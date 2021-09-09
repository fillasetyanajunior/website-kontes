@extends('layouts.appauth')
@section('title','Create Account')
@section('content')
<div class="page-single">
    <div class="container">
        <div class="row">
            <div class="col col-login mx-auto">
                <div class="text-center mb-6">
                    <img src="{{url('assets/auth/img/logo.jpg')}}" class="h-6" alt="">
                </div>
                <form class="card" action="{{route('register')}}" method="post">
                    @csrf
                    <div class="card-body p-6">
                        <div class="card-title">Create new account</div>
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{old('name')}}" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{old('email')}}" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label class="form-label">New Password Confirm</label>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="role" value="1" class="selectgroup-input">
                                    <span class="selectgroup-button text-capitalize">i'm a worker</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="role" value="2" class="selectgroup-input">
                                    <span class="selectgroup-button text-capitalize">i'm a customer</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="agree" />
                                <span class="custom-control-label">Agree the <a href="terms.html">terms and
                                        policy</a></span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block" id="register">Create new
                                account</button>
                        </div>
                    </div>
                </form>
                <div class="text-center text-muted">
                    Already have account? <a href="{{route('login')}}">Sign in</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
