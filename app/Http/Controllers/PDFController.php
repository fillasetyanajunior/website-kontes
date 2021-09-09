<?php

namespace App\Http\Controllers;

use App\Models\WinnerContest;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function PDFConvert(WinnerContest $winnercontest)
    {
        $pdf = PDF::loadView('pdf.certificate', compact('winnercontest'));
        return $pdf->download('Certificate.pdf');
    }
}
