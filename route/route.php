<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

Route::get('index/:login','index/login');

Route::get('select/:MYSQL','index/MYSQL');

/*
 * 6.10 查找数据
 */
include "select.php";



/*
 * 用户
 */
include "user.php";



/*
 * 周考三
 */
include "ks3.php";



/*
 * 电影评分
 */
include "movie.php";



/*
 * 抽奖
 */
include "prize.php";


/*
 * 预定座位
 */
include "seat.php";



/*
 * 数据统计
 */
include "Info.php";

/**
 * 测试Model
 */
include "Users.php";







return [

];

