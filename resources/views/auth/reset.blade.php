@extends('layouts.appauth')
@section('content')
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-md-center align-items-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    <img src="img/logo.jpg" alt="bootstrap 4 login page">
                </div>
                <div class="card fat">
                    <div class="card-body">
                        <h4 class="card-title">Reset Password</h4>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" class="my-login-validation" novalidate="" action="{{route('password.update')}}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->token }}">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ $request->email ?? old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="new-password">New Password</label>
                                <input id="new-password" type="password" class="form-control" name="password">
                                <div class="form-text text-muted">
                                    Make sure your password is strong and easy to remember
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation ">Password Confirm</label>
                                <input id="password_confirmation " type="password" class="form-control" name="password_confirmation ">
                            </div>

                            <div class="form-group m-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Reset Password
                                </button>
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
