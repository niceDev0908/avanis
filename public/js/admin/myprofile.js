$(document).ready(function () {
    $('#frmCreateEdit').validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            password: {
                minlength: 6
            },
            c_password: {
                equalTo: "#password"
            },
            image_file_name: {
                required: function () {
                    if ($('#input_old_name').val() == "") {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        },
        messages: {
            first_name: {
                required: 'Please enter first name'
            },
            last_name: {
                required: 'Please enter last name'
            },
            password: {
                required: 'Please enter password',
                minlength: 'Password should be minimum 6 characters long'
            },
            c_password: {
                required: 'Please confirm password',
                equalTo: 'Password and confirm password should be same'
            },
            image_file_name: {
                required: 'Please select image',
                accept: 'Please upload valid image file'
            }
        }
    });

    $(document).on('click', '.delete_image', function (e) {
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
                    type: 'GET'
                }).done(function (data) {
                    window.location.reload();
                });
            }
        });
    });
});