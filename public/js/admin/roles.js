$(document).ready(function () {
    $(document).on('click', '.delete_record', function (e) {
        e.preventDefault();
        var url = $(this).attr('data-id');
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
                    url: 'roles/' + url + '/delete/',
                    type: 'GET'
                }).done(function (data) {
                    window.location.reload();
                });
            }
        });
    });
    $('#frmCreateEdit').validate({
        rules: {
            name: {
                required: true
            },
            'permission[]': {
                required: true
            }
        },
        messages: {
            name: {
                required: 'Please enter role name'
            },
            'permission[]': {
                required: 'Please select any permission'
            }
        }
    });
    $('#frmEdit').validate({
        rules: {
            name: {
                required: true
            },
            'permission[]': {
                required: true
            }
        },
        messages: {
            name: {
                required: 'Please enter role name'
            },
            'permission[]': {
                required: 'Please select any permission'
            }
        }
    });
});