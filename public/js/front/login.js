$(document).ready(function () {
	$('.loaderClass').click(function() {
        $('.loginLoader').show();
    });
    $('#loginForm').validate({
        rules: {
            email: {
            	email:true,
                required: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: 'Please enter email',
                email: 'Please enter valid email'
            },
            password: {
                required: 'Please enter password'
            }
        }
    });
});