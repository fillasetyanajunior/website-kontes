<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <script
    src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_SANDBOX_CLIENT_ID')}}"> // Required. Replace
    YOUR_CLIENT_ID with your sandbox client ID.
    </script> --}}
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
    {{-- <script>
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

    </script> --}}
</head>

<body>

    {{-- <div id="paypal-button-container"></div> --}}

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


    {{-- <script>
    paypal.Buttons().render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.
  </script> --}}
    {{-- <script>
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
</script> --}}
    {{-- <script>
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
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
        alert('Transaction completed by ' + details.payer.name.given_name);
      });
    }
  }).render('#paypal-button-container');
  //This function displays Smart Payment Buttons on your web page.
</script> --}}
</body>

</html>
{{-- @php
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

@endforeach --}}
{{-- {{Carbon\Carbon::now()->isoformat('YYYY-MM-DD')}} --}}
