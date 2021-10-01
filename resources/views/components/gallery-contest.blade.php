<div class="row row-cards" id="gallery">
    <?php $i=1;?>
    @foreach ($resultcontest as $itemresultcontest)
    @php
    $user = DB::table('workers')->where('user_id',$itemresultcontest->user_id_worker)->first();
    @endphp
    <div class="col-sm-6 col-lg-4">
        <div class="card p-3">
            @if ($itemresultcontest->is_active == 'active')
            <a href="javascript:void(0)" id="feedback" class="mb-3" data-target="#FeedbackContest" data-toggle="modal"
                data-url="{{url('storage')}}" data-id="{{$itemresultcontest->id}}" data-user_id="{{request()->user()->id}}" data-role="{{request()->user()->role}}">
                <img src="{{asset('/storage/resultcontest/' . $itemresultcontest->filecontest)}}" class="rounded"
                    style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
            </a>
            @elseif ($itemresultcontest->is_active == 'eliminasi')
            <a href="javascript:void(0)" id="feedback" class="mb-3" data-target="#FeedbackContest" data-toggle="modal"
                data-url="{{url('storage')}}" data-id="{{$itemresultcontest->id}}" data-user_id="{{request()->user()->id}}" data-role="{{request()->user()->role}}">
                <img src="{{asset('/storage/resultcontest/' . $itemresultcontest->filecontest)}}" class="rounded badge-secondary"
                        style="width: 300px; height: 300px; overflow: hidden; width: 100%;filter:blur(5px);">
                <p style="width: 100%; overflow: hidden; position: absolute;left: 0px; top: 150px; font-size: 20pt" class="text-center text-white bg-red">REJECTED</p>
            </a>
            @else
            <a href="javascript:void(0)" id="feedback" class="mb-3" data-target="#FeedbackContest" data-toggle="modal"
                data-url="{{url('storage')}}" data-id="{{$itemresultcontest->id}}" data-user_id="{{request()->user()->id}}" data-role="{{request()->user()->role}}">
                <img src="{{asset('/storage/resultcontest/' . $itemresultcontest->filecontest)}}" class="rounded badge-secondary"
                    style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
                <img src="{{asset('assets/dashboard/images/piala.png')}}"
                    style="width: 110px; height: 100px; overflow: hidden; position: absolute;left: 0px; top: 0px;">
            </a>
            @endif
            <div class="d-flex align-items-center mt-5">
                @if ($user != null)
                    @if ($user->avatar != 'default.jpg')
                        <div class="avatar avatar-md mr-3"
                            style="background-image: url({{asset('/storage/profile/' . $user->avatar)}}); background-repeat: no-repeat;">
                        </div>
                    @else
                        <div class="avatar avatar-md mr-3"
                            style="background-image: url({{asset('assets/dashboard/images/default.jpg')}})">
                        </div>
                    @endif
                @else
                <div class="avatar avatar-md mr-3"
                    style="background-image: url({{asset('assets/dashboard/images/default.jpg')}})">
                </div>
                @endif
                <div>
                    @if ($user != null)
                    <a href="/profileworker/{{$user->user_id}}"><h6 class="text-muted">#{{$i++ . ' By ' . $user->name}}</h6></a>
                    @else
                    <a href="javascript:void(0)"><h6 class="text-muted">#{{$i++ . ' By Worker'}}</h6></a>
                    @endif
                    @if ($itemresultcontest->nilai == 1)
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="2"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="3"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="4"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="5"><i class="fa fa-star-o"></i></a>
                    @elseif ($itemresultcontest->nilai == 2)
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="3"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="4"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="5"><i class="fa fa-star-o"></i></a>
                    @elseif ($itemresultcontest->nilai == 3)
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="4"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="5"><i class="fa fa-star-o"></i></a>
                    @elseif ($itemresultcontest->nilai == 4)
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="5"><i class="fa fa-star-o"></i></a>
                    @elseif ($itemresultcontest->nilai == 5)
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="5"><i class="fa fa-star text-yellow"></i></a>
                    @else
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="1"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="2"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="3"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="4"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultcontest->is_active == 'active')
                        id="nilaicontest" @endif data-id="{{$itemresultcontest->id}}"
                        data-nilai="5"><i class="fa fa-star-o"></i></a>
                    @endif
                </div>
                <div class="ml-auto">
                    @if (request()->user()->role == 'customer' && request()->user()->id == $project->user_id &&
                    $itemresultcontest->is_active == 'active' && $project->is_active == 'running' || $project->is_active == 'choose winner' || request()->user()->role == 'admin'  &&
                    $itemresultcontest->is_active == 'active' && $project->is_active == 'running' || $project->is_active == 'choose winner' )
                    <div class="mb-1" id="eliminasicontest">
                        <button type="button" class="btn btn-danger col-12" id="btneliminasicontests"
                            data-toggle="modal" data-target="#ActionModal" data-url="{{url('assets/dashboard/images')}}"
                            data-id="{{$itemresultcontest->id}}">Eliminasi</button>
                    </div>
                    <div class="mb-1" id="pickwinnercontest">
                        <button type="button" class=" btn btn-azure col-12" id="btnpickwinnercontests"
                            data-toggle="modal" data-target="#ActionModal" data-url="{{url('assets/dashboard/images')}}"
                            data-id="{{$itemresultcontest->id}}">Pick Winner</button>
                    </div>
                    @endif
                    @if ($project->is_active == 'handover' && $itemresultcontest->is_active == 'winner')
                        @if (request()->user()->id ==
                        $itemresultcontest->user_id_worker || request()->user()->id == $project->user_id)
                            <div class="mb-1">
                                <a class="btn btn-primary col-12" href="/handoverproject/{{$project->id}}">Handover</a>
                            </div>
                        @endif
                    @endif
                    <div class="mb-1">
                        <button type="button" id="feedback" class="mb-1 btn btn-green col-12" data-target="#FeedbackContest"
                            data-toggle="modal" data-url="{{url('storage')}}" data-user_id="{{request()->user()->id}}" data-role="{{request()->user()->role}}" data-id="{{$itemresultcontest->id}}">
                            Feedback
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Public Discussion</h3>
        </div>
        <div class="card-body">
            @foreach($message as $itemmessage)
            @php
            $users = DB::table('users')->where('id',$itemmessage->user_id)->first();
            @endphp
            <div class="d-flex">
                <div class="mr-auto">
                    <div class="d-flex">
                        <div>
                            @if ($users->avatar == 'default.jpg')
                            <img src="{{url('assets/dashboard/images/default.jpg')}}" width="150px" class="mt-5">
                            @else
                            <img src="{{url('storage/profile/' . $users->avatar)}}" width="150px" class="mt-5">
                            @endif
                        </div>
                        <div class="ml-3">
                            <h6 class="mt-3">{{$users->name}}</h6>
                            <p class="mt-4">{{$itemmessage->feedback}}</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <button type="button" class="btn btn-secondary btn-sm" id="replaybuttonform">Reply</button>
                </div>
            </div>
            <form action="{{route('replaydiscus')}}" method="post" id="replayform">
                <div class="card-body">
                    @csrf
                    <input type="hidden" name="id" value="{{$itemmessage->feedback}}">
                    <div class="form-group">
                        <div class="form-group mb-0">
                            <textarea rows="2" class="form-control" name="feedback"></textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
            @php
                $cekreplay = DB::table('replay_public_discuses')->where('message_replay',$itemmessage->feedback)->first();
                $replay = DB::table('replay_public_discuses')->where('message_replay',$itemmessage->feedback)->get();
            @endphp
            @if ($cekreplay != null)
            @foreach ($replay as $itemreplay)
            @php
                $userreplay = DB::table('users')->where('id',$itemreplay->user_id)->first();
            @endphp
            <hr align="right" width="97%">
            <div class="d-flex ml-5 mt-5">
                <div class="mr-auto">
                    <div class="d-flex">
                        <div>
                            @if ($userreplay->avatar == 'default.jpg')
                            <img src="{{url('assets/dashboard/images/default.jpg')}}" width="150px" class="mt-5">
                            @else
                            <img src="{{url('storage/profile/' . $userreplay->avatar)}}" width="150px" class="mt-5">
                            @endif
                        </div>
                        <div class="ml-3">
                            <h6 class="mt-3">{{$userreplay->name}}</h6>
                            <p class="mt-4">{{$itemreplay->feedback}}</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <button type="button" class="btn btn-secondary btn-sm" id="replaybuttonform2">Reply</button>
                </div>
            </div>
            <form action="{{route('replaydiscus')}}" method="post" id="replayform2">
                <div class="card-body">
                    @csrf
                    <input type="hidden" name="id" value="{{$itemmessage->feedback}}">
                    <div class="form-group">
                        <div class="form-group mb-0">
                            <textarea rows="2" class="form-control" name="feedback"></textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
            @endforeach
            @endif
            <hr>
            @endforeach
        </div>
        <form action="{{route('comentar')}}" method="post">
            <div class="card-body">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$project->id}}">
                    <div class="form-group">
                        <div class="form-group mb-0">
                            <textarea rows="5" class="form-control" name="feedback"></textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
