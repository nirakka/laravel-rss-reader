<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = 'articles';
    public $timestamps = false;

    public function site(){
        return $this->belongsTo('App\Site', 'site_id');
    }
}
