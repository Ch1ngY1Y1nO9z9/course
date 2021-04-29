<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseClassController extends Controller
{
    public function index()
    {
        if(Auth::user()->role === 'admin'){
            return view('admin.course.index');
        }else{
            return redirect('/admin/dashboard');
        }
    }

    public function detail($id)
    {
        if(Auth::user()->role === 'admin'){
            return view('admin.course.student_detail');
        }else{
            return redirect('/admin/dashboard');
        }
    }
    
    public function class_detail($id,$class_id)
    {
        if(Auth::user()->role === 'admin'){
            return view('admin.course.class_detail');
        }else{
            return redirect('/admin/dashboard');
        }
    }

    public function student_index()
    {
        return view('admin.course.student.index');
    }

    public function student_check($id)
    {
        return view('admin.course.student.check');
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
