<?php

namespace App\Jobs;

use App\Models\NewsFeed;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewsFeedJob implements ShouldQueue
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
        $newfeed = NewsFeed::all();
        foreach ($newfeed as $item) {
            $limit = date('d-m-Y', strtotime('+1 month', strtotime($item->created_at)));
            $datetime = Carbon::now()->isoformat('YYYY-MM-DD');
            if ($datetime == $limit || $datetime >= $limit) {
                NewsFeed::destroy($item->id);
            }
        }
    }
}
