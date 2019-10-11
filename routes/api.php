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


Route::group(['middleware' => 'api', 'namespace' => 'API', 'prefix' => 'v1'], function () {
    // Retrieve all the custom templates
    Route::get('/templates', 'VideoAutomationController@index');
    // Retrieve a custom templates by ID
    Route::get('/templates/{templateID}', 'VideoAutomationController@show')->where(['templateID' => '[0-9]+']);
    // Store new custom template
    Route::post('/templates', 'VideoAutomationController@store');
    // Update an exists custom template
    Route::put('/templates', 'VideoAutomationController@update');
    // Delete a custom template
    Route::delete('/templates/{templateID}', 'VideoAutomationController@delete')->where(['templateID' => '[0-9]+']);
    // Start a render job
    Route::post('/render', 'VideoAutomationController@render');
    // Get job progress
    Route::get('/status/{renderID}/{action?}', 'VideoAutomationController@status')->where(['renderID' => '[0-9]+'])->name('job.status');
    // Notify after render job done
    Route::get('/notify/{renderID}', 'CronController@notify')->where(['renderID' => '[0-9]+'])->name('cron.notify');
    Route::post('/notify/{renderID}', 'CronController@vauNotify')->where(['renderID' => '[0-9]+'])->name('vau.notify');
});