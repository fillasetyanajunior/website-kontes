<?php

namespace App\Http\Controllers;

use App\Models\FeedbackBid;
use App\Models\Project;
use App\Models\ResultProject;
use App\Models\User;
use App\Models\WinnerContest;
use Illuminate\Http\Request;

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
        if (request()->user()->role == 'customer') {
            FeedbackBid::create([
                'result_id'         => $resultproject->id,
                'worker_id'         => $resultproject->user_id_worker,
                'customer_id'       => request()->user()->id,
                'feedback_customer' => $request->feedback,
            ]);
        } else {
            $project = Project::where('id',$resultproject->contest_id)->first();
            FeedbackBid::create([
                'result_id'         => $resultproject->id,
                'worker_id'         => request()->user()->id,
                'customer_id'       => $project->user_id,
                'feedback_worker'   => $request->feedback,
            ]);
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
        $nilai = ResultProject::groupBy('contest_id')->sum('nilai');

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
        return redirect()->back()->with('status', 'Update Direct Success');
    }
    public function StoreWinner(ResultProject $resultproject)
    {
        WinnerContest::create([
            'contest_id'        => $resultproject->contest_id,
            'user_id'           => request()->user()->id,
            'user_id_worker'    => $resultproject->user_id_worker,
            'title'             => $resultproject->title,
            'filecontest'       => $resultproject->filecontest,
        ]);

        Project::where('id', $resultproject->contest_id)
            ->update([
                'is_active' => 'handover',
            ]);

        return redirect()->back()->with('status', 'Choose Winner Berhasil');
    }
}
