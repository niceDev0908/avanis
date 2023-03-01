$(document).ready(function () {
    $('#myTable').DataTable({
        "aaSorting": [],
        'columnDefs': [{
            'targets': [2],
            'orderable': false,
        }]
    });
    $('#frmCreateEdit').validate({
        rules: {
            setting_value: {
                required: true
            }
        },
        messages: {
            setting_value: {
                required: 'Please select under maintenance setting mode'
            }
        }
    });
});
