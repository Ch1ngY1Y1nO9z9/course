<?php

namespace App\Http\Controllers;

use App\User;
use App\SignUp;
use App\Courses;
use App\EmailRecord;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        $items = User::where('role','student')->get();
        $classes = Courses::whereIn('status', ['已通過','已開課','已結束'])->get();
        
        return view('admin.email.index',compact('items','classes'));
    }

    public function check(Request $request)
    {
        $account = User::where('account_id',$request->account_id)->first();

        if($account && $account->role == 'student'){
            return $account;
        }else{
            return 'false';
        }
    }

    public function send(Request $request)
    {
        $mail = EmailRecord::create($request->all());
        $mail->content = $request->email_content;
        $mail->save();

        dispatch(new SendEmail($mail->id));

        return redirect('/micro-course/mail')->with('success','');
    }
}
