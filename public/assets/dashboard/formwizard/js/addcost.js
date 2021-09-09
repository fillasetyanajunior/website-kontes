$(document).ready(function () {

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

                    var id_transaksi = orderData.id
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
                    $("#btn-finish").removeClass('disabled');

                    // Or go to another URL:  actions.redirect('thank_you.html');

                });
            },

            onError: function (err) {
                console.log(err, JSON.stringify(err, null, 2));
            }
        }).render('#paypal-button-container');
    }
    $('#projectupgrades').hide()
    var total = 0;
    var selectedpackageprice = 0,projectupgrade = 0,transaction = 0;

    $('#catagories*').click(function () {
        $('#addbisniscard').empty()
        $('#subcata').empty()

        var _id = $(this).val()
        let _token = $('meta[name="csrf-token"]').attr('content');
        var _url = '/getcubcatagories/' + _id

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $.each(hasil.subcatagories,function (index,sub) {
                    $('#subcata').append('<div class="col-6 col-sm-4"> <label class="imagecheck mb-4" ><input type="radio" value="' + sub.id + '" data-harga="'
                    + sub.harga + '" class="imagecheck-input" name="subcatagories" id="subcatagories"><figure class="imagecheck-figure" ><div class="card-body imagecheck-image" ><div class="d-flex flex-row bd-highlight" ><div class="p-2 bd-highlight align-self-center" ><i class="'
                    + sub.icon + '"></i></div> <div class="p-2 bd-highlight align-self-center" ><div class="d-flex flex-column bd-highlight" ><div class="bd-highlight" >' + sub.name + '</div> <div class="bd-highlight" >from $'
                    + sub.harga + '</div> <div class="bd-highlight" >' + sub.description + '</div> </div> </div> </div> </div> </figure> </label> </div>')

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
        var  addpackage = $('input[name="addpackage"]:checked').data('harga')
        $('#selectedpackageprice').empty()
        $('#selectedpackageprice').html('$ ' + addpackage)
        selectedpackageprice = $('#selectedpackageprice').html()
        // addbisniscard = $('#addbisniscard').html()
        projectupgrade = $('#projectupgrade').html()

        if (projectupgrade == '') {
            totals = parseFloat(selectedpackageprice.substring(2, 100));
        } else {
            totals = parseFloat(selectedpackageprice.substring(2, 100)) + parseFloat(projectupgrade.substring(2, 100));
        }

        var discon = (10 / 100) * totals
        $('#transaction').html('$ ' + discon)
        transaction = $('#transaction').html()

        if (projectupgrade == '') {
            total = parseFloat(selectedpackageprice.substring(2, 100)) + parseFloat(transaction.substring(2, 100));
        } else {
            total = parseFloat(selectedpackageprice.substring(2, 100)) + parseFloat(projectupgrade.substring(2, 100)) + parseFloat(transaction.substring(2, 100));
        }
        $('#total').html('$ ' + total)

        $('#projectname').html('')
        $('#desainrequired').html('')
        $('#totalcost').html('')

        $('#projectname').html($('input[name="title"]').val())
        $('#desainrequired').html($('input[name="catagories"]').data('name'))
        $('#totalcost').html($('#total').html())
        $('input[name="totalcost"]').val(total)

        $('#paypal-button-container').empty()
        initPayPalButton(total)
    });

    $("#boxes input[type='checkbox']").click(function () {
        $('#projectupgrades').show()
        var addprojectupgrades = 0
        $("#boxes input[type='checkbox']:checked").each(function () {
            //Update total
            addprojectupgrades += parseFloat($(this).data("harga"), 10);
        });
        //deskripsi
        $('#projectupgrade').html('$ ' + addprojectupgrades)
        selectedpackageprice = $('#selectedpackageprice').html()
        // addbisniscard = $('#addbisniscard').html()
        projectupgrade = $('#projectupgrade').html()

        if (projectupgrade == '') {
            totals = parseFloat(selectedpackageprice.substring(2, 100));
        } else {
            totals = parseFloat(selectedpackageprice.substring(2, 100)) + parseFloat(projectupgrade.substring(2, 100));
        }

        var discon = (10 / 100) * totals
        $('#transaction').html('$ ' + discon)
        transaction = $('#transaction').html()

        total = parseFloat(selectedpackageprice.substring(2, 100)) + parseFloat(projectupgrade.substring(2, 100)) + parseFloat(transaction.substring(2, 100));
        $('#total').html('$ ' + total)

        $('#projectname').html('')
        $('#desainrequired').html('')
        $('#totalcost').html('')

        $('#projectname').html($('input[name="title"]').val())
        $('#desainrequired').html($('input[name="catagories"]').data('name'))
        $('#totalcost').html($('#total').html())
        $('input[name="totalcost"]').val(total)

        $('#paypal-button-container').empty()
        initPayPalButton(total)
    });

    $('#coupon').keyup(function () {
        var _url    = '/discountcode'
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
                var total   = $('#total').html()
                var dic = parseFloat(hasil.discon.potongan) + parseFloat(total.substring(2, 100))
                $('#total').html('$' + dic)
            }
        })
    });

    $('input[name="title"]').on('keyup',function () {
        $('#projectname').html($(this).val())
    })
    $('input[name="budget"]').on('keyup',function () {

        var discon = (15 / 100) * $(this).val()
        $('#transaction').html('$ ' + discon)
        transaction = $('#transaction').html()

        total = parseFloat($(this).val()) + parseFloat(transaction.substring(2, 100));

        $('#total').html('$ ' + total)

        $('#totalcost').html($(this).val())
        $('#paypal-button-container').empty()
        var payment = $(this).val()
        initPayPalButton(payment)
    })
    $('select[name="job_description"]').on('change',function () {
        // console.log($('select[name="job_description"] option:selected').data('name'))
        $('#desainrequired').html($('select[name="job_description"] option:selected').data('name'))
    })
})
