<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Report;
use App\Models\ResultContest;
use App\Models\ResultProject;
use App\Models\SortCatagories;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class BrowseProjectController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Browser Project';
        $sort = null;
        if ($request->id != null) {
            $id     = Crypt::decrypt($request->id);
            $sort   = $id;
        }
        if (request()->user()->role == 'admin' || request()->user()->role == 'customer') {
            if ($request->id != null) {
                if ($id == 1) {
                    $data['project']    = Project::orderBy('created_at','desc')->where('is_active', 'running')->paginate(20);
                }elseif ($id == 2) {
                    $data['project']    = Project::orderBy('deadline','desc')->where('is_active', 'running')->paginate(20);
                }elseif ($id == 3) {
                    $data['project']    = Project::orderBy('submit','desc')->where('is_active', 'running')->paginate(20);
                }elseif ($id == 4) {
                    $data['project']    = Project::orderBy('harga','desc')->where('is_active', 'running')->paginate(20);
                }elseif ($id == 5) {
                    $data['project']    = Project::orderBy('nilai','desc')->where('is_active', 'running')->paginate(20);
                }elseif ($id == 6) {
                    $data['project']    = Project::where('is_active', 'running')->paginate(20);
                }elseif ($id == 7) {
                    $data['project']    = Project::where('is_active', 'close')->paginate(20);
                }elseif ($id == 8) {
                    $data['project']    = Project::where('is_active', 'running')->paginate(20);
                }else{
                    $data['project']    = Project::where('guarded', 'active')->paginate(20);
                }
            } else {
                $data['project']        = Project::where('is_active', 'running')->paginate(20);
            }
            $data['data']               = Project::where('is_active', 'running')->get();
            $data['totalproject']       = Project::where('is_active', 'running')->count();
            $data['totalcloseproject']  = Project::where('is_active', 'close')->count();
            $data['sortcatagories']     = SortCatagories::all();
        } else {
            $worker = Worker::where('user_id',request()->user()->id)->first();
            if ($worker->status_account == 'verified') {
                if ($request->id != null) {
                    if ($id == 1) {
                        $data['project']    = Project::orderBy('created_at', 'desc')->where('is_active', 'running')->paginate(20);
                    } elseif ($id == 2) {
                        $data['project']    = Project::orderBy('deadline', 'desc')->where('is_active', 'running')->paginate(20);
                    } elseif ($id == 3) {
                        $data['project']    = Project::orderBy('submit', 'desc')->where('is_active', 'running')->paginate(20);
                    } elseif ($id == 4) {
                        $data['project']    = Project::orderBy('harga', 'desc')->where('is_active', 'running')->paginate(20);
                    } elseif ($id == 5) {
                        $data['project']    = Project::orderBy('nilai', 'desc')->where('is_active', 'running')->paginate(20);
                    } elseif ($id == 6) {
                        $data['project']    = Project::where('is_active', 'running')->paginate(20);
                    } elseif ($id == 7) {
                        $data['project']    = Project::where('is_active', 'close')->paginate(20);
                    } elseif ($id == 8) {
                        $data['project']    = Project::where('is_active', 'running')->paginate(20);
                    } else {
                        $data['project']    = Project::where('guarded', 'active')->paginate(20);
                    }
                } else {
                    $data['project']        = Project::where('is_active', 'running')->paginate(20);
                }
                $data['data']               = Project::where('is_active', 'running')->get();
                $data['totalproject']       = Project::where('is_active', 'running')->count();
                $data['totalcloseproject']  = Project::where('is_active', 'close')->count();
                $data['sortcatagories']     = SortCatagories::all();
            } else {
                if ($request->id != null) {
                    if ($id == 1) {
                        $data['project']    = Project::orderBy('created_at', 'desc')->where('is_active', 'running')->where('catagories_project','contest')->paginate(20);
                    } elseif ($id == 2) {
                        $data['project']    = Project::orderBy('deadline', 'desc')->where('is_active', 'running')->where('catagories_project','contest')->paginate(20);
                    } elseif ($id == 3) {
                        $data['project']    = Project::orderBy('submit', 'desc')->where('is_active', 'running')->where('catagories_project','contest')->paginate(20);
                    } elseif ($id == 4) {
                        $data['project']    = Project::orderBy('harga', 'desc')->where('is_active', 'running')->where('catagories_project','contest')->paginate(20);
                    } elseif ($id == 5) {
                        $data['project']    = Project::orderBy('nilai', 'desc')->where('is_active', 'running')->where('catagories_project','contest')->paginate(20);
                    } elseif ($id == 6) {
                        $data['project']        = Project::where('is_active', 'running')->where('catagories_project', 'contest')->paginate(20);
                    } elseif ($id == 7) {
                        $data['project']    = Project::where('is_active', 'close')->where('catagories_project','contest')->paginate(20);
                    } elseif ($id == 8) {
                        $data['project']        = Project::where('is_active', 'running')->where('catagories_project', 'contest')->paginate(20);
                    } else {
                        $data['project']    = Project::where('guarded', 'active')->where('catagories_project','contest')->paginate(20);
                    }
                } else {
                    $data['project']        = Project::where('is_active', 'running')->where('catagories_project','contest')->paginate(20);
                }
                $data['data']               = Project::where('catagories_project','contest')->where('is_active', 'running')->get();
                $data['totalproject']       = Project::where('catagories_project','contest')->where('is_active', 'running')->count();
                $data['totalcloseproject']  = Project::where('catagories_project','contest')->where('is_active', 'close')->count();
                $data['sortcatagories']     = SortCatagories::where('name','!=','Direct Project')->get();
            }
        }
        return view('home.browseproject',$data,compact('sort'));
    }
    public function BriefContestProject(Request $request)
    {
        $data['title']      = 'Brieft Contest Project';
        $project            = Project::where('id',Crypt::decrypt($request->project))->first();
        $data['winner']     = ResultContest::where('contest_id',$project->id)->where('is_active','winner')->first();
        $data['report']     = Report::where('contest_id',$project)->count();
        return view('customer.projectstatus.briefcontest',compact('project'),$data);
    }
    public function BriefDirectProject(Request $request)
    {
        $data['title']      = 'Brieft Direct Project';
        $project            = Project::where('id',Crypt::decrypt($request->project))->first();
        $data['winner']     = ResultProject::where('contest_id',$project->id)->where('is_active','winner')->first();
        $data['report']     = Report::where('contest_id',$project)->count();
        return view('customer.projectstatus.briefdirect',compact('project'),$data);
    }
}
