<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowArticle extends Model
{
    //
    protected $table = 'favorite_article';
    

    public $fillable = ['user_id', 'article_id', 'status'];
}
