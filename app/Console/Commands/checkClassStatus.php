<?php

namespace App\Console\Commands;

use App\Courses;
use Illuminate\Console\Command;
use App\Jobs\CheckCoursesStatus;

class checkClassStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkClassStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每天晚上12點會檢查是否有課程已過期或已開課';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // // 每天午夜12點執行一次將所有課程狀態做一次調整
        
        // $date = strtotime(date('m/d/Y', time()));
        // $passed_course = Courses::where('status', '已通過')->get();

        // foreach($passed_course as $passed_class)
        // {
        //     $class_start_day = strtotime($passed_class->class_start);
        //     if($date >= $class_start_day){
        //         $passed_class->status = '已開課';
        //         $passed_class->save();
        //     }
        // }


        // $starting_course = Courses::where('status', '已開課')->get();
        
        // foreach($starting_course as $starting_class)
        // {
        //     $class_end_day = strtotime($starting_class->class_end);
        //     if($date >= $class_end_day){
        //         $starting_class->status = '已結束';
        //         $starting_class->save();
        //     }
        // }
        dispatch(new CheckCoursesStatus());
    }
}
