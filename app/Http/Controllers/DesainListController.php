<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DesainListController extends Controller
{
    public function DesainList()
    {
        if (request()->user()->role == 'admin') {
            $data['desaincard'] = Project::where('desaincard','active')->paginate(20);
        }elseif (request()->user()->role == 'customer') {
            $data['desaincard'] = Project::where('desaincard','active')->where('user_id',request()->user()->id)->paginate(20);
        }else {
            $data['desaincard'] = DB::table('projects')
                                    ->join('result_contests','projects.id','result_contests.contest_id')
                                    ->select('pilihandesain','projects.title','desaincard','user_id_worker')
                                    ->where('desaincard','active')
                                    ->where('user_id_worker',request()->user()->id)
                                    ->paginate(20);
        }
        return view('desaincard.desaincard',$data);
    }
}
