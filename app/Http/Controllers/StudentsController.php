<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    public function index()
    {
        if(Auth::user()->role === 'admin'){
            return view('admin.students.index');
        }else{
            return redirect('/admin/dashboard');
        }
    }

    public function detail($id)
    {
        if(Auth::user()->role === 'admin'){
            return view('admin.students.student_detail');
        }else{
            return redirect('/admin/dashboard');
        }
    }
    
    public function class_detail($id,$class_id)
    {
        if(Auth::user()->role === 'admin'){
            return view('admin.students.class_detail');
        }else{
            return redirect('/admin/dashboard');
        }
    }
}
