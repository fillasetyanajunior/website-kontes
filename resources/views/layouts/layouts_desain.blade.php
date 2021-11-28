<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Business Card Design Tool">
    <meta name="author" content="Ahmed YILMAZ">
    <title>Business Card Generator</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
        integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous">
    </script>
    <script src="{{url('assets/desaincard/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{url('assets/desaincard/js/fabric.min.js')}}"></script>
    <script src="{{url('assets/desaincard/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/desaincard/js/jquery-ui.min.js')}}"></script>
    <script src="{{url('assets/desaincard/js/FileSaver.min.js')}}"></script>

    <link rel="stylesheet" href="{{url('assets/desaincard/font-awesome/css/font-awesome.min.css')}}">

    <!-- Bootstrap core CSS -->
    <link href="{{url('assets/desaincard/css/bootstrap.min.css')}}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> --}}

    <!-- Custom styles for this template -->
    <link href="{{url('assets/desaincard/css/my_style.css')}}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header" style="height: 70px">
                <a class="navbar-brand" href="#">
                    <img src="{{url('assets/dashboard/images/logo.jpg')}}" alt="" width="190px">
                </a>
            </div>
            {{-- <ul class="nav nav-tabs">
                <li role="presentation" class="dropdown" style="margin-top: 1.5rem">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        Desain <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="active"><a href="{{route('businesscard')}}">Business Card</a></li>
                        <li><a href="{{route('emailsignature')}}">Email Signature</a></li>
                        <li><a href="{{route('letterheads')}}">Letterheads</a></li>
                        <li><a href="{{route('flayer')}}">Flayer</a></li>
                        <li><a href="{{route('invoices')}}">Invoices</a></li>
                        <li><a href="{{route('postcard')}}">Post Card</a></li>
                        <li><a href="{{route('facebookcover')}}">Facebook Cover</a></li>
                        <li><a href="{{route('facebookpost')}}">Facebook Post</a></li>
                        <li><a href="{{route('youtubebenners')}}">Youtube Benners</a></li>
                        <li><a href="{{route('instagrampost')}}">Instagram Post</a></li>
                    </ul>
                </li>
            </ul> --}}
        </div>
    </nav>
    @yield('content')

</body>

</html>
