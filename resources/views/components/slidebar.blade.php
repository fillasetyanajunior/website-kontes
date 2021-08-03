<div class="header py-4">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="/home">
                <img src="{{url('assets/auth/img/logo.jpg')}}" class="header-brand-img">
            </a>
            <a href="" class="nav-link text-dark"><i class="fe fe-search"></i>&nbsp; Browse Projects</a>
            <a href="/home" class="nav-link text-dark">&nbsp; My Project</a>
            <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown d-none d-md-flex">
                    <a class="nav-link icon notif" data-toggle="dropdown" data-url="{{asset('profile')}}"
                        data-id="{{request()->user()->id}}">
                        <i class="fe fe-mail"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" id="notifdropdown">

                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                        <span class="avatar"
                            style="background-image: url({{asset('profile/' . Auth::user()->avatar)}})"></span>
                        <span class="ml-2 d-none d-lg-block">
                            <span class="text-default">{{Auth::user()->name}}</span>
                            <small class="text-muted d-block mt-1 text-uppercase">{{Auth::user()->role}}</small>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        @if (request()->user()->role == 'customer')
                        <a class="dropdown-item" href="">
                            <i class="dropdown-icon fe fe-user"></i> Profile
                        </a>
                        <a class="dropdown-item" href="">
                            <span class="float-right"><span class="badge badge-primary">6</span></span>
                            <i class="dropdown-icon fe fe-mail"></i> Inbox
                        </a>
                        @elseif (request()->user()->role == 'worker')
                        <a class="dropdown-item" href="">
                            <i class="dropdown-icon fe fe-user"></i> Profile
                        </a>
                        @else
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }} " content="{{'logout'}}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <i class="fe fe-log-out dropdown-icon"></i>{{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse"
                data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
            </a>
        </div>
    </div>
</div>
{{-- <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="/home" class="nav-link @if ($_title == 'Home') active @endif"><i
                                class="fe fe-home"></i> Home</a>
                    </li>
                    @if (request()->user()->role == 'admin')
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link @if ($_title == 'Management User') active @endif"
                            data-toggle="dropdown"><i class="fe fe-box"></i>Management User</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{route('management-workers')}}" class="dropdown-item ">Account Worker</a>
                            <a href="{{route('management-customer')}}" class="dropdown-item ">Account Customer</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)"
                            class="nav-link @if ($_title == 'Management Contest') active @endif"
                            data-toggle="dropdown"><i class="fe fe-box"></i>Management Contest</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{route('pricecontest')}}" class="dropdown-item ">Price Hasil Contest</a>
                            <a href="{{route('opsicontest')}}" class="dropdown-item ">Paket Contest</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link @if ($_title == 'Browse Project') active @endif"
                            data-toggle="dropdown"><i class="fe fe-box"></i>Browse Project</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{route('project')}}" class="dropdown-item ">New Project</a>
                            <a href="{{route('contest')}}" class="dropdown-item ">Contest</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)"
                            class="nav-link @if ($_title == 'Management Project') active @endif"
                            data-toggle="dropdown"><i class="fe fe-box"></i>Management Project</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{route('waittingpayment')}}" class="dropdown-item ">Waiting Payment</a>
                            <a href="{{route('projectrunning')}}" class="dropdown-item ">Project Running</a>
                            <a href="{{route('winnercontest')}}" class="dropdown-item ">Choose Winner</a>
                            <a href="{{route('handoverproject')}}" class="dropdown-item ">Handover Projects</a>
                            <a href="{{route('closeproject')}}" class="dropdown-item ">Projects Closed</a>
                            <a href="{{route('cancelproject')}}" class="dropdown-item ">Projects Canceled</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('report')}}"
                            class="nav-link @if ($_title == 'Replay Reports') active @endif"><i
                                class="fe fe-check-square"></i>
                            Replay Reports</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('chat')}}" class="nav-link @if ($_title == 'Chat') active @endif"><i
                                class="fe fe-check-square"></i>
                            Chat</a>
                    </li>
                    @elseif(request()->user()->role == 'customer')
                    <li class="nav-item dropdown">
                        <a href="{{route('profileCustomers')}}"
                            class="nav-link @if ($_title == 'Customer Profile') active @endif"><i
                                class="fe fe-check-square"></i>
                            Customers Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link @if ($_title == 'Project') active @endif"
                            data-toggle="dropdown"><i class="fe fe-box"></i>Project</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{route('project')}}" class="dropdown-item ">New Project</a>
                            <a href="{{route('contest')}}" class="dropdown-item ">Contest</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link @if ($_title == 'Project Status') active @endif"
                            data-toggle="dropdown"><i class="fe fe-box"></i>Project Status</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{route('waittingpayment')}}" class="dropdown-item ">Waiting Payment</a>
                            <a href="{{route('projectrunning')}}" class="dropdown-item ">Project Running</a>
                            <a href="{{route('winnercontest')}}" class="dropdown-item ">Choose Winner</a>
                            <a href="{{route('handoverproject')}}" class="dropdown-item ">Handover Projects</a>
                            <a href="{{route('closeproject')}}" class="dropdown-item ">Projects Closed</a>
                            <a href="{{route('cancelproject')}}" class="dropdown-item ">Projects Canceled</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('chat')}}" class="nav-link @if ($_title == 'Chat') active @endif"><i
                                class="fe fe-check-square"></i>
                            Chat</a>
                    </li>
                    @else
                    @php
                    $data = DB::table('workers')->where('user_id',Auth::user()->id)->first();
                    @endphp
                    <li class="nav-item dropdown">
                        <a href="{{route('browseproject')}}"
                            class="nav-link @if ($_title == 'Browse Projects') active @endif"><i
                                class="fe fe-check-square"></i>
                            Browse Projects</a>
                    </li>
                    @if ($data->status_account == 'verified')
                    <li class="nav-item dropdown">
                        <a href="{{route('profileWorker')}}"
                            class="nav-link @if ($_title == 'Worker Profile') active @endif"><i
                                class="fe fe-check-square"></i>
                            Worker Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link @if ($_title == 'My Projects') active @endif"
                            data-toggle="dropdown"><i class="fe fe-box"></i>My Projects</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{route('projectrunning')}}" class="dropdown-item ">Project Running</a>
                            <a href="{{route('winnercontest')}}" class="dropdown-item ">Winner Contest</a>
                            <a href="{{route('handoverproject')}}" class="dropdown-item ">Handover Projects</a>
                            <a href="{{route('closeproject')}}" class="dropdown-item ">Projects Closed</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('report')}}"
                            class="nav-link @if ($_title == 'Replay Reports') active @endif"><i
                                class="fe fe-check-square"></i>
                            Replay Reports</a>
                    </li>
                    @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div> --}}
