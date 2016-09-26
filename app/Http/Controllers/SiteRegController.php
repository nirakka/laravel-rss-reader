<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SiteReg;

class SiteRegController extends Controller
{
    //
    public function index(){
        $user_id = \Auth::user()->id;
        $site_reg = SiteReg::where('user_id', '=', $user_id)->get();

        return view('site_reg.site_list', ['site_reg' => $site_reg]);
    }
}
