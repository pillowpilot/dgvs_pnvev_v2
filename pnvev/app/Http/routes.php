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

Route::get('/', 'HomeController@index')->name('home');

// Autentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin')->name('auth.login');
Route::post('auth/login', 'Auth\AuthController@postLogin')->name('auth.loginform');
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('auth.logout');

// Admin pages
Route::group(['middleware' => 'auth', 'prefix' => '/admin'], function () {
    Route::get('/', function() { return redirect()->route('admin.homePage');})->name('admin.index');
    
    Route::get('/user', 'Admin\AdminUserController@index')->name('admin.user');
    Route::post('/user-update-name', 'Admin\AdminUserController@storeName')->name('admin.user.storeName');
    Route::post('/user-update-email', 'Admin\AdminUserController@storeEmail')->name('admin.user.storeEmail');
    Route::post('/user-update-password', 'Admin\AdminUserController@storePassword')->name('admin.user.storePassword');

    Route::get('/tables', 'Admin\AdminTableController@index')->name('admin.table');
    Route::post('/table', 'Admin\AdminTableController@show')->name('admin.table.show');

    Route::get('/homePage', 'Admin\AdminHomeController@index')->name('admin.homePage');
    Route::post('/homePage', 'Admin\AdminHomeController@store')->name('admin.homePage.store');
});

// Public pages
Route::group(['prefix' => '/v2'], function () {
    Route::get('/{id}', 'DiseaseV2Controller@show')->name('disease.show');
});

// REST API
Route::group(['prefix' => 'api/v1'], function () {
    Route::get('/genders', 'Rest\V1\GenderController@index');
    Route::get('/genders/{id}', 'Rest\V1\GenderController@show');
    Route::get('/regions', 'Rest\V1\AdministrativeRegionController@index');
    Route::get('/regions/{id}', 'Rest\V1\AdministrativeRegionController@show');
    Route::get('/diseaseFamilies', 'Rest\V1\DiseaseFamilyController@index');
    Route::get('/diseaseFamilies/{id}', 'Rest\V1\DiseaseFamilyController@show');
    Route::get('/diseases', 'Rest\V1\DiseaseController@index');
    Route::get('/diseases/{id}/years', 'Rest\V1\DiseaseController@showWithYears');
    Route::get('/diseases/{id}/years/max', 'Rest\V1\DiseaseController@showMaxYear');
    Route::get('/diseases/{id}/years/min', 'Rest\V1\DiseaseController@showMinYear');
    Route::get('/diseases/{id}/tendencies', 'Rest\V1\TendenciesController@index');

    Route::get('/homePage', 'Admin\Rest\AdminHomePageRestController@index')->name('rest.homePage');
});
