<?php

namespace App\Http\Controllers;

use App\Models\MessageHandover;
use Illuminate\Http\Request;

class MessageHandoverController extends Controller
{
    public function KirimFeedbackMessage(Request $request)
    {
        if (request()->user()->role == 'customer') {
            MessageHandover::create([
                'result_id'         => $request->id,
                'worker_id'         => $request->user_id_worker,
                'customer_id'       => request()->user()->id,
                'feedback_customer' => $request->feedback,
            ]);
        } else {
            MessageHandover::create([
                'result_id'         => $request->id,
                'worker_id'         => request()->user()->id,
                'customer_id'       => $request->user_id,
                'feedback_worker'   => $request->feedback,
            ]);
        }
        return redirect()->back()->with('status', 'Message Bid Berhasil di kirim');
    }
}
