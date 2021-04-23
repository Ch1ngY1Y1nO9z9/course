<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanArticle extends Model
{
    protected $table = "plan_article";

    public function download_files()
    {
        return $this->hasMany('App\DownloadFile','plan_id');
    }

    public function plan_page($attributes = null)
    {
        return $this->belongsTo('App\PlanPage','pid');
    }
}
