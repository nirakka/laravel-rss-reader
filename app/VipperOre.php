<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VipperOre extends Model
{
    protected $table = 'vipper_ore';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'url', 'site_url', 'site_title',
    ];

    
    public $timestamps = false;
}
