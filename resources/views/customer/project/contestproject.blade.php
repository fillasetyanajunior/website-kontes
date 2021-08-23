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
        <form action="/contestproject/store" id="myForm" role="form" method="post" accept-charset="utf-8"
            enctype="multipart/form-data">
            @csrf
            <!-- SmartWizard html -->
            <input type="hidden" name="totalcost">
            <div id="smartwizard">
                <ul>
                    <li><a href="#step-1">Step 1<br /><small>Project Detail</small></a></li>
                    <li><a href="#step-2">Step 2<br /><small>Creative Brief</small></a></li>
                    <li><a href="#step-3">Step 3<br /><small>Desain Opsions</small></a></li>
                    <li><a href="#step-4">Step 4<br /><small>Payment Opsions</small></a></li>
                </ul>

                <div>
                    <div id="step-1">
                        <div class="text-center">
                            <h2>What design do you need?</h2>
                            <p>select the type of contest design you need designed</p>
                        </div>
                        <div class="form-group mt-3">
                            <div class="row gutters-sm">
                                @foreach ($catagories as $itemcatagories)
                                <div class="col-6 col-sm-4">
                                    <label class="imagecheck mb-4">
                                        <input type="radio" value="{{$itemcatagories->id}}{{old('catagories')}}"
                                            class="imagecheck-input" name="catagories" id="catagories"
                                            data-name="{{$itemcatagories->name}}"
                                            data-harga="{{$itemcatagories->harga}}">
                                        <figure class="imagecheck-figure">
                                            <div class="card-body imagecheck-image">
                                                <div class="d-flex flex-row bd-highlight">
                                                    <div class="p-2 bd-highlight align-self-center">
                                                        <i class="{{$itemcatagories->icon}}"></i>
                                                    </div>
                                                    <div class="p-2 bd-highlight align-self-center">
                                                        <div class="d-flex flex-column bd-highlight">
                                                            <div class="bd-highlight">{{$itemcatagories->name}}</div>
                                                            <div class="bd-highlight">from ${{$itemcatagories->harga}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </figure>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-center">
                            <h2>Package Contest</h2>
                        </div>
                        <div class="form-group mt-3">
                            <div class="row gutters-sm" id="subcata">

                            </div>
                        </div>
                    </div>
                    <div id="step-2">
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
                            <label class="form-label">Logo Text</label>
                            <input type="text" class="form-control" name="logo_text" value="{{old('logo_text')}}"
                                placeholder="What do you want your logo to say on it">
                        </div>
                        <div class="form-group">
                            <div class="form-label">Upload files <small>Opsional</small></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file">
                                <label class="custom-file-label">Choose file</label>

                            </div>
                        </div>
                    </div>
                    <div id="step-3">
                        <div class="text-center">
                            <h2>Which Logo package do you prefer?</h2>
                            <p>Choose a package that will get the result you desire</p>
                        </div>
                        <div class="row">
                            @foreach ($opsipackage as $itemopsipackage)
                            <div class="col-sm-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="card-category">{{$itemopsipackage->name}}</div>
                                        <div class="display-4 my-4">{{"$ ". number_format($itemopsipackage->harga)}}
                                        </div>
                                        <ul class="list-unstyled leading-loose">
                                            @php
                                            $description = explode(',',$itemopsipackage->description);
                                            for ($i=0; $i < count($description) ; $i++) : @endphp <li>
                                                {{$description[$i]}}</li>
                                                @php
                                                endfor;
                                                @endphp
                                        </ul>
                                        <div class="text-center mt-6">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="addpackage" value="{{$itemopsipackage->id}}"
                                                    data-harga="{{$itemopsipackage->harga}}" class="selectgroup-input"
                                                    id="addpackage">
                                                <span class="selectgroup-button">Choose plan</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <h2>Project Upgrades</h2>
                            <p>Choose to upgrade and improve your project below</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <table class="table card-table table-vcenter">
                                        @foreach ($opsipackageupgrade as $itemopsipackageupgrade)
                                        <tr>
                                            <td><i class="{{$itemopsipackageupgrade->icon}}"></i></td>
                                            <td class="text-justify">
                                                <div class="d-flex flex-column bd-highlight mb-3">
                                                    <div class="bd-highlight">
                                                        <h4>{{$itemopsipackageupgrade->name}}</h4>
                                                    </div>
                                                    <div class="bd-highlight">
                                                        <p class="text-justify">{{$itemopsipackageupgrade->description}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                {{"$ ". number_format($itemopsipackageupgrade->harga)}}</td>
                                            <td class="text-center align-middle">
                                                <label class="selectgroup-item" id="boxes">
                                                    <input type="checkbox" name="addprojectupgrades"
                                                        value="{{$itemopsipackageupgrade->id}}"
                                                        data-harga="{{$itemopsipackageupgrade->harga}}"
                                                        class="selectgroup-input" id="addprojectupgrades">
                                                    <span class="selectgroup-button">Add</span>
                                                </label>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <table class="table card-table table-vcenter">
                                        <tr>
                                            <td>Selected Package</td>
                                            <td id="selectedpackageprice"></td>
                                        </tr>
                                        <tr>
                                            <td>Add Bisnis Card Desain</td>
                                            <td id="addbisniscard"></td>
                                        </tr>
                                        <tr>
                                            <td>Transaction Fee</td>
                                            <td id="transaction"></td>
                                        </tr>
                                        <tr id="projectupgrades">
                                            <td>Project Upgrade</td>
                                            <td id="projectupgrade"></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td id="total"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="step-4" class="">
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
                                        <input type="text" class="form-control" id="totalcost" disabled>
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
