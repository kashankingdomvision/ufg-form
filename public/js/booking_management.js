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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/booking_management.js":
/*!********************************************!*\
  !*** ./resources/js/booking_management.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./quote_booking/quote_booking */ "./resources/js/quote_booking/quote_booking.js");

__webpack_require__(/*! ./quote_booking_template/quote_booking_template */ "./resources/js/quote_booking_template/quote_booking_template.js");

__webpack_require__(/*! ./booking_management/booking_app */ "./resources/js/booking_management/booking_app.js");

/***/ }),

/***/ "./resources/js/booking_management/booking_app.js":
/*!********************************************************!*\
  !*** ./resources/js/booking_management/booking_app.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $('#bookingVersion :input').prop('disabled', true);

  function getBookingMarkupTypeFeildAttribute() {
    var markupType = $("input[name=markup_type]:checked").val();

    if (markupType == 'whole') {
      $('.booking-whole-markup-feilds').addClass('d-none');
      $('.total-markup-amount').removeAttr('readonly');
      $('.total-markup-percent').removeAttr('readonly');
      getBookingTotalValues();
    } else if (markupType == 'itemised') {
      $('.booking-whole-markup-feilds').removeClass('d-none');
      $('.total-markup-amount').prop('readonly', true);
      $('.total-markup-percent').prop('readonly', true);
      getBookingTotalValues();
    }
  }

  function getBookingTotalValuesOnMarkupChange(changeFeild) {
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
    getCalculatedTotalNetMarkup();
  }

  $(document).on('click', '.increment', function () {
    var close = $(this).closest('.finance-clonning');
    var valueElement = close.find('.ab_number_of_days');
    var dueDate = close.find('.deposit-due-date').val();
    var nowDate = todayDate();
    var firstDate = new Date(dueDate);
    var secondDate = convertDate(nowDate);

    if (firstDate == 'Invalid Date') {
      alert('Due Date is Required');
    } else {
      if (!$(valueElement).is('[readonly]')) {
        var oneDay = 24 * 60 * 60 * 1000;
        var diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));

        if (firstDate < secondDate) {
          $(this).attr('disabled', true);
        } else {
          var _valueElement$val;

          if (valueElement.val() == '') {
            valueElement.val(0);
          }

          var count = Math.max(parseInt((_valueElement$val = valueElement.val()) !== null && _valueElement$val !== void 0 ? _valueElement$val : 0));
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
  $(document).on('change', '.deposit-due-date', function () {
    var close = $(this).closest('.finance-clonning');
    close.find('.plus').removeAttr('disabled');
  }); // for booking

  $(document).on('change', '.booking-total-markup-change', function () {
    var changeFeild = $(this).attr("data-name");
    getBookingTotalValuesOnMarkupChange(changeFeild);
  });
  $(document).on('change', '.booking-markup-type', function () {
    getBookingMarkupTypeFeildAttribute();
  }); // booking update payment

  $("#update-payment").submit(function (event) {
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
      beforeSend: function beforeSend() {
        $("#overlay").addClass('overlay');
        $("#overlay").html("<i class=\"fas fa-2x fa-sync-alt fa-spin\"></i>");
      },
      success: function success(data) {
        $("#overlay").removeClass('overlay').html('');
        setTimeout(function () {
          alert(data.success_message);
          window.location.href = REDIRECT_BASEURL + "bookings/index";
        }, 1000);
      },
      error: function error(reject) {
        if (reject.status === 422) {
          var errors = $.parseJSON(reject.responseText);
          setTimeout(function () {
            $("#overlay").removeClass('overlay').html('');

            if (errors.hasOwnProperty("overrride_errors")) {
              alert(errors.overrride_errors);
              window.location.href = REDIRECT_BASEURL + "bookings/index";
            } else {
              var flag = true;
              jQuery.each(errors.errors, function (index, value) {
                index = index.replace(/\./g, '_');
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
  $("#update-booking").submit(function (event) {
    event.preventDefault();
    $('.payment-method').removeAttr('disabled');
    var url = $(this).attr('action');
    var formData = new FormData(this);
    var agency = $("input[name=agency]:checked").val();
    var full_number = '';

    if (agency == 0) {
      full_number = $('#lead_passenger_contact').closest('.form-group').find("input[name='full_number']").val();
    } else {
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
      beforeSend: function beforeSend() {
        $('input, select').removeClass('is-invalid');
        $('.text-danger').html('');
        $("#overlay").addClass('overlay');
        $("#overlay").html("<i class=\"fas fa-2x fa-sync-alt fa-spin\"></i>");
      },
      success: function success(data) {
        $("#overlay").removeClass('overlay').html('');
        setTimeout(function () {
          if (data && data.status == 200) {
            alert(data.success_message);
            window.location.href = REDIRECT_BASEURL + "bookings/index"; // location.reload();
          }
        }, 200);
      },
      error: function error(reject) {
        if (reject.status === 422) {
          var errors = $.parseJSON(reject.responseText);
          setTimeout(function () {
            $("#overlay").removeClass('overlay').html('');

            if (errors.hasOwnProperty("overrride_errors")) {
              alert(errors.overrride_errors);
              window.location.href = REDIRECT_BASEURL + "bookings/index";
            } else {
              var flag = true;
              jQuery.each(errors.errors, function (index, value) {
                index = index.replace(/\./g, '_'); // expand quote if feild has an error

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
          }, 200);
        }
      }
    });
  });
  $(document).on('change', '.cancellation-refund-amount', function () {
    var cancellationRefundAmount = $(this).val();
    var cancellationRefundTotalAmount = $('#cancellation_refund_total_amount').val();
    console.log(" cancellationRefundAmount: " + cancellationRefundAmount);
    console.log(" cancellationRefundTotalAmount: " + cancellationRefundTotalAmount);
    var totalCancellationRefundAmountArray = $('.cancellation-payments').find('.cancellation-refund-amount').map(function (i, e) {
      return parseFloat(e.value);
    }).get();
    var totalCancellationRefundAmount = totalCancellationRefundAmountArray.reduce(function (a, b) {
      return a + b;
    }, 0);

    if (totalCancellationRefundAmount > cancellationRefundTotalAmount) {
      alert("Please Enter Correct Refund Amount.");
      $(this).val("0.00");
    }
  });
  $(document).on('click', '.add-more-cancellation-payments', function () {
    if ($('.select2single').data('select2')) {
      $('.select2single').select2('destroy');
    }

    var cancellationPayments = $('.cancellation-payments');
    var cancellationRefundPaymentRow = $(".cancellation-refund-payment-row").length;
    cancellationPayments.find('.cancellation-refund-payment-row').first().clone().find("input").val("").each(function () {
      var name = $(this).attr("data-name");
      this.name = this.name.replace(/\[(\d+)\]/, function () {
        return "[".concat(cancellationRefundPaymentRow, "]");
      });
      this.id = this.id.replace(/\d+/g, cancellationRefundPaymentRow, function () {
        return "cancellation_refund_".concat(cancellationRefundPaymentRow, "_").concat(name);
      });
    }).end().find('.cancellation-refund-payment-label').each(function () {
      this.id = "cancellation_refund_payment_label_".concat(cancellationRefundPaymentRow);
      $(this).text("Refund Amount #".concat(cancellationRefundPaymentRow + 1));
    }).end().find("select").val("").each(function () {
      var name = $(this).attr("data-name");
      this.name = this.name.replace(/\[(\d+)\]/, function () {
        return "[".concat(cancellationRefundPaymentRow, "]");
      });
      this.id = this.id.replace(/\d+/g, cancellationRefundPaymentRow, function () {
        return "cancellation_refund_".concat(cancellationRefundPaymentRow, "_").concat(name);
      });
    }).end().find('.select2single').select2({
      width: '100%',
      theme: "bootstrap"
    }).end().show().insertAfter($('.cancellation-refund-payment-row:last')); // set feild after clone
    // quote.find('.finance-clonning:last .checkbox').prop('checked', false);
    // quote.find('.finance-clonning:last .deposit-amount').val('0.00').attr("readonly", false);
    // quote.find('.finance-clonning:last .ab_number_of_days').val('0').attr("readonly", false);
    // quote.find('.finance-clonning:last').attr('data-financekey',financeCloningLength);

    cancellationPayments.find('.cancellation-refund-payment-row:last .cancellation-refund-payment-row-remove-btn').removeClass('d-none');
    reinitializedSingleSelect2();
  });
  $(document).on('click', '.clone_booking_finance', function () {
    if ($('.select2single').data('select2')) {
      $('.select2single').select2('destroy');
    }

    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var financeCloningLength = quote.find(".finance-clonning").length;
    quote.find('.finance-clonning').first().clone().find("input").val("").each(function () {
      var n = 1;
      var name = $(this).attr("data-name");
      this.name = this.name.replace(/]\[(\d+)]/g, function () {
        return "][".concat(financeCloningLength, "]");
      });
      this.id = this.id.replace(/[0-9]+/g, function (v) {
        return n++ == 2 ? financeCloningLength : v;
      }, function () {
        return "quote_".concat(quoteKey, "_finance_").concat(financeCloningLength, "_").concat(name);
      });
    }).end().find('.depositeLabel').each(function () {
      this.id = 'deposite_heading' + financeCloningLength;
      $(this).text("Payment #".concat(financeCloningLength + 1));
    }).end().find("select").val("").each(function () {
      var n = 1;
      var name = $(this).attr("data-name");
      this.name = this.name.replace(/]\[(\d+)]/g, function () {
        return "][".concat(financeCloningLength, "]");
      });
      this.id = this.id.replace(/[0-9]+/g, function (v) {
        return n++ == 2 ? financeCloningLength : v;
      }, function () {
        return "quote_".concat(quoteKey, "_finance_").concat(financeCloningLength, "_").concat(name);
      });
    }).end().find('.select2single').select2({
      width: '100%',
      theme: "bootstrap"
    }).end().show().insertAfter(quote.find('.finance-clonning:last')); // set feild after clone

    quote.find('.finance-clonning:last .checkbox').prop('checked', false);
    quote.find('.finance-clonning:last .deposit-amount').val('0.00').attr("readonly", false);
    quote.find('.finance-clonning:last .ab_number_of_days').val('0').attr("readonly", false);
    quote.find('.finance-clonning:last').attr('data-financekey', financeCloningLength);
    reinitializedSingleSelect2();
  });
  $("#cancel_booking_submit").submit(function (event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var formData = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: url,
      data: formData,
      beforeSend: function beforeSend() {
        $('input').removeClass('is-invalid');
        $('.text-danger').html('');
        $("#submit_cancel_booking").find('span').addClass('spinner-border spinner-border-sm');
      },
      success: function success(data) {
        $("#submit_cancel_booking").find('span').removeClass('spinner-border spinner-border-sm');
        jQuery('#cancel_booking').modal('hide');
        setTimeout(function () {
          if (data.success_message) {
            alert(data.success_message);
            location.reload();
          }
        }, 400);
      },
      error: function error(reject) {
        if (reject.status === 422) {
          var errors = $.parseJSON(reject.responseText);
          setTimeout(function () {
            $("#submit_cancel_booking").find('span').removeClass('spinner-border spinner-border-sm');
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
  $(document).on('click', '.remove-booking-detail-service', function (e) {
    e.preventDefault();

    if (confirm("Are you sure you want to Remove this Service?") == true) {
      $(this).closest(".quote").remove();
      getBookingTotalValues();
    }
  });
  $(document).on('click', '.revert-booking-detail-cancellation', function (e) {
    e.preventDefault();
    var booking_detail_id = $(this).attr('data-bookingDetialID');

    if (confirm("Are you sure you want to Revert Cancelled Service?") == true) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': CSRFTOKEN
        },
        url: "".concat(REDIRECT_BASEURL, "bookings/revert-booking-detail-cancellation/").concat(booking_detail_id),
        type: 'GET',
        success: function success(data) {
          setTimeout(function () {
            if (data.success_message) {
              alert(data.success_message);
              location.reload();
            }
          }, 100);
        },
        error: function error(reject) {}
      });
    }
  });
  $(document).on('click', '.booking-detail-cancellation', function (e) {
    e.preventDefault();
    var booking_detail_id = $(this).attr('data-bookingDetialID');
    var quote = jQuery(this).closest('.quote');
    var quoteKey = quote.data('key');
    var created_by = $("#quote_".concat(quoteKey, "_created_by")).val();
    var data = {
      booking_detail_id: booking_detail_id,
      booking_cancelled_by_id: created_by
    };

    if (confirm("Are you sure you want to Cancel this Service?") == true) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': CSRFTOKEN
        },
        url: "".concat(REDIRECT_BASEURL, "bookings/booking-detail-cancellation"),
        type: 'POST',
        data: data,
        success: function success(data) {
          setTimeout(function () {
            if (data.success_message) {
              alert(data.success_message);
              location.reload();
            }
          }, 100);
        },
        error: function error(reject) {}
      });
    }
  }); // also used in customer booking

  $(document).on('click', '.cancel-booking', function (e) {
    e.preventDefault();

    if (confirm("Are you sure you want to Cancel Booking?") == true) {
      var booking_id = $(this).attr('data-bookingid');
      jQuery('#cancel_booking').modal('show');
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': CSRFTOKEN
        },
        url: "".concat(REDIRECT_BASEURL, "bookings/get-booking-net-price/").concat(booking_id),
        type: 'get',
        success: function success(data) {
          // console.log(data);
          if (data !== null && data !== '' && data !== undefined) {
            jQuery('#cancel_booking').modal('show').find('#booking_currency_id').val(data.booking_currency_id);
            jQuery('#cancel_booking').modal('show').find('#booking_net_price').val(data.booking_net_price);
            jQuery('#cancel_booking').modal('show').find('#booking_net_price_text').text("Cancellation Charges should not be greater ".concat(data.booking_net_price, " ").concat(data.booking_currency_code));
            jQuery('#cancel_booking').modal('show').find('#booking_id').val(booking_id);
            jQuery('#cancel_booking').modal('show').find('#booking_currency_code').text(data.booking_currency_code);
          }
        },
        error: function error(reject) {}
      });
    }
  });
  $(document).on('click', '.view-payment_detail', function () {
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

    tbody += "<tr>\n            <th>Ref #</th>\n            <td>".concat(isEmpty(details.zoho_booking_reference), "</td>\n        </tr>\n        <tr>\n            <th>Status</th>\n            <td>").concat(isEmpty(details.status), "</td>\n        </tr>\n        <tr>\n            <th>Payment For</th>\n            <td>").concat(isEmpty(details.payment_for), "</td>\n        </tr>\n        <tr>\n            <th>Payment Method</th>\n            <td>").concat(isEmpty(payment_method), "</td>\n        </tr>\n        <tr>\n            <th>Date</th>\n            <td>").concat(isEmpty(details.date), "</td>\n        </tr>\n        <tr>\n            <th>Amount</th>\n            <td>").concat(isEmpty(details.amount), "</td>\n        </tr>\n        <tr>\n            <th>Type</th>\n            <td>").concat(isEmpty(client_type), "</td>\n        </tr>\n        <tr>\n            <th>Ref ID</th>\n            <td>").concat(isEmpty(details.ref_id), "</td>\n        </tr>\n        <tr>\n            <th>Card Holder Name</th>\n            <td>").concat(isEmpty(details.card_holder_name), "</td>\n        </tr>\n        <tr>\n            <th>Address</th>\n            <td>").concat(isEmpty(details.b_street_address), "</td>\n        </tr>\n        <tr>\n            <th>Post Code</th>\n            <td>").concat(isEmpty(details.b_zip_code), "</td>\n        </tr>\n        <tr>\n            <th>Note</th>\n            <td>").concat(isEmpty(details.note), "</td>\n        </tr>\n        <tr>\n            <th>Sort Code</th>\n            <td>").concat(isEmpty(details.sort_code), "</td>\n        </tr>\n        <tr>\n            <th>Created At</th>\n            <td>").concat(isEmpty(details.created_at), "</td>\n        </tr>\n        <tr>\n            <th>Amount Payable</th>\n            <td>").concat(isEmpty(details.amount_payable), "</td>\n        </tr>");
    jQuery('#payment_details_modal').modal('show');
    jQuery('#payment_details_modal_body').html(tbody);
  });
  $(document).on('change', '.cal_selling_price', function () {
    var key = $(this).closest('.quote').data('key');
    var changeFeild = 'estimated_cost';

    if ($(this).is(':checked')) {
      $("#quote_".concat(key, "_markup_amount")).attr("readonly", false);
      $("#quote_".concat(key, "_markup_percentage")).attr("readonly", false);
      $("#quote_".concat(key, "_actual_cost")).attr("data-status", "");
    } else {
      $("#quote_".concat(key, "_markup_amount")).attr("readonly", true);
      $("#quote_".concat(key, "_markup_percentage")).attr("readonly", true);
      $("#quote_".concat(key, "_actual_cost")).attr("data-status", "booking");
      ;
    }
  });
  $(document).on("keyup change", '.change', function (event) {
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
  $(document).on('click', '.bookings-service-category-btn', function (e) {
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
        quote.addClass("quote-".concat(quoteKey));
        $("".concat(quoteClass)).find('.finance .row:not(:first):not(:last)').remove();
        $("".concat(quoteClass)).find('.actual-cost').attr("data-status", "");
        $("".concat(quoteClass)).find('.markup-amount').attr("readonly", false);
        $("".concat(quoteClass)).find('.markup-percentage').attr("readonly", false);
        $("".concat(quoteClass)).find('.cal_selling_price').attr('checked', 'checked');
        $("".concat(quoteClass)).find('.deposit-amount').val('0.00');
        $("".concat(quoteClass, " .finance")).find("input").val("").each(function () {
          this.name = this.name.replace(/\[(\d+)\]/, function () {
            // return '[' + ($('.quote').length - 1) + ']';
            var quoteLength = parseInt($('.quote').length) - 1;
            return "[".concat(quoteLength, "]");
          });
          var n = 1;
          this.id = this.id.replace(/[0-9]+/g, function (v) {
            return n++ == 2 ? 0 : v;
          }, function () {
            var name = $(this).attr("data-name");
            var quoteLength = parseInt($('.quote').length) - 1;
            return "quote_".concat(quoteLength, "_finance_", 0, "_").concat(name);
          });
        }).end().find("select").val("").each(function () {
          this.name = this.name.replace(/\[(\d+)\]/, function () {
            var quoteLength = parseInt($('.quote').length) - 1;
            return "[".concat(quoteLength, "]");
          });
          var n = 1;
          this.id = this.id.replace(/[0-9]+/g, function (v) {
            return n++ == 2 ? 0 : v;
          }, function () {
            var name = $(this).attr("data-name");
            var quoteLength = parseInt($('.quote').length) - 1;
            return "quote_".concat(quoteLength, "_finance_", 0, "_").concat(name);
          });
        }); // $(`#quote_${quoteKey}_date_of_service`).val(todayDate());

        $("#quote_".concat(quoteKey, "_table_name")).val('BookingDetail');
        $("".concat(quoteClass)).find('.mediaModal').find('a').attr('id', '');
        $("".concat(quoteClass)).find('.refund-payment-hidden-section').attr("hidden", true);
        $("".concat(quoteClass)).find('.refund-by-credit-note-section').attr("hidden", true);
        $("".concat(quoteClass)).find('.finance-clonning').removeClass("cancelled-payment-styling");
        $("".concat(quoteClass)).find('.btn-group').removeClass("d-none");
        $("".concat(quoteClass)).find('.clone_booking_finance').removeClass("d-none");
        $("".concat(quoteClass)).find('.finance-clonning input, .finance-clonning select').attr("readonly", false);
        $("".concat(quoteClass)).find('.payment-method').attr("disabled", false);
        $("".concat(quoteClass)).find('.outstanding-amount').attr("readonly", true);
        $("".concat(quoteClass)).find('.cancel-payemnt-btn').attr("hidden", true);
        $("".concat(quoteClass)).find('.refund-by-credit-note-section').remove();
        $("".concat(quoteClass)).find('.refund-by-bank-section').remove();
        $("".concat(quoteClass)).find('.supplier-id').html("<option selected value=\"\">Select Supplier</option>");
        $("".concat(quoteClass)).find('.product-id').html("<option selected value=\"\">Select Product</option>");
        $("".concat(quoteClass)).find(".estimated-cost, .actual-cost, .markup-amount, .markup-percentage, .selling-price, .profit-percentage, .estimated-cost-in-booking-currency, .selling-price-in-booking-currency, .markup-amount-in-booking-currency").val('0.00').attr('data-code', '');
        $("".concat(quoteClass)).find('.text-danger, .supplier-currency-code').html('');
        $("".concat(quoteClass)).find('input, select').removeClass('is-invalid');
        $("".concat(quoteClass)).find('.added-in-sage').removeAttr('checked');
        $("".concat(quoteClass)).find('.booking-detail-cancellation').remove();
        $("".concat(quoteClass)).find('.revert-booking-detail-cancellation').remove();
        $("".concat(quoteClass)).find('.category-id').val(category_id).change();
        $("".concat(quoteClass)).find('.badge-category-id').html(category_name);
        $("".concat(quoteClass)).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').addClass('d-none');
        $("".concat(quoteClass)).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').html(''); // $(`${quoteClass}`).find('.badge-date-of-service').html(todayDate());

        $("".concat(quoteClass)).find('.badge-service-status').html('');
        $("".concat(quoteClass)).find('.finance-clonning-btn, .calender-feild-form-group').removeClass('d-none');
        datepickerReset(1, "".concat(quoteClass));
        reinitializedSingleSelect2();
        reinitializedMultiDynamicFeilds();
        $('html, body').animate({
          scrollTop: $("".concat(quoteClass)).offset().top
        }, 1000);
        $('.parent-spinner').removeClass('spinner-border');
      }, 180);
    }
  });
  $(document).on('click', '.bookings-service-category-btn-below', function (e) {
    e.preventDefault();
    var category_id = $(this).attr('data-id');
    var category_name = $(this).attr('data-name');
    jQuery('#new_service_modal_below').modal('hide');
    $('.parent-spinner').addClass('spinner-border');
    var classvalue = jQuery('#new_service_modal_below').find('.current-key').val();
    var onQuoteClass = ".quote-".concat(classvalue);

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
        quote.addClass("quote-".concat(quoteKey));
        $("".concat(quoteClass)).find('.finance .row:not(:first):not(:last)').remove();
        $("".concat(quoteClass)).find('.actual-cost').attr("data-status", "");
        $("".concat(quoteClass)).find('.markup-amount').attr("readonly", false);
        $("".concat(quoteClass)).find('.markup-percentage').attr("readonly", false);
        $("".concat(quoteClass)).find('.cal_selling_price').attr('checked', 'checked');
        $("".concat(quoteClass)).find('.deposit-amount').val('0.00');
        $("".concat(quoteClass, " .finance")).find("input").val("").each(function () {
          this.name = this.name.replace(/\[(\d+)\]/, function () {
            var quoteLength = parseInt($('.quote').length) - 1;
            return "[".concat(quoteLength, "]");
          });
          var n = 1;
          this.id = this.id.replace(/[0-9]+/g, function (v) {
            return n++ == 2 ? 0 : v;
          }, function () {
            var name = $(this).attr("data-name");
            var quoteLength = parseInt($('.quote').length) - 1;
            return "quote_".concat(quoteLength, "_finance_", 0, "_").concat(name);
          });
        }).end().find("select").val("").each(function () {
          this.name = this.name.replace(/\[(\d+)\]/, function () {
            var quoteLength = parseInt($('.quote').length) - 1;
            return "[".concat(quoteLength, "]");
          });
          var n = 1;
          this.id = this.id.replace(/[0-9]+/g, function (v) {
            return n++ == 2 ? 0 : v;
          }, function () {
            var name = $(this).attr("data-name");
            var quoteLength = parseInt($('.quote').length) - 1;
            return "quote_".concat(quoteLength, "_finance_", 0, "_").concat(name);
          });
        }); // $(`#quote_${quoteKey}_date_of_service`).val(todayDate());

        $("#quote_".concat(quoteKey, "_table_name")).val('BookingDetail');
        $("".concat(quoteClass)).find('.mediaModal').find('a').attr('id', '');
        $("".concat(quoteClass)).find('.refund-payment-hidden-section').attr("hidden", true);
        $("".concat(quoteClass)).find('.refund-by-credit-note-section').attr("hidden", true);
        $("".concat(quoteClass)).find('.finance-clonning').removeClass("cancelled-payment-styling");
        $("".concat(quoteClass)).find('.btn-group').removeClass("d-none");
        $("".concat(quoteClass)).find('.clone_booking_finance').removeClass("d-none");
        $("".concat(quoteClass)).find('.finance-clonning input, .finance-clonning select').attr("readonly", false);
        $("".concat(quoteClass)).find('.payment-method').attr("disabled", false);
        $("".concat(quoteClass)).find('.outstanding-amount').attr("readonly", true);
        $("".concat(quoteClass)).find('.cancel-payemnt-btn').attr("hidden", true);
        $("".concat(quoteClass)).find('.refund-by-credit-note-section').remove();
        $("".concat(quoteClass)).find('.refund-by-bank-section').remove();
        $("".concat(quoteClass)).find('.supplier-id').html("<option selected value=\"\">Select Supplier</option>");
        $("".concat(quoteClass)).find('.product-id').html("<option selected value=\"\">Select Product</option>");
        $("".concat(quoteClass)).find(".estimated-cost, .actual-cost, .markup-amount, .markup-percentage, .selling-price, .profit-percentage, .estimated-cost-in-booking-currency, .selling-price-in-booking-currency, .markup-amount-in-booking-currency").val('0.00').attr('data-code', '');
        $("".concat(quoteClass)).find('.text-danger, .supplier-currency-code').html('');
        $("".concat(quoteClass)).find('input, select').removeClass('is-invalid');
        $("".concat(quoteClass)).find('.added-in-sage').removeAttr('checked');
        $("".concat(quoteClass)).find('.booking-detail-cancellation').remove();
        $("".concat(quoteClass)).find('.revert-booking-detail-cancellation').remove();
        $("".concat(quoteClass)).find('.category-id').val(category_id).change();
        $("".concat(quoteClass)).find('.badge-category-id').html(category_name);
        $("".concat(quoteClass)).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').addClass('d-none');
        $("".concat(quoteClass)).find('.badge-date-of-service, .badge-time-of-service, .badge-supplier-id, .badge-product-id, .badge-supplier-currency-id').html(''); // $(`${quoteClass}`).find('.badge-date-of-service').html(todayDate());

        $("".concat(quoteClass)).find('.badge-service-status').html('');
        $("".concat(quoteClass)).find('.finance-clonning-btn, .calender-feild-form-group').removeClass('d-none');
        datepickerReset(1, "".concat(quoteClass));
        reinitializedSingleSelect2();
        reinitializedMultiDynamicFeilds();
        $('html, body').animate({
          scrollTop: $(quoteClass).offset().top
        }, 1000);
        $('.parent-spinner').removeClass('spinner-border');
      }, 180);
    }
  });
  /*
  |--------------------------------------------------------------------------
  | Booking Management Calculation Functions
  |--------------------------------------------------------------------------
  */

  function getBookingTotalValues() {
    var markupType = $("input[name=markup_type]:checked").val();
    var actualCostInBookingCurrencyArray = $(".actual-cost-in-booking-currency").map(function (i, e) {
      return parseFloat(e.value);
    }).get();
    var actualCostInBookingCurrency = actualCostInBookingCurrencyArray.reduce(function (a, b) {
      return a + b;
    }, 0);
    $(".total-net-price").val(check(actualCostInBookingCurrency));

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
      $(".total-selling-price").val(check(actualCostInBookingCurrency));
    }

    onChangeAgencyCommissionType();
    getCommissionRate();
    getBookingAmountPerPerson();
    getSellingPrice();
  }

  function getBookingRateTypeValues() {
    var rateType = $("input[name=rate_type]:checked").val();
    var actualCostArray = $(".actual-cost").map(function (i, e) {
      return parseFloat(e.value).toFixed(2);
    }).get();
    var sellingPriceArray = $(".selling-price").map(function (i, e) {
      return parseFloat(e.value).toFixed(2);
    }).get();
    var markupAmountArray = $(".markup-amount").map(function (i, e) {
      return parseFloat(e.value).toFixed(2);
    }).get();
    var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
    var supplierCurrencyArray = $(".booking-supplier-currency-id").map(function (i, e) {
      return $(e).find(":selected").data("code");
    }).get();
    var quoteSize = parseInt($('.quote').length);
    var calculatedActualCostInBookingCurrency = 0;
    var calculatedSellingPriceInBookingCurrency = 0;
    var calculatedMarkupAmountInBookingCurrency = 0;
    var key = 0;

    while (key < quoteSize) {
      var actualCost = actualCostArray[key];
      var supplierCurrency = supplierCurrencyArray[key];
      var sellingPrice = sellingPriceArray[key];
      var markupAmount = markupAmountArray[key]; // console.log( supplierCurrency);

      if (supplierCurrency && bookingCurrency) {
        var rate = getRate(supplierCurrency, bookingCurrency, rateType);
        calculatedActualCostInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);
        calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);
        calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);
      } else {
        calculatedSellingPriceInBookingCurrency = parseFloat(0.00);
        calculatedMarkupAmountInBookingCurrency = parseFloat(0.00);
      }

      $("#quote_".concat(key, "_actual_cost_in_booking_currency")).val(check(calculatedActualCostInBookingCurrency));
      $("#quote_".concat(key, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
      $("#quote_".concat(key, "_markup_amount_in_booking_currency")).val(check(calculatedMarkupAmountInBookingCurrency));
      key++;
    }

    getBookingTotalValues();
  }

  function getBookingSupplierCurrencyValues(supplierCurrency, key) {
    var rateType = $("input[name=rate_type]:checked").val();
    var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
    var actualCost = parseFloat($("#quote_".concat(key, "_actual_cost")).val()).toFixed(2);
    var markupAmount = parseFloat($("#quote_".concat(key, "_markup_amount")).val()).toFixed(2);
    var sellingPrice = parseFloat($("#quote_".concat(key, "_selling_price")).val()).toFixed(2);
    var rate = getRate(supplierCurrency, bookingCurrency, rateType);
    var calculatedActualCostInBookingCurrency = 0;
    var calculatedMarkupAmountInBookingCurrency = 0;
    var calculatedSellingPriceInBookingCurrency = 0;
    calculatedActualCostInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);
    calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * parseFloat(rate);
    calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);
    $("#quote_".concat(key, "_actual_cost_in_booking_currency")).val(check(calculatedActualCostInBookingCurrency));
    $("#quote_".concat(key, "_markup_amount_in_booking_currency")).val(check(calculatedMarkupAmountInBookingCurrency));
    $("#quote_".concat(key, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
  }

  function getBookingDetailValues(key) {
    var supplierCurrency = $("#quote_".concat(key, "_supplier_currency_id")).find(':selected').data('code');
    var bookingCurrency = $(".booking-currency-id").find(':selected').data('code');
    var rateType = $('input[name="rate_type"]:checked').val();
    var actualCost = parseFloat($("#quote_".concat(key, "_actual_cost")).val()).toFixed(2);
    var sellingPrice = parseFloat($("#quote_".concat(key, "_selling_price")).val()).toFixed(2);
    var rate = getRate(supplierCurrency, bookingCurrency, rateType);
    var calculatedMarkupAmount = 0;
    var calculatedMarkupPercentage = 0;
    var calculatedProfitPercentage = 0;
    var calculatedActualCostInBookingCurrency = 0;
    var calculatedSellingPriceInBookingCurrency = 0;
    var calculatedMarkupAmountInBookingCurrency = 0;
    calculatedMarkupAmount = parseFloat(sellingPrice) - parseFloat(actualCost);
    calculatedMarkupPercentage = parseFloat(calculatedMarkupAmount) / parseFloat(actualCost / 100);
    calculatedProfitPercentage = (parseFloat(sellingPrice) - parseFloat(actualCost)) / parseFloat(sellingPrice) * 100;
    calculatedActualCostInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);
    calculatedSellingPriceInBookingCurrency = parseFloat(sellingPrice) * parseFloat(rate);
    calculatedMarkupAmountInBookingCurrency = parseFloat(calculatedMarkupAmount) * parseFloat(rate);
    $("#quote_".concat(key, "_markup_amount")).val(check(calculatedMarkupAmount));
    $("#quote_".concat(key, "_markup_percentage")).val(check(calculatedMarkupPercentage));
    $("#quote_".concat(key, "_profit_percentage")).val(check(calculatedProfitPercentage));
    $("#quote_".concat(key, "_actual_cost_in_booking_currency")).val(check(calculatedActualCostInBookingCurrency));
    $("#quote_".concat(key, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
    $("#quote_".concat(key, "_markup_amount_in_booking_currency")).val(check(calculatedMarkupAmountInBookingCurrency));
    getBookingTotalValues();
  }

  function getQuoteDetailValuesForBooking(key, changeFeild) {
    var supplierCurrency = $("#quote_".concat(key, "_supplier_currency_id")).find(':selected').data('code');
    var bookingCurrency = $(".booking-currency-id").find(':selected').data('code');
    var rateType = $('input[name="rate_type"]:checked').val();
    var actualCost = parseFloat($("#quote_".concat(key, "_actual_cost")).val()).toFixed(2);
    var markupPercentage = parseFloat($("#quote_".concat(key, "_markup_percentage")).val());
    var markupAmount = parseFloat($("#quote_".concat(key, "_markup_amount")).val());
    var rate = getRate(supplierCurrency, bookingCurrency, rateType);
    var calculatedSellingPrice = 0;
    var calculatedMarkupPercentage = 0;
    var calculatedMarkupAmount = 0;
    var calculatedProfitPercentage = 0;
    var calculatedMarkupAmountInBookingCurrency = 0;
    var calculatedActualCostInBookingCurrency = 0;
    var calculatedSellingPriceInBookingCurrency = 0;

    if (changeFeild == 'actual_cost') {
      calculatedSellingPrice = parseFloat(markupAmount) + parseFloat(actualCost);
      calculatedMarkupPercentage = parseFloat(markupAmount) / parseFloat(actualCost / 100);
      calculatedProfitPercentage = (parseFloat(calculatedSellingPrice) - parseFloat(actualCost)) / parseFloat(calculatedSellingPrice) * 100;
      calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
      calculatedActualCostInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);
      $("#quote_".concat(key, "_actual_cost_in_booking_currency")).val(check(calculatedActualCostInBookingCurrency));
      $("#quote_".concat(key, "_markup_percentage")).val(check(calculatedMarkupPercentage));
      $("#quote_".concat(key, "_selling_price")).val(check(calculatedSellingPrice));
      $("#quote_".concat(key, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
    }

    if (changeFeild == 'markup_amount') {
      calculatedSellingPrice = parseFloat(markupAmount) + parseFloat(actualCost);
      calculatedMarkupPercentage = parseFloat(markupAmount) / parseFloat(actualCost / 100);
      calculatedProfitPercentage = (parseFloat(calculatedSellingPrice) - parseFloat(actualCost)) / parseFloat(calculatedSellingPrice) * 100;
      calculatedMarkupAmountInBookingCurrency = parseFloat(markupAmount) * rate;
      calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
      $("#quote_".concat(key, "_markup_percentage")).val(check(calculatedMarkupPercentage));
      $("#quote_".concat(key, "_selling_price")).val(check(calculatedSellingPrice));
      $("#quote_".concat(key, "_profit_percentage")).val(check(calculatedProfitPercentage));
      $("#quote_".concat(key, "_markup_amount_in_booking_currency")).val(check(calculatedMarkupAmountInBookingCurrency));
      $("#quote_".concat(key, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
    }

    if (changeFeild == 'markup_percentage') {
      calculatedMarkupAmount = parseFloat(actualCost) / 100 * parseFloat(markupPercentage);
      calculatedSellingPrice = parseFloat(calculatedMarkupAmount) + parseFloat(actualCost);
      calculatedProfitPercentage = (parseFloat(calculatedSellingPrice) - parseFloat(actualCost)) / parseFloat(calculatedSellingPrice) * 100;
      calculatedMarkupAmountInBookingCurrency = parseFloat(calculatedMarkupAmount) * parseFloat(rate);
      calculatedSellingPriceInBookingCurrency = parseFloat(calculatedSellingPrice) * parseFloat(rate);
      $("#quote_".concat(key, "_markup_amount")).val(check(calculatedMarkupAmount));
      $("#quote_".concat(key, "_selling_price")).val(check(calculatedSellingPrice));
      $("#quote_".concat(key, "_profit_percentage")).val(check(calculatedProfitPercentage));
      $("#quote_".concat(key, "_markup_amount_in_booking_currency")).val(check(calculatedMarkupAmountInBookingCurrency));
      $("#quote_".concat(key, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
    }

    getBookingTotalValues();
  }

  function getBookingBookingCurrencyValues() {
    var rateType = $("input[name=rate_type]:checked").val();
    var actualCostArray = $(".actual-cost").map(function (i, e) {
      return parseFloat(e.value).toFixed(2);
    }).get();
    var sellingPriceArray = $(".selling-price").map(function (i, e) {
      return parseFloat(e.value).toFixed(2);
    }).get();
    var markupAmountArray = $(".markup-amount").map(function (i, e) {
      return parseFloat(e.value).toFixed(2);
    }).get();
    var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
    var supplierCurrencyArray = $(".booking-supplier-currency-id").map(function (i, e) {
      return $(e).find(":selected").data("code");
    }).get();
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

      $("#quote_".concat(key, "_actual_cost_in_booking_currency")).val(check(calculatedActualCostInBookingCurrency));
      $("#quote_".concat(key, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
      $("#quote_".concat(key, "_markup_amount_in_booking_currency")).val(check(calculatedMarkupAmountInBookingCurrency));
      key++;
    }
  }

  $(document).on('change', '.booking-supplier-currency-id', function () {
    var code = $(this).find(":selected").data("code");
    var quote = $(this).closest(".quote");
    var quoteKey = quote.data("key");
    var currency_name = $(this).find(':selected').attr('data-name');
    var supplierCurrency = $(this).val();
    var bookingCurrency = $('#currency_id').val();

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
    quote.find('.badge-supplier-currency-id').html(currency_name);
    getBookingSupplierCurrencyValues(code, quoteKey);
    getBookingTotalValues();
  });
  $(document).on('change', '.payment-method', function () {
    var payment_method = $(this).val();
    var supplier_id = $(this).closest('.quote').find('.supplier-id').val();
    var current_payment_methods = $(this);
    var quoteKey = $(this).closest('.quote').data('key');
    var financeKey = $(this).closest('.finance-clonning').data('financekey');
    var estimatedCost = parseFloat($(this).closest('.quote').find('.estimated-cost').val()).toFixed(2);
    var totalDepositAmountArray = $(this).closest('.finance').find('.deposit-amount').map(function (i, e) {
      return parseFloat(e.value);
    }).get();
    var totalDepositAmount = totalDepositAmountArray.reduce(function (a, b) {
      return a + b;
    }, 0);
    var outstanding_amount_left = parseFloat($(this).closest('.quote').find('.outstanding_amount_left').val());
    var wa = 0;
    var outstandingAmountLeft = estimatedCost - totalDepositAmount;
    var currentDepositAmount = $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_deposit_amount")).val();

    if (supplier_id != null && payment_method == 3) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': CSRFTOKEN
        },
        url: REDIRECT_BASEURL + 'wallets/get-supplier-wallet-amount/' + supplier_id,
        type: 'get',
        success: function success(data) {
          if (data.response == true) {
            wa = parseFloat(data.message);

            if (currentDepositAmount > wa) {
              alert("Please Enter Correct Wallet Amount");
              $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_deposit_amount")).val('0.00');
              $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_outstanding_amount")).val('');
            } else {
              $("#quote_".concat(quoteKey, "_outstanding_amount_left")).val(outstandingAmountLeft.toFixed(2));
              $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_outstanding_amount")).val(outstandingAmountLeft.toFixed(2));
            }
          }
        },
        error: function error(reject) {
          if (reject.status === 422) {
            var errors = $.parseJSON(reject.responseText);
            alert(errors.message);
            $(current_payment_methods).val('').trigger('change');
          }
        }
      });
    } else {
      $("#quote_".concat(quoteKey, "_outstanding_amount_left")).val(outstandingAmountLeft.toFixed(2));
      $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_outstanding_amount")).val(outstandingAmountLeft.toFixed(2));
    }
  });
  $(document).on('change', '.deposit-amount', function () {
    var quoteKey = $(this).closest('.quote').data('key');
    var financeKey = $(this).closest('.finance-clonning').data('financekey');
    var closestFinance = $(this).closest('.finance');
    var depositAmount = parseFloat($(this).val()).toFixed(2);
    var estimated_cost = parseFloat($("#quote_".concat(quoteKey, "_estimated_cost")).val()).toFixed(2);
    var payment_method = $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_payment_method")).val();
    var supplier_id = $("#quote_".concat(quoteKey, "_supplier_id")).val();
    var totalDepositAmountArray = closestFinance.find('.deposit-amount').map(function (i, e) {
      return parseFloat(e.value);
    }).get();
    var totalDepositAmount = totalDepositAmountArray.reduce(function (a, b) {
      return a + b;
    }, 0);
    var outstandingAmountLeft = estimated_cost - totalDepositAmount;
    var walletAmount = 0;

    if (payment_method && payment_method == 3) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': CSRFTOKEN
        },
        url: REDIRECT_BASEURL + 'wallets/get-supplier-wallet-amount/' + supplier_id,
        type: 'get',
        success: function success(data) {
          if (data.response == true) {
            walletAmount = parseFloat(data.message);

            if (depositAmount > walletAmount) {
              alert("Please Enter Correct Wallet Amount");
              $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_deposit_amount")).val('0.00');
              $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_outstanding_amount")).val('');
            } else {
              if (outstandingAmountLeft < 0) {
                alert("Please Enter Correct Amount");
                $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_deposit_amount")).val('0.00');
                $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_outstanding_amount")).val('');
              } else {
                $("#quote_".concat(quoteKey, "_outstanding_amount_left")).val(outstandingAmountLeft.toFixed(2));
                $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_outstanding_amount")).val(outstandingAmountLeft.toFixed(2));
              }
            }
          }
        },
        error: function error(reject) {}
      });
    } else {
      if (outstandingAmountLeft >= 0 && payment_method != '') {
        $("#quote_".concat(quoteKey, "_outstanding_amount_left")).val(outstandingAmountLeft.toFixed(2));
        $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_outstanding_amount")).val(outstandingAmountLeft.toFixed(2));
      } else if (outstandingAmountLeft < 0 && payment_method != 3) {
        alert("Please Enter Correct Deposit Amount");
        $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_deposit_amount")).val('0.00');
        $("#quote_".concat(quoteKey, "_finance_").concat(financeKey, "_outstanding_amount")).val('');
      }
    }
  });

  function getActualCost(quote) {
    var totalDepositAmountArray = quote.find('.deposit-amount').map(function (i, e) {
      return parseFloat(e.value);
    }).get();
    var totalDepositAmount = totalDepositAmountArray.reduce(function (a, b) {
      return a + b;
    }, 0);
    var amountArray = quote.find('.amount').map(function (i, e) {
      return parseFloat(e.value);
    }).get();
    var amountTotalArray = amountArray.filter(function (value) {
      return !Number.isNaN(value);
    });
    var totalAmount = amountTotalArray.reduce(function (a, b) {
      return a + b;
    }, 0);
    var actualCost = totalDepositAmount - totalAmount;
    return actualCost;
  }

  function getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey) {
    var supplierCurrency = $("#quote_".concat(quoteKey, "_supplier_currency_id")).find(":selected").data("code");
    var bookingCurrency = $(".booking-currency-id").find(":selected").data("code");
    var rateType = $("input[name=rate_type]:checked").val();
    var rate = getRate(supplierCurrency, bookingCurrency, rateType);
    var calculatedActualCostInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);
    var calculatedSellingPriceInBookingCurrency = parseFloat(actualCost) * parseFloat(rate);
    $("#quote_".concat(quoteKey, "_actual_cost_in_booking_currency")).val(check(calculatedActualCostInBookingCurrency));
    $("#quote_".concat(quoteKey, "_selling_price_in_booking_currency")).val(check(calculatedSellingPriceInBookingCurrency));
  }

  $(document).on('change', '.refund_amount', function () {
    var quote = $(this).closest('.quote');
    var quoteKey = $(this).closest('.quote').data('key');
    var actualCost = parseFloat(getActualCost(quote));

    if (actualCost < 0) {
      alert("Please Enter Correct Amount");
      $(this).val('0.00');
    } else {
      $("#quote_".concat(quoteKey, "_actual_cost")).val(check(actualCost));
      $("#quote_".concat(quoteKey, "_markup_amount")).val('0.00');
      $("#quote_".concat(quoteKey, "_markup_amount_in_booking_currency")).val('0.00');
      $("#quote_".concat(quoteKey, "_markup_percentage")).val('0.00');
      $("#quote_".concat(quoteKey, "_profit_percentage")).val('0.00');
      $("#quote_".concat(quoteKey, "_selling_price")).val(check(actualCost));
      getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey);
      getBookingTotalValues();
    }
  });
  $(document).on('change', '.credit-note-amount', function () {
    var quote = $(this).closest('.quote');
    var quoteKey = $(this).closest('.quote').data('key');
    var actualCost = parseFloat(getActualCost(quote));

    if (actualCost < 0) {
      alert("Please Enter Correct Paid Amount");
      $(this).val('0.00');
    } else {
      $("#quote_".concat(quoteKey, "_actual_cost")).val(check(actualCost));
      $("#quote_".concat(quoteKey, "_markup_amount")).val('0.00');
      $("#quote_".concat(quoteKey, "_markup_amount_in_booking_currency")).val('0.00');
      $("#quote_".concat(quoteKey, "_markup_percentage")).val('0.00');
      $("#quote_".concat(quoteKey, "_profit_percentage")).val('0.00');
      $("#quote_".concat(quoteKey, "_selling_price")).val(check(actualCost));
      getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey);
      getBookingTotalValues();
    }
  });
  $(document).on('click', '.refund-to-bank', function () {
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
      quote.find('.refund-payment-row').first().clone().find("input").val("").each(function () {
        var n = 1;
        var name = $(this).attr("data-name");
        this.name = this.name.replace(/]\[(\d+)]/g, function () {
          return "][".concat(refundPaymentRowLength, "]");
        });
        this.id = this.id.replace(/[0-9]+/g, function (v) {
          return n++ == 2 ? refundPaymentRowLength : v;
        }, function () {
          return "quote_".concat(quoteKey, "_finance_").concat(refundPaymentRowLength, "_").concat(name);
        });
      }).end().find('.refund-payment-label').each(function () {
        this.id = "refund_payment_label_".concat(refundPaymentRowLength);
        $(this).text("Refund Payment #".concat(refundPaymentRowLength + 1));
      }).end().find("select").val("").each(function () {
        var n = 1;
        var name = $(this).attr("data-name");
        this.name = this.name.replace(/]\[(\d+)]/g, function () {
          return "][".concat(refundPaymentRowLength, "]");
        });
        this.id = this.id.replace(/[0-9]+/g, function (v) {
          return n++ == 2 ? refundPaymentRowLength : v;
        }, function () {
          return "quote_".concat(quoteKey, "_finance_").concat(refundPaymentRowLength, "_").concat(name);
        });
      }).end().find('.select2single').select2({
        width: '100%',
        theme: "bootstrap"
      }).end().show().insertAfter(quote.find('.refund-payment-row:last'));
      quote.find('.refund-payment-row:last .checkbox').prop('checked', false);
      quote.find('.refund-payment-row:last :input, select').removeAttr('readonly disabled');
      quote.find('.refund-payment-row:last .refund_amount').val('');
      quote.find('.refund-payment-row:last .refund-payment-hidden-btn').removeClass('d-none');
    }

    reinitializedSingleSelect2();
  });
  $(document).on('click', '.credit-note', function () {
    if ($('.select2single').data('select2')) {
      $('.select2single').select2('destroy');
    }

    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var creditNoteRowLength = quote.find(".credit-note-row:not(:hidden)").length; // console.log(creditNoteRowLength);

    if (parseInt(creditNoteRowLength) == 0) {
      if (confirm("Are you sure you want Credit Note? Actual Cost, Markup Amount, Selling Price, Profit% will be override.") == true) {
        quote.find('.credit-note-section').attr("hidden", false);
      }
    } else {
      quote.find('.credit-note-row').first().clone().find("input").val("").each(function () {
        var n = 1;
        var name = $(this).attr("data-name");
        this.name = this.name.replace(/]\[(\d+)]/g, function () {
          return "][".concat(creditNoteRowLength, "]");
        });
        this.id = this.id.replace(/[0-9]+/g, function (v) {
          return n++ == 2 ? creditNoteRowLength : v;
        }, function () {
          return "quote_".concat(quoteKey, "_finance_").concat(creditNoteRowLength, "_").concat(name);
        });
      }).end().find('.credit_note_label').each(function () {
        this.id = "credit_note_label_".concat(creditNoteRowLength);
        $(this).text("Credit Note Amount Payment #".concat(creditNoteRowLength + 1));
      }).end().find("select").val("").each(function () {
        var n = 1;
        var name = $(this).attr("data-name");
        this.name = this.name.replace(/]\[(\d+)]/g, function () {
          return "][".concat(creditNoteRowLength, "]");
        });
        this.id = this.id.replace(/[0-9]+/g, function (v) {
          return n++ == 2 ? creditNoteRowLength : v;
        }, function () {
          return "quote_".concat(quoteKey, "_finance_").concat(creditNoteRowLength, "_").concat(name);
        });
      }).end().find('.select2single').select2({
        width: '100%',
        theme: "bootstrap"
      }).end().show().insertAfter(quote.find(".credit-note-row:last")); // quote.find('.refund-payment-row:last :input, select').removeAttr('readonly disabled');
      // quote.find('.refund-payment-row:last .refund_amount').val('');

      quote.find('.credit-note-row:last .credit-note-hidden-btn').removeClass('d-none');
    }

    reinitializedSingleSelect2();
  });
  $(document).on('click', '.refund-payment-hidden-btn', function () {
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
    $("#quote_".concat(quoteKey, "_actual_cost")).val(check(actualCost));
    getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey);
    getBookingTotalValues();
  });
  $(document).on('click', '.credit-note-hidden-btn', function () {
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
    $("#quote_".concat(quoteKey, "_actual_cost")).val(check(actualCost));
    getSellingPricenAndActualCostInBookingCurrency(actualCost, quoteKey);
    getBookingTotalValues();
  });
  /*
  |--------------------------------------------------------------------------
  | End Booking Management
  |--------------------------------------------------------------------------
  */
});

/***/ }),

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
  /*
  |--------------------------------------------------------------------------------
  | Functions
  |--------------------------------------------------------------------------------
  */
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
    reinitializedSingleSelect2(); // insElment.appendChild(div);
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

  function convertDate(date) {
    var dateParts = date.split("/");
    return dateParts = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);
  }

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
  /*
  |--------------------------------------------------------------------------------
  | Other Functions
  |--------------------------------------------------------------------------------
  */

  $(document).on('change', '.time-of-service', function () {
    var quote = $(this).closest('.quote');
    quote.find('.badge-time-of-service').html($(this).val());
    quote.find('.badge-time-of-service').removeClass('d-none');
  });
  $(document).on('change', '.date-of-service', function () {
    var quote = $(this).closest('.quote');
    var quoteKey = quote.data('key');
    var DateOFService = $("#quote_".concat(quoteKey, "_date_of_service")).val();
    var EndDateOFService = $("#quote_".concat(quoteKey, "_end_date_of_service")).val();
    var nowDate = todayDate();
    var category_enddateofservice = $("#quote_".concat(quoteKey, "_category_id")).find(':selected').attr('data-enddateofservice');
    /* Set Badge in Card Header*/

    quote.find('.badge-date-of-service').html($(this).val());
    quote.find('.badge-date-of-service').removeClass('d-none');

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
  $(document).on('submit', '#form_add_product', function () {
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
});

/***/ }),

/***/ 1:
/*!**************************************************!*\
  !*** multi ./resources/js/booking_management.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\ufg-form\resources\js\booking_management.js */"./resources/js/booking_management.js");


/***/ })

/******/ });