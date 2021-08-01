<?php

namespace App\Jobs;


use App\SignUp;
use App\Mail\Announce;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendAnnounceMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $signupList;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($signupList)
    {
        $this->signupList = $signupList;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        foreach($this->signupList as $student){
            Mail::to($student->getAccount->email)->queue(new Announce($student->course_id));
        }
    }
}
