$(document).ready(function () {
    $('.loaderClass').click(function() {
        $('.avanisLoader').show();
    });
    $('#changePasswordForm').validate({
        rules: {
            current_password: {
                required: true
            },
            new_password: {
                required: true,
                minlength:6
            },
            new_confirm_password: {
                required: true,
                equalTo: "#new_password"
            }
        },
        messages: {
            current_password: {
                required: 'Please enter your current password'
            },
            new_password: {
                required: 'Please enter new password',
                minlength: 'Password should be minimum 6 characters long'
            },
            new_confirm_password: {
                required: 'Please confirm password',
                equalTo: 'Password and confirm password should be same'
            }
        }
    });
});

