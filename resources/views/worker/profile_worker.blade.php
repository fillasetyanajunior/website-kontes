@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="mt-5">
            <div class="card card-profile">
                <div class="card-header" style="background-image: url({{url('assets/dashboard/images/thumbnail.jpg')}});">
                </div>
                <div class="card-body text-left">
                    <img class="card-profile-img" src="{{asset('/storage/profile/' . $worker->avatar)}}">
                    <h3 class="mb-3">{{$worker->name}}</h3>
                    <div class="d-flex flex-wrap">
                        <div class="form-group mr-5">
                            <label class="form-label">Location</label>
                            <div class="form-control-plaintext">{{$worker->location}}</div>
                        </div>
                        <div class="form-group mx-5">
                            <label class="form-label">Rangked</label>
                            <div class="form-control-plaintext">#{{$worker->id}}</div>
                        </div>
                        @php
                        foreach ($project as $items) {
                            if ($items->catagories_project == 'contest') {
                                $saldo  = DB::table('result_contests')
                                        ->join('projects','result_contests.contest_id','=','projects.id')
                                        ->where('user_id_worker',request()->user()->id)
                                        ->sum('projects.harga');
                            }else{
                                $saldo  = DB::table('result_projects')
                                        ->join('projects','result_projects.contest_id','=','projects.id')
                                        ->where('user_id_worker',request()->user()->id)
                                        ->sum('projects.harga');
                            }
                        }
                        @endphp
                        <div class="form-group mx-5">
                            <label class="form-label">Earnings</label>
                            <div class="form-control-plaintext">
                                @if ($projects != null)
                                    {{"$ ". number_format($saldo)}}
                                @else
                                    $ 0
                                @endif
                            </div>
                        </div>
                        <div class="form-group mx-5">
                            <label class="form-label">Rating</label>
                            <div class="form-control-plaintext">
                            @if ($rating > 20)
                            <a href="javascript:void(0)"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="2"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($rating > 40)
                            <a href="javascript:void(0)"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($rating > 60)
                            <a href="javascript:void(0)"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($rating > 80)
                            <a href="javascript:void(0)"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($rating > 100)
                            <a href="javascript:void(0)"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="5"><i class="fa fa-star text-yellow"></i></a>
                            @else
                            <a href="javascript:void(0)"
                                data-nilai="1"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="2"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h4>Portfolio</h4>
        <div class="row row-cards">
            @foreach ($project as $itemproject)
            @php
            if ($itemproject->catagories_project == 'contest') {
                $resultcontest = DB::table('result_contests')->where('contest_id',$itemproject->id)->where('user_id_worker',request()->user()->id)->get();
            } else {
                $resultcontest = DB::table('result_projects')->where('contest_id',$itemproject->id)->where('user_id_worker',request()->user()->id)->get();
            }
            @endphp
            @foreach ($resultcontest as $itemresultcontest)
            <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                    <a href="javascript:void(0)">
                        <img src="{{asset('/storage/resultcontest/' . $itemresultcontest->filecontest)}}" class="rounded" style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
                    </a>
                    <div class="d-flex align-items-center px-2 mt-5">
                        <div>
                            @if ($itemresultcontest->nilai == 1)
                            <a href="javascript:void(0)"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="2"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultcontest->nilai == 2)
                            <a href="javascript:void(0)"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultcontest->nilai == 3)
                            <a href="javascript:void(0)"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultcontest->nilai == 4)
                            <a href="javascript:void(0)"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultcontest->nilai == 5)
                            <a href="javascript:void(0)"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="5"><i class="fa fa-star text-yellow"></i></a>
                            @else
                            <a href="javascript:void(0)"
                                data-nilai="1"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="2"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
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
