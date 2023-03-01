$(document).ready(function () {
    $('.loaderClass').click(function() {
        $('.avanisLoader').show();
    });

    $('#manageProfileForm').validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email: {
                required: true,
                email: true
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
            first_name: {
                required: 'Please enter first name'
            },
            last_name: {
                required: 'Please enter last name'
            },
            email: {
                required: 'Please enter email',
                email: 'Please enter valid email address'
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