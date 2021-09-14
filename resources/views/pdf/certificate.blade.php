<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Certificate</title>
</head>

<body>
    <div class="">
        <table class="table table-borderless mb-5">
            <tbody>
                <tr>
                    <td>
                        <h6 class="mb-3">Brand Guideliness</h6>
                        <hr width="99%">
                    </td>
                    <td width="100px">
                        <img src="{{url('storage/logotext/'. $winnercontest->logotext)}}" class="rounded-circle" width="75px" height="75px">
                    </td>
                </tr>
            </tbody>
        </table>
        <center>
            <img src="{{url('storage/logotext/'. $winnercontest->logotext)}}" alt="" width="200px">
        </center>
       <div class="card mt-2">
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        @php
                        $font = DB::table('fonts')->where('contest_id',$winnercontest->contest_id)->get();
                        @endphp
                        <tr>
                            <td>Font Used</td>
                            @foreach ($font as $itemfont)
                            <td>
                                {{$itemfont->name}}
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Hexa Color Used</th>
                            <th scope="col">RGB Color Used</th>
                            <th scope="col">Color</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $color = DB::table('colors')->where('contest_id',$winnercontest->contest_id)->get();
                        $j = 1;
                        @endphp
                        @foreach ($color as $itemcolor)
                        <tr>
                            <td>{{$itemcolor->hexa}}</td>
                            <td>{{$itemcolor->rgb}}</td>
                            <td>
                                <div style="width:40px;height:40px;background:{{$itemcolor->hexa}};"></div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <table class="table table-borderless mb-5">
            <tbody>
                <tr>
                    <td>
                        <h6 class="text-white mb-3">...</h6>
                        <hr width="99%">
                        <table class="table table-borderless mb-5">
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{url('storage/logotext/'. $winnercontest->logotext)}}" class="rounded-circle" width="75px" height="75px">
                                    </td>
                                <td>
                                    <p>this brand design guideline is held through www.domainkita.com</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                    <td width="100px">
                        <img src="{{url('storage/logotext/'. $winnercontest->logotext)}}" class="rounded-circle" width="75px" height="75px">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
