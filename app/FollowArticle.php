<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowArticle extends Model
{
    //
    protected $table = 'favorite_article';
    

    public $fillable = ['user_id', 'article_id'];

    public function article(){

        return $this->hasOne('App\Article', 'id', 'article_id');
    }
}
