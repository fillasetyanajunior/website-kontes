<?php

namespace App\Jobs;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProjectRunJob implements ShouldQueue
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
        $project = Project::all();
        $timenow = Carbon::now()->isoformat('YYYY-MM-DD');
        foreach ($project as $itemproject) {
            if ($itemproject->deadline <= $timenow || $itemproject->deadline == $timenow) {
                if ($itemproject->is_active == 'running') {
                    Project::where('id', $itemproject->id)->update(['is_active' => 'choose winner']);
                }
            }
        }
    }
}
