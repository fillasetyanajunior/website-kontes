@extends('layouts.layouts_dashboard')
@section('title',$title)
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row row-cards">
            <div class="col-lg-12">
                <h2 class="text-center my-5">Non Disclosure Agreement</h2>
                <div class="card">
                    <div class="card-body">
                        <center>
                            <p class="text-capitalize col-8">to view the brief for this project a Non Disclosure Agreement (NDA) needs to be agreed
                                to. Please enter your full name below and click 'Continue' to view the NDA before agreeing to it.
                            </p>
                            <h5 class="text-capitalize">note: by clicking 'Continue' you are not yet agreeing to the document.</h5>
                            <a href="/briefnda/perjanjianfileconfirm/{{Crypt::encrypt($id)}}" class="btn btn-primary text-uppercase mt-2">Continue</a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
