$(document).ready(function () {

    $(".btn-submit").attr('disabled',true);
    function initPayPalButton(payments) {
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'gold',
                layout: 'vertical',
                label: 'paypal',

            },

            createOrder: function (data, actions) {
                return actions.order.create({
                        purchase_units: [{
                            "amount": {
                            "currency_code": "USD",
                            "value": payments,
                        }
                    }]
                });
            },

            onApprove: function (data, actions) {
                return actions.order.capture().then(function (orderData) {

                    // Full available details
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                    var id_transaksi = orderData.purchase_units['0'].payments.captures['0'].id
                    var email_transaksi = orderData.payer.email_address
                    var name_transaksi = orderData.payer.name.given_name + orderData.payer.name.surname


                    $('input[name="id_transaksi"]').val(id_transaksi)
                    $('input[name="email_transaksi"]').val(email_transaksi)
                    $('input[name="name_transaksi"]').val(name_transaksi)
                    // console.log(id_transaksi + email_transaksi + payer_id_transaksi + name_transaksi)
                    // Show a success message within this page, e.g.
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    $(".btn-submit").attr('disabled',false);

                    // Or go to another URL:  actions.redirect('thank_you.html');

                });
            },

            onError: function (err) {
                console.log(err, JSON.stringify(err, null, 2));
            }
        }).render('#paypal-button-container');
    }
    $('#projectupgrades').hide()
    $('#codediscount').hide()
    $('#fileperjanjians').hide()

    $('#catagories*').click(function () {
        $('#addbisniscard').empty()
        $('#subcata').empty()

        var _id         = $(this).val()
        var _asseturl   = $(this).data('url')
        let _token      = $('meta[name="csrf-token"]').attr('content');
        var _url        = '/getcubcatagories/' + _id

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $.each(hasil.subcatagories,function (index,sub) {
                    $('#subcata').append('<div class="col-6 col-sm-4"> <label class="imagecheck mb-4" ><input type="radio" value="' + sub.id + '" data-harga="'
                    + sub.harga + '" class="imagecheck-input" name="subcatagories" id="subcatagories"><figure class="imagecheck-figure" ><div class="card-body imagecheck-image" ><div class="d-flex flex-row bd-highlight" ><div class="p-2 bd-highlight align-self-center" ><img src="'
                    + _asseturl + sub.icon + '" width="100px"></img></div> <div class="p-2 bd-highlight align-self-center" ><div class="d-flex flex-column bd-highlight" ><div class="bd-highlight" >' + sub.name + '</div> <div class="bd-highlight" >from $'
                    +sub.harga + '</div> <div class="bd-highlight" ></div></div></div></div><p class="text-justify">' + sub.description + '</p></div> </figure> </label> </div>')

                    // $('#subcata input[name="subcatagories"]*').on('change', function () {
                    //     var catagories = $('#subcata input[name="subcatagories"]:checked').data('harga')
                    //     $('#addbisniscard').html('$ ' + catagories)
                    // })
                })
            }
        });
    });


    $('#addpackage*').click(function () {
        //deskripsi
        var  addpackage = $('input[name="addpackage"]:checked').data('harga');
        $('#selectedpackageprice').empty();
        $('#selectedpackageprice').html('$ ' + addpackage);
        // addbisniscard = $('#addbisniscard').html()
        var projectupgrade = $('#projectupgrade').html();
        var discountcode = $('#discount').html();
        var _url = '/getdatatotalcostpack';
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
                projectupgrades: projectupgrade.substring(2.100),
                selectedpackageprices: addpackage,
                discountcodes: discountcode.substring(2.100),
            },
            success: function (hasil){
                if ($('#coupon').val() == '') {
                    $('#codediscount').hide()
                    $('#discount').html('')
                }
                $('#projectupgrade').html('$ ' + hasil.projectupgrade)
                $('#transaction').html('$ ' + hasil.fee)
                $('#subtotal').html('$ ' + hasil.subtotalcost)
                $('#total').html('$ ' + hasil.totalcost)

                $('#projectname').html('')
                $('#desainrequired').html('')
                $('#totalcost').html('')

                $('#projectname').html($('input[name="title"]').val())
                $('#desainrequired').html($('input[name="catagories"]').data('name'))
                $('#totalcost').html($('#total').html())
                $('input[name="totalcost"]').val(hasil.totalcost)

                $('#paypal-button-container').empty()
                initPayPalButton(hasil.totalcost)
            }
        })

        // if (projectupgrade == '') {
        //     totals = parseFloat(selectedpackageprice.substring(2, 100));
        // } else {
        //     totals = parseFloat(selectedpackageprice.substring(2, 100)) + parseFloat(projectupgrade.substring(2, 100));
        // }

        // if ($('#coupon').val() == '') {
        //     $('#codediscount').hide()
        //     $('#discount').html('')
        // }

        // if ($('#discount').html() != 'Free Fee') {
        //     var fee = (15 / 100) * totals
        //     $('#transaction').html('$ ' + fee)
        // }
        // transaction = $('#transaction').html()

        // if (projectupgrade == '') {
        //     total = parseFloat(selectedpackageprice.substring(2, 100)) + parseFloat(transaction.substring(2, 100));
        // } else {
        //     total = parseFloat(selectedpackageprice.substring(2, 100)) + parseFloat(projectupgrade.substring(2, 100)) + parseFloat(transaction.substring(2, 100));
        // }

        // $('#subtotal').html('$ ' + total)

        // if ($('#discount').html() == '') {
        //     $('#total').html('$ ' + total)
        // } else {
        //     var subtotal = $('#discount').html()
        //     var payments = total - subtotal.substring(2, 100)
        //     $('#total').html('$ ' + payments)
        // }

        // $('#projectname').html('')
        // $('#desainrequired').html('')
        // $('#totalcost').html('')

        // $('#projectname').html($('input[name="title"]').val())
        // $('#desainrequired').html($('input[name="catagories"]').data('name'))
        // $('#totalcost').html($('#total').html())

        // var payment = $('#total').html()
        // $('input[name="totalcost"]').val(payment.substring(2, 100))

        // $('#paypal-button-container').empty()
        // initPayPalButton(payment.substring(2, 100))
    });

    $("#boxes input[type='checkbox']").click(function () {
        $('#projectupgrades').show();
        var addprojectupgrades = null;
        var hariurgent = $('#dayUrgent input').val();
        var hariextended = $('#dayExtended input').val();
        var selectedpackageprice = $('#selectedpackageprice').html();
        var discountcode = $('#discount').html();
        var _url = '/getdatatotalcostupgrade';
        let _token = $('meta[name="csrf-token"]').attr('content');

        $("#boxes input[type='checkbox']:checked").each(function () {
            //Update total
            if (addprojectupgrades == null) {
                addprojectupgrades = $(this).val();
            } else {
                addprojectupgrades = addprojectupgrades + '/' + $(this).val();
            }

            // if ($('#addprojectupgrades[data-names="Urgent"]').is(':checked')) {
            //     if (hariurgent == null) {
            //         var totalhargaurgent = parseFloat($('#addprojectupgrades[data-names="Urgent"]').data('harga')) * 1;
            //     } else {
            //         var totalhargaurgent = parseFloat($('#addprojectupgrades[data-names="Urgent"]').data('harga')) * hariurgent;
            //     }
            //     addprojectupgrades += totalhargaurgent;
            // } else if ($(this).data('names') == 'Extended') {
            //     if (hariextended == null) {
            //         var totalhargaextended = parseFloat($(this).data('harga')) * 1;
            //     } else {
            //         var totalhargaextended = parseFloat($(this).data('harga')) * hariextended;
            //     }
            //     addprojectupgrades += totalhargaextended;
            // }else{
            //     addprojectupgrades += parseFloat($(this).data("harga"), 10);
            // }

        });

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
                addupgrade: addprojectupgrades,
                selectedpackageprices: selectedpackageprice.substring(2, 100),
                hariurgents: hariurgent,
                hariextendeds: hariextended,
                discountcodes: discountcode.substring(2.100),
            },
            success: function (hasil) {
                if ($('#coupon').val() == '') {
                    $('#codediscount').hide()
                    $('#discount').html('')
                }
                $('#projectupgrade').html('$ ' + hasil.projectupgrade)
                $('#transaction').html('$ ' + hasil.fee)
                $('#subtotal').html('$ ' + hasil.subtotalcost)
                $('#total').html('$ ' + hasil.totalcost)

                $('#projectname').html('')
                $('#desainrequired').html('')
                $('#totalcost').html('')

                $('#projectname').html($('input[name="title"]').val())
                $('#desainrequired').html($('input[name="catagories"]').data('name'))
                $('#totalcost').html($('#total').html())
                $('input[name="totalcost"]').val(hasil.totalcost)

                $('#paypal-button-container').empty()
                initPayPalButton(hasil.totalcost)
            }
        })

        // //deskripsi
        // $('#projectupgrade').html('$ ' + addprojectupgrades)
        // selectedpackageprice = $('#selectedpackageprice').html()
        // // addbisniscard = $('#addbisniscard').html()
        // projectupgrade = $('#projectupgrade').html()

        // if (projectupgrade == '') {
        //     totals = parseFloat(selectedpackageprice.substring(2, 100));
        // } else {
        //     totals = parseFloat(selectedpackageprice.substring(2, 100)) + parseFloat(projectupgrade.substring(2, 100));
        // }


        // if ($('#discount').html() != 'Free Fee') {
        //     var fee = (15 / 100) * totals
        //     $('#transaction').html('$ ' + fee)
        // }
        // transaction = $('#transaction').html()

        // total = parseFloat(selectedpackageprice.substring(2, 100)) + parseFloat(projectupgrade.substring(2, 100)) + parseFloat(transaction.substring(2, 100));
        // $('#subtotal').html('$ ' + total)

        // if ($('#discount').html() == '') {
        //     $('#total').html('$ ' + total)
        // }else{
        //     var subtotal = $('#discount').html()
        //     var payments = total - subtotal.substring(2, 100)
        //     $('#total').html('$ ' + payments)
        // }


    });

    $('#addprojectupgrades[data-names="Non Disclosure Agreement (NDA)"]').click(function () {
        if ($(this).is(':checked')) {
            $('#fileperjanjians').show()
        } else {
            $('#fileperjanjians').hide()
        }
    })

    $('#coupon').keyup(function () {

        if ($(this).val() == '') {
            $('#codediscount').hide()
            $('#discount').html('')
        }else{
            $('#codediscount').show()
        }
        var _url    = '/code/getdata'
        let _token  = $('meta[name="csrf-token"]').attr('content')
        var codes   = $(this).val()

        $.ajax({
            type: 'POST',
            url: _url,
            data:{
                _token: _token,
                code: codes
            },
            success: function (hasil) {
                var addpackage = $('#selectedpackageprice').html();
                var projectupgrade = $('#projectupgrade').html();
                var _url2 = '/getdatatotalcostpack';
                var _url3 = '/getdatatotalcostfreefee';

                if (hasil.discount.choices == '$10') {
                    $('#discount').html('$ 10')

                    var discountcode = $('#discount').html();
                    $.ajax({
                        type: 'POST',
                        url: _url2,
                        data: {
                            _token: _token,
                            projectupgrades: projectupgrade.substring(2.100),
                            selectedpackageprices: addpackage.substring(2,100),
                            discountcodes: discountcode.substring(2.100),
                        },
                        success: function (hasil) {
                            if ($('#coupon').val() == '') {
                                $('#codediscount').hide()
                                $('#discount').html('')
                            }
                            $('#subtotal').html('$ ' + hasil.subtotalcost)
                            $('#total').html('$ ' + hasil.totalcost)

                            $('#totalcost').html($('#total').html())
                            $('input[name="totalcost"]').val(hasil.totalcost)

                            $('#paypal-button-container').empty()
                            initPayPalButton(hasil.totalcost)
                        }
                    })
                } else if (hasil.discount.choices == '$20') {
                    $('#discount').html('$ 20')

                    var discountcode = $('#discount').html();

                    $.ajax({
                        type: 'POST',
                        url: _url2,
                        data: {
                            _token: _token,
                            projectupgrades: projectupgrade.substring(2.100),
                            selectedpackageprices: addpackage.substring(2,100),
                            discountcodes: discountcode.substring(2.100),
                        },
                        success: function (hasil) {
                            if ($('#coupon').val() == '') {
                                $('#codediscount').hide()
                                $('#discount').html('')
                            }
                            $('#subtotal').html('$ ' + hasil.subtotalcost)
                            $('#total').html('$ ' + hasil.totalcost)

                            $('#totalcost').html($('#total').html())
                            $('input[name="totalcost"]').val(hasil.totalcost)

                            $('#paypal-button-container').empty()
                            initPayPalButton(hasil.totalcost)
                        }
                    })
                } else if (hasil.discount.choices == '$50') {
                    $('#discount').html('$ 50')

                    var discountcode = $('#discount').html();

                    $.ajax({
                        type: 'POST',
                        url: _url2,
                        data: {
                            _token: _token,
                            projectupgrades: projectupgrade.substring(2.100),
                            selectedpackageprices: addpackage.substring(2,100),
                            discountcodes: discountcode.substring(2.100),
                        },
                        success: function (hasil) {
                            if ($('#coupon').val() == '') {
                                $('#codediscount').hide()
                                $('#discount').html('')
                            }
                            $('#subtotal').html('$ ' + hasil.subtotalcost);
                            $('#total').html('$ ' + hasil.totalcost);
                            $('#totalcost').html($('#total').html());
                            $('input[name="totalcost"]').val(hasil.totalcost);

                            $('#paypal-button-container').empty();
                            initPayPalButton(hasil.totalcost);
                        }
                    })
                }else {

                    $('#discount').html('Free Fee');
                    $('#transaction').html('$ 0');

                    $.ajax({
                        type: 'POST',
                        url: _url3,
                        data: {
                            _token: _token,
                            projectupgrades: projectupgrade.substring(2.100),
                            selectedpackageprices: addpackage.substring(2,100),
                            discountcodes: discountcode.substring(2.100),
                        },
                        success: function (hasil) {
                            if ($('#coupon').val() == '') {
                                $('#codediscount').hide()
                                $('#discount').html('')
                            }
                            $('#projectupgrade').html('$ ' + hasil.projectupgrade)
                            $('#subtotal').html('$ ' + hasil.subtotalcost)
                            $('#total').html('$ ' + hasil.totalcost)

                            $('#totalcost').html($('#total').html())
                            $('input[name="totalcost"]').val(hasil.totalcost)

                            $('#paypal-button-container').empty()
                            initPayPalButton(hasil.totalcost)
                        }
                    })
                }
            }
        })
    });

    $('input[name="title"]').on('keyup',function () {
        $('#projectname').html($(this).val())
    })
    $('input[name="budget"]').on('keyup',function () {

        var discon = (15 / 100) * $(this).val();
        $('#transaction').html('$ ' + discon);
        transaction = $('#transaction').html();

        total = parseFloat($(this).val()) + parseFloat(transaction.substring(2, 100));

        $('#budget').html('$ ' + $(this).val());
        $('#total').html('$ ' + total);

        $('input[name="totalcost"]').val(total);
        $('#totalcost').html('$ ' + total);
        $('#paypal-button-container').empty();
        console.log(total)

        initPayPalButton(total);
    })
    $('select[name="job_description"]').on('change',function () {
        // console.log($('select[name="job_description"] option:selected').data('name'))
        $('#desainrequired').html($('select[name="job_description"] option:selected').data('name'))
    })
})
