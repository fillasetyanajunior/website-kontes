@extends('layouts.layouts_dashboard')
@section('content')
<x-slidebar></x-slidebar>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>News Feed</h2>
                    </div>
                    <table class="table card-table table-vcenter">
                        @foreach ($newsfeed as $itemnewsfeed)
                            @php
                            if ($itemnewsfeed->catagories_project == 'contest') {
                                $data   = DB::table('result_contests')->where('contest_id',$itemnewsfeed->id)->first();
                                $role   = 'contest';
                            } else {
                                $data   = DB::table('result_projects')->where('contest_id',$itemnewsfeed->id)->first();
                                $role   = 'direct';
                            }
                            if ($data != null) :
                            $user       = DB::table('workers')->where('user_id',$data->user_id_worker)->first();
                            @endphp
                        <tr>
                            <td>
                                <div class="d-flex flex-column bd-highlight mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3"
                                        style="background-image: url(demo/faces/female/1.jpg)"></div>
                                        <div>
                                            <div>
                                                <a href="/profileworker/{{$data->user_id_worker}}">{{$user->name}}</a> rated your entries for<a href="{{'/gallery' . $role . '/' . $itemnewsfeed->id}}"> {{$itemnewsfeed->title}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 bd-highlight">
                                        @if ($itemnewsfeed->catagories_project == 'contest')
                                        <img src="{{asset('/storage/resultcontest/' . $data->filecontest)}}" width="200px">
                                        @else
                                        <img src="{{asset('assets/dashboard/images/bid.png')}}" width="200px">
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
