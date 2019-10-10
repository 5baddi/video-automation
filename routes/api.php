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
    // Route::get('test', 'VideoAutomationController@test');

    // Start a render job
    Route::post('/render', 'VideoAutomationController@render');
    // Get job progress
    Route::get('/status/{jobID}/{action?}', 'VideoAutomationController@status')->where(['jobID' => '[0-9]+']);
    // Notify after render job done
    Route::get('/notify/{renderID}', 'CronController@notify')->where(['renderID' => '[0-9]+'])->name('cron.notify');
});
