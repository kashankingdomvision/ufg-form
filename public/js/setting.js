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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
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
  | Store Brand 
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
  | Update Brand
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
  | Store Brand 
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
  | Update Brand
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

/***/ 6:
/*!***************************************!*\
  !*** multi ./resources/js/setting.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\ufg-form\resources\js\setting.js */"./resources/js/setting.js");


/***/ })

/******/ });