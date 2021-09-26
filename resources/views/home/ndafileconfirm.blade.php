@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row row-cards">
            <div class="col-lg-12">
                <h2 class="text-center my-5">Non Disclosure Agreement</h2>
                <div class="card">
                    <div class="card-body ">
                        <p class="text-justify text-center">{!!nl2br(str_replace("{}", " \n", $fileperjanjian->perjanjian))!!}</p>
                        <div class="text-center">
                            <a href="/briefcontest/{{$id}}" class="btn btn-primary text-uppercase">i agree with the terms the agreement above</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
