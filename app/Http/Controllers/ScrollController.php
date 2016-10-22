<?php

namespace App\Http\Controllers;

use App\Article;
use App\Site;
use App\SiteReg;

use Illuminate\Http\Request;

use App\Http\Requests;

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
        $site_title_scroll = [];
        foreach ($articles as $article) {
            $site_title_scroll[] = $article->site()->first()->site_title;
            # code...
        }

        $site_date_scroll = [];

        foreach ($articles as $article){
            # code...
            $site_date_scroll[] = date("Y/m/d", strtotime($article->date));
        }
        
        return response()->json(compact('site_title_scroll','articles','site_date_scroll'));
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
        
}