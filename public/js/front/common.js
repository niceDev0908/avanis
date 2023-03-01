$(document).ready(function () {
	$('.loaderClass').click(function() {
        $('.forgotLoader').show();
    });
    $('#ForgotPasswordForm').validate({
        rules: {
            forgot_email: {
            	email:true,
                required: true
            }
        },
        messages: {
            forgot_email: {
                required: 'Please enter email to complete this action',
                email: 'Please enter valid email'
            }
        }
    });
    $('#resetPasswordForm').validate({
        rules: {
            password_reset: {
                required: true,
                minlength: 6
            },
            confirm_password_reset: {
                required: true,
                equalTo: "#password_reset"
            }
        },
        messages: {
            password_reset: {
                required: 'Please enter password',
                minlength: 'Password should be minimum 6 characters long'
            },
            confirm_password_reset: {
                required: 'Please confirm password',
                equalTo: 'Password and confirm password should be same'
            }
        }
    });
});