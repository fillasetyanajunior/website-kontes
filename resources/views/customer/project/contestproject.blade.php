@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Create Your Contest Project
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
                    <form action="/contestproject/store" method="post" class="f1" enctype="multipart/form-data">
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
                            <div class="f1-step active">
                                <div class="f1-step-icon">1</div>
                                <p>Project Detail</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon">2</div>
                                <p>Creative Brief</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon">3</div>
                                <p>Desain Opsions</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon">4</div>
                                <p>Payment Opsions</p>
                            </div>
                        </div>
                        <!-- step 1 -->
                        <fieldset>
                            <div class="text-center">
                                <h2>What design do you need?</h2>
                                <p>select the type of contest design you need designed</p>
                            </div>
                            <div class="form-group mt-3">
                                <div class="row gutters-sm">
                                    @foreach ($catagories as $itemcatagories)
                                    <div class="col-lg-3 col-sm-3">
                                        <label class="imagecheck mb-4">
                                            <input type="radio" value="{{$itemcatagories->id}}"
                                                class="imagecheck-input" name="catagories" id="catagories"
                                                data-name="{{$itemcatagories->name}}"
                                                data-harga="{{$itemcatagories->harga}}">
                                            <figure class="imagecheck-figure">
                                                <div class="card-body imagecheck-image">
                                                    <div class="d-flex flex-row bd-highlight">
                                                        <div class="p-2 bd-highlight align-self-center">
                                                            <i class="fa {{$itemcatagories->icon}}" style="font-size: 50pt"></i>
                                                        </div>
                                                        <div class="p-2 bd-highlight align-self-center">
                                                            <div class="d-flex flex-column bd-highlight">
                                                                <div class="bd-highlight">{{$itemcatagories->name}}
                                                                </div>
                                                                <div class="bd-highlight">from
                                                                    ${{$itemcatagories->harga}}
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
                                <button type="button" class="btn btn-primary btn-next">Selanjutnya <i
                                        class="fa fa-arrow-right"></i></button>
                            </div>
                        </fieldset>
                        <!-- step 2 -->
                        <fieldset>
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
                                    <input type="file" class="custom-file-input" name="file[]" multiple>
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label text-capitalize">should have <small>Opsional</small></label>
                                <textarea class="form-control" name="shouldhave" rows="6"
                                    placeholder="Describe what you need and tell us a bit about your requrements">{{old('shouldhave')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label text-capitalize">should not have
                                    <small>Opsional</small></label>
                                <textarea class="form-control" name="shouldnothave" rows="6"
                                    placeholder="Describe what you need and tell us a bit about your requrements">{{old('shouldnothave')}}</textarea>
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
                                <button type="button" class="btn btn-primary btn-next ml-2">Selanjutnya <i
                                        class="fa fa-arrow-right"></i></button>
                                <button type="button" class="btn btn-warning btn-previous mr-2"><i
                                        class="fa fa-arrow-left"></i>
                                    Sebelumnya</button>
                            </div>
                        </fieldset>
                        <!-- step 3 -->
                        <fieldset>
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
                                                    <input type="radio" name="addpackage"
                                                        value="{{$itemopsipackage->id}}"
                                                        data-harga="{{$itemopsipackage->harga}}"
                                                        class="selectgroup-input" id="addpackage">
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
                                                <td><i class="fa {{$itemopsipackageupgrade->icon}}" style="font-size: 50pt"></i></td>
                                                <td class="text-justify">
                                                    <div class="d-flex flex-column bd-highlight mb-3">
                                                        <div class="bd-highlight">
                                                            <h4>{{$itemopsipackageupgrade->name}}</h4>
                                                        </div>
                                                        <div class="bd-highlight">
                                                            <p class="text-justify">
                                                                {{$itemopsipackageupgrade->description}}
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
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td width="120px">
                                                            <label for="coupon">Discount Code</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"id="coupon" name="coupon">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card">
                                        <table class="table card-table table-vcenter">
                                            <tr>
                                                <td>Selected Package</td>
                                                <td id="selectedpackageprice"></td>
                                            </tr>
                                            {{-- <tr>
                                                    <td>Add Bisnis Card Desain</td>
                                                    <td id="addbisniscard"></td>
                                                </tr> --}}
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
                                                        <p>Get the design you want ot your money back. conditions apply
                                                            - <a href="">see our refund policy</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="f1-buttons mt-5 d-flex flex-row-reverse">
                                <button type="button" class="btn btn-primary btn-next ml-2">Selanjutnya <i
                                        class="fa fa-arrow-right"></i></button>
                                <button type="button" class="btn btn-warning btn-previous mr-2"><i
                                        class="fa fa-arrow-left"></i>
                                    Sebelumnya</button>
                            </div>
                        </fieldset>
                        <!-- step 4 -->
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