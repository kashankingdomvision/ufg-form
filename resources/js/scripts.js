import $, { ajax, cssNumber } from 'jquery';
import select2 from 'select2';
import intlTelInput from 'intl-tel-input';
import Swal from  'sweetalert2';
import datepicker from 'bootstrap-datepicker';
var CSRFTOKEN = $('#csrf-token').attr('content');

// var BASEURL = window.location.origin+'/ufg-form/public/json/';
// var REDIRECT_BASEURL = window.location.origin+'/ufg-form/public/';
var BASEURL = window.location.origin+'/php/ufg-form/public/json/'; 
var REDIRECT_BASEURL = window.location.origin+'/php/ufg-form/public/'; 
 
$("#generate-pdf").submit(function(event) {
    event.preventDefault();
    var $form = $(this),
    url = $form.attr('action');
    var editor = $('#editor').html();
    var formData = $(this).serializeArray();
    formData.push({name:'data', value: editor});
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        success: function (data) {
            console.log(data, 'data');
        },
        error: function (reject) {

            if( reject.status === 422 ) {

                var errors = $.parseJSON(reject.responseText);

                setTimeout(function() {
                    $("#overlay").removeClass('overlay').html('');

                    if(errors.hasOwnProperty("overrride_errors")){
                        alert(errors.overrride_errors);
                        window.location.href = REDIRECT_BASEURL + "quotes/index";
                    }
                    else{

                        jQuery.each(errors.errors, function( index, value ) {

                            index = index.replace(/\./g,'_');
                            $('#'+index).addClass('is-invalid');
                            $('#'+index).closest('.form-group').find('.text-danger').html(value);
                        });
                    }

                }, 800);
            }
        },
    });
});



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


    $('.nationality-select2').select2({
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

    $(document).on('change','.payment-method', function(){

        var payment_method           = $(this).val();
        var supplier_id              = $(this).closest('.quote').find('.supplier-id').val();
        var current_payment_methods  = $(this);

        var quoteKey                 =  $(this).closest('.quote').data('key');
        var financeKey               =  $(this).closest('.finance-clonning').data('financekey');

        var actualCost               = $(this).closest('.quote').find('.estimated-cost').val();
        var totalDepositAmountArray  = $(this).closest('.finance').find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
        var totalDepositAmount       = totalDepositAmountArray.reduce((a, b) => (a + b), 0);
        var outstanding_amount_left  = $(this).closest('.quote').find('.outstanding_amount_left').val();

        var t = 0;
        var dp = 0;
        var wa = 0;

        if(supplier_id != null && payment_method== 3){
            
            $.ajax({
                headers: {'X-CSRF-TOKEN': CSRFTOKEN},
                url: REDIRECT_BASEURL+'wallets/get-supplier-wallet-amount/'+supplier_id,
                type: 'get',
                // dataType: "json",
                success: function (data) {

                    if(data.response == true){
                        wa = parseFloat(data.message)

                        if(outstanding_amount_left > wa ){
                            $(`#quote_${quoteKey}_finance_${financeKey}_deposit_amount`).val(wa.toFixed(2));
                        }

                        if(outstanding_amount_left < wa ){
                            //    var w =  wa - outstanding_amount_left;

                            //    console.log(wa);
                            //    console.log(outstanding_amount_left);
                            // console.log(w);

                            $(`#quote_${quoteKey}_finance_${financeKey}_deposit_amount`).val(outstanding_amount_left.toFixed(2));
                        }

                        if(outstanding_amount_left == wa ){
                            // var w =  wa - outstanding_amount_left;

                            $(`#quote_${quoteKey}_finance_${financeKey}_deposit_amount`).val(wa.toFixed(2));
                        }
                    }
                },
                error: function (reject) {

                    if( reject.status === 422 ) {
                        var errors = $.parseJSON(reject.responseText);
                        alert(errors.message);
                        $(current_payment_methods).val('').trigger('change');
                    }
                },
            });
           
        }
    
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
                    options += '<option data-value="'+value.name+'" value="'+value.id+'">'+value.name+'</option>';
                });
                $('.appendHolidayType').html(options);
            }
        });
    });
 /// brands holidays
///
$(document).on('change', '.select-agency', function() {
    var agency_     = $('.agencyField');
    var passenger_  = $('.PassengerField');
    if(($(this).val() == 1)){
        $('#pax_no').val(1).change();
        agency_.removeClass('d-none');
        passenger_.addClass('d-none');
        agency_.find('input, select').removeAttr('disabled');
        passenger_.find('input, select').attr('disabled','disabled');
        // $('#agency_contact').addClass('phone phone0');
        // $('#lead_passenger_contact').removeClass('phone');
        // $('#lead_passenger_contact').removeClass('phone0');
        var iti = intlTelInput(document.querySelector('#lead_passenger_contact'), {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
        });
        iti.destroy();
        // intTelinput('gc');
    }else{
        $('#pax_no').val(1).change();
        agency_.addClass('d-none');
        passenger_.removeClass('d-none');
        passenger_.find('input, select').removeAttr('disabled');
        var iti = intlTelInput(document.querySelector('#agency_contact'), {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
        });
        iti.destroy();
        // $('#lead_passenger_contact').addClass('phone phone0');
        // $('#agency_contact').removeClass('phone');
        // $('#agency_contact').removeClass('phone0');
        agency_.find('input, select').attr('disabled','disabled');
        // intTelinput(0);
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

    $(document).on('click', '#add_more', function(e) {

        if($('.select2single').data('select2')){
            $('.select2single').select2('destroy');
        }

        $(".quote").eq(0).clone()
            .find("input").val("") .each(function(){
                this.name = this.name.replace(/\[(\d+)\]/, function(){
                    return '[' + ($('.quote').length) + ']';
                });
                this.id = this.id.replace(/\d+/g, $('.quote').length, function(){
                    return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                });
            }).end()
            .find("textarea").val("").each(function(){
                this.name = this.name.replace(/\[(\d+)\]/, function(){
                    return '[' + (parseInt($('.quote').length)) + ']';
                });
                this.id = this.id.replace(/\d+/g, $('.quote').length, function(){
                    return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                });
            }).end()
            .find("select").val("").each(function(){
                this.name = this.name.replace(/\[(\d+)\]/, function(){ return '[' + ($('.quote').length) + ']'; });
                this.id = this.id.replace(/\d+/g, $('.quote').length, function(){
                    return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                });
            }).end().show().insertAfter(".quote:last");

            $('.supplier-id:last').html(`<option selected value="">Select Supplier</option>`);
            $('.product-id:last').html(`<option selected value="">Select Product</option>`);
            $(".quote:last").attr('data-key', $('.quote').length - 1);
            $(".estimated-cost:last, .markup-amount:last, .markup-percentage:last, .selling-price:last, .profit-percentage:last, .estimated-cost-in-booking-currency:last, .selling-price-in-booking-currency:last, .markup-amount-in-booking-currency:last").val('0.00').attr('data-code', '');
            $('.quote:last .text-danger, .quote:last .supplier-currency-code').html('');
            $('.quote:last input, .quote:last select').removeClass('is-invalid');
            $(".quote:last").prepend("<div class='row'><div class='col-sm-12'><button type='button' class='btn pull-right close'> x </button></div>");
            datepickerReset(1);
            reinitializedDynamicFeilds();
    });

    $(document).on('click', '#add_more_booking', function(e) {

        if($('.select2single').data('select2')){
            $('.select2single').select2('destroy');
        }

        var quote = $(".quote").eq(0).clone()
            .find("input").val("") .each(function(){
                this.name = this.name.replace(/\[(\d+)\]/, function(){
                    return '[' + ($('.quote').length) + ']';
                });
                this.id = this.id.replace(/\d+/g, $('.quote').length, function(){
                    return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                });
            }).end()
            .find("textarea").val("").each(function(){
                this.name = this.name.replace(/\[(\d+)\]/, function(){
                    return '[' + (parseInt($('.quote').length)) + ']';
                });
                this.id = this.id.replace(/\d+/g, $('.quote').length, function(){
                    return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                });
            }).end()
            .find("select").val("").each(function(){
                this.name = this.name.replace(/\[(\d+)\]/, function(){ return '[' + ($('.quote').length) + ']'; });
                this.id = this.id.replace(/\d+/g, $('.quote').length, function(){
                    return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                });
            }).end().show().insertAfter(".quote:last");

            quote.find('.finance .row:not(:first):not(:last)').remove();
            quote.find('.estimated-cost').attr("data-status", "");
            quote.find('.markup-amount').attr("readonly", false);
            quote.find('.markup-percentage').attr("readonly", false);
            quote.find('.cal_selling_price').attr('checked','checked');
            quote.find('.deposit-amount').val('0.00');
            // quote.find('.cancel-payment-section').attr("hidden",'hidden');

            $('.quote:last .finance').find("input").val("") .each(function(){
                this.name = this.name.replace(/\[(\d+)\]/, function(){
                    return '[' + ($('.quote').length - 1 ) + ']';
                });

                let n = 1;
                let name = $(this).attr("data-name");

                this.id = this.id.replace(/[0-9]+/g,v => n++ == 2 ? 0 : v , function(){
                    return `quote_${$('.quote').length - 1}_finance_${0}_${name}`;
                });
                
            }).end()

            .find("select").val("").each(function(){
                this.name = this.name.replace(/\[(\d+)\]/, function(){
                    return '[' + ($('.quote').length - 1 ) + ']';
                });

                let n = 1;
                let name = $(this).attr("data-name");

                this.id = this.id.replace(/[0-9]+/g,v => n++ == 2 ? 0 : v , function(){
                    return `quote_${$('.quote').length - 1}_finance_${0}_${name}`;
                });
            });

            $('.supplier-id:last').html(`<option selected value="">Select Supplier</option>`);
            $('.product-id:last').html(`<option selected value="">Select Product</option>`);
            $(".quote:last").attr('data-key', $('.quote').length - 1);
            $(".estimated-cost:last, .markup-amount:last, .markup-percentage:last, .selling-price:last, .profit-percentage:last, .estimated-cost-in-booking-currency:last, .selling-price-in-booking-currency:last, .markup-amount-in-booking-currency:last").val('0.00').attr('data-code', '');
            $('.quote:last .text-danger, .quote:last .supplier-currency-code').html('');
            $('.quote:last input, .quote:last select').removeClass('is-invalid');
            $(".quote:last").prepend("<div class='row'><div class='col-sm-12'><button type='button' class='btn pull-right close'> x </button></div>");
            
            datepickerReset(1);
            reinitializedDynamicFeilds();

    });

    $(document).on('click', '.close',function(){
        $(this).closest(".quote").remove();

        getTotalValues();
        getSellingPrice();
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


    function check(x) {
        if(isNaN(x) || !isFinite(x) ){
            return parseFloat(0).toFixed(2);
        }
        return x.toFixed(2);
    }

    function getRate(supplierCurrency,bookingCurrency,rateType){
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


    $(document).on('change', '.booking-currency-id',function () {
        $('.booking-currency-code').html($(this).find(':selected').data('code'));
        changeCurrenyRate();
        getTotalValues();
        getSellingPrice();
    });

    $(document).on("keyup change", '.change', function (event) {
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


        var key         = $(this).closest('.quote').data('key');
        var changeFeild = $(this).data('name');
        var cal_selling_price  = $('.cal_selling_price').is(':checked');
        var status             = $(this).data('status');

        if(status && status=='booking' && cal_selling_price == false){
            calculateBookingDetails(key);

        }else{
            calculateQuoteDetails(key,changeFeild);
        }

    });

    
    $(document).on('change', '.cal_selling_price',function(){

        var key         = $(this).closest('.quote').data('key');
        var changeFeild = 'estimated_cost';

        if($(this).is(':checked'))
        {

            $(`#quote_${key}_markup_amount`).attr("readonly", false); 
            $(`#quote_${key}_markup_percentage`).attr("readonly", false); 
            $(`#quote_${key}_estimated_cost`).attr("data-status","");
            // calculateQuoteDetails(key,changeFeild);

        }else
        {
            $(`#quote_${key}_markup_amount`).attr("readonly", true); 
            $(`#quote_${key}_markup_percentage`).attr("readonly", true); 
            $(`#quote_${key}_estimated_cost`).attr("data-status","booking");
            // calculateBookingDetails(key);
        }
  
    });


    function calculateQuoteDetails(key,changeFeild){



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
    }

    function calculateBookingDetails(key){

        var estimatedCost     =  parseFloat($(`#quote_${key}_estimated_cost`).val()).toFixed(2);
        var sellingPrice      =  parseFloat($(`#quote_${key}_selling_price`).val()).toFixed(2);
        var supplierCurrency  =  $(`#quote_${key}_supplier_currency_id`).find(':selected').data('code');
        var bookingCurrency   =  $(".booking-currency-id").find(':selected').data('code');
        var rateType          =  $('input[name="rate_type"]:checked').val();
        var rate              =  getRate(supplierCurrency,bookingCurrency,rateType);
 
        var calculatedMarkupAmount     = 0;
        var calculatedMarkupPercentage = 0;
        var calculatedProfitPercentage = 0;
        var calculatedEstimatedCostInBookingCurrency = 0;
        var calculatedSellingPriceInBookingCurrency = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;

        calculatedMarkupAmount                   = parseFloat(sellingPrice) - parseFloat(estimatedCost);
        calculatedMarkupPercentage               = parseFloat(calculatedMarkupAmount) / parseFloat(estimatedCost / 100);
        calculatedProfitPercentage               = ((parseFloat(sellingPrice) - parseFloat(estimatedCost)) / parseFloat(sellingPrice)) * 100;
        calculatedEstimatedCostInBookingCurrency = parseFloat(estimatedCost) * parseFloat(rate);
        calculatedSellingPriceInBookingCurrency  = parseFloat(sellingPrice) * parseFloat(rate);
        calculatedMarkupAmountInBookingCurrency  = parseFloat(calculatedMarkupAmount) * rate ;

        $(`#quote_${key}_markup_amount`).val(check(calculatedMarkupAmount));
        $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
        $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
        $(`#quote_${key}_estimated_cost_in_booking_currency`).val(check(calculatedEstimatedCostInBookingCurrency));
        $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));

        getTotalValues();
        getSellingPrice();
    }


    $(document).on('change', '.selling-price-other-currency',function(){
        $('.selling-price-other-currency-code').text($(this).val());
        getSellingPrice();
    });

    $(document).on('keyup', '.deposit-amount',function(){

        var quoteKey        =  $(this).closest('.quote').data('key');
        var financeKey      =  $(this).closest('.finance-clonning').data('financekey');
        var depositAmount   =  parseFloat($(this).val()).toFixed(2);

        var estimated_cost     =  parseFloat($(`#quote_${quoteKey}_estimated_cost`).val()).toFixed(2);
        var actualCost         =  parseFloat($(`#quote_${quoteKey}_outstanding_amount_left`).val()).toFixed(2);

        var totalDepositAmountArray = $(this).closest('.finance').find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
        var totalDepositAmount      = totalDepositAmountArray.reduce((a, b) => (a + b), 0);
        var outstandingAmountLeft   = estimated_cost - totalDepositAmount;

        var closestFinance = $(this).closest('.finance');


        if(outstandingAmountLeft >= 0){
            $(`#quote_${quoteKey}_outstanding_amount_left`).val(outstandingAmountLeft.toFixed(2));
            $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val(outstandingAmountLeft.toFixed(2));
        }else{
            alert("Please Enter Correct Deposit Amount");
            $(this).closest('.finance').find('.deposit-amount:last').val('0.00');
            $(this).closest('.finance').find('.outstanding-amount:last').val('');
        }

        var payment_method = $(this).closest('.finance').find('.payment-method').val();
        var wa = 0;
        var supplier_id              = $(this).closest('.quote').find('.supplier-id').val();
        if(payment_method && payment_method == 3){

            $.ajax({
                headers: {'X-CSRF-TOKEN': CSRFTOKEN},
                url: REDIRECT_BASEURL+'wallets/get-supplier-wallet-amount/'+supplier_id,
                type: 'get',
                // dataType: "json",
                success: function (data) {

                    if(data.response == true){
                        wa = parseFloat(data.message);
                        if(depositAmount > wa){
                            alert("Please Enter Correct Wallet Amount.");
                            closestFinance.find('.deposit-amount:last').val('0.00');
                            closestFinance.find('.outstanding-amount:last').val('');
                        }
                    }
                },
                error: function (reject) {}
            });


            // console.log("payment_method is set");
        }else{
            // console.log("payment_method is not set");
        }

    });

    
    $(document).on('click', '.view-payment_detail',function(){

        var details = $(this).data('details');
        var tbody = '';
        var client_type = details.client_type == 1 ? 'Client' : 'Agency';
        var payment_method = '';
        if(details.payment_type_id == 1){
            payment_method = 'Bank';
        }
        else if(details.payment_type_id == 2){
            payment_method = 'Paysafe';
        }else{
            payment_method = '';
        }
  
        console.log(payment_method);


        tbody +=`<tr>
                    <th>Ref #</th>
                    <td>${isEmpty(details.zoho_booking_reference)}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>${(isEmpty(details.status))}</td>
                </tr>
                <tr>
                    <th>Payment For</th>
                    <td>${isEmpty(details.payment_for)}</td>
                </tr>
                <tr>
                    <th>Payment Method</th>
                    <td>${isEmpty(payment_method)}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>${isEmpty(details.date)}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>${isEmpty(details.amount)}</td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td>${isEmpty(client_type)}</td>
                </tr>
                <tr>
                    <th>Ref ID</th>
                    <td>${isEmpty(details.ref_id)}</td>
                </tr>
                <tr>
                    <th>Card Holder Name</th>
                    <td>${isEmpty(details.card_holder_name)}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>${isEmpty(details.b_street_address)}</td>
                </tr>
                <tr>
                    <th>Post Code</th>
                    <td>${isEmpty(details.b_zip_code)}</td>
                </tr>
                <tr>
                    <th>Note</th>
                    <td>${isEmpty(details.note)}</td>
                </tr>
                <tr>
                    <th>Sort Code</th>
                    <td>${isEmpty(details.sort_code)}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>${isEmpty(details.created_at)}</td>
                </tr>
                <tr>
                    <th>Amount Payable</th>
                    <td>${isEmpty(details.amount_payable)}</td>
                </tr>`;

        jQuery('#payment_details_modal').modal('show');
        jQuery('#payment_details_modal_body').html(tbody);
    });

    function isEmpty(value){
        return (value == null || value == '' || value == 'undefined' ? 'N/A' : value );
    }

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

                    if(errors.hasOwnProperty("overrride_errors")){
                        alert(errors.overrride_errors);
                        window.location.href = REDIRECT_BASEURL + "quotes/index";
                    }
                    else{

                        jQuery.each(errors.errors, function( index, value ) {

                            index = index.replace(/\./g,'_');
                            $('#'+index).addClass('is-invalid');
                            $('#'+index).closest('.form-group').find('.text-danger').html(value);
                        });
                    }

                }, 800);
            }
        },
    });
});


$("#update-override").submit(function(event) {
    event.preventDefault();

    var $form = $(this),
    url = $form.attr('action');
 
    $.ajax({
        type: 'POST',
        url: url,
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function() {
            $("#override_submit").find('span').addClass('spinner-border spinner-border-sm');
        },
        success: function (data) {


            if(data.success_message){

                $("#override_submit").find('span').removeClass('spinner-border spinner-border-sm');
                jQuery('#override_modal').modal('hide');
            }


            // $("#overlay").removeClass('overlay').html('');
            // setTimeout(function() {
            //     alert('Quote updated Successfully');
            //     window.location.href = REDIRECT_BASEURL + "quotes/index";
            // }, 800);
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

    var reference_no = $('.reference-name').val();
    if(reference_no == ''){
        alert('Reference number is not found');
        searchRef.text('Search').prop('disabled', false);
    }else{
        $('#ref_no').closest('.form-group').find('.text-danger').html('');
        //check refrence is already exist in system
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
                        beforeSend: function() {

                            $(".search-reference-btn").find('span').addClass('spinner-border spinner-border-sm');
                            searchRef.prop('disabled', true);
                        },
                        success: function (data) {
                            console.log(data);
                            var tbody = '';
                            if(data.response)
                            {
                                
                                if(data.response.tas_ref){
                                    $("#tas_ref").val(data.response.tas_ref);
                                }
                     
                                if(data.response.passengers && data.response.passengers.hasOwnProperty('lead_passenger') && data.response.passengers.lead_passenger.hasOwnProperty('passenger_name') )
                                {
                                    $('#lead_passenger_name').val(data.response.passengers.lead_passenger.passenger_name);
                                }

                                if(data.response.brand && data.response.brand.hasOwnProperty('brand_id'))
                                {
                                    $('#brand_id').val(data.response.brand.brand_id).change();
                                }

                                if(data.response.brand && data.response.brand.hasOwnProperty('name'))
                                {
                                    setTimeout(function(){
                                        $("#holiday_type_id option:contains("+data.response.brand.name+")").attr('selected', 'selected').change();
                                        // $("#holiday_type_id option[data-value='" + data.response.brand.name +"']").attr("selected","selected");
                                    }, 500);
                                }

                                if(data.response.sale_person)
                                {
                                    $('#sale_person_id').val(data.response.sale_person).trigger('change');
                                }

                                if(data.response.pax)
                                {
                                    $('#pax_no').val(data.response.pax).trigger('change');
                                }

                                if(data.response.currency)
                                {
                                    $("#currency_id").find('option').each(function(){
                                        if( $(this).data('code') == data.response.currency ) {
                                            $(this).attr("selected","selected").change();
                                        }
                                    });
                                }
                        
                                if(data.response.passengers &&  data.response.passengers.hasOwnProperty('lead_passenger') && data.response.passengers.lead_passenger.hasOwnProperty('dinning_prefrences') )
                                {
                                    $('#dinning_preference').val(data.response.passengers.lead_passenger.dinning_prefrences);
                                }

                                if(data.response.passengers && data.response.passengers.hasOwnProperty('lead_passenger') && data.response.passengers.lead_passenger.hasOwnProperty('bedding_prefrences') )
                                {
                                    $('#bedding_preference').val(data.response.passengers.lead_passenger.bedding_prefrences);
                                }
                            
                                // Passengers Details
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

                            }else{
                                alert(data.error);
                            }

                            searchRef.prop('disabled', false);
                            $(".search-reference-btn").find('span').removeClass('spinner-border spinner-border-sm');
   
                        },
                        error: function (reject) {

                            searchRef.prop('disabled', false);
                            $(".search-reference-btn").find('span').removeClass('spinner-border spinner-border-sm');
                            $('#ref_no').closest('.form-group').find('.text-danger').html(reject.responseJSON.errors);

                        },
                    });
                }
            },
            error: function (reject) {

                alert(reject);
                searchRef.text('Search').prop('disabled', false);

                searchRef.prop('disabled', false);
                $(".search-reference-btn").find('span').removeClass('spinner-border spinner-border-sm');

            },
        });
        //ajax for references
   }
});

$(document).on('click','.clone_booking_finance', function(){

    if ($('.select2single').data('select2')) {
        $('.select2single').select2('destroy');
    }

    var $quote               = $(this).closest('.quote');
    var quoteKey             = $quote.data('key');
    var financeCloningLength = $quote.find(".finance-clonning").length;

    $quote.find('.finance-clonning').first().clone().find("input").val("").each(function(){

        let n = 1;
        let name = $(this).attr("data-name");

        this.name = this.name.replace(/]\[(\d+)]/g, function(){
            return ']['+financeCloningLength+']';
        });

        this.id = this.id.replace(/[0-9]+/g,v => n++ == 2 ? financeCloningLength : v , function(){
            return `quote_${quoteKey}_finance_${financeCloningLength}_${name}`;
        });

    }).end().find('.depositeLabel').each(function () {

        this.id = 'deposite_heading'+ financeCloningLength;
        $(this).text(`Payment #${financeCloningLength+1}`);

    }).end()
    .find("select").val("").each(function(){
        
        let n = 1;
        let name = $(this).attr("data-name");

        this.name = this.name.replace(/]\[(\d+)]/g, function(){
            return ']['+ financeCloningLength +']';
        });
    
        this.id = this.id.replace(/[0-9]+/g,v => n++ == 2 ? financeCloningLength : v , function(){
            return `quote_${quoteKey}_finance_${financeCloningLength}_${name}`;
        });

    }).end().find('.select2single').select2({
        width: '100%',
        theme: "bootstrap",
    }).end()
    .show()
    .insertAfter($quote.find('.finance-clonning:last'));

    // set feild after clone
    $quote.find('.finance-clonning:last .checkbox').prop('checked', false);
    $quote.find('.finance-clonning:last .deposit-amount').val('0.00').attr("readonly", false);
    $quote.find('.finance-clonning:last .ab_number_of_days').val('0').attr("readonly", false);
    $quote.find('.finance-clonning:last').attr('data-financekey',financeCloningLength);
 
    reinitializedDynamicFeilds();
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

                $('.select2single').select2({
                    width: '100%',
                    theme: "bootstrap",
                    templateResult: formatState,
                    templateSelection: formatState,
                });

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

    $('#update-booking :input').prop('disabled', false);

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
                alert(data.success_message);
                window.location.href = REDIRECT_BASEURL + "bookings/index";
                
            }, 1000);
        },
        error: function (reject) {

            if( reject.status === 422 ) {

                var errors = $.parseJSON(reject.responseText);

                setTimeout(function() {

                    $("#overlay").removeClass('overlay').html('');

                    if(errors.hasOwnProperty("overrride_errors")){
                        alert(errors.overrride_errors);
                        window.location.href = REDIRECT_BASEURL + "bookings/index";
                    }
                    else{

                        jQuery.each(errors.errors, function( index, value ) {

                            index = index.replace(/\./g,'_');
                            $('#'+index).addClass('is-invalid');
                            $('#'+index).closest('.form-group').find('.text-danger').html(value);
                        });
                    }

                }, 800);

            }
        },
    });
});




$(document).on('click', '.credit-note-hidden-btn', function(){
    $(this).closest('.quote').find('.credit-note-hidden-section').attr("hidden",true);
});


$(document).on('click', '.refund-payment-hidden-btn', function(){

    $(this).closest('.quote').find('.refund-payment-hidden-section').attr("hidden",true);
});

$(document).on('change', '.refund_amount', function(){

    var totalDepositAmountArray = $(this).closest('.quote').find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
    var totalDepositAmount      = totalDepositAmountArray.reduce((a, b) => (a + b), 0);
    var refundAmount            = parseFloat($(this).val());

    if(refundAmount != totalDepositAmount){
        alert("Please Enter Correct Paid Amount");
        $(this).val('0.00');
    }
});

$(document).on('change', '.credit-note-amount', function(){

    var totalDepositAmountArray = $(this).closest('.quote').find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
    var totalDepositAmount      = totalDepositAmountArray.reduce((a, b) => (a + b), 0);
    var refundAmount            = parseFloat($(this).val());

    console.log(refundAmount);
    console.log(totalDepositAmount);


    if(refundAmount != totalDepositAmount){
        alert("Please Enter Correct Paid Amount");
        $(this).val('0.00');
    }
});

$(document).on('click', '.refund-to-bank', function(){


    
    var quoteKey                 =  $(this).closest('.quote').data('key');
 
    // var financeKey               =  $(this).closest('.finance-clonning').data('financekey');

    $(this).closest('.quote').find('.refund-payment-hidden-section').removeAttr("hidden");

    $(this).closest('.quote').find('.credit-note-hidden-section').attr("hidden",true);


  
    $(`#quote_${quoteKey}_credit_note_0_credit_note_amount`).val('');
     
    
    var totalDepositAmountArray = $(this).closest('.quote').find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
    var totalDepositAmount      = totalDepositAmountArray.reduce((a, b) => (a + b), 0);

    $(this).closest('.quote').find('.refund_amount').val(totalDepositAmount.toFixed(2));

    // var booking_detail_id = $(this).data('booking_detail_id');

    // var totalDepositAmountArray  = $(this).closest('.quote').find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
    // var totalDepositAmount = totalDepositAmountArray.reduce((a, b) => (a + b), 0);
    // $('#total_deposit_amount').val(totalDepositAmount);

    // jQuery('#refund_to_bank_modal').modal('show');
    // $('#booking_detail_id').val(booking_detail_id);

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

$(document).on('click', '.credit-note', function(){

    $(this).closest('.quote').find('.credit-note-hidden-section').removeAttr("hidden");
    // $(this).closest('.quote').find('input, .select2single').prop("disabled", false);

    var quoteKey                 =  $(this).closest('.quote').data('key');
    $(`#quote_${quoteKey}_refund_0_refund_amount`).val('');

    $(this).closest('.quote').find('.refund-payment-hidden-section').attr("hidden",true);

    var totalDepositAmountArray = $(this).closest('.quote').find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
    var totalDepositAmount      = totalDepositAmountArray.reduce((a, b) => (a + b), 0);

    $(this).closest('.quote').find('.credit-note-amount').val(totalDepositAmount.toFixed(2));

    // var booking_detail_id = $(this).data('booking_detail_id');

    // var totalDepositAmountArray  = $(this).closest('.quote').find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
    // var totalDepositAmount = totalDepositAmountArray.reduce((a, b) => (a + b), 0);

    // console.log(totalDepositAmount);
    // console.log(booking_detail_id);

    
    // jQuery('#credit_note_modal').modal('show');
    
    // $('.total_deposit_amount').val(totalDepositAmount);
    // $('.booking_detail_id').val(booking_detail_id);
   
});

$(document).on('change', '.deposit-due-date', function(){
    var close = $(this).closest('.finance-clonning');
    close.find('.plus').removeAttr('disabled');
});


$('.parent').on('click', function(e) {
    if($(this).is(':checked',true))  
    {
       $(".child").prop('checked', true);  

    } else {  

       $(".child").prop('checked',false);  
    }  
});
 
$('#delete_all').on('click', function(e) {
    e.preventDefault();
    var checkedValues  =  $('.child:checked').map((i, e) => e.value ).get();

    if(checkedValues.length > 0){
        jQuery('#multiple_delete_modal').modal('show');
    }else{
        alert("Please Check any Record First");
    }
 
});

$('#multiple_delete').on('click', function(e) {
    e.preventDefault();
 
    var checkedValues  =  $('.child:checked').map((i, e) => e.value ).get();
    var tableName      =  $('.table-name').val();
    $.ajax({
        url: REDIRECT_BASEURL+'multiple-delete/'+checkedValues,
        type: 'Delete',  
        dataType: "JSON",
        data: { "checkedValues": checkedValues, "tableName": tableName },
        beforeSend: function() {
            $("#multiple_delete").find('span').addClass('spinner-border spinner-border-sm');
        },
        success: function (response)
        {

            if(response.status == true){


                $("#multiple_delete").find('span').removeClass('spinner-border spinner-border-sm');
                jQuery('#multiple_delete_modal').modal('hide');
                
                setTimeout(function() {
                    
                    alert(response.message);
                    location.reload();

                }, 600);
           
            }
        },
        error: function(xhr) {
          console.log(xhr.responseText);  
        }
    });
 
});

$('.multiple-action').on('change', function(e) {

    var action = $(this).val();
    var checkedValues  =  $('.child:checked').map((i, e) => e.value ).get();
    if(checkedValues.length > 0){
        jQuery('#multiple_delete_modal').modal('show');
        $('.action_name').val(action);
        $('#multiple_delete').addClass('btn btn-danger');
        $("#multiple_delete").html(action);
        $('#multiple_delete').removeClass();
        $('#multiple_delete').addClass('btn btn-primary');
        if(action == 'Delete'){
            $('#multiple_delete').addClass('btn btn-danger');
        }
    }else{
        alert("Please Check any Record First");
        $('.multiple-action').val("");
    }

    // if(action && checkedValues.length > 0){

    //     $.ajax({
    //         url: REDIRECT_BASEURL+'quotes/multiple-delete',
    //         type: 'delete',  
    //         dataType: "JSON",
    //         data: { "checkedValues": checkedValues, "action": action },
    //         beforeSend: function() {
    //             $("#multiple_delete").find('span').addClass('spinner-border spinner-border-sm');
    //         },
    //         success: function (response)
    //         {
    
    //             if(response.status == true){
    
    
    //                 $("#multiple_delete").find('span').removeClass('spinner-border spinner-border-sm');
    //                 jQuery('#multiple_delete_modal').modal('hide');
                    
    //                 setTimeout(function() {
                        
    //                     alert(response.message);
    //                     location.reload();
    
    //                 }, 600);
               
    //             }
    //         },
    //         error: function(xhr) {
    //           console.log(xhr.responseText);  
    //         }
    //     });

   
    // }
 
});

///booking incremnet and

$(document).on('click', '.increment', function() {

    var close = $(this).closest('.finance-clonning');

        var valueElement = close.find('.ab_number_of_days');
        var dueDate      = close.find('.deposit-due-date').val();
        var nowDate      = todayDate();
        const firstDate = new Date(dueDate);
        const secondDate = convertDate(nowDate);

        if(firstDate == 'Invalid Date'){
            alert('Deposite Date is Required');
        }else{
            if(!$(valueElement).is('[readonly]')) { 
                const oneDay = 24 * 60 * 60 * 1000;
                const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
                if(firstDate < secondDate){
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
        }
    return false;
});
///booking incremnet and

// tel input  start
if($('.phone').length > 0){
    for (let i = 0; i < $('.phone').length; i++) {
        if($('.phone'+i).length != 0){
            intTelinput(i);
        }
    }
}

if($('#agency_contact').length > 0){
    intTelinput('gc');
    // console.log(inTelinput);
}


//tel input end
//intl-tel-input ************** Start ******************** //
function intTelinput(key = null, inVal = null) {
    // console.log(key);
    var input    =    document.querySelector('.phone'+key);
    var errorMsg =    document.querySelector('.error_msg'+key);
    var validMsg =    document.querySelector('.valid_msg'+key);
    var iti = intlTelInput(input, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
        separateDialCode: true,
        formatOnDisplay:true,
        initialCountry: "US",
        nationalMode: true,
        hiddenInput: "full_number",
        autoPlaceholder: "polite",
        placeholderNumberType: "MOBILE",
    });
    input.nextElementSibling.value = iti.getNumber();
    // iti.setCountry("US");
    // on blur: validate
    var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
    input.addEventListener('blur', function() {
            input.nextElementSibling.value = iti.getNumber();
            reset();
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                    $('.buttonSumbit').removeAttr('disabled');
                    input.classList.add("is-valid");
                    validMsg.innerHTML = 'The number is valid';
                } else {
                    $('.buttonSumbit').attr('disabled', 'disabled');
                    input.classList.add("is-invalid");
                    validMsg.innerHTML = '';
                    var errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");
                }
            }
        });


        var reset = function() {
            input.classList.remove("is-invalid");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
        };
}
//intl-tel-input ************** End ******************** //


/// pax append work  start//



$(document).on('change', '.pax-number', function () {
        
    $('.nationality-select2').select2('destroy');

    var $_val = $(this).val();
    var agencyVal = $('.select-agency:checked').val();
 
    var currentDate = curday('-');
    var countries = $('#content').data('countries');
    if(agencyVal == $_val){
        var count = 1;
        var $v_html = `
        <div class="mb-1 appendCount" id="appendCount${count}">
            <div class="row" >
                <div class="col-md-3 mb-2">
                    <label>Passenger #${count} Full Name <span class="text-danger">*</span></label> 
                    <input type="text" name="pax[${count}][full_name]" class="form-control" placeholder="Passsenger Name" >
                </div>
                <div class="col-md-3 mb-2">
                    <label>Email Address <span class="text-danger">*</span></label> 
                    <input type="email" name="pax[${count}][email_address]" class="form-control" placeholder="Email Address" >
                </div>
                <div class="col-md-3 mb-2">
                    <label>Contact Number <span class="text-danger">*</span></label> 
                    <input type="tel" name="pax[${count}][contact_number]"  data-key="${count}" class="form-control phone phone${count}" >
                    <span class="text-danger error_msg${count}" role="alert"></span>
                    <span class="text-success valid_msg${count}" role="alert"></span>
                </div>
                <div class="col-md-3 mb-2">
                    <label>Date Of Birth <span class="text-danger">*</span></label> 
                    <input type="date" max="{{ date('Y-m-d') }}" name="pax[${count}][date_of_birth]" class="form-control" placeholder="Date Of Birth" >
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label>Nationality <span class="text-danger">*</span></label>
                    <select name="pax[${count}][nationality_id]"  class="form-control nationality-select2 nationality-id">
                        <option selected value="" >Select Nationality</option>
                        ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label>Bedding Preference <span class="text-danger">*</span></label> 
                    <input type="text" name="pax[${count}][bedding_preference]" class="form-control" placeholder="Bedding Preferences" >
                </div>
                
                <div class="col-md-3 mb-2">
                    <label>Dinning Preference <span class="text-danger">*</span></label> 
                    <input type="text" name="pax[${count}][dinning_preference]" class="form-control" placeholder="Dinning Preferences" >
                </div>
              
            </div>
        </div>`;
        $('#appendPaxName').html($v_html);
        intTelinput(1);
        $('#pax_no option').first().attr('disabled', 'disabled');
        
    }
    if($_val > $('.appendCount').length){
        var countable = ($_val - $('.appendCount').length) - 1;
        if(agencyVal == 1){
            var countable = ($_val - $('.appendCount').length);
        }
        
                  
        for (i = 1; i <= countable; ++i) {
            var count = $('.appendCount').length + 1;
            var c = count + 1;
            
            if(agencyVal == 1){
                c = count;
            }
            const $_html = `
                    <div class="mb-1 appendCount" id="appendCount${count}">
                        <div class="row" >
                            <div class="col-md-3 mb-2">
                                <label class="mainLabel">Passenger #${c} Full Name</label> 
                                <input type="text" name="pax[${count}][full_name]" class="form-control" placeholder="PASSENGER #${count} FULL NAME" >
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Email Address</label> 
                                <input type="email" name="pax[${count}][email_address]" class="form-control" placeholder="EMAIL ADDRESS" >
                            </div>
                            
                          
                            <div class="col-md-3 mb-2">
                                <label>Contact Number</label> 
                                <input type="tel" name="pax[${count}][contact_number]"  data-key="${count}" class="form-control phone phone${count}" >
                                <span class="text-danger error_msg${count}" role="alert"></span>
                                <span class="text-success valid_msg${count}" role="alert"></span>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Date Of Birth</label> 
                                <input type="date" max="{{ date('Y-m-d') }}" name="pax[${count}][date_of_birth]" class="form-control" placeholder="Date Of Birth" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Nationality</label>
                                <select name="pax[${count}][nationality_id]"  class="form-control nationality-select2 nationality-id">
                                    <option selected value="" >Select Nationality</option>
                                    ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Bedding Preference</label> 
                                <input type="text" name="pax[${count}][bedding_preference]" class="form-control" placeholder="BEDDING PREFERENCES" >
                            </div>
                            
                            <div class="col-md-3 mb-2">
                                <label>Dinning Preference</label> 
                                <input type="text" name="pax[${count}][dinning_preference]" class="form-control" placeholder="DINNING PREFERENCES" >
                            </div>
                            <div class="col-md-3 mb-2">
                                <button type="button" class=" remove-pax-column mt-2 btn btn-dark float-right"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>`;
                    $('#appendPaxName').append($_html);
                    intTelinput(count);
        }
    }else{
        if(agencyVal != $_val){
            var countable = $('.appendCount').length + 1;
            for (var i = countable - 1; i >= $_val; i--) {
                $("#appendCount"+i).remove();
            }
        }
    }
    $('.nationality-select2').select2({
        width: '100%',
        theme: "bootstrap",
    });
    getSellingPrice();
});

$(document).on('click', '.add-pax-column', function () {
    var pax_value = $('#pax_no').val();
    var updateCount = (pax_value != '')? parseInt(pax_value) + 1 : 1;
    if (isNaN(updateCount)) {
        $('#pax_no').val(1).change();
    }else{
        $('#pax_no').val(updateCount).change();
    }
});


$(document).on('click', '.remove-pax-column', function () {
    var agency_Val =  $('.select-agency:checked').val();
    $(this).closest('.appendCount').remove();
    var pax_value = $('#pax_no').val();
    var updateCount = parseInt(pax_value) - 1;
    $('#pax_no').val(updateCount).change();
    
    var ids = [];
    $('.appendCount').each(function(){
        ids.push($(this).attr('id')); 
      });
    let _val  = 2
    let idLength = ids.length + _val;
    if(agency_Val == 1){
        _val = 1
        idLength = ids.length + _val;
    }
    for (let i = 0; i <= ids.length; i++) {
        var count = 2 + i;
        if(agency_Val == 1){
            count = 1 + i;
        }
        $('#'+ids[i]).find('.mainLabel').text('Passenger #'+count+' Full Name');
    }
});
//pax appednd work end

var btnname = null;
//BUlk DATA DELETE
$('.btnbulkClick').on('click', function (e) {
    btnname = $(this).attr('name');
})

$(".bulkDeleteData").submit(function(e) {
    e.preventDefault(); 
    var url = $(this).attr('action');
    var checkedValues  =  $('.child:checked').map((i, e) => e.value ).get();
    var formData = $(this).serializeArray();
    formData.push({name:'id', value: checkedValues});
    formData.push({name:'btn', value: btnname});
    var message= 'Are you sure you want to delete records?';
    if(btnname == 'archive'){
        message = 'Are you sure you want to add this records in archive?'
    }else if(btnname == 'unarchive'){
        message = 'Are you sure you want to revert this records from archive?'
    }else if(btnname = 'quote delete'){
        message = 'Are you sure you want to cancel this quotes?';
    }
    
     if(checkedValues.length > 0){
         Swal.fire({
             title: 'Are you sure?',
             text: message,
             focusConfirm: false,
             showCancelButton: true,
             confirmButtonText: 'Yes, '+btnname+' it!',
             confirmButtonColor: '#5cb85c',
             cancelButtonText: 'No, keep it',
             showLoaderOnConfirm: true,
           }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: $.param(formData), 
                    success: function(data)
                    {
                        setTimeout(function() {
                            alert(data.message);
                            location.reload();
                        }, 600);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                ///no action here
            }
           })
     }else{
         alert('Please Check any Record First');
     }
});


/// Update Currency Status
$("#currencyStatus").submit(function(e) {
    e.preventDefault(); 
    console.log('run');
    var url = $(this).attr('action');
    var checkedValues  =  $('.child:checked').map((i, e) => e.value ).get();
    var formData = $(this).serializeArray();
    formData.push({name:'id', value: checkedValues});
    formData.push({name:'btn', value: btnname});
    var message = 'Are you sure you want to inactive this records?'
    if(btnname == 'active'){
        message = 'Are you sure you want to active this records?'
    }
     if(checkedValues.length > 0){
         Swal.fire({
             title: 'Are you sure?',
             text: message,
             focusConfirm: false,
             showCancelButton: true,
             confirmButtonText: 'Yes, '+btnname+' it!',
             confirmButtonColor: '#5cb85c',
             cancelButtonText: 'No, keep it',
             showLoaderOnConfirm: true,
           }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $.param(formData), 
                    success: function(data)
                    {
                        setTimeout(function() {
                            alert(data.message);
                            location.reload();
                        }, 600);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                ///no action here
            }
           })
     }else{
         alert('Please Check any Record First');
     }
});
/// Update Currency Status
//BUlk DATA DELETE


///////////////// RELEVANT QUOTE FIELD

$('#cloneRelevantquote').on('click', function() {
   $('.relevant-quote').eq(0).clone().find("input").val("") .each(function(){
                this.name = this.name.replace(/\[(\d+)\]/, function(){
                    return '[' + ($('.quote').length) + ']';
                });
                this.id = this.id.replace(/\d+/g, $('.quote').length, function(){
                    return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                }); 
            }).end().show().insertAfter(".relevant-quote:last");
});
///////////////// RELEVANT QUOTE FIELD
});
