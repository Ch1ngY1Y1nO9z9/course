<?php

namespace App\Http\Controllers;

use App\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseClassController extends Controller
{
    public function index()
    {

        return view('admin.course.index');

    }

    public function detail($id)
    {

        return view('admin.course.student_detail');

    }
    
    public function class_detail($id,$class_id)
    {

        return view('admin.course.class_detail');

    }

    public function student_index()
    {
        $items = Courses::where('status','!=','已撤下')->where('status','!=','審核未通過')->get();
        $date = date('m/d/Y h:i:s a', time());
        return view('admin.course.student.index',compact('items','date'));
    }

    public function student_check($id)
    {
        $item = Courses::find($id);
        return view('admin.course.student.check',compact('item'));
    }

    public function records_index()
    {
        return view('admin.course.student.records.index');
    }

    public function records_check($id)
    {
        return view('admin.course.student.records.check');
    }
}
