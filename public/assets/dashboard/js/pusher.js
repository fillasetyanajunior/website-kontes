$(document).ready(function () {
    var _url = $('.notif').data('url')
    var _id = $('.notif').data('id')
    var html = ''
    var datas = $('#notifdropdown').html()
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('18fb06b99600894b8582', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function (data) {
        if (data.id == _id) {
            if (data) {
                $('.notif').append('<span class="nav-unread"></span>')
                if (data.role_message == 'report') {
                    html += '<a href="/report" class="dropdown-item d-flex"> <span class="avatar mr-3 align-self-center profile_user"style="background-image: url(' + _url + '/' + data.avatar + ')" > </span> <div><strong > ' + data.name + '</strong>&nbsp;&nbsp;' + data.message + '</div> </a>'
                } else {
                    html += '<a href="/chat" class="dropdown-item d-flex"> <span class="avatar mr-3 align-self-center profile_user"style="background-image: url(' + _url + '/' + data.avatar + ')" > </span> <div><strong > ' + data.name + '</strong>&nbsp;&nbsp;' + data.message + '</div> </a>'
                }
                $('#notifdropdown').html(html + datas)
            }
        } else {

        }
    });
})
