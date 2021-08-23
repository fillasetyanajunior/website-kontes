<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ResultContest;
use App\Models\ResultProject;
use Illuminate\Http\Request;

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

        $datetime = ResultContest::create([
            'contest_id'    => $request->id,
            'user_id_worker'=> request()->user()->id,
            'title'         => $request->title,
            'filecontest'   => $name,
            'is_active'     => 'active',
        ]);

        Project::where('id',$request->id)
                ->update([
                    'submit' => $datetime->created_at,
                ]);
        return redirect()->back()->with('status', 'Submit Contest Success');
    }
    public function createSubmitDirect(Request $request)
    {
        $request->validate([
            'description'   => 'required',
        ]);

        $datetime = ResultProject::create([
            'contest_id'    => $request->id,
            'user_id_worker'=> request()->user()->id,
            'description'   => $request->description,
        ]);
        Project::where('id', $request->id)
            ->update([
                'submit' => $datetime->created_at,
            ]);
        return redirect()->back()->with('status', 'Submit Direct Success');
    }
}
