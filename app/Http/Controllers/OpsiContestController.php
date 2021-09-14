<?php

namespace App\Http\Controllers;

use App\Models\OpsiPackage;
use App\Models\OpsiPackageUpgrade;
use Illuminate\Http\Request;

class OpsiContestController extends Controller
{
    public function StoreOpsi(Request $request)
    {

        if ($request->pilihaninput == 1) {
            $request->validate([
                'name'          => 'required',
                'description'   => 'required',
                'harga'         => 'required',
            ]);

            OpsiPackage::create([
                'name'          => $request->name,
                'description'   => $request->description,
                'harga'         => $request->harga,
            ]);
        } else {

            $request->validate([
                'name'          => 'required',
                'icon'          => 'required',
                'description'   => 'required',
                'harga'         => 'required',
            ]);

            OpsiPackageUpgrade::create([
                'name'          => $request->name,
                'icon'          => $request->icon,
                'description'   => $request->description,
                'hari'          => $request->hari,
                'harga'         => $request->harga,
            ]);

        }
        return redirect()->back()->with('status', 'Opsi Berhasil Di Inputkan');
    }
    public function EditOpsi(Request $request)
    {
        if ($request->pilihaninput == 'opsi utama') {
            $opsi = OpsiPackage::where('id', $request->id)->first();
        } else {
            $opsi = OpsiPackageUpgrade::where('id', $request->id)->first();
        }

        return response()->json([
            'opsi' => $opsi
        ]);
    }
    public function UpdateOpsi(Request $request)
    {
        if ($request->pilihaninputs == 1) {
            OpsiPackage::where('id',$request->id)
                        ->update([
                'name'          => $request->name,
                'description'   => $request->description,
                'harga'         => $request->harga,
            ]);
        } else {
            if ($request->icon != null) {
                OpsiPackageUpgrade::where('id', $request->id)
                                ->update([
                    'name'          => $request->name,
                    'icon'          => $request->icon,
                    'description'   => $request->description,
                    'hari'          => $request->hari,
                    'harga'         => $request->harga,
                ]);
            }else{
                OpsiPackageUpgrade::where('id', $request->id)
                                ->update([
                    'name'          => $request->name,
                    'description'   => $request->description,
                    'hari'          => $request->hari,
                    'harga'         => $request->harga,
                ]);
            }
        }
        return redirect()->back()->with('status', 'Opsi Berhasil Di Update');
    }
    public function DeleteOpsi(Request $request)
    {
        if ($request->pilihaninput == 'opsi utama') {
            OpsiPackage::destroy($request->id);
        } else {
            OpsiPackageUpgrade::destroy('id', $request->id);
        }
        return redirect()->back()->with('status', 'Opsi Berhasil Di Update');
    }
}
