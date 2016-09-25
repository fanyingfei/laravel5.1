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

Route::get('/events', 'MainController@events_ev');
Route::get('/events/{p}', 'MainController@events_ev')->where('p', '[0-9]+');
Route::get('/events/in', 'MainController@events_in');
Route::get('/events/in/{p}', 'MainController@events_in')->where('p', '[0-9]+');

Route::get('/show/{id}', 'MainController@show');

Route::get('/about',  'MainController@about');

Route::get('/bespeak', 'MainController@bespeak');
Route::post('/bespeak/save', 'MainController@bespeak_save');

Route::get('/fitment', 'MainController@fitment');
Route::get('/fitment/{p}', 'MainController@fitment');
Route::get('/fitment/hs/{id}', 'MainController@fitment_hs');
Route::get('/fitment/hs/{id}/{p}', 'MainController@fitment_hs');
Route::get('/fitment/ts/{id}', 'MainController@fitment_ts');
Route::get('/fitment/ts/{id}/{p}', 'MainController@fitment_ts');
Route::get('/fitment/ts/{style}/hs/{house}', 'MainController@fitment_filter');
Route::get('/fitment/ts/{style}/hs/{house}/{p}', 'MainController@fitment_filter');
Route::get('/fitment/img/{id}', 'MainController@fitment_img');

Route::get('/retrofit', 'MainController@retrofit');
Route::get('/retrofit/other','MainController@retrofit_other');
Route::get('/page/retrofit/{curr}/{p}','MainController@retrofit_page');

Route::get('/admin/login', 'AdminController@login');
Route::get('/admin/base', 'AdminController@base');
Route::get('/admin/fitment', 'AdminController@fitment');
Route::get('/admin/retrofit', 'AdminController@retrofit');
Route::get('/admin/event', 'AdminController@event');

Route::get('/admin/list', 'AdminController@data_list');
Route::get('/admin/edit', 'AdminController@edit');
Route::post('/admin/delete', 'AdminController@delete');
Route::post('/admin/save', 'AdminController@save');