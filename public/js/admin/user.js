$(document).ready(function () {
    checkUserRole();

    $('#myTable').DataTable({
        "aaSorting": [],
        'columnDefs': [{
                'targets': [0, 9],
                'orderable': false,
            }]
    });

    $('#assetTable').DataTable({
        "aaSorting": [],
        'columnDefs': [{
            'targets': [5, 7],
            'orderable': false,
        }]
    });

    $('#pmcDataTable').DataTable({
        "aaSorting": [],
        'columnDefs': [{
            'targets': [8],
            'orderable': false,
        }]
    });

    $(document).on('click', '#userAssetLog', function(event) {
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            dataType: 'html',
            success: function(result) {
                $('#viewAssetLogModal').modal("show");
                $('#viewAssetLogBody').html(result);
            },
            error: function(error) {
               console.log(error);
            }
        })
    });

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

    $("#checkall").change(function () {
        if ($("#checkall").is(':checked')) {
            $(".cb-element").each(function () {
                $(this).prop("checked", true);
            });
        } else {
            $(".cb-element").each(function () {
                $(this).prop("checked", false);
            })
        }
    });

    $('#btn-all-active,#btn-all-inactive').on('click', function () {
        var action = $(this).attr('action');
        var myCheckboxes = new Array();
        $("input.cb-element:checked").each(function () {
            myCheckboxes.push($(this).val());
        });
        if (myCheckboxes.length == 0) {
            Swal.fire("Alert!", "Please select atleast one record to change the status.", "warning");
            return false;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You wan't to mark the selected record(s) as " + action + "?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00c292',
            cancelButtonColor: '#e46a76',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: base_url + "users/update-selected-records-status",
                    dataType: 'html',
                    data: {
                        ids: myCheckboxes,
                        action: action
                    },
                    success: function (response) {
                        var res = $.parseJSON(response);
                        if (res.success == 1) {
                            for (var i = 0; i < myCheckboxes.length; i++) {
                                if (action == 'Active') {
                                    $('#row_' + myCheckboxes[i]).find('.btn-status').removeClass('label-danger');
                                    $('#row_' + myCheckboxes[i]).find('.btn-status').addClass('label-success');
                                    $('#row_' + myCheckboxes[i]).find('.btn-status').html(action);
                                } else if (action == 'Inactive') {
                                    $('#row_' + myCheckboxes[i]).find('.btn-status').addClass('label-danger');
                                    $('#row_' + myCheckboxes[i]).find('.btn-status').removeClass('label-success');
                                    $('#row_' + myCheckboxes[i]).find('.btn-status').html(action);
                                }
                            }
                            $('.flash-message').html('<div class="alert alert-success">Selected record(s) marked as <b>' + action + '</b> successfully.</div>');
                        } else {
                            $('.flash-message').html('<div class="alert alert-danger">Error in marking the selected record(s) as <b>' + action + '</b>. Please try again.</div>');
                        }
                    }
                });
            }
            $("#checkall").prop('checked', false);
            $(".cb-element").each(function () {
                $(this).prop("checked", false);
            });
        });
    });

    $('#btn-all-delete').on('click', function () {
        var myCheckboxes = new Array();
        $("input.cb-element:checked").each(function () {
            myCheckboxes.push($(this).val());
        });
        if (myCheckboxes.length == 0) {
            Swal.fire("Alert!", "Please select atleast one record to delete.", "warning");
            return false;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You wan't to delete the selected record(s)?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00c292',
            cancelButtonColor: '#e46a76',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: base_url + "users/delete-selected-records",
                    dataType: 'html',
                    data: {
                        ids: myCheckboxes
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
            $("#checkall").prop('checked', false);
            $(".cb-element").each(function () {
                $(this).prop("checked", false);
            });
        });
    });

    $('#frmCreateEdit').validate({
        rules: {
            f_name: {
                required: true
            },
            l_name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            roles: {
                required: true
            },
            password: {
                required: function () {
                    if ($('#id').val() > 0) {
                        return false;
                    } else {
                        return true;
                    }
                },
                minlength: 6
            },
            c_password: {
                required: function () {
                    if ($('#id').val() > 0) {
                        return false;
                    } else {
                        return true;
                    }
                },
                equalTo: "#password"
            },
            address: {
                required: true
            },
            country: {
                required: true
            },
            postcode: {
                required: true
            },
            phone_number: {
                required: true
            },
            receivables: {
                required: true
            },
            planning_fee: {
                required: true
            },
            avanis_fee: {
                required: true
            },
            status: {
                required: true
            }
        },
        messages: {
            f_name: {
                required: 'Please enter first name'
            },
            l_name: {
                required: 'Please enter last name'
            },
            email: {
                required: 'Please enter email',
                email: 'Please enter valid email address'
            },
            roles: {
                required: 'Pease select role'
            },
            password: {
                required: 'Please enter password',
                minlength: 'Password should be minimum 6 characters long'
            },
            c_password: {
                required: 'Please confirm password',
                equalTo: 'Password and confirm password should be same'
            },
            address: {
                required: 'Please enter address'
            },
            country: {
                required: 'Please select country'
            },
            postcode: {
                required: 'Please enter post code'
            },
            phone_number: {
                required: 'Please enter phone number'
            },
            receivables: {
                required: 'Please select receivables'
            },
            planning_fee: {
                required: 'Please enter planning fee'
            },
            avanis_fee: {
                required: 'Please enter avanis fee'
            },
            status: {
                required: 'Please select status'
            }
        }
    });

    $(document).on('change', '#select-role', function (e) {
        checkUserRole();
    });

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
        }
    });
    $('#planning_fee_total').html(planning_fee_total);
}

function getTotalAvanisFee() {
    var avanis_fee_total = 0;
    $('input[name="avanis_fee[]"]').each(function () {
        if ($(this).val() > 0) {
            avanis_fee_total = parseInt(avanis_fee_total) + parseInt($(this).val());
        }
    });
    $('#avanis_fee_total').html(avanis_fee_total);
}

function checkUserRole() {
    var val = $('#select-role').val();
    if (val != "User") {
        $('#product_type').attr('disabled', true);
        $('#receivables').attr('disabled', true);
    } else {
        $('#product_type').attr('disabled', false);
        $('#receivables').attr('disabled', false);
    }
}

$('.image-link').magnificPopup({
    type:'image',
    closeOnContentClick: true,
    mainClass: 'mfp-img-mobile',
    image: {
        verticalFit: true
    }
});