<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//use App\Models\User;

use Carbon\Carbon;
use DB;

class PlanCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        \Log::info('cron is working fine...');
        
        $currdate = date("Y-m-d H:i:s");
           
      
         \Log::info($currdate);
        
        
    }
}
