<?php

namespace App\Http\Controllers;

use App\Article;
use App\Site;
use App\SiteReg;
use App\HasRead;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ReadLater;
use App\FollowArticle;

class ScrollController extends Controller{

	public function form(){
		return view('scroll');
	}

    public function tempArticle(){


        $user = \Auth::user();
        $id=$user->id;
        $username=$user->name;
        $useremail=$user->email;
        $user_reg_site_ids = SiteReg::where('user_id', '=', $id)->get();
        $user_reg_site_ids = $this->articleIdToArray($user_reg_site_ids);
        $user_reg_sites = Site::whereIn('id' , $user_reg_site_ids)->get();

        $articles = Article::whereIn('site_id', $user_reg_site_ids)->orderBy('date', 'desc')->paginate(15);

        $fav_article_query = FollowArticle::where('user_id', '=', $id)->get();
        $fav_article_ob = $this->objectIdToArray($fav_article_query, 'article_id');

        $read_later_query = ReadLater::where('user_id','=',$id)->get();
        $read_later_ob = $this->objectIdToArray($read_later_query, 'article_id');

        $has_read_query = HasRead::where('user_id','=',$id)->get();
        $has_read_ob = $this->objectIdToArray($read_later_query, 'article_id');
        

        $site_title_scroll = [];
        foreach ($articles as $article) {
            $site_title_scroll[] = $article->site()->first()->site_title;
            # code...
        }

        $site_date_scroll = [];
        $has_read = [];
        $read_later = [];
        $fav_article = [];
        foreach ($has_read_ob as $i) {
        $has_read [] = $i;
            # code...
        }

        foreach ($read_later_ob as $i) {
        $read_later [] = $i;
        }

        foreach ($fav_article_ob as $i) {
                $fav_article [] = $i;
            # code...
        }

        foreach ($articles as $article){
            $site_date_scroll[] = date("Y/m/d", strtotime($article->date));
        }
        

        return response()->json(compact('site_title_scroll','articles','site_date_scroll','fav_article','read_later','has_read'));
        // return (
        //     [
        //         'title_name' =>$target_site_title ,
        //         'articles' => $articles ,
        //         'user_reg_sites' => $user_reg_sites ,
        //         'username' => $username ,
        //         'useremail' => $useremail ,
        //     ]);

        // return response()->json();
        //return $request->all();

    }

     public function tempArticleofTargetSite($target_site_id){


        $user = \Auth::user();
        $id=$user->id;
        $username=$user->name;
        $useremail=$user->email;
        $user_reg_site_ids = SiteReg::where('user_id', '=', $id)->get();
        $user_reg_site_ids = $this->articleIdToArray($user_reg_site_ids);
        $user_reg_sites = Site::whereIn('id' , $user_reg_site_ids)->get();

        $articles = Article::where('site_id','=',  $target_site_id)->orderBy('date', 'desc')->paginate(15);

        $fav_article_query = FollowArticle::where('user_id', '=', $id)->get();
        $fav_article_ob = $this->objectIdToArray($fav_article_query, 'article_id');

        $read_later_query = ReadLater::where('user_id','=',$id)->get();
        $read_later_ob = $this->objectIdToArray($read_later_query, 'article_id');

        $has_read_query = HasRead::where('user_id','=',$id)->get();
        $has_read_ob = $this->objectIdToArray($read_later_query, 'article_id');
        

        $site_title_scroll = [];
        foreach ($articles as $article) {
            $site_title_scroll[] = $article->site()->first()->site_title;
            # code...
        }

        $site_date_scroll = [];
        $has_read = [];
        $read_later = [];
        $fav_article = [];
        foreach ($has_read_ob as $i) {
        $has_read [] = $i;
            # code...
        }

        foreach ($read_later_ob as $i) {
        $read_later [] = $i;
        }

        foreach ($fav_article_ob as $i) {
                $fav_article [] = $i;
            # code...
        }

        foreach ($articles as $article){
            $site_date_scroll[] = date("Y/m/d", strtotime($article->date));
        }
        

        return response()->json(compact('site_title_scroll','articles','site_date_scroll','fav_article','read_later','has_read'));
        // return (
        //     [
        //         'title_name' =>$target_site_title ,
        //         'articles' => $articles ,
        //         'user_reg_sites' => $user_reg_sites ,
        //         'username' => $username ,
        //         'useremail' => $useremail ,
        //     ]);

        // return response()->json();
        //return $request->all();

    }

    private function articleIdToArray($data){
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