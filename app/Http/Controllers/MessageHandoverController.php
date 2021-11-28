<?php

namespace App\Http\Controllers;

use App\Mail\HandoverCommentMail;
use App\Models\MessageHandover;
use App\Models\NewsFeed;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class MessageHandoverController extends Controller
{
    public function KirimFeedbackMessage(Request $request)
    {
        $project = Project::where('id', $request->id)->first();

        $file = $request->file('filechat');
        $name = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('filechat', $name);

        if (request()->user()->role == 'customer') {
            if ($request->file('filechat')) {
                $MessageHandover = MessageHandover::create([
                    'result_id'         => $request->id,
                    'worker_id'         => $request->user_id_worker,
                    'customer_id'       => request()->user()->id,
                    'feedback_customer' => $request->feedback,
                    'file'              => $name,
                ]);
            } else {
                $MessageHandover = MessageHandover::create([
                    'result_id'         => $request->id,
                    'worker_id'         => $request->user_id_worker,
                    'customer_id'       => request()->user()->id,
                    'feedback_customer' => $request->feedback,
                ]);
            }

            NewsFeed::create([
                'contest_id'    => $request->id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $MessageHandover->worker_id,
                'feedback'      => $request->feedback,
                'choices'       => 'handover command',
            ]);
            $worker = User::where('id', $MessageHandover->worker_id)->first();
            if ($worker != null) {
                Mail::to($worker->email)->send(new HandoverCommentMail($request->feedback, $project->title));
            } else {
                $admin = User::where('role', 'admin')->get();
                for ($i = 0; $i < count($admin); $i++) {
                    foreach ($admin as $itemadmin) {
                        Mail::to($itemadmin->email)->send(new HandoverCommentMail($request->feedback, $project->title));
                        Http::post(env('API_WHATSAPP_URL') . 'send-message', [
                            'number' => $itemadmin->phone,
                            'message' =>    'You get a comment from the contest ' . $project->title
                        ]);
                    }
                }
            }

        } else {
            if ($request->file('filechat')) {
                $MessageHandover = MessageHandover::create([
                    'result_id'         => $request->id,
                    'worker_id'         => request()->user()->id,
                    'customer_id'       => $request->user_id,
                    'feedback_worker'   => $request->feedback,
                    'file'              => $name,
                ]);
            } else {
                $MessageHandover = MessageHandover::create([
                    'result_id'         => $request->id,
                    'worker_id'         => request()->user()->id,
                    'customer_id'       => $request->user_id,
                    'feedback_worker'   => $request->feedback,
                ]);
            }

            NewsFeed::create([
                'contest_id'    => $request->id,
                'user_id_from'  => request()->user()->id,
                'user_id_to'    => $MessageHandover->customer_id,
                'feedback'      => $request->feedback,
                'choices'       => 'handover command',
            ]);
            $customer = User::where('id', $MessageHandover->customer_id)->first();
            Mail::to($customer->email)->send(new HandoverCommentMail($request->feedback, $project->title));
            Http::post(env('API_WHATSAPP_URL') . 'send-message', [
                'number' => $customer->phone,
                'message' =>    'You get a comment from the contest ' . $project->title
            ]);
        }
        return redirect()->back()->with('status', 'Message Bid Berhasil di kirim');
    }
}
