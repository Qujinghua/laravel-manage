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

Route::get('/config', function () {
    return view('welcome');
});

Route::get('/config/test', function () {
    return 'test';
});

Route::any('/config/userLogin', 'UserController@userLogin');
Route::any('/config/testDB', 'UserController@testDB');
Route::get('/config/islogin', 'UserController@islogin');

Route::group(['middleware' => ['checklogin','web']], function () {
    Route::any('/config/getDepartment', 'DepartmentController@getDepartment');
    Route::any('/config/updateDepartment', 'DepartmentController@updateDepartment');
    Route::any('/config/delDepartment', 'DepartmentController@delDepartment');
    Route::any('/config/getUser', 'UserController@getUser');
    Route::any('/config/updateUser', 'UserController@updateUser');
    Route::any('/config/delUser', 'UserController@delUser');
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