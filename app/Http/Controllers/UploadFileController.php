<?php

namespace App\Http\Controllers;

use App\Models\NewsFeed;
use App\Models\UploadFile;
use App\Models\WinnerContest;
use Illuminate\Http\Request;

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

        NewsFeed::create([
            'contest_id'    => $winnercontest->contest_id,
            'user_id_from'  => request()->user()->id,
            'user_id_to'    => $winnercontest->user_id,
            'feedback'      => 'Upload File Handover Success By' . $winnercontest->user_id_worker,
            'choices'       => 'Handover',
        ]);
        return redirect()->back();
    }
}
