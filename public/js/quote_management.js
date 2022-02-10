/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/quote_booking/quote_booking.js":
/*!*****************************************************!*\
  !*** ./resources/js/quote_booking/quote_booking.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Database Related Functions
  |--------------------------------------------------------------------------------
  */
  var currencyConvert = getJson();
  var commissionCriteriaRates = getCommissionCriteriaJson();
  var commissions = getCommissionJson();
  var commissionGroups = getCommissionGroupsJson();

  function getJson() {
    return JSON.parse($.ajax({
      type: 'GET',
      url: "".concat(BASEURL, "get-currency-conversion"),
      dataType: 'json',
      global: false,
      async: false,
      success: function success(data) {
        return data;
      }
    }).responseText);
  }

  function getCommissionCriteriaJson() {
    return JSON.parse($.ajax({
      type: 'GET',
      url: "".concat(BASEURL, "get-commission-criteriass"),
      dataType: 'json',
      global: false,
      async: false,
      success: function success(data) {
        return data;
      }
    }).responseText);
  }

  function getCommissionJson() {
    return JSON.parse($.ajax({
      type: 'GET',
      url: "".concat(BASEURL, "get-commissions"),
      dataType: 'json',
      global: false,
      async: false,
      success: function success(data) {
        return data;
      }
    }).responseText);
  }

  function getCommissionGroupsJson() {
    return JSON.parse($.ajax({
      type: 'GET',
      url: "".concat(BASEURL, "get-commission-groups"),
      dataType: 'json',
      global: false,
      async: false,
      success: function success(data) {
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


  window.getBookingAmountPerPerson = function () {
    var paxNumber = parseFloat($(".pax-number").val());
    var totalSellingPriceInBookingCurrency = parseFloat($(".total-selling-price").val());
    var bookingAmountPerPerson = parseFloat(totalSellingPriceInBookingCurrency) / parseFloat(paxNumber);
    $('.booking-amount-per-person').val(check(bookingAmountPerPerson));
  };

  window.getSellingPrice = function () {
    var sellingPriceOtherCurrency = $('.selling-price-other-currency').val();

    if (sellingPriceOtherCurrency) {
      var rateType = $('input[name="rate_type"]:checked').val();
      var bookingCurrency = $(".booking-currency-id").find(':selected').data('code');
      var totalSellingPrice = parseFloat($('.total-selling-price').val());
      var rate = getRate(bookingCurrency, sellingPriceOtherCurrency, rateType);
      var sellingPriceOtherCurrencyRate = parseFloat(totalSellingPrice) * parseFloat(rate);
      $('.selling-price-other-currency-rate').val(check(sellingPriceOtherCurrencyRate));
      $('.selling-price-other-currency-code').val(check(sellingPriceOtherCurrencyRate));
    }

    if (sellingPriceOtherCurrency == '') {
      $('.selling-price-other-currency-rate').val('0.00');
      $('.selling-price-other-currency-code').val('');
    }
  };

  window.getCommissionRate = function () {
    var calculatedCommisionAmount = 0;
    var commissionPercentage = 0;
    var agency = $("input[name=agency]:checked").val();
    var agencyCommissionType = $("input[name=agency_commission_type]:checked").val();
    var netValue = $('.total-markup-amount').val();
    var commissionID = $('.commission-id').val();
    var commissionGroupID = $('.commission-group-id').val();
    var brandID = $('.brand-id').val();
    var holidayTypeID = $('.holiday-type-id').val();
    var currencyID = $('.booking-currency-id').val();
    var seasonID = $('.season-id').val(); // console.log(totalNetPrice);
    // console.log(commissionID);
    // console.log(commissionGroupID);
    // console.log(brandID);
    // console.log(holidayTypeID);
    // console.log(seasonID);
    // console.log(currencyID);

    if (agency == 1 && agencyCommissionType == 'paid-net-of-commission' || agency == 1 && agencyCommissionType == 'we-pay-commission-on-departure') {
      netValue = $('.total-net-margin').val();
    }

    if (commissionID && commissionGroupID && brandID && holidayTypeID && currencyID && seasonID) {
      commissionPercentage = getCommissionPercent(commissionID, commissionGroupID, brandID, holidayTypeID, currencyID, seasonID);
      calculatedCommisionAmount = parseFloat(netValue / 100) * parseFloat(commissionPercentage);
      var commissionNames = getCommissionAndGroupName(commissionID, commissionGroupID);

      if (parseFloat(commissionPercentage) > 0.00) {
        $('.badge-commission-name').text(commissionNames.commissionName);
        $('.badge-commission-group-name').text(commissionNames.commissionGroupName);
        $('.badge-commission-percentage').text("".concat(commissionPercentage, " %"));
      } else {
        resetCommissionNameFeilds();
      }
    } else {
      calculatedCommisionAmount = 0.00;
      resetCommissionNameFeilds();
    }

    $('.commission-percentage').val(check(commissionPercentage));
    $('.commission-amount').val(check(calculatedCommisionAmount));
  };

  window.getRate = function (supplierCurrency, bookingCurrency, rateType) {
    var object = currencyConvert.filter(function (elem) {
      return elem.from == supplierCurrency && elem.to == bookingCurrency;
    });
    return object.shift()[rateType];
  };

  function resetCommissionNameFeilds() {
    $('.badge-commission-name').text('');
    $('.badge-commission-group-name').text('');
    $('.badge-commission-percentage').text('');
  }

  function getCommissionPercent(commissionID, commissionGroupID, brandID, holidayTypeID, currencyID, seasonID) {
    var commissionPercentage = 0.00;
    var object = commissionCriteriaRates.filter(function (elem) {
      return elem.commission_id == commissionID && elem.commission_group_id == commissionGroupID && elem.brand_id == brandID && elem.holiday_type_id == holidayTypeID && elem.currency_id == currencyID && elem.season_id == seasonID;
    });

    if (object.length > 0) {
      commissionPercentage = object.shift().percentage;
    }

    return commissionPercentage;
  }

  function getCommissionAndGroupName(commissionID, commissionGroupID) {
    var commissionNameObject = {};
    var commission_name = commissions.filter(function (elem) {
      return elem.id == commissionID;
    });
    var commission_group_name = commissionGroups.filter(function (elem) {
      return elem.id == commissionGroupID;
    });
    commissionNameObject = {
      commissionName: commission_name.shift().name,
      commissionGroupName: commission_group_name.shift().name
    };
    return commissionNameObject;
  }

  function getQuoteBookingCurrencyValues() {
    var rateType = $("input[name=rate_type]:checked").val();
    var estimatedCostArray = $(".estimated-cost").map(function (i, e) {
      return parseFloat(e.value).toFixed(2);
    }).get();
    var sellingPriceArray = $(".selling-price").map(function (i, e) {
      return parseFloat(e.value).toFixed(2);
    }).get();
    var markupAmountArray = $(".markup-amount").map(function (i, e) {
      return parseFloat(e.value).toFixed(2);
    }).get();
    var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
    var supplierCurrencyArray = $(".supplier-currency-id").map(function (i, e) {
      return $(e).find(":selected").data("code");
    }).get();
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

      $("#quote_".concat(key, "_estimated_cost_in_booking_currency")).val(check(calculatedEstimatedCostInBookingCurrency));
      $("#quote_".concat(key, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
      $("#quote_".concat(key, "_markup_amount_in_booking_currency")).val(check(calculatedMarkupAmountInBookingCurrency));
      key++;
    }
  }
  /* Hide Potentail Commission for another Behalf User */


  $(document).on('change', '.sales-person-id', function () {
    console.log("sales  salessalessales");
    var salesPersonID = $(this).val();
    var userID = $('.user-id').val();
    console.log(salesPersonID);
    console.log(userID);

    if (salesPersonID != userID) {
      $('#potential_commission_feild').addClass('d-none');
    }

    if (salesPersonID == userID) {
      $('#potential_commission_feild').removeClass('d-none');
    }
  });
  $(document).on('change', '.view-rate-booking-currency-filter', function () {
    var url = "".concat(BASEURL, "filter-currency-rate/").concat(selectedCurrencies);
    var selectedCurrencies = $(this).val();

    if (selectedCurrencies == '') {
      selectedCurrencies = [];
    }

    $.ajax({
      type: 'get',
      url: url,
      data: {
        'selected_currencies': selectedCurrencies
      },
      success: function success(response) {
        $('#currency_conversions').html(response);
      }
    });
  });
  $(document).on('click', '.search-reference', function () {
    var searchRef = $(this);
    var reference_no = $('.reference-name').val();

    if (reference_no == '') {
      alert('Reference number is not found');
      searchRef.text('Search').prop('disabled', false);
    } else {
      $('#ref_no').closest('.form-group').find('.text-danger').html(''); //check refrence is already exist in system

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': CSRFTOKEN
        },
        url: BASEURL + 'find/reference/' + reference_no + '/exist',
        type: 'get',
        dataType: "json",
        success: function success(data) {
          var r = true;

          if (data.response == true) {
            r = confirm('The reference number is already exists. Are you sure! you want to create quote again on same reference');
          }

          if (r == true) {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': CSRFTOKEN
              },
              url: BASEURL + 'find/reference',
              data: {
                ref_no: reference_no
              },
              type: 'POST',
              dataType: "json",
              beforeSend: function beforeSend() {
                $(".search-reference-btn").find('span').addClass('spinner-border spinner-border-sm');
                searchRef.prop('disabled', true);
              },
              success: function success(data) {
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
                    setTimeout(function () {
                      $("#holiday_type_id option:contains(" + data.response.brand.name + ")").attr('selected', 'selected').change(); // $("#holiday_type_id option[data-value='" + data.response.brand.name +"']").attr("selected","selected");
                    }, 500);
                  }

                  if (data.response.sale_person) {
                    $('#sale_person_id').val(data.response.sale_person).trigger('change');
                  }

                  if (data.response.pax) {
                    $('#pax_no').val(data.response.pax).trigger('change');
                  }

                  if (data.response.currency) {
                    $("#currency_id").find('option').each(function () {
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
                  } // Passengers Details


                  if (data.response.passengers.passengers.length > 0) {
                    data.response.passengers.passengers.forEach(function ($_value, $key) {
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
              error: function error(reject) {
                searchRef.prop('disabled', false);
                $(".search-reference-btn").find('span').removeClass('spinner-border spinner-border-sm');
                $('#ref_no').closest('.form-group').find('.text-danger').html(reject.responseJSON.errors);
              }
            });
          }
        },
        error: function error(reject) {
          alert(reject);
          searchRef.text('Search').prop('disabled', false);
          searchRef.prop('disabled', false);
          $(".search-reference-btn").find('span').removeClass('spinner-border spinner-border-sm');
        }
      }); //ajax for references
    }
  });
  $(document).on('change', '.selling-price-other-currency', function () {
    $('.selling-price-other-currency-code').text($(this).val());
    getSellingPrice();
  });
  $(document).on('change', '.booking-currency-id', function () {
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
  $(document).on('click', '#add_more, #add_more_booking', function (e) {
    jQuery('#new_service_modal').modal('show');
  });
  $(document).on('change', '.season-id', function () {
    getCommissionRate(); // $('.datepicker').datepicker("setDate", '');
  });
  $(document).on('change', '.holiday-type-id', function () {
    getCommissionRate();
  });
  $(document).on('change', '.getBrandtoHoliday', function () {
    var brand_id = $(this).val();
    var options = '';
    var url = BASEURL + 'brand/to/holidays';
    $.ajax({
      type: 'get',
      url: url,
      data: {
        'brand_id': brand_id
      },
      success: function success(response) {
        options += '<option value="">Select Type Of Holiday</option>';
        $.each(response, function (key, value) {
          options += "<option data-value=\"".concat(value.name, "\" value=\"").concat(value.id, "\"> ").concat(value.name, " </option>");
        });
        $('.appendHolidayType').html(options);
      }
    });
    getCommissionRate();
  });
  $(document).on('click', '.view-rates', function () {
    jQuery('#view_rates_modal').modal('show');
  });
  $(document).on('change', '.rate-type', function () {
    var status = $(this).attr("data-status");

    if (status && status == 'booking') {
      getBookingRateTypeValues();
    } else {
      getQuoteRateTypeValues();
    }
  });
});

/***/ }),

/***/ "./resources/js/quote_booking_template/quote_booking_template.js":
/*!***********************************************************************!*\
  !*** ./resources/js/quote_booking_template/quote_booking_template.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $(document).on('change', '.booking-type-id', function () {
    var quote = $(this).closest('.quote');
    var booking_type = $(this).val();
    var booking_slug = $(this).find(':selected').data('slug');

    if (booking_type == 2 || booking_slug == 'partially-refundable') {
      quote.find('.refundable-percentage-feild').removeClass('d-none');
    } else {
      quote.find('.refundable-percentage-feild').addClass('d-none');
    }
  });
  $(".quote").each(function () {
    var quote = $(this);
    var quoteKey = quote.attr('data-key');
    var categoryFormData = $("#quote_".concat(quoteKey, "_category_details")).val();
    var productFormData = $("#quote_".concat(quoteKey, "_product_details")).val();

    if (categoryFormData != '' && typeof categoryFormData != 'undefined') {
      createAllElm(quote, '.category-details-render', 'category_details', JSON.parse(categoryFormData));
    }

    if (productFormData != '' && typeof productFormData != 'undefined') {
      createAllElm(quote, '.product-details-render', 'product_details', JSON.parse(productFormData));
    }
  });
  $(document).on('keyup', '.cat-details-feild', function (e) {
    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var formData = JSON.parse($("#quote_".concat(quoteKey, "_category_details")).val());
    var feildIndex = $(this).parents('.cat-feild-col').index();
    formData[feildIndex].userData = [$(this).val()];
    formData[feildIndex].value = $(this).val();
    quote.find("#quote_".concat(quoteKey, "_category_details")).val(JSON.stringify(formData));
    console.log(JSON.stringify(formData));
  });
  $(document).on('change', '.cat-details-select', function (e) {
    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var formData = JSON.parse($("#quote_".concat(quoteKey, "_category_details")).val());
    var feildIndex = $(this).parents('.cat-feild-col').index();
    var optionIndex = $(this).find(":selected").index(); // formData[feildIndex].values[optionIndex].selected = true;

    var formData = formData.map(function (obj) {
      if (obj.type == 'select' || obj.type == 'autocomplete') {
        obj.values.map(function (obj) {
          obj.selected = false;
          return obj;
        });
      }

      return obj;
    });
    formData[feildIndex].values[optionIndex].selected = true;
    quote.find("#quote_".concat(quoteKey, "_category_details")).val(JSON.stringify(formData));
  });
  $(document).on('change', '.cat-details-checkbox', function (e) {
    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var formData = JSON.parse($("#quote_".concat(quoteKey, "_category_details")).val());
    var feildIndex = $(this).parents('.cat-feild-col').index();
    var optionIndex = $(this).parents('.cat-details-checkbox-parent').index();
    formData[feildIndex].values[optionIndex].selected = true;
    quote.find("#quote_".concat(quoteKey, "_category_details")).val(JSON.stringify(formData));
  });
  $(document).on('change', '.cat-details-radio-btn', function (e) {
    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var formData = JSON.parse($("#quote_".concat(quoteKey, "_category_details")).val());
    var feildIndex = $(this).parents('.cat-feild-col').index();
    var optionIndex = $(this).parents('.cat-details-radio-btn-parent').index();
    var formData = formData.map(function (obj) {
      if (obj.type == 'radio-group') {
        obj.values.map(function (obj) {
          obj.selected = false;
          return obj;
        });
      }

      return obj;
    });
    formData[feildIndex].values[optionIndex].selected = true;
    quote.find("#quote_".concat(quoteKey, "_category_details")).val(JSON.stringify(formData));
  });
  $(document).on('keyup', '.prod-details-feild', function (e) {
    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var formData = JSON.parse($("#quote_".concat(quoteKey, "_product_details")).val());
    var feildIndex = $(this).parents('.prod-feild-col').index();
    formData[feildIndex].userData = [$(this).val()];
    formData[feildIndex].value = $(this).val();
    quote.find("#quote_".concat(quoteKey, "_product_details")).val(JSON.stringify(formData));
    console.log(JSON.stringify(formData));
  });
  $(document).on('change', '.prod-details-select', function (e) {
    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var formData = JSON.parse($("#quote_".concat(quoteKey, "_product_details")).val());
    var feildIndex = $(this).parents('.prod-feild-col').index();
    var optionIndex = $(this).find(":selected").index(); // formData[feildIndex].values[optionIndex].selected = true;

    var formData = formData.map(function (obj) {
      if (obj.type == 'select' || obj.type == 'autocomplete') {
        obj.values.map(function (obj) {
          obj.selected = false;
          return obj;
        });
      }

      return obj;
    });
    formData[feildIndex].values[optionIndex].selected = true;
    quote.find("#quote_".concat(quoteKey, "_product_details")).val(JSON.stringify(formData));
  });
  $(document).on('change', '.product-id', function () {
    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var product_name = $(this).find(':selected').attr('data-name');
    var product_id = $(this).val();
    var detail_id = $("#quote_".concat(quoteKey, "_detail_id")).val();
    var model_name = $("#model_name").val();
    quote.find('.prod-feild-col').remove();
    var formData = '';

    if (typeof product_name === 'undefined' || product_name == '') {
      quote.find('.badge-product-id').html('');
      $("#quote_".concat(quoteKey, "_booking_type_id")).val("").change();
      return;
    }

    $.ajax({
      type: 'get',
      url: "".concat(BASEURL, "get-product-booking-type"),
      data: {
        'product_id': product_id,
        'detail_id': detail_id,
        'model_name': model_name
      },
      success: function success(response) {
        // set category details feilds 
        if (response.product != null && response.product.booking_type_id != null) {
          $("#quote_".concat(quoteKey, "_booking_type_id")).val(response.product.booking_type_id).change();
        }

        if (response.product_details != '' && response.product_details != 'undefined') {
          $("#quote_".concat(quoteKey, "_product_details")).val(response.product_details);
          createAllElm(quote, '.product-details-render', 'product_details', JSON.parse(response.product_details));
        }
      }
    });
    quote.find('.badge-product-id').html(product_name);
    quote.find('.badge-product-id').removeClass('d-none');
  });
  $(document).on('change', '.supplier-country-id', function () {
    var supplier_country_ids = $(this).val();
    var url = BASEURL + 'country/to/supplier';
    var options = '';
    var selectOption = "<option value=''>Select Supplier</option>";

    if (supplier_country_ids && supplier_country_ids.length > 0) {
      $.ajax({
        type: 'get',
        url: url,
        data: {
          'supplier_country_ids': supplier_country_ids
        },
        beforeSend: function beforeSend() {
          $('.supplier-id').html(options);
        },
        success: function success(response) {
          if (response && response.suppliers.length > 0) {
            options += selectOption;
            $.each(response.suppliers, function (key, value) {
              options += "<option data-value=\"".concat(value.name, "\" value=\"").concat(value.id, "\"> ").concat(value.name, " </option>");
            });
          } else {
            options = selectOption;
          }

          $('.supplier-id').html(options);
        }
      });
    } else {
      options = selectOption;
      $('.supplier-id').html(options);
    }
  });
  $(document).on('change', '.date-of-service', function () {
    var quote = $(this).closest('.quote');
    quote.find('.badge-date-of-service').html($(this).val());
    quote.find('.badge-date-of-service').removeClass('d-none');
  });
  $(document).on('change', '.time-of-service', function () {
    var quote = $(this).closest('.quote');
    quote.find('.badge-time-of-service').html($(this).val());
    quote.find('.badge-time-of-service').removeClass('d-none');
  });
  var quoteKeyForComment = '';
  $(document).on('click', '.insert-quick-text', function () {
    var quote = $(this).closest('.quote');
    quoteKeyForComment = quote.data('key');
    var modal = jQuery('.insert-quick-text-modal');
    modal.modal('show');
  });
  $(document).on('click', '#insert_quick_text_confirm_btn', function () {
    var quickText = $(".quick-comment:checked").val();
    $(".quick-comment").prop('checked', false);
    jQuery('.insert-quick-text-modal').modal('hide');
    $("#quote_".concat(quoteKeyForComment, "_comments")).val(quickText);
  });
  var quoteKeyForProduct = '';
  $(document).on('click', '.add-new-product', function () {
    var quote = $(this).closest('.quote');
    quoteKeyForProduct = quote.data('key');
    var supplier_id = quote.find('.supplier-id').val();
    var modal = jQuery('.add-new-product-modal');

    if (supplier_id != "" && typeof supplier_id !== 'undefined') {
      modal.modal('show'); // reset modal feilds

      $('#form_add_product').trigger("reset");
      modal.find('#form_add_product #description').summernote("reset");
      modal.find('#form_add_product #inclusions').summernote("reset");
      modal.find('#form_add_product #packing_list').summernote("reset"); // set supplier id

      modal.find('.product-supplier-id').val(supplier_id);
    } else {
      alert("Please select Supplier first");
      return;
    }
  });
  $("#form_add_product").submit(function (event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var formData = $(this).serialize();
    var options = '';
    $.ajax({
      type: 'POST',
      url: url,
      data: formData,
      beforeSend: function beforeSend() {
        $('input').removeClass('is-invalid');
        $('.text-danger').html('');
        $("#submit_add_product").find('span').addClass('spinner-border spinner-border-sm');
      },
      success: function success(data) {
        $("#submit_add_product").find('span').removeClass('spinner-border spinner-border-sm');
        jQuery('.add-new-product-modal').modal('hide');
        setTimeout(function () {
          if (data && data.status == true) {
            alert(data.success_message);

            if (data.products.length != 0) {
              options += "<option value=''>Select Product</option>";
              $.each(data.products, function (key, value) {
                options += "<option value='".concat(value.id, "' data-name='").concat(value.name, "'>").concat(value.name, " - ").concat(value.code, "</option>");
              });
              $("#quote_".concat(quoteKeyForProduct, "_product_id")).html(options);
            }
          }
        }, 200);
      },
      error: function error(reject) {
        if (reject.status === 422) {
          var errors = $.parseJSON(reject.responseText);
          setTimeout(function () {
            $("#submit_add_product").find('span').removeClass('spinner-border spinner-border-sm');

            if (errors.hasOwnProperty("product_error")) {
              alert(errors.product_error);
            } else {
              jQuery.each(errors.errors, function (index, value) {
                index = index.replace(/\./g, '_');
                $("#".concat(index)).addClass('is-invalid');
                $("#".concat(index)).closest('.form-group').find('.text-danger').html(value);
              });
            }
          }, 200);
        }
      }
    });
  });

  function createElm(quote, selector, type, obj) {
    var inputTypes = ['text', 'textarea', 'number', 'select', 'autocomplete'];
    var appendHTML = '';

    if (obj.type == 'radio-group') {
      var radioBtnElementParent = document.createElement("div");

      if (obj.inline) {
        radioBtnElementParent.setAttribute('class', 'd-flex row');
      } //Create and append the options


      for (var i = 0; i < obj.values.length; i++) {
        var radioBtnDiv = document.createElement("div");
        radioBtnDiv.setAttribute('class', 'mr-1 cat-details-radio-btn-parent');
        var radioBtn = document.createElement("input");
        radioBtn.setAttribute("type", "radio");
        radioBtn.setAttribute("name", obj.name);
        radioBtn.setAttribute("id", removeSpace(obj.values[i].value));
        radioBtn.setAttribute("class", "cat-details-radio-btn");
        radioBtn.setAttribute("value", obj.values[i].value);

        if (obj.values[i].selected) {
          radioBtn.setAttribute('checked', 'checked');
        }

        var label = document.createElement('label');
        label.innerHTML = "&nbsp; ".concat(obj.values[i].label);
        label.setAttribute("for", removeSpace(obj.values[i].value));
        radioBtnDiv.appendChild(radioBtn);
        radioBtnDiv.appendChild(label);
        radioBtnElementParent.appendChild(radioBtnDiv);
      }

      appendHTML = createParentDivOfElm(radioBtnElementParent, type, obj);
    }

    if (obj.type == 'checkbox-group') {
      var checkboxElementParent = document.createElement("div");

      if (obj.inline) {
        checkboxElementParent.setAttribute('class', 'd-flex');
      } //Create and append the options


      for (var _i = 0; _i < obj.values.length; _i++) {
        var checkboxDiv = document.createElement("div");
        checkboxDiv.setAttribute('class', 'mr-1 cat-details-checkbox-parent');
        var checkbox = document.createElement("input");
        checkbox.setAttribute("type", "checkbox");
        checkbox.setAttribute("name", obj.values[_i].value);
        checkbox.setAttribute("id", removeSpace(obj.values[_i].value));
        checkbox.setAttribute("class", "cat-details-checkbox");
        checkbox.setAttribute("value", obj.values[_i].value);

        if (obj.values[_i].selected) {
          checkbox.setAttribute('checked', 'checked');
        }

        var _label = document.createElement('label');

        _label.innerHTML = "&nbsp; ".concat(obj.values[_i].label);

        _label.setAttribute("for", removeSpace(obj.values[_i].value));

        checkboxDiv.appendChild(checkbox);
        checkboxDiv.appendChild(_label);
        checkboxElementParent.appendChild(checkboxDiv);
      }

      appendHTML = createParentDivOfElm(checkboxElementParent, type, obj);
    }

    if (inputTypes.includes(obj.type)) {
      var element = '';
      if (['text', 'number'].includes(obj.type)) element = 'input';else if (['autocomplete', 'select'].includes(obj.type)) element = 'select';else element = obj.type;
      var elm = document.createElement(element); // Set attributes

      if (obj.type == 'text') elm.setAttribute('type', 'text');
      if (obj.type == 'number') elm.setAttribute('type', 'number');
      elm.setAttribute('name', obj.name);

      if (obj.placeholder != undefined) {
        elm.setAttribute('placeholder', obj.placeholder);
      }

      if (obj.className != undefined && type == 'category_details') {
        elm.setAttribute('class', obj.className + ' cat-details-feild');
      }

      if (obj.className != undefined && type == 'product_details') {
        elm.setAttribute('class', obj.className + ' prod-details-feild');
      }

      if (obj.className != undefined && obj.type == 'select' || obj.type == 'autocomplete' && type == 'category_details') {
        elm.setAttribute('class', obj.className + ' select2single cat-details-select');
      }

      if (obj.className != undefined && obj.type == 'select' || obj.type == 'autocomplete' && type == 'product_details') {
        elm.setAttribute('class', obj.className + ' select2single prod-details-select');
      }

      if (obj.required != undefined && obj.required) {
        elm.setAttribute('required', true);
      } // set value for text and textarea


      if (obj.value != undefined && ['text', 'textarea', 'number'].includes(obj.type)) {
        elm.setAttribute('value', obj.value);
      } // set value for textarea


      if (obj.value != undefined && ['textarea'].includes(obj.type)) {
        elm.innerHTML = obj.value;
      } // add options to selectbox
      else if (obj.type == 'select' || obj.type == 'autocomplete') {
        //Create and append the options
        for (var _i2 = 0; _i2 < obj.values.length; _i2++) {
          var option = document.createElement("option");
          option.value = obj.values[_i2].label;
          option.text = obj.values[_i2].value;

          if (obj.values[_i2].selected) {
            option.setAttribute('selected', 'selected');
          }

          elm.appendChild(option);
        }
      }

      appendHTML = createParentDivOfElm(elm, type, obj);
    }

    quote.find(selector).append(appendHTML);
    reinitializedDynamicFeilds(); // insElment.appendChild(div);
    // $(div).insertAfter(quote.find('.product-id-col'));
  }

  function createParentDivOfElm(elem, type, obj) {
    var div = document.createElement('div');
    if (type == 'category_details') div.setAttribute('class', 'col-md-3 cat-feild-col');
    if (type == 'product_details') div.setAttribute('class', 'col-md-3 prod-feild-col');
    var formGroup = document.createElement('div');
    formGroup.setAttribute('class', 'form-group');
    var label = document.createElement('label');
    label.innerHTML = "&nbsp; ".concat(obj.label);
    formGroup.appendChild(label);
    formGroup.appendChild(elem);
    div.appendChild(formGroup);
    return div;
  }

  function createAllElm(location, selector, type, obj) {
    obj.forEach(function (item) {
      createElm(location, selector, type, item);
    });
  }

  $(document).on('change', '.category-id', function () {
    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var detail_id = $("#quote_".concat(quoteKey, "_detail_id")).val();
    var model_name = $("#model_name").val();
    var category_id = $(this).val();
    var category_name = $(this).find(':selected').attr('data-name');
    var category_slug = $(this).find(':selected').attr('data-slug');
    var options = '';
    var formData = ''; // remove already appended feild

    quote.find('.cat-feild-col').remove();
    /* remove & reset supplier location attribute when category selected */

    if (typeof category_id === 'undefined' || category_id == "") {
      quote.find('.badge-category-id').html(""); // $(`#quote_${quoteKey}_supplier_location_id`).val("").trigger('change');
      // $(`#quote_${quoteKey}_supplier_location_id`).attr('disabled', 'disabled');

      $("#quote_".concat(quoteKey, "_supplier_id")).val("").trigger('change');
      $("#quote_".concat(quoteKey, "_supplier_id")).attr('disabled', 'disabled');
      $("#quote_".concat(quoteKey, "_product_id")).val("").trigger('change');
      $("#quote_".concat(quoteKey, "_product_id")).attr('disabled', 'disabled');
      $('.show-tf').addClass('d-none');
      return;
    } else {
      // $(`#quote_${quoteKey}_supplier_location_id`).removeAttr('disabled');
      // $(`#quote_${quoteKey}_supplier_location_id`).val("").trigger('change');
      $("#quote_".concat(quoteKey, "_product_id")).removeAttr('disabled');
      quote.find('.badge-category-id').html(category_name);
    } // set Payment type (Booking Type) refundable when category is fligt


    if (category_slug == 'flights') {
      var refundable = $("#quote_".concat(quoteKey, "_booking_type_id")).find("option[data-slug='refundable']").val();
      $("#quote_".concat(quoteKey, "_booking_type_id")).val(refundable).trigger('change');
    } else {
      $("#quote_".concat(quoteKey, "_booking_type_id")).val('').change();
    }

    $.ajax({
      type: 'get',
      url: "".concat(BASEURL, "category/to/supplier"),
      data: {
        'category_id': category_id,
        'detail_id': detail_id,
        'model_name': model_name
      },
      success: function success(response) {
        if (response.category_details != '' && response.category_details != 'undefined') {
          $("#quote_".concat(quoteKey, "_category_details")).val(response.category_details);
          console.log(JSON.parse(response.category_details));
          createAllElm(quote, '.category-details-render', 'category_details', JSON.parse(response.category_details));
        } // Hide & Show Category details btn according to status


        if (response.category != "" && typeof response.category !== 'undefined') {
          if (response.category.show_tf == 1) {
            $('.show-tf').removeClass('d-none');
            quote.find('.show-tf .form-group .label-of-time-label').html(response.category.label_of_time);
          } else {
            $('.show-tf').addClass('d-none');
          }

          if (response.category.second_tf == 1) {
            $('.second-tf').removeClass('d-none');
            quote.find('.second-tf .form-group .second-label-of-time').html(response.category.second_label_of_time);
          } else {
            $('.second-tf').addClass('d-none');
          }

          if (response.category.quote == 1) {
            quote.find('.build-wrap-parent').removeClass('d-none').addClass('d-flex');
          } else {
            quote.find('.build-wrap-parent').removeClass('d-flex').addClass('d-none');
          }

          if (response.category.booking == 1) {
            quote.find('.booking-category-detail-btn-parent').removeClass('d-none');
            quote.find('.booking-category-detail-btn-parent').addClass('d-flex');
          } else {
            quote.find('.booking-category-detail-btn-parent').removeClass('d-flex');
            quote.find('.booking-category-detail-btn-parent').addClass('d-none');
          }

          if (response.category.set_end_date_of_service == 1) {
            var DateOFService = $("#quote_".concat(quoteKey, "_date_of_service")).val();
            $("#quote_".concat(quoteKey, "_end_date_of_service")).datepicker("setDate", DateOFService);
          }
          /* set product dropdown */


          if (response && response.products.length > 0) {
            options += "<option value=''>Select Product</option>";
            $.each(response.products, function (key, value) {
              options += "<option value='".concat(value.id, "' data-name='").concat(value.name, "'>").concat(value.name, " - ").concat(value.code, "</option>");
            });
            $("#quote_".concat(quoteKey, "_product_id")).html(options);
          } else {
            $("#quote_".concat(quoteKey, "_product_id")).html("<option value=''>Select Product</option>");
          }
        }
      }
    });
  });
  $(document).on('change', '.supplier-location-id', function () {
    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var suppplier_location_id = $("#quote_".concat(quoteKey, "_supplier_location_id")).val();
    var category_id = $("#quote_".concat(quoteKey, "_category_id")).val();
    var options = '';
    $("#quote_".concat(quoteKey, "_supplier_id")).removeAttr('disabled');
    /* set supplier dropdown null when supplier location become null */

    if (typeof suppplier_location_id === 'undefined' || suppplier_location_id == "") {
      $("#quote_".concat(quoteKey, "_supplier_id")).val("").trigger('change');
      $("#quote_".concat(quoteKey, "_supplier_id")).attr('disabled', 'disabled');
      $("#quote_".concat(quoteKey, "_product_id")).val("").trigger('change');
      $("#quote_".concat(quoteKey, "_product_id")).attr('disabled', 'disabled');
      return;
    }
    /* get suppliers according to location */


    $.ajax({
      type: 'get',
      url: "".concat(BASEURL, "location/to/supplier"),
      data: {
        'suppplier_location_id': suppplier_location_id,
        'category_id': category_id
      },
      beforeSend: function beforeSend() {
        $("#quote_".concat(quoteKey, "_supplier_id")).val("").trigger('change');
      },
      success: function success(response) {
        /* set supplier dropdown*/
        options += "<option value=\"\">Select Supplier</option>";
        $.each(response.suppliers, function (key, value) {
          options += "<option value='".concat(value.id, "' data-name='").concat(value.name, "'>").concat(value.name, "</option>");
        });
        $("#quote_".concat(quoteKey, "_supplier_id")).html(options);
      }
    });
  });
  $(document).on('change', '.end-date-of-service', function () {
    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var DateOFService = $("#quote_".concat(quoteKey, "_date_of_service")).val();
    var EndDateOFService = $("#quote_".concat(quoteKey, "_end_date_of_service")).val();
    var nowDate = todayDate();
    var category_enddateofservice = $("#quote_".concat(quoteKey, "_category_id")).find(':selected').attr('data-enddateofservice');

    if (convertDate(EndDateOFService) < convertDate(nowDate)) {
      alert('Please select valid Date, The date you select is already Passed.');
      $("#quote_".concat(quoteKey, "_end_date_of_service")).datepicker("setDate", '');
      $("#quote_".concat(quoteKey, "_number_of_nights")).val('');
    }

    if (convertDate(EndDateOFService) < convertDate(DateOFService) && category_enddateofservice != 1) {
      alert('Please select Valid Date\nEnd Date of Service should be equal or greater than Start Date of Service.');
      $("#quote_".concat(quoteKey, "_end_date_of_service")).datepicker("setDate", '');
      $("#quote_".concat(quoteKey, "_number_of_nights")).val('');
    } else {
      var number = convertDate(EndDateOFService) - convertDate(DateOFService);
      var days = Math.ceil(number / (1000 * 3600 * 24));
      $("#quote_".concat(quoteKey, "_number_of_nights")).val(checkForInt(days));
    }
  });
  $(document).on('change', '.date-of-service', function () {
    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var DateOFService = $("#quote_".concat(quoteKey, "_date_of_service")).val();
    var EndDateOFService = $("#quote_".concat(quoteKey, "_end_date_of_service")).val();
    var nowDate = todayDate();
    var category_enddateofservice = $("#quote_".concat(quoteKey, "_category_id")).find(':selected').attr('data-enddateofservice');

    if (convertDate(DateOFService) < convertDate(nowDate)) {
      alert('Please select valid Date, The date you select is already Passed.');
      $("#quote_".concat(quoteKey, "_date_of_service")).datepicker("setDate", '');
      $("#quote_".concat(quoteKey, "_number_of_nights")).val('');
    }

    if (category_enddateofservice == 1) {
      $("#quote_".concat(quoteKey, "_end_date_of_service")).datepicker("setDate", DateOFService);
      EndDateOFService = $("#quote_".concat(quoteKey, "_end_date_of_service")).val();
    }

    if (convertDate(EndDateOFService) < convertDate(DateOFService) && category_enddateofservice != 1) {
      alert('Please select Valid Date\nEnd Date of Service should be equal or greater than Start Date of Service.');
      $("#quote_".concat(quoteKey, "_date_of_service")).datepicker("setDate", '');
      $("#quote_".concat(quoteKey, "_number_of_nights")).val('');
    } else {
      var number = convertDate(EndDateOFService) - convertDate(DateOFService);
      var days = Math.ceil(number / (1000 * 3600 * 24));
      $("#quote_".concat(quoteKey, "_number_of_nights")).val(checkForInt(days));
    }
  });

  function convertDate(date) {
    var dateParts = date.split("/");
    return dateParts = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);
  }
});

/***/ }),

/***/ "./resources/js/quote_management.js":
/*!******************************************!*\
  !*** ./resources/js/quote_management.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./quote_booking/quote_booking */ "./resources/js/quote_booking/quote_booking.js");

__webpack_require__(/*! ./quote_booking_template/quote_booking_template */ "./resources/js/quote_booking_template/quote_booking_template.js");

__webpack_require__(/*! ./quote_template/quote_template */ "./resources/js/quote_template/quote_template.js");

__webpack_require__(/*! ./quote_management/quote_app */ "./resources/js/quote_management/quote_app.js");

/***/ }),

/***/ "./resources/js/quote_management/quote_app.js":
/*!****************************************************!*\
  !*** ./resources/js/quote_management/quote_app.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Common Functions for Store & Update Category
  |--------------------------------------------------------------------------------
  */
  function getQuoteTotalValuesOnMarkupChange(changeFeild) {
    var totalNetPrice = 0;
    var totalMarkupAmount = 0;
    var markupPercentage = 0;
    var calculatedTotalMarkupPercentage = 0;
    var totalSellingPrice = 0;
    var calculatedTotalMarkupAmount = 0;
    var calculatedProfitPercentage = 0;
    totalNetPrice = parseFloat($('.total-net-price').val());
    totalMarkupAmount = parseFloat($('.total-markup-amount').val());
    markupPercentage = parseFloat($('.total-markup-percent').val());

    if (changeFeild == 'total_markup_amount') {
      calculatedTotalMarkupPercentage = parseFloat(totalMarkupAmount) / parseFloat(totalNetPrice / 100);
      totalSellingPrice = totalNetPrice + totalMarkupAmount;
      $('.total-markup-percent').val(check(calculatedTotalMarkupPercentage));
      $('.total-selling-price').val(check(totalSellingPrice));
    }

    if (changeFeild == 'total_markup_percent') {
      calculatedTotalMarkupAmount = parseFloat(totalNetPrice) / 100 * parseFloat(markupPercentage);
      totalSellingPrice = totalNetPrice + calculatedTotalMarkupAmount;
      $('.total-markup-amount').val(check(calculatedTotalMarkupAmount));
      $('.total-selling-price').val(check(totalSellingPrice));
    }

    calculatedProfitPercentage = (parseFloat(totalSellingPrice) - parseFloat(totalNetPrice)) / parseFloat(totalSellingPrice) * 100;
    $('.total-profit-percentage').val(check(calculatedProfitPercentage));
    getCommissionRate();
    getBookingAmountPerPerson();
    getSellingPrice();
    getCalculatedTotalNetMarkup();
  }

  $(document).on('change', '.total-markup-change', function () {
    var changeFeild = $(this).attr("data-name");
    getQuoteTotalValuesOnMarkupChange(changeFeild);
  });
  $("#update-override").submit(function (event) {
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
      beforeSend: function beforeSend() {
        $("#override_submit").find('span').addClass('spinner-border spinner-border-sm');
      },
      success: function success(data) {
        if (data.success_message) {
          // $("#override_submit").find('span').removeClass('spinner-border spinner-border-sm');
          jQuery('.category-detail-feilds').modal('show');
        } // $("#overlay").removeClass('overlay').html('');
        // setTimeout(function() {
        //     alert('Quote updated Successfully');
        //     window.location.href = REDIRECT_BASEURL + "quotes/index";
        // }, 400);

      },
      error: function error(reject) {
        if (reject.status === 422) {
          var errors = $.parseJSON(reject.responseText);
          setTimeout(function () {
            $("#overlay").removeClass('overlay').html('');
            jQuery.each(errors.errors, function (index, value) {
              index = index.replace(/\./g, '_');
              $("#".concat(index)).addClass('is-invalid');
              $("#".concat(index)).closest('.form-group').find('.text-danger').html(value);
            });
          }, 400);
        }
      }
    });
  });
  $(document).on('submit', ".update-quote, #version_quote", function (event) {
    event.preventDefault();
    var url = $(this).attr('action');
    removeDisabledAttribute(".create-template [name=_method]"); // $('#lead_passenger_contact').intlTelInput("getNumber");/
    // console.log($("input[name='full_number']").val()+ 'asdsa');
    // $('#lead_passenger_contact').intlTelInput("getNumber")

    var formData = new FormData(this);
    var full_number = '';
    var agency = $("input[name=agency]:checked").val();

    if (agency == 0) {
      full_number = $('#lead_passenger_contact').closest('.form-group').find("input[name='full_number']").val();
    } else {
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
      beforeSend: function beforeSend() {
        $('input, select').removeClass('is-invalid');
        $('.text-danger').html('');
        $("#overlay").addClass('overlay');
        $("#overlay").html("<i class=\"fas fa-2x fa-sync-alt fa-spin\"></i>");
        $('.quote').removeClass('border border-danger');
      },
      success: function success(data) {
        $("#overlay").removeClass('overlay').html('');
        setTimeout(function () {
          if (data && data.status == 200) {
            alert(data.success_message);
            window.location.href = REDIRECT_BASEURL + "quotes/index";
          }
        }, 200);
      },
      error: function error(reject) {
        if (reject.status === 422) {
          var errors = $.parseJSON(reject.responseText);
          setTimeout(function () {
            $("#overlay").removeClass('overlay').html('');
            var flag = true;

            if (errors.hasOwnProperty("overrride_errors")) {
              alert(errors.overrride_errors);
              window.location.href = REDIRECT_BASEURL + "quotes/index";
            } else {
              jQuery.each(errors.errors, function (index, value) {
                index = index.replace(/\./g, '_'); // expand quote if feild has an error
                // $(`#${index}`).closest('.quote').addClass('border border-danger');

                $("#".concat(index)).closest('.quote').removeClass('collapsed-card');
                $("#".concat(index)).closest('.quote').find('.card-body').css("display", "block");
                $("#".concat(index)).closest('.quote').find('.collapse-expand-btn').html("<i class=\"fas fa-minus\"></i>");
                $("#".concat(index)).addClass('is-invalid');
                $("#".concat(index)).closest('.form-group').find('.text-danger').html(value);

                if (flag) {
                  $('html, body').animate({
                    scrollTop: $("#".concat(index)).offset().top
                  }, 1000);
                  flag = false;
                }
              });
            }
          }, 400);
        }
      }
    });
  });
  $('.tempalte-id').on('change', function () {
    var templateID = $(this).val();
    $.ajax({
      url: "".concat(BASEURL, "template/").concat(templateID, "/partial"),
      type: 'get',
      dataType: "json",
      success: function success(data) {
        if (data) {
          if (confirm("Are you sure! you want to override Quote Details?")) {
            $('#parent').html(data.template_view);
            $(".select2single").select2({
              width: "100%",
              theme: "bootstrap",
              templateResult: formatState,
              templateSelection: formatState
            });
            $("input[name=markup_type][value='".concat(data.template.markup_type, "']")).attr('checked', 'checked');
            $("input[name=rate_type][value='".concat(data.template.rate_type, "']")).attr('checked', 'checked');
            $(".booking-currency-id").val(data.template.currency_id).change(); // make quote section sortable

            $(function () {
              $(".sortable").sortable();
            });
            getQuoteTotalValues(); // jQuery('.note-editor').remove();

            jQuery('.summernote').summernote({
              height: 100,
              //set editable area's height
              placeholder: 'Enter Text Here..',
              codemirror: {
                // codemirror options
                theme: 'monokai'
              }
            });
          }
        }
      },
      error: function error(reject) {
        console.log(reject); // searchRef.text('Search').prop('disabled', false);
      }
    });
  });
  $(document).on('click', '#submit_template', function () {
    disabledFeild(".create-template [name=_method]");
    var templateName = $('#template_name').val();
    var privacyStatus = $('input[name="privacy_status"]:checked').val();
    var formData = $('.create-template').serialize() + '&template_name=' + templateName + '&privacy_status=' + privacyStatus;
    var url = "".concat(REDIRECT_BASEURL, "template/store-for-quote");
    $.ajax({
      type: 'POST',
      url: url,
      data: formData,
      beforeSend: function beforeSend() {
        $('input').removeClass('is-invalid');
        $('.text-danger').html('');
        $("#submit_template").find('span').addClass('spinner-border spinner-border-sm');
      },
      success: function success(data) {
        $("#submit_template").find('span').removeClass('spinner-border spinner-border-sm');
        jQuery('#modal-default').modal('hide');
        setTimeout(function () {
          alert('Template Created Successfully');
          removeDisabledAttribute(".create-template [name=_method]");
        }, 400);
      },
      error: function error(reject) {
        removeDisabledAttribute(".create-template [name=_method]");

        if (reject.status === 422) {
          var errors = $.parseJSON(reject.responseText);
          setTimeout(function () {
            $("#submit_template").find('span').removeClass('spinner-border spinner-border-sm');
            jQuery.each(errors.errors, function (index, value) {
              index = index.replace(/\./g, '_');
              $("#".concat(index)).addClass('is-invalid');
              $("#".concat(index)).closest('.form-group').find('.text-danger').html(value);
            });
          }, 400);
        }
      }
    });
  }); // Reset Template Modal On Open

  $(document).on('click', '#save_template', function () {
    var modal = jQuery('#modal-default').modal('show');
    modal.find('#template_name').val('');
    modal.find("input[name=privacy_status][value=1]").prop('checked', true);
  });
  $("#store_quote").submit(function (event) {
    event.preventDefault();
    var url = $(this).attr('action');
    $.ajax({
      type: 'POST',
      url: url,
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function beforeSend() {
        removeFormValidationStyles();
        addFormLoadingStyles();
      },
      success: function success(response) {
        removeFormLoadingStyles();
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "quotes/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /* Quote Final page script */

  if (['quotes.final'].includes(CURRENT_ROUTE_NAME)) {
    $("#show_quote :input").prop("disabled", true);
  }
  /* End Quote Final page script */

  /* Quote Version page script */


  if (['quotes.view.version'].includes(CURRENT_ROUTE_NAME)) {
    $("#version_quote :input").prop("disabled", true);
    $('#recall_version').on('click', function () {
      if ($(this).data('recall')) {
        if (confirm("Are you sure you want to Recall this Quotation?")) {
          $("#version_quote :input").prop("disabled", false);
          $('#recall_version').data('recall', false);
          $(this).text('Back Into Version');
          getMarkupTypeFeildAttribute();
        }
      } else {
        $("#version_quote :input").prop("disabled", true);
        $('#recall_version').prop("disabled", false);
        $(this).text('Recall Version');
      }
    });
  }
  /* End Quote Version page script */

  /*
  |--------------------------------------------------------------------------
  | Quote Management Calculation Functions
  |--------------------------------------------------------------------------
  */


  function onChangeAgencyCommissionType() {
    var agency = $("input[name=agency]:checked").val();
    var agencyCommissionType = $("input[name=agency_commission_type]:checked").val();

    if (agency == 1 && agencyCommissionType == 'net-price') {
      $('.paid-net-commission-on-departure').addClass('d-none');
    }

    if (agency == 1 && agencyCommissionType == 'paid-net-of-commission' || agency == 1 && agencyCommissionType == 'we-pay-commission-on-departure') {
      $('.paid-net-commission-on-departure').removeClass('d-none');
    }

    getCalculatedTotalNetMarkup();
    getCommissionRate();
  }

  $(document).on('change, click', '.agency-commission-type', function () {
    onChangeAgencyCommissionType();
  });
  $(document).on('change', '.agency-commission', function () {
    getCalculatedTotalNetMarkup();
    getCommissionRate();
  });

  function getCalculatedTotalNetMarkup() {
    var agencyCommission = $('.agency-commission').val();
    var agencyTotalMarkup = $('.total-markup-amount').val();
    var totalAgencyNetMarkup = parseFloat(agencyTotalMarkup) - parseFloat(agencyCommission);
    $('.total-net-margin').val(check(totalAgencyNetMarkup));
  }

  window.getQuoteTotalValues = function () {
    var markupType = $("input[name=markup_type]:checked").val();
    var estimatedCostInBookingCurrencyArray = $(".estimated-cost-in-booking-currency").map(function (i, e) {
      return parseFloat(e.value);
    }).get();
    var estimatedCostInBookingCurrency = estimatedCostInBookingCurrencyArray.reduce(function (a, b) {
      return a + b;
    }, 0);
    $(".total-net-price").val(check(estimatedCostInBookingCurrency));

    if (markupType == 'itemised') {
      var sellingPriceInBookingCurrencyArray = $(".selling-price-in-booking-currency").map(function (i, e) {
        return parseFloat(e.value);
      }).get();
      var sellingPriceInBookingCurrency = sellingPriceInBookingCurrencyArray.reduce(function (a, b) {
        return a + b;
      }, 0);
      var markupAmountInBookingCurrencyArray = $(".markup-amount-in-booking-currency").map(function (i, e) {
        return parseFloat(e.value);
      }).get();
      var markupAmountInBookingCurrency = markupAmountInBookingCurrencyArray.reduce(function (a, b) {
        return a + b;
      }, 0);
      var markupPercentageArray = $(".markup-percentage").map(function (i, e) {
        return parseFloat(e.value);
      }).get();
      var markupPercentage = markupPercentageArray.reduce(function (a, b) {
        return a + b;
      }, 0);
      var profitPercentageArray = $(".profit-percentage").map(function (i, e) {
        return parseFloat(e.value);
      }).get();
      var profitPercentage = profitPercentageArray.reduce(function (a, b) {
        return a + b;
      }, 0);
      $(".total-selling-price").val(check(sellingPriceInBookingCurrency));
      $(".total-markup-amount").val(check(markupAmountInBookingCurrency));
      $(".total-markup-percent").val(check(markupPercentage));
      $(".total-profit-percentage").val(check(profitPercentage));
    }

    if (markupType == 'whole') {
      $(".total-markup-amount").val(parseFloat(0).toFixed(2));
      $(".total-markup-percent").val(parseFloat(0).toFixed(2));
      $(".total-profit-percentage").val(parseFloat(0).toFixed(2));
      $(".total-selling-price").val(check(estimatedCostInBookingCurrency));
    }

    onChangeAgencyCommissionType();
    getCommissionRate();
    getBookingAmountPerPerson();
    getSellingPrice();
  };

  window.getQuoteDetailsValues = function (key, changeFeild) {
    var supplierCurrency = $("#quote_".concat(key, "_supplier_currency_id")).find(':selected').data('code');
    var bookingCurrency = $(".booking-currency-id").find(':selected').data('code');
    var rateType = $("input[name=rate_type]:checked").val();
    var markupType = $("input[name=markup_type]:checked").val();
    var estimatedCost = parseFloat($("#quote_".concat(key, "_estimated_cost")).val()).toFixed(2);
    var markupPercentage = parseFloat($("#quote_".concat(key, "_markup_percentage")).val());
    var markupAmount = parseFloat($("#quote_".concat(key, "_markup_amount")).val());
    var rate = getRate(supplierCurrency, bookingCurrency, rateType);
    var calculatedSellingPrice = 0;
    var calculatedMarkupPercentage = 0;
    var calculatedMarkupAmount = 0;
    var calculatedProfitPercentage = 0;
    var calculatedMarkupAmountInBookingCurrency = 0;
    var calculatedEstimatedCostInBookingCurrency = 0;
    var calculatedSellingPriceInBookingCurrency = 0;

    if (changeFeild == 'estimated_cost') {
      // calculatedProfitPercentage = ((parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice)) * 100;
      calculatedEstimatedCostInBookingCurrency = parseFloat(estimatedCost) * parseFloat(rate);
      $("#quote_".concat(key, "_estimated_cost_in_booking_currency")).val(check(calculatedEstimatedCostInBookingCurrency));

      if (markupType == 'itemised') {
        calculatedMarkupPercentage = parseFloat(markupAmount) / parseFloat(estimatedCost / 100);
        calculatedSellingPrice = parseFloat(markupAmount) + parseFloat(estimatedCost);
        calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
        $("#quote_".concat(key, "_markup_percentage")).val(check(calculatedMarkupPercentage));
        $("#quote_".concat(key, "_selling_price")).val(check(calculatedSellingPrice));
        $("#quote_".concat(key, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
      }
    }

    if (changeFeild == 'markup_amount') {
      calculatedSellingPrice = parseFloat(markupAmount) + parseFloat(estimatedCost);
      calculatedMarkupPercentage = parseFloat(markupAmount) / parseFloat(estimatedCost / 100);
      calculatedProfitPercentage = (parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice) * 100;
      calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * rate;
      calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
      $("#quote_".concat(key, "_markup_percentage")).val(check(calculatedMarkupPercentage));
      $("#quote_".concat(key, "_selling_price")).val(check(calculatedSellingPrice));
      $("#quote_".concat(key, "_profit_percentage")).val(check(calculatedProfitPercentage));
      $("#quote_".concat(key, "_markup_amount_in_booking_currency")).val(check(calculatedMarkupAmountInBookingCurrency));
      $("#quote_".concat(key, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
    }

    if (changeFeild == 'markup_percentage') {
      calculatedMarkupAmount = parseFloat(estimatedCost) / 100 * parseFloat(markupPercentage);
      calculatedSellingPrice = parseFloat(calculatedMarkupAmount) + parseFloat(estimatedCost);
      calculatedProfitPercentage = (parseFloat(calculatedSellingPrice) - parseFloat(estimatedCost)) / parseFloat(calculatedSellingPrice) * 100;
      calculatedMarkupAmountInBookingCurrency = parseFloat(calculatedMarkupAmount) * parseFloat(rate);
      calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
      $("#quote_".concat(key, "_markup_amount")).val(check(calculatedMarkupAmount));
      $("#quote_".concat(key, "_selling_price")).val(check(calculatedSellingPrice));
      $("#quote_".concat(key, "_profit_percentage")).val(check(calculatedProfitPercentage));
      $("#quote_".concat(key, "_markup_amount_in_booking_currency")).val(check(calculatedMarkupAmountInBookingCurrency));
      $("#quote_".concat(key, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
    }

    getQuoteTotalValues();
  };

  window.getQuoteRateTypeValues = function () {
    var rateType = $("input[name=rate_type]:checked").val();
    var estimatedCostArray = $(".estimated-cost").map(function (i, e) {
      return parseFloat(e.value).toFixed(2);
    }).get();
    var sellingPriceArray = $(".selling-price").map(function (i, e) {
      return parseFloat(e.value).toFixed(2);
    }).get();
    var markupAmountArray = $(".markup-amount").map(function (i, e) {
      return parseFloat(e.value).toFixed(2);
    }).get();
    var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
    var supplierCurrencyArray = $(".supplier-currency-id").map(function (i, e) {
      return $(e).find(":selected").data("code");
    }).get();
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

      $("#quote_".concat(key, "_estimated_cost_in_booking_currency")).val(check(calculatedEstimatedCostInBookingCurrency));
      $("#quote_".concat(key, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
      $("#quote_".concat(key, "_markup_amount_in_booking_currency")).val(check(calculatedMarkupAmountInBookingCurrency));
      key++;
    }

    getQuoteTotalValues();
  };

  window.getQuoteSupplierCurrencyValues = function (supplierCurrency, key) {
    var rateType = $("input[name=rate_type]:checked").val();
    var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
    var estimatedCost = parseFloat($("#quote_".concat(key, "_estimated_cost")).val()).toFixed(2);
    var markupAmount = parseFloat($("#quote_".concat(key, "_markup_amount")).val()).toFixed(2);
    var sellingPrice = parseFloat($("#quote_".concat(key, "_selling_price")).val()).toFixed(2);
    var rate = getRate(supplierCurrency, bookingCurrency, rateType);
    var calculatedEstimatedCostInBookingCurrency = 0;
    var calculatedMarkupAmountInBookingCurrency = 0;
    var calculatedSellingPriceInBookingCurrency = 0;
    calculatedEstimatedCostInBookingCurrency = parseFloat(estimatedCost) * parseFloat(rate);
    calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);
    calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);
    $("#quote_".concat(key, "_estimated_cost_in_booking_currency")).val(check(calculatedEstimatedCostInBookingCurrency));
    $("#quote_".concat(key, "_markup_amount_in_booking_currency")).val(check(calculatedMarkupAmountInBookingCurrency));
    $("#quote_".concat(key, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
  };
  /*
  |--------------------------------------------------------------------------
  | End Quote Management
  |--------------------------------------------------------------------------
  */

});

/***/ }),

/***/ "./resources/js/quote_template/quote_template.js":
/*!*******************************************************!*\
  !*** ./resources/js/quote_template/quote_template.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $(document).on('change', '.markup-type', function () {
    getMarkupTypeFeildAttribute();
  });

  function reinitializedSummerNote(quoteClass) {
    jQuery("".concat(quoteClass)).find('.note-editor').remove();
    jQuery("".concat(quoteClass)).find('.summernote').summernote({
      height: 100,
      //set editable area's height
      placeholder: 'Enter Text Here..',
      codemirror: {
        // codemirror options
        theme: 'monokai'
      }
    });
  }

  function getMarkupTypeFeildAttribute() {
    console.log("working");
    var markupType = $("input[name=markup_type]:checked").val();

    if (markupType == 'whole') {
      $('.whole-markup-feilds').addClass('d-none');
      $('.total-markup-amount').removeAttr('readonly');
      $('.total-markup-percent').removeAttr('readonly');
      getQuoteTotalValues();
    } else if (markupType == 'itemised') {
      $('.whole-markup-feilds').removeClass('d-none');
      $('.total-markup-amount').prop('readonly', true);
      $('.total-markup-percent').prop('readonly', true);
      getQuoteTotalValues();
    }
  }

  $(document).on('click', '.remove-quote-detail-service', function (e) {
    e.preventDefault();

    if (confirm("Are you sure you want to Remove this Service?") == true) {
      $(this).closest(".quote").remove();
      getQuoteTotalValues();
    }
  });
  $(document).on("keyup change", '.change-calculation', function (event) {
    var key = $(this).closest('.quote').data('key');
    var changeFeild = $(this).attr("data-name");
    getQuoteDetailsValues(key, changeFeild);
  });
  $(document).on('change', '.supplier-currency-id', function () {
    var code = $(this).find(':selected').data('code');
    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var bookingCurrency = $('#currency_id').val();
    var currency_name = $(this).find(':selected').attr('data-name');
    var supplierCurrency = $(this).val();

    if (typeof supplierCurrency === 'undefined' || supplierCurrency == "") {
      quote.find("[class*=supplier-currency-code]").html("");
      quote.find('.badge-supplier-currency-id').html("");
      return;
    }

    if (typeof bookingCurrency === 'undefined' || bookingCurrency == "") {
      alert("Please Select Booking Currency first");
      return;
    }

    quote.find("[class*=supplier-currency-code]").html(code);
    quote.find('.badge-supplier-currency-id').html(currency_name); // quote.find('.badge-supplier-currency-id').removeClass('d-none');

    getQuoteSupplierCurrencyValues(code, quoteKey);
    getQuoteTotalValues();
  });
  $(document).on('click', '.quotes-service-category-btn-below', function (e) {
    e.preventDefault();
    var category_id = $(this).attr('data-id');
    var category_name = $(this).attr('data-name');
    var classvalue = jQuery('#new_service_modal_below').find('.current-key').val();
    var onQuoteClass = ".quote-".concat(classvalue);
    jQuery('#new_service_modal_below').modal('hide');
    $('.parent-spinner').addClass('spinner-border');

    if (category_id) {
      setTimeout(function () {
        if ($('.select2single').data('select2')) {
          $('.select2single').select2('destroy');
        }

        if ($('.select2-multiple').data('select2')) {
          $('.select2-multiple').select2('destroy');
        }

        var quote = $(".quote").eq(0).clone().find("input").val("").each(function () {
          this.name = this.name.replace(/\[(\d+)\]/, function () {
            var quoteLength = $('.quote').length;
            return "[".concat(quoteLength, "]");
          });
          this.id = this.id.replace(/\d+/g, $('.quote').length, function () {
            var quoteLength = $('.quote').length;
            var dataName = $(this).attr("data-name");
            return "quote_".concat(quoteLength, "_").concat(dataName);
          });
        }).end().find("textarea").val("").each(function () {
          this.name = this.name.replace(/\[(\d+)\]/, function () {
            var quoteLength = $('.quote').length;
            return "[".concat(quoteLength, "]");
          });
          this.id = this.id.replace(/\d+/g, $('.quote').length, function () {
            var quoteLength = $('.quote').length;
            var dataName = $(this).attr("data-name");
            return "quote_".concat(quoteLength, "_").concat(dataName);
          });
        }).end().find("select").val("").each(function () {
          this.name = this.name.replace(/\[(\d+)\]/, function () {
            var quoteLength = $('.quote').length;
            return "[".concat(quoteLength, "]");
          });
          this.id = this.id.replace(/\d+/g, $('.quote').length, function () {
            var quoteLength = $('.quote').length;
            var dataName = $(this).attr("data-name");
            return "quote_".concat(quoteLength, "_").concat(dataName);
          });
        }).end().show().insertAfter(onQuoteClass);
        var quoteLength = $('.quote').length;
        var quoteKey = quoteLength - 1;
        var quoteClass = ".quote-".concat(quoteKey);
        quote.attr('data-key', quoteKey);
        quote.removeClass("quote-0");
        quote.addClass("quote-".concat(quoteKey)); // $(`#quote_${quoteKey}_date_of_service`).val(todayDate());

        $("#quote_".concat(quoteKey, "_estimated_cost, #quote_").concat(quoteKey, "_markup_amount")).val('0.00');
        $("#quote_".concat(quoteKey, "_markup_percentage, #quote_").concat(quoteKey, "_selling_price")).val('0.00');
        $("#quote_".concat(quoteKey, "_profit_percentage, #quote_").concat(quoteKey, "_estimated_cost_in_booking_currency")).val('0.00');
        $("#quote_".concat(quoteKey, "_markup_amount_in_booking_currency, #quote_").concat(quoteKey, "_selling_price_in_booking_currency")).val('0.00'); // $(`#quote_${quoteKey}_table_name`).val('QuoteDetail');

        $("".concat(quoteClass)).find('.supplier-id').html("<option value=''>Select Supplier</option>");
        $("".concat(quoteClass)).find('.text-danger, .supplier-currency-code').html('');
        $("".concat(quoteClass)).find('input, select').removeClass('is-invalid');
        $("".concat(quoteClass)).find('.card-header .card-tools .remove').addClass('remove-quote-detail-service');
        $("".concat(quoteClass)).find('.card-header .card-tools .remove').removeClass('d-none');
        $("".concat(quoteClass)).find('.refundable-percentage-feild').addClass('d-none');
        $("".concat(quoteClass)).find('.category-id').val(category_id).change();
        $("".concat(quoteClass)).find('.badge-category-id').html(category_name);
        $("".concat(quoteClass)).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').html(''); // $(`${quoteClass}`).find('.badge-date-of-service').html(todayDate());

        $("".concat(quoteClass)).find('.fileManger').attr('data-input', "quote_".concat(quoteKey, "_image"));
        $("".concat(quoteClass)).find('.fileManger').attr('data-preview', "quote_".concat(quoteKey, "_holder"));
        $("".concat(quoteClass)).find('.previewId').attr('id', "quote_".concat(quoteKey, "_holder"));
        $("#quote_".concat(quoteKey, "_holder")).empty();
        callLaravelFileManger();
        datepickerReset(1, "".concat(quoteClass));
        reinitializedSummerNote("".concat(quoteClass));
        reinitializedDynamicFeilds();
        reinitializedMultiDynamicFeilds();
        $('html, body').animate({
          scrollTop: $(quoteClass).offset().top
        }, 1000);
        $('.parent-spinner').removeClass('spinner-border');
      }, 180);
    }
  });
  $(document).on('click', '.add-new-service-below', function (e) {
    var quote = $(this).closest('.quote').data('key');
    jQuery('#new_service_modal_below').modal('show');
    jQuery('#new_service_modal_below').find('.current-key').val(quote);
  });
  $(document).on('click', '.quotes-service-category-btn', function (e) {
    e.preventDefault();
    var category_id = $(this).attr('data-id');
    var category_name = $(this).attr('data-name');
    jQuery('#new_service_modal').modal('hide');
    $('.parent-spinner').addClass('spinner-border');

    if (category_id) {
      setTimeout(function () {
        if ($('.select2single').data('select2')) {
          $('.select2single').select2('destroy');
        }

        if ($('.select2-multiple').data('select2')) {
          $('.select2-multiple').select2('destroy');
        }

        var quote = $(".quote").eq(0).clone().find("input").val("").each(function () {
          this.name = this.name.replace(/\[(\d+)\]/, function () {
            var quoteLength = $('.quote').length;
            return "[".concat(quoteLength, "]");
          });
          this.id = this.id.replace(/\d+/g, $('.quote').length, function () {
            var quoteLength = $('.quote').length;
            var dataName = $(this).attr("data-name");
            return "quote_".concat(quoteLength, "_").concat(dataName);
          });
        }).end().find("textarea").val("").each(function () {
          this.name = this.name.replace(/\[(\d+)\]/, function () {
            var quoteLength = $('.quote').length;
            return "[".concat(quoteLength, "]");
          });
          this.id = this.id.replace(/\d+/g, $('.quote').length, function () {
            var quoteLength = $('.quote').length;
            var dataName = $(this).attr("data-name");
            return "quote_".concat(quoteLength, "_").concat(dataName);
          });
        }).end().find("select").val("").each(function () {
          this.name = this.name.replace(/\[(\d+)\]/, function () {
            var quoteLength = $('.quote').length;
            return "[".concat(quoteLength, "]");
          });
          this.id = this.id.replace(/\d+/g, $('.quote').length, function () {
            var quoteLength = $('.quote').length;
            var dataName = $(this).attr("data-name");
            return "quote_".concat(quoteLength, "_").concat(dataName);
          });
        }).end().show().insertAfter(".quote:last");
        var quoteLength = $('.quote').length;
        var quoteKey = quoteLength - 1;
        var quoteClass = ".quote-".concat(quoteKey);
        quote.attr('data-key', quoteKey);
        quote.removeClass("quote-0");
        quote.addClass("quote-".concat(quoteKey)); // $(`#quote_${quoteKey}_date_of_service`).val(todayDate());

        $("#quote_".concat(quoteKey, "_estimated_cost, #quote_").concat(quoteKey, "_markup_amount")).val('0.00');
        $("#quote_".concat(quoteKey, "_markup_percentage, #quote_").concat(quoteKey, "_selling_price")).val('0.00');
        $("#quote_".concat(quoteKey, "_profit_percentage, #quote_").concat(quoteKey, "_estimated_cost_in_booking_currency")).val('0.00');
        $("#quote_".concat(quoteKey, "_markup_amount_in_booking_currency, #quote_").concat(quoteKey, "_selling_price_in_booking_currency")).val('0.00'); // $(`#quote_${quoteKey}_table_name`).val('QuoteDetail');

        $("".concat(quoteClass)).find('.supplier-id').html("<option value=''>Select Supplier</option>");
        $("".concat(quoteClass)).find('.text-danger, .supplier-currency-code').html('');
        $("".concat(quoteClass)).find('input, select').removeClass('is-invalid');
        $("".concat(quoteClass)).find('.card-header .card-tools .remove').addClass('remove-quote-detail-service');
        $("".concat(quoteClass)).find('.card-header .card-tools .remove').removeClass('d-none');
        $("".concat(quoteClass)).find('.refundable-percentage-feild').addClass('d-none');
        $("".concat(quoteClass)).find('.category-id').val(category_id).change();
        $("".concat(quoteClass)).find('.badge-category-id').html(category_name);
        $("".concat(quoteClass)).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').html(''); // $(`${quoteClass}`).find('.badge-date-of-service').html(todayDate());

        $("".concat(quoteClass)).find('.fileManger').attr('data-input', "quote_".concat(quoteKey, "_image"));
        $("".concat(quoteClass)).find('.fileManger').attr('data-preview', "quote_".concat(quoteKey, "_holder"));
        $("".concat(quoteClass)).find('.previewId').attr('id', "quote_".concat(quoteKey, "_holder"));
        $("#quote_".concat(quoteKey, "_holder")).empty();
        callLaravelFileManger();
        datepickerReset(1, "".concat(quoteClass));
        reinitializedSummerNote("".concat(quoteClass));
        reinitializedDynamicFeilds();
        reinitializedMultiDynamicFeilds();
        $('html, body').animate({
          scrollTop: $('.quote:last').offset().top
        }, 1000);
        $('.parent-spinner').removeClass('spinner-border');
      }, 180);
    }
  });
  callLaravelFileManger();

  function callLaravelFileManger() {
    var route_prefix = FILE_MANAGER_URL;
    jQuery('.fileManger').filemanager('image', {
      prefix: route_prefix
    });
  }
});

/***/ }),

/***/ 2:
/*!************************************************!*\
  !*** multi ./resources/js/quote_management.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\ufg-form\resources\js\quote_management.js */"./resources/js/quote_management.js");


/***/ })

/******/ });