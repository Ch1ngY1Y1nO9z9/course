<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CheckCoursesStatus;

class checkClassStatus extends Command
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
        CheckCoursesStatus::dispatch();
    }
}
