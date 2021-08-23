<?php

namespace App\Http\Controllers;

use App\Models\Catagories;
use App\Models\DetailContest;
use App\Models\DetailProject;
use App\Models\JobCatagories;
use App\Models\OpsiPackage;
use App\Models\OpsiPackageUpgrade;
use App\Models\Project;
use App\Models\ResultContest;
use App\Models\ResultProject;
use App\Models\SortCatagories;
use App\Models\SubCatagories;
use Illuminate\Http\Request;

class BrowseProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->id != null) {
            if ($request->id == 1) {
                $data['project']    = Project::orderBy('created_at','desc')->where('is_active', 'running')->paginate(20);
            }elseif ($request->id == 2) {
                $data['project']    = Project::orderBy('deadline','desc')->where('is_active', 'running')->paginate(20);
            }elseif ($request->id == 3) {
                $data['project']    = Project::orderBy('submit','desc')->where('is_active', 'running')->paginate(20);
            }elseif ($request->id == 4) {
                $data['project']    = Project::orderBy('harga','desc')->where('is_active', 'running')->paginate(20);
            }elseif ($request->id == 5) {
                $data['project']    = Project::orderBy('nilai','desc')->where('is_active', 'running')->paginate(20);
            }elseif ($request->id == 7) {
                $data['project']    = Project::where('is_active', 'close')->paginate(20);
            }
        } else {
            $data['project']        = Project::where('is_active', 'running')->paginate(20);
        }
        $data['data']               = Project::where('is_active', 'running')->get();
        $data['totalproject']       = Project::where('is_active', 'running')->count();
        $data['totalcloseproject']  = Project::where('is_active', 'close')->count();
        $data['sortcatagories']     = SortCatagories::all();
        return view('home.browseproject',$data);
    }

    public function GalleryContestProject(Project $project)
    {
        if (request()->user()->role == 'customer' || request()->user()->role == 'admin') {
            $data['resultcontest'] = ResultContest::where('contest_id',$project->id)->get();
        } else {
            if($project->is_active == 'running'){
                $data['resultcontest'] = ResultContest::where('contest_id',$project->id)->where('user_id_worker',request()->user()->id)->get();
            }else {
                $data['resultcontest'] = ResultContest::where('contest_id',$project->id)->get();
            }
        }

        return view('customer.projectstatus.gallerycontestproject',$data,compact('project'));
    }

    public function BriefContestProject(Project $project)
    {
        $detail = DetailContest::where('project_id',$project->id)->first();
        $data['detailcontest'] = DetailContest::where('project_id',$project->id)->first();
        $data['catagories'] = Catagories::where('id',$detail->catagories)->first();
        $data['subcatagories'] = SubCatagories::where('id',$detail->subcatagories)->first();
        $data['opsi'] = OpsiPackage::where('id',$detail->package)->first();
        if ($detail->packageupgrade != null) {
            $data['opsiupgrade'] = OpsiPackageUpgrade::where('id', $detail->packageupgrade)->first();
        }
        return view('customer.projectstatus.briefcontest',compact('project'),$data);
    }
    public function BriefDirectProject(Project $project)
    {
        $detail = DetailProject::where('project_id',$project->id)->first();
        $data['detaildirect'] = DetailProject::where('project_id',$project->id)->first();
        $data['jobdescription'] = JobCatagories::where('id',$detail->job_description)->first();
        return view('customer.projectstatus.briefdirect',compact('project'),$data);
    }

    public function GalleryDirectProject(Project $project)
    {
        if (request()->user()->role == 'customer' || request()->user()->role == 'admin') {
            $data['resultdirect'] = ResultProject::where('contest_id',$project->id)->get();
        } else {
            if ($project->is_active == 'running') {
                $data['resultdirect'] = ResultProject::where('contest_id',$project->id)->where('user_id_worker', request()->user()->id)->get();
            } else {
                $data['resultdirect'] = ResultProject::where('contest_id',$project->id)->get();
            }
        }
        return view('customer.projectstatus.gallerydirectproject',$data, compact('project'));
    }

}
