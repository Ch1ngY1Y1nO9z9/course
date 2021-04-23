<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebCount extends Model
{
    protected $table = 'web_count';
    protected $fillable=['count','ip'];
}
