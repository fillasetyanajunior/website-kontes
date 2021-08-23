@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Favourite
            </h1>
        </div>
        <div class="row row-cards">
            @php
            foreach ($favourites as $itemfavourites):
                if ($itemfavourites->catagories_project == 'contest') {
                    $data = DB::table('result_contests')->where('contest_id',$itemfavourites->id)->where('nilai','>',4)->get();
                } else {
                    $data = DB::table('result_projects')->where('contest_id',$itemfavourites->id)->where('nilai','>',4)->get();
                }
            foreach ($data as $data):
            $user = DB::table('users')->where('id',$data->user_id_worker)->first();
            @endphp
            <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                    <a href="javascript:void(0)" class="mb-3">
                        @if ($itemfavourites->catagories_project == 'contest')
                        <img src="{{asset('/storage/resultcontest/' . $data->filecontest)}}"class="rounded">
                        @else
                        <img src="{{asset('/storage/profile/' . $user->avatar)}}"class="rounded">
                        @endif
                    </a>
                    <div class="d-flex align-items-center px-2">
                        <div class="avatar avatar-md mr-3" style="background-image: url({{asset('/storage/profile/' . $user->avatar)}})"></div>
                        <div>
                            <div>{{$user->name}}</div>
                            <small class="d-block text-muted">{{$itemfavourites->catagories_project}}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endforeach
        </div>
    </div>
</div>
@endsection
