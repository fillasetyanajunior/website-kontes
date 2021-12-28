<?php

namespace App\Http\Controllers;

use App\Models\UploadFilePerjanjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
        $data['title']  = 'NDA';
        $id             = Crypt::decrypt($request->id);
        return view('home.nda',compact('id'),$data);
    }
    public function Perjanjian(Request $request)
    {
        $data['title']  = 'NDA Confirmed';
        $id             = Crypt::decrypt($request->id);
        $fileperjanjian = UploadFilePerjanjian::where('contest_id',$id)->first();
        return view('home.ndafileconfirm',compact(['id','fileperjanjian']),$data);
    }
}
