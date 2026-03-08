<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
/**
 * 项目管理
 *
 * @icon fa fa-circle-o
 */
class Product extends Backend
{

    /**
     * Product模型对象
     * @var \app\admin\model\Product
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Product;
        $Proclass = db::name("proclass")->column("id,title");
        // dump($Proclass);die;
        $this->view->assign("proclass",$Proclass);

    }

    /**
     * 添加
     *
     * @return string
     * @throws \think\Exception
     */
    public function add()
    {
        if (false === $this->request->isPost()) {
            return $this->view->fetch();
        }
        $params = $this->request->post('row/a');
        if (empty($params)) {
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $params = $this->preExcludeFields($params);

        if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
            $params[$this->dataLimitField] = $this->auth->id;
        }
        
        $checkbox_field= implode(",",$params['checkbox_field']);
        $params['checkbox_field']=$checkbox_field;
        $option1 = strstr( $params['checkbox_field'], "option1");
        $option2 = strstr( $params['checkbox_field'], "option2");
        $option3 = strstr( $params['checkbox_field'], "option3");
        $option4 = strstr( $params['checkbox_field'], "option4");
        if(!$option1){
            unset($params['added_value']);
        }
        if(!$option2){
            unset($params['minimum_envelope']);
            unset($params['envelope_money']);
        }
        if(!$option3){
            unset($params['is_newcomer']);
        }
        if(!$option4){
            unset($params['limit_vip']);
        }
        
        $result = false;
        Db::startTrans();
        try {
            //是否采用模型验证
            if ($this->modelValidate) {
                $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                $this->model->validateFailException()->validate($validate);
            }
            $result = $this->model->allowField(true)->save($params);
            Db::commit();
        } catch (ValidateException|PDOException|Exception $e) {
            Db::rollback();
            $this->error($e->getMessage());
        }
        if ($result === false) {
            $this->error(__('No rows were inserted'));
        }
        $this->success();
    }

    /**
     * 编辑
     *
     * @param $ids
     * @return string
     * @throws DbException
     * @throws \think\Exception
     */
    public function edit($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds) && !in_array($row[$this->dataLimitField], $adminIds)) {
            $this->error(__('You have no permission'));
        }
        if (false === $this->request->isPost()) {
            $this->view->assign('row', $row);
            return $this->view->fetch();
        }
        $params = $this->request->post('row/a');
        if (empty($params)) {
            $this->error(__('Parameter %s can not be empty', ''));
        }

        
        $checkbox_field= implode(",",$params['checkbox_field']);
        $params['checkbox_field']=$checkbox_field;
        $option1 = strstr( $params['checkbox_field'], "option1");
        $option2 = strstr( $params['checkbox_field'], "option2");
        $option3 = strstr( $params['checkbox_field'], "option3");
        $option4 = strstr( $params['checkbox_field'], "option4");
        if(!$option1){
           $params['added_value']=0.00;
        }
        if(!$option2){
            $params['minimum_envelope']=0.00;
            $params['envelope_money']=0.00;
        }
        if(!$option3){
            $params['is_newcomer']=0;
        }
        if(!$option4){
            $params['limit_vip']=0;
        }
                // dump($params);die;
        
        $params = $this->preExcludeFields($params);
        $result = false;
        Db::startTrans();
        try {
            //是否采用模型验证
            if ($this->modelValidate) {
                $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                $row->validateFailException()->validate($validate);
            }
            $result = $row->allowField(true)->save($params);
            Db::commit();
        } catch (ValidateException|PDOException|Exception $e) {
            Db::rollback();
            $this->error($e->getMessage());
        }
        if (false === $result) {
            $this->error(__('No rows were updated'));
        }
        $this->success();
    }
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */


}
