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

    public function destroy(Request $request){
        $delete = FollowArticle::where('user_id', '=', $request->user_id)
            ->where('article_id', '=', $request->article_id)
            ->delete();

        return response()->json($delete);
    }
}
