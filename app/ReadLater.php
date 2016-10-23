<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ReadLater extends Model
{
    //
    protected $table = 'read_later';
        
    public $fillable = ['user_id', 'article_id'];
    public function article(){
        return $this->hasOne('App\Article', 'id', 'article_id');
    }

    
}
