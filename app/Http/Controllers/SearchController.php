<?php

namespace App\Http\Controllers;

use App\Article;
use App\Site;
use App\SiteReg;
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
        // $searchWord = \Request::all();
        $id = \Auth::user()->id;
        $site_reg = SiteReg::where('user_id', '=', $id)->get();
        $articles_id = $this->articleIdToArray($site_reg);
     
        $articles = Article::whereIn('site_id', $articles_id)
                                    ->where('title', 'like', '%'.$searchWord.'%')
                                    ->orWhere('content', 'like', '%'.$searchWord.'%')
                                    ->orderBy('date', 'desc')
                                    ->get();

        return view('search', compact('articles'));
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
