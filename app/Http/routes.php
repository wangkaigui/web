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

Route::get('/', function () {
    return view('welcome');
});

/*
Route::prefix('home')->namespace('Home')->group(function(){
	
	Route::prefix('test')->group(function(){
		Route::get('index','TestController@index');
		Route::get('test','TestController@test');
	});

	Route::prefix('article')->group(function(){
		Route::get('index','ArticleController@index');
		Route::get('test','ArticleController@test');
	});

})
*/

Route::group(['namespace' => 'Home'], function(){

	Route::group(['prefix' => 'test'], function () {
		
		
		Route::get('index', 'TestController@index');
		
		Route::get('test', 'TestController@test');
		
		Route::get('test1', 'TestController@test1');
		
		Route::get('test2', 'TestController@test2');
		
		Route::get('test3', 'TestController@test3');
		
		Route::get('test4', 'TestController@test4');
		
		Route::get('test5', 'TestController@test5');
		
		Route::get('test_model', 'TestController@test_model');
		
		Route::get('test_eloquent', 'TestController@test_eloquent');
		
		Route::get('test_eloquent1', 'TestController@test_eloquent1');
		
		Route::get('test_eloquent2', 'TestController@test_eloquent2');
		
		Route::get('post', 'TestController@test1');
		
		Route::get('viewtest', 'TestController@viewtest');

		Route::get('tests/{id}/{name}', 'TestController@tests')->where('id', '[0-9]+');
		
		Route::get('edit/{id}/{name}', 'TestController@edit');
	});
	
});


/*
Route::prefix('home')->group(function () {
    Route::get('index', 'ArticleController@index');
    Route::get('create', 'ArticleController@create');
    Route::post('store', 'ArticleController@store');
});
*/


