<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VipperOre;
use App\memo;

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
        $articles = VipperOre::orderBy('date', 'desc')->get();
        return view('home', ['articles' => $articles]);
    }

    public function store()
    {
        $xmls = [
            'http://blog.livedoor.jp/news23vip/atom.xml',
            'http://nirakka.net/blog/?feed=rss2',
        ];

        foreach ($xmls as $xml){
            $xml = simplexml_load_file($xml);
            //$xml = simplexml_load_file('http://nirakka.net/blog/?feed=rss2');
            if ($xml->entry){
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

                    $sub = VipperOre::where('url', '=', $item->url);

                    if (is_null($sub)){
                        $query->save();
                    }
                }
            } else if ($xml->item){
                $this->storeRss1($xml);
            } else {
                $this->storeRss2($xml);
            }
        }

        return "success!";
    }

    public function storeRss1($xml){
        
        
        $site_title = $xml->channel->title; // サイトのタイトル
		$site_link = $xml->channel->link; // サイトのリンク
		foreach($xml->item as $item){
            $query = new Model();
            $nameSpace = $xml->getNamespaces(true);
            $gNode = $item->children($nameSpace['dc']);
            $query->title = $item->title;
            $query->url = $item->link;
            $query->content = $gNode->subject;
            $query->date = $gNode->date;

            $query->save();
        }
    }

    public function storeRss2($xml){
        $site_title = $xml->channel->title;
		$site_link	= $xml->channel->link;
		foreach($xml->channel->item as $item){
            $query = new memo();
			$query->title	= $item->title;
			$query->url	= $item->link;
			$date	= $item->pubDate;
			$query->date	= date("Y-m-d H:i:s",strtotime($date));
            $query->content = $item->description;
            $query->site_url = $site_link;
            $query->site_title = $site_title;
            $sub = VipperOre::where('url', '=', $item->url);
            if (is_null($sub)){
            $query->save();
            }
        }
    }
        
}


