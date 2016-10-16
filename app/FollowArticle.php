<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowArticle extends Model
{
    //
    protected $table = 'follow_article';

    public $fillable = ['user_id', 'article_id'];
}
