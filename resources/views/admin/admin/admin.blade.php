@extends('layouts.layouts_dashboard')
@section('title',$title)
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Management Admin
            </h1>
        </div>
        <button type="button" class="btn btn-primary mb-5" data-toggle="modal" data-target="#AdminModal" id="addadmin">Add Admin</button>
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Admin</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($admin as $itemadmin)
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itemadmin->name}}</td>
                                    <td>{{$itemadmin->email}}</td>
                                    <td>{{\Str::before($itemadmin->phone,'@c.us')}}</td>
                                    <td width="100px">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#AdminModal" id="editadmin" data-id="{{$itemadmin->id}}">Edit</button>
                                        @if ($itemadmin->id != 1)
                                        <form action="/managementadmin/delete/{{$itemadmin->id}}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="btn btn-danger btn-sm text-white">Delete</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                        {{$admin->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="AdminModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="AdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AdminModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
             <div class="body_admin">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email">
                        </div>
                        <div class="form-group password">
                            <label for="password">Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password">
                        </div>
                        <div>
                            <label>Phone Number</label>
                            <div class="row">
                                <div class="form-group col-4">
                                    <select class="form-control custom-select" name="kodenegara" id="kodenegara">
                                        @foreach ($kodenegara as $itemkodenegara)
                                        <option value="{{$itemkodenegara->code}}">{{$itemkodenegara->name}} +{{$itemkodenegara->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-8">
                                    <input type="numeric" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                        name="phone" value="{{old('phone')}}" placeholder="Enter phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer footer_admin">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
