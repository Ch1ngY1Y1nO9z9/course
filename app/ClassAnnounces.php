<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassAnnounces extends Model
{
    protected $table = 'class_announces';

    protected $fillable = [
        'title', 'content', 'files', 'start_date', 'end_date', 'class_id'
    ];

    public function announces()
    {
        return $this->belongsTo('App\ClassAnnounce','class_id');
    }
}
