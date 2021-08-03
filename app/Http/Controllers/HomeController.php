<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }
    public function index()
    {
        if (request()->user()->role == 'admin') {

        }elseif (request()->user()->role == 'customer') {
            $data['project'] = Project::where('user_id', request()->user()->id)->paginate(20);
            $data['totalprojectcancel'] = Project::where('user_id', request()->user()->id)->where('is_active', 'cancel')->count();
            $data['totalprojectsuccess'] = Project::where('user_id', request()->user()->id)->where('is_active', 'close')->count();
            $data['totalprojectrunning'] = Project::where('user_id', request()->user()->id)->where('is_active', 'running')->count();
            return view('customer.dashboard_customer',$data);
        } else {
            # code...
        }

    }
}
