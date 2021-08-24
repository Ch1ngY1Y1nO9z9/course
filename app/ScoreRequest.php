<?php

namespace App;

use App\SignUp;
use Illuminate\Database\Eloquent\Model;

class ScoreRequest extends Model
{
    protected $table = "score_reqest";

    protected $fillable = [
        'student_id', 'passed','score'
    ];

    public function student()
    {
        return $this->belongsTo('App\User','student_id','account_id');
    }

    public function checkRemainTime($student_id)
    {
        // 帳號紀錄的學分*18 減去 已修得的時間
        $user = User::where('account_id', $student_id)->first();

        $remain_time = $this->getStudentTime($student_id) - $user->score * 18;

        return $remain_time;
    }

    public function getStudentTime($student_id)
    {
        $time = SignUp::CheckStudentAllTime($student_id);

        return $time;
    }

    public function scopeCheckRequestTime($query, $student_id)
    {
        // 帳號紀錄的學分*18 減去 已修得的時間
        $user = User::where('account_id', $student_id)->first();

        $remain_time = $this->getStudentTime($student_id) - $user->score * 18;

        return $remain_time;
    }
}
