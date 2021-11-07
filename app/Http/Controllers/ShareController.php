<?php

namespace App\Http\Controllers;

use App\Mail\ShareContestMail;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ShareController extends Controller
{
    public function ShareContest(Project $project)
    {
        if ($project->catagories_project == 'contest') {
            $data = DB::table('result_contests')->where('contest_id', $project->id)->where('nilai', '>', 4)->get();
        } else {
            $data = DB::table('result_projects')->where('contest_id', $project->id)->where('nilai', '>', 4)->get();
        }
        foreach ($data as $item) {
            $worker = User::where('id',$item->user_id_worker)->first();
            Mail::to($worker->email)->send(new ShareContestMail($project->id));
            Http::post(env('API_WHATSAPP_URL') . 'send-message', [
                'number' => $worker->phone,
                'message' =>    'Congratulations, you received a contest invitation from a customer, please check your email for the contest link'
            ]);

        }
        return redirect()->back()->with('status','Share Contest Success');
    }
}
