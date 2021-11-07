<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CobaController extends Controller
{
    public function coba()
    {
        Http::post(env('API_WHATSAPP_URL') . 'send-message', [
            'number' => '6285157163319@c.us',
            'message' =>    'We provide several discount codes for you.
here is the code:' . '

Code              : ' . '12' . '
discounts       : ' . 'Filla'
        ]);
    }
}
