$(document).ready(function () {
    $('#add_more').bind('click',function () {
        var html = '<div class="row mb-3 add_more align-items-baseline">';
        html += '<input type="hidden" class="hiddenID">';
        html += '<div class="col-md-2"><label for="" class="form-label">Type of Cryptocurrency</label>';
        html += '<input type="text" class="form-control description" name="description" id="description">';
        html += '</div>';
        html += '<div class="col-md-1"><label for="" class="form-label">Quantity Held</label>';
        html += '<input type="text" class="form-control assetvalue" name="value" id="assetvalue">';
        html += '</div>';
        html += '<div class="col-md-1"><label for="" class="form-label">Currency</label>';
        html += '<select class="form-select currency" name="currency" id="currency">';
        html += '<option disabled selected>Select Currency</option>';
        html += '<option value="dollar">$ Dollar</option>';
        html += '<option value="pound">£ Pound</option>';
        html += '<option value="euro">€ Euro</option></select>';
        html += '</div>';
        html += '<div class="col-md-2"><label for="" class="form-label">Current Price Per Unit</label>';
        html += '<input type="text" class="form-control currentPricePerUnit" name="current_price_per_unit" id="currentPricePerUnit">';
        html += '</div>';
        html += '<div class="col-md-2"><label for="" class="form-label">Total Value of Holdings</label>';
        html += '<input type="text" class="form-control totalValueOfHolding" name="total_value_of_holding" id="totalValueOfHolding">';
        html += '</div>';
        html += '<div class="col-md-2"><label for="" class="form-label">Last Updated</label>';
        html += '<input type="text" class="form-control last_updated_date" name="last_updated_date" id="last_updated_date" readonly>';
        html += '</div>';
        html += '<div class="col-md-2"><div class="main-btn-section">';
        html += '<label for="file-upload" class="download-label" style="border: 1px solid #556ee6;display: inline-block;padding: 6px 12px;cursor: pointer;color: #fff;background-color: #556ee6;border-color: #556ee6;margin-right: 5px;">';
        html += '<i class="fa fa-upload"></i></a></label>';
        html += '<input id="file-upload" name="asset_file" type="file" style="display:none;"/>';
        html += '<a href="" class="btn btn-primary waves-effect waves-light download-label image-link view_asset_image" id="asset_image" style="top: 25px;left: 4px;display:none;margin-right: 6px;">';
        html += '<i class="fa fa-eye" aria-hidden="true"></i></a>';
        html += '<button class="btn btn-primary waves-effect waves-light asset-btn" id="updateBtn" type="submit">Update</button>';
        html += '<a href="javascript:;" class="btn btn-danger waves-effect waves-light close_asset_field" id="deleteAsset" style="top: 25px;left: 4px;">';
        html += '<i class="fa fa-times" aria-hidden="true"></i>';
        html += '</a></div></div>';
        html += '</div>';
        $('.result').append(html);
    });

    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }

    $('#manageAssetForm').on("click", "#updateBtn" ,function() {
        var parentElement = $(this).parent().parent().parent();
        var currentElement = $(this);
        var updateAssetId = currentElement.attr('data-id');

        if(updateAssetId) {
            var formObj = {
                id: updateAssetId,
                description: $('#description_'+updateAssetId).val(),
                assetValue: $('#assetvalue_'+updateAssetId).val(),
                currency: $('#currency_'+updateAssetId).val(),
                current_price_per_unit : $('#currentPricePerUnit_'+updateAssetId).val(),
                total_value_of_holding : $('#totalValueOfHolding_'+updateAssetId).val(),
                old_description: $('#description_'+updateAssetId).attr('data-olddescription'),
                old_assetValue: $('#assetvalue_'+updateAssetId).attr('data-oldassetvalue'),
                old_currency: $('#currency_'+updateAssetId).attr('data-oldcurrency'),
                old_current_price_per_unit: $('#currentPricePerUnit_'+updateAssetId).attr('data-oldCurrentPricePerUnit'),
                old_total_value_of_holding: $('#totalValueOfHolding_'+updateAssetId).attr('data-oldTotalValueOfHolding')
            }
            var form_data = new FormData();
            form_data.append("id", formObj.id)
            form_data.append("description", formObj.description)
            form_data.append("assetValue", formObj.assetValue)
            form_data.append("currency", formObj.currency)
            form_data.append("current_price_per_unit", formObj.current_price_per_unit)
            form_data.append("total_value_of_holding", formObj.total_value_of_holding)
            form_data.append("old_description", formObj.old_description)
            form_data.append("old_assetValue", formObj.old_assetValue)
            form_data.append("old_currency", formObj.old_currency)
            form_data.append("old_current_price_per_unit", formObj.old_current_price_per_unit)
            form_data.append("old_total_value_of_holding", formObj.old_total_value_of_holding)
            form_data.append("asset_file", file_value)
        }else {
            var formObj = {
                description: $('#description',parentElement).val(),
                assetValue: $('#assetvalue',parentElement).val(),
                currency: $('#currency',parentElement).val(),
                current_price_per_unit : $('#currentPricePerUnit',parentElement).val(),
                total_value_of_holding : $('#totalValueOfHolding',parentElement).val(),
                asset_file : file_value
            }
            var form_data = new FormData();
            form_data.append("description", formObj.description)
            form_data.append("assetValue", formObj.assetValue)
            form_data.append("currency", formObj.currency)
            form_data.append("current_price_per_unit", formObj.current_price_per_unit)
            form_data.append("total_value_of_holding", formObj.total_value_of_holding)
            form_data.append("asset_file", formObj.asset_file)
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: base_url + "add-assets-action",
            dataType: 'JSON',
            type: "POST",
            data: form_data,
            cache:false,
            contentType: false,
            processData: false,
            success: function (data) {
                var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                let date = new Date();
                let day = date.getDate();
                let month = months[date.getMonth()];
                let year = date.getFullYear();
                let formatedDate = day+' '+month+', '+year;
                if(data.response == 1) {
                    var assetID = data.asset.id;
                    parentElement.attr('id','assetRow_' + assetID);
                    currentElement.attr('data-id',assetID);
                    
                    jQuery('.description', parentElement).attr("id",'description_'+assetID);
                    jQuery('.assetvalue', parentElement).attr("id",'assetvalue_'+assetID);
                    jQuery('.currency', parentElement).attr("id",'currency_'+assetID);
                    jQuery('.currentPricePerUnit', parentElement).attr("id",'currentPricePerUnit_'+assetID);
                    jQuery('.totalValueOfHolding', parentElement).attr("id",'totalValueOfHolding_'+assetID);
                    jQuery('.last_updated_date', parentElement).attr("id", 'last_updated_date_'+assetID);
                    jQuery('.close_asset_field', parentElement).attr("id", 'deleteAsset_'+assetID);
                    jQuery('.view_asset_image', parentElement).attr("id", 'asset_image_'+assetID);

                    jQuery('#description_'+assetID, parentElement).attr('data-olddescription', data.asset.description);
                    jQuery('#assetvalue_'+assetID, parentElement).attr('data-oldassetvalue', data.asset.value);
                    jQuery('#currency_'+assetID, parentElement).attr('data-oldcurrency', data.asset.currency);
                    jQuery('#currentPricePerUnit_'+assetID, parentElement).attr('data-oldCurrentPricePerUnit', data.asset.current_price_per_unit);
                    jQuery('#totalValueOfHolding_'+assetID, parentElement).attr('data-oldTotalValueOfHolding', data.asset.total_value_of_holding);
                    jQuery('#deleteAsset_'+assetID, parentElement).attr('data-delete', assetID);
                    jQuery('#last_updated_date_'+assetID).val(formatedDate);
                    
                    var image_url = base_url+ 'public/uploads/user_assets/'+assetID+'/'+data.asset.asset_file;
                    jQuery('#asset_image_'+assetID).attr('href', image_url);
                    jQuery('#asset_image_'+assetID).show();
                    
                    $('#success-msg').html('<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">'+data.message+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }else if(data.response == 0) {
                    $('#success-msg').html('<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">'+data.message+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }else if(data.response == 2) {
                    $('#success-msg').html('<div class="alert alert-danger print-error-msg"><ul></ul></div>');
                    printErrorMsg(data.message);
                }
                jQuery("#loader").hide();
                jQuery("#updateBtn").show();
            },
            error: function (error) {
                $('#success-msg').html('<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">'+error+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }
        });   
    });


    $("#manageAssetForm").on( "click", '.close_asset_field' ,function(e) {
        e.preventDefault();
        var currentElement = $(this);
        var deleteElementId = currentElement.attr('data-delete');     
        if(deleteElementId == undefined) {
            $(this).closest(".add_more").remove();
            return false;
        }
        var url = base_url + 'user-assets/delete/' + deleteElementId;
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4458b8',
            cancelButtonColor: '#f46a6a',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'DELETE',
                    dataType: 'JSON',
                }).done(function (data) {
                    if(data.response == 1) {
                        $('#assetRow_' + deleteElementId).remove();
                        $('#success-msg').html('<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">'+data.message+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }else {
                        $('#success-msg').html('<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">'+data.message+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }
                });
            }
        });
    });

    $("#manageAssetForm").on("change", '#file-upload', function(e) {
        file_value = $("input[type=file]").get(0).files[0];
    });

    $('#send_notification_btn').on("click", function(e) {
        let isChecked = $('#send_notification').is(':checked');
        if(isChecked == true) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    isChecked: isChecked
                },
                url: base_url + "user-assets/send-notification",
                dataType: 'JSON',
                success: function (data) {
                    if(data.response == 1) {
                        $('#success-msg').html('<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">'+data.message+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }else {
                        $('#success-msg').html('<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">'+data.message+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    $('#send_notification_btn').prop('disabled', true)
    $('#send_notification').change(function() {
        if(this.checked) {
            $('#send_notification_btn').prop('disabled', false)
        }else {
            $('#send_notification_btn').prop('disabled', true)
        }
    });

    $('.image-link').magnificPopup({
        type:'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        }
    });
    
});