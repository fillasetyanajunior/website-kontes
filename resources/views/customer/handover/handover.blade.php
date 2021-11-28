@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Handover
            </h1>
        </div>
        @if (request()->user()->role == 'customer' && $project->is_active == 'handover' || request()->user()->role == 'admin' && $project->is_active == 'handover')
        <div class="card">
            <div class="card-body">
                <div class="d-flex ">
                    <div class="flex-grow-1 ">
                        <div class="alert alert-success">Make sure you have download all files</div>
                    </div>
                    <div class=" ml-5">
                        <form action="/handoverproject/confirm/{{$project->id}}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-primary text-uppercase">confirm handover</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-8">
                @php
                    $detail = DB::table('detail_projects')->where('project_id',$project->id)->first();
                @endphp
                @if (request()->user()->role == 'customer' && $project->is_active == 'handover' && $detail != null || request()->user()->role == 'admin' && $project->is_active == 'handover' && $detail != null)
                @php
                    $results = DB::table('result_projects')->where('contest_id',$project->id)->first();
                    $result = explode('/',$results->description)
                @endphp
                @if ($detail->hari != $result[2])
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex ">
                            <div class="flex-grow-1 ">
                                <div class="alert alert-success text-capitalize">Deadline time from project</div>
                            </div>
                            <div class=" ml-5">
                                <button type="button" class="btn btn-primary col-lg-12 mb-5 text-capitalize" data-toggle="modal"
                                data-target="#ExtendedDeadline">Deadline time</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif
                @if ($project->desaincard != null)

                @if ($project->desaincard == 'not active' && $project->is_active == 'handover' && request()->user()->role != 'worker')
                <div class="card">
                    <div class="card-body">
                        @if ($project->pilihandesain == null)
                        <form action="/handoverproject/submitdesaincard/{{$project->id}}" method="post" class="row">
                            @csrf
                            <div class="form-group col-lg-4">
                                <label for="pilihan1">Desain Card 1</label>
                                <select name="pilihan1" id="pilihan1" class="form-control">
                                    <option value="">-- Pilihan --</option>
                                    <option value="1">Business Card</option>
                                    <option value="2">Email Signature</option>
                                    <option value="3">Letterheads</option>
                                    <option value="4">Flayer</option>
                                    <option value="5">Invoices</option>
                                    <option value="6">Post Card</option>
                                    <option value="7">Facebook Cover</option>
                                    <option value="8">Facebook Post</option>
                                    <option value="9">Youtube Benners</option>
                                    <option value="10">Instagram Post</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="pilihan2">Desain Card 2</label>
                                <select name="pilihan2" id="pilihan1" class="form-control">
                                    <option value="">-- Pilihan --</option>
                                    <option value="1">Business Card</option>
                                    <option value="2">Email Signature</option>
                                    <option value="3">Letterheads</option>
                                    <option value="4">Flayer</option>
                                    <option value="5">Invoices</option>
                                    <option value="6">Post Card</option>
                                    <option value="7">Facebook Cover</option>
                                    <option value="8">Facebook Post</option>
                                    <option value="9">Youtube Benners</option>
                                    <option value="10">Instagram Post</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="pilihan3">Desain Card 3</label>
                                <select name="pilihan3" id="pilihan3" class="form-control">
                                    <option value="">-- Pilihan --</option>
                                    <option value="1">Business Card</option>
                                    <option value="2">Email Signature</option>
                                    <option value="3">Letterheads</option>
                                    <option value="4">Flayer</option>
                                    <option value="5">Invoices</option>
                                    <option value="6">Post Card</option>
                                    <option value="7">Facebook Cover</option>
                                    <option value="8">Facebook Post</option>
                                    <option value="9">Youtube Benners</option>
                                    <option value="10">Instagram Post</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary ml-auto mr-3 text-capitalize">Submit</button>
                        </form>
                        @else
                        @php
                            $projectdesaincard = explode('/',$project->pilihandesain);
                            for ($i=0; $i < count($projectdesaincard); $i++) {
                                if ($projectdesaincard[$i] == 1) {
                                    $pilihan[$i] = 'Business Card';
                                } elseif($projectdesaincard[$i] == 2){
                                    $pilihan[$i] = 'Email Signature';
                                } elseif($projectdesaincard[$i] == 3){
                                    $pilihan[$i] = 'Letterheads';
                                } elseif($projectdesaincard[$i] == 4){
                                    $pilihan[$i] = 'Flayer';
                                } elseif($projectdesaincard[$i] == 5){
                                    $pilihan[$i] = 'Invoices';
                                } elseif($projectdesaincard[$i] == 6){
                                    $pilihan[$i] = 'Post Card';
                                } elseif($projectdesaincard[$i] == 7){
                                    $pilihan[$i] = 'Facebook Cover';
                                } elseif($projectdesaincard[$i] == 8){
                                    $pilihan[$i] = 'Facebook Post';
                                } elseif($projectdesaincard[$i] == 9){
                                    $pilihan[$i] = 'Youtube Benners';
                                }elseif ($projectdesaincard[$i] == 10) {
                                    $pilihan[$i] = 'Instagram Post';
                                }else{
                                    $pilihan[$i] = '';
                                }
                            }
                        @endphp
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="pilihan1">Desain Card 1</label>
                                <input type="text" value="{{$pilihan[0]}}" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="pilihan2">Desain Card 2</label>
                                <input type="text" value="{{$pilihan[1]}}" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="pilihan3">Desain Card 3</label>
                                <input type="text" value="{{$pilihan[2]}}" class="form-control">
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
                @elseif($project->desaincard == 'not active' && $project->is_active == 'handover' && request()->user()->role == 'worker')
                @if ($project->pilihandesain != null)
                <div class="card">
                    <div class="card-body">
                        <form action="/handoverproject/acceptdesaincard/{{$project->id}}" method="post" class="row">
                            @csrf
                            @php
                                $projectdesaincard = explode('/',$project->pilihandesain);
                                for ($i=0; $i < count($projectdesaincard); $i++) {
                                    if ($projectdesaincard[$i] == 1) {
                                        $pilihan[$i] = 'Business Card';
                                    } elseif($projectdesaincard[$i] == 2){
                                        $pilihan[$i] = 'Email Signature';
                                    } elseif($projectdesaincard[$i] == 3){
                                        $pilihan[$i] = 'Letterheads';
                                    } elseif($projectdesaincard[$i] == 4){
                                        $pilihan[$i] = 'Flayer';
                                    } elseif($projectdesaincard[$i] == 5){
                                        $pilihan[$i] = 'Invoices';
                                    } elseif($projectdesaincard[$i] == 6){
                                        $pilihan[$i] = 'Post Card';
                                    } elseif($projectdesaincard[$i] == 7){
                                        $pilihan[$i] = 'Facebook Cover';
                                    } elseif($projectdesaincard[$i] == 8){
                                        $pilihan[$i] = 'Facebook Post';
                                    } elseif($projectdesaincard[$i] == 9){
                                        $pilihan[$i] = 'Youtube Benners';
                                    }elseif ($projectdesaincard[$i] == 10) {
                                        $pilihan[$i] = 'Instagram Post';
                                    }else{
                                        $pilihan[$i] = '';
                                    }
                                }
                            @endphp
                            <div class="form-group col-lg-4">
                                <label for="pilihan1">Desain Card 1</label>
                                <input type="text" value="{{$pilihan[0]}}" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="pilihan2">Desain Card 2</label>
                                <input type="text" value="{{$pilihan[1]}}" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="pilihan3">Desain Card 3</label>
                                <input type="text" value="{{$pilihan[2]}}" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary ml-auto mr-3 text-capitalize">Accept</button>
                        </form>
                    </div>
                </div>
                @endif
                @else
                @if ($project->desaincard == 'active' && $project->is_active == 'handover')
                <div class="card">
                    <div class="card-body">
                        <div class="flex-grow-1 ">
                            <div class="alert alert-success text-capitalize">When the card design work has begun please go to the list of project designs to do the design work requested by the customer. Your work time is 2 weeks.</div>
                        </div>
                    </div>
                </div>
                @endif
                @endif
                @endif
                <div class="card-body mb-4">
                    <div class="d-flex ">
                        <div class=" align-self-center">
                            <h4 class="text-capitalize ">transfer copyright - <span style="color: grey">signed</span>
                            </h4>
                        </div>
                        <div class="ml-auto ">
                            <a href="" class="btn btn-primary">Download Contract</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex ">
                            <div class="mr-auto ">
                                <h4 class="text-capitalize">upload files</h4>
                            </div>
                            @php
                                //Deskripsi Variabel
                                $strstart       = Str::substr($project->catagories, 0, 4);
                                $strend1        = Str::substr($project->catagories, 7,11);
                                $strend1        = Str::substr($project->catagories, 8,12);

                                //Deskripsi Capitalize
                                $capitalize1    = Str::ucfirst($strstart);
                                $capitalize2    = Str::ucfirst($strend1);
                                $capitalize3    = Str::ucfirst($strend1);

                                //Deskripsi Lowercase
                                $lower1         = Str::lower($strstart);
                                $lower2         = Str::lower($strend1);
                                $lower3         = Str::lower($strend1);
                            @endphp
                            @if ($lower1 == 'logo' || $capitalize1 == 'Logo' || $lower2 == 'logo' || $capitalize2 == 'Logo' ||$lower3 == 'logo' || $capitalize3 == 'Logo')
                            <div class="">
                                <a href="/convertpdf/{{$handover->id}}" class="btn btn-primary">Download Certificate</a>
                            </div>
                            @else

                            @endif
                            <div class=" ml-3">
                                <a href="{{'/convertzip/' . $handover->id}}" class="btn btn-primary">Download All
                                    Files</a>
                            </div>
                        </div>
                    </div>
                    <table class="table card-table table-vcenter">
                        @php
                        $fileupload = DB::table('upload_files')->where('contest_id_winner',$handover->id)->get();
                        @endphp
                        @foreach ($fileupload as $itemfileupload)
                        <tr>
                            <td width="60px"><i class="fa fa-file" style="font-size: 20pt"></i></td>
                            <td width="">{{$itemfileupload->name}}</td>
                            <td class="text-right">{{number_format($itemfileupload->kapasitas)}} KB</td>
                            @if (request()->user()->role == 'worker' && request()->user()->id == $handover->user_id_worker)
                            <td class="text-right" width="50px">
                                <form action="/deletefileupload/{{$itemfileupload->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;"><i class="fa fa-times-circle"></i></button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </div>
                @if (request()->user()->role == 'worker' && $project->is_active == 'handover')
                <a href="javascript:void(0)" data-toggle="modal" data-target="#UploadFiles" id="uploadfile"
                class="btn btn-primary btn-sm">Upload Files</a>
                @endif
                @if ($project->catagories_project == 'contest')
                    @if (request()->user()->role == 'worker' && $project->is_active == 'handover')
                    <div class="card mt-5">
                        <div class="card-body">
                            <form method="post" action="/updatefiles/{{$handover->id}}">
                                @csrf
                                <div class="form-group field_font">
                                    <div class="d-flex ">
                                        <div class="flex-grow-1">
                                            @php
                                                $font = DB::table('fonts')->where('contest_id',$handover->contest_id)->first();
                                                $fontss = DB::table('fonts')->where('contest_id',$handover->contest_id)->get();
                                            @endphp
                                            @if ($font == null)
                                            <label for="font">Font Used</label>
                                            <input type="text" class="form-control mb-3" name="font[]" id="font"value="">
                                            @else
                                            @foreach ($fontss as $itemfont)
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <label for="font">Font Used</label>
                                                    <input type="text" class="form-control mb-3" name="font[]" id="font"
                                                        value="{{$itemfont->name}}">
                                                </div>
                                                <div class="align-self-center mt-3">
                                                    <a href="/updatefiles/delete/font/{{\Crypt::encrypt($itemfont->name)}}"class="btn btn-sm"
                                                            style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;"><i
                                                            class="fa fa-times-circle"></i></a>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div class="">
                                            <a href="javascript:void(0);" class="add_button_font" title="Add field"><i class="fe fe-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group field_hexa">
                                    <div class="d-flex ">
                                        <div class="flex-grow-1  ">
                                            @php
                                                $hexa = DB::table('colors')->where('contest_id',$handover->contest_id)->first();
                                                $hexass = DB::table('colors')->where('contest_id',$handover->contest_id)->get();
                                            @endphp
                                            @if ($hexa == null)
                                            <label for="hexa_color">Hexa Color Used</label>
                                            <input type="text" class="form-control mb-3" name="hexa_color[]" id="hexa_color"
                                            value="">
                                            @else
                                            @foreach ($hexass as $itemhexa)
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <label for="hexa_color">Hexa Color Used</label>
                                                    <input type="text" class="form-control mb-3" name="hexa_color[]" id="hexa_color"
                                                        value="{{$itemhexa->hexa}}">
                                                </div>
                                                <div class="align-self-center mt-3">
                                                    <a href="/updatefiles/delete/color/{{\Crypt::encrypt($itemhexa->hexa)}}"class="btn btn-sm"
                                                            style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;"><i
                                                            class="fa fa-times-circle"></i></a>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div class="">
                                            <a href="javascript:void(0);" class="add_button_hexa" title="Add field"><i class="fe fe-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group field_rgb">
                                    <div class="d-flex ">
                                        <div class="flex-grow-1">
                                            @php
                                                $rgb = DB::table('colors')->where('contest_id',$handover->contest_id)->first();
                                                $rgbss = DB::table('colors')->where('contest_id',$handover->contest_id)->get();
                                            @endphp
                                            @if ($rgb == null)
                                            <label for="rgb_color">RGB Color Used</label>
                                            <input type="text" class="form-control mb-3" name="rgb_color[]" id="rgb_color"
                                            value="">
                                            @else
                                            @foreach ($rgbss as $itemrgb)
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <label for="rgb_color">RGB Color Used</label>
                                                    <input type="text" class="form-control mb-3" name="rgb_color[]" id="rgb_color"
                                                value="{{$itemrgb->rgb}}">
                                                </div>
                                                <div class="align-self-center mt-3 ">
                                                    <button type="button" class="btn btn-sm text-white" disabled style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;"><i class="fa fa-times-circle"></i></button>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="remove_button_rgb text-white" title="Remove field"><i class="fe fe-minus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="font">Font Used</label>
                                @php
                                    $fonts = DB::table('fonts')->where('contest_id',$handover->contest_id)->get();
                                @endphp
                                @foreach ($fonts as $itemfont)
                                <div class="form-control-plaintext">{{$itemfont->name}}</div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="hexa_color">Hexa Color Used</label>
                                @php
                                    $hexas = DB::table('colors')->where('contest_id',$handover->contest_id)->get();
                                @endphp
                                @foreach ($hexas as $itemhexa)
                                <div class="form-control-plaintext">{{$itemhexa->hexa}}</div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="rgb_color">RGB Color Used</label>
                                @php
                                    $rgbs = DB::table('colors')->where('contest_id',$handover->contest_id)->get();
                                @endphp
                                @foreach ($rgbs as $itemrgb)
                                <div class="form-control-plaintext">{{$itemrgb->rgb}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                @endif
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-md-6 col-lg-12">
                        <div class="card">
                            @if ($project->catagories_project == 'contest')
                            <div class="card-body">
                                <div class="mb-4 text-center">
                                    <img src="{{asset('storage/result' . $project->catagories_project . '/' . $handover->filecontest)}}"
                                        class="img-fluid">
                                </div>
                                <div class="d-flex align-items-center px-2">
                                    @php
                                    $user = DB::table('users')->where('id',$handover->user_id_worker)->first();
                                    @endphp
                                    @if ($user->avatar != 'default.jpg')
                                        <div class="avatar avatar-md mr-3"
                                            style="background-image: url({{asset('/storage/profile/' . $user->avatar)}})">
                                        </div>
                                    @else
                                        <div class="avatar avatar-md mr-3"
                                            style="background-image: url({{asset('assets/dashboard/images/default.jpg')}})">
                                        </div>
                                    @endif
                                    <div>
                                        <div>{{$user->name}}</div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="card-body">
                                <div class="mb-4 text-center">
                                    @php
                                    $user = DB::table('users')->where('id',$handover->user_id_worker)->first();
                                    @endphp
                                    @if ($user->avatar != 'default.jpg')
                                        <img src="{{asset('/storage/profile/' . $user->avatar)}}"
                                            class="img-fluid">
                                    @else
                                        <img src="{{asset('assets/dashboard/images/default.jpg')}}"
                                            class="img-fluid">
                                    @endif
                                </div>
                                <div class="d-flex align-items-center px-2">
                                    @if ($user->avatar != 'default.jpg')
                                        <div class="avatar avatar-md mr-3"
                                            style="background-image: url({{asset('/storage/profile/' . $user->avatar)}})">
                                        </div>
                                    @else
                                        <div class="avatar avatar-md mr-3"
                                            style="background-image: url({{asset('assets/dashboard/images/default.jpg')}})">
                                        </div>
                                    @endif
                                    <div>
                                        <div>{{$user->name}}</div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @php
                        //Deskripsi Variabel
                        $strstart       = Str::substr($project->catagories, 0, 4);
                        $strend1        = Str::substr($project->catagories, 7,11);
                        $strend1        = Str::substr($project->catagories, 8,12);

                        //Deskripsi Capitalize
                        $capitalize1    = Str::ucfirst($strstart);
                        $capitalize2    = Str::ucfirst($strend1);
                        $capitalize3    = Str::ucfirst($strend1);

                        //Deskripsi Lowercase
                        $lower1         = Str::lower($strstart);
                        $lower2         = Str::lower($strend1);
                        $lower3         = Str::lower($strend1);
                    @endphp
                    @if ($lower1 == 'logo' || $capitalize1 == 'Logo' || $lower2 == 'logo' || $capitalize2 == 'Logo' ||$lower3 == 'logo' || $capitalize3 == 'Logo')
                        @if (request()->user()->role == 'worker' && $project->is_active == 'handover')
                        <div class="col-md-6 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex ">
                                        <div class="flex-fill ">
                                            <h5>Upload Logo + Text</h5>
                                        </div>
                                        <div class="flex-fill ">
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#UploadFilesLogo"
                                                id="uploadfilelogotext" data-id="{{$handover->id}}"
                                                class="btn btn-primary btn-sm">Upload Files</a>
                                        </div>
                                    </div>
                                    <a href="">See details and guidelines</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-6 col-lg-12">
                            <div class="card">
                                @if ($handover->logotext != null)
                                <div class="card-body">
                                    <div class="mb-4 text-center">
                                        <img src="{{asset('storage/logotext/' . $handover->logotext)}}" class="img-fluid">
                                    </div>
                                    <div class="mt-5 d-flex align-items-center">
                                        <div class="ml-auto">
                                            <a href="javascript:void(0)"
                                                data-url="{{'https://images.google.com/searchbyimage?image_url=' . asset('/storage/logotext/' . $handover->logotext)}}"
                                                id="buttonlogotext" class="btn btn-primary btn-sm">Google Reverse Cek </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @if (request()->user()->role == 'worker' && $project->is_active == 'handover')
                        <div class="col-md-6 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex ">
                                        <div class="p-2 flex-fill ">
                                            <h5>Upload Logo</h5>
                                        </div>
                                        <div class="p-2 flex-fill ">
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#UploadFilesLogo"
                                                id="uploadfilelogo" data-id="{{$handover->id}}"
                                                class="btn btn-primary btn-sm">Upload Files</a>
                                        </div>
                                    </div>
                                    <a href="">See details and guidelines</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-6 col-lg-12">
                            <div class="card">
                                @if ($handover->logo != null)
                                <div class="card-body">
                                    <div class="mb-4 text-center">
                                        <img src="{{asset('storage/logo/' . $handover->logo)}}" class="img-fluid">
                                    </div>
                                    <div class="mt-5 d-flex align-items-center">
                                        <div class="ml-auto">'
                                            <a href="javascript:void(0)"
                                                data-url="{{'https://images.google.com/searchbyimage?image_url=' . asset('/storage/logo/' . $handover->logotext)}}"
                                                id="buttonlogo" class="btn btn-primary btn-sm">Google Reverse Cek </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">Message</h3>
            </div>
            <div class="card-body">
                @php
                foreach($message as $itemmessage) :
                if ($itemmessage->feedback_customer != null) {
                $users = DB::table('users')->where('id',$itemmessage->customer_id)->first();
                } else {
                $users = DB::table('users')->where('id',$itemmessage->worker_id)->first();
                }
                @endphp
                <div class="d-flex">
                    <div>
                        @if ($users->avatar == 'default.jpg')
                        <img src="{{url('assets/dashboard/images/default.jpg')}}" width="90px">
                        @else
                        <img src="{{url('storage/profile/' . $users->avatar)}}" width="90px">
                        @endif
                    </div>
                    <div class="ml-3">
                        <h6 class="mt-3">{{$users->name}}</h6>
                        @if ($itemmessage->feedback_worker == null)
                            @if ($itemmessage->file == null)
                            <p class="mt-4">{{$itemmessage->feedback_customer}}</p>
                            @else
                            <a href="{{asset('storage/filechat/' . $itemmessage->file)}}" target="_blank"><img src="{{asset('storage/filechat/' . $itemmessage->file)}}" alt="" width="400px"></a>
                            <p class="mt-4">{{$itemmessage->feedback_customer}}</p>
                            @endif
                        @else
                            @if ($itemmessage->file == null)
                            <p class="mt-4">{{$itemmessage->feedback_worker}}</p>
                            @else
                            <a href="{{asset('storage/filechat/' . $itemmessage->file)}}" target="_blank"><img src="{{asset('storage/filechat/' . $itemmessage->file)}}" alt="" width="400px"></a>
                            <p class="mt-4">{{$itemmessage->feedback_worker}}</p>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="card">

                </div>
                @php
                endforeach;
                @endphp
            </div>
            <form action="{{route('messagehandover')}}" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{$project->id}}">
                        @if (request()->user()->role == 'customer')
                        <input type="hidden" name="user_id_worker" value="{{$handover->user_id_worker}}">
                        @else
                        <input type="hidden" name="user_id" value="{{$project->user_id}}">
                        @endif
                        <div class="form-row">
                            <div class="form-group col-md-11">
                                <div class="form-group mb-0">
                                    <textarea rows="5" class="form-control" name="feedback"></textarea>
                                </div>
                            </div>
                            <div class="custom-file col-md-1">
                                <label for="filechat"><img src="{{url('assets/dashboard/images/addimages.png')}}" alt="" width="50px"></label>
                                <input type="file" style="display: inline-block;visibility: hidden;" id="filechat" name="filechat">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="UploadFiles" tabindex="-1" aria-labelledby="UploadFilesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UploadFilesLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="body-fileupload">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="id" value="{{$handover->id}}">
                        <div class="form-group">
                            <label for="fileupload">File Upload</label>
                            <input type="file" class="form-control-file" id="fileupload" name="fileupload[]" multiple>
                        </div>
                    </div>
                    <div class="modal-footer footer-fileupload">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="UploadFilesLogo" tabindex="-1" aria-labelledby="UploadFilesLogoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UploadFilesLogoLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="body-fileupload">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="id" value="{{$handover->id}}">
                        <div class="form-group">
                            <label for="fileupload">File Upload</label>
                            <input type="file" class="form-control-file" id="fileupload" name="fileupload">
                        </div>
                    </div>
                    <div class="modal-footer footer-fileupload">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ExtendedDeadline" tabindex="-1" aria-labelledby="ExtendedDeadlineLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ExtendedDeadlineLabel">Extened Deadline</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <form action="/extendeddeadlinedirect/{{$project->id}}" method="post">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="extended">Extended Deadline</label>
                        <input type="text" class="form-control" id="extended" name="extended">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
