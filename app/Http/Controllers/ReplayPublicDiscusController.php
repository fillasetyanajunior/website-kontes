<?php

namespace App\Http\Controllers;

use App\Models\ReplayPublicDiscus;
use Illuminate\Http\Request;

class ReplayPublicDiscusController extends Controller
{
    public function StoreReplayPublic(Request $request)
    {
        ReplayPublicDiscus::create([
            'message_replay' => $request->id,
            'user_id' => request()->user()->id,
            'feedback' => $request->feedback,
        ]);
        return redirect()->back();
    }
}
