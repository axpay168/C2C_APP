<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;
/**
* 首页接口
*/
class Product extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];
    public function _initialize() {
        parent::_initialize();
    }
    
       /**
    * 获取参数列表
    * @ApiMethod (POST)
    * 
    * @return value(返回参数值)
    */
    public function get_config() {

        $ret = \app\common\model\Config::where("id",'>=',19)->select();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    
    
     /**
    * 获取首页公告
    * @ApiMethod (POST)
    * 
    * @return sw_code(1开启0关闭)
    */
    public function get_announcement() {

        $ret = \app\admin\model\Announcement::find();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    
    /**
    * 获取项目分类
    * @ApiMethod (POST)
    */
    public function get_proclass() {

        $ret = \app\admin\model\Proclass::select();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    
      /**
    * 获取热门项目
    * @ApiMethod (POST)
    * @param string $cid 分类id不传默认全部
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    */
    public function get_hot_list() {
        $page = $this->request->request('page') ?? 1;
        $list = $this->request->request('list') ?? 10;
        $where = [];
        $ret = \app\admin\model\Product::where(["is_hot"=>1])->page($page, $list)->order('id desc')->select();
        foreach ($ret as $k => $v) {
            $ret[$k]['schedule'] = number_format((($v['scale']-$v['remaining'])/$v['scale'])*100, 2);
        }
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }



    /**
    * 获取项目列表
    * @ApiMethod (POST)
    * @param string $cid 分类id不传默认全部
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    */
    public function get_list() {
        $cid = $this->request->request('cid');
        $page = $this->request->request('page') ?? 1;
        $list = $this->request->request('list') ?? 10;
        $where = [];
        if ($cid) {
            $where['cid'] = $cid;
        }
        $ret = \app\admin\model\Product::where($where)->page($page, $list)->order('id desc')->select();
        foreach ($ret as $k => $v) {
            $ret[$k]['schedule'] = number_format((($v['scale']-$v['remaining'])/$v['scale'])*100, 2);
        }
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }


    /**
    * 获取项目详情
    * @ApiMethod (POST)
    * @param string $pro_id 产品id
    */
    public function get_details() {
        $pro_id = $this->request->request('pro_id');

        $ret = \app\admin\model\Product::where("id", $pro_id)->find();
        $ret['schedule'] = number_format((($ret['scale']-$ret['remaining'])/$ret['scale'])*100, 2);
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }


    /**
    * 输入多少金额触发红包（一个项目仅触发一次红包）
    * @ApiMethod (POST)
    * @param string $pro_id 产品id
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    */
    public function set_envelope() {

        $user = $this->auth->getUser();
        if (!$user) {
            $this->error('token 失效', '', 422);
        }
        $pro_id = $this->request->request('pro_id');
        $pro = \app\admin\model\Product::where("id", $pro_id)->find();
        if (!$pro) {
            $this->error("项目不存在");
        }
        $ret = \app\admin\model\Proorder::where("id", $pro_id)->find();
        if (!$ret) {
            \app\admin\model\User::where("id", $user->id)->setinc("money", $pro['envelope_money']);
            \app\common\model\User::money($pro['envelope_money'], $this->auth->id, "获得红包".$pro['envelope_money']);
            $this->success("获得红包", $pro['envelope_money']);
        } else {
            $this->error("此项目已发红包");
        }
    }
    /**
    * 立即认购
    * @ApiMethod (POST)
    * @param string $money 认购金额
    * @param string $pro_id 产品id
    * @param string $token 用户凭证
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    */
    public function new_buys() {


        $user = $this->auth->getUser();
        if (!$user) {
            $this->error('token 失效', '', 422);
        }
        $pro_id = $this->request->request('pro_id');
        $money = $this->request->request('money');

        // dump($product_id);die;
        if (!$pro_id || !$money) {
            $this->error("请完善参数");
        }
        $pro = \app\admin\model\Product::where("id", $pro_id)->find();
        $is_order = \app\admin\model\Proorder::where("id", $pro_id)->where("user_id", $user->id)->count();
        if (!$pro) {
            $this->error("项目不存在");
        }
        if ($money > $pro['remaining']) {
            $this->error("剩余金额不足");
        }

        if ($pro['limit_vip']) {
            if ($this->auth->level < $pro['limit_vip']) {
                $this->error("仅VIP".$pro['limit_vip']."用户可购!");
            }
        }
        if ($pro['is_newcomer'] == 1 && $is_order) {
            $this->error("新人项目仅限购一次！");
        }

        if ($this->auth->money < $money) {
            $this->error("金额不足！");
        }
        $data = ["user_id" => $this->auth->id,
            "pro_id" => $pro_id,
            "day_income" => $pro['day_income'],
            "money" => $money,
            "delay_day" => strtotime(date("Y-m-d", strtotime('+1 day'))),
            "day_num" => $pro['product_day'],
            "end_time" => strtotime('+'.$pro['product_day'].' day'),
            "pid" => $this->auth->pid,
            "added_value" => $pro['added_value'],
            "buy_time" => time(),
            "addtime" => time()];

        $Goods = \app\admin\model\Proorder::insert($data);
        $order_id = \app\admin\model\Proorder::getLastInsID();

        db::name("user")->where("id", $this->auth->id)->setDec("money", $money);
        db::name("product")->where("id", $pro_id)->setDec("remaining", $money);
        if ($Goods) {
            \app\common\model\User::money(-$money, $this->auth->id, "购买".$pro['title']."项目".-$money, 3, $pro_id, $order_id);
            $this->success("认购成功", $Goods);
        } else {
            $this->error("认购失败");
        }
    }


    /**
    * 获取已购项目列表
    * @ApiMethod (POST)
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    */
    public function get_purchased() {
        $page = $this->request->request('page') ?? 1;
        $list = $this->request->request('list') ?? 10;
        $user = $this->auth->getUser();
        if (!$user) {
            $this->error('token 失效', '', 422);
        }
        $ret = \app\admin\model\Proorder::where("user_id", $user->id)->page($page, $list)->order('id desc')->select();
        foreach ($ret as $k => $v) {
            $pro = \app\admin\model\Product::where("id", $v['pro_id'])->find();
            $ret[$k]['title'] = $pro['title'];
            $ret[$k]['Introduction'] = $pro['Introduction'];
        }
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }


}