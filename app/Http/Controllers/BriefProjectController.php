<?php

namespace App\Http\Controllers;

use App\Models\DetailContest;
use App\Models\DetailProject;
use App\Models\Project;
use Illuminate\Http\Request;

class BriefProjectController extends Controller
{
    public function DeleteContest(Project $project)
    {
        Project::destroy($project->id);
        DetailContest::where('project_id',$project->id)->delete();
        return redirect('/home')->with('status','Project Berhasil Di Hapus');
    }
    public function ExtendedContest(Project $project,Request $request)
    {
        $request->validate([
            'extended' => 'required'
        ]);

        Project::where('id',$project->id)
                ->update([
                    'deadline' => date('Y-m-d', strtotime('+' . $request->extended . 'days', strtotime($project->deadline))),
                ]);
        return redirect()->back()->with('status','Extended Deadline Berhasil Di Update');
    }
    public function LockedContest(Project $project)
    {
        Project::where('id',$project->id)
                ->update([
                    'is_active' => 'cancel',
                ]);
        return redirect()->back()->with('status','Project Berhasil Di Locked');
    }
    public function DeleteDirect(Project $project)
    {
        Project::destroy($project->id);
        DetailProject::where('project_id',$project->id)->delete();
        return redirect('/home')->with('status','Project Berhasil Di Hapus');
    }
    public function ExtendedDirect(Project $project,Request $request)
    {
        // dd(date('Y-m-d', strtotime('+' . $request->extended . 'days', strtotime($project->deadline))));
        $request->validate([
            'extended' => 'required'
        ]);

        Project::where('id',$project->id)
                ->update([
                    'deadline' => date('Y-m-d', strtotime('+' . $request->extended . 'days', strtotime($project->deadline))),
                ]);
        DetailProject::where('project_id',$project->id)
                    ->update([
                        'hari' => $request->extended,
                    ]);
        return redirect()->back()->with('status','Extended Deadline Berhasil Di Update');
    }
    public function LockedDirect(Project $project)
    {
        Project::where('id',$project->id)
                ->update([
                    'is_active' => 'cancel',
                ]);
        return redirect()->back()->with('status','Project Berhasil Di Locked');
    }
}
