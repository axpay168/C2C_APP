<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;
/**
* 资讯
*/
class Index extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];
    public function _initialize() {
        parent::_initialize();
    }
    /**
    * 首页
    *
    */
    public function index() {
        $this->success('请求成功');
    }


  /**
    * 获取发现页面-关于我们
    * @ApiMethod (POST)
    *
    */
    public function get_about() {
        // $ret["carousel"]=\app\common\model\Config::where("name",'bclb')->value("value"); 
 
        $ban = \app\common\model\Config::where(["name" => "bclb"])->value("value");
        $ban = explode(",", $ban);
        foreach ($ban as $k => $v) {
            $ret[] = "http://".$_SERVER['SERVER_NAME'].$v;
        }
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    
    public function downurl() {
        $ret = \app\common\model\Config::where(["name" => "iosurl"])->value("value");
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    
    public function getkf() {
        $ret['kefu'] = \app\common\model\Config::where(["name" => "chat"])->value("value");
        $ret['telegram'] = \app\common\model\Config::where(["name" => "telegram"])->value("value");
        $ret['zalo'] = \app\common\model\Config::where(["name" => "zalo"])->value("value");
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    
    public function shoujia() {
        $ret['shoujia'] = \app\common\model\Config::where(["name" => "shoujia"])->value("value");
        $ret['zuiyou'] = \app\common\model\Config::where(["name" => "zuiyou"])->value("value");
        $ret['licai'] = \app\common\model\Config::where(["name" => "licai"])->value("value");
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }

    /**
    * 获取发现页面-常见问题
    * @ApiMethod (POST)
    *
    */
    public function get_problem() {

        $ret = \app\admin\model\Problem::select();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }

    /**
    * 获取发现页面-公告
    * @ApiMethod (POST)
    *
    */
    public function get_placard() {

        $ret = \app\admin\model\Placard::select();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    /**
    * 获取发现页面-公告详情
    * @param string  $id   公告id
    * @ApiMethod (POST)
    *
    */
    public function pla_detail() {
        $id = $this->request->post('id');
        if (!$id) {
            $this->error("请完善参数");
        }
        $ret = \app\admin\model\Placard::where("id", $id)->find();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    
    
     /**
    * 协议数据
    * @param string  $id   1用户协议2隐私协议
    * @ApiMethod (POST)
    *
    */
    public function agree_detail() {
        $id = $this->request->post('id');
        if (!$id) {
            $this->error("请完善参数");
        }
        $ret = \app\admin\model\Agree::where("id", $id)->find();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    
    
    
    
    /**
    * 获取首页系统消息
    * @ApiMethod (POST)
    *
    */
    public function get_news() {
       $user = $this->auth->getUser();
            if (!$user) {
                $this->error('token 失效', '', 422);
            }
            // dump($user->id);die;
        $ret = \app\admin\model\News::where("user_id",$user->id)->whereOr("user_id",0)->select();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }



    
    
    /**
    * 获取发现页面-资讯列表
    * @ApiMethod (POST)
    *
    */
    public function get_Information() {
        $lang = $this->request->request('lang');
        $ret = \app\admin\model\Announcement::where('lang',$lang)->select();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    
    //平台介绍
    public function jieshao_detail() {
        $lang = $this->request->post('lang');
        if($lang == 'zh'){
            $id = 7;
        }else if($lang == 'hk'){
            $id = 1;
        }else if($lang == 'en'){
            $id = 5;
        }else if($lang == 'th'){
            $id = 8;
        }else{
            $id = 6;
        }
        $ret = \app\admin\model\Announcement::where("id", $id)->find();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    /**
    * 获取发现页面-资讯详情
    * @param string  $id   资讯id
    * @ApiMethod (POST)
    *
    */
    public function Information_detail() {
        $id = $this->request->post('id');
        if (!$id) {
            $this->error("请完善参数");
        }
        $ret = \app\admin\model\Announcement::where("id", $id)->find();
        if ($ret) {
            $this->success("获取成功", $ret);
        } else {
            $this->error("暂无数据");
        }
    }
    
    
    
    



}