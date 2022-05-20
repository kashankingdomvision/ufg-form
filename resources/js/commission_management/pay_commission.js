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

});