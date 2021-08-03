$(document).ready(function () {
    $('#register').attr('disabled','disabled')
     $('#agree').click(function () {
         if ($(this).is(':checked')) {
             $('#register').removeAttr('disabled', 'disabled')
         } else {
            $('#register').attr('disabled', 'disabled')
         }
     });
})
