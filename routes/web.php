<?php

Route::get('/', function () {
    return view('gasolina');
});

// Endpoint que busca la direccion de las gasolineras x Estado y Mnpio
Route::get( 'precios/api',	['as' => 'precios.api', 'uses' => 'GasolController@api'] );

// Ruta de ayuda para desplegar los municipios x Estado en el input select
Route::get( 'municipios/get',	['as' => 'municipios.get', 'uses' => 'MunicipioController@get'] );
