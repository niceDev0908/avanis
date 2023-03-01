$(document).ready(function () {
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
                    url: base_url + "users/messages/send-message-thread",
                    dataType: 'html',
                    type: "POST",
                    data: $('#sendMessageForm').serialize(),
                    beforeSend: function () {
                        jQuery("#send_message_btn").attr("disabled", true);
                        jQuery("#messageLoader").show();
                    },
                    success: function (response) {
                        jQuery("#messageLoader").hide();
                        jQuery("#send_message_btn").attr("disabled", false);
                        $('#add_message').before(response);
                        document.getElementById("sendMessageForm").reset();
                    },
                    error: function (error) {
                        console.log('error' + error);
                    }
                });
            }
        })
    }

    $(document).on('click', '.delete_record', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00c292',
            cancelButtonColor: '#e46a76',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'DELETE'
                }).done(function (data) {
                    window.location.reload();
                });
            }
        });
    });
});