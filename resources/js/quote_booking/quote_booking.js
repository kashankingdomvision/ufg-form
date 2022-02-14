$(document).ready(function() {

    /*
    |--------------------------------------------------------------------------------
    | Database Related Functions
    |--------------------------------------------------------------------------------
    */

    var currencyConvert         = getJson();
    var commissionCriteriaRates = getCommissionCriteriaJson();
    var commissions             = getCommissionJson();
    var commissionGroups        = getCommissionGroupsJson();

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

    function getCommissionCriteriaJson() {
        return JSON.parse($.ajax({
            type: 'GET',
            url: `${BASEURL}get-commission-criteriass`,
            dataType: 'json',
            global: false,
            async: false,
            success: function(data) {
                return data;
            }
        }).responseText);
    }

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

    /*--------------------------------------------------------------------------------*/

    /*
    |--------------------------------------------------------------------------------
    | Other Functions
    |--------------------------------------------------------------------------------
    */

    $('.selling-price-other-currency').select2({
        width: '68%',
        theme: "bootstrap",
        templateResult: formatState,
        templateSelection: formatState,
    });

    window.getBookingAmountPerPerson = function() {

        var paxNumber = parseFloat($(".pax-number").val());
        var totalSellingPriceInBookingCurrency = parseFloat($(".total-selling-price").val());
        var bookingAmountPerPerson = parseFloat(totalSellingPriceInBookingCurrency) / parseFloat(paxNumber);

        $('.booking-amount-per-person').val(check(bookingAmountPerPerson));
    }

    window.getSellingPrice = function() {

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

    window.getCommissionRate = function() {

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

    window.getRate = function(supplierCurrency, bookingCurrency, rateType) {

        var object = currencyConvert.filter(function(elem) {
            return elem.from == supplierCurrency && elem.to == bookingCurrency
        });

        return (object.shift()[rateType]);
    }

    function resetCommissionNameFeilds(){
        $('.badge-commission-name').text('');
        $('.badge-commission-group-name').text('');
        $('.badge-commission-percentage').text('');
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

    /* Hide Potentail Commission for another Behalf User */
    $(document).on('change', '.sales-person-id', function() {
        console.log("sales  salessalessales");

        var salesPersonID = $(this).val();
        var userID        = $('.user-id').val();


        console.log(salesPersonID);
        console.log(userID);


        if(salesPersonID != userID){
            $('#potential_commission_feild').addClass('d-none');
        }

        if(salesPersonID == userID){
            $('#potential_commission_feild').removeClass('d-none');
        }
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

    $(document).on('click', '.search-reference', function() {

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

    $(document).on('change', '.selling-price-other-currency', function() {
        $('.selling-price-other-currency-code').text($(this).val());
        getSellingPrice();
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


    $(document).on('click', '#add_more, #add_more_booking', function(e) {
        jQuery('#new_service_modal').modal('show');
    });

    $(document).on('change', '.season-id', function() {

        getCommissionRate();
        // $('.datepicker').datepicker("setDate", '');
    });

    $(document).on('change', '.holiday-type-id', function() {
        getCommissionRate();
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

    $(document).on('click', '.view-rates', function() {
        jQuery('#view_rates_modal').modal('show');
    });

    $(document).on('change', '.rate-type', function() {

        var status = $(this).attr("data-status");

        if (status && status == 'booking') {
            getBookingRateTypeValues();

        } else {

            getQuoteRateTypeValues();
        }
    });

});