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
                        <span class="login100-form-title p-b-70">
                            Verification Your Email Address
                        </span>
                        @if (session('status'))
                            <div class="alert-success">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @else
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                            </form>
                        @endif
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
