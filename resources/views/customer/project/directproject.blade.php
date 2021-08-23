@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Dashboard
            </h1>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="/directproject/store" id="myForm" role="form" method="post" accept-charset="utf-8"
            enctype="multipart/form-data">
            @csrf
            <!-- SmartWizard html -->
            <input type="hidden" name="totalcost">
            <div id="smartwizard">
                <ul>
                    <li><a href="#step-1">Step 1<br /><small>Creative Brief</small></a></li>
                    <li><a href="#step-2">Step 2<br /><small>Payment Opsions</small></a></li>
                </ul>

                <div>
                    <div id="step-1">
                        <div class="text-center">
                            <h2>Describe the project you need?</h2>
                            <p>Let's get started with some basic information about your project</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Name Your Project</label>
                            <input type="text" class="form-control" name="title"
                                placeholder="Enter a description title for your logo design project"
                                value="{{old('title')}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Task description</label>
                            <textarea class="form-control" name="description" rows="6"
                                placeholder="Describe what you need and tell us a bit about your requrements">{{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="form-label">Upload files <small>Opsional</small></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Job Description</label>
                            <select name="job_description" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach ($jobcatagories as $itemjobcatagories)
                                <option value="{{$itemjobcatagories->id}}" data-name="{{$itemjobcatagories->name}}">{{$itemjobcatagories->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Budget</label>
                            <input type="text" class="form-control" name="budget" value="{{old('budget')}}"
                                placeholder="Enter Budget in US$">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Timeline</label>
                            <input type="text" class="form-control" name="timeline" value="{{old('timeline')}}"
                                placeholder="Enter your timeline work in days">
                        </div>
                    </div>
                    <div id="step-2">
                        <div class="text-center">
                            <h2>Confirm project details</h2>
                        </div>
                        <div class="card-body ">
                            <div class="d-flex justify-content-center">
                                <div class="d-flex flex-column bd-highlight col-6">
                                    <div class="form-group">
                                        <label class="form-label">Project Name</label>
                                        <input type="text" class="form-control" id="projectname" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Desain Required</label>
                                        <input type="text" class="form-control" id="desainrequired" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Total Project Cost</label>
                                        <input type="text" class="form-control " id="totalcost" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h2>Payment Method</h2>
                        </div>
                        <div class="card-body ">
                            <div class="d-flex justify-content-center">
                                <div class="d-flex flex-column bd-highlight col-6">
                                    <div class="form-group">
                                        <label class="form-label">Nama Pengirim</label>
                                        <input type="text" class="form-control" name="namepengirimpayment">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nomer Paypal/CC/Dll</label>
                                        <input type="text" class="form-control" name="nomerpayment">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
