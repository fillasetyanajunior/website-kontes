@extends('layouts.appauth')
@section('title','Verify Email')
@section('content')
<div class="page-single">
    <div class="container">
        <div class="row">
            <div class="col col-login mx-auto">
                <div class="text-center mb-6">
                    <img src="{{url('assets/auth/img/logo.jpg')}}" class="h-6" alt="">
                </div>
                <div class="card">
                    <div class="card-body p-6">
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
            </div>
        </div>
    </div>
</div>
@endsection
