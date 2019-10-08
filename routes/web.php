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

/*Route::get('/facebook', function(){

$fb = new \Facebook\Facebook([
    'app_id' => 130131932333682,
    'app_secret' => '471c5ea52c7c0d23063ed470aab00648',
    'default_graph_version' => 'v3.3',
    'default_access_token' =>'EAASfiwQBwHYBAOWizfR6E4lO4C5OsGdWQboxgAYe6QCF2dOZCIiiB6H9FOR3xg4ZBvTBCUSzgTU36QsthTrdyZCRVwDZCh1R82lZCyLUzwnX8dWxnHyyA04TGYulQZB0xA1jxnqBUIEX2iPou1ZBbZBiyuGzaJwyUJUXpP8ZCEWJ63Kq2cSgD4opg'
]);

try {
	$response = $fb->post("/127915908088501/client_pages", ['page_id' => "1534536546837785", 'permitted_tasks' => "['CREATE_CONTENT', 'MODERATE', 'ADVERTISE', 'ANALYZE']"]);
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$graphNode = $response->getGraphNode();

dd($graphNode);

});*/

// Route::get('/', 'ApplicationController')->where('any', '.*');

Route::get('/welcome',  'ApplicationController@welcome');
Route::post('/getDealerByID',  'ApplicationController@getDealerByID');
Route::post('/saveForm',  'ApplicationController@saveForm');
Route::post('/uploadlogo',  'ApplicationController@uploadlogo');

Route::any('/{any}', 'AppController@index')->where('any', '.*');
