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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

// Autentication routes
Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'auth.loginform', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

// Admin pages
Route::group(['middleware' => 'auth', 'prefix' => '/admin'], function () {
    Route::get('/', ['as' => 'admin.index', function() { return redirect()->route('admin.homePage');}]);
    
    Route::get('/user', ['as' => 'admin.user', 'uses' => 'Admin\AdminUserController@index']);
    Route::post('/user-update-name', ['as' => 'admin.user.storeName', 'uses' => 'Admin\AdminUserController@storeName']);
    Route::post('/user-update-email', ['as' => 'admin.user.storeEmail', 'uses' => 'Admin\AdminUserController@storeEmail']);
    Route::post('/user-update-password', ['as' => 'admin.user.storePassword', 'uses' => 'Admin\AdminUserController@storePassword']);

    Route::get('/epiweek', ['as' => 'admin.epiweek', 'uses' => 'Admin\AdminEpiweekController@index']);
    Route::post('/epiweek-update-data', ['as' => 'admin.epiweek.store', 'uses' => 'Admin\AdminEpiweekController@store']);

    Route::get('/maps', ['as' => 'admin.maps', 'uses' => 'Admin\AdminMapsController@index']);
    Route::post('/maps-update-district-map', ['as' => 'admin.maps.storeDistrict', 'uses' => 'Admin\AdminMapsController@storeDistrictMap']);
    Route::post('/maps-update-region-map', ['as' => 'admin.maps.storeRegion', 'uses' => 'Admin\AdminMapsController@storeRegionMap']);

    Route::get('/homePage', ['as' => 'admin.homePage', 'uses' => 'Admin\AdminHomeController@index']);
    Route::post('/homePage', ['as' => 'admin.homePage.store', 'uses' => 'Admin\AdminHomeController@store']);
});

// Public pages
Route::group(['prefix' => '/v2'], function () {
    Route::get('/{id}', ['as' => 'disease.show', 'uses' => 'DiseaseV2Controller@show']);
});

// REST API
Route::group(['prefix' => 'api/v1'], function () {
    Route::get('/genders', ['uses' => 'Rest\V1\GenderController@index']);
    Route::get('/genders/{id}', ['uses' => 'Rest\V1\GenderController@show']);
    Route::get('/regions', ['uses' => 'Rest\V1\AdministrativeRegionController@index']);
    Route::get('/regions/{id}', ['uses' => 'Rest\V1\AdministrativeRegionController@show']);
    Route::get('/diseaseFamilies', ['uses' => 'Rest\V1\DiseaseFamilyController@index']);
    Route::get('/diseaseFamilies/{id}', ['uses' => 'Rest\V1\DiseaseFamilyController@show']);
    Route::get('/diseases', ['uses' => 'Rest\V1\DiseaseController@index']);
    Route::get('/diseases/{id}/years', ['uses' => 'Rest\V1\DiseaseController@showWithYears']);
    Route::get('/diseases/{id}/years/max', ['uses' => 'Rest\V1\DiseaseController@showMaxYear']);
    Route::get('/diseases/{id}/years/min', ['uses' => 'Rest\V1\DiseaseController@showMinYear']);
    Route::get('/diseases/{id}/tendencies', ['uses' => 'Rest\V1\TendenciesController@index']);
    Route::get('/diseases/{id}/map', ['uses' => 'Rest\V1\ChoroplethMapRestController@show']);

    Route::get('/districtMap', ['uses' => 'Rest\V1\ChoroplethMapRestController@showDistrictMap']);
    Route::get('/regionMap', ['uses' => 'Rest\V1\ChoroplethMapRestController@showRegionMap']);

    Route::get('/homePage', ['as' => 'rest.homePage', 'uses' => 'Admin\Rest\AdminHomePageRestController@index']);
    Route::get('/epiweek', ['uses' => 'Admin\Rest\AdminEpiweekRestController@index']);
    Route::get('/epiweek/{id}', ['uses' => 'Admin\Rest\AdminEpiweekRestController@show']);
});
