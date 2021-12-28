@extends('layouts.layouts_dashboard')
@section('title',$title)
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Management Desain
            </h1>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Desain</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Name</th>
                                    <th>Desain Card</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $j=1;
                                @endphp
                                @foreach ($desaincard as $itemdesaincard)
                                @php
                                $projectdesaincard = explode('/',$itemdesaincard->pilihandesain);
                                    for ($i=0; $i < count($projectdesaincard); $i++) {
                                        if ($projectdesaincard[$i] == 1) {
                                            $pilihan[$i] = 'businesscard';
                                            $nama[$i] = 'Business Card';
                                        } elseif($projectdesaincard[$i] == 2){
                                            $pilihan[$i] = 'emailsignature';
                                            $nama[$i] = 'Email Signature';
                                        } elseif($projectdesaincard[$i] == 3){
                                            $pilihan[$i] = 'letterheads';
                                            $nama[$i] = 'Letterheads';
                                        } elseif($projectdesaincard[$i] == 4){
                                            $pilihan[$i] = 'flayer';
                                            $nama[$i] = 'Flayer';
                                        } elseif($projectdesaincard[$i] == 5){
                                            $pilihan[$i] = 'invoices';
                                            $nama[$i] = 'Invoices';
                                        } elseif($projectdesaincard[$i] == 6){
                                            $pilihan[$i] = 'postcard';
                                            $nama[$i] = 'Post Card';
                                        } elseif($projectdesaincard[$i] == 7){
                                            $pilihan[$i] = 'facebookcover';
                                            $nama[$i] = 'Facebook Cover';
                                        } elseif($projectdesaincard[$i] == 8){
                                            $pilihan[$i] = 'facebookpost';
                                            $nama[$i] = 'Facebook Post';
                                        } elseif($projectdesaincard[$i] == 9){
                                            $pilihan[$i] = 'youtubebenners';
                                            $nama[$i] = 'Youtube Benners';
                                        }elseif ($projectdesaincard[$i] == 10) {
                                            $nama[$i] = 'Instagram Post';
                                            $pilihan[$i] = 'instagrampost';
                                        }else{
                                            $pilihan[$i] = '';
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td><span class="text-muted">{{$j++}}</span></td>
                                    <td>{{$itemdesaincard->title}}</td>
                                    <td width="100px">
                                        @if ($pilihan[0] != '' && $pilihan[1] != '' && $pilihan[2] != '')
                                        <a href="{{route($pilihan[0],['id' => Crypt::encrypt($itemdesaincard->title)])}}" class="btn btn-primary btn-sm">{{$nama[0]}}</a>
                                        <a href="{{route($pilihan[1],['id' => Crypt::encrypt($itemdesaincard->title)])}}" class="btn btn-primary btn-sm">{{$nama[1]}}</a>
                                        <a href="{{route($pilihan[2],['id' => Crypt::encrypt($itemdesaincard->title)])}}" class="btn btn-primary btn-sm">{{$nama[2]}}</a>
                                        @elseif ($pilihan[0] != '' && $pilihan[1] != '' && $pilihan[2] == '')
                                        <a href="{{route($pilihan[0],['id' => Crypt::encrypt($itemdesaincard->title)])}}" class="btn btn-primary btn-sm">{{$nama[0]}}</a>
                                        <a href="{{route($pilihan[1],['id' => Crypt::encrypt($itemdesaincard->title)])}}" class="btn btn-primary btn-sm">{{$nama[1]}}</a>
                                        @else
                                        <a href="{{route($pilihan[0],['id' => Crypt::encrypt($itemdesaincard->title)])}}" class="btn btn-primary btn-sm">{{$nama[0]}}</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$desaincard->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
