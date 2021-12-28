<?php

namespace App\Http\Controllers;

use App\Models\NewsFeed;
use App\Models\Project;
use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    public function NewsFeed()
    {
        $data['title']      = 'NewsFeed';
        $data['newsfeed']   = NewsFeed::orderBy('created_at','DESC')->where('user_id_to',request()->user()->id)->paginate(20);
        return view('customer.newsfeed.newsfeed',$data);
    }
    public function Favourites()
    {
        $data['title']      = 'Favourites';
        $data['favourites'] = Project::where('user_id',request()->user()->id)->get();
        return view('customer.favourites.favourites',$data);
    }
}
