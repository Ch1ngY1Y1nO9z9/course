<?php

namespace App\Http\Controllers;
use App\Links;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class LinksController extends Controller
{
   public function index(){
        $lists = Links::orderBy('sort','desc')->get();
        return view('admin.links.index',compact('lists'));
   }

   public function create(){
        return view('admin.links.create');
   }

   public function store(Request $request){
       $new_list = new Links();
       $new_list -> links_alt = $request -> links_alt;
       $new_list -> links_a_href = $request -> links_a_href;
       $new_list -> sort = $request -> sort;
       $new_list -> links_url = $this->upload_file($request->file("upload_file"));
       $new_list -> save();
       return redirect('/micro-course/links')->with('message','新增成功!');
   }

   public function edit($id){
        $list = Links::find($id);
        return view('admin.links.edit',compact('list'));
   }

   public function update(Request $request,$id){
       $list = Links::find($id);
       $list -> links_alt = $request -> links_alt;
       $list -> links_a_href = $request -> links_a_href;
       $list -> sort = $request -> sort;
       if($request-> hasFile('upload_file')) {
           File::delete(public_path() . $list->links_url);
           $list->links_url = $this->upload_file($request->file("upload_file"));
       }
       $list -> save();
       return redirect('/micro-course/links')->with('message','修改成功!');
   }

   public function delete(Request $request,$id){
       $list = Links::find($id);
       File::delete(public_path().$list -> links_url);
       $list -> delete();
       return redirect('/micro-course/links')->with('message','刪除成功!');
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
        $destinationPath = public_path() . '/links/';
        $original_filename = $file->getClientOriginalName();

        $filename = $file->getFilename() . '.' . $extension;
        $url = '/links/' . $filename;

        $file->move($destinationPath, $filename);

        return $url;
    }

}
