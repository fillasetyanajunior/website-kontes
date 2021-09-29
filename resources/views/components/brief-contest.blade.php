<div class="row row-cards" id="descri">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @php
                        $day        = date('d',strtotime($project->deadline));
                        $month      = date('m',strtotime($project->deadline));
                        $year       = date('Y',strtotime($project->deadline));
                        $time       = (int)((mktime (0,0,0,$month,$day,$year) - time())/86400);
                        $desainers  = DB::table('result_contests')->where('contest_id',$project->id)->distinct()->count('user_id_worker');
                        $desains    = DB::table('result_contests')->where('contest_id',$project->id)->count();
                        $file       = DB::table('upload_file_projects')->where('contest_id',$project->id)->get();
                        $fee        = ((15/100) * $project->harga);
                        $harga      = $project->harga - $fee - 40;
                    @endphp
                    <div class="">
                        <i class="fa fa-money"></i>&nbsp;
                        {{"$ ". number_format($harga + 40)}}
                    </div>
                    <div class="ml-2">
                        <i class="fe fe-clock"></i>&nbsp;
                        {{$time}} Days
                    </div>
                    <div class="ml-2">
                        <i class="fa fa-image"></i>&nbsp;
                        {{$desains}} Design
                    </div>
                    <div class="ml-2">
                        <i class="fa fa-user"></i>&nbsp;
                        {{$desainers}} Designers
                    </div>
                    <div class="ml-auto">
                        @php
                            $projectupgrade = explode('/',$detailcontest->packageupgrade);
                        @endphp
                        @for ($i = 0; $i < count($projectupgrade); $i++)
                            @php
                                $nameupgrade = DB::table('opsi_package_upgrades')->where('id',$projectupgrade[$i])->first();
                            @endphp
                            @if ($nameupgrade->name == 'Urgent')
                            <p class="btn btn-sm btn-red">{{$nameupgrade->name}}</p>
                            @elseif ($nameupgrade->name == 'Guaranteed')
                            <p class="btn btn-sm btn-green">{{$nameupgrade->name}}</p>
                            @elseif ($nameupgrade->name == '10 Days')
                            <p class="btn btn-sm btn-blue">{{$nameupgrade->name}}</p>
                            @elseif ($nameupgrade->name == '20 Days')
                            <p class="btn btn-sm btn-indigo">{{$nameupgrade->name}}</p>
                            @elseif ($nameupgrade->name == 'Non Disclosure Agreement (NDA)')
                            <p class="btn btn-sm btn-azure">{{$nameupgrade->name}}</p>
                            @elseif ($nameupgrade->name == 'Designer Pro')
                            <p class="btn btn-sm btn-orange">{{$nameupgrade->name}}</p>
                            @else
                            <p class="btn btn-sm btn-lime">{{$nameupgrade->name}}</p>
                            @endif

                        @endfor
                    </div>
                </div>
                <hr>
                <div>
                    <h4 class="text-capitalize">logo design brief</h4>
                    <p class="text-justify">
                        {{$detailcontest->description}}
                    </p>
                </div>
                <hr>
                <div>
                    <h4 class="text-capitalize">logo text</h4>
                    <p>{{$detailcontest->title_logo}}</p>
                </div>
                <hr>
                <div>
                    <h4 class="text-capitalize">catagories</h4>
                    <p>{{$catagories->name}}</p>
                </div>
                <hr>
                <div>
                    <h4 class="text-capitalize">requirements</h4>
                    <h5 class="text-capitalize">should have</h5>
                    <p class="text-justify">
                        {{$project->shouldhave}}
                    </p>
                    <h5 class="text-capitalize">should not have</h5>
                    <p class="text-justify">
                        {{$project->shouldnothave}}
                    </p>
                </div>
                <hr>
                <div>
                    <h4 class="text-capitalize">file</h4>
                    <div class="d-flex bd-highlight mb-3">
                        <div class="bd-highlight ml-3">
                            <a href="/convertzipproject/{{$project->id}}" class="btn btn-primary">Download All
                                Files</a>
                        </div>
                    </div>
                    <table class="table card-table table-vcenter">
                        @foreach ($file as $itemfile)
                        <tr>
                            <td width="60px"><i class="fa fa-file" style="font-size: 20pt"></i></td>
                            <td width="">{{$itemfile->name}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="row">
            <div class="col-md-6 col-lg-12">
                @php
                    $worker = DB::table('workers')->where('user_id',request()->user()->id)->first();
                @endphp
                @if (request()->user()->role == 'worker' && $project->is_active == 'running' && $worker->status_account != 'suspend')
                <a href="javascript:void(0)" class="btn btn-primary mb-5 col-lg-12 font-weight-bold" idcontest="{{$project->id}}" data-catagories="{{$catagories->name}}"
                    data-toggle="modal" data-target="#contestModal" id="tambahresultcontest">Submit
                    Entry</a>
                @elseif (request()->user()->role == 'admin')
                <form action="/deletecontest/{{$project->id}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger col-lg-12 mb-5">Delete</button>
                </form>
                <form action="/lockedcontest/{{$project->id}}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-azure col-lg-12 mb-5">Locked Project</button>
                </form>
                <button type="button" class="btn btn-primary col-lg-12 mb-5" data-toggle="modal"
                    data-target="#ExtendedDeadline">Extended Deadline</button>
                @endif
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table card-table table-vcenter">
                            <tr>
                                <td>
                                    1st place
                                </td>
                                <td width="80px">
                                    {{"$ ". number_format($harga)}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Participation payments x 4
                                </td>
                                <td>
                                    {{"$ ". number_format(10)}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Total Harga
                                </td>
                                <td>
                                    {{"$ ". number_format($harga + 40)}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
