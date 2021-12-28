@extends('layouts.layouts_dashboard')
@section('title',$title)
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Code
            </h1>
        </div>
        <button type="button" class="btn btn-primary mb-5" data-toggle="modal" data-target="#CodeModal">Add
            Code</button>
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Code</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>code</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($code as $itemcode)
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itemcode->code}}</td>
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
<div class="modal fade" id="CodeModal" tabindex="-1" aria-labelledby="CodeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CodeModalLabel">Code Create</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="">
                <form action="{{route('codeStore')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="jumlah">Jumlah Code</label>
                            <input type="text" class="form-control" id="jumlah" name="jumlah">
                        </div>
                        <div class="form-group">
                            <label for="pilihan">Pilihan Discount</label>
                            <select class="form-control text-capitalize" id="pilihan" name="pilihan">
                                <option value="">-- Choose --</option>
                                <option value="1">pot $10</option>
                                <option value="2">pot $20</option>
                                <option value="3">pot $50</option>
                                <option value="4">free posting fee (tanpa pot 15%)</option>
                            </select>
                            <small id="emailHelp" class="form-text text-muted">Default Insert ke Sort Catagories dan
                                Catagories</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
