<?php

namespace App\Http\Controllers;

use App\Models\UploadFilePerjanjian;
use Illuminate\Http\Request;

class PerjanjianController extends Controller
{
    public function UpdatePerjanjian(Request $request, UploadFilePerjanjian $uploadfileperjanjian)
    {
        UploadFilePerjanjian::where('id',$uploadfileperjanjian->id)
                            ->update([
                                'perjanjian' => $request->perjanjian,
                            ]);
        return redirect()->back();
    }
    public function PerjanjianShow(Request $request)
    {
        $id = $request->id;
        return view('home.nda',compact('id'));
    }
    public function Perjanjian(Request $request)
    {
        $id = $request->id;
        $fileperjanjian = UploadFilePerjanjian::where('contest_id',$request->id)->first();
        return view('home.ndafileconfirm',compact(['id','fileperjanjian']));
    }
}
