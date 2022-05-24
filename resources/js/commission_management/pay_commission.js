$(document).ready(function() {


    function getTotalPaidAmount() {
        let valesArray = $('.row-total-paid-amount').map((i, e) => parseFloat(removeComma(e.value))).get();
        let rowTotalPaidAmount  = valesArray.reduce((a, b) => (a + b), 0);

        $('.total-paid-amount').html(check(rowTotalPaidAmount)).val(check(rowTotalPaidAmount));
    }

    function getTotalOutstandingAmount() {
        let valesArray = $('.row-total-outstanding-amount').map((i, e) => parseFloat(removeComma(e.value))).get();
        let rowTotalOutstandingAmount = valesArray.reduce((a, b) => (a + b), 0);

        $('.total-outstanding-amount').html(check(rowTotalOutstandingAmount)).val(check(rowTotalOutstandingAmount));
    }

    function resetCommissionRow(commissionRow) {
        commissionRow.find('.pay-commission-amount').val('0.00');
        commissionRow.find('.finance-child').prop('checked', false).val('0');
        commissionRow.find('.row-total-paid-amount').val('0.00');
        commissionRow.find('.row-total-outstanding-amount').val('0.00');
    }


    $(document).on("change", '.pay-commission-amount', function (e) {

        let commissionRow         = $(this).closest('.commission-row');
        let totalPaidAmountYet    = removeComma(commissionRow.find('.total-paid-amount-yet').val());
        let payCommisionAmount    = removeComma(commissionRow.find('.pay-commission-amount').val());
        let outstandingAmountLeft = removeComma(commissionRow.find('.outstanding-amount-left').val());

        if(parseFloat(payCommisionAmount) <= 0 || parseFloat(payCommisionAmount) > parseFloat(outstandingAmountLeft)){
           
            Toast.fire({
                icon: 'warning',
                title: 'Please Enter Correct Amount.'
            });

            resetCommissionRow(commissionRow);

        }else{

            let rowTotalPaidAmount        = parseFloat(totalPaidAmountYet) + parseFloat(payCommisionAmount);
            let rowTotalOutstandingAmount = parseFloat(outstandingAmountLeft) - parseFloat(payCommisionAmount);
    
            commissionRow.find('.finance-child').prop('checked', true).val('1');
            commissionRow.find('.row-total-paid-amount').val(check(rowTotalPaidAmount));
            commissionRow.find('.row-total-outstanding-amount').val(check(rowTotalOutstandingAmount));
        }

        getTotalPaidAmount();
        getTotalOutstandingAmount();
    });

    $(document).on('submit', '#store_pay_commission', function(event) {
        
        event.preventDefault();

        let checkedValues = $('.finance-child:checked').map((i, e) => e.value).get();
        if (checkedValues.length == 0) {
     
            Toast.fire({
                icon: 'error',
                title: 'Please Check Any Record First.'
            });

            return;
        }

        let url    = $(this).attr('action');
        let formID = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: url,
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
                printServerSuccessMessage(response, `#${formID}`);
            },
            error: function(response) {
                
                removeModalFormLoadingStyles(`#${formID}`);
                printServerValidationErrors(response);
            }
        });
    });

    $(document).on('click', ".pay-batch", function(event) {

        event.preventDefault();

        let batchID = $(this).data('batch_id');

        let modal = $('#pay_batch_modal');
        modal.find('#batch_id').val(batchID);


        modal.modal('show');
    });

    $(document).on('click', ".view-dispute-detail", function(event) {

        event.preventDefault();

        let disputeDetails = $(this).data('details');
        let modal = $('#view_dispute_detail_modal');
        modal.modal('show');
        modal.find('#view_dispute_detail').html('');
        modal.find('#view_dispute_detail').html(disputeDetails);

    });

    $(document).on('click', ".adjust-booking-commission", function(event) {


        let modal = $('#adjust_booking_commission_modal');
        modal.modal('show');

        let saleAgentCurrencyCode = $(this).data('sale_agent_currency_code');
        let bookingCurrencyCode = $(this).data('booking_currency_code');
        let saleAgentCommissionAmount = $(this).data('sale_agent_commission_amount');
        let bookingID = $(this).data('booking_id');
        let batchID = $(this).data('batch_id');

        $('.sale-person-currency-code').html(saleAgentCurrencyCode);
        $('#sale_person_currency_code').val(saleAgentCurrencyCode);
        $('#current_commission_amount').val(check(saleAgentCommissionAmount));
        $('#booking_id').val(bookingID);
        $('#booking_currency_code').val(bookingCurrencyCode);
        $('.batch-id').val(batchID);

      



    });



    $(document).on('submit', "#pay_batch_modal_form", function(event) {

        event.preventDefault();

        let url = $(this).attr('action');
        let formID = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: url,
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

                $("#pay_batch_modal").modal('hide');
                $("#listing_card_body").load(`${location.href} #listing_card_body`);
    
                Toast.fire({
                    icon: 'success',
                    title: response.success_message
                });
                
            },
            error: function(response) {
                
                removeModalFormLoadingStyles(`#${formID}`);
                printServerValidationErrors(response);
            }
        });

    });

    $(document).on('click', ".commission-status", function(event) {

        let url        = $(this).data('action');
        let actionType = $(this).data('action_type');
        let message    = "";
        let buttonText = "";

        switch(actionType) {

            case "confirmed":
                message    = 'You want to Confirmed Commission?';
                buttonText = 'Confirmed';
                break;

            case "dispute":
                message    = 'You want to Dispute Commission?';
                buttonText = 'Dispute';
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

                let modal      = $('#dispute_booking_modal');

                if(actionType == "dispute"){

                    modal.modal('show');
                    modal.find('#dispute_commission_form').attr("action", url);

                }

                if(actionType == "confirmed"){

                    $.ajax({
                        type: 'PATCH',
                        url: url,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {

                            $("#listing_card_body").load(`${location.href} #listing_card_body`);
                
                            Toast.fire({
                                icon: 'success',
                                title: response.success_message
                            });
                        }
                    });
                }

                if(actionType == "edit_booking"){
                    $('#show_booking :input').removeAttr('disabled');
                }
            }
        });
    });

    $(document).on('submit', '#dispute_commission_form', function(event) {

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

                $("#dispute_booking_modal").modal('hide');
                $("#listing_card_body").load(`${location.href} #listing_card_body`);
    
                Toast.fire({
                    icon: 'success',
                    title: response.success_message
                });

            },
            error: function(response) {

                removeModalFormLoadingStyles(`#${formID}`);
                printModalServerValidationErrors(response, `#${formID}`);
            }
        });

    });

    
    $(document).on('submit', '#adjust_booking_commission_form', function(event) {

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

                $("#adjust_booking_commission_modal").modal('hide');
                $("#listing_card_body").load(`${location.href} #listing_card_body`);
    
                Toast.fire({
                    icon: 'success',
                    title: response.success_message
                });

            },
            error: function(response) {

                removeModalFormLoadingStyles(`#${formID}`);
                printModalServerValidationErrors(response, `#${formID}`);
            }
        });

    });

});