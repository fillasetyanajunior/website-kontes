<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    public function NewsFeed()
    {
        $data['newsfeed'] = Project::orderBy('created_at','desc')->where('user_id',request()->user()->id)->paginate(10);
        return view('customer.newsfeed.newsfeed',$data);
    }
    public function Favourites()
    {
        $data['favourites'] = Project::where('user_id',request()->user()->id)->get();
        return view('customer.favourites.favourites',$data);
    }
}
