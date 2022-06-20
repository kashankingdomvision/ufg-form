$(document).ready(function() {

    function totalDepositAmountLeftToAllocate() {

        let depositedAmountPayments = $(".deposited-amount-payments").prop('checked');

        if(depositedAmountPayments){

            let bookingCommissionTotalPaidAmount = getTotalPayCommissionAmount();

            // let totalDepositAmount = parseFloat(removeComma($('#total_deposit_amount').val()));

            console.log(bookingCommissionTotalPaidAmount);

            // if(totalDepositAmount > bookingCommissionTotalPaidAmount) {

            //     let totalDepositAmountLeftToAllocate = totalDepositAmount - bookingCommissionTotalPaidAmount;

            //     $('.total-deposit-amount-left-to-allocate')
            //         .html(check(totalDepositAmountLeftToAllocate))
            //         .val(check(totalDepositAmountLeftToAllocate));


            //     return totalDepositAmountLeftToAllocate;
                    
            // }

            // if( totalDepositAmount <= bookingCommissionTotalPaidAmount ){
            //     $('.total-deposit-amount-left-to-allocate')
            //         .html('0.00')
            //         .val('0.00');

            //     return 0.00;
            // }

        }else{

            $('.total-deposit-amount-left-to-allocate')
                .html('0.00')
                .val('0.00');

            return 0.00;
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

    function getTotalPaidAmount() {

        let spDepositAmount = $('#sp_deposit_amount').val() == '' ? 0.00 : removeComma($('#sp_deposit_amount').val());
        let totalPaidAmount = parseFloat(getBookingCommissionTotalPaidAmount()) + parseFloat(spDepositAmount);

        $('.total-paid-amount')
            .html(check(totalPaidAmount))
            .val(check(totalPaidAmount));

        return totalPaidAmount;
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

        let depositedAmountPayments = $("#deposited_amount_payments").prop('checked');

        if(typeof depositedAmountPayments != 'undefined' && depositedAmountPayments){

            let bookingCommissionTotalPaidAmount = getTotalPayCommissionAmount();
            let totalDepositAmount = parseFloat(removeComma($('#total_deposit_amount').val()));

            if(bookingCommissionTotalPaidAmount > totalDepositAmount){
                let bankTotalAmountPaid = bookingCommissionTotalPaidAmount - totalDepositAmount;
                $('#bank_total_amount_paid').val(check(bankTotalAmountPaid));
            }else{
                $('#bank_total_amount_paid').val('0.00');
            }
    
        }
        else{

            $('#bank_total_amount_paid').val(check(getBookingCommissionTotalPaidAmount()));
        }
    }

    function calDepositAndBankAmountValue(commissionRow) {

        let depositedAmountPayments = $(".deposited-amount-payments").prop('checked');

        if(depositedAmountPayments) {

            let totalDepositAmountLeftToAllocateValue = parseFloat(removeComma($('.total-deposit-amount-left-to-allocate').val()));
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

    }

    function resetCommissionRow(commissionRow) {
        commissionRow.find('.pay-commission-amount').val('0.00');
        commissionRow.find('.finance-child').prop('checked', false).val('0');
        commissionRow.find('.row-total-paid-amount').val('0.00');
        commissionRow.find('.row-total-outstanding-amount').val('0.00');
        commissionRow.find('.deposited-amount-value').val('0.00');
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

            getBankTotalAmountPaid();
        }

        getTotalPayCommissionAmount();
        getBookingCommissionTotalPaidAmount();
        getTotalOutstandingAmount();
        getTotalPaidAmount();
    });

    $(document).on('change', '#sp_deposit_amount', function(event) {

        let spDepositAmount = $(this).val() == '' ? 0.00 : parseFloat(removeComma($('#sp_deposit_amount').val()));

        $('.sp-deposit-amount')
            .html(check(spDepositAmount))
            .val(check(spDepositAmount));

        getTotalPaidAmount();
    });

    $(document).on('change', '.deposited-amount-payments', function(event) {

        let commissionRow         = $(this).closest('.commission-row');
        let depositedAmountPayments = $(".deposited-amount-payments").prop('checked');

        let totalOutstandingAmount = parseFloat(removeComma(commissionRow.find('.current-deposited-total-outstanding-amount').val()));

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
        totalDepositAmountLeftToAllocate();
        getBankTotalAmountPaid();
        getBookingCommissionTotalPaidAmount();
        getTotalOutstandingAmount();
        getTotalPaidAmount();
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
});