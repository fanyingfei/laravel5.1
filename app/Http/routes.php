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

Route::get('/', 'MainController@index');

Route::get('/access', 'MainController@access');

Route::get('/events/{p?}', 'MainController@events')->where('p', '[0-9]+');
Route::get('/information/{p?}', 'MainController@information')->where('p', '[0-9]+');

Route::get('/show/{name}', 'MainController@show');

Route::get('/about/{name?}',  'MainController@about');
Route::post('/data/query','MainController@data_query');

Route::get('/floor',  'MainController@floor');
Route::get('/floor/general',  'MainController@floor_general');

Route::post('/bespeak/save', 'AdminController@save');

Route::get('/fitment/{p?}', 'MainController@fitment');
Route::get('/fitment/hs/{id}/{p?}', 'MainController@fitment_hs');
Route::get('/fitment/ts/{id}/{p?}', 'MainController@fitment_ts');
Route::get('/fitment/ts/{style}/hs/{house}/{p?}', 'MainController@fitment_filter');
Route::get('/fitment/img/{id}', 'MainController@fitment_img');

Route::get('/wall', 'MainController@retrofit');
Route::get('/part','MainController@retrofit_part');
Route::get('/page/{curr}','MainController@retrofit_page');

//后台路由
Route::get('/admin/login', ['as' => 'login', 'uses'=>'AdminController@login']);
Route::post('/admin/sign_in', 'AdminController@sign_in');

Route::group(['prefix' => 'admin','middleware' =>'myauth'], function()
{
    Route::get('/',  'AdminController@base');
    Route::get('base', 'AdminController@base');
    Route::get('fitment', 'AdminController@fitment');
    Route::get('retrofit', 'AdminController@retrofit');
    Route::get('floor', 'AdminController@floor');
    Route::get('event', 'AdminController@event');
    Route::get('bespeak', 'AdminController@bespeak');
    Route::get('access', 'AdminController@access');

    Route::get('list', 'AdminController@data_list');
    Route::get('edit', 'AdminController@edit');
    Route::post('delete', 'AdminController@delete');
    Route::post('save', 'AdminController@save');
});