$(document).ready(function () {
    $('.loaderClass').click(function() {
        $('.registerLoader').show();
    });
    $('#registerForm').validate({
        rules: {
            intermediary_code: {
                required: true
            },
            product_type: {
                required: true
            },
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            reg_email: {
                required: true,
                email: true
            },
            reg_password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                equalTo: "#reg_password"
            },
            address: {
                required: true
            },
            postcode: {
                required: true
            },
            country: {
                required: true
            },
            phone_number: {
                required: true
            }
        },
        messages: {
            intermediary_code: {
                required: 'Please enter application code'
            },
            product_type: {
                required: 'Please select product type'
            },
            first_name: {
                required: 'Please enter first name'
            },
            last_name: {
                required: 'Please enter last name'
            },
            reg_email: {
                required: 'Please enter email',
                email: 'Please enter valid email address'
            },
            reg_password: {
                required: 'Please enter password',
                minlength: 'Password should be minimum 6 characters long'
            },
            confirm_password: {
                required: 'Please confirm password',
                equalTo: 'Password and confirm password should be same'
            },
            address: {
                required: 'Please enter address'
            },
            postcode: {
                required: 'Please enter post code'
            },
            country: {
                required: 'Please select country'
            },
            phone_number: {
                required: 'Please enter phone number'
            }
        }
    });    
});