
$(document).on('click', '.collapse-all-btn', function(event) {
    $('#parent .quote').addClass('collapsed-card');
    $('#parent .card-body').css("display", "none");
    $('#parent .collapse-expand-btn').html(`<i class="fas fa-plus"></i>`);
    // $(this).addClass('d-none');
    // $('.expand-all-btn').removeClass('d-none');
});


    Toast.fire({
        icon: 'success',
        title: data.success_message
    });

    setTimeout(function(){
        window.location.href = REDIRECT_BASEURL + "quotes/index";
    }, 2200);

    
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

$(function(){ // let all dom elements are loaded
    jQuery('.insert-quick-text-modal').on('hidden.bs.modal', function () {
        console.log("modal closed");

        var values = $(".quick-comment:checked").val();
        $(`#quote_${quoteKeyForComment}_comments`).val(values);

        console.log(values);
    });
});

$(document).on('change', '.supplier-id',function(){
    var $selector = $(this);
    var supplier_id = $(this).val();
    var options = '';
    $.ajax({
        type: 'get',
        url: BASEURL+'supplier/to/product/currency',
        data: { 'id': supplier_id },
        success: function(response) {
            options += '<option value="">Select Product</option>';
            $.each(response.product,function(key,value){
                options += '<option value="'+value.id+'">'+value.name+'</option>';
            });

            $selector.closest('.row').find('.supplier-currency-id').val(response.currency).change();
            $selector.closest('.row').find('.product-id').html(options);
        }
    })
});

$(document).on('click', '.quotes-service-category-btn-below', function(e) {

    e.preventDefault();

    var category_id   = $(this).attr('data-id');
    var category_name = $(this).attr('data-name');

    var classvalue =  jQuery('#new_service_modal_before').find('.current-key').val();
   var quoteClass = `.quote-${classvalue}`;

    jQuery('#new_service_modal').modal('hide');
    $('.parent-spinner').addClass('spinner-border');

    if(category_id){

        setTimeout(function() {


            if ($('.select2single').data('select2')) {
                $('.select2single').select2('destroy');
            }

            var q = $(".quote").eq(0).clone()
                .find("input").val("").each(function() {
                    this.name = this.name.replace(/\[(\d+)\]/, function() {
                        return '[' + ($('.quote').length) + ']';
                    });
                    this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                        return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                    });
                }).end()
                .find("textarea").val("").each(function() {
                    this.name = this.name.replace(/\[(\d+)\]/, function() {
                        return '[' + (parseInt($('.quote').length)) + ']';
                    });
                    this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                        return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                    });
                }).end()
                .find("select").val("").each(function() {
                    this.name = this.name.replace(/\[(\d+)\]/, function() { return '[' + ($('.quote').length) + ']'; });
                    this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                        return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                    });
                }).end().show().insertAfter(quoteClass);

            $('.supplier-id:last').html(`<option selected value="">Select Supplier</option>`);
            $('.product-id:last').html(`<option selected value="">Select Product</option>`);
            $(".quote:last").attr('data-key', $('.quote').length - 1);
            $(".estimated-cost:last, .markup-amount:last, .markup-percentage:last, .selling-price:last, .profit-percentage:last, .estimated-cost-in-booking-currency:last, .selling-price-in-booking-currency:last, .markup-amount-in-booking-currency:last").val('0.00').attr('data-code', '');
            $('.quote:last .text-danger, .quote:last .supplier-currency-code').html('');
            $('.quote:last input, .quote:last select').removeClass('is-invalid');
            $('.quote:last .card-header .card-tools .remove').addClass('remove-quote-detail-service');
            $('.quote:last .card-header .card-tools .remove').removeClass('d-none');
            $('.quote:last .refundable-percentage-feild').addClass('d-none');
            // $(".quote:last").prepend("<div class='row'><div class='col-sm-12'><button type='button' class='btn pull-right close'> x </button></div>");

            $('.quote:last .category-id').val(category_id).change();
            $('.quote:last .badge-category-id').html(category_name);
            $('.quote:last .badge-date-of-service, .quote:last .badge-time-of-service, .quote:last .badge-supplier-id, .quote:last .badge-product-id, .quote:last .badge-supplier-currency-id').addClass('d-none');
            $('.quote:last .badge-date-of-service, .quote:last .badge-time-of-service, .quote:last .badge-supplier-id, .quote:last .badge-product-id, .quote:last .badge-supplier-currency-id').html('');


            var qleng = $('.quote').length - 1;
            $('.fileManger:last').attr('data-input', 'quote_' + qleng + '_image');
            $('.fileManger:last').attr('data-preview', 'quote_' + qleng + '_holder');
            $('.previewId:last').attr('id', 'quote_' + qleng + '_holder');
            $('#quote_' + qleng + '_holder').empty();
            callLaravelFileManger();
            datepickerReset(1);
            calltextEditorSummerNote('#quote_' + qleng + '_service_details');
            calltextEditorSummerNote('#quote_' + qleng + '_stored_text');
            reinitializedSingleSelect2();

            $('html, body').animate({ scrollTop: $('.quote:last').offset().top }, 1000);

            $('.parent-spinner').removeClass('spinner-border');

        }, 180);

    }
});

$(document).on('click', '.close', function() {
    $(this).closest(".quote").remove();
    getQuoteTotalValues();
    getSellingPrice();
});

jQuery('.summernotes').summernote({
    height: 150,   //set editable area's height
    placeholder: 'Enter Text Here..',
    codemirror: { // codemirror options
        theme: 'monokai'
    },
});

$(document).on('click', '.add-category-detail', function() {

    var quote = jQuery(this).closest('.quote');
    var key = quote.data('key');
    var type = $(`#quote_${key}_category_id`).find(':selected').data('slug');

    if (typeof type === 'undefined') {
        alert("Please Select Category first");
    }
    quote.find(`.${type}_modal`).modal('show');
    quote.find(`.${type}_modal :input`).removeAttr('disabled');
    jQuery('#accomadation_modal').modal('show').find('input').val('');
});

$('.sbp-child').change(function(){

    var currencyCode          = $(this).attr('data-currencyCode');
    var outstandingAmountLeft = $(this).attr('data-outstandingAmountLeft');
    var dataID                = $(this).attr('data-id');
    var type                = $(this).attr('data-type');

    var totalPaidAmount = 0;

    if($(this).is(':checked')){
        $(`#${dataID}`).html(`${currencyCode} ${outstandingAmountLeft}`);




    }
    else {

        $(`#${dataID}`).html('');

    }

});

function getCheckedValues(){
    var checkedValuesArray = $('.credit:checked').map((i, e) => parseFloat(e.value)).get();
    var checkedValuesTotal = checkedValuesArray.reduce((a, b) => (a + b), 0);
    return parseFloat(checkedValuesTotal).toFixed(2);
}

$('.credit').change(function(){

    var result = 0;
    var currencyCode          = $(this).attr('data-currencyCode');
    var dataID                = $(this).attr('data-id');
    var value                 = parseFloat($(this).val()).toFixed(2);

    var checkDebit              = $('.debit').is(':checked');
    var checkedValuesTotal      = parseFloat(getCheckedValues()).toFixed(2);
    var totalWalletAmount       = parseFloat($('.debit').val()).toFixed(2);
    var debitCheckedValuesTotal = parseFloat(totalWalletAmount);

    if($(this).is(':checked')){

        $(`.${dataID}`).html(`${currencyCode} ${value}`);

        if(checkDebit){

            if(debitCheckedValuesTotal > checkedValuesTotal){
                result = debitCheckedValuesTotal - checkedValuesTotal;
                $('.total-paid-amount').val(checkedValuesTotal);
                $('.remaining-credit-amount').html(result);

            }else{
                result = checkedValuesTotal - debitCheckedValuesTotal;
                $('.total-paid-amount').val(parseFloat(result).toFixed(2));
                $('.remaining-credit-amount').html('0.00');
            }
        }else{
            $('.total-paid-amount').val(checkedValuesTotal);
        }
        
    }
    else {
        $(`.${dataID}`).html(currencyCode + " " +parseFloat(0).toFixed(2));

        if(checkDebit){

            if(debitCheckedValuesTotal > checkedValuesTotal){
                result = debitCheckedValuesTotal - checkedValuesTotal;

                $('.total-paid-amount').val(checkedValuesTotal);
                $('.remaining-credit-amount').html(result);

            }else{
                result = checkedValuesTotal - debitCheckedValuesTotal;
                $('.total-paid-amount').val(parseFloat(result).toFixed(2));
                $('.remaining-credit-amount').html('0.00');
            }
        }else{
            $('.total-paid-amount').val(checkedValuesTotal);
        }

    }
});

$('.debit').change(function(){

    var totalWalletAmount = parseFloat($(this).val()).toFixed(2);
    var debitCheckedValuesTotal = parseFloat(totalWalletAmount);
    var result = 0;
    var checkedValuesTotal = parseFloat(getCheckedValues());
    var currencyCode          = $(this).attr('data-currencyCode');

    if($(this).is(':checked')){

        if(debitCheckedValuesTotal > checkedValuesTotal){

            result = debitCheckedValuesTotal - checkedValuesTotal;
            $('.remaining-credit-amount').html(result.toFixed(2));
        }
        
        else{
            result = checkedValuesTotal - debitCheckedValuesTotal;
            $('.total-paid-amount').val(parseFloat(result).toFixed(2));
            $('.remaining-credit-amount').html('0.00');
        }

    }
    else {

        $(`.remaining-credit-amount`).html(totalWalletAmount);
        $('.total-paid-amount').val(getCheckedValues());
    }
});

$(document).on('change', '.agency-commission', function() {

    onChangeAgencyCommission();
});

$(document).on('change', '.datepicker', function() {
    // var datePicker_id     = $(this).attr('id');
    var name = $(this).data('name');
    var key = $(this).closest('.quote').data('key');
    var DateOFService = $('#quote_' + key + '_date_of_service').val();
    var BookingDate = $('#quote_' + key + '_booking_date').val();
    var BookingDueDate = $('#quote_' + key + '_booking_due_date').val();
    var EndDateOFService = $('#quote_' + key + '_end_date_of_service').val();

    // console.log(DateOFService + ' #quote_'+key+'_date_of_service ');

    //*******Seasons start and*********//
    var $season = $("#season_id");
    var season_start_date = new Date($season.find(':selected').data('start'));
    var season_end_date = new Date($season.find(':selected').data('end'));
    // console.log('season start date', season_start_date);
    // console.log('season end date', season_end_date);
    // console.log(name+ ' case name');

    if (convertDate(DateOFService) > convertDate(EndDateOFService)) {
        $('#quote_' + key + '_end_date_of_service').datepicker("setDate", '');
    }


    switch (name) {

        case 'end_date_of_service':
            EndDateOFService = convertDate($(this).val());



            if (convertDate(BookingDate) >= EndDateOFService) {
                $('#quote_' + key + '_booking_date').datepicker("setDate", '');
                BookingDate = '';
            }

            if (convertDate(BookingDueDate) >= EndDateOFService) {
                $('#quote_' + key + '_booking_due_date').datepicker("setDate", '');
                BookingDueDate = '';
            }


            // BookingDueDate = (BookingDueDate != '')? convertDate(BookingDueDate) : season_start_date;
            // BookingDate    = (BookingDate != '')? convertDate(BookingDate) : DateOFService;

            // if(DateOFService < BookingDueDate){
            //     $('#quote_'+key+'_booking_due_date').datepicker("setDate", '');
            //     $('#quote_'+key+'_booking_date').datepicker("setDate", '');
            // }
            if (convertDate(DateOFService) > EndDateOFService) {
                $('#quote_' + key + '_date_of_service').datepicker("setDate", '');
                // $('#quote_'+key+'_date_of_service').datepicker('remove').datepicker({ autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: EndDateOFService});

            }
            var BookingDate = (BookingDate != '') ? convertDate(BookingDate) : ((BookingDueDate != '') ? convertDate(BookingDueDate) : season_start_date);
            // console.log(BookingDate+ BookingDueDate);
            $('#quote_' + key + '_date_of_service').datepicker('remove').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: BookingDate, endDate: EndDateOFService });
            //     $('#quote_'+key+'_booking_date').datepicker('remove').datepicker({ autoclose: true, format:'dd/mm/yyyy', startDate: BookingDueDate, endDate: DateOFService});
            //     $('#quote_'+key+'_booking_due_date').datepicker('remove').datepicker({ autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: BookingDate});
            break;

        case 'date_of_service':
            // console.log('run date of service function');



            DateOFService = ($(this).val() != '') ? convertDate($(this).val()) : season_end_date;
            BookingDueDate = (BookingDueDate != '') ? convertDate(BookingDueDate) : season_start_date;
            BookingDate = (BookingDate != '') ? convertDate(BookingDate) : DateOFService;

            if (DateOFService > convertDate(EndDateOFService)) {
                $('#quote_' + key + '_end_date_of_service').datepicker("setDate", '');
                EndDateOFService = '';
            }

            if (DateOFService < BookingDueDate) {
                $('#quote_' + key + '_booking_due_date').datepicker("setDate", '');
                $('#quote_' + key + '_booking_due_date').datepicker('remove').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: season_start_date, endDate: DateOFService });
            } else {
                $('#quote_' + key + '_booking_due_date').datepicker('remove').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: season_start_date, endDate: BookingDate });
            }

            if (DateOFService < BookingDate) {
                $('#quote_' + key + '_booking_date').datepicker("setDate", '');
                $('#quote_' + key + '_booking_date').datepicker('remove').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: season_start_date, endDate: DateOFService });
            } else {
                $('#quote_' + key + '_booking_date').datepicker('remove').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: BookingDueDate, endDate: DateOFService });
            }



            $('#quote_' + key + '_date_of_service').datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: BookingDate, endDate: season_end_date });
            $('#quote_' + key + '_end_date_of_service').datepicker('remove').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: DateOFService, endDate: season_end_date });
            break;
        case 'booking_date':
            BookingDate = convertDate($(this).val());

            if (BookingDate <= convertDate(BookingDueDate)) {
                $('#quote_' + key + '_booking_due_date').datepicker("setDate", '');
                BookingDueDate = '';
            }

            if (BookingDate > convertDate(DateOFService)) {
                $('#quote_' + key + '_date_of_service').datepicker("setDate", '');
                $('#quote_' + key + '_end_date_of_service').datepicker("setDate", '');
                DateOFService = '';
            }

            $('#quote_' + key + '_date_of_service').datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: BookingDate, endDate: season_end_date });
            var endDos_start = (DateOFService != '') ? convertDate(DateOFService) : ((BookingDate != '') ? BookingDate : season_start_date);
            $('#quote_' + key + '_end_date_of_service').datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: endDos_start, endDate: season_end_date });
            var setDueDate = (BookingDate != '') ? BookingDate : (DateOFService != '') ? convertDate(DateOFService) : season_end_date;
            // console.log(setDueDate);
            $('#quote_' + key + '_booking_due_date').datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: season_start_date, endDate: setDueDate });

            break;
        case 'booking_due_date':
            BookingDueDate = convertDate($(this).val());
            if (BookingDueDate > convertDate(BookingDate)) {
                $('#quote_' + key + '_booking_date').datepicker("setDate", '');
                BookingDate = '';
                // console.log('run');
            }

            if (BookingDueDate > convertDate(DateOFService)) {
                $('#quote_' + key + '_date_of_service').datepicker("setDate", '');
                DateOFService = '';
            }

            if (BookingDueDate > convertDate(EndDateOFService)) {
                $('#quote_' + key + '_end_date_of_service').datepicker("setDate", '');
                EndDateOFService = '';
            }


            // if(convertDate(BookingDueDate) > convertDate(DateOFService)){
            //     $('#quote_'+key+'_booking_date').datepicker("setDate", '');
            //     $('#quote_'+key+'_date_of_service').datepicker("setDate", '');
            // }
            // if(convertDate(BookingDueDate) > convertDate(BookingDate)){
            //     $('#quote_'+key+'_booking_date').datepicker("setDate", '');
            // }

            var Booking_Date = (BookingDate != '') ? convertDate(BookingDate) : BookingDueDate;
            // console.log(Booking_Date);
            DateOFService = (DateOFService != '') ? convertDate(DateOFService) : season_end_date;
            // console.log('Date of service'+ DateOFService);

            $('#quote_' + key + '_booking_date').datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: BookingDueDate, endDate: DateOFService });
            $('#quote_' + key + '_date_of_service').datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: Booking_Date, endDate: DateOFService });

            break;

        default:
            datepickerReset();
            break;
    }
});

// change Category, Supplier, Product Scenarios Before Work
$(document).on('change', '.category-id', function() {

    // var selector      = $(this);
    var quote             = $(this).closest('.quote');
    var quoteKey          = quote.data('key');

    var detail_id         = $(`#quote_${quoteKey}_detail_id`).val();
    var model_name        = $(`#model_name`).val();

    var category_id       = $(this).val();
    var category_name     = $(this).find(':selected').attr('data-name');
    var category_slug     = $(this).find(':selected').attr('data-slug');
    var options           = '';


    // set category name in car header
    quote.find('.badge-category-id').html(category_name);

    // set supplier dropdown null when category become null
    if(typeof category_id === 'undefined' || category_id == ""){
        quote.find('.badge-category-id').html("");
        $(`#quote_${quoteKey}_supplier_id`).html("<option value=''>Select Supplier</option>");
        $(`#quote_${quoteKey}_supplier_id`).val("").trigger('change');
    }

    // set Payment type (Booking Type) refundable when category is fligt
    if(category_slug == 'flights'){
        let refundable = $(`#quote_${quoteKey}_booking_type_id`).find("option[data-slug='refundable']").val();
        $(`#quote_${quoteKey}_booking_type_id`).val(refundable).trigger('change');
    }else{
        $(`#quote_${quoteKey}_booking_type_id`).val('').trigger('change');
    }

    $.ajax({
        type: 'get',
        url: `${BASEURL}category/to/supplier`,
        data: { 'category_id': category_id, 'detail_id': detail_id, 'model_name': model_name },
        success: function(response) {

            // set supplier dropdown
            options += "<option value=''>Select Supplier</option>";
            $.each(response.suppliers, function(key, value) {
                options += `<option value='${value.id}' data-name='${value.name}'>${value.name}</option>`;
            });
            $(`#quote_${quoteKey}_supplier_id`).html(options);

            // set category details feilds 
            if(typeof response.category_details != 'undefined') {
                quote.find('.category-details').val(response.category_details);
            }

            // Hide & Show Category details btn according to status
            if((response.category != "") && (typeof response.category !== 'undefined')){

                if(response.category.quote == 1){
                    quote.find('.quote-category-detail-btn-parent').removeClass('d-none');
                    quote.find('.quote-category-detail-btn-parent').addClass('d-flex');
                }else{
                    quote.find('.quote-category-detail-btn-parent').removeClass('d-flex');
                    quote.find('.quote-category-detail-btn-parent').addClass('d-none');
                }

                if(response.category.booking == 1){
                    quote.find('.booking-category-detail-btn-parent').removeClass('d-none');
                    quote.find('.booking-category-detail-btn-parent').addClass('d-flex');
                }else{
                    quote.find('.booking-category-detail-btn-parent').removeClass('d-flex');
                    quote.find('.booking-category-detail-btn-parent').addClass('d-none');
                }
            }
            
            // reset product & supplier Sheet
            $(`#quote_${quoteKey}_product_id`).html("<option value=''>Select Product</option>");
            quote.find('.view-supplier-rate').attr("href","");
            quote.find('.view-supplier-rate').html("");
        }
    })

});


// setTimeout(function() {

//     var flag=true;

//     $("#overlay").removeClass('overlay').html('');

//     jQuery.each(errors.errors, function( index, value ) {

//         index = index.replace(/\./g,'_');
//         $(`#${index}`).addClass('is-invalid');
//         $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

//         if(flag) {

//             $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
//             flag = false;
//         }

//     });
// }, 800);

 // $('#update-booking :input').prop('disabled', false);


     $(document).on('change', '.commission-id', function() {

        let commission_id = $(this).val();
        var options       = '';
        var url           = BASEURL + 'get-commission-groups'
        $.ajax({
            type: 'get',
            url: url,
            data: { 'commission_id': commission_id },
            success: function(response){
                options += '<option value="">Select Commission Group</option>';
                $.each(response, function(key, value) {
                    options += '<option data-name="' + value.name + '" value="' + value.id + '">' + value.name + '</option>';
                });

                // $('.commission-group-id').html(options);
            }
        });
    });


// if(agency == 1 && agencyCommissionType == 'we-pay-commission-on-departure'){
//     $('.paid-net-commission-on-departure').removeClass('d-none');
//     getCalculatedTotalNetMarkup();
//     // $(".agency-total-markup").val(check(markupAmountInBookingCurrency));
// }

// var estimatedCostInBookingCurrencyArray     = $('.estimated-cost-in-booking-currency').map((i, e) => parseFloat(e.value)).get();
// var estimatedCostInBookingCurrency          = estimatedCostInBookingCurrencyArray.reduce((a, b) => (a + b), 0);

// var markupAmountInBookingCurrencyArray      = $('.selling-price-in-booking-currency').map((i, e) => parseFloat(e.value)).get();
// var calculatedMarkupAmountInBookingCurrency = markupAmountInBookingCurrencyArray.reduce((a, b) => (a + b), 0);

// var markupAmountInBookingCurrency           = $('.markup-amount-in-booking-currency').map((i, e) => parseFloat(e.value)).get();
// var calculatedMarkupAmountInBookingCurrency = markupAmountInBookingCurrency.reduce((a, b) => (a + b), 0);

// var markupPercentageArray                   = $('.markup-percentage').map((i, e) => parseFloat(e.value)).get();
// var calculatedmarkupPercentage              = markupPercentageArray.reduce((a, b) => (a + b), 0);

// var profitPercentagetArray                  = $('.profit-percentage').map((i, e) => parseFloat(e.value)).get();
// var calculatedProfitPercentage              = profitPercentagetArray.reduce((a, b) => (a + b), 0);

// $(".total-net-price").val(check(estimatedCostInBookingCurrency));
// $(".total-selling-price").val(check(calculatedMarkupAmountInBookingCurrency));
// $(".total-markup-amount").val(check(calculatedMarkupAmountInBookingCurrency));
// $(".total-profit-percentage").val(check(calculatedProfitPercentage));
// $(".total-markup-percent").val(check(calculatedmarkupPercentage));



        // $(this).closest('.quote').find('.refund-payment-section').removeAttr("hidden");
        // // $(this).closest('.quote').find('.credit-note-hidden-section').attr("hidden",true);

        // $(`#quote_${quoteKey}_credit_note_0_credit_note_amount`).val('');

        // var totalDepositAmountArray = $(this).closest('.quote').find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
        // var totalDepositAmount      = totalDepositAmountArray.reduce((a, b) => (a + b), 0);

        // $(this).closest('.quote').find('.refund_amount').val('0.00');

        // var booking_detail_id = $(this).data('booking_detail_id');

        // var totalDepositAmountArray  = $(this).closest('.quote').find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
        // var totalDepositAmount = totalDepositAmountArray.reduce((a, b) => (a + b), 0);
        // $('#total_deposit_amount').val(totalDepositAmount);

        // jQuery('#refund_to_bank_modal').modal('show');
        // $('#booking_detail_id').val(booking_detail_id);