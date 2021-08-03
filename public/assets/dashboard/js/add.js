$(document).ready(function () {
    $('#editworker*').on('click', function () {
        $('.footer_worker* button[type=submit]').html('Edit');
        $('#ModalWorkerLabel*').html('Edit Worker');
        const id = $(this).data('id');
        $('.body_worker form*').attr('action', '/managementworkers/update/' + id);
        $('.body_worker form*').attr('method', 'post');

        let _url = '/managementworkers/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {

                $('#name').val(hasil.response2.name)
                if (hasil.response.status_account == 'unverified') {
                   $("#status_account option[value='" + 1 + "']").attr('selected', true);
                } else {
                    $("#status_account option[value='" + 2 + "']").attr('selected', true);
                }
                if (hasil.response.expired != null) {
                    if (hasil.response.expired == 1) {
                       $("#expired_account option[value='" + 1 + "']").attr('selected', true);
                    } else {
                        $("#expired_account option[value='" + 2 + "']").attr('selected', true);
                    }
                }
            }
        });
    });

    $('#tambahcontestproject').on('click', function () {
        $('.footer_project button[type=submit]').html('Add');
        $('#projectModalLabel').html('Add Contest Project');
        $('.body_project form').attr('action', '/project/store');
        $('.body_project form').attr('method', 'post');
        $('input[name=catagories_project]').val('contest')
    });

    $('#tambahdirectproject').on('click', function () {
        $('.footer_project button[type=submit]').html('Add');
        $('#projectModalLabel').html('Add Direct Project');
        $('.body_project form').attr('action', '/project/store');
        $('.body_project form').attr('method', 'post');
        $('input[name=catagories_project]').val('direct')
    });
    $('#editdirectproject*').on('click', function () {
        $('.footer_contest* button[type=submit]').html('Edit');
        $('#projectContestModalLabel*').html('Edit Contest');
        const id = $(this).data('id');
        $('.body_contest form*').attr('action', '/contest/update/' + id);
        $('.body_contest form*').attr('method', 'post');

        var role_id = $('#active').data('id');

        if (role_id == 'admin') {
            $("#active").show();
        }else{
            $("#active").hide();
        }

        let _url = '/contest/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#title').val(hasil.hasil.title)
                $('#deskripsi').val(hasil.hasil.deskripsi)
                $('#hargatawar').val(hasil.hasil.harga_tawar)
                $('#paket_contest').val(hasil.hasil.pilihan)
                $('#paket_tambahan_contest').val(hasil.hasil.pilihan_tambahan)
                if (role_id == 'admin') {
                    if (hasil.hasil.is_active == 1) {
                        $("#status_contest option[value='" + 1 + "']").attr('selected', true);
                    } else {
                        $("#status_contest option[value='" + 2 + "']").attr('selected', true);
                    }
                }
            }
        });
    });

    $('#projects').hide()
    $('#project_running').change(function () {
        if ($(this).val() == 1) {
            $('#contests').show()
            $('#projects').hide()
        } else {
            $('#contests').hide()
            $('#projects').show()
        }

    });

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

    $('#tambahresultcontest').on('click', function () {
        let userid = $(this).attr('userid');
        let idcontest = $(this).attr('idcontest');
        $('.footer_resultcontest button[type=submit]').html('Add');
        $('#contestModalLabel').html('Add Contest');
        $('.body_resultcontest form').attr('action', '/resultcontest/store');
        $('.body_resultcontest form').attr('method', 'post');

        $("#title").val("");
        $('#id').val(idcontest)
        $('#iduser').val(userid)
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
                $('#name_worker').html(hasil.user.name )
                $('#description').html(hasil.resultcontest.title)

                $.each(hasil.feedback, function (index, feedbackall) {
                    if (feedbackall.customer_id == hasil.resultcontest.user_id) {
                        $.ajax({
                            type: 'POST',
                            url: url2,
                            data: {
                                _token: _token,
                                role_user: 'customer',
                            },
                            success: function (hasils) {
                                $('#feedback_card').append('<div class="d-flex align-items-center px-2"> <div class="avatar avatar-md mr-3" style="background-image: url(' + _urlasset + '/profile/' + hasils.user.avatar +
                                ');"> </div> <div>' + hasils.user.name + '<div> </div> <p>' + feedbackall.feedback + '</p> </div> </div>')
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
                                $('#feedback_card').append('<div class="d-flex align-items-center px-2"> <div class="avatar avatar-md mr-3" style="background-image: url();"> </div> <div><div i="name_feedback" > </div> <p id="pesan" > </p> </div> </div>')
                            }
                        });
                    }
                })
            }
        });
    });

    $('#tambahhandover').on('click', function () {
        let id = $(this).data('id');
        $('.footer_handover button[type=submit]').html('Add');
        $('#handoverProjectLabel').html('Add Handover');
        $('.body_handover form').attr('action', '/handover/' + id);
        $('.body_handover form').attr('method', 'post');
    });

    $('#tambahcontest').on('click', function () {
        $('.footer_contest button[type=submit]').html('Add');
        $('#projectContestModalLabel').html('Add Contest');
        $('.body_contest form').attr('action', '/contest/store');
        $('.body_contest form').attr('method', 'post');
    });

    $('#nilaicontest*').click(function () {
        var _id = $(this).data('id')
        var _nilai = $(this).data('nilai')
        var _url = '/projectstatus/projectrunning/show/nilaicontest/' + _id
        let _token = $('meta[name="csrf-token"]').attr('content')

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
                nilai:_nilai
            },
            success: function (hasil) {
                if (hasil.status == 200) {
                   location.reload()
                }
            }
        });
    });

    $('#opsicontest').on('click', function () {
        $('.footer_opsi button[type=submit]').html('Add');
        $('#OpsiModalLabel').html('Tambah Opsi Conntest');
        $('.body_opsi form').attr('action', '/opsicontest/create');
        $('.body_opsi form').attr('method', 'post');

        $('#name').val("")
        $('#deskripsi').val("")
        $('#price').val("")
        $("#opsi").val("")
    });
    $('#editopsicontest*').on('click', function () {
        $('.footer_opsi* button[type=submit]').html('Edit');
        $('#OpsiModalLabel*').html('Edit Opsi Conntest');
        $('.body_opsi form*').attr('action', '/opsicontest/update');
        $('.body_opsi form*').attr('method', 'post');

        const id = $(this).data('id');
        const opsi = $(this).data('opsi');

        let _url = '/opsicontest/edit';
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
                opsi: opsi,
                id: id,
            },
            success: function (hasil) {
                $('#name').val(hasil.response.name)
                $('#deskripsi').val(hasil.response.description)
                $('#price').val(hasil.response.price)
                if (hasil.opsi == '1') {
                    $("#opsi option[value='" + 1 + "']").attr('selected', true);
                } else {
                    $("#opsi option[value='" + 2 + "']").attr('selected', true);
                }
            }
        });
    });

    $('#panelchat*').on('click', function () {
        const id = $(this).data('id');

        $('#admin_close_chat').attr('action', '/chat/delete/' + id)

        let _url = '/chat/showchat';
        let _token = $('meta[name="csrf-token"]').attr('content');
        $('input[name="id"]').val(id);

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
                user_id: id,
            },
            success: function (hasil) {
                $('#body_chat').empty()
                let _url2 = '/chat/userchat';
                $.each(hasil.response,function (index,chat) {
                    if (chat.chat_admin == null) {
                        $.ajax({
                            type: 'POST',
                            url: _url2,
                            data: {
                                _token: _token,
                                user_id: chat.user_id,
                                role_user: 'customer',
                            },
                            success: function (hasils) {
                                if (chat.chat_user == null) {
                                    $('#body_chat').append(hasils.user.name + '<div class="card"<p>' + chat.chat_admin + '</p></div>')
                                } else {
                                    $('#body_chat').append(hasils.user.name + '<div class="card"<p>' + chat.chat_user + '</p></div>')
                                }
                            }
                        });
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: _url2,
                            data: {
                                _token: _token,
                                admin_id: chat.admin_id,
                                role_user: 'admin',
                            },
                            success: function (hasils) {
                                if (chat.chat_user == null) {
                                    $('#body_chat').append(hasils.user.name + '<div class="card"<p>' + chat.chat_admin + '</p></div>')
                                } else {
                                    $('#body_chat').append(hasils.user.name + '<div class="card"<p>' + chat.chat_user + '</p></div>')
                                }
                            }
                        });
                   }
                });
            }
        });
    });

    $('#panelreport*').on('click', function () {
        const id = $(this).data('id');

        $('#admin_close_report').attr('action', '/report/delete/' + id)

        let _url = '/report/showreport';
        let _token = $('meta[name="csrf-token"]').attr('content');
        $('input[name="id"]').val(id);

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
                user_id: id,
            },
            success: function (hasil) {
                $('#body_report').empty()
                let _url2 = '/report/userreport';
                $.each(hasil.response,function (index,chat) {
                    if (chat.chat_admin == null) {
                        $.ajax({
                            type: 'POST',
                            url: _url2,
                            data: {
                                _token: _token,
                                user_id: chat.worker_id,
                                role_user: 'worker',
                            },
                            success: function (hasils) {
                                if (chat.chat_worker == null) {
                                    $('#body_report').append(hasils.user.name + '<div class="card"<p>' + chat.chat_admin + '</p></div>')
                                } else {
                                    $('#body_report').append(hasils.user.name + '<div class="card"<p>' + chat.chat_worker + '</p></div>')
                                }
                            }
                        });
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: _url2,
                            data: {
                                _token: _token,
                                admin_id: chat.admin_id,
                                role_user: 'admin',
                            },
                            success: function (hasils) {
                                if (chat.chat_worker == null) {
                                    $('#body_report').append(hasils.user.name + '<div class="card"<p>' + chat.chat_admin + '</p></div>')
                                } else {
                                    $('#body_report').append(hasils.user.name + '<div class="card"<p>' + chat.chat_worker + '</p></div>')
                                }
                            }
                        });
                   }
                });
            }
        });
    });

    $('#submitpembayaran*').click(function () {
        let id = $(this).data('id');
        $('.footer_pembayaran button[type=submit]').html('Add');
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
