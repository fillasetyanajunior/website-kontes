<?php

namespace App\Http\Controllers;

use App\Models\WinnerContest;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PDFController extends Controller
{
    public function PDFConvert(Request $request)
    {
        $winnercontest = WinnerContest::where('id',Crypt::decrypt($request->winnercontest))->first();
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('pdf.certificate', compact('winnercontest'));
        // return $pdf->stream();
        return $pdf->setPaper('letter')->download('Certificate.pdf');
    }
}
