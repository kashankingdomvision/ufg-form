import $ from 'jquery';
window.jQuery = $;
window.$ = $;

import 'jquery-ui/ui/widgets/sortable.js';
import select2 from 'select2';
import intlTelInput from 'intl-tel-input';
import Swal from 'sweetalert2';
import datepicker from 'bootstrap-datepicker';
import daterangepicker from 'daterangepicker';
import { result } from 'lodash';

// require('./global_variables');
require('./laravel_filemanager/stand-alone-button');
require('./summernote/summernote-bs4.min');
require('./bootstrap/bootstrap.bundle.min');
require('./adminlte/adminlte');
require('./intl_tel_input/utils');

window.BASEURL          = `${window.location.origin}/ufg-form/public/json/`;
window.REDIRECT_BASEURL = `${window.location.origin}/ufg-form/public/`;
window.FILE_MANAGER_URL = `${window.location.origin}/ufg-form/public/laravel-filemanager`;
window.CSRFTOKEN        = $('#csrf-token').attr('content');


$(document).ready(function($) {


    console.log(window.BASEURL);

    callLaravelFileManger();
    datepickerReset();

    /*  ajaxSetup */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRFTOKEN
        }
    });

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
        templateResult: formatState,
        templateSelection: formatState,
    });

    $('.select2-single').select2({
        width: '90%',
        theme: "bootstrap",
    });

    $('.selling-price-other-currency').select2({
        width: '68%',
        theme: "bootstrap",
        templateResult: formatState,
        templateSelection: formatState,
    });

    $('.summernote').summernote({
        height: 100,   //set editable area's height
        placeholder: 'Enter Text Here..',
        codemirror: { // codemirror options
            theme: 'monokai'
        }
    });

    // make quote section sortable
    $(".sortable").sortable();

    $('.date-range-picker').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            format: 'DD/MM/YYYY',
        }
    });

    $('.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

    $('.date-range-picker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });


    function calltextEditorSummerNote(val = null) {
        $('.summernote:last').summernote('destroy');
        $('.note-editor:last').remove();
        $('.summernote').summernote({
            height: 100,   //set editable area's height
            placeholder: 'Enter Text Here..',
            codemirror: { // codemirror options
                theme: 'monokai'
            }
        }, 'code', val);
    }

    function setTextEditorValue(id, Text) {
        $(id).summernote('code', Text);
    }

    function callLaravelFileManger() {
        var route_prefix = FILE_MANAGER_URL;
        jQuery('.fileManger').filemanager('image', {prefix: route_prefix});
    }

    function formatState(option) {
        var optionImage = $(option.element).attr('data-image');
        if (!optionImage) {
            return option.text;
        }

        return $(`<span><img height="20" width="20" src="${optionImage}" width="60px" />${option.text}</span>`);
    };

    function reinitializedDynamicFeilds() {
        $('.select2single').select2({
            width: '100%',
            theme: "bootstrap",
            templateResult: formatState,
            templateSelection: formatState,
        });
    }

    function reinitializedMultiDynamicFeilds() {
        $('.select2-multiple').select2({
            width: '100%',
            theme: "classic",
            templateResult: formatState,
            templateSelection: formatState,
        });
    }

    function disabledFeild(p) {
        $(p).attr("disabled", true);
    }

    function removeDisabledAttribute(p) {
        $(p).removeAttr("disabled");
    }

    
    function removeFormValidationStyles(){
        $('input, select').removeClass('is-invalid');
        $('.text-danger').html('');
    }

    function addFormLoadingStyles(){
        $("#overlay").addClass('overlay');
        $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
    }

    function removeFormLoadingStyles() {
        $("#overlay").removeClass('overlay');
        $("#overlay").html('');
    }

    var curday = function(sp) {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //As January is 0.
        var yyyy = today.getFullYear();
        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;
        return (yyyy + sp + mm + sp + dd);
    };

    function todayDate() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        return today = dd + '/' + mm + '/' + yyyy;
    }

    function datepickerReset(key = null, quoteClass) {

        var $season = $("#season_id");
        var season_start_date = new Date($season.find(':selected').data('start'));
        var season_end_date = new Date($season.find(':selected').data('end'));
        if (season_start_date != 'Invalid Date' && season_end_date != 'Invalid Date') {
            if (key != null) {
                $(`${quoteClass} .bookingDateOfService`).datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
                // $('.bookingDate:last').datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
                // $('.bookingDueDate:last').datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
                $(`${quoteClass} .bookingEndDateOfService`).datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
                $('.stored-text-date').datepicker("destroy").datepicker({ autoclose: true, format: 'dd/mm/yyyy' });
            } else {
                // $('.datepicker').datepicker('destroy').datepicker({  autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
                $('.datepicker').datepicker("destroy").datepicker({ autoclose: true, format: 'dd/mm/yyyy' });

            }
        } else {
            $('.datepicker').datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy' });
        }
    }

    function convertDate(date) {
        var dateParts = date.split("/");
        return dateParts = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);
    }

    var currencyConvert = getJson();
    function getJson() {
        return JSON.parse($.ajax({
            type: 'GET',
            url: `${BASEURL}get-currency-conversion`,
            dataType: 'json',
            global: false,
            async: false,
            success: function(data) {
                return data;
            }
        }).responseText);
    }

    var commissionCriteriaRates = getCommissionCriteriaJson();
    function getCommissionCriteriaJson() {
        return JSON.parse($.ajax({
            type: 'GET',
            url: `${BASEURL}get-commission-criterias`,
            dataType: 'json',
            global: false,
            async: false,
            success: function(data) {
                return data;
            }
        }).responseText);
    }

    var commissions = getCommissionJson();
    function getCommissionJson() {
        return JSON.parse($.ajax({
            type: 'GET',
            url: `${BASEURL}get-commissions`,
            dataType: 'json',
            global: false,
            async: false,
            success: function(data) {
                return data;
            }
        }).responseText);
    }

    var commissionGroups = getCommissionGroupsJson();
    function getCommissionGroupsJson() {
        return JSON.parse($.ajax({
            type: 'GET',
            url: `${BASEURL}get-commission-groups`,
            dataType: 'json',
            global: false,
            async: false,
            success: function(data) {
                return data;
            }
        }).responseText);
    }

    function check(x) {

        if (isNaN(x) || !isFinite(x)) {
            return parseFloat(0).toFixed(2);
        }

        return parseFloat(x).toFixed(2);
    }

    function checkForInt(x) {

        if (isNaN(x) || !isFinite(x)) {
            return '';
        }

        return parseInt(x);
    }

    function isEmpty(value) {
        return (value == null || value == '' || value == 'undefined' ? 'N/A' : value);
    }

    function getCommissionAndGroupName(commissionID, commissionGroupID){

        var commissionNameObject = {};

        var commission_name = commissions.filter(function(elem) {
            return elem.id == commissionID;
        });

        var commission_group_name = commissionGroups.filter(function(elem) {
            return elem.id == commissionGroupID;
        });

        commissionNameObject = {
            commissionName     : commission_name.shift().name,
            commissionGroupName: commission_group_name.shift().name,
        }

        return commissionNameObject;
    }

    function getRate(supplierCurrency, bookingCurrency, rateType) {

        var object = currencyConvert.filter(function(elem) {
            return elem.from == supplierCurrency && elem.to == bookingCurrency
        });

        return (object.shift()[rateType]);
    }

    function getCommissionPercent(commissionID, commissionGroupID, brandID, holidayTypeID, currencyID, seasonID){

        var commissionPercentage = 0.00;
        var object = commissionCriteriaRates.filter(function(elem) {
            return elem.commission_id == commissionID && elem.commission_group_id == commissionGroupID && elem.brand_id == brandID && elem.holiday_type_id == holidayTypeID && elem.currency_id == currencyID && elem.season_id == seasonID
        });

        if(object.length > 0){
            commissionPercentage = object.shift().percentage;
        }

        return commissionPercentage;
    }

    function resetCommissionNameFeilds(){
        $('.badge-commission-name').text('');
        $('.badge-commission-group-name').text('');
        $('.badge-commission-percentage').text('');
    }

    function getCommissionRate(){

        var calculatedCommisionAmount = 0;
        var commissionPercentage      = 0;
        var agency                    = $("input[name=agency]:checked").val();
        var agencyCommissionType      = $("input[name=agency_commission_type]:checked").val();
        var netValue                  = $('.total-markup-amount').val();
        var commissionID              = $('.commission-id').val();
        var commissionGroupID         = $('.commission-group-id').val();
        var brandID                   = $('.brand-id').val();
        var holidayTypeID             = $('.holiday-type-id').val();
        var currencyID                = $('.booking-currency-id').val();
        var seasonID                  = $('.season-id').val();

        // console.log(totalNetPrice);
        // console.log(commissionID);
        // console.log(commissionGroupID);
        // console.log(brandID);
        // console.log(holidayTypeID);
        // console.log(seasonID);
        // console.log(currencyID);


        if(agency == 1 && agencyCommissionType == 'paid-net-of-commission' || agency == 1 && agencyCommissionType == 'we-pay-commission-on-departure'){
            netValue = $('.total-net-margin').val();
        }

        if (commissionID && commissionGroupID && brandID && holidayTypeID && currencyID && seasonID){

            commissionPercentage      = getCommissionPercent(commissionID, commissionGroupID, brandID, holidayTypeID, currencyID, seasonID);
            calculatedCommisionAmount = parseFloat(netValue / 100) * parseFloat(commissionPercentage);

            var commissionNames = getCommissionAndGroupName(commissionID, commissionGroupID);
            if(parseFloat(commissionPercentage) > 0.00){
                $('.badge-commission-name').text(commissionNames.commissionName);
                $('.badge-commission-group-name').text(commissionNames.commissionGroupName);
                $('.badge-commission-percentage').text(`${commissionPercentage} %`);
            }else{
                resetCommissionNameFeilds();
            }

        } else {
            calculatedCommisionAmount = 0.00;
            resetCommissionNameFeilds()
        }

        $('.commission-percentage').val(check(commissionPercentage));
        $('.commission-amount').val(check(calculatedCommisionAmount));
    }

    function getSellingPrice() {

        var sellingPriceOtherCurrency = $('.selling-price-other-currency').val();

        if (sellingPriceOtherCurrency) {

            var rateType                      = $('input[name="rate_type"]:checked').val();
            var bookingCurrency               = $(".booking-currency-id").find(':selected').data('code');
            var totalSellingPrice             = parseFloat($('.total-selling-price').val());
            var rate                          = getRate(bookingCurrency, sellingPriceOtherCurrency, rateType);
            var sellingPriceOtherCurrencyRate = parseFloat(totalSellingPrice) * parseFloat(rate);

            $('.selling-price-other-currency-rate').val(check(sellingPriceOtherCurrencyRate));
            $('.selling-price-other-currency-code').val(check(sellingPriceOtherCurrencyRate));
        }

        if (sellingPriceOtherCurrency == '') {
            $('.selling-price-other-currency-rate').val('0.00');
            $('.selling-price-other-currency-code').val('');
        }
    }

    $(document).on('change', '.rate-type', function() {

        var status = $(this).attr("data-status");

        if (status && status == 'booking') {
            getBookingRateTypeValues();

        } else {

            getQuoteRateTypeValues();
        }
    });

    /* Hide Potentail Commission for another Behalf User */
    $(document).on('change', '.sales-person-id', function() {

        var salesPersonID = $(this).val();
        var userID        = $('.user-id').val();

        if(salesPersonID != userID){
            $('#potential_commission_feild').addClass('d-none');
        }

        if(salesPersonID == userID){
            $('#potential_commission_feild').removeClass('d-none');
        }
    });

    /* Focus In/Out Function on Calculation Values */
    $(document).on('focus', '.remove-zero-values', function() {
        var value = parseFloat($(this).val()).toFixed(2);
        if(value == 0.00){
            $(this).val('');
        }
    });

    $(document).on('focusout', '.remove-zero-values', function() {
        var value = $(this).val();
        if(value == ''){
            $(this).val((parseFloat(0).toFixed(2)));
        }
    });
    /* End Focus In/Out Function on Calculation Values */

    /*
    |--------------------------------------------------------------------------
    | Quote Management Calculation Functions
    |--------------------------------------------------------------------------
    */

    function getBookingAmountPerPerson() {
        var paxNumber = parseFloat($(".pax-number").val());
        var totalSellingPriceInBookingCurrency = parseFloat($(".total-selling-price").val());
        var bookingAmountPerPerson = parseFloat(totalSellingPriceInBookingCurrency) / parseFloat(paxNumber);

        $('.booking-amount-per-person').val(check(bookingAmountPerPerson));
    }

    function getQuoteBookingCurrencyValues() {

        var rateType = $("input[name=rate_type]:checked").val();
        var estimatedCostArray = $(".estimated-cost").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var sellingPriceArray = $(".selling-price").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var markupAmountArray = $(".markup-amount").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
        var supplierCurrencyArray = $(".supplier-currency-id").map((i, e) => $(e).find(":selected").data("code")).get();
        var quoteSize = parseInt($('.quote').length);
        var calculatedEstimatedCostInBookingCurrency = 0;
        var calculatedSellingPriceInBookingCurrency = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;
        var key = 0;

        while (key < quoteSize) {

            var estimatedCost = estimatedCostArray[key];
            var supplierCurrency = supplierCurrencyArray[key];
            var sellingPrice = sellingPriceArray[key];
            var markupAmount = markupAmountArray[key];

            if (supplierCurrency && bookingCurrency) {

                var rate = getRate(supplierCurrency, bookingCurrency, rateType);
                calculatedEstimatedCostInBookingCurrency = parseFloat(estimatedCost) * parseFloat(rate);
                calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);
                calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);

            } else {

                calculatedSellingPriceInBookingCurrency = parseFloat(0.00);
                calculatedMarkupAmountInBookingCurrency = parseFloat(0.00);
            }

            $(`#quote_${key}_estimated_cost_in_booking_currency`).val(check(calculatedEstimatedCostInBookingCurrency));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
            key++;
        }
    }

    function onChangeAgencyCommissionType(){

        var agency               = $("input[name=agency]:checked").val();
        var agencyCommissionType = $("input[name=agency_commission_type]:checked").val();

        if(agency == 1 && agencyCommissionType == 'net-price'){
            $('.paid-net-commission-on-departure').addClass('d-none');
        }

        if(agency == 1 && agencyCommissionType == 'paid-net-of-commission' || agency == 1 && agencyCommissionType == 'we-pay-commission-on-departure'){
            $('.paid-net-commission-on-departure').removeClass('d-none');
        }
        
        getCalculatedTotalNetMarkup();
        getCommissionRate();
    }

    $(document).on('change, click', '.agency-commission-type', function() {
        onChangeAgencyCommissionType();
    });

    $(document).on('change', '.agency-commission', function() {
        getCalculatedTotalNetMarkup();
        getCommissionRate();
    });

    function getCalculatedTotalNetMarkup() {

        var agencyCommission     = $('.agency-commission').val();
        var agencyTotalMarkup    = $('.total-markup-amount').val();
        var totalAgencyNetMarkup = parseFloat(agencyTotalMarkup) - parseFloat(agencyCommission);

        $('.total-net-margin').val(check(totalAgencyNetMarkup));
    }

    function getQuoteTotalValues() {

        var markupType = $("input[name=markup_type]:checked").val();

        var estimatedCostInBookingCurrencyArray = $(".estimated-cost-in-booking-currency").map((i, e) => parseFloat(e.value)).get();
        var estimatedCostInBookingCurrency      = estimatedCostInBookingCurrencyArray.reduce((a, b) => (a + b), 0);

        $(".total-net-price").val(check(estimatedCostInBookingCurrency));

        if(markupType == 'itemised'){

            var sellingPriceInBookingCurrencyArray = $(".selling-price-in-booking-currency").map((i, e) => parseFloat(e.value)).get();
            var sellingPriceInBookingCurrency = sellingPriceInBookingCurrencyArray.reduce((a, b) => (a + b), 0);

            var markupAmountInBookingCurrencyArray = $(".markup-amount-in-booking-currency").map((i, e) => parseFloat(e.value)).get();
            var markupAmountInBookingCurrency = markupAmountInBookingCurrencyArray.reduce((a, b) => (a + b), 0);

            var markupPercentageArray = $(".markup-percentage").map((i, e) => parseFloat(e.value)).get();
            var markupPercentage = markupPercentageArray.reduce((a, b) => (a + b), 0);

            var profitPercentageArray = $(".profit-percentage").map((i, e) => parseFloat(e.value)).get();
            var profitPercentage = profitPercentageArray.reduce((a, b) => (a + b), 0);

            $(".total-selling-price").val(check(sellingPriceInBookingCurrency));
            $(".total-markup-amount").val(check(markupAmountInBookingCurrency));
            $(".total-markup-percent").val(check(markupPercentage));
            $(".total-profit-percentage").val(check(profitPercentage));

        }

        if(markupType == 'whole'){

            $(".total-markup-amount").val(parseFloat(0).toFixed(2));
            $(".total-markup-percent").val(parseFloat(0).toFixed(2));
            $(".total-profit-percentage").val(parseFloat(0).toFixed(2));
            $(".total-selling-price").val(check(estimatedCostInBookingCurrency));
        }

        onChangeAgencyCommissionType();

        getCommissionRate();
        getBookingAmountPerPerson();
        getSellingPrice();
    }

    function getQuoteDetailsValues(key, changeFeild) {

        var supplierCurrency = $(`#quote_${key}_supplier_currency_id`).find(':selected').data('code');
        var bookingCurrency  = $(".booking-currency-id").find(':selected').data('code');
        var rateType         = $("input[name=rate_type]:checked").val();
        var markupType       = $("input[name=markup_type]:checked").val();
        var estimatedCost    = parseFloat($(`#quote_${key}_estimated_cost`).val()).toFixed(2);
        var markupPercentage = parseFloat($(`#quote_${key}_markup_percentage`).val());
        var markupAmount     = parseFloat($(`#quote_${key}_markup_amount`).val());
        var rate             = getRate(supplierCurrency, bookingCurrency, rateType);
        var calculatedSellingPrice     = 0;
        var calculatedMarkupPercentage = 0;
        var calculatedMarkupAmount     = 0;
        var calculatedProfitPercentage = 0;
        var calculatedMarkupAmountInBookingCurrency  = 0;
        var calculatedEstimatedCostInBookingCurrency = 0;
        var calculatedSellingPriceInBookingCurrency  = 0;

        if (changeFeild == 'estimated_cost') {

            // calculatedProfitPercentage = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedEstimatedCostInBookingCurrency = parseFloat(estimatedCost) * parseFloat(rate);
            $(`#quote_${key}_estimated_cost_in_booking_currency`).val(check(calculatedEstimatedCostInBookingCurrency));

            if(markupType == 'itemised'){

                calculatedMarkupPercentage = parseFloat(markupAmount) / parseFloat(estimatedCost / 100);
                calculatedSellingPrice = parseFloat(markupAmount) + parseFloat(estimatedCost);
                calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);

                $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
                $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
                $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));

            }

        }

        if (changeFeild == 'markup_amount') {

            calculatedSellingPrice = parseFloat(markupAmount) + parseFloat(estimatedCost);
            calculatedMarkupPercentage = parseFloat(markupAmount) / parseFloat(estimatedCost / 100);
            calculatedProfitPercentage = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * rate;
            calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);

            $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
            $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
            $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        }

        if (changeFeild == 'markup_percentage') {

            calculatedMarkupAmount = (parseFloat(estimatedCost) / 100) * parseFloat(markupPercentage);
            calculatedSellingPrice = parseFloat(calculatedMarkupAmount) + parseFloat(estimatedCost);
            calculatedProfitPercentage = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedMarkupAmountInBookingCurrency = parseFloat(calculatedMarkupAmount) * parseFloat(rate);
            calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);

            $(`#quote_${key}_markup_amount`).val(check(calculatedMarkupAmount));
            $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
            $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        }

        getQuoteTotalValues();
    }

    function getQuoteRateTypeValues() {

        var rateType = $("input[name=rate_type]:checked").val();
        var estimatedCostArray = $(".estimated-cost").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var sellingPriceArray = $(".selling-price").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var markupAmountArray = $(".markup-amount").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
        var supplierCurrencyArray = $(".supplier-currency-id").map((i, e) => $(e).find(":selected").data("code")).get();
        var quoteSize = parseInt($('.quote').length);
        var calculatedEstimatedCostInBookingCurrency = 0
        var calculatedSellingPriceInBookingCurrency = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;
        var key = 0;

        while (key < quoteSize) {

            var estimatedCost = estimatedCostArray[key];
            var supplierCurrency = supplierCurrencyArray[key];
            var sellingPrice = sellingPriceArray[key];
            var markupAmount = markupAmountArray[key];

            if (supplierCurrency && bookingCurrency) {

                var rate = getRate(supplierCurrency, bookingCurrency, rateType);
                calculatedEstimatedCostInBookingCurrency = parseFloat(estimatedCost) * parseFloat(rate);
                calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);
                calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);

            } else {

                calculatedSellingPriceInBookingCurrency = parseFloat(0.00);
                calculatedMarkupAmountInBookingCurrency = parseFloat(0.00);
            }

            $(`#quote_${key}_estimated_cost_in_booking_currency`).val(check(calculatedEstimatedCostInBookingCurrency));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
            key++;
        }

        getQuoteTotalValues();
    }

    function getQuoteSupplierCurrencyValues(supplierCurrency, key) {

        var rateType        = $("input[name=rate_type]:checked").val();
        var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
        var estimatedCost   = parseFloat($(`#quote_${key}_estimated_cost`).val()).toFixed(2);
        var markupAmount    = parseFloat($(`#quote_${key}_markup_amount`).val()).toFixed(2);
        var sellingPrice    = parseFloat($(`#quote_${key}_selling_price`).val()).toFixed(2);
        var rate            = getRate(supplierCurrency, bookingCurrency, rateType);
        var calculatedEstimatedCostInBookingCurrency = 0;
        var calculatedMarkupAmountInBookingCurrency  = 0;
        var calculatedSellingPriceInBookingCurrency  = 0;

        calculatedEstimatedCostInBookingCurrency = parseFloat(estimatedCost) * parseFloat(rate);
        calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);
        calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);

        $(`#quote_${key}_estimated_cost_in_booking_currency`).val(check(calculatedEstimatedCostInBookingCurrency));
        $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
        $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
    }

    /*
    |--------------------------------------------------------------------------
    | End Quote Management
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Booking Management Calculation Functions
    |--------------------------------------------------------------------------
    */

    function getBookingTotalValues() {

        var markupType                       = $("input[name=markup_type]:checked").val();
        var actualCostInBookingCurrencyArray = $(".actual-cost-in-booking-currency").map((i, e) => parseFloat(e.value)).get();
        var actualCostInBookingCurrency      = actualCostInBookingCurrencyArray.reduce((a, b) => (a + b), 0);
        $(".total-net-price").val(check(actualCostInBookingCurrency));

        if(markupType == 'itemised'){
            var sellingPriceInBookingCurrencyArray = $(".selling-price-in-booking-currency").map((i, e) => parseFloat(e.value)).get();
            var sellingPriceInBookingCurrency      = sellingPriceInBookingCurrencyArray.reduce((a, b) => (a + b), 0);

            var markupAmountInBookingCurrencyArray = $(".markup-amount-in-booking-currency").map((i, e) => parseFloat(e.value)).get();
            var markupAmountInBookingCurrency      = markupAmountInBookingCurrencyArray.reduce((a, b) => (a + b), 0);

            var markupPercentageArray = $(".markup-percentage").map((i, e) => parseFloat(e.value)).get();
            var markupPercentage      = markupPercentageArray.reduce((a, b) => (a + b), 0);

            var profitPercentageArray = $(".profit-percentage").map((i, e) => parseFloat(e.value)).get();
            var profitPercentage      = profitPercentageArray.reduce((a, b) => (a + b), 0);
            
            $(".total-selling-price").val(check(sellingPriceInBookingCurrency));
            $(".total-markup-amount").val(check(markupAmountInBookingCurrency));
            $(".total-markup-percent").val(check(markupPercentage));
            $(".total-profit-percentage").val(check(profitPercentage));
        }

        if(markupType == 'whole'){

            $(".total-markup-amount").val(parseFloat(0).toFixed(2));
            $(".total-markup-percent").val(parseFloat(0).toFixed(2));
            $(".total-profit-percentage").val(parseFloat(0).toFixed(2));
            $(".total-selling-price").val(check(actualCostInBookingCurrency));
        }

        onChangeAgencyCommissionType();
        getCommissionRate();
        getBookingAmountPerPerson();
        getSellingPrice();
    }

    function getBookingRateTypeValues() {

        var rateType          = $("input[name=rate_type]:checked").val();
        var actualCostArray   = $(".actual-cost").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var sellingPriceArray = $(".selling-price").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var markupAmountArray = $(".markup-amount").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var bookingCurrency   = $(".booking-currency-id").find(":selected").data("code");
        var supplierCurrencyArray = $(".booking-supplier-currency-id").map((i, e) => $(e).find(":selected").data("code")).get();
        var quoteSize             = parseInt($('.quote').length);
        var calculatedActualCostInBookingCurrency   = 0
        var calculatedSellingPriceInBookingCurrency = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;
        var key = 0;

        while (key < quoteSize) {

            var actualCost       = actualCostArray[key];
            var supplierCurrency = supplierCurrencyArray[key];
            var sellingPrice     = sellingPriceArray[key];
            var markupAmount     = markupAmountArray[key];

            // console.log( supplierCurrency);

            if (supplierCurrency && bookingCurrency) {

                var rate = getRate(supplierCurrency, bookingCurrency, rateType);
                calculatedActualCostInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);
                calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);
                calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);

            } else {

                calculatedSellingPriceInBookingCurrency = parseFloat(0.00);
                calculatedMarkupAmountInBookingCurrency = parseFloat(0.00);
            }

            $(`#quote_${key}_actual_cost_in_booking_currency`).val(check(calculatedActualCostInBookingCurrency));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
            key++;
        }

        getBookingTotalValues();
    }

    function getBookingSupplierCurrencyValues(supplierCurrency, key) {

        var rateType        = $("input[name=rate_type]:checked").val();
        var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
        var actualCost      = parseFloat($(`#quote_${key}_actual_cost`).val()).toFixed(2);
        var markupAmount    = parseFloat($(`#quote_${key}_markup_amount`).val()).toFixed(2);
        var sellingPrice    = parseFloat($(`#quote_${key}_selling_price`).val()).toFixed(2);
        var rate            = getRate(supplierCurrency, bookingCurrency, rateType);
        var calculatedActualCostInBookingCurrency   = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;
        var calculatedSellingPriceInBookingCurrency = 0;

        calculatedActualCostInBookingCurrency   = parseFloat(actualCost) * parseFloat(rate);
        calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);
        calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);

        $(`#quote_${key}_actual_cost_in_booking_currency`).val(check(calculatedActualCostInBookingCurrency));
        $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
        $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
    }

    function getBookingDetailValues(key) {

        var supplierCurrency = $(`#quote_${key}_supplier_currency_id`).find(':selected').data('code');
        var bookingCurrency  = $(".booking-currency-id").find(':selected').data('code');
        var rateType         = $('input[name="rate_type"]:checked').val();
        var actualCost       = parseFloat($(`#quote_${key}_actual_cost`).val()).toFixed(2);
        var sellingPrice     = parseFloat($(`#quote_${key}_selling_price`).val()).toFixed(2);
        var rate             = getRate(supplierCurrency, bookingCurrency, rateType);

        var calculatedMarkupAmount     = 0;
        var calculatedMarkupPercentage = 0;
        var calculatedProfitPercentage = 0;
        var calculatedActualCostInBookingCurrency   = 0;
        var calculatedSellingPriceInBookingCurrency = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;

        calculatedMarkupAmount     = parseFloat(sellingPrice) - parseFloat(actualCost);
        calculatedMarkupPercentage = parseFloat(calculatedMarkupAmount) / parseFloat(actualCost / 100);
        calculatedProfitPercentage = ((parseFloat(sellingPrice) - parseFloat(actualCost)) / parseFloat(sellingPrice)) * 100;
        calculatedActualCostInBookingCurrency   = parseFloat(actualCost) * parseFloat(rate);
        calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);
        calculatedMarkupAmountInBookingCurrency = parseFloat(calculatedMarkupAmount) * parseFloat(rate);

        $(`#quote_${key}_markup_amount`).val(check(calculatedMarkupAmount));
        $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
        $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
        $(`#quote_${key}_actual_cost_in_booking_currency`).val(check(calculatedActualCostInBookingCurrency));
        $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));

        getBookingTotalValues();
    }

    function getQuoteDetailValuesForBooking(key, changeFeild) {

        var supplierCurrency = $(`#quote_${key}_supplier_currency_id`).find(':selected').data('code');
        var bookingCurrency  = $(".booking-currency-id").find(':selected').data('code');
        var rateType         = $('input[name="rate_type"]:checked').val();
        var actualCost       = parseFloat($(`#quote_${key}_actual_cost`).val()).toFixed(2);
        var markupPercentage = parseFloat($(`#quote_${key}_markup_percentage`).val());
        var markupAmount     = parseFloat($(`#quote_${key}_markup_amount`).val());
        var rate             = getRate(supplierCurrency, bookingCurrency, rateType);
        var calculatedSellingPrice     = 0;
        var calculatedMarkupPercentage = 0;
        var calculatedMarkupAmount     = 0;
        var calculatedProfitPercentage = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;
        var calculatedActualCostInBookingCurrency   = 0;
        var calculatedSellingPriceInBookingCurrency = 0;

        if (changeFeild == 'actual_cost') {

            calculatedSellingPrice = parseFloat(markupAmount) + parseFloat(actualCost);
            calculatedMarkupPercentage = parseFloat(markupAmount) / parseFloat(actualCost / 100);
            calculatedProfitPercentage = ((parseFloat(calculatedSellingPrice) - parseFloat(actualCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
            calculatedActualCostInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);

            $(`#quote_${key}_actual_cost_in_booking_currency`).val(check(calculatedActualCostInBookingCurrency));
            $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
            $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        }

        if (changeFeild == 'markup_amount') {

            calculatedSellingPrice = parseFloat(markupAmount) + parseFloat(actualCost);
            calculatedMarkupPercentage = parseFloat(markupAmount) / parseFloat(actualCost / 100);
            calculatedProfitPercentage = ((parseFloat(calculatedSellingPrice) - parseFloat(actualCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * rate;
            calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);

            $(`#quote_${key}_markup_percentage`).val(check(calculatedMarkupPercentage));
            $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
            $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        }

        if (changeFeild == 'markup_percentage') {

            calculatedMarkupAmount = (parseFloat(actualCost) / 100) * parseFloat(markupPercentage);
            calculatedSellingPrice = parseFloat(calculatedMarkupAmount) + parseFloat(actualCost);
            calculatedProfitPercentage = ((parseFloat(calculatedSellingPrice) - parseFloat(actualCost)) / parseFloat(calculatedSellingPrice)) * 100;
            calculatedMarkupAmountInBookingCurrency = parseFloat(calculatedMarkupAmount) * parseFloat(rate);
            calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);

            $(`#quote_${key}_markup_amount`).val(check(calculatedMarkupAmount));
            $(`#quote_${key}_selling_price`).val(check(calculatedSellingPrice));
            $(`#quote_${key}_profit_percentage`).val(check(calculatedProfitPercentage));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
        }

        getBookingTotalValues();
    }

    function getBookingBookingCurrencyValues() {

        var rateType = $("input[name=rate_type]:checked").val();
        var actualCostArray = $(".actual-cost").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var sellingPriceArray = $(".selling-price").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var markupAmountArray = $(".markup-amount").map((i, e) => parseFloat(e.value).toFixed(2)).get();
        var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
        var supplierCurrencyArray = $(".booking-supplier-currency-id").map((i, e) => $(e).find(":selected").data("code")).get();
        var quoteSize = parseInt($(".quote").length);
        var calculatedActualCostInBookingCurrency = 0;
        var calculatedSellingPriceInBookingCurrency = 0;
        var calculatedMarkupAmountInBookingCurrency = 0;
        var key = 0;

        while (key < quoteSize) {

            var actualCost = actualCostArray[key];
            var supplierCurrency = supplierCurrencyArray[key];
            var sellingPrice = sellingPriceArray[key];
            var markupAmount = markupAmountArray[key];

            if (supplierCurrency && bookingCurrency) {

                var rate = getRate(supplierCurrency, bookingCurrency, rateType);
                calculatedActualCostInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);
                calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);
                calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);

            } else {

                calculatedSellingPriceInBookingCurrency = parseFloat(0.00);
                calculatedMarkupAmountInBookingCurrency = parseFloat(0.00);
            }

            $(`#quote_${key}_actual_cost_in_booking_currency`).val(check(calculatedActualCostInBookingCurrency));
            $(`#quote_${key}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
            $(`#quote_${key}_markup_amount_in_booking_currency`).val(check(calculatedMarkupAmountInBookingCurrency));
            key++;
        }
    }

    $(document).on('change', '.booking-supplier-currency-id', function() {

        var code = $(this).find(":selected").data("code");
        var quote = $(this).closest(".quote");
        var quoteKey = quote.data("key");
        var currency_name = $(this).find(':selected').attr('data-name');
        var supplierCurrency = $(this).val();
        var bookingCurrency  = $('#currency_id').val();

        if(typeof supplierCurrency === 'undefined' || supplierCurrency == "") {
            quote.find("[class*=supplier-currency-code]").html("");
            quote.find('.badge-supplier-currency-id').html("");
            return;
        }

        if (typeof bookingCurrency === 'undefined' || bookingCurrency == "") {
            alert("Please Select Booking Currency first");
            return;
        }

        quote.find("[class*=supplier-currency-code]").html(code);
        quote.find('.badge-supplier-currency-id').html(currency_name);

        getBookingSupplierCurrencyValues(code, quoteKey);
        getBookingTotalValues();
    });

    $(document).on('change', '.payment-method', function() {

        var payment_method = $(this).val();
        var supplier_id = $(this).closest('.quote').find('.supplier-id').val();
        var current_payment_methods = $(this);

        var quoteKey = $(this).closest('.quote').data('key');
        var financeKey = $(this).closest('.finance-clonning').data('financekey');

        var estimatedCost = parseFloat($(this).closest('.quote').find('.estimated-cost').val()).toFixed(2);
        var totalDepositAmountArray = $(this).closest('.finance').find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
        var totalDepositAmount = totalDepositAmountArray.reduce((a, b) => (a + b), 0);
        var outstanding_amount_left = parseFloat($(this).closest('.quote').find('.outstanding_amount_left').val());

        var wa = 0;
        var outstandingAmountLeft = estimatedCost - totalDepositAmount;
        var currentDepositAmount = $(`#quote_${quoteKey}_finance_${financeKey}_deposit_amount`).val();


        if (supplier_id != null && payment_method == 3) {

            $.ajax({
                headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                url: REDIRECT_BASEURL + 'wallets/get-supplier-wallet-amount/' + supplier_id,
                type: 'get',
                success: function(data) {

                    if (data.response == true) {
                        wa = parseFloat(data.message);

                        if (currentDepositAmount > wa) {
                            alert("Please Enter Correct Wallet Amount");


                            $(`#quote_${quoteKey}_finance_${financeKey}_deposit_amount`).val('0.00');
                            $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val('');
                        } else {
                            $(`#quote_${quoteKey}_outstanding_amount_left`).val((outstandingAmountLeft.toFixed(2)));
                            $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val((outstandingAmountLeft.toFixed(2)));
                        }

                    }
                },
                error: function(reject) {

                    if (reject.status === 422) {
                        var errors = $.parseJSON(reject.responseText);
                        alert(errors.message);
                        $(current_payment_methods).val('').trigger('change');
                    }
                },
            });

        } else {
            $(`#quote_${quoteKey}_outstanding_amount_left`).val((outstandingAmountLeft.toFixed(2)));
            $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val((outstandingAmountLeft.toFixed(2)));
        }
    });

    $(document).on('change', '.deposit-amount', function() {

        var quoteKey = $(this).closest('.quote').data('key');
        var financeKey = $(this).closest('.finance-clonning').data('financekey');
        var closestFinance = $(this).closest('.finance');
        var depositAmount = parseFloat($(this).val()).toFixed(2);
        var estimated_cost = parseFloat($(`#quote_${quoteKey}_estimated_cost`).val()).toFixed(2);
        var payment_method = $(`#quote_${quoteKey}_finance_${financeKey}_payment_method`).val();
        var supplier_id = $(`#quote_${quoteKey}_supplier_id`).val();
        var totalDepositAmountArray = closestFinance.find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
        var totalDepositAmount = totalDepositAmountArray.reduce((a, b) => (a + b), 0);
        var outstandingAmountLeft = estimated_cost - totalDepositAmount;
        var walletAmount = 0;

        if (payment_method && payment_method == 3) {

            $.ajax({
                headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                url: REDIRECT_BASEURL + 'wallets/get-supplier-wallet-amount/' + supplier_id,
                type: 'get',
                success: function(data) {

                    if (data.response == true) {
                        walletAmount = parseFloat(data.message);

                        if (depositAmount > walletAmount) {
                            alert("Please Enter Correct Wallet Amount");
                            $(`#quote_${quoteKey}_finance_${financeKey}_deposit_amount`).val('0.00');
                            $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val('');
                        } else {

                            if (outstandingAmountLeft < 0) {
                                alert("Please Enter Correct Amount");
                                $(`#quote_${quoteKey}_finance_${financeKey}_deposit_amount`).val('0.00');
                                $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val('');
                            } else {

                                $(`#quote_${quoteKey}_outstanding_amount_left`).val(outstandingAmountLeft.toFixed(2));
                                $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val(outstandingAmountLeft.toFixed(2));
                            }
                        }
                    }
                },
                error: function(reject) {}
            });
        } else {

            if (outstandingAmountLeft >= 0 && payment_method != '') {

                $(`#quote_${quoteKey}_outstanding_amount_left`).val(outstandingAmountLeft.toFixed(2));
                $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val(outstandingAmountLeft.toFixed(2));

            } else if (outstandingAmountLeft < 0 && payment_method != 3) {
                alert("Please Enter Correct Deposit Amount");
                $(`#quote_${quoteKey}_finance_${financeKey}_deposit_amount`).val('0.00');
                $(`#quote_${quoteKey}_finance_${financeKey}_outstanding_amount`).val('');
            }

        }

    });

    function getActualCost(quote) {

        var totalDepositAmountArray = quote.find('.deposit-amount').map((i, e) => parseFloat(e.value)).get();
        var totalDepositAmount = totalDepositAmountArray.reduce((a, b) => (a + b), 0);
        var amountArray = quote.find('.amount').map((i, e) => parseFloat(e.value)).get();
        var amountTotalArray = amountArray.filter(function(value) { return !Number.isNaN(value); });
        var totalAmount = amountTotalArray.reduce((a, b) => (a + b), 0);
        var actualCost = totalDepositAmount - totalAmount;

        return actualCost;
    }

    function getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey) {

        var supplierCurrency = $(`#quote_${quoteKey}_supplier_currency_id`).find(":selected").data("code");
        var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
        var rateType = $("input[name=rate_type]:checked").val();
        var rate = getRate(supplierCurrency, bookingCurrency, rateType);

        var calculatedActualCostInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);
        var calculatedSellingPriceInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);

        $(`#quote_${quoteKey}_actual_cost_in_booking_currency`).val(check(calculatedActualCostInBookingCurrency));
        $(`#quote_${quoteKey}_selling_price_in_booking_currency`).val(check(calculatedSellingPriceInBookingCurrency));
    }

    $(document).on('change', '.refund_amount', function() {

        var quote = $(this).closest('.quote');
        var quoteKey = $(this).closest('.quote').data('key');
        var actualCost = parseFloat(getActualCost(quote));


        if (actualCost < 0) {
            alert("Please Enter Correct Amount");
            $(this).val('0.00');
        } else {

            $(`#quote_${quoteKey}_actual_cost`).val(check(actualCost));
            $(`#quote_${quoteKey}_markup_amount`).val('0.00');
            $(`#quote_${quoteKey}_markup_amount_in_booking_currency`).val('0.00');
            $(`#quote_${quoteKey}_markup_percentage`).val('0.00');
            $(`#quote_${quoteKey}_profit_percentage`).val('0.00');
            $(`#quote_${quoteKey}_selling_price`).val(check(actualCost));

            getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey)

            getBookingTotalValues();
        }

    });

    $(document).on('change', '.credit-note-amount', function() {

        var quote = $(this).closest('.quote');
        var quoteKey = $(this).closest('.quote').data('key');
        var actualCost = parseFloat(getActualCost(quote));


        if (actualCost < 0) {
            alert("Please Enter Correct Paid Amount");
            $(this).val('0.00');
        } else {

            $(`#quote_${quoteKey}_actual_cost`).val(check(actualCost));
            $(`#quote_${quoteKey}_markup_amount`).val('0.00');
            $(`#quote_${quoteKey}_markup_amount_in_booking_currency`).val('0.00');
            $(`#quote_${quoteKey}_markup_percentage`).val('0.00');
            $(`#quote_${quoteKey}_profit_percentage`).val('0.00');
            $(`#quote_${quoteKey}_selling_price`).val(check(actualCost));

            getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey)

            getBookingTotalValues();
        }

    });

    $(document).on('click', '.refund-to-bank', function() {

        if ($('.select2single').data('select2')) {
            $('.select2single').select2('destroy');
        }

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');
        var refundPaymentRowLength = quote.find(".refund-payment-row:not(:hidden)").length;

        if (parseInt(refundPaymentRowLength) == 0) {

            if (confirm("Are you sure you want Refund Payment? Actual Cost, Markup Amount, Selling Price, Profit% will be override.") == true) {
                quote.find('.refund-payment-section').attr("hidden", false);
            }
        } else {

            quote.find('.refund-payment-row').first().clone().find("input").val("").each(function() {

                    let n = 1;
                    let name = $(this).attr("data-name");

                    this.name = this.name.replace(/]\[(\d+)]/g, function() {
                        return `][${refundPaymentRowLength}]`;
                    });

                    this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? refundPaymentRowLength : v, function() {
                        return `quote_${quoteKey}_finance_${refundPaymentRowLength}_${name}`;
                    });

                }).end()
                .find('.refund-payment-label').each(function() {

                    this.id = `refund_payment_label_${refundPaymentRowLength}`;
                    $(this).text(`Refund Payment #${refundPaymentRowLength+1}`);

                }).end()
                .find("select").val("").each(function() {

                    let n = 1;
                    let name = $(this).attr("data-name");

                    this.name = this.name.replace(/]\[(\d+)]/g, function() {
                        return `][${refundPaymentRowLength}]`;
                    });

                    this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? refundPaymentRowLength : v, function() {
                        return `quote_${quoteKey}_finance_${refundPaymentRowLength}_${name}`;
                    });

                }).end()
                .find('.select2single').select2({
                    width: '100%',
                    theme: "bootstrap",
                }).end()
                .show()
                .insertAfter(quote.find('.refund-payment-row:last'));

            quote.find('.refund-payment-row:last .checkbox').prop('checked', false);
            quote.find('.refund-payment-row:last :input, select').removeAttr('readonly disabled');
            quote.find('.refund-payment-row:last .refund_amount').val('');
            quote.find('.refund-payment-row:last .refund-payment-hidden-btn').removeClass('d-none');
        }

        reinitializedDynamicFeilds();
    });

    $(document).on('click', '.credit-note', function() {

        if ($('.select2single').data('select2')) {
            $('.select2single').select2('destroy');
        }

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');
        var creditNoteRowLength = quote.find(".credit-note-row:not(:hidden)").length;

        // console.log(creditNoteRowLength);

        if (parseInt(creditNoteRowLength) == 0) {
            if (confirm("Are you sure you want Credit Note? Actual Cost, Markup Amount, Selling Price, Profit% will be override.") == true) {
                quote.find('.credit-note-section').attr("hidden", false);
            }

        } else {

            quote.find('.credit-note-row').first().clone().find("input").val("").each(function() {

                    let n = 1;
                    let name = $(this).attr("data-name");

                    this.name = this.name.replace(/]\[(\d+)]/g, function() {
                        return `][${creditNoteRowLength}]`;
                    });

                    this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? creditNoteRowLength : v, function() {
                        return `quote_${quoteKey}_finance_${creditNoteRowLength}_${name}`;
                    });

                }).end()
                .find('.credit_note_label').each(function() {

                    this.id = `credit_note_label_${creditNoteRowLength}`;
                    $(this).text(`Credit Note Amount Payment #${creditNoteRowLength+1}`);

                }).end()
                .find("select").val("").each(function() {

                    let n = 1;
                    let name = $(this).attr("data-name");

                    this.name = this.name.replace(/]\[(\d+)]/g, function() {
                        return `][${creditNoteRowLength}]`;
                    });

                    this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? creditNoteRowLength : v, function() {
                        return `quote_${quoteKey}_finance_${creditNoteRowLength}_${name}`;
                    });

                }).end()
                .find('.select2single').select2({
                    width: '100%',
                    theme: "bootstrap",
                }).end()
                .show()
                .insertAfter(quote.find(".credit-note-row:last"));

            // quote.find('.refund-payment-row:last :input, select').removeAttr('readonly disabled');
            // quote.find('.refund-payment-row:last .refund_amount').val('');
            quote.find('.credit-note-row:last .credit-note-hidden-btn').removeClass('d-none');
        }

        reinitializedDynamicFeilds();

    });

    $(document).on('click', '.refund-payment-hidden-btn', function() {

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');
        var refundPaymentRowLength = quote.find(".refund-payment-row:not(:hidden)").length;

        if (parseInt(refundPaymentRowLength) == 1) {
            quote.find('.refund-payment-section').attr("hidden", true);
            quote.find('.refund-payment-section .refund_amount').val("");
        } else {
            $(this).closest('.refund-payment-row').remove();
        }

        var actualCost = parseFloat(getActualCost(quote));
        $(`#quote_${quoteKey}_actual_cost`).val(check(actualCost));

        getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey)
        getBookingTotalValues();
    });

    $(document).on('click', '.credit-note-hidden-btn', function() {

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');
        var creditNoteRowLength = quote.find(".credit-note-row:not(:hidden)").length;

        if (parseInt(creditNoteRowLength) == 1) {
            quote.find('.credit-note-section').attr("hidden", true);
            quote.find('.credit-note-section .credit-note-amount').val("");
        } else {
            $(this).closest('.credit-note-row').remove();
        }

        var actualCost = parseFloat(getActualCost(quote));
        $(`#quote_${quoteKey}_actual_cost`).val(check(actualCost));

        getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey)
        getBookingTotalValues();
    });

    /*
    |--------------------------------------------------------------------------
    | End Booking Management
    |--------------------------------------------------------------------------
    */

    $("#generate-pdf").submit(function(event) {
        event.preventDefault();
        var $form = $(this),
            url = $form.attr('action');
        var editor = $('#editor').html();
        var formData = $(this).serializeArray();
        formData.push({ name: 'data', value: editor });
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(data) {
                // console.log(data, 'data');
            },
            error: function(reject) {

                if (reject.status === 422) {

                    var errors = $.parseJSON(reject.responseText);

                    setTimeout(function() {
                        $("#overlay").removeClass('overlay').html('');

                        if (errors.hasOwnProperty("overrride_errors")) {
                            alert(errors.overrride_errors);
                            window.location.href = REDIRECT_BASEURL + "quotes/index";
                        } else {

                            jQuery.each(errors.errors, function(index, value) {

                                index = index.replace(/\./g, '_');
                                $('#' + index).addClass('is-invalid');
                                $('#' + index).closest('.form-group').find('.text-danger').html(value);
                            });
                        }

                    }, 400);
                }
            },
        });
    });

    $(document).on('click', '.view-rates', function() {
        jQuery('#view_rates_modal').modal('show');
    });

    $(document).on('change', '.end-date-of-service', function() {

        var quote    = $(this).closest('.quote');
        var quoteKey = quote.data('key');

        var DateOFService    = $(`#quote_${quoteKey}_date_of_service`).val();
        var EndDateOFService = $(`#quote_${quoteKey}_end_date_of_service`).val();
        var nowDate          = todayDate();

        var category_enddateofservice = $(`#quote_${quoteKey}_category_id`).find(':selected').attr('data-enddateofservice');

        if(convertDate(EndDateOFService) < convertDate(nowDate)){
            alert('Please select valid Date, The date you select is already Passed.');
            $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setDate", '');
            $(`#quote_${quoteKey}_number_of_nights`).val('');
        }
        if((convertDate(EndDateOFService) < convertDate(DateOFService)) && category_enddateofservice != 1){
    
            alert('Please select Valid Date\nEnd Date of Service should be equal or greater than Start Date of Service.');
            $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setDate", '');
            $(`#quote_${quoteKey}_number_of_nights`).val('');
        } else {

            var number = convertDate(EndDateOFService) - convertDate(DateOFService);
            var days   = Math.ceil(number / (1000 * 3600 * 24));

            $(`#quote_${quoteKey}_number_of_nights`).val(checkForInt(days));
        }

    });

    $(document).on('change', '.date-of-service', function() {

        var quote    = $(this).closest('.quote');
        var quoteKey = quote.data('key');

        var DateOFService    = $(`#quote_${quoteKey}_date_of_service`).val();
        var EndDateOFService = $(`#quote_${quoteKey}_end_date_of_service`).val();
        var nowDate          = todayDate();

        var category_enddateofservice = $(`#quote_${quoteKey}_category_id`).find(':selected').attr('data-enddateofservice');

        if(convertDate(DateOFService) < convertDate(nowDate)){
            alert('Please select valid Date, The date you select is already Passed.');
            $(`#quote_${quoteKey}_date_of_service`).datepicker("setDate", '');
            $(`#quote_${quoteKey}_number_of_nights`).val('');
        }

        if(category_enddateofservice == 1){
            $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setDate", DateOFService);
            EndDateOFService = $(`#quote_${quoteKey}_end_date_of_service`).val();
        }

        if((convertDate(EndDateOFService) < convertDate(DateOFService)) && category_enddateofservice != 1){
            alert('Please select Valid Date\nEnd Date of Service should be equal or greater than Start Date of Service.');
            $(`#quote_${quoteKey}_date_of_service`).datepicker("setDate", '');
            $(`#quote_${quoteKey}_number_of_nights`).val('')
        } else {

            var number = convertDate(EndDateOFService) - convertDate(DateOFService);
            var days   = Math.ceil(number / (1000 * 3600 * 24));

            $(`#quote_${quoteKey}_number_of_nights`).val(checkForInt(days));
        }

    });

    $(document).on('change', '.getBrandtoHoliday', function() {
        let brand_id = $(this).val();
        var options = '';
        var url = BASEURL + 'brand/to/holidays'
        $.ajax({
            type: 'get',
            url: url,
            data: { 'brand_id': brand_id },
            success: function(response) {
                options += '<option value="">Select Type Of Holiday</option>';
                $.each(response, function(key, value) {
                    options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} </option>`;
                });
                $('.appendHolidayType').html(options);
            }
        });

        getCommissionRate();
    });

    $(document).on('change', '.getMultipleBrandtoHoliday', function() {

        let brand_ids = $(this).val();
        var options = '';
        var url = BASEURL + 'multiple/brand/to/holidays'
        
        $.ajax({
            type: 'get',
            url: url,
            data: { 'brand_ids': brand_ids },
            beforeSend: function() {
                $('.appendMultipleHolidayType').html(options);
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} (${value.brand_name}) </option>`;
                });

                $('.appendMultipleHolidayType').html(options);
            }
        });
 
    });

    // $(document).on('change', '.getCountryToTown', function() {
    //     let country_id = $(this).val();
    //     var options    = '';

    //     var url = BASEURL + 'country/to/town'
    //     $.ajax({
    //         type: 'get',
    //         url: url,
    //         data: { 'country_id': country_id },
    //         success: function(response) {
    //             options += '<option value="">Select Town</option>';
    //             $.each(response, function(key, value) {
    //                 options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} </option>`;
    //             });

    //             $('.appendCountryTown').html(options);
    //         }
    //     });
    
    // });

    $(document).on('change', '.getCountryToLocation', function() {
        
        var country_ids = $(this).val();
        var url         = BASEURL + 'country/to/location';
        var options     = '';

        $.ajax({
            type: 'get',
            url: url,
            data: { 'country_ids': country_ids },
            beforeSend: function() {
                $('.appendCountryLocation').html(options);
            },
            success: function(response) {

                $.each(response, function(key, value) {
                    options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} (${value.country_name}) </option>`;
                });

                $('.appendCountryLocation').html(options);
            }
        });
    
    });

    $(document).on('change', '.holiday-type-id', function() {
        getCommissionRate();
    });

    $('.season-id').on('change', function() {
        getCommissionRate();
        // $('.datepicker').datepicker("setDate", '');
        // datepickerReset();
    });

            $(document).on('change', '.select-agency', function() {
                var agency_ = $('.agencyField');
                var passenger_ = $('.PassengerField');
                if (($(this).val() == 1)) {
                    $('#pax_no').val(1).change();
                    $("input[name=agency_commission_type][value=net-price]").prop('checked', true);
                    agency_.removeClass('d-none');
                    passenger_.addClass('d-none');
                    agency_.find('input, select').removeAttr('disabled');
                    passenger_.find('input, select').attr('disabled', 'disabled');
                    // $('#agency_contact').addClass('phone phone0');
                    // $('#lead_passenger_contact').removeClass('phone');
                    // $('#lead_passenger_contact').removeClass('phone0');
                    var iti = intlTelInput(document.querySelector('#lead_passenger_contact'), {
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
                    });
                    iti.destroy();
                    // intTelinput('gc');
                } else {
                    $('#pax_no').val(1).change();
                    $('.paid-net-commission-on-departure').addClass('d-none');
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
                    agency_.find('input, select').attr('disabled', 'disabled');
                    // intTelinput(0);
                }

                getCommissionRate();
            });

            $(document).on('click', '.expand-all-btn', function(event) {
                $('#parent .quote').removeClass('collapsed-card');
                $('#parent .card-body').css("display", "block");
                $('#parent .collapse-expand-btn').html(`<i class="fas fa-minus"></i>`);
                // $(this).addClass('d-none');
                // $('.collapse-all-btn').removeClass('d-none');
            });

            $(document).on('click', '.collapse-all-btn', function(event) {
                $('#parent .quote').addClass('collapsed-card');
                $('#parent .card-body').css("display", "none");
                $('#parent .collapse-expand-btn').html(`<i class="fas fa-plus"></i>`);
                // $(this).addClass('d-none');
                // $('.expand-all-btn').removeClass('d-none');
            });





            $(document).on('click', '.compare-expand-all-btn', function(event) {
                $('#compare_parent .card').removeClass('collapsed-card');
                $('#compare_parent .card-body').css("display", "block");
                $('#compare_parent .compare-collapse-expand-btn').html(`<i class="fas fa-minus"></i>`);
            });

            $(document).on('click', '.compare-collapse-all-btn', function(event) {

                $('#compare_parent .card').addClass('collapsed-card');
                $('#compare_parent .card-body').css("display", "none");
                $('#compare_parent .compare-collapse-expand-btn').html(`<i class="fas fa-plus"></i>`);
            });

            $(document).on('change', '.date-of-service', function() {
                var quote = $(this).closest('.quote');
                quote.find('.badge-date-of-service').html($(this).val());
                quote.find('.badge-date-of-service').removeClass('d-none');
            });

            $(document).on('change', '.time-of-service', function() {
                var quote = $(this).closest('.quote');
                quote.find('.badge-time-of-service').html($(this).val());
                quote.find('.badge-time-of-service').removeClass('d-none');
            });



            var quoteKeyForComment = '';
            $(document).on('click', '.insert-quick-text', function() {

                var quote           = $(this).closest('.quote');
                quoteKeyForComment  = quote.data('key');
                var modal           = jQuery('.insert-quick-text-modal');
                modal.modal('show');
            });

            $(document).on('click', '#insert_quick_text_confirm_btn', function() {

                var quickText = $(".quick-comment:checked").val();
                $(".quick-comment").prop('checked', false);
                jQuery('.insert-quick-text-modal').modal('hide');
                $(`#quote_${quoteKeyForComment}_comments`).val(quickText);
            });

            var quoteKeyForProduct = '';
            $(document).on('click', '.add-new-product', function() {

                var quote           = $(this).closest('.quote');
                quoteKeyForProduct  = quote.data('key');
                var supplier_id     = quote.find('.supplier-id').val();
                var modal           = jQuery('.add-new-product-modal');

                if((supplier_id != "") && (typeof supplier_id !== 'undefined')){

                    modal.modal('show');

                    // reset modal feilds
                    $('#form_add_product').trigger("reset");
                    modal.find('#form_add_product #description').summernote("reset");
                    modal.find('#form_add_product #inclusions').summernote("reset");
                    modal.find('#form_add_product #packing_list').summernote("reset");

                    // set supplier id
                    modal.find('.product-supplier-id').val(supplier_id);

                }else{
                    alert("Please select Supplier first");
                    return;
                }

            });

            $("#form_add_product").submit(function(event) {

                event.preventDefault();

                var url      = $(this).attr('action');
                var formData = $(this).serialize();
                var options  = '';

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    beforeSend: function() {
                        $('input').removeClass('is-invalid');
                        $('.text-danger').html('');
                        $("#submit_add_product").find('span').addClass('spinner-border spinner-border-sm');
                    },
                    success: function(data) {
                        $("#submit_add_product").find('span').removeClass('spinner-border spinner-border-sm');

                        jQuery('.add-new-product-modal').modal('hide');

                        setTimeout(function() {

                            if(data && data.status == true){
                                alert(data.success_message);

                                if(data.products.length != 0){
                                
                                    options += "<option value=''>Select Product</option>";
                                    $.each(data.products, function(key, value) {
                                        options += `<option value='${value.id}' data-name='${value.name}'>${value.name} - ${value.code}</option>`;
                                    });
    
                                    $(`#quote_${quoteKeyForProduct}_product_id`).html(options);
                                }
                            }


                        }, 200);
                    },
                    error: function(reject) {
                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);

                            setTimeout(function() {

                                $("#submit_add_product").find('span').removeClass('spinner-border spinner-border-sm');

                                if (errors.hasOwnProperty("product_error")) {
                                    alert(errors.product_error);

                                } else {

                                    jQuery.each(errors.errors, function(index, value) {
                                        index = index.replace(/\./g, '_');
    
                                        $(`#${index}`).addClass('is-invalid');
                                        $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                                    });
    
                                }

                            }, 200);

                        }
                    },
                });

            });

            $(document).on('change', '.product-id', function() {
                var quote        = $(this).closest('.quote');
                var quoteKey     = quote.data('key');
                var product_name = $(this).find(':selected').attr('data-name');
                var product_id   = $(this).val();
                    
                if(typeof product_name === 'undefined' || product_name == '') {
                    quote.find('.badge-product-id').html('');
                    $(`#quote_${quoteKey}_booking_type_id`).val("").change();
                    return;
                }

                $.ajax({
                    type: 'get',
                    url: `${BASEURL}get-product-booking-type`,
                    data: { 'product_id': product_id },
                    success: function(response) {

                        // set category details feilds 
                        if(response.product != null && response.product.booking_type_id != null) {
                            $(`#quote_${quoteKey}_booking_type_id`).val(response.product.booking_type_id).change();
                        }
                    }
                });

                quote.find('.badge-product-id').html(product_name);
                quote.find('.badge-product-id').removeClass('d-none');
            });

            $(document).on('change', '.supplier-country-id', function(){

                var country_ids = $(this).val();
                var url         = BASEURL + 'country/to/supplier';
                var options     = '';

                console.log(url);
        
                $.ajax({
                    type: 'get',
                    url: url,
                    data: { 'country_ids': country_ids },
                    beforeSend: function() {
                        $('.supplier-id').html(options);
                    },
                    success: function(response) {

                        if(response && response.suppliers.length > 0){

                            options += "<option value=''>Select Supplier</option>";

                            $.each(response.suppliers, function(key, value) {
                                options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} </option>`;
                            });
            
                            $('.supplier-id').html(options);
                        }
        
                    }
                });

            });

            $(document).on('change', '.category-id', function() {

                var quote             = $(this).closest('.quote');
                var quoteKey          = quote.data('key');

                var detail_id         = $(`#quote_${quoteKey}_detail_id`).val();
                var model_name        = $(`#model_name`).val();

                var category_id       = $(this).val();
                var category_name     = $(this).find(':selected').attr('data-name');
                var category_slug     = $(this).find(':selected').attr('data-slug');

                var fields_data       = "";
                var formRenderID      = ".build-wrap"; 
                
                var options = ''; 
                

                // var options           = '';
          
                /* remove & reset supplier location attribute when category selected */
                if(typeof category_id === 'undefined' || category_id == ""){

                    quote.find('.badge-category-id').html("");

                    // $(`#quote_${quoteKey}_supplier_location_id`).val("").trigger('change');
                    // $(`#quote_${quoteKey}_supplier_location_id`).attr('disabled', 'disabled');

                    $(`#quote_${quoteKey}_supplier_id`).val("").trigger('change');
                    $(`#quote_${quoteKey}_supplier_id`).attr('disabled', 'disabled');

                    $(`#quote_${quoteKey}_product_id`).val("").trigger('change');
                    $(`#quote_${quoteKey}_product_id`).attr('disabled', 'disabled');
                    
                    $('.show-tf').addClass('d-none');

                    return;
                }else{
    
                    // $(`#quote_${quoteKey}_supplier_location_id`).removeAttr('disabled');
                    // $(`#quote_${quoteKey}_supplier_location_id`).val("").trigger('change');

                    $(`#quote_${quoteKey}_product_id`).removeAttr('disabled');
                    quote.find('.badge-category-id').html(category_name);
                }

                // set Payment type (Booking Type) refundable when category is fligt
                if(category_slug == 'flights'){
                    let refundable = $(`#quote_${quoteKey}_booking_type_id`).find("option[data-slug='refundable']").val();
                    $(`#quote_${quoteKey}_booking_type_id`).val(refundable).trigger('change');
                }else{
                    $(`#quote_${quoteKey}_booking_type_id`).val('').change();
                }


                $.ajax({
                    type: 'get',
                    url: `${BASEURL}category/to/supplier`,
                    data: { 'category_id': category_id, 'detail_id': detail_id, 'model_name': model_name },
                    success: function(response) {

                        // set category details feilds 
                        if(typeof response.category_details != 'undefined') {


                            fields_data = `${response.category_details}`;

                            quote.find('.category-details').val(fields_data);

                            jQuery(function($) {

                                var formRenderOptions = {
                                  formData: fields_data,
                                  layoutTemplates: {
                                    default: function(field, label, help, data) {
                                      let parentHtml = '<div>';
                                      let result = $(parentHtml).addClass('col rendered-form-child').append(label, field);
                                      return result;
                                    }
                                  }
                                }
                          
                                $(formRenderID).html("");
                                $(formRenderID).formRender(formRenderOptions);
                          
                                if(fields_data == ""){
                                  $(formRenderID).html("No Form Data.");
                                }
                              });
                        }

                        // Hide & Show Category details btn according to status
                        if((response.category != "") && (typeof response.category !== 'undefined')){

                            if(response.category.show_tf == 1){

                                $('.show-tf').removeClass('d-none');
                                quote.find('.show-tf .form-group .label-of-time-label').html(response.category.label_of_time);
                            }
                            else{
                                $('.show-tf').addClass('d-none');
                            }

                            if(response.category.quote == 1){
                                quote.find('.build-wrap-parent').removeClass('d-none').addClass('d-flex');
                            }else{
                                quote.find('.build-wrap-parent').removeClass('d-flex').addClass('d-none');
                            }

                            if(response.category.booking == 1){
                                quote.find('.booking-category-detail-btn-parent').removeClass('d-none');
                                quote.find('.booking-category-detail-btn-parent').addClass('d-flex');
                            }else{
                                quote.find('.booking-category-detail-btn-parent').removeClass('d-flex');
                                quote.find('.booking-category-detail-btn-parent').addClass('d-none');
                            }

                            if(response.category.set_end_date_of_service == 1){
                                var DateOFService = $(`#quote_${quoteKey}_date_of_service`).val();
                                $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setDate", DateOFService);
                            }

                            /* set product dropdown */
                            if(response && response.products.length > 0){

                                options += "<option value=''>Select Product</option>";
                                $.each(response.products, function(key, value) {
                                    options += `<option value='${value.id}' data-name='${value.name}'>${value.name} - ${value.code}</option>`;
                                });

                                $(`#quote_${quoteKey}_product_id`).html(options);
                            }else{
                                $(`#quote_${quoteKey}_product_id`).html("<option value=''>Select Product</option>");
                            }
                            
                            
                        }


                
                    }
                });

            });

            $(document).on('change', '.supplier-location-id', function(){
                
                var quote                 = $(this).closest('.quote');
                var quoteKey              = quote.data('key');
                var suppplier_location_id = $(`#quote_${quoteKey}_supplier_location_id`).val();
                var category_id           = $(`#quote_${quoteKey}_category_id`).val();
                var options               = '';

                $(`#quote_${quoteKey}_supplier_id`).removeAttr('disabled');

                /* set supplier dropdown null when supplier location become null */
                if(typeof suppplier_location_id === 'undefined' || suppplier_location_id == ""){
                    
                    $(`#quote_${quoteKey}_supplier_id`).val("").trigger('change');
                    $(`#quote_${quoteKey}_supplier_id`).attr('disabled', 'disabled');

                    $(`#quote_${quoteKey}_product_id`).val("").trigger('change');
                    $(`#quote_${quoteKey}_product_id`).attr('disabled', 'disabled');

                    return;
                }



                /* get suppliers according to location */
                $.ajax({
                    type: 'get',
                    url: `${BASEURL}location/to/supplier`,
                    data: { 'suppplier_location_id': suppplier_location_id, 'category_id': category_id},
                    beforeSend : function(){
                        $(`#quote_${quoteKey}_supplier_id`).val("").trigger('change');
                    },
                    success: function(response) {

                        /* set supplier dropdown*/
                        options += `<option value="">Select Supplier</option>`;
                        $.each(response.suppliers, function(key, value) {
                            options += `<option value='${value.id}' data-name='${value.name}'>${value.name}</option>`;
                        });
                        $(`#quote_${quoteKey}_supplier_id`).html(options);
                      
                    }
                })

            });

            // $(document).on('change', '.supplier-id', function() {

            //     var quote                = $(this).closest('.quote');
            //     var quoteKey             = quote.data('key');
            //     var supplier_name        = $(this).find(':selected').attr('data-name');
            //     var supplier_id          = $(this).val();
            //     var season_id            = $('.season-id').val();
            //     var supplier_location_id = $(`#quote_${quoteKey}_supplier_location_id`).val();
            //     var category_id          = $(`#quote_${quoteKey}_category_id`).val();
            //     var options              = '';

            //     /* set/unset card header, supplier currency & product */
            //     if(typeof supplier_id === 'undefined' || supplier_id == "") {
            //         quote.find('.badge-supplier-id').html("");

            //         // $(`#quote_${quoteKey}_product_id`).val("").trigger('change');
            //         // $(`#quote_${quoteKey}_product_id`).attr('disabled', 'disabled');

            //         $(`#quote_${quoteKey}_supplier_currency_id`).val("").trigger('change');
            //         return;
            //     }else{
            //         quote.find('.badge-supplier-id').html(supplier_name);
            //         // $(`#quote_${quoteKey}_product_id`).removeAttr('disabled');
            //     }

            //     /* get supplier's rate sheet, supplier's product, supplier's currency */
            //     if(season_id != "" && supplier_id != ""){
            //         $.ajax({
            //             type: 'get',
            //             url: `${BASEURL}get-supplier-product-and-sheet`,
            //             data: { 
            //                 'supplier_id': supplier_id,
            //                 'season_id': season_id,
            //                 'supplier_location_id': supplier_location_id,
            //                 'category_id': category_id,
            //             },
            //             success: function(response) {

            //                 if(response && response.url != ""){
            //                     quote.find('.view-supplier-rate').attr("href", response.url).html("(View Rates)");
            //                 }else{
            //                     quote.find('.view-supplier-rate').attr("href","").html("");
            //                 }

            //                 // /* set product dropdown */
            //                 // if(response && response.products.length > 0){
                            
            //                 //     options += "<option value=''>Select Product</option>";
            //                 //     $.each(response.products, function(key, value) {
            //                 //         options += `<option value='${value.id}' data-name='${value.name}'>${value.name}</option>`;
            //                 //     });

            //                 //     $(`#quote_${quoteKey}_product_id`).html(options);
            //                 // }else{
            //                 //     $(`#quote_${quoteKey}_product_id`).html("<option value=''>Select Product</option>");
            //                 // }

            //                 /* set supplier currency */
            //                 if(response && response.supplier_currency != ""){
            //                     $(`#quote_${quoteKey}_supplier_currency_id`).val(response.supplier_currency).trigger('change');
            //                 }

            //             }
            //         });
            //     }else{
            //         quote.find('.view-supplier-rate').attr("href","").html("");
            //         $(`#quote_${quoteKey}_product_id`).html("");
            //     }
            // });

            // $(document).on('change', '.product-location-id', function(){
                
            //     var quote                 = $(this).closest('.quote');
            //     var quoteKey              = quote.data('key');
            //     var product_location_id   = $(`#quote_${quoteKey}_product_location_id`).val();
            //     var supplier_id           = $(`#quote_${quoteKey}_supplier_id`).val();
            //     var options               = '';

            //     $(`#quote_${quoteKey}_product_id`).removeAttr('disabled');

            //     /* set product dropdown null when product location become null */
            //     if(typeof product_location_id === 'undefined' || product_location_id == ""){
            //         // quote.find('.badge-category-id').html("");
            //         $(`#quote_${quoteKey}_product_id`).html("<option value=''>Select Product</option>");
            //         $(`#quote_${quoteKey}_product_id`).val("").trigger('change');
            //         $(`#quote_${quoteKey}_product_id`).attr('disabled', 'disabled');
            //         return;
            //     }

            //     $.ajax({
            //         type: 'get',
            //         url: `${BASEURL}location/to/product`,
            //         data: { 'product_location_id': product_location_id, 'supplier_id' : supplier_id },
            //         success: function(response) {

            //             /* set supplier dropdown*/
            //             options += "<option value=''>Select Product</option>";
            //             $.each(response.products, function(key, value) {
            //                 options += `<option value='${value.id}' data-name='${value.name}'>${value.name}</option>`;
            //             });
            //             $(`#quote_${quoteKey}_product_id`).html(options);
                      
            //         }
            //     })

            // });

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

            /**
             * -------------------------------------------------------------------------------------
             *                                Season Manangement
             * -------------------------------------------------------------------------------------
             */

            $('#seasons').keyup(function() {
                var val = $(this).val();
                if (val.length == 4) {
                    $(this).val(val + '-');
                }
            });


            /**
             * -------------------------------------------------------------------------------------
             *                                Quote Manangement
             * -------------------------------------------------------------------------------------
             */


            $(document).on('click', '.removeChild', function() {
                var id = $(this).data('show');
                $(id).removeAttr("style");
                $($(this).data('append')).empty();
                $(this).attr("style", "display:none");
            });

            $(document).on('click', '.addChild', function() {
                $('.append').empty();
                var id = $(this).data('id');
                var refNumber = $(this).data('ref');
                var appendId = $(this).data('append');
                var url = '{{ route("get.child.reference", ":id") }}';
                url = url.replace(':id', refNumber);
                var removeBtnId = $(this).data('remove');
                var showBtnId = $(this).data('show');
                $('.addChild').removeAttr("style");
                $('.removeChild').attr("style", "display:none");

                $(this).attr("style", "display:none")
                    // $(appendId).empty();

                $.ajax({
                    url: BASEURL + 'quotes/child/reference',
                    data: { id: id, ref_no: refNumber },
                    type: 'get',
                    success: function(response) {
                        $(appendId).append(response);
                        $(removeBtnId).removeAttr("style");
                    }
                });
            });


            $(document).on('click', '.parent-row', function(e) {
                var parentID = $(this).data('id');
                $(`#child-row-${parentID}`).hasClass('d-none') ? $(`#child-row-${parentID}`).removeClass('d-none') : $(`#child-row-${parentID}`).addClass('d-none');
                $(this).html($(this).html() == `<span class="fa fa-minus"></span>` ? `<span class="fa fa-plus"></span>` : `<span class="fa fa-minus"></span>`);
            });

            $(document).on('click', '.quotes-service-category-btn', function(e) {

                e.preventDefault();

                var category_id   = $(this).attr('data-id');
                var category_name = $(this).attr('data-name');

                jQuery('#new_service_modal').modal('hide');
                $('.parent-spinner').addClass('spinner-border');

                if(category_id){

                    setTimeout(function() {

                        if ($('.select2single').data('select2')) {
                            $('.select2single').select2('destroy');
                        }

                        if ($('.select2-multiple').data('select2')) {
                            $('.select2-multiple').select2('destroy');
                        }

                        var quote = $(".quote").eq(0).clone()
                            .find("input").val("").each(function() {
                                this.name = this.name.replace(/\[(\d+)\]/, function() {

                                    let quoteLength = $('.quote').length;
                                    return `[${quoteLength}]`;

                                });
                                this.id = this.id.replace(/\d+/g, $('.quote').length, function() {

                                    let quoteLength = $('.quote').length;
                                    let dataName = $(this).attr("data-name");

                                    return `quote_${quoteLength}_${dataName}`;

                                });
                            }).end()
                            .find("textarea").val("").each(function() {
                                this.name = this.name.replace(/\[(\d+)\]/, function() {

                                    let quoteLength = $('.quote').length;
                                    return `[${quoteLength}]`;
                                });
                                this.id = this.id.replace(/\d+/g, $('.quote').length, function() {

                                    let quoteLength = $('.quote').length;
                                    let dataName    = $(this).attr("data-name");

                                    return `quote_${quoteLength}_${dataName}`;
                                });
                            }).end()
                            .find("select").val("").each(function() {
                                this.name = this.name.replace(/\[(\d+)\]/, function() { 

                                    let quoteLength = $('.quote').length;
                                    return `[${quoteLength}]`;
                                });
                                this.id = this.id.replace(/\d+/g, $('.quote').length, function() {

                                    let quoteLength = $('.quote').length;
                                    let dataName    = $(this).attr("data-name");
                                    return `quote_${quoteLength}_${dataName}`;
                                    
                                });
                            }).end().show().insertAfter(".quote:last");

                        var quoteLength = $('.quote').length;
                        var quoteKey    = quoteLength - 1;
                        var quoteClass = `.quote-${quoteKey}`;

                        quote.attr('data-key', quoteKey);
                        quote.removeClass(`quote-0`);
                        quote.addClass(`quote-${quoteKey}`);
                   
                        // $(`#quote_${quoteKey}_date_of_service`).val(todayDate());
                        $(`#quote_${quoteKey}_estimated_cost, #quote_${quoteKey}_markup_amount`).val('0.00');
                        $(`#quote_${quoteKey}_markup_percentage, #quote_${quoteKey}_selling_price`).val('0.00');
                        $(`#quote_${quoteKey}_profit_percentage, #quote_${quoteKey}_estimated_cost_in_booking_currency`).val('0.00');
                        $(`#quote_${quoteKey}_markup_amount_in_booking_currency, #quote_${quoteKey}_selling_price_in_booking_currency`).val('0.00');
                        // $(`#quote_${quoteKey}_table_name`).val('QuoteDetail');

                        $(`${quoteClass}`).find('.text-danger, .supplier-currency-code').html('');
                        $(`${quoteClass}`).find('input, select').removeClass('is-invalid');
                        $(`${quoteClass}`).find('.card-header .card-tools .remove').addClass('remove-quote-detail-service');
                        $(`${quoteClass}`).find('.card-header .card-tools .remove').removeClass('d-none');
                        $(`${quoteClass}`).find('.refundable-percentage-feild').addClass('d-none');
                        $(`${quoteClass}`).find('.category-id').val(category_id).change();
                        $(`${quoteClass}`).find('.badge-category-id').html(category_name);
                        $(`${quoteClass}`).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').html('');
                        // $(`${quoteClass}`).find('.badge-date-of-service').html(todayDate());

                        $(`${quoteClass}`).find('.fileManger').attr('data-input', `quote_${quoteKey}_image` );
                        $(`${quoteClass}`).find('.fileManger').attr('data-preview', `quote_${quoteKey}_holder` );
                        $(`${quoteClass}`).find('.previewId').attr('id', `quote_${quoteKey}_holder` );
                        $(`#quote_${quoteKey}_holder`).empty();
                        
                        callLaravelFileManger();
                        datepickerReset(1,`${quoteClass}`);

                        reinitializedSummerNote(`${quoteClass}`);
                        reinitializedDynamicFeilds();
                        reinitializedMultiDynamicFeilds();

                        $('html, body').animate({ scrollTop: $('.quote:last').offset().top }, 1000);
                        $('.parent-spinner').removeClass('spinner-border');

                    }, 180);

                }
            });

            function reinitializedSummerNote(quoteClass){

                jQuery(`${quoteClass}`).find('.note-editor').remove();
                jQuery(`${quoteClass}`).find('.summernote').summernote({
                    height: 100,   //set editable area's height
                    placeholder: 'Enter Text Here..',
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                });
            }

            $(document).on('click', '#add_more, #add_more_booking', function(e) {
                jQuery('#new_service_modal').modal('show');
            });

            $(document).on('click', '.add-new-service-below', function(e) {
          
                var quote = $(this).closest('.quote').data('key');

                jQuery('#new_service_modal_below').modal('show');
                jQuery('#new_service_modal_below').find('.current-key').val(quote);
            });

            $(document).on('click', '.quotes-service-category-btn-below', function(e) {

                e.preventDefault();

                var category_id   = $(this).attr('data-id');
                var category_name = $(this).attr('data-name');

                var classvalue =  jQuery('#new_service_modal_below').find('.current-key').val();
                var onQuoteClass = `.quote-${classvalue}`;

                jQuery('#new_service_modal_below').modal('hide');
                $('.parent-spinner').addClass('spinner-border');

                if(category_id){

                    setTimeout(function() {

                        if ($('.select2single').data('select2')) {
                            $('.select2single').select2('destroy');
                        }

                        var quote = $(".quote").eq(0).clone()
                            .find("input").val("").each(function() {
                                this.name = this.name.replace(/\[(\d+)\]/, function() {

                                    let quoteLength = $('.quote').length;
                                    return `[${quoteLength}]`;

                                });
                                this.id = this.id.replace(/\d+/g, $('.quote').length, function() {

                                    let quoteLength = $('.quote').length;
                                    let dataName = $(this).attr("data-name");

                                    return `quote_${quoteLength}_${dataName}`;

                                });
                            }).end()
                            .find("textarea").val("").each(function() {
                                this.name = this.name.replace(/\[(\d+)\]/, function() {

                                    let quoteLength = $('.quote').length;
                                    return `[${quoteLength}]`;
                                });
                                this.id = this.id.replace(/\d+/g, $('.quote').length, function() {

                                    let quoteLength = $('.quote').length;
                                    let dataName    = $(this).attr("data-name");

                                    return `quote_${quoteLength}_${dataName}`;
                                });
                            }).end()
                            .find("select").val("").each(function() {
                                this.name = this.name.replace(/\[(\d+)\]/, function() { 

                                    let quoteLength = $('.quote').length;
                                    return `[${quoteLength}]`;
                                });
                                this.id = this.id.replace(/\d+/g, $('.quote').length, function() {

                                    let quoteLength = $('.quote').length;
                                    let dataName    = $(this).attr("data-name");
                                    return `quote_${quoteLength}_${dataName}`;
                                    
                                });
                            }).end().show().insertAfter(onQuoteClass);

                        var quoteLength = $('.quote').length;
                        var quoteKey    = quoteLength - 1;
                        var quoteClass  = `.quote-${quoteKey}`;

                        quote.attr('data-key', quoteKey);
                        quote.removeClass(`quote-0`);
                        quote.addClass(`quote-${quoteKey}`);
                   
                        // $(`#quote_${quoteKey}_date_of_service`).val(todayDate());
                        $(`#quote_${quoteKey}_estimated_cost, #quote_${quoteKey}_markup_amount`).val('0.00');
                        $(`#quote_${quoteKey}_markup_percentage, #quote_${quoteKey}_selling_price`).val('0.00');
                        $(`#quote_${quoteKey}_profit_percentage, #quote_${quoteKey}_estimated_cost_in_booking_currency`).val('0.00');
                        $(`#quote_${quoteKey}_markup_amount_in_booking_currency, #quote_${quoteKey}_selling_price_in_booking_currency`).val('0.00'); 
                        // $(`#quote_${quoteKey}_table_name`).val('QuoteDetail');

                        $(`${quoteClass}`).find('.text-danger, .supplier-currency-code').html('');
                        $(`${quoteClass}`).find('input, select').removeClass('is-invalid');
                        $(`${quoteClass}`).find('.card-header .card-tools .remove').addClass('remove-quote-detail-service');
                        $(`${quoteClass}`).find('.card-header .card-tools .remove').removeClass('d-none');
                        $(`${quoteClass}`).find('.refundable-percentage-feild').addClass('d-none');
                        $(`${quoteClass}`).find('.category-id').val(category_id).change();
                        $(`${quoteClass}`).find('.badge-category-id').html(category_name);
                        $(`${quoteClass}`).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').html('');
                        // $(`${quoteClass}`).find('.badge-date-of-service').html(todayDate());

                        $(`${quoteClass}`).find('.fileManger').attr('data-input', `quote_${quoteKey}_image` );
                        $(`${quoteClass}`).find('.fileManger').attr('data-preview', `quote_${quoteKey}_holder` );
                        $(`${quoteClass}`).find('.previewId').attr('id', `quote_${quoteKey}_holder` );
                        $(`#quote_${quoteKey}_holder`).empty();
                        
                        callLaravelFileManger();
                        datepickerReset(1,`${quoteClass}`);

                        reinitializedSummerNote(`${quoteClass}`);
                        reinitializedDynamicFeilds();

                        $('html, body').animate({ scrollTop: $(quoteClass).offset().top }, 1000);
                        $('.parent-spinner').removeClass('spinner-border');

                    }, 180);

                }


            });

            $(document).on('click', '.bookings-service-category-btn-below', function(e) {

                e.preventDefault();

                var category_id   = $(this).attr('data-id');
                var category_name = $(this).attr('data-name');

                jQuery('#new_service_modal_below').modal('hide');
                $('.parent-spinner').addClass('spinner-border');

                var classvalue =  jQuery('#new_service_modal_below').find('.current-key').val();
                var onQuoteClass = `.quote-${classvalue}`;

                if(category_id){

                    setTimeout(function() {

                        if ($('.select2single').data('select2')) {
                            $('.select2single').select2('destroy');
                        }
        
                        var quote = $(".quote").eq(0).clone()
                            .find("input").val("").each(function() {
                                this.name = this.name.replace(/\[(\d+)\]/, function() {
                                    let quoteLength = $('.quote').length;
                                    return `[${quoteLength}]`;
                                });
                                this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                                    let quoteLength = $('.quote').length;
                                    let dataName    = $(this).attr("data-name");
                                    return `quote_${quoteLength}_${dataName}`;
                                });
                            }).end()
                            .find("textarea").val("").each(function() {
                                this.name = this.name.replace(/\[(\d+)\]/, function() {
                                    let quoteLength = $('.quote').length;
                                    return `[${quoteLength}]`;
                                });
                                this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                                    let quoteLength = $('.quote').length;
                                    let dataName = $(this).attr("data-name");
                                    return `quote_${quoteLength}_${dataName}`;
                                });
                            }).end()
                            .find("select").val("").each(function() {
                                this.name = this.name.replace(/\[(\d+)\]/, function() { 
                                    let quoteLength = $('.quote').length;
                                    return `[${quoteLength}]`;
                                });
                                this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                                    let quoteLength = $('.quote').length;
                                    let dataName = $(this).attr("data-name");
                                    return `quote_${quoteLength}_${dataName}`;
                                });
                            }).end().show().insertAfter(onQuoteClass);

                        var quoteLength = $('.quote').length;
                        var quoteKey    = quoteLength - 1;
                        var quoteClass  = `.quote-${quoteKey}`;

                        quote.attr('data-key', quoteKey);
                        quote.removeClass(`quote-0`);
                        quote.addClass(`quote-${quoteKey}`);
        
                        $(`${quoteClass}`).find('.finance .row:not(:first):not(:last)').remove();
                        $(`${quoteClass}`).find('.actual-cost').attr("data-status", "");
                        $(`${quoteClass}`).find('.markup-amount').attr("readonly", false);
                        $(`${quoteClass}`).find('.markup-percentage').attr("readonly", false);
                        $(`${quoteClass}`).find('.cal_selling_price').attr('checked', 'checked');
                        $(`${quoteClass}`).find('.deposit-amount').val('0.00');

                        $(`${quoteClass} .finance`).find("input").val("").each(function() {
                            this.name = this.name.replace(/\[(\d+)\]/, function() {

                                let quoteLength = parseInt($('.quote').length) - 1;
                                return `[${quoteLength}]`;
                            });
        
                            let n = 1;

                            this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? 0 : v, function() {
                               
                                let name        = $(this).attr("data-name");
                                let quoteLength = parseInt($('.quote').length) - 1;

                                return `quote_${quoteLength}_finance_${0}_${name}`;
                            });
        
                        }).end()
                        .find("select").val("").each(function() {
                            this.name = this.name.replace(/\[(\d+)\]/, function() {
                                let quoteLength = parseInt($('.quote').length) - 1;
                                return `[${quoteLength}]`;
                            });

                            let n           = 1;
                            this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? 0 : v, function() {

                                let name        = $(this).attr("data-name");
                                let quoteLength = parseInt($('.quote').length) - 1;

                                return `quote_${quoteLength}_finance_${0}_${name}`;
                            });
                        });

                        // $(`#quote_${quoteKey}_date_of_service`).val(todayDate());
                        $(`#quote_${quoteKey}_table_name`).val('BookingDetail');
                        $(`${quoteClass}`).find('.mediaModal').find('a').attr('id', '');
                        $(`${quoteClass}`).find('.refund-payment-hidden-section').attr("hidden", true);
                        $(`${quoteClass}`).find('.refund-by-credit-note-section').attr("hidden", true);
                        $(`${quoteClass}`).find('.finance-clonning').removeClass("cancelled-payment-styling");
                        $(`${quoteClass}`).find('.btn-group').removeClass("d-none");
                        $(`${quoteClass}`).find('.clone_booking_finance').removeClass("d-none");
                        $(`${quoteClass}`).find('.finance-clonning input, .finance-clonning select').attr("readonly", false);
                        $(`${quoteClass}`).find('.payment-method').attr("disabled", false);
                        $(`${quoteClass}`).find('.outstanding-amount').attr("readonly", true);
                        $(`${quoteClass}`).find('.cancel-payemnt-btn').attr("hidden", true);
                        $(`${quoteClass}`).find('.refund-by-credit-note-section').remove();
                        $(`${quoteClass}`).find('.refund-by-bank-section').remove();
                        $(`${quoteClass}`).find('.supplier-id').html(`<option selected value="">Select Supplier</option>`);
                        $(`${quoteClass}`).find('.product-id').html(`<option selected value="">Select Product</option>`);
                        $(`${quoteClass}`).find(".estimated-cost, .actual-cost, .markup-amount, .markup-percentage, .selling-price, .profit-percentage, .estimated-cost-in-booking-currency, .selling-price-in-booking-currency, .markup-amount-in-booking-currency").val('0.00').attr('data-code', '');
                        $(`${quoteClass}`).find('.text-danger, .supplier-currency-code').html('');
                        $(`${quoteClass}`).find('input, select').removeClass('is-invalid');
                        $(`${quoteClass}`).find('.added-in-sage').removeAttr('checked');
                        $(`${quoteClass}`).find('.booking-detail-cancellation').remove();
                        $(`${quoteClass}`).find('.revert-booking-detail-cancellation').remove();
                        $(`${quoteClass}`).find('.category-id').val(category_id).change();
                        $(`${quoteClass}`).find('.badge-category-id').html(category_name);
                        $(`${quoteClass}`).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').addClass('d-none');
                        $(`${quoteClass}`).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').html('');
                        // $(`${quoteClass}`).find('.badge-date-of-service').html(todayDate());
                        $(`${quoteClass}`).find('.badge-service-status').html('');
                        $(`${quoteClass}`).find('.finance-clonning-btn, .calender-feild-form-group').removeClass('d-none');

                        datepickerReset(1,`${quoteClass}`);
                        reinitializedDynamicFeilds();

                        $('html, body').animate({ scrollTop: $(quoteClass).offset().top }, 1000);
                        $('.parent-spinner').removeClass('spinner-border');

                    }, 180);

                }

            });

            $(document).on('click', '.bookings-service-category-btn', function(e) {

                e.preventDefault();

                var category_id   = $(this).attr('data-id');
                var category_name = $(this).attr('data-name');

                jQuery('#new_service_modal').modal('hide');
                $('.parent-spinner').addClass('spinner-border');

                if(category_id){

                    setTimeout(function() {

                        if ($('.select2single').data('select2')) {
                            $('.select2single').select2('destroy');
                        }
        
                        var quote = $(".quote").eq(0).clone()
                            .find("input").val("").each(function() {
                                this.name = this.name.replace(/\[(\d+)\]/, function() {
                                    let quoteLength = $('.quote').length;
                                    return `[${quoteLength}]`;
                                });
                                this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                                    let quoteLength = $('.quote').length;
                                    let dataName    = $(this).attr("data-name");
                                    return `quote_${quoteLength}_${dataName}`;
                                });
                            }).end()
                            .find("textarea").val("").each(function() {
                                this.name = this.name.replace(/\[(\d+)\]/, function() {
                                    let quoteLength = $('.quote').length;
                                    return `[${quoteLength}]`;
                                });
                                this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                                    let quoteLength = $('.quote').length;
                                    let dataName = $(this).attr("data-name");
                                    return `quote_${quoteLength}_${dataName}`;
                                });
                            }).end()
                            .find("select").val("").each(function() {
                                this.name = this.name.replace(/\[(\d+)\]/, function() { 
                                    let quoteLength = $('.quote').length;
                                    return `[${quoteLength}]`;
                                });
                                this.id = this.id.replace(/\d+/g, $('.quote').length, function() {
                                    let quoteLength = $('.quote').length;
                                    let dataName = $(this).attr("data-name");
                                    return `quote_${quoteLength}_${dataName}`;
                                });
                            }).end().show().insertAfter(".quote:last");

                        var quoteLength = $('.quote').length;
                        var quoteKey    = quoteLength - 1;
                        var quoteClass = `.quote-${quoteKey}`;

                        quote.attr('data-key', quoteKey);
                        quote.removeClass(`quote-0`);
                        quote.addClass(`quote-${quoteKey}`);
        
                        $(`${quoteClass}`).find('.finance .row:not(:first):not(:last)').remove();
                        $(`${quoteClass}`).find('.actual-cost').attr("data-status", "");
                        $(`${quoteClass}`).find('.markup-amount').attr("readonly", false);
                        $(`${quoteClass}`).find('.markup-percentage').attr("readonly", false);
                        $(`${quoteClass}`).find('.cal_selling_price').attr('checked', 'checked');
                        $(`${quoteClass}`).find('.deposit-amount').val('0.00');

                        $(`${quoteClass} .finance`).find("input").val("").each(function() {
                            this.name = this.name.replace(/\[(\d+)\]/, function() {
                                // return '[' + ($('.quote').length - 1) + ']';

                                let quoteLength = parseInt($('.quote').length) - 1;
                                return `[${quoteLength}]`;
                            });
        
                            let n = 1;

                            this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? 0 : v, function() {
                               
                                let name        = $(this).attr("data-name");
                                let quoteLength = parseInt($('.quote').length) - 1;

                                return `quote_${quoteLength}_finance_${0}_${name}`;
                            });
        
                        }).end()
                        .find("select").val("").each(function() {
                            this.name = this.name.replace(/\[(\d+)\]/, function() {

                                let quoteLength = parseInt($('.quote').length) - 1;
                                return `[${quoteLength}]`;
                            });

                            let n           = 1;
                            this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? 0 : v, function() {

                                let name        = $(this).attr("data-name");
                                let quoteLength = parseInt($('.quote').length) - 1;

                                return `quote_${quoteLength}_finance_${0}_${name}`;
                            });
                        });

                        // $(`#quote_${quoteKey}_date_of_service`).val(todayDate());
                        $(`#quote_${quoteKey}_table_name`).val('BookingDetail');
                        $(`${quoteClass}`).find('.mediaModal').find('a').attr('id', '');
                        $(`${quoteClass}`).find('.refund-payment-hidden-section').attr("hidden", true);
                        $(`${quoteClass}`).find('.refund-by-credit-note-section').attr("hidden", true);
                        $(`${quoteClass}`).find('.finance-clonning').removeClass("cancelled-payment-styling");
                        $(`${quoteClass}`).find('.btn-group').removeClass("d-none");
                        $(`${quoteClass}`).find('.clone_booking_finance').removeClass("d-none");
                        $(`${quoteClass}`).find('.finance-clonning input, .finance-clonning select').attr("readonly", false);
                        $(`${quoteClass}`).find('.payment-method').attr("disabled", false);
                        $(`${quoteClass}`).find('.outstanding-amount').attr("readonly", true);
                        $(`${quoteClass}`).find('.cancel-payemnt-btn').attr("hidden", true);
                        $(`${quoteClass}`).find('.refund-by-credit-note-section').remove();
                        $(`${quoteClass}`).find('.refund-by-bank-section').remove();
                        $(`${quoteClass}`).find('.supplier-id').html(`<option selected value="">Select Supplier</option>`);
                        $(`${quoteClass}`).find('.product-id').html(`<option selected value="">Select Product</option>`);
                        $(`${quoteClass}`).find(".estimated-cost, .actual-cost, .markup-amount, .markup-percentage, .selling-price, .profit-percentage, .estimated-cost-in-booking-currency, .selling-price-in-booking-currency, .markup-amount-in-booking-currency").val('0.00').attr('data-code', '');
                        $(`${quoteClass}`).find('.text-danger, .supplier-currency-code').html('');
                        $(`${quoteClass}`).find('input, select').removeClass('is-invalid');
                        $(`${quoteClass}`).find('.added-in-sage').removeAttr('checked');
                        $(`${quoteClass}`).find('.booking-detail-cancellation').remove();
                        $(`${quoteClass}`).find('.revert-booking-detail-cancellation').remove();
                        $(`${quoteClass}`).find('.category-id').val(category_id).change();
                        $(`${quoteClass}`).find('.badge-category-id').html(category_name);
                        $(`${quoteClass}`).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').addClass('d-none');
                        $(`${quoteClass}`).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').html('');
                        // $(`${quoteClass}`).find('.badge-date-of-service').html(todayDate());
                        $(`${quoteClass}`).find('.badge-service-status').html('');
                        $(`${quoteClass}`).find('.finance-clonning-btn, .calender-feild-form-group').removeClass('d-none');

                        datepickerReset(1,`${quoteClass}`);
                        reinitializedDynamicFeilds();

                        $('html, body').animate({ scrollTop: $(`${quoteClass}`).offset().top }, 1000);
                        $('.parent-spinner').removeClass('spinner-border');

                    }, 180);

                }

            });

            $(document).on('change', '.supplier-currency-id', function() {

                var code             = $(this).find(':selected').data('code');
                var quote            = $(this).closest('.quote');
                var quoteKey         = quote.data('key');
                var bookingCurrency  = $('#currency_id').val();
                var currency_name    = $(this).find(':selected').attr('data-name');
                var supplierCurrency = $(this).val();


                if(typeof supplierCurrency === 'undefined' || supplierCurrency == "") {
                    quote.find("[class*=supplier-currency-code]").html("");
                    quote.find('.badge-supplier-currency-id').html("");
                    return;
                }

                if (typeof bookingCurrency === 'undefined' || bookingCurrency == "") {
                    alert("Please Select Booking Currency first");
                    return;
                }
                
                quote.find("[class*=supplier-currency-code]").html(code);
                quote.find('.badge-supplier-currency-id').html(currency_name);
                // quote.find('.badge-supplier-currency-id').removeClass('d-none');

                getQuoteSupplierCurrencyValues(code, quoteKey);
                getQuoteTotalValues();
            });

            $(document).on('change', '.booking-type-id', function() {

                var quote        = $(this).closest('.quote');
                var booking_type = $(this).val();
                var booking_slug = $(this).find(':selected').data('slug');

                if(booking_type == 2 || booking_slug == 'partially-refundable'){

                    quote.find('.refundable-percentage-feild').removeClass('d-none');
                }else{

                    quote.find('.refundable-percentage-feild').addClass('d-none');
                }

            });

            $(document).on('change', '.booking-currency-id', function() {
                $('.booking-currency-code').html($(this).find(':selected').data('code'));
                var status = $(this).attr("data-status");

                if (status && status == 'booking') {

                    getBookingTotalValues();
                    getBookingBookingCurrencyValues();

                } else {

                    getQuoteBookingCurrencyValues();
                    getQuoteTotalValues();
                }

                getCommissionRate();
            });

            $(document).on("keyup change", '.change-calculation', function(event) {
                var key = $(this).closest('.quote').data('key');
                var changeFeild = $(this).attr("data-name");
                getQuoteDetailsValues(key, changeFeild);
            });

            $(document).on("keyup change", '.change', function(event) {

                var key = $(this).closest('.quote').data('key');
                var changeFeild = $(this).attr("data-name");
                var cal_selling_price = $('.cal_selling_price').is(':checked');
                var status = $(this).attr("data-status");

                if (status && status == 'booking' && cal_selling_price == false) {
                    getBookingDetailValues(key);

                } else {
                    getQuoteDetailValuesForBooking(key, changeFeild);
                }

            });

            $(document).on('change', '.cal_selling_price', function() {

                var key = $(this).closest('.quote').data('key');
                var changeFeild = 'estimated_cost';

                if ($(this).is(':checked')) {
                    $(`#quote_${key}_markup_amount`).attr("readonly", false);
                    $(`#quote_${key}_markup_percentage`).attr("readonly", false);
                    $(`#quote_${key}_actual_cost`).attr("data-status", "");

                } else {
                    $(`#quote_${key}_markup_amount`).attr("readonly", true);
                    $(`#quote_${key}_markup_percentage`).attr("readonly", true);
                    $(`#quote_${key}_actual_cost`).attr("data-status", "booking");;
                }
            });

            $(document).on('change', '.selling-price-other-currency', function() {
                $('.selling-price-other-currency-code').text($(this).val());
                getSellingPrice();
            });

            $(document).on('click', '.view-payment_detail', function() {

                var details = $(this).data('details');
                var tbody = '';
                var client_type = details.client_type == 1 ? 'Client' : 'Agency';
                var payment_method = '';
                if (details.payment_type_id == 1) {
                    payment_method = 'Bank';
                } else if (details.payment_type_id == 2) {
                    payment_method = 'Paysafe';
                } else {
                    payment_method = '';
                }

                tbody += `<tr>
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

            $(document).on('click', '.cancel-booking', function(e) {

                e.preventDefault();


                if (confirm("Are you sure you want to Cancel Booking?") == true) {

                    var booking_id = $(this).attr('data-bookingid');
                    jQuery('#cancel_booking').modal('show');

                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                        url: `${REDIRECT_BASEURL}bookings/get-booking-net-price/${booking_id}`,
                        type: 'get',
                        success: function(data) {

                            // console.log(data);

                            if (data !== null && data !== '' && data !== undefined) {

                                jQuery('#cancel_booking').modal('show').find('#booking_currency_id').val(data.booking_currency_id);
                                jQuery('#cancel_booking').modal('show').find('#booking_net_price').val(data.booking_net_price);
                                jQuery('#cancel_booking').modal('show').find('#booking_net_price_text').text(`Cancellation Charges should not be greater ${data.booking_net_price} ${data.booking_currency_code}`);
                                jQuery('#cancel_booking').modal('show').find('#booking_id').val(booking_id);
                                jQuery('#cancel_booking').modal('show').find('#booking_currency_code').text(data.booking_currency_code);
                            }

                        },
                        error: function(reject) {}
                    });

                }
            });

            $(document).on('click', '.booking-detail-cancellation', function(e) {
                e.preventDefault();

                var booking_detail_id       = $(this).attr('data-bookingDetialID');

                var quote      = jQuery(this).closest('.quote');
                var quoteKey   = quote.data('key');
                var created_by = $(`#quote_${quoteKey}_created_by`).val();

                var data = {
                    booking_detail_id       : booking_detail_id,
                    booking_cancelled_by_id : created_by
                };

                if( confirm("Are you sure you want to Cancel this Service?") == true){

                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                        url: `${REDIRECT_BASEURL}bookings/booking-detail-cancellation`,
                        type: 'POST',
                        data: data,
                        success: function(data) {

                            setTimeout(function() {

                                if (data.success_message) {
                                    alert(data.success_message);
                                    location.reload();
                                }

                            }, 100);

                        },
                        error: function(reject) {}
                    });

                }
            });

            $(document).on('click', '.revert-booking-detail-cancellation', function(e) {
                e.preventDefault();

                var booking_detail_id       = $(this).attr('data-bookingDetialID');

                if( confirm("Are you sure you want to Revert Cancelled Service?") == true){

                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                        url: `${REDIRECT_BASEURL}bookings/revert-booking-detail-cancellation/${booking_detail_id}`,
                        type: 'GET',
                        success: function(data) {

                            setTimeout(function() {

                                if (data.success_message) {
                                    alert(data.success_message);
                                    location.reload();
                                }

                            }, 100);

                        },
                        error: function(reject) {}
                    });

                }

            });

            $(document).on('click', '.remove-booking-detail-service', function(e) {
                e.preventDefault();

                if( confirm("Are you sure you want to Remove this Service?") == true){
                    $(this).closest(".quote").remove();

                    getBookingTotalValues();
                }
            });

            $(document).on('click', '.remove-quote-detail-service', function(e) {
                e.preventDefault();

                if( confirm("Are you sure you want to Remove this Service?") == true){
                    $(this).closest(".quote").remove();

                    getQuoteTotalValues();
                }
            });


            // $(document).on('click', '.cancel-service', function(e) {

            //     e.preventDefault();

            //     var booking_detail_id = $(this).attr('data-bookingDetialID');

            //     if( confirm("Are you sure you want to Cancel this Service?") == true){

            //         $.ajax({
            //             headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
            //             url: `${REDIRECT_BASEURL}bookings/cancel-booking-service/${booking_detail_id}/${status}`,
            //             type: 'get',
            //             success: function(data) {

            //                 setTimeout(function() {

            //                     if (data.success_message) {
            //                         alert(data.success_message);
            //                         location.reload();
            //                     }

            //                 }, 400);

            //             },
            //             error: function(reject) {}
            //         });
            //     }

            // });

            $("#cancel_booking_submit").submit(function(event) {

                event.preventDefault();

                var url = $(this).attr('action');
                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    beforeSend: function() {
                        $('input').removeClass('is-invalid');
                        $('.text-danger').html('');
                        $("#submit_cancel_booking").find('span').addClass('spinner-border spinner-border-sm');
                    },
                    success: function(data) {
                        $("#submit_cancel_booking").find('span').removeClass('spinner-border spinner-border-sm');

                        jQuery('#cancel_booking').modal('hide');

                        setTimeout(function() {

                            if (data.success_message) {
                                alert(data.success_message);
                                location.reload();
                            }

                        }, 400);
                    },
                    error: function(reject) {
                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);

                            setTimeout(function() {

                                $("#submit_cancel_booking").find('span').removeClass('spinner-border spinner-border-sm');

                                jQuery.each(errors.errors, function(index, value) {
                                    index = index.replace(/\./g, '_');
                                    $(`#${index}`).addClass('is-invalid');
                                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                                });

                            }, 400);

                        }
                    },
                });

            });

            $(".readonly").keypress(function(evt) {
                evt.preventDefault();
            });

            $(".versions :input").prop("disabled", true);
            $('#bookingVersion :input').prop('disabled', true);
            $('#reCall, .disablebutton').prop("disabled", false);
            $(".add-category-detail, .versions .category-detail-feilds-close").removeAttr("disabled");
            $(".versions .category-detail-feilds-submit").addClass("d-none");

            $(".collapse-all-btn").removeAttr('disabled');
            $(".expand-all-btn").removeAttr('disabled');

            $('#reCall').on('click', function() {
                if ($(this).data('recall') == true) {
                    if (confirm("Are you sure you want to Recall this Quotation?") == true) {
                        $(".versions :input").removeAttr("disabled");
                        $(this).data('recall', 'false');
                        $(this).text('Back Into Version');
                        var add_HTML = `<div class="col-12 text-right">
                        <button type="button" id="add_more" class="btn mr-3 btn-outline-dark  pull-right ">+ Add more </button>
                        <button type="button"  id="add_storeText" class="mr-3 btn btn-outline-dark  float-right pull-right">x Remove Stored Text</button>

                                    </div>`;
                        $('#addMoreButton').append(add_HTML);

                      var btn_Submit = `  <button type="submit" class="btn btn-success float-right">Submit</button>`;
                        $('#btnSubmitversion').append(btn_Submit);

                        $('.remove').addClass('remove-quote-detail-service');
                        $('.remove').removeClass('d-none');
                        $('.add-new-product, .insert-quick-text, .add-new-service-below').removeClass('d-none');

                        getMarkupTypeFeildAttribute();
                    }
                } else {
                    $("#versions :input").prop("disabled", true);
                    $('#reCall').prop("disabled", false);
                    $(this).text('Recall Version');
                    $('#addMoreButton').append();
                    $('#btnSubmitversion').append();
                }
            });


            $("#quoteCreate").submit(function(event) {
                event.preventDefault();
                var url = $(this).attr('action');

                $('input, select').removeClass('is-invalid');
                $('.text-danger').html('');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#overlay").addClass('overlay');
                        $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
                    },
                    success: function(data) {
                        $("#overlay").removeClass('overlay').html('');
                        setTimeout(function() {

                            if(data && data.status == 200){
                                alert(data.success_message);
                                window.location.href = REDIRECT_BASEURL + "quotes/index";
                            }
                        }, 200);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);

                            setTimeout(function() {

                                var flag = true;

                                $("#overlay").removeClass('overlay').html('');

                                jQuery.each(errors.errors, function(index, value) {

                                    index = index.replace(/\./g, '_');

                                    // expand quote if feild has an error
                                    $(`#${index}`).closest('.quote').removeClass('collapsed-card');
                                    $(`#${index}`).closest('.quote').find('.card-body').css("display", "block");
                                    $(`#${index}`).closest('.quote').find('.collapse-expand-btn').html(`<i class="fas fa-minus"></i>`);

                                    $(`#${index}`).addClass('is-invalid');
                                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                                    if (flag) {

                                        $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                                        flag = false;
                                    }

                                });
                            }, 400);
                        }
                    },
                });
            });

            /*
            |--------------------------------------------------------------------------
            | Template Management
            |--------------------------------------------------------------------------
            */

            // Reset Template Modal On Open
            $(document).on('click', '#save_template', function() {

                var modal = jQuery('#modal-default').modal('show');

                modal.find('#template_name').val('');
                modal.find("input[name=privacy_status][value=1]").prop('checked', true);
            });

            $(document).on('click', '#submit_template', function() {

                disabledFeild(".create-template [name=_method]");

                var templateName  = $('#template_name').val();
                var privacyStatus = $('input[name="privacy_status"]:checked').val();
                var formData      = $('.create-template').serialize() + '&template_name=' + templateName + '&privacy_status=' + privacyStatus ;
                var url           = `${REDIRECT_BASEURL}template/store-for-quote`;

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    beforeSend: function() {

                        $('input').removeClass('is-invalid');
                        $('.text-danger').html('');
                        $("#submit_template").find('span').addClass('spinner-border spinner-border-sm');
                    },
                    success: function(data) {

                        $("#submit_template").find('span').removeClass('spinner-border spinner-border-sm');
                        jQuery('#modal-default').modal('hide');

                        setTimeout(function() {
                            alert('Template Created Successfully');
                            removeDisabledAttribute(".create-template [name=_method]");
                        }, 400);
                    },
                    error: function(reject) {
                        removeDisabledAttribute(".create-template [name=_method]");
                        if (reject.status === 422) {
                            var errors = $.parseJSON(reject.responseText);

                            setTimeout(function() {

                                $("#submit_template").find('span').removeClass('spinner-border spinner-border-sm');

                                jQuery.each(errors.errors, function(index, value) {
                                    index = index.replace(/\./g, '_');
                                    $(`#${index}`).addClass('is-invalid');
                                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                                });
                            }, 400);
                        }
                    },
                });

            });

            $('.tempalte-id').on('change', function() {

                var templateID = $(this).val();

                $.ajax({
                    url: `${BASEURL}template/${templateID}/partial`,
                    type: 'get',
                    dataType: "json",
                    success: function(data) {

                        if (data) {
                            if (confirm("Are you sure! you want to override Quote Details?")) {

                                $('#parent').html(data.template_view);

                                $(".select2single").select2({
                                    width: "100%",
                                    theme: "bootstrap",
                                    templateResult: formatState,
                                    templateSelection: formatState,
                                });

                                $(`input[name=markup_type][value='${data.template.markup_type}']`).attr('checked', 'checked');
                                $(`input[name=rate_type][value='${data.template.rate_type}']`).attr('checked', 'checked');
                                $(".booking-currency-id").val(data.template.currency_id).change();

                                // make quote section sortable
                                $(function() {
                                    $( ".sortable" ).sortable();
                                });

                                getQuoteTotalValues();

                                // jQuery('.note-editor').remove();
                                jQuery('.summernote').summernote({
                                    height: 100,   //set editable area's height
                                    placeholder: 'Enter Text Here..',
                                    codemirror: { // codemirror options
                                        theme: 'monokai'
                                    },
                                });
                            }
                        }

                    },
                    error: function(reject) {
                        console.log(reject);
                        // searchRef.text('Search').prop('disabled', false);
                    },
                });

            });

            $("#create_template").submit(function(event) {

                event.preventDefault();
                var url = $(this).attr('action');

                /* Send the data using post */
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {

                        $('input, select').removeClass('is-invalid');
                        $('.text-danger').html('');

                        $("#overlay").addClass('overlay');
                        $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
                    },
                    success: function(data) {

                        $("#overlay").removeClass('overlay').html('');

                        setTimeout(function() {

                            if(data && data.status == 200){
                                alert(data.success_message);
                                window.location.href = `${REDIRECT_BASEURL}template/index`;
                            }
                        }, 400);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);
                            
                            setTimeout(function() {

                                var flag = true;

                                $("#overlay").removeClass('overlay').html('');

                                jQuery.each(errors.errors, function(index, value) {

                                    index = index.replace(/\./g, '_');

                                    // expand quote if feild has an error
                                    $(`#${index}`).closest('.quote').removeClass('collapsed-card');
                                    $(`#${index}`).closest('.quote').find('.card-body').css("display", "block");
                                    $(`#${index}`).closest('.quote').find('.collapse-expand-btn').html(`<i class="fas fa-minus"></i>`);

                                    $(`#${index}`).addClass('is-invalid');
                                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                                    if (flag) {

                                        $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                                        flag = false;
                                    }

                                });
                            }, 400);

                        }
                    },
                });
            });

            $("#update_template").submit(function(event) {

                event.preventDefault();

                var url = $(this).attr('action');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {

                        $('input, select').removeClass('is-invalid');
                        $('.text-danger').html('');

                        $("#overlay").addClass('overlay');
                        $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
                    },
                    success: function(data) {

                        $("#overlay").removeClass('overlay').html('');
                        setTimeout(function() {

                            if(data && data.status == 200){
                                alert(data.success_message);
                                window.location.href = `${REDIRECT_BASEURL}template/index`;
                            }
                            
                        }, 400);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);

                            setTimeout(function() {
                                $("#overlay").removeClass('overlay').html('');

                                jQuery.each(errors.errors, function(index, value) {

                                    index = index.replace(/\./g, '_');

                                    $(`#${index}`).addClass('is-invalid');
                                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                                });

                            }, 400);

                        }
                    },
                });
            });

            /*
            |--------------------------------------------------------------------------
            | End Template Management
            |--------------------------------------------------------------------------
            */

            $(".update-quote").submit(function(event) {
                event.preventDefault();
             
                var url = $(this).attr('action');

                removeDisabledAttribute(".create-template [name=_method]");
           
                // $('#lead_passenger_contact').intlTelInput("getNumber");/
                // console.log($("input[name='full_number']").val()+ 'asdsa');

                // $('#lead_passenger_contact').intlTelInput("getNumber")

                var formData = new FormData(this);

                var full_number = '';
                var agency = $("input[name=agency]:checked").val();

                if(agency == 0){
                    full_number = $('#lead_passenger_contact').closest('.form-group').find("input[name='full_number']").val();
                }else{
                    full_number = $('#agency_contact').closest('.form-group').find("input[name='full_number']").val();
                }

                formData.append('full_number', full_number);

                /* Send the data using post */
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('input, select').removeClass('is-invalid');
                        $('.text-danger').html('');

                        $("#overlay").addClass('overlay');
                        $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);

                        $('.quote').removeClass('border border-danger');
                    },
                    success: function(data) {
                        $("#overlay").removeClass('overlay').html('');
                        setTimeout(function() {

                            if(data && data.status == 200){
                                alert(data.success_message);
                                window.location.href = REDIRECT_BASEURL + "quotes/index";
                            }

                        }, 200);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);

                            setTimeout(function() {
                                $("#overlay").removeClass('overlay').html('');
                                var flag = true;

                                if (errors.hasOwnProperty("overrride_errors")) {
                                    alert(errors.overrride_errors);
                                    window.location.href = REDIRECT_BASEURL + "quotes/index";
                                } else {

                                    jQuery.each(errors.errors, function(index, value) {

                                        index = index.replace(/\./g, '_');

                                        // expand quote if feild has an error
                                        // $(`#${index}`).closest('.quote').addClass('border border-danger');

                                        $(`#${index}`).closest('.quote').removeClass('collapsed-card');
                                        $(`#${index}`).closest('.quote').find('.card-body').css("display", "block");
                                        $(`#${index}`).closest('.quote').find('.collapse-expand-btn').html(`<i class="fas fa-minus"></i>`);
               
                                        $(`#${index}`).addClass('is-invalid');
                                        $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                                        if (flag) {

                                            $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                                            flag = false;
                                        }

                                    });
                                }

                            }, 400);
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
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#override_submit").find('span').addClass('spinner-border spinner-border-sm');
                    },
                    success: function(data) {


                        if (data.success_message) {

                            // $("#override_submit").find('span').removeClass('spinner-border spinner-border-sm');
                            jQuery('.category-detail-feilds').modal('show');
                        }


                        // $("#overlay").removeClass('overlay').html('');
                        // setTimeout(function() {
                        //     alert('Quote updated Successfully');
                        //     window.location.href = REDIRECT_BASEURL + "quotes/index";
                        // }, 400);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);


                            setTimeout(function() {
                                $("#overlay").removeClass('overlay').html('');

                                jQuery.each(errors.errors, function(index, value) {

                                    index = index.replace(/\./g, '_');
                                    $(`#${index}`).addClass('is-invalid');
                                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                                });

                            }, 400);

                        }
                    },
                });
            });

            $("#create_supplier_rate_sheet").submit(function(event) {
                
                event.preventDefault();

                var url = $(this).attr('action');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {

                        $('input, select').removeClass('is-invalid');
                        $('.text-danger').html('');
                        $("#supplier_rate_sheet_submit").find('span').addClass('spinner-border spinner-border-sm');
                    },
                    success: function(data) {

                        $("#supplier_rate_sheet_submit").find('span').removeClass('spinner-border spinner-border-sm');

                        setTimeout(function() {

                            if(data && data.status == 200){
                                alert(data.success_message);
                                window.location.href = REDIRECT_BASEURL + "supplier-rate-sheet";
                            }
                        }, 200);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);

                            setTimeout(function() {
                                $("#supplier_rate_sheet_submit").find('span').removeClass('spinner-border spinner-border-sm');

                                jQuery.each(errors.errors, function(index, value) {

                                    index = index.replace(/\./g, '_');
                                    $(`#${index}`).addClass('is-invalid');
                                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                                });

                            }, 200);

                        }
                    },
                });
            });

            $("#edit_supplier_rate_sheet").submit(function(event) {
                
                event.preventDefault();

                var url = $(this).attr('action');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {

                        $('input, select').removeClass('is-invalid');
                        $('.text-danger').html('');
                        $("#supplier_rate_sheet_edit").find('span').addClass('spinner-border spinner-border-sm');
                    },
                    success: function(data) {

                        $("#supplier_rate_sheet_edit").find('span').removeClass('spinner-border spinner-border-sm');

                        setTimeout(function() {

                            if(data && data.status == 200){
                                alert(data.success_message);
                                window.location.href = REDIRECT_BASEURL + "supplier-rate-sheet";
                            }
                        }, 200);
                  
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);

                            setTimeout(function() {
                                $("#supplier_rate_sheet_edit").find('span').removeClass('spinner-border spinner-border-sm');

                                jQuery.each(errors.errors, function(index, value) {

                                    index = index.replace(/\./g, '_');
                                    $(`#${index}`).addClass('is-invalid');
                                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                                });

                            }, 200);

                        }
                    },
                });
            });

            
            $("#store_supplier").submit(function(event) {

                event.preventDefault();

                var url      = $(this).attr('action');
                var formData = new FormData(this);

                /* Send the data using post */
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        removeFormValidationStyles();
                        addFormLoadingStyles();
                    },
                    success: function(data) {

                        removeFormLoadingStyles();

                        setTimeout(function() {

                            if(data && data.status == 200){
                                alert(data.success_message);
                                window.location.href = `${REDIRECT_BASEURL}suppliers`;
                            }
                        }, 400);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);
                            
                            setTimeout(function() {

                                removeFormLoadingStyles();
                                let flag = true;

                                jQuery.each(errors.errors, function(index, value) {

                                    index = index.replace(/\./g, '_');

                                    $(`#${index}`).addClass('is-invalid');
                                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                                    if(flag){

                                        $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                                        flag = false;
                                    }

                                });
                            }, 400);

                        }
                    },
                });
            });

                      
            $("#update_supplier").submit(function(event) {

                event.preventDefault();

                var url      = $(this).attr('action');
                var formData = new FormData(this);

                /* Send the data using post */
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        removeFormValidationStyles();
                        addFormLoadingStyles();
                    },
                    success: function(data) {

                        
                        setTimeout(function() {
                            removeFormLoadingStyles();

                            if(data && data.status == 200){
                                alert(data.success_message);
                                window.location.href = `${REDIRECT_BASEURL}suppliers`;
                            }
                        }, 400);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);
                            
                            removeFormLoadingStyles();
                            
                            setTimeout(function() {

                                let flag = true;

                                jQuery.each(errors.errors, function(index, value) {

                                    index = index.replace(/\./g, '_');

                                    $(`#${index}`).addClass('is-invalid');
                                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                                    if(flag){

                                        $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                                        flag = false;
                                    }

                                });
                            }, 400);

                        }
                    },
                });
            });

            $('.search-reference').on('click', function() {
                var searchRef = $(this);

                var reference_no = $('.reference-name').val();
                if (reference_no == '') {
                    alert('Reference number is not found');
                    searchRef.text('Search').prop('disabled', false);
                } else {
                    $('#ref_no').closest('.form-group').find('.text-danger').html('');
                    //check refrence is already exist in system
                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                        url: BASEURL + 'find/reference/' + reference_no + '/exist',
                        type: 'get',
                        dataType: "json",
                        success: function(data) {
                            var r = true
                            if (data.response == true) {
                                r = confirm('The reference number is already exists. Are you sure! you want to create quote again on same reference');
                            }

                            if (r == true) {
                                $.ajax({
                                    headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                                    url: BASEURL + 'find/reference',
                                    data: { ref_no: reference_no },
                                    type: 'POST',
                                    dataType: "json",
                                    beforeSend: function() {

                                        $(".search-reference-btn").find('span').addClass('spinner-border spinner-border-sm');
                                        searchRef.prop('disabled', true);
                                    },
                                    success: function(data) {
                                        // console.log(data);
                                        var tbody = '';
                                        if (data.response) {

                                            if (data.response.tas_ref) {
                                                $("#tas_ref").val(data.response.tas_ref);
                                            }

                                            if (data.response.passengers && data.response.passengers.hasOwnProperty('lead_passenger') && data.response.passengers.lead_passenger.hasOwnProperty('passenger_name')) {
                                                $('#lead_passenger_name').val(data.response.passengers.lead_passenger.passenger_name);
                                            }

                                            if (data.response.brand && data.response.brand.hasOwnProperty('brand_id')) {
                                                $('#brand_id').val(data.response.brand.brand_id).change();
                                            }

                                            if (data.response.brand && data.response.brand.hasOwnProperty('name')) {
                                                setTimeout(function() {
                                                    $("#holiday_type_id option:contains(" + data.response.brand.name + ")").attr('selected', 'selected').change();
                                                    // $("#holiday_type_id option[data-value='" + data.response.brand.name +"']").attr("selected","selected");
                                                }, 500);
                                            }

                                            if (data.response.sale_person) {
                                                $('#sale_person_id').val(data.response.sale_person).trigger('change');
                                            }

                                            if (data.response.pax) {
                                                $('#pax_no').val(data.response.pax).trigger('change');
                                            }

                                            if (data.response.currency) {
                                                $("#currency_id").find('option').each(function() {
                                                    if ($(this).data('code') == data.response.currency) {
                                                        $(this).attr("selected", "selected").change();
                                                    }
                                                });
                                            }

                                            if (data.response.passengers && data.response.passengers.hasOwnProperty('lead_passenger') && data.response.passengers.lead_passenger.hasOwnProperty('dinning_prefrences')) {
                                                $('#lead_passenger_dietary_preferences').val(data.response.passengers.lead_passenger.dinning_prefrences);
                                            }

                                            if (data.response.passengers && data.response.passengers.hasOwnProperty('lead_passenger') && data.response.passengers.lead_passenger.hasOwnProperty('bedding_prefrences')) {
                                                $('#bedding_preference').val(data.response.passengers.lead_passenger.bedding_prefrences);
                                            }

                                            // Passengers Details
                                            if (data.response.passengers.passengers.length > 0) {
                                                data.response.passengers.passengers.forEach(($_value, $key) => {
                                                    var $_count = $key + 1;
                                                    $('input[name="pax[' + $_count + '][full_name]"]').val($_value.passenger_name);
                                                    $('input[name="pax[' + $_count + '][email_address]"]').val($_value.passenger_email);
                                                    $('input[name="pax[' + $_count + '][contact_number]"]').val($_value.passenger_contact);
                                                    $('input[name="pax[' + $_count + '][date_of_birth]"]').val($_value.passenger_dbo);
                                                    $('input[name="pax[' + $_count + '][bedding_preference]"]').val($_value.bedding_prefrences);
                                                    $('input[name="pax[' + $_count + '][dietary_preferences]"]').val($_value.dinning_prefrences);
                                                });
                                            }

                                        } else {
                                            alert(data.error);
                                        }

                                        searchRef.prop('disabled', false);
                                        $(".search-reference-btn").find('span').removeClass('spinner-border spinner-border-sm');

                                    },
                                    error: function(reject) {

                                        searchRef.prop('disabled', false);
                                        $(".search-reference-btn").find('span').removeClass('spinner-border spinner-border-sm');
                                        $('#ref_no').closest('.form-group').find('.text-danger').html(reject.responseJSON.errors);

                                    },
                                });
                            }
                        },
                        error: function(reject) {

                            alert(reject);
                            searchRef.text('Search').prop('disabled', false);

                            searchRef.prop('disabled', false);
                            $(".search-reference-btn").find('span').removeClass('spinner-border spinner-border-sm');

                        },
                    });
                    //ajax for references
                }
            });


       
            function createFilter(type,label,data){

                var options;

                if(label == null){
                    $('.filter-col').remove();
                    return;
                }

                $.ajax({
                    type: "GET",
                    url: `${BASEURL}category-details-filter`,
                    data: { 'type': type, 'label': label, 'data': data },
                    datatype: "json",
                    async: false,
                    success: function(response){

                        var result = '';
                        $.each(response.label_results, function(key, value) {
                            result += `<option value="${value.value}"> ${value.value} </option>`;
                        });

                        options = result;
                    }
                });

                var multipleSelect2HTML = 
                `<div class="col-md-3 filter-col">
                    <div class="d-flex bd-highlight">
                        <div class="w-100 bd-highlight"><label>${label}</label></div>
                        <div class="flex-shrink-1 bd-highlight" style="font-size: 11px;"><i class="fas fa-times text-danger border border-danger remove-col" style="padding: 4px; border-radius: 4px; cursor: pointer;"></i></div>
                    </div>
                    <select class="form-control select2-multiple" multiple name="columns[${label}][]">${options}</select>
                </div>`;
          
                return multipleSelect2HTML;
            }

 
            $(document).on('change', '.transfer-detail-feild', function() {

                var feild = $(this).val();

                if(typeof feild === 'undefined' || feild == ""){
                    $('#search_transfer_detail').addClass('d-none');
                }else{
                    $('#search_transfer_detail').removeClass('d-none');
                }

                var type  = $(this).find(':selected').attr('data-optionType');
                var label = $(this).find(':selected').attr('data-optionLable');
                var data  = $(this).find(':selected').attr('data-optionData');

                $(createFilter(type,label,data)).insertBefore("#more_filter");
                reinitializedMultiDynamicFeilds();
            });


            $(document).on('click', '.remove-col', function() {
                $(this).closest('.filter-col').remove();
            });

            $(document).on('click', '.clone_booking_finance', function() {

                if ($('.select2single').data('select2')) {
                    $('.select2single').select2('destroy');
                }

                var quote = $(this).closest('.quote');
                var quoteKey = quote.data('key');
                var financeCloningLength = quote.find(".finance-clonning").length;

                quote.find('.finance-clonning').first().clone().find("input").val("").each(function() {

                        let n = 1;
                        let name = $(this).attr("data-name");

                        this.name = this.name.replace(/]\[(\d+)]/g, function() {
                            return `][${financeCloningLength}]`;
                        });

                        this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? financeCloningLength : v, function() {
                            return `quote_${quoteKey}_finance_${financeCloningLength}_${name}`;
                        });

                    }).end().find('.depositeLabel').each(function() {

                        this.id = 'deposite_heading' + financeCloningLength;
                        $(this).text(`Payment #${financeCloningLength+1}`);

                    }).end()
                    .find("select").val("").each(function() {

                        let n = 1;
                        let name = $(this).attr("data-name");

                        this.name = this.name.replace(/]\[(\d+)]/g, function() {
                            return `][${financeCloningLength}]`;
                        });

                        this.id = this.id.replace(/[0-9]+/g, v => n++ == 2 ? financeCloningLength : v, function() {
                            return `quote_${quoteKey}_finance_${financeCloningLength}_${name}`;
                        });

                    }).end().find('.select2single').select2({
                        width: '100%',
                        theme: "bootstrap",
                    }).end()
                    .show()
                    .insertAfter(quote.find('.finance-clonning:last'));

                // set feild after clone
                quote.find('.finance-clonning:last .checkbox').prop('checked', false);
                quote.find('.finance-clonning:last .deposit-amount').val('0.00').attr("readonly", false);
                quote.find('.finance-clonning:last .ab_number_of_days').val('0').attr("readonly", false);
                quote.find('.finance-clonning:last').attr('data-financekey', financeCloningLength);

                reinitializedDynamicFeilds();
            });

            $(document).on('click', '.add-more-cancellation-payments', function() {


                if ($('.select2single').data('select2')) {
                    $('.select2single').select2('destroy');
                }

                var cancellationPayments = $('.cancellation-payments');
                var cancellationRefundPaymentRow = $(".cancellation-refund-payment-row").length;

                cancellationPayments.find('.cancellation-refund-payment-row').first().clone().find("input").val("").each(function() {

                        let name = $(this).attr("data-name");

                        this.name = this.name.replace(/\[(\d+)\]/, function() {
                            return `[${cancellationRefundPaymentRow}]`
                        });

                        this.id = this.id.replace(/\d+/g, cancellationRefundPaymentRow, function() {
                            return `cancellation_refund_${cancellationRefundPaymentRow}_${name}`
                        });

                    }).end().find('.cancellation-refund-payment-label').each(function() {

                        this.id = `cancellation_refund_payment_label_${cancellationRefundPaymentRow}`;
                        $(this).text(`Refund Amount #${cancellationRefundPaymentRow+1}`);

                    }).end()
                    .find("select").val("").each(function() {

                        let name = $(this).attr("data-name");

                        this.name = this.name.replace(/\[(\d+)\]/, function() {
                            return `[${cancellationRefundPaymentRow}]`
                        });

                        this.id = this.id.replace(/\d+/g, cancellationRefundPaymentRow, function() {
                            return `cancellation_refund_${cancellationRefundPaymentRow}_${name}`
                        });

                    }).end().find('.select2single').select2({
                        width: '100%',
                        theme: "bootstrap",
                    }).end()
                    .show()
                    .insertAfter($('.cancellation-refund-payment-row:last'));

                // set feild after clone
                // quote.find('.finance-clonning:last .checkbox').prop('checked', false);
                // quote.find('.finance-clonning:last .deposit-amount').val('0.00').attr("readonly", false);
                // quote.find('.finance-clonning:last .ab_number_of_days').val('0').attr("readonly", false);
                // quote.find('.finance-clonning:last').attr('data-financekey',financeCloningLength);
                cancellationPayments.find('.cancellation-refund-payment-row:last .cancellation-refund-payment-row-remove-btn').removeClass('d-none');

                reinitializedDynamicFeilds();
            });

            $(document).on('change', '.cancellation-refund-amount', function() {

                var cancellationRefundAmount = $(this).val();
                var cancellationRefundTotalAmount = $('#cancellation_refund_total_amount').val();

                console.log(" cancellationRefundAmount: " + cancellationRefundAmount);
                console.log(" cancellationRefundTotalAmount: " + cancellationRefundTotalAmount);


                var totalCancellationRefundAmountArray = $('.cancellation-payments').find('.cancellation-refund-amount').map((i, e) => parseFloat(e.value)).get();
                var totalCancellationRefundAmount = totalCancellationRefundAmountArray.reduce((a, b) => (a + b), 0);

                if (totalCancellationRefundAmount > cancellationRefundTotalAmount) {
                    alert("Please Enter Correct Refund Amount.");
                    $(this).val("0.00");
                }

            });

            $("#update-booking").submit(function(event) {
                event.preventDefault();

                $('.payment-method').removeAttr('disabled');

                var url         = $(this).attr('action');
                var formData    = new FormData(this);
                var agency      = $("input[name=agency]:checked").val();
                var full_number = '';

                if(agency == 0){
                    full_number = $('#lead_passenger_contact').closest('.form-group').find("input[name='full_number']").val();
                }else{
                    full_number = $('#agency_contact').closest('.form-group').find("input[name='full_number']").val();
                }

                formData.append('full_number', full_number);

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('input, select').removeClass('is-invalid');
                        $('.text-danger').html('');
                        $("#overlay").addClass('overlay');
                        $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
                    },
                    success: function(data) {

                        $("#overlay").removeClass('overlay').html('');
                        setTimeout(function() {

                            if(data && data.status == 200){
                                alert(data.success_message);
                                window.location.href = REDIRECT_BASEURL + "bookings/index";
                                // location.reload();
                            }

                        }, 200);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);

                            setTimeout(function() {

                                $("#overlay").removeClass('overlay').html('');

                                if (errors.hasOwnProperty("overrride_errors")) {
                                    alert(errors.overrride_errors);
                                    window.location.href = REDIRECT_BASEURL + "bookings/index";
                                } else {

                                    var flag = true;

                                    jQuery.each(errors.errors, function(index, value) {

                                        index = index.replace(/\./g, '_');

                                        // expand quote if feild has an error
                                        $(`#${index}`).closest('.quote').removeClass('collapsed-card');
                                        $(`#${index}`).closest('.quote').find('.card-body').css("display", "block");
                                        $(`#${index}`).closest('.quote').find('.collapse-expand-btn').html(`<i class="fas fa-minus"></i>`);

                                        $(`#${index}`).addClass('is-invalid');
                                        $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                                        if (flag) {

                                            $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                                            flag = false;
                                        }
                                    });
                                }

                            }, 200);

                        }
                    },
                });
            });

            $("#update-payment").submit(function(event) {
                event.preventDefault();

                $('#update-payment :input').prop('disabled', false);

                var $form = $(this),
                    url = $form.attr('action');
                var formdata = $(this).serialize();

                $('input, select').removeClass('is-invalid');
                $('.text-danger').html('');

                /* Send the data using post */
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#overlay").addClass('overlay');
                        $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
                    },
                    success: function(data) {

                        $("#overlay").removeClass('overlay').html('');
                        setTimeout(function() {
                            alert(data.success_message);
                            window.location.href = REDIRECT_BASEURL + "bookings/index";

                        }, 1000);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);

                            setTimeout(function() {

                                $("#overlay").removeClass('overlay').html('');

                                if (errors.hasOwnProperty("overrride_errors")) {
                                    alert(errors.overrride_errors);
                                    window.location.href = REDIRECT_BASEURL + "bookings/index";
                                } else {

                                    var flag = true;
                                    
                                    jQuery.each(errors.errors, function(index, value) {

                                        index = index.replace(/\./g, '_');
                                        $(`#${index}`).addClass('is-invalid');
                                        $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                                        if (flag) {

                                            $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                                            flag = false;
                                        }
                                    });
                                }

                            }, 400);

                        }
                    },
                });
            });

            function getMarkupTypeFeildAttribute(){

                var markupType = $("input[name=markup_type]:checked").val();

                if(markupType == 'whole'){

                    $('.whole-markup-feilds').addClass('d-none');
                    $('.total-markup-amount').removeAttr('readonly');
                    $('.total-markup-percent').removeAttr('readonly');
                    getQuoteTotalValues();

                }else if(markupType == 'itemised'){

                    $('.whole-markup-feilds').removeClass('d-none');
                    $('.total-markup-amount').prop('readonly', true);
                    $('.total-markup-percent').prop('readonly', true);
                    getQuoteTotalValues();
                }
            }

            $(document).on('change', '.markup-type', function() {
                getMarkupTypeFeildAttribute();
            });

            function getBookingMarkupTypeFeildAttribute(){

                var markupType = $("input[name=markup_type]:checked").val();

                if(markupType == 'whole'){

                    $('.booking-whole-markup-feilds').addClass('d-none');
                    $('.total-markup-amount').removeAttr('readonly');
                    $('.total-markup-percent').removeAttr('readonly');
                    getBookingTotalValues();

                }else if(markupType == 'itemised'){

                    $('.booking-whole-markup-feilds').removeClass('d-none');
                    $('.total-markup-amount').prop('readonly', true);
                    $('.total-markup-percent').prop('readonly', true);  
                    getBookingTotalValues();

                }


            }

            $(document).on('change', '.booking-markup-type', function() {
                getBookingMarkupTypeFeildAttribute();
            });


            $(document).on('change', '.total-markup-change', function() {

                var changeFeild = $(this).attr("data-name");
                getQuoteTotalValuesOnMarkupChange(changeFeild);

            });

            // for booking
            $(document).on('change', '.booking-total-markup-change', function() {

                var changeFeild = $(this).attr("data-name");
                getBookingTotalValuesOnMarkupChange(changeFeild);

            });

            
            $(document).on('change', '.view-rate-booking-currency-filter', function(){

                var url                = `${BASEURL}filter-currency-rate/${selectedCurrencies}`;
                var selectedCurrencies = $(this).val();

                if (selectedCurrencies == ''){
                    selectedCurrencies = [];
                }

                $.ajax({
                    type: 'get',
                    url: url,
                    data: { 'selected_currencies': selectedCurrencies },
                    success: function(response){
                        $('#currency_conversions').html(response);
                    }
                });

            });

            function getQuoteTotalValuesOnMarkupChange(changeFeild){

                var totalNetPrice                   = 0;
                var totalMarkupAmount               = 0;
                var markupPercentage                = 0;
                var calculatedTotalMarkupPercentage = 0;
                var totalSellingPrice               = 0;
                var calculatedTotalMarkupAmount     = 0;
                var calculatedProfitPercentage      = 0;

                totalNetPrice               = parseFloat($('.total-net-price').val());
                totalMarkupAmount           = parseFloat($('.total-markup-amount').val());
                markupPercentage            = parseFloat($('.total-markup-percent').val());

                if(changeFeild == 'total_markup_amount'){

                    calculatedTotalMarkupPercentage = parseFloat(totalMarkupAmount) / parseFloat(totalNetPrice / 100);
                    totalSellingPrice               = totalNetPrice + totalMarkupAmount;

                    $('.total-markup-percent').val(check(calculatedTotalMarkupPercentage));
                    $('.total-selling-price').val(check(totalSellingPrice));
                }

                if(changeFeild == 'total_markup_percent'){

                    calculatedTotalMarkupAmount = (parseFloat(totalNetPrice) / 100) * parseFloat(markupPercentage);
                    totalSellingPrice           = totalNetPrice + calculatedTotalMarkupAmount;

                    $('.total-markup-amount').val(check(calculatedTotalMarkupAmount));
                    $('.total-selling-price').val(check(totalSellingPrice));
                }

                calculatedProfitPercentage = ((parseFloat(totalSellingPrice) - parseFloat(totalNetPrice)) / parseFloat(totalSellingPrice)) * 100;
                $('.total-profit-percentage').val(check(calculatedProfitPercentage));

                getCommissionRate();
                getBookingAmountPerPerson();
                getSellingPrice();
                getCalculatedTotalNetMarkup();
            }

            function getBookingTotalValuesOnMarkupChange(changeFeild){

                var totalNetPrice                   = 0;
                var totalMarkupAmount               = 0;
                var markupPercentage                = 0;
                var calculatedTotalMarkupPercentage = 0;
                var totalSellingPrice               = 0;
                var calculatedTotalMarkupAmount     = 0;
                var calculatedProfitPercentage      = 0;

                totalNetPrice               = parseFloat($('.total-net-price').val());
                totalMarkupAmount           = parseFloat($('.total-markup-amount').val());
                markupPercentage            = parseFloat($('.total-markup-percent').val());

                if(changeFeild == 'total_markup_amount'){

                    calculatedTotalMarkupPercentage = parseFloat(totalMarkupAmount) / parseFloat(totalNetPrice / 100);
                    totalSellingPrice               = totalNetPrice + totalMarkupAmount;

                    $('.total-markup-percent').val(check(calculatedTotalMarkupPercentage));
                    $('.total-selling-price').val(check(totalSellingPrice));
                }

                if(changeFeild == 'total_markup_percent'){

                    calculatedTotalMarkupAmount = (parseFloat(totalNetPrice) / 100) * parseFloat(markupPercentage);
                    totalSellingPrice           = totalNetPrice + calculatedTotalMarkupAmount;

                    $('.total-markup-amount').val(check(calculatedTotalMarkupAmount));
                    $('.total-selling-price').val(check(totalSellingPrice));
                }

                calculatedProfitPercentage = ((parseFloat(totalSellingPrice) - parseFloat(totalNetPrice)) / parseFloat(totalSellingPrice)) * 100;
                $('.total-profit-percentage').val(check(calculatedProfitPercentage));

                getCommissionRate();
                getBookingAmountPerPerson();
                getCalculatedTotalNetMarkup();
            }



            $(document).on('change', '.deposit-due-date', function() {
                var close = $(this).closest('.finance-clonning');
                close.find('.plus').removeAttr('disabled');
            });

            $('.parent').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".child").prop('checked', true);

                } else {

                    $(".child").prop('checked', false);
                }
            });

            $('.sbp-parent').on('click', function(e) {

                if ($(this).is(':checked', true)) {

                    $(".credit").prop('checked', false);
                    $('.credit').trigger('click');

                } else {
           
                    $('.credit').trigger('click');
                    $('.total-paid-amount').val(parseFloat(0).toFixed(2));
            
                }
            });

            $('.credit').change(function(){

                var currencyCode          = $(this).attr('data-currencyCode');
                var value                 = parseFloat($(this).attr('data-value')).toFixed(2);
                var row                   = $(this).closest('.credit-row');

                if($(this).is(':checked')){

                    $(this).val('1');

                    row.find('.row-paid-amount').val(value);
                    row.find('.row-total-paid-amount').val(value);

                    getTotalPaidAmount();
    
                }
                else {
                
                    $(this).val('0');

                    row.find('.row-paid-amount').val((parseFloat(0).toFixed(2)));
                    row.find('.row-total-paid-amount').val((parseFloat(0).toFixed(2)));
                    getTotalPaidAmount();
                    // $('.total-paid-amount').val((parseFloat(getCheckedValues()).toFixed(2)));
                }

            });

            $(document).on("change", '.row-paid-amount', function(event) {

                var row                        = $(this).closest('.credit-row');
                var currentPaidAmountValue     = parseFloat($(this).val());

                var rowCreditNoteAmount        = row.find('.row-credit-note-amount').val();
                var rowTotalPaidAmount         = parseFloat(currentPaidAmountValue) + parseFloat(rowCreditNoteAmount);

                var totalOutstandingAmountLeft = parseFloat(row.find('.credit').attr('data-value'));

                row.find('.row-total-paid-amount').val(getFloat(rowTotalPaidAmount));


                if(rowTotalPaidAmount > totalOutstandingAmountLeft){
                    alert("Please Enter Correct Amount");
                    $(this).val('0.00');


                    row.find('.row-total-paid-amount').val(getFloat(rowCreditNoteAmount));
                }

                getTotalPaidAmount();

                // var value                 = parseFloat($(this).val());
                // var row                   = $(this).closest('.credit-row');
                // var outstandingAmountLeft = row.find('.credit').val();

                // if(value > outstandingAmountLeft){
                //     alert("Please Enter Correct Amount");
                //     $(this).val('0.00');
                // }

                // getTotalPaidAmount();
            });

            function getTotalPaidAmount(){

                var paidAmountValues = parseFloat(getPaidAmountValues());
                $('.total-paid-amount').val(getFloat(paidAmountValues));
            }

            function getRemainingCreditNoteAmount(){

                var totalWalletAmount     = parseFloat($('.total-credit-amount').val());
                var totalCreditNoteValues = parseFloat(getCreditNoteValues());
                var result                = parseFloat(totalWalletAmount) - parseFloat(totalCreditNoteValues);

                $('.remaining-credit-amount').html(getFloat(result));
                $('.remaining-credit-amount').val(getFloat(result));
            }

            function getPaidAmountValues(){
                var checkedValuesArray = $('.row-total-paid-amount').map((i, e) => parseFloat(e.value)).get();
                var checkedValuesTotal = checkedValuesArray.reduce((a, b) => (a + b), 0);
                return parseFloat(checkedValuesTotal).toFixed(2);
            }

            function getCreditNoteValues(){
                var checkedValuesArray = $('.row-credit-note-amount').map((i, e) => parseFloat(e.value)).get();
                var checkedValuesTotal = checkedValuesArray.reduce((a, b) => (a + b), 0);
                return parseFloat(checkedValuesTotal).toFixed(2);
            }


            function getFloat(value){
                // console.log(parseFloat(value).toFixed(2));
                return parseFloat(value).toFixed(2);
            }


            $(document).on("change", '.row-credit-note-amount', function(event) {

                var totalWalletAmount      = parseFloat($('.total-credit-amount').val());
                var currentCreditNoteValue = parseFloat($(this).val());

                var row                    = $(this).closest('.credit-row');
                var rowOutstandingAmount   = row.find('.credit').attr('data-value');

                var rowPaidAmount          = parseFloat(rowOutstandingAmount) - parseFloat(currentCreditNoteValue);
                var rowTotalPaidAmount     = parseFloat(rowPaidAmount) + parseFloat(currentCreditNoteValue);

                var totalCreditNoteValues = parseFloat(getCreditNoteValues());

                if(row.find('.credit').is(':checked')){

                    row.find('.row-paid-amount').val(getFloat(rowPaidAmount));
                    row.find('.row-total-paid-amount').val(getFloat(rowTotalPaidAmount));

                    if(currentCreditNoteValue > totalWalletAmount || totalCreditNoteValues > totalWalletAmount ){

                        alert("Please Enter Correct Amount");
                        $(this).val('0.00');
    
                        row.find('.row-paid-amount').val(getFloat(rowOutstandingAmount));
                        row.find('.row-total-paid-amount').val(getFloat(rowOutstandingAmount));
                    }


                    getTotalPaidAmount();
                    getRemainingCreditNoteAmount();
                }
                else {
                    $(this).val('0.00');
                }
            });

            $("#bulk_payment").submit(function(event) {

                event.preventDefault();
            
                var checkedValues = $('.credit:checked').map((i, e) => e.value).get();
                if (checkedValues.length == 0) {
                    alert("Please Check any Record First");
                    return;
                }

                var url = $(this).attr('action');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('input, select').removeClass('is-invalid');
                        $('.text-danger').html('');
                        $("#bulk_payment_submit").find('span').addClass('spinner-border spinner-border-sm');
                    },
                    success: function(data) {
                        $("#bulk_payment_submit").find('span').removeClass('spinner-border spinner-border-sm');

                        setTimeout(function() {

                            if(data && data.status == true){
                                alert(data.success_message);
                                location.reload();
                            }
                        }, 200);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);

                            setTimeout(function() {
                                $("#bulk_payment_submit").find('span').removeClass('spinner-border spinner-border-sm');

                                if (errors.hasOwnProperty("payment_error")) {
                                    alert(errors.payment_error);
                                    location.reload();

                                } else {

                                    var flag = true;

                                    jQuery.each(errors.errors, function(index, value) {

                                        index = index.replace(/\./g, '_');
                                        $(`#${index}`).addClass('is-invalid');
                                        $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                                        if (flag) {

                                            $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                                            flag = false;
                                        }
                                    });
                                }

                            }, 400);

 
                        }
                    },
                });
            });


           

            $('#delete_all').on('click', function(e) {
                e.preventDefault();
                var checkedValues = $('.child:checked').map((i, e) => e.value).get();

                if (checkedValues.length > 0) {
                    jQuery('#multiple_delete_modal').modal('show');
                } else {
                    alert("Please Check any Record First");
                }

            });

            $('#multiple_delete').on('click', function(e) {
                e.preventDefault();

                var checkedValues = $('.child:checked').map((i, e) => e.value).get();
                var tableName = $('.table-name').val();
                $.ajax({
                    url: REDIRECT_BASEURL + 'multiple-delete/' + checkedValues,
                    type: 'Delete',
                    dataType: "JSON",
                    data: { "checkedValues": checkedValues, "tableName": tableName },
                    beforeSend: function() {
                        $("#multiple_delete").find('span').addClass('spinner-border spinner-border-sm');
                    },
                    success: function(response) {

                        if (response.status == true) {


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
                var checkedValues = $('.child:checked').map((i, e) => e.value).get();
                if (checkedValues.length > 0) {
                    jQuery('#multiple_delete_modal').modal('show');
                    $('.action_name').val(action);
                    $('#multiple_delete').addClass('btn btn-danger');
                    $("#multiple_delete").html(action);
                    $('#multiple_delete').removeClass();
                    $('#multiple_delete').addClass('btn btn-primary');
                    if (action == 'Delete') {
                        $('#multiple_delete').addClass('btn btn-danger');
                    }
                } else {
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

            // booking incremnet and

            $(document).on('click', '.increment', function() {

                var close = $(this).closest('.finance-clonning');

                var valueElement = close.find('.ab_number_of_days');
                var dueDate = close.find('.deposit-due-date').val();
                var nowDate = todayDate();
                const firstDate = new Date(dueDate);
                const secondDate = convertDate(nowDate);

                if (firstDate == 'Invalid Date') {
                    alert('Due Date is Required');
                } else {
                    if (!$(valueElement).is('[readonly]')) {
                        const oneDay = 24 * 60 * 60 * 1000;
                        const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
                        if (firstDate < secondDate) {
                            $(this).attr('disabled', true);
                        } else {
                            if (valueElement.val() == '') {
                                valueElement.val(0);
                            }
                            var count = Math.max(parseInt(valueElement.val() ?? 0));
                            var diffcount = diffDays - valueElement.val();
                            var b = 1;
                            if ($(this).hasClass('plus')) {
                                if (diffcount < 1) {
                                    close.find('.plus').attr('disabled', true);
                                } else {
                                    count = count + b;
                                    valueElement.val(count);
                                }
                            } else if (valueElement.val() > 0) // Stops the value going into negatives
                            {
                                close.find('.plus').attr('disabled', false);
                                count -= b;
                                valueElement.val(count);
                            }
                        }
                    }
                }
                return false;
            });

            // tel input  start
            if ($('.phone').length > 0) {
                for (let i = 0; i < $('.phone').length; i++) {
                    if ($('.phone' + i).length != 0) {
                        intTelinput(i);
                    }
                }
            }

            if ($('#agency_contact').length > 0) {
                intTelinput('gc');
                // console.log(inTelinput);
            }

            //tel input end
            //intl-tel-input ************** Start ******************** //
            function intTelinput(key = null, inVal = null) {
                // console.log(key);
                var input = document.querySelector('.phone' + key);
                var errorMsg = document.querySelector('.error_msg' + key);
                var validMsg = document.querySelector('.valid_msg' + key);
                var iti = intlTelInput(input, {
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
                    separateDialCode: true,
                    formatOnDisplay: true,
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
            $(document).on('change', '.pax-number', function() {

                        $('.nationality-select2').select2('destroy');

                        var $_val = $(this).val();
                        var agencyVal = $('.select-agency:checked').val();

                        var currentDate = curday('-');
                        var countries = $('#content').data('countries');
                        if (agencyVal == $_val) {
                            var count = 1;
                            var $v_html = `
            <div class="mb-1 appendCount" id="appendCount${count}">
                <div class="row" >
                    <div class="col-md-3 mb-2">
                        <label>Passenger #${count} Full Name </label>
                        <input type="text" name="pax[${count}][full_name]" class="form-control" placeholder="Passsenger Name" >
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Email Address </label>
                        <input type="email" name="pax[${count}][email_address]" class="form-control" placeholder="Email Address" >
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Contact Number </label>
                        <input type="tel" name="pax[${count}][contact_number]"  data-key="${count}" class="form-control phone phone${count}" >
                        <span class="text-danger error_msg${count}" role="alert"></span>
                        <span class="text-success valid_msg${count}" role="alert"></span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Date Of Birth </label>
                        <input type="date" max="{{ date('Y-m-d') }}" name="pax[${count}][date_of_birth]" class="form-control" placeholder="Date Of Birth" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Nationality </label>
                        <select name="pax[${count}][nationality_id]"  class="form-control nationality-select2 nationality-id">
                            <option selected value="" >Select Nationality</option>
                            ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <label>Resident In</label>
                        <select name="pax[${count}][resident_in]" class="form-control nationality-select2 resident-id">
                            <option selected value="" >Select Resident</option>
                            ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                        </select>
                        <span class="text-danger" role="alert"></span>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Bedding Preference </label>
                        <input type="text" name="pax[${count}][bedding_preference]" class="form-control" placeholder="Bedding Preferences" >
                    </div>

                    <div class="col-md-3 mb-2">
                        <label>Dietary Preferences </label>
                        <input type="text" name="pax[${count}][dietary_preferences]" class="form-control" placeholder="Dietary Preferences" >
                    </div>

                    <div class="col-md-3 mb-2">
                        <label>Medical Requirements</label>
                        <input type="text" name="pax[${count}][medical_requirement]" class="form-control" placeholder="Medical Requirements">
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Up To Date Covid Vaccination Status </label>
                            <div>
                                <label class="radio-inline">
                                    <input type="radio" name="pax[${count}][covid_vaccinated]" class="covid-vaccinated" value="1" > Yes &nbsp;&nbsp;
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="pax[${count}][covid_vaccinated]" class="covid-vaccinated" value="0" checked> No &nbsp;&nbsp;
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="pax[${count}][covid_vaccinated]" class="covid-vaccinated" value="2" > Not Sure
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>`;

            // console.log($v_html);

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
                            <div class="col-md-12">
                                <button type="button" class=" remove-pax-column mt-2 btn btn-dark float-right"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </div>
                                <div class="col-md-3 mb-2">
                                    <label class="mainLabel">Passenger #${c} Full Name</label>
                                    <input type="text" name="pax[${count}][full_name]" class="form-control" placeholder="PASSENGER FULL NAME" >
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

                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label>Resident In</label>
                                    <select name="pax[${count}][resident_in]" class="form-control nationality-select2 resident-id">
                                        <option selected value="" >Select Resident</option>
                                        ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                                    </select>
                                    <span class="text-danger" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Bedding Preference</label>
                                    <input type="text" name="pax[${count}][bedding_preference]" class="form-control" placeholder="BEDDING PREFERENCES" >
                                </div>

                                <div class="col-md-3 mb-2">
                                    <label>Dietary Preferences</label>
                                    <input type="text" name="pax[${count}][dietary_preferences]" class="form-control" placeholder="Dietary Preferences" >
                                </div>

                                <div class="col-md-3 mb-2">
                                    <label>Medical Requirements</label>
                                    <input type="text" name="pax[${count}][medical_requirement]" class="form-control" placeholder="Medical Requirements">
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Up To Date Covid Vaccination Status </label>
                                        <div>
                                            <label class="radio-inline">
                                                <input type="radio" name="pax[${count}][covid_vaccinated]" class="covid-vaccinated" value="1" > Yes &nbsp;&nbsp;
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="pax[${count}][covid_vaccinated]" class="covid-vaccinated" value="0" checked> No &nbsp;&nbsp;
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="pax[${count}][covid_vaccinated]" class="covid-vaccinated" value="2" > Not Sure
                                            </label>
                                        </div>
                                    </div>
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
        getBookingAmountPerPerson();
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

    $(".bulk-action").submit(function(e) {

        e.preventDefault();

        var url            = $(this).attr('action');
        var checkedValues  = $('.child:checked').map((i, e) => e.value ).get();
        var formData       = $(this).serializeArray();
        var message        = '';

        formData.push({name:'id', value: checkedValues});
        formData.push({name:'btn', value: btnname});

        switch(btnname) {
            case "archive":
                message = 'Are you sure you want to Archive Quotes?'
                break;
            case "unarchive":
                message = 'Are you sure you want to Revert Quotes from Archive?'
                break;
            case "quote":
                message = 'Are you sure you want to Revert Cancelled Quotes?';
                break;
            case "cancel":
                message = 'Are you sure you want to Cancel Quotes?';
        }

        if(checkedValues.length > 0){
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: `Yes`,
                confirmButtonColor: '#5cb85c',
                cancelButtonText: 'No',
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
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
        // console.log('run');
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


//////////// quote media modal close
$(document).on('click', '.QuotemediaModalClose', function () {
    $(this).closest('.modal-body').children('.input-group').find('input').val("");
    $(this).closest('.modal-body').children('.previewId').find('img').remove();
    jQuery('.modal').modal('hide');
});

// remove image work
$(document).on('click', '.remove-img', function () {

    console.log('sadas');
    // $('#previewId').html(`<img src="" class="img-fluid"></img>`);
    $(this).closest('.modal-body').children('.input-group').find('input').val("");
    $(this).parent().html(`<img src="" class="img-fluid">`);


    // console.log($(this).closest('.modal-body').find('.image').html());
});

// $(document).on('click', '#add_storeText', function () {
//     var x = document.getElementById("storedText");
//     if (x.style.display === "none") {
//         x.style.display = "block";
//         $('#selectstoretext').removeAttr('disabled');
//         console.log('show');
//         $(this).text('x Remove Stored Text')
//     } else {
//         console.log('hide');

//         x.style.display = "none";
//         $(this).text('+ Add Stored Text')
//         $('#selectstoretext').attr('disabled', true);

//     }
// })


//////////// quote media modal close

////////////////////// Stored Text

$(document).on('change', '.selectStoredText', function() {

    var slug = $(this).val();
    var quote = jQuery(this).closest('.quote');
    var key = quote.data('key');
    $.ajax({
        url: `${BASEURL}stored/${slug}/text`,
        type: 'get',
        dataType: "json",
        success: function(data) {
            console.log(key);
            var id ='#quote_'+key+'_stored_text';
            setTextEditorValue(id, data);
        },
        error: function(reject) {
            alert(reject);
        },
    });

});

$(document).on('click', '.addmodalforquote', function() {

    var quote = $(this).closest('.quote');
    var key = quote.data('key');
    var target = '.'+$(this).data('show');
    // console.log(target);
    quote.find(target).modal('show');
    quote.find(target+':input').removeAttr('disabled');
    // jQuery('#accomadation_modal').modal('show').find('input').val('');
});

/////////////////// Stored Text End

});

// CreateGroupQuote //
    var checkedQuoteValues = null;
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2200,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    //Create group quote
    $('.createGroupQuote').on('click', function (e) {
        checkedQuoteValues = $('.child:checked').map((i, e) => e.value ).get();

        /*console.log(checkedQuoteValues);
        return false;*/
        if(checkedQuoteValues.length > 1){
            jQuery('#group-quote-modal').modal('show');
        }else{
            alert('Please check atleat two records.');
        }
    });

    $(".create-group-quote").submit(function(e) {
        e.preventDefault();

        var url            = $(this).attr('action');
        /*var formData       = $(this).serializeArray();
        formData.push({name:'quote_ids', value: checkedQuoteValues});*/

        $.ajax({
            type: "POST",
            url: url,
            // data: $.param(formData),
            data: [$(this).serialize(),$.param({quote_ids: checkedQuoteValues})].join('&'),
            success: function(data)
            {
                // console.log(data);
                // return false;
                if(data.status) {
                    jQuery('#group-quote-modal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    });
                    setTimeout(function(){
                        window.location.href = data.redirect;
                    }, 2800);

                } else {
                    new Swal(data.type, data.msg, data.icon);
                }
            }
        });
    });

$(".add-new-group-quote").submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function (data) {
            if (data.status) {
                Toast.fire({
                    icon: 'success',
                    title: data.msg
                });
                setTimeout(function () {
                    window.location.href = data.redirect;
                }, 2800);

            } else {
                new Swal(data.type, data.msg, data.icon);
            }
        }
    });
});


    // $(document).ready(function() {
    //    setTimeout(function() {
    //        jQuery('.alert-success').fadeOut(1500);
    //        jQuery('.alert-danger').fadeOut(1500);
    //     }, 3000);
    //     $('.booking-currency-id').on('change', function() {
    //         let url = $('#routeForGroups').val() + '/' + $(this).val();

    //         console.log(url);

    //         $.ajax({
    //             type: "GET",
    //             url: url,
    //             success:function(response) {
    //                 if(response.status) {
    //                     $('.dynamic-group').empty();
    //                     $.each(response.groups, function(value, key) {
    //                         $('.dynamic-group').append($("<option></option>").attr("value", key.id).text(key.name));
    //                     });
    //                     $('.dynamic-group').select2();
    //                 }
    //             }
    //         });
    //     });
    // });
