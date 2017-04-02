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

//全部の記事一覧
Route::get('/home', 'HomeController@index');
//特定サイトの記事表示
Route::get('/home/pid={site_id}', 'HomeController@showArticlesofTargetSite');

//フィードを読み込むディレクトリー
Route::get('/rss', 'HomeController@store');
//全記事表示のとき，スクロールに呼ばれる
Route::get('/tempArticleGet','ScrollController@tempArticle');
//特定の記事のとき，スクロールに呼ばれる
Route::get('/tempArticleGet/pid={site_id}','ScrollController@tempArticleofTargetSite');
//スクロールデバッグ用コントローラ
Route::get('/tempArticle', 'ScrollController@form');
//記事内の文字検索コントローラ
Route::get('/search','SearchController@index');
Route::get('/logout',function(){
	Auth::logout();
	return redirect('/login');
});

//新規サイト登録（デバッグ用）
Route::get('/sites', 'SiteController@showRegisterForm');
Route::post('/sites', 'SiteController@registerSite');

//登録サイト一覧コンローラ
Route::get('/sites_regs', 'SiteRegController@index');
Route::post('/sites_regs', 'SiteRegController@destroy');

Route::post('/articles', 'FollowArticleController@followArticle');
Route::post('/delete-fav', 'FollowArticleController@destroy');
Route::get('/favorite', 'FollowArticleController@index');

Route::get('/read-later', 'ReadLaterController@index');
Route::post('/read-later', 'ReadLaterController@readLaterArticle');
Route::post('/delete-later', 'ReadLaterController@destroy');
Route::get('/read-later', 'ReadLaterController@index');

Route::post('/has-read', 'HasReadController@hasRead');
Route::post('/del-has-read', 'HasReadController@destroy');
//WIP, ユーザの好みのビューに応じて画面を表示
Route::get('/edit-view', 'UserController@editDefaultViewType');
Route::post('/edit-view', 'UserController@updateDefaultViewType');
