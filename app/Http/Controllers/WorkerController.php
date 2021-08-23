<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Rating;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function profileWorker()
    {
        $data['worker']     = Worker::where('user_id',request()->user()->id)->first();
        $data['project']    = Project::all();
        $data['projects']   = Project::first();
        $data['rating']     = Rating::where('user_id_worker',request()->user()->id)->count();
        return view('worker.profile_worker',$data);
    }
}
