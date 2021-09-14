<div class="row row-cards" id="descri">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap">
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
                    <div class="ml-3">
                        <i class="fe fe-clock"></i>&nbsp;
                        {{$time}} Hari
                    </div>
                    <div class="ml-3">
                        <i class="fa fa-image"></i>&nbsp;
                        {{$desains}} Desain
                    </div>
                    <div class="ml-3">
                        <i class="fa fa-user"></i>&nbsp;
                        {{$desainers}} Desainers
                    </div>
                </div>
                <hr>
                <div>
                    <h4 class="text-capitalize">logo desain brief</h4>
                    <div class="text-justify">
                        {{$detailcontest->description}}
                    </div>
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
                    <p>{{$project->shouldhave}}</p>
                    <h5 class="text-capitalize">should not have</h5>
                    <p>{{$project->shouldnothave}}</p>
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
    <div class="col-lg-4">
        <div class="row">
            <div class="col-md-6 col-lg-12">
                @php
                    $worker = DB::table('workers')->where('user_id',request()->user()->id)->first();
                @endphp
                @if (request()->user()->role == 'worker' && $project->is_active == 'running' && $worker->status_account != 'suspend')
                <a href="javascript:void(0)" class="btn btn-primary mb-5 col-lg-12" idcontest="{{$project->id}}" data-catagories="{{$catagories->name}}"
                    data-toggle="modal" data-target="#contestModal" id="tambahresultcontest">Submit
                    Contest</a>
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
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table card-table table-vcenter">
                            <tr>
                                <td>
                                    1st place
                                </td>
                                <td>
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
