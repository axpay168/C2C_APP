<?php

namespace app\admin\model;

use think\Model;


class Withdrawal extends Model
{

    

    

    // 表名
    protected $name = 'withdrawal';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'stat_text',
        'addtime_text',
        'uptime_text'
    ];
    

    
    public function getStatList()
    {
        return ['0' => __('Stat 0'), '1' => __('Stat 1'), '2' => __('Stat 2')];
    }


    public function getStatTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['stat']) ? $data['stat'] : '');
        $list = $this->getStatList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getAddtimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['addtime']) ? $data['addtime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getUptimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['uptime']) ? $data['uptime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setAddtimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setUptimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


    public function bank()
    {
        return $this->belongsTo('Bank', 'bank_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
