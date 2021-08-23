@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Catagories
            </h1>
        </div>
        <button type="button" class="btn btn-primary mb-5" data-toggle="modal" data-target="#CatagoriesModal" id="addcatagories">Add
            Catagories</button>
        <button type="button" class="btn btn-primary mb-5" data-toggle="modal" data-target="#SubCatagoriesModal" id="addsubcatagories">Add Sub
            Catagories</button>
        <div class="form-group col-3">
            <label for="pilihantable">Pilihan Data</label>
            <select class="form-control" id="pilihantable">
                <option disabled value="">-- Pilih --</option>
                <option selected value="1">Catagories</option>
                <option value="2">Sort Catagories</option>
                <option value="3">Sub Catagories</option>
            </select>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-12" id="catagories_table">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Catagories</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($catagories as $itemcatagories)
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itemcatagories->name}}</td>
                                    <td>
                                        @if ($itemcatagories->icon != null)
                                            {{$itemcatagories->icon}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{$itemcatagories->harga}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm text-white" id="editcatagories" data-id="{{$itemcatagories->id}}"data-toggle="modal" data-target="#CatagoriesModal">Edit</button>
                                        <form action="/managementwebsite/catagories/delete"
                                            method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{$itemcatagories->id}}">
                                            <input type="hidden" name="pilihaninput" value="catagories">
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
            <div class="col-12" id="sort_catagories_table">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Search Catagories</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($search as $itemsearch)
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itemsearch->name}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm text-white" id="editsortcatagories" data-id="{{$itemsearch->id}}"data-toggle="modal" data-target="#CatagoriesModal">Edit</button>
                                        <form action="/managementwebsite/catagories/delete"
                                            method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{$itemsearch->id}}">
                                            <input type="hidden" name="pilihaninput" value="sort catagories">
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
            <div class="col-12" id="sub_catagories_table">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sub Catagories</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Catagories</th>
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Description</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($sub_catagories as $itemsub_catagories)
                                @php
                                $cata = DB::table('catagories')->where('id',$itemsub_catagories->catagori_id)->first();
                                @endphp
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$cata->name}}</td>
                                    <td>{{$itemsub_catagories->name}}</td>
                                    <td>
                                        @if ($itemsub_catagories->icon != null)
                                            {{$itemsub_catagories->icon}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{$itemsub_catagories->description}}</td>
                                    <td>{{$itemsub_catagories->harga}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm text-white" id="editsubcatagories" data-id="{{$itemsub_catagories->id}}" data-toggle="modal" data-target="#SubCatagoriesModal">Edit</button>
                                        <form action="/managementwebsite/subcatagories/delete/{{$itemsub_catagories->id}}"
                                            method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
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
                        {{$sub_catagories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="CatagoriesModal" tabindex="-1" aria-labelledby="CatagoriesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CatagoriesModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="body_catagories">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga">
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <select class="form-control fa" id="icon" name="icon">
                                <option value="">-- Pilih --</option>
                                @foreach ($icon as $itemicon)
                                <option value="{{$itemicon->name}}">&#x{{$itemicon->cheatsheet}}&nbsp;{{$itemicon->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pilihaninput">Pilihan Input</label>
                            <select class="form-control" id="pilihaninput" name="pilihaninput">
                                <option value="">-- Pilih --</option>
                                <option value="1">Catagories</option>
                                <option value="2">Sort Catagories</option>
                            </select>
                            <small id="emailHelp" class="form-text text-muted">Default Insert ke Sort Catagories dan
                                Catagories</small>
                        </div>
                    </div>
                    <div class="modal-footer footer_catagories">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="SubCatagoriesModal" tabindex="-1" aria-labelledby="SubCatagoriesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SubCatagoriesModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="body_sub_catagories">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="namesub" name="name">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" id="hargasub" name="harga">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <select class="form-control fa" id="iconsub" name="icon">
                                <option value="">-- Pilih --</option>
                                @foreach ($icon as $itemicon)
                                <option value="{{$itemicon->name}}">&#x{{$itemicon->cheatsheet}}&nbsp;{{$itemicon->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="catagories">Pilihan Catagories</label>
                            <select class="form-control" id="catagories" name="catagories">
                                <option value="">-- Pilih --</option>
                                @foreach ($catagories as $itemcatagories)
                                <option value="{{$itemcatagories->id}}">{{$itemcatagories->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer footer_sub_catagories">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
