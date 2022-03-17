<?php

namespace App\Http\Controllers;

use App\Seo;
use App\SignUp;
use App\Courses;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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
        $user = Auth::user();
        $warning = '';
        if($user->blocked == 1){
            $warning = '目前您已曠課超過2次,根據微學分課程實施辦法,您將不得再使用本系統選修微學分,若有任何問題請向***提出';
        }
        $info = [];

        if($user->role == 'teacher'){
            $courses = Courses::TeacherDashBoard()->get();
            $info = [
                'totalClass' => count($courses),
                'totalStudents' => Courses::getTotalStudent($courses),
                'runningClass' => Courses::getRunningClass($courses)
            ];
        }else if($user->role == 'admin'){
            $courses = Courses::AdminDashBoard()->get();
            
            $info = [
                'totalClass' => count($courses),
                'totalStudents' => Courses::getTotalStudent($courses),
                'totalScore' => Courses::getStudentsScore(),
                'totalTime' => Courses::getTotalTime()
            ];
        }else {
            $info = [
                'totalStudentClass' => SignUp::getTotalStudentClass()->count(),
                'startingClass' => SignUp::getStartingClass(),
                'totalScore' => Auth::user()->score,
                'totalTime' => SignUp::getStudentTime(),
            ];
        }

        return view('admin.dashboard',compact('warning','info'));
    }

    public function output($date){
        return Response::download(storage_path('logs/laravel-'.$date.'.log'));
    }
 }
