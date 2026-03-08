<?php

namespace app\admin\controller;

use app\common\controller\Backend;

/**
 * 充值管理
 *
 * @icon fa fa-circle-o
 */
class Chongci extends Backend
{

    /**
     * Chongci模型对象
     * @var \app\admin\model\Chongci
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Chongci;

    }



    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */


    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $list = $this->model
                    ->with(['user'])
                    ->where($where)
                    ->order($sort, $order)
                    ->paginate($limit);

            foreach ($list as $row) {
                
                $row->getRelation('user')->visible(['username','nickname','avatar']);
            }

            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }
    
    public function adopt() {
        $post = $this->request->request();
        if (!$post['id']) {
            $this->error('参数错误');
        }
        $cashrecord = db::name("recharge")->where("id", $post['id'])->find();
        $users = db::name("user")->where("id", $cashrecord['user_id'])->find();

        // dump($cashrecord);die;
        if ($cashrecord['stat'] == 1) {
            $this->error("该充值已同意");
        }
        if ($cashrecord['stat'] == 2) {
            $this->error("该充值已拒绝");
        }

        db::name("user")->where("id", $cashrecord['user_id'])->setInc("money", $cashrecord['money']);
        \app\common\model\User::money($cashrecord['money'], $this->auth->id, "充值到账".$cashrecord['money'],6);
        $result = db::name("recharge")->where("id", $post['id'])->update(['stat' => 1, 'remark' => "充值已到账", "uptime" => time()]);
        if ($result) {
            $this->success("操作成功");
        } else {
            $this->error("操作失败");
        }

    }


    public function cancel() {
        $post = $this->request->request();
        // dump($post);die;
        if (!$post['uid']) {
            $this->error('参数错误');
        }
        $cashrecord = db::name("recharge")->where("id", $post['uid'])->find();
        $user = db::name("user")->where("id", $cashrecord['user_id'])->find();
        if (!$user) {
            $this->error('暂无用户信息');
        }
        Db::startTrans();
        try {
            $result = db::name("recharge")->where("id", $post['uid'])->update(['stat' => 2, 'remark' => $post['remark'], "uptime" => time()]);
            Db::commit();
        } catch (\Exception $e) {
            // dump($e->getMessage());die;
            $this->error('数据错误' & $e->getMessage());
            // 回滚事务
            Db::rollback();
        }
        $this->success("拒绝成功");
    }

}
