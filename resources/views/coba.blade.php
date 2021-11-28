{{--
@extends('layouts.layouts_dashboard')
@section('content')
<div class="image">
  <img src="http://4.bp.blogspot.com/-zHYH3-VAQz4/VoaAjKwKfdI/AAAAAAAAQwU/g6eE74I7Izk/s1600/Wisata%2BKerinci%2B-%2BGunung%2BKerinci.jpg">
  <img src="https://images.tokopedia.net/img/cache/500-square/VqbcmM/2021/1/3/ea884921-ca49-4ea5-9f80-ede0922c91f6.jpg.webp" style="position: absolute;
  left: 0px;
  top: 0px;">
</div>
@endsection
@php
$newfeed = DB::table('news_feeds')->get();
        foreach ($newfeed as $item) {
            $limit = date('d-m-Y',strtotime('+1 month',strtotime($item->created_at)));
            $datetime = date('d-m-Y');
            echo ($datetime == $limit || $datetime >= $limit) . '<br>';
            // NewsFeed::destroy($item->id);
        }
@endphp
<td width="4" height="4" style="background:url({{url("assets//email/shadow-left-top.png")}}) no-repeat 100% 0;">
    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
</td>
<td colspan="3" rowspan="3" bgcolor="#f0f2ea" style="padding:0 0 30px;">
    <!-- begin content -->
    <img src="{{url('assets/email/bg1.png')}}" width="600" height="400"
        alt="summer‘s coming trimm your sheeps" style="display:block; border:0; margin:0 0 44px; background:#eeeeee;">
    <p
        style="margin:0 30px 33px; text-align:center; text-transform:uppercase; font-size:24px; line-height:30px; font-weight:bold; color:#484a42;">
        Email Choose Winner
    </p>
    <p
        style="margin:0 30px 33px; text-align:left; text-transform:capitalize; font-size:14px; line-height:30px; font-weight:bold; color:#484a42;">

        Anda telah memilih sefes sebagai juara dari contest sef.
        Selamat anda juara dari drgdsefs.
    </p>
    <p
        style="margin:0 30px 25px; text-align:left; text-transform:capitalize; font-size:14px; line-height:30px; color:#484a42;">
        Berikut adalah detail juara dari contest sefsf.
    </p>
    <br>
    <table style="margin:0 30px 33px; width: 90%;margin-bottom: 1rem;color: #212529; border-collapse: collapse;">
        <tbody>
            <tr>
                <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                    <p style="font-size:16px; color:#333333; ">Desain</p>
                </td>
            </tr>
            <tr>
                <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                    <img src="{{asset('storage/resultcontest/163125136270.jpg')}}" alt="" width="300px">
                </td>
            </tr>
            <tr>
                <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                    <p style="font-size:16px; color:#333333; ">Description</p>
                </td>
            </tr>
            <tr>
                <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">

                    <p style="font-size:16px; color:#333333; ">rdgr</p>
                </td>
            </tr>
        </tbody>
    </table>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script
    src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_SANDBOX_CLIENT_ID')}}"> // Required. Replace
    YOUR_CLIENT_ID with your sandbox client ID.
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{url('assets/dashboard/js/require.min.js')}}"></script>
    <script>
        requirejs.config({
            baseUrl: '.'
        });

    </script>
    <!-- Dashboard Core -->
    <link href="{{url('assets/dashboard/css/dashboard.css')}}" rel="stylesheet" />
    <script src="{{url('assets/dashboard/js/dashboard.js')}}"></script>
    <!-- c3.js Charts Plugin -->
    <link href="{{url('assets/dashboard/plugins/charts-c3/plugin.css')}}" rel="stylesheet" />
    <script src="{{url('assets/dashboard/plugins/charts-c3/plugin.js')}}"></script>
    <!-- Google Maps Plugin -->
    <link href="{{url('assets/dashboard/plugins/maps-google/plugin.css')}}" rel="stylesheet" />
    <script src="{{url('assets/dashboard/plugins/maps-google/plugin.js')}}"></script>
    <!-- Input Mask Plugin -->
    <script src="{{url('assets/dashboard/plugins/input-mask/plugin.js')}}"></script>
    <style>
        /**
 *
 * Style.css
 *
 */
        .container {
            padding: 50px 200px;
        }

        .box {
            position: relative;
            background: #ffffff;
            width: 100%;
        }

        .box-header {
            color: #444;
            display: block;
            padding: 10px;
            position: relative;
            border-bottom: 1px solid #f4f4f4;
            margin-bottom: 10px;
        }

        .box-tools {
            position: absolute;
            right: 10px;
            top: 5px;
        }

        .dropzone-wrapper {
            border: 2px dashed #91b0b3;
            color: #92b0b3;
            position: relative;
            height: 150px;
        }

        .dropzone-desc {
            position: absolute;
            margin: 0 auto;
            left: 0;
            right: 0;
            text-align: center;
            width: 40%;
            top: 50px;
            font-size: 16px;
        }

        .dropzone,
        .dropzone:focus {
            position: absolute;
            outline: none !important;
            width: 100%;
            height: 150px;
            cursor: pointer;
            opacity: 0;
        }

        .dropzone-wrapper:hover,
        .dropzone-wrapper.dragover {
            background: #ecf0f5;
        }

        .preview-zone {
            text-align: center;
        }

        .preview-zone .box {
            box-shadow: none;
            border-radius: 0;
            margin-bottom: 0;
        }

    </style>
    <script>
        /**
         *
         * app.js
         *
         */
        $(document).ready(function () {

            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        var htmlPreview =
                            '<img width="200" src="' + e.target.result + '" />' +
                            '<p>' + input.files[0].name + '</p>';
                        var wrapperZone = $(input).parent();
                        var previewZone = $(input).parent().parent().find('.preview-zone');
                        var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

                        wrapperZone.removeClass('dragover');
                        previewZone.removeClass('hidden');
                        boxZone.empty();
                        boxZone.append(htmlPreview);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function reset(e) {
                e.wrap('<form>').closest('form').get(0).reset();
                e.unwrap();
            }
            $(".dropzone").change(function () {
                readFile(this);
            });
            $('.dropzone-wrapper').on('dragover', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).addClass('dragover');
            });
            $('.dropzone-wrapper').on('dragleave', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass('dragover');
            });
            $('.remove-preview').on('click', function () {
                var boxZone = $(this).parents('.preview-zone').find('.box-body');
                var previewZone = $(this).parents('.preview-zone');
                var dropzone = $(this).parents('.form-group').find('.dropzone');
                boxZone.empty();
                previewZone.addClass('hidden');
                reset(dropzone);
            });
        })

    </script>
</head>

<body>

    <div id="paypal-button-container"></div>

    <section>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Upload File</label>
                            <div class="preview-zone hidden">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <div><b>Preview</b></div>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                                                <i class="fa fa-times"></i> Reset This Form
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body"></div>
                                </div>
                            </div>
                            <div class="dropzone-wrapper">
                                <div class="dropzone-desc">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                    <p>Choose an image file or drag it here.</p>
                                </div>
                                <input type="file" name="img_logo" class="dropzone">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">Upload</button>
                    </div>
                </div>
            </div>
        </form>
    </section>


    <script>
    paypal.Buttons().render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.
  </script>
    <script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '0.01'
          }
        }]
      });
    }
  }).render('#paypal-button-container');
</script>
    <script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '0.01'
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction
      return actions.order.capture().then(function(details) {
        alert('Transaction completed by ' + details.payer.name.given_name);
      });
    }
  }).render('#paypal-button-container');
</script>
</body>

</html>
@php
    $earning    = DB::table('workers')
                    ->orderByDesc('earning')
                    ->get();
    $worker     = DB::table('workers')
                    ->get();
    $i = 1;
@endphp
@foreach ($earning as $item)
@foreach ($worker as $itemw)

@if ($item->user_id == $itemw->user_id)
    @php
        DB::table('workers')->where('user_id',$item->user_id)->update(['rangking' => $i]);
        $i++;
    @endphp
@endif
@endforeach

@endforeach
@php
$kirimnotifcomentar  = \App\Models\MessageComentar::where('result_id',1)->distinct()->get('user_id');
@endphp
@for ($i = 0; $i < count($kirimnotifcomentar); $i++)
{{$kirimnotifcomentar[$i]->user_id}}
@endfor
--}}
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

<body style="font-size: 10pt">
    <img src="{{$img}}" alt="">

    <div class="container mt-5">
        <div class="d-flex bd-highlight">
            <div class="w-100 h-100">
                <h6>Brand Guideliness</h6>
                <hr style="margin-top:2rem; border: 1px solid;" width="99%">
            </div>
            <div class="">
                <img src="https://dagodreampark.co.id/media/k2/items/cache/86e8e67edae9219d12d438efd5f5a939_XL.jpg" class="rounded-circle" width="100px" height="100px">
            </div>
        </div>
        <center>
            <img src="http://4.bp.blogspot.com/-zHYH3-VAQz4/VoaAjKwKfdI/AAAAAAAAQwU/g6eE74I7Izk/s1600/Wisata%2BKerinci%2B-%2BGunung%2BKerinci.jpg" alt="" width="300px">
        </center>
        <div class="card mt-5 mb-5">
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        {{-- @php
                        $font = explode('/',$winnercontest->font);
                        @endphp
                        @for ($i = 0; $i < count( $font); $i++) --}}
                        <tr>
                            <td>Font Used</td>
                            <td>Font Used</td>
                            {{-- <td>{{$font[$i]}}</td> --}}
                        </tr>
                        {{-- @endfor --}}
                    </tbody>
                </table>
                <table class="table table-borderless">
                    <tbody>
                        {{-- @php
                        $hexa_color = explode('/',$winnercontest->hexa_color);
                        $rgb_color = explode('/',$winnercontest->rgb_color);
                        $j = 1;
                        @endphp
                        @for ($i = 0; $i < count( $hexa_color); $i++) --}}
                        <tr>
                            <td>
                                <h6>Color Palette </h6>
                                {{-- <h6>Color Palette {{$j++}}</h6> --}}
                            </td>
                        </tr>
                        <tr>
                            <td>Hexa Color Used</td>
                            <td>Hexa Color Used</td>
                            {{-- <td>{{$hexa_color[$i]}}</td> --}}
                            <td rowspan="2">
                                <div style="width:50px;height:50px;background: #FF0000;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>RGB Color Used</td>
                            <td>RGB Color Used</td>
                            {{-- <td>{{$rgb_color[$i]}}</td> --}}
                        </tr>
                        {{-- @endfor --}}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex bd-highlight">
            <div class="w-100 h-100">
                <h1 class="text-white">...</h1>
                <hr style="border: 1px solid;" width="99%">
                <div class="d-flex flex-row mb-3">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <img src="https://dagodreampark.co.id/media/k2/items/cache/86e8e67edae9219d12d438efd5f5a939_XL.jpg" class="rounded-circle" width="75px" height="75px">
                        </div>
                        <div class="ml-4 mt-3">
                            <p>this brand design guideline is held through www.domainkita.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <img src="https://dagodreampark.co.id/media/k2/items/cache/86e8e67edae9219d12d438efd5f5a939_XL.jpg" width="300px" height="150px">
            </div>
        </div>
    </div>
    <footer style="background-color: #FF0000; height:160px;">

    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>

