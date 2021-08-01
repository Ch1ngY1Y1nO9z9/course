<?php

namespace App\Jobs;

use App\Courses;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CheckCoursesStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 每天午夜12點執行一次將所有課程狀態做一次調整
        
        $date = strtotime(date('m/d/Y', time()));
        $passed_course = Courses::where('status', '已通過')->get();

        foreach($passed_course as $passed_class)
        {
            $class_start_day = strtotime(date('m/d/Y', $passed_class->class_start));
            if($date >= $class_start_day){
                $passed_class->status = '已開課';
                $passed_class->save();
            }
        }


        $starting_course = Courses::where('status', '已開課')->get();
        
        foreach($starting_course as $starting_class)
        {
            $class_end_day = strtotime(date('m/d/Y', $starting_class->class_end));
            if($date >= $class_end_day){
                $starting_class->status = '已結束';
                $starting_class->save();
            }
        }

    }
}
