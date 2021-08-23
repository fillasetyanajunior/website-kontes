@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Brief Project
            </h1>
        </div>
        <div class="row row-cards">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            <div class="">
                                <i class="fa fa-money"></i>&nbsp;
                                {{"$ ". number_format($project->harga)}}
                            </div>
                            <div class="ml-3">
                                @php
                                $day = date('d',strtotime($project->deadline));
                                $month = date('m',strtotime($project->deadline));
                                $year = date('Y',strtotime($project->deadline));
                                $time = (int)((mktime (0,0,0,$month,$day,$year) - time())/86400);
                                $desainers =
                                DB::table('result_contests')->where('contest_id',$project->id)->distinct()->count('user_id_worker');
                                $desains = DB::table('result_contests')->where('contest_id',$project->id)->count();
                                @endphp
                                <i class="fe fe-clock"></i>&nbsp;
                                {{$time}} Hari
                            </div>
                            <div class="ml-3">
                                <i class="fa fa-image"></i>&nbsp;
                                {{$desains}} Desain
                            </div>
                            <div class="ml-3">
                                <i class="fa fa-user"></i>&nbsp;
                                {{$desainers}} Desainers
                            </div>
                        </div>
                        <hr>
                        <div>
                            <h4 class="text-capitalize">logo desain brief</h4>
                            <div class="text-justify">
                                {{$detailcontest->description}}
                            </div>
                        </div>
                        <hr>
                        <div>
                            <h4 class="text-capitalize">logo text</h4>
                            <p>{{$detailcontest->title_logo}}</p>
                        </div>
                        <hr>
                        <div>
                            <h4 class="text-capitalize">catagories</h4>
                            <p>{{$catagories->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-md-6 col-lg-12">
                        <a href="/gallerycontest/{{$project->id}}"
                            class="btn btn-primary text-capitalize mb-5 col-lg-12">see entries</a>
                        @if (request()->user()->role == 'admin')
                        <form action="/deletecontest/{{$project->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger col-lg-12 mb-5">Delete</button>
                        </form>
                        <form action="/lockedcontest/{{$project->id}}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-azure col-lg-12 mb-5">Locked Project</button>
                        </form>
                        <button type="button" class="btn btn-primary col-lg-12 mb-5" data-toggle="modal"
                            data-target="#ExtendedDeadline">Extended Deadline</button>
                        @endif
                    </div>
                    <div class="col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table card-table table-vcenter">
                                    <tr>
                                        <td>
                                            {{$subcatagories->name}}
                                        </td>
                                        <td>
                                            {{"$ ". number_format($subcatagories->harga)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{$opsi->name}}
                                        </td>
                                        <td>
                                            {{"$ ". number_format($opsi->harga)}}
                                        </td>
                                    </tr>
                                    @if ($detailcontest->opsiupgrade != null)
                                    <tr>
                                        <td>
                                            {{$opsiupgrade->name}}
                                        </td>
                                        <td>
                                            {{"$ ". number_format($opsiupgrade->harga)}}
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td>
                                            Transaction Fee
                                        </td>
                                        <td>
                                            $ 10
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Total Harga
                                        </td>
                                        <td>
                                            {{"$ ". number_format($project->harga)}}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ExtendedDeadline" tabindex="-1" aria-labelledby="ExtendedDeadlineLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ExtendedDeadlineLabel">Extened Deadline</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <form action="/extendeddeadlinecontest/{{$project->id}}" method="post">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="extended">Extended Deadline</label>
                        <input type="text" class="form-control" id="extended" name="extended">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
