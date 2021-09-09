<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\File as File;

class ZipController extends Controller
{

    public function CreateZip(Request $request)
    {
        $zip = new ZipArchive;

        $fileName = 'storage/fileuploads/AllFile' . $request->id .'.Zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {

            $files = File::files(public_path('storage/fileuploads/AllFile' . $request->id));
            foreach ($files as $value) {
                $file = basename($value);
                $zip->addFile($value, $file);
            }

            $zip->close();
        }
        return response()->download(public_path($fileName));
    }
    public function CreateZipProject(Request $request)
    {
        $zip = new ZipArchive;

        $fileName = 'storage/fileproject/AllFileProject' . $request->id .'.Zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {

            $files = File::files(public_path('storage/fileproject/AllFileProject' . $request->id));
            foreach ($files as $value) {
                $file = basename($value);
                $zip->addFile($value, $file);
            }

            $zip->close();
        }
        return response()->download(public_path($fileName));
    }
}
