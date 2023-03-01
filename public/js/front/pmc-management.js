$(document).ready(function () {
    let final_total = 0;
    let row_bal = 0;

    //Edit PMC Table Values:
    var editTable = $('#pmcManagementTable');
    var editRows = editTable.find('tbody > tr');
    editRows.each(function (index) {
        var parentRow = $(this);
        toCalculateTotalBalance(parentRow);
    });
    
    var tableRows = $('#pmcManagementTable').find('tbody > tr');
    tableRows.each(function (index) {
        var parentRow = $(this);
        $("#pmc_type", parentRow).on('keyup', function() {
            var text = $(this).val();
            $('#hidden_pmc_type', parentRow).val(text);
        });
        $("#pmc_description", parentRow).on('keyup', function() {
            var pmc_description = $(this).val();
            $('#hidden_pmc_description', parentRow).val(pmc_description);
        });    
        $("#pmc_date", parentRow).on('change', function() {
            var pmc_date = $(this).val();
            $('#hidden_pmc_date', parentRow).val(pmc_date);
        });    
    });

    $("#add_more_pmc").click(function () { 
        var rowCount = $("#pmcManagementTable tbody tr").length;
        if(rowCount > 0) {
            $("#pmcManagementTable").each(function () {
                var mode = $('#edit_mode', this).val();
                if(mode == 'edit') {
                    var html = $("#hiddenPMCTable tbody tr").html();
                    var tds = '<tr>';
                    tds += html;
                    tds += '</tr>';
                }else {
                    var tds = '<tr>';
                    jQuery.each($('tr:last td', this), function (index, element) {
                        if(index == 8) {
                            tds += '<td class="text-center">' + $(this).html() + '</td>';
                        }else {
                            tds += '<td>' + $(this).html() + '</td>';
                        }
                    });
                    tds += '</tr>';
                }
                if ($('tbody', this).length > 0) {
                    $('tbody', this).append(tds);
                } else {
                    $(this).append(tds);
                }
            });
        }else if(rowCount == 0) {
            $('#hiddenPMCTable').each(function () {
                var tds = '<tr>';
                jQuery.each($('tr:last td', this), function (index, element) {
                    if(index == 8) {
                        tds += '<td class="text-center">' + $(this).html() + '</td>';
                    }else {
                        tds += '<td>' + $(this).html() + '</td>';
                    }
                });
                tds += '</tr>';
                if ($('tbody', this).length > 0) {
                    $('tbody', "#pmcManagementTable").append(tds);
                } else {
                    $("#pmcManagementTable").append(tds);
                }
            })
        } 
    });

    $("#pmcManagementTable").on( "click", '.pmc_delete' ,function(e) {
        $(this).closest('tr').remove();
        let parentRow = $(this).parents("tr");
        toCalculateTotalBalance(parentRow);
    });

    $('#pmcManagementTable').on( "keyup", '.pmc_asset_in', function(e) {
        let parentRow = $(this).parents("tr");
        toCalculateTotalBalance(parentRow);
    });

    $('#pmcManagementTable').on( "keyup", '.pmc_asset_out', function(e) {
        let parentRow = $(this).parents("tr");
        toCalculateTotalBalance(parentRow);
    });

    $('#pmcManagementTable').on( "keyup", '.pmc_cash_in', function(e) {
        let parentRow = $(this).parents("tr");
        toCalculateTotalBalance(parentRow);
    });

    $('#pmcManagementTable').on( "keyup", '.pmc_cash_out', function(e) {
        let parentRow = $(this).parents("tr");
        toCalculateTotalBalance(parentRow);
    });

    $('#pmcManagementTable').on( "keyup", '.pmc_type', function(e) {
        let parentRow = $(this).parents("tr");
        validateFields(e);
        toCalculateTotalBalance(parentRow);
    });

    $('#pmcManagementTable').on( "keyup", '.pmc_description', function(e) {
        let parentRow = $(this).parents("tr");
        validateFields(e);
        toCalculateTotalBalance(parentRow);
    });

    $('#pmcManagementTable').on( "change", '.pmc_type', function(e) {
        validateFields(e);
    });

    $('#pmcManagementTable').on( "change", '.pmc_description', function(e) {
        validateFields(e);
    });

    $('#pmcManagementTable').on( "change", '.pmc_file_upload', function(e) { 
        validateFields(e);
    });

    function toCalculateTotalBalance(parentRow) {
        var pmc_type = $('#pmc_type', parentRow).val();
        var pmc_description = $('#pmc_description', parentRow).val();

        $('#hidden_pmc_type', parentRow).val(pmc_type);
        $('#hidden_pmc_description', parentRow).val(pmc_description);

        var table = $('#pmcManagementTable');
        var rows = table.find('tr:not(:hidden)');
        final_total = 0;
        row_bal = 0;

        rows.each(function(index) {
            if(index != 0) {
                var td = $(this).find('td');
                var pmc_asset_in = $('#pmc_asset_in', td).val() ? parseFloat($('#pmc_asset_in', td).val()) : 0;
                var pmc_asset_out = $('#pmc_asset_out', td).val() ? parseFloat($('#pmc_asset_out', td).val()) : 0;
                var pmc_cash_in = $('#pmc_cash_in', td).val() ? parseFloat($('#pmc_cash_in', td).val()) : 0;
                var pmc_cash_out = $('#pmc_cash_out', td).val() ? parseFloat($('#pmc_cash_out', td).val()) : 0;
                            
                row_bal =  (pmc_asset_in + pmc_cash_in) - (pmc_asset_out + pmc_cash_out);
                final_total += row_bal
                $('#pmc_trust_val_bal', td).val(getPrice(final_total));
                $('#hidden_pmc_trust_val_bal', td).val(final_total);
                $('#hidden_pmc_asset_in', td).val(pmc_asset_in);
                $('#hidden_pmc_asset_out', td).val(pmc_asset_out);
                $('#hidden_pmc_cash_in', td).val(pmc_cash_in);
                $('#hidden_pmc_cash_out', td).val(pmc_cash_out);
            }
        });
    }

    $('#savePMCBtn').on("click", function (e) {
        validateFields(e);
    });

    function validateFields(e) {
        var tableRows = $('#pmcManagementTable').find('tbody > tr');
        tableRows.each(function (index) {
            var mode = $('#edit_mode', this).val();
            var parentRow = $(this);
            var pmc_type_val = $('#pmc_type', parentRow).val();
            var pmc_description_val = $('#pmc_description', parentRow).val();
            var pmc_file_upload_val = $('#pmc_file_upload', parentRow).val();
            var file_val = $('#file_value', parentRow).val();
            if(pmc_type_val == '') {
                $('#pmcTypeError', parentRow).show();
                e.preventDefault();
            }else {
                $('#pmcTypeError', parentRow).hide();
            }
            if(pmc_description_val == '') {
                $('#pmcDescriptionError', parentRow).show();
                e.preventDefault();
            }else {
                $('#pmcDescriptionError', parentRow).hide();
            }
            // if(pmc_date_vale == '' || pmc_date_vale == null) {
            //     $('#pmcDateError', parentRow).show();
            // }else {
            //     $('#pmcDateError', parentRow).hide();
            // }
            if(mode == 'edit') {
                if(file_val == '' && pmc_file_upload_val == '') {
                    $('#pmcFileUploadError', parentRow).show();
                    e.preventDefault();  
                }else {
                    $('#pmcFileUploadError', parentRow).hide();
                }    
            }else {
                if(pmc_file_upload_val == '') {
                    $('#pmcFileUploadError', parentRow).show();   
                    e.preventDefault();
                }else {
                    $('#pmcFileUploadError', parentRow).hide();   
                }
            }
        });
    }
});