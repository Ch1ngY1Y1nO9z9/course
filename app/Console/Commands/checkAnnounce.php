<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CheckAnnounceStatus;

class checkAnnounce extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:checkClassStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '確認課程公告是否有新的通知';

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
        CheckAnnounceStatus::dispatch();
    }
}
