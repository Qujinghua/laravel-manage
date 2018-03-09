<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/config/test', function () {
    return 'test';
});

Route::any('/config/userLogin', 'UserController@userLogin');
Route::any('/config/testDB', 'UserController@testDB');
Route::get('/config/islogin', 'UserController@islogin');

Route::group(['middleware' => ['checklogin','web']], function () {
    Route::any('/config/getDepartment', 'DepartmentController@getDepartment'); //获取部门
    Route::any('/config/updateDepartment', 'DepartmentController@updateDepartment'); //新增或修改部门
    Route::any('/config/delDepartment', 'DepartmentController@delDepartment'); // 删除部门
    Route::any('/config/getUser', 'UserController@getUser');  // 获取用户
    Route::any('/config/updateUser', 'UserController@updateUser'); //新增或修改用户
    Route::any('/config/delUser', 'UserController@delUser'); //删除用户
    Route::any('/config/getCustomer', 'CustomerController@getCustomer'); //获取客户
    Route::any('/config/updateCustomer', 'CustomerController@updateCustomer'); //新增或修改客户
    Route::any('/config/delCustomer', 'CustomerController@delCustomer'); //删除客户
    Route::any('/config/personalInfo', 'UserController@personalInfo');  // 用户自定义编辑个人信息（获取）
    Route::any('/config/updatePersonalInfo', 'UserController@updatePersonalInfo');  // 用户自定义编辑个人信息（修改）
    Route::any('/config/getBigC', 'ExhibitionMenuController@getBigC');  // 获取大类
    Route::any('/config/updateMenu', 'ExhibitionMenuController@updateMenu');  // 编辑（大类、小类等）信息
    Route::any('/config/delMenu', 'ExhibitionMenuController@delMenu');  // 删除（大类、小类等）信息
    Route::any('/config/test2', 'UserController@test2');
});

// Route::any('userLogin', ['uses' => 'UserController@userLogin']);


// Dingo api弃用
// $api = app('Dingo\Api\Routing\Router');
// $api->version('v1', function ($api) {
//     $api->group(['namespace' => 'App\Http\Controllers\Api'], function ($api) {
//         $api->get('getUser', 'UserController@getUser');
//         $api->any('userLogin', 'UserController@userLogin');
//         $api->any('testDB', 'UserController@testDB');
//     });

// });