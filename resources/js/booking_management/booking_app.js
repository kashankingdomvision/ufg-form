$(document).ready(function() {

    tourContactAutoCompleteInitialize();

    function tourContactAutoCompleteInitialize(){
        $(".tour-contact").autocomplete({
            source: `${BASEURL}get-tour-contacts`,
        });
    }

    function tourContactAutoCompleteDestroy(){
        $( ".tour-contact" ).autocomplete( "destroy" );
    }

    $('#version_booking :input').prop('disabled', true);
    $('#show_booking :input').attr('disabled', 'disabled');
    $('#show_booking .cancellation-refund-payment-row :input').removeAttr('disabled');
    $('#show_booking button[type="submit"], #show_booking #show_booking_submit, #add_more_cancellation_payments').removeAttr('disabled');


    var pageStatus = $('#show_booking').data('page_status');

    if(typeof pageStatus !== 'undefined' && pageStatus != ""){

        $('.finance :input').removeAttr('disabled');


        $('.refund-by-bank-section :input').removeAttr('disabled');
        $('.refund-by-credit-note-section :input').removeAttr('disabled');
        $('button[type="submit"]').removeAttr('disabled');

        $('.cancel-payemnt-btn .btn').removeAttr('disabled');
        $('.clone_booking_finance').removeAttr('disabled');
    }


 
    function getBookingMarkupTypeFeildAttribute(){

        var markupType = $("input[name=markup_type]:checked").val();

        if(markupType == 'whole'){

            $('.booking-whole-markup-feilds').addClass('d-none');
            $('.total-markup-amount').removeAttr('readonly');
            $('.total-markup-percent').removeAttr('readonly');
            getBookingTotalValues();

        }else if(markupType == 'itemised'){

            $('.booking-whole-markup-feilds').removeClass('d-none');
            $('.total-markup-amount').prop('readonly', true);
            $('.total-markup-percent').prop('readonly', true);  
            getBookingTotalValues();
        }
    }

    function getBookingTotalValuesOnMarkupChange(changeFeild){

        var totalNetPrice                   = 0;
        var totalMarkupAmount               = 0;
        var markupPercentage                = 0;
        var calculatedTotalMarkupPercentage = 0;
        var totalSellingPrice               = 0;
        var calculatedTotalMarkupAmount     = 0;
        var calculatedProfitPercentage      = 0;

        totalNetPrice               = removeComma($('.total-net-price').val());
        totalMarkupAmount           = removeComma($('.total-markup-amount').val());
        markupPercentage            = removeComma($('.total-markup-percent').val());

        if(changeFeild == 'total_markup_amount'){

            calculatedTotalMarkupPercentage = parseFloat(totalMarkupAmount) / parseFloat(totalNetPrice / 100);
            totalSellingPrice               = parseFloat(totalNetPrice) + parseFloat(totalMarkupAmount);

            $('.total-markup-percent').val((calculatedTotalMarkupPercentage).toFixed(2));
            $('.total-selling-price').val(check(totalSellingPrice));
        }

        if(changeFeild == 'total_markup_percent'){

            calculatedTotalMarkupAmount = (parseFloat(totalNetPrice) / 100) * parseFloat(markupPercentage);
            totalSellingPrice           = parseFloat(totalNetPrice) + parseFloat(calculatedTotalMarkupAmount);

            $('.total-markup-amount').val(check(calculatedTotalMarkupAmount));
            $('.total-selling-price').val(check(totalSellingPrice));
        }

        calculatedProfitPercentage = ((parseFloat(totalSellingPrice) - parseFloat(totalNetPrice)) / parseFloat(totalSellingPrice)) * 100;
        $('.total-profit-percentage').val(check(calculatedProfitPercentage));

        getCommissionRate();
        getBookingAmountPerPerson();
        getCalculatedTotalNetMarkup();
        getSellingPrice();
    }


    $(document).on('click', '.increment', function() {

        var close = $(this).closest('.finance-clonning');

        var valueElement = close.find('.ab_number_of_days');
        var dueDate = close.find('.deposit-due-date').val();
        var nowDate = todayDate();
        const firstDate = new Date(dueDate);
        const secondDate = convertDate(nowDate);

        if (firstDate == 'Invalid Date') {
            alert('Due Date is Required');
        } else {
            if (!$(valueElement).is('[readonly]')) {
                const oneDay = 24 * 60 * 60 * 1000;
                const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
                if (firstDate < secondDate) {
                    $(this).attr('disabled', true);
                } else {
                    if (valueElement.val() == '') {
                        valueElement.val(0);
                    }
                    var count = Math.max(parseInt(valueElement.val() ?? 0));
                    var diffcount = diffDays - valueElement.val();
                    var b = 1;
                    if ($(this).hasClass('plus')) {
                        if (diffcount < 1) {
                            close.find('.plus').attr('disabled', true);
                        } else {
                            count = count + b;
                            valueElement.val(count);
                        }
                    } else if (valueElement.val() > 0) // Stops the value going into negatives
                    {
                        close.find('.plus').attr('disabled', false);
                        count -= b;
                        valueElement.val(count);
                    }
                }
            }
        }
        return false;
    });

    $(document).on('change', '.deposit-due-date', function() {
        var close = $(this).closest('.finance-clonning');
        close.find('.plus').removeAttr('disabled');
    });

    // for booking
    $(document).on('change', '.booking-total-markup-change', function() {

        var changeFeild = $(this).attr("data-name");
        getBookingTotalValuesOnMarkupChange(changeFeild);

    });

    $(document).on('change', '.booking-markup-type', function() {
        getBookingMarkupTypeFeildAttribute();
    });


    // booking update payment
    $(document).on('submit', '#show_booking', function(event) { 

        event.preventDefault();

        $('#show_booking :input').prop('disabled', false);

        let url    = $(this).attr('action');
        let formID = $(this).attr('id');

        /* Send the data using post */
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
                printServerSuccessMessage(response, `#${formID}`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                stickyValidationErrors(response);
                printServerValidationErrors(response);
            }
        });
    });

    $("#update_booking").submit(function(event) {
        event.preventDefault();

        $('.payment-method').removeAttr('disabled');

        let url         = $(this).attr('action');
        let formID      = $(this).attr('id');
        var formData    = new FormData(this);
        var agency      = $("input[name=agency]:checked").val();
        var full_number = '';

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
                printServerSuccessMessage(response, `#${formID}`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                stickyValidationErrors(response);
                printServerValidationErrors(response);
            }
        });
    });

    $(document).on('click', '#store_booking_submit', function(event) { 

        event.preventDefault();

        $('.payment-method').removeAttr('disabled');

        let url         = $('#update_booking').attr('action');
        var formData    = new FormData($('#update_booking')[0]);
        var agency      = $("input[name=agency]:checked").val();
        var full_number = '';

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
                printAlertResponse(response);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                stickyValidationErrors(response);
                printServerValidationErrors(response);
            }
        });
    });

    $(document).on('click', '#show_booking_submit', function(event) { 

        event.preventDefault();

        $('#show_booking :input').prop('disabled', false);

        let url = $('#show_booking').attr('action');

        /* Send the data using post */
        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData($('#show_booking')[0]),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                removeFormValidationStyles();
                addFormLoadingStyles();
            },
            success: function(response) {

                removeFormLoadingStyles();
                printAlertResponse(response);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                stickyValidationErrors(response);
                printServerValidationErrors(response);
            }
        });
    });


    $(document).on('change', '.cancellation-refund-amount', function() {

        var cancellationRefundAmount = removeComma($(this).val());
        var cancellationRefundTotalAmount = removeComma($('#cancellation_refund_total_amount').val());

        // console.log(" cancellationRefundAmount: " + cancellationRefundAmount);
        // console.log(" cancellationRefundTotalAmount: " + cancellationRefundTotalAmount);

        var totalCancellationRefundAmountArray = $('.cancellation-payments').find('.cancellation-refund-amount').map((i, e) => parseFloat(removeComma(e.value))).get();
        var totalCancellationRefundAmount = totalCancellationRefundAmountArray.reduce((a, b) => (a + b), 0);

        if (totalCancellationRefundAmount > cancellationRefundTotalAmount) {

            Toast.fire({
                icon: 'warning',
                title: "Please Enter Correct Refund Amount."
            });

            $(this).val("0.00");
        }

    });

    
    $(document).on('click', '.add-more-cancellation-payments', function() {

        destroySingleSelect2();

        var cancellationPayments = $('.cancellation-payments');
        var cancellationRefundPaymentRow = $(".cancellation-refund-payment-row").length;

        cancellationPayments.find('.cancellation-refund-payment-row').first().clone().find("input").val("").each(function() {

                let name = $(this).attr("data-name");

                this.name = this.name.replace(/\[(\d+)\]/, function() {
                    return `[${cancellationRefundPaymentRow}]`
                });

                this.id = this.id.replace(/\d+/g, cancellationRefundPaymentRow, function() {
                    return `cancellation_refund_${cancellationRefundPaymentRow}_${name}`
                });

            }).end().find('.cancellation-refund-payment-label').each(function() {

                this.id = `cancellation_refund_payment_label_${cancellationRefundPaymentRow}`;
                $(this).text(`Refund Amount #${cancellationRefundPaymentRow+1}`);

            }).end()
            .find("select").val("").each(function() {

                let name = $(this).attr("data-name");

                this.name = this.name.replace(/\[(\d+)\]/, function() {
                    return `[${cancellationRefundPaymentRow}]`
                });

                this.id = this.id.replace(/\d+/g, cancellationRefundPaymentRow, function() {
                    return `cancellation_refund_${cancellationRefundPaymentRow}_${name}`
                });

            }).end().find('.select2single').select2({
                width: '100%',
                theme: "bootstrap",
            }).end()
            .show()
            .insertAfter($('.cancellation-refund-payment-row:last'));

        // set feild after clone
        // quote.find('.finance-clonning:last .checkbox').prop('checked', false);
        // quote.find('.finance-clonning:last .deposit-amount').val('0.00').attr("readonly", false);
        // quote.find('.finance-clonning:last .ab_number_of_days').val('0').attr("readonly", false);
        // quote.find('.finance-clonning:last').attr('data-financekey',financeCloningLength);
        cancellationPayments.find('.cancellation-refund-payment-row:last .cancellation-refund-payment-row-remove-btn').removeClass('d-none');

        reinitializedSingleSelect2();
    });


    
    $(document).on('click', '.clone_booking_finance', function() {

        destroySingleSelect2();

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');
        var financeCloningLength = quote.find(".finance-clonning").length;

        quote.find('.finance-clonning').first().clone().find("input").val("").each(function() {

                let n = 1;
                let name = $(this).attr("data-name");

                this.name = this.name.replace(/]\[(\d+)]/g, function() {
                    return `][${financeCloningLength}]`;
                });

                this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? financeCloningLength : v, function() {
                    return `quote_${quoteKey}_finance_${financeCloningLength}_${name}`;
                });

                if(this.type == 'checkbox')
                    $(this).val('0');
                

            }).end().find('.depositeLabel').each(function() {

                this.id = 'deposite_heading' + financeCloningLength;
                $(this).text(`Payment #${financeCloningLength+1}`);

            }).end()
            .find('.finance-custom-control-label').each(function() {

                let name = $(this).attr("data-name");

                $(this).attr('for', `quote_${quoteKey}_finance_${financeCloningLength}_${name}`);

            }).end()
            .find("select").val("").each(function() {

                let n = 1;
                let name = $(this).attr("data-name");

                this.name = this.name.replace(/]\[(\d+)]/g, function() {
                    return `][${financeCloningLength}]`;
                });

                this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? financeCloningLength : v, function() {
                    return `quote_${quoteKey}_finance_${financeCloningLength}_${name}`;
                });

            }).end().find('.select2single').select2({
                width: '100%',
                theme: "bootstrap",
            }).end()
            .show()
            .insertAfter(quote.find('.finance-clonning:last'));

        // set feild after clone
        quote.find('.finance-clonning:last .checkbox').prop('checked', false);
        quote.find('.finance-clonning:last .deposit-amount').val('0.00').attr("readonly", false);
        quote.find('.finance-clonning:last .ab_number_of_days').val('0').attr("readonly", false);
        quote.find('.finance-clonning:last').attr('data-financekey', financeCloningLength);

        reinitializedSingleSelect2();
    });

    $(document).on('submit', '#cancel_booking_submit', function(event) {

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
                addModalFormLoadingStyles(`#${formID}`);
            },
            success: function(response) {

                removeModalFormLoadingStyles(`#${formID}`);
                printModalServerSuccessMessage(response, "#store_booking_cancellation_modal");
            },
            error: function(response) {

                removeModalFormLoadingStyles(`#${formID}`);
                printModalServerValidationErrors(response, `#${formID}`);
            }
        });

    });

    $(document).on('click', '.remove-booking-detail-service', function(e) {
        e.preventDefault();

        if( confirm("Are you sure you want to Remove this Service?") == true){
            $(this).closest(".quote").remove();

            getBookingTotalValues();
        }
    });

    $(document).on('click', '.revert-booking-detail-cancellation', function(e) {
        e.preventDefault();

        var booking_detail_id       = $(this).attr('data-bookingDetialID');

        if( confirm("Are you sure you want to Revert Cancelled Service?") == true){

            $.ajax({
                headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                url: `${REDIRECT_BASEURL}bookings/revert-booking-detail-cancellation/${booking_detail_id}`,
                type: 'GET',
                success: function(data) {

                    setTimeout(function() {

                        if (data.success_message) {
                            alert(data.success_message);
                            location.reload();
                        }

                    }, 100);

                },
                error: function(reject) {}
            });

        }

    });

    $(document).on('click', '.booking-detail-cancellation', function(e) {
        e.preventDefault();

        var booking_detail_id       = $(this).attr('data-bookingDetialID');

        var quote      = jQuery(this).closest('.quote');
        var quoteKey   = quote.data('key');
        var created_by = $(`#quote_${quoteKey}_created_by`).val();

        var data = {
            booking_detail_id       : booking_detail_id,
            booking_cancelled_by_id : created_by
        };

        if( confirm("Are you sure you want to Cancel this Service?") == true){

            $.ajax({
                headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                url: `${REDIRECT_BASEURL}bookings/booking-detail-cancellation`,
                type: 'POST',
                data: data,
                success: function(data) {

                    setTimeout(function() {

                        if (data.success_message) {
                            alert(data.success_message);
                            location.reload();
                        }

                    }, 100);

                },
                error: function(reject) {}
            });

        }
    });

    // also used in customer booking
    $(document).on('click', '.cancel-booking', function(e) {

        e.preventDefault();


        if (confirm("Are you sure you want to Cancel Booking?") == true) {

            var booking_id = $(this).attr('data-bookingid');
            jQuery('#cancel_booking').modal('show');

            $.ajax({
                headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                url: `${REDIRECT_BASEURL}bookings/get-booking-net-price/${booking_id}`,
                type: 'get',
                success: function(data) {

                    // console.log(data);

                    if (data !== null && data !== '' && data !== undefined) {

                        jQuery('#cancel_booking').modal('show').find('#booking_currency_id').val(data.booking_currency_id);
                        jQuery('#cancel_booking').modal('show').find('#booking_net_price').val(data.booking_net_price);
                        jQuery('#cancel_booking').modal('show').find('#booking_net_price_text').text(`Cancellation Charges should not be greater ${data.booking_net_price} ${data.booking_currency_code}`);
                        jQuery('#cancel_booking').modal('show').find('#booking_id').val(booking_id);
                        jQuery('#cancel_booking').modal('show').find('#booking_currency_code').text(data.booking_currency_code);
                    }

                },
                error: function(reject) {}
            });

        }
    });

    $(document).on('click', ".multiple-alert", function(event) {

        let url        = $(this).data('action');
        let actionType = $(this).data('action_type');
        let message    = "";
        let buttonText = "";

        switch(actionType) {

            case "cancel_booking":
                message    = 'You want to Cancel this Booking?';
                buttonText = 'Cancel';
                break;

            case "restore_booking":
                message    = 'You want to Restore this Booking?';
                buttonText = 'Restore';
                break;

            case "edit_booking":
                message    = 'You want to Edit this Booking?';
                buttonText = 'Edit';
                break;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: `Yes, ${buttonText} it !`,
        }).then((result) => {
            if (result.isConfirmed) {

                if(actionType == "cancel_booking"){

                    let booking_id = $(this).data('booking_id');
                    let modal      = $('#store_booking_cancellation_modal');
        
                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                        url: `${REDIRECT_BASEURL}bookings/get-booking-net-price/${booking_id}`,
                        type: 'get',
                        success: function(data) {
        
                            if (data !== null && data !== '' && data !== undefined) {
                                
                                modal.modal('show');
                                modal.find('#cancel_booking_submit').attr("action", data.form_action);
                                modal.find('#booking_currency_id').val(data.booking_currency_id);
                                modal.find('#booking_net_price').val(data.booking_net_price);
                                modal.find('#booking_net_price_text').text(`Cancellation Charges should not be greater ${data.booking_net_price} ${data.booking_currency_code}`);
                                modal.find('#booking_id').val(booking_id);
                                modal.find('#action_type').val(actionType);
                                modal.find('#booking_currency_code').text(data.booking_currency_code);
                            }
        
                        },
                        error: function(reject) {}
                    });
                }

                if(actionType == "restore_booking"){

                    $.ajax({
                        type: 'PATCH',
                        url: url,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            printAlertResponse(response);
                        }
                    });
                }

                if(actionType == "edit_booking"){
                    $('#show_booking :input').removeAttr('disabled');
                }
            }
        });
    });

    $(document).on('click', ".booking-detail-status", function(event) {

        let url        = $(this).data('action');
        let actionType = $(this).data('action_type');
        let message    = "";
        let buttonText = "";

        switch(actionType) {

            case "not_booked":
                message    = 'You want to Change Status "Not Booked" for this Service?';
                buttonText = 'Update';
                break;

            case "pending":
                message    = 'You want to Change Status "Pending" for this Service?';
                buttonText = 'Update';
                break;

            case "booked":
                message    = 'You want to Change Status "Booked" for this Service?';
                buttonText = 'Update';
                break;

            case "cancelled":
                message    = 'You want to Change Status "Cancelled" for this Service?';
                buttonText = 'Update';
                break;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: `Yes, ${buttonText} it !`,
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: 'PATCH',
                    url: url,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        printAlertResponse(response);
                    }
                });
            }
        });
    });

    $(document).on('click', '.view-payment_detail', function() {

        var details = $(this).data('details');
        var tbody = '';
        var client_type = details.client_type == 1 ? 'Client' : 'Agency';
        var payment_method = '';
        if (details.payment_type_id == 1) {
            payment_method = 'Bank';
        } else if (details.payment_type_id == 2) {
            payment_method = 'Paysafe';
        } else {
            payment_method = '';
        }

        tbody += `<tr>
            <th>Ref #</th>
            <td>${isEmpty(details.zoho_booking_reference)}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>${(isEmpty(details.status))}</td>
        </tr>
        <tr>
            <th>Payment For</th>
            <td>${isEmpty(details.payment_for)}</td>
        </tr>
        <tr>
            <th>Payment Method</th>
            <td>${isEmpty(payment_method)}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>${isEmpty(details.date)}</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td>${isEmpty(details.amount)}</td>
        </tr>
        <tr>
            <th>Type</th>
            <td>${isEmpty(client_type)}</td>
        </tr>
        <tr>
            <th>Ref ID</th>
            <td>${isEmpty(details.ref_id)}</td>
        </tr>
        <tr>
            <th>Card Holder Name</th>
            <td>${isEmpty(details.card_holder_name)}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>${isEmpty(details.b_street_address)}</td>
        </tr>
        <tr>
            <th>Post Code</th>
            <td>${isEmpty(details.b_zip_code)}</td>
        </tr>
        <tr>
            <th>Note</th>
            <td>${isEmpty(details.note)}</td>
        </tr>
        <tr>
            <th>Sort Code</th>
            <td>${isEmpty(details.sort_code)}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>${isEmpty(details.created_at)}</td>
        </tr>
        <tr>
            <th>Amount Payable</th>
            <td>${isEmpty(details.amount_payable)}</td>
        </tr>`;

        jQuery('#payment_details_modal').modal('show');
        jQuery('#payment_details_modal_body').html(tbody);
    });

    $(document).on('change', '.cal_selling_price', function() {

        var key = $(this).closest('.quote').data('key');
        var changeFeild = 'estimated_cost';

        if ($(this).is(':checked')) {
            $(`#quote_${key}_markup_amount`).attr("readonly", false);
            $(`#quote_${key}_markup_percentage`).attr("readonly", false);
            $(`#quote_${key}_actual_cost`).attr("data-status", "");

        } else {
            $(`#quote_${key}_markup_amount`).attr("readonly", true);
            $(`#quote_${key}_markup_percentage`).attr("readonly", true);
            $(`#quote_${key}_actual_cost`).attr("data-status", "booking");;
        }
    });

    
    $(document).on("keyup change", '.change', function(event) {

        var key = $(this).closest('.quote').data('key');
        var changeFeild = $(this).attr("data-name");
        var cal_selling_price = $('.cal_selling_price').is(':checked');
        var status = $(this).attr("data-status");

        if (status && status == 'booking' && cal_selling_price == false) {
            getBookingDetailValues(key);

        } else {
            getQuoteDetailValuesForBooking(key, changeFeild);
        }

    });

    $(document).on('click', '.bookings-service-category-btn', function(e) {

        e.preventDefault();

        var category_id   = $(this).attr('data-id');
        var category_name = $(this).attr('data-name');
        let beforeAppendLastQuoteKey = $(".quote").last().data('key');

        jQuery('#new_service_modal').modal('hide');
        $('.parent-spinner').addClass('spinner-border');

        if(category_id){

            setTimeout(function() {

                destroySingleSelect2();
                destroyMultipleSelect2();
                tourContactAutoCompleteDestroy();

                var quote = $(".quote").eq(0).clone()
                    .find("input").val("").each(function() {
                        this.name = this.name.replace(/\[(\d+)\]/, function() {
                            let quoteLength = $('.quote').length;
                            return `[${quoteLength}]`;
                        });
                        this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                            let quoteLength = $('.quote').length;
                            let dataName    = $(this).attr("data-name");
                            return `quote_${quoteLength}_${dataName}`;
                        });
                    }).end()
                    .find("textarea").val("").each(function() {
                        this.name = this.name.replace(/\[(\d+)\]/, function() {
                            let quoteLength = $('.quote').length;
                            return `[${quoteLength}]`;
                        });
                        this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                            let quoteLength = $('.quote').length;
                            let dataName = $(this).attr("data-name");
                            return `quote_${quoteLength}_${dataName}`;
                        });
                    }).end()
                    .find("select").val("").each(function() {
                        this.name = this.name.replace(/\[(\d+)\]/, function() { 
                            let quoteLength = $('.quote').length;
                            return `[${quoteLength}]`;
                        });
                        this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                            let quoteLength = $('.quote').length;
                            let dataName = $(this).attr("data-name");
                            return `quote_${quoteLength}_${dataName}`;
                        });
                    }).end().show().insertAfter(".quote:last");

                var quoteLength = $('.quote').length;
                var quoteKey    = quoteLength - 1;
                var quoteClass = `.quote-${quoteKey}`;

                quote.attr('data-key', quoteKey);
                quote.removeClass(`quote-0`);
                quote.addClass(`quote-${quoteKey}`);
                quote.find('.prod-feild-col').remove();

                $(`${quoteClass}`).find('.finance .row:not(:first):not(:last)').remove();
                $(`${quoteClass}`).find('.actual-cost').attr("data-status", "");
                $(`${quoteClass}`).find('.markup-amount').attr("readonly", false);
                $(`${quoteClass}`).find('.markup-percentage').attr("readonly", false);
                $(`${quoteClass}`).find('.cal_selling_price').attr('checked', 'checked');
                $(`${quoteClass}`).find('.deposit-amount').val('0.00');

                $(`${quoteClass} .finance`).find("input").val("").each(function() {
                    this.name = this.name.replace(/\[(\d+)\]/, function() {
                        // return '[' + ($('.quote').length - 1) + ']';

                        let quoteLength = parseInt($('.quote').length) - 1;
                        return `[${quoteLength}]`;
                    });

                    let n = 1;

                    this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? 0 : v, function() {
                       
                        let name        = $(this).attr("data-name");
                        let quoteLength = parseInt($('.quote').length) - 1;

                        return `quote_${quoteLength}_finance_${0}_${name}`;
                    });

                }).end()
                .find("select").val("").each(function() {
                    this.name = this.name.replace(/\[(\d+)\]/, function() {

                        let quoteLength = parseInt($('.quote').length) - 1;
                        return `[${quoteLength}]`;
                    });

                    let n           = 1;
                    this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? 0 : v, function() {

                        let name        = $(this).attr("data-name");
                        let quoteLength = parseInt($('.quote').length) - 1;

                        return `quote_${quoteLength}_finance_${0}_${name}`;
                    });
                });

                // $(`#quote_${quoteKey}_date_of_service`).val(todayDate());
                $(`#quote_${quoteKey}_table_name`).val('BookingDetail');
                $(`${quoteClass} .card-header .card-title .badge-info`).html('');
                $(`${quoteClass}`).find('.mediaModal').find('a').attr('id', '');
                $(`${quoteClass}`).find('.refund-payment-hidden-section').attr("hidden", true);
                $(`${quoteClass}`).find('.refund-by-credit-note-section').attr("hidden", true);
                $(`${quoteClass}`).find('.finance-clonning').removeClass("cancelled-payment-styling");
                $(`${quoteClass}`).find('.btn-group').removeClass("d-none");
                $(`${quoteClass}`).find('.clone_booking_finance').removeClass("d-none");
                $(`${quoteClass}`).find('.finance-clonning input, .finance-clonning select').attr("readonly", false);
                $(`${quoteClass}`).find('.payment-method').attr("disabled", false);
                $(`${quoteClass}`).find('.outstanding-amount').attr("readonly", true);
                $(`${quoteClass}`).find('.cancel-payemnt-btn').attr("hidden", true);
                $(`${quoteClass}`).find('.refund-by-credit-note-section').remove();
                $(`${quoteClass}`).find('.refund-by-bank-section').remove();
                $(`${quoteClass}`).find('.supplier-id').html(`<option selected value="">Select Supplier</option>`);
                $(`${quoteClass}`).find('.product-id').html(`<option selected value="">Select Product</option>`);
                $(`${quoteClass}`).find(".estimated-cost, .actual-cost, .markup-amount, .markup-percentage, .selling-price, .profit-percentage, .estimated-cost-in-booking-currency, .selling-price-in-booking-currency, .markup-amount-in-booking-currency").val('0.00').attr('data-code', '');
                $(`${quoteClass}`).find('.text-danger, .supplier-currency-code').html('');
                $(`${quoteClass}`).find('input, select').removeClass('is-invalid');
                $(`${quoteClass}`).find('.added-in-sage').removeAttr('checked');
                $(`${quoteClass}`).find('.booking-detail-cancellation').remove();
                $(`${quoteClass}`).find('.revert-booking-detail-cancellation').remove();
                $(`${quoteClass}`).find('.category-id').val(category_id).change();
                $(`${quoteClass}`).find('.badge-category-id').html(category_name);
                $(`${quoteClass}`).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').addClass('d-none');
                $(`${quoteClass}`).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').html('');
                // $(`${quoteClass}`).find('.badge-date-of-service').html(todayDate());
                $(`${quoteClass}`).find('.badge-service-status').html('');
                $(`${quoteClass}`).find('.finance-clonning-btn, .calender-feild-form-group').removeClass('d-none');
                $(`${quoteClass}`).find('.booking-supplier-currency-id').val($('.default-supplier-currency-id').val()).change();
                $(`${quoteClass}`).find('.status-setting').addClass('d-none');

                datepickerReset(1,`${quoteClass}`);
                reinitializedSingleSelect2();
                reinitializedMultipleSelect2();

                /* Set last End Date of Service */
                let endDateOfService = $(`#quote_${beforeAppendLastQuoteKey}_end_date_of_service`).val();
                $(`#quote_${quoteKey}_date_of_service`).datepicker("setDate", endDateOfService);

                // set default supplier country
                let supplier_country_ids = $(`#quote_0_supplier_country_ids`).val();
                $(`#quote_${quoteKey}_supplier_country_ids`).val(supplier_country_ids).change();

                tourContactAutoCompleteInitialize();

                // $( ".tour-contact" ).autocomplete( "destroy" );
                // $(".tour-contact").autocomplete({
                //     source: `${BASEURL}tour-contacts`,
                // });

                $('html, body').animate({ scrollTop: $(`${quoteClass}`).offset().top }, 1000);
                $('.parent-spinner').removeClass('spinner-border');

            }, 180);

        }

    });



    
    $(document).on('click', '.bookings-service-category-btn-below', function(e) {

        e.preventDefault();

        var category_id   = $(this).attr('data-id');
        var category_name = $(this).attr('data-name');

        jQuery('#new_service_modal_below').modal('hide');
        $('.parent-spinner').addClass('spinner-border');

        var currentQuoteKey =  jQuery('#new_service_modal_below').find('.current-key').val();
        var onQuoteClass    = `.quote-${currentQuoteKey}`;

        if(category_id){

            setTimeout(function() {

                destroySingleSelect2();
                destroyMultipleSelect2();

                var quote = $(".quote").eq(0).clone()
                    .find("input").val("").each(function() {
                        this.name = this.name.replace(/\[(\d+)\]/, function() {
                            let quoteLength = $('.quote').length;
                            return `[${quoteLength}]`;
                        });
                        this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                            let quoteLength = $('.quote').length;
                            let dataName    = $(this).attr("data-name");
                            return `quote_${quoteLength}_${dataName}`;
                        });
                    }).end()
                    .find("textarea").val("").each(function() {
                        this.name = this.name.replace(/\[(\d+)\]/, function() {
                            let quoteLength = $('.quote').length;
                            return `[${quoteLength}]`;
                        });
                        this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                            let quoteLength = $('.quote').length;
                            let dataName = $(this).attr("data-name");
                            return `quote_${quoteLength}_${dataName}`;
                        });
                    }).end()
                    .find("select").val("").each(function() {
                        this.name = this.name.replace(/\[(\d+)\]/, function() { 
                            let quoteLength = $('.quote').length;
                            return `[${quoteLength}]`;
                        });
                        this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                            let quoteLength = $('.quote').length;
                            let dataName = $(this).attr("data-name");
                            return `quote_${quoteLength}_${dataName}`;
                        });
                    }).end().show().insertAfter(onQuoteClass);

                var quoteLength = $('.quote').length;
                var quoteKey    = quoteLength - 1;
                var quoteClass  = `.quote-${quoteKey}`;

                quote.attr('data-key', quoteKey);
                quote.removeClass(`quote-0`);
                quote.addClass(`quote-${quoteKey}`);
                quote.find('.prod-feild-col').remove();

                $(`${quoteClass}`).find('.finance .row:not(:first):not(:last)').remove();
                $(`${quoteClass}`).find('.actual-cost').attr("data-status", "");
                $(`${quoteClass}`).find('.markup-amount').attr("readonly", false);
                $(`${quoteClass}`).find('.markup-percentage').attr("readonly", false);
                $(`${quoteClass}`).find('.cal_selling_price').attr('checked', 'checked');
                $(`${quoteClass}`).find('.deposit-amount').val('0.00');

                $(`${quoteClass} .finance`).find("input").val("").each(function() {
                    this.name = this.name.replace(/\[(\d+)\]/, function() {

                        let quoteLength = parseInt($('.quote').length) - 1;
                        return `[${quoteLength}]`;
                    });

                    let n = 1;

                    this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? 0 : v, function() {
                       
                        let name        = $(this).attr("data-name");
                        let quoteLength = parseInt($('.quote').length) - 1;

                        return `quote_${quoteLength}_finance_${0}_${name}`;
                    });

                }).end()
                .find("select").val("").each(function() {
                    this.name = this.name.replace(/\[(\d+)\]/, function() {
                        let quoteLength = parseInt($('.quote').length) - 1;
                        return `[${quoteLength}]`;
                    });

                    let n           = 1;
                    this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? 0 : v, function() {

                        let name        = $(this).attr("data-name");
                        let quoteLength = parseInt($('.quote').length) - 1;

                        return `quote_${quoteLength}_finance_${0}_${name}`;
                    });
                });

                // $(`#quote_${quoteKey}_date_of_service`).val(todayDate());
                $(`#quote_${quoteKey}_table_name`).val('BookingDetail');
                $(`${quoteClass} .card-header .card-title .badge-info`).html('');
                $(`${quoteClass}`).find('.mediaModal').find('a').attr('id', '');
                $(`${quoteClass}`).find('.refund-payment-hidden-section').attr("hidden", true);
                $(`${quoteClass}`).find('.refund-by-credit-note-section').attr("hidden", true);
                $(`${quoteClass}`).find('.finance-clonning').removeClass("cancelled-payment-styling");
                $(`${quoteClass}`).find('.btn-group').removeClass("d-none");
                $(`${quoteClass}`).find('.clone_booking_finance').removeClass("d-none");
                $(`${quoteClass}`).find('.finance-clonning input, .finance-clonning select').attr("readonly", false);
                $(`${quoteClass}`).find('.payment-method').attr("disabled", false);
                $(`${quoteClass}`).find('.outstanding-amount').attr("readonly", true);
                $(`${quoteClass}`).find('.cancel-payemnt-btn').attr("hidden", true);
                $(`${quoteClass}`).find('.refund-by-credit-note-section').remove();
                $(`${quoteClass}`).find('.refund-by-bank-section').remove();
                $(`${quoteClass}`).find('.supplier-id').html(`<option selected value="">Select Supplier</option>`);
                $(`${quoteClass}`).find('.product-id').html(`<option selected value="">Select Product</option>`);
                $(`${quoteClass}`).find(".estimated-cost, .actual-cost, .markup-amount, .markup-percentage, .selling-price, .profit-percentage, .estimated-cost-in-booking-currency, .selling-price-in-booking-currency, .markup-amount-in-booking-currency").val('0.00').attr('data-code', '');
                $(`${quoteClass}`).find('.text-danger, .supplier-currency-code').html('');
                $(`${quoteClass}`).find('input, select').removeClass('is-invalid');
                $(`${quoteClass}`).find('.added-in-sage').removeAttr('checked');
                $(`${quoteClass}`).find('.booking-detail-cancellation').remove();
                $(`${quoteClass}`).find('.revert-booking-detail-cancellation').remove();
                $(`${quoteClass}`).find('.category-id').val(category_id).change();
                $(`${quoteClass}`).find('.badge-category-id').html(category_name);
                $(`${quoteClass}`).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').addClass('d-none');
                $(`${quoteClass}`).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').html('');
                // $(`${quoteClass}`).find('.badge-date-of-service').html(todayDate());
                $(`${quoteClass}`).find('.badge-service-status').html('');
                $(`${quoteClass}`).find('.finance-clonning-btn, .calender-feild-form-group').removeClass('d-none');
                $(`${quoteClass}`).find('.booking-supplier-currency-id').val($('.default-supplier-currency-id').val()).change();
                $(`${quoteClass}`).find('.status-setting').addClass('d-none');


                datepickerReset(1,`${quoteClass}`);
                reinitializedSingleSelect2();
                reinitializedMultipleSelect2();

                /* Set last End Date of Service */
                var endDateOfService = $(`#quote_${currentQuoteKey}_end_date_of_service`).val();
                $(`#quote_${quoteKey}_date_of_service`).datepicker("setDate", endDateOfService);

                // set default supplier country
                let supplier_country_ids = $(`#quote_0_supplier_country_ids`).val();
                $(`#quote_${quoteKey}_supplier_country_ids`).val(supplier_country_ids).change();

                $('html, body').animate({ scrollTop: $(quoteClass).offset().top }, 1000);
                $('.parent-spinner').removeClass('spinner-border');

            }, 180);

        }

    });

    
    /*
    |--------------------------------------------------------------------------
    | Booking Management Calculation Functions
    |--------------------------------------------------------------------------
    */




    function getBookingSupplierCurrencyValues(supplierCurrency, key) {

        var rateType        = $("input[name=rate_type]:checked").val();
        var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
        var actualCost      = removeComma($(`#quote_${key}_actual_cost`).val());
        var markupAmount    = removeComma($(`#quote_${key}_markup_amount`).val());
        var sellingPrice    = removeComma($(`#quote_${key}_selling_price`).val());
        var rate            = getRate(supplierCurrency, bookingCurrency, rateType);
        var calculatedActualCostInBookingCurrency   = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;
        var calculatedSellingPriceInBookingCurrency = 0;

        calculatedActualCostInBookingCurrency   = parseFloat(actualCost) * parseFloat(rate);
        calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);
        calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);

        $(`#quote_${key}_actual_cost_in_booking_currency`).val(check(calculatedActualCostInBookingCurrency));
        $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
        $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
    }

    function getBookingDetailValues(key) {

        var supplierCurrency = $(`#quote_${key}_supplier_currency_id`).find(':selected').data('code');
        var bookingCurrency  = $(".booking-currency-id").find(':selected').data('code');
        var rateType         = $('input[name="rate_type"]:checked').val();
        var actualCost       = removeComma($(`#quote_${key}_actual_cost`).val());
        var sellingPrice     = removeComma($(`#quote_${key}_selling_price`).val());
        var rate             = getRate(supplierCurrency, bookingCurrency, rateType);

        var calculatedMarkupAmount     = 0;
        var calculatedMarkupPercentage = 0;
        var calculatedProfitPercentage = 0;
        var calculatedActualCostInBookingCurrency   = 0;
        var calculatedSellingPriceInBookingCurrency = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;

        calculatedMarkupAmount     = parseFloat(sellingPrice) - parseFloat(actualCost);
        calculatedMarkupPercentage = parseFloat(calculatedMarkupAmount) / parseFloat(actualCost / 100);
        calculatedProfitPercentage = ((parseFloat(sellingPrice) - parseFloat(actualCost)) / parseFloat(sellingPrice)) * 100;
        calculatedActualCostInBookingCurrency   = parseFloat(actualCost) * parseFloat(rate);
        calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);
        calculatedMarkupAmountInBookingCurrency = parseFloat(calculatedMarkupAmount) * parseFloat(rate);

        $(`#quote_${key}_markup_amount`).val(check(calculatedMarkupAmount));
        $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
        $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
        $(`#quote_${key}_actual_cost_in_booking_currency`).val(check(calculatedActualCostInBookingCurrency));
        $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));

        getBookingTotalValues();
    }

    function getQuoteDetailValuesForBooking(key, changeFeild) {

        var supplierCurrency = $(`#quote_${key}_supplier_currency_id`).find(':selected').data('code');
        var bookingCurrency  = $(".booking-currency-id").find(':selected').data('code');
        var rateType         = $('input[name="rate_type"]:checked').val();
        var actualCost       = removeComma($(`#quote_${key}_actual_cost`).val());
        var markupPercentage = removeComma($(`#quote_${key}_markup_percentage`).val());
        var markupAmount     = removeComma($(`#quote_${key}_markup_amount`).val());
        var rate             = getRate(supplierCurrency, bookingCurrency, rateType);
        var calculatedSellingPrice     = 0;
        var calculatedMarkupPercentage = 0;
        var calculatedMarkupAmount     = 0;
        var calculatedProfitPercentage = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;
        var calculatedActualCostInBookingCurrency   = 0;
        var calculatedSellingPriceInBookingCurrency = 0;

        if (changeFeild == 'actual_cost') {

            calculatedSellingPrice = parseFloat(markupAmount) + parseFloat(actualCost);
            calculatedMarkupPercentage = parseFloat(markupAmount) / parseFloat(actualCost / 100);
            calculatedProfitPercentage = ((parseFloat(calculatedSellingPrice) - parseFloat(actualCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
            calculatedActualCostInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);

            $(`#quote_${key}_actual_cost_in_booking_currency`).val(check(calculatedActualCostInBookingCurrency));
            $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
            $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        }

        if (changeFeild == 'markup_amount') {

            calculatedSellingPrice     = parseFloat(markupAmount) + parseFloat(actualCost);
            calculatedMarkupPercentage = parseFloat(markupAmount) / parseFloat(actualCost / 100);
            calculatedProfitPercentage = ((parseFloat(calculatedSellingPrice) - parseFloat(actualCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * rate;
            calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);

            $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
            $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
            $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        }

        if (changeFeild == 'markup_percentage') {

            calculatedMarkupAmount = (parseFloat(actualCost) / 100) * parseFloat(markupPercentage);
            calculatedSellingPrice = parseFloat(calculatedMarkupAmount) + parseFloat(actualCost);
            calculatedProfitPercentage = ((parseFloat(calculatedSellingPrice) - parseFloat(actualCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedMarkupAmountInBookingCurrency = parseFloat(calculatedMarkupAmount) * parseFloat(rate);
            calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);

            $(`#quote_${key}_markup_amount`).val(check(calculatedMarkupAmount));
            $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
            $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        }

        getBookingTotalValues();
    }



    $(document).on('change', '.booking-supplier-currency-id', function() {

        var code = $(this).find(":selected").data("code");
        var quote = $(this).closest(".quote");
        var quoteKey = quote.data("key");
        var currency_name = $(this).find(':selected').attr('data-name');
        var supplierCurrency = $(this).val();
        var bookingCurrency  = $('#currency_id').val();

        if(typeof supplierCurrency === 'undefined' || supplierCurrency == "") {
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

        getBookingSupplierCurrencyValues(code, quoteKey);
        getBookingTotalValues();
    });

    $(document).on('change', '.payment-method', function() {

        var payment_method = $(this).val();
        var supplier_id = $(this).closest('.quote').find('.supplier-id').val();
        var current_payment_methods = $(this);

        var quoteKey = $(this).closest('.quote').data('key');
        var financeKey = $(this).closest('.finance-clonning').data('financekey');

        var estimatedCost = parseFloat(removeComma($(this).closest('.quote').find('.estimated-cost').val()));
        var totalDepositAmountArray = $(this).closest('.finance').find('.deposit-amount').map((i, e) => parseFloat(removeComma(e.value))).get();
        var totalDepositAmount = totalDepositAmountArray.reduce((a, b) => (a + b), 0);
        var outstanding_amount_left = parseFloat(removeComma($(this).closest('.quote').find('.outstanding_amount_left').val()));

        var wa = 0;
        var outstandingAmountLeft = estimatedCost - totalDepositAmount;
        var currentDepositAmount = $(`#quote_${quoteKey}_finance_${financeKey}_deposit_amount`).val();


        if (supplier_id != null && payment_method == 3) {

            $.ajax({
                headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                url: REDIRECT_BASEURL + 'wallets/get-supplier-wallet-amount/' + supplier_id,
                type: 'get',
                success: function(data) {

                    if (data.response == true) {
                        wa = parseFloat(data.message);

                        if (currentDepositAmount > wa) {
                            alert("Please Enter Correct Wallet Amount");


                            $(`#quote_${quoteKey}_finance_${financeKey}_deposit_amount`).val('0.00');
                            $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val('');
                        } else {
                            $(`#quote_${quoteKey}_outstanding_amount_left`).val(check(outstandingAmountLeft));
                            $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val(check(outstandingAmountLeft));
                        }

                    }
                },
                error: function(reject) {

                    if (reject.status === 422) {
                        var errors = $.parseJSON(reject.responseText);
                        alert(errors.message);
                        $(current_payment_methods).val('').trigger('change');
                    }
                },
            });

        } else {
            $(`#quote_${quoteKey}_outstanding_amount_left`).val(check(outstandingAmountLeft));
            $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val(check(outstandingAmountLeft));
        }
    });

    $(document).on('change', '.deposit-amount', function() {

        var quoteKey       = $(this).closest('.quote').data('key');
        var financeKey     = $(this).closest('.finance-clonning').data('financekey');
        var closestFinance = $(this).closest('.finance');
        var depositAmount  = removeComma($(this).val());
        var estimated_cost = removeComma($(`#quote_${quoteKey}_estimated_cost`).val());
        var payment_method = $(`#quote_${quoteKey}_finance_${financeKey}_payment_method`).val();
        var supplier_id    = $(`#quote_${quoteKey}_supplier_id`).val();
        var totalDepositAmountArray = closestFinance.find('.deposit-amount').map((i, e) => parseFloat(removeComma(e.value))).get();
        var totalDepositAmount      = totalDepositAmountArray.reduce((a, b) => (a + b), 0);
        var outstandingAmountLeft   = parseFloat(estimated_cost) - parseFloat(totalDepositAmount);
        var walletAmount = 0;

        if (payment_method && payment_method == 3) {

            $.ajax({
                headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                url: `${REDIRECT_BASEURL}wallets/get-supplier-wallet-amount/${supplier_id}`,
                type: 'get',
                success: function(data) {

                    if (data.response == true) {
                        walletAmount = parseFloat(data.message);

                        if (depositAmount > walletAmount) {
                            alert("Please Enter Correct Wallet Amount");
                            $(`#quote_${quoteKey}_finance_${financeKey}_deposit_amount`).val('0.00');
                            $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val('');
                        } else {

                            if (outstandingAmountLeft < 0) {
                                alert("Please Enter Correct Amount");
                                $(`#quote_${quoteKey}_finance_${financeKey}_deposit_amount`).val('0.00');
                                $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val('');
                            } else {

                                $(`#quote_${quoteKey}_outstanding_amount_left`).val(check(outstandingAmountLeft));
                                $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val(check(outstandingAmountLeft));
                            }
                        }
                    }
                },
                error: function(reject) {}
            });
        } else {

            if (outstandingAmountLeft >= 0 && payment_method !== null) {

                $(`#quote_${quoteKey}_outstanding_amount_left`).val(check(outstandingAmountLeft));
                $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val(check(outstandingAmountLeft));

            } else if (outstandingAmountLeft < 0 && payment_method != 3) {

                Toast.fire({
                    icon: 'warning',
                    title: "Please Enter Correct Deposit Amount."
                });

                $(`#quote_${quoteKey}_finance_${financeKey}_deposit_amount`).val('0.00');
                $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val('');
            }

        }

    });

    function getActualCost(quote) {

        var totalDepositAmountArray = quote.find('.deposit-amount').map((i, e) => parseFloat(removeComma(e.value))).get();
        var totalDepositAmount      = totalDepositAmountArray.reduce((a, b) => (a + b), 0);
        var amountArray             = quote.find('.amount').map((i, e) => parseFloat(removeComma(e.value))).get();
        var amountTotalArray        = amountArray.filter(function(value) { return !Number.isNaN(value); });
        var totalAmount             = amountTotalArray.reduce((a, b) => (a + b), 0);
        var actualCost              = parseFloat(totalDepositAmount) - parseFloat(totalAmount);

        return actualCost;
    }

    function getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey) {

        var supplierCurrency = $(`#quote_${quoteKey}_supplier_currency_id`).find(":selected").data("code");
        var bookingCurrency  = $(".booking-currency-id").find(":selected").data("code");
        var rateType         = $("input[name=rate_type]:checked").val();
        var rate             = getRate(supplierCurrency, bookingCurrency, rateType);

        var calculatedActualCostInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);
        var calculatedSellingPriceInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);

        $(`#quote_${quoteKey}_actual_cost_in_booking_currency`).val(check(calculatedActualCostInBookingCurrency));
        $(`#quote_${quoteKey}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
    }

    $(document).on('change', '.refund_amount', function() {

        var quote      = $(this).closest('.quote');
        var quoteKey   = $(this).closest('.quote').data('key');
        var actualCost = parseFloat(getActualCost(quote));

        if (actualCost < 0) {

            Toast.fire({
                icon: 'warning',
                title: "Please Enter Correct Amount"
            });

            $(this).val('0.00');
        } else {

            $(`#quote_${quoteKey}_actual_cost`).val(check(actualCost));
            $(`#quote_${quoteKey}_markup_amount`).val('0.00');
            $(`#quote_${quoteKey}_markup_amount_in_booking_currency`).val('0.00');
            $(`#quote_${quoteKey}_markup_percentage`).val('0.00');
            $(`#quote_${quoteKey}_profit_percentage`).val('0.00');
            $(`#quote_${quoteKey}_selling_price`).val(check(actualCost));

            getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey)
            getBookingTotalValues();
        }

    });

    $(document).on('change', '.credit-note-amount', function() {

        var quote      = $(this).closest('.quote');
        var quoteKey   = $(this).closest('.quote').data('key');
        var actualCost = parseFloat(getActualCost(quote));


        if (actualCost < 0) {
            Toast.fire({
                icon: 'warning',
                title: "Please Enter Correct Amount"
            });
            $(this).val('0.00');
        } else {

            $(`#quote_${quoteKey}_actual_cost`).val(check(actualCost));
            $(`#quote_${quoteKey}_markup_amount`).val('0.00');
            $(`#quote_${quoteKey}_markup_amount_in_booking_currency`).val('0.00');
            $(`#quote_${quoteKey}_markup_percentage`).val('0.00');
            $(`#quote_${quoteKey}_profit_percentage`).val('0.00');
            $(`#quote_${quoteKey}_selling_price`).val(check(actualCost));

            getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey)

            getBookingTotalValues();
        }

    });

    $(document).on('click', '.refund-to-bank', function() {

        destroySingleSelect2();

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');
        var refundPaymentRowLength = quote.find(".refund-payment-row:not(:hidden)").length;

        if (parseInt(refundPaymentRowLength) == 0) {

            if (confirm("Are you sure you want Refund Payment? Actual Cost, Markup Amount, Selling Price, Profit% will be override.") == true) {
                quote.find('.refund-payment-section').attr("hidden", false);
            }
        } else {

            quote.find('.refund-payment-row').first().clone().find("input").val("").each(function() {

                    let n = 1;
                    let name = $(this).attr("data-name");

                    this.name = this.name.replace(/]\[(\d+)]/g, function() {
                        return `][${refundPaymentRowLength}]`;
                    });

                    this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? refundPaymentRowLength : v, function() {
                        return `quote_${quoteKey}_finance_${refundPaymentRowLength}_${name}`;
                    });

                }).end()
                .find('.refund-payment-label').each(function() {

                    this.id = `refund_payment_label_${refundPaymentRowLength}`;
                    $(this).text(`Refund Payment #${refundPaymentRowLength+1}`);

                }).end()
                .find("select").val("").each(function() {

                    let n = 1;
                    let name = $(this).attr("data-name");

                    this.name = this.name.replace(/]\[(\d+)]/g, function() {
                        return `][${refundPaymentRowLength}]`;
                    });

                    this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? refundPaymentRowLength : v, function() {
                        return `quote_${quoteKey}_finance_${refundPaymentRowLength}_${name}`;
                    });

                }).end()
                .find('.select2single').select2({
                    width: '100%',
                    theme: "bootstrap",
                }).end()
                .show()
                .insertAfter(quote.find('.refund-payment-row:last'));

            quote.find('.refund-payment-row:last .checkbox').prop('checked', false);
            quote.find('.refund-payment-row:last :input, select').removeAttr('readonly disabled');
            quote.find('.refund-payment-row:last .refund_amount').val('');
            quote.find('.refund-payment-row:last .refund-payment-hidden-btn').removeClass('d-none');
        }

        reinitializedSingleSelect2();
    });

    $(document).on('click', '.credit-note', function() {

        destroySingleSelect2();

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');
        var creditNoteRowLength = quote.find(".credit-note-row:not(:hidden)").length;

        // console.log(creditNoteRowLength);

        if (parseInt(creditNoteRowLength) == 0) {
            if (confirm("Are you sure you want Credit Note? Actual Cost, Markup Amount, Selling Price, Profit% will be override.") == true) {
                quote.find('.credit-note-section').attr("hidden", false);
            }

        } else {

            quote.find('.credit-note-row').first().clone().find("input").val("").each(function() {

                    let n = 1;
                    let name = $(this).attr("data-name");

                    this.name = this.name.replace(/]\[(\d+)]/g, function() {
                        return `][${creditNoteRowLength}]`;
                    });

                    this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? creditNoteRowLength : v, function() {
                        return `quote_${quoteKey}_finance_${creditNoteRowLength}_${name}`;
                    });

                }).end()
                .find('.credit_note_label').each(function() {

                    this.id = `credit_note_label_${creditNoteRowLength}`;
                    $(this).text(`Credit Note Amount Payment #${creditNoteRowLength+1}`);

                }).end()
                .find("select").val("").each(function() {

                    let n = 1;
                    let name = $(this).attr("data-name");

                    this.name = this.name.replace(/]\[(\d+)]/g, function() {
                        return `][${creditNoteRowLength}]`;
                    });

                    this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? creditNoteRowLength : v, function() {
                        return `quote_${quoteKey}_finance_${creditNoteRowLength}_${name}`;
                    });

                }).end()
                .find('.select2single').select2({
                    width: '100%',
                    theme: "bootstrap",
                }).end()
                .show()
                .insertAfter(quote.find(".credit-note-row:last"));

            // quote.find('.refund-payment-row:last :input, select').removeAttr('readonly disabled');
            // quote.find('.refund-payment-row:last .refund_amount').val('');
            quote.find('.credit-note-row:last .credit-note-hidden-btn').removeClass('d-none');
        }

        reinitializedSingleSelect2();

    });

    $(document).on('click', '.refund-payment-hidden-btn', function() {

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');
        var refundPaymentRowLength = quote.find(".refund-payment-row:not(:hidden)").length;

        if (parseInt(refundPaymentRowLength) == 1) {
            quote.find('.refund-payment-section').attr("hidden", true);
            quote.find('.refund-payment-section .refund_amount').val("");
        } else {
            $(this).closest('.refund-payment-row').remove();
        }

        var actualCost = parseFloat(getActualCost(quote));
        $(`#quote_${quoteKey}_actual_cost`).val(check(actualCost));

        getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey)
        getBookingTotalValues();
    });

    $(document).on('click', '.credit-note-hidden-btn', function() {

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');
        var creditNoteRowLength = quote.find(".credit-note-row:not(:hidden)").length;

        if (parseInt(creditNoteRowLength) == 1) {
            quote.find('.credit-note-section').attr("hidden", true);
            quote.find('.credit-note-section .credit-note-amount').val("");
        } else {
            $(this).closest('.credit-note-row').remove();
        }

        var actualCost = parseFloat(getActualCost(quote));
        $(`#quote_${quoteKey}_actual_cost`).val(check(actualCost));

        getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey)
        getBookingTotalValues();
    });

    /*
    |--------------------------------------------------------------------------
    | End Booking Management
    |--------------------------------------------------------------------------
    */





});



