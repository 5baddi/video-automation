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

// Redirect to the Vue App
Route::permanentRedirect ('/', '/app');

// Vue App
Route::group(['prefix' => 'app'], function () {
    Route::get('/welcome',  'ApplicationController@welcome');
    Route::post('/getDealerByID',  'ApplicationController@getDealerByID');
    Route::post('/saveForm',  'ApplicationController@saveForm');
    Route::post('/uploadlogo',  'ApplicationController@uploadlogo');

    Route::any('/{any?}', 'AppController@index')->where('any', '.*');
});
