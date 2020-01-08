<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Root routes
Route::group(['middleware' => ['api', 'cors'], 'namespace' => 'API'], function () {
    // API Root action
    Route::get('/', 'RootController@index');
});

// V1 routes
Route::group(['middleware' => ['api', 'cors'], 'namespace' => 'API', 'prefix' => 'v1'], function () {
    // Retrieve all the custom templates
    Route::get('/templates', 'VideoAutomationController@index');
    Route::get('/templates/thumbnails/{rotation?}', 'VideoAutomationController@templatesThumbnails');
    // Retrieve a custom templates by ID
    Route::get('/templates/{templateID}', 'VideoAutomationController@show')->where(['templateID' => '[0-9]+']);
    // Store new custom template
    Route::post('/templates', 'VideoAutomationController@store');
    // Update an exists custom template
    Route::put('/templates/{templateID}', 'VideoAutomationController@update')->where(['templateID' => '[0-9]+']);
    // Delete a custom template
    Route::delete('/templates/{templateID}', 'VideoAutomationController@delete')->where(['templateID' => '[0-9]+']);
    // Store a new media for a custom template
    Route::post('/templates/{templateID}/medias', 'VideoAutomationController@addMedia')->where(['templateID' => '[0-9]+']);
    // Update an exists media for a custom template
    Route::put('/templates/medias/{mediaID}', 'VideoAutomationController@updateMedia')->where(['mediaID' => '[0-9]+']);
    // Delete an exists media for a custom template
    Route::delete('/templates/medias/{mediaID}', 'VideoAutomationController@deleteMedia')->where(['mediaID' => '[0-9]+']);
});

// V2 routes
Route::group(['middleware' => ['api', 'cors'], 'namespace' => 'API', 'prefix' => 'v2'], function () {
    // Start a render job
    Route::post('/render', 'RenderController@renderV2');
    // Get list of rendered jobs
    Route::get('/render/videos', 'RenderController@index');
    // Get job progress
    Route::get('/status/{renderID}', 'RenderController@statusV2')->name('job.status');
    // Notify after render job done by user
    Route::get('/notify/{renderID}', 'CronController@notifyV2')->where(['renderID' => '[0-9]+'])->name('cron.notify');
    // Notify after render job done by VAU API callback
    // Route::post('/notify/{renderID}', 'CronController@vauNotify')->where(['renderID' => '[0-9]+'])->name('vau.notify');
});