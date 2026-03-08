<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;
use think\Validate;
use think\App;
use think\Request;
use think\Lang;
use think\Session;
use think\Cache;
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
    
    protected static $langPack;

    public function getLangPack()
    {
        $lang = Request::param('lang', 'en-us'); // 从请求参数中获取语言，默认为英语

        if (!isset(self::$langPack[$lang])) {
            // 尝试从缓存中获取语言包
            $cacheKey = 'langPack:' . $lang;
            $langPack = Cache::get($cacheKey);
            if (!$langPack) {
                Lang::range($lang); // 设置当前语言
                Lang::load(APP_PATH . 'api/lang' . DIRECTORY_SEPARATOR . $lang . '.php');
                $langPack = Lang::get();

                // 将语言包存储到缓存中，设置过期时间（例如，60秒）
                Cache::set($cacheKey, $langPack, 60);
            }

            self::$langPack[$lang] = $langPack;
        }

        // 返回语言包
        return json(self::$langPack[$lang], 200);
    }
    
    
    /**
    * 首页
    *
    */
    public function index() {
            //   $lang = Session::get('lang', 'en-us'); // 从会话中获取语言，默认为英语
    $lang ="ko-kr";
    // 尝试从缓存中获取语言包
    $langPack = Cache::store('redis')->get('langPack:' . $lang);
    if (!$langPack) {
        // 从语言包文件中加载语言包
        Lang::range($lang);
        Lang::load(APP_PATH . 'api/lang' . DIRECTORY_SEPARATOR . $lang . '.php');
        $langPack = Lang::get();

        // 将语言包存储到缓存中
        Cache::store('redis')->set('langPack:' . $lang, $langPack);
    }
    }





}