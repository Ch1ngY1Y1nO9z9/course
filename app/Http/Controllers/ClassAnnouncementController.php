<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassAnnouncementController extends Controller
{
    public function index()
    {
        if(Auth::user()->role === 'admin'){
            return view('admin.class_announcement.index');
        }else{
            return redirect('/admin/dashboard');
        }

    }

    public function create()
    {
        if(Auth::user()->role === 'admin'){
            return view('admin.class_announcement.create');
        }else{
            return redirect('/admin/dashboard');
        }
    }

    public function edit($id)
    {
        if(Auth::user()->role === 'admin'){
            return view('admin.class_announcement.edit');
        }else{
            return redirect('/admin/dashboard');
        }
    }
}
