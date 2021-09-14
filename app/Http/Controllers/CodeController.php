<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\Request;

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
