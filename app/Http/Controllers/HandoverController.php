<?php

namespace App\Http\Controllers;

use App\Mail\PaymentApprovedMail;
use App\Mail\ProjectDoneMail;
use App\Models\Color;
use App\Models\Font;
use App\Models\MessageHandover;
use App\Models\NewsFeed;
use App\Models\Project;
use App\Models\Rating;
use App\Models\ResultContest;
use App\Models\ResultProject;
use App\Models\User;
use App\Models\WinnerContest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        if ($project->catagories_project == 'contest') {
            $idworker = ResultContest::where('contest_id',$project->id)->first();
        } else {
            $idworker = ResultProject::where('contest_id',$project->id)->first();
        }

        $user   = User::where('id',$project->user_id)->first();
        $worker = User::where('id', $idworker->user_id_worker)->first();

        Rating::create([
            'contest_id'        => $project->id,
            'user_id'           => $project->user_id,
            'user_id_worker'    => $idworker->user_id_worker,
        ]);

        Mail::to($user->email)->send(new ProjectDoneMail());
        Mail::to($worker->email)->send(new PaymentApprovedMail($project->name,$project->harga));

        Project::where('id',$project->id)
                ->update([
                    'is_active' => 'close'
                ]);

        NewsFeed::create([
            'contest_id'    => $project->id,
            'user_id_from'  => request()->user()->id,
            'user_id_to'    => $idworker->user_id_worker,
            'feedback'      => 'Handover Confirm By' . $user->name,
            'choices'       => 'handover',
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

        NewsFeed::create([
            'contest_id'    => $winnercontest->contest_id,
            'user_id_from'  => request()->user()->id,
            'user_id_to'    => $winnercontest->user_id,
            'feedback'      => 'Upload Logo Text Success By' . $winnercontest->user_id_worker,
            'choices'       => 'handover',
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

        NewsFeed::create([
            'contest_id'    => $winnercontest->contest_id,
            'user_id_from'  => request()->user()->id,
            'user_id_to'    => $winnercontest->user_id,
            'feedback'      => 'Upload Logo Success By' . $winnercontest->user_id_worker,
            'choices'       => 'handover',
        ]);
        return redirect()->back()->with('status','Upload Logo Berhasil');
    }
    public function UpdateFontColor(WinnerContest $winnercontest,Request $request)
    {
        //Font
        $font = $request->font;
        for ($i = 0; $i < count($font); $i++) {
            Font::create([
                'contest_id'    => $winnercontest->contest_id,
                'name'          => $font[$i],
            ]);
        }

        //Color
        $hexa = $request->hexa_color;
        $rgb = $request->rgb_color;
        for ($i = 0; $i < count($hexa); $i++) {
            Color::create([
                'contest_id'    => $winnercontest->contest_id,
                'hexa'          => $hexa[$i],
                'rgb'           => $rgb[$i],
            ]);
        }

        NewsFeed::create([
            'contest_id'    => $winnercontest->contest_id,
            'user_id_from'  => request()->user()->id,
            'user_id_to'    => $winnercontest->user_id,
            'feedback'      => 'Upload Font & Color Success By' . $winnercontest->user_id_worker,
            'choices'       => 'handover',
        ]);
        return redirect()->back()->with('status','Color & Font Berhasil di Tambah');
    }
    public function DeleteColor(Color $color)
    {
        Color::destroy($color->id);
        return redirect()->back()->with('status','Delete Color Berhasil di Delete');
    }
    public function DeleteFont(Font $font)
    {
        Font::destroy($font->id);
        return redirect()->back()->with('status','Delete Font Berhasil di Delete');
    }
}
