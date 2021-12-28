<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use ZipArchive;
use Illuminate\Support\Facades\File as File;

class ZipController extends Controller
{

    public function CreateZip(Request $request)
    {
        $zip = new ZipArchive;

        $id = Crypt::decrypt($request->id);

        $fileName = 'storage/fileuploads/AllFile' . $id .'.Zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {

            $files = File::files(public_path('storage/fileuploads/AllFile' . $id));
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

        $id = Crypt::decrypt($request->id);

        $fileName = 'storage/fileproject/AllFileProject' . $id .'.Zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {

            $files = File::files(public_path('storage/fileproject/AllFileProject' . $id));
            foreach ($files as $value) {
                $file = basename($value);
                $zip->addFile($value, $file);
            }

            $zip->close();
        }
        return response()->download(public_path($fileName));
    }
}
