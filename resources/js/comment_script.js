
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