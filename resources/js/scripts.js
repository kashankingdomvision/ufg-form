import $, { ajax } from 'jquery';
import select2 from 'select2';
import intlTelInput from 'intl-tel-input';

var BASEURL = window.location.origin+'/ufg-form/public/json/';
var REDIRECT_BASEURL = window.location.origin+'/ufg-form/public/';
// var BASEURL = window.location.origin+'/php/ufg-form/public/json/';
// var REDIRECT_BASEURL = window.location.origin+'/php/ufg-form/public/';
var CSRFTOKEN = $('#csrf-token').attr('content');
import datepicker from 'bootstrap-datepicker';

function todayDate() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    return today = dd + '/' + mm + '/' + yyyy;
}

function datepickerReset(key = null) {
    
    
    var $season = $("#season_id");
    var season_start_date = new Date($season.find(':selected').data('start'));
    var season_end_date = new Date($season.find(':selected').data('end'));
    if(season_start_date != 'Invalid Date' && season_end_date != 'Invalid Date'){
        if(key != null){
            
            $('.bookingDateOfService:last').datepicker('destroy').datepicker({  autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
            $('.bookingDate:last').datepicker('destroy').datepicker({  autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
            $('.bookingDueDate:last').datepicker('destroy').datepicker({  autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
        }else{
            // $('.datepicker').datepicker('destroy').datepicker({  autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
            $('.datepicker').datepicker("destroy").datepicker({ autoclose: true, format:'dd/mm/yyyy'});
       
       }
    }else{
        $('.datepicker').datepicker('destroy').datepicker({ autoclose: true, format:'dd/mm/yyyy'});
    }
}

function convertDate(date) {
    var dateParts = date.split("/");
    return dateParts = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);
}


$(document).ready(function($) {
    
    $('.select2').select2({
        width: '100%',
        theme: "classic",
    });
    
    $('.select2single').select2({
        width: '100%',
        theme: "bootstrap",
        templateResult: formatState,
        templateSelection: formatState,
    });

    $('.select2-multiple').select2({
        width: '100%',
        theme: "classic",
    });

    $('.selling-price-other-currency').select2({
        width: '68%',
        theme: "bootstrap",
        templateResult: formatState,
        templateSelection: formatState,
    });

    // ajaxSetup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRFTOKEN
        }
    });

    function formatState(opt) {
        if (!opt.id) {
            return opt.text;
        }

        var optimage = $(opt.element).attr('data-image');

        if (!optimage) {
            return opt.text ;
        } else {
            var $opt = $(
                '<span><img height="20" width="20" src="' + optimage + '" width="60px" /> ' + opt.text + '</span>'
            );
            return $opt;
        }
    };
    
    datepickerReset();
    
    
    /////////////////////////////
    // / Date Picker 
    // /
    // /
    $('#season_id').on('change', function(){
        $('.datepicker').datepicker("setDate",'');
        datepickerReset();
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
                
    if(($(this).val() == 1)){
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
        if ($('.select2single').data('select2')) {
            $('.select2single').select2('destroy');
          }
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
            $('.text-danger, .quote:last .supplier-currency-code').html('');
            $(".quote:last").prepend("<div class='row'><div class='col-sm-12'><button type='button' class='btn pull-right close'> x </button></div>");
            datepickerReset(1);
           
            reinitializedDynamicFeilds();
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
        $('.select2single').select2({
            width: '100%',
            theme: "bootstrap",
            templateResult: formatState,
            templateSelection: formatState,
        });
    //     if ($('.select2').hasClass("select2-hidden-accessible")) {
    //         $('.select2').select2('destroy');
    //     }
    //         // $('.select2').select2('remove');
    //     // $('.select2:last').removeClass('select2-hidden-accessible').next().remove();
    //     $('.select2').select2({
    //         width: '100%',
    //         theme: "classic",
    //     });
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

        // console.log( "getRate: " + supplierCurrency);
        // console.log( "getRate: " + bookingCurrency);
        // console.log( "getRate: " + rateType);

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
        $('.select2single').select2('destroy');
        var $_val = $(this).val();
        var currentDate = curday('-');
        var countries = $('#content').data('countries');
        if($_val > $('.appendCount').length){
            var countable = ($_val - $('.appendCount').length) - 1;
            for (i = 1; i <= countable; ++i) {
                var count = $('.appendCount').length + 1;
                var c = count + 1;
                const $_html = `
                        <div class="mb-1 appendCount" id="appendCount${count}">
                            <div class="row" >
                                <div class="col-md-3 mb-2">
                                    <label>Passenger #${c} Full Name</label> 
                                    <input type="text" name="pax[${count}][full_name]" class="form-control" placeholder="PASSENGER #${count} FULL NAME" >
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Email Address</label> 
                                    <input type="email" name="pax[${count}][email_address]" class="form-control" placeholder="EMAIL ADDRESS" >
                                </div>
                                
                                <div class="col-sm-3">
                                    <label>Nationality</label>
                                    <select name="pax[${count}][nationality_id]"  class="form-control select2single nationality-id">
                                    <option selected value="" >Select Nationality</option>
                                    ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Contact Number</label> 
                                    <input type="tel" name="pax[${count}][contact_number]"  data-key="${count}" id="phone${count}" class="form-control phone" >
                                    <div class="alert-danger" style="text-align:center" id="error_msg${count}" ></div>
                                    <div class="alert-danger" style="text-align:center" id="valid_msg${count}" ></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label>Date Of Birth</label> 
                                    <input type="date" max="{{ date('Y-m-d') }}" name="pax[${count}][date_of_birth]" class="form-control" placeholder="Date Of Birth" >
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
                        </div>`;
                        $('#appendPaxName').append($_html);
                        console.log('countable'+count);
                        integrate_intlTelInput('#phone'+count);
            }
        }else{
            var countable = $('.appendCount').length + 1;
            for (var i = countable - 1; i >= $_val; i--) {
                $("#appendCount"+i).remove();
            }
        }
        $('.select2single').select2({
            width: '100%',
            theme: "bootstrap",
        });
        getSellingPrice();
    });

    $(document).on('change', '.booking-currency-id',function () {

        $('.booking-currency-code').html($(this).find(':selected').data('code'));
        changeCurrenyRate();

        getTotalValues();
        getSellingPrice();
    });

    $(document).on('keyup', '.change', function (event) {


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


    $(".versions :input").prop("disabled", true);
    $('#bookingVersion :input').prop('disabled', true);
    
    $('#reCall').prop("disabled", false);
    
    $('#reCall').on('click', function () {
        if($(this).data('recall') == true){
            if (confirm("Are you sure you want to Recall this Quotation?") == true) {
                console.log('run');
                $(".versions :input").removeAttr("disabled");

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
                // window.location.href = REDIRECT_BASEURL + "quotes/index";
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

$(document).on('click', '#save_template', function(){
    jQuery('#modal-default').modal('show').find('input').val('');
});

$(document).on('click', '#submit_template', function(){

    let templateName = $('#template_name').val();
    var formData     = $('#quoteCreate').serialize()  + '&template_name=' + templateName;
    var url          = REDIRECT_BASEURL+'template/store';

    $.ajax({
        type: 'POST',
        url: url,
        data:  formData,
        beforeSend: function() {

            $('input').removeClass('is-invalid');
            $('.text-danger').html('');
            $("#submit_template").find('span').addClass('spinner-border spinner-border-sm');
        },
        success: function (data) {

            $("#submit_template").find('span').removeClass('spinner-border spinner-border-sm');
            jQuery('#modal-default').modal('hide');

            setTimeout(function() {
                alert('Template created Successfully');
            }, 800);
        },
        error: function (reject) {

            if( reject.status === 422 ) {

                var errors = $.parseJSON(reject.responseText);

                setTimeout(function() {
                    $("#submit_template").find('span').removeClass('spinner-border spinner-border-sm');
        
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

$('.clone_booking_finance').on('click', function () {
    
    var depositeLabelId  = 'deposite_heading'+$(this).data('key');
    var countHeading =$('.finance-clonning').length + 1;
    $('.finance-clonning').eq(0).clone().find("input").val("").each(function(){
        this.name = this.name.replace(/]\[(\d+)]/g, function(str,p1){                        
            return ']['+$('.finance-clonning').length+']';
        });
                                                                               
        this.id = this.id.replace(/\d+/g, $('.finance-clonning').length, function(str,p1){                        
            return 'quote_' + parseInt($('.finance-clonning').length) + '_' + $(this).attr("data-name")
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
        this.id = this.id.replace(/\d+/g, $('.finance-clonning').length, function(str,p1){                        
            return 'quote_' + parseInt($('.finance-clonning').length) + '_' + $(this).attr("data-name")
        });
    }).end().find('.select2single').select2({
        width: '100%',
        theme: "bootstrap",
    }).end()
    .show()
    .insertAfter(".finance-clonning:last");
    
    // remove checked attribute after clone
    $('.finance-clonning:last').find(':checked').attr('checked', false);
    $('.deposit-amount:last').val('0.00');
    
    
});

$('#tempalte_id').on('change', function () {

    var confirmAlert = null;

    $.ajax({
        headers: {'X-CSRF-TOKEN': CSRFTOKEN},
        url: BASEURL+'template/'+$(this).val()+'/partial',
        type: 'get',
        dataType: "json",
        success: function (data) {

            if(data){
                confirmAlert = confirm('Are you sure! you want to override Quote Details?');
            }

            if(confirmAlert == true){

                $('#parent').html(data.template_view);
                $(".booking-currency-id").val(data.template.currency_id).change();
            }

        },
        error: function (reject) {
            
            alert(reject);
            searchRef.text('Search').prop('disabled', false);
            
        },
    });

});

$("#create_template").submit(function(event) {
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
                alert('Template created Successfully');
                window.location.href = REDIRECT_BASEURL + "template/index";
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

$("#update_template").submit(function(event) {
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
                alert('Template updated Successfully');
                window.location.href = REDIRECT_BASEURL + "template/index";
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







$(document).on('change', '.deposit-due-date', function(){
    var close = $(this).closest('.finance-clonning');
    close.find('.plus').removeAttr('disabled');
});


///booking incremnet and 
  
$(document).on('click', '.increment', function() {
                
    var close = $(this).closest('.finance-clonning');
    
        var valueElement = close.find('.ab_number_of_days');
        var dueDate = close.find('.deposit-due-date').val();
        var nowDate  =todayDate();
        const firstDate = new Date(dueDate);
        const secondDate = convertDate(nowDate);
       
        if(firstDate == 'Invalid Date'){
            alert('deposite date required');
        }else{
            const oneDay = 24 * 60 * 60 * 1000; 
            const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
            if(firstDate > secondDate){
                $(this).attr('disabled', true);
            }else{
                if(valueElement.val() == ''){
                    valueElement.val(0);
                }
                var count = Math.max(parseInt(valueElement.val()??0));
                var diffcount = diffDays - valueElement.val();
                var b =1;
                if($(this).hasClass('plus')) 
                {
                    if(diffcount < 1){
                        close.find('.plus').attr('disabled', true);
                    }else{
                        count = count + b;
                        valueElement.val(count);
                    }
                } 
                else if (valueElement.val() > 0) // Stops the value going into negatives
                {
                    close.find('.plus').attr('disabled', false);
                    count -=b;
                    valueElement.val(count);
                } 
            }
        }
    return false;
});
///booking incremnet and 

// tel input  start
if($('#phone').length > 0){
   var input =  integrate_intlTelInput();
    console.log('greater than');
}
//tel input end

// $(document).on('change', '.phone', function() {
//     var id = $(this).data('idkey');
//     console.log(id);
//     reset( document.querySelector('#phone'+id),
//     document.querySelector('#error_msg'+id), 
//     document.querySelector('#valid_msg'+id));
// })
// $('.phone').addEventListener('change', resetTelinput);
// $('.phone').addEventListener('keyup', resetTelinput);


});


var integrate_intlTelInput = function (id) {
    var input_id= id??'#phone'
    console.log(input_id, ' int input funcation');
    var input =    document.querySelector(input_id);
    var iti = intlTelInput(input, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
        separateDialCode: true,
        formatOnDisplay:true,
        initialCountry: "auto",
        nationalMode: true,
        hiddenInput: "full_number",
        autoPlaceholder: "polite",
        placeholderNumberType: "MOBILE",
    });
    return iti
}

var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
$(document).on('change', '.phone', function() {
    var key      =    $(this).data('key');
    var input    =    document.querySelector('#phone'+key);
    input.addEventListener('blur', function(iti) {
        var errorMsg =    document.querySelector('#error_msg'+key);
        var validMsg =    document.querySelector('#valid_msg'+key);
        reset(input, errorMsg, validMsg);
        // var iti = integrate_intlTelInput('#phone'+key);/
        console.log(integrate_intlTelInput('#phone'+key).getSelectedCountryData());
        // console.log(integrate_intlTelInput().getSelectedCountryData());
        

    // // var iti = intlTelInput(input, {
    // //     utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
    // //     separateDialCode: true,
    // //     formatOnDisplay:true,
    // //     initialCountry: "auto",
    // //     nationalMode: false,
    // //     hiddenInput: "full_number",
    // //     autoPlaceholder: "polite",
    // //     placeholderNumberType: "MOBILE",
    // // });
    
    // if (input.value.trim()) {
    //     console.log(iti.getSelectedCountryData());
    //     if (iti.isValidNumber()) {
    //         validMsg.classList.remove("hide");
    //     } else {
    //         input.classList.add("is-invalid");
    //         var errorCode = iti.getValidationError();
    //         errorMsg.innerHTML = errorMap[errorCode];
    //         errorMsg.classList.remove("hide");
    //     }
    // }
    // iti.destroy();
        
    });
});

$('.phone1').on("countrychange", function() {
        var key      =    $(this).data('key');
        var input    =    document.querySelector('#phone'+key);
        console.log(input, 'countrycahnge');
        var errorMsg =    document.querySelector('#error_msg'+key);
        var validMsg =    document.querySelector('#valid_msg'+key);
        reset(input, errorMsg, validMsg);
        var iti      = integrate_intlTelInput('#phone'+key);
        iti.destroy();
        iti = integrate_intlTelInput('#phone'+key);
        console.log(iti.getSelectedCountryData());
        
    // do something with iti.getSelectedCountryData()
});

    var reset = function(input, errorMsg, validMsg) {
        input.classList.remove("is-invalid");
        errorMsg.innerHTML = "";
        errorMsg.classList.add("hide");
        console.log('reset funcction');
        validMsg.classList.add("hide");
    };

  

    // on keyup / change flag: reset
  
    // on blur: validate
    // input.addEventListener('blur', function() {
    //     reset(input, errorMsg, validMsg);
    //     if (input.value.trim()) {
    //         if (iti.isValidNumber()) {
    //             validMsg.classList.remove("hide");
    //         } else {
    //             input.classList.add("is-invalid");
    //             var errorCode = iti.getValidationError();
    //             errorMsg.innerHTML = errorMap[errorCode];
    //             errorMsg.classList.remove("hide");
    //         }
    //     }
    // });
    
//   var reset = function(inId = null, erId = null, valid =null) {
//     console.log('rest');
      
//     var input    =     document.querySelector('#phone');
//     var errorMsg =     document.querySelector('#error_msg');
//     var validMsg =     document.querySelector('#valid_msg');
      
//       console.log(input, validMsg, errorMsg);
//     input.classList.remove("is-invalid");
//     errorMsg.innerHTML = "";
//     errorMsg.classList.add("hide");
//     console.log(validMsg);
//     validMsg.classList.add("hide");
//   };