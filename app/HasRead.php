<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasRead extends Model
{
    //
    protected $table = 'has_read_articles';

    public $fillable = ['user_id', 'article_id'];

    public function article(){

        return $this->hasOne('App\Article', 'id', 'article_id');
    }
}
