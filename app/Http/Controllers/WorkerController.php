<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Rating;
use App\Models\ResultContest;
use App\Models\ResultProject;
use App\Models\User;
use App\Models\Worker;
use Carbon\Carbon;
use Cache;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function profileWorker()
    {
        $data['worker']     = Worker::where('user_id',request()->user()->id)->first();
        $data['project']    = Project::all();
        $data['projects']   = Project::first();
        $data['rating']     = Rating::where('user_id_worker',request()->user()->id)->count();
        $user               = User::where('id', request()->user()->id)->first();
        if (Cache::has('user-is-online-' . $user->id)) {
            $data['status'] =  "Online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans();
        } else {
            $data['status'] = "Offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans();
        }
        return view('worker.profile_worker',$data);
    }
    public function ProfileWorkerPublic(Request $request)
    {
        $data['worker']     = Worker::where('user_id',$request->id)->first();
        $data['project']    = Project::all();
        $data['projects']   = Project::first();
        $data['rating']     = Rating::where('user_id_worker',$request->id)->count();
        $user               = User::where('id', $request->id)->first();
        if (Cache::has('user-is-online-' . $user->id)) {
            $data['status'] =  "Online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans();
        } else {
            $data['status'] = "Offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans();
        }
        return view('customer.profile_worker_public',$data);
    }
    public function showPortfolio(Request $request)
    {
        if ($request->role == 'contest') {
            ResultContest::where('id',$request->id)->update(['portfolio' => 'show']);
        } else {
            ResultProject::where('id',$request->id)->update(['portfolio' => 'show']);
        }
        return redirect()->back()->with('status','Portfolio Success in Show');
    }
    public function hidePortfolio(Request $request)
    {
        if ($request->role == 'contest') {
            ResultContest::where('id',$request->id)->update(['portfolio' => 'hide']);
        } else {
            ResultProject::where('id',$request->id)->update(['portfolio' => 'hide']);
        }
        return redirect()->back()->with('status','Portfolio Success in hide');
    }
}
