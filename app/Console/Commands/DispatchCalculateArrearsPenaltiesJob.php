<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DispatchCalculateArrearsPenaltiesJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:dispatch-calculatearrearspenaltiesjob';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch the CalculateArrearsPenaltiesJob';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        CalculateArrearsPenaltiesJob::dispatch();
    }
}
