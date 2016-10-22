<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/oldhome', 'HomeController@oldhome');


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/home/pid={site_id}', 'HomeController@showArticlesofTargetSite');

Route::get('/rss', 'HomeController@store');

Route::get('/tempArticleGet','ScrollController@tempArticle');
Route::get('/tempArticle', 'ScrollController@form');

Route::get('/search','SearchController@index');


//Route::post('/search','SearchController@showresult');


//Route::post('/search',['as' => 'contact'])


Route::get('/sites', 'SiteController@showRegisterForm');

Route::post('/sites', 'SiteController@registerSite');

Route::get('/sites_regs', 'SiteRegController@index');

Route::post('/articles', 'FollowArticleController@followArticle');
Route::post('/delete-fav', 'FollowArticleController@destroy');
Route::get('/favorite', 'FollowArticleController@index');

Route::post('/read-later', 'ReadLaterController@readLaterArticle');
Route::post('/delete-later', 'ReadLaterController@destroy');
Route::get('/read-later', 'ReadLaterController@index');

Route::post('/has-read', 'HasReadController@hasRead');
Route::post('/del-has-read', 'HasReadController@destroy');