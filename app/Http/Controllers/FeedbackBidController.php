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
use Illuminate\Support\Facades\Http;
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

            $worker = User::where('id',$feedbackbis->worker_id)->first();

            if ($worker != null) {
                NewsFeed::create([
                    'contest_id'    => $resultproject->contest_id,
                    'user_id_from'  => request()->user()->id,
                    'user_id_to'    => $feedbackbis->worker_id,
                    'feedback'      => $request->feedback,
                    'choices'       => 'feedback',
                ]);

                Mail::to($worker->email)->send(new FeedbackMail($request->feedback,$project->title));
            } else {
                $admin = User::where('role','admin')->get();
                for ($i=0; $i < count($admin); $i++) {
                    foreach ($admin as $itemadmin) {
                        NewsFeed::create([
                            'contest_id'    => $resultproject->contest_id,
                            'user_id_from'  => request()->user()->id,
                            'user_id_to'    => $itemadmin->id,
                            'feedback'      => $request->feedback,
                            'choices'       => 'feedback',
                        ]);
                        Mail::to($itemadmin->email)->send(new FeedbackMail($request->feedback,$project->title));
                        // Http::post(env('API_WHATSAPP_URL') . 'send-message', [
                        //     'number' => $admin->phone,
                        //     'message' =>    'You get feedback from the Direct ' . $project->title
                        // ]);
                    }
                }
            }
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
            // Http::post(env('API_WHATSAPP_URL') . 'send-message', [
            //     'number' => $customer->phone,
            //     'message' =>    'You get feedback from the Direct ' . $project->title
            // ]);
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

        $guarded = ResultProject::where('nilai', 5)->orWhere('nilai',4)->count('nilai');

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

        $project = Project::where('id', $resultproject->contest_id)->first();

        $worker = User::where('id', $resultproject->user_id_worker)->first();

        if ($worker != null) {
            Mail::to($worker->email)->send(new EliminasiMail($resultproject->contest_id, $worker->role));
            Mail::to(request()->user()->email)->send(new EliminasiMail($resultproject->contest_id, request()->user()->role));
            // Http::post(env('API_WHATSAPP_URL') . 'send-message', [
            //     'number' => request()->user()->phone,
            //     'message' =>    'Thank you for eliminating participants ' . $project->title
            // ]);

            NewsFeed::create([
                'contest_id'    => $resultproject->contest_id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $resultproject->user_id_worker,
                'choices'       => 'eliminasi',
            ]);
        } else {
            $admin = User::where('role','admin')->get();
            for ($i=0; $i < count($admin); $i++) {
                foreach ($admin as $itemadmin) {
                    Mail::to($itemadmin->email)->send(new EliminasiMail($resultproject->contest_id, $itemadmin->role));
                    // Http::post(env('API_WHATSAPP_URL') . 'send-message', [
                    //     'number' => $admin->phone,
                    //     'message' =>    'Sorry you were eliminated from ' . $project->title
                    // ]);

                    NewsFeed::create([
                        'contest_id'    => $resultproject->contest_id,
                        'user_id_from'  => request()->user()->id,
                        'user_id_to'    => $itemadmin->id,
                        'choices'       => 'eliminasi',
                    ]);
                }
            }
            Mail::to(request()->user()->email)->send(new EliminasiMail($resultproject->contest_id, request()->user()->role));
            // Http::post(env('API_WHATSAPP_URL') . 'send-message', [
            //     'number' => request()->user()->phone,
            //     'message' =>    'Thank you for eliminating participants ' . $project->title
            // ]);
        }

        return redirect()->back()->with('status', 'Update Direct Success');
    }
    public function StoreWinner(ResultProject $resultproject)
    {
        $project = Project::where('id',$resultproject->contest_id)->first();

        $worker = Worker::where('user_id', $resultproject->user_id_worker)->first();

        ResultProject::where('id', $resultproject->id)
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

            Mail::to($worker->email)->send(new WinnerChooseMail($resultproject->contest_id, $worker->role));
            Mail::to(request()->user()->email)->send(new WinnerChooseMail($resultproject->contest_id, request()->user()->role));
            // Http::post(env('API_WHATSAPP_URL') . 'send-message', [
            //     'number' => request()->user()->phone,
            //     'message' =>    'You have chosen ' . $worker->name . ' as the champion of the Direct ' . $project->title
            // ]);

            Worker::where('user_id',$resultproject->user_id_worker)
                    ->update([
                        'earning' => $earning,
                    ]);
        } else {
            $admin = User::where('role','admin')->get();
            for ($i=0; $i < count($admin); $i++) {
                foreach ($admin as $itemadmin) {
                    NewsFeed::create([
                        'contest_id'    => $resultproject->contest_id,
                        'user_id_from'  => request()->user()->id,
                        'user_id_to'    => $itemadmin->id,
                        'choices'       => 'pick winner',
                    ]);

                    WinnerContest::create([
                        'contest_id'        => $resultproject->contest_id,
                        'user_id'           => request()->user()->id,
                        'user_id_worker'    => $itemadmin->id,
                        'title'             => $project->title,
                        'filecontest'       => '',
                    ]);

                    Mail::to($itemadmin->email)->send(new WinnerChooseMail($resultproject->contest_id, $itemadmin->role));
                    // Http::post(env('API_WHATSAPP_URL') . 'send-message', [
                    //     'number' => $itemadmin->phone,
                    //     'message' =>    'Congratulations you are the champion of ' . $project->title
                    // ]);
                }
            }
            Mail::to(request()->user()->email)->send(new WinnerChooseMail($resultproject->contest_id, request()->user()->role));
            // Http::post(env('API_WHATSAPP_URL') . 'send-message', [
            //     'number' => request()->user()->phone,
            //     'message' =>    'You have chosen ' . $worker->name . ' as the champion of the Direct  ' . $project->title
            // ]);
        }

        Project::where('id', $resultproject->contest_id)
            ->update([
                'is_active' => 'handover',
            ]);


        return redirect()->back()->with('status', 'Choose Winner Berhasil');
    }
}
