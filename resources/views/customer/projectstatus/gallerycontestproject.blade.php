@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Gallery Contest
            </h1>
        </div>
        @if (request()->user()->role == 'worker' && $project->is_active == 'running')
        <button type="button" class="btn btn-primary mb-3" idcontest="{{$project->id}}"
            data-toggle="modal" data-target="#contestModal" id="tambahresultcontest">Submit
            Contest</button>
        @endif
        <div class="row row-cards">
            @foreach ($resultcontest as $itemresultcontest)
            @php
            $user = DB::table('workers')->where('user_id',$itemresultcontest->user_id_worker)->first();
            @endphp
            <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                    <a href="javascript:void(0)" id="feedback" class="mb-3" data-target="#FeedbackContest" data-toggle="modal" data-url="{{url('storage')}}" data-id="{{$itemresultcontest->id}}">
                        <img src="{{asset('/storage/resultcontest/' . $itemresultcontest->filecontest)}}" class="rounded" style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
                    </a>
                    <div class="d-flex align-items-center px-2">
                        @if ($user->avatar != 'default.jpg')
                            <div class="avatar avatar-md mr-3"
                                style="background-image: url({{asset('/storage/profile/' . $user->avatar)}})">
                            </div>
                        @else
                            <div class="avatar avatar-md mr-3"
                                style="background-image: url({{asset('assets/dashboard/images/default.jpg')}})">
                            </div>
                        @endif
                        <div>
                            <div>{{$itemresultcontest->title}}</div>
                            <small class="d-block text-muted">{{$user->name}}</small>
                            @if ($itemresultcontest->nilai == 1)
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="2"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultcontest->nilai == 2)
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultcontest->nilai == 3)
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultcontest->nilai == 4)
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultcontest->nilai == 5)
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="5"><i class="fa fa-star text-yellow"></i></a>
                            @else
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="1"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="2"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @endif
                        </div>
                        @if (request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running')
                        <div class="ml-auto">
                            <div class="mb-1">
                                <form action="/feedback/eliminasi/{{$itemresultcontest->id}}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn-sm btn btn-secondary">Eliminasi</button>
                                </form>
                            </div>
                            <div class="mb-1">
                                <form action="/feedback/choosewinner/pickwinner/{{$itemresultcontest->id}}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn-sm btn btn-secondary">Pick Winner</button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="modal fade" id="contestModal" tabindex="-1" aria-labelledby="contestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contestModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="body_resultcontest">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="form-group">
                            <label for="title">Title Contest</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="filecontest">File Contest</label>
                            <input type="file" class="form-control-file" id="filecontest" name="filecontest">
                        </div>
                    </div>
                    <div class="modal-footer footer_resultcontest">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="FeedbackContest" tabindex="-1" aria-labelledby="FeedbackContestLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="body_feedback">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-8 col-sm-8">
                            <img src="" alt="" id="hasilcontest">
                        </div>
                        <div class="col-4 col-sm-4">
                            <div class="card-body mb-2">
                                <div class="d-flex align-items-center px-2">
                                    <div class="avatar avatar-md mr-3" id="profileworker"></div>
                                    <div>
                                        <div id="name_worker"></div>
                                        <p id="description"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body mb-2" id="feedback_card">

                            </div>
                            @if (request()->user()->role == 'customer' || request()->user()->role == 'worker')
                            <div class="card-body">
                                <form action="" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control" rows="5" name="feedback"></textarea>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn-sm btn  btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
