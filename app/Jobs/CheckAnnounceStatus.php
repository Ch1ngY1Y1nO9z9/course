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
        // 尋找沒被刪除且已被推送的公告
        $been_announced_list = ClassAnnounces::where('soft_delete', 0)
                                        ->where('pushed', 1)
                                        ->get();


        $date = strtotime(date('m/d/Y h:i:s a', time()));

        foreach($Announce_list as $Announce){
            // 檢查是否可上架
            if($date > strtotime($Announce->start_date)){
                dispatch(new SendAnnounceMail($Announce->announces->signupList));
                $Announce->pushed = 1;
                $Announce->save();
            }
        }

        foreach($been_announced_list as $Announce){
            // 檢查是否可下架(軟刪除)
            // 確認是否有下架時間
            if($Announce->end_date){
                if($date > strtotime($Announce->end_date)){
                    dispatch(new SendAnnounceMail($Announce->announces->signupList));
                    $Announce->soft_delete = 1;
                    $Announce->save();
                }
            }
        }
    }
}
