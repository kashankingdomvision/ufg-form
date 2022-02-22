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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/setting.js":
/*!*********************************!*\
  !*** ./resources/js/setting.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./setting/airport_code_app */ "./resources/js/setting/airport_code_app.js");

__webpack_require__(/*! ./setting/bank_app */ "./resources/js/setting/bank_app.js");

__webpack_require__(/*! ./setting/brand_app */ "./resources/js/setting/brand_app.js");

__webpack_require__(/*! ./setting/country_app */ "./resources/js/setting/country_app.js");

__webpack_require__(/*! ./setting/currency_app */ "./resources/js/setting/currency_app.js");

__webpack_require__(/*! ./setting/currency_conversion_app */ "./resources/js/setting/currency_conversion_app.js");

__webpack_require__(/*! ./setting/harbour_app */ "./resources/js/setting/harbour_app.js");

__webpack_require__(/*! ./setting/holiday_type_app */ "./resources/js/setting/holiday_type_app.js");

__webpack_require__(/*! ./setting/hotel_app */ "./resources/js/setting/hotel_app.js");

__webpack_require__(/*! ./setting/location_app */ "./resources/js/setting/location_app.js");

__webpack_require__(/*! ./setting/payment_method */ "./resources/js/setting/payment_method.js");

__webpack_require__(/*! ./setting/preset_comment_app */ "./resources/js/setting/preset_comment_app.js");

__webpack_require__(/*! ./setting/season_app */ "./resources/js/setting/season_app.js");

__webpack_require__(/*! ./setting/store_text_app */ "./resources/js/setting/store_text_app.js");

/***/ }),

/***/ "./resources/js/setting/airport_code_app.js":
/*!**************************************************!*\
  !*** ./resources/js/setting/airport_code_app.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store AirportCode 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_airport_code', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "airport-codes/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update AirportCode
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_airport_code', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "airport-codes/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('click', '.airport-code-bulk-action-item', function () {
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
            message = 'You want to Delete Airports?';
            buttonText = 'Delete';
            break;
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#airport_code_bulk_action').attr('action'),
              data: new FormData($('#airport_code_bulk_action')[0]),
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

/***/ "./resources/js/setting/bank_app.js":
/*!******************************************!*\
  !*** ./resources/js/setting/bank_app.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Bank
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_bank', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "banks/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Bank
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_bank', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "banks/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('click', '.bank-bulk-action-item', function () {
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
            message = 'You want to Delete Banks?';
            buttonText = 'Delete';
            break;
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#bank_bulk_action').attr('action'),
              data: new FormData($('#bank_bulk_action')[0]),
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

/***/ "./resources/js/setting/brand_app.js":
/*!*******************************************!*\
  !*** ./resources/js/setting/brand_app.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Brand 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_brand', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "brands/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Brand
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_brand', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "brands/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('click', '.brand-bulk-action-item', function () {
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
            message = 'You want to Delete Brands?';
            buttonText = 'Delete';
            break;
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#brand_bulk_action').attr('action'),
              data: new FormData($('#brand_bulk_action')[0]),
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

/***/ "./resources/js/setting/country_app.js":
/*!*********************************************!*\
  !*** ./resources/js/setting/country_app.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Country 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_country', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "countries/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Country
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_country', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "countries/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('click', '.country-bulk-action-item', function () {
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
            message = 'You want to Delete Countries?';
            buttonText = 'Delete';
            break;
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#country_bulk_action').attr('action'),
              data: new FormData($('#country_bulk_action')[0]),
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

/***/ "./resources/js/setting/currency_app.js":
/*!**********************************************!*\
  !*** ./resources/js/setting/currency_app.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Currency 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_currency', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "currencies/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Currency
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_currency', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "currencies/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('click', '.currency-bulk-action-item', function () {
    var checkedValues = $('.child:checked').map(function (i, e) {
      return e.value;
    }).get();
    var bulkActionType = $(this).data('action_type');
    var message = "";
    var buttonText = "";

    if (['active', 'inactive'].includes(bulkActionType)) {
      if (checkedValues.length > 0) {
        $('input[name="bulk_action_type"]').val(bulkActionType);
        $('input[name="bulk_action_ids"]').val(checkedValues);

        switch (bulkActionType) {
          case "active":
            message = 'You want to Active currencies?';
            buttonText = 'Active';
            break;

          case "inactive":
            message = 'You want to Inactive currencies?';
            buttonText = 'Inactive';
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#currency_bulk_action').attr('action'),
              data: new FormData($('#currency_bulk_action')[0]),
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

/***/ "./resources/js/setting/currency_conversion_app.js":
/*!*********************************************************!*\
  !*** ./resources/js/setting/currency_conversion_app.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Update CurrencyConversion
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#update_currency_conversion', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "currency-conversions/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/setting/harbour_app.js":
/*!*********************************************!*\
  !*** ./resources/js/setting/harbour_app.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Harbour 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_harbour', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "harbours/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Harbour
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_harbour', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "harbours/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('click', '.harbour-bulk-action-item', function () {
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
            message = 'You want to Delete Harbours, Train & POI?';
            buttonText = 'Delete';
            break;
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#harbour_bulk_action').attr('action'),
              data: new FormData($('#harbour_bulk_action')[0]),
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

/***/ "./resources/js/setting/holiday_type_app.js":
/*!**************************************************!*\
  !*** ./resources/js/setting/holiday_type_app.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Holiday Type 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_holiday_type', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "holiday-types/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Holiday Type
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_holiday_type', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "holiday-types/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('click', '.holiday-type-bulk-action-item', function () {
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
            message = 'You want to Delete Holiday Types?';
            buttonText = 'Delete';
            break;
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#holiday_type_bulk_action').attr('action'),
              data: new FormData($('#holiday_type_bulk_action')[0]),
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

/***/ "./resources/js/setting/hotel_app.js":
/*!*******************************************!*\
  !*** ./resources/js/setting/hotel_app.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Hotel 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_hotel', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "hotels/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Hotel
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_hotel', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "hotels/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('click', '.hotel-bulk-action-item', function () {
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
            message = 'You want to Delete Hotels?';
            buttonText = 'Delete';
            break;
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#hotel_bulk_action').attr('action'),
              data: new FormData($('#hotel_bulk_action')[0]),
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

/***/ "./resources/js/setting/location_app.js":
/*!**********************************************!*\
  !*** ./resources/js/setting/location_app.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Location 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_location', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "locations/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Location
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_location', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "locations/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('click', '.location-bulk-action-item', function () {
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
            message = 'You want to Delete Locations?';
            buttonText = 'Delete';
            break;
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#location_bulk_action').attr('action'),
              data: new FormData($('#location_bulk_action')[0]),
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

/***/ "./resources/js/setting/payment_method.js":
/*!************************************************!*\
  !*** ./resources/js/setting/payment_method.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Payment Method 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_payment_method', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "payment-methods/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Payment Method
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_payment_method', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "payment-methods/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('click', '.payment-method-bulk-action-item', function () {
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
            message = 'You want to Delete Payment Methods?';
            buttonText = 'Delete';
            break;
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#payment_method_bulk_action').attr('action'),
              data: new FormData($('#payment_method_bulk_action')[0]),
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

/***/ "./resources/js/setting/preset_comment_app.js":
/*!****************************************************!*\
  !*** ./resources/js/setting/preset_comment_app.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Preset Comment 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_preset_comment', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "preset-comments/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Preset Comment
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_preset_comment', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "preset-comments/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  $(document).on('click', '.preset-comment-bulk-action-item', function () {
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
            message = 'You want to Delete Preset Comments?';
            buttonText = 'Delete';
            break;
        }

        Swal.fire({
          title: 'Are you sure?',
          text: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#dc3545',
          confirmButtonText: "Yes, ".concat(buttonText, " it !")
        }).then(function (result) {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: $('#preset_comment_bulk_action').attr('action'),
              data: new FormData($('#preset_comment_bulk_action')[0]),
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

/***/ "./resources/js/setting/season_app.js":
/*!********************************************!*\
  !*** ./resources/js/setting/season_app.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Season 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_season', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "seasons/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Season
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_season', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "seasons/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/setting/store_text_app.js":
/*!************************************************!*\
  !*** ./resources/js/setting/store_text_app.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /*
  |--------------------------------------------------------------------------------
  | Store Store Text 
  |--------------------------------------------------------------------------------
  */
  $(document).on('submit', '#store_store_text', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "store-texts/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
  /*
  |--------------------------------------------------------------------------------
  | Update Store Text
  |--------------------------------------------------------------------------------
  */

  $(document).on('submit', '#update_store_text', function (event) {
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
        printServerSuccessMessage(response, "".concat(REDIRECT_BASEURL, "store-texts/index"));
      },
      error: function error(response) {
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });
  });
});

/***/ }),

/***/ 7:
/*!***************************************!*\
  !*** multi ./resources/js/setting.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\ufg-form\resources\js\setting.js */"./resources/js/setting.js");


/***/ })

/******/ });