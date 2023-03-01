$(document).ready(function () {

    $(document).on('click', '#add_recipient', function (e) {
        var cl_el = $('#original_recipient').clone().removeAttr('style');
        ;
        $('#insert_before').before(cl_el);
    });

    $(document).on('click', '.delete-recipient', function (e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You wan't to delete the recipient?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00c292',
            cancelButtonColor: '#e46a76',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                $(this).parent().parent().parent('.row').remove();
                getTotalPlanningFee();
                getTotalAvanisFee();
            }
        });
    });

    getTotalPlanningFee();
    $(document).on('blur', 'input[name="planning_fee[]"]', function (e) {
        getTotalPlanningFee();
    });

    getTotalAvanisFee();
    $(document).on('blur', 'input[name="avanis_fee[]"]', function (e) {
        getTotalAvanisFee();
    });

});

function getTotalPlanningFee() {
    var planning_fee_total = 0;
    $('input[name="planning_fee[]"]').each(function () {
        if ($(this).val() > 0) {
            planning_fee_total = parseInt(planning_fee_total) + parseInt($(this).val());

            var total_planning_fee = $('.total_planning_fee').attr('data-val');
            var temp_val = ($(this).val() * total_planning_fee) / 100;
            $(this).closest(".row").find('.planning_fee_amount_total').html('£ ' + temp_val);
            $(this).closest(".row").find('.planning_fee_amount_total').attr('data-val', temp_val);
        }
    });
    $('#planning_fee_total').html(planning_fee_total);

    var planning_fee_amount_total = 0;
    $('.planning_fee_amount_total').each(function () {
        if ($(this).attr('data-val') > 0) {
            planning_fee_amount_total = parseInt(planning_fee_amount_total) + parseInt($(this).attr('data-val'));
        }
    });
    $('#planning_fee_amount_total').html('£ ' + planning_fee_amount_total);
}

function getTotalAvanisFee() {
    var avanis_fee_total = 0;
    $('input[name="avanis_fee[]"]').each(function () {
        if ($(this).val() > 0) {
            avanis_fee_total = parseInt(avanis_fee_total) + parseInt($(this).val());

            var total_avanis_fee = $('.total_avanis_fee').attr('data-val');
            var temp_val = ($(this).val() * total_avanis_fee) / 100;
            $(this).closest(".row").find('.avanis_fee_amount_total').html('£ ' + temp_val);
            $(this).closest(".row").find('.avanis_fee_amount_total').attr('data-val', temp_val);
        }
    });
    $('#avanis_fee_total').html(avanis_fee_total);

    var avanis_fee_amount_total = 0;
    $('.avanis_fee_amount_total').each(function () {
        if ($(this).attr('data-val') > 0) {
            avanis_fee_amount_total = parseInt(avanis_fee_amount_total) + parseInt($(this).attr('data-val'));
        }
    });
    $('#avanis_fee_amount_total').html('£ ' + avanis_fee_amount_total);
}
