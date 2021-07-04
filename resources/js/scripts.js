import $ from 'jquery';
import select2 from 'select2';
var BASEURL = 'http://localhost/ufg-form/public/json/';



$(document).ready(function($) {
    $('.select2').select2({
        width: '100%',
    });


    $(document).on('change', '.getBrandtoHoliday',function(){
            let brand_id = $(this).val();
            var options = '';
            var url = BASEURL+'holiday-types'
        $.ajax({
            type: 'get',
            url: url,
            data: { 'brand_id': brand_id },
            success: function(response) {
                options += '<option value="">Select Holiday Type</option>';
                $.each(response,function(key,value){
                    options += '<option value="'+value.id+'">'+value.name+'</option>';
                });
                $('.appendHolidayType').html(options);
            }
        });
    });

    $(document).on('change', '.changeRole', function() {
        var role = $(this).find('option:selected').data('role');
        var supervisor = $('.userSupervisor');
        if (role == 'Sales Agent' || role == 2) {
            supervisor.show();
            $('#selectSupervisor').removeAttr('disabled');
        } else {
            supervisor.hide();
            $('#selectSupervisor').attr('disabled', 'disabled');
        }
    });
        
    $('.currencyImage').select2({
        templateResult: currencyImageFormate,
        templateSelection: currencyImageFormate
    });

    function currencyImageFormate(opt) {
        var optimage = $(opt.element).attr('data-image');
        if (!optimage) {
            return opt.text ;
        }
            var $opt = $(
                '<span><img height="20" width="20" src="' + optimage + '" width="60px" /> ' + opt.text + '</span>'
            );
            return $opt;    
    }

     
    $(document).on('change', '.category-select2',function(){
 
        var $selector = $(this);
        var category_id = $(this).val();
        var options = '';

        $.ajax({
            type: 'get',
            url: url,
            data: { 'category_id': category_id },
            success: function(response) {

                options += '<option value="">Select Supplier</option>';
                $.each(response,function(key,value){
                    options += '<option value="'+value.id+'">'+value.name+'</option>';
                });

                $selector.closest('.row').find('[class*="supplier-select2"]').html(options);
                $selector.closest('.row').find('[class*="product-select2"]').html('<option value="">Select Product</option>');
                $selector.closest('.qoute').find('[name="service_details[]"]').val('');
            }
        })
        
    });


/**
 * -------------------------------------------------------------------------------------
 *                                Quote Manangement
 * -------------------------------------------------------------------------------------
*/

    $('.pax-number').select2();

    $('.selling-price-other-currency').select2({
        // width: '68%',
        width: 'resolve',
        templateResult: currencyImageFormate,
        templateSelection: currencyImageFormate
    });

    $('.booking-currency-id, .supplier-currency-id').select2({
        templateResult: currencyImageFormate,
        templateSelection: currencyImageFormate
    });

    $(document).on('click', '#add_more', function(e) {
            
        $(".quote").eq(0).clone()
            .find("input").val("") .each(function(){
                this.name = this.name.replace(/\[(\d+)\]/, function(str,p1){                        
                    return '[' + ($('.quote').length) + ']';
                });

                this.id = this.id.replace(/\d+/g, $('.quote').length, function(str,p1){                        
                    return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                });

            }).end()
            .find("textarea").val("").each(function(){
                this.name = this.name.replace(/\[(\d+)\]/, function(str,p1){
                    return '[' + (parseInt($('.quote').length)) + ']';
                });
                this.id = this.id.replace(/\d+/g, $('.quote').length, function(str,p1){                        
                    return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                });
 
            }).end()
            .find(".select234").val("").each(function(){
                this.name = this.name.replace(/\[(\d+)\]/, function(str,p1){
                    return '[' + ($('.quote').length) + ']';
                });
                this.id = this.id.replace(/\d+/g, $('.quote').length, function(str,p1){                        
                    return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                });
            }).end()
            .show()
            .insertAfter(".quote:last");
            
            $(".quote:last").attr('data-key', $('.quote').length - 1);
            
            $(".estimated-cost:last, .markup-amount:last, .markup-percentage:last, .selling-price:last, .profit-percentage:last, .selling-price-in-booking-currency:last, .markup-amount-in-booking-currency:last").val('0.00').attr('data-code', '');
            $('.alert-danger').html('');
            $(".quote:last").prepend("<div class='row'><div class='col-sm-12'><button type='button' class='btn pull-right close'> x </button></div>");
            
        
            // reinitializedDynamicFeilds();
            // datePickerSetDate();
    });

    $(document).on('click', '.close',function(){
        $(this).closest(".quote").remove();
    });
    
    $(document).on('change', '.supplier-currency-id',function () {
        $(this).closest(".quote").find('[class*="supplier-currency-code"]').html($(this).val());
    });

    function reinitializedDynamicFeilds(){

        $('.reinitialized-select2').removeClass('select2-hidden-accessible').next().remove();
        $('.reinitialized-select2').select2();
    }

    var currencyConvert = getJson();

    function getJson(url) {

        return JSON.parse($.ajax({
            type: 'GET',
            url : BASEURL+'get-currency-conversion',
            dataType: 'json',
            global: false,
            async: false,
            success: function (data) {
                return data;
            }
        }).responseText);
    }

    function check(x) {

        if(isNaN(x) || !isFinite(x) ){
            return parseFloat(0).toFixed(2);
        }

        return x.toFixed(2);
    }

    function getRate(supplierCurrency,bookingCurrency,rateType){

        console.log( "getRate: " + supplierCurrency);
        console.log( "getRate: " + bookingCurrency);
        console.log( "getRate: " + rateType);

        var object = currencyConvert.filter(function(elem) {
            return elem.from == supplierCurrency && elem.to == bookingCurrency
        });

        return (object.shift()[rateType]);
    }

    function getTotalValues(){

        var markupAmountInBookingCurrencyArray  =  $('.selling-price-in-booking-currency').map((i, e) => parseFloat(e.value)).get();
        var calculatedMarkupAmountInBookingCurrency       =  markupAmountInBookingCurrencyArray.reduce((a, b) => (a + b), 0);
        $('.total-selling-price').val(check(calculatedMarkupAmountInBookingCurrency));

        var markupAmountInBookingCurrency  =  $('.markup-amount-in-booking-currency').map((i, e) => parseFloat(e.value)).get();
        var calculatedMarkupAmountInBookingCurrency       =  markupAmountInBookingCurrency.reduce((a, b) => (a + b), 0);
        $('.total-markup-amount').val(check(calculatedMarkupAmountInBookingCurrency));

        var markupPercentageArray      =  $('.markup-percentage').map((i, e) => parseFloat(e.value)).get();
        var calculatedmarkupPercentage =  markupPercentageArray.reduce((a, b) => (a + b), 0);
        $('.total-markup-percent').val(check(calculatedmarkupPercentage));

        var profitPercentagetArray  =  $('.profit-percentage').map((i, e) => parseFloat(e.value)).get();
        var calculatedProfitPercentage      =  profitPercentagetArray.reduce((a, b) => (a + b), 0);
        $('.total-profit-percentage').val(check(calculatedProfitPercentage));
    }

    function getSellingPrice(){

        var sellingPriceOtherCurrency        =  $('.selling-price-other-currency').val();

        if(sellingPriceOtherCurrency){

            var rateType                      =  $('input[name="rate_type"]:checked').val();
            var paxNumber                     =  parseFloat($(".pax-number").val());
            var bookingCurrency               =  $(".booking-currency-id").val();
            var totalSellingPrice             =  parseFloat($('.total-selling-price').val());
            var rate                          =  getRate(bookingCurrency,sellingPriceOtherCurrency,rateType);
            var sellingPriceOtherCurrencyRate =  parseFloat(totalSellingPrice) * parseFloat(rate);
            var bookingAmountPerPerson        =  parseFloat(sellingPriceOtherCurrencyRate) / parseFloat(paxNumber);


            console.log();

            $('.selling-price-other-currency-rate').val(check(sellingPriceOtherCurrencyRate));
            $('.booking-amount-per-person').val(check(bookingAmountPerPerson));
            $('.selling-price-other-currency-code').val(check(sellingPriceOtherCurrencyRate));

        }
    }

    var curday = function(sp){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //As January is 0.
        var yyyy = today.getFullYear();

        if(dd<10) dd='0'+dd;
        if(mm<10) mm='0'+mm;
        return (yyyy+sp+mm+sp+dd);
    };


    $(document).on('change', '.pax-number',function () {

        var $_val = $(this).val();
        var currentDate = curday('-');

        if($_val > $('.appendCount').length){
            var countable = ($_val - $('.appendCount').length) - 1;
            for (i = 1; i <= countable; ++i) {
                var count = $('.appendCount').length + 1;
                const $_html = `<div class="mb-2 appendCount" id="appendCount${count}">
                            <div class="row" >
                                <div class="col-md-3 mb-2">
                                    <label>Passenger #${ count + 1 } Full Name</label> 
                                    <input type="text" name="pax[${count}][full_name]" class="form-control" placeholder="PASSENGER #2 FULL NAME" >
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Email Address</label> 
                                    <input type="email" name="pax[${count}][email_address]" class="form-control" placeholder="EMAIL ADDRESS" >
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Contact Number</label> 
                                    <input type="number" name="pax[${count}][contact_number]" class="form-control" placeholder="CONTACT NUMBER" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label>Date Of Birth</label> 
                                    <input type="date" max="${currentDate}" name="pax[${count}][date_of_birth]" class="form-control" placeholder="CONTACT NUMBER" >
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Bedding Preference</label> 
                                    <input type="text" name="pax[${count}][bedding_preference]" class="form-control" placeholder="BEDDING PREFERENCES" >
                                </div>
                                
                                <div class="col-md-3 mb-2">
                                    <label>Dinning Preference</label> 
                                    <input type="text" name="pax[${count}][dinning_preference]" class="form-control" placeholder="DINNING PREFERENCES" >
                                </div>
                            </div>
                        </div> `;
                    $('#appendPaxName').append($_html);
            }
        }else{
           var countable = $('.appendCount').length + 1;
           console.log();
            for (var i = countable - 1; i >= $_val; i--) {
                $("#appendCount"+i).remove();
            }
        }

        getSellingPrice();
    });

    $(document).on('change', '.pax-number',function () {

        var $_val = $(this).val();
        var currentDate = curday('-');

        if($_val > $('.appendCount').length){
            var countable = ($_val - $('.appendCount').length) - 1;
            for (i = 1; i <= countable; ++i) {
                var count = $('.appendCount').length + 1;
                const $_html = `<div class="mb-2 appendCount" id="appendCount${count}">
                            <div class="row" >
                                <div class="col-md-3 mb-2">
                                    <label>Passenger #${ count + 1 } Full Name</label> 
                                    <input type="text" name="pax[${count}][full_name]" class="form-control" placeholder="PASSENGER #2 FULL NAME" >
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Email Address</label> 
                                    <input type="email" name="pax[${count}][email_address]" class="form-control" placeholder="EMAIL ADDRESS" >
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Contact Number</label> 
                                    <input type="number" name="pax[${count}][contact_number]" class="form-control" placeholder="CONTACT NUMBER" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label>Date Of Birth</label> 
                                    <input type="date" max="${currentDate}" name="pax[${count}][date_of_birth]" class="form-control" placeholder="CONTACT NUMBER" >
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Bedding Preference</label> 
                                    <input type="text" name="pax[${count}][bedding_preference]" class="form-control" placeholder="BEDDING PREFERENCES" >
                                </div>
                                
                                <div class="col-md-3 mb-2">
                                    <label>Dinning Preference</label> 
                                    <input type="text" name="pax[${count}][dinning_preference]" class="form-control" placeholder="DINNING PREFERENCES" >
                                </div>
                            </div>
                        </div> `;
                    $('#appendPaxName').append($_html);
            }
        }else{
           var countable = $('.appendCount').length + 1;
           console.log();
            for (var i = countable - 1; i >= $_val; i--) {
                $("#appendCount"+i).remove();
            }
        }

        getSellingPrice();
    });

    $(document).on('change', '.booking-currency-id',function () {

        var rateType               =  $('input[name="rate_type"]:checked').val();
        var sellingPriceArray      =  $('.selling-price').map((i, e) => parseFloat(e.value)).get();
        var markupAmountArray      =  $('.markup-amount').map((i, e) => parseFloat(e.value)).get();
        var bookingCurrency        =  $(this).val();
        var supplierCurrencyArray  =  $('.supplier-currency-id').map((i, e) => e.value).get();

        var calculatedSellingPriceInBookingCurrency = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;
        var quoteSize = parseInt($('.quote').length);

        var key = 0;
        while (key < quoteSize) {

            var supplierCurrency = supplierCurrencyArray[key];
            var sellingPrice     = sellingPriceArray[key];
            var markupAmount     = markupAmountArray[key];

            if(supplierCurrency){

                var rate = getRate(supplierCurrency,bookingCurrency,rateType);

                calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);
                calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);
                
            }else{

                calculatedSellingPriceInBookingCurrency = parseFloat(0.00);
                calculatedMarkupAmountInBookingCurrency = parseFloat(0.00);
            }

            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));

            key++;
        }

        $('.booking-currency-code').html(bookingCurrency);
    });

    $(document).on('change', '.change', function (event) {


        var key         = $(this).closest('.quote').data('key');
        var changeFeild = $(this).data('name');

        var estimatedCost               =  parseFloat($(`#quote_${key}_estimated_cost`).val()).toFixed(2);
        var supplierCurrency            =  $(`#quote_${key}_supplier_currency_id`).val();
        var bookingCurrency             =  $(".booking-currency-id").val();
        var rateType                    =  $('input[name="rate_type"]:checked').val();
        var rate                        =  getRate(supplierCurrency,bookingCurrency,rateType);
        var markupPercentage            =  parseFloat($(`#quote_${key}_markup_percentage`).val());
        var markupAmount                =  parseFloat($(`#quote_${key}_markup_amount`).val());
        
        var calculatedSellingPrice                  = 0;
        var calculatedMarkupPercentage              = 0;
        var calculatedMarkupAmount                  = 0;
        var calculatedProfitPercentage              = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;
        var calculatedSellingPriceInBookingCurrency = 0;

        if(changeFeild == 'estimated_cost'){

            calculatedSellingPrice                  = parseFloat(markupAmount) + parseFloat(estimatedCost);
            calculatedMarkupPercentage              = parseFloat(markupAmount) / parseFloat(estimatedCost / 100);
            calculatedProfitPercentage              = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);


            console.log(calculatedMarkupPercentage);
            console.log(calculatedSellingPrice);
            console.log(calculatedSellingPriceInBookingCurrency);

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

        getTotalValues();
        getSellingPrice();
    });

    $(document).on('change', '.selling-price-other-currency',function(){

        $('.selling-price-other-currency-code').text($(this).val());
        getSellingPrice();
    });


    $(".readonly").keypress(function (evt) {
        evt.preventDefault();
    });


});
