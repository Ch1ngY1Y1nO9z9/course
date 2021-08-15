<?php

namespace App\Http\Controllers;

use App\SignUp;
use App\Courses;
use App\ClassAnnounces;
use Illuminate\Http\Request;
use App\Jobs\CheckAnnounceStatus;
use Illuminate\Support\Facades\Auth;

class CourseClassController extends Controller
{
    public function testqueue()
    {

    }

    public function index()
    {
        $items = SignUp::getRecords();

        return view('admin.course.index',compact('items'));

    }

    public function detail($id)
    {
        $item = Courses::find($id);

        return view('admin.course.student_detail', compact('item'));

    }
    
    public function class_detail($class_id)
    {
        $item = Courses::find($class_id);
        return view('admin.course.class_detail', compact('item'));

    }

    public function student_index()
    {
        $user = Auth::user();
        $items = Courses::StudentSignUp()->get();
        $date = strtotime(date('m/d/Y h:i:s a', time()));
        return view('admin.course.student.index',compact('items','date','user'));
    }

    public function student_check($id)
    {
        $item = Courses::find($id);
        return view('admin.course.student.check',compact('item'));
    }

    public function records_index()
    {
        $user = Auth::user();
        $items = SignUp::where('student_id',$user->account_id)
                        ->orderby('created_at','desc')
                        ->get();

        return view('admin.course.student.records.index',compact('items'));
    }

    public function records_check($id)
    {
        $item = Courses::find($id);
        return view('admin.course.student.check',compact('item'));
    }

    public function announce($id)
    {
        $items = ClassAnnounces::getPushedAnnounce($id)
                                ->get();
        $date = strtotime(date('m/d/Y h:i:s a', time()));

        return view('admin.course.student.records.announce', compact('items','date'));
    }

    public function announce_check($id)
    {
        $item = ClassAnnounces::find($id);

        return view('admin.course.student.records.announce_check', compact('item'));
    }
}
