$(document).ready(function () {
    $('#projectupgrades').hide()
    $('#transaction').html('$ 10')
    var total = 0;
    var selectedpackageprice = 0,addbisniscard = 0,projectupgrade = 0,transaction = 0;

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
                    $('#subcata').append('<div class="col-6 col-sm-4"> <label class="imagecheck mb-4" ><input type="radio" value="' + sub.id + '" data-harga="' + sub.harga + '" class="imagecheck-input" name="subcatagories" id="subcatagories"><figure class="imagecheck-figure" ><div class="card-body imagecheck-image" ><div class="d-flex flex-row bd-highlight" ><div class="p-2 bd-highlight align-self-center" ><i class="' + sub.icon + '"></i></div> <div class="p-2 bd-highlight align-self-center" ><div class="d-flex flex-column bd-highlight" ><div class="bd-highlight" >' + sub.name + '</div> <div class="bd-highlight" >from $' + sub.harga + '</div> <div class="bd-highlight" >' + sub.description + '</div> </div> </div> </div> </div> </figure> </label> </div>')

                    $('#subcata input[name="subcatagories"]*').on('change', function () {
                        var catagories = $('#subcata input[name="subcatagories"]:checked').data('harga')
                        $('#addbisniscard').html('$ ' + catagories)
                    })
                })
            }
        });
    });


    $('#addpackage*').click(function () {
       var  addpackage = $('input[name="addpackage"]:checked').data('harga')
        $('#selectedpackageprice').empty()
        $('#selectedpackageprice').html('$ ' + addpackage)
        selectedpackageprice = $('#selectedpackageprice').html()
        addbisniscard = $('#addbisniscard').html()
        projectupgrade = $('#projectupgrade').html()
        transaction = $('#transaction').html()
        if (projectupgrade == '') {
            total = parseInt(selectedpackageprice.substring(2, 100)) + parseInt(addbisniscard.substring(2, 100)) + parseInt(transaction.substring(2, 100));
        } else {
            total = parseInt(selectedpackageprice.substring(2, 100)) + parseInt(addbisniscard.substring(2, 100)) + parseInt(projectupgrade.substring(2, 100)) + parseInt(transaction.substring(2, 100));
        }
        $('#total').html('$' + total)

        $('#projectname').val('')
        $('#desainrequired').val('')
        $('#totalcost').val('')

        $('#projectname').val($('input[name="title"]').val())
        $('#desainrequired').val($('input[name="catagories"]').data('name'))
        $('#totalcost').val($('#total').html())
        var totalcost = $('#total').html()
        $('input[name="totalcost"]').val(totalcost.substring(1, 100))
    });
    $("#boxes input[type='checkbox']").click(function () {
        $('#projectupgrades').show()
        var addprojectupgrades = 0
        $("#boxes input[type='checkbox']:checked").each(function () {
            //Update total
            addprojectupgrades += parseInt($(this).data("harga"), 10);
        });
        console.log(addprojectupgrades)
        $('#projectupgrade').html('$ ' + addprojectupgrades)
        selectedpackageprice = $('#selectedpackageprice').html()
        addbisniscard = $('#addbisniscard').html()
        projectupgrade = $('#projectupgrade').html()
        transaction = $('#transaction').html()
        total = parseInt(selectedpackageprice.substring(2, 100)) + parseInt(addbisniscard.substring(2, 100)) + parseInt(projectupgrade.substring(2, 100)) + parseInt(transaction.substring(2, 100));
        $('#total').html('$' + total)

        $('#projectname').val('')
        $('#desainrequired').val('')
        $('#totalcost').val('')

        $('#projectname').val($('input[name="title"]').val())
        $('#desainrequired').val($('input[name="catagories"]').data('name'))
        $('#totalcost').val($('#total').html())
        var totalcost = $('#total').html()
        $('input[name="totalcost"]').val(totalcost.substring(1, 100))
    });
    // $('input[type="checkbox"]').click(function () {
    //     if ($('input[type="checkbox"]:checked')) {
    //         addprojectupgrades += $(this).data('harga');
    //     } else {
    //         addprojectupgrades -= $(this).data('harga');
    //     }
    //     $('#projectupgrade').empty()
    //     $('#projectupgrade').html('$ ' + addprojectupgrades)
    //     selectedpackageprice = $('#selectedpackageprice').html()
    //     addbisniscard = $('#addbisniscard').html()
    //     projectupgrade = $('#projectupgrade').html()
    //     transaction = $('#transaction').html()
    //     total = parseInt(selectedpackageprice.substring(2, 100)) + parseInt(addbisniscard.substring(2, 100)) + parseInt(projectupgrade.substring(2, 100)) + parseInt(transaction.substring(2, 100));
    //     $('#total').html('$' + total)
    // });

    $('input[name="title"]').on('keyup',function () {
        $('#projectname').val($(this).val())
    })
    $('input[name="budget"]').on('keyup',function () {
        $('#totalcost').val($(this).val())
    })
    $('select[name="job_description"]').on('change',function () {
        console.log($('select[name="job_description"] option:selected').data('name'))
        $('#desainrequired').val($('select[name="job_description"] option:selected').data('name'))
    })
})
