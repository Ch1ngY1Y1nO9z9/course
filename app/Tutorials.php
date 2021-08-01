<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorials extends Model
{
    protected $fillable = [
        'tutorial_name_cn', 'tutorial_name_en', 'tutorials_type', 'budget', 'organizer', 'soft_delete'
    ];


    public function scopeGetAll($query)
    {
        return $this->where('soft_delete','0');
    }

    public function class()
    {
        return $this->hasMany('App\Courses','tutorial_id');
    }
}
