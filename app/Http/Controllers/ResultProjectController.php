<?php

namespace App\Http\Controllers;

use App\Mail\VerifiedWorkerMail;
use App\Models\NewsFeed;
use App\Models\Project;
use App\Models\ResultContest;
use App\Models\ResultProject;
use App\Models\ResultTestContest;
use App\Models\TestCountResult;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ResultProjectController extends Controller
{
    public function createSubmitContest(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'filecontest'   => 'required',
        ]);

        $file = $request->file('filecontest');
        $name = time() . rand(1, 100) . '.' . $file->extension();
        $file->storeAs('resultcontest', $name);

        if ($request->portfolio == 1) {
            $portfolio = 'show';
        } else {
            $portfolio = 'hide';
        }

        $workers = Worker::where('user_id',request()->user()->id)->first();

        if ($workers->status_account == 'verified') {
            $user = Project::where('id',$request->id)->first();

            NewsFeed::create([
                'contest_id'    => $request->id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $user->user_id,
                'filecontest'   => $name,
                'choices'       => 'submit'
            ]);

            $datetime = ResultContest::create([
                'contest_id'    => $request->id,
                'user_id_worker'=> request()->user()->id,
                'title'         => $request->title,
                'filecontest'   => $name,
                'is_active'     => 'active',
                'portfolio'     => $portfolio,
            ]);

            Project::where('id',$request->id)
                    ->update([
                        'submit' => $datetime->created_at,
                    ]);
        } else if ($workers->status_account == 'unverified') {

            $result = ResultTestContest::create([
                'contest_id'    => $request->id,
                'user_id_worker'=> request()->user()->id,
                'title'         => $request->title,
                'filecontest'   => $name,
                'is_active'     => 'active',
                'portfolio'     => $portfolio,
            ]);

            TestCountResult::create([
                'result_contest_id' => $result->id,
                'user_id_worker'    => request()->user()->id,
                'choices'           => 'active'
            ]);

            $result = ResultTestContest::where('user_id_worker',request()->user()->id)->distinct('contest_id')->count();
            $admin  = User::where('role','admin')->get();
            // dd($result);
            if ($result == 3 || $result >= 3 ) {
                foreach ($admin as $itemadmin) {
                    Mail::to($itemadmin->email)->send(new VerifiedWorkerMail(request()->user()->id));
                    // Http::post(env('API_WHATSAPP_URL') . 'send-message', [
                    //     'number' => $itemadmin->phone,
                    //     'message' =>    'the system has detected that a worker has completed the test, please check your email for follow up'
                    // ]);
                }
            }
        }
        return redirect()->back()->with('status', 'Submit Contest Success');
    }
    public function createSubmitDirect(Request $request)
    {
        $request->validate([
            'description'   => 'required',
        ]);

        if ($request->portfolio == 1) {
            $portfolio = 'show';
        }else{
            $portfolio = 'hide';
        }

        $user = Project::where('id', $request->id)->first();

        NewsFeed::create([
            'contest_id'    => $request->id,
            'user_id_from'  => request()->user()->id,
            'user_id_to'    => $user->user_id,
            'description'   => $request->description,
            'choices'       => 'submit',
        ]);

        $datetime = ResultProject::create([
            'contest_id'    => $request->id,
            'user_id_worker'=> request()->user()->id,
            'description'   => $request->description . '/' . $request->harga . '/' . $request->hari,
            'is_active'     => 'active',
            'portfolio'     => $portfolio,
        ]);

        Project::where('id', $request->id)
            ->update([
                'submit' => $datetime->created_at,
            ]);
        return redirect()->back()->with('status', 'Submit Direct Success');
    }
}
