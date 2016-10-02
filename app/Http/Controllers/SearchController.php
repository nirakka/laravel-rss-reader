<?php

namespace App\Http\Controllers;

use Request;
use App\Article;
use App\Site;
use App\SiteReg;

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
    // public function index()


    //     return view('home', ['articles' => $articles]);
    // }

    public function search()
    {
        return view('search');
    }

    public function showresult()
    {
        // $searchWord= Request::get('searchWord');
        // $id = \Auth::user()->id;
        // $site_reg = SiteReg::where('user_id', '=', $id)->get();

        // $articles_id = $this->articleIdToArray($site_reg);
        // $articles = Article::whereIn('site_id', $articles_id)->orderBy('date', 'desc')->get();
        // return view('showresult');
        $value= "F";
        $id = \Auth::user()->id;
        $site_reg = SiteReg::where('user_id', '=', $id)->get();
        $articles_id = $this->articleIdToArray($site_reg);
        $articles = Article::whereIn('site_id', $articles_id)
                                ->where('title', 'like', '%'.$value.'%')
                                ->orWhere('content','like','%'.$value.'%')
                                ->orderBy('date', 'desc')
                                ->get();

        // $articles = Article::whereIn('site_id', $articles_id)->orderBy('date', 'desc')->get();

        return view('showresult', ['articles' => $articles]);
    }

    private function articleIdToArray($data)
    {
        $site = [];
        foreach ($data as $i) {
            $site[] = $i->site_id;
        }
        return $site;
    }
}
