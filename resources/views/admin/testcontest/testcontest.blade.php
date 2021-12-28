@extends('layouts.layouts_dashboard')
@section('title',$title)
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Worker Test
            </h1>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="d-flex mb-3">
                    <div class="ml-auto">
                        <input type="text" id="searchpaymentlist" class="form-control" placeholder="Search">
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List User Contest</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Name</th>
                                    <th>Status Account</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="resultpaymentlist">
                                @php
                                $i=1;
                                @endphp
                                @foreach ($testcontest as $itemtestcontest)
                                @php
                                    $user = DB::table('workers')->where('user_id',$itemtestcontest->user_id_worker)->first();
                                @endphp
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->status_account}}</td>
                                    <td width="100px">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" id="viewtest" data-id="{{$itemtestcontest->user_id_worker}}" data-url="{{asset('storage')}}"
                                            data-target="#ViewTestModal">View</button>
                                        <form action="/managementworker/statusaccount/{{$user->user_id}}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('put')
                                            @if ($user->status_account == 'unverified')
                                            <button type="submit"
                                                class="btn btn-success btn-sm text-white">Verified</button>
                                            @else
                                            <button type="submit"
                                                class="btn btn-success btn-sm text-white">Unverified</button>
                                            @endif
                                            <form action="/managementworker/deleteaccount/{{$user->id}}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="btn btn-danger btn-sm text-white">Delete</button>
                                        </form>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                        {{$testcontest->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ViewTestModal" tabindex="-1" aria-labelledby="ViewTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="body_feedback">
                <div class="modal-body">
                    <div class="mt-5">
                        <div class="card card-profile">
                            <div class="card-header"
                                style="background-image: white;">
                            </div>
                            <div class="card-body text-left">
                                <img class="card-profile-img " id="workerprofile"  src="">
                                <h3 class="mb-3"></h3>
                                <div class="d-flex flex-wrap">
                                    <div class="form-group mr-3">
                                        <label class="form-label">Location</label>
                                        <div class="form-control-plaintext" id="location"></div>
                                    </div>
                                    <div class="form-group mx-3">
                                        <label class="form-label">Rangked</label>
                                        <div class="form-control-plaintext" id="rangking"></div>
                                    </div>
                                    <div class="form-group mx-3">
                                        <label class="form-label">Earnings</label>
                                        <div class="form-control-plaintext" id="earnings">
                                        </div>
                                    </div>
                                    <div class="form-group mx-3">
                                        <label class="form-label">Rating</label>
                                        <div class="form-control-plaintext" id="rating">
                                        </div>
                                    </div>
                                    <div class="form-group mx-3">
                                        <label class="form-label">Status Online</label>
                                        <div class="form-control-plaintext" id="status"></div>
                                    </div>
                                    <div class="form-group mx-3">
                                        <label class="form-label">Status Account</label>
                                        <div class="form-control-plaintext text-capitalize" id="statusaccount"></div>
                                    </div>
                                    <div class="form-group mx-3">
                                        <label class="form-label">Once Suspend</label>
                                        <div class="form-control-plaintext" id="oncesuspend"></div>
                                    </div>
                                    <div class="form-group mx-3">
                                        <label class="form-label">Status Test</label>
                                        <div class="form-control-plaintext" id="statustest"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4>Recent Desain</h4>
                    <div class="row row-cards" id="portfolioview">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
