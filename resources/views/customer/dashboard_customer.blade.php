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
                            <h4 class="m-0"> <small></small></h4>
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
                @if (request()->user()->role == 'customer')
                <div class="d-flex flex-row bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        <button type="button" id="tambahcontestproject" class="btn btn-orange" data-toggle="modal"data-target="#projectModal">Add Project Contest</button>
                    </div>
                    <div class="p-2 bd-highlight">
                        <button type="button" id="tambahdirectproject" class="btn btn-lime" data-toggle="modal"data-target="#projectModal">Add Direct Contest</button>
                    </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Project Running</h3>
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
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                    foreach($project as $itemproject) :
                                    $desainers    = DB::table('result_contests')->where('contest_id',$itemproject->id)->distinct()->count('user_id_worker');
                                    $desains      = DB::table('result_contests')->where('contest_id',$itemproject->id)->count();
                                @endphp
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itemproject->title}}</td>
                                    <td>
                                        @if ($itemproject->catagories_project == 1)
                                            Contest Project
                                        @else
                                            Direct Project
                                        @endif
                                    </td>
                                    <td>
                                        {{$desains}}
                                    </td>
                                    <td>
                                        {{$desainers}}
                                    </td>
                                    <td>
                                        {{date('d M, Y',strtotime($itemproject->created_at))}}
                                    </td>
                                    <td>
                                        {{date('d M, Y',strtotime($itemproject->deadline))}}
                                    </td>
                                    <td>
                                        @if ($itemproject->is_active == 'waiting payment')
                                        <a class="btn btn-warning btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                        @elseif ($itemproject->is_active == 'running')
                                        <a class="btn btn-success btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                        @elseif ($itemproject->is_active == 'choose winner')
                                        <a class="btn btn-azure btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                        @elseif ($itemproject->is_active == 'handover')
                                        <a class="btn btn-primary btn-sm text-white text-uppercase">{{$itemproject->is_active}}</a>
                                        @elseif ($itemproject->is_active == 'close')
                                        <a class="btn btn-secondary btn-sm text-uppercase">{{$itemproject->is_active}}</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="body_contest">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="catagories_project">
                        <div class="form-group">
                            <label for="title">Title Contest</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Contest</label>
                            <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="catagories">Catagories</label>
                            <select class="form-control custom-select" id="catagories" name="catagories">
                                <option value="">-- Pilih Catagories --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="thumbnail">File Backgound</label>
                            <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
                            <small id="emailHelp" class="form-text text-muted">Opsional</small>
                        </div>
                    </div>
                    <div class="modal-footer footer_contest">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
