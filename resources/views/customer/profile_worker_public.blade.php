@extends('layouts.layouts_dashboard')
@section('title',$title)
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="mt-5">
            <div class="card card-profile">
                <div class="card-header"
                    style="background-image: url({{url('assets/dashboard/images/thumbnail.jpg')}});">
                </div>
                <div class="card-body text-left">
                    @if ($worker->avatar != 'default.jpg')
                    <img class="card-profile-img" src="{{asset('/storage/profile/' . $worker->avatar)}}">
                    @else
                    <img class="card-profile-img" src="{{url('assets/dashboard/images/default.jpg')}}">
                    @endif
                    <h3 class="mb-3">{{$worker->name}}</h3>
                    <div class="d-flex flex-wrap">
                        <div class="form-group mr-3">
                            <label class="form-label">Location</label>
                            <div class="form-control-plaintext">{{$worker->location}}</div>
                        </div>
                        <div class="form-group mx-3">
                            <label class="form-label">Rangked</label>
                            <div class="form-control-plaintext">#{{$worker->rangking}}</div>
                        </div>
                        <div class="form-group mx-3">
                            <label class="form-label">Earnings</label>
                            <div class="form-control-plaintext">
                                {{"$ ". number_format($worker->earning)}}
                            </div>
                        </div>
                        <div class="form-group mx-3">
                            <label class="form-label">Rating</label>
                            <div class="form-control-plaintext">
                                @if ($rating > 20)
                                <a href="javascript:void(0)" data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star-o"></i></a>
                                <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star-o"></i></a>
                                <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star-o"></i></a>
                                <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                                @elseif ($rating > 40)
                                <a href="javascript:void(0)" data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star-o"></i></a>
                                <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star-o"></i></a>
                                <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                                @elseif ($rating > 60)
                                <a href="javascript:void(0)" data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star-o"></i></a>
                                <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                                @elseif ($rating > 80)
                                <a href="javascript:void(0)" data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                                @elseif ($rating > 100)
                                <a href="javascript:void(0)" data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                                <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star text-yellow"></i></a>
                                @else
                                <a href="javascript:void(0)" data-nilai="1"><i class="fa fa-star-o"></i></a>
                                <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star-o"></i></a>
                                <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star-o"></i></a>
                                <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star-o"></i></a>
                                <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group mx-3">
                            <label class="form-label">Status Online</label>
                            <div class="form-control-plaintext">{{$status}}</div>
                        </div>
                        <div class="form-group mx-3">
                            <label class="form-label">Status Account</label>
                            <div class="form-control-plaintext">{{$worker->status_account}}</div>
                        </div>
                        <div class="form-group mx-3">
                            <label class="form-label">Once Suspend</label>
                            @php
                            $suspend = DB::table('suspend_accounts')->where('user_id',$worker->user_id)->count();
                            @endphp
                            <div class="form-control-plaintext">{{$suspend}} X Account Suspend</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h4>Portfolio</h4>
        <div class="row row-cards">
            @foreach ($project as $itemproject)
                @php
                    $resultcontest = DB::table('result_contests')->where('contest_id',$itemproject->id)->where('user_id_worker',$worker->user_id)->where('portfolio','show')->get();
                    $role = 'contest'
                @endphp
            @foreach ($resultcontest as $itemresultcontest)
            <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                    <a href="javascript:void(0)">
                        @if ($itemresultcontest->portfolio == 'show')
                        <img src="{{asset('/storage/resultcontest/' . $itemresultcontest->filecontest)}}"
                            class="rounded" style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
                        @else
                        <img src="{{url('assets/dashboard/images/gembok.png')}}" class="rounded"
                            style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
                        @endif
                    </a>
                    <div class="d-flex align-items-center px-2 mt-5">
                        <div>
                            @if ($itemresultcontest->nilai == 1)
                            <a href="javascript:void(0)" data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultcontest->nilai == 2)
                            <a href="javascript:void(0)" data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultcontest->nilai == 3)
                            <a href="javascript:void(0)" data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultcontest->nilai == 4)
                            <a href="javascript:void(0)" data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultcontest->nilai == 5)
                            <a href="javascript:void(0)" data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star text-yellow"></i></a>
                            @else
                            <a href="javascript:void(0)" data-nilai="1"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @endif
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
