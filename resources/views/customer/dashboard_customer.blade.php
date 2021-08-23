@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Dashboard
            </h1>
        </div>
        <div class="row row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-blue mr-3">
                            <i class="fe fe-dollar-sign"></i>
                        </span>
                        <div>
                            <h4 class="m-0">{{"$ ". number_format($totalhargaprojectrunning)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-red mr-3">
                            <i class="fe fe-users"></i>
                        </span>
                        <div>
                            <h4 class="m-0">{{$totalprojectrunning}} <small>Project Running</small></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-green mr-3">
                            <i class="fe fe-shopping-cart"></i>
                        </span>
                        <div>
                            <h4 class="m-0">{{$totalprojectcancel}} <small>Project Cancel</small></h4>
                            <small class="text-muted">{{$totalprojectsuccess}} Project Success</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="d-flex flex-row bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        <a href="{{route('contestproject')}}" class="btn btn-orange">Add Project Contest</a>
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="{{route('directproject')}}" class="btn btn-lime">Add Direct Contest</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Project Running</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Project ID</th>
                                    <th>Name</th>
                                    <th>Project</th>
                                    <th>Bid/Proposals</th>
                                    <th>Worker</th>
                                    <th>Created</th>
                                    <th>Deadline</th>
                                    <th>Status/Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                    foreach($project as $itemproject) :
                                    if ($itemproject->catagories_project == 'contest') {
                                        $desainers    = DB::table('result_contests')->where('contest_id',$itemproject->id)->distinct()->count('user_id_worker');
                                        $desains      = DB::table('result_contests')->where('contest_id',$itemproject->id)->count();
                                    } else {
                                        $desainers    = DB::table('result_projects')->where('contest_id',$itemproject->id)->distinct()->count('user_id_worker');
                                        $desains      = DB::table('result_projects')->where('contest_id',$itemproject->id)->count();
                                    }
                                    if ($itemproject->deadline <= date('Y-m-d')) {
                                        if ($itemproject->is_active == 'running') {
                                            DB::table('projects')->where('id',$itemproject->id)->update(['is_active' =>'choose winner']);
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itemproject->id_project}}</td>
                                    <td>{{$itemproject->title}}</td>
                                    <td>
                                        @if ($itemproject->catagories_project == 'contest')
                                            Contest Project
                                        @else
                                            Direct Project
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{$desains}}
                                    </td>
                                    <td class="text-center">
                                        {{$desainers}}
                                    </td>
                                    <td>
                                        {{date('d M, Y',strtotime($itemproject->created_at))}}
                                    </td>
                                    <td id="deadline" data-deadline="{{$itemproject->deadline}}" data-time="{{date('Y-m-d')}}" data-id="{{$itemproject->id}}">
                                        {{date('d M, Y',strtotime($itemproject->deadline))}}
                                    </td>
                                    <td>
                                        @if ($itemproject->is_active == 'waitting payment')
                                        <a class="btn btn-warning btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                        @elseif ($itemproject->is_active == 'running')
                                            @if ($itemproject->catagories_project == 'contest')
                                            <a href="/briefcontest/{{$itemproject->id}}" class="btn btn-success btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                            @else
                                            <a href="/briefdirect/{{$itemproject->id}}" class="btn btn-success btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                            @endif
                                        @elseif ($itemproject->is_active == 'choose winner')
                                        <a class="btn btn-azure btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                        @elseif ($itemproject->is_active == 'handover')
                                        <a href="/handoverproject/{{$itemproject->id}}" class="btn btn-primary btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                        @elseif ($itemproject->is_active == 'close')
                                        <a href="/handoverproject/{{$itemproject->id}}" class="btn btn-secondary btn-sm text-uppercase">{{$itemproject->is_active}}</a>
                                        @elseif ($itemproject->is_active == 'cancel')
                                        <a class="btn btn-danger btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                        @else
                                        <a class="btn btn-gray-dark btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                    endforeach;
                                @endphp
                            </tbody>
                        </table>
                        {{$project->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
