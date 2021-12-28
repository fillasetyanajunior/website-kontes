@extends('layouts.layouts_dashboard')
@section('title',$title)
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-profile">
                    <div class="card-header"
                        style="background-image: white;">
                    </div>
                    <div class="card-body text-center">
                        @if ($worker->avatar != 'default.jpg')
                        <img class="card-profile-img" src="{{asset('/storage/profile/' . $worker->avatar)}}" >
                        @else
                        <img class="card-profile-img" src="{{url('assets/dashboard/images/default.jpg')}}" >
                        @endif
                        <h3 class="mb-3">{{$worker->name}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <form class="card" action="/worker/setting/profile/update/{{$worker->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <h3 class="card-title">Edit Profile</h3>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Worker ID</label>
                                    <input type="text" class="form-control" placeholder="Worker ID" value="{{$worker->worker_id}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email address</label>
                                    <input type="email" class="form-control" placeholder="Email" value="{{$worker->email}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" value="{{$worker->name}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Paypal Account</label>
                                    <input type="text" class="form-control" name="paypal" placeholder="Account Paypal"
                                        value="{{$worker->paypal}}" >
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-12">
                                <div class="form-group">
                                    <label for="avatar">Foto Profile</label>
                                    <input type="file" class="form-control-file" id="avatar" name="avatar">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-12">
                                <div class="form-group">
                                    <label for="avatar">Location</label>
                                    <input type="text" class="form-control-file" id="locationcustomer" value="{{$worker->location}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
