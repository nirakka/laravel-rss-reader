<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SiteReg;
use App\Site;
use App\User;
class UserController extends Controller
{
    //
    protected $table = 'users';

    public function editDefaultViewType(){
        $user_id = \Auth::user()->id;
        $site_reg = SiteReg::where('user_id', '=', $user_id)->get();
        $user = \Auth::user();
        $id = $user->id;

        
        $user_reg_site_ids = SiteReg::where('user_id', '=', $id)->get();
        $user_reg_site_ids = $this->objectIdToArray($user_reg_site_ids, 'site_id');
        $user_reg_sites = Site::whereIn('id' , $user_reg_site_ids)->get();
        
        $username=$user->name;
        $useremail=$user->email;
        
        return view('editViewType',
                    [
                        'title_name' => '表示設定',
                        'user_reg_sites' => $user_reg_sites ,
                        'username' => $username ,
                        'useremail' => $useremail ,

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

    public function updateDefaultViewType(Request $request){
        
        $user = User::where('id', '=', \Auth::user()->id)->first();
        $user->view_type = $request->view_type;
        $user->save();

        return 'success';
    }
}
