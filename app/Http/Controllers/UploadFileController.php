<?php

namespace App\Http\Controllers;

use App\Mail\UploadFileHandoverMail;
use App\Models\NewsFeed;
use App\Models\Project;
use App\Models\UploadFile;
use App\Models\User;
use App\Models\WinnerContest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class UploadFileController extends Controller
{
    public function Uploadfile(Request $request)
    {
        // dd($request->file('fileupload')->getSize());
        foreach ($request->file('fileupload') as $file) {
            $file->storeAs('fileuploads/AllFile' . $request->id, $file->getClientOriginalName());

            UploadFile::create([
                'contest_id_winner' => $request->id,
                'name'              => $file->getClientOriginalName(),
                'kapasitas'         => $file->getSize(),
            ]);
        }

        $winnercontest = WinnerContest::where('id',$request->id)->first();

        $users = User::where('id', $winnercontest->user_id_worker)->first();

        NewsFeed::create([
            'contest_id'    => $winnercontest->contest_id,
            'user_id_from'  => request()->user()->id,
            'user_id_to'    => $winnercontest->user_id,
            'feedback'      => 'Upload File Handover Success By' . $users->name,
            'choices'       => 'Handover',
        ]);

        $user = User::where('id', $winnercontest->user_id)->first();

        $project = Project::where('id',$winnercontest->contest_id)->first();

        Mail::to($user->email)->send(new UploadFileHandoverMail($request->id,$project->title));
        // Http::post(env('API_WHATSAPP_URL') . 'send-message', [
        //     'number' => $user->phone,
        //     'message' =>    'the handover file has been uploaded, please check the handover contest'
        // ]);

        return redirect()->back();
    }
    public function DeleteFileUpload(UploadFile $uploadfile)
    {
        UploadFile::destroy($uploadfile->id);
        return redirect()->back()->with('status','File Delete Success');
    }
}
