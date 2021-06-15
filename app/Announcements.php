<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    protected $table = 'announcements';

    protected $fillable = [
        'type', 'title', 'content', 'location', 'start_date', 'end_date','sort'
    ];
}
