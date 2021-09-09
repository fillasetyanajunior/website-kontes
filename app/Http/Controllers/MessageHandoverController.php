<?php

namespace App\Http\Controllers;

use App\Models\MessageHandover;
use App\Models\NewsFeed;
use Illuminate\Http\Request;

class MessageHandoverController extends Controller
{
    public function KirimFeedbackMessage(Request $request)
    {
        if (request()->user()->role == 'customer') {
            $MessageHandover = MessageHandover::create([
                'result_id'         => $request->id,
                'worker_id'         => $request->user_id_worker,
                'customer_id'       => request()->user()->id,
                'feedback_customer' => $request->feedback,
            ]);
            NewsFeed::create([
                'contest_id'    => $request->id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $MessageHandover->worker_id,
                'feedback'      => $request->feedback,
                'choices'       => 'handover command',
            ]);
        } else {
            $MessageHandover = MessageHandover::create([
                'result_id'         => $request->id,
                'worker_id'         => request()->user()->id,
                'customer_id'       => $request->user_id,
                'feedback_worker'   => $request->feedback,
            ]);

            NewsFeed::create([
                'contest_id'    => $request->id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $MessageHandover->customer_id,
                'feedback'      => $request->feedback,
                'choices'       => 'handover command',
            ]);
        }
        return redirect()->back()->with('status', 'Message Bid Berhasil di kirim');
    }
}
