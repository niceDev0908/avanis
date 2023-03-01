$(document).ready(function () {
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