$(document).ready(function () {

    function exportReports(url,data,csv_name){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: url,
            dataType: 'html',
            data: data,
            success: function (data) {
                //Convert the Byte Data to BLOB object.
                var blob = new Blob([data], {type: "application/octetstream"});

                //Check the Browser type and download the File.
                var isIE = false || !!document.documentMode;
                if (isIE) {
                    window.navigator.msSaveBlob(blob, csv_name);
                } else {
                    var url = window.URL || window.webkitURL;
                    link = url.createObjectURL(blob);
                    var a = $("<a />");
                    a.attr("download", csv_name);
                    a.attr("href", link);
                    $("body").append(a);
                    a[0].click();
                    $("body").remove(a);
                }
            }
        });
    }

    $(document).on('click', '#download_transactions_report', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var csv_name = "Transactions.csv";
        var data =  {
            from_date: $('#from_date').val(),
            to_date: $('#to_date').val(),
            product_type: $('#product_type').val()
        };
        exportReports(url,data,csv_name);
    });

    $(document).on('click','#download_user_transactions_report', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var csv_name = "Users.csv";
        var data = {
            u_from_date: $('#u_from_date').val(),
            u_to_date: $('#u_to_date').val()
        };
        exportReports(url,data,csv_name);
    });
});