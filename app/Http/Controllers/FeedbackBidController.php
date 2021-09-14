<?php

namespace App\Http\Controllers;

use App\Mail\EliminasiMail;
use App\Mail\FeedbackMail;
use App\Mail\WinnerChooseMail;
use App\Models\FeedbackBid;
use App\Models\NewsFeed;
use App\Models\Project;
use App\Models\ResultProject;
use App\Models\User;
use App\Models\WinnerContest;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackBidController extends Controller
{
    public function GetData(ResultProject $resultproject)
    {
        $user       = User::where('id', $resultproject->user_id_worker)->first();
        $feedback   = FeedbackBid::where('result_id', $resultproject->id)->get();
        $project    = Project::where('id', $resultproject->contest_id)->first();
        return response()->json([
            'resultproject' => $resultproject,
            'project'       => $project,
            'user'          => $user,
            'feedback'      => $feedback,
        ]);
    }
    public function KirimFeedback(Request $request, ResultProject $resultproject)
    {
        $project = Project::where('id', $resultproject->contest_id)->first();
        if (request()->user()->role == 'customer') {
            $feedbackbis = FeedbackBid::create([
                'result_id'         => $resultproject->id,
                'worker_id'         => $resultproject->user_id_worker,
                'customer_id'       => request()->user()->id,
                'feedback_customer' => $request->feedback,
            ]);

            NewsFeed::create([
                'contest_id'    => $resultproject->contest_id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $feedbackbis->worker_id,
                'feedback'      => $request->feedback,
                'choices'       => 'feedback',
            ]);

            $worker = User::where('id',$feedbackbis->worker_id)->first();
            Mail::to($worker->email)->send(new FeedbackMail($request->feedback,$project->title));

        } else {
            $feedbackbis = FeedbackBid::create([
                'result_id'         => $resultproject->id,
                'worker_id'         => request()->user()->id,
                'customer_id'       => $project->user_id,
                'feedback_worker'   => $request->feedback,
            ]);

            NewsFeed::create([
                'contest_id'    => $resultproject->contest_id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $feedbackbis->customer_id,
                'feedback'      => $request->feedback,
                'choices'       => 'feedback',
            ]);

            $customer = User::where('id', $feedbackbis->customer_id)->first();
            Mail::to($customer->email)->send(new FeedbackMail($request->feedback, $project->title));
        }

        return redirect()->back()->with('status', 'Feedback Bid Berhasil di kirim');
    }
    public function UserFeedback(ResultProject $resultproject, Request $request)
    {
        if ($request->role_user == 'customer') {
            $user = Project::where('id', $resultproject->contest_id)->first();
            $data = User::where('id', $user->user_id)->first();
        } else {
            $data = User::where('id', $resultproject->user_id_worker)->first();
        }

        return response()->json([
            'user'  => $data,
            'user2' => $request,
        ]);
    }
    public function NilaiContest(Request $request, ResultProject $resultproject)
    {
        ResultProject::where('id', $resultproject->id)
                    ->update([
                        'nilai' => $request->nilai
                    ]);
        // $data = Project::where('id', $resultproject->contest_id)->first();
        // if ($data->nilai == null) {
        //     $nilai = $request->nilai;
        // } else {
        //     $nilai = $data->nilai + $request->nilai;
        // }
        NewsFeed::create([
            'contest_id'    => $resultproject->contest_id,
            'user_id_from'  => request()->user()->id,
            'user_id_to'    => $resultproject->user_id_worker,
            'rating'        => $request->nilai,
            'choices'       => 'rating',
        ]);

        $nilai = ResultProject::groupBy('contest_id')->sum('nilai');

        $guarded = ResultProject::where('nilai', 5)->count('nilai');

        if ($guarded == 3 || $guarded >= 3) {
            Project::where('id', $resultproject->contest_id)
                ->update([
                    'guarded' => 'active'
                ]);
        }

        Project::where('id', $resultproject->contest_id)
            ->update([
                'nilai' => $nilai
            ]);
        return response()->json([
            'status' => 200,
        ]);
    }
    public function EliminasiPeserta(ResultProject $resultproject)
    {
        ResultProject::where('id', $resultproject->id)
            ->update([
                'is_active'     => 'eliminasi',
            ]);

        $worker = User::where('id', $resultproject->user_id_worker)->first();

        Mail::to($worker->email)->send(new EliminasiMail($resultproject->contest_id, $worker->role));
        Mail::to(request()->user()->email)->send(new EliminasiMail($resultproject->contest_id, request()->user()->role));

        NewsFeed::create([
            'contest_id'    => $resultproject->contest_id,
            'user_id_from'  => request()->user()->id,
            'user_id_to'    => $resultproject->user_id_worker,
            'choices'       => 'eliminasi',
        ]);
        return redirect()->back()->with('status', 'Update Direct Success');
    }
    public function StoreWinner(ResultProject $resultproject)
    {
        $project = Project::where('id',$resultproject->contest_id)->first();

        $worker = Worker::where('user_id', $resultproject->user_id_worker)->first();
        if ($worker->earning == 0) {
            $earning = $project->harga;
        } else {
            $earning = $project->harga + $worker->earning;
        }

        NewsFeed::create([
            'contest_id'    => $resultproject->contest_id,
            'user_id_from'  => request()->user()->id,
            'user_id_to'    => $resultproject->user_id_worker,
            'choices'       => 'pick winner',
        ]);

        WinnerContest::create([
            'contest_id'        => $resultproject->contest_id,
            'user_id'           => request()->user()->id,
            'user_id_worker'    => $resultproject->user_id_worker,
            'title'             => $project->title,
            'filecontest'       => '',
        ]);

        ResultProject::where('id', $resultproject->id)
            ->update([
                'is_active'     => 'winner',
            ]);

        Worker::where('user_id',$resultproject->user_id_worker)
                ->update([
                    'earning' => $earning,
                ]);

        Project::where('id', $resultproject->contest_id)
            ->update([
                'is_active' => 'handover',
            ]);

        Mail::to($worker->email)->send(new WinnerChooseMail($resultproject->contest_id, $worker->role));
        Mail::to(request()->user()->email)->send(new WinnerChooseMail($resultproject->contest_id, request()->user()->role));

        return redirect()->back()->with('status', 'Choose Winner Berhasil');
    }
}
