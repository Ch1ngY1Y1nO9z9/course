<?php

namespace App\Http\Controllers;

use App\SignUp;
use App\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherClassController extends Controller
{
    public function index()
    {
        $feature_name = '單元管理';
        $items = Courses::Passed()
                        ->orderBy('id','desc')
                        ->get();


        return view('admin.class.index',compact('items','feature_name'));
    }

    public function fail()
    {
        $items = Courses::Failed()
                        ->orderBy('id','desc')
                        ->get();

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
