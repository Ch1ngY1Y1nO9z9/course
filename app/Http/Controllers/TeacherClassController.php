<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherClassController extends Controller
{
    public function index()
    {
        if(Auth::user()->role === 'student'){
            return redirect('/admin/dashboard');
        }else{
            return view('admin.class.teacher.index');
        }
    }

    public function create()
    {
        if(Auth::user()->role === 'student'){
            return redirect('/admin/dashboard');
        }else{
            return view('admin.class.teacher.create');
        }
    }

    public function check($id)
    {
        if(Auth::user()->role === 'student'){
            return redirect('/admin/dashboard');
        }else{
            return view('admin.class.teacher.check');
        }
    }

    public function check_students($id)
    {
        if(Auth::user()->role === 'student'){
            return redirect('/admin/dashboard');
        }else{
            return view('admin.class.teacher.check_students');
        }
    }

    public function rollCall($id)
    {
        if(Auth::user()->role === 'student'){
            return redirect('/admin/dashboard');
        }else{
            return view('admin.class.teacher.roll_call');
        }
    }

    public function rollCall_records($id)
    {
        if(Auth::user()->role === 'student'){
            return redirect('/admin/dashboard');
        }else{
            return view('admin.class.teacher.roll_call_records');
        }
    }

    public function rollCall_records_check($id)
    {
        if(Auth::user()->role === 'student'){
            return redirect('/admin/dashboard');
        }else{
            return view('admin.class.teacher.roll_call_records_check');
        }
    }

    public function review()
    {
        if(Auth::user()->role === 'student'){
            return redirect('/admin/dashboard');
        }else{
            return view('admin.class_review.teacher.index');
        }
    }
    
    public function review_check($id)
    {
        if(Auth::user()->role === 'student'){
            return redirect('/admin/dashboard');
        }else{
            return view('admin.class_review.teacher.check');
        }
    }

    public function review_edit($id)
    {
        if(Auth::user()->role === 'student'){
            return redirect('/admin/dashboard');
        }else{
            return view('admin.class_review.teacher.edit');
        }
    }

    public function fail()
    {
        if(Auth::user()->role === 'student'){
            return redirect('/admin/dashboard');
        }else{
            return view('admin.class_fail.teacher.index');
        }
    }

    public function fail_check($id)
    {
        if(Auth::user()->role === 'student'){
            return redirect('/admin/dashboard');
        }else{
            return view('admin.class_fail.teacher.check');
        }
    }



}
