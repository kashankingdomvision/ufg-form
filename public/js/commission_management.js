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
// require('./commission_management/commission_criteria_app.js');


__webpack_require__(/*! ./commission_management/pay_commission.js */ "./resources/js/commission_management/pay_commission.js");

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

/***/ "./resources/js/commission_management/pay_commission.js":
/*!**************************************************************!*\
  !*** ./resources/js/commission_management/pay_commission.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  function getTotalPaidAmount() {
    var valesArray = $('.row-total-paid-amount').map(function (i, e) {
      return parseFloat(removeComma(e.value));
    }).get();
    var rowTotalPaidAmount = valesArray.reduce(function (a, b) {
      return a + b;
    }, 0);
    $('.total-paid-amount').html(check(rowTotalPaidAmount)).val(check(rowTotalPaidAmount));
  }

  function getTotalOutstandingAmount() {
    var valesArray = $('.row-total-outstanding-amount').map(function (i, e) {
      return parseFloat(removeComma(e.value));
    }).get();
    var rowTotalOutstandingAmount = valesArray.reduce(function (a, b) {
      return a + b;
    }, 0);
    $('.total-outstanding-amount').html(check(rowTotalOutstandingAmount)).val(check(rowTotalOutstandingAmount));
  }

  $(document).on("change", '.pay-commission-amount', function (e) {
    var commissionRow = $(this).closest('.commission-row');
    var totalPaidAmountYet = removeComma(commissionRow.find('.total-paid-amount-yet').val());
    var payCommisionAmount = removeComma(commissionRow.find('.pay-commission-amount').val());
    var outstandingAmountLeft = removeComma(commissionRow.find('.outstanding-amount-left').val());

    if (parseFloat(payCommisionAmount) > parseFloat(outstandingAmountLeft)) {
      Toast.fire({
        icon: 'warning',
        title: 'Please Enter Correct Amount.'
      });
      $(this).val('0.00');
      return;
    }

    var rowTotalPaidAmount = parseFloat(totalPaidAmountYet) + parseFloat(payCommisionAmount);
    var rowTotalOutstandingAmount = parseFloat(outstandingAmountLeft) - parseFloat(payCommisionAmount);
    commissionRow.find('.row-total-paid-amount').val(check(rowTotalPaidAmount));
    commissionRow.find('.row-total-outstanding-amount').val(check(rowTotalOutstandingAmount));
    getTotalPaidAmount();
    getTotalOutstandingAmount();
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