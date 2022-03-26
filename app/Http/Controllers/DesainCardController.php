<?php

namespace App\Http\Controllers;

use App\Models\ColorCode;
use App\Models\ThemesDesainCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DesainCardController extends Controller
{
    public function BusinessCard(Request $request)
    {
        $data['title'] = Crypt::decrypt($request->id);
        $data['color'] = ColorCode::all();
        $data['themes'] = ThemesDesainCard::where('choices', 'businesscard')->get();
        return view('desaincard.businesscard',$data);
    }
    public function EmailSignature(Request $request)
    {
        $data['title'] = Crypt::decrypt($request->id);
        $data['color'] = ColorCode::all();
        $data['themes'] = ThemesDesainCard::where('choices', 'emailsignature')->get();
        return view('desaincard.emailsignature',$data);
    }
    public function Letterheads(Request $request)
    {
        $data['title'] = Crypt::decrypt($request->id);
        $data['color'] = ColorCode::all();
        $data['themes'] = ThemesDesainCard::where('choices', 'letterheads')->get();
        return view('desaincard.letterheads',$data);
    }
    public function Flayer(Request $request)
    {
        $data['title'] = Crypt::decrypt($request->id);
        $data['color'] = ColorCode::all();
        $data['themes'] = ThemesDesainCard::where('choices', 'flayer')->get();
        return view('desaincard.flayer',$data);
    }
    public function Invoices(Request $request)
    {
        $data['title'] = Crypt::decrypt($request->id);
        $data['color'] = ColorCode::all();
        $data['themes'] = ThemesDesainCard::where('choices', 'invoices')->get();
        return view('desaincard.invoices',$data);
    }
    public function PostCard(Request $request)
    {
        $data['title'] = Crypt::decrypt($request->id);
        $data['color'] = ColorCode::all();
        $data['themes'] = ThemesDesainCard::where('choices', 'postcard')->get();
        return view('desaincard.postcard',$data);
    }
    public function FacebookCover(Request $request)
    {
        $data['title'] = Crypt::decrypt($request->id);
        $data['color'] = ColorCode::all();
        $data['themes'] = ThemesDesainCard::where('choices', 'facebookcover')->get();
        return view('desaincard.facebookcover',$data);
    }
    public function FacebookPost(Request $request)
    {
        $data['title'] = Crypt::decrypt($request->id);
        $data['color'] = ColorCode::all();
        $data['themes'] = ThemesDesainCard::where('choices', 'facebookpost')->get();
        return view('desaincard.facebookpost',$data);
    }
    public function YoutubeBenners(Request $request)
    {
        $data['title'] = Crypt::decrypt($request->id);
        $data['color'] = ColorCode::all();
        $data['themes'] = ThemesDesainCard::where('choices', 'youtubebenners')->get();
        return view('desaincard.youtubebenners',$data);
    }
    public function InstagramPost(Request $request)
    {
        $data['title'] = Crypt::decrypt($request->id);
        $data['color'] = ColorCode::all();
        $data['themes'] = ThemesDesainCard::where('choices', 'instagrampost')->get();
        return view('desaincard.instagrampost',$data);
    }
    public function StoreDesainCard(Request $request)
    {
        ThemesDesainCard::create([
            'name'      => $request->title,
            'thumnail'  => $request->imagess,
            'themes'    => $request->themes,
            'choices'   => $request->choices,
        ]);
        return response()->json([
            'success' => 200
        ]);
    }
    public function UpdateDesainCard(Request $request,ThemesDesainCard $themesDesainCard)
    {
        ThemesDesainCard::where('id',$themesDesainCard->id)
                        ->update([
                        'thumnail'  => $request->imagess,
                        'themes'    => $request->themes,
                    ]);
        return response()->json([
            'success' => 200
        ]);
    }
    public function LoadThemes(ThemesDesainCard $themesDesainCard)
    {
        $data = ThemesDesainCard::where('id',$themesDesainCard->id)->first();
        return response()->json([
            'theme' => $data
        ]);
    }
}
