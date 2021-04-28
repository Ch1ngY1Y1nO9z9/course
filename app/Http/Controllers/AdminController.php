<?php

namespace App\Http\Controllers;

use App\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function get_reset_password()
    {
        return view("auth.new_reset");
    }

    public function reset_password(Request $request)
    {
        if($request->password != $request->password_confirmation){
            return redirect()->back()
                ->withErrors(['password_confirmation' => "輸入的密碼不一致"]);
        }

        $user = Auth::user();

        $user->forceFill([
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        return redirect()->back()->with('status', "更新密碼成功!");

    }

    public function image_post(Request $request)
    {
        // A list of permitted file extensions
        $allowed = array('png', 'jpg', 'gif','zip','jpeg');
        if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){

            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if(!in_array(strtolower($extension), $allowed)){
                echo '{"status":"error"}';
                exit;
            }
            $name = strval(time().str_random(10));
            $ext = explode('.', $_FILES['file']['name']);
            $filename = $name . '.' . $ext[1];
            $destination = public_path().'/upload/img/'. $filename; //change this directory
            $location = $_FILES["file"]["tmp_name"];
            move_uploaded_file($location, $destination);
            echo "/upload/img/".$filename;//change this URL
        }
        exit;
    }

    public function youtube_video()
    {
        $youtube_url = Seo::where('page','youtube_video')->first();
        return view('admin.youtube_video',compact('youtube_url'));
    }

    public function youtube_video_update(Request $request)
    {
        $youtube_url = Seo::where('page','youtube_video')->first();
        $youtube_url->title = $request->youtube_url;
        $youtube_url->save();

        return redirect()->back()->with('status', '更新Youtube連結成功！');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
