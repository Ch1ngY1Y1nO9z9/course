<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreRequestSuccess extends Model
{
    protected $table = "score_reqest_success";

    protected $fillable = [
        'student_id','score', 'passed_courses'
    ];

    public function student()
    {
        return $this->belongsTo('App\User','student_id','account_id');
    }
}
