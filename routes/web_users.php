<?php

$router->group(['middleware' => ['auth:web_users']], function ($router) {

});

$router->get('/', 'homeCtrl@index');


Route::post('/login', 'authCtrl@login');
Route::get('/logout', 'authCtrl@logout');

Route::get('/signup', function () {
    return view('users.signup');
});

Route::get('/login', function () {
    return view('users.login');
});