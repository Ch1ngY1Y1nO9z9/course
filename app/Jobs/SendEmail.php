<?php

namespace App\Jobs;

use App\User;
use App\SignUp;
use App\WhiteList;
use App\EmailRecord;
use App\Mail\SendMicroEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mail_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail_id)
    {
        $this->mail_id = $mail_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $Email = EmailRecord::find($this->mail_id);

        if($Email->filter == 'all'){
            $all_student = User::where('role', 'student')
                                 ->get();
            $student_ary = [];

            // 用foreach先確認此名單的人是否在白名單中
            // 確認有才放入陣列
            foreach($all_student as $student){
                if(WhiteList::where('student_id',$student->student_id)->get()){
                    array_push($student_ary, $student->email);
                }
            }

            Mail::to('admin@gmail.com')
            ->bcc($student_ary)
            ->queue(new SendMicroEmail($Email));

        }else if($Email->filter == 'class'){
            $student_list = SignUp::where('course_id',$Email->class_id)->get();

            // 將班級所有學生email放入陣列進行寄件
            $email_ary = [];
            foreach($student_list as $student){
                $user_data = User::where('account_id',$student->student_id)->first();

                array_push($email_ary, $user_data->email);
            }

            Mail::to('admin@gmail.com')
                ->bcc($email_ary)
                ->queue(new SendMicroEmail($Email));

        }else if($Email->filter == 'student'){
            $student = User::where('account_id', $Email->account_id)->first(); 
            Mail::to('admin@gmail.com')
                ->bcc($student->email)
                ->queue(new SendMicroEmail($Email));
        }
    }
}
