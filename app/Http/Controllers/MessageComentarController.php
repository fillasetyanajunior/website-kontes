<?php

namespace App\Http\Controllers;

use App\Models\MessageComentar;
use App\Models\NewsFeed;
use Illuminate\Http\Request;

class MessageComentarController extends Controller
{
    public function MessageComentar(Request $request)
    {
        if (request()->user()->role == 'customer') {
            $MessageComentar = MessageComentar::create([
                'result_id'         => $request->id,
                'worker_id'         => $request->user_id_worker,
                'customer_id'       => request()->user()->id,
                'feedback_customer' => $request->feedback,
            ]);

            NewsFeed::create([
                'contest_id'    => $request->id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $MessageComentar->worker_id,
                'feedback'      => $request->feedback,
                'choices'       => 'comment public',
            ]);
        } else {
            $MessageComentar = MessageComentar::create([
                'result_id'         => $request->id,
                'worker_id'         => request()->user()->id,
                'customer_id'       => $request->user_id,
                'feedback_worker'   => $request->feedback,
            ]);

            NewsFeed::create([
                'contest_id'    => $request->id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $MessageComentar->customer_id,
                'feedback'      => $request->feedback,
                'choices'       => 'comment public',
            ]);
        }
        return redirect()->back()->with('status', 'Comentar Berhasil di kirim');
    }
}
