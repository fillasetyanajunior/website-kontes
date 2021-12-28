@extends('layouts.appauth')
@section('title','Reset Password')
@section('content')
<div class="page-single">
    <div class="container">
        <div class="row">
            <div class="col col-login mx-auto">
                <div class="text-center mb-6">
                    <img src="{{url('assets/dashboard/images/logo3.png')}}" width="200px">
                </div>
                <form class="card" action="{{route('password.update')}}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->token }}">
                    <div class="card-body p-6">
                        <div class="card-title">Reset Password</div>
                        <div class="form-group">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $request->email ?? old('email') }}" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label class="form-label">New Password Confirm</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Password">
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
