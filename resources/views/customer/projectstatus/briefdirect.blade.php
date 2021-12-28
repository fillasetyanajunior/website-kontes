@extends('layouts.layouts_dashboard')
@section('title',$title)
@section('content')
<x-slidebar></x-slidebar>
<div class="">
    <div class="bg-gray d-flex align-items-center">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title text-white font-weight-bold">
                    Brief Project
                </h1>
            </div>
        </div>
    </div>
    <div class="container">
        <ul class="nav nav-tabs mb-3 text-capitalize" id="tabs">
            <li class="nav-item">
                <a class="nav-link active font-weight-bold" id="descriptiontoggel" href="javascript:void(0)"
                    data-role="description">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" id="entriestoggel" href="javascript:void(0)" data-role="entries">entries</a>
            </li>
        </ul>
        <x-brief-direct id="{{$project->id}}"></x-brief-direct>
        <livewire:gallery-direct :project="$project" :key="$project->id">
    </div>
</div>
<div class="modal fade" id="directModal" tabindex="-1" aria-labelledby="directModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="directModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="body_resultdirect">
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <div class="form-group">
                                    <label for="description">Description Your Proposal</label>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="5" name="description"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <div class="form-group">
                                        <div class="form-label">Licensed Content</div>
                                        <div class="form-label text-capitalize">declare any stock content used to avoid
                                            penalty.</div>
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="licensed"
                                                    value="1">
                                                <div class="custom-control-label">This entry is entirely my own</div>
                                            </label>
                                            <label class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="licensed"
                                                    value="2" checked>
                                                <div class="custom-control-label">This entry contains elements i did not
                                                    create</div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <div class="form-label">Portfolio Visibility</div>
                                        <div class="form-label text-capitalize">do you want to show the above designs on
                                            your portfolio page?</div>
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="portfolio"
                                                    value="1">
                                                <div class="custom-control-label">Yes</div>
                                            </label>
                                            <label class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="portfolio"
                                                    checked value="2">
                                                <div class="custom-control-label">No</div>
                                            </label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                                                value="option1" checked>
                                            <span class="custom-control-label">This entry is entirely my own original
                                                work and i agree <a href="">Terms & Conditions</a>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Your Bid ($)</label>
                                    <input type="text" class="form-control" name="harga" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">This project will be delivered in:....Days</label>
                                    <input type="text" class="form-control" name="hari" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer footer_resultdirect">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="FeedbackDirect" tabindex="-1" aria-labelledby="FeedbackDirectLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="body_feedback">
                <div class="modal-body">
                    <div class="card-body mb-2">
                        <div class="d-flex align-items-center px-2">
                            <div class="avatar avatar-md mr-3" id="profileworker"></div>
                            <div>
                                <div id="name_worker"></div>
                            </div>
                            <div class="ml-auto">
                                <div id="buttonresultdirect">
                                </div>
                                @if ($report >= 3)
                                @else
                                <div class="mb-1">
                                    <button type="submit" class=" btn btn-outline-danger col-12" data-target="#ReportModal"
                                        data-toggle="modal">Report</button>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="mt-5">
                            <div class="mb-3">
                                <div class="rating" style="font-size: 20pt"></div>
                            </div>
                            <h4>Description</h4>
                            <p id="descriptions"></p>
                            <h4>Your Bid</h4>
                            <p id="bid"></p>
                            <h4>This Project Will Be Delivered In</h4>
                            <p id="bidhari"></p>
                        </div>
                    </div>
                    <div id="feedbackcommentbid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ReportModal" tabindex="-1" aria-labelledby="ReportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ReportModalLabel">Report Contest</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <form action="{{route('reportcreate')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_worker" name="id_worker" value="">
                    <input type="hidden" id="id_project" name="id_project" value="">
                    <div class="form-group">
                        <div class="form-label">Type of issue</div>
                        <div class="custom-controls-stacked">
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="type" value="1">
                                <div class="custom-control-label">General issue</div>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="type" value="2">
                                <div class="custom-control-label">Potential copyright issue</div>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="type" value="3">
                                <div class="custom-control-label">Offensive material</div>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description of issue</label>
                        <textarea class="form-control" name="description" rows="6" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Links - Supporting material</label>
                        <textarea class="form-control" name="link" rows="6" placeholder="Link"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Your Email</label>
                        <input type="text" class="form-control" name="emailfrom" value="{{request()->user()->email}}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Your Name</label>
                        <input type="text" class="form-control" name="namefrom" value="{{request()->user()->name}}"
                            readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ShareModal" tabindex="-1" aria-labelledby="ShareModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ShareModalLabel">Share</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <form action="/sharecontest/{{$project->id}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="text-center">
                            <div class="mt-3">
                                <img src="" alt="" id="gambarShare" width="200px">
                            </div>
                            <div class="mt-3">
                                <p id="captions_share"></p>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary footer_contest">Share</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ActionDirectModal" tabindex="-1" aria-labelledby="ActionDirectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ActionDirectModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="body_direct">
                <form action="" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <div class="text-center">
                                <div class="mt-3">
                                    <img src="" alt="" id="gambarActionDirect" width="200px">
                                </div>
                                <div class="mt-3">
                                    <p id="captions_direct"></p>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary footer_direct">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
