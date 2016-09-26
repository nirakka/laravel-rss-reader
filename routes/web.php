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
  $crawler = Goutte::request('GET', 'http://nirakka.net/blog');
  $url = $crawler->filter('head >link[type="application/rss+xml"]')->first()->attr('href');

  $title = $crawler->filter('head meta[property="og:title"]')->first()->attr('content');
  
  if ($crawler->filter('head > link[type="application/atom+xml"]')->count() !== 0){
      $atom = $crawler->filter('head > link[type="application/atom+xml"]')->first()->attr('href');
  }
  
  dump($url, $title);
  return view('welcome');
});

Route::get('/sites', 'SiteController@showRegisterForm');

Route::post('/sites', 'SiteController@registerSite');

Route::get('/sites_regs', 'SiteRegController@index');