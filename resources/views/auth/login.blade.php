@extends('layouts.appauth')
@section('title','Login')
@section('content')
<div class="page-single">
    <div class="container">
        <div class="row">
            <div class="col col-login mx-auto">
                <div class="text-center mb-6">
                    <img src="{{url('assets/dashboard/images/logo3.png')}}" width="200px">
                </div>
                <form class="card" action="{{route('login')}}" method="post">
                    @csrf
                    <div class="card-body p-6">
                        <div class="card-title">Login to your account</div>
                        <div class="form-group">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{old('email')}}" id="email"
                                placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                Password
                                <a href="{{route('password.request')}}" class="float-right small">I forgot password</a>
                            </label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                name="password" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                        </div>
                    </div>
                </form>
                <div class="text-center text-muted">
                    Don't have account yet? <a href="{{route('register')}}">Sign up</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
