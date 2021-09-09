@extends('layouts.layouts_dashboard')
<x-slidebar></x-slidebar>
@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Accounting
            </h1>
        </div>
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $project->options['chart_title'] }}</h3>
                </div>
                <div class="card-body">
                    {!! $project->renderHtml() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $income->options['chart_title'] }}</h3>
                </div>
                <div class="card-body">
                    {!! $income->renderHtml() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $worker->options['chart_title'] }}</h3>
                </div>
                <div class="card-body">
                    {!! $worker->renderHtml() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $customer->options['chart_title'] }}</h3>
                </div>
                <div class="card-body">
                    {!! $customer->renderHtml() !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! $project->renderJs() !!}
{!! $income->renderJs() !!}
{!! $worker->renderJs() !!}
{!! $customer->renderJs() !!}
@endsection
