<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'tutorial_id', 'class_name', 'teacher_name', 'degree', 'experience', 'class_start', 'class_end', 'open', 'number', 'sign_up_start_date', 'sign_up_end_date', 'location', 'total_hours', 'credit', 'content', 'contact', 'phone', 'extend', 'files', 'remarks', 'status','user_id'
    ];

    
    public function getUser()
    {
        return Auth::user();
    }

    public function getRole()
    {
        return Auth::user()->role;
    }
    
    public function announces()
    {
        return $this->hasMany('App\ClassAnnounce','class_id');
    }

    public function tutorial()
    {
        return $this->belongsTo('App\Tutorials','tutorial_id');
    }

    // 課堂學生名單 
    public function signupList()
    {
        return $this->hasMany('App\SignUp','course_id');
    }

    // 計算全部的課程
    public function scopeAdminDashBoard()
    {
        return $this->whereIn('status',['已開課','已結束','已通過']);
    }

    // 計算老師擁有的課程
    public function scopeTeacherDashBoard()
    {
        return $this->started();
    }

    // 計算學生報名的課程
    // public function scopeStudentsDashBoard()
    // {
    //     return $this->where('',$this->getUser()->id);
    // }

    // 查詢已通過課程(學生端報名用)
    public function scopeStudentSignUp($query)
    {
        return $this->where('status',['已通過']);
    }
    
    // 查詢該課堂已報名人數
    public function checkSignUp($class_id)
    {   
        return SignUp::where('course_id', $class_id)->get()->count();
    }

    // 取得所有報名學生
    public function scopeGetTotalStudent($query, $courses)
    {
        if($this->getRole() == 'teacher'){
            $student_number = 0;
            foreach($courses as $course){
                $student_number += SignUp::where('course_id',$course->id)
                                            ->get()
                                            ->count();
            }
        }else if($this->getRole() == 'admin'){
            $student_number = SignUp::all()
                                        ->unique('student_id')
                                        ->count();
        }

        return $student_number;
    }

    // 取得開課中課程數
    public function scopeGetRunningClass($query, $courses)
    {
        $runningClass = $this->where('user_id',$this->getUser()->id)
                                    ->where('status','已開課')
                                    ->get()
                                    ->count();

        return $runningClass;
    }

    // 取得學生已修學分
    public function scopeGetStudentsScore($query)
    {
        $passed_list = SignUp::where('pass','通過')->get();
        $totalScore = 0;

        foreach($passed_list as $passed)
        {
            $score = $passed->getCoursesDetail->total_hours;
            $totalScore += $score;
        }
        
        return floor($totalScore / 18);
    }

    // 取得學生總時數
    public function scopeGetTotalTime($query)
    {
        $passed_list = SignUp::where('pass','!=','尚未評分')->get();
        $totalTime = 0;

        foreach($passed_list as $passed)
        {
            $totalTime += $passed->getCoursesDetail->total_hours;
        }

        return $totalTime;
    }

    // 判斷學生是否報名(true/false)
    public function querySignup($account_id)
    {
        return $this->signupList->where('student_id',$account_id)->count() > 0;
    }

    // 轉換開課或報名時間
    public function getDate($value)
    {
        return date("Y-m-d H:i", strtotime($value));
    }

    // 確認報名時間(學生查詢修課紀錄用)
    public function checkTime($id)
    {
        $class = Courses::find($id);

        $endTime = strtotime($class->sign_up_end_date);
        $date = strtotime(date('m/d/Y h:i:s a', time()));

        return $endTime > $date;
    }

    // 是否顯示課程公告(狀態為"已通過"和"已開課"才顯示)
    public function checkClassStatus()
    {
        if($this->status == '已通過' || $this->status == '已開課'){
            return true;
        }
        return false;
    }


    // 查詢課程狀態
    // 所有所有類型: 待審核 審核未通過 已撤下 已通過 已開課 已結束 未送出

    // 類型: 審核未通過 已撤下
    public function scopeFailed($query)
    {
        return $this->where('user_id', $this->getUser()->id)
                    ->whereIn('status', ['已撤下','審核未通過']);
    }

    // 類型: 待審核 已通過 已開課 已結束 未送出
    public function scopePassed($query)
    {
        return $this->where('user_id', $this->getUser()->id)
                    ->whereIn('status', ['未送出','待審核','已通過','已開課','已結束']);
    }

    // 類型: 待審核 未送出
    public function scopeReview($query)
    {
        return $this->where('user_id', $this->getUser()->id)
                    ->whereIn('status', ['待審核','未送出']);
    }

    // 類型: 已開課 已結束
    public function scopeStarted($query)
    {
        return $this->where('user_id', $this->getUser()->id)
                    ->whereIn('status', ['已開課','已結束']);
    }
    
}
