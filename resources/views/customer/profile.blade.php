@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-profile">
                    <div class="card-header"
                        style="background-image: url({{url('assets/dashboard/images/thumbnail.jpg')}});">
                    </div>
                    <div class="card-body text-center">
                        <img class="card-profile-img" src="{{asset('/storage/profile/' . $customer->avatar)}}">
                        <h3 class="mb-3">{{$customer->name}}</h3>
                        <p class="mb-4">
                            {{$customer->tagline}}
                        </p>
                        <button class="btn btn-outline-primary btn-sm">
                            <span class="fa fa-twitter"></span> Follow
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <form class="card" action="/customer/profile/update/{{$customer->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <h3 class="card-title">Edit Profile</h3>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Customer ID</label>
                                    <input type="text" class="form-control" id="customer_id" placeholder="Customer ID"
                                        value="{{$customer->customer_id}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{$customer->email}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name"
                                        value="{{$customer->name}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Teg Line</label>
                                    <input type="text" class="form-control" name="tagline" placeholder="Tag Line"
                                        value="{{$customer->tagline}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-12">
                                <div class="form-group">
                                    <label for="avatar">Foto Profile</label>
                                    <input type="file" class="form-control-file" id="avatar" name="avatar">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label class="form-label">About Me</label>
                                    <textarea rows="5" class="form-control"
                                        placeholder="Here can be your description" name="aboutme">{{$customer->aboutme}}</textarea>
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
