@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Create Your Direct Project
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
        <div class="" style="text-align: center;">
            <div class="row">
                <div class="col-md-12 col-md-offset-1 my-5">
                    <form action="/directproject/store" method="post" class="f1" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="totalcost">
                        <input type="hidden" name="id_transaksi">
                        <input type="hidden" name="name_transaksi">
                        <input type="hidden" name="email_transaksi">
                        <div class="f1-steps">
                            <div class="f1-progress">
                                <div class="f1-progress-line" data-now-value="25" data-number-of-steps="4"
                                    style="width: 25%;">
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div class="f1-step active">
                                    <div class="f1-step-icon">1</div>
                                    <p>Project Detail</p>
                                </div>
                                <div class="f1-step">
                                    <div class="f1-step-icon">2</div>
                                    <p>Payment Opsions</p>
                                </div>
                            </div>
                        </div>
                        <!-- step 1 -->
                        <fieldset>
                            <div class="text-center">
                                <h2>Describe the project you need?</h2>
                                <p>Let's get started with some basic information about your project</p>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
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
                                            <input type="file" class="custom-file-input" name="file[]" multiple>
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-capitalize">should have
                                            <small>Opsional</small></label>
                                        <textarea class="form-control" name="shouldhave" rows="6"
                                            placeholder="Describe what you need and tell us a bit about your requrements">{{old('shouldhave')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-capitalize">should not have
                                            <small>Opsional</small></label>
                                        <textarea class="form-control" name="shouldnothave" rows="6"
                                            placeholder="Describe what you need and tell us a bit about your requrements">{{old('shouldnothave')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Job Description</label>
                                        <select name="job_description" class="form-control">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($jobcatagories as $itemjobcatagories)
                                            <option value="{{$itemjobcatagories->id}}" data-name="{{$itemjobcatagories->name}}">
                                                {{$itemjobcatagories->name}}</option>
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
                                <div class="col-lg-4 mt-5">
                                    <div class="card">
                                        <table class="table card-table table-vcenter">
                                            <tr>
                                                <td>Budget</td>
                                                <td id="budget"></td>
                                            </tr>
                                            <tr>
                                                <td>Transaction Fee</td>
                                                <td id="transaction"></td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td id="total"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="mt-5 mb-5">
                                        <div class="d-flex justify-content-center">
                                            <div class="d-flex align-items-center">
                                                <img src="{{url('assets/dashboard/formwizard/guarantee.png')}}" alt=""
                                                    width="200px">
                                                <div class="d-flex flex-column">
                                                    <div class="">
                                                        <h4>Money back guarantee</h4>
                                                    </div>
                                                    <div class="">
                                                        <p>Get the design you want ot your money back. conditions
                                                            apply
                                                            - <a href="">see our refund policy</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="f1-buttons mt-5 d-flex flex-row-reverse">
                                <button type="button" class="btn btn-primary btn-next">Selanjutnya <i
                                        class="fa fa-arrow-right"></i></button>
                            </div>
                        </fieldset>
                        <!-- step 2 -->
                        <fieldset>
                            <div class="d-flex justify-content-center">
                                <div class="card col-lg-6">
                                    <div class="text-center mt-3">
                                        <h2>Confirm project details</h2>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Project Name</th>
                                                    <td id="projectname"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Desain Required</th>
                                                    <td id="desainrequired"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Total Project Cost</th>
                                                    <td id="totalcost"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td><a href=""> Why do you have to pay upfront</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="card col-lg-6">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h2>Payment Method</h2>
                                        </div>
                                        <div id="paypal-button-container"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 mb-5">
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex align-items-center">
                                        <img src="{{url('assets/dashboard/formwizard/guarantee.png')}}" alt=""
                                            width="200px">
                                        <div class="d-flex flex-column">
                                            <div class="ml-3">
                                                <h4>Money back guarantee</h4>
                                            </div>
                                            <div class="col-lg-7">
                                                <p>Get the design you want ot your money back. conditions apply - <a
                                                        href="">see our refund policy</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="f1-buttons mt-5 d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i>
                                    Submit</button>
                                <button type="button" class="btn btn-warning btn-previous mr-2"><i
                                        class="fa fa-arrow-left"></i>
                                    Sebelumnya</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
