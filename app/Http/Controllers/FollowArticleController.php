<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\FollowArticle;

class FollowArticleController extends Controller
{
    //
    public function followArticle(Request $request){
        $follow = FollowArticle::create($request->all());

        return response()->json($follow);

    }
}