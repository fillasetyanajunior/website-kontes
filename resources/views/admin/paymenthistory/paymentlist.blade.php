@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Payment List
            </h1>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Project Running</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Invoice Payment</th>
                                    <th>Name</th>
                                    <th>Nomer Payment</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($paymentlist as $itempaymentlist)
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itempaymentlist->invoicepayment}}</td>
                                    <td>{{$itempaymentlist->name}}</td>
                                    <td>{{$itempaymentlist->nomerpayment}}</td>
                                    <td>
                                        @if ($itempaymentlist->is_active == 'waitting payment')
                                        <form action="/waittingpayment/confirm/{{$itempaymentlist->project_id}}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-primary btn-sm text-white text-uppercase">{{$itempaymentlist->is_active}}</button>
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
                        {{$paymentlist->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
