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

        if (Site::where('site_url', '=', $url)->exists()){
            
            $site_id = Site::where('site_url', '=', $url)->first()->id;
            
            SiteReg::create(['user_id' => \Auth::user()->id, 'site_id' => $site_id]);

            return 'success!';
        }
        //        if (strpos($url, 'http://') === false || strpos($url, 'https://')) {
            //            $url =  'http://' . $url;            
            //}                                       
        
        $client = new Client();
        
      
        $crawler = $client->request('GET', $url);
        

        if ($crawler->filter('head >link[type="application/rss+xml"]')->count() !== 0){ // RSS系のフィードを保存
            $rss = $crawler->filter('head >link[type="application/rss+xml"]')->first()->attr('href');
        }
  
        if ($crawler->filter('head > link[type="application/atom+xml"]')->count() !== 0){ // Atomを保存
            $atom = $crawler->filter('head > link[type="application/atom+xml"]')->first()->attr('href');
        }

        if ($title = $crawler->filter('head meta[property="og:site_name"]')->count() !== 0){ 
            $title = $crawler->filter('head meta[property="og:site_name"]')->first()->attr('content');
        }

        $title = $crawler->filter('head title')->text();
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
