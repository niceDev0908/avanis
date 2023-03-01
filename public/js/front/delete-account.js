$(document).ready(function () {
    $(document).on('click', '.delete_account', function (e) {
        e.preventDefault();
        var url = base_url + 'delete-account-action/' + $(this).attr('data-id');
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
                        Swal.fire(
                            'Deleted!',
                            'Your account has been deleted.',
                            'success'
                        );
                        window.location.href = base_url;
                    } else {
                        Swal.fire(
                            'Deleted!',
                            'Error in deleting account. Please try again.',
                            'error'
                        )
                    }
                });
            }
        });
    });

});