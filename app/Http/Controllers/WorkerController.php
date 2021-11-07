<?php

namespace App\Http\Controllers;

use App\Mail\AccountWorkerMail;
use App\Models\Project;
use App\Models\Rating;
use App\Models\ResultContest;
use App\Models\ResultProject;
use App\Models\User;
use App\Models\Worker;
use Carbon\Carbon;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class WorkerController extends Controller
{
    public function profileWorker()
    {
        $data['worker']     = Worker::where('user_id',request()->user()->id)->first();
        $data['project']    = Project::where('catagories_project','contest')->get();
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
        }
        return redirect()->back()->with('status','Portfolio Success in Show');
    }
    public function hidePortfolio(Request $request)
    {
        if ($request->role == 'contest') {
            ResultContest::where('id',$request->id)->update(['portfolio' => 'hide']);
        }
        return redirect()->back()->with('status','Portfolio Success in hide');
    }
    public function profileWorkerSetting()
    {
        $data['title']      = 'Worker Profile';
        $data['worker']     = Worker::where('user_id', request()->user()->id)->first();
        return view('worker.profile_setting', $data);
    }
    public function profileUpdate(Request $request, Worker $worker)
    {
        if ($request->hasfile('avatar')) {

            if ($worker->avatar != null) {
                Storage::delete('profile/' . $worker->avatar);
            }

            $file = $request->file('avatar');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profile', $name);

            Worker::where('id', $worker->id)
                ->update([
                    'paypal'        => $request->paypal,
                    'avatar'        => $name,
                ]);
            User::where('id', $worker->user_id)
                ->update([
                    'avatar'    => $name,
                ]);
        } else {
            Worker::where('id', $worker->id)
                ->update([
                    'paypal'    => $request->paypal,
                ]);
        }

        if ($request->paypal != $worker->paypal) {
            Mail::to($worker->email)->send(new AccountWorkerMail($request->paypal));
        }


        return redirect()->back()->with('status', 'Profile Berhasil Di Update');
    }
}
