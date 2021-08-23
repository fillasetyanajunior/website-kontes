<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Project;
use App\Models\ResultContest;
use App\Models\User;
use App\Models\WinnerContest;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function GetData(ResultContest $resultcontest)
    {
        $user       = User::where('id', $resultcontest->user_id_worker)->first();
        $feedback   = Feedback::where('result_id', $resultcontest->id)->get();
        $project    = Project::where('id',$resultcontest->contest_id)->first();
        return response()->json([
            'resultcontest' => $resultcontest,
            'project'       => $project,
            'user'          => $user,
            'feedback'      => $feedback,
        ]);
    }
    public function KirimFeedback(Request $request, ResultContest $resultcontest)
    {
        if (request()->user()->role == 'customer') {
            Feedback::create([
                'result_id'         => $resultcontest->id,
                'worker_id'         => $resultcontest->user_id_worker,
                'customer_id'       => request()->user()->id,
                'feedback_customer' => $request->feedback,
            ]);
        } else {
            $project = Project::where('id', $resultcontest->contest_id)->first();
            Feedback::create([
                'result_id'         => $resultcontest->id,
                'worker_id'         => request()->user()->id,
                'customer_id'       => $project->user_id,
                'feedback_worker'   => $request->feedback,
            ]);
        }
        return redirect()->back()->with('status','Feedback Berhasil di kirim');
    }
    public function UserFeedback(ResultContest $resultcontest, Request $request)
    {
        if ($request->role_user == 'customer') {
            $user = Project::where('id',$resultcontest->contest_id)->first();
            $data = User::where('id', $user->user_id)->first();
        } else {
            $data = User::where('id', $resultcontest->user_id_worker)->first();
        }

        return response()->json([
            'user'  => $data,
            'user2' => $request,
        ]);
    }
    public function NilaiContest(Request $request, ResultContest $resultcontest)
    {
        ResultContest::where('id', $resultcontest->id)
                    ->update([
                        'nilai' => $request->nilai
                    ]);
        $nilai = ResultContest::groupBy('contest_id')->sum('nilai');

        Project::where('id',$resultcontest->contest_id)
                ->update([
                    'nilai' => $nilai
                ]);
        return response()->json([
            'status' => 200,
            'nilai'  => $nilai,
        ]);
    }
    public function EliminasiPeserta(ResultContest $resultcontest)
    {
        ResultContest::where('id', $resultcontest->id)
            ->update([
                'is_active'     => 'eliminasi',
            ]);
        return redirect()->back()->with('status', 'Update Contest Success');
    }
    public function StoreWinner(ResultContest $resultcontest)
    {
        WinnerContest::create([
            'contest_id'        => $resultcontest->contest_id,
            'user_id'           => request()->user()->id,
            'user_id_worker'    => $resultcontest->user_id_worker,
            'title'             => $resultcontest->title,
            'filecontest'       => $resultcontest->filecontest,
        ]);

        Project::where('id', $resultcontest->contest_id)
            ->update([
                'is_active' => 'handover',
            ]);

        return redirect()->back()->with('status', 'Choose Winner Berhasil');
    }
}
