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

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {

    $api->get('test2', function () {
        return 'It is ok';
    });

});