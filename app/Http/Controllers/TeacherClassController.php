<?php

namespace App\Http\Controllers;

use App\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherClassController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $items = Courses::where('user_id',$user_id)->where('status','!=','已撤下')->where('status','!=','審核未通過')->orderBy('id','desc')->get();

        return view('admin.class.index',compact('items'));
    }

    public function fail()
    {
        $user_id = Auth::user()->id;
        $items = Courses::where('user_id',$user_id)->where('status','!=','已撤下')->where('status','!=','未送出')->where('status','!=','審核未通過')->orderBy('id','desc')->get();

        return view('admin.class_fail.index',compact('items'));

    }

    public function fail_check($id)
    {

        return view('admin.class_fail.check');

    }

    public function check_students($id)
    {

        return view('admin.class.teacher.check_students');

    }

    public function rollCall($id)
    {

        return view('admin.class.teacher.roll_call');

    }

    public function rollCall_records($id)
    {

        return view('admin.class.teacher.roll_call_records');

    }

    public function rollCall_records_check($id)
    {

        return view('admin.class.teacher.roll_call_records_check');

    }

}
