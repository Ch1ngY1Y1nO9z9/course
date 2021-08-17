<?php

namespace App\Http\Controllers;

use App\Announcements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassAnnouncementController extends Controller
{
    public function index()
    {   
        $items = Announcements::all();
        return view('admin.class_announcement.index',compact('items'));
    }

    public function create()
    {

        return view('admin.class_announcement.create');
    }

    public function store(Request $request)
    {
        $new_record = Announcements::create($request->all());

        if(!$new_record->location)
            $new_record->location = '-';

        $new_record->save();

        return redirect('/micro-course/class_announcement');
    }

    public function edit($id)
    {
        $item = Announcements::find($id);
        return view('admin.class_announcement.edit',compact('item'));
    }

    public function update(Request $request,$id)
    {
        $item = Announcements::find($id);
        $item->update($request->all());

        return redirect('/micro-course/class_announcement')->with('update','取消成功!');
    }

    public function totop($id)
    {
        $item = Announcements::find($id);
        
        if($item->sort == 1){
            $item->sort = 0;
            $item->save();
            return back()->with('success1','取消成功!');
        }
        elseif($item->sort == 0){
            $item->sort = 1;
            $item->save();
            return back()->with('success2','置頂成功!');
        }
    }

    public function delete($id)
    {
        $item = Announcements::find($id);

        $item->delete();

        return redirect()->back();
    }

    public function student_index()
    {
        $items = Announcements::all();
        return view('admin.class_announcement.student.index',compact('items'));
    }

    public function student_check($id)
    {
        $item = Announcements::find($id);

        return view('admin.class_announcement.student.check',compact('item'));
    }
}
