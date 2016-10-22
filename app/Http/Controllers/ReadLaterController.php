<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ReadLater;
use App\SiteReg;
use App\Site;

class ReadLaterController extends Controller
{
    //
    public function index()
    {
        $user = \Auth::user();
        $id = $user->id;
        $articles = ReadLater::where('user_id', '=', $id)->paginate('30');
        $fav_article_query = ReadLater::where('user_id', '=', $id)->get();
        $user_reg_site_ids = SiteReg::where('user_id', '=', $id)->get();
        $user_reg_site_ids = $this->objectIdToArray($user_reg_site_ids, 'site_id');
        $user_reg_sites = Site::whereIn('id' , $user_reg_site_ids)->get();
        
        $username=$user->name;
        $useremail=$user->email;
        $fav_article = $this->objectIdToArray($fav_article_query, 'article_id');
        return view('fav',
                    [
                        'title_name' => '後で読む',
                        'articles' => $articles ,
                        'user_reg_sites' => $user_reg_sites ,
                        'username' => $username ,
                        'useremail' => $useremail ,
                        'fav_article' => $fav_article
                    ]
        );
    }

    private function objectIdToArray($data, $column){
        $site = [];
        foreach ($data as $i) {
            $site[] = $i->$column;
        }
        return $site;
    }
    
    public function readLaterArticle(Request $request){
        $read_later = ReadLater::create($request->all());

        return response()->json($read_later);
    }

    public function destroy(Request $request){
        $delete = ReadLater::where('user_id', '=', $request->user_id)
            ->where('article_id', '=', $request->article_id)
            ->delete();

        return response()->json($delete);
    }
}