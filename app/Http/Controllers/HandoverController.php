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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
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
            $idworker = ResultContest::where('contest_id',$project->id)->where('is_active','winner')->first();
        } else {
            $idworker = ResultProject::where('contest_id',$project->id)->where('is_active','winner')->first();
        }

        $user   = User::where('id',$project->user_id)->first();
        $worker = User::where('id', $idworker->user_id_worker)->first();

        Rating::create([
            'contest_id'        => $project->id,
            'user_id'           => $project->user_id,
            'user_id_worker'    => $idworker->user_id_worker,
        ]);

        Mail::to($user->email)->send(new ProjectDoneMail());
        Mail::to($worker->email)->send(new PaymentApprovedMail($project->id));
        Http::post(env('API_WHATSAPP_URL') . 'send-message', [
            'number' => $user->phone,
            'message' =>    'The project you ordered has been completed.'
        ]);

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
        // dd($request);
        //Font
        Font::where('contest_id',$winnercontest->contest_id)->delete();
        $font = $request->font;
        if ($font != null ) {
            if (count($font) <= 4) {
                for ($i = 0; $i < count($font); $i++) {
                    Font::create([
                        'contest_id'    => $winnercontest->contest_id,
                        'name'          => $font[$i],
                    ]);
                }
            }
        }

        //Color
        $hexa = $request->hexa_color;
        $rgb = $request->rgb_color;
        Color::where('contest_id',$winnercontest->contest_id)->delete();
        for ($i = 0; $i < count($hexa); $i++) {
            if (count($hexa) <= 4) {
                if ($hexa[$i] != null && $rgb[$i] != null) {
                    Color::create([
                        'contest_id'    => $winnercontest->contest_id,
                        'hexa'          => $hexa[$i],
                        'rgb'           => $rgb[$i],
                    ]);
                }
            }
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
    public function DeleteColor(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        Color::where('hexa',$id)->delete();
        return redirect()->back()->with('status','Delete Color Berhasil di Delete');
    }
    public function DeleteFont(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        Font::where('name', $id)->delete();
        return redirect()->back()->with('status','Delete Font Berhasil di Delete');
    }
    public function SubmitPilihanDesain(Project $project, Request $request)
    {
        $pilihan = $request->pilihan1 . '/' . $request->pilihan2 . '/' . $request->pilihan3;
        Project::where('id',$project->id)
                ->update([
                    'pilihandesain' => $pilihan,
                ]);
        return redirect()->back();
    }
    public function AcceptPilihanDesain(Project $project)
    {
        Project::where('id',$project->id)
                ->update([
                    'expired_desaincard'    => date('Y-m-d', strtotime('+2 weeks')),
                    'desaincard'            => 'active',
                ]);
        return redirect()->back();
    }
}
