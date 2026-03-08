<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;

/**
 * 示例接口
 */
class Demo extends Api
{

    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['test', 'test1'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['test2'];

    /**
     * 测试方法
     *
     * @ApiTitle    (测试名称)
     * @ApiSummary  (测试描述信息)
     * @ApiMethod   (POST)
     * @ApiRoute    (/api/demo/test/id/{id}/name/{name})
     * @ApiHeaders  (name=token, type=string, required=true, description="请求的Token")
     * @ApiParams   (name="id", type="integer", required=true, description="会员ID")
     * @ApiParams   (name="name", type="string", required=true, description="用户名")
     * @ApiParams   (name="data", type="object", sample="{'user_id':'int','user_name':'string','profile':{'email':'string','age':'integer'}}", description="扩展数据")
     * @ApiReturnParams   (name="code", type="integer", required=true, sample="0")
     * @ApiReturnParams   (name="msg", type="string", required=true, sample="返回成功")
     * @ApiReturnParams   (name="data", type="object", sample="{'user_id':'int','user_name':'string','profile':{'email':'string','age':'integer'}}", description="扩展数据返回")
     * @ApiReturn   ({
         'code':'1',
         'msg':'返回成功'
        })
     */
    public function test()
    {
        header('content-type:text/html;charset=utf8');

        $apiKey = "ILi9LNEQ";
        $apiSecret = "ErUhSpbm";
        $appId = "ym6Z0g5k";
        
        $url = "https://api.onbuka.com/v3/sendSms";
        
        $timeStamp = time();
        $sign = md5($apiKey.$apiSecret.$timeStamp);
        
        $dataArr['appId'] = $appId;
        $dataArr['numbers'] = '91856321412';
        $dataArr['content'] = 'hello world';
        $dataArr['senderId'] = '';
        
        
        $data = json_encode($dataArr);
        $headers = array('Content-Type:application/json;charset=UTF-8',"Sign:$sign","Timestamp:$timeStamp","Api-Key:$apiKey");
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 600);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS , $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        
        $output = curl_exec($ch);
        curl_close($ch);
        
        // var_dump($output);
        $this->success('返回成功', $output);
    }

    /**
     * 无需登录的接口
     *
     */
    public function test1()
    {
        $licai = db::name("userfina")->where('status',1)->select();
        foreach ($licai as $key => $value) {
            $mobs = db::name("fina")->where('id',$value['fid'])->find();
            //买入当天时间戳
            $date_str = date('Y-m-d', $value['addtime']);
            $date_start = strtotime($date_str . ' 00:00:00');
            //结束日期时间戳
            $endtime = $value['addtime'] + $value['days']*86400;
            $datend_str = date('Y-m-d', $endtime);
            $datend_start = strtotime($datend_str . ' 23:59:59');
            if(time() < $datend_start){
                $totlejiang = ($value['moneys'] * $mobs['fenbi']) + $mobs['jiangjin'];
                $formatted_num = number_format($totlejiang, 2);
                \app\common\model\User::where(["id" => $value['uid']])->setInc("moneys", $formatted_num);
                db::name("userfina")->where('id',$value['id'])->setInc("shouyi", $formatted_num);
            }else{
                $datta['status'] = 0;
                db::name("userfina")->where('id',$value['id'])->update($datta);
                \app\common\model\User::where(["id" => $value['uid']])->setInc("moneys", $value['moneys']);
            }
        }
        $this->success('返回成功', ['action' => 'test1']);
    }

    /**
     * 需要登录的接口
     *
     */
    public function test2()
    {
        $this->success('返回成功', ['action' => 'test2']);
    }

    /**
     * 需要登录且需要验证有相应组的权限
     *
     */
    public function test3()
    {
        $this->success('返回成功', ['action' => 'test3']);
    }

}
