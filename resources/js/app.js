import $ from 'jquery';
window.jQuery = $;
window.$ = $;
window.Swal = require('sweetalert2');

import 'jquery-ui/ui/widgets/sortable.js';
import select2 from 'select2';
import intlTelInput from 'intl-tel-input';
// import Swal from 'sweetalert2';
import datepicker from 'bootstrap-datepicker';
import daterangepicker from 'daterangepicker';
import { result } from 'lodash';

require('./global_variables');
require('./asset/laravel_filemanager/stand-alone-button');
require('./asset/summernote/summernote-bs4.min');
require('./asset/bootstrap/bootstrap.bundle.min');
require('./asset/adminlte/adminlte');
require('./asset/intl_tel_input/utils');

$(document).ready(function($) {

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
 

    window.calltextEditorSummerNote = function(val = null) {

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

    window.setTextEditorValue = function(id, Text) {
        $(id).summernote('code', Text);
    }


    // function formatState(option) {
    window.formatState = function(option) {
        var optionImage = $(option.element).attr('data-image');
        if (!optionImage) {
            return option.text;
        }

        return $(`<span><img height="19" width="19" src="${optionImage}" class="option-flag-image" />${option.text}</span>`);
    };

    window.reinitializedSingleSelect2 = function() {
        $('.select2single').select2({
            width: '100%',
            theme: "bootstrap",
            templateResult: formatState,
            templateSelection: formatState,
        });
    }

    window.reinitializedMultipleSelect2 = function() {
        $('.select2-multiple').select2({
            width: '100%',
            theme: "classic",
            templateResult: formatState,
            templateSelection: formatState,
        });
    }

    window.destroySingleSelect2 = function() {
        if ($('.select2single').data('select2')) {
            $('.select2single').select2('destroy');
        }
    }

    window.destroyMultipleSelect2 = function() {
        if ($('.select2-multiple').data('select2')) {
            $('.select2-multiple').select2('destroy');
        }
    }

    window.disabledFeild = function(p) {
        $(p).attr("disabled", true);
    }

    window.removeDisabledAttribute = function(p) {
        $(p).removeAttr("disabled");
    }

    window.removeSpace = function(string) {
        return string.replace(/\s/g, '');
    }

    /*
    |--------------------------------------------------------------------------
    | Define Global Functions
    |--------------------------------------------------------------------------
    */
    
    window.removeFormValidationStyles = function() {
        $('input, select, textarea').removeClass('is-invalid');
        $('.text-danger').html('');
    }

    window.addFormLoadingStyles = function() {
        $("#overlay").addClass('overlay');
        $(".note-editor").css('border-color', '');
        $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
    }

    window.addModalFormLoadingStyles = function(formSelector) {

        $(`${formSelector} button[type="submit"]`).find('span').addClass(`mr-2 spinner-border spinner-border-sm`);
    }

    window.removeModalFormLoadingStyles = function(formSelector) {

        setTimeout(function() {

            $(`${formSelector} button[type="submit"]`).find('span').removeClass(`spinner-border spinner-border-sm`);
        }, 250);

    }

    window.removeFormLoadingStyles = function() {
        setTimeout(function() {
            $("#overlay").removeClass('overlay');
            $("#overlay").html('');
        }, 250);
    }

    window.printServerValidationErrors = function(response) {

        if (response.status === 422) {

            let errors = response.responseJSON;
            let flag   = true;

            setTimeout(function() {
                jQuery.each(errors.errors, function(index, value) {

                    index = index.replace(/\./g, '_');

                    /* Expand Quote Details Card */
                    
                    let closestQuote = $(`#${index}`).closest('.quote');

                    closestQuote.removeClass('collapsed-card');
                    closestQuote.find('.card-body').css("display", "block");
                    closestQuote.find('.collapse-expand-btn').html(`<i class="fas fa-minus"></i>`);

                    /* --------------------------------  */

                    $(`#${index}`).addClass('is-invalid');
                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                    $(`#${index}`).closest('.form-group').find('.note-editor').css('border-color', 'red');

                    if(flag){
                        $('html, body').animate({ scrollTop: $(`#${index}`).parent('.form-group').offset().top }, 1000);
                        // $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                        flag = false;
                    }
                });

            }, 250);

        }
    }

    window.printServerSuccessMessage = function(data, formSelector) {

        if(data && data.status){

            $(`${formSelector}`)[0].reset();

            Toast.fire({
                icon: 'success',
                title: data.success_message
            });

            setTimeout(function() {
                window.location.href = data.redirect_url;
            }, 2500);
        }
    }

    window.printListingSuccessMessage = function(response) {

        if(response && response.status){
            
            $("#listing_card_body").load(`${location.href} #listing_card_body`);
    
            Toast.fire({
                icon: 'success',
                title: response.message
            });
            
            setTimeout(function() {
                // location.reload();
            }, 2500);
        }

        if(response && !response.status){

            $("#listing_card_body").load(`${location.href} #listing_card_body`);
    
            Toast.fire({
                icon: 'error',
                title: response.message
            });
            
            setTimeout(function() {
                // location.reload();
            }, 2500);
        }

    }

    window.printListingErrorMessage = function(message) {

        Toast.fire({
            icon: 'error',
            title: message
        });
    }

    window.validateSameCurrencies = function (currencyArray) {

        var unique = currencyArray.filter((v, i, a) => a.indexOf(v) === i);

        if(unique.length === 1){
            return true;
        }else{
            return false;
        }
    }

    window.printModalServerSuccessMessage = function(response, modalSelector) {

        if(response && response.status){

            $(`${modalSelector}`).modal('hide');

            $("#listing_card_body").load(`${location.href} #listing_card_body`);

            Toast.fire({
                icon: 'success',
                title: response.success_message
            });

            /* Reload page if you are on edit page */
            if(CURRENT_ROUTE_NAME.includes('edit')){
                setTimeout(function() {
                    location.reload();
                }, 2500);
            }
        }
    }

    window.printModalServerValidationErrors = function(response) {

        if (response.status === 422) {

            let errors = response.responseJSON;

            setTimeout(function() {
                jQuery.each(errors.errors, function(index, value) {

                    index = index.replace(/\./g, '_');

                    $(`#${index}`).addClass('is-invalid');
                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                    $(`#${index}`).closest('.form-group').find('.note-editor').css('border-color', 'red');
                });

            }, 250);

        }
    }

    window.printAlertResponse = function(response) {


        console.log(response.status);
        
        if(response && response.status){

            $("#listing_card_body").load(`${location.href} #listing_card_body`);

            Toast.fire({
                icon: 'success',
                title: response.success_message
            });

            /* Reload page if you are on edit page */
            if(CURRENT_ROUTE_NAME.includes('edit')){
                setTimeout(function() {
                    location.reload();
                }, 2500);
            }
        }

        if(response && !response.status){

            Toast.fire({
                icon: 'error',
                title: response.error_message
            });
        }
    }

    window.curday = function(sp) {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //As January is 0.
        var yyyy = today.getFullYear();
        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;
        return (yyyy + sp + mm + sp + dd);
    };

    window.todayDate = function() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        return today = dd + '/' + mm + '/' + yyyy;
    }

    window.check = function(x) {

        if (isNaN(x) || !isFinite(x)) {
            return parseFloat(0).toFixed(2);
        }

        return parseFloat(x).toFixed(2);
    }

    window.checkForInt = function(x) {

        if (isNaN(x) || !isFinite(x)) {
            return '';
        }

        return parseInt(x);
    }

    window.isEmpty = function(value) {
        return (value == null || value == '' || value == 'undefined' ? 'N/A' : value);
    }

    window.datepickerReset = function(key = null, quoteClass) {

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

    //tel input end
    //intl-tel-input ************** Start ******************** //
    // function intTelinput(key = null, inVal = null) {
    window.intTelinput = function(key = null, inVal = null) {

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

    /*
    |--------------------------------------------------------------------------
    | Invoke Global Functions
    |--------------------------------------------------------------------------
    */
    
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

    // $('.nationality-select2').select2({
    //     width: '100%',
    //     theme: "bootstrap",
    //     templateResult: formatState,
    //     templateSelection: formatState,
    // });

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

    $('.summernote').summernote({
        height: 70,   //set editable area's height
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

    /*---------------------------------------------------------------------------------------*/
 
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
        // $('.expand-collapse-quote-detail-cards').removeClass('d-none');
    });

    $(document).on('click', '.compare-expand-all-btn', function(event) {
        $('#compare_parent .card').removeClass('collapsed-card');
        $('#compare_parent .card-body').css("display", "block");
        $('#compare_parent .compare-collapse-expand-btn').html(`<i class="fas fa-minus"></i>`);
    });

    $(document).on('click', '.compare-expand-collapse-quote-detail-cards', function(event) {

        $('#compare_parent .card').addClass('collapsed-card');
        $('#compare_parent .card-body').css("display", "none");
        $('#compare_parent .compare-collapse-expand-btn').html(`<i class="fas fa-plus"></i>`);
    });

    /**
     * -------------------------------------------------------------------------------------
     *                                Quote Manangement
     * -------------------------------------------------------------------------------------
     */

    $(document).on('click', '.parent-row', function(e) {
        var parentID = $(this).data('id');
        $(`#child-row-${parentID}`).hasClass('d-none') ? $(`#child-row-${parentID}`).removeClass('d-none') : $(`#child-row-${parentID}`).addClass('d-none');
        $(this).html($(this).html() == `<span class="fa fa-minus"></span>` ? `<span class="fa fa-plus"></span>` : `<span class="fa fa-minus"></span>`);
    });

    $(".readonly").keypress(function(evt) {
        evt.preventDefault();
    });

    $(".collapse-all-btn").removeAttr('disabled');
    $(".expand-all-btn").removeAttr('disabled');

            // transfer report
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

 
            // transfer report
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
                reinitializedMultipleSelect2();
            });

            // transfer report
            $(document).on('click', '.remove-col', function() {
                $(this).closest('.filter-col').remove();
            });

            $(document).on('click', '.parent', function() {

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

            // Supplier Bulk Payments
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

            // Supplier Bulk Payments
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

            // Supplier Bulk Payments
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

            // Supplier Bulk Payments
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





    var btnname = null;
    //BUlk DATA DELETE
    $('.btnbulkClick').on('click', function (e) {
        btnname = $(this).attr('name');
    })


    // var bulkActionType = null;




    // $(document).on('submit', '#update_role', function(event) {  
    // });

    // $(".bulk-action").submit(function(e) {

    //     e.preventDefault();

    //     var url            = $(this).attr('action');
    //     var checkedValues  = $('.child:checked').map((i, e) => e.value ).get();
    //     var formData       = $(this).serializeArray();
    //     var message        = '';

    //     formData.push({name:'id', value: checkedValues});
    //     formData.push({name:'btn', value: btnname});

    //     switch(btnname) {
    //         case "archive":
    //             message = 'Are you sure you want to Archive Quotes?'
    //             break;
    //         case "unarchive":
    //             message = 'Are you sure you want to Revert Quotes from Archive?'
    //             break;
    //         case "quote":
    //             message = 'Are you sure you want to Revert Cancelled Quotes?';
    //             break;
    //         case "cancel":
    //             message = 'Are you sure you want to Cancel Quotes?';
    //     }

    //     if(checkedValues.length > 0){
    //         Swal.fire({
    //             title: 'Are you sure?',
    //             text: message,
    //             focusConfirm: false,
    //             showCancelButton: true,
    //             confirmButtonText: `Yes`,
    //             confirmButtonColor: '#5cb85c',
    //             cancelButtonText: 'No',
    //             showLoaderOnConfirm: true,
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 $.ajax({
    //                     type: "PUT",
    //                     url: url,
    //                     data: $.param(formData),
    //                     success: function(data)
    //                     {
    //                         setTimeout(function() {
    //                             alert(data.message);
    //                             location.reload();
    //                         }, 600);
    //                     }
    //                 });
    //             } else if (result.dismiss === Swal.DismissReason.cancel) {
    //                 ///no action here
    //             }
    //         })
    //     }else{
    //         alert('Please Check any Record First');
    //     }
    // });

    /// Update Currency Status
    // $("#currencyStatus").submit(function(e) {
    //     e.preventDefault();
    //     // console.log('run');
    //     var url = $(this).attr('action');
    //     var checkedValues  =  $('.child:checked').map((i, e) => e.value ).get();
    //     var formData = $(this).serializeArray();
    //     formData.push({name:'id', value: checkedValues});
    //     formData.push({name:'btn', value: btnname});
    //     var message = 'Are you sure you want to inactive this records?'
    //     if(btnname == 'active'){
    //         message = 'Are you sure you want to active this records?'
    //     }
    //     if(checkedValues.length > 0){
    //         Swal.fire({
    //             title: 'Are you sure?',
    //             text: message,
    //             focusConfirm: false,
    //             showCancelButton: true,
    //             confirmButtonText: 'Yes, '+btnname+' it!',
    //             confirmButtonColor: '#5cb85c',
    //             cancelButtonText: 'No, keep it',
    //             showLoaderOnConfirm: true,
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 $.ajax({
    //                     type: "POST",
    //                     url: url,
    //                     data: $.param(formData),
    //                     success: function(data)
    //                     {
    //                         setTimeout(function() {
    //                             alert(data.message);
    //                             location.reload();
    //                         }, 600);
    //                     }
    //                 });
    //             } else if (result.dismiss === Swal.DismissReason.cancel) {
    //                 ///no action here
    //             }
    //         })
    //     }else{
    //         alert('Please Check any Record First');
    //     }
    // });
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


// remove image work


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
    // window.Toast = Swal.mixin({
    //     toast: true,
    //     position: 'top-end',
    //     showConfirmButton: false,
    //     timer: 2200,
    //     timerProgressBar: true,
    //     didOpen: (toast) => {
    //       toast.addEventListener('mouseenter', Swal.stopTimer)
    //       toast.addEventListener('mouseleave', Swal.resumeTimer)
    //     }
    // });

    window.Toast = Swal.mixin({
        toast: true,
        icon: 'success',
        position: 'top-right',
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

    // $(".create-group-quote").submit(function(e) {
    //     e.preventDefault();

    //     var url            = $(this).attr('action');
    //     /*var formData       = $(this).serializeArray();
    //     formData.push({name:'quote_ids', value: checkedQuoteValues});*/

    //     $.ajax({
    //         type: "POST",
    //         url: url,
    //         // data: $.param(formData),
    //         data: [$(this).serialize(),$.param({quote_ids: checkedQuoteValues})].join('&'),
    //         success: function(data)
    //         {
    //             // console.log(data);
    //             // return false;
    //             if(data.status) {
    //                 jQuery('#group-quote-modal').modal('hide');
    //                 Toast.fire({
    //                     icon: 'success',
    //                     title: data.msg
    //                 });
    //                 setTimeout(function(){
    //                     window.location.href = data.redirect;
    //                 }, 2800);

    //             } else {
    //                 new Swal(data.type, data.msg, data.icon);
    //             }
    //         }
    //     });
    // });



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
