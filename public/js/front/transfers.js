$(document).ready(function () {
    
    $('#transfer_date').datepicker({
        endDate: '+1d'
    });

    $('#addTransfersForm').validate({
        rules: {
            transfer_date: {
                required: true
            },
            amount: {
                required: true
            },
            currency: {
                required: true
            }
        },
        messages: {
            transfer_date: {
                required: 'Please select date'
            },
            amount: {
                required: 'Please enter amount',
                min: 'Minimum amount should be £10,000'
            },
            currency: {
                required: 'Please select currency'
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("id") == "transfer_date") {
                $('#transfer_date_err').html(error);
            } else if (element.attr("id") == "amount") {
                $('#amount_err').html(error);
            } else if(element.attr("id") == "currency") {
                $('#currency_err').html(error)
            }
        }
    });

    $('#transfer_date').blur(function () {
        $('#transfer_date_err').html('');
    });
});