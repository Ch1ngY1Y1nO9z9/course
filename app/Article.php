<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';

    public function download_files()
    {
        return $this->hasMany('App\DownloadFile','article_id');
    }
}