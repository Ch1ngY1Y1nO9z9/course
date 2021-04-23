<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';
    protected $fillable  =['title','keywords','description'];
    public $timestamps = false;
}
