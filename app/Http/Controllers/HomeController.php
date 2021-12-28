<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Project;
use App\Models\Worker;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }
    public function index()
    {
        $data['title'] = 'Home';
        if (request()->user()->role == 'admin') {
            $data['project']                    = Project::paginate(20);
            $data['waittingpayment']            = Project::where('is_active', 'waiting payment')->count();
            $data['projectrunning']             = Project::where('is_active','running')->count();
            $data['choosewinner']               = Project::where('is_active','choose winner')->count();
            $data['projecthandover']            = Project::where('is_active','handover')->count();
            $data['mediation']                  = Project::where('is_active','mediation')->count();
            $data['projectcancel']              = Project::where('is_active','cancel')->count();
            $data['projectlocked']              = Project::where('is_active','cancel')->count();
            $data['projectclose']               = Project::where('is_active','close')->count();
            $data['accountworker']              = Worker::count();
            $data['accountworker']              = Customer::count();
            return view('admin.dashboard_admin',$data);
        }elseif (request()->user()->role == 'customer') {
            $data['project']                    = Project::where('user_id', request()->user()->id)->paginate(20);
            $data['totalprojectcancel']         = Project::where('user_id', request()->user()->id)->where('is_active', 'cancel')->count();
            $data['totalprojectsuccess']        = Project::where('user_id', request()->user()->id)->where('is_active', 'close')->count();
            $data['totalprojectrunning']        = Project::where('user_id', request()->user()->id)->where('is_active', 'running')->count();
            $data['totalhargaprojectrunning']   = Project::where('user_id', request()->user()->id)->where('is_active', 'running')->sum('harga');
            return view('customer.dashboard_customer',$data);
        } else {
            $data['project']                    = Project::paginate(20);
            $data['projects']                   = Project::first();
            return view('worker.dashboard_worker',$data);
        }

    }
}
