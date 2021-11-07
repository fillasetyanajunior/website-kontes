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
        <div class="row mb-2">
            <div class="col-lg-4 mt-2">
                <div class="input-icon">
                    <input type="search" class="form-control" placeholder="What are you looking for?" id="search_text">
                    <div class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-2">
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
            <div class="col-lg-2 mt-2">
                <select class="form-control" id="search_status">
                    <option value="">-- Pilih --</option>
                    <option value="6">Open Jobs ({{$totalproject}})</option>
                    <option value="7">Close Jobs ({{$totalcloseproject}})</option>
                </select>
            </div>
            <div class="col-lg-2 mt-2">
                <button type="button" class="btn btn-secondary col-lg-12" id="button_fillter">Show Fillters</button>
            </div>
        </div>
        <div id="show_fillters" class="row mb-5">
            <div class="col-lg-5 mt-2">
                <select class="form-control" id="search_by">
                    <option value="">-- Pilih Search By --</option>
                    <option value="1">Most Recent</option>
                    <option value="2">Closing Soon</option>
                    <option value="3">Needs Submissions</option>
                    <option value="4">Payment Size</option>
                    <option value="5">Design Quality</option>
                </select>
            </div>
            <div class="col-lg-5 mt-2">
                <select class="form-control" id="search_payment">
                    <option value="">-- Pilih Search Payment --</option>
                    <option value="8">Any</option>
                    <option value="9">Guaranteed Only</option>
                </select>
            </div>
            <div class="col-lg-2 mt-2">
                <button type="button" class="btn btn-secondary col-lg-12" id="reset_fillter">Reset Fillters</button>
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
                                $datas      = DB::table('result_contests')->where('contest_id',$itemproject->id)->where('is_active','winner')->first();
                                $catagories = DB::table('catagories')->where('id',$data->catagories)->first();
                                $sub        = DB::table('sub_catagories')->where('id',$data->catagories)->first();
                                $desainers  = DB::table('result_contests')->where('contest_id',$itemproject->id)->distinct()->count('user_id_worker');
                                $desains    = DB::table('result_contests')->where('contest_id',$itemproject->id)->count();
                                $nilai      = DB::table('result_contests')->where('contest_id',$itemproject->id)->having('nilai','>',4)->count('nilai');
                                $role       = 'contest';
                                $projectupgrade = explode('/',$data->packageupgrade);
                            } else {
                                $data       = DB::table('detail_projects')->where('project_id',$itemproject->id)->first();
                                $datas      = DB::table('result_projects')->where('contest_id',$itemproject->id)->where('is_active','winner')->first();
                                $desainers  = DB::table('result_projects')->where('contest_id',$itemproject->id)->distinct()->count('user_id_worker');
                                $desains    = DB::table('result_projects')->where('contest_id',$itemproject->id)->count();
                                $job        = DB::table('job_catagories')->where('id',$data->job_description)->first();
                                $nilai      = DB::table('result_projects')->where('contest_id',$itemproject->id)->having('nilai','>',4)->count('nilai');
                                $role       = 'direct';
                                $projectupgrade = null;
                            }
                            $day            = date('d',strtotime($itemproject->deadline));
                            $month          = date('m',strtotime($itemproject->deadline));
                            $year           = date('Y',strtotime($itemproject->deadline));
                            $time           = (int)((mktime (0,0,0,$month,$day,$year) - time())/86400);
                            $fee            = ((15/100) * $itemproject->harga);
                            $harga          = $itemproject->harga - $fee;
                        @endphp
                        @if ($projectupgrade == null)
                            <tr id="browsetable" data-url="{{'/brief' . $role . '/' . $itemproject->id}}">
                        @elseif ($data->packageupgrade == null)
                            <tr id="browsetable" data-url="{{'/brief' . $role . '/' . $itemproject->id}}">
                        @else
                            @for ($i = 0; $i < count($projectupgrade); $i++)
                                @php
                                    $upgrade = DB::table('opsi_package_upgrades')->where('id',$projectupgrade[$i])->first()
                                @endphp
                                @if ($upgrade->name == 'Non Disclosure Agreement (NDA)')
                                    <tr id="browsetable" data-url="{{'/briefnda/' . $itemproject->id}}">
                                @else
                                    <tr id="browsetable" data-url="{{'/brief' . $role . '/' . $itemproject->id}}">
                                @endif
                            @endfor
                        @endif
                            <td width="200px" class="d-none d-md-table-cell text-nowrap">
                                @if ($itemproject->catagories_project == 'contest')
                                    @if ($datas != null)
                                        <img src="{{asset('storage/resultcontest/' . $datas->filecontest)}}" alt="">
                                    @else
                                        <img src="{{url('assets/dashboard/images/opencontest.jpg')}}" alt="">
                                    @endif
                                @else
                                    @if($datas != null)
                                        <img src="{{url('assets/dashboard/images/winnerdirect.jpg')}}" alt="">
                                    @else
                                        <img src="{{url('assets/dashboard/images/opendirect.png')}}" alt="">
                                    @endif
                                @endif
                            </td>
                            <td width="750px">
                                <div class="d-flex flex-column bd-highlight mt-4">
                                    <div class="bd-highlight">
                                        <h3>{{$itemproject->title}}</h3>
                                    </div>
                                    <div class="bd-highlight">
                                        <p class="text-justify">{{Str::limit($data->description,300)}}</p>
                                    </div>
                                    @if ($itemproject->catagories_project == 'contest')
                                    <div class="bd-highlight">
                                        <p class="text-justify  btn btn-outline-danger">{{$itemproject->catagories}}</p>
                                        <p class="text-justify  btn btn-outline-info">{{$sub->name}}</p>
                                        @if ($itemproject->guarded == 'active')
                                            <p class="text-justify btn btn-outline-secondary">Guaranteed Only</p>
                                        @endif
                                    </div>
                                    @else
                                    <div class="bd-highlight">
                                        <p class="text-justify btn btn-outline-info">{{$itemproject->catagories}}</p>
                                        <p class="text-justify btn btn-outline-primary">{{$job->name}}</p>
                                        @if ($itemproject->guarded == 'active')
                                            <p class="text-justify btn btn-outline-secondary">Guaranteed Only</p>
                                        @endif
                                    </div>
                                    @endif

                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column bd-highlight mt-4">
                                    <div class="bd-highlight">
                                         <p><i class="fa fa-money"></i> {{"$". number_format($harga)}}</p>
                                    </div>
                                    <div class="bd-highlight">
                                        <p><i class="fe fe-clock"></i> Under {{$time}} Days</p>
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
