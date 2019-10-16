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


Route::group(['middleware' => ['api', 'cors'], 'namespace' => 'API', 'prefix' => 'v1'], function () {
    // Retrieve all the custom templates
    Route::get('/templates', 'VideoAutomationController@index');
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
    // Start a render job
    Route::post('/render', 'VideoAutomationController@render');
    // Get job progress
    // Route::get('/status/{renderID}/{action?}', 'VideoAutomationController@status')->where(['renderID' => '[0-9]+'])->name('job.status');
    Route::get('/status/{renderID}', 'VideoAutomationController@status')->name('job.status');
    Route::get('/download/{createdAt}/{fileName}', 'VideoAutomationController@download')->where(['createdAt' => '[0-9]+'])->name('va.download');
    // Notify after render job done
    Route::get('/notify/{renderID}', 'CronController@notify')->where(['renderID' => '[0-9]+'])->name('cron.notify');
    Route::post('/notify/{renderID}', 'CronController@vauNotify')->where(['renderID' => '[0-9]+'])->name('vau.notify');
});