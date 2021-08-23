<?php

namespace App\Http\Controllers;

use App\Models\MessageHandover;
use App\Models\Project;
use App\Models\WinnerContest;
use Illuminate\Http\Request;

class HandoverController extends Controller
{
    public function HandoverIndex(Project $project)
    {
        $data['handover'] = WinnerContest::where('contest_id',$project->id)->first();
        if (request()->user()->role == 'admin') {
            $data['message']     = MessageHandover::where('result_id',$project->id)->get();
        }else if (request()->user()->role == 'customer') {
            $data['message']     = MessageHandover::where('customer_id',request()->user()->id)->where('result_id',$project->id)->get();
        } else {
            $data['message']     = MessageHandover::where('worker_id',request()->user()->id)->where('result_id',$project->id)->get();
        }

        return view('customer.handover.handover',$data,compact('project'));
    }
    public function HandoverConfirm(Project $project)
    {
        Project::where('id',$project->id)
                ->update([
                    'is_active' => 'close'
                ]);
        return redirect()->back()->with('status','Project Berhasil Di Confirm');
    }
    public function UploadLogoText(Request $request,WinnerContest $winnercontest)
    {
        $file = $request->file('fileupload');
        $file->storeAs('logotext', $file->getClientOriginalName());
        WinnerContest::where('id',$winnercontest->id)
                    ->update([
                        'logotext'  => $file->getClientOriginalName()
                    ]);
        return redirect()->back()->with('status','Upload Logo + Text Berhasil');
    }
    public function UploadLogo(Request $request,WinnerContest $winnercontest)
    {
        $file = $request->file('fileupload');
        $file->storeAs('logo', $file->getClientOriginalName());
        WinnerContest::where('id',$winnercontest->id)
        ->update([
            'logo'  => $file->getClientOriginalName()
        ]);
        return redirect()->back()->with('status','Upload Logo Berhasil');
    }
    public function UpdateFontColor(WinnerContest $winnercontest,Request $request)
    {
        WinnerContest::where('id',$winnercontest->id)
                    ->update([
                        'hexa_color'    => $request->hexa_color,
                        'rgb_color'     => $request->rgb_color,
                        'font'          => $request->font,
                    ]);
        return redirect()->back()->with('status','Color & Font Berhasil di Tambah');
    }
}
