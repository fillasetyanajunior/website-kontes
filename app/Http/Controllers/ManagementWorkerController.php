<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Rating;
use App\Models\ResultContest;
use App\Models\ResultProject;
use App\Models\SuspendAccount;
use App\Models\User;
use App\Models\Worker;
use Carbon\Carbon;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementWorkerController extends Controller
{
    public function index()
    {
        $data['title']  = 'Management Worker';
        $data['worker'] = Worker::paginate(20);
        return view('admin.worker.worker', $data);
    }
    public function StatusAccount(Worker $worker)
    {
        if ($worker->status_account == 'unverified') {
            $status = 'verified';
        } else {
            $status = 'unverified';
        }

        Worker::where('id',$worker->id)
            ->update([
                'status_account' => $status,
            ]);
        return redirect()->back()->with('status','Account' . $worker->name . 'Berhsil Di' . $status);
    }
    public function SuspendAccount(Worker $worker,Request $request)
    {
        if ($request->suspend == '1') {
            $status = 1;
        } else {
            $status = 3;
        }
        Worker::where('id',$worker->id)
            ->update([
                'status_account'    => 'suspend',
                'suspend'           => date('Y-m-d', strtotime('+' . $status . ' month')),
            ]);
        SuspendAccount::create([
            'user_id'       => $worker->user_id,
            'suspendtime'   => $status . 'month'
        ]);
        return redirect()->back()->with('status','Account' . $worker->name . 'Berhsil Di Suspend' . $status . 'Bulan');
    }
    public function DeleteAccount(Worker $worker)
    {
        Worker::destroy($worker->id);
        User::where('id',$worker->user_id)->delete();
        return redirect()->back()->with('status','Account' . $worker->name . 'Berhsil Di Hapus');
    }
    public function ViewAccount(Worker $worker)
    {
        $project    = Project::all();
        $projects   = Project::first();
        $rating     = Rating::where('user_id_worker', $worker->user_id)->count();
        $user       = User::where('id',$worker->user_id)->first();
        $suspend    = SuspendAccount::where('user_id',$worker->user_id)->count();
        if (Cache::has('user-is-online-' . $user->id)){
            $status =  "Online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() ;
        }else{
            $status = "Offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() ;
        }
        return response()->json([
            'worker'    => $worker,
            'project'   => $project,
            'projects'  => $projects,
            'rating'    => $rating,
            'status'    => $status,
            'user'      => $user,
            'suspend'   => $suspend,
        ]);
    }
    public function ViewProject(Project $project,Request $request)
    {
        if ($project->catagories_project == 'contest') {
            $resultproject  = ResultContest::where('contest_id', $project->id)->where('portfolio','show')->where('user_id_worker', $request->user_id)->get();
        } else {
            $resultproject  = ResultProject::where('contest_id', $project->id)->where('portfolio','show')->where('user_id_worker', $request->user_id)->get();
        }
        return response()->json([
            'resultproject' => $resultproject,
        ]);
    }
}
