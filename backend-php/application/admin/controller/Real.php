<?php

namespace app\admin\controller;

use think\Db;
use app\common\controller\Backend;

/**
 * 实名认证审核
 *
 * @icon fa fa-circle-o
 */
class Real extends Backend
{

    /**
     * Real模型对象
     * @var \app\admin\model\Real
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Real;
        $this->view->assign("statusList", $this->model->getStatusList());
    }



    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    
    public function adopt() {
        $post = $this->request->request();
        if (!$post['id']) {
            $this->error('参数错误');
        }
        $cashrecord = db::name("real")->where("id", $post['id'])->find();
        $users = db::name("user")->where("id", $cashrecord['user_id'])->find();

        // if ($cashrecord['status'] == 1) {
        //     $this->error("该已同意");
        // }
        // if ($cashrecord['status'] == 2) {
        //     $this->error("该已拒绝");
        // }
        
        $jines = sprintf("%.2f",$users['money'] * $users['baobl']);
        \app\common\model\User::where(["id" => $cashrecord['user_id']])->setInc("rebaojin", $jines);
        \app\common\model\User::where(["id" => $cashrecord['user_id']])->update(['isti' => 1]);
        $result = db::name("real")->where("id", $post['id'])->update(['status' => 1]);
        if ($result) {
            $this->success("操作成功");
        } else {
            $this->error("操作失败");
        }
    }
    
    public function cancel() {
        $post = $this->request->request();
        if (!$post['id']) {
            $this->error('参数错误');
        }
        $cashrecord = db::name("real")->where("id", $post['id'])->find();

        // if ($cashrecord['status'] == 1) {
        //     $this->error("该已同意");
        // }
        // if ($cashrecord['status'] == 2) {
        //     $this->error("该已拒绝");
        // }
        $result = db::name("real")->where("id", $post['id'])->update(['status' => 2]);
        if ($result) {
            $this->success("操作成功");
        } else {
            $this->error("操作失败");
        }
    }


}
