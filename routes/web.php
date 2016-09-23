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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/rss', 'HomeController@store');

Route::get('/a', function() {
  $crawler = Goutte::request('GET', 'http://duckduckgo.com/?q=Laravel');
  $url = $crawler->filter('.result__title > a')->first()->attr('href');
  dump($url);
  return view('welcome');
});