<?php

$router->group(['middleware' => ['auth:web_admin']], function ($router) {
	Route::get('/', 'homeCtrl@index');
});

$router->get('/login', 'authCtrl@index');
$router->post('/login', 'authCtrl@login');
$router->get('/logout', 'authCtrl@logout');