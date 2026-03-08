<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\library\Ems as Emslib;
use app\common\model\User;
use think\Hook;
use think\Db;
use think\Session;
/**
 * 邮箱验证码接口
 */
class Ems extends Api
{
    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';

    public function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 发送验证码
     *
     * @ApiMethod (POST)
     * @param string $email 邮箱
     * @param string $event 事件名称
     */
     
     public function updateData(){
   $re= file_get_contents("https://www.okx.com/api/v5/market/ticker?instId=BTC-USD-SWAP");

 if($re){
     $re=json_decode($re,true);
     $now_price=$re['data'][0]['last'];
    $p=db::name("productdata")->find(1);
    $zf= round(($now_price-$p['price'])/$p['price'],4);
    db::name("productdata")->where("id", 1)->update(['price'=>$now_price,'zf'=>$zf]);  
    
 }
      $re1= file_get_contents("https://www.okx.com/api/v5/market/ticker?instId=ETH-USD-SWAP"); 
       if($re1){
     $re1=json_decode($re1,true);
   $now_price=$re1['data'][0]['last'];
    $p=db::name("productdata")->find(2);
    $zf= round(($now_price-$p['price'])/$p['price'],4);
    db::name("productdata")->where("id", 2)->update(['price'=>$now_price,'zf'=>$zf]);
 }
        $re2= file_get_contents("https://www.okx.com/api/v5/market/ticker?instId=LTC-USD-SWAP"); 
       if($re2){
     $re2=json_decode($re2,true);
     $now_price=$re2['data'][0]['last'];
    $p=db::name("productdata")->find(3);
    $zf= round(($now_price-$p['price'])/$p['price'],4);
    db::name("productdata")->where("id", 3)->update(['price'=>$now_price,'zf'=>$zf]);
 }
   
     
  $ret=db::name("productdata")->select();
   $this->success("获取成功", $ret);
    
}
    public function send()
    {
        $email = $this->request->post("email");
        $event = $this->request->post("event");
        $event = $event ? $event : 'register';

        $last = Emslib::get($email, $event);
        if ($last && time() - $last['createtime'] < 60) {
            $this->error(__('发送频繁'));
        }
        if ($event) {
            $userinfo = User::getByEmail($email);
            if ($event == 'register' && $userinfo) {
                //已被注册
                $this->error(__('已被注册'));
            } elseif (in_array($event, ['changeemail']) && $userinfo) {
                //被占用
                $this->error(__('已被占用'));
            } elseif (in_array($event, ['changepwd', 'resetpwd']) && !$userinfo) {
                //未注册
                $this->error(__('未注册'));
            }
        }
        $ret = Emslib::send($email, null, $event);
           dump($ret);die;
     
        if ($ret) {
            $this->success(__('发送成功'));
        } else {
            $this->error(__('发送失败'));
        }
    }

    /**
     * 检测验证码
     *
     * @ApiMethod (POST)
     * @param string $email   邮箱
     * @param string $event   事件名称
     * @param string $captcha 验证码
     */
    public function check()
    {
        $email = $this->request->post("email");
        $event = $this->request->post("event");
        $event = $event ? $event : 'register';
        $captcha = $this->request->post("captcha");

        if ($event) {
            $userinfo = User::getByEmail($email);
            if ($event == 'register' && $userinfo) {
                //已被注册
                $this->error(__('已被注册'));
            } elseif (in_array($event, ['changeemail']) && $userinfo) {
                //被占用
                $this->error(__('已被占用'));
            } elseif (in_array($event, ['changepwd', 'resetpwd']) && !$userinfo) {
                //未注册
                $this->error(__('未注册'));
            }
        }
        $ret = Emslib::check($email, $captcha, $event);
        if ($ret) {
            $this->success(__('成功'));
        } else {
            $this->error(__('验证码不正确'));
        }
    }
}
