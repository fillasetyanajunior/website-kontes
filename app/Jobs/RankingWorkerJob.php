<?php

namespace App\Jobs;

use App\Models\Worker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RankingWorkerJob implements ShouldQueue
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
        $earning    = Worker::orderByDesc('earning')->get();
        $worker     = Worker::all();
        $i = 1;
        foreach ($earning as $item) {
            foreach ($worker as $itemw) {
                if ($item->user_id == $itemw->user_id) {
                    Worker::where('user_id', $item->user_id)->update(['rangking' => $i]);
                    $i++;
                }
            }
        }
    }
}
