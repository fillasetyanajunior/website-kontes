<div id="gallery">
    <livewire:gallery-contest :project="$project" :key="$project->id">
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
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="Replay('{{$itemmessage->feedback}}')">Reply</button>
                </div>
            </div>
            @php
                $cekreplay = DB::table('replay_public_discuses')->where('message_replay',$itemmessage->feedback)->first();
                $replay = DB::table('replay_public_discuses')->where('message_replay',$itemmessage->feedback)->get();
            @endphp
            @if ($cekreplay != null)
            @foreach ($replay as $itemreplay)
            @if ($itemreplay->message_replay == $itemmessage->feedback)
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
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="Replay('{{$itemmessage->feedback}}')">Reply</button>
                </div>
            </div>
            @endif
            @endforeach
            @endif
            <hr>
            @endforeach
        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="form-group">
                    <div class="form-group mb-0">
                        <textarea rows="5" class="form-control" wire:model="feedback"></textarea>
                    </div>
                </div>
                <div class="text-right">
                    <button type="button" wire:click="MessageComentar({{$project->id}})" class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>
