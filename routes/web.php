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

Route::get('/test', function () {
    return 'test';
});

Route::any('/userLogin', 'UserController@userLogin');
Route::any('/testDB', 'UserController@testDB');
Route::get('/islogin', 'UserController@islogin');

Route::group(['middleware' => ['checklogin','web']], function () {
    Route::any('/getUser', 'UserController@getUser');
    Route::any('/getDepartment', 'DepartmentController@getDepartment');
    Route::any('/updateDepartment', 'DepartmentController@updateDepartment');
    Route::any('/delDepartment', 'DepartmentController@delDepartment');
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