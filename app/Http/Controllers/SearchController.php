<?php

namespace App\Http\Controllers;

use App\Article;
use App\Site;
use App\SiteReg;
use App\FollowArticle;
use App\ReadLater;
use App\HasRead;
use Request;

class SearchController extends Controller
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

        $searchWord = \Request::get('searchWord');
        $user = \Auth::user();
        $id=$user->id;
        $username=$user->name;
        $useremail=$user->email;

        $user_reg_site_ids = SiteReg::where('user_id', '=', $id)->get();
        $user_reg_site_ids = $this->articleIdToArray($user_reg_site_ids);
        $site_reg = SiteReg::where('user_id', '=', $id)->get();
        $articles_id = SiteReg::where('user_id', '=', $id)->get()->toArray();
        $articles_id = $this->articleIdToArray($site_reg);
        $user_reg_sites = Site::whereIn('id' , $user_reg_site_ids)->get();
        $articles = Article::whereIn('site_id', $articles_id)
                                    ->where('title', 'like', '%'.$searchWord.'%')
                                    ->orWhere('content', 'like', '%'.$searchWord.'%')
                                    ->orderBy('date', 'desc')
                                    ->paginate(15);

        $fav_article_query = FollowArticle::where('user_id', '=', $id)->get();
        $fav_article = $this->objectIdToArray($fav_article_query, 'article_id');

        $read_later_query = ReadLater::where('user_id','=',$id)->get();
        $read_later = $this->objectIdToArray($read_later_query, 'article_id');

        $has_read_query = HasRead::where('user_id','=',$id)->get();
        $has_read = $this->objectIdToArray($read_later_query, 'article_id');
                                    
        return view('home', 
            [
                'title_name' =>'Search Result of "' . $searchWord . '"' ,
                'articles' => $articles ,
                'user_reg_sites' => $user_reg_sites ,
                'username' => $username ,
                'useremail' => $useremail ,
                'fav_article' => $fav_article ,
                'read_later' => $read_later ,
                'has_read' => $has_read ,
            ]);                              
        
    }

    private function articleIdToArray($data)
    {
        $site = [];
        foreach ($data as $i) {
            $site[] = $i->site_id;
        }
        return $site;
    }

    private function objectIdToArray($data, $column){

        $site = [];
        foreach ($data as $i) {
            $site[] = $i->$column;
        }
        return $site;
    }
}
