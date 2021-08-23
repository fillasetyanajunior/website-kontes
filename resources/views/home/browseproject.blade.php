@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Browse Project
            </h1>
        </div>
        <div class="row mb-5">
            <div class="col-4">
                <div class="input-icon">
                    <input type="search" class="form-control" placeholder="What are you looking for?" id="search_text">
                    <div class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <select class="form-control" id="search_catagories">
                    <option value="">All ({{$totalproject}})</option>
                    @php
                        foreach ($sortcatagories as $itemsortcatagories) :
                        $datas = DB::table('projects')->where('catagories',$itemsortcatagories->name)->where('is_active','running')->count();
                    @endphp
                    <option value="{{$itemsortcatagories->name}}">{{$itemsortcatagories->name}} ({{$datas}})</option>
                    @php
                        endforeach;
                    @endphp
                </select>
            </div>
            <div class="col-2">
                <select class="form-control" id="search_status">
                    <option value="">-- Pilih --</option>
                    <option value="6">Open Jobs ({{$totalproject}})</option>
                    <option value="7">Close Jobs ({{$totalcloseproject}})</option>
                </select>
            </div>
            <div class="col-2 text-center">
                <button type="button" class="btn btn-secondary" id="button_fillter">Show Fillters</button>
            </div>
            <div id="show_fillters" class="col-12">
                <div class="d-flex justify-content-start bd-highlight mt-3">
                    <select class="form-control" id="search_by">
                        <option value="">-- Pilih --</option>
                        <option value="1">Most Recent</option>
                        <option value="2">Closing Soon</option>
                        <option value="3">Needs Submissions</option>
                        <option value="4">Payment Size</option>
                        <option value="5">Design Quality</option>
                    </select>
                    <select class="form-control mx-5" id="search_payment">
                        <option value="1">Any</option>
                        <option value="2">Guaranteed Only</option>
                    </select>
                    <div>
                        <button type="button" class="btn btn-secondary" id="reset_fillter">Reset Fillters</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="card">
                    <table class="table card-table table-vcenter" id="store">
                        @foreach ($project as $itemproject)
                        @php
                            if ($itemproject->catagories_project == 'contest') {
                                $data       = DB::table('detail_contests')->where('project_id',$itemproject->id)->first();
                                $catagories = DB::table('catagories')->where('id',$data->catagories)->first();
                                $sub        = DB::table('sub_catagories')->where('id',$data->catagories)->first();
                                $desainers  = DB::table('result_contests')->where('contest_id',$itemproject->id)->distinct()->count('user_id_worker');
                                $desains    = DB::table('result_contests')->where('contest_id',$itemproject->id)->count();
                                $nilai      = DB::table('result_contests')->where('contest_id',$itemproject->id)->having('nilai','>',4)->count('nilai');
                                $role       = 'contest';
                            } else {
                                $desainers  = DB::table('result_projects')->where('contest_id',$itemproject->id)->distinct()->count('user_id_worker');
                                $desains    = DB::table('result_projects')->where('contest_id',$itemproject->id)->count();
                                $data       = DB::table('detail_projects')->where('project_id',$itemproject->id)->first();
                                $job        = DB::table('job_catagories')->where('id',$data->job_description)->first();
                                $nilai      = DB::table('result_projects')->where('contest_id',$itemproject->id)->having('nilai','>',4)->count('nilai');
                                $role       = 'direct';
                            }
                            $day            = date('d',strtotime($itemproject->deadline));
                            $month          = date('m',strtotime($itemproject->deadline));
                            $year           = date('Y',strtotime($itemproject->deadline));
                            $time           = (int)((mktime (0,0,0,$month,$day,$year) - time())/86400);
                        @endphp
                        <tr id="browsetable" data-url="{{'/brief' . $role . '/' . $itemproject->id}}">
                            <td width="200px">
                                @if ($data->thumbnail)
                                <img src="{{asset('/storage/' . $itemproject->catagories_project  . '/' . $data->thumnail)}}" alt="" >
                                @else
                                <img src="{{asset('assets/dashboard/images/defaultopen.jpg')}}" alt="">
                                @endif
                            </td>
                            <td width="750px">
                                <div class="d-flex flex-column bd-highlight mt-4">
                                    <div class="bd-highlight">
                                        <h3>{{$itemproject->title}}</h3>
                                    </div>
                                    <div class="bd-highlight">
                                        <p class="text-justify">{{$data->description}}</p>
                                    </div>
                                    @if ($itemproject->catagories_project == 'contest')
                                    <div class="bd-highlight">
                                        <p class="text-justify  btn btn-outline-danger">{{$itemproject->catagories}}</p>
                                        <p class="text-justify  btn btn-outline-info">{{$sub->name}}</p>
                                    </div>
                                    @else
                                    <div class="bd-highlight">
                                        <p class="text-justify btn btn-outline-secondary">{{$itemproject->catagories}}</p>
                                        <p class="text-justify btn btn-outline-primary">{{$job->name}}</p>
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column bd-highlight mt-4">
                                    <div class="bd-highlight">
                                         <p><i class="fa fa-money"></i> ${{$data->harga}}</p>
                                    </div>
                                    <div class="bd-highlight">
                                        <p><i class="fe fe-clock"></i> Under {{$time}} Hari</p>
                                    </div>
                                    <div class="bd-highlight">
                                        <p><i class="fa fa-image"></i> {{$desains}} Desain</p>
                                    </div>
                                    <div class="bd-highlight">
                                        <p><i class="fa fa-user"></i> {{$desainers}} Desainer</p>
                                    </div>
                                    <div class="bd-highlight">
                                        <p><i class="fa fa-star"></i> {{$nilai}} + star ratings</p>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </table>
                    {{$project->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
