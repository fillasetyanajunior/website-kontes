@extends('layouts.layouts_dashboard')
@section('title',$title)
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
            @if ($user != null)
            <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                    <a href="javascript:void(0)" class="mb-3">
                        @if ($itemfavourites->catagories_project == 'contest')
                        <img src="{{asset('/storage/resultcontest/' . $data->filecontest)}}"class="rounded">
                        @else
                        @if ($user->avatar == 'default.jpg')
                        <img src="{{asset('assets/dashboard/images/default.jpg')}}"class="rounded">
                        @else
                        <img src="{{asset('/storage/profile/' . $user->avatar)}}"class="rounded">
                        @endif
                        @endif
                    </a>
                    <div class="d-flex align-items-center px-2">
                        @if ($user->avatar == 'default.jpg')
                        <div class="avatar avatar-md mr-3" style="background-image: url({{asset('assets/dashboard/images/default.jpg')}})"></div>
                        @else
                        <div class="avatar avatar-md mr-3" style="background-image: url({{asset('/storage/profile/' . $user->avatar)}})"></div>
                        @endif
                        <div>
                            <div><a href="/profileworker/{{Crypt::encrypt($data->user_id_worker)}}">{{$user->name}}</a></div>
                            <small class="d-block text-muted">{{$itemfavourites->catagories_project}}</small>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                    <a href="javascript:void(0)" class="mb-3">
                        @if ($itemfavourites->catagories_project == 'contest')
                        <img src="{{asset('/storage/resultcontest/' . $data->filecontest)}}"class="rounded">
                        @else
                        @if ($user->avatar == 'default.jpg')
                        <img src="{{asset('assets/dashboard/images/default.jpg')}}"class="rounded">
                        @else
                        <img src="{{asset('/storage/profile/' . $user->avatar)}}"class="rounded">
                        @endif
                        @endif
                    </a>
                    <div class="d-flex align-items-center px-2">
                        @if ($user->avatar == 'default.jpg')
                        <div class="avatar avatar-md mr-3" style="background-image: url({{asset('assets/dashboard/images/default.jpg')}})"></div>
                        @else
                        <div class="avatar avatar-md mr-3" style="background-image: url({{asset('/storage/profile/' . $user->avatar)}})"></div>
                        @endif
                        <div>
                            <div><a href="javascript:void(0)">Worker</a></div>
                            <small class="d-block text-muted">{{$itemfavourites->catagories_project}}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @endforeach
        </div>
    </div>
</div>
@endsection
