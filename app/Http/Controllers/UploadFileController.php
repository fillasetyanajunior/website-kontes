<?php

namespace App\Http\Controllers;

use App\Models\UploadFile;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function Uploadfile(Request $request)
    {
        // dd($request->file('fileupload')->getSize());
        foreach ($request->file('fileupload') as $file) {
            $file->storeAs('fileuploads/AllFile' . $request->id, $file->getClientOriginalName());

            UploadFile::create([
                'contest_id_winner' => $request->id,
                'name'              => $file->getClientOriginalName(),
                'kapasitas'         => $file->getSize(),
            ]);
        }
        return redirect()->back();
    }
}
