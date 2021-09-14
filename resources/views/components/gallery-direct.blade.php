<div class="row row-cards" id="gallery">
    @foreach ($resultdirect as $itemresultdirect)
    @php
    $user = DB::table('workers')->where('user_id',$itemresultdirect->user_id_worker)->first();
    @endphp
    <div class="col-sm-6 col-lg-4">
        <div class="card p-3">
            @if ($itemresultdirect->is_active == 'active')
            @if ($user->avatar != 'default.jpg')
            <a href="javascript:void(0)" id="feedbackbid" class="mb-3" data-target="#FeedbackDirect" data-toggle="modal"
                data-url="{{url('storage')}}" data-id="{{$itemresultdirect->id}}">
                <img src="{{asset('/storage/profile/' . $user->avatar)}}" class="rounded"
                    style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
            </a>
            @else
            <a href="javascript:void(0)" id="feedbackbid" class="mb-3" data-target="#FeedbackDirect" data-toggle="modal"
                data-url="{{url('storage')}}" data-id="{{$itemresultdirect->id}}">
                <img src="{{asset('assets/dashboard/images/default.jpg')}}" class="rounded"
                    style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
            @endif
            @elseif ($itemresultdirect->is_active == 'eliminasi')
            <img src="{{url('assets/dashboard/images/gembok.png')}}" class="rounded"
                style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
            @else
            <a href="javascript:void(0)" id="feedbackbid" class="mb-3" data-target="#FeedbackDirect"
                data-toggle="modal" data-url="{{url('storage')}}" data-id="{{$itemresultdirect->id}}">
                <img src="{{asset('assets/dashboard/images/piala.png')}}" class="rounded"
                    style="width: 300px; height: 300px; overflow: hidden; width: 100%;">
                <img src="{{asset('assets/dashboard/images/piala.png')}}"
                style="width: 110px; height: 100px; overflow: hidden; position: absolute;left: 0px; top: 0px;">
            </a>
            @endif
            <div class="d-flex align-items-center mt-5">
                <div>
                    <small class="d-block text-muted">{{$user->name}}</small>
                    @if ($itemresultdirect->nilai == 1)
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="2"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="3"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="4"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="5"><i class="fa fa-star-o"></i></a>
                    @elseif ($itemresultdirect->nilai == 2)
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="3"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="4"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="5"><i class="fa fa-star-o"></i></a>
                    @elseif ($itemresultdirect->nilai == 3)
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="4"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="5"><i class="fa fa-star-o"></i></a>
                    @elseif ($itemresultdirect->nilai == 4)
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="5"><i class="fa fa-star-o"></i></a>
                    @elseif ($itemresultdirect->nilai == 5)
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="1"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="2"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="3"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="4"><i class="fa fa-star text-yellow"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="5"><i class="fa fa-star text-yellow"></i></a>
                    @else
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="1"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="2"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="3"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="4"><i class="fa fa-star-o"></i></a>
                    <a href="javascript:void(0)" @if(request()->user()->role == 'customer' &&
                        request()->user()->id == $project->user_id && $project->is_active == 'running' &&
                        $itemresultdirect->is_active == 'active')
                        id="nilaidirect" @endif data-id="{{$itemresultdirect->id}}"
                        data-nilai="5"><i class="fa fa-star-o"></i></a>
                    @endif
                </div>
                <div class="ml-auto">
                    @if (request()->user()->role == 'customer' && request()->user()->id == $project->user_id &&
                    $project->is_active == 'running' && $itemresultdirect->is_active == 'active')
                    <div class="mb-1" id="eliminasidirect">
                        <button type="submit" class=" btn btn-danger col-12" id="btneliminasidirects"
                            data-toggle="modal" data-url="{{url('assets/dashboard/images')}}"
                            data-target="#ActionDirectModal" data-id="{{$itemresultcontest->id}}">Eliminasi</button>
                    </div>
                    <div class="mb-1" id="pickwinnerdirect">
                        <button type="submit" class=" btn btn-azure col-12" id="btnpickwinnerdirects"
                            data-toggle="modal" data-url="{{url('assets/dashboard/images')}}"
                            data-target="#ActionDirectModal" data-id="{{$itemresultcontest->id}}">Pick
                            Winner</button>
                    </div>
                    @endif
                    @if ($project->is_active == 'handover' && $itemresultcontest->is_active == 'winner')
                    @if (request()->user()->id == $itemresultcontest->user_id_worker || request()->user()->id ==
                    $project->user_id)

                    <div class="mb-1">
                        <a class="btn btn-primary col-12" href="/handoverproject/{{$project->id}}">Handover</a>
                    </div>
                    @endif
                    @endif
                    <div class="mb-1">
                        <button type="button" id="feedback" class=" btn btn-green col-12"
                            data-target="#FeedbackDirect" data-toggle="modal" data-url="{{url('storage')}}"
                            data-id="{{$itemresultcontest->id}}">
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
