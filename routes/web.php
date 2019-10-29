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

Route::any('/', function () {
    dd("eee");
});

// Redirect to the Vue App
// Route::permanentRedirect ('/', '/app');
Route::permanentRedirect ('/', '/api');

// Vue App
// Route::group(['prefix' => 'app'], function () {
//     Route::any('/{any?}', 'AppController@index')->where('any', '.*');
// });

// CDN routes
Route::group(['middleware' => 'cors', 'prefix' => 'cdn'], function () {
    // Download generated video
    Route::get('/download/{createdAt}/{fileName}', 'CDNController@downloadOutputVideo')->where(['createdAt' => '[0-9]+'])->name('cdn.download');
    // Retrieve the custom template thumbnail
    // Route::get('/thumbnails/{customTemplateID}/{fileName}/{width?}/{height?}', 'CDNController@retrieveCustomTemplateThumbnail')->where(['customTemplateID' => '[0-9]+', 'width' => '[0-9]+', 'height' => '[0-9]+'])->name('cdn.thumbnail');
    // Retrieve the custom template demo video
    Route::get('/{collection}/{customTemplateID}/{fileName}', 'CDNController@retrieveCustomTemplateFiles')->where(['customTemplateID' => '[0-9]+'])->name('cdn.cutomTemplate.files');
});
