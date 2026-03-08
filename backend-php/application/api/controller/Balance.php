<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;
/**
* 余额宝
*/
class Balance extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];
    public function _initialize() {
        parent::_initialize();
    }

    /**
    * 获取余额宝信息
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    */
    public function get_balance_reve() {
        $page = $this->request->request('page') ?? 1;
        $list = $this->request->request('list') ?? 10;
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error('token 失效', '', 422);
        }
        $ret['count_balance'] = $user->balance_revered;
        $ret['yesterday_money'] = \app\common\model\MoneyLog::where("user_id", $user->id)->where("type", 5)->whereTime("createtime", "yesterday")->sum("money");
        // $ret['today_money'] = \app\common\model\Moneylog::where("user_id", $user->id)->where("type", 5)->whereTime("createtime", "today")->sum("money");
        $ret['total_money'] = \app\common\model\MoneyLog::where("user_id", $user->id)->where("type", 5)->sum("money");
        $ret['dayrate'] = Db::name('config')->where('name', 'dayrate')->value("value");
        $ret['list'] = \app\common\model\MoneyLog::where("user_id", $user->id)->where("type", 5)->page($page, $list)->order('id desc')->select();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    
    /**
    * 获取余额宝记录
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    */
    public function get_balance_list() {
        $page = $this->request->request('page') ?? 1;
        $list = $this->request->request('list') ?? 10;
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error('token 失效', '', 422);
        }
        $ret= \app\common\model\MoneyLog::where("user_id", $user->id)->where("type", 5)->page($page, $list)->order('id desc')->select();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->success("暂无数据",[]);
        }
    }
    /**
    * 转入&转出
    *
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @ApiMethod (POST)
    * @param string $type 1转入2转出
    * @param string $money 金额
    */
    public function transfer_in() {
        $type = $this->request->request('type');
        $money = $this->request->request('money');
        $user = $this->auth->getUser();
        if (! $user) {
            $this->error('token 失效', '', 422);
        }
        if ($type == '' || $money == '') {
            $this->error('必填参数不能为空');
        }
        $result = false;
        Db::startTrans();
        try {
            if ($type == 1) {
                if ($this->auth->money < $money) {
                    $this->error("金额不足！");
                }
                \app\common\model\User::where("id", $user->id)->setdec("money", $money);
                \app\common\model\User::where("id", $user->id)->setinc("balance_revered", $money);
                \app\common\model\User::money(-$money, $this->auth->id, "金额转入余额宝", 0);
                $result = \app\common\model\User::money_baby($money, $this->auth->id, "金额转入余额宝", 5);
            } else {
                if ($this->auth->balance_revered < $money) {
                    $this->error("余额宝金额不足！");
                }
                \app\common\model\User::where("id", $user->id)->setdec("money", $money);
                \app\common\model\User::where("id", $user->id)->setinc("balance_revered", $money);
                \app\common\model\User::money($money, $this->auth->id, "余额宝转出金额", 0);
                $result = \app\common\model\User::money_baby(-$money, $this->auth->id, "余额宝转出金额", 5);
            }

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
            $this->success("操作成功");
        } else {
            $this->error("操作失败");
        }



    }


    public function Scheduled_Tasks() {
        $result = false;
        Db::startTrans();
        try {
            Db::name('user')->where('balance_revered',
                '>',
                0)->chunk(100,
                function($users) {
                    $dayrate = Db::name('config')->where('name', 'dayrate')->value("value");
                    foreach ($users as $k => $v) {
                        if ($v['change_time'] < time()) {
                            //超过24小时时间戳 执行分发
                            $money = $v['balance_revered'] * $dayrate;
                            \app\common\model\User::money_baby($money, $this->auth->id, "余额宝转入", 5);
                            \app\common\model\User::where("id", $v['id'])->update(["change_time" => strtotime('+1 day')]);
                        }
                    }
                });

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


    }

}