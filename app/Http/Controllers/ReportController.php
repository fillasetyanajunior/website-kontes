<?php

namespace App\Http\Controllers;

use App\Mail\ReportMail;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function ReportCreate(Request $request)
    {
        $admin  = User::where('role','admin')->first();
        $id = Report::create([
                    'contest_id'    => $request->id_project,
                    'type'          => $request->type,
                    'description'   => $request->description,
                    'link'          => $request->link,
                ]);
        Mail::to($admin->email)->send(new ReportMail($id->id, $request->idfrom));
        return redirect()->back()->with('status','Report Desain Success');
    }
}
