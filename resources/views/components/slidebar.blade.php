<div class="header py-4">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="{{route('home')}}">
                <img src="{{url('assets/dashboard/images/logo2.jpg')}}" class="" width="180px">
            </a>
            <div class="d-flex order-lg-2 ml-auto mt-3">
            <div class="dropdown">
                <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    @if (Auth::user()->avatar != 'default.jpg')
                    <span class="avatar"
                        style="background-image: url({{asset('storage/profile/' . Auth::user()->avatar)}})"></span>
                    @else
                    <span class="avatar"
                        style="background-image: url({{asset('assets/dashboard/images/default.jpg')}})"></span>
                    @endif
                    <span class="ml-2 d-none d-lg-block">
                        <span class="text-default" style="font-size: 11pt">{{Auth::user()->name}}</span>
                        <small class="text-muted d-block mt-1 text-uppercase"
                            style="font-size: 10pt">{{Auth::user()->role}}</small>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    @if (request()->user()->role == 'admin')
                    <a class="dropdown-item" href="/messenger">
                        <span class="float-right"></span>
                        <i class="dropdown-icon fe fe-mail"></i> Inbox
                    </a>
                    <a class="dropdown-item" href="{{env('API_WHATSAPP_URL')}}">
                        <span class="float-right"></span>
                        <i class="dropdown-icon fa fa-whatsapp"></i> Whatsapp Web QR
                    </a>
                    <a class="dropdown-item" href="{{route('newsfeed')}}">
                        <span class="float-right"></span>
                        <i class="dropdown-icon fe fe-bell"></i> News Feed
                    </a>
                    <a class="dropdown-item" href="{{route('accounting')}}">
                        <span class="float-right"></span>
                        <i class="dropdown-icon fa fa-bar-chart"></i> Accounting
                    </a>
                    @elseif (request()->user()->role == 'customer')
                    <a class="dropdown-item" href="{{route('profileCustomers')}}">
                        <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="/messenger">
                        <span class="float-right"></span>
                        <i class="dropdown-icon fe fe-mail"></i> Inbox
                    </a>
                    <a class="dropdown-item" href="{{route('newsfeed')}}">
                        <span class="float-right"></span>
                        <i class="dropdown-icon fe fe-bell"></i> News Feed
                    </a>
                    <a class="dropdown-item" href="{{route('favourites')}}">
                        <span class="float-right"></span>
                        <i class="dropdown-icon fa fa-heart"></i> Favourites
                    </a>
                    @else
                    <a class="dropdown-item" href="{{route('newsfeed')}}">
                        <span class="float-right"></span>
                        <i class="dropdown-icon fe fe-bell"></i> News Feed
                    </a>
                    <a class="dropdown-item" href="{{route('profileWorker')}}">
                        <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="{{route('profileWorkerSetting')}}">
                        <i class="dropdown-icon fa fa-wrench"></i> Account Setting
                    </a>
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
<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    @if (request()->user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link"><i class="fe fe-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link " data-toggle="dropdown"><i
                                class="fe fe-box"></i>Management User</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{route('managementworker')}}" class="dropdown-item ">Account Worker</a>
                            <a href="{{route('managementcustomer')}}" class="dropdown-item ">Account Customer</a>
                            <a href="{{route('managementadmin')}}" class="dropdown-item ">Account Admin</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link " data-toggle="dropdown"><i
                                class="fe fe-box"></i>Management Website</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{route('catagories')}}" class="dropdown-item ">Catagories</a>
                            <a href="{{route('opsipackage')}}" class="dropdown-item ">Opsi Paket Contest</a>
                            <a href="{{route('jobcatagories')}}" class="dropdown-item ">Job Description</a>
                            <a href="{{route('code')}}" class="dropdown-item ">Code Discount</a>
                            <a href="{{route('nda')}}" class="dropdown-item ">NDA</a>
                            <a href="{{route('resultcontest')}}" class="dropdown-item ">Test Contest</a>
                        </div>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{route('browseproject')}}" class="nav-link"><i
                                class="fe fe-search"></i>Browse Projects</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('desainlist')}}" class="nav-link"><i
                                class="fe fe-list"></i>List Desain Project</a>
                    </li>
                    @if (request()->user()->role != 'admin')
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link"><i class="fa fa-edit"></i>My Project</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
