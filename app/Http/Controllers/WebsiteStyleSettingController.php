<?php

namespace App\Http\Controllers;

use App\WebsiteStyleSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class WebsiteStyleSettingController extends Controller
{
    public function index()
    {
        $website_style_setting = WebsiteStyleSetting::find(1);
        
        return view('admin.website_style_setting.index',compact('website_style_setting'));
    }

    public function update(Request $request)
    {
        $website_style_setting = WebsiteStyleSetting::find(1);
        $website_style_setting -> main_navbar_bg_color = $request -> main_navbar_bg_color;
        $website_style_setting -> more_navbar_bg_color = $request -> more_navbar_bg_color;
        $website_style_setting -> footer_bg_color = $request -> footer_bg_color;

        if($request-> hasFile('content_page_bg_img')) {
            File::delete(public_path() . $website_style_setting->content_page_bg_img);
            $website_style_setting->content_page_bg_img = $this->upload_file($request->file("content_page_bg_img"));
        }
        $website_style_setting -> save();

        return redirect('/admin/website_style_setting');
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
         $destinationPath = public_path() . '/websiteSetting/';
         $original_filename = $file->getClientOriginalName();
 
         $filename = $file->getFilename() . '.' . $extension;
         $url = '/websiteSetting/' . $filename;
 
         $file->move($destinationPath, $filename);
 
         return $url;
     }
}
