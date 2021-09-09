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
                data-url="{{url('storage')}}" data-id="{{$itemresultcontest->id}}">
                <img src="{{asset('/storage/resultcontest/' . $itemresultcontest->filecontest)}}" class="rounded"
                    style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
            </a>
            @elseif ($itemresultcontest->is_active == 'eliminasi')
            <img src="{{url('assets/dashboard/images/gembok.png')}}" class="rounded"
                style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
            @else
            <a href="javascript:void(0)" id="feedback" class="mb-3" data-target="#FeedbackContest" data-toggle="modal"
                data-url="{{url('storage')}}" data-id="{{$itemresultcontest->id}}"
                style="background: url({{asset('/storage/resultcontest/' . $itemresultcontest->filecontest)}});background-size:350px ">
                <img src="{{asset('assets/dashboard/images/piala.png')}}" class="rounded"
                    style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
            </a>
            @endif
            <div class="d-flex align-items-center mt-5">
                @if ($user->avatar != 'default.jpg')
                <div class="avatar avatar-md mr-3"
                    style="background-image: url({{asset('/storage/profile/' . $user->avatar)}})">
                </div>
                @else
                <div class="avatar avatar-md mr-3"
                    style="background-image: url({{asset('assets/dashboard/images/default.jpg')}})">
                </div>
                @endif
                <div>
                    <h6 class="text-muted">#{{$i++ . ' By ' . $user->name}}</h6>
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
                    $itemresultcontest->is_active == 'active' &&
                    $project->is_active == 'running')
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
                    @if ($project->is_active == 'handover')
                        @if (request()->user()->id ==
                        $itemresultcontest->user_id_worker || request()->user()->id == $project->user_id)
                            <div class="mb-1">
                                <a class="btn btn-primary col-12" href="/handoverproject/{{$project->id}}">handover</a>
                            </div>
                        @endif
                    @endif
                    <div class="mb-1">
                        <button type="button" id="feedback" class="mb-1 btn btn-green col-12" data-target="#FeedbackContest"
                            data-toggle="modal" data-url="{{url('storage')}}" data-id="{{$itemresultcontest->id}}">
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
            @php
            foreach($message as $itemmessage) :
            if ($itemmessage->feedback_customer != null) {
            $users = DB::table('users')->where('id',$itemmessage->customer_id)->first();
            } else {
            $users = DB::table('users')->where('id',$itemmessage->worker_id)->first();
            }
            @endphp
            {{$users->name}}
            <div class="card">
                @if ($itemmessage->feedback_worker == null)
                <p>{{$itemmessage->feedback_customer}}</p>
                @else
                <p>{{$itemmessage->feedback_worker}}</p>
                @endif
            </div>
            @php
            endforeach;
            @endphp
        </div>
        <form action="{{route('comentar')}}" method="post">
            <div class="card-body">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$project->id}}">
                    @if (request()->user()->role == 'customer')
                    @php
                    if($project->catagories_project == 'contest'){
                    $user = DB::table('result_contests')->where('contest_id',$project->id)->first();
                    }else{
                    $user = DB::table('result_projects')->where('contest_id',$project->id)->first();
                    }
                    @endphp
                    <input type="hidden" name="user_id_worker" value="{{$user->user_id_worker}}">
                    @else
                    <input type="hidden" name="user_id" value="{{$project->user_id}}">
                    @endif
                    <div class="form-group">
                        <div class="form-group mb-0">
                            <textarea rows="5" class="form-control" name="feedback"></textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
