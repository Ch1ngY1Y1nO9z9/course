<?php

namespace App\Http\Controllers;

use App\IndexBackgrounds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class IndexBackgroundController extends Controller
{
    public function index()
    {
        $index_backgrounds = IndexBackgrounds::all();
        
        return view('admin.index_background_setting.index',compact('index_backgrounds'));
    }

    public function update(Request $request, $block)
    {
        $index_background = IndexBackgrounds::where('block',$block)->first();
        $index_background->background_size = $request->background_size;

        if($request-> hasFile('background_link')) {
            File::delete(public_path() . $index_background->background_link);
            $index_background->background_link = $this->upload_file($request->file("background_link"));
        }
        $index_background -> save();

        return redirect('/micro-course/index_background_setting');
    }

    //Baner圖片上傳
     public function upload_file($file){
         $allowed_extensions = ["png", "jpg", "PNG", "JPG"];
         if ($file->getClientOriginalExtension() &&
             !in_array($file->getClientOriginalExtension(), $allowed_extensions))
         {
             return redirect()->back()->with('message','僅接受jpg, png格式檔案!');
         }
         $extension = $file->getClientOriginalExtension();
         $destinationPath = public_path() . '/IndexBackground/';
         $original_filename = $file->getClientOriginalName();
 
         $filename = $file->getFilename() . '.' . $extension;
         $url = '/IndexBackground/' . $filename;
 
         $file->move($destinationPath, $filename);
 
         return $url;
     }
}
