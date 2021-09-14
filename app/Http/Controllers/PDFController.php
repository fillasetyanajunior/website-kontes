<?php

namespace App\Http\Controllers;

use App\Models\WinnerContest;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function PDFConvert(WinnerContest $winnercontest)
    {
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('pdf.certificate', compact('winnercontest'));
        // return $pdf->stream();
        return $pdf->setPaper('letter')->download('Certificate.pdf');
    }
}
