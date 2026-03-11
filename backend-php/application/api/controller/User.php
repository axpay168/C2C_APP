<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\library\Ems;
use app\common\library\Sms;
use app\common\library\Sms as Smslib;
use fast\Random;
use think\Config;
use think\Hook;
use think\Db;
use think\Validate;
use think\App;
use think\Request;
use think\Lang;
use think\Session;
use app\api\controller\Common;

use think\Cache;

/**
*
* 会员接口
*/
class User extends Api
{
    protected $noNeedLogin = ['login',
        'mobilelogin',
        'register',
        'resetpwd',
        'changeemail',
        'changemobile',
        'third',
        'robot',
        'send_email_mobile',
        'change_pwd',
        'index',
        'indexs'];
    protected $noNeedRight = '*';
    protected static $langPack;

    public function _initialize() {
        parent::_initialize();
        $lang = $this->request->request('lang');

        if (!Config::get('fastadmin.usercenter')) {
            $this->error(__('User center already closed'));
        }



    }
    public function index() {
        $langPack = $this->getLangPack($lang)->getData();
        dump($langPack); die;

    }

    public function indexs() {
        $lang = $this->request->request('lang');
        $lang = "eng";
        $langPack = $this->getLangPack($lang)->getData();
        dump($langPack); die;

    }


    /**
    * 发送邮箱验证码或短信验证码
    * @param string  $username   邮箱&手机号
    * @param string $event 事件名称register或者login
    * @return boolean
    */
    public function send_email_mobile($code = null) {
        $lang = $this->request->request('lang');
        $username = $this->request->post('username');
        if (!$lang) {
            $this->error(__('language is not null'));
        }

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            if ($username && !Validate::is($username, "email")) {
                $this->error($this->getLangPack($lang)->getData()['email is incorrect']);
            }
            $event = "reg";
            $code = is_null($code) ? mt_rand(100000, 999999) : $code;
            $tres = mailTo($username, $this->getLangPack($lang)->getData()['certificat d\'enregistrement'], $this->getLangPack($lang)->getData()['your verification code is'].$code);
            db::name("ems")->insert(['email' => $username, 'event' => $event, 'code' => $code, 'times' => 0, 'createtime' => time(),]);
            if ($tres == 1) {
                $this->success($this->getLangPack($lang)->getData()['the email was sent successfully']);
            } else {
                $this->error($this->getLangPack($lang)->getData()['other errors']);
            }
        } else {
            $mobile = $username;
            $event = $this->request->request("event");
            $event = $event ? $event : 'register';

            // if (!$mobile || !\think\Validate::regex($mobile, "^1\d{10}$")) {
            //     $this->error(__('手机号不正确'));
            // }
            $last = Smslib::get($mobile, $event);
            if ($last && time() - $last['createtime'] < 60) {
                $this->error($this->getLangPack($lang)->getData()['send frequently']);
            }
            $ipSendTotal = \app\common\model\Sms::where(['ip' => $this->request->ip()])->whereTime('createtime', '-1 hours')->count();
            if ($ipSendTotal >= 5) {
                $this->error($this->getLangPack($lang)->getData()['send frequently']); //发送频繁
            }

            if ($event) {
                $userinfo = \app\common\model\User::getByMobile($mobile);
                if ($event == 'register' && $userinfo) {
                    //已被注册
                    $this->error($this->getLangPack($lang)->getData()['already registered']);
                } elseif (in_array($event, ['changemobile']) && $userinfo) {
                    //被占用
                    $this->error($this->getLangPack($lang)->getData()['already occupied']);
                } elseif (in_array($event, ['changepwd', 'resetpwd']) && !$userinfo) {
                    //未注册
                    $this->error($this->getLangPack($lang)->getData()['not registered']);
                }
            }
            if (!Hook::get('sms_send')) {
                $this->error($this->getLangPack($lang)->getData()['please check sms configuration']);
            }
            $ret = Smslib::send($mobile, mt_rand(100000, 999999), $event);
            if ($ret) {
                $this->success($this->getLangPack($lang)->getData()['sms sent successfully']);
            } else {
                $this->error($this->getLangPack($lang)->getData()['fail']);
            }
        }
        $this->error($this->getLangPack($lang)->getData()['illegal request']);

    }

    /**
    * 会员登录
    *
    * @ApiMethod (POST)
    * @param string $account  账号
    * @param string $password 密码
    */
    public function login() {
        $lang = $this->request->request('lang');
        $account = $this->request->post('account');
        $password = $this->request->post('password');
        if (!$account || !$password) {
            $this->error($this->getLangPack($lang)->getData()['invalid parameters']);
        }
        $ret = $this->auth->login($account, $password, $lang);
        if ($ret) {
            $data = ['userinfo' => $this->auth->getUserinfo()];
            $this->success($this->getLangPack($lang)->getData()['logged in successful'], $data);
        } else {
            $this->error($this->auth->getError());
        }
    }

    /**
    * 注册会员
    *
    * @ApiMethod (POST)
    * @param string $username 邮箱&手机号
    * @param string $password 密码
    * @param string $code     验证码
    * @param string $invitation_code   邀请码
    */
    public function register() {
        $lang = $this->request->request('lang');
        $username = $this->request->post('username');
        $password = $this->request->post('password');
        $invitation_code = $this->request->post('invitation_code');
        $code = $this->request->post('code');
        if (!$username || !$password) {
            $this->error($this->getLangPack($lang)->getData()['invalid parameters']);
        }
        if (!$invitation_code) {
            $this->error($this->getLangPack($lang)->getData()['invitation code cannot be empty']);
        }

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            if ($username && !Validate::is($username, "email")) {
                $this->error($this->getLangPack($lang)->getData()['email is incorrect']);
            }
            $extend['email'] = $username;
            $retsm = db::name("ems")->where('email', $username)->order("id desc")->value("code");
            if ($retsm !== $code&&1>2) {
                $this->error($this->getLangPack($lang)->getData()['email verification code error']);
            }
        } else {
            // if ($username && !Validate::regex($username, "^1\d{10}$")) {
            //     $this->error(__('Mobile is incorrect'));
            // }
            $username = substr($username, 1);
            $extend['mobile'] = $username;
            $ret = Sms::check($username, $code, 'register');
            if (!$ret) {
              //  $this->error($this->getLangPack($lang)->getData()['captcha is incorrect']);
            }
        }
        $inv = db::name("user")->where("code", $invitation_code)->find();
        if (!$inv) {
           // $this->error($this->getLangPack($lang)->getData()['the invitation code is wrong or does not exist']);
        }

        $ret = $this->auth->register($username, $password, $inv['id'], $lang, $extend);
        
        if ($ret) {

           // $data = ['userinfo' => $this->auth->getUserinfo()];
            //file_put_contents('11.txt',$this->auth->getUserinfo());
            $this->success(' successful');
        } else {
            $this->error($this->auth->getError());
        }
    }

    /**
    * 忘记密码-找回
    *
    * @ApiMethod (POST)
    * @param string $username  邮箱&手机号
    * @param string $password 密码
    * @param string $code 验证码
    */
    public function change_pwd() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $password = $this->request->post('password');
        $Random = Random::alnum();
        $updata['password'] = $this->getEncryptPassword($password, $Random);
        $updata['salt'] = $Random;
        $updata['updatetime'] = time();
        $result = db::name("user")->where("id", $user->id)->update($updata);
        if ($result !== false) {
            $this->success($this->getLangPack($lang)->getData()['successfully modified']);
        } else {
            $this->error($this->getLangPack($lang)->getData()['fail to edit']);
        }
    }
    // /**
    // * 修改支付密码
    // *
    // * @ApiMethod (POST)
    // * @param string $username  邮箱&手机号
    // * @param string $password 密码
    // * @param string $code 验证码
    // */
    // public function change_paypwd() {
    //     $username = $this->request->post('username');
    //     $password = $this->request->post('password');
    //     $code = $this->request->post('code');
    //     if (!$username || !$password || !$code) {
    //         $this->error(__('Invalid parameters'));
    //     }
    //     $Random = Random::alnum();
    //     $updata['funds_pwd'] = $password;
    //     $updata['updatetime'] = time();
    //     $result = false;
    //     if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
    //         if ($username && !Validate::is($username, "email")) {
    //             $this->error(__('Email is incorrect'));
    //         }
    //         $extend['email'] = $username;
    //         $retsm = db::name("ems")->where('email', $username)->order("id desc")->value("code");
    //         if ($retsm !== $code) {
    //             $this->error('邮箱验证码错误');
    //         }
    //         $result = db::name("user")->where("email", $username)->update($updata);
    //     } else {
    //         if ($username && !Validate::regex($username, "^1\d{10}$")) {
    //             $this->error(__('Mobile is incorrect'));
    //         }
    //         $extend['mobile'] = $username;
    //         $ret = Sms::check($username, $code, 'register');
    //         if (!$ret) {
    //             $this->error(__('Captcha is incorrect'));
    //         }
    //         $result = db::name("user")->where("mobile", $username)->update($updata);
    //     }
    //     if ($result !== false) {
    //         // $this->success(__('修改成功'));
    //         $this->success('modification réussie');
    //     } else {
    //         $this->error(__('error'));
    //     }
    // }




    /**
    * 修改个人信息
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)
    * @param string * 修改什么值传什么值（avatar头像，nickname昵称）
    */
    public function up_userinfo() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $params = $this->request->post();
        $res = \app\common\model\User::where(['id' => $user->id])->update($params);
        if ($res) {
            // $this->success('修改成功');
            $this->success('modification réussie');
        } else {
            $this->error('error');
        }
    }
    /**
    * 获取个人信息
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)

    */
    public function getUserinfo() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $data = $this->auth->getUserinfo();
        $data['bank'] = \app\admin\model\Bank::where('user_id', $user->id)->where("is_del", 0)->order('id desc')->select();
        if ($this->auth->id) {
            $this->success("获取成功", $data);
        } else {
            $this->error("提交失败");
        }
    }
    /**
    * 获取分享链接
    */
    public function obtain_share() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        if ($user->group_id == 3) {
            $user['share_link'] = "https://".$_SERVER['SERVER_NAME'] ."/#/pages/common/register?pid=".$this->auth->code;
            $user['share_code'] = $this->auth->code;

            return $this->success("success", $user);
        } else {
            $user['share_link'] = 0;
            $user['share_code'] = 0;

            return $this->success("success", $user);
        }

    }




    /**
    * 收益记录
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)

    * @param string $page 从1开始
    * @param string $list 分页长度,默认10
    */
    public function revenue_expenditure() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $page = $this->request->post('page') ?? 1;
        $list = $this->request->post('list') ?? 20;
        // * @param string $year 年
        // * @param string $month 月
        // * @param string $day 日
        // $year = $this->request->request('year') ?? date('Y');
        // $month = $this->request->request('month') ?? date('m');
        // $day = $this->request->request('day') ?? date('d');
        // $tday = $this->getStartAndEndUnixTimestamp($year, $month, $day);

        // whereTime('createtime', 'between', [$tday['start'], $tday['end']])->
        $res = \app\common\model\MoneyLog::where('user_id', $user->id)->page($page, $list)->order("createtime desc")->select();
        foreach ($res as $k => $v) {
            $res[$k]['createtime_text'] = date("Y-m-d H:i:s", $v['createtime']);
        }

        if ($res) {
            $this->success('收支明细', $res);
        } else {
            $this->success("暂无数据", []);
        }
    }
    /**
    * 提现记录
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)
    * @param string $page 从1开始
    * @param string $list 分页长度,默认10
    *
    */
    public function withdraw_list() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $page = $this->request->post('page') ?? 1;
        $list = $this->request->post('list') ?? 20;
        $res = \app\admin\model\Withdrawal::field("id,user_id,money,remark,addtime")->page($page, $list)->where('user_id', $user->id)->order("addtime desc")->select();
        foreach ($res as $k => $v) {
            $res[$k]['createtime_text'] = date("Y-m-d H:i:s", $v['addtime']);
        }

        if ($res) {
            $this->success('ok', $res);
        } else {
            $this->success("暂无数据", []);
        }
    }

    /**
    * 充值记录
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)
    * @param string $page 从1开始
    * @param string $list 分页长度,默认10
    */
    public function recharge_list() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $page = $this->request->post('page') ?? 1;
        $list = $this->request->post('list') ?? 20;

        $res = \app\admin\model\Recharge::field("id,user_id,money,remark,addtime")->page($page, $list)->where('user_id', $user->id)->order("addtime desc")->select();
        foreach ($res as $k => $v) {
            $res[$k]['createtime_text'] = date("Y-m-d H:i:s", $v['addtime']);
        }

        if ($res) {
            $this->success('ok', $res);
        } else {
            $this->success("暂无数据", []);
        }
    }

    /**
    * 申请实名提交
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)
    * @param string $name 真实姓名
    * @param string $idno 真实姓名
    * @param string $front 身份证正面
    * @param string $reverse_side 身份证反面
    */
    public function bind_real() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        // $name = $this->request->request('name');
        $idno = $this->request->request('fileurl');
        $front = $this->request->request('fileurl1');
        $reverse_side = $this->request->request('fileurl2');
        if ($front == '' || $idno == '' || $reverse_side == '') {
            $this->error('Les paramètres requis ne peuvent pas être vides');
        }
        $real = \app\admin\model\Real::where('user_id', $user->id)->find();
        if (isset($real['status'])) {

            if ($real['status'] == 0) {
                $this->error('Révision, soyez patient...');
            }
            if ($real['status'] == 2) {
                //重新提交申请审核
                $datas = [
                    'front' => $front,
                    'reverse_side' => $reverse_side,
                    'status' => 0,
                ];
                $rets = \app\admin\model\Real::update($datas);
                if ($retss) {
                    $this->success('Re-soumettre la candidature avec succès');
                } else {
                    $this->error('Échec de la soumission');
                }
            }

        }

        $data = [
            'name' => '',
            'idno' => $idno,

            'user_id' => $user->id,
            'front' => $front,
            'reverse_side' => $reverse_side,
            'addtime' => time()
        ];
        $ret = \app\admin\model\Real::create($data, true);
        if ($ret) {
            $this->success('Soumis avec succès');
        } else {
            $this->error('Échec de la soumission');
        }
    }


    /**
    * 获取实名信息
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)
    */
    public function is_verified() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $ret['status'] = $user->isti;
        $this->success('ok', $ret);


        $ret = \app\admin\model\Real::where('user_id', $user->id)->find();
        if ($ret) {

            $this->success('获取成功', $ret);
        } else {
            $ret['status'] = $user->isti;
            $this->success('暂无实名信息', $ret);
        }
    }

    /**
    * 绑定银行卡
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)
    * @param string $name 真实姓名
    * @param string $card_no 卡号
    * @param string $bank_name 开户银行
    * @param string $bank_deposit 支行
    */
    public function bind_bank() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $name = $this->request->request('name');
        $card_no = $this->request->request('card_no');
        $bank_name = $this->request->request('bank_name');
        $guojia = $this->request->request('guojia');
        $zhou = $this->request->request('zhou');
        $citys = $this->request->request('citys');
        $xingshi = $this->request->request('xingshi');
        $mingzi = $this->request->request('mingzi');
        $mobile = $this->request->request('mobile');
        $dizhis = $this->request->request('dizhis');
        $youbian = $this->request->request('youbian');
$uaddress= $this->request->request('uaddress');

$aname= $this->request->request('aname');
$iban= $this->request->request('iban');
        if ($lang == 'chn' || $lang == 'jpn' || $lang == 'kor' || $lang == 'tha' || $lang == 'vnm' || $lang == 'sgp' || $lang == 'hkg' || $lang == 'ind' || $lang == 'mys') {
            
            if ($name == '' ||   $bank_name == ''  || $mobile == '' || $youbian == '') {
                  $this->error($this->getLangPack($lang)->getData()['required parameters cannot be empty ！！']);
            }
            $data = [
                'user_id' => $user->id,
                'lang' =>$lang,
                'name' => $name,//开户姓名
                'bank_name' => $bank_name,//银行名称
                'card_no' => $card_no,//银行账户
                'mobile' => $mobile,//联系方式
                'youbian' => $youbian,//邮政编码
                'uaddress'=>$uaddress,
                'addtime' => time()
            ];

        } else {
            if ($name == '' || $bank_name == ''   || $mobile == ''|| $youbian == '') {
                // $this->error('必填参数不能为空');
                $this->error($this->getLangPack($lang)->getData()['required parameters cannot be empty ！']);
            }
            $data = [
                'user_id' => $user->id,
                'lang' =>$lang,
                'name' => $name,
                'bank_name' => $bank_name,
                'guojia' => $guojia,
                'card_no' => $card_no,
                'zhou' => $zhou,
                'citys' => $citys,
                'xingshi' => $xingshi,
              
                'mobile' => $mobile,
                
                'youbian' => $youbian,
                'uaddress'=>$uaddress,
                 'aname'=>$aname,
                  'iban'=>$iban,
                'addtime' => time()
            ];
        }
        
            $real = \app\admin\model\Bank::where('user_id', $user->id)->find();
             
        if (isset($real['is_del'])) {
            if ($real['is_del'] == 0) {
                $this->error($this->getLangPack($lang)->getData()['do not apply for real name again']);
            }
            if ($real['is_del'] == 1) {
                $this->error($this->getLangPack($lang)->getData()['the real name has agreed to do not apply again']);
            }
        }
        $ret = \app\admin\model\Bank::create($data, true);
        $this->success($this->getLangPack($lang)->getData()['successful request']);
    }


    public function updete_bank() {
        $lang = $this->request->request('lang');
      
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $bankid = $this->request->request('bankid');
        $name = $this->request->request('name');
        $card_no = $this->request->request('card_no');
        // $bank_deposit = $this->request->request('bank_deposit');
        $bank_name = $this->request->request('bank_name');
        $guojia = $this->request->request('guojia');
        $zhou = $this->request->request('zhou');
        $citys = $this->request->request('citys');
        $xingshi = $this->request->request('xingshi');
        $mingzi = $this->request->request('mingzi');
        $mobile = $this->request->request('mobile');
        $dizhis = $this->request->request('dizhis');
        $youbian = $this->request->request('youbian');
$uaddress = $this->request->request('uaddress');
$aname= $this->request->request('aname');
$iban= $this->request->request('iban');

        if ($lang == 'chn' || $lang == 'jpn' || $lang == 'kor' || $lang == 'tha' || $lang == 'vnm' || $lang == 'sgp' || $lang == 'hkg' || $lang == 'ind' || $lang == 'mys') {
            
            
            if ($name == '' || $card_no == '' ||  $bank_name == ''  || $mobile == '' || $youbian == '') {
                  $this->error($this->getLangPack($lang)->getData()['required parameters cannot be empty']);
            }
            $data = [
                'user_id' => $user->id,
                
                'name' => $name,//开户姓名
                'bank_name' => $bank_name,//银行名称
                'card_no' => $card_no,//银行账户
                'mobile' => $mobile,//联系方式
                'youbian' => $youbian,//邮政编码
                'uaddress'=>$uaddress,
                 'aname'=>$aname,
                  'iban'=>$iban,
                'addtime' => time()
            ];

        } else {
            
         
            $data = [
                'user_id' => $user->id,
                'name' => $name,
                'bank_name' => $bank_name,
                'guojia' => $guojia,
                'card_no' => $card_no,
                'zhou' => $zhou,
                'citys' => $citys,
                'xingshi' => $xingshi,
                'mingzi' => $mingzi,
                'mobile' => $mobile,
                'dizhis' => $dizhis,
                'youbian' => $youbian,
                 'uaddress'=>$uaddress,
                  'aname'=>$aname,
                  'iban'=>$iban,
                'addtime' => time()
            ];
        }
        $ret = \app\admin\model\Bank::where('id', $bankid)->update($data);
        $this->success($this->getLangPack($lang)->getData()['successful request']);
    }

    /**
    * 获取银行卡列表
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)

    */
    public function bank_list() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $page = $this->request->request('page') ?? 1;
        $list = $this->request->request('list') ?? 10;
        $bnak = \app\admin\model\Bank::where('user_id', $user->id)->where("is_del", 0)->page($page, $list)->order('id desc')->select();
        if ($bnak) {
            $this->success("获取成功", $bnak);
        } else {
            $this->success("暂无数据", []);
        }
    }

    /**
    * 软删除银行卡
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)
    * @param string $bank_id 银行卡id
    */
    public function del_bank() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $bank_id = $this->request->request('bank_id');
        if ($bank_id == '') {
            $this->error('必填参数不能为空');
        }
        $bank = \app\admin\model\Bank::where('id', $bank_id)->find();
        if ($bank['is_del'] == 1) {
            $this->error('该银行卡已删除');
        }
        $ret = \app\admin\model\Bank::where("id", $bank_id)->update(['is_del' => 1]);
        $this->success('yêu cầu thành công', $ret);
    }

    /**
    * 我要买
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)

    */
    public function tobuy() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $level = $user->level;
        $cishu = db::name("buy")->where('uid', $user->id)->whereTime('addtime', 'today')->count();
        // if ($level > 0) {
        //     $xianci = db::name("zhidu")->where('id', $level)->find();
        //     if ($cishu > $xianci['cishu'] || $cishu == $xianci['cishu']) {
        //         // $this->error('超出当前级别限制交易次数');
        //         $this->error('Le nombre de transactions dépasse la limite du niveau actuel');
        //     }
        //     if ($this->request->request('mine') < $xianci['minx']) {
        //         // $this->error('低于当前级别最低交易额');
        //         $this->error('En dessous du commerce minimum du niveau actuel');
        //     }
        //     if ($this->request->request('maxe') > $xianci['maxs']) {
        //         // $this->error('超出当前级别最大交易额');
        //         $this->error('Dépassé le montant maximum déchange du niveau actuel');
        //     }
        // }

        $data['uid'] = $user->id;
        $data['nowcoin'] = $this->request->request('nowcoin');
        $data['buynum'] = $this->request->request('buynum');
        $data['daojishi'] = $this->request->request('daojishi');
        $data['xtype'] = $this->request->request('xtype');
        $data['zuid'] = $this->request->request('zuid');
        $data['mine'] = $this->request->request('mine');
        $data['maxe'] = $this->request->request('maxe');
        $data['addtime'] = time();
        $ret = db::name("buy")->insert($data);
        $this->success($this->getLangPack($lang)->getData()['successful request'], $ret);
    }

    /**
    * 我要卖
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)

    */
    public function tosell() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        if ($this->request->request('mainum') < 0 || $this->request->request('mainum') == 0) {
            // $this->error('资金不足');
            $this->error($this->getLangPack($lang)->getData()['insufficient funds']);
        }
        if ($this->request->request('mainum') > $user->money) {
            // $this->error('资金不足');
            $this->error($this->getLangPack($lang)->getData()['insufficient funds']);
        }
        $level = $user->level;
        $group_id = $user->group_id;
        $cishu = db::name("sell")->where('uid', $user->id)->whereTime('addtime', 'today')->count();
        // if ($level > 0) {
        //     $jib = $level+1;
        //     $levelname = 'vip'.$jib;
        //     $xianci = db::name("zhidu")->where('zubie', $group_id)->where('level', $levelname)->find();
        //     // var_dump($xianci);die;
        //     if ($cishu > $xianci['cishu'] || $cishu == $xianci['cishu']) {
        //         // $this->error('超出当前级别限制交易次数');
        //         $this->error('Số lượng giao dịch vượt quá giới hạn mức hiện tại');
        //     }
        //     if ($this->request->request('mainum') < $xianci['minx']) {
        //         // $this->error('低于当前级别最低交易额');
        //         $this->error('Dưới mức giao dịch tối thiểu của mức hiện tại');
        //     }
        //     if ($this->request->request('mainum') > $xianci['maxs']) {
        //         // $this->error('超出当前级别最大交易额');
        //         $this->error('Vượt quá số tiền giao dịch tối đa của mức hiện tại');
        //     }
        // }
        $shoujia = \app\common\model\Config::where(["name" => "zuiyou"])->value("value");
        if ($this->request->request('maijia') > $shoujia) {
            $this->error($this->getLangPack($lang)->getData()['the selling price cannot exceed the current exchange rate']);
        }
        $data['uid'] = $user->id;
        $data['maijia'] = $this->request->request('maijia');
        $data['mainum'] = $this->request->request('mainum');
        $data['addtime'] = time();
        $yuedun = $this->request->request('maijia') * $this->request->request('mainum');
        \app\common\model\User::where(["id" => $this->auth->id])->setDec("money", $this->request->request('mainum'));
        \app\common\model\User::where(["id" => $this->auth->id])->setInc("balance_revered", $yuedun);
        $ret = db::name("sell")->insert($data);
        $this->success($this->error($this->getLangPack($lang)->getData()['successful request']), $ret);
    }

    //otc售卖
    public function isotcsell() {
        // dump(date("Y-m-d H:i:s",time()));die;
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        if ($user->weigui !== '0') {
            $this->success('weigui', $user->weigui);
        }
        if ($user->isti == 0) {
            $this->success('jutishi', $user->jutishi);
        }
        $this->success('success');
    }

    //otc售卖
    public function otcsell() {
        
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        if ($this->request->request('mainum') < 0 || $this->request->request('mainum') == 0) {
            // $this->error('资金不足');
            $this->error($this->getLangPack($lang)->getData()['insufficient funds']);
        }
        if ($this->request->request('mainum') > $user->money) {
            // $this->error('资金不足');
            $this->error($this->getLangPack($lang)->getData()['insufficient funds']);
        }
        if ($user->weigui !== '0') {
            $this->error($user->weigui);
        }
        if ($user->isti == 0) {
            $this->error($user->jutishi);
        }

//zuidia


if($user->zuidia>0){
    if($this->request->request('mainum')<$user->zuidia){
    $this->error("Minimum sales amount of ".$user->zuidia);    
    }
}
/*file_put_contents('119.txt',json_encode($user));*/
   
        $level = $user->level;
        // $group_id = $user->group_id;
        $cishu = db::name("sell")->where('uid', $user->id)->whereTime('addtime', 'today')->count();
        $cishus = db::name("dtrecod")->where('uid', $user->id)->count();

        if ($user->buy_num > 0) {
            if ($cishus >= $user->buy_num) {
                $this->error("交易次数已超出限额");
            }


        }
        // dump($cishus);die;
        // var_dump($cishu);die;
        // if ($user->zuidia == 0) {
        //     if ($level > 0) {
        //         $jib = $level+1;
        //         $levelname = 'vip'.$jib;
        //         $xianci = db::name("zhidu")->where('level', $levelname)->find();
        //         if ($cishu > $xianci['cishu'] || $cishu == $xianci['cishu']) {
        //             // $this->error('超出当前级别限制交易次数');
        //             $this->error('Le nombre de transactions dépasse la limite du niveau actuel');
        //         }
        //         if ($this->request->request('mainum') < $xianci['minx']) {
        //             // $this->error('低于当前级别最低交易额');
        //             $this->error('La vente minimum de votre compte nécessite '.$xianci['minx'].' usdt');
        //         }
        //         if ($this->request->request('mainum') > $xianci['maxs']) {
        //             // $this->error('超出当前级别最大交易额');
        //             $this->error("Dépassé le montant maximum d'échange du niveau actuel");
        //         }
        //     }
        // } else {
        //     if ($this->request->request('mainum') < $user->zuidia) {
        //         // $this->error('低于当前级别最低交易额');
        //         $this->error('La vente minimum de votre compte nécessite '.$user->zuidia.' usdt');
        //     }
        // }

        $dingid = $this->request->request('orderid');
        $orders = db::name("order")->where('id', $dingid)->find();
        if ($this->request->request('mainum') < $orders['mine']) {
            // $this->error('低于该订单最低交易额');
            $this->error('En dessous du montant minimum de transaction de la commande');
        }
        if ($this->request->request('mainum') > $orders['maxe']) {
            // $this->error('超出该订单最大交易额');
            $this->error('Dépassé le montant maximum de transaction de la commande');
        }
        // if($this->request->request('mainum') > $orders['shengyu']){
        //     $this->error('超出该订单剩余所需金额');
        // }


        $data['uid'] = $user->id;
        $data['orderid'] = $dingid;
        $data['money'] = $this->request->request('mainum');
        $data['danjia'] = $this->request->request('danjia');
        $data['addtime'] = time();
        db::name("order")->where('id', $dingid)->setDec("shengyu", $this->request->request('mainum'));
        // db::name("order")->where('id',$dingid)->setDec("shuliang",$this->request->request('mainum'));
        \app\common\model\User::where(["id" => $this->auth->id])->setDec("money", $this->request->request('mainum'));

        // $licai = \app\common\model\Config::where(["name" => "licai"])->value("value");
        // $jines = sprintf("%.2f",$this->request->request('mainum') * $this->request->request('danjia'));
        // \app\common\model\User::where(["id" => $this->auth->id])->setInc("balance_revered", $jines);

        $ret = db::name("dtrecod")->insert($data);
        $this->success('出售成功', $ret);
    }

    //额度转换
    public function utovnd() {
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        if ($this->request->request('type') == 1) {
            if ($this->request->request('money') > $user->moneys) {
                // $this->error('资金不足');
                $this->error('Không đủ tiền');
            }
            \app\common\model\User::where(["id" => $this->auth->id])->setDec("moneys", $this->request->request('money'));
            \app\common\model\User::where(["id" => $this->auth->id])->setInc("money", $this->request->request('money'));
            $this->success('thành công');
        } else {
            if ($this->request->request('money') > $user->balance_revered) {
                // $this->error('资金不足');
                $this->error('Không đủ tiền');
            }
            \app\common\model\User::where(["id" => $this->auth->id])->setDec("balance_revered", $this->request->request('money'));
            \app\common\model\User::where(["id" => $this->auth->id])->setInc("moneys", $this->request->request('moneys'));
            $this->success('thành công');
        }
    }

    /**
    * 订单
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)

    */
    public function getsell() {
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $data['uid'] = $user->id;
        $ret = db::name("sell")->where($data)->order('id desc')->select();
        foreach ($ret as $k => $v) {
            // echo date("Y-m-d H:i:s", $v['addtime']);
            $ret[$k]['addtime_text'] = date("Y-m-d H:i:s", $v['addtime']);
        }
        $this->success('yêu cầu thành công', $ret);
    }

    /**
    * 订单
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)

    */
    public function getdtrecod() {
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $data['uid'] = $user->id;
        $ret = db::name("dtrecod")->where($data)->order('id desc')->select();
        foreach ($ret as $k => $v) {
            // echo date("Y-m-d H:i:s", $v['addtime']);
            $ret[$k]['addtime_text'] = date("Y-m-d H:i:s", $v['addtime']);
        }
        $this->success('yêu cầu thành công', $ret);
    }

    /**
    * 交易大厅
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)

    */
    public function dating() {
        $lang = $this->request->request('lang');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $type = $this->request->request('xtype');
      //  $ret = db::name("order")->where('xtype', $type)->where("lang",$lang)->select();
      $ret = db::name("order")->where('xtype', $type)->select();
          file_put_contents('11.txt',$type."|||".$lang);
        for ($i = 0; $i < count($ret); $i++) {
            $renshu = rand(2, 7);
            $tou = ['head_1.png',
                'head_2.png',
                'head_3.png',
                'head_4.png',
                'head_5.png',
                'head_6.png',
                'head_7.png',
                'head_8.png',
                'head_9.png',
                'head_10.png',
                'head_11.png',
                'head_12.png',
                'head_13.png',
                'head_14.png',
                'head_15.png'];
            $random_keys = array_rand($tou, $renshu);
            $toux = [];
            //  var_dump($random_keys);die;
            foreach ($random_keys as $key => $value) {
                array_push($toux, $tou[$random_keys[$key]]);
            }
            //  for ($j = 0; $j < count($random_keys); $j++) {
            //       array_push($toux,$tou[$random_keys[$j]]);
            //  }
            $ret[$i]['head'] = $toux;
        }
        if ($ret) {
          
            $this->success("获取成功", $ret);
        } else {
            $this->success("暂无数据", []);
        }
    }

    public function datings() {
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        // $type = $this->request->request('xtype');
        $ret = db::name("rorder")->orderRaw('rand()')->select();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->success("暂无数据", []);
        }
    }

    /**
    * 商家升级
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)

    */
    public function upshang() {
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $data['uid'] = $user->id;
        $data['images'] = $this->request->request('images');
        $data['addtime'] = time();
        $ret = db::name("shangup")->insert($data);
        $this->success('yêu cầu thành công', $ret);
    }

    public function isups() {
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $data['uid'] = $user->id;
        $data['status'] = 1;
        $ret = db::name("shangup")->where($data)->find();
        if ($ret) {
            $this->success("获取成功", 1);
        } else {
            $this->success("暂无数据", 0);
        }
    }


    //不用管
    //获取理财产品
    public function getfina() {
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $ret = db::name("fina")->select();
        $this->success('yêu cầu thành công', $ret);
    }

    //购买理财
    public function setfina() {
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        if ($this->request->request('moneys') > $user->moneys) {
            // $this->error('资金不足');
            $this->error('Không đủ tiền');
        }
        $licai = db::name("fina")->where('id', $this->request->request('fid'))->find();
        if ($this->request->request('moneys') < $licai['minday']) {
            // $this->error('低于限额');
            $this->error('dưới giới hạn');
        }
        if ($this->request->request('moneys') > $licai['maxday']) {
            // $this->error('高于限额');
            $this->error('trên giới hạn');
        }
        if ($this->request->request('days') < $licai['minmon']) {
            // $this->error('低于最低天数');
            $this->error('ít hơn số ngày tối thiểu');
        }
        if ($this->request->request('days') > $licai['maxmon']) {
            // $this->error('高于最高天数');
            $this->error('trên số ngày tối đa');
        }
        $data['uid'] = $user->id;
        $data['fid'] = $this->request->request('fid');
        $data['moneys'] = $this->request->request('moneys');
        $data['days'] = $this->request->request('days');
        $data['addtime'] = time();
        \app\common\model\User::where(["id" => $this->auth->id])->setDec("moneys", $this->request->request('moneys'));
        $ret = db::name("userfina")->insert($data);
        $this->success('yêu cầu thành công', $ret);
    }

    //理财列表
    public function getfinas() {
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $data['uid'] = $user->id;
        $ret = db::name("userfina")->where($data)->select();
        foreach ($ret as $k => $v) {
            // echo date("Y-m-d H:i:s", $v['addtime']);
            $ret[$k]['addtime_text'] = date("Y-m-d H:i:s", $v['addtime']);
        }
        $this->success('success', $ret);
    }

    //end

    public function robot() {
        $data = '{"info":[{"header":"head_1.png","username":"dsqtw****@zoho.com","amount":17960,"time":82},
{"header":"head_2.png","username":"fgafj****@hotmail.com","amount":28563,"time":54},
{"header":"head_3.png","username":"6oscmz****@aol.com","amount":12717,"time":32},
{"header":"head_4.png","username":"nzn3ob****@aol.com","amount":4430,"time":2},
{"header":"head_5.png","username":"61t59****@yahoo.com.vn","amount":3666,"time":35},
{"header":"head_6.png","username":"zi4z6k****@aol.com","amount":9824,"time":31},
{"header":"head_7.png","username":"oa5mvx****@hotmail.com","amount":10086,"time":4},
{"header":"head_8.png","username":"my2mfc****@yahoo.com","amount":8509,"time":83},
{"header":"head_9.png","username":"fyquzc****@hotmail.com","amount":10857,"time":20},
{"header":"head_10.png","username":"h9hzad****@163.com","amount":25735,"time":35},
{"header":"head_11.png","username":"ihhr9u****@163.com","amount":12297,"time":89},
{"header":"head_12.png","username":"f2qaah****@hotmail.com","amount":13040,"time":60},
{"header":"head_13.png","username":"g2zr7z****@163.com","amount":10362,"time":57},
{"header":"head_14.png","username":"15l1bd****@outlook.com","amount":27657,"time":12},
{"header":"head_15.png","username":"uenbp****@yahoo.com","amount":16265,"time":41},
{"header":"head_5.png","username":"53tv94****@yahoo.com","amount":21123,"time":70},
{"header":"head_7.png","username":"hfgde****@aol.com","amount":17448,"time":49},
{"header":"head_3.png","username":"fa2uk2****@yahoo.com","amount":6962,"time":62},
{"header":"head_1.png","username":"5cv2g8****@yahoo.com","amount":4217,"time":72},
{"header":"head_7.png","username":"dsqtwr****@zoho.com","amount":21567,"time":46}],"code":1}
        ';
        $data = json_decode($data, true);
        $data = $data['info'];
        $this->success('yêu cầu thành công', $data);
    }

    public function cointype() {
        $user = $this->auth->getUser();
        if (!$user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $data = \app\common\model\Config::where(["name" => "dizhimen"])->value("value");
        $data = json_decode($data, true);
        $data = $data['rechargetype'];
        $is_wallt = db::name("wallt")->where("uid", $this->auth->id)->find();
        if (!$is_wallt) {
            $wallt = db::name("wallt")->where("uid", 0)->find();
            $duto['uid'] = $this->auth->id;
            db::name("wallt")->where("id", $wallt['id'])->update($duto);
            $data[0]['caddre'] = $wallt['address'];
        } else {
            $data[0]['caddre'] = $is_wallt['address'];
        }
        $this->success('yêu cầu thành công', $data);
    }


    /**
    * 提交充值凭证
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)
    * @param string $image 充值凭证
    * @param string $money 金额
    */

    public function add_Recharge() {
        $user = $this->auth->getUser();
        if (!$user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $image = $this->request->request('image');
        $money = $this->request->request('money');
        // dump($money);die;
        if (!$image || !$money) {
            $this->error("Vui lòng điền đầy đủ thông số");
        }
        // $is_rec = \app\admin\model\Recharge::where("user_id", $user->id)->find();

        // if ($is_rec['stat'] == 0) {
        //     $this->success("请等待审批...");
        // }
        $data = array(
            "image" => $image,
            "money" => $money,
            "pid" => $this->auth->pid,
            "user_id" => $user->id,
            "stat" => 0,
            "remark" => "正在审核中",
            "addtime" => time(),
        );
        $result = \app\admin\model\Recharge::insert($data);
        if ($result) {
            $this->success("gửi thành công");
        } else {
            $this->error("提交失败");
        }
    }




    /**
    * 申请提现
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)
    * @param string $bank_id 银行卡id
    * @param string $money 金额
    */



    public function apply_withdrawal() {
        $lang = $this->request->request('lang');
        $users = $this->auth->getUser();
        if (!$users) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }

        $money = $this->request->request('money');
         $type= $this->request->request('type');
        $bank_id = $this->request->request('bank_id');
        $is_bank = db::name("bank")->where("user_id", $this->auth->id)->count();
        $_bank = db::name("bank")->where("user_id", $this->auth->id)->find();
        // $is_wit = \app\admin\model\Withdrawal::where("user_id", $users->id)->find();

        if ($users->isti == 0) {
            $this->error($this->getLangPack($lang)->getData()['please contact customer service first']);
        }
        // $level = $users->level;
        // if ($level > 0) {
        //     $cishu = db::name("dtrecod")->whereTime('addtime', 'today')->count();
        //     if ($cishu < 2) {
        //         $this->error("Hãy hoàn thành nhiệm vụ hôm nay");
        //     }
        // }
        if (!$is_bank) {
            $this->error($this->getLangPack($lang)->getData()['please bind your bank card first']);
        }
        if ($money <= 0) {
            $this->error($this->getLangPack($lang)->getData()['withdrawal amount cannot be empty']);

        }
        if ($this->auth->money < $money) {
            $this->error($this->getLangPack($lang)->getData()['insufficient cash balance']);
        }
        $result = false;
        Db::startTrans();
        try {


            $result = \app\admin\model\Withdrawal::insert(["lang"=>$lang,"user_id" => $this->auth->id, "bank_id" => $bank_id, "money" => $money, "type"=>$type,"addtime" => time()]);

            \app\common\model\User::where(["id" => $this->auth->id])->setDec("money", $money);
            // \app\common\model\User::money(-$money, $this->auth->id, "提现扣除".$money, 7);

            Db::commit();
        } catch (ValidateException $e) {
            Db::rollback();
            $this->error($e->getMessage());
        } catch (PDOException $e) {
            Db::rollback();
            $this->error($e->getMessage());
        } catch (Exception $e) {
            Db::rollback();
            $this->error($e->getMessage());
        }

        if ($result !== false) {
            $this->success($this->getLangPack($lang)->getData()['withdrawal application successful']);
        } else {
            $this->error($this->getLangPack($lang)->getData()['withdrawal failed']);
        }

    }




    public function apply_withdrawal2() {
        $lang = $this->request->request('lang');
        $users = $this->auth->getUser();
        if (!$users) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }

        $money = $this->request->request('money');
         $type= $this->request->request('type');
         $usdtaddress= $this->request->request('usdtaddress');
        $bank_id = $this->request->request('bank_id');
        $is_bank = db::name("bank")->where("user_id", $this->auth->id)->count();
        $_bank = db::name("bank")->where("user_id", $this->auth->id)->find();
        // $is_wit = \app\admin\model\Withdrawal::where("user_id", $users->id)->find();

        if ($users->isti == 0) {
            $this->error($this->getLangPack($lang)->getData()['please contact customer service first']);
        }
        // $level = $users->level;
        // if ($level > 0) {
        //     $cishu = db::name("dtrecod")->whereTime('addtime', 'today')->count();
        //     if ($cishu < 2) {
        //         $this->error("Hãy hoàn thành nhiệm vụ hôm nay");
        //     }
        // }
        if (!$is_bank) {
            $this->error($this->getLangPack($lang)->getData()['please bind your bank card first']);
        }
        if ($money <= 0) {
            $this->error($this->getLangPack($lang)->getData()['withdrawal amount cannot be empty']);

        }
        if ($this->auth->balance_revered	 < $money) {
            $this->error($this->getLangPack($lang)->getData()['insufficient cash balance']);
        }
        $result = false;
        Db::startTrans();
        try {


            $result = \app\admin\model\Withdrawal::insert(["lang"=>$lang,"user_id" => $this->auth->id, "bank_id" => $bank_id, "money" => $money, "type"=>$type,"addtime" => time(),'usdtaddress'=>$usdtaddress]);

            \app\common\model\User::where(["id" => $this->auth->id])->setDec("balance_revered", $money);
            // \app\common\model\User::money(-$money, $this->auth->id, "提现扣除".$money, 7);

            Db::commit();
        } catch (ValidateException $e) {
            Db::rollback();
            $this->error($e->getMessage());
        } catch (PDOException $e) {
            Db::rollback();
            $this->error($e->getMessage());
        } catch (Exception $e) {
            Db::rollback();
            $this->error($e->getMessage());
        }

        if ($result !== false) {
            $this->success($this->getLangPack($lang)->getData()['withdrawal application successful']);
        } else {
            $this->error($this->getLangPack($lang)->getData()['withdrawal failed']);
        }

    }



    /**
    * 获取我的团队
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)

    */
    public function team_list() {
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error($this->getLangPack($lang)->getData()['token failed']);
        }
        $one_uids = db::name("user")->where("pid", $user->id)->field("id,username")->select();
        //下级数量
        $list['subordinate_num'] = count($one_uids);
        $list['list'] = $one_uids;
        if ($list) {
            $this->success("获取成功", $list);
        } else {
            $this->success("Không có dữ liệu", []);
        }
    }


    /**
    * ==================
    *
    */
    public function getEncryptPassword($password, $salt = '') {
        return md5(md5($password) . $salt);
    }


    //获取指定年月日的开始时间戳和结束时间戳
    private function getStartAndEndUnixTimestamp($year = 0, $month = 0, $day = 0) {
        if (empty($year)) {
            $year = date("Y");
        }
        $start_year = $year;
        $start_year_formated = str_pad(intval($start_year), 4, "0", STR_PAD_RIGHT);
        $end_year = $start_year + 1;
        $end_year_formated = str_pad(intval($end_year), 4, "0", STR_PAD_RIGHT);

        if (empty($month)) {
            //只设置了年份
            $start_month_formated = '01';
            $end_month_formated = '01';
            $start_day_formated = '01';
            $end_day_formated = '01';
        } else
        {
            $month > 12 || $month < 1 ? $month = 1 : $month = $month;
            $start_month = $month;
            $start_month_formated = sprintf("%02d", intval($start_month));

            if (empty($day)) {
                //只设置了年份和月份
                $end_month = $start_month + 1;

                if ($end_month > 12) {
                    $end_month = 1;
                } else
                {
                    $end_year_formated = $start_year_formated;
                }
                $end_month_formated = sprintf("%02d", intval($end_month));
                $start_day_formated = '01';
                $end_day_formated = '01';
            } else
            {
                //设置了年份月份和日期
                $startTimestamp = strtotime($start_year_formated.'-'.$start_month_formated.'-'.sprintf("%02d", intval($day))." 00:00:00");
                $endTimestamp = $startTimestamp + 24 * 3600 - 1;
                return array('start' => $startTimestamp, 'end' => $endTimestamp);
            }
        }
        $startTimestamp = strtotime($start_year_formated.'-'.$start_month_formated.'-'.$start_day_formated." 00:00:00");
        $endTimestamp = strtotime($end_year_formated.'-'.$end_month_formated.'-'.$end_day_formated." 00:00:00") - 1;
        return array('start' => $startTimestamp, 'end' => $endTimestamp);
    }






    public function getLangPack($lang = 'chn') {

        Lang::range($lang); // 设置当前语言
        Lang::load(APP_PATH . 'api/lang' . DIRECTORY_SEPARATOR . $lang . '.php');
        $langPack = Lang::get();
        return json($langPack, 200);
        die;


        if (!isset(self::$langPack[$lang])) {
            // 尝试从缓存中获取语言包
            $cacheKey = 'langPack:' . $lang;
            $langPack = Cache::get($cacheKey);
            if (!$langPack) {
                Lang::range($lang); // 设置当前语言
                Lang::load(APP_PATH . 'api/lang' . DIRECTORY_SEPARATOR . $lang . '.php');
                $langPack = Lang::get();
                // 将语言包存储到缓存中，设置过期时间（例如，60秒）
                Cache::set($cacheKey, $langPack, 60);
            }
            self::$langPack[$lang] = $langPack;
        }
        return json(self::$langPack[$lang], 200);
    }


    // /**
    // * 会员中心
    // */
    // public function index() {
    //     $this->success('', ['welcome' => $this->auth->nickname]);
    // }

    // /**
    // * 手机验证码登录
    // *
    // * @ApiMethod (POST)
    // * @param string $mobile  手机号
    // * @param string $captcha 验证码
    // */
    // public function mobilelogin() {
    //     $mobile = $this->request->post('mobile');
    //     $captcha = $this->request->post('captcha');
    //     if (!$mobile || !$captcha) {
    //         $this->error(__('Invalid parameters'));
    //     }
    //     if (!Validate::regex($mobile, "^1\d{10}$")) {
    //         $this->error(__('Mobile is incorrect'));
    //     }
    //     if (!Sms::check($mobile, $captcha, 'mobilelogin')) {
    //         $this->error(__('Captcha is incorrect'));
    //     }
    //     $user = \app\common\model\User::getByMobile($mobile);
    //     if ($user) {
    //         if ($user->status != 'normal') {
    //             $this->error(__('Account is locked'));
    //         }
    //         //如果已经有账号则直接登录
    //         $ret = $this->auth->direct($user->id);
    //     } else {
    //         $ret = $this->auth->register($mobile, Random::alnum(), '', $mobile, []);
    //     }
    //     if ($ret) {
    //         Sms::flush($mobile, 'mobilelogin');
    //         $data = ['userinfo' => $this->auth->getUserinfo()];
    //         $this->success(__('Logged in successful'), $data);
    //     } else {
    //         $this->error($this->auth->getError());
    //     }
    // }

    // /**
    // * 退出登录
    // * @ApiMethod (POST)
    // */
    // public function logout() {
    //     if (!$this->request->isPost()) {
    //         $this->error(__('Invalid parameters'));
    //     }
    //     $this->auth->logout();
    //     $this->success(__('Logout successful'));
    // }

    // /**
    // * 修改会员个人信息
    // *
    // * @ApiMethod (POST)
    // * @param string $avatar   头像地址
    // * @param string $username 用户名
    // * @param string $nickname 昵称
    // * @param string $bio      个人简介
    // */
    // public function profile() {
    //     $user = $this->auth->getUser();
    //     $username = $this->request->post('username');
    //     $nickname = $this->request->post('nickname');
    //     $bio = $this->request->post('bio');
    //     $avatar = $this->request->post('avatar', '', 'trim,strip_tags,htmlspecialchars');
    //     if ($username) {
    //         $exists = \app\common\model\User::where('username', $username)->where('id', '<>', $this->auth->id)->find();
    //         if ($exists) {
    //             $this->error(__('Username already exists'));
    //         }
    //         $user->username = $username;
    //     }
    //     if ($nickname) {
    //         $exists = \app\common\model\User::where('nickname', $nickname)->where('id', '<>', $this->auth->id)->find();
    //         if ($exists) {
    //             $this->error(__('Nickname already exists'));
    //         }
    //         $user->nickname = $nickname;
    //     }
    //     $user->bio = $bio;
    //     $user->avatar = $avatar;
    //     $user->save();
    //     $this->success();
    // }

    // /**
    // * 修改邮箱
    // *
    // * @ApiMethod (POST)
    // * @param string $email   邮箱
    // * @param string $captcha 验证码
    // */
    // public function changeemail() {
    //     $user = $this->auth->getUser();
    //     $email = $this->request->post('email');
    //     $captcha = $this->request->post('captcha');
    //     if (!$email || !$captcha) {
    //         $this->error(__('Invalid parameters'));
    //     }
    //     if (!Validate::is($email, "email")) {
    //         $this->error(__('Email is incorrect'));
    //     }
    //     if (\app\common\model\User::where('email', $email)->where('id', '<>', $user->id)->find()) {
    //         $this->error(__('Email already exists'));
    //     }
    //     $result = Ems::check($email, $captcha, 'changeemail');
    //     if (!$result) {
    //         $this->error(__('Captcha is incorrect'));
    //     }
    //     $verification = $user->verification;
    //     $verification->email = 1;
    //     $user->verification = $verification;
    //     $user->email = $email;
    //     $user->save();

    //     Ems::flush($email, 'changeemail');
    //     $this->success();
    // }

    // /**
    // * 修改手机号
    // *
    // * @ApiMethod (POST)
    // * @param string $mobile  手机号
    // * @param string $captcha 验证码
    // */
    // public function changemobile() {
    //     $user = $this->auth->getUser();
    //     $mobile = $this->request->post('mobile');
    //     $captcha = $this->request->post('captcha');
    //     if (!$mobile || !$captcha) {
    //         $this->error(__('Invalid parameters'));
    //     }
    //     if (!Validate::regex($mobile, "^1\d{10}$")) {
    //         $this->error(__('Mobile is incorrect'));
    //     }
    //     if (\app\common\model\User::where('mobile', $mobile)->where('id', '<>', $user->id)->find()) {
    //         $this->error(__('Mobile already exists'));
    //     }
    //     $result = Sms::check($mobile, $captcha, 'changemobile');
    //     if (!$result) {
    //         $this->error(__('Captcha is incorrect'));
    //     }
    //     $verification = $user->verification;
    //     $verification->mobile = 1;
    //     $user->verification = $verification;
    //     $user->mobile = $mobile;
    //     $user->save();

    //     Sms::flush($mobile, 'changemobile');
    //     $this->success();
    // }

    // /**
    // * 第三方登录
    // *
    // * @ApiMethod (POST)
    // * @param string $platform 平台名称
    // * @param string $code     Code码
    // */
    // public function third() {
    //     $url = url('user/index');
    //     $platform = $this->request->post("platform");
    //     $code = $this->request->post("code");
    //     $config = get_addon_config('third');
    //     if (!$config || !isset($config[$platform])) {
    //         $this->error(__('Invalid parameters'));
    //     }
    //     $app = new \addons\third\library\Application($config);
    //     //通过code换access_token和绑定会员
    //     $result = $app-> {
    //         $platform
    //     }->getUserInfo(['code' => $code]);
    //     if ($result) {
    //         $loginret = \addons\third\library\Service::connect($platform, $result);
    //         if ($loginret) {
    //             $data = [
    //                 'userinfo' => $this->auth->getUserinfo(),
    //                 'thirdinfo' => $result
    //             ];
    //             $this->success(__('Logged in successful'), $data);
    //         }
    //     }
    //     $this->error(__('Operation failed'), $url);
    // }

    // /**
    // * 重置密码
    // *
    // * @ApiMethod (POST)
    // * @param string $mobile      手机号
    // * @param string $newpassword 新密码
    // * @param string $captcha     验证码
    // */
    // public function resetpwd() {
    //     $type = $this->request->post("type");
    //     $mobile = $this->request->post("mobile");
    //     $email = $this->request->post("email");
    //     $newpassword = $this->request->post("newpassword");
    //     $captcha = $this->request->post("captcha");
    //     if (!$newpassword || !$captcha) {
    //         $this->error(__('Invalid parameters'));
    //     }
    //     //验证Token
    //     if (!Validate::make()->check(['newpassword' => $newpassword], ['newpassword' => 'require|regex:\S{6,30}'])) {
    //         $this->error(__('Password must be 6 to 30 characters'));
    //     }
    //     if ($type == 'mobile') {
    //         if (!Validate::regex($mobile, "^1\d{10}$")) {
    //             $this->error(__('Mobile is incorrect'));
    //         }
    //         $user = \app\common\model\User::getByMobile($mobile);
    //         if (!$user) {
    //             $this->error(__('User not found'));
    //         }
    //         $ret = Sms::check($mobile, $captcha, 'resetpwd');
    //         if (!$ret) {
    //             $this->error(__('Captcha is incorrect'));
    //         }
    //         Sms::flush($mobile, 'resetpwd');
    //     } else {
    //         if (!Validate::is($email, "email")) {
    //             $this->error(__('Email is incorrect'));
    //         }
    //         $user = \app\common\model\User::getByEmail($email);
    //         if (!$user) {
    //             $this->error(__('User not found'));
    //         }
    //         $ret = Ems::check($email, $captcha, 'resetpwd');
    //         if (!$ret) {
    //             $this->error(__('Captcha is incorrect'));
    //         }
    //         Ems::flush($email, 'resetpwd');
    //     }
    //     //模拟一次登录
    //     $this->auth->direct($user->id);
    //     $ret = $this->auth->changepwd($newpassword, '', true);
    //     if ($ret) {
    //         $this->success(__('Reset password successful'));
    //     } else {
    //         $this->error($this->auth->getError());
    //     }
    // }
}