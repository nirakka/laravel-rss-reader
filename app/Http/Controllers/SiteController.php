<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use App\Http\Requests;
use App\Http\Requests\SiteRequest;
use Goutte\Client;
use App\SiteReg;

class SiteController extends Controller
{
    //
    public function registerSite(SiteRequest $request){
        $url = $request->site_reg;

        
        if (strpos($url, 'http://') === false || strpos($url, 'https://')) {
            $url =  'http://' . $url;            
        }                                       
        


        $client = new Client();
        $guzzleClient = new \GuzzleHttp\Client([
                                                   'timeout' => 90,
                                                   'verify' => false,
                                               ]);
        $client->setClient($guzzleClient);
        $crawler = $client->request('GET', $url);
        

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

        $site_id = Site::orderBy('id', 'desc')->first()->id;
        $site_reg = new SiteReg();
        $user_id = \Auth()->user()->id;
        $site_reg->user_id = $user_id;
        $site_reg->site_id = $site_id;
        $site_reg->save();
        
        return "success";
    }

    public function showRegisterForm(){
        return view('site_reg.register');
    }
}
