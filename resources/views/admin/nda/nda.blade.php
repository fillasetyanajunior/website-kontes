@extends('layouts.layouts_dashboard')
@section('title',$title)
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Management NDA
            </h1>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List NDA</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Name File</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($perjanjian as $itemperjanjian)
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itemperjanjian->name}}</td>
                                    <td>
                                        <a href="{{asset('storage/nda/' . $itemperjanjian->name)}}" class="btn btn-primary btn-sm">Download</a>
                                    </td>
                                    <td width="100px">
                                        @if ($itemperjanjian->perjanjian == null)
                                        <button type="button" id="btnnda" data-toggle="modal" data-target="#NDAModal" class="btn btn-primary btn-sm text-white" data-id="{{$itemperjanjian->id}}">Edit</button>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                        {{$perjanjian->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="NDAModal" tabindex="-1" aria-labelledby="NDAModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NDAModalLabel">NDA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="body_nda">
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="perjanjian">Perjanjian</label>
                            <textarea class="form-control" name="perjanjian" id="perjanjian" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer footer_nda">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
