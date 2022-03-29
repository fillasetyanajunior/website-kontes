<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- META DATA -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!--font-family-->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">

    <!-- TITLE OF SITE -->
    <title>@yield('title') - {{env('APP_NAME')}}</title>

    <!-- for title img -->
    <link rel="shortcut icon" type="image/icon" href="{{url('assets/dashboard/images/logo3.png')}}" />

    <!--font-awesome.min.css-->
    <link rel="stylesheet" href="{{url('assets/home/css/font-awesome.min.css')}}">

    <!--linear icon css-->
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

    <!--animate.css-->
    <link rel="stylesheet" href="{{url('assets/home/css/animate.css')}}">

    <!--hover.css-->
    <link rel="stylesheet" href="{{url('assets/home/css/hover-min.css')}}">

    <!--vedio player css-->
    <link rel="stylesheet" href="{{url('assets/home/css/magnific-popup.css')}}">

    <!--owl.carousel.css-->
    <link rel="stylesheet" href="{{url('assets/home/css/owl.carousel.min.css')}}">
    <link href="{{url('assets/home/css/owl.theme.default.min.css')}}" rel="stylesheet" />

    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="{{url('assets/home/css/bootstrap.min.css')}}">

    <!-- bootsnav -->
    <link href="{{url('assets/home/css/bootsnav.css')}}" rel="stylesheet" />

    <!--style.css-->
    <link rel="stylesheet" href="{{url('assets/home/css/style.css')}}">

    <!--responsive.css-->
    <link rel="stylesheet" href="{{url('assets/home/css/responsive.css')}}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <section class="header">
        <div class="container">
            <div class="header-left">
                <ul class="pull-left">
                    <li>
                        <a href="#">
                            <i class="fa fa-phone" aria-hidden="true"></i> +992 563 542
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-envelope" aria-hidden="true"></i>admin@jobsaja.com
                        </a>
                    </li>
                </ul>
            </div>
            <div class="header-right pull-right">
                <ul>
                    <li class="reg">
                        <a href="{{route('register')}}">
                            Register
                        </a>
                        /
                        <a href="{{route('login')}}">
                            Log in
                        </a>
                    </li>
                    <li>
                        <div class="social-icon">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section id="menu">
        <div class="container">
            <div class="menubar">
                <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="/">Home</a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="service.html">Service</a></li>
                            <li><a href="project.html">Project</a></li>
                            <li><a href="team.html">Team</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </section>
    <section class="header-slider-area">
        <div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="single-slide-item slide-1">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="single-slide-item-content">
                                        <h2>Get the Perfect Design, <br> Every Time.</h2>
                                        <button type="button" id="getstarted" class="slide-btn">
                                            get started
                                        </button>
                                        <button type="button" class="slide-btn">
                                            explore more
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @yield('content')
    <footer class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <div class="foot-copyright pull-left">
                        <p>
                            &copy; All Rights Reserved.
                        </p>
                    </div>
                </div>
            </div>
            <div id="scroll-Top">
                <i class="fa fa-angle-double-up return-to-top" id="scroll-top" data-toggle="tooltip"
                    data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
            </div>
        </div>
    </footer>

    <!-- jaquery link -->
    <script src="{{url('assets/home/js/jquery.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <!--modernizr.min.js-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js">
    </script>

    <!--bootstrap.min.js-->
    <script type="text/javascript" src="{{url('assets/home/js/bootstrap.min.js')}}"></script>

    <!-- bootsnav js -->
    <script src="{{url('assets/home/js/bootsnav.js')}}"></script>

    <!-- for manu -->
    <script src="{{url('assets/home/js/jquery.hc-sticky.min.js')}}" type="text/javascript"></script>

    <!-- vedio player js -->
    <script src="{{url('assets/home/js/jquery.magnific-popup.min.js')}}"></script>

    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!--owl.carousel.js-->
    <script type="text/javascript" src="{{url('assets/home/js/owl.carousel.min.js')}}"></script>

    <!-- counter js -->
    <script src="{{url('assets/home/js/jquery.counterup.min.js')}}"></script>
    <script src="{{url('assets/home/js/waypoints.min.js')}}"></script>

    <!--Custom JS-->
    <script type="text/javascript" src="{{url('assets/home/js/jak-menusearch.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/home/js/custom.js')}}"></script>
    @stack('scripts')
    <script>
        $(document).ready(function () {
            $('#getstarted').click(function(){
                window.location = "{{route('contestproject')}}";
            });
        });
    </script>

</body>

</html>
