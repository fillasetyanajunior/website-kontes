<?php

namespace App\Http\Controllers;

use App\Models\SubCatagories;
use Illuminate\Http\Request;

class SubCatagoriesController extends Controller
{
    public function StoreSubCatagories(Request $request)
    {
        $request->validate([
            'catagories'    => 'required',
            'description'   => 'required',
            'name'          => 'required',
            'harga'         => 'required',
        ]);

        if ($request->icon != '') {
            SubCatagories::create([
                'catagori_id'   => $request->catagories,
                'name'          => $request->name,
                'icon'          => $request->icon,
                'description'   => $request->description,
                'harga'         => $request->harga,
            ]);
        } else {
            SubCatagories::create([
                'catagori_id'   => $request->catagories,
                'name'          => $request->name,
                'description'   => $request->description,
                'harga'         => $request->harga,
            ]);
        }
        return redirect()->back()->with('status', 'Sub Catagories Berhasil Di Inputkan');
    }
    public function EditSubCatagories(SubCatagories $subcatagories)
    {
        return response()->json([
            'subcatagories' => $subcatagories
        ]);
    }
    public function UpdateSubCatagories(Request $request, SubCatagories $subcatagories)
    {
        if ($request->icon != '') {
            SubCatagories::where('id',$subcatagories->id)
                        ->update([
                'catagori_id'   => $request->catagories,
                'name'          => $request->name,
                'icon'          => $request->icon,
                'description'   => $request->description,
                'harga'         => $request->harga,
            ]);
        } else {
            SubCatagories::where('id', $subcatagories->id)
                        ->update([
                'catagori_id'   => $request->catagories,
                'name'          => $request->name,
                'description'   => $request->description,
                'harga'         => $request->harga,
            ]);
        }
        return redirect()->back()->with('status', 'Sub Catagories Berhasil Di Update');
    }
    public function DeleteSubCatagories(SubCatagories $subcatagories)
    {
        SubCatagories::destroy($subcatagories->id);
        return redirect()->back()->with('status', 'Sub Catagories Berhasil Di Update');
    }
}
