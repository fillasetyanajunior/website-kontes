<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaittingpaymentController extends Controller
{
    public function GetData()
    {
        $data['title']          = 'Waiting Payment';
        $data['paymentlist']    = DB::table('projects')
                                ->join('project_payments','projects.id','=','project_payments.project_id')
                                ->paginate(20);
        return view('admin.paymenthistory.paymentlist',$data);
    }
    public function ConfirmPayment(Project $project)
    {
        Project::where('id',$project->id)
                ->update([
                    'deadline'  => date('Y-m-d', strtotime('+' . $project->hari . ' days')),
                    'is_active' => 'running',
                ]);
        return redirect('/home')->with('status','Project Berhasil Di Berjalan');
    }
}
