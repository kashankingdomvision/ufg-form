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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/commission_management.js":
/*!***********************************************!*\
  !*** ./resources/js/commission_management.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./commission_management/commission_app */ "./resources/js/commission_management/commission_app.js"); // require('./commission_management/commission_group_app.js');


__webpack_require__(/*! ./commission_management/commission_criteria_app.js */ "./resources/js/commission_management/commission_criteria_app.js");

__webpack_require__(/*! ./commission_management/pay_commission.js */ "./resources/js/commission_management/pay_commission.js");

__webpack_require__(/*! ./commission_management/view_commission_detail.js */ "./resources/js/commission_management/view_commission_detail.js");

__webpack_require__(/*! ./commission_management/sale_person_payment_app.js */ "./resources/js/commission_management/sale_person_payment_app.js");

/***/ }),

/***/ "./resources/js/commission_management/commission_app.js":
/*!**************************************************************!*\
  !*** ./resources/js/commission_management/commission_app.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Commission 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_commission', function (event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var formID = $(this).attr('id');
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
        printServerSuccessMessage(response, "#".concat(formID));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Commission
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_commission', function (event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var formID = $(this).attr('id');
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
        printServerSuccessMessage(response, "#".concat(formID));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('click', '.commission-bulk-action-item', function () {
    var checkedValues = $('.child:checked').map(function (i, e) {
      return e.value;
    }).get();
    var bulkActionType = $(this).data('action_type');
    var message = "";
    var buttonText = "";

    if (['delete'].includes(bulkActionType)) {
      if (checkedValues.length > 0) {
        $('input[name="bulk_action_type"]').val(bulkActionType);
        $('input[name="bulk_action_ids"]').val(checkedValues);

        switch (bulkActionType) {
          case "delete":
            message = 'You want to Delete Commission?';
            buttonText = 'Delete';
            break;
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#commission_bulk_action').attr('action'),
              data: new FormData($('#commission_bulk_action')[0]),
              contentType: false,
              cache: false,
              processData: false,
              success: function success(response) {
                printListingSuccessMessage(response);
              }
            });
          }
        });
      } else {
        printListingErrorMessage("Please Check Atleast One Record.");
      }
    }
  });
});

/***/ }),

/***/ "./resources/js/commission_management/commission_criteria_app.js":
/*!***********************************************************************!*\
  !*** ./resources/js/commission_management/commission_criteria_app.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Commission Criteria 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_commission_criteria', function (event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var formID = $(this).attr('id');
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
        printServerSuccessMessage(response, "#".concat(formID));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Commission Criteria
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_commission_criteria', function (event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var formID = $(this).attr('id');
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
        printServerSuccessMessage(response, "#".concat(formID));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('change', '.getMultipleBrandtoHoliday', function () {
    var brand_ids = $(this).val();
    var options = '';
    var url = "".concat(BASEURL, "multiple-brand-on-change");
    $.ajax({
      type: 'get',
      url: url,
      data: {
        'brand_ids': brand_ids
      },
      beforeSend: function beforeSend() {
        $('.appendMultipleHolidayType').html(options);
      },
      success: function success(response) {
        $.each(response, function (key, value) {
          options += "<option data-value=\"".concat(value.name, "\" value=\"").concat(value.id, "\"> ").concat(value.name, " (").concat(value.brand_name, ") </option>");
        });
        $('.appendMultipleHolidayType').html(options);
      }
    });
  });
  $(document).on('click', '.commission-criteria-bulk-action-item', function () {
    var checkedValues = $('.child:checked').map(function (i, e) {
      return e.value;
    }).get();
    var bulkActionType = $(this).data('action_type');
    var message = "";
    var buttonText = "";

    if (['delete'].includes(bulkActionType)) {
      if (checkedValues.length > 0) {
        $('input[name="bulk_action_type"]').val(bulkActionType);
        $('input[name="bulk_action_ids"]').val(checkedValues);

        switch (bulkActionType) {
          case "delete":
            message = 'You want to Delete Commission Criterias?';
            buttonText = 'Delete';
            break;
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#commission_criteria_bulk_action').attr('action'),
              data: new FormData($('#commission_criteria_bulk_action')[0]),
              contentType: false,
              cache: false,
              processData: false,
              success: function success(response) {
                printListingSuccessMessage(response);
              }
            });
          }
        });
      } else {
        printListingErrorMessage("Please Check Atleast One Record.");
      }
    }
  });
  $(document).on('click', '.delete-commission-criteria', function (event) {
    var _this = this;

    event.preventDefault();
    var url = $(this).attr('action');
    message = 'You want to Delete Commission Criteria?';
    buttonText = 'Delete';
    Swal.fire({
      title: 'Are you sure?',
      text: message,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#dc3545',
      confirmButtonText: "Yes ".concat(buttonText, "!")
    }).then(function (result) {
      if (result.isConfirmed) {
        $.ajax({
          type: 'DELETE',
          url: url,
          data: new FormData(_this),
          contentType: false,
          cache: false,
          processData: false,
          success: function success(response) {
            printListingSuccessMessage(response);
          },
          error: function error(response) {
            Toast.fire({
              icon: 'warning',
              title: response.message
            });
          }
        });
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/commission_management/pay_commission.js":
/*!**************************************************************!*\
  !*** ./resources/js/commission_management/pay_commission.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  function resetTable(response) {
    $("#listing_card_body").load("".concat(location.href, " #listing_card_body"));
    $("#overlay").addClass('overlay').html("<i class=\"fas fa-2x fa-sync-alt fa-spin\"></i>");
    setTimeout(function () {
      $("#overlay").removeClass('overlay').html('');
      $('.child-row').removeClass('d-none');
      $('.parent-row').html('<span class="fa fa-minus"></span>');
      Toast.fire({
        icon: 'success',
        title: response.success_message
      });
    }, 500);
  }

  function totalBankAmountValues() {
    var values = $('.bank-amount-value').map(function (i, e) {
      return parseFloat(removeComma(e.value));
    }).get();
    values = values.reduce(function (a, b) {
      return a + b;
    }, 0);
    $('.booking-commission-total-bank-amount').html(check(values)).val(check(values));
    return values;
  }

  function totalDepositAmountValues() {
    var values = $('.deposit-amount-value').map(function (i, e) {
      return parseFloat(removeComma(e.value));
    }).get();
    values = values.reduce(function (a, b) {
      return a + b;
    }, 0);
    $('.booking-commission-total-deposit-amount').html(check(values)).val(check(values));
    return values;
  }

  function totalDepositedAmount() {
    var valesArray = $('.deposited-amount-payments:checked').parents('.commission-row').find('.total-deposit-amount').map(function (i, e) {
      return parseFloat(removeComma(e.value));
    }).get();
    valesArray = valesArray.reduce(function (a, b) {
      return a + b;
    }, 0);
    return valesArray;
  }

  function totalDepositAmountLeftToAllocate() {
    var totalDepositAmount = totalDepositedAmount();

    if (totalDepositAmount > 0) {
      $('.deposit-amount-value').prop("readonly", false);
    } else {
      $('.deposit-amount-value').prop("readonly", true);
    }

    $('.total-deposit-amount-left-to-allocate').html(check(totalDepositAmount)).val(check(totalDepositAmount));
  }

  function calTotalDepositAmountLeftToAllocate() {
    var totalDepositAmount = totalDepositedAmount();

    if (totalDepositAmount > 0) {
      // if(totalDepositAmount > bookingCommissionTotalPaidAmount) {
      //     let totalDepositAmountLeftToAllocate = totalDepositAmount - bookingCommissionTotalPaidAmount;
      //     $('.total-deposit-amount-left-to-allocate')
      //         .html(check(totalDepositAmountLeftToAllocate))
      //         .val(check(totalDepositAmountLeftToAllocate));
      //     return totalDepositAmountLeftToAllocate;
      // }
      // if(totalDepositAmount <= bookingCommissionTotalPaidAmount){
      //     $('.total-deposit-amount-left-to-allocate')
      //         .html('0.00')
      //         .val('0.00');
      //     return 0.00;
      // }
      var _totalDepositAmountLeftToAllocate = totalDepositAmount - totalDepositAmountValues();

      $('.total-deposit-amount-left-to-allocate').html(check(_totalDepositAmountLeftToAllocate)).val(check(_totalDepositAmountLeftToAllocate));
      return _totalDepositAmountLeftToAllocate;
    }
  }

  function getTotalOutstandingAmount() {
    var valesArray = $('.row-total-outstanding-amount').map(function (i, e) {
      return parseFloat(removeComma(e.value));
    }).get();
    var rowsTotalOutstandingAmount = valesArray.reduce(function (a, b) {
      return a + b;
    }, 0);
    $('.total-outstanding-amount').html(check(rowsTotalOutstandingAmount)).val(check(rowsTotalOutstandingAmount));
    return rowsTotalOutstandingAmount;
  }

  function getBookingCommissionTotalPaidAmount() {
    var valesArray = $('.row-total-paid-amount').map(function (i, e) {
      return parseFloat(removeComma(e.value));
    }).get();
    var rowsTotalPaidAmount = valesArray.reduce(function (a, b) {
      return a + b;
    }, 0);
    $('.booking-commission-total-paid-amount').html(check(rowsTotalPaidAmount)).val(check(rowsTotalPaidAmount));
    return rowsTotalPaidAmount;
  }

  function getDepositAndPayCommissionTotal() {
    var spDepositAmount = $('#sp_deposit_amount').val() == '' ? 0.00 : removeComma($('#sp_deposit_amount').val());
    var depositAndPayCommissionTotal = parseFloat(getTotalPayCommissionAmount()) + parseFloat(spDepositAmount);
    $('.deposit-and-pay-commission-total').html(check(depositAndPayCommissionTotal)).val(check(depositAndPayCommissionTotal));
    return depositAndPayCommissionTotal;
  }

  function getTotalPayCommissionAmount() {
    var valesArray = $('.pay-commission-amount').map(function (i, e) {
      return parseFloat(removeComma(e.value));
    }).get();
    var totalPayCommissionAmount = valesArray.reduce(function (a, b) {
      return a + b;
    }, 0);
    $('.total-pay-commission-amount').html(check(totalPayCommissionAmount)).val(check(totalPayCommissionAmount));
    return totalPayCommissionAmount;
  }

  function getRowTotalOutstandingAmount(commissionRow) {
    var outstandingAmountLeft = removeComma(commissionRow.find('.outstanding-amount-left').val());
    var payCommisionAmount = removeComma(commissionRow.find('.pay-commission-amount').val());
    var rowTotalOutstandingAmount = parseFloat(outstandingAmountLeft) - parseFloat(payCommisionAmount);
    commissionRow.find('.row-total-outstanding-amount').val(check(rowTotalOutstandingAmount));
  }

  function getRowTotalPaidAmount(commissionRow) {
    var totalPaidAmountYet = removeComma(commissionRow.find('.total-paid-amount-yet').val());
    var payCommisionAmount = removeComma(commissionRow.find('.pay-commission-amount').val());
    var rowTotalPaidAmount = parseFloat(totalPaidAmountYet) + parseFloat(payCommisionAmount);
    commissionRow.find('.row-total-paid-amount').val(check(rowTotalPaidAmount));
  }

  function getBankTotalAmountPaid() {
    var depositedAmountPayments = $('.deposited-amount-payments').prop('checked');

    if (typeof depositedAmountPayments != 'undefined' && depositedAmountPayments) {
      var bankTotalAmountPaid = $('.bank-amount-value').map(function (i, e) {
        return parseFloat(removeComma(e.value));
      }).get();
      bankTotalAmountPaid = bankTotalAmountPaid.reduce(function (a, b) {
        return a + b;
      }, 0);
      $('#bank_total_amount_paid').val(check(bankTotalAmountPaid)); // let bookingCommissionTotalPaidAmount = getTotalPayCommissionAmount();
      // let totalDepositAmount = parseFloat(removeComma($('#total_deposit_amount').val()));
      // if(bookingCommissionTotalPaidAmount > totalDepositAmount){
      //     let bankTotalAmountPaid = bookingCommissionTotalPaidAmount - totalDepositAmount;
      //     $('#bank_total_amount_paid').val(check(bankTotalAmountPaid));
      // }else{
      //     $('#bank_total_amount_paid').val('0.00');
      // }
    } else {
      $('#bank_total_amount_paid').val(check(getTotalPayCommissionAmount()));
    }
  }

  function calDepositAndBankAmountValue(commissionRow) {
    var totalDepositAmountLeftToAllocate = $("#total_deposit_amount_left_to_allocate").val();
    var payCommissionAmount = parseFloat(commissionRow.find('.pay-commission-amount').val());
    var depositAmountValue = commissionRow.find('.deposit-amount-value').val();

    if (totalDepositAmountLeftToAllocate && typeof totalDepositAmountLeftToAllocate !== "undefined" && parseFloat(totalDepositAmountLeftToAllocate) > 0) {
      totalDepositAmountLeftToAllocate = parseFloat(removeComma($("#total_deposit_amount_left_to_allocate").val()));
      var outstandingAmountLeft = parseFloat(removeComma(commissionRow.find('.pay-commission-amount').val()));
      var totalDepositAmountLeftToAllocateValue = parseFloat(removeComma($('.total-deposit-amount-left-to-allocate').val()));

      if (outstandingAmountLeft > totalDepositAmountLeftToAllocateValue) {
        var bankAmountValue = outstandingAmountLeft - totalDepositAmountLeftToAllocateValue;
        commissionRow.find('.deposit-amount-value').val(check(totalDepositAmountLeftToAllocateValue));
        commissionRow.find('.bank-amount-value').val(check(bankAmountValue));
      }

      if (outstandingAmountLeft <= totalDepositAmountLeftToAllocateValue) {
        commissionRow.find('.deposit-amount-value').val(check(outstandingAmountLeft));
      }
    }

    if (payCommissionAmount && typeof payCommissionAmount !== "undefined" && parseFloat(totalDepositAmountLeftToAllocate) == 0) {
      commissionRow.find('.bank-amount-value').val(check(payCommissionAmount));
    }

    if (depositAmountValue && typeof depositAmountValue !== "undefined" && payCommissionAmount == depositAmountValue) {
      commissionRow.find('.bank-amount-value').val(check(0));
    } // else{
    //     let depositPayment = $('.deposited-amount-payments').length;
    //     if(depositPayment > 0){
    //         commissionRow.find('.bank-amount-value').val(check(outstandingAmountLeft));
    //     }
    // }

  }

  function resetCommissionRow(commissionRow) {
    commissionRow.find('.pay-commission-amount').val('0.00');
    commissionRow.find('.finance-child').prop('checked', false).val('0');
    commissionRow.find('.row-total-paid-amount').val('0.00');
    commissionRow.find('.row-total-outstanding-amount').val('0.00');
    commissionRow.find('.deposit-amount-value').val('0.00');
    commissionRow.find('.bank-amount-value').val('0.00');
  }

  $(document).on("change", '.pay-commission-amount', function (e) {
    var commissionRow = $(this).closest('.commission-row');
    var payCommisionAmount = removeComma(commissionRow.find('.pay-commission-amount').val());
    var outstandingAmountLeft = removeComma(commissionRow.find('.outstanding-amount-left').val()); // let bankAmountValue = removeComma(commissionRow.find('.bank-amount-value').val());

    if (parseFloat(payCommisionAmount) <= 0 || parseFloat(payCommisionAmount) > parseFloat(outstandingAmountLeft)) {
      Toast.fire({
        icon: 'warning',
        title: 'Please Enter Correct Amount.'
      });
      resetCommissionRow(commissionRow);
    } else {
      commissionRow.find('.finance-child').prop('checked', true).val('1');
      getRowTotalPaidAmount(commissionRow);
      getRowTotalOutstandingAmount(commissionRow);
      var depositedAmountValue = commissionRow.find('.deposit-amount-value').val();

      if (depositedAmountValue && typeof depositedAmountValue !== "undefined") {
        var _depositedAmountValue = removeComma(commissionRow.find('.deposit-amount-value').val());

        if (parseFloat(_depositedAmountValue) > 0) {
          if (parseFloat(payCommisionAmount) >= parseFloat(_depositedAmountValue)) {
            var bankAmountValue = parseFloat(payCommisionAmount) - parseFloat(_depositedAmountValue);
            commissionRow.find('.bank-amount-value').val(check(bankAmountValue));
          }

          if (calTotalDepositAmountLeftToAllocate() == 0) {
            if (parseFloat(payCommisionAmount) < parseFloat(_depositedAmountValue)) {
              commissionRow.find('.deposit-amount-value').val(check(0));
              commissionRow.find('.bank-amount-value').val(check(0));
            }
          }
        }

        if (parseFloat(_depositedAmountValue) == 0 && parseFloat(payCommisionAmount) <= calTotalDepositAmountLeftToAllocate()) {
          commissionRow.find('.deposit-amount-value').val(check(parseFloat(payCommisionAmount)));
          commissionRow.find('.bank-amount-value').val(check(0));
        }
      }
    }

    getTotalPayCommissionAmount();
    getBookingCommissionTotalPaidAmount();
    getTotalOutstandingAmount();
    getDepositAndPayCommissionTotal();
    calDepositAndBankAmountValue(commissionRow);
    totalDepositAmountValues();
    totalBankAmountValues();
    getBankTotalAmountPaid();
    calTotalDepositAmountLeftToAllocate();
  });
  $(document).on('change', '#sp_deposit_amount', function (event) {
    var spDepositAmount = $(this).val() == '' ? 0.00 : parseFloat(removeComma($('#sp_deposit_amount').val()));
    $('.sp-deposit-amount').html(check(spDepositAmount)).val(check(spDepositAmount));
    getDepositAndPayCommissionTotal();
  });
  $(document).on('change', '.deposited-amount-payments', function (event) {
    var commissionRow = $(this).closest('.commission-row');
    var depositedAmountPayments = commissionRow.find(".deposited-amount-payments").prop('checked');
    var totalOutstandingAmount = parseFloat(removeComma(commissionRow.find('.current-deposited-total-outstanding-amount').val())); // let totalDepositAmount = totalDepositedAmount();

    if (depositedAmountPayments) {
      commissionRow.find('.total-deposit-amount').val(check(totalOutstandingAmount));
      commissionRow.find('.total-deposited-outstanding-amount').val('0.00');
    } else {
      commissionRow.find('.total-deposit-amount').val('0.00');
      commissionRow.find('.total-deposited-outstanding-amount').val(check(totalOutstandingAmount));
    } // getBankTotalAmountPaid();


    totalDepositAmountLeftToAllocate();
  });
  var commissionRow = '';
  $(document).on('click', '.adjust-deposited-amount', function (event) {
    commissionRow = $(this).closest('.commission-row');
    var modal = $('#adjust_deposited_amount_modal');
    modal.modal('show');
    modal.find('form')[0].reset();
    var totalDepositedOutstandingAmount = removeComma(commissionRow.find('.current-deposited-total-outstanding-amount').val());
    var currencyCode = commissionRow.find('.total-deposit-amount').data('sale_person_currency_code'); // $('#adjust_deposited_amount_modal').find('#adjust_total_deposit_amount').val(totalDepositedOutstandingAmount);

    $('#adjust_deposited_amount_modal').find('.sale-person-currency-code').html(currencyCode);
    modal.find('#outstanding_amount').val(totalDepositedOutstandingAmount);
  });
  $(document).on('click', '#apply_adjust_total_deposit_amount', function (event) {
    var modal = $('#adjust_deposited_amount_modal');
    var adjustTotalDepositAmount = parseFloat(removeComma(modal.find('#adjust_total_deposit_amount').val()));
    var totalOutstandingAmount = parseFloat(removeComma(modal.find('#outstanding_amount').val()));

    if (adjustTotalDepositAmount > totalOutstandingAmount) {
      Toast.fire({
        icon: 'error',
        title: 'Please Enter Correct Amount.'
      });
      $('#total_deposit_amount').val('0.00');
      return;
    }

    modal.modal('hide');
    var totaldepositedOutstandingAmount = totalOutstandingAmount - adjustTotalDepositAmount;
    commissionRow.find('.deposited-amount-payments').prop('checked', true);
    commissionRow.find('.total-deposit-amount').val(check(adjustTotalDepositAmount));
    commissionRow.find('.total-deposited-outstanding-amount').val(check(totaldepositedOutstandingAmount));
    totalDepositAmountLeftToAllocate();
    calTotalDepositAmountLeftToAllocate();
  });
  $(document).on('change', '.deposit-amount-value', function (event) {
    var commissionRow = $(this).closest('.commission-row');
    var payCommisionAmount = parseFloat(removeComma(commissionRow.find('.pay-commission-amount').val()));
    var depositAmountValue = parseFloat(removeComma(commissionRow.find('.deposit-amount-value').val()));

    if (payCommisionAmount <= 0) {
      Toast.fire({
        icon: 'error',
        title: 'Please Enter Correct Commission Amount First.'
      });
      $(this).val('0.00');
    }

    if (payCommisionAmount > depositAmountValue) {
      var bankAmountValue = payCommisionAmount - depositAmountValue;
      commissionRow.find('.bank-amount-value').val(check(bankAmountValue));
      getBankTotalAmountPaid();
    }

    totalDepositAmountValues();
    calTotalDepositAmountLeftToAllocate();
  });
  $(document).on('change', '.finance-child', function (event) {
    var commissionRow = $(this).closest('.commission-row');
    var financeChild = commissionRow.find('.finance-child').prop('checked');

    if (financeChild) {
      var outstandingAmountLeft = parseFloat(commissionRow.find('.outstanding-amount-left').val());
      commissionRow.find('.pay-commission-amount').val(check(outstandingAmountLeft));
      getRowTotalPaidAmount(commissionRow);
      getRowTotalOutstandingAmount(commissionRow);
      calDepositAndBankAmountValue(commissionRow);
    } else {
      resetCommissionRow(commissionRow);
    }

    getTotalPayCommissionAmount(); // totalDepositAmountLeftToAllocate();

    getBankTotalAmountPaid();
    getBookingCommissionTotalPaidAmount();
    getTotalOutstandingAmount();
    getDepositAndPayCommissionTotal();
    calTotalDepositAmountLeftToAllocate();
    totalDepositAmountValues();
    totalBankAmountValues();
  });
  $(document).on('submit', '#store_pay_commission', function (event) {
    event.preventDefault();
    var checkedValues = $('.finance-child:checked').map(function (i, e) {
      return e.value;
    }).get();

    if (checkedValues.length == 0) {
      Toast.fire({
        icon: 'error',
        title: 'Please Check Any Record First.'
      });
      return;
    }

    var url = $(this).attr('action');
    var formID = $(this).attr('id');
    $.ajax({
      type: 'POST',
      url: url,
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function beforeSend() {
        removeFormValidationStyles();
        addModalFormLoadingStyles("#".concat(formID));
      },
      success: function success(response) {
        removeModalFormLoadingStyles("#".concat(formID));
        printServerSuccessMessage(response, "#".concat(formID));
      },
      error: function error(response) {
        removeModalFormLoadingStyles("#".concat(formID));
        printServerValidationErrors(response);
      }
    });
  });
  $("#pay_deposit_amount_row").hide();
  $("#pay_deposit_amount").click(function () {
    $("#pay_deposit_amount_row").toggle();
  });
  $("#pay_bonus_amount_row").hide();
  $("#bonus_amount_btn").click(function () {
    $("#pay_bonus_amount_row").toggle();
  });
  $(document).on('click', ".commission-status", function (event) {
    var url = $(this).data('action');
    var actionType = $(this).data('action_type');
    var message = "";
    var buttonText = "";

    switch (actionType) {
      case "confirmed":
        message = 'You want to Confirmed Commission?';
        buttonText = 'Confirmed';
        break;

      case "dispute":
        message = 'You want to Dispute Commission?';
        buttonText = 'Dispute';
        break;
    }

    Swal.fire({
      title: 'Are you sure?',
      text: message,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#dc3545',
      confirmButtonText: "Yes, ".concat(buttonText, " it !")
    }).then(function (result) {
      if (result.isConfirmed) {
        var modal = $('#dispute_booking_modal');

        if (actionType == "dispute") {
          modal.modal('show');
          $("#dispute_commission_form")[0].reset();
          modal.find('#dispute_commission_form').attr("action", url);
        }

        if (actionType == "confirmed") {
          $.ajax({
            type: 'PATCH',
            url: url,
            contentType: false,
            cache: false,
            processData: false,
            success: function success(response) {
              resetTable(response);
            }
          });
        }
      }
    });
  });
  $(document).on('submit', '#dispute_commission_form', function (event) {
    event.preventDefault();
    var formID = $(this).attr('id');
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'),
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function beforeSend() {
        removeFormValidationStyles();
        addModalFormLoadingStyles("#".concat(formID));
      },
      success: function success(response) {
        removeModalFormLoadingStyles("#".concat(formID));
        $("#dispute_booking_modal").modal('hide');
        resetTable(response);
      },
      error: function error(response) {
        removeModalFormLoadingStyles("#".concat(formID));
        printModalServerValidationErrors(response, "#".concat(formID));
      }
    });
  });
  $(document).on('click', ".view-dispute-detail", function (event) {
    event.preventDefault();
    var disputeDetails = $(this).data('details');
    var modal = $('#view_dispute_detail_modal');
    modal.modal('show');
    modal.find('#view_dispute_detail').html('');
    modal.find('#view_dispute_detail').html(disputeDetails);
  });
  $(document).on('click', ".adjust-booking-commission", function (event) {
    var modal = $('#adjust_booking_commission_modal');
    modal.modal('show');
    var saleAgentCurrencyCode = $(this).data('sale_agent_currency_code');
    var bookingCurrencyCode = $(this).data('booking_currency_code');
    var saleAgentCommissionAmount = $(this).data('sale_agent_commission_amount');
    var bookingID = $(this).data('booking_id');
    var batchID = $(this).data('batch_id');
    $('.sale-person-currency-code').html(saleAgentCurrencyCode);
    $('#sale_person_currency_code').val(saleAgentCurrencyCode);
    $('#current_commission_amount').val(check(saleAgentCommissionAmount));
    $('#booking_id').val(bookingID);
    $('#booking_currency_code').val(bookingCurrencyCode);
    $('.batch-id').val(batchID);
  });
  $(document).on('click', '.batch-parent', function () {
    var batchID = $(this).data('batch_id');

    if ($(this).is(':checked', true)) {
      $(".batch-child-".concat(batchID)).prop('checked', true);
    } else {
      $(".batch-child-".concat(batchID)).prop('checked', false);
    }
  });
  $(document).on('click', '.sale-person-commission-bulk-action-item', function () {
    var checkedValues = $('.batch-child:checked').map(function (i, e) {
      return e.value;
    }).get();
    var batchCheckedValues = $('.batch-parent:checked').map(function (i, e) {
      return e.value;
    }).get();
    var bulkActionType = $(this).data('action_type');
    var message = "";
    var buttonText = "";

    if (['confirmed'].includes(bulkActionType)) {
      if (checkedValues.length > 0) {
        $('input[name="bulk_action_type"]').val(bulkActionType);
        $('input[name="bulk_action_ids"]').val(checkedValues);
        $('input[name="batch_ids"]').val(batchCheckedValues);

        switch (bulkActionType) {
          case "confirmed":
            message = 'You want to Confirmed Commission?';
            buttonText = 'Confirm';
            break;
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#sale_person_commission_bulk_action').attr('action'),
              data: new FormData($('#sale_person_commission_bulk_action')[0]),
              contentType: false,
              cache: false,
              processData: false,
              success: function success(response) {
                printListingSuccessMessage(response);
              }
            });
          }
        });
      } else {
        printListingErrorMessage("Please Check Atleast One Record.");
      }
    }
  });
  $(document).on('click', ".pay-batch", function (event) {
    event.preventDefault();
    var batchID = $(this).data('batch_id');
    var modal = $('#pay_batch_modal');
    modal.find('#batch_id').val(batchID);
    modal.modal('show');
  });
  $(document).on('submit', "#pay_batch_modal_form", function (event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var formID = $(this).attr('id');
    $.ajax({
      type: 'POST',
      url: url,
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function beforeSend() {
        removeFormValidationStyles();
        addModalFormLoadingStyles("#".concat(formID));
      },
      success: function success(response) {
        removeModalFormLoadingStyles("#".concat(formID));
        $("#pay_batch_modal").modal('hide');
        $("#listing_card_body").load("".concat(location.href, " #listing_card_body"));
        Toast.fire({
          icon: 'success',
          title: response.success_message
        });
      },
      error: function error(response) {
        removeModalFormLoadingStyles("#".concat(formID));
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('click', ".store-sale-person-bonus", function (event) {
    var modal = $('#store_sale_person_bonus_modal');
    var bookingID = $(this).data('booking_id');
    var saleAgentCurrencyCode = $(this).data('sale_agent_currency_code');
    modal.modal('show');
    modal.find('form')[0].reset();
    modal.find('.booking-id').val(bookingID);
    modal.find('.sale-person-currency-code').html(saleAgentCurrencyCode);
  });
  $(document).on('submit', '#store_sale_person_bonus_modal_form', function (event) {
    event.preventDefault();
    var formID = $(this).attr('id');
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'),
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function beforeSend() {
        removeFormValidationStyles();
        addModalFormLoadingStyles("#".concat(formID));
      },
      success: function success(response) {
        removeModalFormLoadingStyles("#".concat(formID));
        $("#store_sale_person_bonus_modal").modal('hide');
        location.reload();
        Toast.fire({
          icon: 'success',
          title: response.success_message
        });
      },
      error: function error(response) {
        removeModalFormLoadingStyles("#".concat(formID));
        printModalServerValidationErrors(response, "#".concat(formID));
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/commission_management/sale_person_payment_app.js":
/*!***********************************************************************!*\
  !*** ./resources/js/commission_management/sale_person_payment_app.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $(document).on('submit', '#store_sale_person_payment', function (event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var formID = $(this).attr('id');
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
        printServerSuccessMessage(response, "#".concat(formID));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('submit', '#update_sale_person_payment', function (event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var formID = $(this).attr('id');
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
        printServerSuccessMessage(response, "#".concat(formID));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('change', '.sale-person-id', function (event) {
    var salePersonCurrencyID = $(this).find(":selected").data('sale_person_currency_id');
    var salePersonCurrencyCode = $(this).find(":selected").data("sale_person_currency_code");
    $('.sale-person-currency-id').val(salePersonCurrencyID);
    $('.sale-person-currency-code').html(salePersonCurrencyCode);
  });
});

/***/ }),

/***/ "./resources/js/commission_management/view_commission_detail.js":
/*!**********************************************************************!*\
  !*** ./resources/js/commission_management/view_commission_detail.js ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).on('click', ".view-detail", function (event) {
  event.preventDefault();
  var bookingID = $(this).data('booking_id');
  var modal = $('#view_detail_modal');
  modal.find('#commission_detail').val(bookingID);
  $.ajax({
    type: 'POST',
    url: "".concat(REDIRECT_BASEURL, "pay-commissions/view-commission-detail/").concat(bookingID),
    data: {
      'booking_id': bookingID
    },
    success: function success(response) {
      if (response.status && response.hasOwnProperty('html')) {
        modal.modal('show');
        $('#view_detail_modal .modal-body').html(response.html);
      }
    },
    error: function error(_error) {
      console.log(_error);
    }
  });
});

/***/ }),

/***/ 5:
/*!*****************************************************!*\
  !*** multi ./resources/js/commission_management.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\ufg-form\resources\js\commission_management.js */"./resources/js/commission_management.js");


/***/ })

/******/ });