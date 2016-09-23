<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Site;

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
        $articles = Article::orderBy('date', 'desc')->get();
        return view('home', ['articles' => $articles]);
    }

    public function store()
    {
        /////////////////////////////////////////////////////////
        // $xmls = [                                           //
        //     'http://blog.livedoor.jp/news23vip/atom.xml',   //
        //     'http://alfalfalfa.com/index.rdf',              //
        //     'http://news.2chblog.jp/index.rdf',             //
        //     'http://blog.livedoor.jp/dqnplus/index.rdf',    //
        //     'http://hamusoku.com/index.rdf',                //
        //     'http://blog.livedoor.jp/jyoushiki43/atom.xml', //
        //     'http://hypernews.2chblog.jp/atom.xml',         //
        //     'http://watch2ch.2chblog.jp/index.rdf',         //
        // ];                                                  //
        /////////////////////////////////////////////////////////

        $start = microtime(true);
        $xmls = Site::all();
        foreach ($xmls as $rss){
            $xml = $rss->rss;
            if (empty($xml) ){
                $xml = $rss->atom;
            }
            $site_id = $rss->id;
            $xml = simplexml_load_file($xml);
            if (isset($xml->entry)){
                $this->storeAtom($xml, $site_id);
            } else if (isset($xml->item)){
                $this->storeRss1($xml, $site_id);
            } else if (isset($xml->channel->item)) {
                $this->storeRss2($xml, $site_id);
            } else {
                return "Nothing can be stored";
            }
        }
        $end = microtime(true);
        return "success! 処理時間:" . ($end - $start) . "秒" ;
    }

    private function storeAtom($xml, $site_id){
        $articles = $xml->entry;
        $site_title = $xml->title;
        $site_url = $xml->link['href'];
        foreach ($articles as $item)
        {
            $sub = Article::where('url', '=', $item->link['href'])->first();
            
            if (is_null($sub)){
                $query = new Article();
                $query->title = $item->title;
                $query->content = $item->summary;
                $query->date = date("Y-m-d H:i:s",strtotime($item->issued));
                $query->url = $item->link['href'];
                $query->site_title = $site_title;
                $query->site_url = $site_url;
                $query->site_id = $site_id;
                $query->save();
            }
        }
    }

    private function storeRss1($xml){
        $site_title = $xml->channel->title; // サイトのタイトル
		$site_link = $xml->channel->link; // サイトのリンク
		foreach($xml->item as $item){
            $sub = Article::where('url', '=', $item->link)->first();
            
            if (is_null($sub)){
                $query = new Article();
                $nameSpace = $xml->getNamespaces(true);
                $gNode = $item->children($nameSpace['dc']);
                $query->title = $item->title;
                $query->url = $item->link;
                $query->content = $item->description;
                $query->date = date("Y-m-d H:i:s",strtotime($gNode->date));
                $query->site_title = $site_title;
                $query->site_url  = $site_link;
                $query->save();
            }
        }
    }

    private function storeRss2($xml){
        $site_title = $xml->channel->title;
		$site_link	= $xml->channel->link;
		foreach($xml->channel->item as $item){
            $sub = Article::where('url', '=', $item->link)->first();
            if (is_null($sub)){

                $query = new Article();
                $query->title	= $item->title;
                $query->url	= $item->link;
                $date	= $item->pubDate;
                $query->date	= date("Y-m-d H:i:s",strtotime($date));
                $query->content = strip_tags($item->description);
                $query->site_url = $site_link;
                $query->site_title = $site_title;
                $query->save();
            }
        }
    }
        
}


