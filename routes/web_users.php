<?php

$router->group(['middleware' => ['auth:web_users']], function ($router) {

});

//home
$router->get('/', 'homeCtrl@index');
$router->get('/home', 'homeCtrl@index');
$router->get('/getdate', 'homeCtrl@getdate');

Route::post('/login', 'authCtrl@login');
Route::get('/logout', 'authCtrl@logout');

//autocomplete
$router->get('/search-autocomplete', 'homeCtrl@autocompleteSearch');

//search
$router->get('/search-hotel', 'SearchCtrl@index');
$router->get('/search/do_tabel', 'SearchCtrl@do_Tabel');
$router->get('/search-tampil', 'SearchCtrl@indextampil');

//details
$router->get('/detail-hotel', 'DetailCtrl@index');
$router->get('/detail/do_Tabel', 'DetailCtrl@do_Tabel');

Route::get('/signup', function () {
    return view('users.signup');
});

Route::get('/login', function () {
    return view('users.login');
});