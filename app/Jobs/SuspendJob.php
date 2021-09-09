<?php

namespace App\Jobs;

use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SuspendJob implements ShouldQueue
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
        $worker = Worker::all();
        $timenow = Carbon::now()->isoformat('YYYY-MM-DD');
        foreach ($worker as $itemworker) {
            if ($timenow >= $itemworker->suspend || $timenow == $itemworker->suspend) {
                Worker::where('id',$itemworker->id)
                        ->update([
                            'status_account' => 'verified'
                        ]);
            }
        }
    }
}
