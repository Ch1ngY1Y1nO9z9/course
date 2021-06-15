<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'class_cn', 'class_en', 'budget', 'class_type', 'organizer', 'teacher_name', 'degree', 'experience', 'class_start', 'class_end', 'open', 'number', 'sign_up_start_date', 'sign_up_end_date', 'location', 'total_hours', 'credit', 'content', 'contact', 'phone', 'extend', 'files', 'remarks', 'status','user_id'
    ];
    
    public function announces()
    {
        return $this->hasMany('App\ClassAnnounce','class_id');
    }
}
