<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::rule('get/[:env]','api/set/get');
Route::rule('json','api/set/json');
Route::rule('mail','api/set/email');		// 提交email地址
Route::rule('stat','api/statistics/get');
Route::rule('putfisc','api/statistics/putFisc');
Route::rule('putfil','api/statistics/putFil');
Route::rule('info','api/statistics/info');	// 根据bep20地址查询所持有的fil、fisc等信息
Route::rule('pledgelogs','api/statistics/pledgelogs');	// 质押日志列表
Route::rule('profitlogs','api/statistics/profitlogs');	// 质押收益列表


return [
    //别名配置,别名只能是映射到控制器且访问时必须加上请求的方法
    '__alias__'   => [
    ],
    //变量规则
    '__pattern__' => [ 
    ],
//        域名绑定到模块
//        '__domain__'  => [
//            'admin' => 'admin',
//            'api'   => 'api',
//        ],

];
