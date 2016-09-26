<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    //
    protected $table = "sites";
    public $timestamps = false;

    public function articles(){
        return $this->hasMany('App\Article', 'site_id', 'id');
    }
}
