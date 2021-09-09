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
        @if (request()->user()->role == 'customer' && $project->is_active == 'handover')
        <div class="card">
            <div class="card-body">
                <div class="d-flex bd-highlight">
                    <div class="flex-grow-1 bd-highlight">
                        <div class="alert alert-success">Make sure you have download all files</div>
                    </div>
                    <div class="bd-highlight ml-5">
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
                <div class="card-body mb-4">
                    <div class="d-flex bd-highlight">
                        <div class="bd-highlight align-self-center">
                            <h4 class="text-capitalize ">transfer copyright - <span style="color: grey">signed</span>
                            </h4>
                        </div>
                        <div class="ml-auto bd-highlight">
                            <a href="" class="btn btn-primary">Download Contract</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex bd-highlight">
                            <div class="mr-auto bd-highlight">
                                <h4 class="text-capitalize">uploade files</h4>
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
                            <div class="bd-highlight">
                                <a href="/convertpdf/{{$handover->id}}" class="btn btn-primary">Download Certificate</a>
                            </div>
                            @else

                            @endif
                            <div class="bd-highlight ml-3">
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
                        </tr>
                        @endforeach
                    </table>
                </div>
                @if (request()->user()->role == 'worker' && $project->is_active == 'handover')
                <a href="javascript:void(0)" data-toggle="modal" data-target="#UploadFiles" id="uploadfile"
                    class="btn btn-primary btn-sm">Upload Files</a>
                <div class="card mt-5">
                    <div class="card-body">
                        <form method="post" action="/updatefiles/{{$handover->id}}">
                            @csrf
                            <div class="form-group field_font">
                                <div class="d-flex bd-highlight">
                                    <div class="flex-grow-1 bd-highlight ">
                                        @php
                                            $font = explode(',',$handover->font);
                                        @endphp
                                        @for ($i = 0; $i < count( $font); $i++)

                                        <label for="font">Font Used</label>
                                        <input type="text" class="form-control mb-3" name="font[]" id="font"
                                            value="{{$font[$i]}}">
                                        @endfor
                                    </div>
                                    <div class="bd-highlight">
                                        <a href="javascript:void(0);" class="add_button_font" title="Add field"><i class="fe fe-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group field_hexa">
                                <div class="d-flex bd-highlight">
                                    <div class="flex-grow-1 bd-highlight ">
                                        @php
                                            $hexa_color = explode(',',$handover->hexa_color);
                                        @endphp
                                        @for ($i = 0; $i < count( $hexa_color); $i++)

                                        <label for="hexa_color">Hexa Color Used</label>
                                        <input type="text" class="form-control mb-3" name="hexa_color[]" id="hexa_color"
                                            value="{{$hexa_color[$i]}}">
                                        @endfor
                                    </div>
                                    <div class="bd-highlight">
                                        <a href="javascript:void(0);" class="add_button_hexa" title="Add field"><i class="fe fe-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group field_rgb">
                                <div class="d-flex bd-highlight">
                                    <div class="flex-grow-1 bd-highlight ">
                                        @php
                                            $rgb_color = explode(',',$handover->rgb_color);
                                        @endphp
                                        @for ($i = 0; $i < count( $rgb_color); $i++)

                                        <label for="rgb_color">RGB Color Used</label>
                                        <input type="text" class="form-control mb-3" name="rgb_color[]" id="rgb_color"
                                            value="{{$rgb_color[$i]}}">
                                        @endfor
                                    </div>
                                    <div class="bd-highlight">
                                        <a href="javascript:void(0);" class="add_button_rgb" title="Add field"><i class="fe fe-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label for="hexa_color">Hexa Color Used</label>
                                <input type="text" class="form-control" name="hexa_color[]" id="hexa_color"
                                    value="{{$handover->hexa_color}}">
                            </div>
                            <div class="form-group">
                                <label for="rgb_color">RGB Color Used</label>
                                <input type="text" class="form-control" name="rgb_color[]" id="rgb_color"
                                    value="{{$handover->rgb_color}}">
                            </div> --}}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                @else
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="font">Font Used</label>
                            <div class="form-control-plaintext">{{$handover->font}}</div>
                        </div>
                        <div class="form-group">
                            <label for="hexa_color">Hexa Color Used</label>
                            <div class="form-control-plaintext">{{$handover->hexa_color}}</div>
                        </div>
                        <div class="form-group">
                            <label for="rgb_color">RGB Color Used</label>
                            <div class="form-control-plaintext">{{$handover->rgb_color}}</div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-md-6 col-lg-12">
                        <div class="card">
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
                                    <div class="d-flex bd-highlight">
                                        <div class="flex-fill bd-highlight">
                                            <h5>Upload Logo + Text</h5>
                                        </div>
                                        <div class="flex-fill bd-highlight">
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
                                    <div class="d-flex bd-highlight">
                                        <div class="p-2 flex-fill bd-highlight">
                                            <h5>Upload Logo</h5>
                                        </div>
                                        <div class="p-2 flex-fill bd-highlight">
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
        <div class="card">
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
                {{$users->name}}
                <div class="card">
                    @if ($itemmessage->feedback_worker == null)
                    <p>{{$itemmessage->feedback_customer}}</p>
                    @else
                    <p>{{$itemmessage->feedback_worker}}</p>
                    @endif
                </div>
                @php
                endforeach;
                @endphp
            </div>
            <form action="{{route('messagehandover')}}" method="post">
                <div class="card-body">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{$project->id}}">
                        @if (request()->user()->role == 'customer')
                        @php
                            if($project->catagories_project == 'contest'){
                                $user = DB::table('result_contests')->where('contest_id',$project->id)->first();
                            }else{
                                $user = DB::table('result_projects')->where('contest_id',$project->id)->first();
                            }
                        @endphp
                        <input type="hidden" name="user_id_worker" value="{{$user->user_id_worker}}">
                        @else
                        <input type="hidden" name="user_id" value="{{$project->user_id}}">
                        @endif
                        <div class="form-group">
                            <div class="form-group mb-0">
                                <textarea rows="5" class="form-control" name="feedback"></textarea>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Kirim</button>
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
@endsection
