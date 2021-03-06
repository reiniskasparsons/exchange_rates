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

/**
 * Route for RSS feed
 */
Route::get('/', 'RssController@index');

/**
 * Route for single exchange rate
 */
Route::get('/single/{id}', 'RssController@singleExchangeRate')->where('id', '[0-9]+');
