$(document).ready(function () {
    $('#resetpasswordform').validate({
        rules: {
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            password: {
                required: 'Please enter password',
                minlength: 'Password should be minimum 6 characters long'
            },
            password_confirmation: {
                required: 'Please confirm password',
                equalTo: 'Password and confirm password should be same'
            }
        }
    });
});