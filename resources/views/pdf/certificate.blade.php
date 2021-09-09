<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Certificate</title>
</head>

<body>

    <div class="container">
        <img src="{{url('storage/logotext/'. $winnercontest->logotext)}}" alt="" width="550px">

        <div class="card mt-5">
            <div class="card-body">
                <div class="form-group">
                     @php
                        $font = explode(',',$winnercontest->font);
                    @endphp
                    @for ($i = 0; $i < count( $font); $i++)
                    <label for="font">Font Used</label>
                    <div class="form-control-plaintext">{{$font[$i]}}</div>
                    @endfor
                </div>
                <div class="form-group">
                    @php
                        $hexa_color = explode(',',$winnercontest->hexa_color);
                    @endphp
                    @for ($i = 0; $i < count( $hexa_color); $i++)
                    <label for="hexa_color">Hexa Color Used</label>
                    <div class="form-control-plaintext">{{$hexa_color[$i]}}</div>
                    @endfor
                </div>
                <div class="form-group">
                    @php
                        $rgb_color = explode(',',$winnercontest->rgb_color);
                    @endphp
                    @for ($i = 0; $i < count( $rgb_color); $i++)
                    <label for="rgb_color">RGB Color Used</label>
                    <div class="form-control-plaintext">{{$rgb_color[$i]}}</div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>
