<?php

namespace App\Http\Controllers;

use App\Tutorials;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function index()
    {
        // 搜尋未被軟刪除的分類
        $items = Tutorials::where('soft_delete','0')->get();

        return view('admin.tutorial.index',compact('items'));
    }

    public function create()
    {
        return view('admin.tutorial.create');
    }

    public function store(Request $request)
    {
        Tutorials::create($request->all());

        return redirect('/micro-course/tutorial')->with('success','新增成功!');
    }

    public function edit($id)
    {
        $item = Tutorials::find($id);
        return view('admin.tutorial.edit',compact('item'));
    }

    public function update(Request $request,$id)
    {
        $item = Tutorials::find($id);
        $item->update($request->all());

        $item->save();

        return redirect('/micro-course/tutorial')->with('success','更新成功!');
    }

    public function delete(Request $request,$id)
    {
        $item = Tutorials::find($id);
        $item->soft_delete = 1;
        $item->save();

        return redirect('/micro-course/tutorial')->with('success','撤下成功!');
    }

}
