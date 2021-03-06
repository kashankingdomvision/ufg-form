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
            url: `${BASEURL}get-currency-conversions`,
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
        var totalSellingPriceInBookingCurrency = removeComma($(".total-selling-price").val());
        var bookingAmountPerPerson = parseFloat(totalSellingPriceInBookingCurrency) / parseFloat(paxNumber);

        $('.booking-amount-per-person').val(check(bookingAmountPerPerson));
    }

    window.getBookingAmountPerPersonInOtherSellingPrice = function() {

        let paxNumber                     = $(".pax-number").val();
        let sellingPriceOtherCurrencyRate = removeComma($('.selling-price-other-currency-rate').val());
        let bookingAmountPerPersonInOtherSellingPrice = parseFloat(sellingPriceOtherCurrencyRate) / parseFloat(paxNumber);

        $('.booking-amount-per-person-in-osp').val(check(bookingAmountPerPersonInOtherSellingPrice));
    }

    window.getCommissionAmountInSalePersonCurrency = function() {

        let rateType           = $('input[name="rate_type"]:checked').val();
        let commissionAmount   = removeComma($('.commission-amount').val());
        let bookingCurrency    = $(".booking-currency-id").find(':selected').data('code');
        let salePersonCurrency = $(".sale-person-currency-id").data('currency_code');

        let rate = getRate(bookingCurrency, salePersonCurrency, rateType);

        let commissionAmountInSalePersonCurrency = parseFloat(commissionAmount) * parseFloat(rate);
        $('.commission-amount-in-sale-person-currency').val(check(commissionAmountInSalePersonCurrency));
    }


    window.getSellingPrice = function() {

        var sellingPriceOtherCurrency = $('.selling-price-other-currency').val();

        if (sellingPriceOtherCurrency) {

            var rateType                      = $('input[name="rate_type"]:checked').val();
            var bookingCurrency               = $(".booking-currency-id").find(':selected').data('code');
            var totalSellingPrice             = removeComma($('.total-selling-price').val());
            var rate                          = getRate(bookingCurrency, sellingPriceOtherCurrency, rateType);
            var sellingPriceOtherCurrencyRate = parseFloat(totalSellingPrice) * parseFloat(rate);

            $('.selling-price-other-currency-rate').val(check(sellingPriceOtherCurrencyRate));
            $('.selling-price-other-currency-code').val(check(sellingPriceOtherCurrencyRate));

            getBookingAmountPerPersonInOtherSellingPrice();
        }

        if (sellingPriceOtherCurrency == '') {
            $('.selling-price-other-currency-rate').val('0.00');
            $('.selling-price-other-currency-code').val('');
        }
    }

    window.getCommissionRate = function() {

        var calculatedCommisionAmount = 0;
        var commissionObject          = {};
        var agency                    = $("input[name=agency]:checked").val();
        var agencyCommissionType      = $("input[name=agency_commission_type]:checked").val();
        var netValue                  = removeComma($('.total-markup-amount').val());
        var brandID                   = $('.brand-id').val();
        var holidayTypeID             = $('.holiday-type-id').val();
        var currencyID                = $('.booking-currency-id').val();
        var seasonID                  = $('.season-id').val();

        if(agency == 1 && agencyCommissionType == 'paid-net-of-commission' || agency == 1 && agencyCommissionType == 'we-pay-commission-on-departure'){
            netValue = removeComma($('.total-net-margin').val());
        }

        if (brandID && holidayTypeID && currencyID && seasonID){

            commissionObject          = getCommissionPercent(brandID, holidayTypeID, currencyID, seasonID);
            calculatedCommisionAmount = parseFloat(netValue / 100) * parseFloat(commissionObject.commissionPercentage);

            if(parseFloat(commissionObject.commissionPercentage) > 0.00){
                $('.badge-commission-name').text(commissionObject.commissionName);
                $('.badge-commission-percentage').text(`${commissionObject.commissionPercentage} %`);
                // $('.badge-commission-group-name').text(commissionNames.commissionGroupName);
            }else{
                resetCommissionNameFeilds();
            }

        } else {
            calculatedCommisionAmount = 0.00;
            resetCommissionNameFeilds();
        }

        $('.commission-criteria-id').val(commissionObject.criteriaID);
        $('.commission-percentage').val(check(commissionObject.commissionPercentage));
        $('.commission-amount').val(check(calculatedCommisionAmount));

        getCommissionAmountInSalePersonCurrency();
    }

    window.getRate = function(fromCurrency, toCurrency, rateType) {

        var object = currencyConvert.filter(function(elem) {
            return elem.from == fromCurrency && elem.to == toCurrency
        });

        return (object.shift()[rateType]);
    }

    window.onChangeAgencyCommissionType = function() {

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

    window.getCalculatedTotalNetMarkup = function() {

        var agencyCommission     = removeComma($('.agency-commission').val());
        var agencyTotalMarkup    = removeComma($('.total-markup-amount').val());
        var totalAgencyNetMarkup = parseFloat(agencyTotalMarkup) - parseFloat(agencyCommission);

        $('.total-net-margin').val(check(totalAgencyNetMarkup));
    }

    window.getBookingRateTypeValues = function() {

        var rateType          = $("input[name=rate_type]:checked").val();
        var actualCostArray   = $(".actual-cost").map((i, e) => parseFloat(removeComma(e.value))).get();
        var sellingPriceArray = $(".selling-price").map((i, e) => parseFloat(removeComma(e.value))).get();
        var markupAmountArray = $(".markup-amount").map((i, e) => parseFloat(removeComma(e.value))).get();
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

    window.getBookingTotalValues = function() {


        var markupType                       = $("input[name=markup_type]:checked").val();
        var actualCostInBookingCurrencyArray = $(".actual-cost-in-booking-currency").map((i, e) => parseFloat(removeComma(e.value))).get();
        var actualCostInBookingCurrency      = actualCostInBookingCurrencyArray.reduce((a, b) => (a + b), 0);
        $(".total-net-price").val(check(actualCostInBookingCurrency));

        if(markupType == 'itemised'){
            var sellingPriceInBookingCurrencyArray = $(".selling-price-in-booking-currency").map((i, e) => parseFloat(removeComma(e.value))).get();
            var sellingPriceInBookingCurrency      = sellingPriceInBookingCurrencyArray.reduce((a, b) => (a + b), 0);

            var markupAmountInBookingCurrencyArray = $(".markup-amount-in-booking-currency").map((i, e) => parseFloat(removeComma(e.value))).get();
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

            // $(".total-markup-amount").val(parseFloat(0).toFixed(2));
            // $(".total-markup-percent").val(parseFloat(0).toFixed(2));
            // $(".total-profit-percentage").val(parseFloat(0).toFixed(2));

            let totalMarkupAmount = removeComma($(".total-markup-amount").val());
            let sellingPriceInBookingCurrency = parseFloat(actualCostInBookingCurrency) + parseFloat(totalMarkupAmount);
            $(".total-selling-price").val(check(sellingPriceInBookingCurrency));
        }

        onChangeAgencyCommissionType();
        getCommissionRate();
        getBookingAmountPerPerson();
        getSellingPrice();
    }

    window.getBookingBookingCurrencyValues = function() {

        var rateType              = $("input[name=rate_type]:checked").val();
        var actualCostArray       = $(".actual-cost").map((i, e) => parseFloat(removeComma(e.value))).get();
        var sellingPriceArray     = $(".selling-price").map((i, e) => parseFloat(removeComma(e.value))).get();
        var markupAmountArray     = $(".markup-amount").map((i, e) => parseFloat(removeComma(e.value))).get();
        var bookingCurrency       = $(".booking-currency-id").find(":selected").data("code");
        var supplierCurrencyArray = $(".booking-supplier-currency-id").map((i, e) => $(e).find(":selected").data("code")).get();
        var quoteSize = parseInt($(".quote").length);
        var calculatedActualCostInBookingCurrency   = 0;
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


    function resetCommissionNameFeilds(){
        $('.badge-commission-name').text('');
        $('.badge-commission-group-name').text('');
        $('.badge-commission-percentage').text('');
    }

    function getCommissionPercent(brandID, holidayTypeID, currencyID, seasonID){

        let criteriaID = '';
        let criteriaName = '';
        let criteriaPercentage = 0.00;

        var object = commissionCriteriaRates.filter(function(elem) {
            return elem.brand_id == brandID && elem.holiday_type_id == holidayTypeID && elem.currency_id == currencyID && elem.season_id == seasonID
        });

        if(object.length > 0) {
            criteriaID         = object[0].id;
            criteriaName       = object[0].name;
            criteriaPercentage = object[0].percentage;
        }

        return { 
            criteriaID           : criteriaID,
            commissionName       : criteriaName,
            commissionPercentage : criteriaPercentage,
        }
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

        var rateType              = $("input[name=rate_type]:checked").val();
        var estimatedCostArray    = $(".estimated-cost").map((i, e) => parseFloat(removeComma(e.value))).get();
        var sellingPriceArray     = $(".selling-price").map((i, e) => parseFloat(removeComma(e.value))).get();
        var markupAmountArray     = $(".markup-amount").map((i, e) => parseFloat(removeComma(e.value))).get();
        var bookingCurrency       = $(".booking-currency-id").find(":selected").data("code");
        var supplierCurrencyArray = $(".supplier-currency-id").map((i, e) => $(e).find(":selected").data("code")).get();
        var quoteSize             = parseInt($('.quote').length);
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
                calculatedSellingPriceInBookingCurrency  = parseFloat(sellingPrice) * parseFloat(rate);
                calculatedMarkupAmountInBookingCurrency  = parseFloat(markupAmount) * parseFloat(rate);

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

    $(document).on('change', '.pax-number', function() {

        destroySingleSelect2();

        var $_val       = $(this).val();
        var agencyVal   = $('.select-agency:checked').val();
        var currentDate = curday('-');
        var countries   = $('#content').data('countries');

        if (agencyVal == $_val) {
            var count = 1;
            var $v_html = `
            <div class="mb-1 appendCount border rounded p-3 mb-1" id="appendCount${count}">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Passenger #${count} Full Name </label>
                            <input type="text" name="pax[${count}][full_name]" class="form-control" placeholder="Passsenger Name" >
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Email Address </label>
                            <input type="email" name="pax[${count}][email_address]" class="form-control" placeholder="Email Address" >
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Contact Number </label>
                            <input type="tel" name="pax[${count}][contact_number]"  data-key="${count}" class="form-control phone phone${count}" >
                            <span class="text-danger error_msg${count}" role="alert"></span>
                            <span class="text-success valid_msg${count}" role="alert"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date Of Birth </label>
                            <input type="date" max="{{ date('Y-m-d') }}" name="pax[${count}][date_of_birth]" class="form-control" placeholder="Date Of Birth" >
                        </div>
                    </div>
    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nationality </label>
                            <select name="pax[${count}][nationality_id]" class="form-control select2single nationality-id">
                                <option selected value="">Select Nationality</option>
                                ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Resident In</label>
                            <select name="pax[${count}][resident_in]" class="form-control select2single resident-id">
                                <option selected value="" >Select Resident</option>
                                ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                            </select>
                            <span class="text-danger" role="alert"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Bedding Preference </label>
                            <input type="text" name="pax[${count}][bedding_preference]" class="form-control" placeholder="Bedding Preferences" >
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Dietary Preferences </label>
                            <input type="text" name="pax[${count}][dietary_preferences]" class="form-control" placeholder="Dietary Preferences" >
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Medical Requirements</label>
                            <input type="text" name="pax[${count}][medical_requirement]" class="form-control" placeholder="Medical Requirements">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Up To Date Covid Vaccination Status </label>
                            <div class="d-flex flex-row">

                                <div class="custom-control custom-radio mr-1">
                                    <input type="radio" name="pax[${count}][covid_vaccinated]" id="pax_cv_yes_${count}" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="1" >
                                    <label class="custom-control-label" for="pax_cv_yes_${count}"> Yes </label>
                                </div>

                                <div class="custom-control custom-radio mr-1">
                                    <input type="radio" name="pax[${count}][covid_vaccinated]" id="pax_cv_no_${count}" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="0" checked> 
                                    <label class="custom-control-label" for="pax_cv_no_${count}">No </label>
                                </div>

                                <div class="custom-control custom-radio mr-1">
                                    <input type="radio" name="pax[${count}][covid_vaccinated]" id="pax_cv_not_sure_${count}" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="2" > 
                                    <label class="custom-control-label" for="pax_cv_not_sure_${count}">Not Sure</label>
                                </div>
                            </div>
                        </div>
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
                <div class="mb-1 appendCount border rounded p-3 mb-1" id="appendCount${count}">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="remove-pax-column btn btn-sm btn-dark float-right"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="mainLabel">Passenger #${c} Full Name</label>
                                <input type="text" name="pax[${count}][full_name]" class="form-control" placeholder="Passsenger Name">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="pax[${count}][email_address]" class="form-control" placeholder="Email Address">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="tel" name="pax[${count}][contact_number]" data-key="${count}" class="form-control phone phone${count}">
                                <span class="text-danger error_msg${count}" role="alert"></span>
                                <span class="text-success valid_msg${count}" role="alert"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date Of Birth</label>
                                <input type="date" max="{{ date('Y-m-d') }}" name="pax[${count}][date_of_birth]" class="form-control" placeholder="Date Of Birth">
                            </div>
                        </div>
    
                        <div class="col-md-3">
                            <label>Nationality</label>
                            <select name="pax[${count}][nationality_id]" class="form-control select2single nationality-id">
                                <option selected value="" >Select Nationality</option>
                                ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                            </select>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Resident In</label>
                                <select name="pax[${count}][resident_in]" class="form-control select2single resident-id">
                                    <option selected value="" >Select Resident</option>
                                    ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                                </select>
                                <span class="text-danger" role="alert"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Bedding Preference</label>
                                <input type="text" name="pax[${count}][bedding_preference]" class="form-control" placeholder="Bedding Preferences" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Dietary Preferences</label>
                                <input type="text" name="pax[${count}][dietary_preferences]" class="form-control" placeholder="Dietary Preferences" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Medical Requirements</label>
                                <input type="text" name="pax[${count}][medical_requirement]" class="form-control" placeholder="Medical Requirements">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Up To Date Covid Vaccination Status </label>
                                <div class="d-flex flex-row">

                                    <div class="custom-control custom-radio mr-1">
                                        <input type="radio" name="pax[${count}][covid_vaccinated]" id="pax_cv_yes_${count}" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="1">
                                        <label class="custom-control-label" for="pax_cv_yes_${count}">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio mr-1">
                                        <input type="radio" name="pax[${count}][covid_vaccinated]" id="pax_cv_no_${count}" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="0" checked>
                                        <label class="custom-control-label" for="pax_cv_no_${count}">No</label>
                                    </div>

                                    <div class="custom-control custom-radio mr-1">
                                        <input type="radio" name="pax[${count}][covid_vaccinated]" id="pax_cv_not_sure_${count}" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="2">
                                        <label class="custom-control-label" for="pax_cv_not_sure_${count}">Not Sure</label>
                                    </div>

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

        reinitializedSingleSelect2();
        
        getBookingAmountPerPerson();
        getBookingAmountPerPersonInOtherSellingPrice();
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

    /* Hide Potentail Commission for another Behalf User */
    $(document).on('change', '.sales-person-id', function() {

        var salesPersonID = $(this).val();

        /* Hide Staff Commission Code */

        // var userID        = $('.user-id').val();

        // if (typeof salesPersonID === 'undefined' || salesPersonID == "") {
        //     return;
        // }

        // if(salesPersonID != userID){
        //     $('#potential_commission_feild').addClass('d-none');
        // }

        // if(salesPersonID == userID){
        //     $('#potential_commission_feild').removeClass('d-none');
        // }

        /* Hide Staff Commission Code */

        $.ajax({
            type: 'get',
            url: `${BASEURL}sales-person-on-change`,
            data: {
                'sales_person_id': salesPersonID,
            },
            success: function (response) {

                if(response && response.supervisor != null){
                    $('.supervisor-id').val(response.supervisor.id).change();
                }

                if(response && response.sale_person_currency != null){
                    
                    $('.sale-person-currency-code').html(response.sale_person_currency.code);
                    $('.sale-person-currency-id').val(response.sale_person_currency.id);
                    $('.sale-person-currency-id')
                        .attr('data-currency_code', response.sale_person_currency.code)
                        .data('currency_code', response.sale_person_currency.code);
                }

                getCommissionAmountInSalePersonCurrency();

            }
        });
    });
          
    $(document).on('change', '.view-rate-booking-currency-filter', function(){

        var selectedCurrencies = $(this).val();
        var url                = `${BASEURL}get-filter-currency-rate`;
    
        $.ajax({
            type: 'get',
            url: url,
            data: { 'selected_currencies': selectedCurrencies },
            success: function(response){
                $('#currency_conversions').html(response);
            }
        });
    
    });


    function findReferenceData(reference_no) {

        $.ajax({
            headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
            url: `${BASEURL}find/reference`,
            data: { ref_no: reference_no },
            type: 'POST',
            dataType: "json",
            beforeSend: function() {
                $(".search-reference-btn").find('span').addClass('spinner-border spinner-border-sm');
            },
            success: function(data) {

                let response      = data.response;
                let leadPassenger = data.response.lead_passenger;
                let brand         = data.response.brand;

                if(response){

                    /* Lead Passenger */
                    if(leadPassenger.name != null){
                        $('#lead_passenger_name').val(leadPassenger.name);
                    }

                    if (leadPassenger.email  != null) {
                        $('#lead_passenger_email').val(leadPassenger.email);
                    }

                    if (leadPassenger.phone !== null) {

                        $('#lead_passenger_contact').val('');
                        
                        var input = document.querySelector('#lead_passenger_contact');
                        input.classList.remove("is-valid");

                        var validMsg = document.querySelector('.valid_msg0');
                        validMsg.innerHTML = "";

                        var errorMsg = document.querySelector('.error_msg0');
                        errorMsg.innerHTML = "";

                        var iti = intlTelInput(input, {
                            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
                            separateDialCode: true,
                            preferredCountries:["gb","us","au","ca","nz"],
                            formatOnDisplay: true,
                            initialCountry: "US",
                            nationalMode: true,
                            hiddenInput: "full_number",
                            autoPlaceholder: "polite",
                            placeholderNumberType: "MOBILE",
                        });

                        iti.setNumber(leadPassenger.phone.replace(/^0+/, '+'));

                        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

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
                                console.log(errorCode);
                                errorMsg.innerHTML = errorMap[errorCode];
                                errorMsg.classList.remove("hide");
                            }
                        }

                    }

                    if (response.tas_ref !== null) {
                        $("#tas_ref").val(response.tas_ref);
                    }

                    if (brand.hasOwnProperty('brand_id') && brand.brand_id !== null) {
                        $('#brand_id').val(brand.brand_id).change();
                    }

                    if (brand.hasOwnProperty('name') && brand.name !== null) {
                        setTimeout(function() {
                            $("#holiday_type_id option:contains(" + brand.name + ")").attr('selected', 'selected').change();
                            // $("#holiday_type_id option[data-value='" + data.response.brand.name +"']").attr("selected","selected");
                        }, 500);
                    }

                    if (response.sale_person !== null) {
                        // $('#sale_person_id').val(data.response.sale_person).trigger('change');
                        $(`#sale_person_id option[data-email="${response.sale_person}"]`).prop('selected','selected').change();
                    }

                    if (response.currency !== null) {
                        $(`#currency_id option[data-code="${response.currency}"]`).prop('selected','selected').change();
                    }
                    
                }


                    // if (data.response.pax) {
                    //     $('#pax_no').val(data.response.pax).trigger('change');
                    // }


                      // if (data.response.passengers && data.response.passengers.hasOwnProperty('lead_passenger') && data.response.passengers.lead_passenger.hasOwnProperty('passenger_name')) {
                    //     $('#lead_passenger_name').val(data.response.passengers.lead_passenger.passenger_name);
                    // }

                    // if (data.response.passengers && data.response.passengers.hasOwnProperty('lead_passenger') && data.response.passengers.lead_passenger.hasOwnProperty('passenger_email')) {
                    //     $('#lead_passenger_email').val(data.response.passengers.lead_passenger.passenger_email);
                    // }
         
                    // if (data.response.passengers && data.response.passengers.hasOwnProperty('lead_passenger') && data.response.passengers.lead_passenger.hasOwnProperty('passenger_contact')) {
                    //     $('#lead_passenger_contact').val(data.response.passengers.lead_passenger.passenger_contact);
                        
                    //     var input = document.querySelector('#lead_passenger_contact');
                    //     var validMsg = document.querySelector('.valid_msg0');

                    //     var iti = intlTelInput(input, {
                    //         utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
                    //         separateDialCode: true,
                    //         preferredCountries:["gb","us","au","ca","nz"],
                    //         formatOnDisplay: true,
                    //         initialCountry: "US",
                    //         nationalMode: true,
                    //         hiddenInput: "full_number",
                    //         autoPlaceholder: "polite",
                    //         placeholderNumberType: "MOBILE",
                    //     });

                    //     if (input.value.trim()) {
                    //         if (iti.isValidNumber()) {
                    //             $('.buttonSumbit').removeAttr('disabled');
                    //             input.classList.add("is-valid");
                    //             validMsg.innerHTML = 'The number is valid';
                    //         } else {
                    //             $('.buttonSumbit').attr('disabled', 'disabled');
                    //             input.classList.add("is-invalid");
                    //             validMsg.innerHTML = '';
                    //             var errorCode = iti.getValidationError();
                    //             errorMsg.innerHTML = errorMap[errorCode];
                    //             errorMsg.classList.remove("hide");
                    //         }
                    //     }

                    // }

                    // if (data.response.passengers && data.response.passengers.hasOwnProperty('lead_passenger') && data.response.passengers.lead_passenger.hasOwnProperty('dinning_prefrences')) {
                    //     $('#lead_passenger_dietary_preferences').val(data.response.passengers.lead_passenger.dinning_prefrences);
                    // }

                    // if (data.response.passengers && data.response.passengers.hasOwnProperty('lead_passenger') && data.response.passengers.lead_passenger.hasOwnProperty('bedding_prefrences')) {
                    //     $('#bedding_preference').val(data.response.passengers.lead_passenger.bedding_prefrences);
                    // }

                    // Passengers Details
                    // if (data.response.passengers.passengers.length > 0) {
                    //     data.response.passengers.passengers.forEach(($_value, $key) => {
                    //         var $_count = $key + 1;
                    //         $(`input[name="pax[${$_count}][full_name]"]`).val($_value.passenger_name);
                    //         $(`input[name="pax[${$_count}][email_address]"]`).val($_value.passenger_email);
                    //         $(`input[name="pax[${$_count}][contact_number]"]`).val($_value.passenger_contact);
                    //         $(`input[name="pax[${$_count}][date_of_birth]"]`).val($_value.passenger_dbo);
                    //         $(`input[name="pax[${$_count}][bedding_preference]"]`).val($_value.bedding_prefrences);
                    //         $(`input[name="pax[${$_count}][dietary_preferences]"]`).val($_value.dinning_prefrences);
                    //     });
                    // }

           
                $(".search-reference-btn").find('span').removeClass('spinner-border spinner-border-sm');
            },
            error: function(reject) {

                $(".search-reference-btn").find('span').removeClass('spinner-border spinner-border-sm');
                $('#ref_no').closest('.form-group').find('.text-danger').html(reject.responseJSON.errors);

            }
        });
    }

    $(document).on('click', '.search-reference', function() {

        var reference_no = $('.reference-name').val();

        if (reference_no == '') {

            Toast.fire({
                icon: 'error',
                title: 'Reference Number is not found.'
            });

        } else {

            $('#ref_no').closest('.form-group').find('.text-danger').html('');

            //check refrence is already exist in system
            $.ajax({
                headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
                url:  `${BASEURL}is/reference/${reference_no}/exist`,
                type: 'get',
                dataType: "json",
                success: function(data) {

                    if (data.response) {

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "The Reference number is already exists. You want to Create it Again?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#28a745',
                            cancelButtonColor: '#dc3545',
                            confirmButtonText: `Yes, Create it !`,
                        }).then((result) => {

                            if (result.isConfirmed) {
                                findReferenceData(reference_no);
                            }
                        });

                    }else{

                        findReferenceData(reference_no);
                    }

                },
                error: function(reject) {
                    $(".search-reference-btn").find('span').removeClass('spinner-border spinner-border-sm');
                }
            });
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
        $('#new_service_modal').modal('show');
    });

    $(document).on('change', '.season-id', function() {
        getCommissionRate();
    });

    $(document).on('change', '.holiday-type-id', function() {
        getCommissionRate();
    });

    $(document).on('change', '.getBrandtoHoliday', function() {

        let brand_id = $(this).val();
        let options  = '';
        let url      = `${BASEURL}brand-on-change`;

        $.ajax({
            type: 'get',
            url: url,
            data: { 'brand_id': brand_id },
            success: function(response) {
                options += '<option value="">Select Type Of Holiday</option>';
                $.each(response.holiday_types, function(key, value) {
                    options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} </option>`;
                });

                $('.appendHolidayType').html(options);

                /* Brand supplier countries change code */ 
                // $(`.supplier-country-id`).val(response.brand_supplier_countries).change();
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

    $(document).on('change, click', '.agency-commission-type', function() {
        onChangeAgencyCommissionType();
    });

    $(document).on('change', '.agency-commission', function() {
        getCalculatedTotalNetMarkup();
        getCommissionRate();
    });

    $(document).on('change', '#lead_passenger_dbo', function () {
        var dob = $('#lead_passenger_dbo').val();
        ageCheck(dob);
    });

    function ageCheck(dob)
    {
        var today = new Date();
        var birthDate = convertDate(dob);
        var dayDiff = Math.ceil(today.getTime() - birthDate.getTime()) / (1000 * 60 * 60 * 24 * 365);
        var age = parseInt(dayDiff);
        if(age != null){
            if ( age < 18){
                $('#lead_passenger_dbo').parent('.form-group').find('.text-danger').html(`Your age is less than 18 years old`);
            } else{
                $('#lead_passenger_dbo').parent('.form-group').find('.text-danger').html('');
            }
        }
    }

});

// $('.datepicker').datepicker("setDate", '');
