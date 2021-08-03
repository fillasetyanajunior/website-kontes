<?php

namespace App\Http\Controllers;

use App\Models\DetailContest;
use App\Models\DetailProject;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function StoreProject(Request $request)
    {
        $id  =  Project::create([
                    'user_id'               => request()->user()->id,
                    'title'                 => $request->title,
                    'catagories_project'    => $request->catagories_project,
                    'is_active'             => 'waiting payment',
                    'deadline'              => $request->deadline,
                ]);
        if ($request->catagories_project == 'contest') {
            DetailContest::create();
        } else {
            DetailProject::create();
        }
        return redirect()->back()->with('status','Add' . $request->catagories_project . 'project success');

    }
}
