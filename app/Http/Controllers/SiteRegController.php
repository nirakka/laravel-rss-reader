<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SiteReg;
use App\Site;
class SiteRegController extends Controller
{

    public function index(){
        $user_id = \Auth::user()->id;
        $site_reg = SiteReg::where('user_id', '=', $user_id)->get();
        $user = \Auth::user();
        $id = $user->id;
        
        $user_reg_site_ids = SiteReg::where('user_id', '=', $id)->get();
        $user_reg_site_ids = $this->objectIdToArray($user_reg_site_ids, 'site_id');
        $user_reg_sites = Site::whereIn('id' , $user_reg_site_ids)->get();
        
        $username=$user->name;
        $useremail=$user->email;
        
        return view('site_reg.site_list',
                    [
                        'title_name' => '後で読む',
                        'user_reg_sites' => $user_reg_sites ,
                        'username' => $username ,
                        'useremail' => $useremail ,
                        'site_reg' => $site_reg,
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

    public function destroy(Request $request){
        $delete = SiteReg::where('user_id', '=', $request->user_id)
                ->where('site_id', '=', $request->site_id)
                ->delete();

        return response()->json($delete);

    }
    
}
