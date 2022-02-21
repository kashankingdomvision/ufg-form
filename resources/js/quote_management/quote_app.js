$(document).ready(function() {
   
    /*
    |--------------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------------
    */

    function getQuoteTotalValuesOnMarkupChange(changeFeild){

        var totalNetPrice                   = 0;
        var totalMarkupAmount               = 0;
        var markupPercentage                = 0;
        var calculatedTotalMarkupPercentage = 0;
        var totalSellingPrice               = 0;
        var calculatedTotalMarkupAmount     = 0;
        var calculatedProfitPercentage      = 0;

        totalNetPrice               = parseFloat($('.total-net-price').val());
        totalMarkupAmount           = parseFloat($('.total-markup-amount').val());
        markupPercentage            = parseFloat($('.total-markup-percent').val());

        if(changeFeild == 'total_markup_amount'){

            calculatedTotalMarkupPercentage = parseFloat(totalMarkupAmount) / parseFloat(totalNetPrice / 100);
            totalSellingPrice               = totalNetPrice + totalMarkupAmount;

            $('.total-markup-percent').val(check(calculatedTotalMarkupPercentage));
            $('.total-selling-price').val(check(totalSellingPrice));
        }

        if(changeFeild == 'total_markup_percent'){

            calculatedTotalMarkupAmount = (parseFloat(totalNetPrice) / 100) * parseFloat(markupPercentage);
            totalSellingPrice           = totalNetPrice + calculatedTotalMarkupAmount;

            $('.total-markup-amount').val(check(calculatedTotalMarkupAmount));
            $('.total-selling-price').val(check(totalSellingPrice));
        }

        calculatedProfitPercentage = ((parseFloat(totalSellingPrice) - parseFloat(totalNetPrice)) / parseFloat(totalSellingPrice)) * 100;
        $('.total-profit-percentage').val(check(calculatedProfitPercentage));

        getCommissionRate();
        getBookingAmountPerPerson();
        getSellingPrice();
        getCalculatedTotalNetMarkup();
    }



    window.getQuoteTotalValues = function() {

        var markupType = $("input[name=markup_type]:checked").val();

        var estimatedCostInBookingCurrencyArray = $(".estimated-cost-in-booking-currency").map((i, e) => parseFloat(e.value)).get();
        var estimatedCostInBookingCurrency      = estimatedCostInBookingCurrencyArray.reduce((a, b) => (a + b), 0);

        $(".total-net-price").val(check(estimatedCostInBookingCurrency));

        if(markupType == 'itemised'){

            var sellingPriceInBookingCurrencyArray = $(".selling-price-in-booking-currency").map((i, e) => parseFloat(e.value)).get();
            var sellingPriceInBookingCurrency = sellingPriceInBookingCurrencyArray.reduce((a, b) => (a + b), 0);

            var markupAmountInBookingCurrencyArray = $(".markup-amount-in-booking-currency").map((i, e) => parseFloat(e.value)).get();
            var markupAmountInBookingCurrency = markupAmountInBookingCurrencyArray.reduce((a, b) => (a + b), 0);

            var markupPercentageArray = $(".markup-percentage").map((i, e) => parseFloat(e.value)).get();
            var markupPercentage = markupPercentageArray.reduce((a, b) => (a + b), 0);

            var profitPercentageArray = $(".profit-percentage").map((i, e) => parseFloat(e.value)).get();
            var profitPercentage = profitPercentageArray.reduce((a, b) => (a + b), 0);

            $(".total-selling-price").val(check(sellingPriceInBookingCurrency));
            $(".total-markup-amount").val(check(markupAmountInBookingCurrency));
            $(".total-markup-percent").val(check(markupPercentage));
            $(".total-profit-percentage").val(check(profitPercentage));

        }

        if(markupType == 'whole'){

            $(".total-markup-amount").val(parseFloat(0).toFixed(2));
            $(".total-markup-percent").val(parseFloat(0).toFixed(2));
            $(".total-profit-percentage").val(parseFloat(0).toFixed(2));
            $(".total-selling-price").val(check(estimatedCostInBookingCurrency));
        }

        onChangeAgencyCommissionType();

        getCommissionRate();
        getBookingAmountPerPerson();
        getSellingPrice();
    }

    window.getQuoteDetailsValues = function(key, changeFeild) {

        var supplierCurrency = $(`#quote_${key}_supplier_currency_id`).find(':selected').data('code');
        var bookingCurrency  = $(".booking-currency-id").find(':selected').data('code');
        var rateType         = $("input[name=rate_type]:checked").val();
        var markupType       = $("input[name=markup_type]:checked").val();
        var estimatedCost    = parseFloat($(`#quote_${key}_estimated_cost`).val()).toFixed(2);
        var markupPercentage = parseFloat($(`#quote_${key}_markup_percentage`).val());
        var markupAmount     = parseFloat($(`#quote_${key}_markup_amount`).val());
        var rate             = getRate(supplierCurrency, bookingCurrency, rateType);
        var calculatedSellingPrice     = 0;
        var calculatedMarkupPercentage = 0;
        var calculatedMarkupAmount     = 0;
        var calculatedProfitPercentage = 0;
        var calculatedMarkupAmountInBookingCurrency  = 0;
        var calculatedEstimatedCostInBookingCurrency = 0;
        var calculatedSellingPriceInBookingCurrency  = 0;

        if (changeFeild == 'estimated_cost') {

            // calculatedProfitPercentage = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedEstimatedCostInBookingCurrency = parseFloat(estimatedCost) * parseFloat(rate);
            $(`#quote_${key}_estimated_cost_in_booking_currency`).val(check(calculatedEstimatedCostInBookingCurrency));

            if(markupType == 'itemised'){

                calculatedMarkupPercentage = parseFloat(markupAmount) / parseFloat(estimatedCost / 100);
                calculatedSellingPrice = parseFloat(markupAmount) + parseFloat(estimatedCost);
                calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);

                $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
                $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
                $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));

            }

        }

        if (changeFeild == 'markup_amount') {

            calculatedSellingPrice = parseFloat(markupAmount) + parseFloat(estimatedCost);
            calculatedMarkupPercentage = parseFloat(markupAmount) / parseFloat(estimatedCost / 100);
            calculatedProfitPercentage = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * rate;
            calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);

            $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
            $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
            $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        }

        if (changeFeild == 'markup_percentage') {

            calculatedMarkupAmount = (parseFloat(estimatedCost) / 100) * parseFloat(markupPercentage);
            calculatedSellingPrice = parseFloat(calculatedMarkupAmount) + parseFloat(estimatedCost);
            calculatedProfitPercentage = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedMarkupAmountInBookingCurrency = parseFloat(calculatedMarkupAmount) * parseFloat(rate);
            calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);

            $(`#quote_${key}_markup_amount`).val(check(calculatedMarkupAmount));
            $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
            $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        }

        getQuoteTotalValues();
    }

    window.getQuoteRateTypeValues = function() {

        var rateType = $("input[name=rate_type]:checked").val();
        var estimatedCostArray = $(".estimated-cost").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var sellingPriceArray = $(".selling-price").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var markupAmountArray = $(".markup-amount").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
        var supplierCurrencyArray = $(".supplier-currency-id").map((i, e) => $(e).find(":selected").data("code")).get();
        var quoteSize = parseInt($('.quote').length);
        var calculatedEstimatedCostInBookingCurrency = 0
        var calculatedSellingPriceInBookingCurrency = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;
        var key = 0;

        while (key < quoteSize) {

            var estimatedCost = estimatedCostArray[key];
            var supplierCurrency = supplierCurrencyArray[key];
            var sellingPrice = sellingPriceArray[key];
            var markupAmount = markupAmountArray[key];

            if (supplierCurrency && bookingCurrency) {

                var rate = getRate(supplierCurrency, bookingCurrency, rateType);
                calculatedEstimatedCostInBookingCurrency = parseFloat(estimatedCost) * parseFloat(rate);
                calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);
                calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);

            } else {

                calculatedSellingPriceInBookingCurrency = parseFloat(0.00);
                calculatedMarkupAmountInBookingCurrency = parseFloat(0.00);
            }

            $(`#quote_${key}_estimated_cost_in_booking_currency`).val(check(calculatedEstimatedCostInBookingCurrency));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
            key++;
        }

        getQuoteTotalValues();
    }

    window.getQuoteSupplierCurrencyValues = function(supplierCurrency, key) {

        var rateType        = $("input[name=rate_type]:checked").val();
        var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
        var estimatedCost   = parseFloat($(`#quote_${key}_estimated_cost`).val()).toFixed(2);
        var markupAmount    = parseFloat($(`#quote_${key}_markup_amount`).val()).toFixed(2);
        var sellingPrice    = parseFloat($(`#quote_${key}_selling_price`).val()).toFixed(2);
        var rate            = getRate(supplierCurrency, bookingCurrency, rateType);
        var calculatedEstimatedCostInBookingCurrency = 0;
        var calculatedMarkupAmountInBookingCurrency  = 0;
        var calculatedSellingPriceInBookingCurrency  = 0;

        calculatedEstimatedCostInBookingCurrency = parseFloat(estimatedCost) * parseFloat(rate);
        calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);
        calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);

        $(`#quote_${key}_estimated_cost_in_booking_currency`).val(check(calculatedEstimatedCostInBookingCurrency));
        $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
        $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
    }

    /*
    |--------------------------------------------------------------------------------
    | Specific Page Script
    |--------------------------------------------------------------------------------
    */

    /* Quote Final page script */
        $("#show_quote :input").prop("disabled", true);
    /* End Quote Final page script */

    /* Quote Version page script */
    $("#version_quote :input").prop("disabled", true);
    $('#recall_version').on('click', function() {

        if ($(this).data('recall')) {
            if (confirm("Are you sure you want to Recall this Quotation?")) {

                $("#version_quote :input").prop("disabled", false);
                $('#recall_version').data('recall', false);
                $(this).html('<i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back Into Version');

                getMarkupTypeFeildAttribute();
            }

        }
        else{

            $("#version_quote :input").prop("disabled", true);
            $('#recall_version').prop("disabled", false);
            $(this).html(`<i class="fa fa-undo-alt"></i>&nbsp;&nbsp;Recall Version`);
        }
    });
    /* End Quote Version page script */


    /*
    |--------------------------------------------------------------------------------
    | Other Functions
    |--------------------------------------------------------------------------------
    */

    $(document).on('change', '.total-markup-change', function() {

        var changeFeild = $(this).attr("data-name");
        getQuoteTotalValuesOnMarkupChange(changeFeild);
    });
    
    $(document).on('submit', "#store_quote", function(event) {

        event.preventDefault();

        var url = $(this).attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                removeFormValidationStyles();
                addFormLoadingStyles();
            },
            success: function(response) {

                removeFormLoadingStyles();
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}quotes/index`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });

    $(document).on('submit', "#update_quote, #version_quote", function(event) {

        event.preventDefault();
        removeDisabledAttribute(".create-template [name=_method]");
     
        var url         = $(this).attr('action');
        var formData    = new FormData(this);
        var full_number = '';
        var agency      = $("input[name=agency]:checked").val();

        if(agency == 0){
            full_number = $('#lead_passenger_contact').closest('.form-group').find("input[name='full_number']").val();
        }else{
            full_number = $('#agency_contact').closest('.form-group').find("input[name='full_number']").val();
        }

        formData.append('full_number', full_number);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                removeFormValidationStyles();
                addFormLoadingStyles();
            },
            success: function(response) {

                removeFormLoadingStyles();
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}quotes/index`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });

    $('.tempalte-id').on('change', function() {

        var templateID = $(this).val();

        $.ajax({
            url: `${BASEURL}template/${templateID}/partial`,
            type: 'get',
            dataType: "json",
            success: function(data) {

                if (data) {
                    if (confirm("Are you sure! you want to override Quote Details?")) {

                        $('#parent').html(data.template_view);

                        $(".select2single").select2({
                            width: "100%",
                            theme: "bootstrap",
                            templateResult: formatState,
                            templateSelection: formatState,
                        });

                        $(`input[name=markup_type][value='${data.template.markup_type}']`).attr('checked', 'checked');
                        $(`input[name=rate_type][value='${data.template.rate_type}']`).attr('checked', 'checked');
                        $(".booking-currency-id").val(data.template.currency_id).change();

                        // make quote section sortable
                        $(function() {
                            $( ".sortable" ).sortable();
                        });

                        getQuoteTotalValues();

                        // jQuery('.note-editor').remove();
                        jQuery('.summernote').summernote({
                            height: 100,   //set editable area's height
                            placeholder: 'Enter Text Here..',
                            codemirror: { // codemirror options
                                theme: 'monokai'
                            },
                        });
                    }
                }

            },
            error: function(reject) {
                console.log(reject);
                // searchRef.text('Search').prop('disabled', false);
            },
        });

    });

    $(document).on('click', '#submit_template', function() {

        disabledFeild(".create-template [name=_method]");

        var templateName  = $('#template_name').val();
        var privacyStatus = $('input[name="privacy_status"]:checked').val();
        var formData      = $('.create-template').serialize() + '&template_name=' + templateName + '&privacy_status=' + privacyStatus ;
        var url           = `${REDIRECT_BASEURL}template/store-for-quote`;

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            beforeSend: function() {

                $('input').removeClass('is-invalid');
                $('.text-danger').html('');
                $("#submit_template").find('span').addClass('spinner-border spinner-border-sm');
            },
            success: function(data) {

                $("#submit_template").find('span').removeClass('spinner-border spinner-border-sm');
                jQuery('#modal-default').modal('hide');

                setTimeout(function() {
                    alert('Template Created Successfully');
                    removeDisabledAttribute(".create-template [name=_method]");
                }, 400);
            },
            error: function(reject) {
                removeDisabledAttribute(".create-template [name=_method]");
                if (reject.status === 422) {
                    var errors = $.parseJSON(reject.responseText);

                    setTimeout(function() {

                        $("#submit_template").find('span').removeClass('spinner-border spinner-border-sm');

                        jQuery.each(errors.errors, function(index, value) {
                            index = index.replace(/\./g, '_');
                            $(`#${index}`).addClass('is-invalid');
                            $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                        });
                    }, 400);
                }
            },
        });

    });

    // Reset Template Modal On Open
    $(document).on('click', '#save_template', function() {

        var modal = jQuery('#modal-default').modal('show');

        modal.find('#template_name').val('');
        modal.find("input[name=privacy_status][value=1]").prop('checked', true);
    });

    $(document).on('submit', "#update-override", function(event) {
        event.preventDefault();

        var $form = $(this),
            url = $form.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#override_submit").find('span').addClass('spinner-border spinner-border-sm');
            },
            success: function(data) {


                if (data.success_message) {

                    // $("#override_submit").find('span').removeClass('spinner-border spinner-border-sm');
                    jQuery('.category-detail-feilds').modal('show');
                }


                // $("#overlay").removeClass('overlay').html('');
                // setTimeout(function() {
                //     alert('Quote updated Successfully');
                //     window.location.href = REDIRECT_BASEURL + "quotes/index";
                // }, 400);
            },
            error: function(reject) {

                if (reject.status === 422) {

                    var errors = $.parseJSON(reject.responseText);


                    setTimeout(function() {
                        $("#overlay").removeClass('overlay').html('');

                        jQuery.each(errors.errors, function(index, value) {

                            index = index.replace(/\./g, '_');
                            $(`#${index}`).addClass('is-invalid');
                            $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                        });

                    }, 400);

                }
            },
        });
    });



    $(document).on('change', '.agency-commission', function() {
        getCalculatedTotalNetMarkup();
        getCommissionRate();
    });

    $(document).on('click', '.quote-bulk-action-item', function() {

        let checkedValues  = $('.child:checked').map((i, e) => e.value ).get();
        let bulkActionType = $(this).data('action_type');
        let message        = "";
        let buttonText     = "";
    
        if(['cancel', 'revert_cancel', 'archive', 'unarchive'].includes(bulkActionType)){

            if(checkedValues.length > 0){
    
                $('input[name="bulk_action_type"]').val(bulkActionType);
                $('input[name="bulk_action_ids"]').val(checkedValues);
    
                switch(bulkActionType) {
                    case "archive":
                        message    = 'You want to Archive Quotes?';
                        buttonText = 'Archive';
                        break;
                    case "unarchive":
                        message    = 'You want to Revert Quotes from Archive?'
                        buttonText = 'Unarchive';
                        break;
                    case "revert_cancel":
                        message    = 'You want to Revert Cancelled Quotes?';
                        buttonText = 'Revert';
                        break;
                    case "cancel":
                        message    = 'You want to Cancel Quotes?';
                        buttonText = 'Cancel';
                }
    
                Swal.fire({
                    title: 'Are you sure?',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: `Yes, ${buttonText} it !`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: $('#quote_bulk_action').attr('action'),
                            data: new FormData($('#quote_bulk_action')[0]),
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(response) {
                                printListingSuccessMessage(response);
                            }
                        });
                    }
                })
            } else {

                printListingErrorMessage("Please Check Atleast One Record.");
            }
        }

        if(['store_group_quote'].includes(bulkActionType)){
                
            if(checkedValues.length > 1){
               
                let checkedBookingCurrency = $('.child:checked').map((i, e) => $(e).data('booking_currency') ).get();

                /* Validate Same Currency */
                if(!validateSameCurrencies(checkedBookingCurrency)){
                    printListingErrorMessage("Quotes Booking Currency should be Same.");
                    return;
                }
                
                $('#store_group_modal').modal('show');
                $('#store_group_modal input[name="bulk_action_ids"]').val(checkedValues);

                $(document).on('submit', '#store_group_modal_form', function(event) {
        
                    event.preventDefault();

                    let formID = $(this).attr('id');
            
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            removeFormValidationStyles();
                            addModalFormLoadingStyles(formID);
                        },
                        success: function(response) {
            
                            removeModalFormLoadingStyles(formID);
                            printModalServerSuccessMessage(response, "#store_group_modal");
                        },
                        error: function(response) {
            
                            removeModalFormLoadingStyles(formID);
                            printModalServerValidationErrors(response);
                        }
                    });
                });

            } else {

                printListingErrorMessage("Please Check Atleast Two Record.");
            }
        } 

    });
});