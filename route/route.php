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

Route::get('/', 'index/Index/index');
Route::get('/login', 'index/Index/login');
Route::post('/doLogin', 'index/Index/doLogin');
Route::get('/register', 'index/Index/register');
Route::post('/doRegister', 'index/Index/doRegister');
Route::get('/logout', 'index/Index/logout');
Route::get('/userEdit/:id', 'index/Index/userEdit');
Route::post('/userUpdate/:id', 'index/Index/userUpdate');
Route::get('/userDel/:id', 'index/Index/userDel');

return [

];
