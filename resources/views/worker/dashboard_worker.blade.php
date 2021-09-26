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
        @php
        foreach ($project as $item) {
            $totalprojectsuccesscontest     = DB::table('result_contests')
                                            ->join('projects','result_contests.contest_id','=','projects.id')
                                            ->where('projects.is_active', 'close')->OrWhere('projects.is_active', 'choose winner')
                                            ->distinct('contest_id')
                                            ->where('user_id_worker',request()->user()->id)
                                            ->count();
            $totalprojecthandovercontest    = DB::table('result_contests')
                                            ->join('projects','result_contests.contest_id','=','projects.id')
                                            ->where('projects.is_active', 'handover')
                                            ->distinct('contest_id')
                                            ->where('user_id_worker',request()->user()->id)
                                            ->count();
            $totalprojectrunningcontest     = DB::table('result_contests')
                                            ->join('projects','result_contests.contest_id','=','projects.id')
                                            ->where('projects.is_active', 'running')
                                            ->where('user_id_worker',request()->user()->id)
                                            ->distinct('contest_id')
                                            ->count();
            $totalprojectsuccessdirect      = DB::table('result_projects')
                                            ->join('projects','result_projects.contest_id','=','projects.id')
                                            ->where('projects.is_active', 'close')->OrWhere('projects.is_active', 'choose winner')
                                            ->distinct('contest_id')
                                            ->where('user_id_worker',request()->user()->id)
                                            ->count();
            $totalprojecthandoverdirect     = DB::table('result_projects')
                                            ->join('projects','result_projects.contest_id','=','projects.id')
                                            ->where('projects.is_active', 'handover')
                                            ->where('user_id_worker',request()->user()->id)
                                            ->distinct('contest_id')
                                            ->count();
            $totalprojectrunningdirect      = DB::table('result_projects')
                                            ->join('projects','result_projects.contest_id','=','projects.id')
                                            ->where('projects.is_active', 'running')
                                            ->where('user_id_worker',request()->user()->id)
                                            ->distinct('contest_id')
                                            ->count();
        }
        @endphp
        <div class="row row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3 bg-azure">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-white text-dark mr-3">
                            <i class="fa fa-refresh"></i>
                        </span>
                        <div>
                            <h6 class="m-0 text-white">
                                @if ($projects != null)
                                {{$totalprojectrunningcontest + $totalprojectrunningdirect}}
                                @else
                                0
                                @endif
                                <small class="text-white">Project Running</small>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3 bg-green">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-white text-dark mr-3">
                            <i class="fa fa-check"></i>
                        </span>
                        <div>
                            <h6 class="m-0 text-white">
                                @if ($projects != null)
                                {{$totalprojectsuccessdirect + $totalprojectsuccesscontest}}
                                @else
                                0
                                @endif
                                <small class="text-white">Project Success</small>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3 bg-primary">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-white text-dark mr-3">
                            <i class="fa fa-handshake-o"></i>
                        </span>
                        <div>
                            <h6 class="m-0 text-white">
                                @if ($projects != null)
                                {{$totalprojecthandovercontest + $totalprojecthandoverdirect}}
                                @else
                                0
                                @endif
                                <small class="text-white">Project Handover</small>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Project Running</h3>
                        <div class="ml-auto">
                            <input type="text" id="searchprojectrunningworker" class="form-control" placeholder="Search">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Name</th>
                                    <th>Project</th>
                                    <th>Bid/Proposals</th>
                                    <th>Worker</th>
                                    <th>Created</th>
                                    <th>Deadline</th>
                                    <th>Status/Action</th>
                                </tr>
                            </thead>
                            <tbody id="resultprojectrunningworker">
                                @php
                                $i=1;
                                    foreach($project as $itemproject) :
                                    $handover = DB::table('winner_contests')->where('contest_id',$itemproject->id)->first();
                                    if ($itemproject->catagories_project == 'contest') {
                                        $myproject      = DB::table('result_contests')
                                                            ->join('projects','result_contests.contest_id','=','projects.id')
                                                            ->where('contest_id',$itemproject->id)->where('user_id_worker',request()->user()->id)
                                                            ->limit(1)
                                                            ->get();
                                        $desainers      = DB::table('result_contests')->where('contest_id',$itemproject->id)->distinct()->count('user_id_worker');
                                        $desains        = DB::table('result_contests')->where('contest_id',$itemproject->id)->count();
                                    } else {
                                        $myproject      = DB::table('result_projects')
                                                            ->join('projects','result_projects.contest_id','=','projects.id')
                                                            ->where('contest_id',$itemproject->id)->where('user_id_worker',request()->user()->id)
                                                            ->limit(1)
                                                            ->get();
                                        $desainers      = DB::table('result_projects')->where('contest_id',$itemproject->id)->distinct()->count('user_id_worker');
                                        $desains        = DB::table('result_projects')->where('contest_id',$itemproject->id)->count();
                                    }

                                @endphp
                                @foreach ($myproject as $itemmyproject)

                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itemmyproject->title}}</td>
                                    <td>
                                        @if ($itemmyproject->catagories_project == 'contest')
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
                                        {{date('d M, Y',strtotime($itemmyproject->created_at))}}
                                    </td>
                                    <td>
                                        {{date('d M, Y',strtotime($itemmyproject->deadline))}}
                                    </td>
                                    <td>
                                        @if ($itemmyproject->is_active == 'waiting payment')
                                        <a class="btn btn-warning btn-sm text-white text-uppercase">{{$itemmyproject->is_active}}</a>
                                        @elseif ($itemmyproject->is_active == 'running')
                                            @if ($itemproject->catagories_project == 'contest')
                                            <a href="/briefcontest/{{$itemproject->id}}" class="btn btn-success btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                            @else
                                            <a href="/briefdirect/{{$itemproject->id}}" class="btn btn-success btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                            @endif
                                        @elseif ($itemmyproject->is_active == 'choose winner')
                                            @if ($itemproject->catagories_project == 'contest')
                                            <a href="/briefcontest/{{$itemproject->id}}" class="btn btn-azure btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                            @else
                                            <a href="/briefdirect/{{$itemproject->id}}" class="btn btn-azure btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                            @endif
                                        @elseif ($itemmyproject->is_active == 'handover')
                                            @if ($itemproject->catagories_project == 'contest')
                                            <a href="/briefcontest/{{$itemproject->id}}" class="btn btn-primary btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                            @else
                                            <a href="/briefdirect/{{$itemproject->id}}" class="btn btn-primary btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                            @endif
                                        @elseif ($itemmyproject->is_active == 'close')
                                            @if ($itemproject->catagories_project == 'contest')
                                            <a href="/briefcontest/{{$itemproject->id}}" class="btn btn-secondary btn-sm text-uppercase">{{$itemproject->is_active}}</a>
                                            @else
                                            <a href="/briefdirect/{{$itemproject->id}}" class="btn btn-secondary btn-sm text-uppercase">{{$itemproject->is_active}}</a>
                                            @endif
                                        @elseif ($itemmyproject->is_active == 'cancel')
                                        <a class="btn btn-danger btn-sm text-white text-uppercase">{{$itemmyproject->is_active}}</a>
                                        @else
                                        <a class="btn btn-gray-dark btn-sm text-white text-uppercase">{{$itemmyproject->is_active}}</a>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                $i++;
                                endforeach;
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
