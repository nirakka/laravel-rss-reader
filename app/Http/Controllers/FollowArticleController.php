<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\FollowArticle;

class FollowArticleController extends Controller
{
    //
    public function followArticle(Request $request){
        $follow = new FollowArticle();
        $follow->user_id = \Auth::user()->id;
        $follow->article_id = $request->article_id;

        $follow->save();
    }
}
