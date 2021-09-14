@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Opsi Package
            </h1>
        </div>
        <button type="button" class="btn btn-primary mb-5" data-toggle="modal" data-target="#OpsiModal" id="opsicontest">Add Opsi Package</button>
        <div class="form-group row">
            <div class="col-lg-3">
                <label for="paketopsicontest">Pilihan Data</label>
                <select class="form-control" id="paketopsicontest">
                    <option disabled value="">-- Pilih --</option>
                    <option selected value="1">Opsi Utama</option>
                    <option value="2">Opsi Upgrade</option>
                </select>
            </div>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-12" id="opsiutama">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Opsi Utama</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Name</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($opsi as $itemopsi)
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itemopsi->name}}</td>
                                    <td>{{$itemopsi->harga}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm text-white"
                                            id="editopsicontest" data-id="{{$itemopsi->id}}" data-toggle="modal"
                                            data-target="#OpsiModal">Edit</button>
                                        <form action="/managementwebsite/opsicontest/delete" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{$itemopsi->id}}">
                                            <input type="hidden" name="pilihaninput" value="opsiutama">
                                            <button type="submit"
                                                class="btn btn-danger btn-sm text-white">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12" id="opsitambahan">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Opsi Upgrade</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Name</th>
                                    <th>icon</th>
                                    <th>Description</th>
                                    <th>Hari</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($opsiupgrade as $itemopsiupgrade)
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itemopsiupgrade->name}}</td>
                                    <td>
                                        @if ($itemopsiupgrade->icon != null)
                                        {{$itemopsiupgrade->icon}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>{{$itemopsiupgrade->description}}</td>
                                    <td>
                                        @if ($itemopsiupgrade->hari != null)
                                        {{$itemopsiupgrade->hari}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>{{$itemopsiupgrade->harga}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm text-white"
                                            id="editopsiupgradecontest" data-id="{{$itemopsiupgrade->id}}"
                                            data-toggle="modal" data-target="#OpsiModal">Edit</button>
                                        <form action="/managementwebsite/opsicontest/delete" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{$itemopsiupgrade->id}}">
                                            <input type="hidden" name="pilihaninput" value="opsiupgrade">
                                            <button type="submit"
                                                class="btn btn-danger btn-sm text-white">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="OpsiModal" tabindex="-1" aria-labelledby="OpsiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="OpsiModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="body_opsi">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="pilihaninputs">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga">
                        </div>
                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <input type="text" class="form-control" id="hari" name="hari">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <select class="form-control fa" id="iconopsi" name="icon">
                                <option value="">-- Choose --</option>
                                @foreach ($icon as $itemicon)
                                <option value="{{$itemicon->name}}">
                                    &#x{{$itemicon->cheatsheet}}&nbsp;{{$itemicon->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pilihaninput">Choice Input</label>
                            <select class="form-control" id="pilihaninput" name="pilihaninput">
                                <option value="">-- Choose --</option>
                                <option value="1">Opsi Utama</option>
                                <option value="2">Opsi Upgrade</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer footer_opsi">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
