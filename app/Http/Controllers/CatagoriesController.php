<?php

namespace App\Http\Controllers;

use App\Models\Catagories;
use App\Models\SortCatagories;
use Illuminate\Http\Request;

class CatagoriesController extends Controller
{
    public function StoreCatagories(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'harga' => 'required',
        ]);

        if ($request->pilihaninput == 1) {
            if ($request->icon != '') {
                Catagories::create([
                    'name' => $request->name,
                    'icon' => $request->icon,
                    'harga' => $request->harga,
                ]);
            } else {
                Catagories::create([
                    'name' => $request->name,
                    'harga' => $request->harga,
                ]);
            }
        } elseif ($request->pilihaninput == 2) {
            SortCatagories::create([
                'name' => $request->name
            ]);
        } else {
            if ($request->icon != '') {
                Catagories::create([
                    'name' => $request->name,
                    'icon' => $request->icon,
                    'harga' => $request->harga,
                ]);
            } else {
                Catagories::create([
                    'name' => $request->name,
                    'harga' => $request->harga,
                ]);
            }
            SortCatagories::create([
                'name' => $request->name
            ]);
        }
        return redirect()->back()->with('status', 'Catagories Berhasil Di Inputkan');
    }
    public function EditCatagories(Request $request)
    {
        if ($request->pilihaninputs == 'catagories') {
            $catagories = Catagories::where('id',$request->id)->first();
        } else {
            $catagories = SortCatagories::where('id',$request->id)->first();
        }

        return response()->json([
            'catagories' => $catagories
        ]);
    }
    public function UpdateCatagories(Request $request)
    {
        if ($request->pilihaninputs == 1) {
            if ($request->icon != '') {
                Catagories::where('id',$request->id)
                    ->update([
                    'name' => $request->name,
                    'icon' => $request->icon,
                    'harga' => $request->harga,
                ]);
            } else {
                Catagories::where('id',$request->id)
                    ->update([
                    'name' => $request->name,
                    'harga' => $request->harga,
                ]);
            }
            SortCatagories::where('id',$request->id)
                ->update([
                'name' => $request->name
            ]);
        } else {
            SortCatagories::where('id',$request->id)
                ->update([
                'name' => $request->name
            ]);
        }
        return redirect()->back()->with('status','Catagories Berhasil Di Update');
    }
    public function DeleteCatagories(Request $request)
    {
        if ($request->pilihaninput == 'catagories') {

            $cata = Catagories::where('id',$request->id)->first();
            Catagories::destroy($cata->id);
            SortCatagories::where('name',$cata->name)->delete();
        } else {
            SortCatagories::destroy('id',$request->id);
        }
        return redirect()->back()->with('status', 'Catagories Berhasil Di Update');
    }
}
