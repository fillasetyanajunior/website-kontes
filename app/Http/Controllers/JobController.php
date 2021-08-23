<?php

namespace App\Http\Controllers;

use App\Models\JobCatagories;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function StoreJob(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        JobCatagories::create($request->all());

        return redirect()->back()->with('status','Job Description Berhasil Input');
    }
    public function EditJob(JobCatagories $jobcatagories)
    {
        return response()->json([
            'jobcatagories' => $jobcatagories
        ]);
    }
    public function UpdateJob(Request $request,JobCatagories $jobcatagories)
    {
        JobCatagories::where('id',$jobcatagories->id)
        ->update($request->all());
        return redirect()->back()->with('status','Job Description berhasil Di Update');
    }
    public function DeleteJob(JobCatagories $jobcatagories)
    {
        JobCatagories::destroy($jobcatagories->id);
        return redirect()->back()->with('status','Job Description berhasil Di Delete');
    }
}
