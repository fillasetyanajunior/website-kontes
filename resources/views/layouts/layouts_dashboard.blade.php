<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Homepage - {{env('APP_NAME')}}</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    @livewireStyles
    @livewireScripts
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <!-- Your application script -->
    {{-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="{{url('assets/dashboard/css/fontawesome.css')}}"> --}}
    {{-- <script src="{{url('assets/dashboard/js/jquery3.6.0.js')}}"></script> --}}
    <script src="{{url('assets/dashboard/js/add.js')}}"></script>
    {{-- <link rel="stylesheet" href="{{url('assets/dashboard/css/select.css')}}"> --}}
    {{-- <script src="{{url('assets/dashboard/js/select.js')}}"></script> --}}
    {{-- <script src="{{url('assets/dashboard/js/pusher.js')}}"></script> --}}
    {{-- Paypal --}}
    <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_SANDBOX_CLIENT_ID')}}"></script>
    <!-- Include jQuery Validator plugin -->
    <script src="{{url('assets/dashboard/formwizard/js/addcost.js')}}"></script>
    <style>
        div.image span{
        position: absolute;
        left: 0px;
        top: 0px;
        }
    </style>
    {{-- <script type="text/javascript">
        $(document).ready(function () {

            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                .attr('id', 'btn-finish')
                .addClass('btn btn-info')
                .on('click', function () {

                });
            var btnCancel = $('<button></button>').text('Cancel')
                .addClass('btn btn-danger')
                .on('click', function () {
                    $('#myForm').attr('method', 'get');
                    $('#myForm').attr('action', '/home');
                    $('#smartwizard').smartWizard("reset");
                });



            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'dots',
                transitionEffect: 'fade',
                toolbarSettings: {
                    toolbarPosition: 'bottom',
                    toolbarExtraButtons: [btnFinish, btnCancel]
                },
                anchorSettings: {
                    markDoneStep: true, // add done css
                    markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                    enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                }
            });

            $("#btn-finish").addClass('disabled');
            $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection,
                stepPosition) {
                //alert("You are on step "+stepNumber+" now");
                if (stepPosition == 'first') {
                    $("#prev-btn").addClass('disabled');
                    $("#btn-finish").addClass('disabled');
                } else if (stepPosition == 'final') {
                    $("#next-btn").addClass('disabled');
                } else {
                    $("#prev-btn").removeClass('disabled');
                    $("#next-btn").removeClass('disabled');
                    $("#btn-finish").addClass('disabled');
                }
            });

        });

    </script> --}}
    <script src="{{url('assets/dashboard/js/require.min.js')}}"></script>
    <script>
        requirejs.config({
            baseUrl: '.'
        });
    </script>
    <!-- Dashboard Core -->
    <link href="{{url('assets/dashboard/css/dashboard.css')}}" rel="stylesheet" />
    <script src="{{url('assets/dashboard/js/dashboard.js')}}"></script>
    <link rel="stylesheet" href="{{url('assets/dashboard/formwizard/css/bootstrap.css')}}">
    <script src="{{url('assets/dashboard/formwizard/js/bootstrap.js')}}"></script>
    <!-- c3.js Charts Plugin -->
    <link href="{{url('assets/dashboard/plugins/charts-c3/plugin.css')}}" rel="stylesheet" />
    <script src="{{url('assets/dashboard/plugins/charts-c3/plugin.js')}}"></script>
    <!-- Google Maps Plugin -->
    <link href="{{url('assets/dashboard/plugins/maps-google/plugin.css')}}" rel="stylesheet" />
    <script src="{{url('assets/dashboard/plugins/maps-google/plugin.js')}}"></script>
    <!-- Input Mask Plugin -->
    <script src="{{url('assets/dashboard/plugins/input-mask/plugin.js')}}"></script>

</head>

<body class="">
    <div class="page">
        <div class="page-main">
            @yield('content')
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                        Copyright © <script>
                        document.write(new Date().getFullYear());

                    </script> <a href=".">Tabler</a>. Theme by <a href="https://codecalm.net"
                            target="_blank">codecalm.net</a> All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
