<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/chart', function () {
    return view('charts');
});


/**
 * Rotas de autenticação
 */
Auth::routes();


/**
 * Rotas de admin
 */
Route::prefix('admin')->middleware('auth')->group( function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('person' , 'PersonController');
    Route::resource('address', 'AddressController');
    Route::resource('hospital', 'HospitalController');

    Route::get('attendance/{person}/create' , 'AttendanceController@create')->name('attendance.create');
    Route::post('attendance/' , 'AttendanceController@store')->name('attendance.store');

    Route::get('historic/{person}' , 'AttendanceController@index')->name('historic');

    Route::post('address/state/store', 'CreatePlacesController@storeState' )->name('state.store');
    Route::post('address/city/store', 'CreatePlacesController@storeCity' )->name('city.store');
    Route::post('address/district/store', 'CreatePlacesController@storeDistrict' )->name('district.store');

    Route::get('question', 'QuizController@create')->name('question');

    Route::post('symptom/store', 'SymptomController@store')->name('symptom.store');
    Route::post('disease/store', 'DiseaseController@store')->name('disease.store');

    Route::post('company/store', 'CompanyController@store')->name('company.store');

    Route::get('collection/create', 'CollectionLocationController@create')->name('collection.create');
    Route::post('collection/store', 'CollectionLocationController@store')->name('collection.store');

    Route::post('profession/store' , 'ProfessionController@store')->name('profession.store');

    //Route::resource('district', 'DistrictController');
    Route::resource('csv', 'CsvController');



});

/**
 * Rotas de api
 */
Route::prefix('api')->group( function() {
    Route::get('map/full' , 'ApiMapController@index');
    Route::get('map/{district_id}', 'ApiMapController@getDistrict' );

    Route::get('state/{state_id}', 'ApiMapController@getCityByState' )->name('state.get');
    Route::get('city/{city_id}', 'ApiMapController@getDistrictsByCity' )->name('city.get');

    Route::get('collection', 'ApiMapController@getCollection');


});
