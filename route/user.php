<?php
// 用户注册
Route::get('reg','User/reg');
Route::post('reg','User/reg2');
// 用户登录
Route::get('login/login','User/login');
Route::post('login/login','User/login2');
// 个人中心
Route::get('center/center','User/center');
// 商品详情
Route::get('goods/:id','Goods/detail');
// 退出登录
Route::get('out/out','User/out');