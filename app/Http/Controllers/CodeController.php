<?php

namespace App\Http\Controllers;

use App\Mail\CodeMail;
use App\Models\Code;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CodeController extends Controller
{
    public function StoreCode(Request $request)
    {
        if ($request->pilihan == 1) {
            $choices = '$10';
        } elseif($request->pilihan == 2){
            $choices = '$20';
        } elseif($request->pilihan == 3){
            $choices = '$50';
        }else {
            $choices = 'free posting fee';
        }

        for ($i=1; $i <= $request->jumlah; $i++) {
            $code = \Str::random(10);
            Code::create([
                'code'      => $code,
                'choices'   => $choices,
            ]);
        }
        // return $codes;
        $customer = User::where('role','customer')->get();
        foreach ($customer as $itemcustomer) {
            Mail::to($itemcustomer->email)->send(new CodeMail);
            Http::post(env('API_WHATSAPP_URL') . 'send-message', [
                'number' => $itemcustomer->phone,
                'message' =>    'please check your email because we have sent a discount code ' . $choices
            ]);
        }
        return redirect()->back()->with('status','Code Success');
    }
    public function GetDataCode(Request $request)
    {
        $code = Code::where('code',$request->code)->first();
        return response()->json([
            'discount' => $code,
        ]);
    }
}
