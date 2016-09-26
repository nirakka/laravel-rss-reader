<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use App\Http\Requests;
use Goutte;

class SiteController extends Controller
{
    //
    public function registerSite(Request $request){
        $url = $request->site_reg;

        if (strpos($url, 'http://') === false) {
            $url =  'http://' . $url;
        }

        $crawler = Goutte::request('GET', $url);


        if ($crawler->filter('head >link[type="application/rss+xml"]')->count() !== 0){ // RSS系のフィードを保存
            $rss = $crawler->filter('head >link[type="application/rss+xml"]')->first()->attr('href');
        }
  
        if ($crawler->filter('head > link[type="application/atom+xml"]')->count() !== 0){ // Atomを保存
            $atom = $crawler->filter('head > link[type="application/atom+xml"]')->first()->attr('href');
        }

        $title = $crawler->filter('head meta[property="og:site_name"]')->first()->attr('content');
        
        $site = new Site();

        $site->site_title = $title;
        if (isset($url)) {
            $site->site_url = $url;
        }
        if (isset($rss)) {
            $site->rss = $rss;
        }
        if (isset($atom)) {
            $site->atom = $atom;
        }

        $site->save();

        
        
        return "success";
    }

    public function showRegisterForm(){
        return view('site_reg.register');
    }
}
