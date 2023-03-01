$(document).ready(function () {
    $('#myTable').DataTable({
        "aaSorting": [],
        'columnDefs': [{
                'targets': [4],
                'orderable': false,
            }]
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

});
