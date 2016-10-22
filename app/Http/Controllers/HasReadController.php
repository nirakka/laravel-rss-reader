<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\HasRead;


class HasReadController extends Controller
{
    //
    private function objectIdToArray($data, $column){
        $site = [];
        foreach ($data as $i) {
            $site[] = $i->$column;
        }
        return $site;
    }
    
    public function hasRead(Request $request){
        $has_read = HasRead::create($request->all());

        return response()->json($has_read);
    }

    public function destroy(Request $request){
        $delete = HasRead::where('user_id', '=', $request->user_id)
            ->where('article_id', '=', $request->article_id)
            ->delete();

        return response()->json($delete);
    }
}
