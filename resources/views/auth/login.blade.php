@extends('layouts.appauth')
@section('content')
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    <img src="{{url('assets/auth/img/logo.jpg')}}" alt="logo">
                </div>
                <div class="card fat">
                    <div class="card-body">
                        <h4 class="card-title">Login</h4>
                        <form method="POST" class="my-login-validation" novalidate="" action="{{route('login')}}">
                            @csrf
                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
                            </div>

                            <div class="form-group">
                                <label for="password">Password
                                    <a href="{{route('password.request')}}" class="float-right">
                                        Forgot Password?
                                    </a>
                                </label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >
                            </div>

                            <div class="form-group m-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>
                            </div>
                            <div class="mt-4 text-center">
                                Don't have an account? <a href="{{route('register')}}">Create One</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="footer">
                    Copyright &copy; 2017 &mdash; Your Company
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
