<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VipperOre;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = VipperOre::all();
        return view('home', ['articles' => $articles]);
    }

    public function store()
    {
        $xml = simplexml_load_file('http://blog.livedoor.jp/news23vip/atom.xml');
        $articles = $xml->entry;
        $site_title = $xml->title;
        $site_url = $xml->link['href'];
        foreach ($articles as $item)
        {
            $query = new VipperOre();
            $query->title = $item->title;
            $query->content = $item->summary;
            $query->date = $item->issued;
            $query->url = $item->link['href'];
            $query->site_title = $site_title;
            $query->site_url = $site_url;

            $query->save();
        }

        return "success!";
    }
        
}
