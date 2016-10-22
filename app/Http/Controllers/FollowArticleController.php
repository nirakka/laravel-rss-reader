<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\FollowArticle;

use App\Site;
use App\SiteReg;
use App\ReadLater;
use App\HasRead;

class FollowArticleController extends Controller
{
    //

    public function index()
    {
        $user = \Auth::user();
        $id = $user->id;
        $articles = FollowArticle::where('user_id', '=', $id)->paginate('30');
        $fav_article_query = FollowArticle::where('user_id', '=', $id)->get();
        $user_reg_site_ids = SiteReg::where('user_id', '=', $id)->get();
        $user_reg_site_ids = $this->objectIdToArray($user_reg_site_ids, 'site_id');
        $user_reg_sites = Site::whereIn('id' , $user_reg_site_ids)->get();
        
        $username=$user->name;
        $useremail=$user->email;
        $fav_article = $this->objectIdToArray($fav_article_query, 'article_id');

        $read_later_query = ReadLater::where('user_id','=',$id)->get();
        $read_later = $this->objectIdToArray($read_later_query, 'article_id');

        $has_read_query = HasRead::where('user_id','=',$id)->get();
        $has_read = $this->objectIdToArray($read_later_query, 'article_id');
        return view('fav',
                    [
                        'title_name' => 'Favorite',
                        'articles' => $articles ,
                        'user_reg_sites' => $user_reg_sites ,
                        'username' => $username ,
                        'useremail' => $useremail ,
                        'fav_article' => $fav_article,
                        'read_later' => $read_later,
                        'has_read' => $has_read,
                    ]
        );
    }
    
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

    private function objectIdToArray($data, $column){
        $site = [];
        foreach ($data as $i) {
            $site[] = $i->$column;
        }
        return $site;
    }
}
