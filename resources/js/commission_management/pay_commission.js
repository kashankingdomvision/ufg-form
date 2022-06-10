$(document).ready(function() {

    // function getTotalPayCommissionAmount() {
    //     let valesArray = $('.pay-commission-amount').map((i, e) => parseFloat(removeComma(e.value))).get();
    //     let totalPayCommissionAmount = valesArray.reduce((a, b) => (a + b), 0);
    //     $('.total-pay-commission-amount').html(check(totalPayCommissionAmount)).val(check(totalPayCommissionAmount));
    //     return totalPayCommissionAmount;
    // }

    function getTotalPaidAmount() {
        let valesArray = $('.row-total-paid-amount').map((i, e) => parseFloat(removeComma(e.value))).get();
        let rowsTotalPaidAmount = valesArray.reduce((a, b) => (a + b), 0);

        $('.total-paid-amount')
            .html(check(rowsTotalPaidAmount))
            .val(check(rowsTotalPaidAmount));

        return rowsTotalPaidAmount;
    }

    function getTotalOutstandingAmount() {
        let valesArray = $('.row-total-outstanding-amount').map((i, e) => parseFloat(removeComma(e.value))).get();
        let rowsTotalOutstandingAmount = valesArray.reduce((a, b) => (a + b), 0);

        $('.total-outstanding-amount')
            .html(check(rowsTotalOutstandingAmount))
            .val(check(rowsTotalOutstandingAmount));

        return rowsTotalOutstandingAmount;
    }

    function resetCommissionRow(commissionRow) {
        commissionRow.find('.pay-commission-amount').val('0.00');
        commissionRow.find('.finance-child').prop('checked', false).val('0');
        commissionRow.find('.row-total-paid-amount').val('0.00');
        commissionRow.find('.row-total-outstanding-amount').val('0.00');
        commissionRow.find('.deposited-amount-value').val('0.00');
        commissionRow.find('.bank-amount-value').val('0.00');
    }

    function getRowTotalPaidAmount(commissionRow) {

        let totalPaidAmountYet = removeComma(commissionRow.find('.total-paid-amount-yet').val());
        let payCommisionAmount = removeComma(commissionRow.find('.pay-commission-amount').val());
        let rowTotalPaidAmount = parseFloat(totalPaidAmountYet) + parseFloat(payCommisionAmount);

        commissionRow.find('.row-total-paid-amount').val(check(rowTotalPaidAmount));
    }

    function getRowTotalOutstandingAmount(commissionRow) {

        let outstandingAmountLeft = removeComma(commissionRow.find('.outstanding-amount-left').val());
        let payCommisionAmount    = removeComma(commissionRow.find('.pay-commission-amount').val());

        let rowTotalOutstandingAmount = parseFloat(outstandingAmountLeft) - parseFloat(payCommisionAmount);

        commissionRow.find('.row-total-outstanding-amount').val(check(rowTotalOutstandingAmount));
    }

    function getBankTotalAmountPaid() {

        let depositedAmountPayments = $("#deposited_amount_payments").prop('checked');

        if(typeof depositedAmountPayments != 'undefined' && depositedAmountPayments){

            let bookingCommissionTotalPaidAmount = getTotalPaidAmount();
            let totalDepositAmount = parseFloat(removeComma($('#total_deposit_amount').val()));

            if(bookingCommissionTotalPaidAmount > totalDepositAmount){
                let bankTotalAmountPaid = bookingCommissionTotalPaidAmount - totalDepositAmount;
                $('#bank_total_amount_paid').val(check(bankTotalAmountPaid));
            }else{
                $('#bank_total_amount_paid').val('0.00');
            }
    
        }
        else{

            $('#bank_total_amount_paid').val(check(getTotalPaidAmount()));
        }
    }

    function totalDepositedOutstandingAmount() {

        let currentDepositedTotalOutstandingAmount = $('#current_deposited_total_outstanding_amount').val();
        let totalDepositAmount                     = removeComma($('#total_deposit_amount').val());

        let totalDepositedOutstandingAmount = parseFloat(currentDepositedTotalOutstandingAmount) - parseFloat(totalDepositAmount); 

        $('#total_deposited_outstanding_amount').val(check(totalDepositedOutstandingAmount));

        $('#deposited_amount_payments')
            .prop('checked', true)
            .val('1');
    }

    $(document).on("change", '.pay-commission-amount', function (e) {

        let commissionRow         = $(this).closest('.commission-row');
        let payCommisionAmount    = removeComma(commissionRow.find('.pay-commission-amount').val());
        let outstandingAmountLeft = removeComma(commissionRow.find('.outstanding-amount-left').val());

        if(parseFloat(payCommisionAmount) <= 0 || parseFloat(payCommisionAmount) > parseFloat(outstandingAmountLeft)){
           
            Toast.fire({
                icon: 'warning',
                title: 'Please Enter Correct Amount.'
            });

            resetCommissionRow(commissionRow);

        }else{
    
            commissionRow.find('.finance-child').prop('checked', true).val('1');

            getRowTotalPaidAmount(commissionRow);
            getRowTotalOutstandingAmount(commissionRow);

            getBankTotalAmountPaid();
        }

        getTotalPaidAmount();
        getTotalOutstandingAmount();
    });

    $(document).on('click', '.adjust-deposited-amount', function(event) {

        let modal = $('#adjust_deposited_amount_modal');
        let saleAgentCurrencyCode = $('#total_deposit_amount').data('sale_person_currency_code');
        
        $('#adjust_deposited_amount_modal').find('.sale-person-currency-code').html(saleAgentCurrencyCode);

        modal.modal('show');
        modal.find('form')[0].reset();

        
    });
    
    $(document).on('click', '#apply_adjust_total_deposit_amount', function(event) {

        let adjustTotalDepositAmount = parseFloat(removeComma($('#adjust_total_deposit_amount').val()));
        let totalOutstandingAmount   = parseFloat(removeComma($('#current_deposited_total_outstanding_amount').val()));

        if(adjustTotalDepositAmount > totalOutstandingAmount){

            Toast.fire({
                icon: 'error',
                title: 'Please Enter Correct Amount.'
            });

            $('#total_deposit_amount').val('0.00');
            return;
        }

        let modal = $('#adjust_deposited_amount_modal');
        modal.modal('hide');
        
        $('#total_deposit_amount').val(check(adjustTotalDepositAmount));

        totalDepositedOutstandingAmount();
        getBankTotalAmountPaid();
        totalDepositAmountLeftToAllocate();
    });

    $(document).on('change', '#deposited_amount_payments', function(event) {

        let depositedAmountPayments = $("#deposited_amount_payments").prop('checked');

        if (depositedAmountPayments) {

            let totalOutstandingAmount = parseFloat(removeComma($('#current_deposited_total_outstanding_amount').val()));
            $('#total_deposit_amount').val(check(totalOutstandingAmount));
            $('#total_deposited_outstanding_amount').val('0.00');
        } 
        else {

            let totalOutstandingAmount = parseFloat(removeComma($('#current_deposited_total_outstanding_amount').val()));

            $('#total_deposited_outstanding_amount').val(check(totalOutstandingAmount));
            $('#total_deposit_amount').val('0.00');
        }

        getBankTotalAmountPaid();
        totalDepositAmountLeftToAllocate();
    });

    function totalDepositAmountLeftToAllocate() {
        let depositedAmountPayments = $("#deposited_amount_payments").prop('checked');

        if(depositedAmountPayments){

            let bookingCommissionTotalPaidAmount = getTotalPaidAmount();
            let totalDepositAmount = parseFloat(removeComma($('#total_deposit_amount').val()));

            if(totalDepositAmount > bookingCommissionTotalPaidAmount) {

                let totalDepositAmountLeftToAllocate = totalDepositAmount - bookingCommissionTotalPaidAmount;

                $('.total-deposit-amount-left-to-allocate')
                    .html(check(totalDepositAmountLeftToAllocate))
                    .val(check(totalDepositAmountLeftToAllocate));


                return totalDepositAmountLeftToAllocate;
                    
            }

            if( totalDepositAmount <= bookingCommissionTotalPaidAmount ){
                $('.total-deposit-amount-left-to-allocate')
                    .html('0.00')
                    .val('0.00');

                return 0.00;
            }

        }else{

            $('.total-deposit-amount-left-to-allocate')
                .html('0.00')
                .val('0.00');

            return 0.00;
        }
    }

    $(document).on('change', '.finance-child', function(event) {
        
        let commissionRow = $(this).closest('.commission-row');

        let financeChild = commissionRow.find('.finance-child').prop('checked');

        if (financeChild) {

            let outstandingAmountLeft = commissionRow.find('.outstanding-amount-left').val();
            commissionRow.find('.pay-commission-amount').val(outstandingAmountLeft);

            getRowTotalPaidAmount(commissionRow);
            getRowTotalOutstandingAmount(commissionRow);
            calDepositAndBankAmountValue(commissionRow);

            // let totalDepositAmountLeftToAllocateValue = parseFloat($('.total-deposit-amount-left-to-allocate').val());

            // if(parseFloat(outstandingAmountLeft) > totalDepositAmountLeftToAllocateValue){
            //     let bankAmountValue = parseFloat(outstandingAmountLeft) - totalDepositAmountLeftToAllocateValue;
            //     commissionRow.find('.deposited-amount-value').val(check(totalDepositAmountLeftToAllocateValue));
            //     commissionRow.find('.bank-amount-value').val(check(bankAmountValue));
            // }

            // if(parseFloat(outstandingAmountLeft) <= totalDepositAmountLeftToAllocateValue){
            //     commissionRow.find('.deposited-amount-value').val(check(parseFloat(outstandingAmountLeft)));
            // }

        } else {

            resetCommissionRow(commissionRow);

            // let bookingCommissionTotalPaidAmount = getTotalPaidAmount();
            // let totalDepositAmount = parseFloat(removeComma($('#total_deposit_amount').val()));

            // if(bookingCommissionTotalPaidAmount > totalDepositAmount){
            //     let bankTotalAmountPaid = bookingCommissionTotalPaidAmount - totalDepositAmount;
            //     $('#bank_total_amount_paid').val(check(bankTotalAmountPaid));
            // }else{
            //     $('#bank_total_amount_paid').val('0.00');
            // }

            // getBankTotalAmountPaid();
        }

        totalDepositAmountLeftToAllocate();
        getBankTotalAmountPaid();
        getTotalPaidAmount();
        getTotalOutstandingAmount();
    });

    function calDepositAndBankAmountValue(commissionRow) {

        let totalDepositAmountLeftToAllocateValue = parseFloat($('.total-deposit-amount-left-to-allocate').val());
        let outstandingAmountLeft = removeComma(commissionRow.find('.outstanding-amount-left').val());

        if(parseFloat(outstandingAmountLeft) > totalDepositAmountLeftToAllocateValue){
            let bankAmountValue = parseFloat(outstandingAmountLeft) - totalDepositAmountLeftToAllocateValue;
            commissionRow.find('.deposited-amount-value').val(check(totalDepositAmountLeftToAllocateValue));
            commissionRow.find('.bank-amount-value').val(check(bankAmountValue));
        }

        if(parseFloat(outstandingAmountLeft) <= totalDepositAmountLeftToAllocateValue){
            commissionRow.find('.deposited-amount-value').val(check(parseFloat(outstandingAmountLeft)));
        }
    }

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

    $(document).on('click', ".store-sale-person-bonus", function(event) {

        let modal = $('#store_sale_person_bonus_modal');
        let bookingID = $(this).data('booking_id');
        let saleAgentCurrencyCode = $(this).data('sale_agent_currency_code');

        modal.modal('show');
        modal.find('form')[0].reset();

        modal.find('.booking-id').val(bookingID);
        modal.find('.sale-person-currency-code').html(saleAgentCurrencyCode);
    });

    $(document).on('submit', '#store_sale_person_bonus_modal_form', function(event) {

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

                $("#store_sale_person_bonus_modal").modal('hide');
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


    $(document).on('click', ".update-booking-commission", function(event) {

        let modal = $('#update_booking_commission_modal');
        modal.modal('show');
        modal.find('form')[0].reset();

        let bookingID = $(this).data('booking_id');
        let saleAgentCurrencyCode = $(this).data('sale_agent_currency_code');
        let saleAgentCommissionAmount = $(this).data('sale_agent_commission_amount');

        $('.sale-person-currency-code').html(saleAgentCurrencyCode);
        $('.booking-ids').val(bookingID);
        $('#current_commission_amount').val(check(saleAgentCommissionAmount));
    });

    $(document).on('submit', '#update_booking_commission_form', function(event) {

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

                $("#update_booking_commission_modal").modal('hide');
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

    function resetTable(response){
        $("#listing_card_body").load(`${location.href} #listing_card_body`);
        $("#overlay").addClass('overlay').html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);

        setTimeout(function () {

            $("#overlay").removeClass('overlay').html('');
            $('.child-row').removeClass('d-none');
            $('.parent-row').html('<span class="fa fa-minus"></span>');

            Toast.fire({
                icon: 'success',
                title: response.success_message
            });
            
        }, 500);
    }

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
                    $("#dispute_commission_form")[0].reset();
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
                            resetTable(response);
                        }
                    });
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
                resetTable(response);
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

                setTimeout(function () {
                    window.location.href = data.redirect_url;
                }, 2500);
            },
            error: function(response) {

                removeModalFormLoadingStyles(`#${formID}`);
                printModalServerValidationErrors(response, `#${formID}`);
            }
        });

    });


    $(document).on('click', '.batch-parent', function () {

        let batchID = $(this).data('batch_id');

        if ($(this).is(':checked', true)) {
            $(`.batch-child-${batchID}`).prop('checked', true);

        } else {

            $(`.batch-child-${batchID}`).prop('checked', false);
        }
    });

    $(document).on('click', '.sale-person-commission-bulk-action-item', function() {

        let checkedValues      = $('.batch-child:checked').map((i, e) => e.value ).get();
        let batchCheckedValues = $('.batch-parent:checked').map((i, e) => e.value ).get();
        let bulkActionType     = $(this).data('action_type');
        let message            = "";
        let buttonText         = "";

        if(['confirmed'].includes(bulkActionType)){

            if(checkedValues.length > 0){
    
                $('input[name="bulk_action_type"]').val(bulkActionType);
                $('input[name="bulk_action_ids"]').val(checkedValues);
                $('input[name="batch_ids"]').val(batchCheckedValues);
    
                switch(bulkActionType) {
                    case "confirmed":
                        message    = 'You want to Confirmed Commission?';
                        buttonText = 'Confirm';
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
                            type: 'POST',
                            url: $('#sale_person_commission_bulk_action').attr('action'),
                            data: new FormData($('#sale_person_commission_bulk_action')[0]),
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

    });


    $("#add_deposit_payment").click(function(){
        
        $("#deposit_payment_row").toggle();
    });

});