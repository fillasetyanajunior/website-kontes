@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Gallery Direct
            </h1>
        </div>
        @if (request()->user()->role == 'worker' && $project->is_active == 'running')
        <button type="button" class="btn btn-primary mb-3" idcontest="{{$project->id}}" data-toggle="modal"
            data-target="#directModal" id="tambahresultdirect">Submit
            Direct</button>
        @endif
        <div class="row row-cards">
            @foreach ($resultdirect as $itemresultdirect)
            @php
            $user = DB::table('workers')->where('user_id',$itemresultdirect->user_id_worker)->first();
            @endphp
            <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                    @if ($user->avatar != 'default.jpg')
                    <a href="javascript:void(0)" id="feedbackbid" class="mb-3" data-target="#FeedbackDirect"
                        data-toggle="modal" data-url="{{url('storage')}}" data-id="{{$itemresultdirect->id}}">
                        <img src="{{asset('/storage/profile/' . $user->avatar)}}" class="rounded" style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
                    </a>
                    @else
                    <a href="javascript:void(0)" id="feedbackbid" class="mb-3" data-target="#FeedbackDirect"
                        data-toggle="modal" data-url="{{url('storage')}}" data-id="{{$itemresultdirect->id}}">
                        <img src="{{asset('assets/dashboard/images/default.jpg')}}" class="rounded" style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
                    @endif

                    <div class="d-flex align-items-center px-2">
                        <div>
                            <div>{{$itemresultdirect->title}}</div>
                            <small class="d-block text-muted">{{$user->name}}</small>
                            @if ($itemresultdirect->nilai == 1)
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="2"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultdirect->nilai == 2)
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultdirect->nilai == 3)
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultdirect->nilai == 4)
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @elseif ($itemresultdirect->nilai == 5)
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="5"><i class="fa fa-star text-yellow"></i></a>
                            @else
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="1"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="2"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="3"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="4"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0)" @if(request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running') id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                                data-nilai="5"><i class="fa fa-star-o"></i></a>
                            @endif
                        </div>
                        @if (request()->user()->role == 'customer' && request()->user()->id == $project->user_id && $project->is_active == 'running')
                        <div class="ml-auto">
                            <div class="mb-1">
                                <form action="/feedback/eliminasi/{{$itemresultdirect->id}}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn-sm btn btn-secondary">Eliminasi</button>
                                </form>
                            </div>
                            <div class="mb-1">
                                <form action="/feedback/choosewinner/pickwinner/{{$itemresultdirect->id}}"
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
<div class="modal fade" id="directModal" tabindex="-1" aria-labelledby="directModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="directModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="body_resultdirect">
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer footer_resultdirect">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="FeedbackDirect" tabindex="-1" aria-labelledby="FeedbackDirectLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="body_feedback">
                <div class="modal-body">
                    <div class="card-body mb-2">
                        <div class="d-flex align-items-center px-2">
                            <div class="avatar avatar-md mr-3" id="profileworker"></div>
                            <div>
                                <div id="name_worker"></div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <p id="descriptions"></p>
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
@endsection
