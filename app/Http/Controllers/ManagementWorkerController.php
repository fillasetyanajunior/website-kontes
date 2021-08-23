<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Rating;
use App\Models\ResultContest;
use App\Models\ResultProject;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementWorkerController extends Controller
{
    public function index()
    {
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
                'suspend' => date('Y-m-d', strtotime('+' . $status . ' month')),
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
        return response()->json([
            'worker' => $worker,
            'project' => $project,
            'projects' => $projects,
            'rating' => $rating,
        ]);
    }
    public function ViewProject(Project $project,Request $request)
    {
        if ($project->catagories_project == 'contest') {
            $resultproject  = ResultContest::where('contest_id', $project->id)->where('user_id_worker', $request->user_id)->get();
        } else {
            $resultproject  = ResultProject::where('contest_id', $project->id)->where('user_id_worker', $request->user_id)->get();
        }
            $earning        = DB::table('winner_contests')
                            ->join('projects', 'winner_contests.contest_id','=','projects.id')
                            ->where('user_id_worker',$request->user_id)
                            ->sum('projects.harga');

        return response()->json([
            'resultproject' => $resultproject,
            'earning' => $earning,
        ]);
    }
}
