<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteReg extends Model
{
    //
    protected $table = 'sites_regs';

    public function siteInfo(){
        return $this->belongsTo('App\Site', 'site_id');
    }
}
