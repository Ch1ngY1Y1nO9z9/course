<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreRequestFailed extends Model
{
    protected $table = "score_reqest_failed";

    protected $fillable = [
        'student_id', 'passed_courses'
    ];

    public function student()
    {
        return $this->belongsTo('App\User','student_id','account_id');
    }

    public function getCourse($signup_id)
    {
        return SignUp::find($signup_id);
    }
}
