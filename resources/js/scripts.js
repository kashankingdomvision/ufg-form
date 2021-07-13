import $, { ajax } from 'jquery';
import select2 from 'select2';
var BASEURL = 'http://localhost/ufg-form/public/json/';
var REDIRECT_BASEURL = 'http://localhost/ufg-form/public/';

var CSRFTOKEN = $('#csrf-token').attr('content');
import datepicker from 'bootstrap-datepicker';


function datepickerReset(key = null) {
    
    
    var $season = $("#season_id");
    var season_start_date = new Date($season.find(':selected').data('start'));
    var season_end_date = new Date($season.find(':selected').data('end'));
    if(season_start_date && season_end_date){
        if(key != null){
            $('.bookingDateOfService:last').datepicker('remove').datepicker({  autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
            $('.bookingDate:last').datepicker('remove').datepicker({  autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
            $('.bookingDueDate:last').datepicker('remove').datepicker({  autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
        }else{
            $('.datepicker').datepicker('remove').datepicker({  autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
            
        }
    }else{
        $('.datepicker').datepicker({ autoclose: true, format:'dd/mm/yyyy'});
    }
}

function convertDate(date) {
    var dateParts = date.split("/");
    return dateParts = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);
}


$(document).ready(function($) {
    
    datepickerReset();
    
    $('.select2').select2({
        width: '100%',
    });
    
    /////////////////////////////
    // / Date Picker 
    // /
    // /
    $('#season_id').on('change', function(){
        datepickerReset();
        $('.datepicker').datepicker("setDate",'');
    });
    
    $(document).on('change', '.datepicker', function () {
        var datePicker_id   = $(this).attr('id');
        var name            = $(this).data('name');
        var key             = $(this).closest('.quote').data('key');
        var DateOFService   = $('#quote_'+key+'_date_of_service').val();
        var BookingDate     = $('#quote_'+key+'_booking_date').val();
        var BookingDueDate  = $('#quote_'+key+'_booking_due_date').val();
        var $season         = $("#season_id");
        var season_start_date = new Date($season.find(':selected').data('start'));
        var season_end_date = new Date($season.find(':selected').data('end'));
        
        switch (name) {
            case 'date_of_service':
            DateOFService  = convertDate($(this).val());
            BookingDueDate = (BookingDueDate != '')? convertDate(BookingDueDate) : season_start_date;
            BookingDate    = (BookingDate != '')? convertDate(BookingDate) : DateOFService;
            
            if(DateOFService < BookingDueDate){
                $('#quote_'+key+'_booking_due_date').datepicker("setDate", '');
                $('#quote_'+key+'_booking_date').datepicker("setDate", '');
            }
            
            $('#quote_'+key+'_booking_date').datepicker('remove').datepicker({ autoclose: true, format:'dd/mm/yyyy', startDate: BookingDueDate, endDate: DateOFService});
            $('#quote_'+key+'_booking_due_date').datepicker('remove').datepicker({ autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: BookingDate});
                break;
            case 'booking_date':

                if(convertDate(BookingDate) > convertDate(DateOFService)){
                    $('#quote_'+key+'_date_of_service').datepicker("setDate", '');
                }
                
                if(convertDate(BookingDate) < convertDate(BookingDueDate)){
                    $('#quote_'+key+'_booking_due_date').datepicker("setDate", '');
                }
                
                BookingDate = convertDate($(this).val());
                $('#quote_'+key+'_date_of_service').datepicker('destroy').datepicker({ autoclose: true, format:'dd/mm/yyyy', startDate: BookingDate, endDate: season_end_date});
                var setDueDate = (BookingDate != '')? BookingDate: (DateOFService != '')? convertDate(DateOFService) : season_end_date;
                $('#quote_'+key+'_booking_due_date').datepicker('destroy').datepicker({ autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: setDueDate});
                
                break;
            case 'booking_due_date':
                if(convertDate(BookingDueDate) > convertDate(DateOFService)){
                    $('#quote_'+key+'_booking_date').datepicker("setDate", '');
                    $('#quote_'+key+'_date_of_service').datepicker("setDate", '');
                }
                if(convertDate(BookingDueDate) > convertDate(BookingDate)){
                    $('#quote_'+key+'_booking_date').datepicker("setDate", '');
                }
                
                BookingDueDate = convertDate($(this).val());
                BookingDate = (BookingDate != null)? convertDate(BookingDate): season_start_date;
                DateOFService = (DateOFService != '')? convertDate(DateOFService): season_end_date;
                $('#quote_'+key+'_booking_date').datepicker('destroy').datepicker({ autoclose: true, format:'dd/mm/yyyy', startDate: BookingDueDate, endDate: season_end_date});
                $('#quote_'+key+'_date_of_service').datepicker('destroy').datepicker({ autoclose: true, format:'dd/mm/yyyy', startDate: BookingDate, endDate: season_end_date});

                break;
        
            default:
                datepickerReset();
                break;
        }
    });
    
    // /
    // /
    // / Date Picker 
    /////////////////////////////


 /// brands holidays
    $(document).on('change', '.getBrandtoHoliday',function(){
            let brand_id = $(this).val();
            var options = '';
            var url = BASEURL+'brand/to/holidays'
        $.ajax({
            type: 'get',
            url: url,
            data: { 'brand_id': brand_id },
            success: function(response) {
                options += '<option value="">Select Type Of Holiday</option>';
                $.each(response,function(key,value){
                    options += '<option value="'+value.id+'">'+value.name+'</option>';
                });
                $('.appendHolidayType').html(options);
            }
        });
    });
 /// brands holidays
///
$(document).on('change', '.select-agency', function() {
    $('.agency-columns').empty();
    
    var $v_html = ` <div class="col form-group" style="width:175px;">
                    <label for="inputEmail3" class="">Agency Name</label> <span style="color:red"> *</span>
                    <input type="text" name="agency_name" id="agency_name" class="form-control">
                    <span class="text-danger" role="alert" > </span>
                </div>
                <div class="col form-group">
                    <label for="inputEmail3" class="">Agency Contact No.</label> <span style="color:red"> *</span>
                    <input type="text" name="agency_contact" id="agency_contact" class="form-control">
                    <span class="text-danger" role="alert" > </span>
                </div>`;
                
    if($(this).val() == 'yes'){
        $('.agency-columns').append($v_html);
    }else{
        $('.agency-columns').empty();
    } 
});

/// Category to supplier
$(document).on('change', '.category-id',function(){
    var $selector = $(this);
    var category_id = $(this).val();
    var options = '';
    $.ajax({
        type: 'get',
        url: BASEURL+'category/to/supplier',
        data: { 'category_id': category_id },
        success: function(response) {
            options += '<option value="">Select Supplier</option>';
            $.each(response,function(key,value){
                options += '<option value="'+value.id+'">'+value.name+'</option>';
            });
            
            $selector.closest('.row').find('.supplier-id').html(options);
            $selector.closest('.row').find('.product-id').html('<option value="">Select Product</option>');

            
        }
    })
});
/// Category to supplier

// Supplier to product
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
// Supplier to product



    $(document).on('change', '.role', function() {

        var role = $(this).find('option:selected').data('role');
        var supervisor = $('#supervisor_feild');

        if (role == 'Sales Agent' || role == 2) {

            $(supervisor).removeClass("d-none");
            $('#supervisor_id').attr("required", true).removeAttr('disabled');

        } else {

            $(supervisor).addClass("d-none");
            $('#selectSupervisor').attr("required", false).attr('disabled', 'disabled');
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

     
    

/**
 * -------------------------------------------------------------------------------------
 *                                Season Manangement
 * -------------------------------------------------------------------------------------
*/

    // $('.date-picker').datetimepicker({
    //     format: 'L'
    // });

    $('#seasons').keyup( function () {
        var val = $(this).val();
        if(val.length == 4){
            $(this).val(val+'-');
        }
    });


/**
 * -------------------------------------------------------------------------------------
 *                                Quote Manangement
 * -------------------------------------------------------------------------------------
*/


$(document).on('click', '.removeChild', function () {
    var id = $(this).data('show');
    $(id).removeAttr("style");
    $($(this).data('append')).empty();
    $(this).attr("style", "display:none");
  });

$(document).on('click', '.addChild', function () {
    $('.append').empty();
    var id = $(this).data('id');
    var refNumber = $(this).data('ref');
    var appendId  = $(this).data('append');
    var url = '{{ route("get.child.reference", ":id") }}';
    url = url.replace(':id', refNumber);
    var removeBtnId =$(this).data('remove');
    var showBtnId = $(this).data('show');
    $('.addChild').removeAttr("style");
    $('.removeChild').attr("style", "display:none");

    $(this).attr("style", "display:none")
    // $(appendId).empty();
    
    $.ajax({
        url:  BASEURL+'quotes/child/reference',
        data: {id: id, ref_no: refNumber},
        type: 'get',
        success: function(response) {
          $(appendId).append(response);
          $(removeBtnId).removeAttr("style");
        }
    });
});

    // $('.pax-number').select2();

    // $('.selling-price-other-currency').select2({
    //     // width: '68%',
    //     width: 'resolve',
    //     templateResult: currencyImageFormate,
    //     templateSelection: currencyImageFormate
    // });

    // $('.booking-currency-id, .supplier-currency-id').select2({
    //     templateResult: currencyImageFormate,
    //     templateSelection: currencyImageFormate
    // });

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
            .find("select").val("").each(function(){
                this.name = this.name.replace(/\[(\d+)\]/, function(str,p1){
                    return '[' + ($('.quote').length) + ']';
                });
                this.id = this.id.replace(/\d+/g, $('.quote').length, function(str,p1){                        
                    return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                });
            }).end()
            .show()
            .insertAfter(".quote:last");
            
            $('.supplier-id:last').html(`<option selected value="">Select Supplier</option>`);
            $('.product-id:last').html(`<option selected value="">Select Product</option>`);
            $(".quote:last").attr('data-key', $('.quote').length - 1);
          
            $(".estimated-cost:last, .markup-amount:last, .markup-percentage:last, .selling-price:last, .profit-percentage:last, .estimated-cost-in-booking-currency:last, .selling-price-in-booking-currency:last, .markup-amount-in-booking-currency:last").val('0.00').attr('data-code', '');
            $('.text-danger').html('');
            $(".quote:last").prepend("<div class='row'><div class='col-sm-12'><button type='button' class='btn pull-right close'> x </button></div>");
            datepickerReset(1);
           
            // reinitializedDynamicFeilds();
            // datePickerSetDate();
            // $('.select2').select2({
            //     width: '100%',
            // });
    });

    $(document).on('click', '.close',function(){
        $(this).closest(".quote").remove();
    });
    
    $(document).on('change', '.supplier-currency-id',function () {
        var code = $(this).find(':selected').data('code');
        $(this).closest(".quote").find('[class*="supplier-currency-code"]').html(code);
    });

    function reinitializedDynamicFeilds(){

        $('.reinitialized-select2').removeClass('select2-hidden-accessible').next().remove();
        $('.reinitialized-select2').select2();
    }

    var currencyConvert = getJson();

    function getJson() {
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

    
    var commissionRate = getCommissionJson();

    function getCommissionJson() {
        return JSON.parse($.ajax({
            type: 'GET',
            url : BASEURL+'get-commission',
            dataType: 'json',
            global: false,
            async: false,
            success: function (data) {
                return data;
            }
        }).responseText);
    }

    // console.log(commissionRate);

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

    function getCommissionRate(){

        var totalNetPrice  = $('.total-net-price').val();
        var commissionId   = $('.commission-id').val(); 
        var calculatedCommisionAmount = 0;

        if(commissionId){

            var object = commissionRate.filter(function(elem) {
                return elem.id == commissionId
            });
            var commissionPercentage = parseFloat(object.shift()['percentage']);
            calculatedCommisionAmount =  parseFloat(totalNetPrice / 100) * parseFloat(commissionPercentage);

        }else{
            calculatedCommisionAmount = 0.00;
        }
        
        $('.commission-amount').val(check(calculatedCommisionAmount));
    }

    function getTotalValues(){

        var estimatedCostInBookingCurrencyArray  =  $('.estimated-cost-in-booking-currency').map((i, e) => parseFloat(e.value)).get();
        var estimatedCostInBookingCurrency       =  estimatedCostInBookingCurrencyArray.reduce((a, b) => (a + b), 0);
        $('.total-net-price').val(check(estimatedCostInBookingCurrency));

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

        getCommissionRate();
    }

    function getSellingPrice(){

        var sellingPriceOtherCurrency        =  $('.selling-price-other-currency').val();

        if(sellingPriceOtherCurrency){

            var rateType                      =  $('input[name="rate_type"]:checked').val();
            var paxNumber                     =  parseFloat($(".pax-number").val());
            var bookingCurrency               =  $(".booking-currency-id").find(':selected').data('code');
            var totalSellingPrice             =  parseFloat($('.total-selling-price').val());

            var rate                          =  getRate(bookingCurrency,sellingPriceOtherCurrency,rateType);
            var sellingPriceOtherCurrencyRate =  parseFloat(totalSellingPrice) * parseFloat(rate);
            var bookingAmountPerPerson        =  parseFloat(sellingPriceOtherCurrencyRate) / parseFloat(paxNumber);

            $('.selling-price-other-currency-rate').val(check(sellingPriceOtherCurrencyRate));
            $('.booking-amount-per-person').val(check(bookingAmountPerPerson));
            $('.selling-price-other-currency-code').val(check(sellingPriceOtherCurrencyRate));

        }
    }

    function changeCurrenyRate(){
        var rateType               =  $('input[name="rate_type"]:checked').val();
        var estimatedCostArray     =  $('.estimated-cost').map((i, e) => parseFloat(e.value)).get();
        var sellingPriceArray      =  $('.selling-price').map((i, e) => parseFloat(e.value)).get();
        var markupAmountArray      =  $('.markup-amount').map((i, e) => parseFloat(e.value)).get();
        var bookingCurrency        =  $('.booking-currency-id').find(':selected').data('code');
        var supplierCurrencyArray  =  $('.supplier-currency-id').map((i, e) => $(e).find(':selected').data('code') ).get();

        var calculatedEstimatedCostInBookingCurrency = 0
        var calculatedSellingPriceInBookingCurrency = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;
        var quoteSize = parseInt($('.quote').length);

        var key = 0;
        while (key < quoteSize) {

            var estimatedCost    = estimatedCostArray[key];
            var supplierCurrency = supplierCurrencyArray[key];
            var sellingPrice     = sellingPriceArray[key];
            var markupAmount     = markupAmountArray[key];

            if(supplierCurrency){

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
                                <div class="col-md-4 mb-2">
                                    <label>Passenger #${ count + 1 } Full Name</label> 
                                    <input type="text" name="pax[${count}][full_name]" class="form-control" placeholder="PASSENGER #2 FULL NAME" >
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Email Address</label> 
                                    <input type="email" name="pax[${count}][email_address]" class="form-control" placeholder="EMAIL ADDRESS" >
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Contact Number</label> 
                                    <input type="number" name="pax[${count}][contact_number]" class="form-control" placeholder="CONTACT NUMBER" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Date Of Birth</label> 
                                    <input type="date" max="${currentDate}" name="pax[${count}][date_of_birth]" class="form-control" placeholder="CONTACT NUMBER" >
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Bedding Preference</label> 
                                    <input type="text" name="pax[${count}][bedding_preference]" class="form-control" placeholder="BEDDING PREFERENCES" >
                                </div>
                                
                                <div class="col-md-4 mb-2">
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

        changeCurrenyRate();
        $('.booking-currency-code').html($(this).find(':selected').data('code'));

        getTotalValues();
        getSellingPrice();
    });

    $(document).on('change', '.change', function (event) {


        var key         = $(this).closest('.quote').data('key');
        var changeFeild = $(this).data('name');

        var estimatedCost               =  parseFloat($(`#quote_${key}_estimated_cost`).val()).toFixed(2);
        var supplierCurrency            =  $(`#quote_${key}_supplier_currency_id`).find(':selected').data('code');
        var bookingCurrency             =  $(".booking-currency-id").find(':selected').data('code');

        var rateType                    =  $('input[name="rate_type"]:checked').val();
        var rate                        =  getRate(supplierCurrency,bookingCurrency,rateType);
        var markupPercentage            =  parseFloat($(`#quote_${key}_markup_percentage`).val());
        var markupAmount                =  parseFloat($(`#quote_${key}_markup_amount`).val());
        
        var calculatedSellingPrice                  = 0;
        var calculatedMarkupPercentage              = 0;
        var calculatedMarkupAmount                  = 0;
        var calculatedProfitPercentage              = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;
        var calculatedEstimatedCostInBookingCurrency = 0;
        var calculatedSellingPriceInBookingCurrency = 0;

        if(changeFeild == 'estimated_cost'){

            calculatedSellingPrice                  = parseFloat(markupAmount) + parseFloat(estimatedCost);
            calculatedMarkupPercentage              = parseFloat(markupAmount) / parseFloat(estimatedCost / 100);
            calculatedProfitPercentage              = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
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

        getTotalValues();
        getSellingPrice();
    });

    $(document).on('change', '.selling-price-other-currency',function(){

        $('.selling-price-other-currency-code').text($(this).val());
        getSellingPrice();
    });

    $(document).on('change', '.rate-type',function(){
        changeCurrenyRate();
    });

    $(document).on('change', '.commission-id', function () {
        getCommissionRate();
    });

    $(".readonly").keypress(function (evt) {
        evt.preventDefault();
    });


    $("#versions :input").prop("disabled", true);
    $('#bookingVersion :input').prop('disabled', true);
    
    
    $('#reCall').prop("disabled", false);
    $('#reCall').on('click', function () {
        if($(this).data('recall') == true){
            if (confirm("Are you sure you want to Recall this Quotation?") == true) {
                $("#versions :input").not(this).prop('disabled', false);
                $(this).data('recall', 'false');
                $(this).text('Back Into Version');
                var add_HTML = `<div class="col-12 text-right">
                                    <button type="button" id="add_more" class="btn btn-outline-dark  pull-right ">+ Add more </button>
                                </div>`;
                $('#addMoreButton').append(add_HTML);
                var btn_Submit= ` <button type="submit" class="btn btn-success float-right">Submit</button>`;
                $('#btnSubmitversion').append(btn_Submit);
            } 
        }else {
            $("#versions :input").prop("disabled", true);
            $('#reCall').prop("disabled", false);
            $(this).text('Recall Version');
            $('#addMoreButton').append();
            $('#btnSubmitversion').append();
        }
    });

////////////////////////////////// 
// / Quote FORM SUBMISSION START
// /
// / 

$("#quoteCreate").submit(function(event) {
    event.preventDefault();
    var $form = $(this),
    url = $form.attr('action');
    var formdata = $(this).serialize();

    $('input, select').removeClass('is-invalid');
    $('.text-danger').html('');

    /* Send the data using post */
    $.ajax({
        type: 'POST',
        url: url,
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function() {
            $("#overlay").addClass('overlay');
            $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
        },
        success: function (data) {
            $("#overlay").removeClass('overlay').html('');
            setTimeout(function() {
                alert('Quote created Successfully');
                window.location.href = REDIRECT_BASEURL + "quotes/index";
            }, 800);
        },
        error: function (reject) {

            if( reject.status === 422 ) {

                var errors = $.parseJSON(reject.responseText);

                setTimeout(function() {
                    $("#overlay").removeClass('overlay').html('');
     
                    jQuery.each(errors.errors, function( index, value ) {
    
                        index = index.replace(/\./g,'_');
    
                        $('#'+index).addClass('is-invalid');
                        $('#'+index).closest('.form-group').find('.text-danger').html(value);
                    });

                }, 800);

            }
        },
    });
});


$(".update-quote").submit(function(event) {
    event.preventDefault();
    var $form = $(this),
    url = $form.attr('action');
    var formdata = $(this).serialize();

    $('input, select').removeClass('is-invalid');
    $('.text-danger').html('');

    /* Send the data using post */
    $.ajax({
        type: 'POST',
        url: url,
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function() {
            $("#overlay").addClass('overlay');
            $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
        },
        success: function (data) {
            $("#overlay").removeClass('overlay').html('');
            setTimeout(function() {
                alert('Quote updated Successfully');
                window.location.href = REDIRECT_BASEURL + "quotes/index";
            }, 800);
        },
        error: function (reject) {

            if( reject.status === 422 ) {

                var errors = $.parseJSON(reject.responseText);

                setTimeout(function() {
                    $("#overlay").removeClass('overlay').html('');
     
                    jQuery.each(errors.errors, function( index, value ) {
    
                        index = index.replace(/\./g,'_');
                        $('#'+index).addClass('is-invalid');
                        $('#'+index).closest('.form-group').find('.text-danger').html(value);
                    });

                }, 800);

            }
        },
    });
});

$('.search-reference').on('click', function () {
    var searchRef = $(this);
    searchRef.text('Searching..').prop('disabled', true);
    var reference_no = $('.reference-name').val();
    if(reference_no == ''){
        alert('Reference number is not found'); 
        searchRef.text('Search').prop('disabled', false);     
    }else{
        
        //ajax for references
        $.ajax({
            headers: {'X-CSRF-TOKEN': CSRFTOKEN},
            url: BASEURL+'find/reference/'+reference_no+'/exist',
            type: 'get',
            dataType: "json",
            success: function (data) {
                var r = true
                if(data.response == true){
                    r = confirm('The reference number is already exists. Are you sure! you want to create quote again on same reference');
                }
                
                if(r == true){
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': CSRFTOKEN},
                        url: BASEURL+'find/reference',
                        data : {ref_no: reference_no},
                        type: 'POST',
                        dataType: "json",
                        success: function (data) {
                            // lead Passenger
                                $('#lead_passenger').val(data.response.passengers.lead_passenger.passenger_name);
                            // lead Passenger
                            // brand
                                $('#brand_id').val(data.response.brand.brand_id).change();
                            // brand
                            // holidaytype
                                $("#holiday_type_id option:contains("+data.response.brand.name+")").attr('selected', 'selected');
                            // holidaytype
                            // Sale person
                                $('#sale_person_id').val(data.response.sale_person).trigger('change');
                            // Sale person
                            // Pax No
                                $('#pax_no').val(data.response.pax).trigger('change');  
                            // Pax No
                            // Booking Currency'
                            $("#currency_id").find('option').each(function(){
                                if( $(this).data('code') == data.response.currency ) {
                                    $(this).attr("selected","selected");
                                }
                            });
                                // $("#currency_id option:data-code"+data.response.currency+"]").trigger('change');
                            // Booking Currency
                            // Dinning Preference
                            $('#dinning_preference').val(data.response.passengers.lead_passenger.dinning_prefrences);
                            // Dinning Preference
                            // Bedding Preference
                            $('#bedding_preference').val(data.response.passengers.lead_passenger.bedding_prefrences);
                            // Bedding Preference
                          
                            if(data.response.passengers.passengers.length > 0){
                                data.response.passengers.passengers.forEach(($_value, $key) => {
                                    var $_count = $key + 1;
                                    $('input[name="pax['+$_count+'][full_name]"]').val($_value.passenger_name);
                                    $('input[name="pax['+$_count+'][email_address]"]').val($_value.passenger_email);
                                    $('input[name="pax['+$_count+'][contact_number]"]').val($_value.passenger_contact);
                                    $('input[name="pax['+$_count+'][date_of_birth]"]').val($_value.passenger_dbo);
                                    $('input[name="pax['+$_count+'][bedding_preference]"]').val($_value.bedding_prefrences);
                                    $('input[name="pax['+$_count+'][dinning_preference]"]').val($_value.dinning_prefrences);
                                });
                            }
                            
                            searchRef.text('Search').prop('disabled', false);
                            
                        },
                        error: function (reject) {
                           alert(reject.responseJSON.errors);
                            searchRef.text('Search').prop('disabled', false);
                        
                        },
                    });
                }
            },
            error: function (reject) {
                
                alert(reject);
                searchRef.text('Search').prop('disabled', false);
                
            },
        });
        //ajax for references
   } 
});

$('#clone_booking_finance').on('click', function () {
    var depositeLabelId  = 'deposite_heading'+$(this).data('key');
    var countHeading =$('.finance-clonning').length + 1;
    console.log($(this).data('key'));
    $('.finance-clonning').eq(0).clone().find("input").val("").each(function(){
        this.name = this.name.replace(/]\[(\d+)]/g, function(str,p1){                        
            return ']['+$('.finance-clonning').length+']';
        });
    }).end().find('.depositeLabel').each(function () {
        this.id = 'deposite_heading'+$('.finance-clonning').length;
    var countHeading =$('.finance-clonning').length + 1;
        $(this).text('Deposit Payment #'+countHeading);
    }).end()
    .find("select").val("").each(function(){
        this.name = this.name.replace(/]\[(\d+)]/g, function(str,p1){                        
            return ']['+$('.finance-clonning').length+']';
        });
    }).end()
    .show()
    .insertAfter(".finance-clonning:last");

    // remove checked attribute after clone
    $('.finance-clonning:last').find(':checked').attr('checked', false);
    $('.deposit-amount:last').val('0.00');
});

$('#tempalte_id').on('change', function () {
    $.ajax({
        headers: {'X-CSRF-TOKEN': CSRFTOKEN},
        url: BASEURL+'template/'+$(this).val()+'/partial',
        type: 'get',
        dataType: "json",
        success: function (data) {
           $('#parent').html(data.template_view);
        },
        error: function (reject) {
            
            alert(reject);
            searchRef.text('Search').prop('disabled', false);
            
        },
    });
});

// /
// / 
// / Quote FORM SUBMISSION END
////////////////////////////////// 



$("#update-booking").submit(function(event) {
    event.preventDefault();
    var $form = $(this),
    url = $form.attr('action');
    var formdata = $(this).serialize();

    $('input, select').removeClass('is-invalid');
    $('.text-danger').html('');

    /* Send the data using post */
    $.ajax({
        type: 'POST',
        url: url,
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function() {
            $("#overlay").addClass('overlay');
            $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
        },
        success: function (data) {
            $("#overlay").removeClass('overlay').html('');
            setTimeout(function() {
                alert('Booking updated Successfully');
                window.history.back();
            }, 800);
        },
        error: function (reject) {

            if( reject.status === 422 ) {

                var errors = $.parseJSON(reject.responseText);

                setTimeout(function() {
                    $("#overlay").removeClass('overlay').html('');
     
                    jQuery.each(errors.errors, function( index, value ) {
    
                        index = index.replace(/\./g,'_');
                        $('#'+index).addClass('is-invalid');
                        $('#'+index).closest('.form-group').find('.text-danger').html(value);
                    });

                }, 800);

            }
        },
    });
});
});
