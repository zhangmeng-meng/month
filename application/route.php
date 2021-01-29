<?php

use think\Route;

//定义路由
Route::get('index','goods/Goods/index');
//详情页接口
Route::get('detail','goods/Goods/detail');

//返回页面
Route::get('login','admin/Admin/index');
//登录
Route::post('logindo','admin/Admin/login');
//添加

