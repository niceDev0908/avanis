$(document).ready(function () {
    $('.simplebar-content-wrapper').scrollTop(9999999999);
    if ($("#sendMessageForm").length > 0) {
        $("#sendMessageForm").validate({
            rules: {
                message: {
                    required: true
                }
            },
            messages: {
                message: {
                    required: 'Please enter message'
                }
            },
            submitHandler: function (form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: base_url + "messages/send-message-thread",
                    dataType: 'html',
                    type: "POST",
                    data: $('#sendMessageForm').serialize(),
                    beforeSend: function () {
                        jQuery("#send_message_btn").hide();
                        jQuery("#messageLoader").show();
                    },
                    success: function (response) {
                        jQuery("#messageLoader").hide();
                        jQuery("#send_message_btn").show();
                        $('#add_message').before(response);
                        document.getElementById("sendMessageForm").reset();
                        $('.simplebar-content-wrapper').scrollTop(9999999999);
                    },
                    error: function (error) {
                        jQuery("#messageLoader").hide();
                        jQuery("#send_message_btn").show();
                    }
                });
            }
        })
    }
});