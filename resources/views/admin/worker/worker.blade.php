@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Management Worker
            </h1>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Worker</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Worker ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status Account</th>
                                    <th>Suspend</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($worker as $itemworker)
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itemworker->worker_id}}</td>
                                    <td>{{$itemworker->name}}</td>
                                    <td>{{$itemworker->email}}</td>
                                    <td class="text-capitalize">{{$itemworker->status_account}}</td>
                                    <td>
                                        @if ($itemworker->suspend != null)
                                        {{date('d M, Y',strtotime($itemworker->suspend))}}
                                        @endif
                                    </td>
                                    <td width="100px">
                                        <button type="button" data-toggle="modal" id="viewaccount" data-target="#ProfileWorker" class="btn btn-primary btn-sm text-white" data-url="{{url('storage')}}"  data-id="{{$itemworker->id}}">View</button>
                                        <form action="/managementworker/statusaccount/{{$itemworker->id}}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('put')
                                            @if ($itemworker->status_account == 'unverified')
                                            <button type="submit"
                                                class="btn btn-success btn-sm text-white">Verified</button>
                                            @else
                                            <button type="submit"
                                                class="btn btn-success btn-sm text-white">Unverified</button>
                                            @endif
                                        </form>
                                        @if ($itemworker->suspend == null)
                                        <button type="button" id="editworker" data-id="{{$itemworker->id}}"
                                            data-toggle="modal" data-target="#WorkerManagement"
                                            class="btn btn-warning btn-sm text-white">Suspend</button>
                                        @endif
                                        <form action="/managementworker/deleteaccount/{{$itemworker->id}}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="btn btn-danger btn-sm text-white">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                        {{$worker->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="WorkerManagement" tabindex="-1" aria-labelledby="WorkerManagementLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="WorkerManagementLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="body_worker">
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="suspend">Suspend</label>
                            <select class="form-control" id="suspend" name="suspend">
                                <option value="">-- Pilih Suspend --</option>
                                <option value="1">Bulan 1</option>
                                <option value="2">Bulan 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer footer_worker">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ProfileWorker" tabindex="-1" aria-labelledby="ProfileWorkerLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="body_feedback">
                <div class="modal-body">
                    <div class="mt-5">
                        <div class="card card-profile">
                            <div class="card-header"
                                style="background-image: url({{url('assets/dashboard/images/thumbnail.jpg')}});">
                            </div>
                            <div class="card-body text-left">
                                <img class="card-profile-img " id="workerprofile"  src="">
                                <h3 class="mb-3"></h3>
                                <div class="d-flex flex-wrap">
                                    <div class="form-group mr-5">
                                        <label class="form-label">Location</label>
                                        <div class="form-control-plaintext" id="location"></div>
                                    </div>
                                    <div class="form-group mx-5">
                                        <label class="form-label">Rangked</label>
                                        <div class="form-control-plaintext" id="rangking"></div>
                                    </div>
                                    <div class="form-group mx-5">
                                        <label class="form-label">Earnings</label>
                                        <div class="form-control-plaintext" id="earnings">
                                        </div>
                                    </div>
                                    <div class="form-group mx-5">
                                        <label class="form-label">Rating</label>
                                        <div class="form-control-plaintext" id="rating">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4>Portfolio</h4>
                    <div class="row row-cards" id="portfolio">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
