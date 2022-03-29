<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\Catagories;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomepageController extends Controller
{
    public function index()
    {
        $categories     = Catagories::orderBy('name')->limit(4)->get();
        $categoriesall  = Catagories::orderBy('name')->get();
        $project        = Project::where('is_active','close')->where('catagories_project','contest')->limit(8)->get();
        return view('home',compact('categories','categoriesall','project'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'phone'     => 'required',
            'comment'   => 'required',
        ]);

        Mail::to($request->email)->send(new ContactMessageMail($request->comment,$request->phone));
        return redirect()->back()->with('success','Send Comment Success');
    }
}
