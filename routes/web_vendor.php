<?php

$router->group(['middleware' => ['auth:web_vendor']], function ($router) {
    Route::get('/', 'homeCtrl@index');

    //hotel
    $router->get('/home', 'homeCtrl@index');
    $router->get('/list-hotel', 'HotelCtrl@index');
    $router->post('/do-simpan', 'HotelCtrl@do_Simpan');
    $router->get('/deletephoto/{id}', 'HotelCtrl@deletePhotos');
    $router->get('/photo/{id}', 'HotelCtrl@getPhotos');


    //room
	$router->get('/room/list-room', 'roomCtrl@index');
    $router->get('/room/do_Tabel', 'roomCtrl@do_Tabel');
    $router->get('/room/allotmentdo_Tabel', 'roomCtrl@allotmentdo_Tabel');
    $router->get('/room/allotmentdailydo_Tabel', 'roomCtrl@allotmentdailydo_Tabel');
    $router->post('/room/newallotment/', 'roomCtrl@postAllotment');
    $router->post('/room/newallotmentdaily/', 'roomCtrl@postAllotmentDaily');
    $router->get('/room/editallotment/{id_allotment}', 'roomCtrl@editAllotment');
    $router->get('/room/editallotmentdaily/{id_allotment}', 'roomCtrl@editAllotmentDaily');
    $router->get('/room/deleteallotment/{id_allotment}', 'roomCtrl@deleteAllotment');
    $router->get('/room/getdate/{id_allotment}', 'roomCtrl@getdate');

    //stopsell
    $router->get('/room/getdatestopsell/{id_room}', 'roomCtrl@getdatestopsell');
    $router->get('/room/getdatestopsellallroom', 'stopSellCtrl@getDateStopSellAllRoom');
    $router->get('/room/stopselldo_Tabel', 'stopSellCtrl@do_Tabel');
    $router->post('/room/newstopsale/', 'stopSellCtrl@postStopSale');
    $router->get('/room/deletestopsale/{id}', 'stopSellCtrl@deleteStopSale');
    $router->get('/room/cancelstopsale', 'stopSellCtrl@cancelStopSale');
    $router->get('/room/stopsale', 'roomCtrl@stopsale');

});

$router->get('/login', 'authCtrl@index');
$router->post('/login', 'authCtrl@login');
$router->get('/logout', 'authCtrl@logout');