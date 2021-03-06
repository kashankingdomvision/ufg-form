$(document).ready(function() {

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

    function totalBankAmountValues() {

        let values = $('.bank-amount-value').map((i, e) => parseFloat(removeComma(e.value))).get();
        values = values.reduce((a, b) => (a + b), 0);

        $('.booking-commission-total-bank-amount')
            .html(check(values))
            .val(check(values));

        return values;
    }

    function totalDepositAmountValues() {

        let values = $('.deposit-amount-value').map((i, e) => parseFloat(removeComma(e.value))).get();
        values = values.reduce((a, b) => (a + b), 0);

        $('.booking-commission-total-deposit-amount')
            .html(check(values))
            .val(check(values));

        return values;
    }

    function totalDepositedAmount() {

        let valesArray = $('.deposited-amount-payments:checked').parents('.commission-row').find('.total-deposit-amount').map((i, e) => parseFloat(removeComma(e.value))).get();
        valesArray = valesArray.reduce((a, b) => (a + b), 0);

        return valesArray;
    }

    function totalDepositAmountLeftToAllocate() {

        let totalDepositAmount = totalDepositedAmount();

        if(totalDepositAmount > 0){

            $('.deposit-amount-value').prop("readonly", false);
        }
        else{

            $('.deposit-amount-value').prop("readonly", true);
        }

        $('.total-deposit-amount-left-to-allocate')
            .html(check(totalDepositAmount))
            .val(check(totalDepositAmount));
    }

    function calTotalDepositAmountLeftToAllocate() {

        let totalDepositAmount = totalDepositedAmount();

        if(totalDepositAmount > 0){
            
            // if(totalDepositAmount > bookingCommissionTotalPaidAmount) {

            //     let totalDepositAmountLeftToAllocate = totalDepositAmount - bookingCommissionTotalPaidAmount;

            //     $('.total-deposit-amount-left-to-allocate')
            //         .html(check(totalDepositAmountLeftToAllocate))
            //         .val(check(totalDepositAmountLeftToAllocate));

            //     return totalDepositAmountLeftToAllocate;
            // }

            // if(totalDepositAmount <= bookingCommissionTotalPaidAmount){
            //     $('.total-deposit-amount-left-to-allocate')
            //         .html('0.00')
            //         .val('0.00');

            //     return 0.00;
            // }


            let totalDepositAmountLeftToAllocate = totalDepositAmount - totalDepositAmountValues();

            $('.total-deposit-amount-left-to-allocate')
                .html(check(totalDepositAmountLeftToAllocate))
                .val(check(totalDepositAmountLeftToAllocate));

            return totalDepositAmountLeftToAllocate;
        }
    }

    function getTotalOutstandingAmount() {
        let valesArray = $('.row-total-outstanding-amount').map((i, e) => parseFloat(removeComma(e.value))).get();
        let rowsTotalOutstandingAmount = valesArray.reduce((a, b) => (a + b), 0);

        $('.total-outstanding-amount')
            .html(check(rowsTotalOutstandingAmount))
            .val(check(rowsTotalOutstandingAmount));

        return rowsTotalOutstandingAmount;
    }

    function getBookingCommissionTotalPaidAmount() {
        let valesArray = $('.row-total-paid-amount').map((i, e) => parseFloat(removeComma(e.value))).get();
        let rowsTotalPaidAmount = valesArray.reduce((a, b) => (a + b), 0);

        $('.booking-commission-total-paid-amount')
            .html(check(rowsTotalPaidAmount))
            .val(check(rowsTotalPaidAmount));

        return rowsTotalPaidAmount;
    }

    function getDepositAndPayCommissionTotal() {

        let spDepositAmount = $('#sp_deposit_amount').val() == '' ? 0.00 : removeComma($('#sp_deposit_amount').val());
        let depositAndPayCommissionTotal = parseFloat(getTotalPayCommissionAmount()) + parseFloat(spDepositAmount);

        $('.deposit-and-pay-commission-total')
            .html(check(depositAndPayCommissionTotal))
            .val(check(depositAndPayCommissionTotal));

        return depositAndPayCommissionTotal;
    }

    function getTotalPayCommissionAmount() {
        let valesArray = $('.pay-commission-amount').map((i, e) => parseFloat(removeComma(e.value))).get();
        let totalPayCommissionAmount = valesArray.reduce((a, b) => (a + b), 0);
        $('.total-pay-commission-amount').html(check(totalPayCommissionAmount)).val(check(totalPayCommissionAmount));
        return totalPayCommissionAmount;
    }

    function getRowTotalOutstandingAmount(commissionRow) {

        let outstandingAmountLeft = removeComma(commissionRow.find('.outstanding-amount-left').val());
        let payCommisionAmount    = removeComma(commissionRow.find('.pay-commission-amount').val());

        let rowTotalOutstandingAmount = parseFloat(outstandingAmountLeft) - parseFloat(payCommisionAmount);

        commissionRow.find('.row-total-outstanding-amount').val(check(rowTotalOutstandingAmount));
    }

    function getRowTotalPaidAmount(commissionRow) {

        let totalPaidAmountYet = removeComma(commissionRow.find('.total-paid-amount-yet').val());
        let payCommisionAmount = removeComma(commissionRow.find('.pay-commission-amount').val());
        let rowTotalPaidAmount = parseFloat(totalPaidAmountYet) + parseFloat(payCommisionAmount);

        commissionRow.find('.row-total-paid-amount').val(check(rowTotalPaidAmount));
    }

    function getBankTotalAmountPaid() {

        let depositedAmountPayments = $('.deposited-amount-payments').prop('checked');

        if(typeof depositedAmountPayments != 'undefined' && depositedAmountPayments){

            let bankTotalAmountPaid = $('.bank-amount-value').map((i, e) => parseFloat(removeComma(e.value))).get();
            bankTotalAmountPaid = bankTotalAmountPaid.reduce((a, b) => (a + b), 0);
      
            $('#bank_total_amount_paid').val(check(bankTotalAmountPaid));

            // let bookingCommissionTotalPaidAmount = getTotalPayCommissionAmount();
            // let totalDepositAmount = parseFloat(removeComma($('#total_deposit_amount').val()));

            // if(bookingCommissionTotalPaidAmount > totalDepositAmount){
            //     let bankTotalAmountPaid = bookingCommissionTotalPaidAmount - totalDepositAmount;
            //     $('#bank_total_amount_paid').val(check(bankTotalAmountPaid));
            // }else{
            //     $('#bank_total_amount_paid').val('0.00');
            // }
        }
        else{

            $('#bank_total_amount_paid').val(check(getTotalPayCommissionAmount()));
        }
    }

    function calDepositAndBankAmountValue(commissionRow) {

        let totalDepositAmountLeftToAllocate = $("#total_deposit_amount_left_to_allocate").val();

        let payCommissionAmount = parseFloat(commissionRow.find('.pay-commission-amount').val());
        let depositAmountValue = commissionRow.find('.deposit-amount-value').val();

        if(totalDepositAmountLeftToAllocate && typeof totalDepositAmountLeftToAllocate !== "undefined" && parseFloat(totalDepositAmountLeftToAllocate) > 0) {

            totalDepositAmountLeftToAllocate = parseFloat(removeComma($("#total_deposit_amount_left_to_allocate").val()));

            let outstandingAmountLeft = parseFloat(removeComma(commissionRow.find('.pay-commission-amount').val()));
            let totalDepositAmountLeftToAllocateValue = parseFloat(removeComma($('.total-deposit-amount-left-to-allocate').val()));
        
            if(outstandingAmountLeft > totalDepositAmountLeftToAllocateValue){
                let bankAmountValue = outstandingAmountLeft - totalDepositAmountLeftToAllocateValue;

                commissionRow.find('.deposit-amount-value').val(check(totalDepositAmountLeftToAllocateValue));
                commissionRow.find('.bank-amount-value').val(check(bankAmountValue));
            }
    
            if(outstandingAmountLeft <= totalDepositAmountLeftToAllocateValue){
                commissionRow.find('.deposit-amount-value').val(check(outstandingAmountLeft));
            }

        }

        if(payCommissionAmount && typeof payCommissionAmount !== "undefined" && parseFloat(totalDepositAmountLeftToAllocate) == 0){
            commissionRow.find('.bank-amount-value').val(check(payCommissionAmount));
        }

        if(depositAmountValue && typeof depositAmountValue !== "undefined" && payCommissionAmount == depositAmountValue){
            commissionRow.find('.bank-amount-value').val(check(0));
        }  
        
        // else{
        //     let depositPayment = $('.deposited-amount-payments').length;
        //     if(depositPayment > 0){
        //         commissionRow.find('.bank-amount-value').val(check(outstandingAmountLeft));
        //     }
        // }
    }

    function resetCommissionRow(commissionRow) {
        commissionRow.find('.pay-commission-amount').val('0.00');
        commissionRow.find('.finance-child').prop('checked', false).val('0');
        commissionRow.find('.row-total-paid-amount').val('0.00');
        commissionRow.find('.row-total-outstanding-amount').val('0.00');
        commissionRow.find('.deposit-amount-value').val('0.00');
        commissionRow.find('.bank-amount-value').val('0.00');
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

            let depositedAmountValue = commissionRow.find('.deposit-amount-value').val();

            if(depositedAmountValue && typeof depositedAmountValue !== "undefined") {

                let depositedAmountValue = removeComma(commissionRow.find('.deposit-amount-value').val());
            
                if(parseFloat(depositedAmountValue) > 0){
                    if(parseFloat(payCommisionAmount) > parseFloat(depositedAmountValue) || parseFloat(payCommisionAmount) == parseFloat(depositedAmountValue)){
                        
                        let bankAmountValue = parseFloat(payCommisionAmount) - parseFloat(depositedAmountValue);
                        commissionRow.find('.bank-amount-value').val(check(bankAmountValue));
                    }
                }
            }

        }

        getTotalPayCommissionAmount();
        getBookingCommissionTotalPaidAmount();
        getTotalOutstandingAmount();
        getDepositAndPayCommissionTotal();
        calDepositAndBankAmountValue(commissionRow);
        totalDepositAmountValues();
        totalBankAmountValues();
        getBankTotalAmountPaid();
        calTotalDepositAmountLeftToAllocate();
    });

    $(document).on('change', '#sp_deposit_amount', function(event) {

        let spDepositAmount = $(this).val() == '' ? 0.00 : parseFloat(removeComma($('#sp_deposit_amount').val()));

        $('.sp-deposit-amount')
            .html(check(spDepositAmount))
            .val(check(spDepositAmount));

        getDepositAndPayCommissionTotal();
    });

    $(document).on('change', '.deposited-amount-payments', function(event) {

        let commissionRow         = $(this).closest('.commission-row');
        let depositedAmountPayments = commissionRow.find(".deposited-amount-payments").prop('checked');

        let totalOutstandingAmount = parseFloat(removeComma(commissionRow.find('.current-deposited-total-outstanding-amount').val()));
        // let totalDepositAmount = totalDepositedAmount();

        if (depositedAmountPayments) {

            commissionRow.find('.total-deposit-amount').val(check(totalOutstandingAmount));
            commissionRow.find('.total-deposited-outstanding-amount').val('0.00');
        } 
        else {

            commissionRow.find('.total-deposit-amount').val('0.00');
            commissionRow.find('.total-deposited-outstanding-amount').val(check(totalOutstandingAmount));
        }

        // getBankTotalAmountPaid();
        totalDepositAmountLeftToAllocate();
    });

    var commissionRow = '';
    $(document).on('click', '.adjust-deposited-amount', function(event) {

        commissionRow = $(this).closest('.commission-row');
        let modal = $('#adjust_deposited_amount_modal');
        modal.modal('show');
        modal.find('form')[0].reset();
        
        let totalDepositedOutstandingAmount = removeComma(commissionRow.find('.current-deposited-total-outstanding-amount').val());
        let currencyCode = commissionRow.find('.total-deposit-amount').data('sale_person_currency_code');

        // $('#adjust_deposited_amount_modal').find('#adjust_total_deposit_amount').val(totalDepositedOutstandingAmount);
        $('#adjust_deposited_amount_modal').find('.sale-person-currency-code').html(currencyCode);


        modal.find('#outstanding_amount').val(totalDepositedOutstandingAmount);
    });

    $(document).on('click', '#apply_adjust_total_deposit_amount', function(event) {

        let modal = $('#adjust_deposited_amount_modal');

        let adjustTotalDepositAmount = parseFloat(
            removeComma(modal.find('#adjust_total_deposit_amount').val())
        );

        let totalOutstandingAmount   = parseFloat(
            removeComma(modal.find('#outstanding_amount').val())
        );

        if(adjustTotalDepositAmount > totalOutstandingAmount){

            Toast.fire({
                icon: 'error',
                title: 'Please Enter Correct Amount.'
            });

            $('#total_deposit_amount').val('0.00');
            return;
        }
      
        modal.modal('hide');

        let totaldepositedOutstandingAmount = totalOutstandingAmount - adjustTotalDepositAmount;

        commissionRow.find('.deposited-amount-payments').prop('checked', true);
        commissionRow.find('.total-deposit-amount').val(check(adjustTotalDepositAmount));
        commissionRow.find('.total-deposited-outstanding-amount').val(check(totaldepositedOutstandingAmount));

        totalDepositAmountLeftToAllocate();
        calTotalDepositAmountLeftToAllocate();
    });

    $(document).on('change', '.deposit-amount-value', function(event) {

        let commissionRow = $(this).closest('.commission-row');

        let payCommisionAmount = parseFloat(
            removeComma(commissionRow.find('.pay-commission-amount').val())
        );

        let depositAmountValue = parseFloat(
            removeComma(commissionRow.find('.deposit-amount-value').val())
        );

        if(payCommisionAmount <= 0){

            Toast.fire({
                icon: 'error',
                title: 'Please Enter Correct Commission Amount First.'
            });

            $(this).val('0.00');
        }

        if(payCommisionAmount > depositAmountValue){

            let bankAmountValue = payCommisionAmount - depositAmountValue;
            commissionRow.find('.bank-amount-value').val(check(bankAmountValue));

            getBankTotalAmountPaid();
        }

        totalDepositAmountValues();
        calTotalDepositAmountLeftToAllocate();
    });

    $(document).on('change', '.finance-child', function(event) {
        
        let commissionRow = $(this).closest('.commission-row');

        let financeChild = commissionRow.find('.finance-child').prop('checked');

        if (financeChild) {

            let outstandingAmountLeft = parseFloat(commissionRow.find('.outstanding-amount-left').val());
            commissionRow.find('.pay-commission-amount').val(check(outstandingAmountLeft));

            getRowTotalPaidAmount(commissionRow);
            getRowTotalOutstandingAmount(commissionRow);
            calDepositAndBankAmountValue(commissionRow);

        } else {

            resetCommissionRow(commissionRow);
        }

        getTotalPayCommissionAmount();
        // totalDepositAmountLeftToAllocate();
        getBankTotalAmountPaid();
        getBookingCommissionTotalPaidAmount();
        getTotalOutstandingAmount();
        getDepositAndPayCommissionTotal();


        calTotalDepositAmountLeftToAllocate();


        totalDepositAmountValues();
        totalBankAmountValues();
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

    $("#pay_deposit_amount_row").hide();
    $("#pay_deposit_amount").click(function(){
        $("#pay_deposit_amount_row").toggle();
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
});