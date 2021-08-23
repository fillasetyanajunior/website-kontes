$(document).ready(function () {
    //Search
    $('#show_fillters').hide();
    $('#button_fillter').click(function () {
        var html = $(this).html();
        if (html == 'Show Fillters') {
            $(this).html('Hide Fillters')
            $('#show_fillters').show();
        } else {
            $('#show_fillters').hide();
            $(this).html('Show Fillters')
        }
    });

    $("#search_text").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#store tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#search_catagories").on("change", function () {
        var value = $(this).val().toLowerCase();
        if (value != '') {
            $("#store tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        } else {
            $("#store tr").not(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }
    });

    $("#search_by").on("change", function () {
        var value = $(this).val();
        if (value == 1) {
            window.location.assign('/browseproject/sort/' + value)
        } else if (value == 2) {
            window.location.assign('/browseproject/sort/' + value)
        } else if (value == 3) {
            window.location.assign('/browseproject/sort/' + value)
        } else if (value == 4) {
            window.location.assign('/browseproject/sort/' + value)
        } else if (value == 5) {
            window.location.assign('/browseproject/sort/' + value)
        }
    });
    $("#search_status").on("change", function () {
        var value = $(this).val();
        if (value == 6) {
            window.location.assign('/browseproject')
        } else {
            window.location.assign('/browseproject/sort/' + value)
        }
    });

    //Contest
    $('#tambahresultcontest').on('click', function () {
        let idcontest = $(this).attr('idcontest');
        $('.footer_resultcontest button[type=submit]').html('Add');
        $('#contestModalLabel').html('Add Contest');
        $('.body_resultcontest form').attr('action', '/resultcontest/store');
        $('.body_resultcontest form').attr('method', 'post');

        $("#title").val("");
        $('#id').val(idcontest)
    });

    $('#feedback*').click(function () {
        var _id = $(this).data('id')
        var _urlasset = $(this).data('url')
        var _url = '/feedback/' + _id
        let _token = $('meta[name="csrf-token"]').attr('content')

        $('.body_feedback form').attr('action', '/feedback/kirim/' + _id);
        $('.body_feedback form').attr('method', 'post');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#feedback_card').empty()
                let url2 = '/feedback/users/' + _id
                $('#hasilcontest').attr('src', _urlasset + '/resultcontest/' + hasil.resultcontest.filecontest)
                $('#profileworker').css('background-image', 'url(' + _urlasset + '/profile/' + hasil.user.avatar + ')')
                $('#name_worker').html(hasil.user.name)
                $('#description').html(hasil.resultcontest.title)

                $.each(hasil.feedback, function (index, feedbackall) {
                    if (feedbackall.feedback_worker == null) {
                        $.ajax({
                            type: 'POST',
                            url: url2,
                            data: {
                                _token: _token,
                                role_user: 'customer',
                            },
                            success: function (hasils) {
                                $('#feedback_card').append('<div class="d-flex align-items-center px-2"> <div class="avatar avatar-md mr-3" style="background-image: url(' + _urlasset + '/profile/' + hasils.user.avatar +
                                    ');"> </div> <div>' + hasils.user.name + '<div> </div> <p>' + feedbackall.feedback_customer + '</p> </div> </div>')
                            }
                        });
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: url2,
                            data: {
                                _token: _token,
                                role_user: 'worker',
                            },
                            success: function (hasils) {
                                $('#feedback_card').append('<div class="d-flex align-items-center px-2"> <div class="avatar avatar-md mr-3" style="background-image: url(' + _urlasset + '/profile/' + hasils.user.avatar +
                                    ');"> </div> <div>' + hasils.user.name + '<div> </div> <p>' + feedbackall.feedback_worker + '</p> </div> </div>')
                            }
                        });
                    }
                })
            }
        });
    });

    $('#nilaicontest*').click(function () {
        var _id = $(this).data('id')
        var _nilai = $(this).data('nilai')
        var _url = '/feedback/show/nilaicontest/' + _id
        let _token = $('meta[name="csrf-token"]').attr('content')

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
                nilai: _nilai
            },
            success: function (hasil) {
                console.log(hasil.nilai)
                if (hasil.status == 200) {
                    location.reload()
                }
            }
        });
    });

    //Direct
    $('#tambahresultdirect').on('click', function () {
        let idcontest = $(this).attr('idcontest');
        $('.footer_resultdirect button[type=submit]').html('Add');
        $('#directModalLabel').html('Add Contest');
        $('.body_resultdirect form').attr('action', '/resultdirect/store');
        $('.body_resultdirect form').attr('method', 'post');

        $("#title").val("");
        $('#id').val(idcontest)
    });

    $('#feedbackbid*').click(function () {
        var _id = $(this).data('id')
        var _urlasset = $(this).data('url')
        var _url = '/feedbackbid/' + _id
        let _token = $('meta[name="csrf-token"]').attr('content')

        $('.body_feedback form').attr('action', '/feedbackbid/kirim/' + _id);
        $('.body_feedback form').attr('method', 'post');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#feedback_card').empty()
                let url2 = '/feedbackbid/users/' + _id
                $('#profileworker').css('background-image', 'url(' + _urlasset + '/profile/' + hasil.user.avatar + ')')
                $('#name_worker').html(hasil.user.name)
                $('#descriptions').text(hasil.resultproject.description)

                $.each(hasil.feedback, function (index, feedbackall) {
                    if (feedbackall.feedback_worker == null) {
                        $.ajax({
                            type: 'POST',
                            url: url2,
                            data: {
                                _token: _token,
                                role_user: 'customer',
                            },
                            success: function (hasils) {
                                $('#feedback_card').append('<div class="d-flex align-items-center px-2"> <div class="avatar avatar-md mr-3" style="background-image: url(' + _urlasset + '/profile/' + hasils.user.avatar +
                                    ');"> </div> <div>' + hasils.user.name + '<div> </div> <p>' + feedbackall.feedback_customer + '</p> </div> </div>')
                            }
                        });
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: url2,
                            data: {
                                _token: _token,
                                role_user: 'worker',
                            },
                            success: function (hasils) {
                                $('#feedback_card').append('<div class="d-flex align-items-center px-2"> <div class="avatar avatar-md mr-3" style="background-image: url(' + _urlasset + '/profile/' + hasils.user.avatar +
                                    ');"> </div> <div>' + hasils.user.name + '<div> </div> <p>' + feedbackall.feedback_worker + '</p> </div> </div>')
                            }
                        });
                    }
                })
            }
        });
    });

    $('#nilaidirect*').click(function () {
        var _id = $(this).data('id')
        var _nilai = $(this).data('nilai')
        var _url = '/feedbackbid/show/nilaicontest/' + _id
        let _token = $('meta[name="csrf-token"]').attr('content')

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
                nilai: _nilai
            },
            success: function (hasil) {
                if (hasil.status == 200) {
                    location.reload()
                }
            }
        });
    });

    //FileUpload
    $('#uploadfile').click(function () {
        $('.footer-fileupload button[type=submit]').html('Upload');
        $('#UploadFilesLabel').html('Upload File');
        $('.body-fileupload form').attr('action', '/fileupload/store');
        $('.body-fileupload form').attr('method', 'post');
    });

    $('#uploadfilelogotext').click(function () {
        var _id = $(this).data('id')
        $('.footer-fileupload button[type=submit]').html('Upload');
        $('#UploadFilesLabel').html('Upload Logo Text File');
        $('.body-fileupload form').attr('action', '/fileupload/store/logotext/' + _id);
        $('.body-fileupload form').attr('method', 'post');
    });

    $('#uploadfilelogo').click(function () {
        var _id = $(this).data('id')
        $('.footer-fileupload button[type=submit]').html('Upload');
        $('#UploadFilesLabel').html('Upload Logo File');
        $('.body-fileupload form').attr('action', '/fileupload/store/logo/' + _id);
        $('.body-fileupload form').attr('method', 'post');
    });

    //Browse
    $('#browsetable*').click(function () {
        var url = $(this).data('url');
        window.location.assign(url)
    })

    //Button Reverse
    $('#buttonlogotext').click(function () {
        var url = $(this).data('url')
        window.open(url,'_blank')
    })
    $('#buttonlogo').click(function () {
        var url = $(this).data('url')
        window.open(url,'_blank')
    })

    //worker
    $('#editworker*').on('click', function () {
        $('.footer_worker button[type=submit]').html('Edit');
        $('#WorkerManagementLabel*').html('Edit Suspend');
        const id = $(this).data('id');
        $('.body_worker form').attr('action', '/managementworker/suspendaccount/' + id);
    });

    //catagories
    $('#addcatagories').on('click', function () {
        $('.footer_catagories button[type=submit]').html('Add');
        $('#CatagoriesModalLabel').html('Add Catagories');
        $('.body_catagories form').attr('action', '/managementwebsite/catagories/create');
        $('.body_catagories form').attr('method', 'post');

        $('#name').val('')
        $('#harga').attr('disabled', false).val('')
        $("#icon").attr('disabled', false).val('')
        $('#pilihaninput').attr('disabled', false).val('')
    });
    $('#editcatagories*').on('click', function () {
        $('.footer_catagories button[type=submit]').html('Add');
        $('#CatagoriesModalLabel').html('Edit Catagories');
        $('.body_catagories form').attr('action', '/managementwebsite/catagories/update');
        $('.body_catagories form').attr('method', 'post');

        $("#icon").attr('disabled', false)
        $('#harga').attr('disabled', false)
        $('#pilihaninput').attr('disabled', false)

        var _id = $(this).data('id');

        let _url = '/managementwebsite/catagories/edit';
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
                id: _id,
                pilihaninput: 'catagories'
            },
            success: function (hasil) {
                $('#name').val(hasil.catagories.name)
                $('#harga').val(hasil.catagories.harga)
                $("#icon option[value='" + hasil.catagories.icon + "']").attr('selected', true);
                $('#pilihaninput').attr('disabled',true)
            }
        });
    });
    $('#editsortcatagories*').on('click', function () {
        $('.footer_catagories button[type=submit]').html('Add');
        $('#CatagoriesModalLabel').html('Edit Catagories');
        $('.body_catagories form').attr('action', '/managementwebsite/catagories/update');
        $('.body_catagories form').attr('method', 'post');

        var _id = $(this).data('id');

        let _url = '/managementwebsite/catagories/edit';
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
                id: _id,
                pilihaninput: 'sort catagories'
            },
            success: function (hasil) {
                $('#pilihaninput').attr('disabled', true).val('')
                $('#harga').attr('disabled', true).val('')
                $("#icon").attr('disabled', true).val('')
                $('#name').val(hasil.catagories.name)
            }
        });
    });

    $('#addsubcatagories').on('click', function () {
        $('.footer_sub_catagories button[type=submit]').html('Add');
        $('#SubCatagoriesModalLabel').html('Add Sub Catagories');
        $('.body_sub_catagories form').attr('action', '/managementwebsite/subcatagories/create');
        $('.body_sub_catagories form').attr('method', 'post');

        $('#namesub').val('')
        $('#description').val('')
        $('#hargasub').val('')
        $("#iconsub").val('')
        $("#catagories ").val('')
    });
    $('#editsubcatagories*').on('click', function () {
        var _id = $(this).data('id');
        $('.footer_sub_catagories button[type=submit]').html('Add');
        $('#SubCatagoriesModalLabel').html('Add Sub Catagories');
        $('.body_sub_catagories form').attr('action', '/managementwebsite/subcatagories/update/' + _id);
        $('.body_sub_catagories form').attr('method', 'post');

        let _url = '/managementwebsite/subcatagories/edit/' + _id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
            },
            success: function (hasil) {
                $('#namesub').val(hasil.subcatagories.name)
                $('#description').val(hasil.subcatagories.description)
                $('#hargasub').val(hasil.subcatagories.harga)
                $("#iconsub option[value='" + hasil.subcatagories.icon + "']").attr('selected', true);
                $("#catagories option[value='" + hasil.subcatagories.catagori_id + "']").attr('selected', true);
            }
        });
    });

    $('#sub_catagories_table').hide()
    $('#sort_catagories_table').hide()
    $('#pilihantable').change(function () {
        if ($(this).val() == 1) {
            $('#catagories_table').show()
            $('#sub_catagories_table').hide()
            $('#sort_catagories_table').hide()
        }else if ($(this).val() == 2) {
            $('#catagories_table').hide()
            $('#sub_catagories_table').hide()
            $('#sort_catagories_table').show()
        } else {
           $('#catagories_table').hide()
           $('#sub_catagories_table').show()
           $('#sort_catagories_table').hide()
        }

    });

    //Opsi
    $('#opsitambahan').hide()
    $('#paketopsicontest').change(function () {
        if ($(this).val() == 1) {
            $('#opsiutama').show()
            $('#opsitambahan').hide()
        } else {
            $('#opsiutama').hide()
            $('#opsitambahan').show()
        }

    });

    $('#opsicontest').on('click', function () {
        $('.footer_opsi button[type=submit]').html('Add');
        $('#OpsiModalLabel').html('Tambah Opsi Conntest');
        $('.body_opsi form').attr('action', '/managementwebsite/opsicontest/create');
        $('.body_opsi form').attr('method', 'post');

        $('#name').val("")
        $('#description').val("")
        $('#harga').val("")
        $("#iconopsi").val("")
        $("#hari").val("")
        $("#pilihaninput").attr('disabled', false).val("")
    });

    $('#editopsicontest*').on('click', function () {
        $('.footer_opsi* button[type=submit]').html('Edit');
        $('#OpsiModalLabel*').html('Edit Opsi Conntest');
        $('.body_opsi form*').attr('action', '/managementwebsite/opsicontest/update');
        $('.body_opsi form*').attr('method', 'post');

        $('#hari').attr('disabled', true).val("")

        const id = $(this).data('id');

        let _url = '/managementwebsite/opsicontest/edit';
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
                pilihaninput: 'opsi utama',
                id: id,
            },
            success: function (hasil) {
                $('#name').val(hasil.opsi.name)
                $('#description').val(hasil.opsi.description)
                $('#harga').val(hasil.opsi.harga)
                $("#pilihaninput").attr('disabled',true)
                $("#iconopsi option[value='" + hasil.opsi.icon + "']").attr('selected', true);
            }
        });
    });

    $('#editopsiupgradecontest*').on('click', function () {
        $('.footer_opsi* button[type=submit]').html('Edit');
        $('#OpsiModalLabel*').html('Edit Opsi Conntest');
        $('.body_opsi form*').attr('action', '/managementwebsite/opsicontest/update');
        $('.body_opsi form*').attr('method', 'post');

        const id = $(this).data('id');

        let _url = '/managementwebsite/opsicontest/edit';
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
                pilihaninput: 'opsi upgrade',
                id: id,
            },
            success: function (hasil) {
                console.log(hasil.opsi)
                $('#name').val(hasil.opsi.name)
                $('#description').val(hasil.opsi.description)
                $('#harga').val(hasil.opsi.harga)
                $('#hari').val(hasil.opsi.hari).attr('disabled', false)
                $("#iconopsi option[value='" + hasil.opsi.icon + "']").attr('selected', true);
                $("#pilihaninput").attr('disabled',true)
            }
        });
    });

    //Job
    $('#addjobdescription').on('click', function () {
        $('.footer_jobdescription button[type=submit]').html('Add');
        $('#JobModalLabel').html('Tambah Job');
        $('.body_jobdescription form').attr('action', '/managementwebsite/jobdescription/create');
        $('.body_jobdescription form').attr('method', 'post');

        $('#name').val("")
    });

    $('#editjobdescription*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_jobdescription* button[type=submit]').html('Edit');
        $('#JobModalLabel*').html('Edit Job');
        $('.body_jobdescription form*').attr('action', '/managementwebsite/jobdescription/update/' + id);
        $('.body_jobdescription form*').attr('method', 'post');


        let _url = '/managementwebsite/jobdescription/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#name').val(hasil.jobcatagories.name)
            }
        });
    });

    $('#viewaccount*').click(function () {
        var id = $(this).data('id')
        var _asset = $(this).data('url')
        let _url = '/managementworker/viewaccount/' + id

        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data:{
                _token: _token,
            },
            success: function (hasil) {
                if (hasil.worker.avatar != 'default.jpg') {
                    $('#workerprofile').attr('src', _asset + '/profile/' + hasil.worker.avatar)
                } else {
                    $('#workerprofile').attr('src', '/assets/dashboard/images/default.jpg')
                }
                $('#rangking').html('#' + hasil.worker.id)
                $('#location').html(hasil.worker.location)
                $('#rating').empty()
                if (hasil.rating > 20) {
                    $('#rating').append(
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>'+
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>'+
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>'+
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>'+
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>')
                } else if(hasil.rating > 40) {
                    $('#rating').append(
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>'+
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"> </i></a>' +
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>'+
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>'+
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>')
                }else if (hasil.rating > 60) {
                    $('#rating').append(
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>'+
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"> </i></a>' +
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"> </i></a>' +
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>'+
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>')
                }else if (hasil.rating > 80) {
                    $('#rating').append(
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>'+
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"> </i></a>' +
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"> </i></a>' +
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"> </i></a>' +
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>')
                }else if (hasil.rating > 100) {
                    $('#rating').append(
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>'+
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"> </i></a>' +
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"> </i></a>' +
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"> </i></a>' +
                    '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"> </i></a>')
                }else{
                    $('#rating').append(
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>' +
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>' +
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>' +
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>' +
                    '<a href="javascript:void(0)"><i class="fa fa-star-o"> </i></a>')
                }

                let _url2 = '/managementworker/viewproject/'

                $.each(hasil.project,function (index,project) {
                    $.ajax({
                        type: 'POST',
                        url: _url2 + project.id,
                        data: {
                            _token: _token,
                            user_id: hasil.worker.user_id,
                        },
                        success: function (hasils) {
                            $('#portfolio').empty()
                            $('#earnings').html('$' + (hasils.earning / 1000).toFixed(0))
                            $.each(hasils.resultproject,function (index,resultproject) {
                                $('#portfolio').append(
                                    '<div class="col-sm-6 col-lg-2">'+
                                        '<div class="card p-3" >'+
                                            '<a href="javascript:void(0)" >'+
                                                '<img src="' + _asset + '/result' + project.catagories_project + '/' + resultproject.filecontest + '" class="rounded" style="width: 300px; height: 300px; overflow: hidden width: 100%;" >'+
                                            '</a>'+
                                            '<div class="d-flex align-items-center px-2 mt-5">' +
                                                '<div id="ratingcontest">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'
                                )
                                if (resultproject.nilai == 1) {
                                    $('#ratingcontest').append(
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>'
                                    )
                                } else if(resultproject.nilai == 2) {
                                    $('#ratingcontest').append(
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>'
                                    )
                                } else if(resultproject.nilai == 3) {
                                    $('#ratingcontest').append(
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>'
                                    )
                                } else if(resultproject.nilai == 4) {
                                    $('#ratingcontest').append(
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>'
                                    )
                                } else if(resultproject.nilai == 5) {
                                    $('#ratingcontest').append(
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a>'
                                        )
                                }else{
                                    $('#ratingcontest').append(
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>' +
                                        '<a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>'
                                    )
                                }
                            })
                        }
                    });
                })
            }
        });
    });

    $('#submitpembayaran*').click(function () {
        let id = $(this).data('id');
        $('.footer_pembayaran button[type=submit]').html('Add');W
        $('#PembayaranModalLabel').html('Add Konfirmasi');
        $('.body_pembayaran form').attr('action', '/projectstatus/paymentsubmit/' + id);
        $('.body_pembayaran form').attr('method', 'post');
    });

    $('#title_winner').prop('disabled',true);
    $('#name_winner').prop('disabled', true);
    $('#id_worker_winner').prop('disabled', true);
    $('#customer_id').prop('disabled', true);
    $('#worker_id').prop('disabled',true);
    $('#expire_account').prop('disabled', true);
    $('#status_account').prop('disabled', true);

});
