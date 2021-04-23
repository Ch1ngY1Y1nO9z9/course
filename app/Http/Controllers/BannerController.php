<?php

namespace App\Http\Controllers;
use App\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class BannerController extends Controller
{
   public function index(){
        $lists = Slider::orderBy('sort','desc')->get();
        return view('admin.banner.index',compact('lists'));
   }

   public function create(){
        return view('admin.banner.create');
   }

   public function store(Request $request){
       $new_list = new Slider();
       $new_list -> slider_alt = $request -> slider_alt;
       $new_list -> slider_a_href = $request -> slider_a_href;
       $new_list -> sort = $request -> sort;
       $new_list -> slider_url = $this->upload_file($request->file("upload_file"));
       $new_list -> save();
       return redirect('/admin/banner')->with('message','新增成功!');
   }

   public function edit($id){
        $list = Slider::find($id);
        return view('admin.banner.edit',compact('list'));
   }

   public function update(Request $request,$id){
       $list = Slider::find($id);
       $list -> slider_alt = $request -> slider_alt;
       $list -> slider_a_href = $request -> slider_a_href;
       $list -> sort = $request -> sort;
       if($request-> hasFile('upload_file')) {
           File::delete(public_path() . $list->slider_url);
           $list->slider_url = $this->upload_file($request->file("upload_file"));
       }
       $list -> save();
       return redirect('/admin/banner')->with('message','修改成功!');
   }

   public function delete(Request $request,$id){
       $list = Slider::find($id);
       File::delete(public_path().$list -> slider_url);
       $list -> delete();
       return redirect('/admin/banner')->with('message','刪除成功!');
   }

   //Baner圖片上傳
    public function upload_file($file){
        $allowed_extensions = ["png", "jpg", "gif", "PNG", "JPG", "GIF"];
        if ($file->getClientOriginalExtension() &&
            !in_array($file->getClientOriginalExtension(), $allowed_extensions))
        {
            return redirect()->back()->with('message','僅接受jpg, png, gif, doc, docx, xls, xlsx, pdf格式檔案!');
        }
        $extension = $file->getClientOriginalExtension();
        $destinationPath = public_path() . '/banner/';
        $original_filename = $file->getClientOriginalName();

        $filename = $file->getFilename() . '.' . $extension;
        $url = '/banner/' . $filename;

        $file->move($destinationPath, $filename);

        return $url;
    }

}
