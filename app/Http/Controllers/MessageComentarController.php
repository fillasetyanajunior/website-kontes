<?php

namespace App\Http\Controllers;

use App\Mail\HandoverCommentMail;
use App\Mail\PublicDiscussionMail;
use App\Models\MessageComentar;
use App\Models\NewsFeed;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageComentarController extends Controller
{
    public function MessageComentar(Request $request)
    {
        $project    = Project::where('id',$request->id)->first();
        $comentar   = MessageComentar::where('result_id',$request->id)->first();
        if ($comentar != '') {
            $MessageComentar = MessageComentar::create([
                'result_id' => $request->id,
                'user_id'   => request()->user()->id,
                'feedback'  => $request->feedback,
            ]);

            $kirimnotifcomentar  = MessageComentar::where('result_id',$request->id)->distinct()->get('user_id');

            for ($i = 0; $i < count($kirimnotifcomentar); $i++) {
                if (request()->user()->id != $kirimnotifcomentar[$i]->user_id) {
                    NewsFeed::create([
                        'contest_id'    => $request->id,
                        'user_id_from'  => request()->user()->id,
                        'user_id_to'    => $kirimnotifcomentar[$i]->user_id,
                        'feedback'      => $request->feedback,
                        'choices'       => 'comment public',
                    ]);
                    $worker = User::where('id', $kirimnotifcomentar[$i]->user_id)->first();
                    Mail::to($worker->email)->send(new PublicDiscussionMail($request->feedback, $project->title));
                }
            }
        } else {
            MessageComentar::create([
                'result_id' => $request->id,
                'user_id'   => request()->user()->id,
                'feedback'  => $request->feedback,
            ]);

            NewsFeed::create([
                'contest_id'    => $request->id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $project->user_id,
                'feedback'      => $request->feedback,
                'choices'       => 'comment public',
            ]);
            $customer = User::where('id', $project->user_id)->first();
            Mail::to($customer->email)->send(new PublicDiscussionMail($request->feedback, $project->title));
        }
        return redirect()->back()->with('status', 'Comentar Berhasil di kirim');
    }
}
