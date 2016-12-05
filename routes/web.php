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

$router->group(['middleware' => ['web']], function ($router) {
    
    $router->group(['prefix' => '/', 'namespace' => 'Users'], function ($router) {
        require dirname(__FILE__).'/web_users.php';
    });

    $router->group(['prefix' => 'admin', 'namespace' => 'Admin'], function ($router) {
        require dirname(__FILE__).'/web_admin.php';
    });

    $router->group(['prefix' => 'tjvendor', 'namespace' => 'Vendor'], function ($router) {
        require dirname(__FILE__).'/web_vendor.php';
    });

});