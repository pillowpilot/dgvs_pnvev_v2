<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::group(['prefix' => '/disease'], function () {
    
    Route::group(['prefix' => '/leishmaniasis'], function () {
        Route::get('/{subDiseaseParam}', 'LeishmaniasisController@index')->where('subDiseaseParam', 'mucosa|cutanea|visceral');
    });
    
    Route::group(['prefix' => '/chagas'], function () {
        Route::get('/{subDiseaseParam}', 'ChagasController@index')->where('subDiseaseParam', 'agudo|cronico|congenito');
    });

    Route::get('/{diseaseParam}', 'DiseaseController@index');
});

Route::group(['prefix' => 'api/v1'], function () {
    Route::get('/values/{filterName}', 'Rest\V1\FilterPossibleValuesController@index')->where('filterName', 'GrupoEtareo|Sexo|Year');
    Route::get('tendencies', 'Rest\V1\TendenciesController@index');
    Route::get('horizontalBars', 'Rest\V1\HorizontalBarsController@index');
});
