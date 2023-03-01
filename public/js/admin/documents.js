$(document).ready(function () {
    $('#myTable').DataTable({
        "aaSorting": [],
        'columnDefs': [{
                'targets': [0, 4],
                'orderable': false,
            }]
    });

    $('#frmCreateEdit').validate({
        rules: {
            receivable_id: {
                required: true
            },
            title: {
                required: true
            },
            'upload_action_docs[]': {
                extension: "doc|docx|pdf|xls|csv"
            },
            action_status: {
                required: true
            }
        },
        messages: {
            receivable_id: {
                required: 'Please select receivable'
            },
            title: {
                required: 'Please enter action title'
            },
            'upload_action_docs[]': {
                extension: 'Please upload valid file format'
            },
            action_status: {
                required: 'Please select action status'
            }
        }
    });

    $('#add_more_btn').bind('click', function () {
        var newel = $('.add_more:last').clone(true).attr('id', 'upload_ref').find("input,text").val("").end().appendTo(".results");
        newel.find('.dynamic-add-form-close').show();
        $(newel).insertAfter(".add_more:last");
    });

    $(".dynamic-add-form-close").click(function () {
        $(this).closest(".add_more").remove();
    });

    $(document).on('click', '.delete_record', function (e) {
        e.preventDefault();
        var url = base_url + 'users/documents/delete/' + $(this).attr('data-id');
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
                    url: base_url + "users/documents/update-selected-records-status",
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
                    url: base_url + "users/documents/delete-selected-records",
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

    $(document).on('click', '.delete_doc', function (e) {
        e.preventDefault();
        var url = base_url + 'users/documents/delete_action_document/' + $(this).attr('data-id');
        var id = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0378B5',
            cancelButtonColor: '#131313',
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
                    if (data.success == 1) {
                        $('#action_doc' + id).remove();
                        Swal.fire(
                                'Deleted!',
                                'Action Document has been deleted.',
                                'success'
                                )
                    } else {
                        Swal.fire(
                                'Deleted!',
                                'Error in deleting Action Document. Please try again.',
                                'error'
                                )
                    }
                });
            }
        });
    });

    if ($("#is_request_document").is(':checked')) {
        $('.document_url').hide();
    }

    $('#is_request_document').click(function () {
        if ($("#is_request_document").is(':checked')) {
            $('.document_url').hide();
        } else {
            $('.document_url').show();
        }
    });

    $('.download-file').click(function () {
        var file_name = $(this).attr('data-file-name');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).attr('data-url'),
            type: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
        }).done(function (data) {
            var a = document.createElement('a');
            var url = window.URL.createObjectURL(data);
            a.href = url;
            a.download = file_name;
            document.body.append(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
        });
    });

});