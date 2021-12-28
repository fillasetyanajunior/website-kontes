@extends('layouts.layouts_dashboard')
@section('title',$title)
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
                        $user       = DB::table('users')->where('id',$itemnewsfeed->user_id_from)->first();
                        $project    = DB::table('projects')->where('id',$itemnewsfeed->contest_id)->first();
                        @endphp

                        @if ($itemnewsfeed->choices == 'eliminasi')
                        <tr>
                            <td>
                                <div class="d-flex flex-column mb-3">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div>
                                                <a href="javascript:void(0)">
                                                    @if ($user != null)
                                                    {{$user->name}}
                                                    @else

                                                    @endif
                                                </a>
                                                You have been eliminated for
                                                <a
                                                    href="{{'/brief' . $project->catagories_project . '/' . Crypt::encrypt($itemnewsfeed->contest_id)}}">
                                                    {{$project->title}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        @if ($itemnewsfeed->filecontest != '')
                                        <img src="{{asset('/storage/resultcontest/' . $itemnewsfeed->filecontest)}}"
                                            width="200px">
                                        @else
                                        <img src="{{asset('assets/dashboard/images/bid.png')}}" width="200px">
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @elseif ($itemnewsfeed->choices == 'feedback')
                        <tr>
                            <td>
                                <div class="d-flex flex-column mb-3">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div>
                                                <a href="javascript:void(0)">
                                                    @if ($user != null)
                                                    {{$user->name}}
                                                    @else

                                                    @endif
                                                </a>
                                                Your got feedback for
                                                <a
                                                    href="{{'/brief' . $project->catagories_project . '/' . Crypt::encrypt($itemnewsfeed->contest_id)}}">
                                                    {{$project->title}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <p class="text-justify">
                                            {{$itemnewsfeed->feedback}}
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @elseif ($itemnewsfeed->choices == 'winner choose')
                        <tr>
                            <td>
                                <div class="d-flex flex-column mb-3">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div>
                                                <a href="javascript:void(0)">
                                                    @if ($user != null)
                                                    {{$user->name}}
                                                    @else

                                                    @endif
                                                </a>
                                                {{$project->catagories_project}} project you have passed the time
                                                limit, choose a winner immediately for
                                                <a
                                                    href="{{'/brief' . $project->catagories_project . '/' . Crypt::encrypt($itemnewsfeed->contest_id)}}">
                                                    {{$project->title}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @elseif ($itemnewsfeed->choices == 'rating')
                        <tr>
                            <td>
                                <div class="d-flex flex-column mb-3">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div>
                                                <a href="javascript:void(0)">
                                                    @if ($user != null)
                                                    {{$user->name}}
                                                    @else

                                                    @endif
                                                </a>
                                                Congrats you got the rating for
                                                <a
                                                    href="{{'/brief' . $project->catagories_project . '/' . Crypt::encrypt($itemnewsfeed->contest_id)}}">
                                                    {{$project->title}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="d-flex flex-column mb-3">
                                            <div class="mt-3">
                                                @if ($itemnewsfeed->filecontest != '')
                                                <img src="{{asset('/storage/resultcontest/' . $itemnewsfeed->filecontest)}}"
                                                    width="200px">
                                                @else
                                                <img src="{{asset('assets/dashboard/images/bid.png')}}" width="200px">
                                                @endif
                                            </div>
                                            <div class="mt-3">

                                                @if ($itemnewsfeed->rating == 1)
                                                <a href="javascript:void(0)" data-nilai="1"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star-o"></i></a>
                                                <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star-o"></i></a>
                                                <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star-o"></i></a>
                                                <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                                                @elseif ($itemnewsfeed->rating == 2)
                                                <a href="javascript:void(0)" data-nilai="1"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="2"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star-o"></i></a>
                                                <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star-o"></i></a>
                                                <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                                                @elseif ($itemnewsfeed->rating == 3)
                                                <a href="javascript:void(0)" data-nilai="1"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="2"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="3"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star-o"></i></a>
                                                <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                                                @elseif ($itemnewsfeed->rating == 4)
                                                <a href="javascript:void(0)" data-nilai="1"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="2"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="3"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="4"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                                                @elseif ($itemnewsfeed->rating == 5)
                                                <a href="javascript:void(0)" data-nilai="1"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="2"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="3"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="4"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                <a href="javascript:void(0)" data-nilai="5"><i
                                                        class="fa fa-star text-yellow"></i></a>
                                                @else
                                                <a href="javascript:void(0)" data-nilai="1"><i class="fa fa-star-o"></i></a>
                                                <a href="javascript:void(0)" data-nilai="2"><i class="fa fa-star-o"></i></a>
                                                <a href="javascript:void(0)" data-nilai="3"><i class="fa fa-star-o"></i></a>
                                                <a href="javascript:void(0)" data-nilai="4"><i class="fa fa-star-o"></i></a>
                                                <a href="javascript:void(0)" data-nilai="5"><i class="fa fa-star-o"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @elseif ($itemnewsfeed->choices == 'comment public')
                        <tr>
                            <td>
                                <div class="d-flex flex-column mb-3">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div>
                                                <a href="javascript:void(0)">
                                                    @if ($user != null)
                                                    {{$user->name}}
                                                    @else

                                                    @endif
                                                </a>
                                                Your got comment public for
                                                <a
                                                    href="{{'/brief' . $project->catagories_project . '/' . Crypt::encrypt($itemnewsfeed->contest_id)}}">
                                                    {{$project->title}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <p class="text-justify">
                                            {{$itemnewsfeed->feedback}}
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @elseif ($itemnewsfeed->choices == 'handover')
                        <tr>
                            <td>
                                <div class="d-flex flex-column mb-3">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div>
                                                <a href="javascript:void(0)">
                                                    @if ($user != null)
                                                    {{$user->name}}
                                                    @else

                                                    @endif
                                                </a>
                                                {{$itemnewsfeed->feedback}} for
                                                <a
                                                    href="{{'/brief' . $project->catagories_project . '/' . Crypt::encrypt($itemnewsfeed->contest_id)}}">
                                                    {{$project->title}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @elseif ($itemnewsfeed->choices == 'pick winner')
                        <tr>
                            <td>
                                <div class="d-flex flex-column mb-3">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div>
                                                <a href="javascript:void(0)">
                                                    @if ($user != null)
                                                    {{$user->name}}
                                                    @else

                                                    @endif
                                                </a>
                                                Congratulations you are the winner of the contest for
                                                <a
                                                    href="{{'/brief' . $project->catagories_project . '/' . Crypt::encrypt($itemnewsfeed->contest_id)}}">
                                                    {{$project->title}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        @if ($itemnewsfeed->filecontest != '')
                                        <img src="{{asset('/storage/resultcontest/' . $itemnewsfeed->filecontest)}}"
                                            width="200px">
                                        @else
                                        <img src="{{asset('assets/dashboard/images/bid.png')}}" width="200px">
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @elseif ($itemnewsfeed->choices == 'handover command')
                        <tr>
                            <td>
                                <div class="d-flex flex-column mb-3">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div>
                                                <a href="javascript:void(0)">
                                                    @if ($user != null)
                                                    {{$user->name}}
                                                    @else

                                                    @endif
                                                </a>
                                                Your got handover command for
                                                <a
                                                    href="{{'/brief' . $project->catagories_project . '/' . Crypt::encrypt($itemnewsfeed->contest_id)}}">
                                                    {{$project->title}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <p class="text-justify">
                                            {{$itemnewsfeed->feedback}}
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td>
                                <div class="d-flex flex-column mb-3">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div>
                                                <a href="javascript:void(0)">
                                                    @if ($user != null)
                                                    {{$user->name}}
                                                    @else

                                                    @endif
                                                </a>
                                                submit your contest for
                                                <a
                                                    href="{{'/brief' . $project->catagories_project . '/' . Crypt::encrypt($itemnewsfeed->contest_id)}}">
                                                    {{$project->title}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        @if ($itemnewsfeed->filecontest != null)
                                        <img src="{{asset('/storage/resultcontest/' . $itemnewsfeed->filecontest)}}"
                                            width="200px">
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
