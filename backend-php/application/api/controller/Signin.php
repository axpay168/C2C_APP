<?php
namespace app\api\controller;

use app\common\controller\Api;
use fast\Date;
use think\Db;
use think\Exception;
use think\exception\PDOException;

/**
 * 签到接口
 */
class Signin extends Api
{
    protected $noNeedLogin = [];
    protected $noNeedRight = ['*'];
    
   
	/**
	 * 获取签到数据
	 *
	 * @ApiSummary  ( 获取签到)
	 * @ApiMethod   (GET)
	 * 
	 * @param string $date 日期 例子：2023-03-14
	 */
	public function getSignin()
	{
	    $config = get_addon_config('signin');
		if(!$config){
			$this->error('签到不存在！');
		}
		
		
	
	    $signdata = $config['signinscore'];
	    $date = $this->request->request('date', date("Y-m-d"), "trim");
	    $time = strtotime($date);
	    $lastdata = \addons\signin\model\Signin::where('user_id', $this->auth->id)->order('createtime', 'desc')->find();
	    $successions = $lastdata && $lastdata['createtime'] > Date::unixtime('day', -1) ? $lastdata['successions'] : 0;
	    $signin = \addons\signin\model\Signin::where('user_id', $this->auth->id)->whereTime('createtime', 'today')->find();
	    $list = \addons\signin\model\Signin::where('user_id', $this->auth->id)
	        ->field('id,createtime')
	        ->whereTime('createtime', 'between', [date("Y-m-1", $time), date("Y-m-1", strtotime("+1 month", $time))])
	        ->select();
	        
	        foreach ($list as $k=> $v) {
	           // $list[$k]['createtime']=date("yyyy-MM-dd",$v['createtime'] );
	        }
			
		// 用户余额
		$data['user_score'] = $this->auth->money;
		// 已签到日期
		$data['list'] = $list;
		// 今日
		$data['date'] = $date;
		// 你当前已经连续签到
		$data['successions'] = $successions; 
	    $successions++;
	    $money = isset($signdata['s' . $successions]) ? $signdata['s' . $successions] : $signdata['sn'];
		// 是否签到
		$data['signin'] = $signin;
		// 可获余额
		$data['score'] = $money;
		
		
		// 连续第几天
		$data['signinscore'] = $config['signinscore'];
		
		
				$data['signinscores'] =[ ["id"=>1,"type"=>0,"species"=>10], ["id"=>2,"type"=>0,"species"=>10], ["id"=>3,"type"=>0,"species"=>10], ["id"=>4,"type"=>0,"species"=>10], ["id"=>5,"type"=>0,"species"=>10], ["id"=>6,"type"=>0,"species"=>10], ["id"=>7,"type"=>1,"species"=>10]];
		$this->success('OK', $data);
	}
	
	
	/**
	 * 立即签到
	 *
	 * @ApiSummary  ( 获取签到)
	 * @ApiMethod   (POST)
	 * 
	 */
	public function dosign()
	{
	    if ($this->request->isPost()) {
	        $config = get_addon_config('signin');
	        $signdata = $config['signinscore'];
	
	        $lastdata = \addons\signin\model\Signin::where('user_id', $this->auth->id)->order('createtime', 'desc')->find();
	        $successions = $lastdata && $lastdata['createtime'] > Date::unixtime('day', -1) ? $lastdata['successions'] : 0;
	        $signin = \addons\signin\model\Signin::where('user_id', $this->auth->id)->whereTime('createtime', 'today')->find();
	        if ($signin) {
	            $this->error('今天已签到,请明天再来!');
	        } else {
	            $successions++;
	            $money = isset($signdata['s' . $successions]) ? $signdata['s' . $successions] : $signdata['sn'];
	            Db::startTrans();
	            try {
	                \addons\signin\model\Signin::create(['user_id' => $this->auth->id, 'successions' => $successions, 'createtime' => time()]);
	                \app\common\model\User::money($money, $this->auth->id, "连续签到{$successions}天");
	                Db::commit();
	            } catch (Exception $e) {
	                Db::rollback();
	                $this->error('签到失败,请稍后重试');
	            }
	            
	            $this->success('OK','获得' . $money . '元');
	               //$this->success('OK','签到成功!连续签到' . $successions . '天!获得' . $money . '元');
	        }
	    }
	    $this->error("请求错误");
	}
	

	
}
