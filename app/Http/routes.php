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

Route::get('/faq', 'MainController@faq');


Route::get('/events/{p?}', 'MainController@events_ev')->where('p', '[0-9]+');
Route::get('/information/{p?}', 'MainController@events_in')->where('p', '[0-9]+');

Route::get('/show/{id}', 'MainController@show');

Route::get('/about',  'MainController@about');
Route::post('/quality/query','MainController@quality_query');

Route::get('/floor',  'MainController@floor');
Route::get('/floor/general',  'MainController@floor_general');

Route::post('/bespeak/save', 'MainController@bespeak_save');

Route::get('/fitment/{p?}', 'MainController@fitment');
Route::get('/fitment/hs/{id}/{p?}', 'MainController@fitment_hs');
Route::get('/fitment/ts/{id}/{p?}', 'MainController@fitment_ts');
Route::get('/fitment/ts/{style}/hs/{house}/{p?}', 'MainController@fitment_filter');
Route::get('/fitment/img/{id}', 'MainController@fitment_img');

Route::get('/wall', 'MainController@retrofit');
Route::get('/part','MainController@retrofit_part');
Route::get('/page/{curr}/{p}','MainController@retrofit_page');

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

    Route::get('list', 'AdminController@data_list');
    Route::get('edit', 'AdminController@edit');
    Route::post('delete', 'AdminController@delete');
    Route::post('save', 'AdminController@save');
});