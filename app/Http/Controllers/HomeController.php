<?php

namespace App\Http\Controllers;

use App\Article;
use App\Site;
use App\SiteReg;
use Illuminate\Database\Query\paginate;
use Illuminate\Http\Request;
use laravelcollective\Html\HtmlFacade;

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
        $user = \Auth::user();
        $id=$user->id;
        $username=$user->name;
        $useremail=$user->email;

        $user_reg_site_ids = SiteReg::where('user_id', '=', $id)->get();
        $user_reg_site_ids = $this->articleIdToArray($user_reg_site_ids);
        $user_reg_sites = Site::whereIn('id' , $user_reg_site_ids)->get();
     
        $articles = Article::whereIn('site_id', $user_reg_site_ids)->orderBy('date', 'desc')->paginate(30);

        return view('home', 
            [
                'title_name' => 'All Articles' ,
                'articles' => $articles ,
                'user_reg_sites' => $user_reg_sites ,
                'username' => $username ,
                'useremail' => $useremail ,
     
            ]);
    }
    public function showArticlesofTargetSite($target_site_id)
    {

        $user = \Auth::user();
        $id=$user->id;
        $username=$user->name;
        $useremail=$user->email;

        $user_reg_site_ids = SiteReg::where('user_id', '=', $id)->get();
        $user_reg_site_ids = $this->articleIdToArray($user_reg_site_ids);

        $user_reg_sites = Site::whereIn('id' , $user_reg_site_ids)->get();
        $target_site_title = Site::where('id' , '=' , $target_site_id)->value('site_title');
        //get articles of target_site_id
        $articles = Article::where('site_id','=',  $target_site_id)->orderBy('date', 'desc')->paginate(30);
        
        return view('home', 
            [
                'title_name' =>$target_site_title ,
                'articles' => $articles ,
                'user_reg_sites' => $user_reg_sites ,
                'username' => $username ,
                'useremail' => $useremail ,
            ]);
    }
    public function oldhome()
    {

        $id = \Auth::user()->id;
        $site_reg = SiteReg::where('user_id', '=', $id)->get();
        $articles_id = $this->articleIdToArray($site_reg);
        $articles = Article::whereIn('site_id', $articles_id)->orderBy('date', 'desc')->get();

        return view('oldhome', ['articles' => $articles]);
    }

    public function store()
    {
        
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

    public function tempArticle(Request $request){

         $user = \Auth::user();
        $id=$user->id;
        
        $user_reg_site_ids = SiteReg::where('user_id', '=', $id)->get();
        $user_reg_site_ids = $this->articleIdToArray($user_reg_site_ids);

        $user_reg_sites = Site::whereIn('id' , $user_reg_site_ids)->get();
        $target_site_title = Site::where('id' , '=' , $target_site_id)->value('site_title');
        //get articles of target_site_id
        $articles = Article::where('site_id','=',  $target_site_id)->orderBy('date', 'desc')->paginate(15);
        
        return (
            [
                'title_name' =>$target_site_title ,
                'articles' => $articles ,
                'user_reg_sites' => $user_reg_sites ,
                'username' => $username ,
                'useremail' => $useremail ,
            ]);

        // return response()->json();
        //return $request->all();

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
                $query->site_id = $site_id;
                $query->save();
            }
        }
    }

    private function storeRss1($xml, $site_id){
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
                $query->site_id = $site_id;
                $query->save();
            }
        }
    }

    private function storeRss2($xml, $site_id){
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
                $query->site_id = $site_id;
                $query->save();
            }
        }
    }


    private function articleIdToArray($data){
        $site = [];
        foreach ($data as $i) {
            $site[] = $i->site_id;
        }
        return $site;
    }
        
}

