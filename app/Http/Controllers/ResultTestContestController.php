<?php

namespace App\Http\Controllers;

use App\Mail\DeleteResultTestMail;
use App\Models\NewsFeed;
use App\Models\Project;
use App\Models\Rating;
use App\Models\ResultContest;
use App\Models\ResultTestContest;
use App\Models\SuspendAccount;
use App\Models\User;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ResultTestContestController extends Controller
{
    public function ResultTestIndex()
    {
        $data['testcontest'] = DB::table('result_test_contests')
                                ->select('user_id_worker')
                                ->distinct()
                                ->simplePaginate(1);
        return view('admin.testcontest.testcontest',$data);
    }
    public function UpdateTestContest(Request $request)
    {
        $testresult = ResultTestContest::where('user_id_worker',$request->user_id_worker)->get();
        foreach ($testresult as $itemtestresult) {
            $user = Project::where('id', $itemtestresult->contest_id)->first();

            NewsFeed::create([
                'contest_id'    => $itemtestresult->contest_id,
                'user_id_from'  => $itemtestresult->user_id_worker,
                'user_id_to'    => $user->user_id,
                'filecontest'   => $itemtestresult->filecontest,
                'choices'       => 'submit'
            ]);

            $datetime = ResultContest::create([
                'contest_id'    => $itemtestresult->contest_id,
                'user_id_worker'=> $itemtestresult->user_id_worker,
                'title'         => $itemtestresult->title,
                'filecontest'   => $itemtestresult->filecontest,
                'is_active'     => 'active',
                'portfolio'     => $itemtestresult->portfolio,
            ]);

            Project::where('id', $itemtestresult->id)
                ->update([
                    'submit' => $datetime->created_at,
                ]);
        }
        Worker::where('id', $request->user_id_worker)
            ->update([
                'status_account' => 'verified',
            ]);

        $user = User::where('id',$request->user_id_worker)->first();
        Http::post(env('API_WHATSAPP_URL') . 'send-message', [
            'number' => $user->phone,
            'message' =>    'Congratulations, you have passed the test and your account has been verified'
        ]);

        ResultTestContest::where('user_id_worker',$request->user_id_worker)->delete();
        return redirect()->back()->with('status', 'Account Success verified');
    }
    public function ViewAccount(Request $request)
    {
        $request->only('user_id_worker');
        $worker     = Worker::where('user_id', $request->user_id_worker)->first();
        $rating     = Rating::where('user_id_worker', $request->user_id_worker)->count();
        $user       = User::where('id', $request->user_id_worker)->first();
        $suspend    = SuspendAccount::where('user_id', $request->user_id_worker)->count();
        if (Cache::has('user-is-online-' . $user->id)) {
            $status =  "Online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans();
        } else {
            $status = "Offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans();
        }
        return response()->json([
            'worker'    => $worker,
            'rating'    => $rating,
            'status'    => $status,
            'user'      => $user,
            'suspend'   => $suspend,
        ]);
    }
    public function ViewProject(Request $request)
    {
        $request->only('user_id_worker');
        $resultproject  = ResultTestContest::orderBy('created_at','DESC')->where('user_id_worker', $request->user_id_worker)->get();
        return response()->json([
            'resultproject' => $resultproject,
        ]);
    }
    public function DeleteResultTestContest(ResultTestContest $resultTestContest)
    {
        $worker = Worker::where('user_id',$resultTestContest->user_id_worker)->first();
        Mail::to($worker->email)->send(new DeleteResultTestMail($resultTestContest->filecontest));
        $user = User::where('id', $worker->user_id)->first();
        Http::post(env('API_WHATSAPP_URL') . 'send-message', [
            'number' => $user->phone,
            'message' =>    'sorry your design was rejected, please submit 1 more design'
        ]);

        Storage::delete('resultcontest/', $resultTestContest->filecontest);
        ResultTestContest::destroy($resultTestContest->id);
        return redirect()->back()->with('status','Result Success Delete');
    }
}
