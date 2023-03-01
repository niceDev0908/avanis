$(document).ready(function () {
    
    $('#receivable_date').datepicker({
        endDate: '+1d'
    });

    $('#addReceivablesForm').validate({
        rules: {
            receivable_date: {
                required: true
            },
            amount: {
                required: true,
                /*min: function(){
                    if($('#product_type').val() == "RSA") {
                        return "10000"
                    } else {
                        return "1"
                    }
                }*/
            }
        },
        messages: {
            receivable_date: {
                required: 'Please select date'
            },
            amount: {
                required: 'Please enter amount',
                min: 'Minimum amount should be £10,000'
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("id") == "receivable_date") {
                $('#receivable_date_err').html(error);
            } else if (element.attr("id") == "amount") {
                $('#amount_err').html(error);
            }
        }
    });

    $('#receivable_date').blur(function () {
        $('#receivable_date_err').html('');
    });
});