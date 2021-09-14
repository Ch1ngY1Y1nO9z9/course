<?php

namespace App\Jobs;

use App\ClassAnnounces;
use Illuminate\Bus\Queueable;
use App\Jobs\SendAnnounceMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CheckAnnounceStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 尋找沒被刪除且尚未被推送的公告
        $Announce_list = ClassAnnounces::where('soft_delete', 0)
                                        ->where('pushed', 0)
                                        ->get();

        $date = strtotime(date('m/d/Y h:i:s a', time()));

        if(count($Announce_list) != 0){
            foreach($Announce_list as $Announce){
                // 檢查是否可上架
                if($date > strtotime($Announce->start_date)){
                        dispatch(new SendAnnounceMail($Announce->announces->signupList));
                        $Announce->pushed = 1;
                        $Announce->save();
                    
                }
            }
        }
    }
}
