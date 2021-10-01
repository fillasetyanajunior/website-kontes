<?php

namespace App\Http\Controllers;

use App\Mail\EliminasiMail;
use App\Mail\FeedbackMail;
use App\Mail\WinnerChooseMail;
use App\Models\Feedback;
use App\Models\NewsFeed;
use App\Models\Project;
use App\Models\ResultContest;
use App\Models\User;
use App\Models\WinnerContest;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $project = Project::where('id', $resultcontest->contest_id)->first();
        if (request()->user()->role == 'customer') {
            $feedback = Feedback::create([
                'result_id'         => $resultcontest->id,
                'worker_id'         => $resultcontest->user_id_worker,
                'customer_id'       => request()->user()->id,
                'feedback_customer' => $request->feedback,
            ]);

            $worker = User::where('id', $feedback->worker_id)->first();

            if ($worker != null) {
                NewsFeed::create([
                    'contest_id'    => $resultcontest->contest_id,
                    'user_id_from'  => request()->user()->id,
                    'user_id_to'    => $feedback->worker_id,
                    'feedback'      => $request->feedback,
                    'choices'       => 'feedback',
                ]);

                Mail::to($worker->email)->send(new FeedbackMail($request->feedback, $project->title));
            } else {
                $admin = User::where('role','admin')->get();
                for ($i=0; $i < count($admin); $i++) {
                    foreach ($admin as $itemadmin) {
                        NewsFeed::create([
                            'contest_id'    => $resultcontest->contest_id,
                            'user_id_from'  => request()->user()->id,
                            'user_id_to'    => $itemadmin->id,
                            'feedback'      => $request->feedback,
                            'choices'       => 'feedback',
                        ]);
                        Mail::to($itemadmin->email)->send(new FeedbackMail($request->feedback, $project->title));
                    }
                }
            }
        } else {
            $feedback = Feedback::create([
                'result_id'         => $resultcontest->id,
                'worker_id'         => request()->user()->id,
                'customer_id'       => $project->user_id,
                'feedback_worker'   => $request->feedback,
            ]);

            NewsFeed::create([
                'contest_id'    => $resultcontest->contest_id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $feedback->customer_id,
                'feedback'      => $request->feedback,
                'choices'       => 'feedback',
            ]);

            $customer = User::where('id', $feedback->customer_id)->first();
            Mail::to($customer->email)->send(new FeedbackMail($request->feedback, $project->title));
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

        NewsFeed::create([
            'contest_id'    => $resultcontest->contest_id,
            'user_id_from'  => request()->user()->id,
            'user_id_to'    => $resultcontest->user_id_worker,
            'filecontest'   => $resultcontest->filecontest,
            'rating'        => $request->nilai,
            'choices'       => 'rating',
        ]);

        $nilai = ResultContest::groupBy('contest_id')->sum('nilai');

        $guarded = ResultContest::where('nilai',5)->orWhere('nilai', 4)->count('nilai');

        if ($guarded == 3 || $guarded >= 3) {
            Project::where('id', $resultcontest->contest_id)
                ->update([
                    'guarded' => 'active'
                ]);
        }

        Project::where('id',$resultcontest->contest_id)
                ->update([
                    'nilai' => $nilai
                ]);
        return response()->json([
            'status' => 200,
            'nilai'  => $guarded,
        ]);
    }
    public function EliminasiPeserta(ResultContest $resultcontest)
    {
        ResultContest::where('id', $resultcontest->id)
            ->update([
                'is_active'     => 'eliminasi',
            ]);

        $worker = User::where('id',$resultcontest->user_id_worker)->first();

        if ($worker != null) {
            Mail::to($worker->email)->send(new EliminasiMail($resultcontest->contest_id,$worker->role));
            Mail::to(request()->user()->email)->send(new EliminasiMail($resultcontest->contest_id, request()->user()->role));

            NewsFeed::create([
                'contest_id'    => $resultcontest->contest_id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $resultcontest->user_id_worker,
                'filecontest'   => $resultcontest->filecontest,
                'choices'       => 'eliminasi',
            ]);
        } else {

            $admin = User::where('role','admin')->get();

            for ($i=0; $i < count($admin); $i++) {
                foreach ($admin as $itemadmin) {
                    Mail::to($itemadmin->email)->send(new EliminasiMail($resultcontest->contest_id,$itemadmin->role));

                    NewsFeed::create([
                        'contest_id'    => $resultcontest->contest_id,
                        'user_id_from'  => request()->user()->id,
                        'user_id_to'    => $itemadmin->id,
                        'filecontest'   => $resultcontest->filecontest,
                        'choices'       => 'eliminasi',
                    ]);
                }
            }
            Mail::to(request()->user()->email)->send(new EliminasiMail($resultcontest->contest_id, request()->user()->role));

        }

        return redirect()->back()->with('status', 'Update Contest Success');
    }
    public function StoreWinner(ResultContest $resultcontest)
    {
        $project = Project::where('id', $resultcontest->contest_id)->first();

        $worker = User::where('id', $resultcontest->user_id_worker)->first();

        ResultContest::where('id', $resultcontest->id)
            ->update([
                'is_active'     => 'winner',
            ]);

        if ($worker != null) {
            if ($worker->earning == 0) {
                $earning = $project->harga;
            } else {
                $earning = $project->harga + $worker->earning;
            }

            NewsFeed::create([
                'contest_id'    => $resultcontest->contest_id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $resultcontest->user_id_worker,
                'filecontest'   => $resultcontest->filecontest,
                'choices'       => 'pick winner',
            ]);

            WinnerContest::create([
                'contest_id'        => $resultcontest->contest_id,
                'user_id'           => $project->user_id,
                'user_id_worker'    => $resultcontest->user_id_worker,
                'title'             => $project->title,
                'filecontest'       => $resultcontest->filecontest,
            ]);


            Mail::to($worker->email)->send(new WinnerChooseMail($resultcontest->contest_id, $worker->role));
            Mail::to(request()->user()->email)->send(new WinnerChooseMail($resultcontest->contest_id, request()->user()->role));

            Worker::where('user_id', $resultcontest->user_id_worker)
                ->update([
                    'earning' => $earning,
                ]);
        } else {
            $admin = User::where('role','admin')->get();

            for ($i=0; $i < count($admin); $i++) {
                foreach ($admin as $itemadmin) {
                    NewsFeed::create([
                        'contest_id'    => $resultcontest->contest_id,
                        'user_id_from'  => request()->user()->id,
                        'user_id_to'    => $itemadmin->id,
                        'filecontest'   => $resultcontest->filecontest,
                        'choices'       => 'pick winner',
                    ]);

                    WinnerContest::create([
                        'contest_id'        => $resultcontest->contest_id,
                        'user_id'           => $project->user_id,
                        'user_id_worker'    => $itemadmin->id,
                        'title'             => $project->title,
                        'filecontest'       => $resultcontest->filecontest,
                    ]);

                    Mail::to($itemadmin->email)->send(new WinnerChooseMail($resultcontest->contest_id, $itemadmin->role));
                }
            }
            Mail::to(request()->user()->email)->send(new WinnerChooseMail($resultcontest->contest_id, request()->user()->role));
        }

        Project::where('id', $resultcontest->contest_id)
            ->update([
                'is_active' => 'handover',
            ]);

        return redirect()->back()->with('status', 'Choose Winner Berhasil');
    }
}
