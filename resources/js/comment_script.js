
function calculateQuoteDetailsCalcualtionForBooking(key,changeFeild){

    var estimatedCost                            = parseFloat($(`#quote_${key}_actual_cost`).val()).toFixed(2);
    var supplierCurrency                         = $(`#quote_${key}_supplier_currency_id`).find(':selected').data('code');
    var bookingCurrency                          = $(".booking-currency-id").find(':selected').data('code');
    var rateType                                 = $('input[name="rate_type"]:checked').val();
    var rate                                     = getRate(supplierCurrency,bookingCurrency,rateType);
    var markupPercentage                         = parseFloat($(`#quote_${key}_markup_percentage`).val());
    var markupAmount                             = parseFloat($(`#quote_${key}_markup_amount`).val());
    var calculatedSellingPrice                   = 0;
    var calculatedMarkupPercentage               = 0;
    var calculatedMarkupAmount                   = 0;
    var calculatedProfitPercentage               = 0;
    var calculatedMarkupAmountInBookingCurrency  = 0;
    var calculatedEstimatedCostInBookingCurrency = 0;
    var calculatedSellingPriceInBookingCurrency  = 0;

    if(changeFeild == 'actual_cost'){

        calculatedSellingPrice                   = parseFloat(markupAmount) + parseFloat(estimatedCost);
        calculatedMarkupPercentage               = parseFloat(markupAmount) / parseFloat(estimatedCost / 100);
        calculatedProfitPercentage               = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
        calculatedSellingPriceInBookingCurrency  = parseFloat(calculatedSellingPrice) * parseFloat(rate);
        calculatedEstimatedCostInBookingCurrency = parseFloat(estimatedCost) * parseFloat(rate);
        
        $(`#quote_${key}_estimated_cost_in_booking_currency`).val(check(calculatedEstimatedCostInBookingCurrency));
        $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
        $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
        $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
    }

    if(changeFeild == 'markup_amount'){

        calculatedSellingPrice                  = parseFloat(markupAmount) + parseFloat(estimatedCost);
        calculatedMarkupPercentage              = parseFloat(markupAmount) / parseFloat(estimatedCost / 100);
        calculatedProfitPercentage              = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
        calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * rate ;
        calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
        
        $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
        $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
        $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
        $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
        $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
    }

    if(changeFeild == 'markup_percentage'){

        calculatedMarkupAmount                  = (parseFloat(estimatedCost) / 100) * parseFloat(markupPercentage);
        calculatedSellingPrice                  = parseFloat(calculatedMarkupAmount) + parseFloat(estimatedCost);
        calculatedProfitPercentage              = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
        calculatedMarkupAmountInBookingCurrency = parseFloat(calculatedMarkupAmount) * parseFloat(rate) ;
        calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
        
        $(`#quote_${key}_markup_amount`).val(check(calculatedMarkupAmount));
        $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
        $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
        $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
        $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
    }

    getBookingTotalValues();
    getSellingPrice();
}

    
function getTotalValues(){

    var estimatedCostInBookingCurrencyArray = $('.estimated-cost-in-booking-currency').map((i, e) => parseFloat(e.value)).get();
    var estimatedCostInBookingCurrency      = estimatedCostInBookingCurrencyArray.reduce((a, b) => (a + b), 0);
    $('.total-net-price').val(check(estimatedCostInBookingCurrency));

    var markupAmountInBookingCurrencyArray      = $('.selling-price-in-booking-currency').map((i, e) => parseFloat(e.value)).get();
    var calculatedMarkupAmountInBookingCurrency = markupAmountInBookingCurrencyArray.reduce((a, b) => (a + b), 0);
    $('.total-selling-price').val(check(calculatedMarkupAmountInBookingCurrency));

    var markupAmountInBookingCurrency           = $('.markup-amount-in-booking-currency').map((i, e) => parseFloat(e.value)).get();
    var calculatedMarkupAmountInBookingCurrency = markupAmountInBookingCurrency.reduce((a, b) => (a + b), 0);
    $('.total-markup-amount').val(check(calculatedMarkupAmountInBookingCurrency));

    var markupPercentageArray      = $('.markup-percentage').map((i, e) => parseFloat(e.value)).get();
    var calculatedmarkupPercentage = markupPercentageArray.reduce((a, b) => (a + b), 0);
    $('.total-markup-percent').val(check(calculatedmarkupPercentage));

    var profitPercentagetArray     = $('.profit-percentage').map((i, e) => parseFloat(e.value)).get();
    var calculatedProfitPercentage = profitPercentagetArray.reduce((a, b) => (a + b), 0);
    $('.total-profit-percentage').val(check(calculatedProfitPercentage));

    getCommissionRate();
}

function changeCurrenyRate(){
    var rateType                                 = $('input[name="rate_type"]:checked').val();
    var estimatedCostArray                       = $('.actual-cost').map((i, e) => parseFloat(e.value).toFixed(2) ).get();
    var sellingPriceArray                        = $('.selling-price').map((i, e) => parseFloat(e.value).toFixed(2) ).get();
    var markupAmountArray                        = $('.markup-amount').map((i, e) => parseFloat(e.value).toFixed(2) ).get();
    var bookingCurrency                          = $('.booking-currency-id').find(':selected').data('code');
    var supplierCurrencyArray                    = $('.supplier-currency-id').map((i, e) => $(e).find(':selected').data('code') ).get();
    var calculatedEstimatedCostInBookingCurrency = 0
    var calculatedSellingPriceInBookingCurrency  = 0;
    var calculatedMarkupAmountInBookingCurrency  = 0;
    var quoteSize                                = parseInt($('.quote').length);
    var key                                      = 0;

    while (key < quoteSize) {

        var estimatedCost    = estimatedCostArray[key];
        var supplierCurrency = supplierCurrencyArray[key];
        var sellingPrice     = sellingPriceArray[key];
        var markupAmount     = markupAmountArray[key];

        if(supplierCurrency && bookingCurrency){

            var rate = getRate(supplierCurrency,bookingCurrency,rateType);
            calculatedEstimatedCostInBookingCurrency = parseFloat(estimatedCost) * parseFloat(rate);
            calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);
            calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);

        }else{
            
            calculatedSellingPriceInBookingCurrency = parseFloat(0.00);
            calculatedMarkupAmountInBookingCurrency = parseFloat(0.00);
        }

        $(`#quote_${key}_estimated_cost_in_booking_currency`).val(check(calculatedEstimatedCostInBookingCurrency));
        $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
        key++;
    }

    getTotalValues();
    getSellingPrice();
}

    // var key         = $(this).closest('.quote').data('key');
        // var changeFeild = $(this).data('name');
        // var estimatedCost               =  parseFloat($(`#quote_${key}_estimated_cost`).val()).toFixed(2);
        // var supplierCurrency            =  $(`#quote_${key}_supplier_currency_id`).find(':selected').data('code');
        // var bookingCurrency             =  $(".booking-currency-id").find(':selected').data('code');
        // var rateType                    =  $('input[name="rate_type"]:checked').val();
        // var rate                        =  getRate(supplierCurrency,bookingCurrency,rateType);
        // var markupPercentage            =  parseFloat($(`#quote_${key}_markup_percentage`).val());
        // var markupAmount                =  parseFloat($(`#quote_${key}_markup_amount`).val());
        // var calculatedSellingPrice                  = 0;
        // var calculatedMarkupPercentage              = 0;
        // var calculatedMarkupAmount                  = 0;
        // var calculatedProfitPercentage              = 0;
        // var calculatedMarkupAmountInBookingCurrency = 0;
        // var calculatedEstimatedCostInBookingCurrency = 0;
        // var calculatedSellingPriceInBookingCurrency = 0;
        // if(changeFeild == 'estimated_cost'){
        //     calculatedSellingPrice                  = parseFloat(markupAmount) + parseFloat(estimatedCost);
        //     calculatedMarkupPercentage              = parseFloat(markupAmount) / parseFloat(estimatedCost / 100);
        //     calculatedProfitPercentage              = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
        //     calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
        //     calculatedEstimatedCostInBookingCurrency = parseFloat(estimatedCost) * parseFloat(rate);
        //     $(`#quote_${key}_estimated_cost_in_booking_currency`).val(check(calculatedEstimatedCostInBookingCurrency));
        //     $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
        //     $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
        //     $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        // }

        // if(changeFeild == 'markup_amount'){
        //     calculatedSellingPrice                  = parseFloat(markupAmount) + parseFloat(estimatedCost);
        //     calculatedMarkupPercentage              = parseFloat(markupAmount) / parseFloat(estimatedCost / 100);
        //     calculatedProfitPercentage              = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
        //     calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * rate ;
        //     calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
        //     $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
        //     $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
        //     $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
        //     $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
        //     $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        // }

        // if(changeFeild == 'markup_percentage'){

        //     calculatedMarkupAmount                  = (parseFloat(estimatedCost) / 100) * parseFloat(markupPercentage);
        //     calculatedSellingPrice                  = parseFloat(calculatedMarkupAmount) + parseFloat(estimatedCost);
        //     calculatedProfitPercentage              = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
        //     calculatedMarkupAmountInBookingCurrency = parseFloat(calculatedMarkupAmount) * parseFloat(rate) ;
        //     calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
        //     $(`#quote_${key}_markup_amount`).val(check(calculatedMarkupAmount));
        //     $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
        //     $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
        //     $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
        //     $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        // }
        // getTotalValues();
        // getSellingPrice();

        $('#create_credit_note').submit(function(event) {
            event.preventDefault();
            var $form = $(this);
            var url = $form.attr('action');
    
            $.ajax({
                type: 'POST',
                url: url,
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    $(".loader_icon").find('span').addClass('spinner-border spinner-border-sm');
                },
                success: function (data) {
            
                    
                    $(".loader_icon").find('span').removeClass('spinner-border spinner-border-sm');
                    jQuery('.create_credit_note').modal('hide');
    
                    setTimeout(function() {
                        alert(data.success_message);
                        window.location.href = REDIRECT_BASEURL + "bookings/index";
    
                        // if(data.success_message){
                        //     alert(data.success_message);
                        //     location.reload();
                        // }
                        
                    }, 800);
                },
                error: function (reject) {
    
                    if( reject.status === 422 ) {
    
                        var errors = $.parseJSON(reject.responseText);
    
                        setTimeout(function() {
        
                            $(".loader_icon").find('span').removeClass('spinner-border spinner-border-sm');
    
                            jQuery.each(errors.errors, function( index, value ) {
    
                                index = index.replace(/\./g,'_');
                                $('#'+index).addClass('is-invalid');
                                $('#'+index).closest('.form-group').find('.text-danger').html(value);
    
                                console.log(index);
                                console.log(value);
    
                            });
    
                        }, 800);
    
                    }
                },
            });
        });
    
        $('#create_refund_to_bank').submit(function(event) {
            event.preventDefault();
            var $form = $(this);
            var url = $form.attr('action');
    
            $.ajax({
                type: 'POST',
                url: url,
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    $("#loader_icon").find('span').addClass('spinner-border spinner-border-sm');
                },
                success: function (data) {
            
                    
                    $("#loader_icon").find('span').removeClass('spinner-border spinner-border-sm');
                    jQuery('#refund_to_bank_modal').modal('hide');
                    setTimeout(function() {
                        alert(data.success_message);
                        window.location.href = REDIRECT_BASEURL + "bookings/index";
    
                        // if(data.success_message){
                        //     alert(data.success_message);
                        //     location.reload();
                        // }
                        
                    }, 800);
                },
                error: function (reject) {
    
                    if( reject.status === 422 ) {
    
                        var errors = $.parseJSON(reject.responseText);
    
                        setTimeout(function() {
        
                            $("#loader_icon").find('span').removeClass('spinner-border spinner-border-sm');
    
                            jQuery.each(errors.errors, function( index, value ) {
    
                                index = index.replace(/\./g,'_');
                                $('#'+index).addClass('is-invalid');
                                $('#'+index).closest('.form-group').find('.text-danger').html(value);
    
                                console.log(index);
                                console.log(value);
    
                            });
    
                        }, 800);
    
                    }
                },
            });
        });

$(document).on('click', '.credit-note', function(){

    // $(this).closest('.quote').find('.credit-note-hidden-section').removeAttr("hidden");
    // // $(this).closest('.quote').find('input, .select2single').prop("disabled", false);

    // var quoteKey                 =  $(this).closest('.quote').data('key');
    // $(`#quote_${quoteKey}_refund_0_refund_amount`).val('');

    // $(this).closest('.quote').find('.refund-payment-hidden-section').attr("hidden",true);

    // var totalDepositAmountArray = $(this).closest('.quote').find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
    // var totalDepositAmount      = totalDepositAmountArray.reduce((a, b) => (a + b), 0);

    // $(this).closest('.quote').find('.credit-note-amount').val(totalDepositAmount.toFixed(2));

    // var booking_detail_id = $(this).data('booking_detail_id');

    // var totalDepositAmountArray  = $(this).closest('.quote').find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
    // var totalDepositAmount = totalDepositAmountArray.reduce((a, b) => (a + b), 0);

    // console.log(totalDepositAmount);
    // console.log(booking_detail_id);

    
    // jQuery('#credit_note_modal').modal('show');
    
    // $('.total_deposit_amount').val(totalDepositAmount);
    // $('.booking_detail_id').val(booking_detail_id);


    

});

$(document).on('change', '.credit-note-amount', function(){

    // var quote                   = $(this).closest('.quote');
    // var totalDepositAmountArray = quote.find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
    // var totalDepositAmount      = totalDepositAmountArray.reduce((a, b) => (a + b), 0);

    // var refundAmountArray       = quote.find('.refund_amount').map((i, e) => parseFloat(e.value)).get();
    // var totalRefundAmount       = refundAmountArray.reduce((a, b) => (a + b), 0);
    
    // var creditNoteAmountArray   = quote.find('.credit-note-amount').not(this).map((i, e) => parseFloat(e.value)).get();
    // var totalCreditNoteAmount   = creditNoteAmountArray.reduce((a, b) => (a + b), 0);

    // var totalReturnedAmount     = totalCreditNoteAmount + totalRefundAmount;
    // var totalAmount             = totalDepositAmount - totalReturnedAmount;

    // if(!isNaN(totalRefundAmount)){

    //     var totalReturnedAmount = totalRefundAmount + totalRefundAmount;
    //     var totalAmount         = totalDepositAmount - totalReturnedAmount;
    // }else{
    //     var totalAmount         = totalDepositAmount - totalCreditNoteAmount;
    // }
    

    // // console.log("totalCreditNoteAmount: " + totalCreditNoteAmount);
    // // console.log("totalDepositAmount: " + totalDepositAmount);

    // // console.log("totalRefundAmount: " + totalRefundAmount);
    // // console.log("totalAmount: " + totalAmount);

    // if($(this).val() > totalAmount){
    //     alert("Please Enter Correct Paid Amount");
    //     $(this).val('0.00');
    // }

    // ______________________________________________________________________________


    // var quote                   = $(this).closest('.quote');
    // var totalDepositAmountArray = quote.find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
    // var totalDepositAmount      = totalDepositAmountArray.reduce((a, b) => (a + b), 0);

    // var amountArray       = quote.find('.amount').map((i, e) => parseFloat(e.value)).get();
    // var amountTotalArray  = amountArray.filter(function (value) { return !Number.isNaN(value); });
    // var totalAmount       = amountTotalArray.reduce((a, b) => (a + b), 0);
    // var actualCost        = totalDepositAmount - totalAmount;

    // quote.find('.actual-cost').val(actualCost);

   

});

$(document).on('change', '.refund_amount', function(){

    // var quote                   = $(this).closest('.quote');
    // var totalDepositAmountArray = quote.find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
    // var totalDepositAmount      = totalDepositAmountArray.reduce((a, b) => (a + b), 0);
    
    // var refundAmountArray       = quote.find('.refund_amount').not(this).map((i, e) => parseFloat(e.value)).get();
    // var totalRefundAmount       = refundAmountArray.reduce((a, b) => (a + b), 0);

    // var creditNoteAmountArray   = quote.find('.credit-note-amount').map((i, e) => parseFloat(e.value)).get();
    // var totalCreditNoteAmount   = creditNoteAmountArray.reduce((a, b) => (a + b), 0);

    // var refundAmountWithArray       = quote.find('.refund_amount').map((i, e) => parseFloat(e.value)).get();
    // var totalRefundAmountWith       = refundAmountWithArray.reduce((a, b) => (a + b), 0);


    // if(!isNaN(totalCreditNoteAmount)){

    //     var totalReturnedAmount = totalCreditNoteAmount + totalRefundAmount;
    //     var totalAmount         = totalDepositAmount - totalReturnedAmount;
    // }else{
    //     var totalAmount         = totalDepositAmount - totalRefundAmount;
    // }

    // if($(this).val() > totalAmount){
    //     alert("Please Enter Correct Paid Amount");
        // $(this).val('0.00');
    // }

    // ______________________________________________________________________________
 


    // var totalDepositAmountArray = quote.find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
    // var totalDepositAmount      = totalDepositAmountArray.reduce((a, b) => (a + b), 0);

    // var amountArray       = quote.find('.amount').map((i, e) => parseFloat(e.value)).get();
    // var amountTotalArray  = amountArray.filter(function (value) { return !Number.isNaN(value); });
    // var totalAmount       = amountTotalArray.reduce((a, b) => (a + b), 0);
    // var actualCost        = totalDepositAmount - totalAmount;

    // quote.find('.actual-cost').val(actualCost);
});