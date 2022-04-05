$(document).ready(function () {



    $(document).on('change', '.markup-type', function () {
        getMarkupTypeFeildAttribute();
    });

    function reinitializedSummerNote(quoteClass) {

        jQuery(`${quoteClass}`).find('.note-editor').remove();
        jQuery(`${quoteClass}`).find('.summernote').summernote({
            height: 100,   //set editable area's height
            placeholder: 'Enter Text Here..',
            codemirror: { // codemirror options
                theme: 'monokai'
            },
        });
    }


    function getMarkupTypeFeildAttribute() {

        console.log("working");

        var markupType = $("input[name=markup_type]:checked").val();

        if (markupType == 'whole') {

            $('.whole-markup-feilds').addClass('d-none');
            $('.total-markup-amount').removeAttr('readonly');
            $('.total-markup-percent').removeAttr('readonly');
            getQuoteTotalValues();

        } else if (markupType == 'itemised') {

            $('.whole-markup-feilds').removeClass('d-none');
            $('.total-markup-amount').prop('readonly', true);
            $('.total-markup-percent').prop('readonly', true);
            getQuoteTotalValues();
        }
    }


    $(document).on('click', '.remove-quote-detail-service', function (e) {
        e.preventDefault();

        if (confirm("Are you sure you want to Remove this Service?") == true) {
            $(this).closest(".quote").remove();

            getQuoteTotalValues();
        }
    });


    $(document).on("keyup change", '.change-calculation', function (event) {
        var key = $(this).closest('.quote').data('key');
        var changeFeild = $(this).attr("data-name");
        getQuoteDetailsValues(key, changeFeild);
    });

    $(document).on('change', '.supplier-currency-id', function () {

        var code = $(this).find(':selected').data('code');
        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');
        var bookingCurrency = $('#currency_id').val();
        var currency_name = $(this).find(':selected').attr('data-name');
        var supplierCurrency = $(this).val();


        if (typeof supplierCurrency === 'undefined' || supplierCurrency == "") {
            quote.find("[class*=supplier-currency-code]").html("");
            quote.find('.badge-supplier-currency-id').html("");
            return;
        }

        if (typeof bookingCurrency === 'undefined' || bookingCurrency == "") {
            alert("Please Select Booking Currency first");
            return;
        }

        quote.find("[class*=supplier-currency-code]").html(code);
        quote.find('.badge-supplier-currency-id').html(currency_name);
        // quote.find('.badge-supplier-currency-id').removeClass('d-none');

        getQuoteSupplierCurrencyValues(code, quoteKey);
        getQuoteTotalValues();
    });

    $(document).on('click', '.quotes-service-category-btn-below', function (e) {

        e.preventDefault();

        var category_id = $(this).attr('data-id');
        var category_name = $(this).attr('data-name');

        var currentQuoteKey = jQuery('#new_service_modal_below').find('.current-key').val();
        var onQuoteClass = `.quote-${currentQuoteKey}`;

        jQuery('#new_service_modal_below').modal('hide');
        $('.parent-spinner').addClass('spinner-border');

        if (category_id) {

            setTimeout(function () {

                destroySingleSelect2();
                destroyMultipleSelect2();

                var quote = $(".quote").eq(0).clone()
                    .find("input").val("").each(function () {
                        this.name = this.name.replace(/\[(\d+)\]/, function () {

                            let quoteLength = $('.quote').length;
                            return `[${quoteLength}]`;

                        });
                        this.id = this.id.replace(/\d+/g, $('.quote').length, function () {

                            let quoteLength = $('.quote').length;
                            let dataName = $(this).attr("data-name");

                            return `quote_${quoteLength}_${dataName}`;

                        });
                    }).end()
                    .find("textarea").val("").each(function () {
                        this.name = this.name.replace(/\[(\d+)\]/, function () {

                            let quoteLength = $('.quote').length;
                            return `[${quoteLength}]`;
                        });
                        this.id = this.id.replace(/\d+/g, $('.quote').length, function () {

                            let quoteLength = $('.quote').length;
                            let dataName = $(this).attr("data-name");

                            return `quote_${quoteLength}_${dataName}`;
                        });
                    }).end()
                    .find("select").val("").each(function () {
                        this.name = this.name.replace(/\[(\d+)\]/, function () {

                            let quoteLength = $('.quote').length;
                            return `[${quoteLength}]`;
                        });
                        this.id = this.id.replace(/\d+/g, $('.quote').length, function () {

                            let quoteLength = $('.quote').length;
                            let dataName = $(this).attr("data-name");
                            return `quote_${quoteLength}_${dataName}`;

                        });
                    }).end().show().insertAfter(onQuoteClass);

                var quoteLength = $('.quote').length;
                var quoteKey = quoteLength - 1;
                var quoteClass = `.quote-${quoteKey}`;

                quote.attr('data-key', quoteKey);
                quote.removeClass(`quote-0`);
                quote.addClass(`quote-${quoteKey}`);
                quote.find('.prod-feild-col').remove();

                // $(`#quote_${quoteKey}_date_of_service`).val(todayDate());
                $(`#quote_${quoteKey}_estimated_cost, #quote_${quoteKey}_markup_amount`).val('0.00');
                $(`#quote_${quoteKey}_markup_percentage, #quote_${quoteKey}_selling_price`).val('0.00');
                $(`#quote_${quoteKey}_profit_percentage, #quote_${quoteKey}_estimated_cost_in_booking_currency`).val('0.00');
                $(`#quote_${quoteKey}_markup_amount_in_booking_currency, #quote_${quoteKey}_selling_price_in_booking_currency`).val('0.00');
                // $(`#quote_${quoteKey}_table_name`).val('QuoteDetail');
                $(`${quoteClass} .card-header .card-title .badge-info`).html('');
                $(`${quoteClass}`).find('.supplier-id').html("<option value=''>Select Supplier</option>");
                $(`${quoteClass}`).find('.text-danger, .supplier-currency-code').html('');
                $(`${quoteClass}`).find('input, select').removeClass('is-invalid');
                $(`${quoteClass}`).find('.card-header .card-tools .remove').addClass('remove-quote-detail-service');
                $(`${quoteClass}`).find('.card-header .card-tools .remove').removeClass('d-none');
                $(`${quoteClass}`).find('.refundable-percentage-feild').addClass('d-none');
                $(`${quoteClass}`).find('.category-id').val(category_id).change();
                $(`${quoteClass}`).find('.badge-category-id').html(category_name);
                $(`${quoteClass}`).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').html('');
                // $(`${quoteClass}`).find('.badge-date-of-service').html(todayDate());

                $(`${quoteClass}`).find('.fileManger').attr('data-input', `quote_${quoteKey}_image`);
                $(`${quoteClass}`).find('.fileManger').attr('data-preview', `quote_${quoteKey}_holder`);
                $(`${quoteClass}`).find('.previewId').attr('id', `quote_${quoteKey}_holder`);
                $(`#quote_${quoteKey}_holder`).empty();

                $(`${quoteClass}`).find('.supplier-currency-id').val($('.default-supplier-currency-id').val()).change();


                callLaravelFileManger();
                datepickerReset(1, `${quoteClass}`);

                reinitializedSummerNote(`${quoteClass}`);
                reinitializedSingleSelect2();
                reinitializedMultipleSelect2();

                /* Set last End Date of Service */
                var endDateOfService = $(`#quote_${currentQuoteKey}_end_date_of_service`).val();
                $(`#quote_${quoteKey}_date_of_service`).datepicker("setDate", endDateOfService);

                // var currentDate = convertDate(endDateOfService);
                // console.log("New Date "+currentDate);

                // $(`#quote_${quoteKey}_date_of_service`).datepicker("setDate", currentDate);
                // $(`#quote_${quoteKey}_date_of_service`).datepicker({
                //     format: 'dd-mm-yyyy',
                //     autoclose: true,
                // })
                // $(`#quote_${quoteKey}_date_of_service`).datepicker('setDate', currentDate);

                // var currentDate = $(`#quote_${quoteKey}_end_date_of_service`).datepicker('setStartDate', currentDate);
                // console.log(currentDate);

                // set default supplier country
                let supplier_country_ids = $(`#quote_0_supplier_country_ids`).val();
                $(`#quote_${quoteKey}_supplier_country_ids`).val(supplier_country_ids).change();

                $('html, body').animate({ scrollTop: $(quoteClass).offset().top }, 1000);
                $('.parent-spinner').removeClass('spinner-border');

            }, 180);

        }


    });

    $(document).on('click', '.quotes-service-category-btn', function (e) {

        e.preventDefault();

        var category_id = $(this).attr('data-id');
        var category_name = $(this).attr('data-name');
        let beforeAppendLastQuoteKey = $(".quote").last().data('key');

        jQuery('#new_service_modal').modal('hide');
        $('.parent-spinner').addClass('spinner-border');

        if (category_id) {

            setTimeout(function () {

                destroySingleSelect2();
                destroyMultipleSelect2();

                var quote = $(".quote").eq(0).clone()
                    .find("input").val("").each(function () {
                        this.name = this.name.replace(/\[(\d+)\]/, function () {

                            let quoteLength = $('.quote').length;
                            return `[${quoteLength}]`;

                        });
                        this.id = this.id.replace(/\d+/g, $('.quote').length, function () {

                            let quoteLength = $('.quote').length;
                            let dataName = $(this).attr("data-name");

                            return `quote_${quoteLength}_${dataName}`;

                        });
                    }).end()
                    .find("textarea").val("").each(function () {
                        this.name = this.name.replace(/\[(\d+)\]/, function () {

                            let quoteLength = $('.quote').length;
                            return `[${quoteLength}]`;
                        });
                        this.id = this.id.replace(/\d+/g, $('.quote').length, function () {

                            let quoteLength = $('.quote').length;
                            let dataName = $(this).attr("data-name");

                            return `quote_${quoteLength}_${dataName}`;
                        });
                    }).end()
                    .find("select").val("").each(function () {
                        this.name = this.name.replace(/\[(\d+)\]/, function () {

                            let quoteLength = $('.quote').length;
                            return `[${quoteLength}]`;
                        });
                        this.id = this.id.replace(/\d+/g, $('.quote').length, function () {

                            let quoteLength = $('.quote').length;
                            let dataName = $(this).attr("data-name");
                            return `quote_${quoteLength}_${dataName}`;

                        });
                    }).end().show().insertAfter(".quote:last");

                var quoteLength = $('.quote').length;
                var quoteKey = quoteLength - 1;
                var quoteClass = `.quote-${quoteKey}`;

                quote.attr('data-key', quoteKey);
                quote.removeClass(`quote-0`);
                quote.addClass(`quote-${quoteKey}`);
                quote.find('.prod-feild-col').remove();

                // $(`#quote_${quoteKey}_date_of_service`).val(todayDate());
                $(`#quote_${quoteKey}_estimated_cost, #quote_${quoteKey}_markup_amount`).val('0.00');
                $(`#quote_${quoteKey}_markup_percentage, #quote_${quoteKey}_selling_price`).val('0.00');
                $(`#quote_${quoteKey}_profit_percentage, #quote_${quoteKey}_estimated_cost_in_booking_currency`).val('0.00');
                $(`#quote_${quoteKey}_markup_amount_in_booking_currency, #quote_${quoteKey}_selling_price_in_booking_currency`).val('0.00');
                // $(`#quote_${quoteKey}_table_name`).val('QuoteDetail');
                $(`${quoteClass} .card-header .card-title .badge-info`).html('');
                $(`${quoteClass}`).find('.supplier-id').html("<option value=''>Select Supplier</option>");
                $(`${quoteClass}`).find('.text-danger, .supplier-currency-code').html('');
                $(`${quoteClass}`).find('input, select').removeClass('is-invalid');
                $(`${quoteClass}`).find('.card-header .card-tools .remove').addClass('remove-quote-detail-service');
                $(`${quoteClass}`).find('.card-header .card-tools .remove').removeClass('d-none');
                $(`${quoteClass}`).find('.refundable-percentage-feild').addClass('d-none');
                $(`${quoteClass}`).find('.category-id').val(category_id).change();
                $(`${quoteClass}`).find('.badge-category-id').html(category_name);
                $(`${quoteClass}`).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').html('');
                // $(`${quoteClass}`).find('.badge-date-of-service').html(todayDate());

                $(`${quoteClass}`).find('.fileManger').attr('data-input', `quote_${quoteKey}_image`);
                $(`${quoteClass}`).find('.fileManger').attr('data-preview', `quote_${quoteKey}_holder`);
                $(`${quoteClass}`).find('.previewId').attr('id', `quote_${quoteKey}_holder`);
                $(`#quote_${quoteKey}_holder`).empty();

                $(`${quoteClass}`).find('.supplier-currency-id').val($('.default-supplier-currency-id').val()).change();


                callLaravelFileManger();
                datepickerReset(1, `${quoteClass}`);

                reinitializedSummerNote(`${quoteClass}`);
                reinitializedSingleSelect2();
                reinitializedMultipleSelect2();

                /* Set last End Date of Service */
                var endDateOfService = $(`#quote_${beforeAppendLastQuoteKey}_end_date_of_service`).val();
                $(`#quote_${quoteKey}_date_of_service`).datepicker("setDate", endDateOfService);

                // var stringDate = convertDate(endDateOfService);
                // console.log("Add More "+stringDate);
                // quote_8_end_date_of_service
                // var stringDate = $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setStartDate", stringDate);
                // console.log(stringDate);


                // set default supplier country
                let supplier_country_ids = $(`#quote_0_supplier_country_ids`).val();
                $(`#quote_${quoteKey}_supplier_country_ids`).val(supplier_country_ids).change();

                $('html, body').animate({ scrollTop: $('.quote:last').offset().top }, 1000);
                $('.parent-spinner').removeClass('spinner-border');

            }, 180);

        }
    });


    callLaravelFileManger();
    function callLaravelFileManger() {
        var route_prefix = FILE_MANAGER_URL;
        jQuery('.fileManger').filemanager('image', { prefix: route_prefix });
    }

    /* Quote Medial Modal  */
    $(document).on('click', '.QuotemediaModalClose', function () {
        $(this).closest('.modal-body').children('.input-group').find('input').val("");
        $(this).closest('.modal-body').children('.previewId').find('img').remove();
        jQuery('.modal').modal('hide');
    });

    /* Remove Image in Medial Modal  */
    $(document).on('click', '.remove-img', function () {

        // $('#previewId').html(`<img src="" class="img-fluid"></img>`);
        $(this).closest('.modal-body').children('.input-group').find('input').val("");
        $(this).parent().html(`<img src="" class="img-fluid">`);
        // console.log($(this).closest('.modal-body').find('.image').html());
    });

});