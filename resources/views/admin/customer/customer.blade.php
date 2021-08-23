@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Management Customer
            </h1>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Customer</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Customer ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($customer as $itemcustomer)
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itemcustomer->customer_id}}</td>
                                    <td>{{$itemcustomer->name}}</td>
                                    <td>{{$itemcustomer->email}}</td>
                                    <td>
                                        <form action="/managementcustomer/deleteaccount/{{$itemcustomer->id}}" method="post">
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
                        {{$customer->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
