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
                <div class="d-flex mb-3">
                    <div class="ml-auto">
                        <input type="text" id="searchpaymentlist" class="form-control" placeholder="Search">
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Payment List</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Invoice Payment</th>
                                    <th>Name Transaksi</th>
                                    <th>Email Transaksi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="resultpaymentlist">
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($paymentlist as $itempaymentlist)
                                @php
                                    $perjanjian = DB::table('upload_file_perjanjians')->where('contest_id',$itempaymentlist->project_id)->first();
                                @endphp
                                <tr>
                                    <td><span class="text-muted">{{$i}}</span></td>
                                    <td>{{$itempaymentlist->payment_id_transaksi}}</td>
                                    <td>{{$itempaymentlist->name_transaksi}}</td>
                                    <td>{{$itempaymentlist->email_transaksi}}</td>
                                    <td>
                                        @if ($itempaymentlist->is_active == 'waiting payment')
                                        @if ($perjanjian != null)
                                        @if ($perjanjian->perjanjian == null)
                                        Silahkan isi File Perjanjian Terlebih Dahulu
                                        @else
                                        <form action="/waittingpayment/confirm/{{$itempaymentlist->project_id}}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-primary btn-sm text-white text-uppercase">{{$itempaymentlist->is_active}}</button>
                                        </form>
                                        @endif
                                        @else
                                        <form action="/waittingpayment/confirm/{{$itempaymentlist->project_id}}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-primary btn-sm text-white text-uppercase">{{$itempaymentlist->is_active}}</button>
                                        </form>
                                        @endif
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
