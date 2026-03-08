<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;
/**
* 积分商品
*/
class Goods extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];
    public function _initialize() {
        parent::_initialize();
    }
 
    
    /**
    * 获取项目列表
    * @ApiMethod (POST)
    * @param string $page 从1开始
    * @param string $list 分页长度,默认20
    */
    public function get_goods_list() {
        $page = $this->request->request('page') ?? 1;
        $list = $this->request->request('list') ?? 10;

        $ret = \app\admin\model\Goods::page($page, $list)->order('id desc')->select();
        foreach ($ret as $k => $v) {
            // $ret[$k]['schedule'] = number_format((($v['scale']-$v['remaining'])/$v['scale'])*100, 2);
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
    * @param string $pro_id 商品id
    */
    public function get_goods_details() {
        $pro_id = $this->request->request('pro_id');

        $ret = \app\admin\model\Goods::where("id", $pro_id)->find();
        // $ret['schedule'] = number_format((($ret['scale']-$ret['remaining'])/$ret['scale'])*100, 2);
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    /**
    * 立即兑换商品
    * @ApiMethod (POST)
    * @param string $money 兑换积分
    * @param string $g_id 产品id
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    */
    public function new_exchange() {


        $user = $this->auth->getUser();
        if (!$user) {
            $this->error('token 失效', '', 422);
        }
        $g_id = $this->request->request('g_id');
        $money = $this->request->request('money');

        // dump($product_id);die;
        if (!$g_id || !$money) {
            $this->error("请完善参数");
        }
        $pro = \app\admin\model\Goods::where("id", $g_id)->find();
        if (!$pro) {
            $this->error("商品不存在");
        }
        
        if ($this->auth->score < $money) {
            $this->error("积分不足！");
        }
        $data = ["user_id" => $this->auth->id,
            "g_id" => $g_id,
            "money" => $money,
            "addtime" => time()];

        $Goods = \app\admin\model\Gorder::insert($data);
        $order_id = \app\admin\model\Gorder::getLastInsID();
        if ($Goods) {
            \app\common\model\User::score(-$money, $this->auth->id, "购买".$pro['title']."商品".-$money, 6, $g_id, $order_id);
            $this->success("兑换成功", $Goods);
        } else {
            $this->error("兑换失败");
        }
    }


    
    /**
    * 我兑换的商品列表
    * @ApiMethod (POST)
    * @param string $page 从1开始
    * @ApiHeaders (name=token, type=string, required=true, description="请求的Token")
    */
    public function get_gorder_list() {
        $page = $this->request->request('page') ?? 1;
        $list = $this->request->request('list') ?? 10;
        $user = $this->auth->getUser();
        if (!$user) {
            $this->error('token 失效', '', 422);
        }
        $ret = \app\admin\model\Gorder::where("user_id",$user->id)->page($page, $list)->order('id desc')->select();
        foreach ($ret as $k => $v) {
               $pro = \app\admin\model\Goods::where("id", $v['g_id'])->find();
            $ret[$k]['title'] =$pro['title'];
             $ret[$k]['image'] =$pro['image'];
        }
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }



}