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

/***/ "./node_modules/jquery/dist/jquery.js":
/*!********************************************!*\
  !*** ./node_modules/jquery/dist/jquery.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
 * jQuery JavaScript Library v3.6.0
 * https://jquery.com/
 *
 * Includes Sizzle.js
 * https://sizzlejs.com/
 *
 * Copyright OpenJS Foundation and other contributors
 * Released under the MIT license
 * https://jquery.org/license
 *
 * Date: 2021-03-02T17:08Z
 */
( function( global, factory ) {

	"use strict";

	if (  true && typeof module.exports === "object" ) {

		// For CommonJS and CommonJS-like environments where a proper `window`
		// is present, execute the factory and get jQuery.
		// For environments that do not have a `window` with a `document`
		// (such as Node.js), expose a factory as module.exports.
		// This accentuates the need for the creation of a real `window`.
		// e.g. var jQuery = require("jquery")(window);
		// See ticket #14549 for more info.
		module.exports = global.document ?
			factory( global, true ) :
			function( w ) {
				if ( !w.document ) {
					throw new Error( "jQuery requires a window with a document" );
				}
				return factory( w );
			};
	} else {
		factory( global );
	}

// Pass this if window is not defined yet
} )( typeof window !== "undefined" ? window : this, function( window, noGlobal ) {

// Edge <= 12 - 13+, Firefox <=18 - 45+, IE 10 - 11, Safari 5.1 - 9+, iOS 6 - 9.1
// throw exceptions when non-strict code (e.g., ASP.NET 4.5) accesses strict mode
// arguments.callee.caller (trac-13335). But as of jQuery 3.0 (2016), strict mode should be common
// enough that all such attempts are guarded in a try block.
"use strict";

var arr = [];

var getProto = Object.getPrototypeOf;

var slice = arr.slice;

var flat = arr.flat ? function( array ) {
	return arr.flat.call( array );
} : function( array ) {
	return arr.concat.apply( [], array );
};


var push = arr.push;

var indexOf = arr.indexOf;

var class2type = {};

var toString = class2type.toString;

var hasOwn = class2type.hasOwnProperty;

var fnToString = hasOwn.toString;

var ObjectFunctionString = fnToString.call( Object );

var support = {};

var isFunction = function isFunction( obj ) {

		// Support: Chrome <=57, Firefox <=52
		// In some browsers, typeof returns "function" for HTML <object> elements
		// (i.e., `typeof document.createElement( "object" ) === "function"`).
		// We don't want to classify *any* DOM node as a function.
		// Support: QtWeb <=3.8.5, WebKit <=534.34, wkhtmltopdf tool <=0.12.5
		// Plus for old WebKit, typeof returns "function" for HTML collections
		// (e.g., `typeof document.getElementsByTagName("div") === "function"`). (gh-4756)
		return typeof obj === "function" && typeof obj.nodeType !== "number" &&
			typeof obj.item !== "function";
	};


var isWindow = function isWindow( obj ) {
		return obj != null && obj === obj.window;
	};


var document = window.document;



	var preservedScriptAttributes = {
		type: true,
		src: true,
		nonce: true,
		noModule: true
	};

	function DOMEval( code, node, doc ) {
		doc = doc || document;

		var i, val,
			script = doc.createElement( "script" );

		script.text = code;
		if ( node ) {
			for ( i in preservedScriptAttributes ) {

				// Support: Firefox 64+, Edge 18+
				// Some browsers don't support the "nonce" property on scripts.
				// On the other hand, just using `getAttribute` is not enough as
				// the `nonce` attribute is reset to an empty string whenever it
				// becomes browsing-context connected.
				// See https://github.com/whatwg/html/issues/2369
				// See https://html.spec.whatwg.org/#nonce-attributes
				// The `node.getAttribute` check was added for the sake of
				// `jQuery.globalEval` so that it can fake a nonce-containing node
				// via an object.
				val = node[ i ] || node.getAttribute && node.getAttribute( i );
				if ( val ) {
					script.setAttribute( i, val );
				}
			}
		}
		doc.head.appendChild( script ).parentNode.removeChild( script );
	}


function toType( obj ) {
	if ( obj == null ) {
		return obj + "";
	}

	// Support: Android <=2.3 only (functionish RegExp)
	return typeof obj === "object" || typeof obj === "function" ?
		class2type[ toString.call( obj ) ] || "object" :
		typeof obj;
}
/* global Symbol */
// Defining this global in .eslintrc.json would create a danger of using the global
// unguarded in another place, it seems safer to define global only for this module



var
	version = "3.6.0",

	// Define a local copy of jQuery
	jQuery = function( selector, context ) {

		// The jQuery object is actually just the init constructor 'enhanced'
		// Need init if jQuery is called (just allow error to be thrown if not included)
		return new jQuery.fn.init( selector, context );
	};

jQuery.fn = jQuery.prototype = {

	// The current version of jQuery being used
	jquery: version,

	constructor: jQuery,

	// The default length of a jQuery object is 0
	length: 0,

	toArray: function() {
		return slice.call( this );
	},

	// Get the Nth element in the matched element set OR
	// Get the whole matched element set as a clean array
	get: function( num ) {

		// Return all the elements in a clean array
		if ( num == null ) {
			return slice.call( this );
		}

		// Return just the one element from the set
		return num < 0 ? this[ num + this.length ] : this[ num ];
	},

	// Take an array of elements and push it onto the stack
	// (returning the new matched element set)
	pushStack: function( elems ) {

		// Build a new jQuery matched element set
		var ret = jQuery.merge( this.constructor(), elems );

		// Add the old object onto the stack (as a reference)
		ret.prevObject = this;

		// Return the newly-formed element set
		return ret;
	},

	// Execute a callback for every element in the matched set.
	each: function( callback ) {
		return jQuery.each( this, callback );
	},

	map: function( callback ) {
		return this.pushStack( jQuery.map( this, function( elem, i ) {
			return callback.call( elem, i, elem );
		} ) );
	},

	slice: function() {
		return this.pushStack( slice.apply( this, arguments ) );
	},

	first: function() {
		return this.eq( 0 );
	},

	last: function() {
		return this.eq( -1 );
	},

	even: function() {
		return this.pushStack( jQuery.grep( this, function( _elem, i ) {
			return ( i + 1 ) % 2;
		} ) );
	},

	odd: function() {
		return this.pushStack( jQuery.grep( this, function( _elem, i ) {
			return i % 2;
		} ) );
	},

	eq: function( i ) {
		var len = this.length,
			j = +i + ( i < 0 ? len : 0 );
		return this.pushStack( j >= 0 && j < len ? [ this[ j ] ] : [] );
	},

	end: function() {
		return this.prevObject || this.constructor();
	},

	// For internal use only.
	// Behaves like an Array's method, not like a jQuery method.
	push: push,
	sort: arr.sort,
	splice: arr.splice
};

jQuery.extend = jQuery.fn.extend = function() {
	var options, name, src, copy, copyIsArray, clone,
		target = arguments[ 0 ] || {},
		i = 1,
		length = arguments.length,
		deep = false;

	// Handle a deep copy situation
	if ( typeof target === "boolean" ) {
		deep = target;

		// Skip the boolean and the target
		target = arguments[ i ] || {};
		i++;
	}

	// Handle case when target is a string or something (possible in deep copy)
	if ( typeof target !== "object" && !isFunction( target ) ) {
		target = {};
	}

	// Extend jQuery itself if only one argument is passed
	if ( i === length ) {
		target = this;
		i--;
	}

	for ( ; i < length; i++ ) {

		// Only deal with non-null/undefined values
		if ( ( options = arguments[ i ] ) != null ) {

			// Extend the base object
			for ( name in options ) {
				copy = options[ name ];

				// Prevent Object.prototype pollution
				// Prevent never-ending loop
				if ( name === "__proto__" || target === copy ) {
					continue;
				}

				// Recurse if we're merging plain objects or arrays
				if ( deep && copy && ( jQuery.isPlainObject( copy ) ||
					( copyIsArray = Array.isArray( copy ) ) ) ) {
					src = target[ name ];

					// Ensure proper type for the source value
					if ( copyIsArray && !Array.isArray( src ) ) {
						clone = [];
					} else if ( !copyIsArray && !jQuery.isPlainObject( src ) ) {
						clone = {};
					} else {
						clone = src;
					}
					copyIsArray = false;

					// Never move original objects, clone them
					target[ name ] = jQuery.extend( deep, clone, copy );

				// Don't bring in undefined values
				} else if ( copy !== undefined ) {
					target[ name ] = copy;
				}
			}
		}
	}

	// Return the modified object
	return target;
};

jQuery.extend( {

	// Unique for each copy of jQuery on the page
	expando: "jQuery" + ( version + Math.random() ).replace( /\D/g, "" ),

	// Assume jQuery is ready without the ready module
	isReady: true,

	error: function( msg ) {
		throw new Error( msg );
	},

	noop: function() {},

	isPlainObject: function( obj ) {
		var proto, Ctor;

		// Detect obvious negatives
		// Use toString instead of jQuery.type to catch host objects
		if ( !obj || toString.call( obj ) !== "[object Object]" ) {
			return false;
		}

		proto = getProto( obj );

		// Objects with no prototype (e.g., `Object.create( null )`) are plain
		if ( !proto ) {
			return true;
		}

		// Objects with prototype are plain iff they were constructed by a global Object function
		Ctor = hasOwn.call( proto, "constructor" ) && proto.constructor;
		return typeof Ctor === "function" && fnToString.call( Ctor ) === ObjectFunctionString;
	},

	isEmptyObject: function( obj ) {
		var name;

		for ( name in obj ) {
			return false;
		}
		return true;
	},

	// Evaluates a script in a provided context; falls back to the global one
	// if not specified.
	globalEval: function( code, options, doc ) {
		DOMEval( code, { nonce: options && options.nonce }, doc );
	},

	each: function( obj, callback ) {
		var length, i = 0;

		if ( isArrayLike( obj ) ) {
			length = obj.length;
			for ( ; i < length; i++ ) {
				if ( callback.call( obj[ i ], i, obj[ i ] ) === false ) {
					break;
				}
			}
		} else {
			for ( i in obj ) {
				if ( callback.call( obj[ i ], i, obj[ i ] ) === false ) {
					break;
				}
			}
		}

		return obj;
	},

	// results is for internal usage only
	makeArray: function( arr, results ) {
		var ret = results || [];

		if ( arr != null ) {
			if ( isArrayLike( Object( arr ) ) ) {
				jQuery.merge( ret,
					typeof arr === "string" ?
						[ arr ] : arr
				);
			} else {
				push.call( ret, arr );
			}
		}

		return ret;
	},

	inArray: function( elem, arr, i ) {
		return arr == null ? -1 : indexOf.call( arr, elem, i );
	},

	// Support: Android <=4.0 only, PhantomJS 1 only
	// push.apply(_, arraylike) throws on ancient WebKit
	merge: function( first, second ) {
		var len = +second.length,
			j = 0,
			i = first.length;

		for ( ; j < len; j++ ) {
			first[ i++ ] = second[ j ];
		}

		first.length = i;

		return first;
	},

	grep: function( elems, callback, invert ) {
		var callbackInverse,
			matches = [],
			i = 0,
			length = elems.length,
			callbackExpect = !invert;

		// Go through the array, only saving the items
		// that pass the validator function
		for ( ; i < length; i++ ) {
			callbackInverse = !callback( elems[ i ], i );
			if ( callbackInverse !== callbackExpect ) {
				matches.push( elems[ i ] );
			}
		}

		return matches;
	},

	// arg is for internal usage only
	map: function( elems, callback, arg ) {
		var length, value,
			i = 0,
			ret = [];

		// Go through the array, translating each of the items to their new values
		if ( isArrayLike( elems ) ) {
			length = elems.length;
			for ( ; i < length; i++ ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}

		// Go through every key on the object,
		} else {
			for ( i in elems ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}
		}

		// Flatten any nested arrays
		return flat( ret );
	},

	// A global GUID counter for objects
	guid: 1,

	// jQuery.support is not used in Core but other projects attach their
	// properties to it so it needs to exist.
	support: support
} );

if ( typeof Symbol === "function" ) {
	jQuery.fn[ Symbol.iterator ] = arr[ Symbol.iterator ];
}

// Populate the class2type map
jQuery.each( "Boolean Number String Function Array Date RegExp Object Error Symbol".split( " " ),
	function( _i, name ) {
		class2type[ "[object " + name + "]" ] = name.toLowerCase();
	} );

function isArrayLike( obj ) {

	// Support: real iOS 8.2 only (not reproducible in simulator)
	// `in` check used to prevent JIT error (gh-2145)
	// hasOwn isn't used here due to false negatives
	// regarding Nodelist length in IE
	var length = !!obj && "length" in obj && obj.length,
		type = toType( obj );

	if ( isFunction( obj ) || isWindow( obj ) ) {
		return false;
	}

	return type === "array" || length === 0 ||
		typeof length === "number" && length > 0 && ( length - 1 ) in obj;
}
var Sizzle =
/*!
 * Sizzle CSS Selector Engine v2.3.6
 * https://sizzlejs.com/
 *
 * Copyright JS Foundation and other contributors
 * Released under the MIT license
 * https://js.foundation/
 *
 * Date: 2021-02-16
 */
( function( window ) {
var i,
	support,
	Expr,
	getText,
	isXML,
	tokenize,
	compile,
	select,
	outermostContext,
	sortInput,
	hasDuplicate,

	// Local document vars
	setDocument,
	document,
	docElem,
	documentIsHTML,
	rbuggyQSA,
	rbuggyMatches,
	matches,
	contains,

	// Instance-specific data
	expando = "sizzle" + 1 * new Date(),
	preferredDoc = window.document,
	dirruns = 0,
	done = 0,
	classCache = createCache(),
	tokenCache = createCache(),
	compilerCache = createCache(),
	nonnativeSelectorCache = createCache(),
	sortOrder = function( a, b ) {
		if ( a === b ) {
			hasDuplicate = true;
		}
		return 0;
	},

	// Instance methods
	hasOwn = ( {} ).hasOwnProperty,
	arr = [],
	pop = arr.pop,
	pushNative = arr.push,
	push = arr.push,
	slice = arr.slice,

	// Use a stripped-down indexOf as it's faster than native
	// https://jsperf.com/thor-indexof-vs-for/5
	indexOf = function( list, elem ) {
		var i = 0,
			len = list.length;
		for ( ; i < len; i++ ) {
			if ( list[ i ] === elem ) {
				return i;
			}
		}
		return -1;
	},

	booleans = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|" +
		"ismap|loop|multiple|open|readonly|required|scoped",

	// Regular expressions

	// http://www.w3.org/TR/css3-selectors/#whitespace
	whitespace = "[\\x20\\t\\r\\n\\f]",

	// https://www.w3.org/TR/css-syntax-3/#ident-token-diagram
	identifier = "(?:\\\\[\\da-fA-F]{1,6}" + whitespace +
		"?|\\\\[^\\r\\n\\f]|[\\w-]|[^\0-\\x7f])+",

	// Attribute selectors: http://www.w3.org/TR/selectors/#attribute-selectors
	attributes = "\\[" + whitespace + "*(" + identifier + ")(?:" + whitespace +

		// Operator (capture 2)
		"*([*^$|!~]?=)" + whitespace +

		// "Attribute values must be CSS identifiers [capture 5]
		// or strings [capture 3 or capture 4]"
		"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + identifier + "))|)" +
		whitespace + "*\\]",

	pseudos = ":(" + identifier + ")(?:\\((" +

		// To reduce the number of selectors needing tokenize in the preFilter, prefer arguments:
		// 1. quoted (capture 3; capture 4 or capture 5)
		"('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|" +

		// 2. simple (capture 6)
		"((?:\\\\.|[^\\\\()[\\]]|" + attributes + ")*)|" +

		// 3. anything else (capture 2)
		".*" +
		")\\)|)",

	// Leading and non-escaped trailing whitespace, capturing some non-whitespace characters preceding the latter
	rwhitespace = new RegExp( whitespace + "+", "g" ),
	rtrim = new RegExp( "^" + whitespace + "+|((?:^|[^\\\\])(?:\\\\.)*)" +
		whitespace + "+$", "g" ),

	rcomma = new RegExp( "^" + whitespace + "*," + whitespace + "*" ),
	rcombinators = new RegExp( "^" + whitespace + "*([>+~]|" + whitespace + ")" + whitespace +
		"*" ),
	rdescend = new RegExp( whitespace + "|>" ),

	rpseudo = new RegExp( pseudos ),
	ridentifier = new RegExp( "^" + identifier + "$" ),

	matchExpr = {
		"ID": new RegExp( "^#(" + identifier + ")" ),
		"CLASS": new RegExp( "^\\.(" + identifier + ")" ),
		"TAG": new RegExp( "^(" + identifier + "|[*])" ),
		"ATTR": new RegExp( "^" + attributes ),
		"PSEUDO": new RegExp( "^" + pseudos ),
		"CHILD": new RegExp( "^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" +
			whitespace + "*(even|odd|(([+-]|)(\\d*)n|)" + whitespace + "*(?:([+-]|)" +
			whitespace + "*(\\d+)|))" + whitespace + "*\\)|)", "i" ),
		"bool": new RegExp( "^(?:" + booleans + ")$", "i" ),

		// For use in libraries implementing .is()
		// We use this for POS matching in `select`
		"needsContext": new RegExp( "^" + whitespace +
			"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + whitespace +
			"*((?:-\\d)?\\d*)" + whitespace + "*\\)|)(?=[^-]|$)", "i" )
	},

	rhtml = /HTML$/i,
	rinputs = /^(?:input|select|textarea|button)$/i,
	rheader = /^h\d$/i,

	rnative = /^[^{]+\{\s*\[native \w/,

	// Easily-parseable/retrievable ID or TAG or CLASS selectors
	rquickExpr = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,

	rsibling = /[+~]/,

	// CSS escapes
	// http://www.w3.org/TR/CSS21/syndata.html#escaped-characters
	runescape = new RegExp( "\\\\[\\da-fA-F]{1,6}" + whitespace + "?|\\\\([^\\r\\n\\f])", "g" ),
	funescape = function( escape, nonHex ) {
		var high = "0x" + escape.slice( 1 ) - 0x10000;

		return nonHex ?

			// Strip the backslash prefix from a non-hex escape sequence
			nonHex :

			// Replace a hexadecimal escape sequence with the encoded Unicode code point
			// Support: IE <=11+
			// For values outside the Basic Multilingual Plane (BMP), manually construct a
			// surrogate pair
			high < 0 ?
				String.fromCharCode( high + 0x10000 ) :
				String.fromCharCode( high >> 10 | 0xD800, high & 0x3FF | 0xDC00 );
	},

	// CSS string/identifier serialization
	// https://drafts.csswg.org/cssom/#common-serializing-idioms
	rcssescape = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
	fcssescape = function( ch, asCodePoint ) {
		if ( asCodePoint ) {

			// U+0000 NULL becomes U+FFFD REPLACEMENT CHARACTER
			if ( ch === "\0" ) {
				return "\uFFFD";
			}

			// Control characters and (dependent upon position) numbers get escaped as code points
			return ch.slice( 0, -1 ) + "\\" +
				ch.charCodeAt( ch.length - 1 ).toString( 16 ) + " ";
		}

		// Other potentially-special ASCII characters get backslash-escaped
		return "\\" + ch;
	},

	// Used for iframes
	// See setDocument()
	// Removing the function wrapper causes a "Permission Denied"
	// error in IE
	unloadHandler = function() {
		setDocument();
	},

	inDisabledFieldset = addCombinator(
		function( elem ) {
			return elem.disabled === true && elem.nodeName.toLowerCase() === "fieldset";
		},
		{ dir: "parentNode", next: "legend" }
	);

// Optimize for push.apply( _, NodeList )
try {
	push.apply(
		( arr = slice.call( preferredDoc.childNodes ) ),
		preferredDoc.childNodes
	);

	// Support: Android<4.0
	// Detect silently failing push.apply
	// eslint-disable-next-line no-unused-expressions
	arr[ preferredDoc.childNodes.length ].nodeType;
} catch ( e ) {
	push = { apply: arr.length ?

		// Leverage slice if possible
		function( target, els ) {
			pushNative.apply( target, slice.call( els ) );
		} :

		// Support: IE<9
		// Otherwise append directly
		function( target, els ) {
			var j = target.length,
				i = 0;

			// Can't trust NodeList.length
			while ( ( target[ j++ ] = els[ i++ ] ) ) {}
			target.length = j - 1;
		}
	};
}

function Sizzle( selector, context, results, seed ) {
	var m, i, elem, nid, match, groups, newSelector,
		newContext = context && context.ownerDocument,

		// nodeType defaults to 9, since context defaults to document
		nodeType = context ? context.nodeType : 9;

	results = results || [];

	// Return early from calls with invalid selector or context
	if ( typeof selector !== "string" || !selector ||
		nodeType !== 1 && nodeType !== 9 && nodeType !== 11 ) {

		return results;
	}

	// Try to shortcut find operations (as opposed to filters) in HTML documents
	if ( !seed ) {
		setDocument( context );
		context = context || document;

		if ( documentIsHTML ) {

			// If the selector is sufficiently simple, try using a "get*By*" DOM method
			// (excepting DocumentFragment context, where the methods don't exist)
			if ( nodeType !== 11 && ( match = rquickExpr.exec( selector ) ) ) {

				// ID selector
				if ( ( m = match[ 1 ] ) ) {

					// Document context
					if ( nodeType === 9 ) {
						if ( ( elem = context.getElementById( m ) ) ) {

							// Support: IE, Opera, Webkit
							// TODO: identify versions
							// getElementById can match elements by name instead of ID
							if ( elem.id === m ) {
								results.push( elem );
								return results;
							}
						} else {
							return results;
						}

					// Element context
					} else {

						// Support: IE, Opera, Webkit
						// TODO: identify versions
						// getElementById can match elements by name instead of ID
						if ( newContext && ( elem = newContext.getElementById( m ) ) &&
							contains( context, elem ) &&
							elem.id === m ) {

							results.push( elem );
							return results;
						}
					}

				// Type selector
				} else if ( match[ 2 ] ) {
					push.apply( results, context.getElementsByTagName( selector ) );
					return results;

				// Class selector
				} else if ( ( m = match[ 3 ] ) && support.getElementsByClassName &&
					context.getElementsByClassName ) {

					push.apply( results, context.getElementsByClassName( m ) );
					return results;
				}
			}

			// Take advantage of querySelectorAll
			if ( support.qsa &&
				!nonnativeSelectorCache[ selector + " " ] &&
				( !rbuggyQSA || !rbuggyQSA.test( selector ) ) &&

				// Support: IE 8 only
				// Exclude object elements
				( nodeType !== 1 || context.nodeName.toLowerCase() !== "object" ) ) {

				newSelector = selector;
				newContext = context;

				// qSA considers elements outside a scoping root when evaluating child or
				// descendant combinators, which is not what we want.
				// In such cases, we work around the behavior by prefixing every selector in the
				// list with an ID selector referencing the scope context.
				// The technique has to be used as well when a leading combinator is used
				// as such selectors are not recognized by querySelectorAll.
				// Thanks to Andrew Dupont for this technique.
				if ( nodeType === 1 &&
					( rdescend.test( selector ) || rcombinators.test( selector ) ) ) {

					// Expand context for sibling selectors
					newContext = rsibling.test( selector ) && testContext( context.parentNode ) ||
						context;

					// We can use :scope instead of the ID hack if the browser
					// supports it & if we're not changing the context.
					if ( newContext !== context || !support.scope ) {

						// Capture the context ID, setting it first if necessary
						if ( ( nid = context.getAttribute( "id" ) ) ) {
							nid = nid.replace( rcssescape, fcssescape );
						} else {
							context.setAttribute( "id", ( nid = expando ) );
						}
					}

					// Prefix every selector in the list
					groups = tokenize( selector );
					i = groups.length;
					while ( i-- ) {
						groups[ i ] = ( nid ? "#" + nid : ":scope" ) + " " +
							toSelector( groups[ i ] );
					}
					newSelector = groups.join( "," );
				}

				try {
					push.apply( results,
						newContext.querySelectorAll( newSelector )
					);
					return results;
				} catch ( qsaError ) {
					nonnativeSelectorCache( selector, true );
				} finally {
					if ( nid === expando ) {
						context.removeAttribute( "id" );
					}
				}
			}
		}
	}

	// All others
	return select( selector.replace( rtrim, "$1" ), context, results, seed );
}

/**
 * Create key-value caches of limited size
 * @returns {function(string, object)} Returns the Object data after storing it on itself with
 *	property name the (space-suffixed) string and (if the cache is larger than Expr.cacheLength)
 *	deleting the oldest entry
 */
function createCache() {
	var keys = [];

	function cache( key, value ) {

		// Use (key + " ") to avoid collision with native prototype properties (see Issue #157)
		if ( keys.push( key + " " ) > Expr.cacheLength ) {

			// Only keep the most recent entries
			delete cache[ keys.shift() ];
		}
		return ( cache[ key + " " ] = value );
	}
	return cache;
}

/**
 * Mark a function for special use by Sizzle
 * @param {Function} fn The function to mark
 */
function markFunction( fn ) {
	fn[ expando ] = true;
	return fn;
}

/**
 * Support testing using an element
 * @param {Function} fn Passed the created element and returns a boolean result
 */
function assert( fn ) {
	var el = document.createElement( "fieldset" );

	try {
		return !!fn( el );
	} catch ( e ) {
		return false;
	} finally {

		// Remove from its parent by default
		if ( el.parentNode ) {
			el.parentNode.removeChild( el );
		}

		// release memory in IE
		el = null;
	}
}

/**
 * Adds the same handler for all of the specified attrs
 * @param {String} attrs Pipe-separated list of attributes
 * @param {Function} handler The method that will be applied
 */
function addHandle( attrs, handler ) {
	var arr = attrs.split( "|" ),
		i = arr.length;

	while ( i-- ) {
		Expr.attrHandle[ arr[ i ] ] = handler;
	}
}

/**
 * Checks document order of two siblings
 * @param {Element} a
 * @param {Element} b
 * @returns {Number} Returns less than 0 if a precedes b, greater than 0 if a follows b
 */
function siblingCheck( a, b ) {
	var cur = b && a,
		diff = cur && a.nodeType === 1 && b.nodeType === 1 &&
			a.sourceIndex - b.sourceIndex;

	// Use IE sourceIndex if available on both nodes
	if ( diff ) {
		return diff;
	}

	// Check if b follows a
	if ( cur ) {
		while ( ( cur = cur.nextSibling ) ) {
			if ( cur === b ) {
				return -1;
			}
		}
	}

	return a ? 1 : -1;
}

/**
 * Returns a function to use in pseudos for input types
 * @param {String} type
 */
function createInputPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return name === "input" && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for buttons
 * @param {String} type
 */
function createButtonPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return ( name === "input" || name === "button" ) && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for :enabled/:disabled
 * @param {Boolean} disabled true for :disabled; false for :enabled
 */
function createDisabledPseudo( disabled ) {

	// Known :disabled false positives: fieldset[disabled] > legend:nth-of-type(n+2) :can-disable
	return function( elem ) {

		// Only certain elements can match :enabled or :disabled
		// https://html.spec.whatwg.org/multipage/scripting.html#selector-enabled
		// https://html.spec.whatwg.org/multipage/scripting.html#selector-disabled
		if ( "form" in elem ) {

			// Check for inherited disabledness on relevant non-disabled elements:
			// * listed form-associated elements in a disabled fieldset
			//   https://html.spec.whatwg.org/multipage/forms.html#category-listed
			//   https://html.spec.whatwg.org/multipage/forms.html#concept-fe-disabled
			// * option elements in a disabled optgroup
			//   https://html.spec.whatwg.org/multipage/forms.html#concept-option-disabled
			// All such elements have a "form" property.
			if ( elem.parentNode && elem.disabled === false ) {

				// Option elements defer to a parent optgroup if present
				if ( "label" in elem ) {
					if ( "label" in elem.parentNode ) {
						return elem.parentNode.disabled === disabled;
					} else {
						return elem.disabled === disabled;
					}
				}

				// Support: IE 6 - 11
				// Use the isDisabled shortcut property to check for disabled fieldset ancestors
				return elem.isDisabled === disabled ||

					// Where there is no isDisabled, check manually
					/* jshint -W018 */
					elem.isDisabled !== !disabled &&
					inDisabledFieldset( elem ) === disabled;
			}

			return elem.disabled === disabled;

		// Try to winnow out elements that can't be disabled before trusting the disabled property.
		// Some victims get caught in our net (label, legend, menu, track), but it shouldn't
		// even exist on them, let alone have a boolean value.
		} else if ( "label" in elem ) {
			return elem.disabled === disabled;
		}

		// Remaining elements are neither :enabled nor :disabled
		return false;
	};
}

/**
 * Returns a function to use in pseudos for positionals
 * @param {Function} fn
 */
function createPositionalPseudo( fn ) {
	return markFunction( function( argument ) {
		argument = +argument;
		return markFunction( function( seed, matches ) {
			var j,
				matchIndexes = fn( [], seed.length, argument ),
				i = matchIndexes.length;

			// Match elements found at the specified indexes
			while ( i-- ) {
				if ( seed[ ( j = matchIndexes[ i ] ) ] ) {
					seed[ j ] = !( matches[ j ] = seed[ j ] );
				}
			}
		} );
	} );
}

/**
 * Checks a node for validity as a Sizzle context
 * @param {Element|Object=} context
 * @returns {Element|Object|Boolean} The input node if acceptable, otherwise a falsy value
 */
function testContext( context ) {
	return context && typeof context.getElementsByTagName !== "undefined" && context;
}

// Expose support vars for convenience
support = Sizzle.support = {};

/**
 * Detects XML nodes
 * @param {Element|Object} elem An element or a document
 * @returns {Boolean} True iff elem is a non-HTML XML node
 */
isXML = Sizzle.isXML = function( elem ) {
	var namespace = elem && elem.namespaceURI,
		docElem = elem && ( elem.ownerDocument || elem ).documentElement;

	// Support: IE <=8
	// Assume HTML when documentElement doesn't yet exist, such as inside loading iframes
	// https://bugs.jquery.com/ticket/4833
	return !rhtml.test( namespace || docElem && docElem.nodeName || "HTML" );
};

/**
 * Sets document-related variables once based on the current document
 * @param {Element|Object} [doc] An element or document object to use to set the document
 * @returns {Object} Returns the current document
 */
setDocument = Sizzle.setDocument = function( node ) {
	var hasCompare, subWindow,
		doc = node ? node.ownerDocument || node : preferredDoc;

	// Return early if doc is invalid or already selected
	// Support: IE 11+, Edge 17 - 18+
	// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
	// two documents; shallow comparisons work.
	// eslint-disable-next-line eqeqeq
	if ( doc == document || doc.nodeType !== 9 || !doc.documentElement ) {
		return document;
	}

	// Update global variables
	document = doc;
	docElem = document.documentElement;
	documentIsHTML = !isXML( document );

	// Support: IE 9 - 11+, Edge 12 - 18+
	// Accessing iframe documents after unload throws "permission denied" errors (jQuery #13936)
	// Support: IE 11+, Edge 17 - 18+
	// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
	// two documents; shallow comparisons work.
	// eslint-disable-next-line eqeqeq
	if ( preferredDoc != document &&
		( subWindow = document.defaultView ) && subWindow.top !== subWindow ) {

		// Support: IE 11, Edge
		if ( subWindow.addEventListener ) {
			subWindow.addEventListener( "unload", unloadHandler, false );

		// Support: IE 9 - 10 only
		} else if ( subWindow.attachEvent ) {
			subWindow.attachEvent( "onunload", unloadHandler );
		}
	}

	// Support: IE 8 - 11+, Edge 12 - 18+, Chrome <=16 - 25 only, Firefox <=3.6 - 31 only,
	// Safari 4 - 5 only, Opera <=11.6 - 12.x only
	// IE/Edge & older browsers don't support the :scope pseudo-class.
	// Support: Safari 6.0 only
	// Safari 6.0 supports :scope but it's an alias of :root there.
	support.scope = assert( function( el ) {
		docElem.appendChild( el ).appendChild( document.createElement( "div" ) );
		return typeof el.querySelectorAll !== "undefined" &&
			!el.querySelectorAll( ":scope fieldset div" ).length;
	} );

	/* Attributes
	---------------------------------------------------------------------- */

	// Support: IE<8
	// Verify that getAttribute really returns attributes and not properties
	// (excepting IE8 booleans)
	support.attributes = assert( function( el ) {
		el.className = "i";
		return !el.getAttribute( "className" );
	} );

	/* getElement(s)By*
	---------------------------------------------------------------------- */

	// Check if getElementsByTagName("*") returns only elements
	support.getElementsByTagName = assert( function( el ) {
		el.appendChild( document.createComment( "" ) );
		return !el.getElementsByTagName( "*" ).length;
	} );

	// Support: IE<9
	support.getElementsByClassName = rnative.test( document.getElementsByClassName );

	// Support: IE<10
	// Check if getElementById returns elements by name
	// The broken getElementById methods don't pick up programmatically-set names,
	// so use a roundabout getElementsByName test
	support.getById = assert( function( el ) {
		docElem.appendChild( el ).id = expando;
		return !document.getElementsByName || !document.getElementsByName( expando ).length;
	} );

	// ID filter and find
	if ( support.getById ) {
		Expr.filter[ "ID" ] = function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				return elem.getAttribute( "id" ) === attrId;
			};
		};
		Expr.find[ "ID" ] = function( id, context ) {
			if ( typeof context.getElementById !== "undefined" && documentIsHTML ) {
				var elem = context.getElementById( id );
				return elem ? [ elem ] : [];
			}
		};
	} else {
		Expr.filter[ "ID" ] =  function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				var node = typeof elem.getAttributeNode !== "undefined" &&
					elem.getAttributeNode( "id" );
				return node && node.value === attrId;
			};
		};

		// Support: IE 6 - 7 only
		// getElementById is not reliable as a find shortcut
		Expr.find[ "ID" ] = function( id, context ) {
			if ( typeof context.getElementById !== "undefined" && documentIsHTML ) {
				var node, i, elems,
					elem = context.getElementById( id );

				if ( elem ) {

					// Verify the id attribute
					node = elem.getAttributeNode( "id" );
					if ( node && node.value === id ) {
						return [ elem ];
					}

					// Fall back on getElementsByName
					elems = context.getElementsByName( id );
					i = 0;
					while ( ( elem = elems[ i++ ] ) ) {
						node = elem.getAttributeNode( "id" );
						if ( node && node.value === id ) {
							return [ elem ];
						}
					}
				}

				return [];
			}
		};
	}

	// Tag
	Expr.find[ "TAG" ] = support.getElementsByTagName ?
		function( tag, context ) {
			if ( typeof context.getElementsByTagName !== "undefined" ) {
				return context.getElementsByTagName( tag );

			// DocumentFragment nodes don't have gEBTN
			} else if ( support.qsa ) {
				return context.querySelectorAll( tag );
			}
		} :

		function( tag, context ) {
			var elem,
				tmp = [],
				i = 0,

				// By happy coincidence, a (broken) gEBTN appears on DocumentFragment nodes too
				results = context.getElementsByTagName( tag );

			// Filter out possible comments
			if ( tag === "*" ) {
				while ( ( elem = results[ i++ ] ) ) {
					if ( elem.nodeType === 1 ) {
						tmp.push( elem );
					}
				}

				return tmp;
			}
			return results;
		};

	// Class
	Expr.find[ "CLASS" ] = support.getElementsByClassName && function( className, context ) {
		if ( typeof context.getElementsByClassName !== "undefined" && documentIsHTML ) {
			return context.getElementsByClassName( className );
		}
	};

	/* QSA/matchesSelector
	---------------------------------------------------------------------- */

	// QSA and matchesSelector support

	// matchesSelector(:active) reports false when true (IE9/Opera 11.5)
	rbuggyMatches = [];

	// qSa(:focus) reports false when true (Chrome 21)
	// We allow this because of a bug in IE8/9 that throws an error
	// whenever `document.activeElement` is accessed on an iframe
	// So, we allow :focus to pass through QSA all the time to avoid the IE error
	// See https://bugs.jquery.com/ticket/13378
	rbuggyQSA = [];

	if ( ( support.qsa = rnative.test( document.querySelectorAll ) ) ) {

		// Build QSA regex
		// Regex strategy adopted from Diego Perini
		assert( function( el ) {

			var input;

			// Select is set to empty string on purpose
			// This is to test IE's treatment of not explicitly
			// setting a boolean content attribute,
			// since its presence should be enough
			// https://bugs.jquery.com/ticket/12359
			docElem.appendChild( el ).innerHTML = "<a id='" + expando + "'></a>" +
				"<select id='" + expando + "-\r\\' msallowcapture=''>" +
				"<option selected=''></option></select>";

			// Support: IE8, Opera 11-12.16
			// Nothing should be selected when empty strings follow ^= or $= or *=
			// The test attribute must be unknown in Opera but "safe" for WinRT
			// https://msdn.microsoft.com/en-us/library/ie/hh465388.aspx#attribute_section
			if ( el.querySelectorAll( "[msallowcapture^='']" ).length ) {
				rbuggyQSA.push( "[*^$]=" + whitespace + "*(?:''|\"\")" );
			}

			// Support: IE8
			// Boolean attributes and "value" are not treated correctly
			if ( !el.querySelectorAll( "[selected]" ).length ) {
				rbuggyQSA.push( "\\[" + whitespace + "*(?:value|" + booleans + ")" );
			}

			// Support: Chrome<29, Android<4.4, Safari<7.0+, iOS<7.0+, PhantomJS<1.9.8+
			if ( !el.querySelectorAll( "[id~=" + expando + "-]" ).length ) {
				rbuggyQSA.push( "~=" );
			}

			// Support: IE 11+, Edge 15 - 18+
			// IE 11/Edge don't find elements on a `[name='']` query in some cases.
			// Adding a temporary attribute to the document before the selection works
			// around the issue.
			// Interestingly, IE 10 & older don't seem to have the issue.
			input = document.createElement( "input" );
			input.setAttribute( "name", "" );
			el.appendChild( input );
			if ( !el.querySelectorAll( "[name='']" ).length ) {
				rbuggyQSA.push( "\\[" + whitespace + "*name" + whitespace + "*=" +
					whitespace + "*(?:''|\"\")" );
			}

			// Webkit/Opera - :checked should return selected option elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			// IE8 throws error here and will not see later tests
			if ( !el.querySelectorAll( ":checked" ).length ) {
				rbuggyQSA.push( ":checked" );
			}

			// Support: Safari 8+, iOS 8+
			// https://bugs.webkit.org/show_bug.cgi?id=136851
			// In-page `selector#id sibling-combinator selector` fails
			if ( !el.querySelectorAll( "a#" + expando + "+*" ).length ) {
				rbuggyQSA.push( ".#.+[+~]" );
			}

			// Support: Firefox <=3.6 - 5 only
			// Old Firefox doesn't throw on a badly-escaped identifier.
			el.querySelectorAll( "\\\f" );
			rbuggyQSA.push( "[\\r\\n\\f]" );
		} );

		assert( function( el ) {
			el.innerHTML = "<a href='' disabled='disabled'></a>" +
				"<select disabled='disabled'><option/></select>";

			// Support: Windows 8 Native Apps
			// The type and name attributes are restricted during .innerHTML assignment
			var input = document.createElement( "input" );
			input.setAttribute( "type", "hidden" );
			el.appendChild( input ).setAttribute( "name", "D" );

			// Support: IE8
			// Enforce case-sensitivity of name attribute
			if ( el.querySelectorAll( "[name=d]" ).length ) {
				rbuggyQSA.push( "name" + whitespace + "*[*^$|!~]?=" );
			}

			// FF 3.5 - :enabled/:disabled and hidden elements (hidden elements are still enabled)
			// IE8 throws error here and will not see later tests
			if ( el.querySelectorAll( ":enabled" ).length !== 2 ) {
				rbuggyQSA.push( ":enabled", ":disabled" );
			}

			// Support: IE9-11+
			// IE's :disabled selector does not pick up the children of disabled fieldsets
			docElem.appendChild( el ).disabled = true;
			if ( el.querySelectorAll( ":disabled" ).length !== 2 ) {
				rbuggyQSA.push( ":enabled", ":disabled" );
			}

			// Support: Opera 10 - 11 only
			// Opera 10-11 does not throw on post-comma invalid pseudos
			el.querySelectorAll( "*,:x" );
			rbuggyQSA.push( ",.*:" );
		} );
	}

	if ( ( support.matchesSelector = rnative.test( ( matches = docElem.matches ||
		docElem.webkitMatchesSelector ||
		docElem.mozMatchesSelector ||
		docElem.oMatchesSelector ||
		docElem.msMatchesSelector ) ) ) ) {

		assert( function( el ) {

			// Check to see if it's possible to do matchesSelector
			// on a disconnected node (IE 9)
			support.disconnectedMatch = matches.call( el, "*" );

			// This should fail with an exception
			// Gecko does not error, returns false instead
			matches.call( el, "[s!='']:x" );
			rbuggyMatches.push( "!=", pseudos );
		} );
	}

	rbuggyQSA = rbuggyQSA.length && new RegExp( rbuggyQSA.join( "|" ) );
	rbuggyMatches = rbuggyMatches.length && new RegExp( rbuggyMatches.join( "|" ) );

	/* Contains
	---------------------------------------------------------------------- */
	hasCompare = rnative.test( docElem.compareDocumentPosition );

	// Element contains another
	// Purposefully self-exclusive
	// As in, an element does not contain itself
	contains = hasCompare || rnative.test( docElem.contains ) ?
		function( a, b ) {
			var adown = a.nodeType === 9 ? a.documentElement : a,
				bup = b && b.parentNode;
			return a === bup || !!( bup && bup.nodeType === 1 && (
				adown.contains ?
					adown.contains( bup ) :
					a.compareDocumentPosition && a.compareDocumentPosition( bup ) & 16
			) );
		} :
		function( a, b ) {
			if ( b ) {
				while ( ( b = b.parentNode ) ) {
					if ( b === a ) {
						return true;
					}
				}
			}
			return false;
		};

	/* Sorting
	---------------------------------------------------------------------- */

	// Document order sorting
	sortOrder = hasCompare ?
	function( a, b ) {

		// Flag for duplicate removal
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		// Sort on method existence if only one input has compareDocumentPosition
		var compare = !a.compareDocumentPosition - !b.compareDocumentPosition;
		if ( compare ) {
			return compare;
		}

		// Calculate position if both inputs belong to the same document
		// Support: IE 11+, Edge 17 - 18+
		// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
		// two documents; shallow comparisons work.
		// eslint-disable-next-line eqeqeq
		compare = ( a.ownerDocument || a ) == ( b.ownerDocument || b ) ?
			a.compareDocumentPosition( b ) :

			// Otherwise we know they are disconnected
			1;

		// Disconnected nodes
		if ( compare & 1 ||
			( !support.sortDetached && b.compareDocumentPosition( a ) === compare ) ) {

			// Choose the first element that is related to our preferred document
			// Support: IE 11+, Edge 17 - 18+
			// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
			// two documents; shallow comparisons work.
			// eslint-disable-next-line eqeqeq
			if ( a == document || a.ownerDocument == preferredDoc &&
				contains( preferredDoc, a ) ) {
				return -1;
			}

			// Support: IE 11+, Edge 17 - 18+
			// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
			// two documents; shallow comparisons work.
			// eslint-disable-next-line eqeqeq
			if ( b == document || b.ownerDocument == preferredDoc &&
				contains( preferredDoc, b ) ) {
				return 1;
			}

			// Maintain original order
			return sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;
		}

		return compare & 4 ? -1 : 1;
	} :
	function( a, b ) {

		// Exit early if the nodes are identical
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		var cur,
			i = 0,
			aup = a.parentNode,
			bup = b.parentNode,
			ap = [ a ],
			bp = [ b ];

		// Parentless nodes are either documents or disconnected
		if ( !aup || !bup ) {

			// Support: IE 11+, Edge 17 - 18+
			// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
			// two documents; shallow comparisons work.
			/* eslint-disable eqeqeq */
			return a == document ? -1 :
				b == document ? 1 :
				/* eslint-enable eqeqeq */
				aup ? -1 :
				bup ? 1 :
				sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;

		// If the nodes are siblings, we can do a quick check
		} else if ( aup === bup ) {
			return siblingCheck( a, b );
		}

		// Otherwise we need full lists of their ancestors for comparison
		cur = a;
		while ( ( cur = cur.parentNode ) ) {
			ap.unshift( cur );
		}
		cur = b;
		while ( ( cur = cur.parentNode ) ) {
			bp.unshift( cur );
		}

		// Walk down the tree looking for a discrepancy
		while ( ap[ i ] === bp[ i ] ) {
			i++;
		}

		return i ?

			// Do a sibling check if the nodes have a common ancestor
			siblingCheck( ap[ i ], bp[ i ] ) :

			// Otherwise nodes in our document sort first
			// Support: IE 11+, Edge 17 - 18+
			// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
			// two documents; shallow comparisons work.
			/* eslint-disable eqeqeq */
			ap[ i ] == preferredDoc ? -1 :
			bp[ i ] == preferredDoc ? 1 :
			/* eslint-enable eqeqeq */
			0;
	};

	return document;
};

Sizzle.matches = function( expr, elements ) {
	return Sizzle( expr, null, null, elements );
};

Sizzle.matchesSelector = function( elem, expr ) {
	setDocument( elem );

	if ( support.matchesSelector && documentIsHTML &&
		!nonnativeSelectorCache[ expr + " " ] &&
		( !rbuggyMatches || !rbuggyMatches.test( expr ) ) &&
		( !rbuggyQSA     || !rbuggyQSA.test( expr ) ) ) {

		try {
			var ret = matches.call( elem, expr );

			// IE 9's matchesSelector returns false on disconnected nodes
			if ( ret || support.disconnectedMatch ||

				// As well, disconnected nodes are said to be in a document
				// fragment in IE 9
				elem.document && elem.document.nodeType !== 11 ) {
				return ret;
			}
		} catch ( e ) {
			nonnativeSelectorCache( expr, true );
		}
	}

	return Sizzle( expr, document, null, [ elem ] ).length > 0;
};

Sizzle.contains = function( context, elem ) {

	// Set document vars if needed
	// Support: IE 11+, Edge 17 - 18+
	// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
	// two documents; shallow comparisons work.
	// eslint-disable-next-line eqeqeq
	if ( ( context.ownerDocument || context ) != document ) {
		setDocument( context );
	}
	return contains( context, elem );
};

Sizzle.attr = function( elem, name ) {

	// Set document vars if needed
	// Support: IE 11+, Edge 17 - 18+
	// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
	// two documents; shallow comparisons work.
	// eslint-disable-next-line eqeqeq
	if ( ( elem.ownerDocument || elem ) != document ) {
		setDocument( elem );
	}

	var fn = Expr.attrHandle[ name.toLowerCase() ],

		// Don't get fooled by Object.prototype properties (jQuery #13807)
		val = fn && hasOwn.call( Expr.attrHandle, name.toLowerCase() ) ?
			fn( elem, name, !documentIsHTML ) :
			undefined;

	return val !== undefined ?
		val :
		support.attributes || !documentIsHTML ?
			elem.getAttribute( name ) :
			( val = elem.getAttributeNode( name ) ) && val.specified ?
				val.value :
				null;
};

Sizzle.escape = function( sel ) {
	return ( sel + "" ).replace( rcssescape, fcssescape );
};

Sizzle.error = function( msg ) {
	throw new Error( "Syntax error, unrecognized expression: " + msg );
};

/**
 * Document sorting and removing duplicates
 * @param {ArrayLike} results
 */
Sizzle.uniqueSort = function( results ) {
	var elem,
		duplicates = [],
		j = 0,
		i = 0;

	// Unless we *know* we can detect duplicates, assume their presence
	hasDuplicate = !support.detectDuplicates;
	sortInput = !support.sortStable && results.slice( 0 );
	results.sort( sortOrder );

	if ( hasDuplicate ) {
		while ( ( elem = results[ i++ ] ) ) {
			if ( elem === results[ i ] ) {
				j = duplicates.push( i );
			}
		}
		while ( j-- ) {
			results.splice( duplicates[ j ], 1 );
		}
	}

	// Clear input after sorting to release objects
	// See https://github.com/jquery/sizzle/pull/225
	sortInput = null;

	return results;
};

/**
 * Utility function for retrieving the text value of an array of DOM nodes
 * @param {Array|Element} elem
 */
getText = Sizzle.getText = function( elem ) {
	var node,
		ret = "",
		i = 0,
		nodeType = elem.nodeType;

	if ( !nodeType ) {

		// If no nodeType, this is expected to be an array
		while ( ( node = elem[ i++ ] ) ) {

			// Do not traverse comment nodes
			ret += getText( node );
		}
	} else if ( nodeType === 1 || nodeType === 9 || nodeType === 11 ) {

		// Use textContent for elements
		// innerText usage removed for consistency of new lines (jQuery #11153)
		if ( typeof elem.textContent === "string" ) {
			return elem.textContent;
		} else {

			// Traverse its children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				ret += getText( elem );
			}
		}
	} else if ( nodeType === 3 || nodeType === 4 ) {
		return elem.nodeValue;
	}

	// Do not include comment or processing instruction nodes

	return ret;
};

Expr = Sizzle.selectors = {

	// Can be adjusted by the user
	cacheLength: 50,

	createPseudo: markFunction,

	match: matchExpr,

	attrHandle: {},

	find: {},

	relative: {
		">": { dir: "parentNode", first: true },
		" ": { dir: "parentNode" },
		"+": { dir: "previousSibling", first: true },
		"~": { dir: "previousSibling" }
	},

	preFilter: {
		"ATTR": function( match ) {
			match[ 1 ] = match[ 1 ].replace( runescape, funescape );

			// Move the given value to match[3] whether quoted or unquoted
			match[ 3 ] = ( match[ 3 ] || match[ 4 ] ||
				match[ 5 ] || "" ).replace( runescape, funescape );

			if ( match[ 2 ] === "~=" ) {
				match[ 3 ] = " " + match[ 3 ] + " ";
			}

			return match.slice( 0, 4 );
		},

		"CHILD": function( match ) {

			/* matches from matchExpr["CHILD"]
				1 type (only|nth|...)
				2 what (child|of-type)
				3 argument (even|odd|\d*|\d*n([+-]\d+)?|...)
				4 xn-component of xn+y argument ([+-]?\d*n|)
				5 sign of xn-component
				6 x of xn-component
				7 sign of y-component
				8 y of y-component
			*/
			match[ 1 ] = match[ 1 ].toLowerCase();

			if ( match[ 1 ].slice( 0, 3 ) === "nth" ) {

				// nth-* requires argument
				if ( !match[ 3 ] ) {
					Sizzle.error( match[ 0 ] );
				}

				// numeric x and y parameters for Expr.filter.CHILD
				// remember that false/true cast respectively to 0/1
				match[ 4 ] = +( match[ 4 ] ?
					match[ 5 ] + ( match[ 6 ] || 1 ) :
					2 * ( match[ 3 ] === "even" || match[ 3 ] === "odd" ) );
				match[ 5 ] = +( ( match[ 7 ] + match[ 8 ] ) || match[ 3 ] === "odd" );

				// other types prohibit arguments
			} else if ( match[ 3 ] ) {
				Sizzle.error( match[ 0 ] );
			}

			return match;
		},

		"PSEUDO": function( match ) {
			var excess,
				unquoted = !match[ 6 ] && match[ 2 ];

			if ( matchExpr[ "CHILD" ].test( match[ 0 ] ) ) {
				return null;
			}

			// Accept quoted arguments as-is
			if ( match[ 3 ] ) {
				match[ 2 ] = match[ 4 ] || match[ 5 ] || "";

			// Strip excess characters from unquoted arguments
			} else if ( unquoted && rpseudo.test( unquoted ) &&

				// Get excess from tokenize (recursively)
				( excess = tokenize( unquoted, true ) ) &&

				// advance to the next closing parenthesis
				( excess = unquoted.indexOf( ")", unquoted.length - excess ) - unquoted.length ) ) {

				// excess is a negative index
				match[ 0 ] = match[ 0 ].slice( 0, excess );
				match[ 2 ] = unquoted.slice( 0, excess );
			}

			// Return only captures needed by the pseudo filter method (type and argument)
			return match.slice( 0, 3 );
		}
	},

	filter: {

		"TAG": function( nodeNameSelector ) {
			var nodeName = nodeNameSelector.replace( runescape, funescape ).toLowerCase();
			return nodeNameSelector === "*" ?
				function() {
					return true;
				} :
				function( elem ) {
					return elem.nodeName && elem.nodeName.toLowerCase() === nodeName;
				};
		},

		"CLASS": function( className ) {
			var pattern = classCache[ className + " " ];

			return pattern ||
				( pattern = new RegExp( "(^|" + whitespace +
					")" + className + "(" + whitespace + "|$)" ) ) && classCache(
						className, function( elem ) {
							return pattern.test(
								typeof elem.className === "string" && elem.className ||
								typeof elem.getAttribute !== "undefined" &&
									elem.getAttribute( "class" ) ||
								""
							);
				} );
		},

		"ATTR": function( name, operator, check ) {
			return function( elem ) {
				var result = Sizzle.attr( elem, name );

				if ( result == null ) {
					return operator === "!=";
				}
				if ( !operator ) {
					return true;
				}

				result += "";

				/* eslint-disable max-len */

				return operator === "=" ? result === check :
					operator === "!=" ? result !== check :
					operator === "^=" ? check && result.indexOf( check ) === 0 :
					operator === "*=" ? check && result.indexOf( check ) > -1 :
					operator === "$=" ? check && result.slice( -check.length ) === check :
					operator === "~=" ? ( " " + result.replace( rwhitespace, " " ) + " " ).indexOf( check ) > -1 :
					operator === "|=" ? result === check || result.slice( 0, check.length + 1 ) === check + "-" :
					false;
				/* eslint-enable max-len */

			};
		},

		"CHILD": function( type, what, _argument, first, last ) {
			var simple = type.slice( 0, 3 ) !== "nth",
				forward = type.slice( -4 ) !== "last",
				ofType = what === "of-type";

			return first === 1 && last === 0 ?

				// Shortcut for :nth-*(n)
				function( elem ) {
					return !!elem.parentNode;
				} :

				function( elem, _context, xml ) {
					var cache, uniqueCache, outerCache, node, nodeIndex, start,
						dir = simple !== forward ? "nextSibling" : "previousSibling",
						parent = elem.parentNode,
						name = ofType && elem.nodeName.toLowerCase(),
						useCache = !xml && !ofType,
						diff = false;

					if ( parent ) {

						// :(first|last|only)-(child|of-type)
						if ( simple ) {
							while ( dir ) {
								node = elem;
								while ( ( node = node[ dir ] ) ) {
									if ( ofType ?
										node.nodeName.toLowerCase() === name :
										node.nodeType === 1 ) {

										return false;
									}
								}

								// Reverse direction for :only-* (if we haven't yet done so)
								start = dir = type === "only" && !start && "nextSibling";
							}
							return true;
						}

						start = [ forward ? parent.firstChild : parent.lastChild ];

						// non-xml :nth-child(...) stores cache data on `parent`
						if ( forward && useCache ) {

							// Seek `elem` from a previously-cached index

							// ...in a gzip-friendly way
							node = parent;
							outerCache = node[ expando ] || ( node[ expando ] = {} );

							// Support: IE <9 only
							// Defend against cloned attroperties (jQuery gh-1709)
							uniqueCache = outerCache[ node.uniqueID ] ||
								( outerCache[ node.uniqueID ] = {} );

							cache = uniqueCache[ type ] || [];
							nodeIndex = cache[ 0 ] === dirruns && cache[ 1 ];
							diff = nodeIndex && cache[ 2 ];
							node = nodeIndex && parent.childNodes[ nodeIndex ];

							while ( ( node = ++nodeIndex && node && node[ dir ] ||

								// Fallback to seeking `elem` from the start
								( diff = nodeIndex = 0 ) || start.pop() ) ) {

								// When found, cache indexes on `parent` and break
								if ( node.nodeType === 1 && ++diff && node === elem ) {
									uniqueCache[ type ] = [ dirruns, nodeIndex, diff ];
									break;
								}
							}

						} else {

							// Use previously-cached element index if available
							if ( useCache ) {

								// ...in a gzip-friendly way
								node = elem;
								outerCache = node[ expando ] || ( node[ expando ] = {} );

								// Support: IE <9 only
								// Defend against cloned attroperties (jQuery gh-1709)
								uniqueCache = outerCache[ node.uniqueID ] ||
									( outerCache[ node.uniqueID ] = {} );

								cache = uniqueCache[ type ] || [];
								nodeIndex = cache[ 0 ] === dirruns && cache[ 1 ];
								diff = nodeIndex;
							}

							// xml :nth-child(...)
							// or :nth-last-child(...) or :nth(-last)?-of-type(...)
							if ( diff === false ) {

								// Use the same loop as above to seek `elem` from the start
								while ( ( node = ++nodeIndex && node && node[ dir ] ||
									( diff = nodeIndex = 0 ) || start.pop() ) ) {

									if ( ( ofType ?
										node.nodeName.toLowerCase() === name :
										node.nodeType === 1 ) &&
										++diff ) {

										// Cache the index of each encountered element
										if ( useCache ) {
											outerCache = node[ expando ] ||
												( node[ expando ] = {} );

											// Support: IE <9 only
											// Defend against cloned attroperties (jQuery gh-1709)
											uniqueCache = outerCache[ node.uniqueID ] ||
												( outerCache[ node.uniqueID ] = {} );

											uniqueCache[ type ] = [ dirruns, diff ];
										}

										if ( node === elem ) {
											break;
										}
									}
								}
							}
						}

						// Incorporate the offset, then check against cycle size
						diff -= last;
						return diff === first || ( diff % first === 0 && diff / first >= 0 );
					}
				};
		},

		"PSEUDO": function( pseudo, argument ) {

			// pseudo-class names are case-insensitive
			// http://www.w3.org/TR/selectors/#pseudo-classes
			// Prioritize by case sensitivity in case custom pseudos are added with uppercase letters
			// Remember that setFilters inherits from pseudos
			var args,
				fn = Expr.pseudos[ pseudo ] || Expr.setFilters[ pseudo.toLowerCase() ] ||
					Sizzle.error( "unsupported pseudo: " + pseudo );

			// The user may use createPseudo to indicate that
			// arguments are needed to create the filter function
			// just as Sizzle does
			if ( fn[ expando ] ) {
				return fn( argument );
			}

			// But maintain support for old signatures
			if ( fn.length > 1 ) {
				args = [ pseudo, pseudo, "", argument ];
				return Expr.setFilters.hasOwnProperty( pseudo.toLowerCase() ) ?
					markFunction( function( seed, matches ) {
						var idx,
							matched = fn( seed, argument ),
							i = matched.length;
						while ( i-- ) {
							idx = indexOf( seed, matched[ i ] );
							seed[ idx ] = !( matches[ idx ] = matched[ i ] );
						}
					} ) :
					function( elem ) {
						return fn( elem, 0, args );
					};
			}

			return fn;
		}
	},

	pseudos: {

		// Potentially complex pseudos
		"not": markFunction( function( selector ) {

			// Trim the selector passed to compile
			// to avoid treating leading and trailing
			// spaces as combinators
			var input = [],
				results = [],
				matcher = compile( selector.replace( rtrim, "$1" ) );

			return matcher[ expando ] ?
				markFunction( function( seed, matches, _context, xml ) {
					var elem,
						unmatched = matcher( seed, null, xml, [] ),
						i = seed.length;

					// Match elements unmatched by `matcher`
					while ( i-- ) {
						if ( ( elem = unmatched[ i ] ) ) {
							seed[ i ] = !( matches[ i ] = elem );
						}
					}
				} ) :
				function( elem, _context, xml ) {
					input[ 0 ] = elem;
					matcher( input, null, xml, results );

					// Don't keep the element (issue #299)
					input[ 0 ] = null;
					return !results.pop();
				};
		} ),

		"has": markFunction( function( selector ) {
			return function( elem ) {
				return Sizzle( selector, elem ).length > 0;
			};
		} ),

		"contains": markFunction( function( text ) {
			text = text.replace( runescape, funescape );
			return function( elem ) {
				return ( elem.textContent || getText( elem ) ).indexOf( text ) > -1;
			};
		} ),

		// "Whether an element is represented by a :lang() selector
		// is based solely on the element's language value
		// being equal to the identifier C,
		// or beginning with the identifier C immediately followed by "-".
		// The matching of C against the element's language value is performed case-insensitively.
		// The identifier C does not have to be a valid language name."
		// http://www.w3.org/TR/selectors/#lang-pseudo
		"lang": markFunction( function( lang ) {

			// lang value must be a valid identifier
			if ( !ridentifier.test( lang || "" ) ) {
				Sizzle.error( "unsupported lang: " + lang );
			}
			lang = lang.replace( runescape, funescape ).toLowerCase();
			return function( elem ) {
				var elemLang;
				do {
					if ( ( elemLang = documentIsHTML ?
						elem.lang :
						elem.getAttribute( "xml:lang" ) || elem.getAttribute( "lang" ) ) ) {

						elemLang = elemLang.toLowerCase();
						return elemLang === lang || elemLang.indexOf( lang + "-" ) === 0;
					}
				} while ( ( elem = elem.parentNode ) && elem.nodeType === 1 );
				return false;
			};
		} ),

		// Miscellaneous
		"target": function( elem ) {
			var hash = window.location && window.location.hash;
			return hash && hash.slice( 1 ) === elem.id;
		},

		"root": function( elem ) {
			return elem === docElem;
		},

		"focus": function( elem ) {
			return elem === document.activeElement &&
				( !document.hasFocus || document.hasFocus() ) &&
				!!( elem.type || elem.href || ~elem.tabIndex );
		},

		// Boolean properties
		"enabled": createDisabledPseudo( false ),
		"disabled": createDisabledPseudo( true ),

		"checked": function( elem ) {

			// In CSS3, :checked should return both checked and selected elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			var nodeName = elem.nodeName.toLowerCase();
			return ( nodeName === "input" && !!elem.checked ) ||
				( nodeName === "option" && !!elem.selected );
		},

		"selected": function( elem ) {

			// Accessing this property makes selected-by-default
			// options in Safari work properly
			if ( elem.parentNode ) {
				// eslint-disable-next-line no-unused-expressions
				elem.parentNode.selectedIndex;
			}

			return elem.selected === true;
		},

		// Contents
		"empty": function( elem ) {

			// http://www.w3.org/TR/selectors/#empty-pseudo
			// :empty is negated by element (1) or content nodes (text: 3; cdata: 4; entity ref: 5),
			//   but not by others (comment: 8; processing instruction: 7; etc.)
			// nodeType < 6 works because attributes (2) do not appear as children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				if ( elem.nodeType < 6 ) {
					return false;
				}
			}
			return true;
		},

		"parent": function( elem ) {
			return !Expr.pseudos[ "empty" ]( elem );
		},

		// Element/input types
		"header": function( elem ) {
			return rheader.test( elem.nodeName );
		},

		"input": function( elem ) {
			return rinputs.test( elem.nodeName );
		},

		"button": function( elem ) {
			var name = elem.nodeName.toLowerCase();
			return name === "input" && elem.type === "button" || name === "button";
		},

		"text": function( elem ) {
			var attr;
			return elem.nodeName.toLowerCase() === "input" &&
				elem.type === "text" &&

				// Support: IE<8
				// New HTML5 attribute values (e.g., "search") appear with elem.type === "text"
				( ( attr = elem.getAttribute( "type" ) ) == null ||
					attr.toLowerCase() === "text" );
		},

		// Position-in-collection
		"first": createPositionalPseudo( function() {
			return [ 0 ];
		} ),

		"last": createPositionalPseudo( function( _matchIndexes, length ) {
			return [ length - 1 ];
		} ),

		"eq": createPositionalPseudo( function( _matchIndexes, length, argument ) {
			return [ argument < 0 ? argument + length : argument ];
		} ),

		"even": createPositionalPseudo( function( matchIndexes, length ) {
			var i = 0;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		} ),

		"odd": createPositionalPseudo( function( matchIndexes, length ) {
			var i = 1;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		} ),

		"lt": createPositionalPseudo( function( matchIndexes, length, argument ) {
			var i = argument < 0 ?
				argument + length :
				argument > length ?
					length :
					argument;
			for ( ; --i >= 0; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		} ),

		"gt": createPositionalPseudo( function( matchIndexes, length, argument ) {
			var i = argument < 0 ? argument + length : argument;
			for ( ; ++i < length; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		} )
	}
};

Expr.pseudos[ "nth" ] = Expr.pseudos[ "eq" ];

// Add button/input type pseudos
for ( i in { radio: true, checkbox: true, file: true, password: true, image: true } ) {
	Expr.pseudos[ i ] = createInputPseudo( i );
}
for ( i in { submit: true, reset: true } ) {
	Expr.pseudos[ i ] = createButtonPseudo( i );
}

// Easy API for creating new setFilters
function setFilters() {}
setFilters.prototype = Expr.filters = Expr.pseudos;
Expr.setFilters = new setFilters();

tokenize = Sizzle.tokenize = function( selector, parseOnly ) {
	var matched, match, tokens, type,
		soFar, groups, preFilters,
		cached = tokenCache[ selector + " " ];

	if ( cached ) {
		return parseOnly ? 0 : cached.slice( 0 );
	}

	soFar = selector;
	groups = [];
	preFilters = Expr.preFilter;

	while ( soFar ) {

		// Comma and first run
		if ( !matched || ( match = rcomma.exec( soFar ) ) ) {
			if ( match ) {

				// Don't consume trailing commas as valid
				soFar = soFar.slice( match[ 0 ].length ) || soFar;
			}
			groups.push( ( tokens = [] ) );
		}

		matched = false;

		// Combinators
		if ( ( match = rcombinators.exec( soFar ) ) ) {
			matched = match.shift();
			tokens.push( {
				value: matched,

				// Cast descendant combinators to space
				type: match[ 0 ].replace( rtrim, " " )
			} );
			soFar = soFar.slice( matched.length );
		}

		// Filters
		for ( type in Expr.filter ) {
			if ( ( match = matchExpr[ type ].exec( soFar ) ) && ( !preFilters[ type ] ||
				( match = preFilters[ type ]( match ) ) ) ) {
				matched = match.shift();
				tokens.push( {
					value: matched,
					type: type,
					matches: match
				} );
				soFar = soFar.slice( matched.length );
			}
		}

		if ( !matched ) {
			break;
		}
	}

	// Return the length of the invalid excess
	// if we're just parsing
	// Otherwise, throw an error or return tokens
	return parseOnly ?
		soFar.length :
		soFar ?
			Sizzle.error( selector ) :

			// Cache the tokens
			tokenCache( selector, groups ).slice( 0 );
};

function toSelector( tokens ) {
	var i = 0,
		len = tokens.length,
		selector = "";
	for ( ; i < len; i++ ) {
		selector += tokens[ i ].value;
	}
	return selector;
}

function addCombinator( matcher, combinator, base ) {
	var dir = combinator.dir,
		skip = combinator.next,
		key = skip || dir,
		checkNonElements = base && key === "parentNode",
		doneName = done++;

	return combinator.first ?

		// Check against closest ancestor/preceding element
		function( elem, context, xml ) {
			while ( ( elem = elem[ dir ] ) ) {
				if ( elem.nodeType === 1 || checkNonElements ) {
					return matcher( elem, context, xml );
				}
			}
			return false;
		} :

		// Check against all ancestor/preceding elements
		function( elem, context, xml ) {
			var oldCache, uniqueCache, outerCache,
				newCache = [ dirruns, doneName ];

			// We can't set arbitrary data on XML nodes, so they don't benefit from combinator caching
			if ( xml ) {
				while ( ( elem = elem[ dir ] ) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						if ( matcher( elem, context, xml ) ) {
							return true;
						}
					}
				}
			} else {
				while ( ( elem = elem[ dir ] ) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						outerCache = elem[ expando ] || ( elem[ expando ] = {} );

						// Support: IE <9 only
						// Defend against cloned attroperties (jQuery gh-1709)
						uniqueCache = outerCache[ elem.uniqueID ] ||
							( outerCache[ elem.uniqueID ] = {} );

						if ( skip && skip === elem.nodeName.toLowerCase() ) {
							elem = elem[ dir ] || elem;
						} else if ( ( oldCache = uniqueCache[ key ] ) &&
							oldCache[ 0 ] === dirruns && oldCache[ 1 ] === doneName ) {

							// Assign to newCache so results back-propagate to previous elements
							return ( newCache[ 2 ] = oldCache[ 2 ] );
						} else {

							// Reuse newcache so results back-propagate to previous elements
							uniqueCache[ key ] = newCache;

							// A match means we're done; a fail means we have to keep checking
							if ( ( newCache[ 2 ] = matcher( elem, context, xml ) ) ) {
								return true;
							}
						}
					}
				}
			}
			return false;
		};
}

function elementMatcher( matchers ) {
	return matchers.length > 1 ?
		function( elem, context, xml ) {
			var i = matchers.length;
			while ( i-- ) {
				if ( !matchers[ i ]( elem, context, xml ) ) {
					return false;
				}
			}
			return true;
		} :
		matchers[ 0 ];
}

function multipleContexts( selector, contexts, results ) {
	var i = 0,
		len = contexts.length;
	for ( ; i < len; i++ ) {
		Sizzle( selector, contexts[ i ], results );
	}
	return results;
}

function condense( unmatched, map, filter, context, xml ) {
	var elem,
		newUnmatched = [],
		i = 0,
		len = unmatched.length,
		mapped = map != null;

	for ( ; i < len; i++ ) {
		if ( ( elem = unmatched[ i ] ) ) {
			if ( !filter || filter( elem, context, xml ) ) {
				newUnmatched.push( elem );
				if ( mapped ) {
					map.push( i );
				}
			}
		}
	}

	return newUnmatched;
}

function setMatcher( preFilter, selector, matcher, postFilter, postFinder, postSelector ) {
	if ( postFilter && !postFilter[ expando ] ) {
		postFilter = setMatcher( postFilter );
	}
	if ( postFinder && !postFinder[ expando ] ) {
		postFinder = setMatcher( postFinder, postSelector );
	}
	return markFunction( function( seed, results, context, xml ) {
		var temp, i, elem,
			preMap = [],
			postMap = [],
			preexisting = results.length,

			// Get initial elements from seed or context
			elems = seed || multipleContexts(
				selector || "*",
				context.nodeType ? [ context ] : context,
				[]
			),

			// Prefilter to get matcher input, preserving a map for seed-results synchronization
			matcherIn = preFilter && ( seed || !selector ) ?
				condense( elems, preMap, preFilter, context, xml ) :
				elems,

			matcherOut = matcher ?

				// If we have a postFinder, or filtered seed, or non-seed postFilter or preexisting results,
				postFinder || ( seed ? preFilter : preexisting || postFilter ) ?

					// ...intermediate processing is necessary
					[] :

					// ...otherwise use results directly
					results :
				matcherIn;

		// Find primary matches
		if ( matcher ) {
			matcher( matcherIn, matcherOut, context, xml );
		}

		// Apply postFilter
		if ( postFilter ) {
			temp = condense( matcherOut, postMap );
			postFilter( temp, [], context, xml );

			// Un-match failing elements by moving them back to matcherIn
			i = temp.length;
			while ( i-- ) {
				if ( ( elem = temp[ i ] ) ) {
					matcherOut[ postMap[ i ] ] = !( matcherIn[ postMap[ i ] ] = elem );
				}
			}
		}

		if ( seed ) {
			if ( postFinder || preFilter ) {
				if ( postFinder ) {

					// Get the final matcherOut by condensing this intermediate into postFinder contexts
					temp = [];
					i = matcherOut.length;
					while ( i-- ) {
						if ( ( elem = matcherOut[ i ] ) ) {

							// Restore matcherIn since elem is not yet a final match
							temp.push( ( matcherIn[ i ] = elem ) );
						}
					}
					postFinder( null, ( matcherOut = [] ), temp, xml );
				}

				// Move matched elements from seed to results to keep them synchronized
				i = matcherOut.length;
				while ( i-- ) {
					if ( ( elem = matcherOut[ i ] ) &&
						( temp = postFinder ? indexOf( seed, elem ) : preMap[ i ] ) > -1 ) {

						seed[ temp ] = !( results[ temp ] = elem );
					}
				}
			}

		// Add elements to results, through postFinder if defined
		} else {
			matcherOut = condense(
				matcherOut === results ?
					matcherOut.splice( preexisting, matcherOut.length ) :
					matcherOut
			);
			if ( postFinder ) {
				postFinder( null, results, matcherOut, xml );
			} else {
				push.apply( results, matcherOut );
			}
		}
	} );
}

function matcherFromTokens( tokens ) {
	var checkContext, matcher, j,
		len = tokens.length,
		leadingRelative = Expr.relative[ tokens[ 0 ].type ],
		implicitRelative = leadingRelative || Expr.relative[ " " ],
		i = leadingRelative ? 1 : 0,

		// The foundational matcher ensures that elements are reachable from top-level context(s)
		matchContext = addCombinator( function( elem ) {
			return elem === checkContext;
		}, implicitRelative, true ),
		matchAnyContext = addCombinator( function( elem ) {
			return indexOf( checkContext, elem ) > -1;
		}, implicitRelative, true ),
		matchers = [ function( elem, context, xml ) {
			var ret = ( !leadingRelative && ( xml || context !== outermostContext ) ) || (
				( checkContext = context ).nodeType ?
					matchContext( elem, context, xml ) :
					matchAnyContext( elem, context, xml ) );

			// Avoid hanging onto element (issue #299)
			checkContext = null;
			return ret;
		} ];

	for ( ; i < len; i++ ) {
		if ( ( matcher = Expr.relative[ tokens[ i ].type ] ) ) {
			matchers = [ addCombinator( elementMatcher( matchers ), matcher ) ];
		} else {
			matcher = Expr.filter[ tokens[ i ].type ].apply( null, tokens[ i ].matches );

			// Return special upon seeing a positional matcher
			if ( matcher[ expando ] ) {

				// Find the next relative operator (if any) for proper handling
				j = ++i;
				for ( ; j < len; j++ ) {
					if ( Expr.relative[ tokens[ j ].type ] ) {
						break;
					}
				}
				return setMatcher(
					i > 1 && elementMatcher( matchers ),
					i > 1 && toSelector(

					// If the preceding token was a descendant combinator, insert an implicit any-element `*`
					tokens
						.slice( 0, i - 1 )
						.concat( { value: tokens[ i - 2 ].type === " " ? "*" : "" } )
					).replace( rtrim, "$1" ),
					matcher,
					i < j && matcherFromTokens( tokens.slice( i, j ) ),
					j < len && matcherFromTokens( ( tokens = tokens.slice( j ) ) ),
					j < len && toSelector( tokens )
				);
			}
			matchers.push( matcher );
		}
	}

	return elementMatcher( matchers );
}

function matcherFromGroupMatchers( elementMatchers, setMatchers ) {
	var bySet = setMatchers.length > 0,
		byElement = elementMatchers.length > 0,
		superMatcher = function( seed, context, xml, results, outermost ) {
			var elem, j, matcher,
				matchedCount = 0,
				i = "0",
				unmatched = seed && [],
				setMatched = [],
				contextBackup = outermostContext,

				// We must always have either seed elements or outermost context
				elems = seed || byElement && Expr.find[ "TAG" ]( "*", outermost ),

				// Use integer dirruns iff this is the outermost matcher
				dirrunsUnique = ( dirruns += contextBackup == null ? 1 : Math.random() || 0.1 ),
				len = elems.length;

			if ( outermost ) {

				// Support: IE 11+, Edge 17 - 18+
				// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
				// two documents; shallow comparisons work.
				// eslint-disable-next-line eqeqeq
				outermostContext = context == document || context || outermost;
			}

			// Add elements passing elementMatchers directly to results
			// Support: IE<9, Safari
			// Tolerate NodeList properties (IE: "length"; Safari: <number>) matching elements by id
			for ( ; i !== len && ( elem = elems[ i ] ) != null; i++ ) {
				if ( byElement && elem ) {
					j = 0;

					// Support: IE 11+, Edge 17 - 18+
					// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
					// two documents; shallow comparisons work.
					// eslint-disable-next-line eqeqeq
					if ( !context && elem.ownerDocument != document ) {
						setDocument( elem );
						xml = !documentIsHTML;
					}
					while ( ( matcher = elementMatchers[ j++ ] ) ) {
						if ( matcher( elem, context || document, xml ) ) {
							results.push( elem );
							break;
						}
					}
					if ( outermost ) {
						dirruns = dirrunsUnique;
					}
				}

				// Track unmatched elements for set filters
				if ( bySet ) {

					// They will have gone through all possible matchers
					if ( ( elem = !matcher && elem ) ) {
						matchedCount--;
					}

					// Lengthen the array for every element, matched or not
					if ( seed ) {
						unmatched.push( elem );
					}
				}
			}

			// `i` is now the count of elements visited above, and adding it to `matchedCount`
			// makes the latter nonnegative.
			matchedCount += i;

			// Apply set filters to unmatched elements
			// NOTE: This can be skipped if there are no unmatched elements (i.e., `matchedCount`
			// equals `i`), unless we didn't visit _any_ elements in the above loop because we have
			// no element matchers and no seed.
			// Incrementing an initially-string "0" `i` allows `i` to remain a string only in that
			// case, which will result in a "00" `matchedCount` that differs from `i` but is also
			// numerically zero.
			if ( bySet && i !== matchedCount ) {
				j = 0;
				while ( ( matcher = setMatchers[ j++ ] ) ) {
					matcher( unmatched, setMatched, context, xml );
				}

				if ( seed ) {

					// Reintegrate element matches to eliminate the need for sorting
					if ( matchedCount > 0 ) {
						while ( i-- ) {
							if ( !( unmatched[ i ] || setMatched[ i ] ) ) {
								setMatched[ i ] = pop.call( results );
							}
						}
					}

					// Discard index placeholder values to get only actual matches
					setMatched = condense( setMatched );
				}

				// Add matches to results
				push.apply( results, setMatched );

				// Seedless set matches succeeding multiple successful matchers stipulate sorting
				if ( outermost && !seed && setMatched.length > 0 &&
					( matchedCount + setMatchers.length ) > 1 ) {

					Sizzle.uniqueSort( results );
				}
			}

			// Override manipulation of globals by nested matchers
			if ( outermost ) {
				dirruns = dirrunsUnique;
				outermostContext = contextBackup;
			}

			return unmatched;
		};

	return bySet ?
		markFunction( superMatcher ) :
		superMatcher;
}

compile = Sizzle.compile = function( selector, match /* Internal Use Only */ ) {
	var i,
		setMatchers = [],
		elementMatchers = [],
		cached = compilerCache[ selector + " " ];

	if ( !cached ) {

		// Generate a function of recursive functions that can be used to check each element
		if ( !match ) {
			match = tokenize( selector );
		}
		i = match.length;
		while ( i-- ) {
			cached = matcherFromTokens( match[ i ] );
			if ( cached[ expando ] ) {
				setMatchers.push( cached );
			} else {
				elementMatchers.push( cached );
			}
		}

		// Cache the compiled function
		cached = compilerCache(
			selector,
			matcherFromGroupMatchers( elementMatchers, setMatchers )
		);

		// Save selector and tokenization
		cached.selector = selector;
	}
	return cached;
};

/**
 * A low-level selection function that works with Sizzle's compiled
 *  selector functions
 * @param {String|Function} selector A selector or a pre-compiled
 *  selector function built with Sizzle.compile
 * @param {Element} context
 * @param {Array} [results]
 * @param {Array} [seed] A set of elements to match against
 */
select = Sizzle.select = function( selector, context, results, seed ) {
	var i, tokens, token, type, find,
		compiled = typeof selector === "function" && selector,
		match = !seed && tokenize( ( selector = compiled.selector || selector ) );

	results = results || [];

	// Try to minimize operations if there is only one selector in the list and no seed
	// (the latter of which guarantees us context)
	if ( match.length === 1 ) {

		// Reduce context if the leading compound selector is an ID
		tokens = match[ 0 ] = match[ 0 ].slice( 0 );
		if ( tokens.length > 2 && ( token = tokens[ 0 ] ).type === "ID" &&
			context.nodeType === 9 && documentIsHTML && Expr.relative[ tokens[ 1 ].type ] ) {

			context = ( Expr.find[ "ID" ]( token.matches[ 0 ]
				.replace( runescape, funescape ), context ) || [] )[ 0 ];
			if ( !context ) {
				return results;

			// Precompiled matchers will still verify ancestry, so step up a level
			} else if ( compiled ) {
				context = context.parentNode;
			}

			selector = selector.slice( tokens.shift().value.length );
		}

		// Fetch a seed set for right-to-left matching
		i = matchExpr[ "needsContext" ].test( selector ) ? 0 : tokens.length;
		while ( i-- ) {
			token = tokens[ i ];

			// Abort if we hit a combinator
			if ( Expr.relative[ ( type = token.type ) ] ) {
				break;
			}
			if ( ( find = Expr.find[ type ] ) ) {

				// Search, expanding context for leading sibling combinators
				if ( ( seed = find(
					token.matches[ 0 ].replace( runescape, funescape ),
					rsibling.test( tokens[ 0 ].type ) && testContext( context.parentNode ) ||
						context
				) ) ) {

					// If seed is empty or no tokens remain, we can return early
					tokens.splice( i, 1 );
					selector = seed.length && toSelector( tokens );
					if ( !selector ) {
						push.apply( results, seed );
						return results;
					}

					break;
				}
			}
		}
	}

	// Compile and execute a filtering function if one is not provided
	// Provide `match` to avoid retokenization if we modified the selector above
	( compiled || compile( selector, match ) )(
		seed,
		context,
		!documentIsHTML,
		results,
		!context || rsibling.test( selector ) && testContext( context.parentNode ) || context
	);
	return results;
};

// One-time assignments

// Sort stability
support.sortStable = expando.split( "" ).sort( sortOrder ).join( "" ) === expando;

// Support: Chrome 14-35+
// Always assume duplicates if they aren't passed to the comparison function
support.detectDuplicates = !!hasDuplicate;

// Initialize against the default document
setDocument();

// Support: Webkit<537.32 - Safari 6.0.3/Chrome 25 (fixed in Chrome 27)
// Detached nodes confoundingly follow *each other*
support.sortDetached = assert( function( el ) {

	// Should return 1, but returns 4 (following)
	return el.compareDocumentPosition( document.createElement( "fieldset" ) ) & 1;
} );

// Support: IE<8
// Prevent attribute/property "interpolation"
// https://msdn.microsoft.com/en-us/library/ms536429%28VS.85%29.aspx
if ( !assert( function( el ) {
	el.innerHTML = "<a href='#'></a>";
	return el.firstChild.getAttribute( "href" ) === "#";
} ) ) {
	addHandle( "type|href|height|width", function( elem, name, isXML ) {
		if ( !isXML ) {
			return elem.getAttribute( name, name.toLowerCase() === "type" ? 1 : 2 );
		}
	} );
}

// Support: IE<9
// Use defaultValue in place of getAttribute("value")
if ( !support.attributes || !assert( function( el ) {
	el.innerHTML = "<input/>";
	el.firstChild.setAttribute( "value", "" );
	return el.firstChild.getAttribute( "value" ) === "";
} ) ) {
	addHandle( "value", function( elem, _name, isXML ) {
		if ( !isXML && elem.nodeName.toLowerCase() === "input" ) {
			return elem.defaultValue;
		}
	} );
}

// Support: IE<9
// Use getAttributeNode to fetch booleans when getAttribute lies
if ( !assert( function( el ) {
	return el.getAttribute( "disabled" ) == null;
} ) ) {
	addHandle( booleans, function( elem, name, isXML ) {
		var val;
		if ( !isXML ) {
			return elem[ name ] === true ? name.toLowerCase() :
				( val = elem.getAttributeNode( name ) ) && val.specified ?
					val.value :
					null;
		}
	} );
}

return Sizzle;

} )( window );



jQuery.find = Sizzle;
jQuery.expr = Sizzle.selectors;

// Deprecated
jQuery.expr[ ":" ] = jQuery.expr.pseudos;
jQuery.uniqueSort = jQuery.unique = Sizzle.uniqueSort;
jQuery.text = Sizzle.getText;
jQuery.isXMLDoc = Sizzle.isXML;
jQuery.contains = Sizzle.contains;
jQuery.escapeSelector = Sizzle.escape;




var dir = function( elem, dir, until ) {
	var matched = [],
		truncate = until !== undefined;

	while ( ( elem = elem[ dir ] ) && elem.nodeType !== 9 ) {
		if ( elem.nodeType === 1 ) {
			if ( truncate && jQuery( elem ).is( until ) ) {
				break;
			}
			matched.push( elem );
		}
	}
	return matched;
};


var siblings = function( n, elem ) {
	var matched = [];

	for ( ; n; n = n.nextSibling ) {
		if ( n.nodeType === 1 && n !== elem ) {
			matched.push( n );
		}
	}

	return matched;
};


var rneedsContext = jQuery.expr.match.needsContext;



function nodeName( elem, name ) {

	return elem.nodeName && elem.nodeName.toLowerCase() === name.toLowerCase();

}
var rsingleTag = ( /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i );



// Implement the identical functionality for filter and not
function winnow( elements, qualifier, not ) {
	if ( isFunction( qualifier ) ) {
		return jQuery.grep( elements, function( elem, i ) {
			return !!qualifier.call( elem, i, elem ) !== not;
		} );
	}

	// Single element
	if ( qualifier.nodeType ) {
		return jQuery.grep( elements, function( elem ) {
			return ( elem === qualifier ) !== not;
		} );
	}

	// Arraylike of elements (jQuery, arguments, Array)
	if ( typeof qualifier !== "string" ) {
		return jQuery.grep( elements, function( elem ) {
			return ( indexOf.call( qualifier, elem ) > -1 ) !== not;
		} );
	}

	// Filtered directly for both simple and complex selectors
	return jQuery.filter( qualifier, elements, not );
}

jQuery.filter = function( expr, elems, not ) {
	var elem = elems[ 0 ];

	if ( not ) {
		expr = ":not(" + expr + ")";
	}

	if ( elems.length === 1 && elem.nodeType === 1 ) {
		return jQuery.find.matchesSelector( elem, expr ) ? [ elem ] : [];
	}

	return jQuery.find.matches( expr, jQuery.grep( elems, function( elem ) {
		return elem.nodeType === 1;
	} ) );
};

jQuery.fn.extend( {
	find: function( selector ) {
		var i, ret,
			len = this.length,
			self = this;

		if ( typeof selector !== "string" ) {
			return this.pushStack( jQuery( selector ).filter( function() {
				for ( i = 0; i < len; i++ ) {
					if ( jQuery.contains( self[ i ], this ) ) {
						return true;
					}
				}
			} ) );
		}

		ret = this.pushStack( [] );

		for ( i = 0; i < len; i++ ) {
			jQuery.find( selector, self[ i ], ret );
		}

		return len > 1 ? jQuery.uniqueSort( ret ) : ret;
	},
	filter: function( selector ) {
		return this.pushStack( winnow( this, selector || [], false ) );
	},
	not: function( selector ) {
		return this.pushStack( winnow( this, selector || [], true ) );
	},
	is: function( selector ) {
		return !!winnow(
			this,

			// If this is a positional/relative selector, check membership in the returned set
			// so $("p:first").is("p:last") won't return true for a doc with two "p".
			typeof selector === "string" && rneedsContext.test( selector ) ?
				jQuery( selector ) :
				selector || [],
			false
		).length;
	}
} );


// Initialize a jQuery object


// A central reference to the root jQuery(document)
var rootjQuery,

	// A simple way to check for HTML strings
	// Prioritize #id over <tag> to avoid XSS via location.hash (#9521)
	// Strict HTML recognition (#11290: must start with <)
	// Shortcut simple #id case for speed
	rquickExpr = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/,

	init = jQuery.fn.init = function( selector, context, root ) {
		var match, elem;

		// HANDLE: $(""), $(null), $(undefined), $(false)
		if ( !selector ) {
			return this;
		}

		// Method init() accepts an alternate rootjQuery
		// so migrate can support jQuery.sub (gh-2101)
		root = root || rootjQuery;

		// Handle HTML strings
		if ( typeof selector === "string" ) {
			if ( selector[ 0 ] === "<" &&
				selector[ selector.length - 1 ] === ">" &&
				selector.length >= 3 ) {

				// Assume that strings that start and end with <> are HTML and skip the regex check
				match = [ null, selector, null ];

			} else {
				match = rquickExpr.exec( selector );
			}

			// Match html or make sure no context is specified for #id
			if ( match && ( match[ 1 ] || !context ) ) {

				// HANDLE: $(html) -> $(array)
				if ( match[ 1 ] ) {
					context = context instanceof jQuery ? context[ 0 ] : context;

					// Option to run scripts is true for back-compat
					// Intentionally let the error be thrown if parseHTML is not present
					jQuery.merge( this, jQuery.parseHTML(
						match[ 1 ],
						context && context.nodeType ? context.ownerDocument || context : document,
						true
					) );

					// HANDLE: $(html, props)
					if ( rsingleTag.test( match[ 1 ] ) && jQuery.isPlainObject( context ) ) {
						for ( match in context ) {

							// Properties of context are called as methods if possible
							if ( isFunction( this[ match ] ) ) {
								this[ match ]( context[ match ] );

							// ...and otherwise set as attributes
							} else {
								this.attr( match, context[ match ] );
							}
						}
					}

					return this;

				// HANDLE: $(#id)
				} else {
					elem = document.getElementById( match[ 2 ] );

					if ( elem ) {

						// Inject the element directly into the jQuery object
						this[ 0 ] = elem;
						this.length = 1;
					}
					return this;
				}

			// HANDLE: $(expr, $(...))
			} else if ( !context || context.jquery ) {
				return ( context || root ).find( selector );

			// HANDLE: $(expr, context)
			// (which is just equivalent to: $(context).find(expr)
			} else {
				return this.constructor( context ).find( selector );
			}

		// HANDLE: $(DOMElement)
		} else if ( selector.nodeType ) {
			this[ 0 ] = selector;
			this.length = 1;
			return this;

		// HANDLE: $(function)
		// Shortcut for document ready
		} else if ( isFunction( selector ) ) {
			return root.ready !== undefined ?
				root.ready( selector ) :

				// Execute immediately if ready is not present
				selector( jQuery );
		}

		return jQuery.makeArray( selector, this );
	};

// Give the init function the jQuery prototype for later instantiation
init.prototype = jQuery.fn;

// Initialize central reference
rootjQuery = jQuery( document );


var rparentsprev = /^(?:parents|prev(?:Until|All))/,

	// Methods guaranteed to produce a unique set when starting from a unique set
	guaranteedUnique = {
		children: true,
		contents: true,
		next: true,
		prev: true
	};

jQuery.fn.extend( {
	has: function( target ) {
		var targets = jQuery( target, this ),
			l = targets.length;

		return this.filter( function() {
			var i = 0;
			for ( ; i < l; i++ ) {
				if ( jQuery.contains( this, targets[ i ] ) ) {
					return true;
				}
			}
		} );
	},

	closest: function( selectors, context ) {
		var cur,
			i = 0,
			l = this.length,
			matched = [],
			targets = typeof selectors !== "string" && jQuery( selectors );

		// Positional selectors never match, since there's no _selection_ context
		if ( !rneedsContext.test( selectors ) ) {
			for ( ; i < l; i++ ) {
				for ( cur = this[ i ]; cur && cur !== context; cur = cur.parentNode ) {

					// Always skip document fragments
					if ( cur.nodeType < 11 && ( targets ?
						targets.index( cur ) > -1 :

						// Don't pass non-elements to Sizzle
						cur.nodeType === 1 &&
							jQuery.find.matchesSelector( cur, selectors ) ) ) {

						matched.push( cur );
						break;
					}
				}
			}
		}

		return this.pushStack( matched.length > 1 ? jQuery.uniqueSort( matched ) : matched );
	},

	// Determine the position of an element within the set
	index: function( elem ) {

		// No argument, return index in parent
		if ( !elem ) {
			return ( this[ 0 ] && this[ 0 ].parentNode ) ? this.first().prevAll().length : -1;
		}

		// Index in selector
		if ( typeof elem === "string" ) {
			return indexOf.call( jQuery( elem ), this[ 0 ] );
		}

		// Locate the position of the desired element
		return indexOf.call( this,

			// If it receives a jQuery object, the first element is used
			elem.jquery ? elem[ 0 ] : elem
		);
	},

	add: function( selector, context ) {
		return this.pushStack(
			jQuery.uniqueSort(
				jQuery.merge( this.get(), jQuery( selector, context ) )
			)
		);
	},

	addBack: function( selector ) {
		return this.add( selector == null ?
			this.prevObject : this.prevObject.filter( selector )
		);
	}
} );

function sibling( cur, dir ) {
	while ( ( cur = cur[ dir ] ) && cur.nodeType !== 1 ) {}
	return cur;
}

jQuery.each( {
	parent: function( elem ) {
		var parent = elem.parentNode;
		return parent && parent.nodeType !== 11 ? parent : null;
	},
	parents: function( elem ) {
		return dir( elem, "parentNode" );
	},
	parentsUntil: function( elem, _i, until ) {
		return dir( elem, "parentNode", until );
	},
	next: function( elem ) {
		return sibling( elem, "nextSibling" );
	},
	prev: function( elem ) {
		return sibling( elem, "previousSibling" );
	},
	nextAll: function( elem ) {
		return dir( elem, "nextSibling" );
	},
	prevAll: function( elem ) {
		return dir( elem, "previousSibling" );
	},
	nextUntil: function( elem, _i, until ) {
		return dir( elem, "nextSibling", until );
	},
	prevUntil: function( elem, _i, until ) {
		return dir( elem, "previousSibling", until );
	},
	siblings: function( elem ) {
		return siblings( ( elem.parentNode || {} ).firstChild, elem );
	},
	children: function( elem ) {
		return siblings( elem.firstChild );
	},
	contents: function( elem ) {
		if ( elem.contentDocument != null &&

			// Support: IE 11+
			// <object> elements with no `data` attribute has an object
			// `contentDocument` with a `null` prototype.
			getProto( elem.contentDocument ) ) {

			return elem.contentDocument;
		}

		// Support: IE 9 - 11 only, iOS 7 only, Android Browser <=4.3 only
		// Treat the template element as a regular one in browsers that
		// don't support it.
		if ( nodeName( elem, "template" ) ) {
			elem = elem.content || elem;
		}

		return jQuery.merge( [], elem.childNodes );
	}
}, function( name, fn ) {
	jQuery.fn[ name ] = function( until, selector ) {
		var matched = jQuery.map( this, fn, until );

		if ( name.slice( -5 ) !== "Until" ) {
			selector = until;
		}

		if ( selector && typeof selector === "string" ) {
			matched = jQuery.filter( selector, matched );
		}

		if ( this.length > 1 ) {

			// Remove duplicates
			if ( !guaranteedUnique[ name ] ) {
				jQuery.uniqueSort( matched );
			}

			// Reverse order for parents* and prev-derivatives
			if ( rparentsprev.test( name ) ) {
				matched.reverse();
			}
		}

		return this.pushStack( matched );
	};
} );
var rnothtmlwhite = ( /[^\x20\t\r\n\f]+/g );



// Convert String-formatted options into Object-formatted ones
function createOptions( options ) {
	var object = {};
	jQuery.each( options.match( rnothtmlwhite ) || [], function( _, flag ) {
		object[ flag ] = true;
	} );
	return object;
}

/*
 * Create a callback list using the following parameters:
 *
 *	options: an optional list of space-separated options that will change how
 *			the callback list behaves or a more traditional option object
 *
 * By default a callback list will act like an event callback list and can be
 * "fired" multiple times.
 *
 * Possible options:
 *
 *	once:			will ensure the callback list can only be fired once (like a Deferred)
 *
 *	memory:			will keep track of previous values and will call any callback added
 *					after the list has been fired right away with the latest "memorized"
 *					values (like a Deferred)
 *
 *	unique:			will ensure a callback can only be added once (no duplicate in the list)
 *
 *	stopOnFalse:	interrupt callings when a callback returns false
 *
 */
jQuery.Callbacks = function( options ) {

	// Convert options from String-formatted to Object-formatted if needed
	// (we check in cache first)
	options = typeof options === "string" ?
		createOptions( options ) :
		jQuery.extend( {}, options );

	var // Flag to know if list is currently firing
		firing,

		// Last fire value for non-forgettable lists
		memory,

		// Flag to know if list was already fired
		fired,

		// Flag to prevent firing
		locked,

		// Actual callback list
		list = [],

		// Queue of execution data for repeatable lists
		queue = [],

		// Index of currently firing callback (modified by add/remove as needed)
		firingIndex = -1,

		// Fire callbacks
		fire = function() {

			// Enforce single-firing
			locked = locked || options.once;

			// Execute callbacks for all pending executions,
			// respecting firingIndex overrides and runtime changes
			fired = firing = true;
			for ( ; queue.length; firingIndex = -1 ) {
				memory = queue.shift();
				while ( ++firingIndex < list.length ) {

					// Run callback and check for early termination
					if ( list[ firingIndex ].apply( memory[ 0 ], memory[ 1 ] ) === false &&
						options.stopOnFalse ) {

						// Jump to end and forget the data so .add doesn't re-fire
						firingIndex = list.length;
						memory = false;
					}
				}
			}

			// Forget the data if we're done with it
			if ( !options.memory ) {
				memory = false;
			}

			firing = false;

			// Clean up if we're done firing for good
			if ( locked ) {

				// Keep an empty list if we have data for future add calls
				if ( memory ) {
					list = [];

				// Otherwise, this object is spent
				} else {
					list = "";
				}
			}
		},

		// Actual Callbacks object
		self = {

			// Add a callback or a collection of callbacks to the list
			add: function() {
				if ( list ) {

					// If we have memory from a past run, we should fire after adding
					if ( memory && !firing ) {
						firingIndex = list.length - 1;
						queue.push( memory );
					}

					( function add( args ) {
						jQuery.each( args, function( _, arg ) {
							if ( isFunction( arg ) ) {
								if ( !options.unique || !self.has( arg ) ) {
									list.push( arg );
								}
							} else if ( arg && arg.length && toType( arg ) !== "string" ) {

								// Inspect recursively
								add( arg );
							}
						} );
					} )( arguments );

					if ( memory && !firing ) {
						fire();
					}
				}
				return this;
			},

			// Remove a callback from the list
			remove: function() {
				jQuery.each( arguments, function( _, arg ) {
					var index;
					while ( ( index = jQuery.inArray( arg, list, index ) ) > -1 ) {
						list.splice( index, 1 );

						// Handle firing indexes
						if ( index <= firingIndex ) {
							firingIndex--;
						}
					}
				} );
				return this;
			},

			// Check if a given callback is in the list.
			// If no argument is given, return whether or not list has callbacks attached.
			has: function( fn ) {
				return fn ?
					jQuery.inArray( fn, list ) > -1 :
					list.length > 0;
			},

			// Remove all callbacks from the list
			empty: function() {
				if ( list ) {
					list = [];
				}
				return this;
			},

			// Disable .fire and .add
			// Abort any current/pending executions
			// Clear all callbacks and values
			disable: function() {
				locked = queue = [];
				list = memory = "";
				return this;
			},
			disabled: function() {
				return !list;
			},

			// Disable .fire
			// Also disable .add unless we have memory (since it would have no effect)
			// Abort any pending executions
			lock: function() {
				locked = queue = [];
				if ( !memory && !firing ) {
					list = memory = "";
				}
				return this;
			},
			locked: function() {
				return !!locked;
			},

			// Call all callbacks with the given context and arguments
			fireWith: function( context, args ) {
				if ( !locked ) {
					args = args || [];
					args = [ context, args.slice ? args.slice() : args ];
					queue.push( args );
					if ( !firing ) {
						fire();
					}
				}
				return this;
			},

			// Call all the callbacks with the given arguments
			fire: function() {
				self.fireWith( this, arguments );
				return this;
			},

			// To know if the callbacks have already been called at least once
			fired: function() {
				return !!fired;
			}
		};

	return self;
};


function Identity( v ) {
	return v;
}
function Thrower( ex ) {
	throw ex;
}

function adoptValue( value, resolve, reject, noValue ) {
	var method;

	try {

		// Check for promise aspect first to privilege synchronous behavior
		if ( value && isFunction( ( method = value.promise ) ) ) {
			method.call( value ).done( resolve ).fail( reject );

		// Other thenables
		} else if ( value && isFunction( ( method = value.then ) ) ) {
			method.call( value, resolve, reject );

		// Other non-thenables
		} else {

			// Control `resolve` arguments by letting Array#slice cast boolean `noValue` to integer:
			// * false: [ value ].slice( 0 ) => resolve( value )
			// * true: [ value ].slice( 1 ) => resolve()
			resolve.apply( undefined, [ value ].slice( noValue ) );
		}

	// For Promises/A+, convert exceptions into rejections
	// Since jQuery.when doesn't unwrap thenables, we can skip the extra checks appearing in
	// Deferred#then to conditionally suppress rejection.
	} catch ( value ) {

		// Support: Android 4.0 only
		// Strict mode functions invoked without .call/.apply get global-object context
		reject.apply( undefined, [ value ] );
	}
}

jQuery.extend( {

	Deferred: function( func ) {
		var tuples = [

				// action, add listener, callbacks,
				// ... .then handlers, argument index, [final state]
				[ "notify", "progress", jQuery.Callbacks( "memory" ),
					jQuery.Callbacks( "memory" ), 2 ],
				[ "resolve", "done", jQuery.Callbacks( "once memory" ),
					jQuery.Callbacks( "once memory" ), 0, "resolved" ],
				[ "reject", "fail", jQuery.Callbacks( "once memory" ),
					jQuery.Callbacks( "once memory" ), 1, "rejected" ]
			],
			state = "pending",
			promise = {
				state: function() {
					return state;
				},
				always: function() {
					deferred.done( arguments ).fail( arguments );
					return this;
				},
				"catch": function( fn ) {
					return promise.then( null, fn );
				},

				// Keep pipe for back-compat
				pipe: function( /* fnDone, fnFail, fnProgress */ ) {
					var fns = arguments;

					return jQuery.Deferred( function( newDefer ) {
						jQuery.each( tuples, function( _i, tuple ) {

							// Map tuples (progress, done, fail) to arguments (done, fail, progress)
							var fn = isFunction( fns[ tuple[ 4 ] ] ) && fns[ tuple[ 4 ] ];

							// deferred.progress(function() { bind to newDefer or newDefer.notify })
							// deferred.done(function() { bind to newDefer or newDefer.resolve })
							// deferred.fail(function() { bind to newDefer or newDefer.reject })
							deferred[ tuple[ 1 ] ]( function() {
								var returned = fn && fn.apply( this, arguments );
								if ( returned && isFunction( returned.promise ) ) {
									returned.promise()
										.progress( newDefer.notify )
										.done( newDefer.resolve )
										.fail( newDefer.reject );
								} else {
									newDefer[ tuple[ 0 ] + "With" ](
										this,
										fn ? [ returned ] : arguments
									);
								}
							} );
						} );
						fns = null;
					} ).promise();
				},
				then: function( onFulfilled, onRejected, onProgress ) {
					var maxDepth = 0;
					function resolve( depth, deferred, handler, special ) {
						return function() {
							var that = this,
								args = arguments,
								mightThrow = function() {
									var returned, then;

									// Support: Promises/A+ section 2.3.3.3.3
									// https://promisesaplus.com/#point-59
									// Ignore double-resolution attempts
									if ( depth < maxDepth ) {
										return;
									}

									returned = handler.apply( that, args );

									// Support: Promises/A+ section 2.3.1
									// https://promisesaplus.com/#point-48
									if ( returned === deferred.promise() ) {
										throw new TypeError( "Thenable self-resolution" );
									}

									// Support: Promises/A+ sections 2.3.3.1, 3.5
									// https://promisesaplus.com/#point-54
									// https://promisesaplus.com/#point-75
									// Retrieve `then` only once
									then = returned &&

										// Support: Promises/A+ section 2.3.4
										// https://promisesaplus.com/#point-64
										// Only check objects and functions for thenability
										( typeof returned === "object" ||
											typeof returned === "function" ) &&
										returned.then;

									// Handle a returned thenable
									if ( isFunction( then ) ) {

										// Special processors (notify) just wait for resolution
										if ( special ) {
											then.call(
												returned,
												resolve( maxDepth, deferred, Identity, special ),
												resolve( maxDepth, deferred, Thrower, special )
											);

										// Normal processors (resolve) also hook into progress
										} else {

											// ...and disregard older resolution values
											maxDepth++;

											then.call(
												returned,
												resolve( maxDepth, deferred, Identity, special ),
												resolve( maxDepth, deferred, Thrower, special ),
												resolve( maxDepth, deferred, Identity,
													deferred.notifyWith )
											);
										}

									// Handle all other returned values
									} else {

										// Only substitute handlers pass on context
										// and multiple values (non-spec behavior)
										if ( handler !== Identity ) {
											that = undefined;
											args = [ returned ];
										}

										// Process the value(s)
										// Default process is resolve
										( special || deferred.resolveWith )( that, args );
									}
								},

								// Only normal processors (resolve) catch and reject exceptions
								process = special ?
									mightThrow :
									function() {
										try {
											mightThrow();
										} catch ( e ) {

											if ( jQuery.Deferred.exceptionHook ) {
												jQuery.Deferred.exceptionHook( e,
													process.stackTrace );
											}

											// Support: Promises/A+ section 2.3.3.3.4.1
											// https://promisesaplus.com/#point-61
											// Ignore post-resolution exceptions
											if ( depth + 1 >= maxDepth ) {

												// Only substitute handlers pass on context
												// and multiple values (non-spec behavior)
												if ( handler !== Thrower ) {
													that = undefined;
													args = [ e ];
												}

												deferred.rejectWith( that, args );
											}
										}
									};

							// Support: Promises/A+ section 2.3.3.3.1
							// https://promisesaplus.com/#point-57
							// Re-resolve promises immediately to dodge false rejection from
							// subsequent errors
							if ( depth ) {
								process();
							} else {

								// Call an optional hook to record the stack, in case of exception
								// since it's otherwise lost when execution goes async
								if ( jQuery.Deferred.getStackHook ) {
									process.stackTrace = jQuery.Deferred.getStackHook();
								}
								window.setTimeout( process );
							}
						};
					}

					return jQuery.Deferred( function( newDefer ) {

						// progress_handlers.add( ... )
						tuples[ 0 ][ 3 ].add(
							resolve(
								0,
								newDefer,
								isFunction( onProgress ) ?
									onProgress :
									Identity,
								newDefer.notifyWith
							)
						);

						// fulfilled_handlers.add( ... )
						tuples[ 1 ][ 3 ].add(
							resolve(
								0,
								newDefer,
								isFunction( onFulfilled ) ?
									onFulfilled :
									Identity
							)
						);

						// rejected_handlers.add( ... )
						tuples[ 2 ][ 3 ].add(
							resolve(
								0,
								newDefer,
								isFunction( onRejected ) ?
									onRejected :
									Thrower
							)
						);
					} ).promise();
				},

				// Get a promise for this deferred
				// If obj is provided, the promise aspect is added to the object
				promise: function( obj ) {
					return obj != null ? jQuery.extend( obj, promise ) : promise;
				}
			},
			deferred = {};

		// Add list-specific methods
		jQuery.each( tuples, function( i, tuple ) {
			var list = tuple[ 2 ],
				stateString = tuple[ 5 ];

			// promise.progress = list.add
			// promise.done = list.add
			// promise.fail = list.add
			promise[ tuple[ 1 ] ] = list.add;

			// Handle state
			if ( stateString ) {
				list.add(
					function() {

						// state = "resolved" (i.e., fulfilled)
						// state = "rejected"
						state = stateString;
					},

					// rejected_callbacks.disable
					// fulfilled_callbacks.disable
					tuples[ 3 - i ][ 2 ].disable,

					// rejected_handlers.disable
					// fulfilled_handlers.disable
					tuples[ 3 - i ][ 3 ].disable,

					// progress_callbacks.lock
					tuples[ 0 ][ 2 ].lock,

					// progress_handlers.lock
					tuples[ 0 ][ 3 ].lock
				);
			}

			// progress_handlers.fire
			// fulfilled_handlers.fire
			// rejected_handlers.fire
			list.add( tuple[ 3 ].fire );

			// deferred.notify = function() { deferred.notifyWith(...) }
			// deferred.resolve = function() { deferred.resolveWith(...) }
			// deferred.reject = function() { deferred.rejectWith(...) }
			deferred[ tuple[ 0 ] ] = function() {
				deferred[ tuple[ 0 ] + "With" ]( this === deferred ? undefined : this, arguments );
				return this;
			};

			// deferred.notifyWith = list.fireWith
			// deferred.resolveWith = list.fireWith
			// deferred.rejectWith = list.fireWith
			deferred[ tuple[ 0 ] + "With" ] = list.fireWith;
		} );

		// Make the deferred a promise
		promise.promise( deferred );

		// Call given func if any
		if ( func ) {
			func.call( deferred, deferred );
		}

		// All done!
		return deferred;
	},

	// Deferred helper
	when: function( singleValue ) {
		var

			// count of uncompleted subordinates
			remaining = arguments.length,

			// count of unprocessed arguments
			i = remaining,

			// subordinate fulfillment data
			resolveContexts = Array( i ),
			resolveValues = slice.call( arguments ),

			// the primary Deferred
			primary = jQuery.Deferred(),

			// subordinate callback factory
			updateFunc = function( i ) {
				return function( value ) {
					resolveContexts[ i ] = this;
					resolveValues[ i ] = arguments.length > 1 ? slice.call( arguments ) : value;
					if ( !( --remaining ) ) {
						primary.resolveWith( resolveContexts, resolveValues );
					}
				};
			};

		// Single- and empty arguments are adopted like Promise.resolve
		if ( remaining <= 1 ) {
			adoptValue( singleValue, primary.done( updateFunc( i ) ).resolve, primary.reject,
				!remaining );

			// Use .then() to unwrap secondary thenables (cf. gh-3000)
			if ( primary.state() === "pending" ||
				isFunction( resolveValues[ i ] && resolveValues[ i ].then ) ) {

				return primary.then();
			}
		}

		// Multiple arguments are aggregated like Promise.all array elements
		while ( i-- ) {
			adoptValue( resolveValues[ i ], updateFunc( i ), primary.reject );
		}

		return primary.promise();
	}
} );


// These usually indicate a programmer mistake during development,
// warn about them ASAP rather than swallowing them by default.
var rerrorNames = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;

jQuery.Deferred.exceptionHook = function( error, stack ) {

	// Support: IE 8 - 9 only
	// Console exists when dev tools are open, which can happen at any time
	if ( window.console && window.console.warn && error && rerrorNames.test( error.name ) ) {
		window.console.warn( "jQuery.Deferred exception: " + error.message, error.stack, stack );
	}
};




jQuery.readyException = function( error ) {
	window.setTimeout( function() {
		throw error;
	} );
};




// The deferred used on DOM ready
var readyList = jQuery.Deferred();

jQuery.fn.ready = function( fn ) {

	readyList
		.then( fn )

		// Wrap jQuery.readyException in a function so that the lookup
		// happens at the time of error handling instead of callback
		// registration.
		.catch( function( error ) {
			jQuery.readyException( error );
		} );

	return this;
};

jQuery.extend( {

	// Is the DOM ready to be used? Set to true once it occurs.
	isReady: false,

	// A counter to track how many items to wait for before
	// the ready event fires. See #6781
	readyWait: 1,

	// Handle when the DOM is ready
	ready: function( wait ) {

		// Abort if there are pending holds or we're already ready
		if ( wait === true ? --jQuery.readyWait : jQuery.isReady ) {
			return;
		}

		// Remember that the DOM is ready
		jQuery.isReady = true;

		// If a normal DOM Ready event fired, decrement, and wait if need be
		if ( wait !== true && --jQuery.readyWait > 0 ) {
			return;
		}

		// If there are functions bound, to execute
		readyList.resolveWith( document, [ jQuery ] );
	}
} );

jQuery.ready.then = readyList.then;

// The ready event handler and self cleanup method
function completed() {
	document.removeEventListener( "DOMContentLoaded", completed );
	window.removeEventListener( "load", completed );
	jQuery.ready();
}

// Catch cases where $(document).ready() is called
// after the browser event has already occurred.
// Support: IE <=9 - 10 only
// Older IE sometimes signals "interactive" too soon
if ( document.readyState === "complete" ||
	( document.readyState !== "loading" && !document.documentElement.doScroll ) ) {

	// Handle it asynchronously to allow scripts the opportunity to delay ready
	window.setTimeout( jQuery.ready );

} else {

	// Use the handy event callback
	document.addEventListener( "DOMContentLoaded", completed );

	// A fallback to window.onload, that will always work
	window.addEventListener( "load", completed );
}




// Multifunctional method to get and set values of a collection
// The value/s can optionally be executed if it's a function
var access = function( elems, fn, key, value, chainable, emptyGet, raw ) {
	var i = 0,
		len = elems.length,
		bulk = key == null;

	// Sets many values
	if ( toType( key ) === "object" ) {
		chainable = true;
		for ( i in key ) {
			access( elems, fn, i, key[ i ], true, emptyGet, raw );
		}

	// Sets one value
	} else if ( value !== undefined ) {
		chainable = true;

		if ( !isFunction( value ) ) {
			raw = true;
		}

		if ( bulk ) {

			// Bulk operations run against the entire set
			if ( raw ) {
				fn.call( elems, value );
				fn = null;

			// ...except when executing function values
			} else {
				bulk = fn;
				fn = function( elem, _key, value ) {
					return bulk.call( jQuery( elem ), value );
				};
			}
		}

		if ( fn ) {
			for ( ; i < len; i++ ) {
				fn(
					elems[ i ], key, raw ?
						value :
						value.call( elems[ i ], i, fn( elems[ i ], key ) )
				);
			}
		}
	}

	if ( chainable ) {
		return elems;
	}

	// Gets
	if ( bulk ) {
		return fn.call( elems );
	}

	return len ? fn( elems[ 0 ], key ) : emptyGet;
};


// Matches dashed string for camelizing
var rmsPrefix = /^-ms-/,
	rdashAlpha = /-([a-z])/g;

// Used by camelCase as callback to replace()
function fcamelCase( _all, letter ) {
	return letter.toUpperCase();
}

// Convert dashed to camelCase; used by the css and data modules
// Support: IE <=9 - 11, Edge 12 - 15
// Microsoft forgot to hump their vendor prefix (#9572)
function camelCase( string ) {
	return string.replace( rmsPrefix, "ms-" ).replace( rdashAlpha, fcamelCase );
}
var acceptData = function( owner ) {

	// Accepts only:
	//  - Node
	//    - Node.ELEMENT_NODE
	//    - Node.DOCUMENT_NODE
	//  - Object
	//    - Any
	return owner.nodeType === 1 || owner.nodeType === 9 || !( +owner.nodeType );
};




function Data() {
	this.expando = jQuery.expando + Data.uid++;
}

Data.uid = 1;

Data.prototype = {

	cache: function( owner ) {

		// Check if the owner object already has a cache
		var value = owner[ this.expando ];

		// If not, create one
		if ( !value ) {
			value = {};

			// We can accept data for non-element nodes in modern browsers,
			// but we should not, see #8335.
			// Always return an empty object.
			if ( acceptData( owner ) ) {

				// If it is a node unlikely to be stringify-ed or looped over
				// use plain assignment
				if ( owner.nodeType ) {
					owner[ this.expando ] = value;

				// Otherwise secure it in a non-enumerable property
				// configurable must be true to allow the property to be
				// deleted when data is removed
				} else {
					Object.defineProperty( owner, this.expando, {
						value: value,
						configurable: true
					} );
				}
			}
		}

		return value;
	},
	set: function( owner, data, value ) {
		var prop,
			cache = this.cache( owner );

		// Handle: [ owner, key, value ] args
		// Always use camelCase key (gh-2257)
		if ( typeof data === "string" ) {
			cache[ camelCase( data ) ] = value;

		// Handle: [ owner, { properties } ] args
		} else {

			// Copy the properties one-by-one to the cache object
			for ( prop in data ) {
				cache[ camelCase( prop ) ] = data[ prop ];
			}
		}
		return cache;
	},
	get: function( owner, key ) {
		return key === undefined ?
			this.cache( owner ) :

			// Always use camelCase key (gh-2257)
			owner[ this.expando ] && owner[ this.expando ][ camelCase( key ) ];
	},
	access: function( owner, key, value ) {

		// In cases where either:
		//
		//   1. No key was specified
		//   2. A string key was specified, but no value provided
		//
		// Take the "read" path and allow the get method to determine
		// which value to return, respectively either:
		//
		//   1. The entire cache object
		//   2. The data stored at the key
		//
		if ( key === undefined ||
				( ( key && typeof key === "string" ) && value === undefined ) ) {

			return this.get( owner, key );
		}

		// When the key is not a string, or both a key and value
		// are specified, set or extend (existing objects) with either:
		//
		//   1. An object of properties
		//   2. A key and value
		//
		this.set( owner, key, value );

		// Since the "set" path can have two possible entry points
		// return the expected data based on which path was taken[*]
		return value !== undefined ? value : key;
	},
	remove: function( owner, key ) {
		var i,
			cache = owner[ this.expando ];

		if ( cache === undefined ) {
			return;
		}

		if ( key !== undefined ) {

			// Support array or space separated string of keys
			if ( Array.isArray( key ) ) {

				// If key is an array of keys...
				// We always set camelCase keys, so remove that.
				key = key.map( camelCase );
			} else {
				key = camelCase( key );

				// If a key with the spaces exists, use it.
				// Otherwise, create an array by matching non-whitespace
				key = key in cache ?
					[ key ] :
					( key.match( rnothtmlwhite ) || [] );
			}

			i = key.length;

			while ( i-- ) {
				delete cache[ key[ i ] ];
			}
		}

		// Remove the expando if there's no more data
		if ( key === undefined || jQuery.isEmptyObject( cache ) ) {

			// Support: Chrome <=35 - 45
			// Webkit & Blink performance suffers when deleting properties
			// from DOM nodes, so set to undefined instead
			// https://bugs.chromium.org/p/chromium/issues/detail?id=378607 (bug restricted)
			if ( owner.nodeType ) {
				owner[ this.expando ] = undefined;
			} else {
				delete owner[ this.expando ];
			}
		}
	},
	hasData: function( owner ) {
		var cache = owner[ this.expando ];
		return cache !== undefined && !jQuery.isEmptyObject( cache );
	}
};
var dataPriv = new Data();

var dataUser = new Data();



//	Implementation Summary
//
//	1. Enforce API surface and semantic compatibility with 1.9.x branch
//	2. Improve the module's maintainability by reducing the storage
//		paths to a single mechanism.
//	3. Use the same single mechanism to support "private" and "user" data.
//	4. _Never_ expose "private" data to user code (TODO: Drop _data, _removeData)
//	5. Avoid exposing implementation details on user objects (eg. expando properties)
//	6. Provide a clear path for implementation upgrade to WeakMap in 2014

var rbrace = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
	rmultiDash = /[A-Z]/g;

function getData( data ) {
	if ( data === "true" ) {
		return true;
	}

	if ( data === "false" ) {
		return false;
	}

	if ( data === "null" ) {
		return null;
	}

	// Only convert to a number if it doesn't change the string
	if ( data === +data + "" ) {
		return +data;
	}

	if ( rbrace.test( data ) ) {
		return JSON.parse( data );
	}

	return data;
}

function dataAttr( elem, key, data ) {
	var name;

	// If nothing was found internally, try to fetch any
	// data from the HTML5 data-* attribute
	if ( data === undefined && elem.nodeType === 1 ) {
		name = "data-" + key.replace( rmultiDash, "-$&" ).toLowerCase();
		data = elem.getAttribute( name );

		if ( typeof data === "string" ) {
			try {
				data = getData( data );
			} catch ( e ) {}

			// Make sure we set the data so it isn't changed later
			dataUser.set( elem, key, data );
		} else {
			data = undefined;
		}
	}
	return data;
}

jQuery.extend( {
	hasData: function( elem ) {
		return dataUser.hasData( elem ) || dataPriv.hasData( elem );
	},

	data: function( elem, name, data ) {
		return dataUser.access( elem, name, data );
	},

	removeData: function( elem, name ) {
		dataUser.remove( elem, name );
	},

	// TODO: Now that all calls to _data and _removeData have been replaced
	// with direct calls to dataPriv methods, these can be deprecated.
	_data: function( elem, name, data ) {
		return dataPriv.access( elem, name, data );
	},

	_removeData: function( elem, name ) {
		dataPriv.remove( elem, name );
	}
} );

jQuery.fn.extend( {
	data: function( key, value ) {
		var i, name, data,
			elem = this[ 0 ],
			attrs = elem && elem.attributes;

		// Gets all values
		if ( key === undefined ) {
			if ( this.length ) {
				data = dataUser.get( elem );

				if ( elem.nodeType === 1 && !dataPriv.get( elem, "hasDataAttrs" ) ) {
					i = attrs.length;
					while ( i-- ) {

						// Support: IE 11 only
						// The attrs elements can be null (#14894)
						if ( attrs[ i ] ) {
							name = attrs[ i ].name;
							if ( name.indexOf( "data-" ) === 0 ) {
								name = camelCase( name.slice( 5 ) );
								dataAttr( elem, name, data[ name ] );
							}
						}
					}
					dataPriv.set( elem, "hasDataAttrs", true );
				}
			}

			return data;
		}

		// Sets multiple values
		if ( typeof key === "object" ) {
			return this.each( function() {
				dataUser.set( this, key );
			} );
		}

		return access( this, function( value ) {
			var data;

			// The calling jQuery object (element matches) is not empty
			// (and therefore has an element appears at this[ 0 ]) and the
			// `value` parameter was not undefined. An empty jQuery object
			// will result in `undefined` for elem = this[ 0 ] which will
			// throw an exception if an attempt to read a data cache is made.
			if ( elem && value === undefined ) {

				// Attempt to get data from the cache
				// The key will always be camelCased in Data
				data = dataUser.get( elem, key );
				if ( data !== undefined ) {
					return data;
				}

				// Attempt to "discover" the data in
				// HTML5 custom data-* attrs
				data = dataAttr( elem, key );
				if ( data !== undefined ) {
					return data;
				}

				// We tried really hard, but the data doesn't exist.
				return;
			}

			// Set the data...
			this.each( function() {

				// We always store the camelCased key
				dataUser.set( this, key, value );
			} );
		}, null, value, arguments.length > 1, null, true );
	},

	removeData: function( key ) {
		return this.each( function() {
			dataUser.remove( this, key );
		} );
	}
} );


jQuery.extend( {
	queue: function( elem, type, data ) {
		var queue;

		if ( elem ) {
			type = ( type || "fx" ) + "queue";
			queue = dataPriv.get( elem, type );

			// Speed up dequeue by getting out quickly if this is just a lookup
			if ( data ) {
				if ( !queue || Array.isArray( data ) ) {
					queue = dataPriv.access( elem, type, jQuery.makeArray( data ) );
				} else {
					queue.push( data );
				}
			}
			return queue || [];
		}
	},

	dequeue: function( elem, type ) {
		type = type || "fx";

		var queue = jQuery.queue( elem, type ),
			startLength = queue.length,
			fn = queue.shift(),
			hooks = jQuery._queueHooks( elem, type ),
			next = function() {
				jQuery.dequeue( elem, type );
			};

		// If the fx queue is dequeued, always remove the progress sentinel
		if ( fn === "inprogress" ) {
			fn = queue.shift();
			startLength--;
		}

		if ( fn ) {

			// Add a progress sentinel to prevent the fx queue from being
			// automatically dequeued
			if ( type === "fx" ) {
				queue.unshift( "inprogress" );
			}

			// Clear up the last queue stop function
			delete hooks.stop;
			fn.call( elem, next, hooks );
		}

		if ( !startLength && hooks ) {
			hooks.empty.fire();
		}
	},

	// Not public - generate a queueHooks object, or return the current one
	_queueHooks: function( elem, type ) {
		var key = type + "queueHooks";
		return dataPriv.get( elem, key ) || dataPriv.access( elem, key, {
			empty: jQuery.Callbacks( "once memory" ).add( function() {
				dataPriv.remove( elem, [ type + "queue", key ] );
			} )
		} );
	}
} );

jQuery.fn.extend( {
	queue: function( type, data ) {
		var setter = 2;

		if ( typeof type !== "string" ) {
			data = type;
			type = "fx";
			setter--;
		}

		if ( arguments.length < setter ) {
			return jQuery.queue( this[ 0 ], type );
		}

		return data === undefined ?
			this :
			this.each( function() {
				var queue = jQuery.queue( this, type, data );

				// Ensure a hooks for this queue
				jQuery._queueHooks( this, type );

				if ( type === "fx" && queue[ 0 ] !== "inprogress" ) {
					jQuery.dequeue( this, type );
				}
			} );
	},
	dequeue: function( type ) {
		return this.each( function() {
			jQuery.dequeue( this, type );
		} );
	},
	clearQueue: function( type ) {
		return this.queue( type || "fx", [] );
	},

	// Get a promise resolved when queues of a certain type
	// are emptied (fx is the type by default)
	promise: function( type, obj ) {
		var tmp,
			count = 1,
			defer = jQuery.Deferred(),
			elements = this,
			i = this.length,
			resolve = function() {
				if ( !( --count ) ) {
					defer.resolveWith( elements, [ elements ] );
				}
			};

		if ( typeof type !== "string" ) {
			obj = type;
			type = undefined;
		}
		type = type || "fx";

		while ( i-- ) {
			tmp = dataPriv.get( elements[ i ], type + "queueHooks" );
			if ( tmp && tmp.empty ) {
				count++;
				tmp.empty.add( resolve );
			}
		}
		resolve();
		return defer.promise( obj );
	}
} );
var pnum = ( /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/ ).source;

var rcssNum = new RegExp( "^(?:([+-])=|)(" + pnum + ")([a-z%]*)$", "i" );


var cssExpand = [ "Top", "Right", "Bottom", "Left" ];

var documentElement = document.documentElement;



	var isAttached = function( elem ) {
			return jQuery.contains( elem.ownerDocument, elem );
		},
		composed = { composed: true };

	// Support: IE 9 - 11+, Edge 12 - 18+, iOS 10.0 - 10.2 only
	// Check attachment across shadow DOM boundaries when possible (gh-3504)
	// Support: iOS 10.0-10.2 only
	// Early iOS 10 versions support `attachShadow` but not `getRootNode`,
	// leading to errors. We need to check for `getRootNode`.
	if ( documentElement.getRootNode ) {
		isAttached = function( elem ) {
			return jQuery.contains( elem.ownerDocument, elem ) ||
				elem.getRootNode( composed ) === elem.ownerDocument;
		};
	}
var isHiddenWithinTree = function( elem, el ) {

		// isHiddenWithinTree might be called from jQuery#filter function;
		// in that case, element will be second argument
		elem = el || elem;

		// Inline style trumps all
		return elem.style.display === "none" ||
			elem.style.display === "" &&

			// Otherwise, check computed style
			// Support: Firefox <=43 - 45
			// Disconnected elements can have computed display: none, so first confirm that elem is
			// in the document.
			isAttached( elem ) &&

			jQuery.css( elem, "display" ) === "none";
	};



function adjustCSS( elem, prop, valueParts, tween ) {
	var adjusted, scale,
		maxIterations = 20,
		currentValue = tween ?
			function() {
				return tween.cur();
			} :
			function() {
				return jQuery.css( elem, prop, "" );
			},
		initial = currentValue(),
		unit = valueParts && valueParts[ 3 ] || ( jQuery.cssNumber[ prop ] ? "" : "px" ),

		// Starting value computation is required for potential unit mismatches
		initialInUnit = elem.nodeType &&
			( jQuery.cssNumber[ prop ] || unit !== "px" && +initial ) &&
			rcssNum.exec( jQuery.css( elem, prop ) );

	if ( initialInUnit && initialInUnit[ 3 ] !== unit ) {

		// Support: Firefox <=54
		// Halve the iteration target value to prevent interference from CSS upper bounds (gh-2144)
		initial = initial / 2;

		// Trust units reported by jQuery.css
		unit = unit || initialInUnit[ 3 ];

		// Iteratively approximate from a nonzero starting point
		initialInUnit = +initial || 1;

		while ( maxIterations-- ) {

			// Evaluate and update our best guess (doubling guesses that zero out).
			// Finish if the scale equals or crosses 1 (making the old*new product non-positive).
			jQuery.style( elem, prop, initialInUnit + unit );
			if ( ( 1 - scale ) * ( 1 - ( scale = currentValue() / initial || 0.5 ) ) <= 0 ) {
				maxIterations = 0;
			}
			initialInUnit = initialInUnit / scale;

		}

		initialInUnit = initialInUnit * 2;
		jQuery.style( elem, prop, initialInUnit + unit );

		// Make sure we update the tween properties later on
		valueParts = valueParts || [];
	}

	if ( valueParts ) {
		initialInUnit = +initialInUnit || +initial || 0;

		// Apply relative offset (+=/-=) if specified
		adjusted = valueParts[ 1 ] ?
			initialInUnit + ( valueParts[ 1 ] + 1 ) * valueParts[ 2 ] :
			+valueParts[ 2 ];
		if ( tween ) {
			tween.unit = unit;
			tween.start = initialInUnit;
			tween.end = adjusted;
		}
	}
	return adjusted;
}


var defaultDisplayMap = {};

function getDefaultDisplay( elem ) {
	var temp,
		doc = elem.ownerDocument,
		nodeName = elem.nodeName,
		display = defaultDisplayMap[ nodeName ];

	if ( display ) {
		return display;
	}

	temp = doc.body.appendChild( doc.createElement( nodeName ) );
	display = jQuery.css( temp, "display" );

	temp.parentNode.removeChild( temp );

	if ( display === "none" ) {
		display = "block";
	}
	defaultDisplayMap[ nodeName ] = display;

	return display;
}

function showHide( elements, show ) {
	var display, elem,
		values = [],
		index = 0,
		length = elements.length;

	// Determine new display value for elements that need to change
	for ( ; index < length; index++ ) {
		elem = elements[ index ];
		if ( !elem.style ) {
			continue;
		}

		display = elem.style.display;
		if ( show ) {

			// Since we force visibility upon cascade-hidden elements, an immediate (and slow)
			// check is required in this first loop unless we have a nonempty display value (either
			// inline or about-to-be-restored)
			if ( display === "none" ) {
				values[ index ] = dataPriv.get( elem, "display" ) || null;
				if ( !values[ index ] ) {
					elem.style.display = "";
				}
			}
			if ( elem.style.display === "" && isHiddenWithinTree( elem ) ) {
				values[ index ] = getDefaultDisplay( elem );
			}
		} else {
			if ( display !== "none" ) {
				values[ index ] = "none";

				// Remember what we're overwriting
				dataPriv.set( elem, "display", display );
			}
		}
	}

	// Set the display of the elements in a second loop to avoid constant reflow
	for ( index = 0; index < length; index++ ) {
		if ( values[ index ] != null ) {
			elements[ index ].style.display = values[ index ];
		}
	}

	return elements;
}

jQuery.fn.extend( {
	show: function() {
		return showHide( this, true );
	},
	hide: function() {
		return showHide( this );
	},
	toggle: function( state ) {
		if ( typeof state === "boolean" ) {
			return state ? this.show() : this.hide();
		}

		return this.each( function() {
			if ( isHiddenWithinTree( this ) ) {
				jQuery( this ).show();
			} else {
				jQuery( this ).hide();
			}
		} );
	}
} );
var rcheckableType = ( /^(?:checkbox|radio)$/i );

var rtagName = ( /<([a-z][^\/\0>\x20\t\r\n\f]*)/i );

var rscriptType = ( /^$|^module$|\/(?:java|ecma)script/i );



( function() {
	var fragment = document.createDocumentFragment(),
		div = fragment.appendChild( document.createElement( "div" ) ),
		input = document.createElement( "input" );

	// Support: Android 4.0 - 4.3 only
	// Check state lost if the name is set (#11217)
	// Support: Windows Web Apps (WWA)
	// `name` and `type` must use .setAttribute for WWA (#14901)
	input.setAttribute( "type", "radio" );
	input.setAttribute( "checked", "checked" );
	input.setAttribute( "name", "t" );

	div.appendChild( input );

	// Support: Android <=4.1 only
	// Older WebKit doesn't clone checked state correctly in fragments
	support.checkClone = div.cloneNode( true ).cloneNode( true ).lastChild.checked;

	// Support: IE <=11 only
	// Make sure textarea (and checkbox) defaultValue is properly cloned
	div.innerHTML = "<textarea>x</textarea>";
	support.noCloneChecked = !!div.cloneNode( true ).lastChild.defaultValue;

	// Support: IE <=9 only
	// IE <=9 replaces <option> tags with their contents when inserted outside of
	// the select element.
	div.innerHTML = "<option></option>";
	support.option = !!div.lastChild;
} )();


// We have to close these tags to support XHTML (#13200)
var wrapMap = {

	// XHTML parsers do not magically insert elements in the
	// same way that tag soup parsers do. So we cannot shorten
	// this by omitting <tbody> or other required elements.
	thead: [ 1, "<table>", "</table>" ],
	col: [ 2, "<table><colgroup>", "</colgroup></table>" ],
	tr: [ 2, "<table><tbody>", "</tbody></table>" ],
	td: [ 3, "<table><tbody><tr>", "</tr></tbody></table>" ],

	_default: [ 0, "", "" ]
};

wrapMap.tbody = wrapMap.tfoot = wrapMap.colgroup = wrapMap.caption = wrapMap.thead;
wrapMap.th = wrapMap.td;

// Support: IE <=9 only
if ( !support.option ) {
	wrapMap.optgroup = wrapMap.option = [ 1, "<select multiple='multiple'>", "</select>" ];
}


function getAll( context, tag ) {

	// Support: IE <=9 - 11 only
	// Use typeof to avoid zero-argument method invocation on host objects (#15151)
	var ret;

	if ( typeof context.getElementsByTagName !== "undefined" ) {
		ret = context.getElementsByTagName( tag || "*" );

	} else if ( typeof context.querySelectorAll !== "undefined" ) {
		ret = context.querySelectorAll( tag || "*" );

	} else {
		ret = [];
	}

	if ( tag === undefined || tag && nodeName( context, tag ) ) {
		return jQuery.merge( [ context ], ret );
	}

	return ret;
}


// Mark scripts as having already been evaluated
function setGlobalEval( elems, refElements ) {
	var i = 0,
		l = elems.length;

	for ( ; i < l; i++ ) {
		dataPriv.set(
			elems[ i ],
			"globalEval",
			!refElements || dataPriv.get( refElements[ i ], "globalEval" )
		);
	}
}


var rhtml = /<|&#?\w+;/;

function buildFragment( elems, context, scripts, selection, ignored ) {
	var elem, tmp, tag, wrap, attached, j,
		fragment = context.createDocumentFragment(),
		nodes = [],
		i = 0,
		l = elems.length;

	for ( ; i < l; i++ ) {
		elem = elems[ i ];

		if ( elem || elem === 0 ) {

			// Add nodes directly
			if ( toType( elem ) === "object" ) {

				// Support: Android <=4.0 only, PhantomJS 1 only
				// push.apply(_, arraylike) throws on ancient WebKit
				jQuery.merge( nodes, elem.nodeType ? [ elem ] : elem );

			// Convert non-html into a text node
			} else if ( !rhtml.test( elem ) ) {
				nodes.push( context.createTextNode( elem ) );

			// Convert html into DOM nodes
			} else {
				tmp = tmp || fragment.appendChild( context.createElement( "div" ) );

				// Deserialize a standard representation
				tag = ( rtagName.exec( elem ) || [ "", "" ] )[ 1 ].toLowerCase();
				wrap = wrapMap[ tag ] || wrapMap._default;
				tmp.innerHTML = wrap[ 1 ] + jQuery.htmlPrefilter( elem ) + wrap[ 2 ];

				// Descend through wrappers to the right content
				j = wrap[ 0 ];
				while ( j-- ) {
					tmp = tmp.lastChild;
				}

				// Support: Android <=4.0 only, PhantomJS 1 only
				// push.apply(_, arraylike) throws on ancient WebKit
				jQuery.merge( nodes, tmp.childNodes );

				// Remember the top-level container
				tmp = fragment.firstChild;

				// Ensure the created nodes are orphaned (#12392)
				tmp.textContent = "";
			}
		}
	}

	// Remove wrapper from fragment
	fragment.textContent = "";

	i = 0;
	while ( ( elem = nodes[ i++ ] ) ) {

		// Skip elements already in the context collection (trac-4087)
		if ( selection && jQuery.inArray( elem, selection ) > -1 ) {
			if ( ignored ) {
				ignored.push( elem );
			}
			continue;
		}

		attached = isAttached( elem );

		// Append to fragment
		tmp = getAll( fragment.appendChild( elem ), "script" );

		// Preserve script evaluation history
		if ( attached ) {
			setGlobalEval( tmp );
		}

		// Capture executables
		if ( scripts ) {
			j = 0;
			while ( ( elem = tmp[ j++ ] ) ) {
				if ( rscriptType.test( elem.type || "" ) ) {
					scripts.push( elem );
				}
			}
		}
	}

	return fragment;
}


var rtypenamespace = /^([^.]*)(?:\.(.+)|)/;

function returnTrue() {
	return true;
}

function returnFalse() {
	return false;
}

// Support: IE <=9 - 11+
// focus() and blur() are asynchronous, except when they are no-op.
// So expect focus to be synchronous when the element is already active,
// and blur to be synchronous when the element is not already active.
// (focus and blur are always synchronous in other supported browsers,
// this just defines when we can count on it).
function expectSync( elem, type ) {
	return ( elem === safeActiveElement() ) === ( type === "focus" );
}

// Support: IE <=9 only
// Accessing document.activeElement can throw unexpectedly
// https://bugs.jquery.com/ticket/13393
function safeActiveElement() {
	try {
		return document.activeElement;
	} catch ( err ) { }
}

function on( elem, types, selector, data, fn, one ) {
	var origFn, type;

	// Types can be a map of types/handlers
	if ( typeof types === "object" ) {

		// ( types-Object, selector, data )
		if ( typeof selector !== "string" ) {

			// ( types-Object, data )
			data = data || selector;
			selector = undefined;
		}
		for ( type in types ) {
			on( elem, type, selector, data, types[ type ], one );
		}
		return elem;
	}

	if ( data == null && fn == null ) {

		// ( types, fn )
		fn = selector;
		data = selector = undefined;
	} else if ( fn == null ) {
		if ( typeof selector === "string" ) {

			// ( types, selector, fn )
			fn = data;
			data = undefined;
		} else {

			// ( types, data, fn )
			fn = data;
			data = selector;
			selector = undefined;
		}
	}
	if ( fn === false ) {
		fn = returnFalse;
	} else if ( !fn ) {
		return elem;
	}

	if ( one === 1 ) {
		origFn = fn;
		fn = function( event ) {

			// Can use an empty set, since event contains the info
			jQuery().off( event );
			return origFn.apply( this, arguments );
		};

		// Use same guid so caller can remove using origFn
		fn.guid = origFn.guid || ( origFn.guid = jQuery.guid++ );
	}
	return elem.each( function() {
		jQuery.event.add( this, types, fn, data, selector );
	} );
}

/*
 * Helper functions for managing events -- not part of the public interface.
 * Props to Dean Edwards' addEvent library for many of the ideas.
 */
jQuery.event = {

	global: {},

	add: function( elem, types, handler, data, selector ) {

		var handleObjIn, eventHandle, tmp,
			events, t, handleObj,
			special, handlers, type, namespaces, origType,
			elemData = dataPriv.get( elem );

		// Only attach events to objects that accept data
		if ( !acceptData( elem ) ) {
			return;
		}

		// Caller can pass in an object of custom data in lieu of the handler
		if ( handler.handler ) {
			handleObjIn = handler;
			handler = handleObjIn.handler;
			selector = handleObjIn.selector;
		}

		// Ensure that invalid selectors throw exceptions at attach time
		// Evaluate against documentElement in case elem is a non-element node (e.g., document)
		if ( selector ) {
			jQuery.find.matchesSelector( documentElement, selector );
		}

		// Make sure that the handler has a unique ID, used to find/remove it later
		if ( !handler.guid ) {
			handler.guid = jQuery.guid++;
		}

		// Init the element's event structure and main handler, if this is the first
		if ( !( events = elemData.events ) ) {
			events = elemData.events = Object.create( null );
		}
		if ( !( eventHandle = elemData.handle ) ) {
			eventHandle = elemData.handle = function( e ) {

				// Discard the second event of a jQuery.event.trigger() and
				// when an event is called after a page has unloaded
				return typeof jQuery !== "undefined" && jQuery.event.triggered !== e.type ?
					jQuery.event.dispatch.apply( elem, arguments ) : undefined;
			};
		}

		// Handle multiple events separated by a space
		types = ( types || "" ).match( rnothtmlwhite ) || [ "" ];
		t = types.length;
		while ( t-- ) {
			tmp = rtypenamespace.exec( types[ t ] ) || [];
			type = origType = tmp[ 1 ];
			namespaces = ( tmp[ 2 ] || "" ).split( "." ).sort();

			// There *must* be a type, no attaching namespace-only handlers
			if ( !type ) {
				continue;
			}

			// If event changes its type, use the special event handlers for the changed type
			special = jQuery.event.special[ type ] || {};

			// If selector defined, determine special event api type, otherwise given type
			type = ( selector ? special.delegateType : special.bindType ) || type;

			// Update special based on newly reset type
			special = jQuery.event.special[ type ] || {};

			// handleObj is passed to all event handlers
			handleObj = jQuery.extend( {
				type: type,
				origType: origType,
				data: data,
				handler: handler,
				guid: handler.guid,
				selector: selector,
				needsContext: selector && jQuery.expr.match.needsContext.test( selector ),
				namespace: namespaces.join( "." )
			}, handleObjIn );

			// Init the event handler queue if we're the first
			if ( !( handlers = events[ type ] ) ) {
				handlers = events[ type ] = [];
				handlers.delegateCount = 0;

				// Only use addEventListener if the special events handler returns false
				if ( !special.setup ||
					special.setup.call( elem, data, namespaces, eventHandle ) === false ) {

					if ( elem.addEventListener ) {
						elem.addEventListener( type, eventHandle );
					}
				}
			}

			if ( special.add ) {
				special.add.call( elem, handleObj );

				if ( !handleObj.handler.guid ) {
					handleObj.handler.guid = handler.guid;
				}
			}

			// Add to the element's handler list, delegates in front
			if ( selector ) {
				handlers.splice( handlers.delegateCount++, 0, handleObj );
			} else {
				handlers.push( handleObj );
			}

			// Keep track of which events have ever been used, for event optimization
			jQuery.event.global[ type ] = true;
		}

	},

	// Detach an event or set of events from an element
	remove: function( elem, types, handler, selector, mappedTypes ) {

		var j, origCount, tmp,
			events, t, handleObj,
			special, handlers, type, namespaces, origType,
			elemData = dataPriv.hasData( elem ) && dataPriv.get( elem );

		if ( !elemData || !( events = elemData.events ) ) {
			return;
		}

		// Once for each type.namespace in types; type may be omitted
		types = ( types || "" ).match( rnothtmlwhite ) || [ "" ];
		t = types.length;
		while ( t-- ) {
			tmp = rtypenamespace.exec( types[ t ] ) || [];
			type = origType = tmp[ 1 ];
			namespaces = ( tmp[ 2 ] || "" ).split( "." ).sort();

			// Unbind all events (on this namespace, if provided) for the element
			if ( !type ) {
				for ( type in events ) {
					jQuery.event.remove( elem, type + types[ t ], handler, selector, true );
				}
				continue;
			}

			special = jQuery.event.special[ type ] || {};
			type = ( selector ? special.delegateType : special.bindType ) || type;
			handlers = events[ type ] || [];
			tmp = tmp[ 2 ] &&
				new RegExp( "(^|\\.)" + namespaces.join( "\\.(?:.*\\.|)" ) + "(\\.|$)" );

			// Remove matching events
			origCount = j = handlers.length;
			while ( j-- ) {
				handleObj = handlers[ j ];

				if ( ( mappedTypes || origType === handleObj.origType ) &&
					( !handler || handler.guid === handleObj.guid ) &&
					( !tmp || tmp.test( handleObj.namespace ) ) &&
					( !selector || selector === handleObj.selector ||
						selector === "**" && handleObj.selector ) ) {
					handlers.splice( j, 1 );

					if ( handleObj.selector ) {
						handlers.delegateCount--;
					}
					if ( special.remove ) {
						special.remove.call( elem, handleObj );
					}
				}
			}

			// Remove generic event handler if we removed something and no more handlers exist
			// (avoids potential for endless recursion during removal of special event handlers)
			if ( origCount && !handlers.length ) {
				if ( !special.teardown ||
					special.teardown.call( elem, namespaces, elemData.handle ) === false ) {

					jQuery.removeEvent( elem, type, elemData.handle );
				}

				delete events[ type ];
			}
		}

		// Remove data and the expando if it's no longer used
		if ( jQuery.isEmptyObject( events ) ) {
			dataPriv.remove( elem, "handle events" );
		}
	},

	dispatch: function( nativeEvent ) {

		var i, j, ret, matched, handleObj, handlerQueue,
			args = new Array( arguments.length ),

			// Make a writable jQuery.Event from the native event object
			event = jQuery.event.fix( nativeEvent ),

			handlers = (
				dataPriv.get( this, "events" ) || Object.create( null )
			)[ event.type ] || [],
			special = jQuery.event.special[ event.type ] || {};

		// Use the fix-ed jQuery.Event rather than the (read-only) native event
		args[ 0 ] = event;

		for ( i = 1; i < arguments.length; i++ ) {
			args[ i ] = arguments[ i ];
		}

		event.delegateTarget = this;

		// Call the preDispatch hook for the mapped type, and let it bail if desired
		if ( special.preDispatch && special.preDispatch.call( this, event ) === false ) {
			return;
		}

		// Determine handlers
		handlerQueue = jQuery.event.handlers.call( this, event, handlers );

		// Run delegates first; they may want to stop propagation beneath us
		i = 0;
		while ( ( matched = handlerQueue[ i++ ] ) && !event.isPropagationStopped() ) {
			event.currentTarget = matched.elem;

			j = 0;
			while ( ( handleObj = matched.handlers[ j++ ] ) &&
				!event.isImmediatePropagationStopped() ) {

				// If the event is namespaced, then each handler is only invoked if it is
				// specially universal or its namespaces are a superset of the event's.
				if ( !event.rnamespace || handleObj.namespace === false ||
					event.rnamespace.test( handleObj.namespace ) ) {

					event.handleObj = handleObj;
					event.data = handleObj.data;

					ret = ( ( jQuery.event.special[ handleObj.origType ] || {} ).handle ||
						handleObj.handler ).apply( matched.elem, args );

					if ( ret !== undefined ) {
						if ( ( event.result = ret ) === false ) {
							event.preventDefault();
							event.stopPropagation();
						}
					}
				}
			}
		}

		// Call the postDispatch hook for the mapped type
		if ( special.postDispatch ) {
			special.postDispatch.call( this, event );
		}

		return event.result;
	},

	handlers: function( event, handlers ) {
		var i, handleObj, sel, matchedHandlers, matchedSelectors,
			handlerQueue = [],
			delegateCount = handlers.delegateCount,
			cur = event.target;

		// Find delegate handlers
		if ( delegateCount &&

			// Support: IE <=9
			// Black-hole SVG <use> instance trees (trac-13180)
			cur.nodeType &&

			// Support: Firefox <=42
			// Suppress spec-violating clicks indicating a non-primary pointer button (trac-3861)
			// https://www.w3.org/TR/DOM-Level-3-Events/#event-type-click
			// Support: IE 11 only
			// ...but not arrow key "clicks" of radio inputs, which can have `button` -1 (gh-2343)
			!( event.type === "click" && event.button >= 1 ) ) {

			for ( ; cur !== this; cur = cur.parentNode || this ) {

				// Don't check non-elements (#13208)
				// Don't process clicks on disabled elements (#6911, #8165, #11382, #11764)
				if ( cur.nodeType === 1 && !( event.type === "click" && cur.disabled === true ) ) {
					matchedHandlers = [];
					matchedSelectors = {};
					for ( i = 0; i < delegateCount; i++ ) {
						handleObj = handlers[ i ];

						// Don't conflict with Object.prototype properties (#13203)
						sel = handleObj.selector + " ";

						if ( matchedSelectors[ sel ] === undefined ) {
							matchedSelectors[ sel ] = handleObj.needsContext ?
								jQuery( sel, this ).index( cur ) > -1 :
								jQuery.find( sel, this, null, [ cur ] ).length;
						}
						if ( matchedSelectors[ sel ] ) {
							matchedHandlers.push( handleObj );
						}
					}
					if ( matchedHandlers.length ) {
						handlerQueue.push( { elem: cur, handlers: matchedHandlers } );
					}
				}
			}
		}

		// Add the remaining (directly-bound) handlers
		cur = this;
		if ( delegateCount < handlers.length ) {
			handlerQueue.push( { elem: cur, handlers: handlers.slice( delegateCount ) } );
		}

		return handlerQueue;
	},

	addProp: function( name, hook ) {
		Object.defineProperty( jQuery.Event.prototype, name, {
			enumerable: true,
			configurable: true,

			get: isFunction( hook ) ?
				function() {
					if ( this.originalEvent ) {
						return hook( this.originalEvent );
					}
				} :
				function() {
					if ( this.originalEvent ) {
						return this.originalEvent[ name ];
					}
				},

			set: function( value ) {
				Object.defineProperty( this, name, {
					enumerable: true,
					configurable: true,
					writable: true,
					value: value
				} );
			}
		} );
	},

	fix: function( originalEvent ) {
		return originalEvent[ jQuery.expando ] ?
			originalEvent :
			new jQuery.Event( originalEvent );
	},

	special: {
		load: {

			// Prevent triggered image.load events from bubbling to window.load
			noBubble: true
		},
		click: {

			// Utilize native event to ensure correct state for checkable inputs
			setup: function( data ) {

				// For mutual compressibility with _default, replace `this` access with a local var.
				// `|| data` is dead code meant only to preserve the variable through minification.
				var el = this || data;

				// Claim the first handler
				if ( rcheckableType.test( el.type ) &&
					el.click && nodeName( el, "input" ) ) {

					// dataPriv.set( el, "click", ... )
					leverageNative( el, "click", returnTrue );
				}

				// Return false to allow normal processing in the caller
				return false;
			},
			trigger: function( data ) {

				// For mutual compressibility with _default, replace `this` access with a local var.
				// `|| data` is dead code meant only to preserve the variable through minification.
				var el = this || data;

				// Force setup before triggering a click
				if ( rcheckableType.test( el.type ) &&
					el.click && nodeName( el, "input" ) ) {

					leverageNative( el, "click" );
				}

				// Return non-false to allow normal event-path propagation
				return true;
			},

			// For cross-browser consistency, suppress native .click() on links
			// Also prevent it if we're currently inside a leveraged native-event stack
			_default: function( event ) {
				var target = event.target;
				return rcheckableType.test( target.type ) &&
					target.click && nodeName( target, "input" ) &&
					dataPriv.get( target, "click" ) ||
					nodeName( target, "a" );
			}
		},

		beforeunload: {
			postDispatch: function( event ) {

				// Support: Firefox 20+
				// Firefox doesn't alert if the returnValue field is not set.
				if ( event.result !== undefined && event.originalEvent ) {
					event.originalEvent.returnValue = event.result;
				}
			}
		}
	}
};

// Ensure the presence of an event listener that handles manually-triggered
// synthetic events by interrupting progress until reinvoked in response to
// *native* events that it fires directly, ensuring that state changes have
// already occurred before other listeners are invoked.
function leverageNative( el, type, expectSync ) {

	// Missing expectSync indicates a trigger call, which must force setup through jQuery.event.add
	if ( !expectSync ) {
		if ( dataPriv.get( el, type ) === undefined ) {
			jQuery.event.add( el, type, returnTrue );
		}
		return;
	}

	// Register the controller as a special universal handler for all event namespaces
	dataPriv.set( el, type, false );
	jQuery.event.add( el, type, {
		namespace: false,
		handler: function( event ) {
			var notAsync, result,
				saved = dataPriv.get( this, type );

			if ( ( event.isTrigger & 1 ) && this[ type ] ) {

				// Interrupt processing of the outer synthetic .trigger()ed event
				// Saved data should be false in such cases, but might be a leftover capture object
				// from an async native handler (gh-4350)
				if ( !saved.length ) {

					// Store arguments for use when handling the inner native event
					// There will always be at least one argument (an event object), so this array
					// will not be confused with a leftover capture object.
					saved = slice.call( arguments );
					dataPriv.set( this, type, saved );

					// Trigger the native event and capture its result
					// Support: IE <=9 - 11+
					// focus() and blur() are asynchronous
					notAsync = expectSync( this, type );
					this[ type ]();
					result = dataPriv.get( this, type );
					if ( saved !== result || notAsync ) {
						dataPriv.set( this, type, false );
					} else {
						result = {};
					}
					if ( saved !== result ) {

						// Cancel the outer synthetic event
						event.stopImmediatePropagation();
						event.preventDefault();

						// Support: Chrome 86+
						// In Chrome, if an element having a focusout handler is blurred by
						// clicking outside of it, it invokes the handler synchronously. If
						// that handler calls `.remove()` on the element, the data is cleared,
						// leaving `result` undefined. We need to guard against this.
						return result && result.value;
					}

				// If this is an inner synthetic event for an event with a bubbling surrogate
				// (focus or blur), assume that the surrogate already propagated from triggering the
				// native event and prevent that from happening again here.
				// This technically gets the ordering wrong w.r.t. to `.trigger()` (in which the
				// bubbling surrogate propagates *after* the non-bubbling base), but that seems
				// less bad than duplication.
				} else if ( ( jQuery.event.special[ type ] || {} ).delegateType ) {
					event.stopPropagation();
				}

			// If this is a native event triggered above, everything is now in order
			// Fire an inner synthetic event with the original arguments
			} else if ( saved.length ) {

				// ...and capture the result
				dataPriv.set( this, type, {
					value: jQuery.event.trigger(

						// Support: IE <=9 - 11+
						// Extend with the prototype to reset the above stopImmediatePropagation()
						jQuery.extend( saved[ 0 ], jQuery.Event.prototype ),
						saved.slice( 1 ),
						this
					)
				} );

				// Abort handling of the native event
				event.stopImmediatePropagation();
			}
		}
	} );
}

jQuery.removeEvent = function( elem, type, handle ) {

	// This "if" is needed for plain objects
	if ( elem.removeEventListener ) {
		elem.removeEventListener( type, handle );
	}
};

jQuery.Event = function( src, props ) {

	// Allow instantiation without the 'new' keyword
	if ( !( this instanceof jQuery.Event ) ) {
		return new jQuery.Event( src, props );
	}

	// Event object
	if ( src && src.type ) {
		this.originalEvent = src;
		this.type = src.type;

		// Events bubbling up the document may have been marked as prevented
		// by a handler lower down the tree; reflect the correct value.
		this.isDefaultPrevented = src.defaultPrevented ||
				src.defaultPrevented === undefined &&

				// Support: Android <=2.3 only
				src.returnValue === false ?
			returnTrue :
			returnFalse;

		// Create target properties
		// Support: Safari <=6 - 7 only
		// Target should not be a text node (#504, #13143)
		this.target = ( src.target && src.target.nodeType === 3 ) ?
			src.target.parentNode :
			src.target;

		this.currentTarget = src.currentTarget;
		this.relatedTarget = src.relatedTarget;

	// Event type
	} else {
		this.type = src;
	}

	// Put explicitly provided properties onto the event object
	if ( props ) {
		jQuery.extend( this, props );
	}

	// Create a timestamp if incoming event doesn't have one
	this.timeStamp = src && src.timeStamp || Date.now();

	// Mark it as fixed
	this[ jQuery.expando ] = true;
};

// jQuery.Event is based on DOM3 Events as specified by the ECMAScript Language Binding
// https://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
jQuery.Event.prototype = {
	constructor: jQuery.Event,
	isDefaultPrevented: returnFalse,
	isPropagationStopped: returnFalse,
	isImmediatePropagationStopped: returnFalse,
	isSimulated: false,

	preventDefault: function() {
		var e = this.originalEvent;

		this.isDefaultPrevented = returnTrue;

		if ( e && !this.isSimulated ) {
			e.preventDefault();
		}
	},
	stopPropagation: function() {
		var e = this.originalEvent;

		this.isPropagationStopped = returnTrue;

		if ( e && !this.isSimulated ) {
			e.stopPropagation();
		}
	},
	stopImmediatePropagation: function() {
		var e = this.originalEvent;

		this.isImmediatePropagationStopped = returnTrue;

		if ( e && !this.isSimulated ) {
			e.stopImmediatePropagation();
		}

		this.stopPropagation();
	}
};

// Includes all common event props including KeyEvent and MouseEvent specific props
jQuery.each( {
	altKey: true,
	bubbles: true,
	cancelable: true,
	changedTouches: true,
	ctrlKey: true,
	detail: true,
	eventPhase: true,
	metaKey: true,
	pageX: true,
	pageY: true,
	shiftKey: true,
	view: true,
	"char": true,
	code: true,
	charCode: true,
	key: true,
	keyCode: true,
	button: true,
	buttons: true,
	clientX: true,
	clientY: true,
	offsetX: true,
	offsetY: true,
	pointerId: true,
	pointerType: true,
	screenX: true,
	screenY: true,
	targetTouches: true,
	toElement: true,
	touches: true,
	which: true
}, jQuery.event.addProp );

jQuery.each( { focus: "focusin", blur: "focusout" }, function( type, delegateType ) {
	jQuery.event.special[ type ] = {

		// Utilize native event if possible so blur/focus sequence is correct
		setup: function() {

			// Claim the first handler
			// dataPriv.set( this, "focus", ... )
			// dataPriv.set( this, "blur", ... )
			leverageNative( this, type, expectSync );

			// Return false to allow normal processing in the caller
			return false;
		},
		trigger: function() {

			// Force setup before trigger
			leverageNative( this, type );

			// Return non-false to allow normal event-path propagation
			return true;
		},

		// Suppress native focus or blur as it's already being fired
		// in leverageNative.
		_default: function() {
			return true;
		},

		delegateType: delegateType
	};
} );

// Create mouseenter/leave events using mouseover/out and event-time checks
// so that event delegation works in jQuery.
// Do the same for pointerenter/pointerleave and pointerover/pointerout
//
// Support: Safari 7 only
// Safari sends mouseenter too often; see:
// https://bugs.chromium.org/p/chromium/issues/detail?id=470258
// for the description of the bug (it existed in older Chrome versions as well).
jQuery.each( {
	mouseenter: "mouseover",
	mouseleave: "mouseout",
	pointerenter: "pointerover",
	pointerleave: "pointerout"
}, function( orig, fix ) {
	jQuery.event.special[ orig ] = {
		delegateType: fix,
		bindType: fix,

		handle: function( event ) {
			var ret,
				target = this,
				related = event.relatedTarget,
				handleObj = event.handleObj;

			// For mouseenter/leave call the handler if related is outside the target.
			// NB: No relatedTarget if the mouse left/entered the browser window
			if ( !related || ( related !== target && !jQuery.contains( target, related ) ) ) {
				event.type = handleObj.origType;
				ret = handleObj.handler.apply( this, arguments );
				event.type = fix;
			}
			return ret;
		}
	};
} );

jQuery.fn.extend( {

	on: function( types, selector, data, fn ) {
		return on( this, types, selector, data, fn );
	},
	one: function( types, selector, data, fn ) {
		return on( this, types, selector, data, fn, 1 );
	},
	off: function( types, selector, fn ) {
		var handleObj, type;
		if ( types && types.preventDefault && types.handleObj ) {

			// ( event )  dispatched jQuery.Event
			handleObj = types.handleObj;
			jQuery( types.delegateTarget ).off(
				handleObj.namespace ?
					handleObj.origType + "." + handleObj.namespace :
					handleObj.origType,
				handleObj.selector,
				handleObj.handler
			);
			return this;
		}
		if ( typeof types === "object" ) {

			// ( types-object [, selector] )
			for ( type in types ) {
				this.off( type, selector, types[ type ] );
			}
			return this;
		}
		if ( selector === false || typeof selector === "function" ) {

			// ( types [, fn] )
			fn = selector;
			selector = undefined;
		}
		if ( fn === false ) {
			fn = returnFalse;
		}
		return this.each( function() {
			jQuery.event.remove( this, types, fn, selector );
		} );
	}
} );


var

	// Support: IE <=10 - 11, Edge 12 - 13 only
	// In IE/Edge using regex groups here causes severe slowdowns.
	// See https://connect.microsoft.com/IE/feedback/details/1736512/
	rnoInnerhtml = /<script|<style|<link/i,

	// checked="checked" or checked
	rchecked = /checked\s*(?:[^=]|=\s*.checked.)/i,
	rcleanScript = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;

// Prefer a tbody over its parent table for containing new rows
function manipulationTarget( elem, content ) {
	if ( nodeName( elem, "table" ) &&
		nodeName( content.nodeType !== 11 ? content : content.firstChild, "tr" ) ) {

		return jQuery( elem ).children( "tbody" )[ 0 ] || elem;
	}

	return elem;
}

// Replace/restore the type attribute of script elements for safe DOM manipulation
function disableScript( elem ) {
	elem.type = ( elem.getAttribute( "type" ) !== null ) + "/" + elem.type;
	return elem;
}
function restoreScript( elem ) {
	if ( ( elem.type || "" ).slice( 0, 5 ) === "true/" ) {
		elem.type = elem.type.slice( 5 );
	} else {
		elem.removeAttribute( "type" );
	}

	return elem;
}

function cloneCopyEvent( src, dest ) {
	var i, l, type, pdataOld, udataOld, udataCur, events;

	if ( dest.nodeType !== 1 ) {
		return;
	}

	// 1. Copy private data: events, handlers, etc.
	if ( dataPriv.hasData( src ) ) {
		pdataOld = dataPriv.get( src );
		events = pdataOld.events;

		if ( events ) {
			dataPriv.remove( dest, "handle events" );

			for ( type in events ) {
				for ( i = 0, l = events[ type ].length; i < l; i++ ) {
					jQuery.event.add( dest, type, events[ type ][ i ] );
				}
			}
		}
	}

	// 2. Copy user data
	if ( dataUser.hasData( src ) ) {
		udataOld = dataUser.access( src );
		udataCur = jQuery.extend( {}, udataOld );

		dataUser.set( dest, udataCur );
	}
}

// Fix IE bugs, see support tests
function fixInput( src, dest ) {
	var nodeName = dest.nodeName.toLowerCase();

	// Fails to persist the checked state of a cloned checkbox or radio button.
	if ( nodeName === "input" && rcheckableType.test( src.type ) ) {
		dest.checked = src.checked;

	// Fails to return the selected option to the default selected state when cloning options
	} else if ( nodeName === "input" || nodeName === "textarea" ) {
		dest.defaultValue = src.defaultValue;
	}
}

function domManip( collection, args, callback, ignored ) {

	// Flatten any nested arrays
	args = flat( args );

	var fragment, first, scripts, hasScripts, node, doc,
		i = 0,
		l = collection.length,
		iNoClone = l - 1,
		value = args[ 0 ],
		valueIsFunction = isFunction( value );

	// We can't cloneNode fragments that contain checked, in WebKit
	if ( valueIsFunction ||
			( l > 1 && typeof value === "string" &&
				!support.checkClone && rchecked.test( value ) ) ) {
		return collection.each( function( index ) {
			var self = collection.eq( index );
			if ( valueIsFunction ) {
				args[ 0 ] = value.call( this, index, self.html() );
			}
			domManip( self, args, callback, ignored );
		} );
	}

	if ( l ) {
		fragment = buildFragment( args, collection[ 0 ].ownerDocument, false, collection, ignored );
		first = fragment.firstChild;

		if ( fragment.childNodes.length === 1 ) {
			fragment = first;
		}

		// Require either new content or an interest in ignored elements to invoke the callback
		if ( first || ignored ) {
			scripts = jQuery.map( getAll( fragment, "script" ), disableScript );
			hasScripts = scripts.length;

			// Use the original fragment for the last item
			// instead of the first because it can end up
			// being emptied incorrectly in certain situations (#8070).
			for ( ; i < l; i++ ) {
				node = fragment;

				if ( i !== iNoClone ) {
					node = jQuery.clone( node, true, true );

					// Keep references to cloned scripts for later restoration
					if ( hasScripts ) {

						// Support: Android <=4.0 only, PhantomJS 1 only
						// push.apply(_, arraylike) throws on ancient WebKit
						jQuery.merge( scripts, getAll( node, "script" ) );
					}
				}

				callback.call( collection[ i ], node, i );
			}

			if ( hasScripts ) {
				doc = scripts[ scripts.length - 1 ].ownerDocument;

				// Reenable scripts
				jQuery.map( scripts, restoreScript );

				// Evaluate executable scripts on first document insertion
				for ( i = 0; i < hasScripts; i++ ) {
					node = scripts[ i ];
					if ( rscriptType.test( node.type || "" ) &&
						!dataPriv.access( node, "globalEval" ) &&
						jQuery.contains( doc, node ) ) {

						if ( node.src && ( node.type || "" ).toLowerCase()  !== "module" ) {

							// Optional AJAX dependency, but won't run scripts if not present
							if ( jQuery._evalUrl && !node.noModule ) {
								jQuery._evalUrl( node.src, {
									nonce: node.nonce || node.getAttribute( "nonce" )
								}, doc );
							}
						} else {
							DOMEval( node.textContent.replace( rcleanScript, "" ), node, doc );
						}
					}
				}
			}
		}
	}

	return collection;
}

function remove( elem, selector, keepData ) {
	var node,
		nodes = selector ? jQuery.filter( selector, elem ) : elem,
		i = 0;

	for ( ; ( node = nodes[ i ] ) != null; i++ ) {
		if ( !keepData && node.nodeType === 1 ) {
			jQuery.cleanData( getAll( node ) );
		}

		if ( node.parentNode ) {
			if ( keepData && isAttached( node ) ) {
				setGlobalEval( getAll( node, "script" ) );
			}
			node.parentNode.removeChild( node );
		}
	}

	return elem;
}

jQuery.extend( {
	htmlPrefilter: function( html ) {
		return html;
	},

	clone: function( elem, dataAndEvents, deepDataAndEvents ) {
		var i, l, srcElements, destElements,
			clone = elem.cloneNode( true ),
			inPage = isAttached( elem );

		// Fix IE cloning issues
		if ( !support.noCloneChecked && ( elem.nodeType === 1 || elem.nodeType === 11 ) &&
				!jQuery.isXMLDoc( elem ) ) {

			// We eschew Sizzle here for performance reasons: https://jsperf.com/getall-vs-sizzle/2
			destElements = getAll( clone );
			srcElements = getAll( elem );

			for ( i = 0, l = srcElements.length; i < l; i++ ) {
				fixInput( srcElements[ i ], destElements[ i ] );
			}
		}

		// Copy the events from the original to the clone
		if ( dataAndEvents ) {
			if ( deepDataAndEvents ) {
				srcElements = srcElements || getAll( elem );
				destElements = destElements || getAll( clone );

				for ( i = 0, l = srcElements.length; i < l; i++ ) {
					cloneCopyEvent( srcElements[ i ], destElements[ i ] );
				}
			} else {
				cloneCopyEvent( elem, clone );
			}
		}

		// Preserve script evaluation history
		destElements = getAll( clone, "script" );
		if ( destElements.length > 0 ) {
			setGlobalEval( destElements, !inPage && getAll( elem, "script" ) );
		}

		// Return the cloned set
		return clone;
	},

	cleanData: function( elems ) {
		var data, elem, type,
			special = jQuery.event.special,
			i = 0;

		for ( ; ( elem = elems[ i ] ) !== undefined; i++ ) {
			if ( acceptData( elem ) ) {
				if ( ( data = elem[ dataPriv.expando ] ) ) {
					if ( data.events ) {
						for ( type in data.events ) {
							if ( special[ type ] ) {
								jQuery.event.remove( elem, type );

							// This is a shortcut to avoid jQuery.event.remove's overhead
							} else {
								jQuery.removeEvent( elem, type, data.handle );
							}
						}
					}

					// Support: Chrome <=35 - 45+
					// Assign undefined instead of using delete, see Data#remove
					elem[ dataPriv.expando ] = undefined;
				}
				if ( elem[ dataUser.expando ] ) {

					// Support: Chrome <=35 - 45+
					// Assign undefined instead of using delete, see Data#remove
					elem[ dataUser.expando ] = undefined;
				}
			}
		}
	}
} );

jQuery.fn.extend( {
	detach: function( selector ) {
		return remove( this, selector, true );
	},

	remove: function( selector ) {
		return remove( this, selector );
	},

	text: function( value ) {
		return access( this, function( value ) {
			return value === undefined ?
				jQuery.text( this ) :
				this.empty().each( function() {
					if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
						this.textContent = value;
					}
				} );
		}, null, value, arguments.length );
	},

	append: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
				var target = manipulationTarget( this, elem );
				target.appendChild( elem );
			}
		} );
	},

	prepend: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
				var target = manipulationTarget( this, elem );
				target.insertBefore( elem, target.firstChild );
			}
		} );
	},

	before: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.parentNode ) {
				this.parentNode.insertBefore( elem, this );
			}
		} );
	},

	after: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.parentNode ) {
				this.parentNode.insertBefore( elem, this.nextSibling );
			}
		} );
	},

	empty: function() {
		var elem,
			i = 0;

		for ( ; ( elem = this[ i ] ) != null; i++ ) {
			if ( elem.nodeType === 1 ) {

				// Prevent memory leaks
				jQuery.cleanData( getAll( elem, false ) );

				// Remove any remaining nodes
				elem.textContent = "";
			}
		}

		return this;
	},

	clone: function( dataAndEvents, deepDataAndEvents ) {
		dataAndEvents = dataAndEvents == null ? false : dataAndEvents;
		deepDataAndEvents = deepDataAndEvents == null ? dataAndEvents : deepDataAndEvents;

		return this.map( function() {
			return jQuery.clone( this, dataAndEvents, deepDataAndEvents );
		} );
	},

	html: function( value ) {
		return access( this, function( value ) {
			var elem = this[ 0 ] || {},
				i = 0,
				l = this.length;

			if ( value === undefined && elem.nodeType === 1 ) {
				return elem.innerHTML;
			}

			// See if we can take a shortcut and just use innerHTML
			if ( typeof value === "string" && !rnoInnerhtml.test( value ) &&
				!wrapMap[ ( rtagName.exec( value ) || [ "", "" ] )[ 1 ].toLowerCase() ] ) {

				value = jQuery.htmlPrefilter( value );

				try {
					for ( ; i < l; i++ ) {
						elem = this[ i ] || {};

						// Remove element nodes and prevent memory leaks
						if ( elem.nodeType === 1 ) {
							jQuery.cleanData( getAll( elem, false ) );
							elem.innerHTML = value;
						}
					}

					elem = 0;

				// If using innerHTML throws an exception, use the fallback method
				} catch ( e ) {}
			}

			if ( elem ) {
				this.empty().append( value );
			}
		}, null, value, arguments.length );
	},

	replaceWith: function() {
		var ignored = [];

		// Make the changes, replacing each non-ignored context element with the new content
		return domManip( this, arguments, function( elem ) {
			var parent = this.parentNode;

			if ( jQuery.inArray( this, ignored ) < 0 ) {
				jQuery.cleanData( getAll( this ) );
				if ( parent ) {
					parent.replaceChild( elem, this );
				}
			}

		// Force callback invocation
		}, ignored );
	}
} );

jQuery.each( {
	appendTo: "append",
	prependTo: "prepend",
	insertBefore: "before",
	insertAfter: "after",
	replaceAll: "replaceWith"
}, function( name, original ) {
	jQuery.fn[ name ] = function( selector ) {
		var elems,
			ret = [],
			insert = jQuery( selector ),
			last = insert.length - 1,
			i = 0;

		for ( ; i <= last; i++ ) {
			elems = i === last ? this : this.clone( true );
			jQuery( insert[ i ] )[ original ]( elems );

			// Support: Android <=4.0 only, PhantomJS 1 only
			// .get() because push.apply(_, arraylike) throws on ancient WebKit
			push.apply( ret, elems.get() );
		}

		return this.pushStack( ret );
	};
} );
var rnumnonpx = new RegExp( "^(" + pnum + ")(?!px)[a-z%]+$", "i" );

var getStyles = function( elem ) {

		// Support: IE <=11 only, Firefox <=30 (#15098, #14150)
		// IE throws on elements created in popups
		// FF meanwhile throws on frame elements through "defaultView.getComputedStyle"
		var view = elem.ownerDocument.defaultView;

		if ( !view || !view.opener ) {
			view = window;
		}

		return view.getComputedStyle( elem );
	};

var swap = function( elem, options, callback ) {
	var ret, name,
		old = {};

	// Remember the old values, and insert the new ones
	for ( name in options ) {
		old[ name ] = elem.style[ name ];
		elem.style[ name ] = options[ name ];
	}

	ret = callback.call( elem );

	// Revert the old values
	for ( name in options ) {
		elem.style[ name ] = old[ name ];
	}

	return ret;
};


var rboxStyle = new RegExp( cssExpand.join( "|" ), "i" );



( function() {

	// Executing both pixelPosition & boxSizingReliable tests require only one layout
	// so they're executed at the same time to save the second computation.
	function computeStyleTests() {

		// This is a singleton, we need to execute it only once
		if ( !div ) {
			return;
		}

		container.style.cssText = "position:absolute;left:-11111px;width:60px;" +
			"margin-top:1px;padding:0;border:0";
		div.style.cssText =
			"position:relative;display:block;box-sizing:border-box;overflow:scroll;" +
			"margin:auto;border:1px;padding:1px;" +
			"width:60%;top:1%";
		documentElement.appendChild( container ).appendChild( div );

		var divStyle = window.getComputedStyle( div );
		pixelPositionVal = divStyle.top !== "1%";

		// Support: Android 4.0 - 4.3 only, Firefox <=3 - 44
		reliableMarginLeftVal = roundPixelMeasures( divStyle.marginLeft ) === 12;

		// Support: Android 4.0 - 4.3 only, Safari <=9.1 - 10.1, iOS <=7.0 - 9.3
		// Some styles come back with percentage values, even though they shouldn't
		div.style.right = "60%";
		pixelBoxStylesVal = roundPixelMeasures( divStyle.right ) === 36;

		// Support: IE 9 - 11 only
		// Detect misreporting of content dimensions for box-sizing:border-box elements
		boxSizingReliableVal = roundPixelMeasures( divStyle.width ) === 36;

		// Support: IE 9 only
		// Detect overflow:scroll screwiness (gh-3699)
		// Support: Chrome <=64
		// Don't get tricked when zoom affects offsetWidth (gh-4029)
		div.style.position = "absolute";
		scrollboxSizeVal = roundPixelMeasures( div.offsetWidth / 3 ) === 12;

		documentElement.removeChild( container );

		// Nullify the div so it wouldn't be stored in the memory and
		// it will also be a sign that checks already performed
		div = null;
	}

	function roundPixelMeasures( measure ) {
		return Math.round( parseFloat( measure ) );
	}

	var pixelPositionVal, boxSizingReliableVal, scrollboxSizeVal, pixelBoxStylesVal,
		reliableTrDimensionsVal, reliableMarginLeftVal,
		container = document.createElement( "div" ),
		div = document.createElement( "div" );

	// Finish early in limited (non-browser) environments
	if ( !div.style ) {
		return;
	}

	// Support: IE <=9 - 11 only
	// Style of cloned element affects source element cloned (#8908)
	div.style.backgroundClip = "content-box";
	div.cloneNode( true ).style.backgroundClip = "";
	support.clearCloneStyle = div.style.backgroundClip === "content-box";

	jQuery.extend( support, {
		boxSizingReliable: function() {
			computeStyleTests();
			return boxSizingReliableVal;
		},
		pixelBoxStyles: function() {
			computeStyleTests();
			return pixelBoxStylesVal;
		},
		pixelPosition: function() {
			computeStyleTests();
			return pixelPositionVal;
		},
		reliableMarginLeft: function() {
			computeStyleTests();
			return reliableMarginLeftVal;
		},
		scrollboxSize: function() {
			computeStyleTests();
			return scrollboxSizeVal;
		},

		// Support: IE 9 - 11+, Edge 15 - 18+
		// IE/Edge misreport `getComputedStyle` of table rows with width/height
		// set in CSS while `offset*` properties report correct values.
		// Behavior in IE 9 is more subtle than in newer versions & it passes
		// some versions of this test; make sure not to make it pass there!
		//
		// Support: Firefox 70+
		// Only Firefox includes border widths
		// in computed dimensions. (gh-4529)
		reliableTrDimensions: function() {
			var table, tr, trChild, trStyle;
			if ( reliableTrDimensionsVal == null ) {
				table = document.createElement( "table" );
				tr = document.createElement( "tr" );
				trChild = document.createElement( "div" );

				table.style.cssText = "position:absolute;left:-11111px;border-collapse:separate";
				tr.style.cssText = "border:1px solid";

				// Support: Chrome 86+
				// Height set through cssText does not get applied.
				// Computed height then comes back as 0.
				tr.style.height = "1px";
				trChild.style.height = "9px";

				// Support: Android 8 Chrome 86+
				// In our bodyBackground.html iframe,
				// display for all div elements is set to "inline",
				// which causes a problem only in Android 8 Chrome 86.
				// Ensuring the div is display: block
				// gets around this issue.
				trChild.style.display = "block";

				documentElement
					.appendChild( table )
					.appendChild( tr )
					.appendChild( trChild );

				trStyle = window.getComputedStyle( tr );
				reliableTrDimensionsVal = ( parseInt( trStyle.height, 10 ) +
					parseInt( trStyle.borderTopWidth, 10 ) +
					parseInt( trStyle.borderBottomWidth, 10 ) ) === tr.offsetHeight;

				documentElement.removeChild( table );
			}
			return reliableTrDimensionsVal;
		}
	} );
} )();


function curCSS( elem, name, computed ) {
	var width, minWidth, maxWidth, ret,

		// Support: Firefox 51+
		// Retrieving style before computed somehow
		// fixes an issue with getting wrong values
		// on detached elements
		style = elem.style;

	computed = computed || getStyles( elem );

	// getPropertyValue is needed for:
	//   .css('filter') (IE 9 only, #12537)
	//   .css('--customProperty) (#3144)
	if ( computed ) {
		ret = computed.getPropertyValue( name ) || computed[ name ];

		if ( ret === "" && !isAttached( elem ) ) {
			ret = jQuery.style( elem, name );
		}

		// A tribute to the "awesome hack by Dean Edwards"
		// Android Browser returns percentage for some values,
		// but width seems to be reliably pixels.
		// This is against the CSSOM draft spec:
		// https://drafts.csswg.org/cssom/#resolved-values
		if ( !support.pixelBoxStyles() && rnumnonpx.test( ret ) && rboxStyle.test( name ) ) {

			// Remember the original values
			width = style.width;
			minWidth = style.minWidth;
			maxWidth = style.maxWidth;

			// Put in the new values to get a computed value out
			style.minWidth = style.maxWidth = style.width = ret;
			ret = computed.width;

			// Revert the changed values
			style.width = width;
			style.minWidth = minWidth;
			style.maxWidth = maxWidth;
		}
	}

	return ret !== undefined ?

		// Support: IE <=9 - 11 only
		// IE returns zIndex value as an integer.
		ret + "" :
		ret;
}


function addGetHookIf( conditionFn, hookFn ) {

	// Define the hook, we'll check on the first run if it's really needed.
	return {
		get: function() {
			if ( conditionFn() ) {

				// Hook not needed (or it's not possible to use it due
				// to missing dependency), remove it.
				delete this.get;
				return;
			}

			// Hook needed; redefine it so that the support test is not executed again.
			return ( this.get = hookFn ).apply( this, arguments );
		}
	};
}


var cssPrefixes = [ "Webkit", "Moz", "ms" ],
	emptyStyle = document.createElement( "div" ).style,
	vendorProps = {};

// Return a vendor-prefixed property or undefined
function vendorPropName( name ) {

	// Check for vendor prefixed names
	var capName = name[ 0 ].toUpperCase() + name.slice( 1 ),
		i = cssPrefixes.length;

	while ( i-- ) {
		name = cssPrefixes[ i ] + capName;
		if ( name in emptyStyle ) {
			return name;
		}
	}
}

// Return a potentially-mapped jQuery.cssProps or vendor prefixed property
function finalPropName( name ) {
	var final = jQuery.cssProps[ name ] || vendorProps[ name ];

	if ( final ) {
		return final;
	}
	if ( name in emptyStyle ) {
		return name;
	}
	return vendorProps[ name ] = vendorPropName( name ) || name;
}


var

	// Swappable if display is none or starts with table
	// except "table", "table-cell", or "table-caption"
	// See here for display values: https://developer.mozilla.org/en-US/docs/CSS/display
	rdisplayswap = /^(none|table(?!-c[ea]).+)/,
	rcustomProp = /^--/,
	cssShow = { position: "absolute", visibility: "hidden", display: "block" },
	cssNormalTransform = {
		letterSpacing: "0",
		fontWeight: "400"
	};

function setPositiveNumber( _elem, value, subtract ) {

	// Any relative (+/-) values have already been
	// normalized at this point
	var matches = rcssNum.exec( value );
	return matches ?

		// Guard against undefined "subtract", e.g., when used as in cssHooks
		Math.max( 0, matches[ 2 ] - ( subtract || 0 ) ) + ( matches[ 3 ] || "px" ) :
		value;
}

function boxModelAdjustment( elem, dimension, box, isBorderBox, styles, computedVal ) {
	var i = dimension === "width" ? 1 : 0,
		extra = 0,
		delta = 0;

	// Adjustment may not be necessary
	if ( box === ( isBorderBox ? "border" : "content" ) ) {
		return 0;
	}

	for ( ; i < 4; i += 2 ) {

		// Both box models exclude margin
		if ( box === "margin" ) {
			delta += jQuery.css( elem, box + cssExpand[ i ], true, styles );
		}

		// If we get here with a content-box, we're seeking "padding" or "border" or "margin"
		if ( !isBorderBox ) {

			// Add padding
			delta += jQuery.css( elem, "padding" + cssExpand[ i ], true, styles );

			// For "border" or "margin", add border
			if ( box !== "padding" ) {
				delta += jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );

			// But still keep track of it otherwise
			} else {
				extra += jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );
			}

		// If we get here with a border-box (content + padding + border), we're seeking "content" or
		// "padding" or "margin"
		} else {

			// For "content", subtract padding
			if ( box === "content" ) {
				delta -= jQuery.css( elem, "padding" + cssExpand[ i ], true, styles );
			}

			// For "content" or "padding", subtract border
			if ( box !== "margin" ) {
				delta -= jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );
			}
		}
	}

	// Account for positive content-box scroll gutter when requested by providing computedVal
	if ( !isBorderBox && computedVal >= 0 ) {

		// offsetWidth/offsetHeight is a rounded sum of content, padding, scroll gutter, and border
		// Assuming integer scroll gutter, subtract the rest and round down
		delta += Math.max( 0, Math.ceil(
			elem[ "offset" + dimension[ 0 ].toUpperCase() + dimension.slice( 1 ) ] -
			computedVal -
			delta -
			extra -
			0.5

		// If offsetWidth/offsetHeight is unknown, then we can't determine content-box scroll gutter
		// Use an explicit zero to avoid NaN (gh-3964)
		) ) || 0;
	}

	return delta;
}

function getWidthOrHeight( elem, dimension, extra ) {

	// Start with computed style
	var styles = getStyles( elem ),

		// To avoid forcing a reflow, only fetch boxSizing if we need it (gh-4322).
		// Fake content-box until we know it's needed to know the true value.
		boxSizingNeeded = !support.boxSizingReliable() || extra,
		isBorderBox = boxSizingNeeded &&
			jQuery.css( elem, "boxSizing", false, styles ) === "border-box",
		valueIsBorderBox = isBorderBox,

		val = curCSS( elem, dimension, styles ),
		offsetProp = "offset" + dimension[ 0 ].toUpperCase() + dimension.slice( 1 );

	// Support: Firefox <=54
	// Return a confounding non-pixel value or feign ignorance, as appropriate.
	if ( rnumnonpx.test( val ) ) {
		if ( !extra ) {
			return val;
		}
		val = "auto";
	}


	// Support: IE 9 - 11 only
	// Use offsetWidth/offsetHeight for when box sizing is unreliable.
	// In those cases, the computed value can be trusted to be border-box.
	if ( ( !support.boxSizingReliable() && isBorderBox ||

		// Support: IE 10 - 11+, Edge 15 - 18+
		// IE/Edge misreport `getComputedStyle` of table rows with width/height
		// set in CSS while `offset*` properties report correct values.
		// Interestingly, in some cases IE 9 doesn't suffer from this issue.
		!support.reliableTrDimensions() && nodeName( elem, "tr" ) ||

		// Fall back to offsetWidth/offsetHeight when value is "auto"
		// This happens for inline elements with no explicit setting (gh-3571)
		val === "auto" ||

		// Support: Android <=4.1 - 4.3 only
		// Also use offsetWidth/offsetHeight for misreported inline dimensions (gh-3602)
		!parseFloat( val ) && jQuery.css( elem, "display", false, styles ) === "inline" ) &&

		// Make sure the element is visible & connected
		elem.getClientRects().length ) {

		isBorderBox = jQuery.css( elem, "boxSizing", false, styles ) === "border-box";

		// Where available, offsetWidth/offsetHeight approximate border box dimensions.
		// Where not available (e.g., SVG), assume unreliable box-sizing and interpret the
		// retrieved value as a content box dimension.
		valueIsBorderBox = offsetProp in elem;
		if ( valueIsBorderBox ) {
			val = elem[ offsetProp ];
		}
	}

	// Normalize "" and auto
	val = parseFloat( val ) || 0;

	// Adjust for the element's box model
	return ( val +
		boxModelAdjustment(
			elem,
			dimension,
			extra || ( isBorderBox ? "border" : "content" ),
			valueIsBorderBox,
			styles,

			// Provide the current computed size to request scroll gutter calculation (gh-3589)
			val
		)
	) + "px";
}

jQuery.extend( {

	// Add in style property hooks for overriding the default
	// behavior of getting and setting a style property
	cssHooks: {
		opacity: {
			get: function( elem, computed ) {
				if ( computed ) {

					// We should always get a number back from opacity
					var ret = curCSS( elem, "opacity" );
					return ret === "" ? "1" : ret;
				}
			}
		}
	},

	// Don't automatically add "px" to these possibly-unitless properties
	cssNumber: {
		"animationIterationCount": true,
		"columnCount": true,
		"fillOpacity": true,
		"flexGrow": true,
		"flexShrink": true,
		"fontWeight": true,
		"gridArea": true,
		"gridColumn": true,
		"gridColumnEnd": true,
		"gridColumnStart": true,
		"gridRow": true,
		"gridRowEnd": true,
		"gridRowStart": true,
		"lineHeight": true,
		"opacity": true,
		"order": true,
		"orphans": true,
		"widows": true,
		"zIndex": true,
		"zoom": true
	},

	// Add in properties whose names you wish to fix before
	// setting or getting the value
	cssProps: {},

	// Get and set the style property on a DOM Node
	style: function( elem, name, value, extra ) {

		// Don't set styles on text and comment nodes
		if ( !elem || elem.nodeType === 3 || elem.nodeType === 8 || !elem.style ) {
			return;
		}

		// Make sure that we're working with the right name
		var ret, type, hooks,
			origName = camelCase( name ),
			isCustomProp = rcustomProp.test( name ),
			style = elem.style;

		// Make sure that we're working with the right name. We don't
		// want to query the value if it is a CSS custom property
		// since they are user-defined.
		if ( !isCustomProp ) {
			name = finalPropName( origName );
		}

		// Gets hook for the prefixed version, then unprefixed version
		hooks = jQuery.cssHooks[ name ] || jQuery.cssHooks[ origName ];

		// Check if we're setting a value
		if ( value !== undefined ) {
			type = typeof value;

			// Convert "+=" or "-=" to relative numbers (#7345)
			if ( type === "string" && ( ret = rcssNum.exec( value ) ) && ret[ 1 ] ) {
				value = adjustCSS( elem, name, ret );

				// Fixes bug #9237
				type = "number";
			}

			// Make sure that null and NaN values aren't set (#7116)
			if ( value == null || value !== value ) {
				return;
			}

			// If a number was passed in, add the unit (except for certain CSS properties)
			// The isCustomProp check can be removed in jQuery 4.0 when we only auto-append
			// "px" to a few hardcoded values.
			if ( type === "number" && !isCustomProp ) {
				value += ret && ret[ 3 ] || ( jQuery.cssNumber[ origName ] ? "" : "px" );
			}

			// background-* props affect original clone's values
			if ( !support.clearCloneStyle && value === "" && name.indexOf( "background" ) === 0 ) {
				style[ name ] = "inherit";
			}

			// If a hook was provided, use that value, otherwise just set the specified value
			if ( !hooks || !( "set" in hooks ) ||
				( value = hooks.set( elem, value, extra ) ) !== undefined ) {

				if ( isCustomProp ) {
					style.setProperty( name, value );
				} else {
					style[ name ] = value;
				}
			}

		} else {

			// If a hook was provided get the non-computed value from there
			if ( hooks && "get" in hooks &&
				( ret = hooks.get( elem, false, extra ) ) !== undefined ) {

				return ret;
			}

			// Otherwise just get the value from the style object
			return style[ name ];
		}
	},

	css: function( elem, name, extra, styles ) {
		var val, num, hooks,
			origName = camelCase( name ),
			isCustomProp = rcustomProp.test( name );

		// Make sure that we're working with the right name. We don't
		// want to modify the value if it is a CSS custom property
		// since they are user-defined.
		if ( !isCustomProp ) {
			name = finalPropName( origName );
		}

		// Try prefixed name followed by the unprefixed name
		hooks = jQuery.cssHooks[ name ] || jQuery.cssHooks[ origName ];

		// If a hook was provided get the computed value from there
		if ( hooks && "get" in hooks ) {
			val = hooks.get( elem, true, extra );
		}

		// Otherwise, if a way to get the computed value exists, use that
		if ( val === undefined ) {
			val = curCSS( elem, name, styles );
		}

		// Convert "normal" to computed value
		if ( val === "normal" && name in cssNormalTransform ) {
			val = cssNormalTransform[ name ];
		}

		// Make numeric if forced or a qualifier was provided and val looks numeric
		if ( extra === "" || extra ) {
			num = parseFloat( val );
			return extra === true || isFinite( num ) ? num || 0 : val;
		}

		return val;
	}
} );

jQuery.each( [ "height", "width" ], function( _i, dimension ) {
	jQuery.cssHooks[ dimension ] = {
		get: function( elem, computed, extra ) {
			if ( computed ) {

				// Certain elements can have dimension info if we invisibly show them
				// but it must have a current display style that would benefit
				return rdisplayswap.test( jQuery.css( elem, "display" ) ) &&

					// Support: Safari 8+
					// Table columns in Safari have non-zero offsetWidth & zero
					// getBoundingClientRect().width unless display is changed.
					// Support: IE <=11 only
					// Running getBoundingClientRect on a disconnected node
					// in IE throws an error.
					( !elem.getClientRects().length || !elem.getBoundingClientRect().width ) ?
					swap( elem, cssShow, function() {
						return getWidthOrHeight( elem, dimension, extra );
					} ) :
					getWidthOrHeight( elem, dimension, extra );
			}
		},

		set: function( elem, value, extra ) {
			var matches,
				styles = getStyles( elem ),

				// Only read styles.position if the test has a chance to fail
				// to avoid forcing a reflow.
				scrollboxSizeBuggy = !support.scrollboxSize() &&
					styles.position === "absolute",

				// To avoid forcing a reflow, only fetch boxSizing if we need it (gh-3991)
				boxSizingNeeded = scrollboxSizeBuggy || extra,
				isBorderBox = boxSizingNeeded &&
					jQuery.css( elem, "boxSizing", false, styles ) === "border-box",
				subtract = extra ?
					boxModelAdjustment(
						elem,
						dimension,
						extra,
						isBorderBox,
						styles
					) :
					0;

			// Account for unreliable border-box dimensions by comparing offset* to computed and
			// faking a content-box to get border and padding (gh-3699)
			if ( isBorderBox && scrollboxSizeBuggy ) {
				subtract -= Math.ceil(
					elem[ "offset" + dimension[ 0 ].toUpperCase() + dimension.slice( 1 ) ] -
					parseFloat( styles[ dimension ] ) -
					boxModelAdjustment( elem, dimension, "border", false, styles ) -
					0.5
				);
			}

			// Convert to pixels if value adjustment is needed
			if ( subtract && ( matches = rcssNum.exec( value ) ) &&
				( matches[ 3 ] || "px" ) !== "px" ) {

				elem.style[ dimension ] = value;
				value = jQuery.css( elem, dimension );
			}

			return setPositiveNumber( elem, value, subtract );
		}
	};
} );

jQuery.cssHooks.marginLeft = addGetHookIf( support.reliableMarginLeft,
	function( elem, computed ) {
		if ( computed ) {
			return ( parseFloat( curCSS( elem, "marginLeft" ) ) ||
				elem.getBoundingClientRect().left -
					swap( elem, { marginLeft: 0 }, function() {
						return elem.getBoundingClientRect().left;
					} )
			) + "px";
		}
	}
);

// These hooks are used by animate to expand properties
jQuery.each( {
	margin: "",
	padding: "",
	border: "Width"
}, function( prefix, suffix ) {
	jQuery.cssHooks[ prefix + suffix ] = {
		expand: function( value ) {
			var i = 0,
				expanded = {},

				// Assumes a single number if not a string
				parts = typeof value === "string" ? value.split( " " ) : [ value ];

			for ( ; i < 4; i++ ) {
				expanded[ prefix + cssExpand[ i ] + suffix ] =
					parts[ i ] || parts[ i - 2 ] || parts[ 0 ];
			}

			return expanded;
		}
	};

	if ( prefix !== "margin" ) {
		jQuery.cssHooks[ prefix + suffix ].set = setPositiveNumber;
	}
} );

jQuery.fn.extend( {
	css: function( name, value ) {
		return access( this, function( elem, name, value ) {
			var styles, len,
				map = {},
				i = 0;

			if ( Array.isArray( name ) ) {
				styles = getStyles( elem );
				len = name.length;

				for ( ; i < len; i++ ) {
					map[ name[ i ] ] = jQuery.css( elem, name[ i ], false, styles );
				}

				return map;
			}

			return value !== undefined ?
				jQuery.style( elem, name, value ) :
				jQuery.css( elem, name );
		}, name, value, arguments.length > 1 );
	}
} );


function Tween( elem, options, prop, end, easing ) {
	return new Tween.prototype.init( elem, options, prop, end, easing );
}
jQuery.Tween = Tween;

Tween.prototype = {
	constructor: Tween,
	init: function( elem, options, prop, end, easing, unit ) {
		this.elem = elem;
		this.prop = prop;
		this.easing = easing || jQuery.easing._default;
		this.options = options;
		this.start = this.now = this.cur();
		this.end = end;
		this.unit = unit || ( jQuery.cssNumber[ prop ] ? "" : "px" );
	},
	cur: function() {
		var hooks = Tween.propHooks[ this.prop ];

		return hooks && hooks.get ?
			hooks.get( this ) :
			Tween.propHooks._default.get( this );
	},
	run: function( percent ) {
		var eased,
			hooks = Tween.propHooks[ this.prop ];

		if ( this.options.duration ) {
			this.pos = eased = jQuery.easing[ this.easing ](
				percent, this.options.duration * percent, 0, 1, this.options.duration
			);
		} else {
			this.pos = eased = percent;
		}
		this.now = ( this.end - this.start ) * eased + this.start;

		if ( this.options.step ) {
			this.options.step.call( this.elem, this.now, this );
		}

		if ( hooks && hooks.set ) {
			hooks.set( this );
		} else {
			Tween.propHooks._default.set( this );
		}
		return this;
	}
};

Tween.prototype.init.prototype = Tween.prototype;

Tween.propHooks = {
	_default: {
		get: function( tween ) {
			var result;

			// Use a property on the element directly when it is not a DOM element,
			// or when there is no matching style property that exists.
			if ( tween.elem.nodeType !== 1 ||
				tween.elem[ tween.prop ] != null && tween.elem.style[ tween.prop ] == null ) {
				return tween.elem[ tween.prop ];
			}

			// Passing an empty string as a 3rd parameter to .css will automatically
			// attempt a parseFloat and fallback to a string if the parse fails.
			// Simple values such as "10px" are parsed to Float;
			// complex values such as "rotate(1rad)" are returned as-is.
			result = jQuery.css( tween.elem, tween.prop, "" );

			// Empty strings, null, undefined and "auto" are converted to 0.
			return !result || result === "auto" ? 0 : result;
		},
		set: function( tween ) {

			// Use step hook for back compat.
			// Use cssHook if its there.
			// Use .style if available and use plain properties where available.
			if ( jQuery.fx.step[ tween.prop ] ) {
				jQuery.fx.step[ tween.prop ]( tween );
			} else if ( tween.elem.nodeType === 1 && (
				jQuery.cssHooks[ tween.prop ] ||
					tween.elem.style[ finalPropName( tween.prop ) ] != null ) ) {
				jQuery.style( tween.elem, tween.prop, tween.now + tween.unit );
			} else {
				tween.elem[ tween.prop ] = tween.now;
			}
		}
	}
};

// Support: IE <=9 only
// Panic based approach to setting things on disconnected nodes
Tween.propHooks.scrollTop = Tween.propHooks.scrollLeft = {
	set: function( tween ) {
		if ( tween.elem.nodeType && tween.elem.parentNode ) {
			tween.elem[ tween.prop ] = tween.now;
		}
	}
};

jQuery.easing = {
	linear: function( p ) {
		return p;
	},
	swing: function( p ) {
		return 0.5 - Math.cos( p * Math.PI ) / 2;
	},
	_default: "swing"
};

jQuery.fx = Tween.prototype.init;

// Back compat <1.8 extension point
jQuery.fx.step = {};




var
	fxNow, inProgress,
	rfxtypes = /^(?:toggle|show|hide)$/,
	rrun = /queueHooks$/;

function schedule() {
	if ( inProgress ) {
		if ( document.hidden === false && window.requestAnimationFrame ) {
			window.requestAnimationFrame( schedule );
		} else {
			window.setTimeout( schedule, jQuery.fx.interval );
		}

		jQuery.fx.tick();
	}
}

// Animations created synchronously will run synchronously
function createFxNow() {
	window.setTimeout( function() {
		fxNow = undefined;
	} );
	return ( fxNow = Date.now() );
}

// Generate parameters to create a standard animation
function genFx( type, includeWidth ) {
	var which,
		i = 0,
		attrs = { height: type };

	// If we include width, step value is 1 to do all cssExpand values,
	// otherwise step value is 2 to skip over Left and Right
	includeWidth = includeWidth ? 1 : 0;
	for ( ; i < 4; i += 2 - includeWidth ) {
		which = cssExpand[ i ];
		attrs[ "margin" + which ] = attrs[ "padding" + which ] = type;
	}

	if ( includeWidth ) {
		attrs.opacity = attrs.width = type;
	}

	return attrs;
}

function createTween( value, prop, animation ) {
	var tween,
		collection = ( Animation.tweeners[ prop ] || [] ).concat( Animation.tweeners[ "*" ] ),
		index = 0,
		length = collection.length;
	for ( ; index < length; index++ ) {
		if ( ( tween = collection[ index ].call( animation, prop, value ) ) ) {

			// We're done with this property
			return tween;
		}
	}
}

function defaultPrefilter( elem, props, opts ) {
	var prop, value, toggle, hooks, oldfire, propTween, restoreDisplay, display,
		isBox = "width" in props || "height" in props,
		anim = this,
		orig = {},
		style = elem.style,
		hidden = elem.nodeType && isHiddenWithinTree( elem ),
		dataShow = dataPriv.get( elem, "fxshow" );

	// Queue-skipping animations hijack the fx hooks
	if ( !opts.queue ) {
		hooks = jQuery._queueHooks( elem, "fx" );
		if ( hooks.unqueued == null ) {
			hooks.unqueued = 0;
			oldfire = hooks.empty.fire;
			hooks.empty.fire = function() {
				if ( !hooks.unqueued ) {
					oldfire();
				}
			};
		}
		hooks.unqueued++;

		anim.always( function() {

			// Ensure the complete handler is called before this completes
			anim.always( function() {
				hooks.unqueued--;
				if ( !jQuery.queue( elem, "fx" ).length ) {
					hooks.empty.fire();
				}
			} );
		} );
	}

	// Detect show/hide animations
	for ( prop in props ) {
		value = props[ prop ];
		if ( rfxtypes.test( value ) ) {
			delete props[ prop ];
			toggle = toggle || value === "toggle";
			if ( value === ( hidden ? "hide" : "show" ) ) {

				// Pretend to be hidden if this is a "show" and
				// there is still data from a stopped show/hide
				if ( value === "show" && dataShow && dataShow[ prop ] !== undefined ) {
					hidden = true;

				// Ignore all other no-op show/hide data
				} else {
					continue;
				}
			}
			orig[ prop ] = dataShow && dataShow[ prop ] || jQuery.style( elem, prop );
		}
	}

	// Bail out if this is a no-op like .hide().hide()
	propTween = !jQuery.isEmptyObject( props );
	if ( !propTween && jQuery.isEmptyObject( orig ) ) {
		return;
	}

	// Restrict "overflow" and "display" styles during box animations
	if ( isBox && elem.nodeType === 1 ) {

		// Support: IE <=9 - 11, Edge 12 - 15
		// Record all 3 overflow attributes because IE does not infer the shorthand
		// from identically-valued overflowX and overflowY and Edge just mirrors
		// the overflowX value there.
		opts.overflow = [ style.overflow, style.overflowX, style.overflowY ];

		// Identify a display type, preferring old show/hide data over the CSS cascade
		restoreDisplay = dataShow && dataShow.display;
		if ( restoreDisplay == null ) {
			restoreDisplay = dataPriv.get( elem, "display" );
		}
		display = jQuery.css( elem, "display" );
		if ( display === "none" ) {
			if ( restoreDisplay ) {
				display = restoreDisplay;
			} else {

				// Get nonempty value(s) by temporarily forcing visibility
				showHide( [ elem ], true );
				restoreDisplay = elem.style.display || restoreDisplay;
				display = jQuery.css( elem, "display" );
				showHide( [ elem ] );
			}
		}

		// Animate inline elements as inline-block
		if ( display === "inline" || display === "inline-block" && restoreDisplay != null ) {
			if ( jQuery.css( elem, "float" ) === "none" ) {

				// Restore the original display value at the end of pure show/hide animations
				if ( !propTween ) {
					anim.done( function() {
						style.display = restoreDisplay;
					} );
					if ( restoreDisplay == null ) {
						display = style.display;
						restoreDisplay = display === "none" ? "" : display;
					}
				}
				style.display = "inline-block";
			}
		}
	}

	if ( opts.overflow ) {
		style.overflow = "hidden";
		anim.always( function() {
			style.overflow = opts.overflow[ 0 ];
			style.overflowX = opts.overflow[ 1 ];
			style.overflowY = opts.overflow[ 2 ];
		} );
	}

	// Implement show/hide animations
	propTween = false;
	for ( prop in orig ) {

		// General show/hide setup for this element animation
		if ( !propTween ) {
			if ( dataShow ) {
				if ( "hidden" in dataShow ) {
					hidden = dataShow.hidden;
				}
			} else {
				dataShow = dataPriv.access( elem, "fxshow", { display: restoreDisplay } );
			}

			// Store hidden/visible for toggle so `.stop().toggle()` "reverses"
			if ( toggle ) {
				dataShow.hidden = !hidden;
			}

			// Show elements before animating them
			if ( hidden ) {
				showHide( [ elem ], true );
			}

			/* eslint-disable no-loop-func */

			anim.done( function() {

				/* eslint-enable no-loop-func */

				// The final step of a "hide" animation is actually hiding the element
				if ( !hidden ) {
					showHide( [ elem ] );
				}
				dataPriv.remove( elem, "fxshow" );
				for ( prop in orig ) {
					jQuery.style( elem, prop, orig[ prop ] );
				}
			} );
		}

		// Per-property setup
		propTween = createTween( hidden ? dataShow[ prop ] : 0, prop, anim );
		if ( !( prop in dataShow ) ) {
			dataShow[ prop ] = propTween.start;
			if ( hidden ) {
				propTween.end = propTween.start;
				propTween.start = 0;
			}
		}
	}
}

function propFilter( props, specialEasing ) {
	var index, name, easing, value, hooks;

	// camelCase, specialEasing and expand cssHook pass
	for ( index in props ) {
		name = camelCase( index );
		easing = specialEasing[ name ];
		value = props[ index ];
		if ( Array.isArray( value ) ) {
			easing = value[ 1 ];
			value = props[ index ] = value[ 0 ];
		}

		if ( index !== name ) {
			props[ name ] = value;
			delete props[ index ];
		}

		hooks = jQuery.cssHooks[ name ];
		if ( hooks && "expand" in hooks ) {
			value = hooks.expand( value );
			delete props[ name ];

			// Not quite $.extend, this won't overwrite existing keys.
			// Reusing 'index' because we have the correct "name"
			for ( index in value ) {
				if ( !( index in props ) ) {
					props[ index ] = value[ index ];
					specialEasing[ index ] = easing;
				}
			}
		} else {
			specialEasing[ name ] = easing;
		}
	}
}

function Animation( elem, properties, options ) {
	var result,
		stopped,
		index = 0,
		length = Animation.prefilters.length,
		deferred = jQuery.Deferred().always( function() {

			// Don't match elem in the :animated selector
			delete tick.elem;
		} ),
		tick = function() {
			if ( stopped ) {
				return false;
			}
			var currentTime = fxNow || createFxNow(),
				remaining = Math.max( 0, animation.startTime + animation.duration - currentTime ),

				// Support: Android 2.3 only
				// Archaic crash bug won't allow us to use `1 - ( 0.5 || 0 )` (#12497)
				temp = remaining / animation.duration || 0,
				percent = 1 - temp,
				index = 0,
				length = animation.tweens.length;

			for ( ; index < length; index++ ) {
				animation.tweens[ index ].run( percent );
			}

			deferred.notifyWith( elem, [ animation, percent, remaining ] );

			// If there's more to do, yield
			if ( percent < 1 && length ) {
				return remaining;
			}

			// If this was an empty animation, synthesize a final progress notification
			if ( !length ) {
				deferred.notifyWith( elem, [ animation, 1, 0 ] );
			}

			// Resolve the animation and report its conclusion
			deferred.resolveWith( elem, [ animation ] );
			return false;
		},
		animation = deferred.promise( {
			elem: elem,
			props: jQuery.extend( {}, properties ),
			opts: jQuery.extend( true, {
				specialEasing: {},
				easing: jQuery.easing._default
			}, options ),
			originalProperties: properties,
			originalOptions: options,
			startTime: fxNow || createFxNow(),
			duration: options.duration,
			tweens: [],
			createTween: function( prop, end ) {
				var tween = jQuery.Tween( elem, animation.opts, prop, end,
					animation.opts.specialEasing[ prop ] || animation.opts.easing );
				animation.tweens.push( tween );
				return tween;
			},
			stop: function( gotoEnd ) {
				var index = 0,

					// If we are going to the end, we want to run all the tweens
					// otherwise we skip this part
					length = gotoEnd ? animation.tweens.length : 0;
				if ( stopped ) {
					return this;
				}
				stopped = true;
				for ( ; index < length; index++ ) {
					animation.tweens[ index ].run( 1 );
				}

				// Resolve when we played the last frame; otherwise, reject
				if ( gotoEnd ) {
					deferred.notifyWith( elem, [ animation, 1, 0 ] );
					deferred.resolveWith( elem, [ animation, gotoEnd ] );
				} else {
					deferred.rejectWith( elem, [ animation, gotoEnd ] );
				}
				return this;
			}
		} ),
		props = animation.props;

	propFilter( props, animation.opts.specialEasing );

	for ( ; index < length; index++ ) {
		result = Animation.prefilters[ index ].call( animation, elem, props, animation.opts );
		if ( result ) {
			if ( isFunction( result.stop ) ) {
				jQuery._queueHooks( animation.elem, animation.opts.queue ).stop =
					result.stop.bind( result );
			}
			return result;
		}
	}

	jQuery.map( props, createTween, animation );

	if ( isFunction( animation.opts.start ) ) {
		animation.opts.start.call( elem, animation );
	}

	// Attach callbacks from options
	animation
		.progress( animation.opts.progress )
		.done( animation.opts.done, animation.opts.complete )
		.fail( animation.opts.fail )
		.always( animation.opts.always );

	jQuery.fx.timer(
		jQuery.extend( tick, {
			elem: elem,
			anim: animation,
			queue: animation.opts.queue
		} )
	);

	return animation;
}

jQuery.Animation = jQuery.extend( Animation, {

	tweeners: {
		"*": [ function( prop, value ) {
			var tween = this.createTween( prop, value );
			adjustCSS( tween.elem, prop, rcssNum.exec( value ), tween );
			return tween;
		} ]
	},

	tweener: function( props, callback ) {
		if ( isFunction( props ) ) {
			callback = props;
			props = [ "*" ];
		} else {
			props = props.match( rnothtmlwhite );
		}

		var prop,
			index = 0,
			length = props.length;

		for ( ; index < length; index++ ) {
			prop = props[ index ];
			Animation.tweeners[ prop ] = Animation.tweeners[ prop ] || [];
			Animation.tweeners[ prop ].unshift( callback );
		}
	},

	prefilters: [ defaultPrefilter ],

	prefilter: function( callback, prepend ) {
		if ( prepend ) {
			Animation.prefilters.unshift( callback );
		} else {
			Animation.prefilters.push( callback );
		}
	}
} );

jQuery.speed = function( speed, easing, fn ) {
	var opt = speed && typeof speed === "object" ? jQuery.extend( {}, speed ) : {
		complete: fn || !fn && easing ||
			isFunction( speed ) && speed,
		duration: speed,
		easing: fn && easing || easing && !isFunction( easing ) && easing
	};

	// Go to the end state if fx are off
	if ( jQuery.fx.off ) {
		opt.duration = 0;

	} else {
		if ( typeof opt.duration !== "number" ) {
			if ( opt.duration in jQuery.fx.speeds ) {
				opt.duration = jQuery.fx.speeds[ opt.duration ];

			} else {
				opt.duration = jQuery.fx.speeds._default;
			}
		}
	}

	// Normalize opt.queue - true/undefined/null -> "fx"
	if ( opt.queue == null || opt.queue === true ) {
		opt.queue = "fx";
	}

	// Queueing
	opt.old = opt.complete;

	opt.complete = function() {
		if ( isFunction( opt.old ) ) {
			opt.old.call( this );
		}

		if ( opt.queue ) {
			jQuery.dequeue( this, opt.queue );
		}
	};

	return opt;
};

jQuery.fn.extend( {
	fadeTo: function( speed, to, easing, callback ) {

		// Show any hidden elements after setting opacity to 0
		return this.filter( isHiddenWithinTree ).css( "opacity", 0 ).show()

			// Animate to the value specified
			.end().animate( { opacity: to }, speed, easing, callback );
	},
	animate: function( prop, speed, easing, callback ) {
		var empty = jQuery.isEmptyObject( prop ),
			optall = jQuery.speed( speed, easing, callback ),
			doAnimation = function() {

				// Operate on a copy of prop so per-property easing won't be lost
				var anim = Animation( this, jQuery.extend( {}, prop ), optall );

				// Empty animations, or finishing resolves immediately
				if ( empty || dataPriv.get( this, "finish" ) ) {
					anim.stop( true );
				}
			};

		doAnimation.finish = doAnimation;

		return empty || optall.queue === false ?
			this.each( doAnimation ) :
			this.queue( optall.queue, doAnimation );
	},
	stop: function( type, clearQueue, gotoEnd ) {
		var stopQueue = function( hooks ) {
			var stop = hooks.stop;
			delete hooks.stop;
			stop( gotoEnd );
		};

		if ( typeof type !== "string" ) {
			gotoEnd = clearQueue;
			clearQueue = type;
			type = undefined;
		}
		if ( clearQueue ) {
			this.queue( type || "fx", [] );
		}

		return this.each( function() {
			var dequeue = true,
				index = type != null && type + "queueHooks",
				timers = jQuery.timers,
				data = dataPriv.get( this );

			if ( index ) {
				if ( data[ index ] && data[ index ].stop ) {
					stopQueue( data[ index ] );
				}
			} else {
				for ( index in data ) {
					if ( data[ index ] && data[ index ].stop && rrun.test( index ) ) {
						stopQueue( data[ index ] );
					}
				}
			}

			for ( index = timers.length; index--; ) {
				if ( timers[ index ].elem === this &&
					( type == null || timers[ index ].queue === type ) ) {

					timers[ index ].anim.stop( gotoEnd );
					dequeue = false;
					timers.splice( index, 1 );
				}
			}

			// Start the next in the queue if the last step wasn't forced.
			// Timers currently will call their complete callbacks, which
			// will dequeue but only if they were gotoEnd.
			if ( dequeue || !gotoEnd ) {
				jQuery.dequeue( this, type );
			}
		} );
	},
	finish: function( type ) {
		if ( type !== false ) {
			type = type || "fx";
		}
		return this.each( function() {
			var index,
				data = dataPriv.get( this ),
				queue = data[ type + "queue" ],
				hooks = data[ type + "queueHooks" ],
				timers = jQuery.timers,
				length = queue ? queue.length : 0;

			// Enable finishing flag on private data
			data.finish = true;

			// Empty the queue first
			jQuery.queue( this, type, [] );

			if ( hooks && hooks.stop ) {
				hooks.stop.call( this, true );
			}

			// Look for any active animations, and finish them
			for ( index = timers.length; index--; ) {
				if ( timers[ index ].elem === this && timers[ index ].queue === type ) {
					timers[ index ].anim.stop( true );
					timers.splice( index, 1 );
				}
			}

			// Look for any animations in the old queue and finish them
			for ( index = 0; index < length; index++ ) {
				if ( queue[ index ] && queue[ index ].finish ) {
					queue[ index ].finish.call( this );
				}
			}

			// Turn off finishing flag
			delete data.finish;
		} );
	}
} );

jQuery.each( [ "toggle", "show", "hide" ], function( _i, name ) {
	var cssFn = jQuery.fn[ name ];
	jQuery.fn[ name ] = function( speed, easing, callback ) {
		return speed == null || typeof speed === "boolean" ?
			cssFn.apply( this, arguments ) :
			this.animate( genFx( name, true ), speed, easing, callback );
	};
} );

// Generate shortcuts for custom animations
jQuery.each( {
	slideDown: genFx( "show" ),
	slideUp: genFx( "hide" ),
	slideToggle: genFx( "toggle" ),
	fadeIn: { opacity: "show" },
	fadeOut: { opacity: "hide" },
	fadeToggle: { opacity: "toggle" }
}, function( name, props ) {
	jQuery.fn[ name ] = function( speed, easing, callback ) {
		return this.animate( props, speed, easing, callback );
	};
} );

jQuery.timers = [];
jQuery.fx.tick = function() {
	var timer,
		i = 0,
		timers = jQuery.timers;

	fxNow = Date.now();

	for ( ; i < timers.length; i++ ) {
		timer = timers[ i ];

		// Run the timer and safely remove it when done (allowing for external removal)
		if ( !timer() && timers[ i ] === timer ) {
			timers.splice( i--, 1 );
		}
	}

	if ( !timers.length ) {
		jQuery.fx.stop();
	}
	fxNow = undefined;
};

jQuery.fx.timer = function( timer ) {
	jQuery.timers.push( timer );
	jQuery.fx.start();
};

jQuery.fx.interval = 13;
jQuery.fx.start = function() {
	if ( inProgress ) {
		return;
	}

	inProgress = true;
	schedule();
};

jQuery.fx.stop = function() {
	inProgress = null;
};

jQuery.fx.speeds = {
	slow: 600,
	fast: 200,

	// Default speed
	_default: 400
};


// Based off of the plugin by Clint Helfers, with permission.
// https://web.archive.org/web/20100324014747/http://blindsignals.com/index.php/2009/07/jquery-delay/
jQuery.fn.delay = function( time, type ) {
	time = jQuery.fx ? jQuery.fx.speeds[ time ] || time : time;
	type = type || "fx";

	return this.queue( type, function( next, hooks ) {
		var timeout = window.setTimeout( next, time );
		hooks.stop = function() {
			window.clearTimeout( timeout );
		};
	} );
};


( function() {
	var input = document.createElement( "input" ),
		select = document.createElement( "select" ),
		opt = select.appendChild( document.createElement( "option" ) );

	input.type = "checkbox";

	// Support: Android <=4.3 only
	// Default value for a checkbox should be "on"
	support.checkOn = input.value !== "";

	// Support: IE <=11 only
	// Must access selectedIndex to make default options select
	support.optSelected = opt.selected;

	// Support: IE <=11 only
	// An input loses its value after becoming a radio
	input = document.createElement( "input" );
	input.value = "t";
	input.type = "radio";
	support.radioValue = input.value === "t";
} )();


var boolHook,
	attrHandle = jQuery.expr.attrHandle;

jQuery.fn.extend( {
	attr: function( name, value ) {
		return access( this, jQuery.attr, name, value, arguments.length > 1 );
	},

	removeAttr: function( name ) {
		return this.each( function() {
			jQuery.removeAttr( this, name );
		} );
	}
} );

jQuery.extend( {
	attr: function( elem, name, value ) {
		var ret, hooks,
			nType = elem.nodeType;

		// Don't get/set attributes on text, comment and attribute nodes
		if ( nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		// Fallback to prop when attributes are not supported
		if ( typeof elem.getAttribute === "undefined" ) {
			return jQuery.prop( elem, name, value );
		}

		// Attribute hooks are determined by the lowercase version
		// Grab necessary hook if one is defined
		if ( nType !== 1 || !jQuery.isXMLDoc( elem ) ) {
			hooks = jQuery.attrHooks[ name.toLowerCase() ] ||
				( jQuery.expr.match.bool.test( name ) ? boolHook : undefined );
		}

		if ( value !== undefined ) {
			if ( value === null ) {
				jQuery.removeAttr( elem, name );
				return;
			}

			if ( hooks && "set" in hooks &&
				( ret = hooks.set( elem, value, name ) ) !== undefined ) {
				return ret;
			}

			elem.setAttribute( name, value + "" );
			return value;
		}

		if ( hooks && "get" in hooks && ( ret = hooks.get( elem, name ) ) !== null ) {
			return ret;
		}

		ret = jQuery.find.attr( elem, name );

		// Non-existent attributes return null, we normalize to undefined
		return ret == null ? undefined : ret;
	},

	attrHooks: {
		type: {
			set: function( elem, value ) {
				if ( !support.radioValue && value === "radio" &&
					nodeName( elem, "input" ) ) {
					var val = elem.value;
					elem.setAttribute( "type", value );
					if ( val ) {
						elem.value = val;
					}
					return value;
				}
			}
		}
	},

	removeAttr: function( elem, value ) {
		var name,
			i = 0,

			// Attribute names can contain non-HTML whitespace characters
			// https://html.spec.whatwg.org/multipage/syntax.html#attributes-2
			attrNames = value && value.match( rnothtmlwhite );

		if ( attrNames && elem.nodeType === 1 ) {
			while ( ( name = attrNames[ i++ ] ) ) {
				elem.removeAttribute( name );
			}
		}
	}
} );

// Hooks for boolean attributes
boolHook = {
	set: function( elem, value, name ) {
		if ( value === false ) {

			// Remove boolean attributes when set to false
			jQuery.removeAttr( elem, name );
		} else {
			elem.setAttribute( name, name );
		}
		return name;
	}
};

jQuery.each( jQuery.expr.match.bool.source.match( /\w+/g ), function( _i, name ) {
	var getter = attrHandle[ name ] || jQuery.find.attr;

	attrHandle[ name ] = function( elem, name, isXML ) {
		var ret, handle,
			lowercaseName = name.toLowerCase();

		if ( !isXML ) {

			// Avoid an infinite loop by temporarily removing this function from the getter
			handle = attrHandle[ lowercaseName ];
			attrHandle[ lowercaseName ] = ret;
			ret = getter( elem, name, isXML ) != null ?
				lowercaseName :
				null;
			attrHandle[ lowercaseName ] = handle;
		}
		return ret;
	};
} );




var rfocusable = /^(?:input|select|textarea|button)$/i,
	rclickable = /^(?:a|area)$/i;

jQuery.fn.extend( {
	prop: function( name, value ) {
		return access( this, jQuery.prop, name, value, arguments.length > 1 );
	},

	removeProp: function( name ) {
		return this.each( function() {
			delete this[ jQuery.propFix[ name ] || name ];
		} );
	}
} );

jQuery.extend( {
	prop: function( elem, name, value ) {
		var ret, hooks,
			nType = elem.nodeType;

		// Don't get/set properties on text, comment and attribute nodes
		if ( nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		if ( nType !== 1 || !jQuery.isXMLDoc( elem ) ) {

			// Fix name and attach hooks
			name = jQuery.propFix[ name ] || name;
			hooks = jQuery.propHooks[ name ];
		}

		if ( value !== undefined ) {
			if ( hooks && "set" in hooks &&
				( ret = hooks.set( elem, value, name ) ) !== undefined ) {
				return ret;
			}

			return ( elem[ name ] = value );
		}

		if ( hooks && "get" in hooks && ( ret = hooks.get( elem, name ) ) !== null ) {
			return ret;
		}

		return elem[ name ];
	},

	propHooks: {
		tabIndex: {
			get: function( elem ) {

				// Support: IE <=9 - 11 only
				// elem.tabIndex doesn't always return the
				// correct value when it hasn't been explicitly set
				// https://web.archive.org/web/20141116233347/http://fluidproject.org/blog/2008/01/09/getting-setting-and-removing-tabindex-values-with-javascript/
				// Use proper attribute retrieval(#12072)
				var tabindex = jQuery.find.attr( elem, "tabindex" );

				if ( tabindex ) {
					return parseInt( tabindex, 10 );
				}

				if (
					rfocusable.test( elem.nodeName ) ||
					rclickable.test( elem.nodeName ) &&
					elem.href
				) {
					return 0;
				}

				return -1;
			}
		}
	},

	propFix: {
		"for": "htmlFor",
		"class": "className"
	}
} );

// Support: IE <=11 only
// Accessing the selectedIndex property
// forces the browser to respect setting selected
// on the option
// The getter ensures a default option is selected
// when in an optgroup
// eslint rule "no-unused-expressions" is disabled for this code
// since it considers such accessions noop
if ( !support.optSelected ) {
	jQuery.propHooks.selected = {
		get: function( elem ) {

			/* eslint no-unused-expressions: "off" */

			var parent = elem.parentNode;
			if ( parent && parent.parentNode ) {
				parent.parentNode.selectedIndex;
			}
			return null;
		},
		set: function( elem ) {

			/* eslint no-unused-expressions: "off" */

			var parent = elem.parentNode;
			if ( parent ) {
				parent.selectedIndex;

				if ( parent.parentNode ) {
					parent.parentNode.selectedIndex;
				}
			}
		}
	};
}

jQuery.each( [
	"tabIndex",
	"readOnly",
	"maxLength",
	"cellSpacing",
	"cellPadding",
	"rowSpan",
	"colSpan",
	"useMap",
	"frameBorder",
	"contentEditable"
], function() {
	jQuery.propFix[ this.toLowerCase() ] = this;
} );




	// Strip and collapse whitespace according to HTML spec
	// https://infra.spec.whatwg.org/#strip-and-collapse-ascii-whitespace
	function stripAndCollapse( value ) {
		var tokens = value.match( rnothtmlwhite ) || [];
		return tokens.join( " " );
	}


function getClass( elem ) {
	return elem.getAttribute && elem.getAttribute( "class" ) || "";
}

function classesToArray( value ) {
	if ( Array.isArray( value ) ) {
		return value;
	}
	if ( typeof value === "string" ) {
		return value.match( rnothtmlwhite ) || [];
	}
	return [];
}

jQuery.fn.extend( {
	addClass: function( value ) {
		var classes, elem, cur, curValue, clazz, j, finalValue,
			i = 0;

		if ( isFunction( value ) ) {
			return this.each( function( j ) {
				jQuery( this ).addClass( value.call( this, j, getClass( this ) ) );
			} );
		}

		classes = classesToArray( value );

		if ( classes.length ) {
			while ( ( elem = this[ i++ ] ) ) {
				curValue = getClass( elem );
				cur = elem.nodeType === 1 && ( " " + stripAndCollapse( curValue ) + " " );

				if ( cur ) {
					j = 0;
					while ( ( clazz = classes[ j++ ] ) ) {
						if ( cur.indexOf( " " + clazz + " " ) < 0 ) {
							cur += clazz + " ";
						}
					}

					// Only assign if different to avoid unneeded rendering.
					finalValue = stripAndCollapse( cur );
					if ( curValue !== finalValue ) {
						elem.setAttribute( "class", finalValue );
					}
				}
			}
		}

		return this;
	},

	removeClass: function( value ) {
		var classes, elem, cur, curValue, clazz, j, finalValue,
			i = 0;

		if ( isFunction( value ) ) {
			return this.each( function( j ) {
				jQuery( this ).removeClass( value.call( this, j, getClass( this ) ) );
			} );
		}

		if ( !arguments.length ) {
			return this.attr( "class", "" );
		}

		classes = classesToArray( value );

		if ( classes.length ) {
			while ( ( elem = this[ i++ ] ) ) {
				curValue = getClass( elem );

				// This expression is here for better compressibility (see addClass)
				cur = elem.nodeType === 1 && ( " " + stripAndCollapse( curValue ) + " " );

				if ( cur ) {
					j = 0;
					while ( ( clazz = classes[ j++ ] ) ) {

						// Remove *all* instances
						while ( cur.indexOf( " " + clazz + " " ) > -1 ) {
							cur = cur.replace( " " + clazz + " ", " " );
						}
					}

					// Only assign if different to avoid unneeded rendering.
					finalValue = stripAndCollapse( cur );
					if ( curValue !== finalValue ) {
						elem.setAttribute( "class", finalValue );
					}
				}
			}
		}

		return this;
	},

	toggleClass: function( value, stateVal ) {
		var type = typeof value,
			isValidValue = type === "string" || Array.isArray( value );

		if ( typeof stateVal === "boolean" && isValidValue ) {
			return stateVal ? this.addClass( value ) : this.removeClass( value );
		}

		if ( isFunction( value ) ) {
			return this.each( function( i ) {
				jQuery( this ).toggleClass(
					value.call( this, i, getClass( this ), stateVal ),
					stateVal
				);
			} );
		}

		return this.each( function() {
			var className, i, self, classNames;

			if ( isValidValue ) {

				// Toggle individual class names
				i = 0;
				self = jQuery( this );
				classNames = classesToArray( value );

				while ( ( className = classNames[ i++ ] ) ) {

					// Check each className given, space separated list
					if ( self.hasClass( className ) ) {
						self.removeClass( className );
					} else {
						self.addClass( className );
					}
				}

			// Toggle whole class name
			} else if ( value === undefined || type === "boolean" ) {
				className = getClass( this );
				if ( className ) {

					// Store className if set
					dataPriv.set( this, "__className__", className );
				}

				// If the element has a class name or if we're passed `false`,
				// then remove the whole classname (if there was one, the above saved it).
				// Otherwise bring back whatever was previously saved (if anything),
				// falling back to the empty string if nothing was stored.
				if ( this.setAttribute ) {
					this.setAttribute( "class",
						className || value === false ?
							"" :
							dataPriv.get( this, "__className__" ) || ""
					);
				}
			}
		} );
	},

	hasClass: function( selector ) {
		var className, elem,
			i = 0;

		className = " " + selector + " ";
		while ( ( elem = this[ i++ ] ) ) {
			if ( elem.nodeType === 1 &&
				( " " + stripAndCollapse( getClass( elem ) ) + " " ).indexOf( className ) > -1 ) {
				return true;
			}
		}

		return false;
	}
} );




var rreturn = /\r/g;

jQuery.fn.extend( {
	val: function( value ) {
		var hooks, ret, valueIsFunction,
			elem = this[ 0 ];

		if ( !arguments.length ) {
			if ( elem ) {
				hooks = jQuery.valHooks[ elem.type ] ||
					jQuery.valHooks[ elem.nodeName.toLowerCase() ];

				if ( hooks &&
					"get" in hooks &&
					( ret = hooks.get( elem, "value" ) ) !== undefined
				) {
					return ret;
				}

				ret = elem.value;

				// Handle most common string cases
				if ( typeof ret === "string" ) {
					return ret.replace( rreturn, "" );
				}

				// Handle cases where value is null/undef or number
				return ret == null ? "" : ret;
			}

			return;
		}

		valueIsFunction = isFunction( value );

		return this.each( function( i ) {
			var val;

			if ( this.nodeType !== 1 ) {
				return;
			}

			if ( valueIsFunction ) {
				val = value.call( this, i, jQuery( this ).val() );
			} else {
				val = value;
			}

			// Treat null/undefined as ""; convert numbers to string
			if ( val == null ) {
				val = "";

			} else if ( typeof val === "number" ) {
				val += "";

			} else if ( Array.isArray( val ) ) {
				val = jQuery.map( val, function( value ) {
					return value == null ? "" : value + "";
				} );
			}

			hooks = jQuery.valHooks[ this.type ] || jQuery.valHooks[ this.nodeName.toLowerCase() ];

			// If set returns undefined, fall back to normal setting
			if ( !hooks || !( "set" in hooks ) || hooks.set( this, val, "value" ) === undefined ) {
				this.value = val;
			}
		} );
	}
} );

jQuery.extend( {
	valHooks: {
		option: {
			get: function( elem ) {

				var val = jQuery.find.attr( elem, "value" );
				return val != null ?
					val :

					// Support: IE <=10 - 11 only
					// option.text throws exceptions (#14686, #14858)
					// Strip and collapse whitespace
					// https://html.spec.whatwg.org/#strip-and-collapse-whitespace
					stripAndCollapse( jQuery.text( elem ) );
			}
		},
		select: {
			get: function( elem ) {
				var value, option, i,
					options = elem.options,
					index = elem.selectedIndex,
					one = elem.type === "select-one",
					values = one ? null : [],
					max = one ? index + 1 : options.length;

				if ( index < 0 ) {
					i = max;

				} else {
					i = one ? index : 0;
				}

				// Loop through all the selected options
				for ( ; i < max; i++ ) {
					option = options[ i ];

					// Support: IE <=9 only
					// IE8-9 doesn't update selected after form reset (#2551)
					if ( ( option.selected || i === index ) &&

							// Don't return options that are disabled or in a disabled optgroup
							!option.disabled &&
							( !option.parentNode.disabled ||
								!nodeName( option.parentNode, "optgroup" ) ) ) {

						// Get the specific value for the option
						value = jQuery( option ).val();

						// We don't need an array for one selects
						if ( one ) {
							return value;
						}

						// Multi-Selects return an array
						values.push( value );
					}
				}

				return values;
			},

			set: function( elem, value ) {
				var optionSet, option,
					options = elem.options,
					values = jQuery.makeArray( value ),
					i = options.length;

				while ( i-- ) {
					option = options[ i ];

					/* eslint-disable no-cond-assign */

					if ( option.selected =
						jQuery.inArray( jQuery.valHooks.option.get( option ), values ) > -1
					) {
						optionSet = true;
					}

					/* eslint-enable no-cond-assign */
				}

				// Force browsers to behave consistently when non-matching value is set
				if ( !optionSet ) {
					elem.selectedIndex = -1;
				}
				return values;
			}
		}
	}
} );

// Radios and checkboxes getter/setter
jQuery.each( [ "radio", "checkbox" ], function() {
	jQuery.valHooks[ this ] = {
		set: function( elem, value ) {
			if ( Array.isArray( value ) ) {
				return ( elem.checked = jQuery.inArray( jQuery( elem ).val(), value ) > -1 );
			}
		}
	};
	if ( !support.checkOn ) {
		jQuery.valHooks[ this ].get = function( elem ) {
			return elem.getAttribute( "value" ) === null ? "on" : elem.value;
		};
	}
} );




// Return jQuery for attributes-only inclusion


support.focusin = "onfocusin" in window;


var rfocusMorph = /^(?:focusinfocus|focusoutblur)$/,
	stopPropagationCallback = function( e ) {
		e.stopPropagation();
	};

jQuery.extend( jQuery.event, {

	trigger: function( event, data, elem, onlyHandlers ) {

		var i, cur, tmp, bubbleType, ontype, handle, special, lastElement,
			eventPath = [ elem || document ],
			type = hasOwn.call( event, "type" ) ? event.type : event,
			namespaces = hasOwn.call( event, "namespace" ) ? event.namespace.split( "." ) : [];

		cur = lastElement = tmp = elem = elem || document;

		// Don't do events on text and comment nodes
		if ( elem.nodeType === 3 || elem.nodeType === 8 ) {
			return;
		}

		// focus/blur morphs to focusin/out; ensure we're not firing them right now
		if ( rfocusMorph.test( type + jQuery.event.triggered ) ) {
			return;
		}

		if ( type.indexOf( "." ) > -1 ) {

			// Namespaced trigger; create a regexp to match event type in handle()
			namespaces = type.split( "." );
			type = namespaces.shift();
			namespaces.sort();
		}
		ontype = type.indexOf( ":" ) < 0 && "on" + type;

		// Caller can pass in a jQuery.Event object, Object, or just an event type string
		event = event[ jQuery.expando ] ?
			event :
			new jQuery.Event( type, typeof event === "object" && event );

		// Trigger bitmask: & 1 for native handlers; & 2 for jQuery (always true)
		event.isTrigger = onlyHandlers ? 2 : 3;
		event.namespace = namespaces.join( "." );
		event.rnamespace = event.namespace ?
			new RegExp( "(^|\\.)" + namespaces.join( "\\.(?:.*\\.|)" ) + "(\\.|$)" ) :
			null;

		// Clean up the event in case it is being reused
		event.result = undefined;
		if ( !event.target ) {
			event.target = elem;
		}

		// Clone any incoming data and prepend the event, creating the handler arg list
		data = data == null ?
			[ event ] :
			jQuery.makeArray( data, [ event ] );

		// Allow special events to draw outside the lines
		special = jQuery.event.special[ type ] || {};
		if ( !onlyHandlers && special.trigger && special.trigger.apply( elem, data ) === false ) {
			return;
		}

		// Determine event propagation path in advance, per W3C events spec (#9951)
		// Bubble up to document, then to window; watch for a global ownerDocument var (#9724)
		if ( !onlyHandlers && !special.noBubble && !isWindow( elem ) ) {

			bubbleType = special.delegateType || type;
			if ( !rfocusMorph.test( bubbleType + type ) ) {
				cur = cur.parentNode;
			}
			for ( ; cur; cur = cur.parentNode ) {
				eventPath.push( cur );
				tmp = cur;
			}

			// Only add window if we got to document (e.g., not plain obj or detached DOM)
			if ( tmp === ( elem.ownerDocument || document ) ) {
				eventPath.push( tmp.defaultView || tmp.parentWindow || window );
			}
		}

		// Fire handlers on the event path
		i = 0;
		while ( ( cur = eventPath[ i++ ] ) && !event.isPropagationStopped() ) {
			lastElement = cur;
			event.type = i > 1 ?
				bubbleType :
				special.bindType || type;

			// jQuery handler
			handle = ( dataPriv.get( cur, "events" ) || Object.create( null ) )[ event.type ] &&
				dataPriv.get( cur, "handle" );
			if ( handle ) {
				handle.apply( cur, data );
			}

			// Native handler
			handle = ontype && cur[ ontype ];
			if ( handle && handle.apply && acceptData( cur ) ) {
				event.result = handle.apply( cur, data );
				if ( event.result === false ) {
					event.preventDefault();
				}
			}
		}
		event.type = type;

		// If nobody prevented the default action, do it now
		if ( !onlyHandlers && !event.isDefaultPrevented() ) {

			if ( ( !special._default ||
				special._default.apply( eventPath.pop(), data ) === false ) &&
				acceptData( elem ) ) {

				// Call a native DOM method on the target with the same name as the event.
				// Don't do default actions on window, that's where global variables be (#6170)
				if ( ontype && isFunction( elem[ type ] ) && !isWindow( elem ) ) {

					// Don't re-trigger an onFOO event when we call its FOO() method
					tmp = elem[ ontype ];

					if ( tmp ) {
						elem[ ontype ] = null;
					}

					// Prevent re-triggering of the same event, since we already bubbled it above
					jQuery.event.triggered = type;

					if ( event.isPropagationStopped() ) {
						lastElement.addEventListener( type, stopPropagationCallback );
					}

					elem[ type ]();

					if ( event.isPropagationStopped() ) {
						lastElement.removeEventListener( type, stopPropagationCallback );
					}

					jQuery.event.triggered = undefined;

					if ( tmp ) {
						elem[ ontype ] = tmp;
					}
				}
			}
		}

		return event.result;
	},

	// Piggyback on a donor event to simulate a different one
	// Used only for `focus(in | out)` events
	simulate: function( type, elem, event ) {
		var e = jQuery.extend(
			new jQuery.Event(),
			event,
			{
				type: type,
				isSimulated: true
			}
		);

		jQuery.event.trigger( e, null, elem );
	}

} );

jQuery.fn.extend( {

	trigger: function( type, data ) {
		return this.each( function() {
			jQuery.event.trigger( type, data, this );
		} );
	},
	triggerHandler: function( type, data ) {
		var elem = this[ 0 ];
		if ( elem ) {
			return jQuery.event.trigger( type, data, elem, true );
		}
	}
} );


// Support: Firefox <=44
// Firefox doesn't have focus(in | out) events
// Related ticket - https://bugzilla.mozilla.org/show_bug.cgi?id=687787
//
// Support: Chrome <=48 - 49, Safari <=9.0 - 9.1
// focus(in | out) events fire after focus & blur events,
// which is spec violation - http://www.w3.org/TR/DOM-Level-3-Events/#events-focusevent-event-order
// Related ticket - https://bugs.chromium.org/p/chromium/issues/detail?id=449857
if ( !support.focusin ) {
	jQuery.each( { focus: "focusin", blur: "focusout" }, function( orig, fix ) {

		// Attach a single capturing handler on the document while someone wants focusin/focusout
		var handler = function( event ) {
			jQuery.event.simulate( fix, event.target, jQuery.event.fix( event ) );
		};

		jQuery.event.special[ fix ] = {
			setup: function() {

				// Handle: regular nodes (via `this.ownerDocument`), window
				// (via `this.document`) & document (via `this`).
				var doc = this.ownerDocument || this.document || this,
					attaches = dataPriv.access( doc, fix );

				if ( !attaches ) {
					doc.addEventListener( orig, handler, true );
				}
				dataPriv.access( doc, fix, ( attaches || 0 ) + 1 );
			},
			teardown: function() {
				var doc = this.ownerDocument || this.document || this,
					attaches = dataPriv.access( doc, fix ) - 1;

				if ( !attaches ) {
					doc.removeEventListener( orig, handler, true );
					dataPriv.remove( doc, fix );

				} else {
					dataPriv.access( doc, fix, attaches );
				}
			}
		};
	} );
}
var location = window.location;

var nonce = { guid: Date.now() };

var rquery = ( /\?/ );



// Cross-browser xml parsing
jQuery.parseXML = function( data ) {
	var xml, parserErrorElem;
	if ( !data || typeof data !== "string" ) {
		return null;
	}

	// Support: IE 9 - 11 only
	// IE throws on parseFromString with invalid input.
	try {
		xml = ( new window.DOMParser() ).parseFromString( data, "text/xml" );
	} catch ( e ) {}

	parserErrorElem = xml && xml.getElementsByTagName( "parsererror" )[ 0 ];
	if ( !xml || parserErrorElem ) {
		jQuery.error( "Invalid XML: " + (
			parserErrorElem ?
				jQuery.map( parserErrorElem.childNodes, function( el ) {
					return el.textContent;
				} ).join( "\n" ) :
				data
		) );
	}
	return xml;
};


var
	rbracket = /\[\]$/,
	rCRLF = /\r?\n/g,
	rsubmitterTypes = /^(?:submit|button|image|reset|file)$/i,
	rsubmittable = /^(?:input|select|textarea|keygen)/i;

function buildParams( prefix, obj, traditional, add ) {
	var name;

	if ( Array.isArray( obj ) ) {

		// Serialize array item.
		jQuery.each( obj, function( i, v ) {
			if ( traditional || rbracket.test( prefix ) ) {

				// Treat each array item as a scalar.
				add( prefix, v );

			} else {

				// Item is non-scalar (array or object), encode its numeric index.
				buildParams(
					prefix + "[" + ( typeof v === "object" && v != null ? i : "" ) + "]",
					v,
					traditional,
					add
				);
			}
		} );

	} else if ( !traditional && toType( obj ) === "object" ) {

		// Serialize object item.
		for ( name in obj ) {
			buildParams( prefix + "[" + name + "]", obj[ name ], traditional, add );
		}

	} else {

		// Serialize scalar item.
		add( prefix, obj );
	}
}

// Serialize an array of form elements or a set of
// key/values into a query string
jQuery.param = function( a, traditional ) {
	var prefix,
		s = [],
		add = function( key, valueOrFunction ) {

			// If value is a function, invoke it and use its return value
			var value = isFunction( valueOrFunction ) ?
				valueOrFunction() :
				valueOrFunction;

			s[ s.length ] = encodeURIComponent( key ) + "=" +
				encodeURIComponent( value == null ? "" : value );
		};

	if ( a == null ) {
		return "";
	}

	// If an array was passed in, assume that it is an array of form elements.
	if ( Array.isArray( a ) || ( a.jquery && !jQuery.isPlainObject( a ) ) ) {

		// Serialize the form elements
		jQuery.each( a, function() {
			add( this.name, this.value );
		} );

	} else {

		// If traditional, encode the "old" way (the way 1.3.2 or older
		// did it), otherwise encode params recursively.
		for ( prefix in a ) {
			buildParams( prefix, a[ prefix ], traditional, add );
		}
	}

	// Return the resulting serialization
	return s.join( "&" );
};

jQuery.fn.extend( {
	serialize: function() {
		return jQuery.param( this.serializeArray() );
	},
	serializeArray: function() {
		return this.map( function() {

			// Can add propHook for "elements" to filter or add form elements
			var elements = jQuery.prop( this, "elements" );
			return elements ? jQuery.makeArray( elements ) : this;
		} ).filter( function() {
			var type = this.type;

			// Use .is( ":disabled" ) so that fieldset[disabled] works
			return this.name && !jQuery( this ).is( ":disabled" ) &&
				rsubmittable.test( this.nodeName ) && !rsubmitterTypes.test( type ) &&
				( this.checked || !rcheckableType.test( type ) );
		} ).map( function( _i, elem ) {
			var val = jQuery( this ).val();

			if ( val == null ) {
				return null;
			}

			if ( Array.isArray( val ) ) {
				return jQuery.map( val, function( val ) {
					return { name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
				} );
			}

			return { name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
		} ).get();
	}
} );


var
	r20 = /%20/g,
	rhash = /#.*$/,
	rantiCache = /([?&])_=[^&]*/,
	rheaders = /^(.*?):[ \t]*([^\r\n]*)$/mg,

	// #7653, #8125, #8152: local protocol detection
	rlocalProtocol = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
	rnoContent = /^(?:GET|HEAD)$/,
	rprotocol = /^\/\//,

	/* Prefilters
	 * 1) They are useful to introduce custom dataTypes (see ajax/jsonp.js for an example)
	 * 2) These are called:
	 *    - BEFORE asking for a transport
	 *    - AFTER param serialization (s.data is a string if s.processData is true)
	 * 3) key is the dataType
	 * 4) the catchall symbol "*" can be used
	 * 5) execution will start with transport dataType and THEN continue down to "*" if needed
	 */
	prefilters = {},

	/* Transports bindings
	 * 1) key is the dataType
	 * 2) the catchall symbol "*" can be used
	 * 3) selection will start with transport dataType and THEN go to "*" if needed
	 */
	transports = {},

	// Avoid comment-prolog char sequence (#10098); must appease lint and evade compression
	allTypes = "*/".concat( "*" ),

	// Anchor tag for parsing the document origin
	originAnchor = document.createElement( "a" );

originAnchor.href = location.href;

// Base "constructor" for jQuery.ajaxPrefilter and jQuery.ajaxTransport
function addToPrefiltersOrTransports( structure ) {

	// dataTypeExpression is optional and defaults to "*"
	return function( dataTypeExpression, func ) {

		if ( typeof dataTypeExpression !== "string" ) {
			func = dataTypeExpression;
			dataTypeExpression = "*";
		}

		var dataType,
			i = 0,
			dataTypes = dataTypeExpression.toLowerCase().match( rnothtmlwhite ) || [];

		if ( isFunction( func ) ) {

			// For each dataType in the dataTypeExpression
			while ( ( dataType = dataTypes[ i++ ] ) ) {

				// Prepend if requested
				if ( dataType[ 0 ] === "+" ) {
					dataType = dataType.slice( 1 ) || "*";
					( structure[ dataType ] = structure[ dataType ] || [] ).unshift( func );

				// Otherwise append
				} else {
					( structure[ dataType ] = structure[ dataType ] || [] ).push( func );
				}
			}
		}
	};
}

// Base inspection function for prefilters and transports
function inspectPrefiltersOrTransports( structure, options, originalOptions, jqXHR ) {

	var inspected = {},
		seekingTransport = ( structure === transports );

	function inspect( dataType ) {
		var selected;
		inspected[ dataType ] = true;
		jQuery.each( structure[ dataType ] || [], function( _, prefilterOrFactory ) {
			var dataTypeOrTransport = prefilterOrFactory( options, originalOptions, jqXHR );
			if ( typeof dataTypeOrTransport === "string" &&
				!seekingTransport && !inspected[ dataTypeOrTransport ] ) {

				options.dataTypes.unshift( dataTypeOrTransport );
				inspect( dataTypeOrTransport );
				return false;
			} else if ( seekingTransport ) {
				return !( selected = dataTypeOrTransport );
			}
		} );
		return selected;
	}

	return inspect( options.dataTypes[ 0 ] ) || !inspected[ "*" ] && inspect( "*" );
}

// A special extend for ajax options
// that takes "flat" options (not to be deep extended)
// Fixes #9887
function ajaxExtend( target, src ) {
	var key, deep,
		flatOptions = jQuery.ajaxSettings.flatOptions || {};

	for ( key in src ) {
		if ( src[ key ] !== undefined ) {
			( flatOptions[ key ] ? target : ( deep || ( deep = {} ) ) )[ key ] = src[ key ];
		}
	}
	if ( deep ) {
		jQuery.extend( true, target, deep );
	}

	return target;
}

/* Handles responses to an ajax request:
 * - finds the right dataType (mediates between content-type and expected dataType)
 * - returns the corresponding response
 */
function ajaxHandleResponses( s, jqXHR, responses ) {

	var ct, type, finalDataType, firstDataType,
		contents = s.contents,
		dataTypes = s.dataTypes;

	// Remove auto dataType and get content-type in the process
	while ( dataTypes[ 0 ] === "*" ) {
		dataTypes.shift();
		if ( ct === undefined ) {
			ct = s.mimeType || jqXHR.getResponseHeader( "Content-Type" );
		}
	}

	// Check if we're dealing with a known content-type
	if ( ct ) {
		for ( type in contents ) {
			if ( contents[ type ] && contents[ type ].test( ct ) ) {
				dataTypes.unshift( type );
				break;
			}
		}
	}

	// Check to see if we have a response for the expected dataType
	if ( dataTypes[ 0 ] in responses ) {
		finalDataType = dataTypes[ 0 ];
	} else {

		// Try convertible dataTypes
		for ( type in responses ) {
			if ( !dataTypes[ 0 ] || s.converters[ type + " " + dataTypes[ 0 ] ] ) {
				finalDataType = type;
				break;
			}
			if ( !firstDataType ) {
				firstDataType = type;
			}
		}

		// Or just use first one
		finalDataType = finalDataType || firstDataType;
	}

	// If we found a dataType
	// We add the dataType to the list if needed
	// and return the corresponding response
	if ( finalDataType ) {
		if ( finalDataType !== dataTypes[ 0 ] ) {
			dataTypes.unshift( finalDataType );
		}
		return responses[ finalDataType ];
	}
}

/* Chain conversions given the request and the original response
 * Also sets the responseXXX fields on the jqXHR instance
 */
function ajaxConvert( s, response, jqXHR, isSuccess ) {
	var conv2, current, conv, tmp, prev,
		converters = {},

		// Work with a copy of dataTypes in case we need to modify it for conversion
		dataTypes = s.dataTypes.slice();

	// Create converters map with lowercased keys
	if ( dataTypes[ 1 ] ) {
		for ( conv in s.converters ) {
			converters[ conv.toLowerCase() ] = s.converters[ conv ];
		}
	}

	current = dataTypes.shift();

	// Convert to each sequential dataType
	while ( current ) {

		if ( s.responseFields[ current ] ) {
			jqXHR[ s.responseFields[ current ] ] = response;
		}

		// Apply the dataFilter if provided
		if ( !prev && isSuccess && s.dataFilter ) {
			response = s.dataFilter( response, s.dataType );
		}

		prev = current;
		current = dataTypes.shift();

		if ( current ) {

			// There's only work to do if current dataType is non-auto
			if ( current === "*" ) {

				current = prev;

			// Convert response if prev dataType is non-auto and differs from current
			} else if ( prev !== "*" && prev !== current ) {

				// Seek a direct converter
				conv = converters[ prev + " " + current ] || converters[ "* " + current ];

				// If none found, seek a pair
				if ( !conv ) {
					for ( conv2 in converters ) {

						// If conv2 outputs current
						tmp = conv2.split( " " );
						if ( tmp[ 1 ] === current ) {

							// If prev can be converted to accepted input
							conv = converters[ prev + " " + tmp[ 0 ] ] ||
								converters[ "* " + tmp[ 0 ] ];
							if ( conv ) {

								// Condense equivalence converters
								if ( conv === true ) {
									conv = converters[ conv2 ];

								// Otherwise, insert the intermediate dataType
								} else if ( converters[ conv2 ] !== true ) {
									current = tmp[ 0 ];
									dataTypes.unshift( tmp[ 1 ] );
								}
								break;
							}
						}
					}
				}

				// Apply converter (if not an equivalence)
				if ( conv !== true ) {

					// Unless errors are allowed to bubble, catch and return them
					if ( conv && s.throws ) {
						response = conv( response );
					} else {
						try {
							response = conv( response );
						} catch ( e ) {
							return {
								state: "parsererror",
								error: conv ? e : "No conversion from " + prev + " to " + current
							};
						}
					}
				}
			}
		}
	}

	return { state: "success", data: response };
}

jQuery.extend( {

	// Counter for holding the number of active queries
	active: 0,

	// Last-Modified header cache for next request
	lastModified: {},
	etag: {},

	ajaxSettings: {
		url: location.href,
		type: "GET",
		isLocal: rlocalProtocol.test( location.protocol ),
		global: true,
		processData: true,
		async: true,
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",

		/*
		timeout: 0,
		data: null,
		dataType: null,
		username: null,
		password: null,
		cache: null,
		throws: false,
		traditional: false,
		headers: {},
		*/

		accepts: {
			"*": allTypes,
			text: "text/plain",
			html: "text/html",
			xml: "application/xml, text/xml",
			json: "application/json, text/javascript"
		},

		contents: {
			xml: /\bxml\b/,
			html: /\bhtml/,
			json: /\bjson\b/
		},

		responseFields: {
			xml: "responseXML",
			text: "responseText",
			json: "responseJSON"
		},

		// Data converters
		// Keys separate source (or catchall "*") and destination types with a single space
		converters: {

			// Convert anything to text
			"* text": String,

			// Text to html (true = no transformation)
			"text html": true,

			// Evaluate text as a json expression
			"text json": JSON.parse,

			// Parse text as xml
			"text xml": jQuery.parseXML
		},

		// For options that shouldn't be deep extended:
		// you can add your own custom options here if
		// and when you create one that shouldn't be
		// deep extended (see ajaxExtend)
		flatOptions: {
			url: true,
			context: true
		}
	},

	// Creates a full fledged settings object into target
	// with both ajaxSettings and settings fields.
	// If target is omitted, writes into ajaxSettings.
	ajaxSetup: function( target, settings ) {
		return settings ?

			// Building a settings object
			ajaxExtend( ajaxExtend( target, jQuery.ajaxSettings ), settings ) :

			// Extending ajaxSettings
			ajaxExtend( jQuery.ajaxSettings, target );
	},

	ajaxPrefilter: addToPrefiltersOrTransports( prefilters ),
	ajaxTransport: addToPrefiltersOrTransports( transports ),

	// Main method
	ajax: function( url, options ) {

		// If url is an object, simulate pre-1.5 signature
		if ( typeof url === "object" ) {
			options = url;
			url = undefined;
		}

		// Force options to be an object
		options = options || {};

		var transport,

			// URL without anti-cache param
			cacheURL,

			// Response headers
			responseHeadersString,
			responseHeaders,

			// timeout handle
			timeoutTimer,

			// Url cleanup var
			urlAnchor,

			// Request state (becomes false upon send and true upon completion)
			completed,

			// To know if global events are to be dispatched
			fireGlobals,

			// Loop variable
			i,

			// uncached part of the url
			uncached,

			// Create the final options object
			s = jQuery.ajaxSetup( {}, options ),

			// Callbacks context
			callbackContext = s.context || s,

			// Context for global events is callbackContext if it is a DOM node or jQuery collection
			globalEventContext = s.context &&
				( callbackContext.nodeType || callbackContext.jquery ) ?
				jQuery( callbackContext ) :
				jQuery.event,

			// Deferreds
			deferred = jQuery.Deferred(),
			completeDeferred = jQuery.Callbacks( "once memory" ),

			// Status-dependent callbacks
			statusCode = s.statusCode || {},

			// Headers (they are sent all at once)
			requestHeaders = {},
			requestHeadersNames = {},

			// Default abort message
			strAbort = "canceled",

			// Fake xhr
			jqXHR = {
				readyState: 0,

				// Builds headers hashtable if needed
				getResponseHeader: function( key ) {
					var match;
					if ( completed ) {
						if ( !responseHeaders ) {
							responseHeaders = {};
							while ( ( match = rheaders.exec( responseHeadersString ) ) ) {
								responseHeaders[ match[ 1 ].toLowerCase() + " " ] =
									( responseHeaders[ match[ 1 ].toLowerCase() + " " ] || [] )
										.concat( match[ 2 ] );
							}
						}
						match = responseHeaders[ key.toLowerCase() + " " ];
					}
					return match == null ? null : match.join( ", " );
				},

				// Raw string
				getAllResponseHeaders: function() {
					return completed ? responseHeadersString : null;
				},

				// Caches the header
				setRequestHeader: function( name, value ) {
					if ( completed == null ) {
						name = requestHeadersNames[ name.toLowerCase() ] =
							requestHeadersNames[ name.toLowerCase() ] || name;
						requestHeaders[ name ] = value;
					}
					return this;
				},

				// Overrides response content-type header
				overrideMimeType: function( type ) {
					if ( completed == null ) {
						s.mimeType = type;
					}
					return this;
				},

				// Status-dependent callbacks
				statusCode: function( map ) {
					var code;
					if ( map ) {
						if ( completed ) {

							// Execute the appropriate callbacks
							jqXHR.always( map[ jqXHR.status ] );
						} else {

							// Lazy-add the new callbacks in a way that preserves old ones
							for ( code in map ) {
								statusCode[ code ] = [ statusCode[ code ], map[ code ] ];
							}
						}
					}
					return this;
				},

				// Cancel the request
				abort: function( statusText ) {
					var finalText = statusText || strAbort;
					if ( transport ) {
						transport.abort( finalText );
					}
					done( 0, finalText );
					return this;
				}
			};

		// Attach deferreds
		deferred.promise( jqXHR );

		// Add protocol if not provided (prefilters might expect it)
		// Handle falsy url in the settings object (#10093: consistency with old signature)
		// We also use the url parameter if available
		s.url = ( ( url || s.url || location.href ) + "" )
			.replace( rprotocol, location.protocol + "//" );

		// Alias method option to type as per ticket #12004
		s.type = options.method || options.type || s.method || s.type;

		// Extract dataTypes list
		s.dataTypes = ( s.dataType || "*" ).toLowerCase().match( rnothtmlwhite ) || [ "" ];

		// A cross-domain request is in order when the origin doesn't match the current origin.
		if ( s.crossDomain == null ) {
			urlAnchor = document.createElement( "a" );

			// Support: IE <=8 - 11, Edge 12 - 15
			// IE throws exception on accessing the href property if url is malformed,
			// e.g. http://example.com:80x/
			try {
				urlAnchor.href = s.url;

				// Support: IE <=8 - 11 only
				// Anchor's host property isn't correctly set when s.url is relative
				urlAnchor.href = urlAnchor.href;
				s.crossDomain = originAnchor.protocol + "//" + originAnchor.host !==
					urlAnchor.protocol + "//" + urlAnchor.host;
			} catch ( e ) {

				// If there is an error parsing the URL, assume it is crossDomain,
				// it can be rejected by the transport if it is invalid
				s.crossDomain = true;
			}
		}

		// Convert data if not already a string
		if ( s.data && s.processData && typeof s.data !== "string" ) {
			s.data = jQuery.param( s.data, s.traditional );
		}

		// Apply prefilters
		inspectPrefiltersOrTransports( prefilters, s, options, jqXHR );

		// If request was aborted inside a prefilter, stop there
		if ( completed ) {
			return jqXHR;
		}

		// We can fire global events as of now if asked to
		// Don't fire events if jQuery.event is undefined in an AMD-usage scenario (#15118)
		fireGlobals = jQuery.event && s.global;

		// Watch for a new set of requests
		if ( fireGlobals && jQuery.active++ === 0 ) {
			jQuery.event.trigger( "ajaxStart" );
		}

		// Uppercase the type
		s.type = s.type.toUpperCase();

		// Determine if request has content
		s.hasContent = !rnoContent.test( s.type );

		// Save the URL in case we're toying with the If-Modified-Since
		// and/or If-None-Match header later on
		// Remove hash to simplify url manipulation
		cacheURL = s.url.replace( rhash, "" );

		// More options handling for requests with no content
		if ( !s.hasContent ) {

			// Remember the hash so we can put it back
			uncached = s.url.slice( cacheURL.length );

			// If data is available and should be processed, append data to url
			if ( s.data && ( s.processData || typeof s.data === "string" ) ) {
				cacheURL += ( rquery.test( cacheURL ) ? "&" : "?" ) + s.data;

				// #9682: remove data so that it's not used in an eventual retry
				delete s.data;
			}

			// Add or update anti-cache param if needed
			if ( s.cache === false ) {
				cacheURL = cacheURL.replace( rantiCache, "$1" );
				uncached = ( rquery.test( cacheURL ) ? "&" : "?" ) + "_=" + ( nonce.guid++ ) +
					uncached;
			}

			// Put hash and anti-cache on the URL that will be requested (gh-1732)
			s.url = cacheURL + uncached;

		// Change '%20' to '+' if this is encoded form body content (gh-2658)
		} else if ( s.data && s.processData &&
			( s.contentType || "" ).indexOf( "application/x-www-form-urlencoded" ) === 0 ) {
			s.data = s.data.replace( r20, "+" );
		}

		// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
		if ( s.ifModified ) {
			if ( jQuery.lastModified[ cacheURL ] ) {
				jqXHR.setRequestHeader( "If-Modified-Since", jQuery.lastModified[ cacheURL ] );
			}
			if ( jQuery.etag[ cacheURL ] ) {
				jqXHR.setRequestHeader( "If-None-Match", jQuery.etag[ cacheURL ] );
			}
		}

		// Set the correct header, if data is being sent
		if ( s.data && s.hasContent && s.contentType !== false || options.contentType ) {
			jqXHR.setRequestHeader( "Content-Type", s.contentType );
		}

		// Set the Accepts header for the server, depending on the dataType
		jqXHR.setRequestHeader(
			"Accept",
			s.dataTypes[ 0 ] && s.accepts[ s.dataTypes[ 0 ] ] ?
				s.accepts[ s.dataTypes[ 0 ] ] +
					( s.dataTypes[ 0 ] !== "*" ? ", " + allTypes + "; q=0.01" : "" ) :
				s.accepts[ "*" ]
		);

		// Check for headers option
		for ( i in s.headers ) {
			jqXHR.setRequestHeader( i, s.headers[ i ] );
		}

		// Allow custom headers/mimetypes and early abort
		if ( s.beforeSend &&
			( s.beforeSend.call( callbackContext, jqXHR, s ) === false || completed ) ) {

			// Abort if not done already and return
			return jqXHR.abort();
		}

		// Aborting is no longer a cancellation
		strAbort = "abort";

		// Install callbacks on deferreds
		completeDeferred.add( s.complete );
		jqXHR.done( s.success );
		jqXHR.fail( s.error );

		// Get transport
		transport = inspectPrefiltersOrTransports( transports, s, options, jqXHR );

		// If no transport, we auto-abort
		if ( !transport ) {
			done( -1, "No Transport" );
		} else {
			jqXHR.readyState = 1;

			// Send global event
			if ( fireGlobals ) {
				globalEventContext.trigger( "ajaxSend", [ jqXHR, s ] );
			}

			// If request was aborted inside ajaxSend, stop there
			if ( completed ) {
				return jqXHR;
			}

			// Timeout
			if ( s.async && s.timeout > 0 ) {
				timeoutTimer = window.setTimeout( function() {
					jqXHR.abort( "timeout" );
				}, s.timeout );
			}

			try {
				completed = false;
				transport.send( requestHeaders, done );
			} catch ( e ) {

				// Rethrow post-completion exceptions
				if ( completed ) {
					throw e;
				}

				// Propagate others as results
				done( -1, e );
			}
		}

		// Callback for when everything is done
		function done( status, nativeStatusText, responses, headers ) {
			var isSuccess, success, error, response, modified,
				statusText = nativeStatusText;

			// Ignore repeat invocations
			if ( completed ) {
				return;
			}

			completed = true;

			// Clear timeout if it exists
			if ( timeoutTimer ) {
				window.clearTimeout( timeoutTimer );
			}

			// Dereference transport for early garbage collection
			// (no matter how long the jqXHR object will be used)
			transport = undefined;

			// Cache response headers
			responseHeadersString = headers || "";

			// Set readyState
			jqXHR.readyState = status > 0 ? 4 : 0;

			// Determine if successful
			isSuccess = status >= 200 && status < 300 || status === 304;

			// Get response data
			if ( responses ) {
				response = ajaxHandleResponses( s, jqXHR, responses );
			}

			// Use a noop converter for missing script but not if jsonp
			if ( !isSuccess &&
				jQuery.inArray( "script", s.dataTypes ) > -1 &&
				jQuery.inArray( "json", s.dataTypes ) < 0 ) {
				s.converters[ "text script" ] = function() {};
			}

			// Convert no matter what (that way responseXXX fields are always set)
			response = ajaxConvert( s, response, jqXHR, isSuccess );

			// If successful, handle type chaining
			if ( isSuccess ) {

				// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
				if ( s.ifModified ) {
					modified = jqXHR.getResponseHeader( "Last-Modified" );
					if ( modified ) {
						jQuery.lastModified[ cacheURL ] = modified;
					}
					modified = jqXHR.getResponseHeader( "etag" );
					if ( modified ) {
						jQuery.etag[ cacheURL ] = modified;
					}
				}

				// if no content
				if ( status === 204 || s.type === "HEAD" ) {
					statusText = "nocontent";

				// if not modified
				} else if ( status === 304 ) {
					statusText = "notmodified";

				// If we have data, let's convert it
				} else {
					statusText = response.state;
					success = response.data;
					error = response.error;
					isSuccess = !error;
				}
			} else {

				// Extract error from statusText and normalize for non-aborts
				error = statusText;
				if ( status || !statusText ) {
					statusText = "error";
					if ( status < 0 ) {
						status = 0;
					}
				}
			}

			// Set data for the fake xhr object
			jqXHR.status = status;
			jqXHR.statusText = ( nativeStatusText || statusText ) + "";

			// Success/Error
			if ( isSuccess ) {
				deferred.resolveWith( callbackContext, [ success, statusText, jqXHR ] );
			} else {
				deferred.rejectWith( callbackContext, [ jqXHR, statusText, error ] );
			}

			// Status-dependent callbacks
			jqXHR.statusCode( statusCode );
			statusCode = undefined;

			if ( fireGlobals ) {
				globalEventContext.trigger( isSuccess ? "ajaxSuccess" : "ajaxError",
					[ jqXHR, s, isSuccess ? success : error ] );
			}

			// Complete
			completeDeferred.fireWith( callbackContext, [ jqXHR, statusText ] );

			if ( fireGlobals ) {
				globalEventContext.trigger( "ajaxComplete", [ jqXHR, s ] );

				// Handle the global AJAX counter
				if ( !( --jQuery.active ) ) {
					jQuery.event.trigger( "ajaxStop" );
				}
			}
		}

		return jqXHR;
	},

	getJSON: function( url, data, callback ) {
		return jQuery.get( url, data, callback, "json" );
	},

	getScript: function( url, callback ) {
		return jQuery.get( url, undefined, callback, "script" );
	}
} );

jQuery.each( [ "get", "post" ], function( _i, method ) {
	jQuery[ method ] = function( url, data, callback, type ) {

		// Shift arguments if data argument was omitted
		if ( isFunction( data ) ) {
			type = type || callback;
			callback = data;
			data = undefined;
		}

		// The url can be an options object (which then must have .url)
		return jQuery.ajax( jQuery.extend( {
			url: url,
			type: method,
			dataType: type,
			data: data,
			success: callback
		}, jQuery.isPlainObject( url ) && url ) );
	};
} );

jQuery.ajaxPrefilter( function( s ) {
	var i;
	for ( i in s.headers ) {
		if ( i.toLowerCase() === "content-type" ) {
			s.contentType = s.headers[ i ] || "";
		}
	}
} );


jQuery._evalUrl = function( url, options, doc ) {
	return jQuery.ajax( {
		url: url,

		// Make this explicit, since user can override this through ajaxSetup (#11264)
		type: "GET",
		dataType: "script",
		cache: true,
		async: false,
		global: false,

		// Only evaluate the response if it is successful (gh-4126)
		// dataFilter is not invoked for failure responses, so using it instead
		// of the default converter is kludgy but it works.
		converters: {
			"text script": function() {}
		},
		dataFilter: function( response ) {
			jQuery.globalEval( response, options, doc );
		}
	} );
};


jQuery.fn.extend( {
	wrapAll: function( html ) {
		var wrap;

		if ( this[ 0 ] ) {
			if ( isFunction( html ) ) {
				html = html.call( this[ 0 ] );
			}

			// The elements to wrap the target around
			wrap = jQuery( html, this[ 0 ].ownerDocument ).eq( 0 ).clone( true );

			if ( this[ 0 ].parentNode ) {
				wrap.insertBefore( this[ 0 ] );
			}

			wrap.map( function() {
				var elem = this;

				while ( elem.firstElementChild ) {
					elem = elem.firstElementChild;
				}

				return elem;
			} ).append( this );
		}

		return this;
	},

	wrapInner: function( html ) {
		if ( isFunction( html ) ) {
			return this.each( function( i ) {
				jQuery( this ).wrapInner( html.call( this, i ) );
			} );
		}

		return this.each( function() {
			var self = jQuery( this ),
				contents = self.contents();

			if ( contents.length ) {
				contents.wrapAll( html );

			} else {
				self.append( html );
			}
		} );
	},

	wrap: function( html ) {
		var htmlIsFunction = isFunction( html );

		return this.each( function( i ) {
			jQuery( this ).wrapAll( htmlIsFunction ? html.call( this, i ) : html );
		} );
	},

	unwrap: function( selector ) {
		this.parent( selector ).not( "body" ).each( function() {
			jQuery( this ).replaceWith( this.childNodes );
		} );
		return this;
	}
} );


jQuery.expr.pseudos.hidden = function( elem ) {
	return !jQuery.expr.pseudos.visible( elem );
};
jQuery.expr.pseudos.visible = function( elem ) {
	return !!( elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length );
};




jQuery.ajaxSettings.xhr = function() {
	try {
		return new window.XMLHttpRequest();
	} catch ( e ) {}
};

var xhrSuccessStatus = {

		// File protocol always yields status code 0, assume 200
		0: 200,

		// Support: IE <=9 only
		// #1450: sometimes IE returns 1223 when it should be 204
		1223: 204
	},
	xhrSupported = jQuery.ajaxSettings.xhr();

support.cors = !!xhrSupported && ( "withCredentials" in xhrSupported );
support.ajax = xhrSupported = !!xhrSupported;

jQuery.ajaxTransport( function( options ) {
	var callback, errorCallback;

	// Cross domain only allowed if supported through XMLHttpRequest
	if ( support.cors || xhrSupported && !options.crossDomain ) {
		return {
			send: function( headers, complete ) {
				var i,
					xhr = options.xhr();

				xhr.open(
					options.type,
					options.url,
					options.async,
					options.username,
					options.password
				);

				// Apply custom fields if provided
				if ( options.xhrFields ) {
					for ( i in options.xhrFields ) {
						xhr[ i ] = options.xhrFields[ i ];
					}
				}

				// Override mime type if needed
				if ( options.mimeType && xhr.overrideMimeType ) {
					xhr.overrideMimeType( options.mimeType );
				}

				// X-Requested-With header
				// For cross-domain requests, seeing as conditions for a preflight are
				// akin to a jigsaw puzzle, we simply never set it to be sure.
				// (it can always be set on a per-request basis or even using ajaxSetup)
				// For same-domain requests, won't change header if already provided.
				if ( !options.crossDomain && !headers[ "X-Requested-With" ] ) {
					headers[ "X-Requested-With" ] = "XMLHttpRequest";
				}

				// Set headers
				for ( i in headers ) {
					xhr.setRequestHeader( i, headers[ i ] );
				}

				// Callback
				callback = function( type ) {
					return function() {
						if ( callback ) {
							callback = errorCallback = xhr.onload =
								xhr.onerror = xhr.onabort = xhr.ontimeout =
									xhr.onreadystatechange = null;

							if ( type === "abort" ) {
								xhr.abort();
							} else if ( type === "error" ) {

								// Support: IE <=9 only
								// On a manual native abort, IE9 throws
								// errors on any property access that is not readyState
								if ( typeof xhr.status !== "number" ) {
									complete( 0, "error" );
								} else {
									complete(

										// File: protocol always yields status 0; see #8605, #14207
										xhr.status,
										xhr.statusText
									);
								}
							} else {
								complete(
									xhrSuccessStatus[ xhr.status ] || xhr.status,
									xhr.statusText,

									// Support: IE <=9 only
									// IE9 has no XHR2 but throws on binary (trac-11426)
									// For XHR2 non-text, let the caller handle it (gh-2498)
									( xhr.responseType || "text" ) !== "text"  ||
									typeof xhr.responseText !== "string" ?
										{ binary: xhr.response } :
										{ text: xhr.responseText },
									xhr.getAllResponseHeaders()
								);
							}
						}
					};
				};

				// Listen to events
				xhr.onload = callback();
				errorCallback = xhr.onerror = xhr.ontimeout = callback( "error" );

				// Support: IE 9 only
				// Use onreadystatechange to replace onabort
				// to handle uncaught aborts
				if ( xhr.onabort !== undefined ) {
					xhr.onabort = errorCallback;
				} else {
					xhr.onreadystatechange = function() {

						// Check readyState before timeout as it changes
						if ( xhr.readyState === 4 ) {

							// Allow onerror to be called first,
							// but that will not handle a native abort
							// Also, save errorCallback to a variable
							// as xhr.onerror cannot be accessed
							window.setTimeout( function() {
								if ( callback ) {
									errorCallback();
								}
							} );
						}
					};
				}

				// Create the abort callback
				callback = callback( "abort" );

				try {

					// Do send the request (this may raise an exception)
					xhr.send( options.hasContent && options.data || null );
				} catch ( e ) {

					// #14683: Only rethrow if this hasn't been notified as an error yet
					if ( callback ) {
						throw e;
					}
				}
			},

			abort: function() {
				if ( callback ) {
					callback();
				}
			}
		};
	}
} );




// Prevent auto-execution of scripts when no explicit dataType was provided (See gh-2432)
jQuery.ajaxPrefilter( function( s ) {
	if ( s.crossDomain ) {
		s.contents.script = false;
	}
} );

// Install script dataType
jQuery.ajaxSetup( {
	accepts: {
		script: "text/javascript, application/javascript, " +
			"application/ecmascript, application/x-ecmascript"
	},
	contents: {
		script: /\b(?:java|ecma)script\b/
	},
	converters: {
		"text script": function( text ) {
			jQuery.globalEval( text );
			return text;
		}
	}
} );

// Handle cache's special case and crossDomain
jQuery.ajaxPrefilter( "script", function( s ) {
	if ( s.cache === undefined ) {
		s.cache = false;
	}
	if ( s.crossDomain ) {
		s.type = "GET";
	}
} );

// Bind script tag hack transport
jQuery.ajaxTransport( "script", function( s ) {

	// This transport only deals with cross domain or forced-by-attrs requests
	if ( s.crossDomain || s.scriptAttrs ) {
		var script, callback;
		return {
			send: function( _, complete ) {
				script = jQuery( "<script>" )
					.attr( s.scriptAttrs || {} )
					.prop( { charset: s.scriptCharset, src: s.url } )
					.on( "load error", callback = function( evt ) {
						script.remove();
						callback = null;
						if ( evt ) {
							complete( evt.type === "error" ? 404 : 200, evt.type );
						}
					} );

				// Use native DOM manipulation to avoid our domManip AJAX trickery
				document.head.appendChild( script[ 0 ] );
			},
			abort: function() {
				if ( callback ) {
					callback();
				}
			}
		};
	}
} );




var oldCallbacks = [],
	rjsonp = /(=)\?(?=&|$)|\?\?/;

// Default jsonp settings
jQuery.ajaxSetup( {
	jsonp: "callback",
	jsonpCallback: function() {
		var callback = oldCallbacks.pop() || ( jQuery.expando + "_" + ( nonce.guid++ ) );
		this[ callback ] = true;
		return callback;
	}
} );

// Detect, normalize options and install callbacks for jsonp requests
jQuery.ajaxPrefilter( "json jsonp", function( s, originalSettings, jqXHR ) {

	var callbackName, overwritten, responseContainer,
		jsonProp = s.jsonp !== false && ( rjsonp.test( s.url ) ?
			"url" :
			typeof s.data === "string" &&
				( s.contentType || "" )
					.indexOf( "application/x-www-form-urlencoded" ) === 0 &&
				rjsonp.test( s.data ) && "data"
		);

	// Handle iff the expected data type is "jsonp" or we have a parameter to set
	if ( jsonProp || s.dataTypes[ 0 ] === "jsonp" ) {

		// Get callback name, remembering preexisting value associated with it
		callbackName = s.jsonpCallback = isFunction( s.jsonpCallback ) ?
			s.jsonpCallback() :
			s.jsonpCallback;

		// Insert callback into url or form data
		if ( jsonProp ) {
			s[ jsonProp ] = s[ jsonProp ].replace( rjsonp, "$1" + callbackName );
		} else if ( s.jsonp !== false ) {
			s.url += ( rquery.test( s.url ) ? "&" : "?" ) + s.jsonp + "=" + callbackName;
		}

		// Use data converter to retrieve json after script execution
		s.converters[ "script json" ] = function() {
			if ( !responseContainer ) {
				jQuery.error( callbackName + " was not called" );
			}
			return responseContainer[ 0 ];
		};

		// Force json dataType
		s.dataTypes[ 0 ] = "json";

		// Install callback
		overwritten = window[ callbackName ];
		window[ callbackName ] = function() {
			responseContainer = arguments;
		};

		// Clean-up function (fires after converters)
		jqXHR.always( function() {

			// If previous value didn't exist - remove it
			if ( overwritten === undefined ) {
				jQuery( window ).removeProp( callbackName );

			// Otherwise restore preexisting value
			} else {
				window[ callbackName ] = overwritten;
			}

			// Save back as free
			if ( s[ callbackName ] ) {

				// Make sure that re-using the options doesn't screw things around
				s.jsonpCallback = originalSettings.jsonpCallback;

				// Save the callback name for future use
				oldCallbacks.push( callbackName );
			}

			// Call if it was a function and we have a response
			if ( responseContainer && isFunction( overwritten ) ) {
				overwritten( responseContainer[ 0 ] );
			}

			responseContainer = overwritten = undefined;
		} );

		// Delegate to script
		return "script";
	}
} );




// Support: Safari 8 only
// In Safari 8 documents created via document.implementation.createHTMLDocument
// collapse sibling forms: the second one becomes a child of the first one.
// Because of that, this security measure has to be disabled in Safari 8.
// https://bugs.webkit.org/show_bug.cgi?id=137337
support.createHTMLDocument = ( function() {
	var body = document.implementation.createHTMLDocument( "" ).body;
	body.innerHTML = "<form></form><form></form>";
	return body.childNodes.length === 2;
} )();


// Argument "data" should be string of html
// context (optional): If specified, the fragment will be created in this context,
// defaults to document
// keepScripts (optional): If true, will include scripts passed in the html string
jQuery.parseHTML = function( data, context, keepScripts ) {
	if ( typeof data !== "string" ) {
		return [];
	}
	if ( typeof context === "boolean" ) {
		keepScripts = context;
		context = false;
	}

	var base, parsed, scripts;

	if ( !context ) {

		// Stop scripts or inline event handlers from being executed immediately
		// by using document.implementation
		if ( support.createHTMLDocument ) {
			context = document.implementation.createHTMLDocument( "" );

			// Set the base href for the created document
			// so any parsed elements with URLs
			// are based on the document's URL (gh-2965)
			base = context.createElement( "base" );
			base.href = document.location.href;
			context.head.appendChild( base );
		} else {
			context = document;
		}
	}

	parsed = rsingleTag.exec( data );
	scripts = !keepScripts && [];

	// Single tag
	if ( parsed ) {
		return [ context.createElement( parsed[ 1 ] ) ];
	}

	parsed = buildFragment( [ data ], context, scripts );

	if ( scripts && scripts.length ) {
		jQuery( scripts ).remove();
	}

	return jQuery.merge( [], parsed.childNodes );
};


/**
 * Load a url into a page
 */
jQuery.fn.load = function( url, params, callback ) {
	var selector, type, response,
		self = this,
		off = url.indexOf( " " );

	if ( off > -1 ) {
		selector = stripAndCollapse( url.slice( off ) );
		url = url.slice( 0, off );
	}

	// If it's a function
	if ( isFunction( params ) ) {

		// We assume that it's the callback
		callback = params;
		params = undefined;

	// Otherwise, build a param string
	} else if ( params && typeof params === "object" ) {
		type = "POST";
	}

	// If we have elements to modify, make the request
	if ( self.length > 0 ) {
		jQuery.ajax( {
			url: url,

			// If "type" variable is undefined, then "GET" method will be used.
			// Make value of this field explicit since
			// user can override it through ajaxSetup method
			type: type || "GET",
			dataType: "html",
			data: params
		} ).done( function( responseText ) {

			// Save response for use in complete callback
			response = arguments;

			self.html( selector ?

				// If a selector was specified, locate the right elements in a dummy div
				// Exclude scripts to avoid IE 'Permission Denied' errors
				jQuery( "<div>" ).append( jQuery.parseHTML( responseText ) ).find( selector ) :

				// Otherwise use the full result
				responseText );

		// If the request succeeds, this function gets "data", "status", "jqXHR"
		// but they are ignored because response was set above.
		// If it fails, this function gets "jqXHR", "status", "error"
		} ).always( callback && function( jqXHR, status ) {
			self.each( function() {
				callback.apply( this, response || [ jqXHR.responseText, status, jqXHR ] );
			} );
		} );
	}

	return this;
};




jQuery.expr.pseudos.animated = function( elem ) {
	return jQuery.grep( jQuery.timers, function( fn ) {
		return elem === fn.elem;
	} ).length;
};




jQuery.offset = {
	setOffset: function( elem, options, i ) {
		var curPosition, curLeft, curCSSTop, curTop, curOffset, curCSSLeft, calculatePosition,
			position = jQuery.css( elem, "position" ),
			curElem = jQuery( elem ),
			props = {};

		// Set position first, in-case top/left are set even on static elem
		if ( position === "static" ) {
			elem.style.position = "relative";
		}

		curOffset = curElem.offset();
		curCSSTop = jQuery.css( elem, "top" );
		curCSSLeft = jQuery.css( elem, "left" );
		calculatePosition = ( position === "absolute" || position === "fixed" ) &&
			( curCSSTop + curCSSLeft ).indexOf( "auto" ) > -1;

		// Need to be able to calculate position if either
		// top or left is auto and position is either absolute or fixed
		if ( calculatePosition ) {
			curPosition = curElem.position();
			curTop = curPosition.top;
			curLeft = curPosition.left;

		} else {
			curTop = parseFloat( curCSSTop ) || 0;
			curLeft = parseFloat( curCSSLeft ) || 0;
		}

		if ( isFunction( options ) ) {

			// Use jQuery.extend here to allow modification of coordinates argument (gh-1848)
			options = options.call( elem, i, jQuery.extend( {}, curOffset ) );
		}

		if ( options.top != null ) {
			props.top = ( options.top - curOffset.top ) + curTop;
		}
		if ( options.left != null ) {
			props.left = ( options.left - curOffset.left ) + curLeft;
		}

		if ( "using" in options ) {
			options.using.call( elem, props );

		} else {
			curElem.css( props );
		}
	}
};

jQuery.fn.extend( {

	// offset() relates an element's border box to the document origin
	offset: function( options ) {

		// Preserve chaining for setter
		if ( arguments.length ) {
			return options === undefined ?
				this :
				this.each( function( i ) {
					jQuery.offset.setOffset( this, options, i );
				} );
		}

		var rect, win,
			elem = this[ 0 ];

		if ( !elem ) {
			return;
		}

		// Return zeros for disconnected and hidden (display: none) elements (gh-2310)
		// Support: IE <=11 only
		// Running getBoundingClientRect on a
		// disconnected node in IE throws an error
		if ( !elem.getClientRects().length ) {
			return { top: 0, left: 0 };
		}

		// Get document-relative position by adding viewport scroll to viewport-relative gBCR
		rect = elem.getBoundingClientRect();
		win = elem.ownerDocument.defaultView;
		return {
			top: rect.top + win.pageYOffset,
			left: rect.left + win.pageXOffset
		};
	},

	// position() relates an element's margin box to its offset parent's padding box
	// This corresponds to the behavior of CSS absolute positioning
	position: function() {
		if ( !this[ 0 ] ) {
			return;
		}

		var offsetParent, offset, doc,
			elem = this[ 0 ],
			parentOffset = { top: 0, left: 0 };

		// position:fixed elements are offset from the viewport, which itself always has zero offset
		if ( jQuery.css( elem, "position" ) === "fixed" ) {

			// Assume position:fixed implies availability of getBoundingClientRect
			offset = elem.getBoundingClientRect();

		} else {
			offset = this.offset();

			// Account for the *real* offset parent, which can be the document or its root element
			// when a statically positioned element is identified
			doc = elem.ownerDocument;
			offsetParent = elem.offsetParent || doc.documentElement;
			while ( offsetParent &&
				( offsetParent === doc.body || offsetParent === doc.documentElement ) &&
				jQuery.css( offsetParent, "position" ) === "static" ) {

				offsetParent = offsetParent.parentNode;
			}
			if ( offsetParent && offsetParent !== elem && offsetParent.nodeType === 1 ) {

				// Incorporate borders into its offset, since they are outside its content origin
				parentOffset = jQuery( offsetParent ).offset();
				parentOffset.top += jQuery.css( offsetParent, "borderTopWidth", true );
				parentOffset.left += jQuery.css( offsetParent, "borderLeftWidth", true );
			}
		}

		// Subtract parent offsets and element margins
		return {
			top: offset.top - parentOffset.top - jQuery.css( elem, "marginTop", true ),
			left: offset.left - parentOffset.left - jQuery.css( elem, "marginLeft", true )
		};
	},

	// This method will return documentElement in the following cases:
	// 1) For the element inside the iframe without offsetParent, this method will return
	//    documentElement of the parent window
	// 2) For the hidden or detached element
	// 3) For body or html element, i.e. in case of the html node - it will return itself
	//
	// but those exceptions were never presented as a real life use-cases
	// and might be considered as more preferable results.
	//
	// This logic, however, is not guaranteed and can change at any point in the future
	offsetParent: function() {
		return this.map( function() {
			var offsetParent = this.offsetParent;

			while ( offsetParent && jQuery.css( offsetParent, "position" ) === "static" ) {
				offsetParent = offsetParent.offsetParent;
			}

			return offsetParent || documentElement;
		} );
	}
} );

// Create scrollLeft and scrollTop methods
jQuery.each( { scrollLeft: "pageXOffset", scrollTop: "pageYOffset" }, function( method, prop ) {
	var top = "pageYOffset" === prop;

	jQuery.fn[ method ] = function( val ) {
		return access( this, function( elem, method, val ) {

			// Coalesce documents and windows
			var win;
			if ( isWindow( elem ) ) {
				win = elem;
			} else if ( elem.nodeType === 9 ) {
				win = elem.defaultView;
			}

			if ( val === undefined ) {
				return win ? win[ prop ] : elem[ method ];
			}

			if ( win ) {
				win.scrollTo(
					!top ? val : win.pageXOffset,
					top ? val : win.pageYOffset
				);

			} else {
				elem[ method ] = val;
			}
		}, method, val, arguments.length );
	};
} );

// Support: Safari <=7 - 9.1, Chrome <=37 - 49
// Add the top/left cssHooks using jQuery.fn.position
// Webkit bug: https://bugs.webkit.org/show_bug.cgi?id=29084
// Blink bug: https://bugs.chromium.org/p/chromium/issues/detail?id=589347
// getComputedStyle returns percent when specified for top/left/bottom/right;
// rather than make the css module depend on the offset module, just check for it here
jQuery.each( [ "top", "left" ], function( _i, prop ) {
	jQuery.cssHooks[ prop ] = addGetHookIf( support.pixelPosition,
		function( elem, computed ) {
			if ( computed ) {
				computed = curCSS( elem, prop );

				// If curCSS returns percentage, fallback to offset
				return rnumnonpx.test( computed ) ?
					jQuery( elem ).position()[ prop ] + "px" :
					computed;
			}
		}
	);
} );


// Create innerHeight, innerWidth, height, width, outerHeight and outerWidth methods
jQuery.each( { Height: "height", Width: "width" }, function( name, type ) {
	jQuery.each( {
		padding: "inner" + name,
		content: type,
		"": "outer" + name
	}, function( defaultExtra, funcName ) {

		// Margin is only for outerHeight, outerWidth
		jQuery.fn[ funcName ] = function( margin, value ) {
			var chainable = arguments.length && ( defaultExtra || typeof margin !== "boolean" ),
				extra = defaultExtra || ( margin === true || value === true ? "margin" : "border" );

			return access( this, function( elem, type, value ) {
				var doc;

				if ( isWindow( elem ) ) {

					// $( window ).outerWidth/Height return w/h including scrollbars (gh-1729)
					return funcName.indexOf( "outer" ) === 0 ?
						elem[ "inner" + name ] :
						elem.document.documentElement[ "client" + name ];
				}

				// Get document width or height
				if ( elem.nodeType === 9 ) {
					doc = elem.documentElement;

					// Either scroll[Width/Height] or offset[Width/Height] or client[Width/Height],
					// whichever is greatest
					return Math.max(
						elem.body[ "scroll" + name ], doc[ "scroll" + name ],
						elem.body[ "offset" + name ], doc[ "offset" + name ],
						doc[ "client" + name ]
					);
				}

				return value === undefined ?

					// Get width or height on the element, requesting but not forcing parseFloat
					jQuery.css( elem, type, extra ) :

					// Set width or height on the element
					jQuery.style( elem, type, value, extra );
			}, type, chainable ? margin : undefined, chainable );
		};
	} );
} );


jQuery.each( [
	"ajaxStart",
	"ajaxStop",
	"ajaxComplete",
	"ajaxError",
	"ajaxSuccess",
	"ajaxSend"
], function( _i, type ) {
	jQuery.fn[ type ] = function( fn ) {
		return this.on( type, fn );
	};
} );




jQuery.fn.extend( {

	bind: function( types, data, fn ) {
		return this.on( types, null, data, fn );
	},
	unbind: function( types, fn ) {
		return this.off( types, null, fn );
	},

	delegate: function( selector, types, data, fn ) {
		return this.on( types, selector, data, fn );
	},
	undelegate: function( selector, types, fn ) {

		// ( namespace ) or ( selector, types [, fn] )
		return arguments.length === 1 ?
			this.off( selector, "**" ) :
			this.off( types, selector || "**", fn );
	},

	hover: function( fnOver, fnOut ) {
		return this.mouseenter( fnOver ).mouseleave( fnOut || fnOver );
	}
} );

jQuery.each(
	( "blur focus focusin focusout resize scroll click dblclick " +
	"mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave " +
	"change select submit keydown keypress keyup contextmenu" ).split( " " ),
	function( _i, name ) {

		// Handle event binding
		jQuery.fn[ name ] = function( data, fn ) {
			return arguments.length > 0 ?
				this.on( name, null, data, fn ) :
				this.trigger( name );
		};
	}
);




// Support: Android <=4.0 only
// Make sure we trim BOM and NBSP
var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;

// Bind a function to a context, optionally partially applying any
// arguments.
// jQuery.proxy is deprecated to promote standards (specifically Function#bind)
// However, it is not slated for removal any time soon
jQuery.proxy = function( fn, context ) {
	var tmp, args, proxy;

	if ( typeof context === "string" ) {
		tmp = fn[ context ];
		context = fn;
		fn = tmp;
	}

	// Quick check to determine if target is callable, in the spec
	// this throws a TypeError, but we will just return undefined.
	if ( !isFunction( fn ) ) {
		return undefined;
	}

	// Simulated bind
	args = slice.call( arguments, 2 );
	proxy = function() {
		return fn.apply( context || this, args.concat( slice.call( arguments ) ) );
	};

	// Set the guid of unique handler to the same of original handler, so it can be removed
	proxy.guid = fn.guid = fn.guid || jQuery.guid++;

	return proxy;
};

jQuery.holdReady = function( hold ) {
	if ( hold ) {
		jQuery.readyWait++;
	} else {
		jQuery.ready( true );
	}
};
jQuery.isArray = Array.isArray;
jQuery.parseJSON = JSON.parse;
jQuery.nodeName = nodeName;
jQuery.isFunction = isFunction;
jQuery.isWindow = isWindow;
jQuery.camelCase = camelCase;
jQuery.type = toType;

jQuery.now = Date.now;

jQuery.isNumeric = function( obj ) {

	// As of jQuery 3.0, isNumeric is limited to
	// strings and numbers (primitives or objects)
	// that can be coerced to finite numbers (gh-2662)
	var type = jQuery.type( obj );
	return ( type === "number" || type === "string" ) &&

		// parseFloat NaNs numeric-cast false positives ("")
		// ...but misinterprets leading-number strings, particularly hex literals ("0x...")
		// subtraction forces infinities to NaN
		!isNaN( obj - parseFloat( obj ) );
};

jQuery.trim = function( text ) {
	return text == null ?
		"" :
		( text + "" ).replace( rtrim, "" );
};



// Register as a named AMD module, since jQuery can be concatenated with other
// files that may use define, but not via a proper concatenation script that
// understands anonymous AMD modules. A named AMD is safest and most robust
// way to register. Lowercase jquery is used because AMD module names are
// derived from file names, and jQuery is normally delivered in a lowercase
// file name. Do this after creating the global so that if an AMD module wants
// to call noConflict to hide this version of jQuery, it will work.

// Note that for maximum portability, libraries that are not jQuery should
// declare themselves as anonymous modules, and avoid setting a global if an
// AMD loader is present. jQuery is a special case. For more information, see
// https://github.com/jrburke/requirejs/wiki/Updating-existing-libraries#wiki-anon

if ( true ) {
	!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function() {
		return jQuery;
	}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
}




var

	// Map over jQuery in case of overwrite
	_jQuery = window.jQuery,

	// Map over the $ in case of overwrite
	_$ = window.$;

jQuery.noConflict = function( deep ) {
	if ( window.$ === jQuery ) {
		window.$ = _$;
	}

	if ( deep && window.jQuery === jQuery ) {
		window.jQuery = _jQuery;
	}

	return jQuery;
};

// Expose jQuery and $ identifiers, even in AMD
// (#7102#comment:10, https://github.com/jquery/jquery/pull/557)
// and CommonJS for browser emulators (#13566)
if ( typeof noGlobal === "undefined" ) {
	window.jQuery = window.$ = jQuery;
}




return jQuery;
} );


/***/ }),

/***/ "./resources/js/category_app.js":
/*!**************************************!*\
  !*** ./resources/js/category_app.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./form_builder/jquery-ui */ "./resources/js/form_builder/jquery-ui.js");

__webpack_require__(/*! ./form_builder/formRender */ "./resources/js/form_builder/formRender.js");

__webpack_require__(/*! ./form_builder/formBuilder */ "./resources/js/form_builder/formBuilder.js");

/***/ }),

/***/ "./resources/js/form_builder/formBuilder.js":
/*!**************************************************!*\
  !*** ./resources/js/form_builder/formBuilder.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _get(target, property, receiver) { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get; } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(receiver); } return desc.value; }; } return _get(target, property, receiver || target); }

function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = _getPrototypeOf(object); if (object === null) break; } return object; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e41) { throw _e41; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e42) { didErr = true; err = _e42; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*!
 * jQuery formBuilder: https://formbuilder.online/
 * Version: 3.7.2
 * Author: Kevin Chappell <kevin.b.chappell@gmail.com>
 */
!function (e) {
  "use strict";

  !function (e) {
    var t = {};

    function r(o) {
      if (t[o]) return t[o].exports;
      var n = t[o] = {
        i: o,
        l: !1,
        exports: {}
      };
      return e[o].call(n.exports, n, n.exports, r), n.l = !0, n.exports;
    }

    r.m = e, r.c = t, r.d = function (e, t, o) {
      r.o(e, t) || Object.defineProperty(e, t, {
        enumerable: !0,
        get: o
      });
    }, r.r = function (e) {
      "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
        value: "Module"
      }), Object.defineProperty(e, "__esModule", {
        value: !0
      });
    }, r.t = function (e, t) {
      if (1 & t && (e = r(e)), 8 & t) return e;
      if (4 & t && "object" == _typeof(e) && e && e.__esModule) return e;
      var o = Object.create(null);
      if (r.r(o), Object.defineProperty(o, "default", {
        enumerable: !0,
        value: e
      }), 2 & t && "string" != typeof e) for (var n in e) {
        r.d(o, n, function (t) {
          return e[t];
        }.bind(null, n));
      }
      return o;
    }, r.n = function (e) {
      var t = e && e.__esModule ? function () {
        return e["default"];
      } : function () {
        return e;
      };
      return r.d(t, "a", t), t;
    }, r.o = function (e, t) {
      return Object.prototype.hasOwnProperty.call(e, t);
    }, r.p = "", r(r.s = 35);
  }([function (t, r, o) {
    function n(e, t) {
      var r = Object.keys(e);

      if (Object.getOwnPropertySymbols) {
        var o = Object.getOwnPropertySymbols(e);
        t && (o = o.filter(function (t) {
          return Object.getOwnPropertyDescriptor(e, t).enumerable;
        })), r.push.apply(r, o);
      }

      return r;
    }

    function i(e) {
      for (var t = 1; t < arguments.length; t++) {
        var r = null != arguments[t] ? arguments[t] : {};
        t % 2 ? n(Object(r), !0).forEach(function (t) {
          l(e, t, r[t]);
        }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(r)) : n(Object(r)).forEach(function (t) {
          Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(r, t));
        });
      }

      return e;
    }

    function l(e, t, r) {
      return t in e ? Object.defineProperty(e, t, {
        value: r,
        enumerable: !0,
        configurable: !0,
        writable: !0
      }) : e[t] = r, e;
    }

    function a(e, t) {
      if (null == e) return {};

      var r,
          o,
          n = function (e, t) {
        if (null == e) return {};
        var r,
            o,
            n = {},
            i = Object.keys(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || (n[r] = e[r]);
        }

        return n;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || Object.prototype.propertyIsEnumerable.call(e, r) && (n[r] = e[r]);
        }
      }

      return n;
    }

    o.d(r, "A", function () {
      return s;
    }), o.d(r, "C", function () {
      return d;
    }), o.d(r, "b", function () {
      return u;
    }), o.d(r, "h", function () {
      return p;
    }), o.d(r, "n", function () {
      return b;
    }), o.d(r, "c", function () {
      return h;
    }), o.d(r, "s", function () {
      return g;
    }), o.d(r, "k", function () {
      return y;
    }), o.d(r, "q", function () {
      return w;
    }), o.d(r, "t", function () {
      return A;
    }), o.d(r, "u", function () {
      return j;
    }), o.d(r, "g", function () {
      return k;
    }), o.d(r, "i", function () {
      return C;
    }), o.d(r, "B", function () {
      return E;
    }), o.d(r, "v", function () {
      return N;
    }), o.d(r, "l", function () {
      return S;
    }), o.d(r, "p", function () {
      return L;
    }), o.d(r, "m", function () {
      return D;
    }), o.d(r, "d", function () {
      return T;
    }), o.d(r, "a", function () {
      return F;
    }), o.d(r, "e", function () {
      return R;
    }), o.d(r, "r", function () {
      return I;
    }), o.d(r, "x", function () {
      return P;
    }), o.d(r, "j", function () {
      return M;
    }), o.d(r, "y", function () {
      return z;
    }), o.d(r, "o", function () {
      return U;
    }), o.d(r, "w", function () {
      return H;
    }), o.d(r, "z", function () {
      return Q;
    }), window.fbLoaded = {
      js: [],
      css: []
    }, window.fbEditors = {
      quill: {},
      tinymce: {}
    };

    var s = function s(e) {
      var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : !1;
      var r = [null, void 0, ""];
      t && r.push(!1);

      for (var _t in e) {
        r.includes(e[_t]) ? delete e[_t] : Array.isArray(e[_t]) && (e[_t].length || delete e[_t]);
      }

      return e;
    },
        c = function c(e) {
      return !["values", "enableOther", "other", "label", "subtype"].includes(e);
    },
        d = function d(e) {
      return Object.entries(e).map(function (_ref) {
        var _ref2 = _slicedToArray(_ref, 2),
            e = _ref2[0],
            t = _ref2[1];

        return "".concat(b(e), "=\"").concat(t, "\"");
      }).join(" ");
    },
        u = function u(e) {
      return Object.entries(e).map(function (_ref3) {
        var _ref4 = _slicedToArray(_ref3, 2),
            e = _ref4[0],
            t = _ref4[1];

        return c(e) && Object.values(f(e, t)).join("");
      }).filter(Boolean).join(" ");
    },
        f = function f(e, t) {
      var r;
      return e = m(e), t && (Array.isArray(t) ? r = q(t.join(" ")) : ("boolean" == typeof t && (t = t.toString()), r = q(t.trim()))), {
        name: e,
        value: t = t ? "=\"".concat(r, "\"") : ""
      };
    },
        p = function p(e) {
      return e.reduce(function (e, t) {
        return e.concat(Array.isArray(t) ? p(t) : t);
      }, []);
    },
        m = function m(e) {
      return {
        className: "class"
      }[e] || b(e);
    },
        b = function b(e) {
      return (e = (e = e.replace(/[^\w\s\-]/gi, "")).replace(/([A-Z])/g, function (e) {
        return "-" + e.toLowerCase();
      })).replace(/\s/g, "-").replace(/^-+/g, "");
    },
        h = function h(e) {
      return e.replace(/-([a-z])/g, function (e, t) {
        return t.toUpperCase();
      });
    },
        g = function () {
      var e,
          t = 0;
      return function (r) {
        var o = new Date().getTime();
        o === e ? ++t : (t = 0, e = o);
        return (r.type || b(r.label)) + "-" + o + "-" + t;
      };
    }(),
        y = function y(e) {
      return void 0 === e ? e : [["array", function (e) {
        return Array.isArray(e);
      }], ["node", function (e) {
        return e instanceof window.Node || e instanceof window.HTMLElement;
      }], ["component", function () {
        return e && e.dom;
      }], [_typeof(e), function () {
        return !0;
      }]].find(function (t) {
        return t[1](e);
      })[0];
    },
        w = function w(e) {
      var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "";
      var r = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
      var o = y(t);
      var n = r.events,
          i = a(r, ["events"]),
          l = document.createElement(e),
          s = {
        string: function string(e) {
          l.innerHTML += e;
        },
        object: function object(e) {
          var t = e.tag,
              r = e.content,
              o = a(e, ["tag", "content"]);
          return l.appendChild(w(t, r, o));
        },
        node: function node(e) {
          return l.appendChild(e);
        },
        array: function array(e) {
          for (var _t2 = 0; _t2 < e.length; _t2++) {
            o = y(e[_t2]), s[o](e[_t2]);
          }
        },
        "function": function _function(e) {
          e = e(), o = y(e), s[o](e);
        },
        undefined: function undefined() {}
      };

      for (var _e2 in i) {
        if (i.hasOwnProperty(_e2)) {
          var _t3 = m(_e2),
              _r = Array.isArray(i[_e2]) ? E(i[_e2].join(" ").split(" ")).join(" ") : i[_e2];

          l.setAttribute(_t3, _r);
        }
      }

      return t && s[o](t), function (e, t) {
        if (t) {
          var _loop = function _loop(_r2) {
            t.hasOwnProperty(_r2) && e.addEventListener(_r2, function (e) {
              return t[_r2](e);
            });
          };

          for (var _r2 in t) {
            _loop(_r2);
          }
        }
      }(l, n), l;
    },
        v = function v(e) {
      var t = e.attributes,
          r = {};
      return C(t, function (e) {
        var o = t[e].value || "";
        o.match(/false|true/g) ? o = "true" === o : o.match(/undefined/g) && (o = void 0), o && (r[h(t[e].name)] = o);
      }), r;
    },
        x = function x(e) {
      var t = [];

      for (var _r3 = 0; _r3 < e.length; _r3++) {
        var _o = i(i({}, v(e[_r3])), {}, {
          label: e[_r3].textContent
        });

        t.push(_o);
      }

      return t;
    },
        O = function O(e) {
      var t = [];

      if (e.length) {
        var _r4 = e[0].getElementsByTagName("value");

        for (var _e3 = 0; _e3 < _r4.length; _e3++) {
          t.push(_r4[_e3].textContent);
        }
      }

      return t;
    },
        A = function A(e) {
      var t = new window.DOMParser().parseFromString(e, "text/xml"),
          r = [];

      if (t) {
        var _e4 = t.getElementsByTagName("field");

        for (var _t4 = 0; _t4 < _e4.length; _t4++) {
          var _o2 = v(_e4[_t4]),
              _n2 = _e4[_t4].getElementsByTagName("option"),
              _i2 = _e4[_t4].getElementsByTagName("userData");

          _n2 && _n2.length && (_o2.values = x(_n2)), _i2 && _i2.length && (_o2.userData = O(_i2)), r.push(_o2);
        }
      }

      return r;
    },
        j = function j(e) {
      var t = document.createElement("textarea");
      return t.innerHTML = e, t.textContent;
    },
        k = function k(e) {
      var t = document.createElement("textarea");
      return t.textContent = e, t.innerHTML;
    },
        q = function q(e) {
      var t = {
        '"': "&quot;",
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;"
      };
      return "string" == typeof e ? e.replace(/["&<>]/g, function (e) {
        return t[e] || e;
      }) : e;
    },
        C = function C(e, t, r) {
      for (var _o3 = 0; _o3 < e.length; _o3++) {
        t.call(r, _o3, e[_o3]);
      }
    },
        E = function E(e) {
      return e.filter(function (e, t, r) {
        return r.indexOf(e) === t;
      });
    },
        N = function N(e, t) {
      var r = t.indexOf(e);
      r > -1 && t.splice(r, 1);
    },
        S = function S(e, t) {
      var _jQuery;

      var r = jQuery;
      var o = [];
      return Array.isArray(e) || (e = [e]), L(e) || (o = jQuery.map(e, function (e) {
        var r = {
          dataType: "script",
          cache: !0,
          url: (t || "") + e
        };
        return jQuery.ajax(r).done(function () {
          return window.fbLoaded.js.push(e);
        });
      })), o.push(jQuery.Deferred(function (e) {
        return r(e.resolve);
      })), (_jQuery = jQuery).when.apply(_jQuery, _toConsumableArray(o));
    },
        L = function L(e) {
      var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "js";
      var r = !1;
      var o = window.fbLoaded[t];
      return r = Array.isArray(e) ? e.every(function (e) {
        return o.includes(e);
      }) : o.includes(e), r;
    },
        D = function D(t, r) {
      Array.isArray(t) || (t = [t]), t.forEach(function (t) {
        var o = "href",
            n = t,
            i = "";

        if ("object" == _typeof(t) && (o = t.type || (t.style ? "inline" : "href"), i = t.id, t = "inline" == o ? t.style : t.href, n = i || t.href || t.style), !L(n, "css")) {
          if ("href" == o) {
            var _e5 = document.createElement("link");

            _e5.type = "text/css", _e5.rel = "stylesheet", _e5.href = (r || "") + t, document.head.appendChild(_e5);
          } else e("<style type=\"text/css\">".concat(t, "</style>")).attr("id", i).appendTo(e(document.head));

          window.fbLoaded.css.push(n);
        }
      });
    },
        T = function T(e) {
      return e.replace(/\b\w/g, function (e) {
        return e.toUpperCase();
      });
    },
        B = function B(e, t) {
      var r = Object.assign({}, e, t);

      for (var _o4 in t) {
        r.hasOwnProperty(_o4) && (Array.isArray(t[_o4]) ? r[_o4] = Array.isArray(e[_o4]) ? E(e[_o4].concat(t[_o4])) : t[_o4] : "object" == _typeof(t[_o4]) ? r[_o4] = B(e[_o4], t[_o4]) : r[_o4] = t[_o4]);
      }

      return r;
    },
        F = function F(e, t, r) {
      return t.split(" ").forEach(function (t) {
        return e.addEventListener(t, r, !1);
      });
    },
        R = function R(e, t) {
      var r = t.replace(".", "");

      for (; (e = e.parentElement) && !e.classList.contains(r);) {
        ;
      }

      return e;
    },
        I = function I() {
      var e = "";
      var t;
      return t = navigator.userAgent || navigator.vendor || window.opera, /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(t) && (e = "formbuilder-mobile"), e;
    },
        P = function P(e) {
      return e.replace(/\s/g, "-").replace(/[^a-zA-Z0-9[\]_-]/g, "");
    },
        M = function M(e) {
      return e.replace(/[^0-9]/g, "");
    },
        z = function z(e, t) {
      return t.filter(function (e) {
        return !~this.indexOf(e);
      }, e);
    },
        U = function U(e) {
      var t = (e = Array.isArray(e) ? e : [e]).map(function (_ref5) {
        var e = _ref5.src,
            t = _ref5.id;
        return new Promise(function (r) {
          if (window.fbLoaded.css.includes(e)) return r(e);
          var o = w("link", null, {
            href: e,
            rel: "stylesheet",
            id: t
          });
          document.head.insertBefore(o, document.head.firstChild);
        });
      });
      return Promise.all(t);
    },
        H = function H(e) {
      var t = document.getElementById(e);
      return t.parentElement.removeChild(t);
    };

    function Q(e) {
      var t = ["a", "an", "and", "as", "at", "but", "by", "for", "for", "from", "in", "into", "near", "nor", "of", "on", "onto", "or", "the", "to", "with"].map(function (e) {
        return "\\s".concat(e, "\\s");
      }),
          r = new RegExp("(?!".concat(t.join("|"), ")\\w\\S*"), "g");
      return ("" + e).replace(r, function (e) {
        return e.charAt(0).toUpperCase() + e.substr(1).replace(/[A-Z]/g, function (e) {
          return " " + e;
        });
      });
    }

    var V = {
      addEventListeners: F,
      attrString: u,
      camelCase: h,
      capitalize: T,
      closest: R,
      getContentType: y,
      escapeAttr: q,
      escapeAttrs: function escapeAttrs(e) {
        for (var _t5 in e) {
          e.hasOwnProperty(_t5) && (e[_t5] = q(e[_t5]));
        }

        return e;
      },
      escapeHtml: k,
      forceNumber: M,
      forEach: C,
      getScripts: S,
      getStyles: D,
      hyphenCase: b,
      isCached: L,
      markup: w,
      merge: B,
      mobileClass: I,
      nameAttr: g,
      parseAttrs: v,
      parsedHtml: j,
      parseOptions: x,
      parseUserData: O,
      parseXML: A,
      removeFromArray: N,
      safeAttr: f,
      safeAttrName: m,
      safename: P,
      subtract: z,
      trimObj: s,
      unique: E,
      validAttr: c,
      titleCase: Q,
      splitObject: function splitObject(e, t) {
        var r = function r(e) {
          return function (t, r) {
            return t[r] = e[r], t;
          };
        };

        return [Object.keys(e).filter(function (e) {
          return t.includes(e);
        }).reduce(r(e), {}), Object.keys(e).filter(function (e) {
          return !t.includes(e);
        }).reduce(r(e), {})];
      }
    };
    r.f = V;
  }, function (e, t, r) {
    r.d(t, "a", function () {
      return a;
    });
    var o = r(0),
        n = r(2),
        i = r.n(n);

    function l(e, t) {
      if (null == e) return {};

      var r,
          o,
          n = function (e, t) {
        if (null == e) return {};
        var r,
            o,
            n = {},
            i = Object.keys(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || (n[r] = e[r]);
        }

        return n;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || Object.prototype.propertyIsEnumerable.call(e, r) && (n[r] = e[r]);
        }
      }

      return n;
    }

    var a = /*#__PURE__*/function () {
      function a(e, t) {
        _classCallCheck(this, a);

        this.rawConfig = jQuery.extend({}, e), e = jQuery.extend({}, e), this.preview = t, delete e.isPreview, this.preview && delete e.required;
        var r = ["label", "description", "subtype", "required", "disabled"];

        for (var _i3 = 0, _r5 = r; _i3 < _r5.length; _i3++) {
          var _t6 = _r5[_i3];
          this[_t6] = e[_t6], delete e[_t6];
        }

        e.id || (e.name ? e.id = e.name : e.id = "control-" + Math.floor(1e7 * Math.random() + 1)), this.id = e.id, this.type = e.type, this.description && (e.title = this.description), a.controlConfig || (a.controlConfig = {});
        var o = this.subtype ? this.type + "." + this.subtype : this.type;
        this.classConfig = jQuery.extend({}, a.controlConfig[o] || {}), this.subtype && (e.type = this.subtype), this.required && (e.required = "required", e["aria-required"] = "true"), this.disabled && (e.disabled = "disabled"), this.config = e, this.configure();
      }

      _createClass(a, [{
        key: "configure",
        value: function configure() {}
      }, {
        key: "build",
        value: function build() {
          var e = this.config,
              t = e.label,
              r = e.type,
              n = l(e, ["label", "type"]);
          return this.markup(r, Object(o.u)(t), n);
        }
      }, {
        key: "on",
        value: function on(e) {
          var _this = this;

          var t = {
            prerender: function prerender(e) {
              return e;
            },
            render: function render(e) {
              var t = function t() {
                _this.onRender && _this.onRender(e);
              };

              _this.css && Object(o.m)(_this.css), _this.js && !Object(o.p)(_this.js) ? Object(o.l)(_this.js).done(t) : t();
            }
          };
          return e ? t[e] : t;
        }
      }, {
        key: "markup",
        value: function markup(e) {
          var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "";
          var r = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
          return this.element = Object(o.q)(e, t, r), this.element;
        }
      }, {
        key: "parsedHtml",
        value: function parsedHtml(e) {
          return Object(o.u)(e);
        }
      }], [{
        key: "definition",
        get: function get() {
          return {};
        }
      }, {
        key: "register",
        value: function register(e, t, r) {
          var o = r ? r + "." : "";
          a.classRegister || (a.classRegister = {}), Array.isArray(e) || (e = [e]);

          var _iterator = _createForOfIteratorHelper(e),
              _step;

          try {
            for (_iterator.s(); !(_step = _iterator.n()).done;) {
              var _r6 = _step.value;
              -1 === _r6.indexOf(".") ? a.classRegister[o + _r6] = t : a.error("Ignoring type ".concat(_r6, ". Cannot use the character '.' in a type name."));
            }
          } catch (err) {
            _iterator.e(err);
          } finally {
            _iterator.f();
          }
        }
      }, {
        key: "getRegistered",
        value: function getRegistered() {
          var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : !1;
          var t = Object.keys(a.classRegister);
          return t.length ? t.filter(function (t) {
            return e ? t.indexOf(e + ".") > -1 : -1 == t.indexOf(".");
          }) : t;
        }
      }, {
        key: "getRegisteredSubtypes",
        value: function getRegisteredSubtypes() {
          var e = {};

          for (var _t7 in a.classRegister) {
            if (a.classRegister.hasOwnProperty(_t7)) {
              var _t7$split = _t7.split("."),
                  _t7$split2 = _slicedToArray(_t7$split, 2),
                  _r7 = _t7$split2[0],
                  _o5 = _t7$split2[1];

              if (!_o5) continue;
              e[_r7] || (e[_r7] = []), e[_r7].push(_o5);
            }
          }

          return e;
        }
      }, {
        key: "getClass",
        value: function getClass(e, t) {
          var r = t ? e + "." + t : e,
              o = a.classRegister[r] || a.classRegister[e];
          return o || a.error("Invalid control type. (Type: " + e + ", Subtype: " + t + "). Please ensure you have registered it, and imported it correctly.");
        }
      }, {
        key: "loadCustom",
        value: function loadCustom(e) {
          var t = [];

          if (e && (t = t.concat(e)), window.fbControls && (t = t.concat(window.fbControls)), !this.fbControlsLoaded) {
            var _iterator2 = _createForOfIteratorHelper(t),
                _step2;

            try {
              for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
                var _e6 = _step2.value;

                _e6(a, a.classRegister);
              }
            } catch (err) {
              _iterator2.e(err);
            } finally {
              _iterator2.f();
            }

            this.fbControlsLoaded = !0;
          }
        }
      }, {
        key: "mi18n",
        value: function mi18n(e, t) {
          var r = this.definition;
          var o = r.i18n || {};
          o = o[i.a.locale] || o["default"] || o;
          var n = this.camelCase(e),
              l = "object" == _typeof(o) ? o[n] || o[e] : o;
          if (l) return l;
          var _a = r.mi18n;
          return "object" == _typeof(_a) && (_a = _a[n] || _a[e]), _a || (_a = n), i.a.get(_a, t);
        }
      }, {
        key: "active",
        value: function active(e) {
          return !Array.isArray(this.definition.inactive) || -1 == this.definition.inactive.indexOf(e);
        }
      }, {
        key: "label",
        value: function label(e) {
          return this.mi18n(e);
        }
      }, {
        key: "icon",
        value: function icon(e) {
          var t = this.definition;
          return t && "object" == _typeof(t.icon) ? t.icon[e] : t.icon;
        }
      }, {
        key: "error",
        value: function error(e) {
          throw new Error(e);
        }
      }, {
        key: "camelCase",
        value: function camelCase(e) {
          return Object(o.c)(e);
        }
      }]);

      return a;
    }();
  }, function (e, t) {
    /*!
     * mi18n - https://github.com/Draggable/mi18n
     * Version: 0.4.7
     * Author: Kevin Chappell <kevin.b.chappell@gmail.com> (http://kevin-chappell.com)
     */
    e.exports = function (e) {
      var t = {};

      function r(o) {
        if (t[o]) return t[o].exports;
        var n = t[o] = {
          i: o,
          l: !1,
          exports: {}
        };
        return e[o].call(n.exports, n, n.exports, r), n.l = !0, n.exports;
      }

      return r.m = e, r.c = t, r.d = function (e, t, o) {
        r.o(e, t) || Object.defineProperty(e, t, {
          enumerable: !0,
          get: o
        });
      }, r.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
          value: "Module"
        }), Object.defineProperty(e, "__esModule", {
          value: !0
        });
      }, r.t = function (e, t) {
        if (1 & t && (e = r(e)), 8 & t) return e;
        if (4 & t && "object" == _typeof(e) && e && e.__esModule) return e;
        var o = Object.create(null);
        if (r.r(o), Object.defineProperty(o, "default", {
          enumerable: !0,
          value: e
        }), 2 & t && "string" != typeof e) for (var n in e) {
          r.d(o, n, function (t) {
            return e[t];
          }.bind(null, n));
        }
        return o;
      }, r.n = function (e) {
        var t = e && e.__esModule ? function () {
          return e["default"];
        } : function () {
          return e;
        };
        return r.d(t, "a", t), t;
      }, r.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t);
      }, r.p = "", r(r.s = 7);
    }([function (e, t, r) {
      var o = "function" == typeof Symbol && "symbol" == _typeof(Symbol.iterator) ? function (e) {
        return _typeof(e);
      } : function (e) {
        return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : _typeof(e);
      },
          n = r(2),
          i = r(10),
          l = Object.prototype.toString;

      function a(e) {
        return "[object Array]" === l.call(e);
      }

      function s(e) {
        return null !== e && "object" === (void 0 === e ? "undefined" : o(e));
      }

      function c(e) {
        return "[object Function]" === l.call(e);
      }

      function d(e, t) {
        if (null != e) if ("object" !== (void 0 === e ? "undefined" : o(e)) && (e = [e]), a(e)) for (var r = 0, n = e.length; r < n; r++) {
          t.call(null, e[r], r, e);
        } else for (var i in e) {
          Object.prototype.hasOwnProperty.call(e, i) && t.call(null, e[i], i, e);
        }
      }

      e.exports = {
        isArray: a,
        isArrayBuffer: function isArrayBuffer(e) {
          return "[object ArrayBuffer]" === l.call(e);
        },
        isBuffer: i,
        isFormData: function isFormData(e) {
          return "undefined" != typeof FormData && e instanceof FormData;
        },
        isArrayBufferView: function isArrayBufferView(e) {
          return "undefined" != typeof ArrayBuffer && ArrayBuffer.isView ? ArrayBuffer.isView(e) : e && e.buffer && e.buffer instanceof ArrayBuffer;
        },
        isString: function isString(e) {
          return "string" == typeof e;
        },
        isNumber: function isNumber(e) {
          return "number" == typeof e;
        },
        isObject: s,
        isUndefined: function isUndefined(e) {
          return void 0 === e;
        },
        isDate: function isDate(e) {
          return "[object Date]" === l.call(e);
        },
        isFile: function isFile(e) {
          return "[object File]" === l.call(e);
        },
        isBlob: function isBlob(e) {
          return "[object Blob]" === l.call(e);
        },
        isFunction: c,
        isStream: function isStream(e) {
          return s(e) && c(e.pipe);
        },
        isURLSearchParams: function isURLSearchParams(e) {
          return "undefined" != typeof URLSearchParams && e instanceof URLSearchParams;
        },
        isStandardBrowserEnv: function isStandardBrowserEnv() {
          return ("undefined" == typeof navigator || "ReactNative" !== navigator.product) && "undefined" != typeof window && "undefined" != typeof document;
        },
        forEach: d,
        merge: function e() {
          var t = {};

          function r(r, n) {
            "object" === o(t[n]) && "object" === (void 0 === r ? "undefined" : o(r)) ? t[n] = e(t[n], r) : t[n] = r;
          }

          for (var n = 0, i = arguments.length; n < i; n++) {
            d(arguments[n], r);
          }

          return t;
        },
        extend: function extend(e, t, r) {
          return d(t, function (t, o) {
            e[o] = r && "function" == typeof t ? n(t, r) : t;
          }), e;
        },
        trim: function trim(e) {
          return e.replace(/^\s*/, "").replace(/\s*$/, "");
        }
      };
    }, function (e, t, r) {
      (function (t) {
        var o = r(0),
            n = r(13),
            i = {
          "Content-Type": "application/x-www-form-urlencoded"
        };

        function l(e, t) {
          !o.isUndefined(e) && o.isUndefined(e["Content-Type"]) && (e["Content-Type"] = t);
        }

        var a = {
          adapter: function () {
            var e;
            return ("undefined" != typeof XMLHttpRequest || void 0 !== t) && (e = r(3)), e;
          }(),
          transformRequest: [function (e, t) {
            return n(t, "Content-Type"), o.isFormData(e) || o.isArrayBuffer(e) || o.isBuffer(e) || o.isStream(e) || o.isFile(e) || o.isBlob(e) ? e : o.isArrayBufferView(e) ? e.buffer : o.isURLSearchParams(e) ? (l(t, "application/x-www-form-urlencoded;charset=utf-8"), e.toString()) : o.isObject(e) ? (l(t, "application/json;charset=utf-8"), JSON.stringify(e)) : e;
          }],
          transformResponse: [function (e) {
            if ("string" == typeof e) try {
              e = JSON.parse(e);
            } catch (e) {}
            return e;
          }],
          timeout: 0,
          xsrfCookieName: "XSRF-TOKEN",
          xsrfHeaderName: "X-XSRF-TOKEN",
          maxContentLength: -1,
          validateStatus: function validateStatus(e) {
            return e >= 200 && e < 300;
          },
          headers: {
            common: {
              Accept: "application/json, text/plain, */*"
            }
          }
        };
        o.forEach(["delete", "get", "head"], function (e) {
          a.headers[e] = {};
        }), o.forEach(["post", "put", "patch"], function (e) {
          a.headers[e] = o.merge(i);
        }), e.exports = a;
      }).call(this, r(12));
    }, function (e, t, r) {
      e.exports = function (e, t) {
        return function () {
          for (var r = new Array(arguments.length), o = 0; o < r.length; o++) {
            r[o] = arguments[o];
          }

          return e.apply(t, r);
        };
      };
    }, function (e, t, r) {
      var o = r(0),
          n = r(14),
          i = r(16),
          l = r(17),
          a = r(18),
          s = r(4),
          c = "undefined" != typeof window && window.btoa && window.btoa.bind(window) || r(19);

      e.exports = function (e) {
        return new Promise(function (t, d) {
          var u = e.data,
              f = e.headers;
          o.isFormData(u) && delete f["Content-Type"];
          var p = new XMLHttpRequest(),
              m = "onreadystatechange",
              b = !1;

          if ("undefined" == typeof window || !window.XDomainRequest || "withCredentials" in p || a(e.url) || (p = new window.XDomainRequest(), m = "onload", b = !0, p.onprogress = function () {}, p.ontimeout = function () {}), e.auth) {
            var h = e.auth.username || "",
                g = e.auth.password || "";
            f.Authorization = "Basic " + c(h + ":" + g);
          }

          if (p.open(e.method.toUpperCase(), i(e.url, e.params, e.paramsSerializer), !0), p.timeout = e.timeout, p[m] = function () {
            if (p && (4 === p.readyState || b) && (0 !== p.status || p.responseURL && 0 === p.responseURL.indexOf("file:"))) {
              var r = "getAllResponseHeaders" in p ? l(p.getAllResponseHeaders()) : null,
                  o = {
                data: e.responseType && "text" !== e.responseType ? p.response : p.responseText,
                status: 1223 === p.status ? 204 : p.status,
                statusText: 1223 === p.status ? "No Content" : p.statusText,
                headers: r,
                config: e,
                request: p
              };
              n(t, d, o), p = null;
            }
          }, p.onerror = function () {
            d(s("Network Error", e, null, p)), p = null;
          }, p.ontimeout = function () {
            d(s("timeout of " + e.timeout + "ms exceeded", e, "ECONNABORTED", p)), p = null;
          }, o.isStandardBrowserEnv()) {
            var y = r(20),
                w = (e.withCredentials || a(e.url)) && e.xsrfCookieName ? y.read(e.xsrfCookieName) : void 0;
            w && (f[e.xsrfHeaderName] = w);
          }

          if ("setRequestHeader" in p && o.forEach(f, function (e, t) {
            void 0 === u && "content-type" === t.toLowerCase() ? delete f[t] : p.setRequestHeader(t, e);
          }), e.withCredentials && (p.withCredentials = !0), e.responseType) try {
            p.responseType = e.responseType;
          } catch (t) {
            if ("json" !== e.responseType) throw t;
          }
          "function" == typeof e.onDownloadProgress && p.addEventListener("progress", e.onDownloadProgress), "function" == typeof e.onUploadProgress && p.upload && p.upload.addEventListener("progress", e.onUploadProgress), e.cancelToken && e.cancelToken.promise.then(function (e) {
            p && (p.abort(), d(e), p = null);
          }), void 0 === u && (u = null), p.send(u);
        });
      };
    }, function (e, t, r) {
      var o = r(15);

      e.exports = function (e, t, r, n, i) {
        var l = new Error(e);
        return o(l, t, r, n, i);
      };
    }, function (e, t, r) {
      e.exports = function (e) {
        return !(!e || !e.__CANCEL__);
      };
    }, function (e, t, r) {
      function o(e) {
        this.message = e;
      }

      o.prototype.toString = function () {
        return "Cancel" + (this.message ? ": " + this.message : "");
      }, o.prototype.__CANCEL__ = !0, e.exports = o;
    }, function (e, t, r) {
      t.__esModule = !0, t.I18N = void 0;

      var o = "function" == typeof Symbol && "symbol" == _typeof(Symbol.iterator) ? function (e) {
        return _typeof(e);
      } : function (e) {
        return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : _typeof(e);
      },
          n = function () {
        function e(e, t) {
          for (var r = 0; r < t.length; r++) {
            var o = t[r];
            o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o);
          }
        }

        return function (t, r, o) {
          return r && e(t.prototype, r), o && e(t, o), t;
        };
      }(),
          i = r(8),
          l = {
        extension: ".lang",
        location: "assets/lang/",
        langs: ["en-US"],
        locale: "en-US",
        override: {}
      },
          a = t.I18N = function () {
        function e() {
          var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : l;
          !function (e, t) {
            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function");
          }(this, e), this.langs = Object.create(null), this.loaded = [], this.processConfig(t);
        }

        return e.prototype.processConfig = function (e) {
          var t = this,
              r = Object.assign({}, l, e),
              o = r.location,
              n = function (e, t) {
            var r = {};

            for (var o in e) {
              t.indexOf(o) >= 0 || Object.prototype.hasOwnProperty.call(e, o) && (r[o] = e[o]);
            }

            return r;
          }(r, ["location"]),
              i = o.replace(/\/?$/, "/");

          this.config = Object.assign({}, {
            location: i
          }, n);
          var a = this.config,
              s = a.override,
              c = a.preloaded,
              d = void 0 === c ? {} : c,
              u = Object.entries(this.langs).concat(Object.entries(s || d));
          this.langs = u.reduce(function (e, r) {
            var o = r[0],
                n = r[1];
            return e[o] = t.applyLanguage.call(t, o, n), e;
          }, {}), this.locale = this.config.locale || this.config.langs[0];
        }, e.prototype.init = function (e) {
          return this.processConfig.call(this, Object.assign({}, this.config, e)), this.setCurrent(this.locale);
        }, e.prototype.addLanguage = function (e) {
          var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
          t = "string" == typeof t ? this.processFile.call(this, t) : t, this.applyLanguage.call(this, e, t), this.config.langs.push("locale");
        }, e.prototype.getValue = function (e) {
          var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.locale;
          return this.langs[t] && this.langs[t][e] || this.getFallbackValue(e);
        }, e.prototype.getFallbackValue = function (e) {
          var t = Object.values(this.langs).find(function (t) {
            return t[e];
          });
          return t && t[e];
        }, e.prototype.makeSafe = function (e) {
          var t = {
            "{": "\\{",
            "}": "\\}",
            "|": "\\|"
          };
          return e = e.replace(/\{|\}|\|/g, function (e) {
            return t[e];
          }), new RegExp(e, "g");
        }, e.prototype.put = function (e, t) {
          return this.current[e] = t;
        }, e.prototype.get = function (e, t) {
          var r = this.getValue(e);

          if (r) {
            var n = r.match(/\{[^}]+?\}/g),
                i = void 0;
            if (t && n) if ("object" === (void 0 === t ? "undefined" : o(t))) for (var l = 0; l < n.length; l++) {
              i = n[l].substring(1, n[l].length - 1), r = r.replace(this.makeSafe(n[l]), t[i] || "");
            } else r = r.replace(/\{[^}]+?\}/g, t);
            return r;
          }
        }, e.prototype.fromFile = function (e) {
          for (var t, r = e.split("\n"), o = {}, n = 0; n < r.length; n++) {
            (t = r[n].match(/^(.+?) *?= *?([^\n]+)/)) && (o[t[1]] = t[2].replace(/^\s+|\s+$/, ""));
          }

          return o;
        }, e.prototype.processFile = function (e) {
          return this.fromFile(e.replace(/\n\n/g, "\n"));
        }, e.prototype.loadLang = function (e) {
          var t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1],
              r = this;
          return new Promise(function (o, n) {
            if (-1 !== r.loaded.indexOf(e) && t) return r.applyLanguage.call(r, r.langs[e]), o(r.langs[e]);
            var l = [r.config.location, e, r.config.extension].join("");
            return (0, i.get)(l).then(function (t) {
              var n = t.data,
                  i = r.processFile(n);
              return r.applyLanguage.call(r, e, i), r.loaded.push(e), o(r.langs[e]);
            })["catch"](function () {
              var t = r.applyLanguage.call(r, e);
              o(t);
            });
          });
        }, e.prototype.applyLanguage = function (e) {
          var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
              r = this.config.override[e] || {},
              o = this.langs[e] || {};
          return this.langs[e] = Object.assign({}, o, t, r), this.langs[e];
        }, e.prototype.setCurrent = function () {
          var e = this,
              t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "en-US";
          return this.loadLang(t).then(function () {
            return e.locale = t, e.current = e.langs[t], e.current;
          });
        }, n(e, [{
          key: "getLangs",
          get: function get() {
            return this.config.langs;
          }
        }]), e;
      }();

      t["default"] = new a();
    }, function (e, t, r) {
      e.exports = r(9);
    }, function (e, t, r) {
      var o = r(0),
          n = r(2),
          i = r(11),
          l = r(1);

      function a(e) {
        var t = new i(e),
            r = n(i.prototype.request, t);
        return o.extend(r, i.prototype, t), o.extend(r, t), r;
      }

      var s = a(l);
      s.Axios = i, s.create = function (e) {
        return a(o.merge(l, e));
      }, s.Cancel = r(6), s.CancelToken = r(26), s.isCancel = r(5), s.all = function (e) {
        return Promise.all(e);
      }, s.spread = r(27), e.exports = s, e.exports["default"] = s;
    }, function (e, t, r) {
      /*!
       * Determine if an object is a Buffer
       *
       * @author   Feross Aboukhadijeh <https://feross.org>
       * @license  MIT
       */
      function o(e) {
        return !!e.constructor && "function" == typeof e.constructor.isBuffer && e.constructor.isBuffer(e);
      }

      e.exports = function (e) {
        return null != e && (o(e) || function (e) {
          return "function" == typeof e.readFloatLE && "function" == typeof e.slice && o(e.slice(0, 0));
        }(e) || !!e._isBuffer);
      };
    }, function (e, t, r) {
      var o = r(1),
          n = r(0),
          i = r(21),
          l = r(22);

      function a(e) {
        this.defaults = e, this.interceptors = {
          request: new i(),
          response: new i()
        };
      }

      a.prototype.request = function (e) {
        "string" == typeof e && (e = n.merge({
          url: arguments[0]
        }, arguments[1])), (e = n.merge(o, {
          method: "get"
        }, this.defaults, e)).method = e.method.toLowerCase();
        var t = [l, void 0],
            r = Promise.resolve(e);

        for (this.interceptors.request.forEach(function (e) {
          t.unshift(e.fulfilled, e.rejected);
        }), this.interceptors.response.forEach(function (e) {
          t.push(e.fulfilled, e.rejected);
        }); t.length;) {
          r = r.then(t.shift(), t.shift());
        }

        return r;
      }, n.forEach(["delete", "get", "head", "options"], function (e) {
        a.prototype[e] = function (t, r) {
          return this.request(n.merge(r || {}, {
            method: e,
            url: t
          }));
        };
      }), n.forEach(["post", "put", "patch"], function (e) {
        a.prototype[e] = function (t, r, o) {
          return this.request(n.merge(o || {}, {
            method: e,
            url: t,
            data: r
          }));
        };
      }), e.exports = a;
    }, function (e, t, r) {
      var o,
          n,
          i = e.exports = {};

      function l() {
        throw new Error("setTimeout has not been defined");
      }

      function a() {
        throw new Error("clearTimeout has not been defined");
      }

      function s(e) {
        if (o === setTimeout) return setTimeout(e, 0);
        if ((o === l || !o) && setTimeout) return o = setTimeout, setTimeout(e, 0);

        try {
          return o(e, 0);
        } catch (t) {
          try {
            return o.call(null, e, 0);
          } catch (t) {
            return o.call(this, e, 0);
          }
        }
      }

      !function () {
        try {
          o = "function" == typeof setTimeout ? setTimeout : l;
        } catch (e) {
          o = l;
        }

        try {
          n = "function" == typeof clearTimeout ? clearTimeout : a;
        } catch (e) {
          n = a;
        }
      }();
      var c,
          d = [],
          u = !1,
          f = -1;

      function p() {
        u && c && (u = !1, c.length ? d = c.concat(d) : f = -1, d.length && m());
      }

      function m() {
        if (!u) {
          var e = s(p);
          u = !0;

          for (var t = d.length; t;) {
            for (c = d, d = []; ++f < t;) {
              c && c[f].run();
            }

            f = -1, t = d.length;
          }

          c = null, u = !1, function (e) {
            if (n === clearTimeout) return clearTimeout(e);
            if ((n === a || !n) && clearTimeout) return n = clearTimeout, clearTimeout(e);

            try {
              n(e);
            } catch (t) {
              try {
                return n.call(null, e);
              } catch (t) {
                return n.call(this, e);
              }
            }
          }(e);
        }
      }

      function b(e, t) {
        this.fun = e, this.array = t;
      }

      function h() {}

      i.nextTick = function (e) {
        var t = new Array(arguments.length - 1);
        if (arguments.length > 1) for (var r = 1; r < arguments.length; r++) {
          t[r - 1] = arguments[r];
        }
        d.push(new b(e, t)), 1 !== d.length || u || s(m);
      }, b.prototype.run = function () {
        this.fun.apply(null, this.array);
      }, i.title = "browser", i.browser = !0, i.env = {}, i.argv = [], i.version = "", i.versions = {}, i.on = h, i.addListener = h, i.once = h, i.off = h, i.removeListener = h, i.removeAllListeners = h, i.emit = h, i.prependListener = h, i.prependOnceListener = h, i.listeners = function (e) {
        return [];
      }, i.binding = function (e) {
        throw new Error("process.binding is not supported");
      }, i.cwd = function () {
        return "/";
      }, i.chdir = function (e) {
        throw new Error("process.chdir is not supported");
      }, i.umask = function () {
        return 0;
      };
    }, function (e, t, r) {
      var o = r(0);

      e.exports = function (e, t) {
        o.forEach(e, function (r, o) {
          o !== t && o.toUpperCase() === t.toUpperCase() && (e[t] = r, delete e[o]);
        });
      };
    }, function (e, t, r) {
      var o = r(4);

      e.exports = function (e, t, r) {
        var n = r.config.validateStatus;
        r.status && n && !n(r.status) ? t(o("Request failed with status code " + r.status, r.config, null, r.request, r)) : e(r);
      };
    }, function (e, t, r) {
      e.exports = function (e, t, r, o, n) {
        return e.config = t, r && (e.code = r), e.request = o, e.response = n, e;
      };
    }, function (e, t, r) {
      var o = r(0);

      function n(e) {
        return encodeURIComponent(e).replace(/%40/gi, "@").replace(/%3A/gi, ":").replace(/%24/g, "$").replace(/%2C/gi, ",").replace(/%20/g, "+").replace(/%5B/gi, "[").replace(/%5D/gi, "]");
      }

      e.exports = function (e, t, r) {
        if (!t) return e;
        var i;
        if (r) i = r(t);else if (o.isURLSearchParams(t)) i = t.toString();else {
          var l = [];
          o.forEach(t, function (e, t) {
            null != e && (o.isArray(e) ? t += "[]" : e = [e], o.forEach(e, function (e) {
              o.isDate(e) ? e = e.toISOString() : o.isObject(e) && (e = JSON.stringify(e)), l.push(n(t) + "=" + n(e));
            }));
          }), i = l.join("&");
        }
        return i && (e += (-1 === e.indexOf("?") ? "?" : "&") + i), e;
      };
    }, function (e, t, r) {
      var o = r(0),
          n = ["age", "authorization", "content-length", "content-type", "etag", "expires", "from", "host", "if-modified-since", "if-unmodified-since", "last-modified", "location", "max-forwards", "proxy-authorization", "referer", "retry-after", "user-agent"];

      e.exports = function (e) {
        var t,
            r,
            i,
            l = {};
        return e ? (o.forEach(e.split("\n"), function (e) {
          if (i = e.indexOf(":"), t = o.trim(e.substr(0, i)).toLowerCase(), r = o.trim(e.substr(i + 1)), t) {
            if (l[t] && n.indexOf(t) >= 0) return;
            l[t] = "set-cookie" === t ? (l[t] ? l[t] : []).concat([r]) : l[t] ? l[t] + ", " + r : r;
          }
        }), l) : l;
      };
    }, function (e, t, r) {
      var o = r(0);
      e.exports = o.isStandardBrowserEnv() ? function () {
        var e,
            t = /(msie|trident)/i.test(navigator.userAgent),
            r = document.createElement("a");

        function n(e) {
          var o = e;
          return t && (r.setAttribute("href", o), o = r.href), r.setAttribute("href", o), {
            href: r.href,
            protocol: r.protocol ? r.protocol.replace(/:$/, "") : "",
            host: r.host,
            search: r.search ? r.search.replace(/^\?/, "") : "",
            hash: r.hash ? r.hash.replace(/^#/, "") : "",
            hostname: r.hostname,
            port: r.port,
            pathname: "/" === r.pathname.charAt(0) ? r.pathname : "/" + r.pathname
          };
        }

        return e = n(window.location.href), function (t) {
          var r = o.isString(t) ? n(t) : t;
          return r.protocol === e.protocol && r.host === e.host;
        };
      }() : function () {
        return !0;
      };
    }, function (e, t, r) {
      function o() {
        this.message = "String contains an invalid character";
      }

      o.prototype = new Error(), o.prototype.code = 5, o.prototype.name = "InvalidCharacterError", e.exports = function (e) {
        for (var t, r, n = String(e), i = "", l = 0, a = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/="; n.charAt(0 | l) || (a = "=", l % 1); i += a.charAt(63 & t >> 8 - l % 1 * 8)) {
          if ((r = n.charCodeAt(l += 0.75)) > 255) throw new o();
          t = t << 8 | r;
        }

        return i;
      };
    }, function (e, t, r) {
      var o = r(0);
      e.exports = o.isStandardBrowserEnv() ? {
        write: function write(e, t, r, n, i, l) {
          var a = [];
          a.push(e + "=" + encodeURIComponent(t)), o.isNumber(r) && a.push("expires=" + new Date(r).toGMTString()), o.isString(n) && a.push("path=" + n), o.isString(i) && a.push("domain=" + i), !0 === l && a.push("secure"), document.cookie = a.join("; ");
        },
        read: function read(e) {
          var t = document.cookie.match(new RegExp("(^|;\\s*)(" + e + ")=([^;]*)"));
          return t ? decodeURIComponent(t[3]) : null;
        },
        remove: function remove(e) {
          this.write(e, "", Date.now() - 864e5);
        }
      } : {
        write: function write() {},
        read: function read() {
          return null;
        },
        remove: function remove() {}
      };
    }, function (e, t, r) {
      var o = r(0);

      function n() {
        this.handlers = [];
      }

      n.prototype.use = function (e, t) {
        return this.handlers.push({
          fulfilled: e,
          rejected: t
        }), this.handlers.length - 1;
      }, n.prototype.eject = function (e) {
        this.handlers[e] && (this.handlers[e] = null);
      }, n.prototype.forEach = function (e) {
        o.forEach(this.handlers, function (t) {
          null !== t && e(t);
        });
      }, e.exports = n;
    }, function (e, t, r) {
      var o = r(0),
          n = r(23),
          i = r(5),
          l = r(1),
          a = r(24),
          s = r(25);

      function c(e) {
        e.cancelToken && e.cancelToken.throwIfRequested();
      }

      e.exports = function (e) {
        return c(e), e.baseURL && !a(e.url) && (e.url = s(e.baseURL, e.url)), e.headers = e.headers || {}, e.data = n(e.data, e.headers, e.transformRequest), e.headers = o.merge(e.headers.common || {}, e.headers[e.method] || {}, e.headers || {}), o.forEach(["delete", "get", "head", "post", "put", "patch", "common"], function (t) {
          delete e.headers[t];
        }), (e.adapter || l.adapter)(e).then(function (t) {
          return c(e), t.data = n(t.data, t.headers, e.transformResponse), t;
        }, function (t) {
          return i(t) || (c(e), t && t.response && (t.response.data = n(t.response.data, t.response.headers, e.transformResponse))), Promise.reject(t);
        });
      };
    }, function (e, t, r) {
      var o = r(0);

      e.exports = function (e, t, r) {
        return o.forEach(r, function (r) {
          e = r(e, t);
        }), e;
      };
    }, function (e, t, r) {
      e.exports = function (e) {
        return /^([a-z][a-z\d\+\-\.]*:)?\/\//i.test(e);
      };
    }, function (e, t, r) {
      e.exports = function (e, t) {
        return t ? e.replace(/\/+$/, "") + "/" + t.replace(/^\/+/, "") : e;
      };
    }, function (e, t, r) {
      var o = r(6);

      function n(e) {
        if ("function" != typeof e) throw new TypeError("executor must be a function.");
        var t;
        this.promise = new Promise(function (e) {
          t = e;
        });
        var r = this;
        e(function (e) {
          r.reason || (r.reason = new o(e), t(r.reason));
        });
      }

      n.prototype.throwIfRequested = function () {
        if (this.reason) throw this.reason;
      }, n.source = function () {
        var e;
        return {
          token: new n(function (t) {
            e = t;
          }),
          cancel: e
        };
      }, e.exports = n;
    }, function (e, t, r) {
      e.exports = function (e) {
        return function (t) {
          return e.apply(null, t);
        };
      };
    }]);
  }, function (e, t, r) {
    r.d(t, "c", function () {
      return i;
    }), r.d(t, "d", function () {
      return l;
    }), r.d(t, "b", function () {
      return a;
    }), r.d(t, "a", function () {
      return s;
    });
    var o = r(2);

    var n = function n() {
      return null;
    };

    r.n(o).a.addLanguage("en-US", {
      NATIVE_NAME: "English (US)",
      ENGLISH_NAME: "English",
      addOption: "Add Option +",
      allFieldsRemoved: "All fields were removed.",
      allowMultipleFiles: "Allow users to upload multiple files",
      autocomplete: "Autocomplete",
      button: "Button",
      cannotBeEmpty: "This field cannot be empty",
      checkboxGroup: "Checkbox Group",
      checkbox: "Checkbox",
      checkboxes: "Checkboxes",
      className: "Class",
      clearAllMessage: "Are you sure you want to clear all fields?",
      clear: "Clear",
      close: "Close",
      content: "Content",
      copy: "Copy To Clipboard",
      copyButton: "&#43;",
      copyButtonTooltip: "Copy",
      dateField: "Date Field",
      description: "Help Text",
      descriptionField: "Description",
      devMode: "Developer Mode",
      editNames: "Edit Names",
      editorTitle: "Form Elements",
      editXML: "Edit XML",
      enableOther: "Enable &quot;Other&quot;",
      enableOtherMsg: "Let users enter an unlisted option",
      fieldDeleteWarning: "false",
      fieldVars: "Field Variables",
      fieldNonEditable: "This field cannot be edited.",
      fieldRemoveWarning: "Are you sure you want to remove this field?",
      fileUpload: "File Upload",
      formUpdated: "Form Updated",
      getStarted: "Drag a field from the right to this area",
      header: "Header",
      hide: "Edit",
      hidden: "Hidden Input",
      inline: "Inline",
      inlineDesc: "Display {type} inline",
      label: "Label",
      labelEmpty: "Field Label cannot be empty",
      limitRole: "Limit access to one or more of the following roles:",
      mandatory: "Mandatory",
      maxlength: "Max Length",
      minOptionMessage: "This field requires a minimum of 2 options",
      minSelectionRequired: "Minimum {min} selections required",
      multipleFiles: "Multiple Files",
      name: "Name",
      no: "No",
      noFieldsToClear: "There are no fields to clear",
      number: "Number",
      off: "Off",
      on: "On",
      option: "Option",
      optionCount: "Option {count}",
      options: "Options",
      optional: "optional",
      optionLabelPlaceholder: "Label",
      optionValuePlaceholder: "Value",
      optionEmpty: "Option value required",
      other: "Other",
      paragraph: "Paragraph",
      placeholder: "Placeholder",
      "placeholders.value": "Value",
      "placeholders.label": "Label",
      "placeholders.email": "Enter your email",
      "placeholders.className": "space separated classes",
      "placeholders.password": "Enter your password",
      preview: "Preview",
      radioGroup: "Radio Group",
      radio: "Radio",
      removeMessage: "Remove Element",
      removeOption: "Remove Option",
      remove: "&#215;",
      required: "Required",
      requireValidOption: "Only accept a pre-defined Option",
      richText: "Rich Text Editor",
      roles: "Access",
      rows: "Rows",
      save: "Save",
      selectOptions: "Options",
      select: "Select",
      selectColor: "Select Color",
      selectionsMessage: "Allow Multiple Selections",
      size: "Size",
      "size.xs": "Extra Small",
      "size.sm": "Small",
      "size.m": "Default",
      "size.lg": "Large",
      style: "Style",
      "styles.btn.default": "Default",
      "styles.btn.danger": "Danger",
      "styles.btn.info": "Info",
      "styles.btn.primary": "Primary",
      "styles.btn.success": "Success",
      "styles.btn.warning": "Warning",
      subtype: "Type",
      text: "Text Field",
      textArea: "Text Area",
      toggle: "Toggle",
      warning: "Warning!",
      value: "Value",
      viewJSON: "[{&hellip;}]",
      viewXML: "&lt;/&gt;",
      yes: "Yes"
    });
    var i = {
      actionButtons: [],
      allowStageSort: !0,
      append: !1,
      controlOrder: ["autocomplete", "button", "checkbox-group", "checkbox", "date", "file", "header", "hidden", "number", "paragraph", "radio-group", "select", "text", "textarea"],
      controlPosition: "right",
      dataType: "json",
      defaultFields: [],
      disabledActionButtons: [],
      disabledAttrs: [],
      disabledFieldButtons: {},
      disabledSubtypes: {},
      disableFields: [],
      disableHTMLLabels: !1,
      disableInjectedStyle: !1,
      editOnAdd: !1,
      fields: [],
      fieldRemoveWarn: !1,
      fieldEditContainer: null,
      inputSets: [],
      notify: {
        error: function error(e) {
          console.log(e);
        },
        success: function success(e) {
          console.log(e);
        },
        warning: function warning(e) {
          console.warn(e);
        }
      },
      onAddField: function onAddField(e, t) {
        return t;
      },
      onAddFieldAfter: function onAddFieldAfter(e, t) {
        return t;
      },
      onAddOption: function onAddOption(e) {
        return e;
      },
      onClearAll: n,
      onCloseFieldEdit: n,
      onOpenFieldEdit: n,
      onSave: n,
      persistDefaultFields: !1,
      prepend: !1,
      replaceFields: [],
      roles: {
        1: "Administrator"
      },
      scrollToFieldOnAdd: !0,
      showActionButtons: !0,
      sortableControls: !1,
      stickyControls: {
        enable: !0,
        offset: {
          top: 5,
          bottom: "auto",
          right: "auto"
        }
      },
      subtypes: {},
      templates: {},
      typeUserAttrs: {},
      typeUserDisabledAttrs: {},
      typeUserEvents: {}
    },
        l = {
      btn: ["default", "danger", "info", "primary", "success", "warning"]
    },
        a = {
      location: "assets/lang/"
    },
        s = {};
  }, function (e, t, r) {
    r.d(t, "d", function () {
      return o;
    }), r.d(t, "f", function () {
      return i;
    }), r.d(t, "b", function () {
      return l;
    }), r.d(t, "c", function () {
      return a;
    }), r.d(t, "e", function () {
      return s;
    }), r.d(t, "a", function () {
      return d;
    });

    var o = {},
        n = {
      text: ["text", "password", "email", "color", "tel"],
      header: ["h1", "h2", "h3"],
      button: ["button", "submit", "reset"],
      paragraph: ["p", "address", "blockquote", "canvas", "output"],
      textarea: ["textarea", "quill"]
    },
        i = function i(e) {
      e.parentNode && e.parentNode.removeChild(e);
    },
        l = function l(e) {
      for (; e.firstChild;) {
        e.removeChild(e.firstChild);
      }

      return e;
    },
        a = function a(e, t) {
      var r = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : !0;
      var o = [];
      var n = ["none", "block"];
      r && (n = n.reverse());

      for (var _r8 = e.length - 1; _r8 >= 0; _r8--) {
        -1 !== e[_r8].textContent.toLowerCase().indexOf(t.toLowerCase()) ? (e[_r8].style.display = n[0], o.push(e[_r8])) : e[_r8].style.display = n[1];
      }

      return o;
    },
        s = ["select", "checkbox-group", "checkbox", "radio-group", "autocomplete"],
        c = new RegExp("(".concat(s.join("|"), ")"));

    var d = /*#__PURE__*/function () {
      function d(e) {
        _classCallCheck(this, d);

        return this.optionFields = s, this.optionFieldsRegEx = c, this.subtypes = n, this.empty = l, this.filter = a, o[e] = this, o[e];
      }

      _createClass(d, [{
        key: "onRender",
        value: function onRender(e, t) {
          var _this2 = this;

          e.parentElement ? t(e) : window.requestAnimationFrame(function () {
            return _this2.onRender(e, t);
          });
        }
      }]);

      return d;
    }();
  }, function (e, t, r) {
    function o(e) {
      var t;
      return "function" == typeof Event ? t = new Event(e) : (t = document.createEvent("Event"), t.initEvent(e, !0, !0)), t;
    }

    var n = {
      loaded: o("loaded"),
      viewData: o("viewData"),
      userDeclined: o("userDeclined"),
      modalClosed: o("modalClosed"),
      modalOpened: o("modalOpened"),
      formSaved: o("formSaved"),
      fieldAdded: o("fieldAdded"),
      fieldRemoved: o("fieldRemoved"),
      fieldRendered: o("fieldRendered"),
      fieldEditOpened: o("fieldEditOpened"),
      fieldEditClosed: o("fieldEditClosed")
    };
    t.a = n;
  }, function (e, t, r) {
    r.d(t, "a", function () {
      return l;
    });
    var o = r(1),
        n = r(2),
        i = r.n(n);

    var l = /*#__PURE__*/function (_o$a) {
      _inherits(l, _o$a);

      var _super = _createSuper(l);

      function l() {
        _classCallCheck(this, l);

        return _super.apply(this, arguments);
      }

      _createClass(l, [{
        key: "build",
        value: function build() {
          var e = l.templates[this.type];
          if (!e) return this.error("Invalid custom control type. Please ensure you have registered it correctly as a template option.");
          var t = Object.assign(this.config),
              r = ["label", "description", "subtype", "id", "isPreview", "required", "title", "aria-required", "type"];

          for (var _i4 = 0, _r9 = r; _i4 < _r9.length; _i4++) {
            var _e7 = _r9[_i4];
            t[_e7] = this.config[_e7] || this[_e7];
          }

          return e = e.bind(this), e = e(t), e.js && (this.js = e.js), e.css && (this.css = e.css), this.onRender = e.onRender, {
            field: e.field,
            layout: e.layout
          };
        }
      }], [{
        key: "register",
        value: function register() {
          var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
          var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];
          l.customRegister = {}, l.def || (l.def = {
            icon: {},
            i18n: {}
          }), l.templates = e;
          var r = i.a.locale;
          l.def.i18n[r] || (l.def.i18n[r] = {}), o.a.register(Object.keys(e), l);

          var _iterator3 = _createForOfIteratorHelper(t),
              _step3;

          try {
            for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
              var _n3 = _step3.value;
              var _t8 = _n3.type;

              if (_n3.attrs = _n3.attrs || {}, !_t8) {
                if (!_n3.attrs.type) {
                  this.error("Ignoring invalid custom field definition. Please specify a type property.");
                  continue;
                }

                _t8 = _n3.attrs.type;
              }

              var _i5 = _n3.subtype || _t8;

              if (!e[_t8]) {
                var _e8 = o.a.getClass(_t8, _n3.subtype);

                if (!_e8) {
                  this.error("Error while registering custom field: " + _t8 + (_n3.subtype ? ":" + _n3.subtype : "") + ". Unable to find any existing defined control or template for rendering.");
                  continue;
                }

                _i5 = _n3.datatype ? _n3.datatype : "".concat(_t8, "-").concat(Math.floor(9e3 * Math.random() + 1e3)), l.customRegister[_i5] = jQuery.extend(_n3, {
                  type: _t8,
                  "class": _e8
                });
              }

              l.def.i18n[r][_i5] = _n3.label, l.def.icon[_i5] = _n3.icon;
            }
          } catch (err) {
            _iterator3.e(err);
          } finally {
            _iterator3.f();
          }
        }
      }, {
        key: "getRegistered",
        value: function getRegistered() {
          var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : !1;
          return e ? o.a.getRegistered(e) : Object.keys(l.customRegister);
        }
      }, {
        key: "lookup",
        value: function lookup(e) {
          return l.customRegister[e];
        }
      }, {
        key: "definition",
        get: function get() {
          return l.def;
        }
      }]);

      return l;
    }(o.a);

    l.customRegister = {};
  }, function (e, t, r) {
    e.exports = function (e) {
      var t = [];
      return t.toString = function () {
        return this.map(function (t) {
          var r = function (e, t) {
            var r = e[1] || "",
                o = e[3];
            if (!o) return r;

            if (t && "function" == typeof btoa) {
              var n = (l = o, a = btoa(unescape(encodeURIComponent(JSON.stringify(l)))), s = "sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(a), "/*# ".concat(s, " */")),
                  i = o.sources.map(function (e) {
                return "/*# sourceURL=".concat(o.sourceRoot || "").concat(e, " */");
              });
              return [r].concat(i).concat([n]).join("\n");
            }

            var l, a, s;
            return [r].join("\n");
          }(t, e);

          return t[2] ? "@media ".concat(t[2], " {").concat(r, "}") : r;
        }).join("");
      }, t.i = function (e, r, o) {
        "string" == typeof e && (e = [[null, e, ""]]);
        var n = {};
        if (o) for (var i = 0; i < this.length; i++) {
          var l = this[i][0];
          null != l && (n[l] = !0);
        }

        for (var a = 0; a < e.length; a++) {
          var s = [].concat(e[a]);
          o && n[s[0]] || (r && (s[2] ? s[2] = "".concat(r, " and ").concat(s[2]) : s[2] = r), t.push(s));
        }
      }, t;
    };
  }, function (e) {
    e.exports = JSON.parse('{"a":"formbuilder-icon-"}');
  }, function (e, t, r) {
    var o,
        n = function n() {
      return void 0 === o && (o = Boolean(window && document && document.all && !window.atob)), o;
    },
        i = function () {
      var e = {};
      return function (t) {
        if (void 0 === e[t]) {
          var r = document.querySelector(t);
          if (window.HTMLIFrameElement && r instanceof window.HTMLIFrameElement) try {
            r = r.contentDocument.head;
          } catch (e) {
            r = null;
          }
          e[t] = r;
        }

        return e[t];
      };
    }(),
        l = [];

    function a(e) {
      for (var t = -1, r = 0; r < l.length; r++) {
        if (l[r].identifier === e) {
          t = r;
          break;
        }
      }

      return t;
    }

    function s(e, t) {
      for (var r = {}, o = [], n = 0; n < e.length; n++) {
        var i = e[n],
            s = t.base ? i[0] + t.base : i[0],
            c = r[s] || 0,
            d = "".concat(s, " ").concat(c);
        r[s] = c + 1;
        var u = a(d),
            f = {
          css: i[1],
          media: i[2],
          sourceMap: i[3]
        };
        -1 !== u ? (l[u].references++, l[u].updater(f)) : l.push({
          identifier: d,
          updater: h(f, t),
          references: 1
        }), o.push(d);
      }

      return o;
    }

    function c(e) {
      var t = document.createElement("style"),
          o = e.attributes || {};

      if (void 0 === o.nonce) {
        var n = r.nc;
        n && (o.nonce = n);
      }

      if (Object.keys(o).forEach(function (e) {
        t.setAttribute(e, o[e]);
      }), "function" == typeof e.insert) e.insert(t);else {
        var l = i(e.insert || "head");
        if (!l) throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
        l.appendChild(t);
      }
      return t;
    }

    var d,
        u = (d = [], function (e, t) {
      return d[e] = t, d.filter(Boolean).join("\n");
    });

    function f(e, t, r, o) {
      var n = r ? "" : o.media ? "@media ".concat(o.media, " {").concat(o.css, "}") : o.css;
      if (e.styleSheet) e.styleSheet.cssText = u(t, n);else {
        var i = document.createTextNode(n),
            l = e.childNodes;
        l[t] && e.removeChild(l[t]), l.length ? e.insertBefore(i, l[t]) : e.appendChild(i);
      }
    }

    function p(e, t, r) {
      var o = r.css,
          n = r.media,
          i = r.sourceMap;
      if (n ? e.setAttribute("media", n) : e.removeAttribute("media"), i && btoa && (o += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(i)))), " */")), e.styleSheet) e.styleSheet.cssText = o;else {
        for (; e.firstChild;) {
          e.removeChild(e.firstChild);
        }

        e.appendChild(document.createTextNode(o));
      }
    }

    var m = null,
        b = 0;

    function h(e, t) {
      var r, o, n;

      if (t.singleton) {
        var i = b++;
        r = m || (m = c(t)), o = f.bind(null, r, i, !1), n = f.bind(null, r, i, !0);
      } else r = c(t), o = p.bind(null, r, t), n = function n() {
        !function (e) {
          if (null === e.parentNode) return !1;
          e.parentNode.removeChild(e);
        }(r);
      };

      return o(e), function (t) {
        if (t) {
          if (t.css === e.css && t.media === e.media && t.sourceMap === e.sourceMap) return;
          o(e = t);
        } else n();
      };
    }

    e.exports = function (e, t) {
      (t = t || {}).singleton || "boolean" == typeof t.singleton || (t.singleton = n());
      var r = s(e = e || [], t);
      return function (e) {
        if (e = e || [], "[object Array]" === Object.prototype.toString.call(e)) {
          for (var o = 0; o < r.length; o++) {
            var n = a(r[o]);
            l[n].references--;
          }

          for (var i = s(e, t), c = 0; c < r.length; c++) {
            var d = a(r[c]);
            0 === l[d].references && (l[d].updater(), l.splice(d, 1));
          }

          r = i;
        }
      };
    };
  }, function (e, t, r) {
    r.d(t, "a", function () {
      return i;
    });
    var o = r(0);

    var n = function n(e, t) {
      var r = e.id ? "formbuilder-".concat(e.type, " form-group field-").concat(e.id) : "";

      if (e.className) {
        var _o6 = e.className.split(" ");

        _o6 = _o6.filter(function (e) {
          return /^col-(xs|sm|md|lg)-([^\s]+)/.test(e) || e.startsWith("row-");
        }), _o6 && _o6.length > 0 && (r += " " + _o6.join(" "));

        for (var _e9 = 0; _e9 < _o6.length; _e9++) {
          var _r10 = _o6[_e9];
          t.classList.remove(_r10);
        }
      }

      return r;
    };

    var i = /*#__PURE__*/function () {
      function i(e, t) {
        var _this3 = this;

        _classCallCheck(this, i);

        this.preview = t, this.templates = {
          label: null,
          help: null,
          "default": function _default(e, t, r, o) {
            return r && t.appendChild(r), _this3.markup("div", [t, e], {
              className: n(o, e)
            });
          },
          noLabel: function noLabel(e, t, r, o) {
            return _this3.markup("div", e, {
              className: n(o, e)
            });
          },
          hidden: function hidden(e) {
            return e;
          }
        }, e && (this.templates = jQuery.extend(this.templates, e)), this.configure();
      }

      _createClass(i, [{
        key: "configure",
        value: function configure() {}
      }, {
        key: "build",
        value: function build(e, t, r) {
          this.preview && (t.name ? t.name = t.name + "-preview" : t.name = o.f.nameAttr(t) + "-preview"), t.id = t.name, this.data = jQuery.extend({}, t);
          var n = new e(t, this.preview);

          var _i6 = n.build();

          "object" == _typeof(_i6) && _i6.field || (_i6 = {
            field: _i6
          });
          var l = this.label(),
              a = this.help();
          var s;
          s = r && this.isTemplate(r) ? r : this.isTemplate(_i6.layout) ? _i6.layout : "default";
          var c = this.processTemplate(s, _i6.field, l, a);
          return n.on("prerender")(c), c.addEventListener("fieldRendered", n.on("render")), c;
        }
      }, {
        key: "label",
        value: function label() {
          var e = this.data.label || "",
              t = [o.f.parsedHtml(e)];
          return this.data.required && t.push(this.markup("span", "*", {
            className: "formbuilder-required"
          })), this.isTemplate("label") ? this.processTemplate("label", t) : this.markup("label", t, {
            "for": this.data.id,
            className: "formbuilder-".concat(this.data.type, "-label")
          });
        }
      }, {
        key: "help",
        value: function help() {
          return this.data.description ? this.isTemplate("help") ? this.processTemplate("help", this.data.description) : this.markup("span", "?", {
            className: "tooltip-element",
            tooltip: this.data.description
          }) : null;
        }
      }, {
        key: "isTemplate",
        value: function isTemplate(e) {
          return "function" == typeof this.templates[e];
        }
      }, {
        key: "processTemplate",
        value: function processTemplate(e) {
          var _this$templates;

          for (var _len = arguments.length, t = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
            t[_key - 1] = arguments[_key];
          }

          var r = (_this$templates = this.templates)[e].apply(_this$templates, t.concat([this.data]));

          return r.jquery && (r = r[0]), r;
        }
      }, {
        key: "markup",
        value: function markup(e) {
          var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "";
          var r = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
          return o.f.markup(e, t, r);
        }
      }]);

      return i;
    }();
  }, function (e, t) {
    e.exports = function (e) {
      var t = _typeof(e);

      return null != e && ("object" == t || "function" == t);
    };
  }, function (t, r, o) {
    var n = o(1),
        i = o(4);

    function l(e, t) {
      if (null == e) return {};

      var r,
          o,
          n = function (e, t) {
        if (null == e) return {};
        var r,
            o,
            n = {},
            i = Object.keys(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || (n[r] = e[r]);
        }

        return n;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || Object.prototype.propertyIsEnumerable.call(e, r) && (n[r] = e[r]);
        }
      }

      return n;
    }

    var a = /*#__PURE__*/function (_n$a) {
      _inherits(a, _n$a);

      var _super2 = _createSuper(a);

      function a() {
        _classCallCheck(this, a);

        return _super2.apply(this, arguments);
      }

      _createClass(a, [{
        key: "build",
        value: function build() {
          var _this4 = this;

          var e = this.config,
              t = e.values,
              r = e.type,
              o = l(e, ["values", "type"]),
              n = function n(e) {
            var t = e.target.nextSibling.nextSibling,
                r = e.target.nextSibling,
                o = _this4.getActiveOption(t);

            var n = new Map([[38, function () {
              var e = _this4.getPreviousOption(o);

              e && _this4.selectOption(t, e);
            }], [40, function () {
              var e = _this4.getNextOption(o);

              e && _this4.selectOption(t, e);
            }], [13, function () {
              o ? (e.target.value = o.innerHTML, r.value = o.getAttribute("value"), "none" === t.style.display ? _this4.showList(t, o) : _this4.hideList(t)) : _this4.config.requireValidOption && (_this4.isOptionValid(t, e.target.value) || (e.target.value = "", e.target.nextSibling.value = "")), e.preventDefault();
            }], [27, function () {
              _this4.hideList(t);
            }]]).get(e.keyCode);
            return n || (n = function n() {
              return !1;
            }), n();
          },
              _a2 = {
            focus: function focus(e) {
              var t = e.target.nextSibling.nextSibling,
                  r = Object(i.c)(t.querySelectorAll("li"), e.target.value);

              if (e.target.addEventListener("keydown", n), e.target.value.length > 0) {
                var _e10 = r.length > 0 ? r[r.length - 1] : null;

                _this4.showList(t, _e10);
              }
            },
            blur: function blur(e) {
              e.target.removeEventListener("keydown", n);
              var t = setTimeout(function () {
                e.target.nextSibling.nextSibling.style.display = "none", clearTimeout(t);
              }, 200);

              if (_this4.config.requireValidOption) {
                var _t9 = e.target.nextSibling.nextSibling;
                _this4.isOptionValid(_t9, e.target.value) || (e.target.value = "", e.target.nextSibling.value = "");
              }
            },
            input: function input(e) {
              var t = e.target.nextSibling.nextSibling;
              e.target.nextSibling.value = e.target.value;
              var r = Object(i.c)(t.querySelectorAll("li"), e.target.value);
              if (0 == r.length) _this4.hideList(t);else {
                var _e11 = _this4.getActiveOption(t);

                _e11 || (_e11 = r[r.length - 1]), _this4.showList(t, _e11);
              }
            }
          },
              s = Object.assign({}, o, {
            id: o.id + "-input",
            autocomplete: "off",
            events: _a2
          }),
              c = Object.assign({}, o, {
            type: "hidden"
          });

          delete s.name;
          var d = [this.markup("input", null, s), this.markup("input", null, c)],
              u = t.map(function (e) {
            var t = e.label,
                r = {
              events: {
                click: function click(t) {
                  var r = t.target.parentElement,
                      o = r.previousSibling.previousSibling;
                  o.value = e.label, o.nextSibling.value = e.value, _this4.hideList(r);
                }
              },
              value: e.value
            };
            return _this4.markup("li", t, r);
          });
          return d.push(this.markup("ul", u, {
            id: o.id + "-list",
            className: "formbuilder-".concat(r, "-list")
          })), d;
        }
      }, {
        key: "hideList",
        value: function hideList(e) {
          this.selectOption(e, null), e.style.display = "none";
        }
      }, {
        key: "showList",
        value: function showList(e, t) {
          this.selectOption(e, t), e.style.display = "block", e.style.width = e.parentElement.offsetWidth + "px";
        }
      }, {
        key: "getActiveOption",
        value: function getActiveOption(e) {
          var t = e.getElementsByClassName("active-option")[0];
          return t && "none" !== t.style.display ? t : null;
        }
      }, {
        key: "getPreviousOption",
        value: function getPreviousOption(e) {
          var t = e;

          do {
            t = t ? t.previousSibling : null;
          } while (null != t && "none" === t.style.display);

          return t;
        }
      }, {
        key: "getNextOption",
        value: function getNextOption(e) {
          var t = e;

          do {
            t = t ? t.nextSibling : null;
          } while (null != t && "none" === t.style.display);

          return t;
        }
      }, {
        key: "selectOption",
        value: function selectOption(e, t) {
          var r = e.querySelectorAll("li");

          for (var _e12 = 0; _e12 < r.length; _e12++) {
            r[_e12].classList.remove("active-option");
          }

          t && t.classList.add("active-option");
        }
      }, {
        key: "isOptionValid",
        value: function isOptionValid(e, t) {
          var r = e.querySelectorAll("li");
          var o = !1;

          for (var _e13 = 0; _e13 < r.length; _e13++) {
            if (r[_e13].innerHTML === t) {
              o = !0;
              break;
            }
          }

          return o;
        }
      }, {
        key: "onRender",
        value: function onRender(t) {
          if (this.config.userData) {
            var _t10 = e("#" + this.config.name),
                _r11 = _t10.next(),
                _o7 = this.config.userData[0];

            var _n4 = null;
            if (_r11.find("li").each(function () {
              e(this).attr("value") !== _o7 || (_n4 = e(this).get(0));
            }), null === _n4) return this.config.requireValidOption ? void 0 : void _t10.prev().val(this.config.userData[0]);
            _t10.prev().val(_n4.innerHTML), _t10.val(_n4.getAttribute("value"));

            var _i7 = _t10.next().get(0);

            "none" === _i7.style.display ? this.showList(_i7, _n4) : this.hideList(_i7);
          }

          return t;
        }
      }], [{
        key: "definition",
        get: function get() {
          return {
            mi18n: {
              requireValidOption: "requireValidOption"
            }
          };
        }
      }]);

      return a;
    }(n.a);

    n.a.register("autocomplete", a);

    var s = /*#__PURE__*/function (_n$a2) {
      _inherits(s, _n$a2);

      var _super3 = _createSuper(s);

      function s() {
        _classCallCheck(this, s);

        return _super3.apply(this, arguments);
      }

      _createClass(s, [{
        key: "build",
        value: function build() {
          return {
            field: this.markup("button", this.label, this.config),
            layout: "noLabel"
          };
        }
      }]);

      return s;
    }(n.a);

    n.a.register("button", s), n.a.register(["button", "submit", "reset"], s, "button");
    var c = o(6);

    var d = /*#__PURE__*/function (_n$a3) {
      _inherits(d, _n$a3);

      var _super4 = _createSuper(d);

      function d() {
        _classCallCheck(this, d);

        return _super4.apply(this, arguments);
      }

      _createClass(d, [{
        key: "build",
        value: function build() {
          return {
            field: this.markup("input", null, this.config),
            layout: "hidden"
          };
        }
      }, {
        key: "onRender",
        value: function onRender() {
          this.config.userData && e("#" + this.config.name).val(this.config.userData[0]);
        }
      }]);

      return d;
    }(n.a);

    n.a.register("hidden", d);
    var u = o(0);

    function f(e, t) {
      if (null == e) return {};

      var r,
          o,
          n = function (e, t) {
        if (null == e) return {};
        var r,
            o,
            n = {},
            i = Object.keys(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || (n[r] = e[r]);
        }

        return n;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || Object.prototype.propertyIsEnumerable.call(e, r) && (n[r] = e[r]);
        }
      }

      return n;
    }

    var p = /*#__PURE__*/function (_n$a4) {
      _inherits(p, _n$a4);

      var _super5 = _createSuper(p);

      function p() {
        _classCallCheck(this, p);

        return _super5.apply(this, arguments);
      }

      _createClass(p, [{
        key: "build",
        value: function build() {
          var e = this.config,
              t = e.type,
              r = f(e, ["type"]);
          var o = t;
          var n = {
            paragraph: "p",
            header: this.subtype
          };
          return n[t] && (o = n[t]), {
            field: this.markup(o, u.f.parsedHtml(this.label), r),
            layout: "noLabel"
          };
        }
      }]);

      return p;
    }(n.a);

    function m(e, t) {
      if (null == e) return {};

      var r,
          o,
          n = function (e, t) {
        if (null == e) return {};
        var r,
            o,
            n = {},
            i = Object.keys(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || (n[r] = e[r]);
        }

        return n;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || Object.prototype.propertyIsEnumerable.call(e, r) && (n[r] = e[r]);
        }
      }

      return n;
    }

    n.a.register(["paragraph", "header"], p), n.a.register(["p", "address", "blockquote", "canvas", "output"], p, "paragraph"), n.a.register(["h1", "h2", "h3", "h4", "h5", "h6"], p, "header");

    var b = /*#__PURE__*/function (_n$a5) {
      _inherits(b, _n$a5);

      var _super6 = _createSuper(b);

      function b() {
        _classCallCheck(this, b);

        return _super6.apply(this, arguments);
      }

      _createClass(b, [{
        key: "build",
        value: function build() {
          var e = [],
              t = this.config,
              r = t.values,
              o = t.value,
              n = t.placeholder,
              i = t.type,
              l = t.inline,
              a = t.other,
              s = t.toggle,
              c = m(t, ["values", "value", "placeholder", "type", "inline", "other", "toggle"]),
              d = i.replace("-group", ""),
              f = "select" === i;

          if ((c.multiple || "checkbox-group" === i) && (c.name = c.name + "[]"), "checkbox-group" === i && c.required && (this.onRender = this.groupRequired), delete c.title, r) {
            n && f && e.push(this.markup("option", n, {
              disabled: null,
              selected: null
            }));

            for (var _t11 = 0; _t11 < r.length; _t11++) {
              var _i8 = r[_t11];
              "string" == typeof _i8 && (_i8 = {
                label: _i8,
                value: _i8
              });

              var _i9 = _i8,
                  _i9$label = _i9.label,
                  _a3 = _i9$label === void 0 ? "" : _i9$label,
                  _u = m(_i8, ["label"]);

              if (_u.id = "".concat(c.id, "-").concat(_t11), _u.selected && !n || delete _u.selected, void 0 !== o && _u.value === o && (_u.selected = !0), f) {
                var _t12 = this.markup("option", document.createTextNode(_a3), _u);

                e.push(_t12);
              } else {
                var _t13 = [_a3];

                var _r12 = "formbuilder-" + d;

                l && (_r12 += "-inline"), _u.type = d, _u.selected && (_u.checked = "checked", delete _u.selected);

                var _o8 = this.markup("input", null, Object.assign({}, c, _u)),
                    _n5 = {
                  "for": _u.id
                };

                var _i10 = [_o8, this.markup("label", _t13, _n5)];
                s && (_n5.className = "kc-toggle", _t13.unshift(_o8, this.markup("span")), _i10 = this.markup("label", _t13, _n5));

                var _f = this.markup("div", _i10, {
                  className: _r12
                });

                e.push(_f);
              }
            }

            if (!f && a) {
              var _t14 = {
                id: c.id + "-other",
                className: c.className + " other-option",
                value: ""
              };

              var _r13 = "formbuilder-" + d;

              l && (_r13 += "-inline");

              var _o9 = Object.assign({}, c, _t14);

              _o9.type = d;

              var _n6 = {
                type: "text",
                events: {
                  input: function input(e) {
                    var t = e.target,
                        r = t.parentElement.previousElementSibling;
                    r.value = t.value, r.name = c.id + "[]";
                  }
                },
                id: _t14.id + "-value",
                className: "other-val"
              },
                  _i11 = this.markup("input", null, _o9),
                  _a4 = [document.createTextNode("Other"), this.markup("input", null, _n6)],
                  _s2 = this.markup("label", _a4, {
                "for": _o9.id
              }),
                  _u2 = this.markup("div", [_i11, _s2], {
                className: _r13
              });

              e.push(_u2);
            }
          }

          return this.dom = "select" == i ? this.markup(d, e, Object(u.A)(c, !0)) : this.markup("div", e, {
            className: i
          }), this.dom;
        }
      }, {
        key: "groupRequired",
        value: function groupRequired() {
          var e = this.element.getElementsByTagName("input"),
              t = function t(e, _t15) {
            [].forEach.call(e, function (e) {
              _t15 ? e.removeAttribute("required") : e.setAttribute("required", "required"), function (e, t) {
                var r = n.a.mi18n("minSelectionRequired", 1);
                t ? e.setCustomValidity("") : e.setCustomValidity(r);
              }(e, _t15);
            });
          },
              r = function r() {
            var r = [].some.call(e, function (e) {
              return e.checked;
            });
            t(e, r);
          };

          for (var _t16 = e.length - 1; _t16 >= 0; _t16--) {
            e[_t16].addEventListener("change", r);
          }

          r();
        }
      }, {
        key: "onRender",
        value: function onRender() {
          if (this.config.userData) {
            var _t17 = this.config.userData.slice();

            "select" === this.config.type ? e(this.dom).val(_t17).prop("selected", !0) : this.config.type.endsWith("-group") && this.dom.querySelectorAll("input").forEach(function (e) {
              if (!e.classList.contains("other-val")) {
                for (var _r14 = 0; _r14 < _t17.length; _r14++) {
                  if (e.value === _t17[_r14]) {
                    e.setAttribute("checked", !0), _t17.splice(_r14, 1);
                    break;
                  }
                }

                if (e.id.endsWith("-other")) {
                  var _r15 = document.getElementById(e.id + "-value");

                  if (0 === _t17.length) return;
                  e.setAttribute("checked", !0), _r15.value = e.value = _t17[0], _r15.style.display = "inline-block";
                }
              }
            });
          }
        }
      }], [{
        key: "definition",
        get: function get() {
          return {
            inactive: ["checkbox"],
            mi18n: {
              minSelectionRequired: "minSelectionRequired"
            }
          };
        }
      }]);

      return b;
    }(n.a);

    n.a.register(["select", "checkbox-group", "radio-group", "checkbox"], b);

    var h = /*#__PURE__*/function (_n$a6) {
      _inherits(h, _n$a6);

      var _super7 = _createSuper(h);

      function h() {
        _classCallCheck(this, h);

        return _super7.apply(this, arguments);
      }

      _createClass(h, [{
        key: "build",
        value: function build() {
          var e = this.config.name;
          e = this.config.multiple ? e + "[]" : e;
          var t = Object.assign({}, this.config, {
            name: e
          });
          return this.dom = this.markup("input", null, t), this.dom;
        }
      }, {
        key: "onRender",
        value: function onRender() {
          this.config.userData && e(this.dom).val(this.config.userData[0]);
        }
      }], [{
        key: "definition",
        get: function get() {
          return {
            mi18n: {
              date: "dateField",
              file: "fileUpload"
            }
          };
        }
      }]);

      return h;
    }(n.a);

    n.a.register(["text", "file", "date", "number"], h), n.a.register(["text", "password", "email", "color", "tel"], h, "text");

    var g = /*#__PURE__*/function (_h) {
      _inherits(g, _h);

      var _super8 = _createSuper(g);

      function g() {
        _classCallCheck(this, g);

        return _super8.apply(this, arguments);
      }

      _createClass(g, [{
        key: "configure",
        value: function configure() {
          var _this5 = this;

          this.js = this.classConfig.js || "//cdnjs.cloudflare.com/ajax/libs/file-uploader/5.14.2/jquery.fine-uploader/jquery.fine-uploader.min.js", this.css = [this.classConfig.css || "//cdnjs.cloudflare.com/ajax/libs/file-uploader/5.14.2/jquery.fine-uploader/fine-uploader-gallery.min.css", {
            type: "inline",
            id: "fineuploader-inline",
            style: "\n          .qq-uploader .qq-error-message {\n            position: absolute;\n            left: 20%;\n            top: 20px;\n            width: 60%;\n            color: #a94442;\n            background: #f2dede;\n            border: solid 1px #ebccd1;\n            padding: 15px;\n            line-height: 1.5em;\n            text-align: center;\n            z-index: 99999;\n          }\n          .qq-uploader .qq-error-message span {\n            display: inline-block;\n            text-align: left;\n          }"
          }], this.handler = this.classConfig.handler || "/upload";
          ["js", "css", "handler"].forEach(function (e) {
            return delete _this5.classConfig[e];
          });
          var t = this.classConfig.template || '\n      <div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Drop files here">\n        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">\n          <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>\n        </div>\n        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>\n          <span class="qq-upload-drop-area-text-selector"></span>\n        </div>\n        <div class="qq-upload-button-selector qq-upload-button">\n          <div>Upload a file</div>\n        </div>\n        <span class="qq-drop-processing-selector qq-drop-processing">\n          <span>Processing dropped files...</span>\n          <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>\n        </span>\n        <ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite" aria-relevant="additions removals">\n          <li>\n            <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>\n            <div class="qq-progress-bar-container-selector qq-progress-bar-container">\n              <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>\n            </div>\n            <span class="qq-upload-spinner-selector qq-upload-spinner"></span>\n            <div class="qq-thumbnail-wrapper">\n              <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>\n            </div>\n            <button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>\n            <button type="button" class="qq-upload-retry-selector qq-upload-retry">\n              <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>\n              Retry\n            </button>\n            <div class="qq-file-info">\n              <div class="qq-file-name">\n                <span class="qq-upload-file-selector qq-upload-file"></span>\n                <span class="qq-edit-filename-icon-selector qq-btn qq-edit-filename-icon" aria-label="Edit filename"></span>\n              </div>\n              <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">\n              <span class="qq-upload-size-selector qq-upload-size"></span>\n              <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">\n                <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>\n              </button>\n              <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">\n                <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>\n              </button>\n              <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">\n                <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>\n              </button>\n            </div>\n          </li>\n        </ul>\n        <dialog class="qq-alert-dialog-selector">\n          <div class="qq-dialog-message-selector"></div>\n          <div class="qq-dialog-buttons">\n            <button type="button" class="qq-cancel-button-selector">Close</button>\n          </div>\n        </dialog>\n        <dialog class="qq-confirm-dialog-selector">\n          <div class="qq-dialog-message-selector"></div>\n          <div class="qq-dialog-buttons">\n            <button type="button" class="qq-cancel-button-selector">No</button>\n            <button type="button" class="qq-ok-button-selector">Yes</button>\n          </div>\n        </dialog>\n        <dialog class="qq-prompt-dialog-selector">\n          <div class="qq-dialog-message-selector"></div>\n          <input type="text">\n          <div class="qq-dialog-buttons">\n            <button type="button" class="qq-cancel-button-selector">Cancel</button>\n            <button type="button" class="qq-ok-button-selector">Ok</button>\n          </div>\n        </dialog>\n      </div>';
          this.fineTemplate = e("<div/>").attr("id", "qq-template").html(t);
        }
      }, {
        key: "build",
        value: function build() {
          return this.input = this.markup("input", null, {
            type: "hidden",
            name: this.config.name,
            id: this.config.name
          }), this.wrapper = this.markup("div", "", {
            id: this.config.name + "-wrapper"
          }), [this.input, this.wrapper];
        }
      }, {
        key: "onRender",
        value: function onRender() {
          var t = e(this.wrapper),
              r = e(this.input),
              o = jQuery.extend(!0, {
            request: {
              endpoint: this.handler
            },
            deleteFile: {
              enabled: !0,
              endpoint: this.handler
            },
            chunking: {
              enabled: !0,
              concurrent: {
                enabled: !0
              },
              success: {
                endpoint: this.handler + (-1 == this.handler.indexOf("?") ? "?" : "&") + "done"
              }
            },
            resume: {
              enabled: !0
            },
            retry: {
              enableAuto: !0,
              showButton: !0
            },
            callbacks: {
              onError: function onError(r, o, n) {
                "." != n.slice(-1) && (n += ".");
                var i = e("<div />").addClass("qq-error-message").html("<span>Error processing upload: <b>".concat(o, "</b>.<br />Reason: ").concat(n, "</span>")).prependTo(t.find(".qq-uploader")),
                    l = window.setTimeout(function () {
                  i.fadeOut(function () {
                    i.remove(), window.clearTimeout(l);
                  });
                }, 6e3);
                return r;
              },
              onStatusChange: function onStatusChange(e, o, n) {
                var i = t.fineUploader("getUploads"),
                    l = [];

                var _iterator4 = _createForOfIteratorHelper(i),
                    _step4;

                try {
                  for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {
                    var _e14 = _step4.value;
                    "upload successful" == _e14.status && l.push(_e14.name);
                  }
                } catch (err) {
                  _iterator4.e(err);
                } finally {
                  _iterator4.f();
                }

                return r.val(l.join(", ")), {
                  id: e,
                  oldStatus: o,
                  newStatus: n
                };
              }
            },
            template: this.fineTemplate
          }, this.classConfig);
          t.fineUploader(o);
        }
      }], [{
        key: "definition",
        get: function get() {
          return {
            i18n: {
              "default": "Fine Uploader"
            }
          };
        }
      }]);

      return g;
    }(h);

    function y(e, t) {
      if (null == e) return {};

      var r,
          o,
          n = function (e, t) {
        if (null == e) return {};
        var r,
            o,
            n = {},
            i = Object.keys(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || (n[r] = e[r]);
        }

        return n;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || Object.prototype.propertyIsEnumerable.call(e, r) && (n[r] = e[r]);
        }
      }

      return n;
    }

    h.register("file", h, "file"), h.register("fineuploader", g, "file");

    var w = /*#__PURE__*/function (_n$a7) {
      _inherits(w, _n$a7);

      var _super9 = _createSuper(w);

      function w() {
        _classCallCheck(this, w);

        return _super9.apply(this, arguments);
      }

      _createClass(w, [{
        key: "build",
        value: function build() {
          var e = this.config,
              _e$value = e.value,
              t = _e$value === void 0 ? "" : _e$value,
              r = y(e, ["value"]);
          return this.field = this.markup("textarea", this.parsedHtml(t), r), this.field;
        }
      }, {
        key: "onRender",
        value: function onRender() {
          this.config.userData && e("#" + this.config.name).val(this.config.userData[0]);
        }
      }, {
        key: "on",
        value: function on(t) {
          var _this6 = this;

          return "prerender" == t && this.preview ? function (t) {
            _this6.field && (t = _this6.field), e(t).on("mousedown", function (e) {
              e.stopPropagation();
            });
          } : _get(_getPrototypeOf(w.prototype), "on", this).call(this, t);
        }
      }], [{
        key: "definition",
        get: function get() {
          return {
            mi18n: {
              textarea: "textArea"
            }
          };
        }
      }]);

      return w;
    }(n.a);

    function v(e, t) {
      if (null == e) return {};

      var r,
          o,
          n = function (e, t) {
        if (null == e) return {};
        var r,
            o,
            n = {},
            i = Object.keys(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || (n[r] = e[r]);
        }

        return n;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || Object.prototype.propertyIsEnumerable.call(e, r) && (n[r] = e[r]);
        }
      }

      return n;
    }

    n.a.register("textarea", w), n.a.register("textarea", w, "textarea");

    var x = /*#__PURE__*/function (_w) {
      _inherits(x, _w);

      var _super10 = _createSuper(x);

      function x() {
        _classCallCheck(this, x);

        return _super10.apply(this, arguments);
      }

      _createClass(x, [{
        key: "configure",
        value: function configure() {
          if (this.js = ["https://cdn.tinymce.com/4/tinymce.min.js"], this.classConfig.js) {
            var _e15 = this.classConfig.js;
            Array.isArray(_e15) || (_e15 = new Array(_e15)), this.js.concat(_e15), delete this.classConfig.js;
          }

          this.classConfig.css && (this.css = this.classConfig.css), this.editorOptions = {
            height: 250,
            paste_data_images: !0,
            plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste code"],
            toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | table"
          };
        }
      }, {
        key: "build",
        value: function build() {
          var e = this.config,
              _e$value2 = e.value,
              t = _e$value2 === void 0 ? "" : _e$value2,
              r = v(e, ["value"]);
          return this.field = this.markup("textarea", this.parsedHtml(t), r), r.disabled && (this.editorOptions.readonly = !0), this.field;
        }
      }, {
        key: "onRender",
        value: function onRender(e) {
          window.tinymce.editors[this.id] && window.tinymce.editors[this.id].remove();
          var t = jQuery.extend(this.editorOptions, this.classConfig);
          return t.target = this.field, window.tinymce.init(t), this.config.userData && window.tinymce.editors[this.id].setContent(this.parsedHtml(this.config.userData[0])), e;
        }
      }]);

      return x;
    }(w);

    function O(e, t) {
      if (null == e) return {};

      var r,
          o,
          n = function (e, t) {
        if (null == e) return {};
        var r,
            o,
            n = {},
            i = Object.keys(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || (n[r] = e[r]);
        }

        return n;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || Object.prototype.propertyIsEnumerable.call(e, r) && (n[r] = e[r]);
        }
      }

      return n;
    }

    function A(e, t) {
      var r = Object.keys(e);

      if (Object.getOwnPropertySymbols) {
        var o = Object.getOwnPropertySymbols(e);
        t && (o = o.filter(function (t) {
          return Object.getOwnPropertyDescriptor(e, t).enumerable;
        })), r.push.apply(r, o);
      }

      return r;
    }

    function j(e) {
      for (var t = 1; t < arguments.length; t++) {
        var r = null != arguments[t] ? arguments[t] : {};
        t % 2 ? A(Object(r), !0).forEach(function (t) {
          k(e, t, r[t]);
        }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(r)) : A(Object(r)).forEach(function (t) {
          Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(r, t));
        });
      }

      return e;
    }

    function k(e, t, r) {
      return t in e ? Object.defineProperty(e, t, {
        value: r,
        enumerable: !0,
        configurable: !0,
        writable: !0
      }) : e[t] = r, e;
    }

    w.register("tinymce", x, "textarea");

    var q = /*#__PURE__*/function (_w2) {
      _inherits(q, _w2);

      var _super11 = _createSuper(q);

      function q() {
        _classCallCheck(this, q);

        return _super11.apply(this, arguments);
      }

      _createClass(q, [{
        key: "configure",
        value: function configure() {
          var e = {
            modules: {
              toolbar: [[{
                header: [1, 2, !1]
              }], ["bold", "italic", "underline"], ["code-block"]]
            },
            placeholder: this.config.placeholder || "",
            theme: "snow"
          },
              _u$f$splitObject = u.f.splitObject(this.classConfig, ["css", "js"]),
              _u$f$splitObject2 = _slicedToArray(_u$f$splitObject, 2),
              t = _u$f$splitObject2[0],
              r = _u$f$splitObject2[1];

          Object.assign(this, j(j({}, {
            js: "//cdn.quilljs.com/1.2.4/quill.js",
            css: "//cdn.quilljs.com/1.2.4/quill.snow.css"
          }), t)), this.editorConfig = j(j({}, e), r);
        }
      }, {
        key: "build",
        value: function build() {
          var e = this.config,
              _e$value3 = e.value,
              t = _e$value3 === void 0 ? "" : _e$value3,
              r = O(e, ["value"]);
          return this.field = this.markup("div", null, r), this.field;
        }
      }, {
        key: "onRender",
        value: function onRender(e) {
          var t = this.config.value || "",
              r = window.Quill["import"]("delta");
          window.fbEditors.quill[this.id] = {};
          var o = window.fbEditors.quill[this.id];
          return o.instance = new window.Quill(this.field, this.editorConfig), o.data = new r(), t && o.instance.setContents(window.JSON.parse(this.parsedHtml(t))), o.instance.on("text-change", function (e) {
            o.data = o.data.compose(e);
          }), e;
        }
      }]);

      return q;
    }(w);

    w.register("quill", q, "textarea");
    c.a;
  }, function (e, t, r) {
    var o = r(20),
        n = "object" == (typeof self === "undefined" ? "undefined" : _typeof(self)) && self && self.Object === Object && self,
        i = o || n || Function("return this")();
    e.exports = i;
  }, function (e, t, r) {
    var o = r(13).Symbol;
    e.exports = o;
  }, function (e, t, r) {
    var o = r(18),
        n = r(11);

    e.exports = function (e, t, r) {
      var i = !0,
          l = !0;
      if ("function" != typeof e) throw new TypeError("Expected a function");
      return n(r) && (i = "leading" in r ? !!r.leading : i, l = "trailing" in r ? !!r.trailing : l), o(e, t, {
        leading: i,
        maxWait: t,
        trailing: l
      });
    };
  }, function (e, t, r) {
    var o = r(9),
        n = r(17);
    "string" == typeof (n = n.__esModule ? n["default"] : n) && (n = [[e.i, n, ""]]);
    var i = {
      attributes: {
        "class": "formBuilder-injected-style"
      },
      insert: "head",
      singleton: !1
    };
    o(n, i);
    e.exports = n.locals || {};
  }, function (e, t, r) {
    r.r(t);
    var o = r(7),
        n = r.n(o)()(!1);
    n.push([e.i, "@font-face{font-family:'formbuilder-icons';src:url(\"data:application/octet-stream;base64,d09GRgABAAAAABu0AA8AAAAAMegAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAABHU1VCAAABWAAAADsAAABUIIslek9TLzIAAAGUAAAAQwAAAFY+IFQTY21hcAAAAdgAAACqAAACbnpHyFBjdnQgAAAChAAAABMAAAAgBtX/BGZwZ20AAAKYAAAFkAAAC3CKkZBZZ2FzcAAACCgAAAAIAAAACAAAABBnbHlmAAAIMAAAEA4AAByklMHRx2hlYWQAABhAAAAAMwAAADYZ1vNNaGhlYQAAGHQAAAAdAAAAJAc8A2VobXR4AAAYlAAAACEAAABMRoz//2xvY2EAABi4AAAAKAAAAChJjFGYbWF4cAAAGOAAAAAgAAAAIAKGDJhuYW1lAAAZAAAAAZkAAAM5OICt5nBvc3QAABqcAAAAmwAAAN59hsARcHJlcAAAGzgAAAB6AAAAhuVBK7x4nGNgZGBg4GIwYLBjYHJx8wlh4MtJLMljkGJgYYAAkDwymzEnMz2RgQPGA8qxgGkOIGaDiAIAJjsFSAB4nGNgZN7OOIGBlYGBqYppDwMDQw+EZnzAYMjIBBRlYGVmwAoC0lxTGA68YPjkyxz0P4shijmIYRpQmBEkBwAMiQy7AHic7ZHLFYJADEXvAOIP5FOCC1e2ws6CXFlr1jSgL5OUYTiXScIMcHKBA9CKp+igfCh4vNUttd9yqf2Ol+qTrgZstGXfvl9l2BRZjaLndx41a3S20xd6juqe9Z4rAyM3JmYWVm3q+cdQ75bVGmktZcCSOvXEjVni1ixxm5Zo6lii+WOJTGCJnGCJW7ZEnrDE/84SuZP5QBZlPsDXOcDXJZBj9i1g/QFjZzHOAAB4nGNgQAMSEMgc9D8LhAESbAPdAHicrVZpd9NGFB15SZyELCULLWphxMRpsEYmbMGACUGyYyBdnK2VoIsUO+m+8Ynf4F/zZNpz6Dd+Wu8bLySQtOdwmpOjd+fN1czbZRJaktgL65GUmy/F1NYmjew8CemGTctRfCg7eyFlisnfBVEQrZbatx2HREQiULWusEQQ+x5ZmmR86FFGy7akV03KLT3pLlvjQb1V334aOsqxO6GkZjN0aD2yJVUYVaJIpj1S0qZlqPorSSu8v8LMV81QwohOImm8GcbQSN4bZ7TKaDW24yiKbLLcKFIkmuFBFHmU1RLn5IoJDMoHzZDyyqcR5cP8iKzYo5xWsEu20/y+L3mndzk/sV9vUbbkQB/Ijuzg7HQlX4RbW2HctJPtKFQRdtd3QmzZ7FT/Zo/ymkYDtysyvdCMYKl8hRArP6HM/iFZLZxP+ZJHo1qykRNB62VO7Es+gdbjiClxzRhZ0N3RCRHU/ZIzDPaYPh788d4plgsTAngcy3pHJZwIEylhczRJ2jByYCVliyqp9a6YOOV1WsRbwn7t2tGXzmjjUHdiPFsPHVs5UcnxaFKnmUyd2knNoykNopR0JnjMrwMoP6JJXm1jNYmVR9M4ZsaERCICLdxLU0EsO7GkKQTNoxm9uRumuXYtWqTJA/Xco/f05la4udNT2g70s0Z/VqdiOtgL0+lp5C/xadrlIkXp+ukZfkziQdYCMpEtNsOUgwdv/Q7Sy9eWHIXXBtju7fMrqH3WRPCkAfsb0B5P1SkJTIWYVYhWQGKta1mWydWsFqnI1HdDmla+rNMEinIcF8e+jHH9XzMzlpgSvt+J07MjLj1z7UsI0xx8m3U9mtepxXIBcWZ5TqdZlu/rNMfyA53mWZ7X6QhLW6ejLD/UaYHlRzodY3lBC5p038GQizDkAg6QMISlA0NYXoIhLBUMYbkIQ1gWYQjLJRjC8mMYwnIZhrC8rGXV1FNJ49qZWAZsQmBijh65zEXlaiq5VEK7aFRqQ54SbpVUFM+qf2WgXjzyhjmwFkiXyJpfMc6Vj0bl+NYVLW8aO1fAsepvH472OfFS1ouFPwX/1dZUJb1izcOTq/Abhp5sJ6o2qXh0TZfPVT26/l9UVFgL9BtIhVgoyrJscGcihI86nYZqoJVDzGzMPLTrdcuan8P9NzFCFlD9+DcUGgvcg05ZSVnt4KzV19uy3DuDcjgTLEkxN/P6VvgiI7PSfpFZyp6PfB5wBYxKZdhqA60VvNknMQ+Z3iTPBHFbUTZI2tjOBIkNHPOAefOdBCZh6qoN5E7hhg34BWFuwXknXKJ6oyyH7kXs8yik/Fun4kT2qGiMwLPZG2Gv70LKb3EMJDT5pX4MVBWhqRg1FdA0Um6oBl/G2bptQsYO9CMqdsOyrOLDxxb3lZJtGYR8pIjVo6Of1l6iTqrcfmYUl++dvgXBIDUxf3vfdHGQyrtayTJHbQNTtxqVU9eaQ+NVh+rmUfW94+wTOWuabronHnpf06rbwcVcLLD2bQ7SUiYX1PVhhQ2iy8WlUOplNEnvuAcYFhjQ71CKjf+r+th8nitVhdFxJN9O1LfR52AM/A/Yf0f1A9D3Y+hyDS7P95oTn2704WyZrqIX66foNzBrrblZugbc0HQD4iFHrY64yg18pwZxeqS5HOkh4GPdFeIBwCaAxeAT3bWM5lMAo/mMOT7A58xh0GQOgy3mMNhmzhrADnMY7DKHwR5zGHzBnHWAL5nDIGQOg4g5DJ4wJwB4yhwGXzGHwdfMYfANc+4DfMscBjFzGCTMYbCv6dYwzC1e0F2gtkFVoANTT1jcw+JQU2XI/o4Xhv29Qcz+wSCm/qjp9pD6Ey8M9WeDmPqLQUz9VdOdIfU3Xhjq7wYx9Q+DmPpMvxjLZQa/jHyXCgeUXWw+5++J9w/bxUC5AAEAAf//AA94nM1ZW3Bbx3nef88VwMEBDnAO7iAuBxcRoEQKV0qkAEiiREqkJJKmJFKyQNY0HVc0TSlJq9ox7TZynKgvrmcqT6dR22EznXGcTOvIE+fB6kynkpt6PHamje126pdOXyq/+KHNS2EB6r+40KwkZ9xkPJPF2QvP7v5nd//b9y+Jk5C757nb3CzhiERsxEHcxEuCJEJMkiZZMkmmyRyZJ8/Q0cnX9On52ks8UHOHSVesICcTSTmxRhKZZCKzGoOIZ8ATWSED0ejAsu7WOEdYDTtWDJeTU/v61OUQ+PrBpD5ziexID9kHeYnskOoCR4nNQkEkUE8pVCRJWUzWd0FmZ5Z6IhnPYi6+m4uSsCMaXgyC3x84RQIBZYL09XkXiNdr9x4JTr5m4ML+uLuwHWufs7KBtQcvLaz2rX5pa6u9/IWW5RmIrm6tS1378he2sFA7f/LkzIzPpyhP/96l3/2dr3/tqxfXzz/+lcdWHl1+5LeWFuvnzp6cPzl/+tTM3MzcQ7PTJ45PHRk/fGjs4IH9tcpwMTeUzfTvSKeSCTMei0b6wiFf0BcM+L0eQ3e7NKfiUBwujSVnXghmIW+YadPIlzHjU8TH9GJOY4PrtllmnWDoKmRB00UzFk8VtUIF8rGiWYwZphHL9QHXD0YsWWRkTAMKKTOmmdidb+dYXAyD7sm3B7NJuVIRLlWrG5UKPo1qu6pWb+Cb9oMN+HEg64/EQ01XyMQWvLwBezbgtD8beLN1pXWFftJ8EYfR11xq6/s4v1JpnVc1Te2NU100wMhXqt2y2ny32k70jxr+TKD1nVA8HqI/Q3o4uxrINt+/8SkjA++rrtZPqxX8udSGquHUiqYSgjrIdHLzgTqZJ2UyQqrkBPka+ZPa1f1JGnYd2Zng3GE6HovQsNsSnguC2++1cxbZbVn0eRRONjSJE3hZqOtOkeMdNo4DwkM9AC5X33wU+vqUCdVKOUJC8yQUsoeOfPXC2vmvPLa8dO7sqYeOTR0aq1b2jY7s3TNcLhULuwf70z2eI8N9XY53kzMuhLM9bqa31XBPzRULKaQjSobuKedzJdg2vtzt83b7yp/JQmkEiqzIecI4o9OSjHzOM765+db162/1Svju669/eP06/HBz88PXX7+liAnJCp3yu+1XH25uuqyyKSmApWz9l4HQnU/CmUx4ooBKWviwlDCTJRgPZ05sbm4mrl+/nths3tpssCJxHYY229Q22exWCvs2N1e3vRpoFhkp+k44U0oWCslSp8wgbyny9h+5/6B/T3TST3K1wfYBuonEURjXAQ4RIJQDuoS8J9wc4Tg0vtieKo6UC7zgY3qhAh7GLuhqRs7jLUsWEJJFpgpx0dCY+KPYc1Mozc33UO6wprlY3vryB633W+9BDgY0tfme6nKpNKdqNNBSeoOwzsRO/3frKrz86BsKE/POOCLjul95oJ94srYaBl6IgIX3g2wJgigbIInCeB8IAbB4QOQOe0Eaw4kU7VbdCgLhLQJfJxYiixa5TkQbjpfO4OnAKQKgkCOKIss9K6LaZZtsYwLmVAR/VouhIcAsYKFhs4htB6S9bqmTudt3fCzDJZpvvsvyxrV6/Vo3c3rlzcqbHRVtVG/Uo8/CG/XoBvwYC9zV/XuMIpeKpIJ+cA6Ejgc8Q2xUoLaVILgsrgtsWzbclk+hgh14q8AvecFKHKLVsUREImmihIrmJJrq1Jb8oBK3rLqXQjqVDQ+1uGTL0rZ9B2tnO8SFtS+B+kLtwLGpWrVcymbiMUN3Omemp+aOzR0+VJ2sTY7sLVXKldxQppgtppKx/nh/MKBHjajT7dzSbmcYlXuLAe1sMA4YHIojCiMaZxTOdFzUPblSIdV9i8qpi/e+vHdoj2t76MXmi738UVssc23ZRFkMoTh2BDVdLqfxRdDlst83pM3iRpX9qvBGINPuy2UCGy7sDLla32wPL84WN3C0oRutF7vzsXi2MwbPzOjKgr5N0juW9yAZR2k4QR4ip8lZskgukW+Q58hl8m1u/+RrFpSPPyOj0og0unIYhsuiOLyyDwgpFUmpjoJUyBQL9fzuwZ18tj8RDfkEymXp4o5DyYOx/eGq38Klx8wDkVqw4rXwAsfXU/G+gEcQDLfmsAs2RbDVc0O7BviM7nKqvGLNKHViJRbZaqmjhkqjslTHNe7dM7K3TvaQ8vCeMmoXgDhLRBEWCIhwDNGSFRf5l79skQO4SJLJ0szsr7tUbqC70oFfaaU2XOmfb19peVhc+w07z9pfdBY4svYbusIFxHp/9cwzc3PT01NTExNjY7Xa6OjwMCXffuFbz1/+5h/8/jPPPfPcsxvfePqpHg68sP7k2hOr53+7gwYZFnz47JmF+bnTc6dPnZx+aPqh2ZmpE1Mnjh+bmJyYPHpkbHwMkWHtYA2x4Wh1FMHC8MgwwgWGFvK53UODu3YO3IsWtyEHp1UiDuoYF/QsbPdfWiElIGw0MEOMWZ32L4+w776cNMx9NG94H1j1oCGCROP+3KYKXUeSxsy9eudqyDRD3CritjtP5TBxq3eu9nLu3OzpmfpkfaY+0FyfnH1lZub7k5N/MzPzh2xgrj4zz7omz3XnNF0dW7bRUuAXnB4PM5BphugnIfN5l93dvEIH7G7Fbd9KEbfbjlbtvjKKhV1UesmvuJtXGYCtVAlxbvktBds68ZEQ+q0E2UEGyBApkGEy2rFbUOx4sMeCYOMUzrZCFJ5Xlv1eaggewVgJ+KhHFD3LcV1z8HZJlewrbhaJyLK6bAG+L0QhzMNiImJyYSIYYaHOfJBdlBZjgABBJueswHH0VBQoVTj0Zk90P6Ss4Zc4hV/tfcqz1v6W4BFXP/uYutb5mqTKq7/C5xZqJ5ls79xpoPHeLpPVyhZ4RXHcObQTJfJBAmn4DJTJtkgi6sDDVNyFpODBkGB3TyTzWtvldd2eG8WKiaiGudzLKFPJbX9DOi90BRX5fjEUb9w5/ZmPa9y4cefnLFboRSOtK702fFC9dOd/kMHcbEcgaR6GKzfevIFz6MUb1Urz3Uo3NdolXDjUYKTwkHq+q4djWOTwkw7v9xOE/jxZUQCsPFhXiayCTZRt7bPlEE70cJqd4TTCcJrVYrHOEqvVskAsVgtavAMdGrD2qxNZqKWiURm5GDWjyIK+oMeNZ64wqGe1IHrkkQKnOQQjW8aDTqJehiG2D/Dg3dr/xbmcFtNuwC9aymen+mY89JkOV+5c/R47Ihb+4Zkx1euqIWdF9fyEoWty9z+52/SD7q3H2do8w+AIxKHOq5TYwWoj1rrioDbE2aJNWJJBlCRxFitROkUQvB6NRoEwcepsJ9CzbQ6rzDaD4XoEIs62hWOWiNm0zg5GwGgHssWuxQMUsX7Q0Ao11+uN+rVgwgxdwwZ9KRQ37zx9jf6suU5fovMslEz5WldCJgsbzRBc8qVak3CpdQUuIXzBQyd3f8Qdo3eRIzrxozV4oebtAyqEPaqE6/FzGO/hHjEQHJ98zYWCkSYCFdZx43Sdnf064kYgy+hLeB5msQL+NOP6ZLCWun8kWb9/4EINgVQs6vM6HRYZlyHqErLTW05jvIZxuxmXQDT0fK4MpbQXzCLoiOPLpVwEPO/kLucnYFER+NY/8XaBh0Gu73Zr6DZ3TD93+5w+4rmsS/nL+dFxKip86595LGEXf/F2a/Bj+NOwce7jhw3jsoedA9fWhVdRF3g0GA5yqHbACvwhWaS8wK8TgQjrEnprZBBXR34DnSWUMsBM4ajFAsTisDC5tDE24iDclwW5mGQIWELth7LX1EwNPmhluVerGxvNC43GtRvf+/TTjQq80Wi0fgp7COks5Dad/5w7tsGtqH47tvy72t/2220WSeAk2KFYZZGn6CeB1HG+qjnUOtGI060560jNZbhddcSsOkbMdaTt8Xs9deS6L+j31bPppBmLhKVgIBCc3fojGDiVSSXi0b6QFAgGjqJjn0O3Po1OfQpd+kTvqmd75P8FfHkvUBjAQMG97V7n3iz8kvx5c9zd24POHc49D7Oi3KtYn7qn/nnPnm5/qp0BNFDZnjaqG9vy9gSXKi2lytgIrKB/Ta+jj+2rBX2aleMpgXFmLcg6Bu70Md2ne1mkXixUIZ0qMIFGqfagdKNzEeODGOzGU4GbNwOFw4FbN/0TOf/Nm/7chP/mLf9E/kwiwOqc/9Yt9u7WzUCnP4+fle6TIx+JkQG6+yeZdIKzyDDewfbHJeAQJHLWNQ2sCrEu20GRibLsANViE9QVFmLaULOpYKHCKtsSh2LlRJ9qUVnEKPC8MEsEgemxgArfweFjW1TtisZZZaTrUNEiIq2VB9KyPZiW9qWskFmw6QdTlVfbZC2qbe3/T9eNdGfuoaus/tqEa7NfiKbFRle/MNEFlmpmwI/ql+3fkUqa8b6wPxZgob5P8/VU0yWEsm6Gc/OaiXU/YC304vA0i9XjKLTevFHOS14zbZgVBmXZvWYH0lYqzX+Np9MH0+nY0J49S3v3vh15bMfFp/rXIqhObRd0FPVlMXcqh4+/9kQNH35p6fzTTz7Z0R/0S29xNvIsOV6bXJgrcKLgRWsrs3uvcRntq0QFkRfY9QZQEZasQFHj5rCiZJ5jajb19FMX1ldXlhbnT544fnTs6559SzbUNyGeiotmPFUuVGi5tA8KaYYTHKCj38t5vLoodQcU2wOKaa1cShUGYRekd4GI00rlHB5CPoemTIyLkmh4GcDokNpFi/f3u7dIcz/wP5J7xG93gisQtbhAMlrf8UhgWOJ9OiiOwOO76z676vL0YR86GcpTWZDjPg8oauDxoSWPqroCIasOkgNeUCVwW3eFVNX36OCST1V1X1zSwW2JhlygnOB5n93lpKJoO/hvisBx/35CEXmnS/UB69GcPC/ZD0bgHxx2FQlanVTgabc7wLoF5fgtim7z+nFFpIpnW4f9WPO/DiAxDDR9HT7Rt5FPWbKrlg3LFHk0joePDFhhuOFJBjH4OcLz7IKSJ1P78u5hUxD8WcDjQefODkjTxSywe1tzq5VK44+dZYldXdK3dTVEVR489lFVn3Y5sZwtH04mlg9WfgA2Vacf9zsTwKliX3ND1XWVvtKcZzUYUiB2cP/0w99Cl9e9Vz3PrWIMxPzqeG2MR3FxOO2cIBKhripUREslyQhN2eKVCSvIsl0+QghzYDhny4dpWwldGBTNsim1s5Fv53y5nfE9vs5zq9ciG5EG5o/eifxwW/taI9KAjzYamDYa3arRYOb77t3u/9sYKh8hz9ccJvBCFkWdWAAkDm24gjZnAFWaE/gVBmBEjrQv+xB0otIL8jyRZWUC4Rl6AkrtFAOtnZ3h3NoXGr9QU4qxlO4ulrymBbcpbIPUXgSi7u59e1pDQ4BcQiPAbuRxhNSFrKhl2Mc4yG0qYnNTtlpluihZJwrJ5mayAKUEXUwWPpywys3OvfiZM4kSFJL4trSPLrLhnQ66wsZ3OqDwozNn2qMZwYkOjQL5XxyYz4kAAHicY2BkYGAAYoWQLZPj+W2+MnAzvwCKMNzOCL8Go////5/F/II5CMjlYGACiQIAb6wN5AB4nGNgZGBgDvqfBSRf/AcC5hcMQBEUIAwAtq0HpgAAAHicY37BwMAMwgugNC4ciWAzrUNinwLS2SD2//8Ae2MRwgAAAAAAAAABygK4AxQDhgSMBuIH6giCCOwJcAmyCpgK1gw4DQwNZA24DlIAAQAAABMAiAAWAAAAAAACAI4AngBzAAABWwtwAAAAAHicjZLPSutAFId/qVXRgqAXXB/uQhQxjRE3rgoFXbkR7FJI08mfkmbKZCrU/V35IL6BOx/Al9BX8dfpcFGKaMIk3/nOmcnMIQD28IYAy+ucY8kBdhktuYVNXHpeo7/23CbfeV5HB9rzBv2D520c49FzB3/wzBWC9hajMV49B/gbnHluYSe49bxGn3puk/95Xsd+8OR5g/7F8zYGwbvnDg5a5309nZsyL6wc9o8kjuJIhnPRVGWdVJLMbKFNIz3JdG1VVekw1ZNMm8lwVlYjZU7KVNfNjcpnVWJW/IoYKNOUupbTMFrJXalamcSq0WIHzX0eW5tJZvRELv23ZWr0WKU2LKydXnS7n/eEPps7xRwGJXIUsBAc0h7xHSNyQzBkhbByWVWiRoKKJsGMMwqXaRj3ODJGNa1iRUUOkfI5cd7wPeSckpkRKwxOyKmb0eCGJme24rrmF/U/VwycaWgWseCUu4l+Me+KpnY2cScZ/e9Bg3vuMaa1XGdxWuNOJ/yRv55b2NdFbkyT0oeuu5b2Al3e3/TpA2udouQAAAB4nG3IWw7CIBBGYX5FbK133YaLmg6jECkQpInu3mjjm+fpy1EzNbVS/zthhjk0FjBYokGLFTqsscEWO+xxwBEnnNWaxpo4DTlIFW2pSsNO+N6n5/aHy62kMXeFrE+T2+LZXao8q3lIEK7Nx1SE9HdmieyDvvogxnlrJRqmyBJMP9aaonFCVkqbqdCtUHYmjkMvRXPKL6Xep1o2rQB4nGPw3sFwIihiIyNjX+QGxp0cDBwMyQUbGVidNjEwMmiBGJu5mBg5ICw+BjCLzWkX0wGgNCeQze60i8EBwmZmcNmowtgRGLHBoSNiI3OKy0Y1EG8XRwMDI4tDR3JIBEhJJBBs5mFi5NHawfi/dQNL70YmBhcADHYj9AAA\") format(\"woff\")}[class^=\"formbuilder-icon-\"]:before,[class*=\" formbuilder-icon-\"]:before{font-family:\"formbuilder-icons\";font-style:normal;font-weight:normal;speak:never;display:inline-block;text-decoration:inherit;width:1em;margin-right:.2em;text-align:center;font-variant:normal;text-transform:none;line-height:1em;margin-left:.2em}.formbuilder-icon-autocomplete:before{content:'\\e800'}.formbuilder-icon-date:before{content:'\\e801'}.formbuilder-icon-checkbox:before{content:'\\e802'}.formbuilder-icon-checkbox-group:before{content:'\\e803'}.formbuilder-icon-radio-group:before{content:'\\e804'}.formbuilder-icon-rich-text:before{content:'\\e805'}.formbuilder-icon-select:before{content:'\\e806'}.formbuilder-icon-textarea:before{content:'\\e807'}.formbuilder-icon-text:before{content:'\\e808'}.formbuilder-icon-pencil:before{content:'\\e809'}.formbuilder-icon-file:before{content:'\\e80a'}.formbuilder-icon-hidden:before{content:'\\e80b'}.formbuilder-icon-cancel:before{content:'\\e80c'}.formbuilder-icon-button:before{content:'\\e80d'}.formbuilder-icon-header:before{content:'\\e80f'}.formbuilder-icon-paragraph:before{content:'\\e810'}.formbuilder-icon-number:before{content:'\\e811'}.formbuilder-icon-copy:before{content:'\\f24d'}.form-wrap.form-builder{position:relative}.form-wrap.form-builder *{box-sizing:border-box}.form-wrap.form-builder button,.form-wrap.form-builder input,.form-wrap.form-builder select,.form-wrap.form-builder textarea{font-family:inherit;font-size:inherit;line-height:inherit}.form-wrap.form-builder input{line-height:normal}.form-wrap.form-builder textarea{overflow:auto}.form-wrap.form-builder button,.form-wrap.form-builder input,.form-wrap.form-builder select,.form-wrap.form-builder textarea{font-family:inherit;font-size:inherit;line-height:inherit}.form-wrap.form-builder .btn-group{position:relative;display:inline-block;vertical-align:middle}.form-wrap.form-builder .btn-group>.btn{position:relative;float:left}.form-wrap.form-builder .btn-group>.btn:first-child:not(:last-child):not(.dropdown-toggle){border-top-right-radius:0;border-bottom-right-radius:0}.form-wrap.form-builder .btn-group>.btn:not(:first-child):not(:last-child):not(.dropdown-toggle){border-radius:0}.form-wrap.form-builder .btn-group .btn+.btn,.form-wrap.form-builder .btn-group .btn+.btn-group,.form-wrap.form-builder .btn-group .btn-group+.btn,.form-wrap.form-builder .btn-group .btn-group+.btn-group{margin-left:-1px}.form-wrap.form-builder .btn-group>.btn:last-child:not(:first-child),.form-wrap.form-builder .btn-group>.dropdown-toggle:not(:first-child),.form-wrap.form-builder .btn-group .input-group .form-control:last-child,.form-wrap.form-builder .btn-group .input-group-addon:last-child,.form-wrap.form-builder .btn-group .input-group-btn:first-child>.btn-group:not(:first-child)>.btn,.form-wrap.form-builder .btn-group .input-group-btn:first-child>.btn:not(:first-child),.form-wrap.form-builder .btn-group .input-group-btn:last-child>.btn,.form-wrap.form-builder .btn-group .input-group-btn:last-child>.btn-group>.btn,.form-wrap.form-builder .btn-group .input-group-btn:last-child>.dropdown-toggle{border-top-left-radius:0;border-bottom-left-radius:0}.form-wrap.form-builder .btn-group>.btn.active,.form-wrap.form-builder .btn-group>.btn:active,.form-wrap.form-builder .btn-group>.btn:focus,.form-wrap.form-builder .btn-group>.btn:hover{z-index:2}.form-wrap.form-builder .btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;user-select:none;background-image:none;border-radius:4px}.form-wrap.form-builder .btn.btn-lg{padding:10px 16px;font-size:18px;line-height:1.3333333;border-radius:6px}.form-wrap.form-builder .btn.btn-sm{padding:5px 10px;font-size:12px;line-height:1.5;border-radius:3px}.form-wrap.form-builder .btn.btn-xs{padding:1px 5px;font-size:12px;line-height:1.5;border-radius:3px}.form-wrap.form-builder .btn.active,.form-wrap.form-builder .btn.btn-active,.form-wrap.form-builder .btn:active{background-image:none}.form-wrap.form-builder .input-group .form-control:last-child,.form-wrap.form-builder .input-group-addon:last-child,.form-wrap.form-builder .input-group-btn:first-child>.btn-group:not(:first-child)>.btn,.form-wrap.form-builder .input-group-btn:first-child>.btn:not(:first-child),.form-wrap.form-builder .input-group-btn:last-child>.btn,.form-wrap.form-builder .input-group-btn:last-child>.btn-group>.btn,.form-wrap.form-builder .input-group-btn:last-child>.dropdown-toggle{border-top-left-radius:0;border-bottom-left-radius:0}.form-wrap.form-builder .input-group .form-control,.form-wrap.form-builder .input-group-addon,.form-wrap.form-builder .input-group-btn{display:table-cell}.form-wrap.form-builder .input-group-lg>.form-control,.form-wrap.form-builder .input-group-lg>.input-group-addon,.form-wrap.form-builder .input-group-lg>.input-group-btn>.btn{height:46px;padding:10px 16px;font-size:18px;line-height:1.3333333}.form-wrap.form-builder .input-group{position:relative;display:table;border-collapse:separate}.form-wrap.form-builder .input-group .form-control{position:relative;z-index:2;float:left;width:100%;margin-bottom:0}.form-wrap.form-builder .form-control,.form-wrap.form-builder output{font-size:14px;line-height:1.42857143;display:block}.form-wrap.form-builder textarea.form-control{height:auto}.form-wrap.form-builder .form-control{height:34px;display:block;width:100%;padding:6px 12px;font-size:14px;line-height:1.42857143;border-radius:4px}.form-wrap.form-builder .form-control:focus{outline:0;box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(102,175,233,0.6)}.form-wrap.form-builder .form-group{margin-left:0px;margin-bottom:15px}.form-wrap.form-builder .btn,.form-wrap.form-builder .form-control{background-image:none}.form-wrap.form-builder .pull-right{float:right}.form-wrap.form-builder .pull-left{float:left}.form-wrap.form-builder .formbuilder-required,.form-wrap.form-builder .required-asterisk{color:#c10000}.form-wrap.form-builder .formbuilder-checkbox-group input[type='checkbox'],.form-wrap.form-builder .formbuilder-checkbox-group input[type='radio'],.form-wrap.form-builder .formbuilder-radio-group input[type='checkbox'],.form-wrap.form-builder .formbuilder-radio-group input[type='radio']{margin:0 4px 0 0}.form-wrap.form-builder .formbuilder-checkbox-inline,.form-wrap.form-builder .formbuilder-radio-inline{margin-right:8px;display:inline-block;vertical-align:middle;padding-left:0}.form-wrap.form-builder .formbuilder-checkbox-inline label input[type='text'],.form-wrap.form-builder .formbuilder-radio-inline label input[type='text']{margin-top:0}.form-wrap.form-builder .formbuilder-checkbox-inline:first-child,.form-wrap.form-builder .formbuilder-radio-inline:first-child{padding-left:0}.form-wrap.form-builder .formbuilder-autocomplete-list{background-color:#fff;display:none;list-style:none;padding:0;border:1px solid #ccc;border-width:0 1px 1px;position:absolute;z-index:20;max-height:200px;overflow-y:auto}.form-wrap.form-builder .formbuilder-autocomplete-list li{display:none;cursor:default;padding:5px;margin:0;transition:background-color 200ms ease-in-out}.form-wrap.form-builder .formbuilder-autocomplete-list li:hover,.form-wrap.form-builder .formbuilder-autocomplete-list li.active-option{background-color:rgba(0,0,0,0.075)}@keyframes PLACEHOLDER{0%{height:1px}100%{height:15px}}.form-wrap.form-builder .cb-wrap{width:26%;transition:transform 250ms}.form-wrap.form-builder .cb-wrap.pull-left .form-actions{float:left}.form-wrap.form-builder .cb-wrap h4{margin-top:0;color:#666}@media (max-width: 481px){.form-wrap.form-builder .cb-wrap{width:64px}.form-wrap.form-builder .cb-wrap h4{display:none}}.form-wrap.form-builder .frmb-control{margin:0;padding:0;border-radius:5px}.form-wrap.form-builder .frmb-control li{cursor:move;list-style:none;margin:0 0 -1px 0;padding:10px;text-align:left;background:#fff;-webkit-user-select:none;user-select:none;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;box-shadow:inset 0 0 0 1px #c5c5c5}.form-wrap.form-builder .frmb-control li .control-icon{width:16px;height:auto;margin-right:10px;margin-left:0.2em;display:inline-block}.form-wrap.form-builder .frmb-control li .control-icon img,.form-wrap.form-builder .frmb-control li .control-icon svg{max-width:100%;height:auto}.form-wrap.form-builder .frmb-control li:first-child{border-radius:5px 5px 0 0;margin-top:0}.form-wrap.form-builder .frmb-control li:last-child{border-radius:0 0 5px 5px}.form-wrap.form-builder .frmb-control li::before{margin-right:10px;font-size:16px}.form-wrap.form-builder .frmb-control li:hover{background-color:#f2f2f2}.form-wrap.form-builder .frmb-control li.ui-sortable-helper{border-radius:5px;transition:box-shadow 250ms;box-shadow:2px 2px 6px 0 #666;border:1px solid #fff}.form-wrap.form-builder .frmb-control li.ui-state-highlight{width:0;overflow:hidden;padding:0;margin:0;border:0 none}.form-wrap.form-builder .frmb-control li.moving{opacity:.6}.form-wrap.form-builder .frmb-control li.formbuilder-separator{background-color:transparent;box-shadow:none;padding:0;cursor:default}.form-wrap.form-builder .frmb-control li.formbuilder-separator hr{margin:10px 0}@media (max-width: 481px){.form-wrap.form-builder .frmb-control li::before{font-size:30px}.form-wrap.form-builder .frmb-control li span{display:none}}.form-wrap.form-builder .frmb-control.sort-enabled li.ui-state-highlight{box-shadow:none;height:0;width:100%;background:radial-gradient(ellipse at center, #545454 0%, rgba(0,0,0,0) 75%);border:0 none;-webkit-clip-path:polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);clip-path:polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);visibility:visible;overflow:hidden;margin:1px 0 3px;animation:PLACEHOLDER 250ms forwards}.form-wrap.form-builder .formbuilder-mobile .form-actions{width:100%}.form-wrap.form-builder .formbuilder-mobile .form-actions button{width:100%;font-size:.85em !important;display:block !important;border-radius:0 !important;margin-top:-1px;margin-left:0 !important}.form-wrap.form-builder .formbuilder-mobile .form-actions button:first-child{border-radius:5px 5px 0 0 !important;margin-top:0 !important;border-bottom:0 none}.form-wrap.form-builder .formbuilder-mobile .form-actions button:last-child{border-radius:0 0 5px 5px !important}.form-wrap.form-builder .form-actions{float:right;margin-top:5px}.form-wrap.form-builder .form-actions button{border:0 none}.form-wrap.form-builder .stage-wrap{position:relative;padding:0;margin:0;width:calc(74% - 5px)}@media (max-width: 481px){.form-wrap.form-builder .stage-wrap{width:calc(100% - 64px)}}.form-wrap.form-builder .stage-wrap.empty{border:3px dashed #ccc;background-color:rgba(255,255,255,0.25)}.form-wrap.form-builder .stage-wrap.empty::after{content:attr(data-content);position:absolute;text-align:center;top:50%;left:0;width:100%;margin-top:-1em}.form-wrap.form-builder .frmb{list-style-type:none;min-height:200px;transition:background-color 500ms ease-in-out}.form-wrap.form-builder .frmb .formbuilder-required{color:#c10000}.form-wrap.form-builder .frmb.removing{overflow:hidden}.form-wrap.form-builder .frmb>li:hover{border-color:#66afe9;outline:0;box-shadow:inset 0 1px 1px rgba(0,0,0,0.1),0 0 8px rgba(102,175,233,0.6)}.form-wrap.form-builder .frmb>li:hover .field-actions{opacity:1}.form-wrap.form-builder .frmb>li:hover li :hover{background:#fefefe}.form-wrap.form-builder .frmb li{position:relative;padding:6px;clear:both;margin-left:0;margin-bottom:3px;background-color:#fff;transition:background-color 250ms ease-in-out, margin-top 400ms}.form-wrap.form-builder .frmb li.hidden-field{background-color:rgba(255,255,255,0.6)}.form-wrap.form-builder .frmb li:first-child{border-top-right-radius:5px;border-top-left-radius:5px}.form-wrap.form-builder .frmb li:first-child .field-actions .btn:last-child{border-radius:0 5px 0 0}.form-wrap.form-builder .frmb li:last-child{border-bottom-right-radius:5px;border-bottom-left-radius:5px}.form-wrap.form-builder .frmb li.no-fields label{font-weight:400}@keyframes PLACEHOLDER{0%{height:0}100%{height:15px}}.form-wrap.form-builder .frmb li.frmb-placeholder,.form-wrap.form-builder .frmb li.ui-state-highlight{height:0;padding:0;background:radial-gradient(ellipse at center, #545454 0%, rgba(0,0,0,0) 75%);border:0 none;-webkit-clip-path:polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);clip-path:polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);visibility:visible;overflow:hidden;margin-bottom:3px;animation:PLACEHOLDER 250ms forwards}.form-wrap.form-builder .frmb li.moving,.form-wrap.form-builder .frmb li.ui-sortable-helper{transition:box-shadow 500ms ease-in-out;box-shadow:2px 2px 6px 0 #666;border:1px solid #fff;border-radius:5px}.form-wrap.form-builder .frmb li.disabled-field{z-index:1;position:relative;overflow:visible}.form-wrap.form-builder .frmb li.disabled-field:hover .frmb-tt{display:inline-block}.form-wrap.form-builder .frmb li.disabled-field [type='checkbox']{float:left;margin-right:10px}.form-wrap.form-builder .frmb li.disabled-field h2{border-bottom:0 none}.form-wrap.form-builder .frmb li.disabled-field label{font-size:12px;font-weight:400;color:#666}.form-wrap.form-builder .frmb li.disabled-field .prev-holder{cursor:default;line-height:28px;padding-left:5px}.form-wrap.form-builder .frmb li .close-field{position:absolute;color:#666;left:50%;bottom:6px;background:#fff;border-top:1px solid #c5c5c5;border-left:1px solid #c5c5c5;border-right:1px solid #c5c5c5;transform:translateX(-50%);padding:0 5px;border-top-right-radius:3px;border-top-left-radius:3px;cursor:pointer;transition:background-color 250ms ease-in-out}.form-wrap.form-builder .frmb li .close-field:hover{text-decoration:none}.form-wrap.form-builder .frmb li.button-field h1,.form-wrap.form-builder .frmb li.button-field h2,.form-wrap.form-builder .frmb li.button-field h3,.form-wrap.form-builder .frmb li.button-field p,.form-wrap.form-builder .frmb li.button-field canvas,.form-wrap.form-builder .frmb li.button-field output,.form-wrap.form-builder .frmb li.button-field address,.form-wrap.form-builder .frmb li.button-field blockquote,.form-wrap.form-builder .frmb li.button-field .prev-holder,.form-wrap.form-builder .frmb li.header-field h1,.form-wrap.form-builder .frmb li.header-field h2,.form-wrap.form-builder .frmb li.header-field h3,.form-wrap.form-builder .frmb li.header-field p,.form-wrap.form-builder .frmb li.header-field canvas,.form-wrap.form-builder .frmb li.header-field output,.form-wrap.form-builder .frmb li.header-field address,.form-wrap.form-builder .frmb li.header-field blockquote,.form-wrap.form-builder .frmb li.header-field .prev-holder,.form-wrap.form-builder .frmb li.paragraph-field h1,.form-wrap.form-builder .frmb li.paragraph-field h2,.form-wrap.form-builder .frmb li.paragraph-field h3,.form-wrap.form-builder .frmb li.paragraph-field p,.form-wrap.form-builder .frmb li.paragraph-field canvas,.form-wrap.form-builder .frmb li.paragraph-field output,.form-wrap.form-builder .frmb li.paragraph-field address,.form-wrap.form-builder .frmb li.paragraph-field blockquote,.form-wrap.form-builder .frmb li.paragraph-field .prev-holder{margin:0}.form-wrap.form-builder .frmb li.button-field .field-label,.form-wrap.form-builder .frmb li.header-field .field-label,.form-wrap.form-builder .frmb li.paragraph-field .field-label{display:none}.form-wrap.form-builder .frmb li.button-field.editing .field-label,.form-wrap.form-builder .frmb li.header-field.editing .field-label,.form-wrap.form-builder .frmb li.paragraph-field.editing .field-label{display:block}.form-wrap.form-builder .frmb li.paragraph-field .fld-label{min-height:150px;overflow-y:auto}.form-wrap.form-builder .frmb li.checkbox-field .field-label{display:none}.form-wrap.form-builder .frmb li.deleting,.form-wrap.form-builder .frmb li.delete:hover,.form-wrap.form-builder .frmb li:hover li.delete:hover{background-color:#fdd}.form-wrap.form-builder .frmb li.deleting .close-field,.form-wrap.form-builder .frmb li.delete:hover .close-field,.form-wrap.form-builder .frmb li:hover li.delete:hover .close-field{background-color:#fdd}.form-wrap.form-builder .frmb li.deleting{z-index:20;pointer-events:none}.form-wrap.form-builder .frmb.disabled-field{padding:0 5px}.form-wrap.form-builder .frmb.disabled-field :hover{border-color:transparent}.form-wrap.form-builder .frmb.disabled-field .form-element{float:none;margin-bottom:10px;overflow:visible;padding:5px 0;position:relative}.form-wrap.form-builder .frmb .frm-holder{display:none}.form-wrap.form-builder .frmb .tooltip{left:20px}.form-wrap.form-builder .frmb .prev-holder{display:block}.form-wrap.form-builder .frmb .prev-holder .form-group{margin:0}.form-wrap.form-builder .frmb .prev-holder .ql-editor{min-height:125px}.form-wrap.form-builder .frmb .prev-holder .form-group>label:not([class='formbuilder-checkbox-label']){display:none}.form-wrap.form-builder .frmb .prev-holder select,.form-wrap.form-builder .frmb .prev-holder input[type='text'],.form-wrap.form-builder .frmb .prev-holder textarea,.form-wrap.form-builder .frmb .prev-holder input[type='number']{background-color:#fff;border:1px solid #ccc;box-shadow:inset 0 1px 1px rgba(0,0,0,0.075)}.form-wrap.form-builder .frmb .prev-holder input[type='color']{width:60px;padding:2px;display:inline-block}.form-wrap.form-builder .frmb .prev-holder input[type='date']{width:auto}.form-wrap.form-builder .frmb .prev-holder select[multiple]{height:auto}.form-wrap.form-builder .frmb .prev-holder label{font-weight:normal}.form-wrap.form-builder .frmb .prev-holder input[type='number']{width:auto}.form-wrap.form-builder .frmb .prev-holder input[type='color']{width:60px;padding:2px;display:inline-block}.form-wrap.form-builder .frmb .required-asterisk{display:none}.form-wrap.form-builder .frmb .field-label,.form-wrap.form-builder .frmb .legend{color:#666;margin-bottom:5px;line-height:27px;font-size:16px;font-weight:normal}.form-wrap.form-builder .frmb .disabled-field .field-label{display:block}.form-wrap.form-builder .frmb .other-option:checked+label input{display:inline-block}.form-wrap.form-builder .frmb .other-val{margin-left:5px;display:none}.form-wrap.form-builder .frmb .field-actions{position:absolute;top:0;right:0;opacity:0}.form-wrap.form-builder .frmb .field-actions a::before{margin:0}.form-wrap.form-builder .frmb .field-actions a:hover{text-decoration:none;color:#000}.form-wrap.form-builder .frmb .field-actions .btn{display:inline-block;width:32px;height:32px;padding:0 6px;border-radius:0;border-color:#c5c5c5;background-color:#fff;color:#c5c5c5;line-height:32px;font-size:16px;border-width:0 0 1px 1px}.form-wrap.form-builder .frmb .field-actions .btn:first-child{border-bottom-left-radius:5px}.form-wrap.form-builder .frmb .field-actions .toggle-form:hover{background-color:#65aac6;color:#fff}.form-wrap.form-builder .frmb .field-actions .copy-button:hover{background-color:#6fc665;color:#fff}.form-wrap.form-builder .frmb .field-actions .del-button:hover{background-color:#c66865;color:#fff}.form-wrap.form-builder .frmb .option-actions{text-align:right;margin-top:10px;width:100%;margin-left:2%}.form-wrap.form-builder .frmb .option-actions button,.form-wrap.form-builder .frmb .option-actions a{background:#fff;padding:5px 10px;border:1px solid #c5c5c5;font-size:14px;border-radius:5px;cursor:default}.form-wrap.form-builder .frmb .sortable-options-wrap{width:81.33333333%;display:inline-block}.form-wrap.form-builder .frmb .sortable-options-wrap label{font-weight:normal}@media (max-width: 481px){.form-wrap.form-builder .frmb .sortable-options-wrap{display:block;width:100%}}.form-wrap.form-builder .frmb .radio-group-field .sortable-options li:nth-child(2) .remove{display:none}.form-wrap.form-builder .frmb .sortable-options{display:inline-block;width:100%;margin-left:2%;background:#c5c5c5;margin-bottom:0;border-radius:5px;list-style:none;padding:0}.form-wrap.form-builder .frmb .sortable-options>li{display:flex;cursor:move;margin:1px;padding-right:28px}.form-wrap.form-builder .frmb .sortable-options>li:nth-child(1) .remove{display:none}.form-wrap.form-builder .frmb .sortable-options>li .remove{position:absolute;opacity:1;right:8px;height:18px;width:18px;top:14px;font-size:12px;padding:0;color:#c10000}.form-wrap.form-builder .frmb .sortable-options>li .remove::before{margin:0}.form-wrap.form-builder .frmb .sortable-options>li .remove:hover{background-color:#c10000;text-decoration:none;color:#fff}.form-wrap.form-builder .frmb .sortable-options .option-selected{margin:0;width:5%}.form-wrap.form-builder .frmb .sortable-options input[type='text']{width:calc(44.5% - 17px);margin:0 3px;float:none}.form-wrap.form-builder .frmb .form-field .form-group{width:100%;clear:left;float:none}.form-wrap.form-builder .frmb .col-md-6 .form-elements,.form-wrap.form-builder .frmb .col-md-8 .form-elements{width:100%}.form-wrap.form-builder .frmb .field-options .add-area .add{clear:both}.form-wrap.form-builder .frmb .style-wrap button.selected{border:1px solid #000;margin-top:0;margin-right:1px;box-shadow:0 0 0 1px #fff inset;padding:1px 5px}.form-wrap.form-builder .frmb .form-elements{padding:10px 5px;background:#f7f7f7;border-radius:3px;margin:0;border:1px solid #c5c5c5}.form-wrap.form-builder .frmb .form-elements .input-wrap{width:81.33333333%;margin-left:2%;float:left}.form-wrap.form-builder .frmb .form-elements .input-wrap>input[type='checkbox']{margin-top:8px}.form-wrap.form-builder .frmb .form-elements .btn-group{margin-left:2%}.form-wrap.form-builder .frmb .form-elements .add{clear:both}.form-wrap.form-builder .frmb .form-elements [contenteditable],.form-wrap.form-builder .frmb .form-elements select[multiple]{height:auto}.form-wrap.form-builder .frmb .form-elements [contenteditable].form-control,.form-wrap.form-builder .frmb .form-elements input[type='text'],.form-wrap.form-builder .frmb .form-elements input[type='number'],.form-wrap.form-builder .frmb .form-elements input[type='date'],.form-wrap.form-builder .frmb .form-elements input[type='color'],.form-wrap.form-builder .frmb .form-elements textarea,.form-wrap.form-builder .frmb .form-elements select{transition:background 250ms ease-in-out;padding:6px 12px;border:1px solid #c5c5c5;background-color:#fff}@media (max-width: 481px){.form-wrap.form-builder .frmb .form-elements .input-wrap{width:100%;margin-left:0;float:none}}.form-wrap.form-builder .frmb .form-elements input[type='number']{width:auto}.form-wrap.form-builder .frmb .form-elements .btn-group{margin-left:2%}.col-md-6 .form-wrap.form-builder .frmb .form-elements .false-label,.col-md-8 .form-wrap.form-builder .frmb .form-elements .false-label,.col-md-6 .form-wrap.form-builder .frmb .form-elements label,.col-md-8 .form-wrap.form-builder .frmb .form-elements label{display:block}.form-wrap.form-builder .frmb .form-elements .false-label:first-child,.form-wrap.form-builder .frmb .form-elements label:first-child{width:16.66666667%;padding-top:7px;margin-bottom:0;text-align:right;font-weight:700;float:left;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;text-transform:capitalize}@media (max-width: 481px){.form-wrap.form-builder .frmb .form-elements .false-label:first-child,.form-wrap.form-builder .frmb .form-elements label:first-child{display:block;width:auto;float:none;text-align:left}.form-wrap.form-builder .frmb .form-elements .false-label:first-child.empty-label,.form-wrap.form-builder .frmb .form-elements label:first-child.empty-label{display:none}}.form-wrap.form-builder .frmb .form-elements .false-label.multiple,.form-wrap.form-builder .frmb .form-elements .false-label.required-label,.form-wrap.form-builder .frmb .form-elements .false-label.toggle-label,.form-wrap.form-builder .frmb .form-elements .false-label.roles-label,.form-wrap.form-builder .frmb .form-elements .false-label.other-label,.form-wrap.form-builder .frmb .form-elements label.multiple,.form-wrap.form-builder .frmb .form-elements label.required-label,.form-wrap.form-builder .frmb .form-elements label.toggle-label,.form-wrap.form-builder .frmb .form-elements label.roles-label,.form-wrap.form-builder .frmb .form-elements label.other-label{text-align:left;float:none;margin-bottom:-3px;font-weight:400;width:calc(81.3333% - 23px)}.form-wrap.form-builder .frmb .form-elements input.error{border:1px solid #c10000}.form-wrap.form-builder .frmb .form-elements input.fld-maxlength{width:75px}.form-wrap.form-builder .frmb .form-elements input.field-error{background:#fefefe;border:1px solid #c5c5c5}.form-wrap.form-builder .frmb .form-elements label em{display:block;font-weight:400;font-size:0.75em}.form-wrap.form-builder .frmb .form-elements label.maxlength-label{line-height:1em}.form-wrap.form-builder .frmb .form-elements .available-roles{display:none;padding:10px;margin:10px 0;background:#e6e6e6;box-shadow:inset 0 0 2px 0 #b3b3b3}@media (max-width: 481px){.form-wrap.form-builder .frmb .form-elements .available-roles{margin-left:0}}.form-wrap.form-builder .frmb .form-elements .available-roles label{font-weight:400;width:auto;float:none;display:inline}.form-wrap.form-builder .frmb .form-elements .available-roles input{display:inline;top:auto}.form-wrap.form-builder .autocomplete-field .sortable-options .option-selected{display:none}.form-wrap.form-builder .formbuilder-mobile .field-actions{opacity:1}.form-wrap.form-builder *[tooltip]{position:relative}.form-wrap.form-builder *[tooltip]:hover:after{background:rgba(0,0,0,0.9);border-radius:5px 5px 5px 0;bottom:23px;color:#fff;content:attr(tooltip);padding:10px 5px;position:absolute;z-index:98;left:2px;width:230px;text-shadow:none;font-size:12px;line-height:1.5em;cursor:default}.form-wrap.form-builder *[tooltip]:hover:before{border:solid;border-color:#222 transparent;border-width:6px 6px 0;bottom:17px;content:'';left:2px;position:absolute;z-index:99;cursor:default}.form-wrap.form-builder .tooltip-element{visibility:visible;color:#fff;background:#000;width:16px;height:16px;border-radius:8px;display:inline-block;text-align:center;line-height:16px;margin:0 5px;font-size:12px;cursor:default}.form-wrap.form-builder .kc-toggle{padding-left:0 !important}.form-wrap.form-builder .kc-toggle span{position:relative;width:48px;height:24px;background:#e6e6e6;display:inline-block;border-radius:4px;border:1px solid #ccc;padding:2px;overflow:hidden;float:left;margin-right:5px;will-change:transform}.form-wrap.form-builder .kc-toggle span::after,.form-wrap.form-builder .kc-toggle span::before{position:absolute;display:inline-block;top:0}.form-wrap.form-builder .kc-toggle span::after{position:relative;content:'';width:50%;height:100%;left:0;border-radius:3px;background:linear-gradient(to bottom, #fff 0%, #ccc 100%);border:1px solid #999;transition:transform 100ms;transform:translateX(0)}.form-wrap.form-builder .kc-toggle span::before{border-radius:4px;top:2px;left:2px;content:'';width:calc(100% - 4px);height:18px;box-shadow:0 0 1px 1px #b3b3b3 inset;background-color:transparent}.form-wrap.form-builder .kc-toggle input{height:0;overflow:hidden;width:0;opacity:0;pointer-events:none;margin:0}.form-wrap.form-builder .kc-toggle input:checked+span::after{transform:translateX(100%)}.form-wrap.form-builder .kc-toggle input:checked+span::before{background-color:#6fc665}.form-wrap.form-builder::after{content:'';display:table;clear:both}.cb-wrap,.stage-wrap{vertical-align:top}.cb-wrap.pull-right,.stage-wrap.pull-right{float:right}.cb-wrap.pull-left,.stage-wrap.pull-left{float:left}.form-elements,.form-group,.multi-row span,textarea{display:block}.form-elements::after,.form-group::after{content:'.';display:block;height:0;clear:both;visibility:hidden}.form-elements .field-options div:hover,.frmb .legend,.frmb .prev-holder{cursor:move}.frmb-tt{display:none;position:absolute;top:0;left:0;border:1px solid #262626;background-color:#666;border-radius:5px;padding:5px;color:#fff;z-index:20;text-align:left;font-size:12px;pointer-events:none}.frmb-tt::before{border-color:#262626 transparent;bottom:-11px}.frmb-tt::before,.frmb-tt::after{content:'';position:absolute;border-style:solid;border-width:10px 10px 0;border-color:#666 transparent;display:block;width:0;z-index:1;margin-left:-10px;bottom:-10px;left:20px}.frmb-tt a{text-decoration:underline;color:#fff}.frmb li:hover .del-button,.frmb li:hover .toggle-form,.formbuilder-mobile .frmb li .del-button,.formbuilder-mobile .frmb li .toggle-form{opacity:1}.frmb-xml .ui-dialog-content{white-space:pre-wrap;word-wrap:break-word;font-size:12px;padding:0 30px;margin-top:0}.toggle-form{opacity:0}.toggle-form:hover{border-color:#ccc}.toggle-form::before{margin:0}.formb-field-vars .copy-var{display:inline-block;width:24px;height:24px;background:#b3b3b3;text-indent:-9999px}.ui-button .ui-button-text{line-height:0}.form-builder-overlay{position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,0.5);display:none;z-index:10}.form-builder-overlay.visible{display:block}.form-builder-dialog{position:absolute;border-radius:5px;background:#fff;z-index:20;transform:translate(-50%, -50%);top:0;left:0;padding:10px;box-shadow:0 3px 10px #000;min-width:166px;max-height:80%;overflow-y:scroll}.form-builder-dialog h3{margin-top:0}.form-builder-dialog.data-dialog{width:65%;background-color:#23241f}.form-builder-dialog.data-dialog pre{background:none;border:0 none;box-shadow:none;margin:0;color:#f2f2f2}.form-builder-dialog.positioned{transform:translate(-50%, -100%)}.form-builder-dialog.positioned .button-wrap::before{content:'';width:0;height:0;border-left:15px solid transparent;border-right:15px solid transparent;border-top:10px solid #fff;position:absolute;left:50%;top:100%;transform:translate(-50%, 10px)}.form-builder-dialog .button-wrap{position:relative;margin-top:10px;text-align:right;clear:both}.form-builder-dialog .button-wrap .btn{margin-left:10px}\n", ""]), t["default"] = n;
  }, function (e, t, r) {
    var o = r(11),
        n = r(19),
        i = r(22),
        l = Math.max,
        a = Math.min;

    e.exports = function (e, t, r) {
      var s,
          c,
          d,
          u,
          f,
          p,
          m = 0,
          b = !1,
          h = !1,
          g = !0;
      if ("function" != typeof e) throw new TypeError("Expected a function");

      function y(t) {
        var r = s,
            o = c;
        return s = c = void 0, m = t, u = e.apply(o, r);
      }

      function w(e) {
        return m = e, f = setTimeout(x, t), b ? y(e) : u;
      }

      function v(e) {
        var r = e - p;
        return void 0 === p || r >= t || r < 0 || h && e - m >= d;
      }

      function x() {
        var e = n();
        if (v(e)) return O(e);
        f = setTimeout(x, function (e) {
          var r = t - (e - p);
          return h ? a(r, d - (e - m)) : r;
        }(e));
      }

      function O(e) {
        return f = void 0, g && s ? y(e) : (s = c = void 0, u);
      }

      function A() {
        var e = n(),
            r = v(e);

        if (s = arguments, c = this, p = e, r) {
          if (void 0 === f) return w(p);
          if (h) return clearTimeout(f), f = setTimeout(x, t), y(p);
        }

        return void 0 === f && (f = setTimeout(x, t)), u;
      }

      return t = i(t) || 0, o(r) && (b = !!r.leading, d = (h = "maxWait" in r) ? l(i(r.maxWait) || 0, t) : d, g = "trailing" in r ? !!r.trailing : g), A.cancel = function () {
        void 0 !== f && clearTimeout(f), m = 0, s = p = c = f = void 0;
      }, A.flush = function () {
        return void 0 === f ? u : O(n());
      }, A;
    };
  }, function (e, t, r) {
    var o = r(13);

    e.exports = function () {
      return o.Date.now();
    };
  }, function (e, t, r) {
    (function (t) {
      var r = "object" == _typeof(t) && t && t.Object === Object && t;
      e.exports = r;
    }).call(this, r(21));
  }, function (e, t) {
    var r;

    r = function () {
      return this;
    }();

    try {
      r = r || new Function("return this")();
    } catch (e) {
      "object" == (typeof window === "undefined" ? "undefined" : _typeof(window)) && (r = window);
    }

    e.exports = r;
  }, function (e, t, r) {
    var o = r(23),
        n = r(11),
        i = r(25),
        l = /^[-+]0x[0-9a-f]+$/i,
        a = /^0b[01]+$/i,
        s = /^0o[0-7]+$/i,
        c = parseInt;

    e.exports = function (e) {
      if ("number" == typeof e) return e;
      if (i(e)) return NaN;

      if (n(e)) {
        var t = "function" == typeof e.valueOf ? e.valueOf() : e;
        e = n(t) ? t + "" : t;
      }

      if ("string" != typeof e) return 0 === e ? e : +e;
      e = o(e);
      var r = a.test(e);
      return r || s.test(e) ? c(e.slice(2), r ? 2 : 8) : l.test(e) ? NaN : +e;
    };
  }, function (e, t, r) {
    var o = r(24),
        n = /^\s+/;

    e.exports = function (e) {
      return e ? e.slice(0, o(e) + 1).replace(n, "") : e;
    };
  }, function (e, t) {
    var r = /\s/;

    e.exports = function (e) {
      for (var t = e.length; t-- && r.test(e.charAt(t));) {
        ;
      }

      return t;
    };
  }, function (e, t, r) {
    var o = r(26),
        n = r(29);

    e.exports = function (e) {
      return "symbol" == _typeof(e) || n(e) && "[object Symbol]" == o(e);
    };
  }, function (e, t, r) {
    var o = r(14),
        n = r(27),
        i = r(28),
        l = o ? o.toStringTag : void 0;

    e.exports = function (e) {
      return null == e ? void 0 === e ? "[object Undefined]" : "[object Null]" : l && l in Object(e) ? n(e) : i(e);
    };
  }, function (e, t, r) {
    var o = r(14),
        n = Object.prototype,
        i = n.hasOwnProperty,
        l = n.toString,
        a = o ? o.toStringTag : void 0;

    e.exports = function (e) {
      var t = i.call(e, a),
          r = e[a];

      try {
        e[a] = void 0;
        var o = !0;
      } catch (e) {}

      var n = l.call(e);
      return o && (t ? e[a] = r : delete e[a]), n;
    };
  }, function (e, t) {
    var r = Object.prototype.toString;

    e.exports = function (e) {
      return r.call(e);
    };
  }, function (e, t) {
    e.exports = function (e) {
      return null != e && "object" == _typeof(e);
    };
  },,,,,, function (t, r, o) {
    o.r(r);
    o(16);
    var n = o(15),
        i = o.n(n),
        l = o(4);
    var a = {};

    var s = function s(e) {
      _classCallCheck(this, s);

      this.formData = {}, this.formID = e, this.layout = "", a[e] = this;
    };

    var c = o(2),
        d = o.n(c),
        u = o(5),
        f = o(10),
        p = o(0),
        m = o(3),
        b = o(1),
        h = o(6);

    function g(e, t) {
      if (null == e) return {};

      var r,
          o,
          n = function (e, t) {
        if (null == e) return {};
        var r,
            o,
            n = {},
            i = Object.keys(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || (n[r] = e[r]);
        }

        return n;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || Object.prototype.propertyIsEnumerable.call(e, r) && (n[r] = e[r]);
        }
      }

      return n;
    }

    var y = /*#__PURE__*/function () {
      function y(e, t, r) {
        _classCallCheck(this, y);

        this.data = a[e], this.d = l.d[e], this.doCancel = !1, this.layout = t, this.handleKeyDown = this.handleKeyDown.bind(this), this.formBuilder = r;
      }

      _createClass(y, [{
        key: "startMoving",
        value: function startMoving(e, t) {
          t.item.show().addClass("moving"), this.doCancel = !0, this.from = t.item.parent();
        }
      }, {
        key: "stopMoving",
        value: function stopMoving(t, r) {
          r.item.removeClass("moving"), this.doCancel && (r.sender && e(r.sender).sortable("cancel"), this.from.sortable("cancel")), this.save(), this.doCancel = !1;
        }
      }, {
        key: "beforeStop",
        value: function beforeStop(e, t) {
          var r = this,
              o = m.a.opts,
              n = r.d.stage.childNodes.length - 1,
              i = [];
          r.stopIndex = t.placeholder.index() - 1, !o.sortableControls && t.item.parent().hasClass("frmb-control") && i.push(!0), o.prepend && i.push(0 === r.stopIndex), o.append && i.push(r.stopIndex + 1 === n), r.doCancel = i.some(function (e) {
            return !0 === e;
          });
        }
      }, {
        key: "getTypes",
        value: function getTypes(t) {
          var r = {
            type: t.attr("type")
          },
              o = e(".fld-subtype", t).val();
          return o !== r.type && (r.subtype = o), r;
        }
      }, {
        key: "fieldOptionData",
        value: function fieldOptionData(t) {
          var r = [],
              o = e(".sortable-options li", t);
          return o.each(function (e) {
            var t = o[e],
                n = t.querySelectorAll("input[type=text], input[type=number], select"),
                i = t.querySelectorAll("input[type=checkbox], input[type=radio]"),
                l = {};
            Object(p.i)(n, function (e) {
              var t = n[e],
                  r = t.dataset.attr;
              l[r] = t.value;
            }), Object(p.i)(i, function (e) {
              var t = i[e],
                  r = t.getAttribute("data-attr");
              l[r] = t.checked;
            }), r.push(l);
          }), r;
        }
      }, {
        key: "xmlSave",
        value: function xmlSave(e) {
          var t = this.prepData(e),
              r = new XMLSerializer(),
              o = ["<fields>"];
          t.forEach(function (e) {
            var t = e.values,
                r = g(e, ["values"]);
            var n = ["<field ".concat(Object(p.C)(r), ">")];

            if (l.e.includes(e.type)) {
              var _e16 = t.map(function (e) {
                return Object(p.q)("option", e.label, e).outerHTML;
              });

              n = n.concat(_e16);
            }

            n.push("</field>"), o.push(n);
          }), o.push("</fields>");
          var n = Object(p.q)("form-template", Object(p.h)(o).join(""));
          return r.serializeToString(n);
        }
      }, {
        key: "prepData",
        value: function prepData(t) {
          var r = [],
              o = this.d,
              n = this;
          return 0 !== t.childNodes.length && Object(p.i)(t.childNodes, function (t, i) {
            var l = e(i);

            if (!l.hasClass("disabled-field")) {
              var _t18 = n.getTypes(l);

              var _a5 = e(".roles-field:checked", i),
                  _s3 = _a5.map(function (e) {
                return _a5[e].value;
              }).get();

              if (_t18 = Object.assign({}, _t18, n.getAttrVals(i)), _t18.subtype) if ("quill" === _t18.subtype) {
                var _e17 = _t18.name + "-preview";

                if (window.fbEditors.quill[_e17]) {
                  var _r16 = window.fbEditors.quill[_e17].instance.getContents();

                  _t18.value = window.JSON.stringify(_r16.ops);
                }
              } else if ("tinymce" === _t18.subtype && window.tinymce) {
                var _e18 = _t18.name + "-preview";

                if (window.tinymce.editors[_e18]) {
                  var _r17 = window.tinymce.editors[_e18];
                  _t18.value = _r17.getContent();
                }
              }

              if (_s3.length && (_t18.role = _s3.join(",")), _t18.className = _t18.className || _t18["class"], _t18.className) {
                var _e19 = /(?:^|\s)btn-(.*?)(?:\s|$)/g.exec(_t18.className);

                _e19 && (_t18.style = _e19[1]);
              }

              _t18 = Object(p.A)(_t18);
              _t18.type && _t18.type.match(o.optionFieldsRegEx) && (_t18.values = n.fieldOptionData(l)), r.push(_t18);
            }
          }), r;
        }
      }, {
        key: "getData",
        value: function getData(e) {
          var t = this.data;
          if (e || (e = m.a.opts.formData), !e) return !1;
          var r = {
            xml: function xml(e) {
              return Array.isArray(e) ? e : Object(p.t)(e);
            },
            json: function json(e) {
              return "string" == typeof e ? window.JSON.parse(e) : e;
            }
          };
          return t.formData = r[m.a.opts.dataType](e) || [], t.formData;
        }
      }, {
        key: "save",
        value: function save(e) {
          var t = this,
              r = this.data,
              o = this.d.stage,
              n = {
            xml: function xml(e) {
              return t.xmlSave(o, e);
            },
            json: function json(e) {
              return window.JSON.stringify(t.prepData(o), null, e && "  ");
            }
          };
          return r.formData = n[m.a.opts.dataType](e), document.dispatchEvent(u.a.formSaved), r.formData;
        }
      }, {
        key: "incrementId",
        value: function incrementId(e) {
          var t = e.lastIndexOf("-"),
              r = parseInt(e.substring(t + 1)) + 1;
          return "".concat(e.substring(0, t), "-").concat(r);
        }
      }, {
        key: "getAttrVals",
        value: function getAttrVals(t) {
          var r = Object.create(null),
              o = t.querySelectorAll('[class*="fld-"]');
          return Object(p.i)(o, function (t) {
            var n = o[t],
                i = Object(p.c)(n.getAttribute("name")),
                l = [[n.attributes.contenteditable, function () {
              return "xml" === m.a.opts.dataType ? Object(p.g)(n.innerHTML) : n.innerHTML;
            }], ["checkbox" === n.type, function () {
              return n.checked;
            }], ["number" === n.type && "" !== n.value, function () {
              return Number(n.value);
            }], [n.attributes.multiple, function () {
              return e(n).val();
            }], [!0, function () {
              return n.value;
            }]].find(function (_ref6) {
              var _ref7 = _slicedToArray(_ref6, 1),
                  e = _ref7[0];

              return !!e;
            })[1]();
            r[i] = l;
          }), r;
        }
      }, {
        key: "updatePreview",
        value: function updatePreview(t) {
          var r = this.d,
              o = t.attr("class"),
              n = t[0];
          if (o.includes("input-control")) return;
          var i = t.attr("type"),
              a = e(".prev-holder", n);
          var s = Object.assign({}, this.getAttrVals(n), {
            type: i
          });
          i.match(r.optionFieldsRegEx) && (s.values = [], s.multiple = e('[name="multiple"]', n).is(":checked"), e(".sortable-options li", n).each(function (t, r) {
            var o = {
              selected: e(".option-selected", r).is(":checked"),
              value: e(".option-value", r).val(),
              label: e(".option-label", r).val()
            };
            s.values.push(o);
          })), s = Object(p.A)(s, !0), s.className = this.classNames(n, s), t.data("fieldData", s);
          var c = h.a.lookup(s.type),
              d = c ? c["class"] : b.a.getClass(s.type, s.subtype),
              f = this.layout.build(d, s);
          Object(l.b)(a[0]), a[0].appendChild(f), f.dispatchEvent(u.a.fieldRendered);
        }
      }, {
        key: "disabledTT",
        value: function disabledTT(e) {
          var t = e.querySelectorAll(".disabled-field");
          Object(p.i)(t, function (e) {
            var r = t[e],
                o = d.a.get("fieldNonEditable");

            if (o) {
              var _e20 = Object(p.q)("p", o, {
                className: "frmb-tt"
              });

              r.appendChild(_e20), r.addEventListener("mousemove", function (t) {
                return function (e, t) {
                  var r = t.field.getBoundingClientRect(),
                      o = e.clientX - r.left - 21,
                      n = e.clientY - r.top - t.tt.offsetHeight - 12;
                  t.tt.style.transform = "translate(".concat(o, "px, ").concat(n, "px)");
                }(t, {
                  tt: _e20,
                  field: r
                });
              });
            }
          });
        }
      }, {
        key: "classNames",
        value: function classNames(t, r) {
          var o = t.querySelector(".fld-className"),
              n = t.querySelector(".btn-style"),
              i = n && n.value;
          if (!o) return;
          var l = r.type,
              a = o.multiple ? e(o).val() : o.value.trim().split(" "),
              s = {
            button: "btn",
            submit: "btn"
          }[l];

          if (s && i) {
            for (var _e21 = 0; _e21 < a.length; _e21++) {
              var _t19 = new RegExp("^".concat(s, "-.*"), "g");

              a[_e21].match(_t19) ? a.splice(_e21, 1, s + "-" + i) : a.push(s + "-" + i);
            }

            a.push(s);
          }

          var c = Object(p.B)(a).join(" ").trim();
          return o.value = c, c;
        }
      }, {
        key: "closeConfirm",
        value: function closeConfirm(e, t) {
          e || (e = document.getElementsByClassName("form-builder-overlay")[0]), e && Object(l.f)(e), t || (t = document.getElementsByClassName("form-builder-dialog")[0]), t && Object(l.f)(t), document.removeEventListener("keydown", this.handleKeyDown, !1), document.dispatchEvent(u.a.modalClosed);
        }
      }, {
        key: "handleKeyDown",
        value: function handleKeyDown(e) {
          27 === (e.keyCode || e.which) && (e.preventDefault(), this.closeConfirm.call(this));
        }
      }, {
        key: "editorLayout",
        value: function editorLayout(e) {
          return {
            left: {
              stage: "pull-right",
              controls: "pull-left"
            },
            right: {
              stage: "pull-left",
              controls: "pull-right"
            }
          }[e] || "";
        }
      }, {
        key: "showOverlay",
        value: function showOverlay() {
          var _this7 = this;

          var e = Object(p.q)("div", null, {
            className: "form-builder-overlay"
          });
          return document.body.appendChild(e), e.classList.add("visible"), e.addEventListener("click", function (_ref8) {
            var e = _ref8.target;
            return _this7.closeConfirm(e);
          }, !1), document.addEventListener("keydown", this.handleKeyDown, !1), e;
        }
      }, {
        key: "confirm",
        value: function confirm(e, t) {
          var r = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : !1;
          var o = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : "";
          var n = this,
              i = d.a.current,
              l = n.showOverlay(),
              a = Object(p.q)("button", i.yes, {
            className: "yes btn btn-success btn-sm"
          }),
              s = Object(p.q)("button", i.no, {
            className: "no btn btn-danger btn-sm"
          });
          s.onclick = function () {
            n.closeConfirm(l);
          }, a.onclick = function () {
            t(), n.closeConfirm(l);
          };
          var c = Object(p.q)("div", [s, a], {
            className: "button-wrap"
          });
          o = "form-builder-dialog " + o;
          var u = Object(p.q)("div", [e, c], {
            className: o
          });
          if (r) u.classList.add("positioned");else {
            var _e22 = document.documentElement;
            r = {
              pageX: Math.max(_e22.clientWidth, window.innerWidth || 0) / 2,
              pageY: Math.max(_e22.clientHeight, window.innerHeight || 0) / 2
            }, u.style.position = "fixed";
          }
          return u.style.left = r.pageX + "px", u.style.top = r.pageY + "px", document.body.appendChild(u), a.focus(), u;
        }
      }, {
        key: "dialog",
        value: function dialog(e) {
          var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : !1;
          var r = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "";
          var o = document.documentElement.clientWidth,
              n = document.documentElement.clientHeight;
          this.showOverlay(), r = "form-builder-dialog " + r;
          var i = Object(p.q)("div", e, {
            className: r
          });
          return t ? i.classList.add("positioned") : (t = {
            pageX: Math.max(o, window.innerWidth || 0) / 2,
            pageY: Math.max(n, window.innerHeight || 0) / 2
          }, i.style.position = "fixed"), i.style.left = t.pageX + "px", i.style.top = t.pageY + "px", document.body.appendChild(i), document.dispatchEvent(u.a.modalOpened), -1 !== r.indexOf("data-dialog") && document.dispatchEvent(u.a.viewData), i;
        }
      }, {
        key: "confirmRemoveAll",
        value: function confirmRemoveAll(t) {
          var _this8 = this;

          var r = this,
              o = t.target.id.match(/frmb-\d{13}/)[0],
              n = document.getElementById(o),
              i = d.a.current,
              l = e("li.form-field", n),
              a = t.target.getBoundingClientRect(),
              s = document.body.getBoundingClientRect(),
              c = {
            pageX: a.left + a.width / 2,
            pageY: a.top - s.top - 12
          };
          l.length ? r.confirm(i.clearAllMessage, function () {
            r.removeAllFields.call(r, n), m.a.opts.persistDefaultFields && m.a.opts.defaultFields ? _this8.addDefaultFields() : m.a.opts.notify.success(i.allFieldsRemoved), m.a.opts.onClearAll();
          }, c) : r.dialog(i.noFieldsToClear, c);
        }
      }, {
        key: "addDefaultFields",
        value: function addDefaultFields() {
          var _this9 = this;

          m.a.opts.defaultFields.forEach(function (e) {
            return _this9.formBuilder.prepFieldVars(e);
          }), this.d.stage.classList.remove("empty");
        }
      }, {
        key: "removeAllFields",
        value: function removeAllFields(e) {
          var t = d.a.current,
              r = m.a.opts,
              o = [];
          if (!e.querySelectorAll("li.form-field").length) return !1;
          r.prepend && o.push(!0), r.append && o.push(!0), o.some(Boolean) || (e.classList.add("empty"), e.dataset.content = t.getStarted), this.emptyStage(e);
        }
      }, {
        key: "emptyStage",
        value: function emptyStage(e) {
          Object(l.b)(e).classList.remove("removing"), this.save();
        }
      }, {
        key: "setFieldOrder",
        value: function setFieldOrder(t) {
          if (!m.a.opts.sortableControls) return !1;
          var _window = window,
              r = _window.sessionStorage,
              o = _window.JSON,
              n = [];
          return t.children().each(function (t, r) {
            var o = e(r).data("type");
            o && n.push(o);
          }), r && r.setItem("fieldOrder", o.stringify(n)), n;
        }
      }, {
        key: "closeAllEdit",
        value: function closeAllEdit() {
          var t = e("> li.editing", this.d.stage),
              r = e(".toggle-form", this.d.stage),
              o = e(".frm-holder", t);
          r.removeClass("open"), t.removeClass("editing"), e(".prev-holder", t).show(), o.hide();
        }
      }, {
        key: "toggleEdit",
        value: function toggleEdit(t) {
          var r = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : !0;
          var o = document.getElementById(t);
          if (!o) return o;
          var n = e(".frm-holder", o),
              i = e(".prev-holder", o);
          return o.classList.toggle("editing"), e(".toggle-form", o).toggleClass("open"), r ? (i.slideToggle(250), n.slideToggle(250)) : (i.toggle(), n.toggle()), this.updatePreview(e(o)), o.classList.contains("editing") ? (this.formBuilder.currentEditPanel = n[0], m.a.opts.onOpenFieldEdit(n[0]), document.dispatchEvent(u.a.fieldEditOpened)) : (m.a.opts.onCloseFieldEdit(n[0]), document.dispatchEvent(u.a.fieldEditClosed)), o;
        }
      }, {
        key: "getStyle",
        value: function getStyle(e) {
          var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : !1;
          var r;
          return window.getComputedStyle ? r = window.getComputedStyle(e, null) : e.currentStyle && (r = e.currentStyle), t ? r[t] : r;
        }
      }, {
        key: "stickyControls",
        value: function stickyControls() {
          var _this$d = this.d,
              t = _this$d.controls,
              r = _this$d.stage,
              o = e(t).parent(),
              n = t.getBoundingClientRect(),
              _r$getBoundingClientR = r.getBoundingClientRect(),
              i = _r$getBoundingClientR.top;

          e(window).scroll(function (l) {
            var a = e(l.target).scrollTop(),
                s = {
              top: 5,
              bottom: "auto",
              right: "auto",
              left: n.left
            },
                c = Object.assign({}, s, m.a.opts.stickyControls.offset);

            if (a > i) {
              var _e23 = {
                position: "sticky"
              },
                  _n7 = Object.assign(_e23, c),
                  _i12 = t.getBoundingClientRect(),
                  _l = r.getBoundingClientRect(),
                  _s4 = _i12.top + _i12.height,
                  _d2 = _l.top + _l.height,
                  _u3 = _s4 === _d2 && _i12.top > a;

              _s4 > _d2 && _i12.top !== _l.top && o.css({
                position: "absolute",
                top: "auto",
                bottom: 0,
                right: 0,
                left: "auto"
              }), (_s4 < _d2 || _u3) && o.css(_n7);
            } else t.parentElement.removeAttribute("style");
          });
        }
      }, {
        key: "showData",
        value: function showData() {
          var e = this.getFormData(m.a.opts.dataType, !0);
          "xml" === m.a.opts.dataType && (e = Object(p.g)(e));
          var t = Object(p.q)("code", e, {
            className: "formData-" + m.a.opts.dataType
          });
          this.dialog(Object(p.q)("pre", t), null, "data-dialog");
        }
      }, {
        key: "removeField",
        value: function removeField(t) {
          var r = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 250;
          var o = !1;
          var n = this,
              i = this.d.stage,
              l = i.getElementsByClassName("form-field");
          if (!l.length) return m.a.opts.notify.warning("No fields to remove"), !1;
          var a = t && document.getElementById(t);

          if (!t || !a) {
            var _e24 = [].slice.call(l).map(function (e) {
              return e.id;
            });

            m.a.opts.notify.warning("fieldID required to remove specific fields."), m.a.opts.notify.warning("Removing last field since no ID was supplied."), m.a.opts.notify.warning("Available IDs: " + _e24.join(", ")), t = i.lastChild.id;
          }

          var s = e(a);
          if (!a) return m.a.opts.notify.warning("Field not found"), !1;
          s.slideUp(r, function () {
            s.removeClass("deleting"), s.remove(), o = !0, n.save(), i.childNodes.length || (i.classList.add("empty"), i.dataset.content = d.a.current.getStarted);
          });
          var c = m.a.opts.typeUserEvents[a.type];
          return c && c.onremove && c.onremove(a), document.dispatchEvent(u.a.fieldRemoved), o;
        }
      }, {
        key: "processActionButtons",
        value: function processActionButtons(e) {
          var t = e.label,
              r = e.events,
              o = g(e, ["label", "events"]);
          var n = t;
          var i = this.data;
          n = n ? d.a.current[n] || n : o.id ? d.a.current[o.id] || Object(p.d)(o.id) : "", o.id ? o.id = "".concat(i.formID, "-").concat(o.id, "-action") : o.id = "".concat(i.formID, "-action-").concat(Math.round(1e3 * Math.random()));
          var l = Object(p.q)("button", n, o);

          if (r) {
            var _loop2 = function _loop2(_e25) {
              r.hasOwnProperty(_e25) && l.addEventListener(_e25, function (t) {
                return r[_e25](t);
              });
            };

            for (var _e25 in r) {
              _loop2(_e25);
            }
          }

          return l;
        }
      }, {
        key: "processSubtypes",
        value: function processSubtypes(e) {
          var t = m.a.opts.disabledSubtypes;

          for (var _t20 in e) {
            e.hasOwnProperty(_t20) && b.a.register(e[_t20], b.a.getClass(_t20), _t20);
          }

          var r = b.a.getRegisteredSubtypes(),
              o = Object.entries(r).reduce(function (e, _ref9) {
            var _ref10 = _slicedToArray(_ref9, 2),
                r = _ref10[0],
                o = _ref10[1];

            return e[r] = t[r] && Object(p.y)(t[r], o) || o, e;
          }, {}),
              n = {};

          for (var _e26 in o) {
            if (o.hasOwnProperty(_e26)) {
              var _t21 = [];

              var _iterator5 = _createForOfIteratorHelper(o[_e26]),
                  _step5;

              try {
                for (_iterator5.s(); !(_step5 = _iterator5.n()).done;) {
                  var _r18 = _step5.value;

                  var _o10 = b.a.getClass(_e26, _r18),
                      _n8 = _o10.mi18n("subtype." + _r18) || _o10.mi18n(_r18) || _r18;

                  _t21.push({
                    label: _n8,
                    value: _r18
                  });
                }
              } catch (err) {
                _iterator5.e(err);
              } finally {
                _iterator5.f();
              }

              n[_e26] = _t21;
            }
          }

          return n;
        }
      }, {
        key: "editorUI",
        value: function editorUI(e) {
          var t = this.d,
              r = this.data,
              o = e || r.formID;
          t.editorWrap = Object(p.q)("div", null, {
            id: r.formID + "-form-wrap",
            className: "form-wrap form-builder " + Object(p.r)()
          }), t.stage = Object(p.q)("ul", null, {
            id: o,
            className: "frmb stage-wrap " + r.layout.stage
          }), t.controls = Object(p.q)("ul", null, {
            id: o + "-control-box",
            className: "frmb-control"
          });
          var n = this.formActionButtons();
          t.formActions = Object(p.q)("div", n, {
            className: "form-actions btn-group"
          });
        }
      }, {
        key: "formActionButtons",
        value: function formActionButtons() {
          var _this10 = this;

          var e = m.a.opts;
          return e.actionButtons.map(function (t) {
            if (t.id && -1 === e.disabledActionButtons.indexOf(t.id)) return _this10.processActionButtons(t);
          }).filter(Boolean);
        }
      }, {
        key: "processOptions",
        value: function processOptions(e) {
          var t = this,
              r = e.actionButtons,
              o = e.replaceFields,
              n = g(e, ["actionButtons", "replaceFields"]);
          var i = n.fieldEditContainer;
          "string" == typeof n.fieldEditContainer && (i = document.querySelector(n.fieldEditContainer));
          var l = [{
            type: "button",
            id: "clear",
            className: "clear-all btn btn-danger",
            events: {
              click: t.confirmRemoveAll.bind(t)
            }
          }, {
            type: "button",
            label: "viewJSON",
            id: "data",
            className: "btn btn-default get-data",
            events: {
              click: t.showData.bind(t)
            }
          }, {
            type: "button",
            id: "save",
            className: "btn btn-primary save-template",
            events: {
              click: function click(e) {
                t.save(), m.a.opts.onSave(e, t.data.formData);
              }
            }
          }].concat(r);
          return n.fields = n.fields.concat(o), n.disableFields = n.disableFields.concat(o.map(function (_ref11) {
            var e = _ref11.type;
            return e && e;
          })), "xml" === n.dataType && (n.disableHTMLLabels = !0), m.a.opts = Object.assign({}, {
            actionButtons: l
          }, {
            fieldEditContainer: i
          }, n), m.a.opts;
        }
      }, {
        key: "input",
        value: function input() {
          var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
          return Object(p.q)("input", null, e);
        }
      }, {
        key: "getFormData",
        value: function getFormData() {
          var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : "js";
          var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : !1;
          var r = this;
          return {
            js: function js() {
              return r.prepData(r.d.stage);
            },
            xml: function xml() {
              return r.xmlSave(r.d.stage);
            },
            json: function json(e) {
              return window.JSON.stringify(r.prepData(r.d.stage), null, e && "  ");
            }
          }[e](t);
        }
      }]);

      return y;
    }();

    o(12);
    var w = o(8);

    var v = /*#__PURE__*/function () {
      function v(e, t) {
        _classCallCheck(this, v);

        this.opts = e, this.dom = t.controls, this.custom = h.a, this.getClass = b.a.getClass, this.getRegistered = b.a.getRegistered, b.a.controlConfig = e.controlConfig || {}, this.init();
      }

      _createClass(v, [{
        key: "init",
        value: function init() {
          this.setupControls(), this.appendControls();
        }
      }, {
        key: "setupControls",
        value: function setupControls() {
          var _this11 = this;

          var e = this.opts;
          b.a.loadCustom(e.controls), Object.keys(e.fields).length && h.a.register(e.templates, e.fields);
          var t = b.a.getRegistered();
          this.registeredControls = t;
          var r = h.a.getRegistered();
          r && jQuery.merge(t, r);
          var o = b.a.getRegisteredSubtypes();
          this.registeredSubtypes = o, e.sortableControls && this.dom.classList.add("sort-enabled"), this.controlList = [], this.allControls = {};

          for (var _e27 = 0; _e27 < t.length; _e27++) {
            var _r19 = t[_e27];

            var _o11 = void 0,
                _n9 = h.a.lookup(_r19);

            if (_n9) _o11 = _n9["class"];else if (_n9 = {}, _o11 = b.a.getClass(_r19), !_o11 || !_o11.active(_r19)) continue;

            var _i13 = _n9.icon || _o11.icon(_r19);

            var _l2 = _n9.label || _o11.label(_r19);

            var _a6 = _i13 ? "" : _n9.iconClassName || "" + (w.a + _r19.replace(/-[\d]{4}$/, ""));

            _i13 && (_l2 = "<span class=\"control-icon\">".concat(_i13, "</span>").concat(_l2));

            var _s5 = Object(p.q)("li", Object(p.q)("span", _l2), {
              className: "".concat(_a6, " input-control input-control-").concat(_e27)
            });

            _s5.dataset.type = _r19, this.controlList.push(_r19), this.allControls[_r19] = _s5;
          }

          e.inputSets.length && e.inputSets.forEach(function (e, t) {
            var r = e.name,
                o = e.label;
            r = r || Object(p.n)(o), e.icon && (o = "<span class=\"control-icon\">".concat(e.icon, "</span>").concat(o));
            var n = Object(p.q)("li", o, {
              className: "input-set-control input-set-" + t
            });
            n.dataset.type = r, _this11.controlList.push(r), _this11.allControls[r] = n;
          });
        }
      }, {
        key: "orderFields",
        value: function orderFields(e) {
          var t = this.opts,
              r = t.controlOrder.concat(e);
          var o;
          return window.sessionStorage && (t.sortableControls ? o = window.sessionStorage.getItem("fieldOrder") : window.sessionStorage.removeItem("fieldOrder")), o ? (o = window.JSON.parse(o), o = Object(p.B)(o.concat(e)), o = Object.keys(o).map(function (e) {
            return o[e];
          })) : o = Object(p.B)(r), o.forEach(function (e) {
            var t = new RegExp("-[\\d]{4}$");

            if (e.match(t)) {
              var _r20 = o.indexOf(e.replace(t, ""));

              -1 !== _r20 && (o.splice(o.indexOf(e), 1), o.splice(_r20 + 1, o.indexOf(e), e));
            }
          }), t.disableFields.length && (o = o.filter(function (e) {
            return !t.disableFields.includes(e);
          })), o.filter(Boolean);
        }
      }, {
        key: "appendControls",
        value: function appendControls() {
          var _this12 = this;

          var e = document.createDocumentFragment();
          Object(l.b)(this.dom), this.orderFields(this.controlList).forEach(function (t) {
            var r = _this12.allControls[t];
            r && e.appendChild(r);
          }), this.dom.appendChild(e);
        }
      }]);

      return v;
    }();

    function x(e, t) {
      if (null == e) return {};

      var r,
          o,
          n = function (e, t) {
        if (null == e) return {};
        var r,
            o,
            n = {},
            i = Object.keys(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || (n[r] = e[r]);
        }

        return n;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (o = 0; o < i.length; o++) {
          r = i[o], t.indexOf(r) >= 0 || Object.prototype.propertyIsEnumerable.call(e, r) && (n[r] = e[r]);
        }
      }

      return n;
    }

    function O(e, t) {
      var r = Object.keys(e);

      if (Object.getOwnPropertySymbols) {
        var o = Object.getOwnPropertySymbols(e);
        t && (o = o.filter(function (t) {
          return Object.getOwnPropertyDescriptor(e, t).enumerable;
        })), r.push.apply(r, o);
      }

      return r;
    }

    function A(e) {
      for (var t = 1; t < arguments.length; t++) {
        var r = null != arguments[t] ? arguments[t] : {};
        t % 2 ? O(Object(r), !0).forEach(function (t) {
          j(e, t, r[t]);
        }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(r)) : O(Object(r)).forEach(function (t) {
          Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(r, t));
        });
      }

      return e;
    }

    function j(e, t, r) {
      return t in e ? Object.defineProperty(e, t, {
        value: r,
        enumerable: !0,
        configurable: !0,
        writable: !0
      }) : e[t] = r, e;
    }

    var k = function k(e, t, r) {
      var _this13 = this;

      var o = this,
          n = d.a.current,
          a = "frmb-" + new Date().getTime(),
          c = new s(a),
          b = new l.a(a);
      e.layout || (e.layout = f.a);
      var h = new e.layout(e.layoutTemplates, !0),
          g = new y(a, h, o),
          O = p.q;
      e = g.processOptions(e), c.layout = g.editorLayout(e.controlPosition), g.editorUI(a), c.formID = a, c.lastID = c.formID + "-fld-0";
      var j = new v(e, b),
          k = m.a.subtypes = g.processSubtypes(e.subtypes),
          q = r(b.stage),
          C = r(b.controls);
      q.sortable({
        cursor: "move",
        opacity: 0.9,
        revert: 150,
        beforeStop: function beforeStop(e, t) {
          return g.beforeStop.call(g, e, t);
        },
        start: function start(e, t) {
          return g.startMoving.call(g, e, t);
        },
        stop: function stop(e, t) {
          return g.stopMoving.call(g, e, t);
        },
        cancel: ["input", "select", "textarea", ".disabled-field", ".form-elements", ".btn", "button", ".is-locked"].join(", "),
        placeholder: "frmb-placeholder"
      }), e.allowStageSort || q.sortable("disable"), C.sortable({
        helper: "clone",
        opacity: 0.9,
        connectWith: q,
        cancel: ".formbuilder-separator",
        cursor: "move",
        scroll: !1,
        placeholder: "ui-state-highlight",
        start: function start(e, t) {
          return g.startMoving.call(g, e, t);
        },
        stop: function stop(e, t) {
          return g.stopMoving.call(g, e, t);
        },
        revert: 150,
        beforeStop: function beforeStop(e, t) {
          return g.beforeStop.call(g, e, t);
        },
        distance: 3,
        update: function update(t, r) {
          if (g.doCancel) return !1;
          r.item.parent()[0] === b.stage ? (g.doCancel = !0, E(r.item)) : (g.setFieldOrder(C), g.doCancel = !e.sortableControls);
        }
      });

      var E = function E(t) {
        if (t[0].classList.contains("input-set-control")) {
          var _r21 = [],
              _o12 = e.inputSets.find(function (e) {
            return Object(p.n)(e.name || e.label) === t[0].dataset.type;
          });

          if (_o12 && _o12.showHeader) {
            var _e28 = {
              type: "header",
              subtype: "h2",
              id: _o12.name,
              label: _o12.label
            };

            _r21.push(_e28);
          }

          _r21.push.apply(_r21, _toConsumableArray(_o12.fields)), _r21.forEach(function (e) {
            L(e, !0), (g.stopIndex || 0 === g.stopIndex) && g.stopIndex++;
          });
        } else L(t, !0);
      },
          N = r(b.editorWrap),
          S = O("div", b.controls, {
        id: c.formID + "-cb-wrap",
        className: "cb-wrap " + c.layout.controls
      });

      e.showActionButtons && S.appendChild(b.formActions), N.append(b.stage, S), "textarea" !== t.type ? r(t).append(N) : r(t).replaceWith(N), r(b.controls).on("click", "li", function (_ref12) {
        var e = _ref12.target;
        var t = r(e).closest("li");
        g.stopIndex = void 0, E(t), g.save.call(g);
      });

      var L = function L(t) {
        var o = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : !1;
        var n = {};
        if (t instanceof jQuery) {
          if (n.type = t[0].dataset.type, n.type) {
            var _e29 = j.custom.lookup(n.type);

            if (_e29) n = Object.assign({}, _e29);else {
              var _e30 = j.getClass(n.type);

              n.label = _e30.label(n.type);
            }
          } else {
            var _e31 = t[0].attributes;
            o || (n.values = t.children().map(function (e, t) {
              return {
                label: r(t).text(),
                value: r(t).attr("value"),
                selected: Boolean(r(t).attr("selected"))
              };
            }));

            for (var _t22 = _e31.length - 1; _t22 >= 0; _t22--) {
              n[_e31[_t22].name] = _e31[_t22].value;
            }
          }
        } else n = Object.assign({}, t);
        n.name || (n.name = Object(p.s)(n)), o && ["text", "number", "file", "date", "select", "textarea", "autocomplete"].includes(n.type) && (n.className = n.className || "form-control");
        var i = /(?:^|\s)btn-(.*?)(?:\s|$)/g.exec(n.className);

        if (i && (n.style = i[1]), o) {
          var _e32 = setTimeout(function () {
            document.dispatchEvent(u.a.fieldAdded), clearTimeout(_e32);
          }, 10);
        }

        e.onAddField(c.lastID, n), W(n, o), e.onAddFieldAfter(c.lastID, n), b.stage.classList.remove("empty");
      };

      o.prepFieldVars = L;

      var D = function D(t) {
        (t = g.getData(t)) && t.length ? (t.forEach(function (e) {
          return L(Object(p.A)(e));
        }), b.stage.classList.remove("empty")) : e.defaultFields && e.defaultFields.length ? g.addDefaultFields() : e.prepend || e.append || (b.stage.classList.add("empty"), b.stage.dataset.content = d.a.get("getStarted")), function () {
          var t = [],
              o = function o(t) {
            return O("li", e[t], {
              className: "disabled-field form-" + t
            });
          };

          return e.prepend && !r(".disabled-field.form-prepend", b.stage).length && (t.push(!0), q.prepend(o("prepend"))), e.append && !r(".disabled-field.form-.append", b.stage).length && (t.push(!0), q.append(o("append"))), g.disabledTT(b.stage), t.some(function (e) {
            return !0 === e;
          });
        }() && b.stage.classList.remove("empty"), g.save();
      },
          T = function T(t) {
        var r = t.type,
            o = [],
            n = j.getClass(r),
            i = function (e) {
          var t = ["required", "label", "description", "placeholder", "className", "name", "access", "value"],
              r = !["header", "paragraph", "file", "autocomplete"].concat(b.optionFields).includes(e),
              o = {
            autocomplete: t.concat(["options", "requireValidOption"]),
            button: ["label", "subtype", "style", "className", "name", "value", "access"],
            checkbox: ["required", "label", "description", "toggle", "inline", "className", "name", "access", "other", "options"],
            text: t.concat(["subtype", "maxlength"]),
            date: t,
            file: t.concat(["subtype", "multiple"]),
            header: ["label", "subtype", "className", "access"],
            hidden: ["name", "value", "access"],
            paragraph: ["label", "subtype", "className", "access"],
            number: t.concat(["min", "max", "step"]),
            select: t.concat(["multiple", "options"]),
            textarea: t.concat(["subtype", "maxlength", "rows"])
          };
          e in j.registeredSubtypes && !(e in o) && (o[e] = t.concat(["subtype"])), o["checkbox-group"] = o.checkbox, o["radio-group"] = o.checkbox;
          var n = o[e];
          return "radio-group" === e && Object(p.v)("toggle", n), ["header", "paragraph", "button"].includes(e) && Object(p.v)("description", n), r || Object(p.v)("value", n), n || t;
        }(r),
            l = {
          required: function required() {
            return V(t);
          },
          toggle: function toggle() {
            return M("toggle", t, {
              first: d.a.get("toggle")
            });
          },
          inline: function inline() {
            var e = {
              first: d.a.get("inline"),
              second: d.a.get("inlineDesc", r.replace("-group", ""))
            };
            return M("inline", t, e);
          },
          label: function label() {
            return Q("label", t);
          },
          description: function description() {
            return Q("description", t);
          },
          subtype: function subtype() {
            return H("subtype", t, k[r]);
          },
          style: function style() {
            return z(t.style);
          },
          placeholder: function placeholder() {
            return Q("placeholder", t);
          },
          rows: function rows() {
            return U("rows", t);
          },
          className: function className(e) {
            return Q("className", t, e);
          },
          name: function name(e) {
            return Q("name", t, e);
          },
          value: function value() {
            return Q("value", t);
          },
          maxlength: function maxlength() {
            return U("maxlength", t);
          },
          access: function access() {
            var r = ["<div class=\"available-roles\" ".concat(t.role ? 'style="display:block"' : "", ">")];

            for (a in e.roles) {
              if (e.roles.hasOwnProperty(a)) {
                var _t23 = "fld-".concat(c.lastID, "-roles-").concat(a),
                    _o13 = {
                  type: "checkbox",
                  name: "roles[]",
                  value: a,
                  id: _t23,
                  className: "roles-field"
                };

                s.includes(a) && (_o13.checked = "checked"), r.push("<label for=\"".concat(_t23, "\">")), r.push(g.input(_o13).outerHTML), r.push(" ".concat(e.roles[a], "</label>"));
              }
            }

            r.push("</div>");
            var o = {
              first: d.a.get("roles"),
              second: d.a.get("limitRole"),
              content: r.join("")
            };
            return M("access", t, o);
          },
          other: function other() {
            return M("other", t, {
              first: d.a.get("enableOther"),
              second: d.a.get("enableOtherMsg")
            });
          },
          options: function options() {
            return function (e) {
              var t = e.type,
                  r = e.values;
              var o;

              var n = [O("a", d.a.get("addOption"), {
                className: "add add-opt"
              })],
                  i = [O("label", d.a.get("selectOptions"), {
                className: "false-label"
              })],
                  l = e.multiple || "checkbox-group" === t,
                  a = function a(e) {
                var t = d.a.get("optionCount", e);
                return {
                  selected: !1,
                  label: t,
                  value: Object(p.n)(t)
                };
              };

              if (r && r.length) o = r.map(function (e) {
                return Object.assign({}, {
                  selected: !1
                }, e);
              });else {
                var _e33 = [1, 2, 3];
                ["checkbox-group", "checkbox"].includes(t) && (_e33 = [1]), o = _e33.map(a);
                var _r22 = o[0];
                _r22.hasOwnProperty("selected") && "radio-group" !== t && (_r22.selected = !0);
              }
              var s = O("div", n, {
                className: "option-actions"
              }),
                  c = O("ol", o.map(function (e, r) {
                var o = m.a.opts.onAddOption(e, {
                  type: t,
                  index: r,
                  isMultiple: l
                });
                return Y(o, l);
              }), {
                className: "sortable-options"
              }),
                  u = O("div", [c, s], {
                className: "sortable-options-wrap"
              });
              return i.push(u), O("div", i, {
                className: "form-group field-options"
              }).outerHTML;
            }(t);
          },
          requireValidOption: function requireValidOption() {
            return M("requireValidOption", t, {
              first: " ",
              second: d.a.get("requireValidOption")
            });
          },
          multiple: function multiple() {
            var e = {
              "default": {
                first: "Multiple",
                second: "set multiple attribute"
              },
              file: {
                first: d.a.get("multipleFiles"),
                second: d.a.get("allowMultipleFiles")
              },
              select: {
                first: " ",
                second: d.a.get("selectionsMessage")
              }
            };
            return M("multiple", t, e[r] || e["default"]);
          }
        };

        var a;
        var s = void 0 !== t.role ? t.role.split(",") : [];
        ["min", "max", "step"].forEach(function (e) {
          l[e] = function () {
            return U(e, t);
          };
        });
        var u = ["name", "className"];

        if (Object.keys(i).forEach(function (t) {
          var a = i[t],
              s = [!0],
              c = e.disabledAttrs.includes(a);

          if (e.typeUserDisabledAttrs[r]) {
            var _t24 = e.typeUserDisabledAttrs[r];
            s.push(!_t24.includes(a));
          }

          if (n.definition.hasOwnProperty("defaultAttrs")) {
            var _e34 = Object.keys(n.definition.defaultAttrs);

            s.push(!_e34.includes(a));
          }

          if (e.typeUserAttrs[r]) {
            var _t25 = Object.keys(e.typeUserAttrs[r]);

            s.push(!_t25.includes(a));
          }

          c && !u.includes(a) && s.push(!1), s.every(Boolean) && o.push(l[a](c));
        }), n.definition.hasOwnProperty("defaultAttrs")) {
          var _e35 = R(n.definition.defaultAttrs, t);

          o.push(_e35);
        }

        if (e.typeUserAttrs[r]) {
          var _n10 = R(e.typeUserAttrs[r], t);

          o.push(_n10);
        }

        return o.join("");
      };

      function B(e) {
        return [["array", function (_ref13) {
          var e = _ref13.options;
          return !!e;
        }], ["boolean", function (_ref14) {
          var e = _ref14.type;
          return "checkbox" === e;
        }], [_typeof(e.value), function () {
          return !0;
        }]].find(function (t) {
          return t[1](e);
        })[0] || "string";
      }

      function F(e, t) {
        return e.subtype && e.subtype === t;
      }

      function R(e, t) {
        var r = [],
            o = {
          array: P,
          string: I,
          number: U,
          "boolean": function boolean(e, r) {
            var o = !1;
            return "checkbox" === e.type ? o = Boolean(!!r.hasOwnProperty("value") && r.value) : t.hasOwnProperty(e) ? o = t[e] : (r.hasOwnProperty("value") || r.hasOwnProperty("checked")) && (o = r.value || r.checked || !1), M(e, A(A({}, r), {}, _defineProperty({}, e, o)), {
              first: r.label
            });
          }
        };

        for (var _i14 in e) {
          if (e.hasOwnProperty(_i14)) {
            var _l3 = B(e[_i14]);

            if ("undefined" !== _l3) {
              var _d$a;

              var _a7 = d.a.get(_i14),
                  _s6 = e[_i14],
                  _c = _s6.value || "";

              _s6.value = t[_i14] || _s6.value || "", _s6.label && (n[_i14] = Array.isArray(_s6.label) ? (_d$a = d.a).get.apply(_d$a, _toConsumableArray(_s6.label)) || _s6.label[0] : _s6.label), o[_l3] && r.push(o[_l3](_i14, _s6)), n[_i14] = _a7, _s6.value = _c;
            } else {
              if ("undefined" !== _l3 || !F(t, _i14)) continue;
              r.push(R(e[_i14], t));
            }
          }
        }

        return r.join("");
      }

      function I(e, t) {
        var r = t["class"],
            o = t.className,
            i = x(t, ["class", "className"]);
        var l = {
          id: e + "-" + c.lastID,
          title: i.description || i.label || e.toUpperCase(),
          name: e,
          type: i.type || "text",
          className: ["fld-" + e, (r || o || "").trim()],
          value: i.value || ""
        };
        var a = "<label for=\"".concat(l.id, "\">").concat(n[e] || "", "</label>");
        ["checkbox", "checkbox-group", "radio-group"].includes(l.type) || l.className.push("form-control"), l = Object.assign({}, i, l);
        return "<div class=\"form-group ".concat(e, "-wrap\">").concat(a, "<div class=\"input-wrap\">".concat(function () {
          if ("textarea" === l.type) {
            var _e36 = l.value;
            return delete l.value, "<textarea ".concat(Object(p.b)(l), ">").concat(_e36, "</textarea>");
          }

          return "<input ".concat(Object(p.b)(l), ">");
        }(), "</div>"), "</div>");
      }

      function P(e, t) {
        var r = t.multiple,
            o = t.options,
            i = t.label,
            l = t.value,
            a = t["class"],
            s = t.className,
            u = x(t, ["multiple", "options", "label", "value", "class", "className"]),
            f = Object.keys(o).map(function (e) {
          var _d$a2;

          var t = {
            value: e
          },
              r = o[e],
              n = Array.isArray(r) ? (_d$a2 = d.a).get.apply(_d$a2, _toConsumableArray(r)) || r[0] : r;
          return (Array.isArray(l) ? l.includes(e) : e === l) && (t.selected = null), O("option", n, t);
        }),
            p = {
          id: "".concat(e, "-").concat(c.lastID),
          title: u.description || i || e.toUpperCase(),
          name: e,
          className: "fld-".concat(e, " form-control ").concat(a || s || "").trim()
        };
        r && (p.multiple = !0);
        var m = "<label for=\"".concat(p.id, "\">").concat(n[e], "</label>");
        Object.keys(u).forEach(function (e) {
          p[e] = u[e];
        });
        return "<div class=\"form-group ".concat(e, "-wrap\">").concat(m, "<div class=\"input-wrap\">".concat(O("select", f, p).outerHTML, "</div>"), "</div>");
      }

      var M = function M(e, t) {
        var r = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

        var o = function o(t) {
          return O("label", t, {
            "for": "".concat(e, "-").concat(c.lastID)
          }).outerHTML;
        },
            n = {
          type: "checkbox",
          className: "fld-" + e,
          name: e,
          id: "".concat(e, "-").concat(c.lastID)
        };

        t[e] && (n.checked = !0);
        var i = [];
        var l = [O("input", null, n).outerHTML];
        return r.first && i.push(o(r.first)), r.second && l.push(" ", o(r.second)), r.content && l.push(r.content), l = O("div", l, {
          className: "input-wrap"
        }).outerHTML, O("div", i.concat(l), {
          className: "form-group ".concat(e, "-wrap")
        }).outerHTML;
      },
          z = function z(e) {
        var t = "";
        "undefined" === e && (e = "default");
        var r = "<label>".concat(n.style, "</label>");
        return t += g.input({
          value: e || "default",
          type: "hidden",
          className: "btn-style"
        }).outerHTML, t += '<div class="btn-group" role="group">', m.d.btn.forEach(function (r) {
          var o = ["btn-xs", "btn", "btn-" + r];
          e === r && o.push("selected");
          var n = O("button", d.a.get("styles.btn." + r), {
            value: r,
            type: "button",
            className: o.join(" ")
          }).outerHTML;
          t += n;
        }), t += "</div>", t = O("div", [r, t], {
          className: "form-group style-wrap"
        }), t.outerHTML;
      },
          U = function U(e, t) {
        var r = t["class"],
            o = t.className,
            n = t.value,
            i = x(t, ["class", "className", "value"])[e] || n,
            l = d.a.get(e) || e,
            a = {
          type: "number",
          value: i,
          name: e,
          placeholder: d.a.get("placeholder." + e),
          className: "fld-".concat(e, " form-control ").concat(r || o || "").trim(),
          id: "".concat(e, "-").concat(c.lastID)
        },
            s = g.input(Object(p.A)(a)).outerHTML;
        return O("div", ["<label for=\"".concat(a.id, "\">").concat(l, "</label>"), "<div class=\"input-wrap\">".concat(s, "</div>")], {
          className: "form-group ".concat(e, "-wrap")
        }).outerHTML;
      },
          H = function H(e, t, r) {
        var o = r.map(function (r, o) {
          var i = Object.assign({
            label: "".concat(n.option, " ").concat(o),
            value: void 0
          }, r);
          return r.value === t[e] && (i.selected = !0), i = Object(p.A)(i), O("option", i.label, i);
        }),
            i = {
          id: e + "-" + c.lastID,
          name: e,
          className: "fld-".concat(e, " form-control")
        },
            l = d.a.get(e) || Object(p.d)(e) || "",
            a = O("label", l, {
          "for": i.id
        }),
            s = O("select", o, i),
            u = O("div", s, {
          className: "input-wrap"
        });
        return O("div", [a, u], {
          className: "form-group ".concat(i.name, "-wrap")
        }).outerHTML;
      },
          Q = function Q(t, r) {
        var o = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : !1;
        var n = ["paragraph"];
        var i = r[t] || "",
            l = d.a.get(t);
        "label" === t && (n.includes(r.type) ? l = d.a.get("content") : i = Object(p.u)(i));
        var a = d.a.get("placeholders." + t) || "";
        var s = "";

        if (![].some(function (e) {
          return !0 === e;
        })) {
          var _n11 = {
            name: t,
            placeholder: a,
            className: "fld-".concat(t, " form-control"),
            id: "".concat(t, "-").concat(c.lastID)
          },
              _d3 = O("label", l, {
            "for": _n11.id
          }).outerHTML;
          "label" !== t || e.disableHTMLLabels ? (_n11.value = i, _n11.type = "text", s += "<input ".concat(Object(p.b)(_n11), ">")) : (_n11.contenteditable = !0, s += O("div", i, _n11).outerHTML);

          var _u4 = "<div class=\"input-wrap\">".concat(s, "</div>");

          var _f2 = o ? "none" : "block";

          "value" === t && (_f2 = r.subtype && "quill" === r.subtype && "none"), s = O("div", [_d3, _u4], {
            className: "form-group ".concat(t, "-wrap"),
            style: "display: " + _f2
          });
        }

        return s.outerHTML;
      },
          V = function V(e) {
        var t = e.type,
            r = [];
        var o = "";
        return ["header", "paragraph", "button"].includes(t) && r.push(!0), r.some(function (e) {
          return !0 === e;
        }) || (o = M("required", e, {
          first: d.a.get("required")
        })), o;
      },
          W = function W(t) {
        var i = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : !0;
        c.lastID = g.incrementId(c.lastID);
        var l = t.type || "text";
        var a = t.label || (i ? n.get(l) || d.a.get("label") : "");
        "hidden" === l && (a = "".concat(d.a.get(l), ": ").concat(t.name));
        var s = e.disabledFieldButtons[l] || t.disabledFieldButtons;
        var u = [O("a", null, {
          type: "remove",
          id: "del_" + c.lastID,
          className: "del-button btn ".concat(w.a, "cancel delete-confirm"),
          title: d.a.get("removeMessage")
        }), O("a", null, {
          type: "edit",
          id: c.lastID + "-edit",
          className: "toggle-form btn ".concat(w.a, "pencil"),
          title: d.a.get("hide")
        }), O("a", null, {
          type: "copy",
          id: c.lastID + "-copy",
          className: "copy-button btn ".concat(w.a, "copy"),
          title: d.a.get("copyButtonTooltip")
        })];
        s && Array.isArray(s) && (u = u.filter(function (e) {
          return !s.includes(e.type);
        }));
        var f = [O("div", u, {
          className: "field-actions"
        })];
        f.push(O("label", Object(p.u)(a), {
          className: "field-label"
        })), f.push(O("span", " *", {
          className: "required-asterisk",
          style: t.required ? "display:inline" : ""
        }));
        var m = {
          className: "tooltip-element",
          tooltip: t.description,
          style: t.description ? "display:inline-block" : "display:none"
        };
        f.push(O("span", "?", m)), f.push(O("div", "", {
          className: "prev-holder"
        }));
        var h = O("div", [T(t), O("a", d.a.get("close"), {
          className: "close-field"
        })], {
          className: "form-elements"
        }),
            y = O("div", h, {
          id: c.lastID + "-holder",
          className: "frm-holder",
          dataFieldId: c.lastID
        });
        o.currentEditPanel = y, f.push(y);
        var v = O("li", f, {
          "class": l + "-field form-field",
          type: l,
          id: c.lastID
        }),
            x = r(v);
        x.data("fieldData", {
          attrs: t
        }), void 0 !== g.stopIndex ? r("> li", b.stage).eq(g.stopIndex).before(x) : q.append(x), r(".sortable-options", x).sortable({
          update: function update() {
            return g.updatePreview(x);
          }
        }), g.updatePreview(x), e.typeUserEvents[l] && e.typeUserEvents[l].onadd && e.typeUserEvents[l].onadd(v), i && (e.editOnAdd && (g.closeAllEdit(), g.toggleEdit(c.lastID, !1)), v.scrollIntoView && e.scrollToFieldOnAdd && v.scrollIntoView({
          behavior: "smooth"
        }));
      },
          Y = function Y(e, t) {
        var r = {
          selected: t ? "checkbox" : "radio"
        },
            o = {
          "boolean": function boolean(e, t) {
            var o = {
              value: e,
              type: r[t] || "checkbox"
            };
            return e && (o.checked = !!e), ["input", null, o];
          },
          number: function number(e) {
            return ["input", null, {
              value: e,
              type: "number"
            }];
          },
          string: function string(e, t) {
            return ["input", null, {
              value: e,
              type: "text",
              placeholder: d.a.get("placeholder." + t) || ""
            }];
          },
          array: function array(e) {
            return ["select", e.map(function (_ref15) {
              var e = _ref15.label,
                  t = _ref15.value;
              return O("option", e, {
                value: t
              });
            })];
          },
          object: function object(e) {
            var t = e.tag,
                r = e.content;
            return [t, r, x(e, ["tag", "content"])];
          }
        };
        e = A(A({}, {
          selected: !1,
          label: "",
          value: ""
        }), e);
        var n = Object.entries(e).map(function (_ref16) {
          var _ref17 = _slicedToArray(_ref16, 2),
              e = _ref17[0],
              t = _ref17[1];

          var r = Object(p.k)(t),
              _o$r = o[r](t, e),
              _o$r2 = _slicedToArray(_o$r, 3),
              n = _o$r2[0],
              i = _o$r2[1],
              l = _o$r2[2],
              a = "option-".concat(e, " option-attr");

          return l["data-attr"] = e, l.className = l.className ? "".concat(l.className, " ").concat(a) : a, O(n, i, l);
        }),
            i = {
          className: "remove btn ".concat(w.a, "cancel"),
          title: d.a.get("removeMessage")
        };
        return n.push(O("a", null, i)), O("li", n).outerHTML;
      },
          X = [".form-elements input", ".form-elements select", ".form-elements textarea"].join(", ");

      q.on("change blur keyup click", X, i()(function (e) {
        if (e) {
          if ([function (_ref18) {
            var e = _ref18.type,
                t = _ref18.target;
            return "keyup" === e && "className" === t.name;
          }].some(function (t) {
            return t(e);
          })) return !1;
          g.updatePreview(r(e.target).closest(".form-field")), g.save.call(g);
        }
      }, 333, {
        leading: !1
      })), q.on("click touchstart", ".remove", function (t) {
        var o = r(t.target).parents(".form-field:eq(0)"),
            n = o[0],
            i = n.getAttribute("type"),
            l = r(t.target.parentElement);
        t.preventDefault();
        n.querySelector(".sortable-options").childNodes.length <= 2 && !i.includes("checkbox") ? e.notify.error("Error: " + d.a.get("minOptionMessage")) : l.slideUp("250", function () {
          l.remove(), g.updatePreview(o), g.save.call(g);
        });
      }), q.on("touchstart", "input", function (e) {
        var t = r(_this13);
        if (!0 === e.handled) return !1;
        if ("checkbox" === t.attr("type")) t.trigger("click");else {
          t.focus();

          var _e37 = t.val();

          t.val(_e37);
        }
      }), q.on("click touchstart", ".toggle-form, .close-field", function (e) {
        if (e.stopPropagation(), e.preventDefault(), !0 === e.handled) return !1;
        {
          var _t26 = r(e.target).parents(".form-field:eq(0)").attr("id");

          g.toggleEdit(_t26), e.handled = !0;
        }
      }), q.on("dblclick", "li.form-field", function (e) {
        if (!["select", "input", "label"].includes(e.target.tagName.toLowerCase()) && "true" !== e.target.contentEditable && (e.stopPropagation(), e.preventDefault(), !0 !== e.handled)) {
          var _t27 = "li" == e.target.tagName ? r(e.target).attr("id") : r(e.target).closest("li.form-field").attr("id");

          g.toggleEdit(_t27), e.handled = !0;
        }
      }), q.on("change", '[name="subtype"]', function (e) {
        var t = r(e.target).closest("li.form-field");
        r(".value-wrap", t).toggle("quill" !== e.target.value);
      });

      if (q.on("change", [".prev-holder input", ".prev-holder select", ".prev-holder textarea"].join(", "), function (e) {
        var t;
        if (e.target.classList.contains("other-option")) return;
        var r = Object(p.e)(e.target, ".form-field");

        if (["select", "checkbox-group", "radio-group"].includes(r.type)) {
          var _o14 = r.getElementsByClassName("option-value");

          "select" === r.type ? Object(p.i)(_o14, function (t) {
            _o14[t].parentElement.childNodes[0].checked = e.target.value === _o14[t].value;
          }) : (t = document.getElementsByName(e.target.name), Object(p.i)(t, function (e) {
            _o14[e].parentElement.childNodes[0].checked = t[e].checked;
          }));
        } else {
          var _t28 = document.getElementById("value-" + r.id);

          _t28 && (_t28.value = e.target.value);
        }

        g.save.call(g);
      }), Object(p.a)(b.stage, "keyup change", function (_ref19) {
        var e = _ref19.target;
        if (!e.classList.contains("fld-label")) return;
        var t = e.value || e.innerHTML;
        Object(p.e)(e, ".form-field").querySelector(".field-label").innerHTML = Object(p.u)(t);
      }), q.on("keyup", "input.error", function (_ref20) {
        var e = _ref20.target;
        return r(e).removeClass("error");
      }), q.on("keyup", 'input[name="description"]', function (e) {
        var t = r(e.target).parents(".form-field:eq(0)"),
            o = r(".tooltip-element", t),
            n = r(e.target).val();
        if ("" !== n) {
          if (o.length) o.attr("tooltip", n).css("display", "inline-block");else {
            var _e38 = "<span class=\"tooltip-element\" tooltip=\"".concat(n, "\">?</span>");

            r(".field-label", t).after(_e38);
          }
        } else o.length && o.css("display", "none");
      }), q.on("change", ".fld-multiple", function (e) {
        var t = e.target.checked ? "checkbox" : "radio",
            o = r(".option-selected", r(e.target).closest(".form-elements"));
        return o.each(function (e) {
          return o[e].type = t;
        }), t;
      }), q.on("blur", "input.fld-name", function (e) {
        e.target.value = Object(p.x)(e.target.value), "" === e.target.value ? r(e.target).addClass("field-error").attr("placeholder", d.a.get("cannotBeEmpty")) : r(e.target).removeClass("field-error");
      }), q.on("blur", "input.fld-maxlength", function (e) {
        e.target.value = Object(p.j)(e.target.value);
      }), q.on("click touchstart", ".".concat(w.a, "copy"), function (t) {
        t.preventDefault();

        var o = r(t.target).parent().parent("li"),
            n = function (t) {
          c.lastID = g.incrementId(c.lastID);
          var o = t.attr("id"),
              n = t.attr("type"),
              i = n + "-" + new Date().getTime(),
              l = t.clone();
          return r(".fld-name", l).val(i), l.find("[id]").each(function (e, t) {
            t.id = t.id.replace(o, c.lastID);
          }), l.find("[for]").each(function (e, t) {
            var r = t.getAttribute("for").replace(o, c.lastID);
            t.setAttribute("for", r);
          }), l.attr("id", c.lastID), l.attr("name", i), l.addClass("cloned"), r(".sortable-options", l).sortable(), e.typeUserEvents[n] && e.typeUserEvents[n].onclone && e.typeUserEvents[n].onclone(l[0]), l;
        }(o);

        n.insertAfter(o), g.updatePreview(n), g.save.call(g);
      }), q.on("click touchstart", ".delete-confirm", function (t) {
        t.preventDefault();
        var o = t.target.getBoundingClientRect(),
            n = document.body.getBoundingClientRect(),
            i = {
          pageX: o.left + o.width / 2,
          pageY: o.top - n.top - 12
        },
            l = r(t.target).parents(".form-field:eq(0)").attr("id"),
            a = r(document.getElementById(l));

        if (document.addEventListener("modalClosed", function () {
          a.removeClass("deleting");
        }, !1), e.fieldRemoveWarn) {
          var _e39 = O("h3", d.a.get("warning")),
              _t29 = O("p", d.a.get("fieldRemoveWarning"));

          g.confirm([_e39, _t29], function () {
            return g.removeField(l);
          }, i), a.addClass("deleting");
        } else {// g.removeField(l);
        }

        ;
      }), q.on("click", ".style-wrap button", function (e) {
        var t = r(e.target),
            o = t.closest(".form-elements"),
            n = t.val(),
            i = r(".btn-style", o);
        i.val(n), t.siblings(".btn").removeClass("selected"), t.addClass("selected"), g.updatePreview(i.closest(".form-field")), g.save();
      }), q.on("click", ".fld-required", function (e) {
        r(e.target).closest(".form-field").find(".required-asterisk").toggle();
      }), q.on("click", "input.fld-access", function (e) {
        var t = r(e.target).closest(".form-field").find(".available-roles"),
            o = r(e.target);
        t.slideToggle(250, function () {
          o.is(":checked") || r("input[type=checkbox]", t).removeAttr("checked");
        });
      }), q.on("click", ".add-opt", function (e) {
        e.preventDefault();
        var t = r(e.target).closest(".form-field").attr("type"),
            o = r(e.target).closest(".field-options"),
            n = r('[name="multiple"]', o),
            i = r(".option-selected:eq(0)", o);
        var l = !1;
        l = n.length ? n.prop("checked") : "checkbox" === i.attr("type");
        var a = r(".sortable-options", o),
            s = m.a.opts.onAddOption({
          selected: !1,
          label: "",
          value: ""
        }, {
          type: t,
          index: a.children().length,
          isMultiple: l
        });
        a.append(Y(s, l));
      }), q.on("mouseover mouseout", ".remove, .del-button", function (e) {
        return r(e.target).closest("li").toggleClass();
      }), D(), e.disableInjectedStyle) {
        var _e40 = document.getElementsByClassName("formBuilder-injected-style");

        Object(p.i)(_e40, function (t) {
          return Object(l.f)(_e40[t]);
        });
      }

      return document.dispatchEvent(u.a.loaded), o.actions = {
        getFieldTypes: function getFieldTypes(t) {
          return t ? Object(p.y)(j.getRegistered(), e.disableFields) : j.getRegistered();
        },
        clearFields: function clearFields(e) {
          return g.removeAllFields(b.stage, e);
        },
        showData: g.showData.bind(g),
        save: function save(e) {
          var t = g.save(e),
              r = window.JSON.parse(t);
          return m.a.opts.onSave(r), r;
        },
        addField: function addField(e, t) {
          g.stopIndex = c.formData.length ? t : void 0, L(e);
        },
        removeField: g.removeField.bind(g),
        getData: g.getFormData.bind(g),
        setData: function setData(e) {
          g.stopIndex = void 0, g.removeAllFields(b.stage, !1), D(e);
        },
        setLang: function setLang(e) {
          d.a.setCurrent.call(d.a, e).then(function () {
            b.stage.dataset.content = d.a.get("getStarted"), j.init(), b.empty(b.formActions), g.formActionButtons().forEach(function (e) {
              return b.formActions.appendChild(e);
            });
          });
        },
        showDialog: g.dialog.bind(g),
        toggleFieldEdit: function toggleFieldEdit(e) {
          (Array.isArray(e) ? e : [e]).forEach(function (e) {
            ["number", "string"].includes(_typeof(e)) && ("number" == typeof e ? e = b.stage.children[e].id : /^frmb-/.test(e) || (e = b.stage.querySelector(e).id), g.toggleEdit(e));
          });
        },
        toggleAllFieldEdit: function toggleAllFieldEdit() {
          Object(p.i)(b.stage.children, function (e) {
            g.toggleEdit(b.stage.children[e].id);
          });
        },
        closeAllFieldEdit: g.closeAllEdit.bind(g),
        getCurrentFieldId: function getCurrentFieldId() {
          return c.lastID;
        }
      }, b.onRender(b.controls, function () {
        var t = setTimeout(function () {
          b.stage.style.minHeight = b.controls.clientHeight + "px", e.stickyControls.enable && g.stickyControls(q), clearTimeout(t);
        }, 0);
      }), o;
    },
        q = {
      init: function init(e, t) {
        var r = jQuery.extend({}, m.c, e, !0),
            o = r.i18n,
            n = x(r, ["i18n"]);
        m.a.opts = n;
        var i = jQuery.extend({}, m.b, o, !0);
        return q.instance = {
          actions: {
            getFieldTypes: null,
            addField: null,
            clearFields: null,
            closeAllFieldEdit: null,
            getData: null,
            removeField: null,
            save: null,
            setData: null,
            setLang: null,
            showData: null,
            showDialog: null,
            toggleAllFieldEdit: null,
            toggleFieldEdit: null,
            getCurrentFieldId: null
          },
          markup: p.q,

          get formData() {
            return q.instance.actions.getData && q.instance.actions.getData("json");
          },

          promise: new Promise(function (e, r) {
            d.a.init(i).then(function () {
              t.each(function (e) {
                var r = new k(n, t[e], jQuery);
                jQuery(t[e]).data("formBuilder", r), Object.assign(q, r.actions, {
                  markup: p.q
                }), q.instance.actions = r.actions;
              }), delete q.instance.promise, e(q.instance);
            })["catch"](function (e) {
              r(e), n.notify.error(e);
            });
          })
        }, q.instance;
      }
    };

    jQuery.fn.formBuilder = function () {
      var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

      if (!("string" == typeof e)) {
        var _t30 = q.init(e, this);

        return Object.assign(q, _t30), _t30;
      }

      for (var _len2 = arguments.length, t = new Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {
        t[_key2 - 1] = arguments[_key2];
      }

      if (q[e]) return "function" == typeof q[e] ? q[e].apply(this, t) : q[e];
    };
  }]);
}(jQuery);

/***/ }),

/***/ "./resources/js/form_builder/formRender.js":
/*!*************************************************!*\
  !*** ./resources/js/form_builder/formRender.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _get(target, property, receiver) { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get; } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(receiver); } return desc.value; }; } return _get(target, property, receiver || target); }

function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = _getPrototypeOf(object); if (object === null) break; } return object; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e21) { throw _e21; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e22) { didErr = true; err = _e22; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*!
 * jQuery formRender: https://formbuilder.online/
 * Version: 3.7.2
 * Author: Kevin Chappell <kevin.b.chappell@gmail.com>
 */
!function (e) {
  "use strict";

  !function (e) {
    var t = {};

    function n(r) {
      if (t[r]) return t[r].exports;
      var o = t[r] = {
        i: r,
        l: !1,
        exports: {}
      };
      return e[r].call(o.exports, o, o.exports, n), o.l = !0, o.exports;
    }

    n.m = e, n.c = t, n.d = function (e, t, r) {
      n.o(e, t) || Object.defineProperty(e, t, {
        enumerable: !0,
        get: r
      });
    }, n.r = function (e) {
      "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
        value: "Module"
      }), Object.defineProperty(e, "__esModule", {
        value: !0
      });
    }, n.t = function (e, t) {
      if (1 & t && (e = n(e)), 8 & t) return e;
      if (4 & t && "object" == _typeof(e) && e && e.__esModule) return e;
      var r = Object.create(null);
      if (n.r(r), Object.defineProperty(r, "default", {
        enumerable: !0,
        value: e
      }), 2 & t && "string" != typeof e) for (var o in e) {
        n.d(r, o, function (t) {
          return e[t];
        }.bind(null, o));
      }
      return r;
    }, n.n = function (e) {
      var t = e && e.__esModule ? function () {
        return e["default"];
      } : function () {
        return e;
      };
      return n.d(t, "a", t), t;
    }, n.o = function (e, t) {
      return Object.prototype.hasOwnProperty.call(e, t);
    }, n.p = "", n(n.s = 30);
  }([function (t, n, r) {
    function o(e, t) {
      var n = Object.keys(e);

      if (Object.getOwnPropertySymbols) {
        var r = Object.getOwnPropertySymbols(e);
        t && (r = r.filter(function (t) {
          return Object.getOwnPropertyDescriptor(e, t).enumerable;
        })), n.push.apply(n, r);
      }

      return n;
    }

    function i(e) {
      for (var t = 1; t < arguments.length; t++) {
        var n = null != arguments[t] ? arguments[t] : {};
        t % 2 ? o(Object(n), !0).forEach(function (t) {
          s(e, t, n[t]);
        }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n)) : o(Object(n)).forEach(function (t) {
          Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(n, t));
        });
      }

      return e;
    }

    function s(e, t, n) {
      return t in e ? Object.defineProperty(e, t, {
        value: n,
        enumerable: !0,
        configurable: !0,
        writable: !0
      }) : e[t] = n, e;
    }

    function a(e, t) {
      if (null == e) return {};

      var n,
          r,
          o = function (e, t) {
        if (null == e) return {};
        var n,
            r,
            o = {},
            i = Object.keys(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || (o[n] = e[n]);
        }

        return o;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]);
        }
      }

      return o;
    }

    r.d(n, "A", function () {
      return l;
    }), r.d(n, "C", function () {
      return u;
    }), r.d(n, "b", function () {
      return d;
    }), r.d(n, "h", function () {
      return f;
    }), r.d(n, "n", function () {
      return m;
    }), r.d(n, "c", function () {
      return g;
    }), r.d(n, "s", function () {
      return b;
    }), r.d(n, "k", function () {
      return y;
    }), r.d(n, "q", function () {
      return v;
    }), r.d(n, "t", function () {
      return q;
    }), r.d(n, "u", function () {
      return j;
    }), r.d(n, "g", function () {
      return k;
    }), r.d(n, "i", function () {
      return S;
    }), r.d(n, "B", function () {
      return E;
    }), r.d(n, "v", function () {
      return A;
    }), r.d(n, "l", function () {
      return T;
    }), r.d(n, "p", function () {
      return R;
    }), r.d(n, "m", function () {
      return L;
    }), r.d(n, "d", function () {
      return D;
    }), r.d(n, "a", function () {
      return N;
    }), r.d(n, "e", function () {
      return F;
    }), r.d(n, "r", function () {
      return M;
    }), r.d(n, "x", function () {
      return B;
    }), r.d(n, "j", function () {
      return U;
    }), r.d(n, "y", function () {
      return z;
    }), r.d(n, "o", function () {
      return I;
    }), r.d(n, "w", function () {
      return H;
    }), r.d(n, "z", function () {
      return $;
    }), window.fbLoaded = {
      js: [],
      css: []
    }, window.fbEditors = {
      quill: {},
      tinymce: {}
    };

    var l = function l(e) {
      var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : !1;
      var n = [null, void 0, ""];
      t && n.push(!1);

      for (var _t in e) {
        n.includes(e[_t]) ? delete e[_t] : Array.isArray(e[_t]) && (e[_t].length || delete e[_t]);
      }

      return e;
    },
        c = function c(e) {
      return !["values", "enableOther", "other", "label", "subtype"].includes(e);
    },
        u = function u(e) {
      return Object.entries(e).map(function (_ref) {
        var _ref2 = _slicedToArray(_ref, 2),
            e = _ref2[0],
            t = _ref2[1];

        return "".concat(m(e), "=\"").concat(t, "\"");
      }).join(" ");
    },
        d = function d(e) {
      return Object.entries(e).map(function (_ref3) {
        var _ref4 = _slicedToArray(_ref3, 2),
            e = _ref4[0],
            t = _ref4[1];

        return c(e) && Object.values(p(e, t)).join("");
      }).filter(Boolean).join(" ");
    },
        p = function p(e, t) {
      var n;
      return e = h(e), t && (Array.isArray(t) ? n = C(t.join(" ")) : ("boolean" == typeof t && (t = t.toString()), n = C(t.trim()))), {
        name: e,
        value: t = t ? "=\"".concat(n, "\"") : ""
      };
    },
        f = function f(e) {
      return e.reduce(function (e, t) {
        return e.concat(Array.isArray(t) ? f(t) : t);
      }, []);
    },
        h = function h(e) {
      return {
        className: "class"
      }[e] || m(e);
    },
        m = function m(e) {
      return (e = (e = e.replace(/[^\w\s\-]/gi, "")).replace(/([A-Z])/g, function (e) {
        return "-" + e.toLowerCase();
      })).replace(/\s/g, "-").replace(/^-+/g, "");
    },
        g = function g(e) {
      return e.replace(/-([a-z])/g, function (e, t) {
        return t.toUpperCase();
      });
    },
        b = function () {
      var e,
          t = 0;
      return function (n) {
        var r = new Date().getTime();
        r === e ? ++t : (t = 0, e = r);
        return (n.type || m(n.label)) + "-" + r + "-" + t;
      };
    }(),
        y = function y(e) {
      return void 0 === e ? e : [["array", function (e) {
        return Array.isArray(e);
      }], ["node", function (e) {
        return e instanceof window.Node || e instanceof window.HTMLElement;
      }], ["component", function () {
        return e && e.dom;
      }], [_typeof(e), function () {
        return !0;
      }]].find(function (t) {
        return t[1](e);
      })[0];
    },
        v = function v(e) {
      var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "";
      var n = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
      var r = y(t);
      var o = n.events,
          i = a(n, ["events"]),
          s = document.createElement(e),
          l = {
        string: function string(e) {
          s.innerHTML += e;
        },
        object: function object(e) {
          var t = e.tag,
              n = e.content,
              r = a(e, ["tag", "content"]);
          return s.appendChild(v(t, n, r));
        },
        node: function node(e) {
          return s.appendChild(e);
        },
        array: function array(e) {
          for (var _t2 = 0; _t2 < e.length; _t2++) {
            r = y(e[_t2]), l[r](e[_t2]);
          }
        },
        "function": function _function(e) {
          e = e(), r = y(e), l[r](e);
        },
        undefined: function undefined() {}
      };

      for (var _e2 in i) {
        if (i.hasOwnProperty(_e2)) {
          var _t3 = h(_e2),
              _n2 = Array.isArray(i[_e2]) ? E(i[_e2].join(" ").split(" ")).join(" ") : i[_e2];

          s.setAttribute(_t3, _n2);
        }
      }

      return t && l[r](t), function (e, t) {
        if (t) {
          var _loop = function _loop(_n3) {
            t.hasOwnProperty(_n3) && e.addEventListener(_n3, function (e) {
              return t[_n3](e);
            });
          };

          for (var _n3 in t) {
            _loop(_n3);
          }
        }
      }(s, o), s;
    },
        x = function x(e) {
      var t = e.attributes,
          n = {};
      return S(t, function (e) {
        var r = t[e].value || "";
        r.match(/false|true/g) ? r = "true" === r : r.match(/undefined/g) && (r = void 0), r && (n[g(t[e].name)] = r);
      }), n;
    },
        w = function w(e) {
      var t = [];

      for (var _n4 = 0; _n4 < e.length; _n4++) {
        var _r = i(i({}, x(e[_n4])), {}, {
          label: e[_n4].textContent
        });

        t.push(_r);
      }

      return t;
    },
        O = function O(e) {
      var t = [];

      if (e.length) {
        var _n5 = e[0].getElementsByTagName("value");

        for (var _e3 = 0; _e3 < _n5.length; _e3++) {
          t.push(_n5[_e3].textContent);
        }
      }

      return t;
    },
        q = function q(e) {
      var t = new window.DOMParser().parseFromString(e, "text/xml"),
          n = [];

      if (t) {
        var _e4 = t.getElementsByTagName("field");

        for (var _t4 = 0; _t4 < _e4.length; _t4++) {
          var _r2 = x(_e4[_t4]),
              _o = _e4[_t4].getElementsByTagName("option"),
              _i2 = _e4[_t4].getElementsByTagName("userData");

          _o && _o.length && (_r2.values = w(_o)), _i2 && _i2.length && (_r2.userData = O(_i2)), n.push(_r2);
        }
      }

      return n;
    },
        j = function j(e) {
      var t = document.createElement("textarea");
      return t.innerHTML = e, t.textContent;
    },
        k = function k(e) {
      var t = document.createElement("textarea");
      return t.textContent = e, t.innerHTML;
    },
        C = function C(e) {
      var t = {
        '"': "&quot;",
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;"
      };
      return "string" == typeof e ? e.replace(/["&<>]/g, function (e) {
        return t[e] || e;
      }) : e;
    },
        S = function S(e, t, n) {
      for (var _r3 = 0; _r3 < e.length; _r3++) {
        t.call(n, _r3, e[_r3]);
      }
    },
        E = function E(e) {
      return e.filter(function (e, t, n) {
        return n.indexOf(e) === t;
      });
    },
        A = function A(e, t) {
      var n = t.indexOf(e);
      n > -1 && t.splice(n, 1);
    },
        T = function T(e, t) {
      var _jQuery;

      var n = jQuery;
      var r = [];
      return Array.isArray(e) || (e = [e]), R(e) || (r = jQuery.map(e, function (e) {
        var n = {
          dataType: "script",
          cache: !0,
          url: (t || "") + e
        };
        return jQuery.ajax(n).done(function () {
          return window.fbLoaded.js.push(e);
        });
      })), r.push(jQuery.Deferred(function (e) {
        return n(e.resolve);
      })), (_jQuery = jQuery).when.apply(_jQuery, _toConsumableArray(r));
    },
        R = function R(e) {
      var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "js";
      var n = !1;
      var r = window.fbLoaded[t];
      return n = Array.isArray(e) ? e.every(function (e) {
        return r.includes(e);
      }) : r.includes(e), n;
    },
        L = function L(t, n) {
      Array.isArray(t) || (t = [t]), t.forEach(function (t) {
        var r = "href",
            o = t,
            i = "";

        if ("object" == _typeof(t) && (r = t.type || (t.style ? "inline" : "href"), i = t.id, t = "inline" == r ? t.style : t.href, o = i || t.href || t.style), !R(o, "css")) {
          if ("href" == r) {
            var _e5 = document.createElement("link");

            _e5.type = "text/css", _e5.rel = "stylesheet", _e5.href = (n || "") + t, document.head.appendChild(_e5);
          } else e("<style type=\"text/css\">".concat(t, "</style>")).attr("id", i).appendTo(e(document.head));

          window.fbLoaded.css.push(o);
        }
      });
    },
        D = function D(e) {
      return e.replace(/\b\w/g, function (e) {
        return e.toUpperCase();
      });
    },
        P = function P(e, t) {
      var n = Object.assign({}, e, t);

      for (var _r4 in t) {
        n.hasOwnProperty(_r4) && (Array.isArray(t[_r4]) ? n[_r4] = Array.isArray(e[_r4]) ? E(e[_r4].concat(t[_r4])) : t[_r4] : "object" == _typeof(t[_r4]) ? n[_r4] = P(e[_r4], t[_r4]) : n[_r4] = t[_r4]);
      }

      return n;
    },
        N = function N(e, t, n) {
      return t.split(" ").forEach(function (t) {
        return e.addEventListener(t, n, !1);
      });
    },
        F = function F(e, t) {
      var n = t.replace(".", "");

      for (; (e = e.parentElement) && !e.classList.contains(n);) {
        ;
      }

      return e;
    },
        M = function M() {
      var e = "";
      var t;
      return t = navigator.userAgent || navigator.vendor || window.opera, /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(t) && (e = "formbuilder-mobile"), e;
    },
        B = function B(e) {
      return e.replace(/\s/g, "-").replace(/[^a-zA-Z0-9[\]_-]/g, "");
    },
        U = function U(e) {
      return e.replace(/[^0-9]/g, "");
    },
        z = function z(e, t) {
      return t.filter(function (e) {
        return !~this.indexOf(e);
      }, e);
    },
        I = function I(e) {
      var t = (e = Array.isArray(e) ? e : [e]).map(function (_ref5) {
        var e = _ref5.src,
            t = _ref5.id;
        return new Promise(function (n) {
          if (window.fbLoaded.css.includes(e)) return n(e);
          var r = v("link", null, {
            href: e,
            rel: "stylesheet",
            id: t
          });
          document.head.insertBefore(r, document.head.firstChild);
        });
      });
      return Promise.all(t);
    },
        H = function H(e) {
      var t = document.getElementById(e);
      return t.parentElement.removeChild(t);
    };

    function $(e) {
      var t = ["a", "an", "and", "as", "at", "but", "by", "for", "for", "from", "in", "into", "near", "nor", "of", "on", "onto", "or", "the", "to", "with"].map(function (e) {
        return "\\s".concat(e, "\\s");
      }),
          n = new RegExp("(?!".concat(t.join("|"), ")\\w\\S*"), "g");
      return ("" + e).replace(n, function (e) {
        return e.charAt(0).toUpperCase() + e.substr(1).replace(/[A-Z]/g, function (e) {
          return " " + e;
        });
      });
    }

    var _ = {
      addEventListeners: N,
      attrString: d,
      camelCase: g,
      capitalize: D,
      closest: F,
      getContentType: y,
      escapeAttr: C,
      escapeAttrs: function escapeAttrs(e) {
        for (var _t5 in e) {
          e.hasOwnProperty(_t5) && (e[_t5] = C(e[_t5]));
        }

        return e;
      },
      escapeHtml: k,
      forceNumber: U,
      forEach: S,
      getScripts: T,
      getStyles: L,
      hyphenCase: m,
      isCached: R,
      markup: v,
      merge: P,
      mobileClass: M,
      nameAttr: b,
      parseAttrs: x,
      parsedHtml: j,
      parseOptions: w,
      parseUserData: O,
      parseXML: q,
      removeFromArray: A,
      safeAttr: p,
      safeAttrName: h,
      safename: B,
      subtract: z,
      trimObj: l,
      unique: E,
      validAttr: c,
      titleCase: $,
      splitObject: function splitObject(e, t) {
        var n = function n(e) {
          return function (t, n) {
            return t[n] = e[n], t;
          };
        };

        return [Object.keys(e).filter(function (e) {
          return t.includes(e);
        }).reduce(n(e), {}), Object.keys(e).filter(function (e) {
          return !t.includes(e);
        }).reduce(n(e), {})];
      }
    };
    n.f = _;
  }, function (e, t, n) {
    n.d(t, "a", function () {
      return a;
    });
    var r = n(0),
        o = n(2),
        i = n.n(o);

    function s(e, t) {
      if (null == e) return {};

      var n,
          r,
          o = function (e, t) {
        if (null == e) return {};
        var n,
            r,
            o = {},
            i = Object.keys(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || (o[n] = e[n]);
        }

        return o;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]);
        }
      }

      return o;
    }

    var a = /*#__PURE__*/function () {
      function a(e, t) {
        _classCallCheck(this, a);

        this.rawConfig = jQuery.extend({}, e), e = jQuery.extend({}, e), this.preview = t, delete e.isPreview, this.preview && delete e.required;
        var n = ["label", "description", "subtype", "required", "disabled"];

        for (var _i3 = 0, _n6 = n; _i3 < _n6.length; _i3++) {
          var _t6 = _n6[_i3];
          this[_t6] = e[_t6], delete e[_t6];
        }

        e.id || (e.name ? e.id = e.name : e.id = "control-" + Math.floor(1e7 * Math.random() + 1)), this.id = e.id, this.type = e.type, this.description && (e.title = this.description), a.controlConfig || (a.controlConfig = {});
        var r = this.subtype ? this.type + "." + this.subtype : this.type;
        this.classConfig = jQuery.extend({}, a.controlConfig[r] || {}), this.subtype && (e.type = this.subtype), this.required && (e.required = "required", e["aria-required"] = "true"), this.disabled && (e.disabled = "disabled"), this.config = e, this.configure();
      }

      _createClass(a, [{
        key: "configure",
        value: function configure() {}
      }, {
        key: "build",
        value: function build() {
          var e = this.config,
              t = e.label,
              n = e.type,
              o = s(e, ["label", "type"]);
          return this.markup(n, Object(r.u)(t), o);
        }
      }, {
        key: "on",
        value: function on(e) {
          var _this = this;

          var t = {
            prerender: function prerender(e) {
              return e;
            },
            render: function render(e) {
              var t = function t() {
                _this.onRender && _this.onRender(e);
              };

              _this.css && Object(r.m)(_this.css), _this.js && !Object(r.p)(_this.js) ? Object(r.l)(_this.js).done(t) : t();
            }
          };
          return e ? t[e] : t;
        }
      }, {
        key: "markup",
        value: function markup(e) {
          var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "";
          var n = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
          return this.element = Object(r.q)(e, t, n), this.element;
        }
      }, {
        key: "parsedHtml",
        value: function parsedHtml(e) {
          return Object(r.u)(e);
        }
      }], [{
        key: "definition",
        get: function get() {
          return {};
        }
      }, {
        key: "register",
        value: function register(e, t, n) {
          var r = n ? n + "." : "";
          a.classRegister || (a.classRegister = {}), Array.isArray(e) || (e = [e]);

          var _iterator = _createForOfIteratorHelper(e),
              _step;

          try {
            for (_iterator.s(); !(_step = _iterator.n()).done;) {
              var _n7 = _step.value;
              -1 === _n7.indexOf(".") ? a.classRegister[r + _n7] = t : a.error("Ignoring type ".concat(_n7, ". Cannot use the character '.' in a type name."));
            }
          } catch (err) {
            _iterator.e(err);
          } finally {
            _iterator.f();
          }
        }
      }, {
        key: "getRegistered",
        value: function getRegistered() {
          var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : !1;
          var t = Object.keys(a.classRegister);
          return t.length ? t.filter(function (t) {
            return e ? t.indexOf(e + ".") > -1 : -1 == t.indexOf(".");
          }) : t;
        }
      }, {
        key: "getRegisteredSubtypes",
        value: function getRegisteredSubtypes() {
          var e = {};

          for (var _t7 in a.classRegister) {
            if (a.classRegister.hasOwnProperty(_t7)) {
              var _t7$split = _t7.split("."),
                  _t7$split2 = _slicedToArray(_t7$split, 2),
                  _n8 = _t7$split2[0],
                  _r5 = _t7$split2[1];

              if (!_r5) continue;
              e[_n8] || (e[_n8] = []), e[_n8].push(_r5);
            }
          }

          return e;
        }
      }, {
        key: "getClass",
        value: function getClass(e, t) {
          var n = t ? e + "." + t : e,
              r = a.classRegister[n] || a.classRegister[e];
          return r || a.error("Invalid control type. (Type: " + e + ", Subtype: " + t + "). Please ensure you have registered it, and imported it correctly.");
        }
      }, {
        key: "loadCustom",
        value: function loadCustom(e) {
          var t = [];

          if (e && (t = t.concat(e)), window.fbControls && (t = t.concat(window.fbControls)), !this.fbControlsLoaded) {
            var _iterator2 = _createForOfIteratorHelper(t),
                _step2;

            try {
              for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
                var _e6 = _step2.value;

                _e6(a, a.classRegister);
              }
            } catch (err) {
              _iterator2.e(err);
            } finally {
              _iterator2.f();
            }

            this.fbControlsLoaded = !0;
          }
        }
      }, {
        key: "mi18n",
        value: function mi18n(e, t) {
          var n = this.definition;
          var r = n.i18n || {};
          r = r[i.a.locale] || r["default"] || r;
          var o = this.camelCase(e),
              s = "object" == _typeof(r) ? r[o] || r[e] : r;
          if (s) return s;
          var _a = n.mi18n;
          return "object" == _typeof(_a) && (_a = _a[o] || _a[e]), _a || (_a = o), i.a.get(_a, t);
        }
      }, {
        key: "active",
        value: function active(e) {
          return !Array.isArray(this.definition.inactive) || -1 == this.definition.inactive.indexOf(e);
        }
      }, {
        key: "label",
        value: function label(e) {
          return this.mi18n(e);
        }
      }, {
        key: "icon",
        value: function icon(e) {
          var t = this.definition;
          return t && "object" == _typeof(t.icon) ? t.icon[e] : t.icon;
        }
      }, {
        key: "error",
        value: function error(e) {
          throw new Error(e);
        }
      }, {
        key: "camelCase",
        value: function camelCase(e) {
          return Object(r.c)(e);
        }
      }]);

      return a;
    }();
  }, function (e, t) {
    /*!
     * mi18n - https://github.com/Draggable/mi18n
     * Version: 0.4.7
     * Author: Kevin Chappell <kevin.b.chappell@gmail.com> (http://kevin-chappell.com)
     */
    e.exports = function (e) {
      var t = {};

      function n(r) {
        if (t[r]) return t[r].exports;
        var o = t[r] = {
          i: r,
          l: !1,
          exports: {}
        };
        return e[r].call(o.exports, o, o.exports, n), o.l = !0, o.exports;
      }

      return n.m = e, n.c = t, n.d = function (e, t, r) {
        n.o(e, t) || Object.defineProperty(e, t, {
          enumerable: !0,
          get: r
        });
      }, n.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
          value: "Module"
        }), Object.defineProperty(e, "__esModule", {
          value: !0
        });
      }, n.t = function (e, t) {
        if (1 & t && (e = n(e)), 8 & t) return e;
        if (4 & t && "object" == _typeof(e) && e && e.__esModule) return e;
        var r = Object.create(null);
        if (n.r(r), Object.defineProperty(r, "default", {
          enumerable: !0,
          value: e
        }), 2 & t && "string" != typeof e) for (var o in e) {
          n.d(r, o, function (t) {
            return e[t];
          }.bind(null, o));
        }
        return r;
      }, n.n = function (e) {
        var t = e && e.__esModule ? function () {
          return e["default"];
        } : function () {
          return e;
        };
        return n.d(t, "a", t), t;
      }, n.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t);
      }, n.p = "", n(n.s = 7);
    }([function (e, t, n) {
      var r = "function" == typeof Symbol && "symbol" == _typeof(Symbol.iterator) ? function (e) {
        return _typeof(e);
      } : function (e) {
        return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : _typeof(e);
      },
          o = n(2),
          i = n(10),
          s = Object.prototype.toString;

      function a(e) {
        return "[object Array]" === s.call(e);
      }

      function l(e) {
        return null !== e && "object" === (void 0 === e ? "undefined" : r(e));
      }

      function c(e) {
        return "[object Function]" === s.call(e);
      }

      function u(e, t) {
        if (null != e) if ("object" !== (void 0 === e ? "undefined" : r(e)) && (e = [e]), a(e)) for (var n = 0, o = e.length; n < o; n++) {
          t.call(null, e[n], n, e);
        } else for (var i in e) {
          Object.prototype.hasOwnProperty.call(e, i) && t.call(null, e[i], i, e);
        }
      }

      e.exports = {
        isArray: a,
        isArrayBuffer: function isArrayBuffer(e) {
          return "[object ArrayBuffer]" === s.call(e);
        },
        isBuffer: i,
        isFormData: function isFormData(e) {
          return "undefined" != typeof FormData && e instanceof FormData;
        },
        isArrayBufferView: function isArrayBufferView(e) {
          return "undefined" != typeof ArrayBuffer && ArrayBuffer.isView ? ArrayBuffer.isView(e) : e && e.buffer && e.buffer instanceof ArrayBuffer;
        },
        isString: function isString(e) {
          return "string" == typeof e;
        },
        isNumber: function isNumber(e) {
          return "number" == typeof e;
        },
        isObject: l,
        isUndefined: function isUndefined(e) {
          return void 0 === e;
        },
        isDate: function isDate(e) {
          return "[object Date]" === s.call(e);
        },
        isFile: function isFile(e) {
          return "[object File]" === s.call(e);
        },
        isBlob: function isBlob(e) {
          return "[object Blob]" === s.call(e);
        },
        isFunction: c,
        isStream: function isStream(e) {
          return l(e) && c(e.pipe);
        },
        isURLSearchParams: function isURLSearchParams(e) {
          return "undefined" != typeof URLSearchParams && e instanceof URLSearchParams;
        },
        isStandardBrowserEnv: function isStandardBrowserEnv() {
          return ("undefined" == typeof navigator || "ReactNative" !== navigator.product) && "undefined" != typeof window && "undefined" != typeof document;
        },
        forEach: u,
        merge: function e() {
          var t = {};

          function n(n, o) {
            "object" === r(t[o]) && "object" === (void 0 === n ? "undefined" : r(n)) ? t[o] = e(t[o], n) : t[o] = n;
          }

          for (var o = 0, i = arguments.length; o < i; o++) {
            u(arguments[o], n);
          }

          return t;
        },
        extend: function extend(e, t, n) {
          return u(t, function (t, r) {
            e[r] = n && "function" == typeof t ? o(t, n) : t;
          }), e;
        },
        trim: function trim(e) {
          return e.replace(/^\s*/, "").replace(/\s*$/, "");
        }
      };
    }, function (e, t, n) {
      (function (t) {
        var r = n(0),
            o = n(13),
            i = {
          "Content-Type": "application/x-www-form-urlencoded"
        };

        function s(e, t) {
          !r.isUndefined(e) && r.isUndefined(e["Content-Type"]) && (e["Content-Type"] = t);
        }

        var a = {
          adapter: function () {
            var e;
            return ("undefined" != typeof XMLHttpRequest || void 0 !== t) && (e = n(3)), e;
          }(),
          transformRequest: [function (e, t) {
            return o(t, "Content-Type"), r.isFormData(e) || r.isArrayBuffer(e) || r.isBuffer(e) || r.isStream(e) || r.isFile(e) || r.isBlob(e) ? e : r.isArrayBufferView(e) ? e.buffer : r.isURLSearchParams(e) ? (s(t, "application/x-www-form-urlencoded;charset=utf-8"), e.toString()) : r.isObject(e) ? (s(t, "application/json;charset=utf-8"), JSON.stringify(e)) : e;
          }],
          transformResponse: [function (e) {
            if ("string" == typeof e) try {
              e = JSON.parse(e);
            } catch (e) {}
            return e;
          }],
          timeout: 0,
          xsrfCookieName: "XSRF-TOKEN",
          xsrfHeaderName: "X-XSRF-TOKEN",
          maxContentLength: -1,
          validateStatus: function validateStatus(e) {
            return e >= 200 && e < 300;
          },
          headers: {
            common: {
              Accept: "application/json, text/plain, */*"
            }
          }
        };
        r.forEach(["delete", "get", "head"], function (e) {
          a.headers[e] = {};
        }), r.forEach(["post", "put", "patch"], function (e) {
          a.headers[e] = r.merge(i);
        }), e.exports = a;
      }).call(this, n(12));
    }, function (e, t, n) {
      e.exports = function (e, t) {
        return function () {
          for (var n = new Array(arguments.length), r = 0; r < n.length; r++) {
            n[r] = arguments[r];
          }

          return e.apply(t, n);
        };
      };
    }, function (e, t, n) {
      var r = n(0),
          o = n(14),
          i = n(16),
          s = n(17),
          a = n(18),
          l = n(4),
          c = "undefined" != typeof window && window.btoa && window.btoa.bind(window) || n(19);

      e.exports = function (e) {
        return new Promise(function (t, u) {
          var d = e.data,
              p = e.headers;
          r.isFormData(d) && delete p["Content-Type"];
          var f = new XMLHttpRequest(),
              h = "onreadystatechange",
              m = !1;

          if ("undefined" == typeof window || !window.XDomainRequest || "withCredentials" in f || a(e.url) || (f = new window.XDomainRequest(), h = "onload", m = !0, f.onprogress = function () {}, f.ontimeout = function () {}), e.auth) {
            var g = e.auth.username || "",
                b = e.auth.password || "";
            p.Authorization = "Basic " + c(g + ":" + b);
          }

          if (f.open(e.method.toUpperCase(), i(e.url, e.params, e.paramsSerializer), !0), f.timeout = e.timeout, f[h] = function () {
            if (f && (4 === f.readyState || m) && (0 !== f.status || f.responseURL && 0 === f.responseURL.indexOf("file:"))) {
              var n = "getAllResponseHeaders" in f ? s(f.getAllResponseHeaders()) : null,
                  r = {
                data: e.responseType && "text" !== e.responseType ? f.response : f.responseText,
                status: 1223 === f.status ? 204 : f.status,
                statusText: 1223 === f.status ? "No Content" : f.statusText,
                headers: n,
                config: e,
                request: f
              };
              o(t, u, r), f = null;
            }
          }, f.onerror = function () {
            u(l("Network Error", e, null, f)), f = null;
          }, f.ontimeout = function () {
            u(l("timeout of " + e.timeout + "ms exceeded", e, "ECONNABORTED", f)), f = null;
          }, r.isStandardBrowserEnv()) {
            var y = n(20),
                v = (e.withCredentials || a(e.url)) && e.xsrfCookieName ? y.read(e.xsrfCookieName) : void 0;
            v && (p[e.xsrfHeaderName] = v);
          }

          if ("setRequestHeader" in f && r.forEach(p, function (e, t) {
            void 0 === d && "content-type" === t.toLowerCase() ? delete p[t] : f.setRequestHeader(t, e);
          }), e.withCredentials && (f.withCredentials = !0), e.responseType) try {
            f.responseType = e.responseType;
          } catch (t) {
            if ("json" !== e.responseType) throw t;
          }
          "function" == typeof e.onDownloadProgress && f.addEventListener("progress", e.onDownloadProgress), "function" == typeof e.onUploadProgress && f.upload && f.upload.addEventListener("progress", e.onUploadProgress), e.cancelToken && e.cancelToken.promise.then(function (e) {
            f && (f.abort(), u(e), f = null);
          }), void 0 === d && (d = null), f.send(d);
        });
      };
    }, function (e, t, n) {
      var r = n(15);

      e.exports = function (e, t, n, o, i) {
        var s = new Error(e);
        return r(s, t, n, o, i);
      };
    }, function (e, t, n) {
      e.exports = function (e) {
        return !(!e || !e.__CANCEL__);
      };
    }, function (e, t, n) {
      function r(e) {
        this.message = e;
      }

      r.prototype.toString = function () {
        return "Cancel" + (this.message ? ": " + this.message : "");
      }, r.prototype.__CANCEL__ = !0, e.exports = r;
    }, function (e, t, n) {
      t.__esModule = !0, t.I18N = void 0;

      var r = "function" == typeof Symbol && "symbol" == _typeof(Symbol.iterator) ? function (e) {
        return _typeof(e);
      } : function (e) {
        return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : _typeof(e);
      },
          o = function () {
        function e(e, t) {
          for (var n = 0; n < t.length; n++) {
            var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r);
          }
        }

        return function (t, n, r) {
          return n && e(t.prototype, n), r && e(t, r), t;
        };
      }(),
          i = n(8),
          s = {
        extension: ".lang",
        location: "assets/lang/",
        langs: ["en-US"],
        locale: "en-US",
        override: {}
      },
          a = t.I18N = function () {
        function e() {
          var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : s;
          !function (e, t) {
            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function");
          }(this, e), this.langs = Object.create(null), this.loaded = [], this.processConfig(t);
        }

        return e.prototype.processConfig = function (e) {
          var t = this,
              n = Object.assign({}, s, e),
              r = n.location,
              o = function (e, t) {
            var n = {};

            for (var r in e) {
              t.indexOf(r) >= 0 || Object.prototype.hasOwnProperty.call(e, r) && (n[r] = e[r]);
            }

            return n;
          }(n, ["location"]),
              i = r.replace(/\/?$/, "/");

          this.config = Object.assign({}, {
            location: i
          }, o);
          var a = this.config,
              l = a.override,
              c = a.preloaded,
              u = void 0 === c ? {} : c,
              d = Object.entries(this.langs).concat(Object.entries(l || u));
          this.langs = d.reduce(function (e, n) {
            var r = n[0],
                o = n[1];
            return e[r] = t.applyLanguage.call(t, r, o), e;
          }, {}), this.locale = this.config.locale || this.config.langs[0];
        }, e.prototype.init = function (e) {
          return this.processConfig.call(this, Object.assign({}, this.config, e)), this.setCurrent(this.locale);
        }, e.prototype.addLanguage = function (e) {
          var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
          t = "string" == typeof t ? this.processFile.call(this, t) : t, this.applyLanguage.call(this, e, t), this.config.langs.push("locale");
        }, e.prototype.getValue = function (e) {
          var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.locale;
          return this.langs[t] && this.langs[t][e] || this.getFallbackValue(e);
        }, e.prototype.getFallbackValue = function (e) {
          var t = Object.values(this.langs).find(function (t) {
            return t[e];
          });
          return t && t[e];
        }, e.prototype.makeSafe = function (e) {
          var t = {
            "{": "\\{",
            "}": "\\}",
            "|": "\\|"
          };
          return e = e.replace(/\{|\}|\|/g, function (e) {
            return t[e];
          }), new RegExp(e, "g");
        }, e.prototype.put = function (e, t) {
          return this.current[e] = t;
        }, e.prototype.get = function (e, t) {
          var n = this.getValue(e);

          if (n) {
            var o = n.match(/\{[^}]+?\}/g),
                i = void 0;
            if (t && o) if ("object" === (void 0 === t ? "undefined" : r(t))) for (var s = 0; s < o.length; s++) {
              i = o[s].substring(1, o[s].length - 1), n = n.replace(this.makeSafe(o[s]), t[i] || "");
            } else n = n.replace(/\{[^}]+?\}/g, t);
            return n;
          }
        }, e.prototype.fromFile = function (e) {
          for (var t, n = e.split("\n"), r = {}, o = 0; o < n.length; o++) {
            (t = n[o].match(/^(.+?) *?= *?([^\n]+)/)) && (r[t[1]] = t[2].replace(/^\s+|\s+$/, ""));
          }

          return r;
        }, e.prototype.processFile = function (e) {
          return this.fromFile(e.replace(/\n\n/g, "\n"));
        }, e.prototype.loadLang = function (e) {
          var t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1],
              n = this;
          return new Promise(function (r, o) {
            if (-1 !== n.loaded.indexOf(e) && t) return n.applyLanguage.call(n, n.langs[e]), r(n.langs[e]);
            var s = [n.config.location, e, n.config.extension].join("");
            return (0, i.get)(s).then(function (t) {
              var o = t.data,
                  i = n.processFile(o);
              return n.applyLanguage.call(n, e, i), n.loaded.push(e), r(n.langs[e]);
            })["catch"](function () {
              var t = n.applyLanguage.call(n, e);
              r(t);
            });
          });
        }, e.prototype.applyLanguage = function (e) {
          var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
              n = this.config.override[e] || {},
              r = this.langs[e] || {};
          return this.langs[e] = Object.assign({}, r, t, n), this.langs[e];
        }, e.prototype.setCurrent = function () {
          var e = this,
              t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "en-US";
          return this.loadLang(t).then(function () {
            return e.locale = t, e.current = e.langs[t], e.current;
          });
        }, o(e, [{
          key: "getLangs",
          get: function get() {
            return this.config.langs;
          }
        }]), e;
      }();

      t["default"] = new a();
    }, function (e, t, n) {
      e.exports = n(9);
    }, function (e, t, n) {
      var r = n(0),
          o = n(2),
          i = n(11),
          s = n(1);

      function a(e) {
        var t = new i(e),
            n = o(i.prototype.request, t);
        return r.extend(n, i.prototype, t), r.extend(n, t), n;
      }

      var l = a(s);
      l.Axios = i, l.create = function (e) {
        return a(r.merge(s, e));
      }, l.Cancel = n(6), l.CancelToken = n(26), l.isCancel = n(5), l.all = function (e) {
        return Promise.all(e);
      }, l.spread = n(27), e.exports = l, e.exports["default"] = l;
    }, function (e, t, n) {
      /*!
       * Determine if an object is a Buffer
       *
       * @author   Feross Aboukhadijeh <https://feross.org>
       * @license  MIT
       */
      function r(e) {
        return !!e.constructor && "function" == typeof e.constructor.isBuffer && e.constructor.isBuffer(e);
      }

      e.exports = function (e) {
        return null != e && (r(e) || function (e) {
          return "function" == typeof e.readFloatLE && "function" == typeof e.slice && r(e.slice(0, 0));
        }(e) || !!e._isBuffer);
      };
    }, function (e, t, n) {
      var r = n(1),
          o = n(0),
          i = n(21),
          s = n(22);

      function a(e) {
        this.defaults = e, this.interceptors = {
          request: new i(),
          response: new i()
        };
      }

      a.prototype.request = function (e) {
        "string" == typeof e && (e = o.merge({
          url: arguments[0]
        }, arguments[1])), (e = o.merge(r, {
          method: "get"
        }, this.defaults, e)).method = e.method.toLowerCase();
        var t = [s, void 0],
            n = Promise.resolve(e);

        for (this.interceptors.request.forEach(function (e) {
          t.unshift(e.fulfilled, e.rejected);
        }), this.interceptors.response.forEach(function (e) {
          t.push(e.fulfilled, e.rejected);
        }); t.length;) {
          n = n.then(t.shift(), t.shift());
        }

        return n;
      }, o.forEach(["delete", "get", "head", "options"], function (e) {
        a.prototype[e] = function (t, n) {
          return this.request(o.merge(n || {}, {
            method: e,
            url: t
          }));
        };
      }), o.forEach(["post", "put", "patch"], function (e) {
        a.prototype[e] = function (t, n, r) {
          return this.request(o.merge(r || {}, {
            method: e,
            url: t,
            data: n
          }));
        };
      }), e.exports = a;
    }, function (e, t, n) {
      var r,
          o,
          i = e.exports = {};

      function s() {
        throw new Error("setTimeout has not been defined");
      }

      function a() {
        throw new Error("clearTimeout has not been defined");
      }

      function l(e) {
        if (r === setTimeout) return setTimeout(e, 0);
        if ((r === s || !r) && setTimeout) return r = setTimeout, setTimeout(e, 0);

        try {
          return r(e, 0);
        } catch (t) {
          try {
            return r.call(null, e, 0);
          } catch (t) {
            return r.call(this, e, 0);
          }
        }
      }

      !function () {
        try {
          r = "function" == typeof setTimeout ? setTimeout : s;
        } catch (e) {
          r = s;
        }

        try {
          o = "function" == typeof clearTimeout ? clearTimeout : a;
        } catch (e) {
          o = a;
        }
      }();
      var c,
          u = [],
          d = !1,
          p = -1;

      function f() {
        d && c && (d = !1, c.length ? u = c.concat(u) : p = -1, u.length && h());
      }

      function h() {
        if (!d) {
          var e = l(f);
          d = !0;

          for (var t = u.length; t;) {
            for (c = u, u = []; ++p < t;) {
              c && c[p].run();
            }

            p = -1, t = u.length;
          }

          c = null, d = !1, function (e) {
            if (o === clearTimeout) return clearTimeout(e);
            if ((o === a || !o) && clearTimeout) return o = clearTimeout, clearTimeout(e);

            try {
              o(e);
            } catch (t) {
              try {
                return o.call(null, e);
              } catch (t) {
                return o.call(this, e);
              }
            }
          }(e);
        }
      }

      function m(e, t) {
        this.fun = e, this.array = t;
      }

      function g() {}

      i.nextTick = function (e) {
        var t = new Array(arguments.length - 1);
        if (arguments.length > 1) for (var n = 1; n < arguments.length; n++) {
          t[n - 1] = arguments[n];
        }
        u.push(new m(e, t)), 1 !== u.length || d || l(h);
      }, m.prototype.run = function () {
        this.fun.apply(null, this.array);
      }, i.title = "browser", i.browser = !0, i.env = {}, i.argv = [], i.version = "", i.versions = {}, i.on = g, i.addListener = g, i.once = g, i.off = g, i.removeListener = g, i.removeAllListeners = g, i.emit = g, i.prependListener = g, i.prependOnceListener = g, i.listeners = function (e) {
        return [];
      }, i.binding = function (e) {
        throw new Error("process.binding is not supported");
      }, i.cwd = function () {
        return "/";
      }, i.chdir = function (e) {
        throw new Error("process.chdir is not supported");
      }, i.umask = function () {
        return 0;
      };
    }, function (e, t, n) {
      var r = n(0);

      e.exports = function (e, t) {
        r.forEach(e, function (n, r) {
          r !== t && r.toUpperCase() === t.toUpperCase() && (e[t] = n, delete e[r]);
        });
      };
    }, function (e, t, n) {
      var r = n(4);

      e.exports = function (e, t, n) {
        var o = n.config.validateStatus;
        n.status && o && !o(n.status) ? t(r("Request failed with status code " + n.status, n.config, null, n.request, n)) : e(n);
      };
    }, function (e, t, n) {
      e.exports = function (e, t, n, r, o) {
        return e.config = t, n && (e.code = n), e.request = r, e.response = o, e;
      };
    }, function (e, t, n) {
      var r = n(0);

      function o(e) {
        return encodeURIComponent(e).replace(/%40/gi, "@").replace(/%3A/gi, ":").replace(/%24/g, "$").replace(/%2C/gi, ",").replace(/%20/g, "+").replace(/%5B/gi, "[").replace(/%5D/gi, "]");
      }

      e.exports = function (e, t, n) {
        if (!t) return e;
        var i;
        if (n) i = n(t);else if (r.isURLSearchParams(t)) i = t.toString();else {
          var s = [];
          r.forEach(t, function (e, t) {
            null != e && (r.isArray(e) ? t += "[]" : e = [e], r.forEach(e, function (e) {
              r.isDate(e) ? e = e.toISOString() : r.isObject(e) && (e = JSON.stringify(e)), s.push(o(t) + "=" + o(e));
            }));
          }), i = s.join("&");
        }
        return i && (e += (-1 === e.indexOf("?") ? "?" : "&") + i), e;
      };
    }, function (e, t, n) {
      var r = n(0),
          o = ["age", "authorization", "content-length", "content-type", "etag", "expires", "from", "host", "if-modified-since", "if-unmodified-since", "last-modified", "location", "max-forwards", "proxy-authorization", "referer", "retry-after", "user-agent"];

      e.exports = function (e) {
        var t,
            n,
            i,
            s = {};
        return e ? (r.forEach(e.split("\n"), function (e) {
          if (i = e.indexOf(":"), t = r.trim(e.substr(0, i)).toLowerCase(), n = r.trim(e.substr(i + 1)), t) {
            if (s[t] && o.indexOf(t) >= 0) return;
            s[t] = "set-cookie" === t ? (s[t] ? s[t] : []).concat([n]) : s[t] ? s[t] + ", " + n : n;
          }
        }), s) : s;
      };
    }, function (e, t, n) {
      var r = n(0);
      e.exports = r.isStandardBrowserEnv() ? function () {
        var e,
            t = /(msie|trident)/i.test(navigator.userAgent),
            n = document.createElement("a");

        function o(e) {
          var r = e;
          return t && (n.setAttribute("href", r), r = n.href), n.setAttribute("href", r), {
            href: n.href,
            protocol: n.protocol ? n.protocol.replace(/:$/, "") : "",
            host: n.host,
            search: n.search ? n.search.replace(/^\?/, "") : "",
            hash: n.hash ? n.hash.replace(/^#/, "") : "",
            hostname: n.hostname,
            port: n.port,
            pathname: "/" === n.pathname.charAt(0) ? n.pathname : "/" + n.pathname
          };
        }

        return e = o(window.location.href), function (t) {
          var n = r.isString(t) ? o(t) : t;
          return n.protocol === e.protocol && n.host === e.host;
        };
      }() : function () {
        return !0;
      };
    }, function (e, t, n) {
      function r() {
        this.message = "String contains an invalid character";
      }

      r.prototype = new Error(), r.prototype.code = 5, r.prototype.name = "InvalidCharacterError", e.exports = function (e) {
        for (var t, n, o = String(e), i = "", s = 0, a = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/="; o.charAt(0 | s) || (a = "=", s % 1); i += a.charAt(63 & t >> 8 - s % 1 * 8)) {
          if ((n = o.charCodeAt(s += 0.75)) > 255) throw new r();
          t = t << 8 | n;
        }

        return i;
      };
    }, function (e, t, n) {
      var r = n(0);
      e.exports = r.isStandardBrowserEnv() ? {
        write: function write(e, t, n, o, i, s) {
          var a = [];
          a.push(e + "=" + encodeURIComponent(t)), r.isNumber(n) && a.push("expires=" + new Date(n).toGMTString()), r.isString(o) && a.push("path=" + o), r.isString(i) && a.push("domain=" + i), !0 === s && a.push("secure"), document.cookie = a.join("; ");
        },
        read: function read(e) {
          var t = document.cookie.match(new RegExp("(^|;\\s*)(" + e + ")=([^;]*)"));
          return t ? decodeURIComponent(t[3]) : null;
        },
        remove: function remove(e) {
          this.write(e, "", Date.now() - 864e5);
        }
      } : {
        write: function write() {},
        read: function read() {
          return null;
        },
        remove: function remove() {}
      };
    }, function (e, t, n) {
      var r = n(0);

      function o() {
        this.handlers = [];
      }

      o.prototype.use = function (e, t) {
        return this.handlers.push({
          fulfilled: e,
          rejected: t
        }), this.handlers.length - 1;
      }, o.prototype.eject = function (e) {
        this.handlers[e] && (this.handlers[e] = null);
      }, o.prototype.forEach = function (e) {
        r.forEach(this.handlers, function (t) {
          null !== t && e(t);
        });
      }, e.exports = o;
    }, function (e, t, n) {
      var r = n(0),
          o = n(23),
          i = n(5),
          s = n(1),
          a = n(24),
          l = n(25);

      function c(e) {
        e.cancelToken && e.cancelToken.throwIfRequested();
      }

      e.exports = function (e) {
        return c(e), e.baseURL && !a(e.url) && (e.url = l(e.baseURL, e.url)), e.headers = e.headers || {}, e.data = o(e.data, e.headers, e.transformRequest), e.headers = r.merge(e.headers.common || {}, e.headers[e.method] || {}, e.headers || {}), r.forEach(["delete", "get", "head", "post", "put", "patch", "common"], function (t) {
          delete e.headers[t];
        }), (e.adapter || s.adapter)(e).then(function (t) {
          return c(e), t.data = o(t.data, t.headers, e.transformResponse), t;
        }, function (t) {
          return i(t) || (c(e), t && t.response && (t.response.data = o(t.response.data, t.response.headers, e.transformResponse))), Promise.reject(t);
        });
      };
    }, function (e, t, n) {
      var r = n(0);

      e.exports = function (e, t, n) {
        return r.forEach(n, function (n) {
          e = n(e, t);
        }), e;
      };
    }, function (e, t, n) {
      e.exports = function (e) {
        return /^([a-z][a-z\d\+\-\.]*:)?\/\//i.test(e);
      };
    }, function (e, t, n) {
      e.exports = function (e, t) {
        return t ? e.replace(/\/+$/, "") + "/" + t.replace(/^\/+/, "") : e;
      };
    }, function (e, t, n) {
      var r = n(6);

      function o(e) {
        if ("function" != typeof e) throw new TypeError("executor must be a function.");
        var t;
        this.promise = new Promise(function (e) {
          t = e;
        });
        var n = this;
        e(function (e) {
          n.reason || (n.reason = new r(e), t(n.reason));
        });
      }

      o.prototype.throwIfRequested = function () {
        if (this.reason) throw this.reason;
      }, o.source = function () {
        var e;
        return {
          token: new o(function (t) {
            e = t;
          }),
          cancel: e
        };
      }, e.exports = o;
    }, function (e, t, n) {
      e.exports = function (e) {
        return function (t) {
          return e.apply(null, t);
        };
      };
    }]);
  }, function (e, t, n) {
    n.d(t, "c", function () {
      return i;
    }), n.d(t, "d", function () {
      return s;
    }), n.d(t, "b", function () {
      return a;
    }), n.d(t, "a", function () {
      return l;
    });
    var r = n(2);

    var o = function o() {
      return null;
    };

    n.n(r).a.addLanguage("en-US", {
      NATIVE_NAME: "English (US)",
      ENGLISH_NAME: "English",
      addOption: "Add Option +",
      allFieldsRemoved: "All fields were removed.",
      allowMultipleFiles: "Allow users to upload multiple files",
      autocomplete: "Autocomplete",
      button: "Button",
      cannotBeEmpty: "This field cannot be empty",
      checkboxGroup: "Checkbox Group",
      checkbox: "Checkbox",
      checkboxes: "Checkboxes",
      className: "Class",
      clearAllMessage: "Are you sure you want to clear all fields?",
      clear: "Clear",
      close: "Close",
      content: "Content",
      copy: "Copy To Clipboard",
      copyButton: "&#43;",
      copyButtonTooltip: "Copy",
      dateField: "Date Field",
      description: "Help Text",
      descriptionField: "Description",
      devMode: "Developer Mode",
      editNames: "Edit Names",
      editorTitle: "Form Elements",
      editXML: "Edit XML",
      enableOther: "Enable &quot;Other&quot;",
      enableOtherMsg: "Let users enter an unlisted option",
      fieldDeleteWarning: "false",
      fieldVars: "Field Variables",
      fieldNonEditable: "This field cannot be edited.",
      fieldRemoveWarning: "Are you sure you want to remove this field?",
      fileUpload: "File Upload",
      formUpdated: "Form Updated",
      getStarted: "Drag a field from the right to this area",
      header: "Header",
      hide: "Edit",
      hidden: "Hidden Input",
      inline: "Inline",
      inlineDesc: "Display {type} inline",
      label: "Label",
      labelEmpty: "Field Label cannot be empty",
      limitRole: "Limit access to one or more of the following roles:",
      mandatory: "Mandatory",
      maxlength: "Max Length",
      minOptionMessage: "This field requires a minimum of 2 options",
      minSelectionRequired: "Minimum {min} selections required",
      multipleFiles: "Multiple Files",
      name: "Name",
      no: "No",
      noFieldsToClear: "There are no fields to clear",
      number: "Number",
      off: "Off",
      on: "On",
      option: "Option",
      optionCount: "Option {count}",
      options: "Options",
      optional: "optional",
      optionLabelPlaceholder: "Label",
      optionValuePlaceholder: "Value",
      optionEmpty: "Option value required",
      other: "Other",
      paragraph: "Paragraph",
      placeholder: "Placeholder",
      "placeholders.value": "Value",
      "placeholders.label": "Label",
      "placeholders.email": "Enter your email",
      "placeholders.className": "space separated classes",
      "placeholders.password": "Enter your password",
      preview: "Preview",
      radioGroup: "Radio Group",
      radio: "Radio",
      removeMessage: "Remove Element",
      removeOption: "Remove Option",
      remove: "&#215;",
      required: "Required",
      requireValidOption: "Only accept a pre-defined Option",
      richText: "Rich Text Editor",
      roles: "Access",
      rows: "Rows",
      save: "Save",
      selectOptions: "Options",
      select: "Select",
      selectColor: "Select Color",
      selectionsMessage: "Allow Multiple Selections",
      size: "Size",
      "size.xs": "Extra Small",
      "size.sm": "Small",
      "size.m": "Default",
      "size.lg": "Large",
      style: "Style",
      "styles.btn.default": "Default",
      "styles.btn.danger": "Danger",
      "styles.btn.info": "Info",
      "styles.btn.primary": "Primary",
      "styles.btn.success": "Success",
      "styles.btn.warning": "Warning",
      subtype: "Type",
      text: "Text Field",
      textArea: "Text Area",
      toggle: "Toggle",
      warning: "Warning!",
      value: "Value",
      viewJSON: "[{&hellip;}]",
      viewXML: "&lt;/&gt;",
      yes: "Yes"
    });
    var i = {
      actionButtons: [],
      allowStageSort: !0,
      append: !1,
      controlOrder: ["autocomplete", "button", "checkbox-group", "checkbox", "date", "file", "header", "hidden", "number", "paragraph", "radio-group", "select", "text", "textarea"],
      controlPosition: "right",
      dataType: "json",
      defaultFields: [],
      disabledActionButtons: [],
      disabledAttrs: [],
      disabledFieldButtons: {},
      disabledSubtypes: {},
      disableFields: [],
      disableHTMLLabels: !1,
      disableInjectedStyle: !1,
      editOnAdd: !1,
      fields: [],
      fieldRemoveWarn: !1,
      fieldEditContainer: null,
      inputSets: [],
      notify: {
        error: function error(e) {
          console.log(e);
        },
        success: function success(e) {
          console.log(e);
        },
        warning: function warning(e) {
          console.warn(e);
        }
      },
      onAddField: function onAddField(e, t) {
        return t;
      },
      onAddFieldAfter: function onAddFieldAfter(e, t) {
        return t;
      },
      onAddOption: function onAddOption(e) {
        return e;
      },
      onClearAll: o,
      onCloseFieldEdit: o,
      onOpenFieldEdit: o,
      onSave: o,
      persistDefaultFields: !1,
      prepend: !1,
      replaceFields: [],
      roles: {
        1: "Administrator"
      },
      scrollToFieldOnAdd: !0,
      showActionButtons: !0,
      sortableControls: !1,
      stickyControls: {
        enable: !0,
        offset: {
          top: 5,
          bottom: "auto",
          right: "auto"
        }
      },
      subtypes: {},
      templates: {},
      typeUserAttrs: {},
      typeUserDisabledAttrs: {},
      typeUserEvents: {}
    },
        s = {
      btn: ["default", "danger", "info", "primary", "success", "warning"]
    },
        a = {
      location: "assets/lang/"
    },
        l = {};
  }, function (e, t, n) {
    n.d(t, "d", function () {
      return r;
    }), n.d(t, "f", function () {
      return i;
    }), n.d(t, "b", function () {
      return s;
    }), n.d(t, "c", function () {
      return a;
    }), n.d(t, "e", function () {
      return l;
    }), n.d(t, "a", function () {
      return u;
    });

    var r = {},
        o = {
      text: ["text", "password", "email", "color", "tel"],
      header: ["h1", "h2", "h3"],
      button: ["button", "submit", "reset"],
      paragraph: ["p", "address", "blockquote", "canvas", "output"],
      textarea: ["textarea", "quill"]
    },
        i = function i(e) {
      e.parentNode && e.parentNode.removeChild(e);
    },
        s = function s(e) {
      for (; e.firstChild;) {
        e.removeChild(e.firstChild);
      }

      return e;
    },
        a = function a(e, t) {
      var n = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : !0;
      var r = [];
      var o = ["none", "block"];
      n && (o = o.reverse());

      for (var _n9 = e.length - 1; _n9 >= 0; _n9--) {
        -1 !== e[_n9].textContent.toLowerCase().indexOf(t.toLowerCase()) ? (e[_n9].style.display = o[0], r.push(e[_n9])) : e[_n9].style.display = o[1];
      }

      return r;
    },
        l = ["select", "checkbox-group", "checkbox", "radio-group", "autocomplete"],
        c = new RegExp("(".concat(l.join("|"), ")"));

    var u = /*#__PURE__*/function () {
      function u(e) {
        _classCallCheck(this, u);

        return this.optionFields = l, this.optionFieldsRegEx = c, this.subtypes = o, this.empty = s, this.filter = a, r[e] = this, r[e];
      }

      _createClass(u, [{
        key: "onRender",
        value: function onRender(e, t) {
          var _this2 = this;

          e.parentElement ? t(e) : window.requestAnimationFrame(function () {
            return _this2.onRender(e, t);
          });
        }
      }]);

      return u;
    }();
  }, function (e, t, n) {
    function r(e) {
      var t;
      return "function" == typeof Event ? t = new Event(e) : (t = document.createEvent("Event"), t.initEvent(e, !0, !0)), t;
    }

    var o = {
      loaded: r("loaded"),
      viewData: r("viewData"),
      userDeclined: r("userDeclined"),
      modalClosed: r("modalClosed"),
      modalOpened: r("modalOpened"),
      formSaved: r("formSaved"),
      fieldAdded: r("fieldAdded"),
      fieldRemoved: r("fieldRemoved"),
      fieldRendered: r("fieldRendered"),
      fieldEditOpened: r("fieldEditOpened"),
      fieldEditClosed: r("fieldEditClosed")
    };
    t.a = o;
  }, function (e, t, n) {
    n.d(t, "a", function () {
      return s;
    });
    var r = n(1),
        o = n(2),
        i = n.n(o);

    var s = /*#__PURE__*/function (_r$a) {
      _inherits(s, _r$a);

      var _super = _createSuper(s);

      function s() {
        _classCallCheck(this, s);

        return _super.apply(this, arguments);
      }

      _createClass(s, [{
        key: "build",
        value: function build() {
          var e = s.templates[this.type];
          if (!e) return this.error("Invalid custom control type. Please ensure you have registered it correctly as a template option.");
          var t = Object.assign(this.config),
              n = ["label", "description", "subtype", "id", "isPreview", "required", "title", "aria-required", "type"];

          for (var _i4 = 0, _n10 = n; _i4 < _n10.length; _i4++) {
            var _e7 = _n10[_i4];
            t[_e7] = this.config[_e7] || this[_e7];
          }

          return e = e.bind(this), e = e(t), e.js && (this.js = e.js), e.css && (this.css = e.css), this.onRender = e.onRender, {
            field: e.field,
            layout: e.layout
          };
        }
      }], [{
        key: "register",
        value: function register() {
          var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
          var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];
          s.customRegister = {}, s.def || (s.def = {
            icon: {},
            i18n: {}
          }), s.templates = e;
          var n = i.a.locale;
          s.def.i18n[n] || (s.def.i18n[n] = {}), r.a.register(Object.keys(e), s);

          var _iterator3 = _createForOfIteratorHelper(t),
              _step3;

          try {
            for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
              var _o2 = _step3.value;
              var _t8 = _o2.type;

              if (_o2.attrs = _o2.attrs || {}, !_t8) {
                if (!_o2.attrs.type) {
                  this.error("Ignoring invalid custom field definition. Please specify a type property.");
                  continue;
                }

                _t8 = _o2.attrs.type;
              }

              var _i5 = _o2.subtype || _t8;

              if (!e[_t8]) {
                var _e8 = r.a.getClass(_t8, _o2.subtype);

                if (!_e8) {
                  this.error("Error while registering custom field: " + _t8 + (_o2.subtype ? ":" + _o2.subtype : "") + ". Unable to find any existing defined control or template for rendering.");
                  continue;
                }

                _i5 = _o2.datatype ? _o2.datatype : "".concat(_t8, "-").concat(Math.floor(9e3 * Math.random() + 1e3)), s.customRegister[_i5] = jQuery.extend(_o2, {
                  type: _t8,
                  "class": _e8
                });
              }

              s.def.i18n[n][_i5] = _o2.label, s.def.icon[_i5] = _o2.icon;
            }
          } catch (err) {
            _iterator3.e(err);
          } finally {
            _iterator3.f();
          }
        }
      }, {
        key: "getRegistered",
        value: function getRegistered() {
          var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : !1;
          return e ? r.a.getRegistered(e) : Object.keys(s.customRegister);
        }
      }, {
        key: "lookup",
        value: function lookup(e) {
          return s.customRegister[e];
        }
      }, {
        key: "definition",
        get: function get() {
          return s.def;
        }
      }]);

      return s;
    }(r.a);

    s.customRegister = {};
  }, function (e, t, n) {
    e.exports = function (e) {
      var t = [];
      return t.toString = function () {
        return this.map(function (t) {
          var n = function (e, t) {
            var n = e[1] || "",
                r = e[3];
            if (!r) return n;

            if (t && "function" == typeof btoa) {
              var o = (s = r, a = btoa(unescape(encodeURIComponent(JSON.stringify(s)))), l = "sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(a), "/*# ".concat(l, " */")),
                  i = r.sources.map(function (e) {
                return "/*# sourceURL=".concat(r.sourceRoot || "").concat(e, " */");
              });
              return [n].concat(i).concat([o]).join("\n");
            }

            var s, a, l;
            return [n].join("\n");
          }(t, e);

          return t[2] ? "@media ".concat(t[2], " {").concat(n, "}") : n;
        }).join("");
      }, t.i = function (e, n, r) {
        "string" == typeof e && (e = [[null, e, ""]]);
        var o = {};
        if (r) for (var i = 0; i < this.length; i++) {
          var s = this[i][0];
          null != s && (o[s] = !0);
        }

        for (var a = 0; a < e.length; a++) {
          var l = [].concat(e[a]);
          r && o[l[0]] || (n && (l[2] ? l[2] = "".concat(n, " and ").concat(l[2]) : l[2] = n), t.push(l));
        }
      }, t;
    };
  },, function (e, t, n) {
    var r,
        o = function o() {
      return void 0 === r && (r = Boolean(window && document && document.all && !window.atob)), r;
    },
        i = function () {
      var e = {};
      return function (t) {
        if (void 0 === e[t]) {
          var n = document.querySelector(t);
          if (window.HTMLIFrameElement && n instanceof window.HTMLIFrameElement) try {
            n = n.contentDocument.head;
          } catch (e) {
            n = null;
          }
          e[t] = n;
        }

        return e[t];
      };
    }(),
        s = [];

    function a(e) {
      for (var t = -1, n = 0; n < s.length; n++) {
        if (s[n].identifier === e) {
          t = n;
          break;
        }
      }

      return t;
    }

    function l(e, t) {
      for (var n = {}, r = [], o = 0; o < e.length; o++) {
        var i = e[o],
            l = t.base ? i[0] + t.base : i[0],
            c = n[l] || 0,
            u = "".concat(l, " ").concat(c);
        n[l] = c + 1;
        var d = a(u),
            p = {
          css: i[1],
          media: i[2],
          sourceMap: i[3]
        };
        -1 !== d ? (s[d].references++, s[d].updater(p)) : s.push({
          identifier: u,
          updater: g(p, t),
          references: 1
        }), r.push(u);
      }

      return r;
    }

    function c(e) {
      var t = document.createElement("style"),
          r = e.attributes || {};

      if (void 0 === r.nonce) {
        var o = n.nc;
        o && (r.nonce = o);
      }

      if (Object.keys(r).forEach(function (e) {
        t.setAttribute(e, r[e]);
      }), "function" == typeof e.insert) e.insert(t);else {
        var s = i(e.insert || "head");
        if (!s) throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
        s.appendChild(t);
      }
      return t;
    }

    var u,
        d = (u = [], function (e, t) {
      return u[e] = t, u.filter(Boolean).join("\n");
    });

    function p(e, t, n, r) {
      var o = n ? "" : r.media ? "@media ".concat(r.media, " {").concat(r.css, "}") : r.css;
      if (e.styleSheet) e.styleSheet.cssText = d(t, o);else {
        var i = document.createTextNode(o),
            s = e.childNodes;
        s[t] && e.removeChild(s[t]), s.length ? e.insertBefore(i, s[t]) : e.appendChild(i);
      }
    }

    function f(e, t, n) {
      var r = n.css,
          o = n.media,
          i = n.sourceMap;
      if (o ? e.setAttribute("media", o) : e.removeAttribute("media"), i && btoa && (r += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(i)))), " */")), e.styleSheet) e.styleSheet.cssText = r;else {
        for (; e.firstChild;) {
          e.removeChild(e.firstChild);
        }

        e.appendChild(document.createTextNode(r));
      }
    }

    var h = null,
        m = 0;

    function g(e, t) {
      var n, r, o;

      if (t.singleton) {
        var i = m++;
        n = h || (h = c(t)), r = p.bind(null, n, i, !1), o = p.bind(null, n, i, !0);
      } else n = c(t), r = f.bind(null, n, t), o = function o() {
        !function (e) {
          if (null === e.parentNode) return !1;
          e.parentNode.removeChild(e);
        }(n);
      };

      return r(e), function (t) {
        if (t) {
          if (t.css === e.css && t.media === e.media && t.sourceMap === e.sourceMap) return;
          r(e = t);
        } else o();
      };
    }

    e.exports = function (e, t) {
      (t = t || {}).singleton || "boolean" == typeof t.singleton || (t.singleton = o());
      var n = l(e = e || [], t);
      return function (e) {
        if (e = e || [], "[object Array]" === Object.prototype.toString.call(e)) {
          for (var r = 0; r < n.length; r++) {
            var o = a(n[r]);
            s[o].references--;
          }

          for (var i = l(e, t), c = 0; c < n.length; c++) {
            var u = a(n[c]);
            0 === s[u].references && (s[u].updater(), s.splice(u, 1));
          }

          n = i;
        }
      };
    };
  }, function (e, t, n) {
    n.d(t, "a", function () {
      return i;
    });
    var r = n(0);

    var o = function o(e, t) {
      var n = e.id ? "formbuilder-".concat(e.type, " form-group field-").concat(e.id) : "";

      if (e.className) {
        var _r6 = e.className.split(" ");

        _r6 = _r6.filter(function (e) {
          return /^col-(xs|sm|md|lg)-([^\s]+)/.test(e) || e.startsWith("row-");
        }), _r6 && _r6.length > 0 && (n += " " + _r6.join(" "));

        for (var _e9 = 0; _e9 < _r6.length; _e9++) {
          var _n11 = _r6[_e9];
          t.classList.remove(_n11);
        }
      }

      return n;
    };

    var i = /*#__PURE__*/function () {
      function i(e, t) {
        var _this3 = this;

        _classCallCheck(this, i);

        this.preview = t, this.templates = {
          label: null,
          help: null,
          "default": function _default(e, t, n, r) {
            return n && t.appendChild(n), _this3.markup("div", [t, e], {
              className: o(r, e)
            });
          },
          noLabel: function noLabel(e, t, n, r) {
            return _this3.markup("div", e, {
              className: o(r, e)
            });
          },
          hidden: function hidden(e) {
            return e;
          }
        }, e && (this.templates = jQuery.extend(this.templates, e)), this.configure();
      }

      _createClass(i, [{
        key: "configure",
        value: function configure() {}
      }, {
        key: "build",
        value: function build(e, t, n) {
          this.preview && (t.name ? t.name = t.name + "-preview" : t.name = r.f.nameAttr(t) + "-preview"), t.id = t.name, this.data = jQuery.extend({}, t);
          var o = new e(t, this.preview);

          var _i6 = o.build();

          "object" == _typeof(_i6) && _i6.field || (_i6 = {
            field: _i6
          });
          var s = this.label(),
              a = this.help();
          var l;
          l = n && this.isTemplate(n) ? n : this.isTemplate(_i6.layout) ? _i6.layout : "default";
          var c = this.processTemplate(l, _i6.field, s, a);
          return o.on("prerender")(c), c.addEventListener("fieldRendered", o.on("render")), c;
        }
      }, {
        key: "label",
        value: function label() {
          var e = this.data.label || "",
              t = [r.f.parsedHtml(e)];
          return this.data.required && t.push(this.markup("span", "*", {
            className: "formbuilder-required"
          })), this.isTemplate("label") ? this.processTemplate("label", t) : this.markup("label", t, {
            "for": this.data.id,
            className: "formbuilder-".concat(this.data.type, "-label")
          });
        }
      }, {
        key: "help",
        value: function help() {
          return this.data.description ? this.isTemplate("help") ? this.processTemplate("help", this.data.description) : this.markup("span", "?", {
            className: "tooltip-element",
            tooltip: this.data.description
          }) : null;
        }
      }, {
        key: "isTemplate",
        value: function isTemplate(e) {
          return "function" == typeof this.templates[e];
        }
      }, {
        key: "processTemplate",
        value: function processTemplate(e) {
          var _this$templates;

          for (var _len = arguments.length, t = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
            t[_key - 1] = arguments[_key];
          }

          var n = (_this$templates = this.templates)[e].apply(_this$templates, t.concat([this.data]));

          return n.jquery && (n = n[0]), n;
        }
      }, {
        key: "markup",
        value: function markup(e) {
          var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "";
          var n = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
          return r.f.markup(e, t, n);
        }
      }]);

      return i;
    }();
  },, function (t, n, r) {
    var o = r(1),
        i = r(4);

    function s(e, t) {
      if (null == e) return {};

      var n,
          r,
          o = function (e, t) {
        if (null == e) return {};
        var n,
            r,
            o = {},
            i = Object.keys(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || (o[n] = e[n]);
        }

        return o;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]);
        }
      }

      return o;
    }

    var a = /*#__PURE__*/function (_o$a) {
      _inherits(a, _o$a);

      var _super2 = _createSuper(a);

      function a() {
        _classCallCheck(this, a);

        return _super2.apply(this, arguments);
      }

      _createClass(a, [{
        key: "build",
        value: function build() {
          var _this4 = this;

          var e = this.config,
              t = e.values,
              n = e.type,
              r = s(e, ["values", "type"]),
              o = function o(e) {
            var t = e.target.nextSibling.nextSibling,
                n = e.target.nextSibling,
                r = _this4.getActiveOption(t);

            var o = new Map([[38, function () {
              var e = _this4.getPreviousOption(r);

              e && _this4.selectOption(t, e);
            }], [40, function () {
              var e = _this4.getNextOption(r);

              e && _this4.selectOption(t, e);
            }], [13, function () {
              r ? (e.target.value = r.innerHTML, n.value = r.getAttribute("value"), "none" === t.style.display ? _this4.showList(t, r) : _this4.hideList(t)) : _this4.config.requireValidOption && (_this4.isOptionValid(t, e.target.value) || (e.target.value = "", e.target.nextSibling.value = "")), e.preventDefault();
            }], [27, function () {
              _this4.hideList(t);
            }]]).get(e.keyCode);
            return o || (o = function o() {
              return !1;
            }), o();
          },
              _a2 = {
            focus: function focus(e) {
              var t = e.target.nextSibling.nextSibling,
                  n = Object(i.c)(t.querySelectorAll("li"), e.target.value);

              if (e.target.addEventListener("keydown", o), e.target.value.length > 0) {
                var _e10 = n.length > 0 ? n[n.length - 1] : null;

                _this4.showList(t, _e10);
              }
            },
            blur: function blur(e) {
              e.target.removeEventListener("keydown", o);
              var t = setTimeout(function () {
                e.target.nextSibling.nextSibling.style.display = "none", clearTimeout(t);
              }, 200);

              if (_this4.config.requireValidOption) {
                var _t9 = e.target.nextSibling.nextSibling;
                _this4.isOptionValid(_t9, e.target.value) || (e.target.value = "", e.target.nextSibling.value = "");
              }
            },
            input: function input(e) {
              var t = e.target.nextSibling.nextSibling;
              e.target.nextSibling.value = e.target.value;
              var n = Object(i.c)(t.querySelectorAll("li"), e.target.value);
              if (0 == n.length) _this4.hideList(t);else {
                var _e11 = _this4.getActiveOption(t);

                _e11 || (_e11 = n[n.length - 1]), _this4.showList(t, _e11);
              }
            }
          },
              l = Object.assign({}, r, {
            id: r.id + "-input",
            autocomplete: "off",
            events: _a2
          }),
              c = Object.assign({}, r, {
            type: "hidden"
          });

          delete l.name;
          var u = [this.markup("input", null, l), this.markup("input", null, c)],
              d = t.map(function (e) {
            var t = e.label,
                n = {
              events: {
                click: function click(t) {
                  var n = t.target.parentElement,
                      r = n.previousSibling.previousSibling;
                  r.value = e.label, r.nextSibling.value = e.value, _this4.hideList(n);
                }
              },
              value: e.value
            };
            return _this4.markup("li", t, n);
          });
          return u.push(this.markup("ul", d, {
            id: r.id + "-list",
            className: "formbuilder-".concat(n, "-list")
          })), u;
        }
      }, {
        key: "hideList",
        value: function hideList(e) {
          this.selectOption(e, null), e.style.display = "none";
        }
      }, {
        key: "showList",
        value: function showList(e, t) {
          this.selectOption(e, t), e.style.display = "block", e.style.width = e.parentElement.offsetWidth + "px";
        }
      }, {
        key: "getActiveOption",
        value: function getActiveOption(e) {
          var t = e.getElementsByClassName("active-option")[0];
          return t && "none" !== t.style.display ? t : null;
        }
      }, {
        key: "getPreviousOption",
        value: function getPreviousOption(e) {
          var t = e;

          do {
            t = t ? t.previousSibling : null;
          } while (null != t && "none" === t.style.display);

          return t;
        }
      }, {
        key: "getNextOption",
        value: function getNextOption(e) {
          var t = e;

          do {
            t = t ? t.nextSibling : null;
          } while (null != t && "none" === t.style.display);

          return t;
        }
      }, {
        key: "selectOption",
        value: function selectOption(e, t) {
          var n = e.querySelectorAll("li");

          for (var _e12 = 0; _e12 < n.length; _e12++) {
            n[_e12].classList.remove("active-option");
          }

          t && t.classList.add("active-option");
        }
      }, {
        key: "isOptionValid",
        value: function isOptionValid(e, t) {
          var n = e.querySelectorAll("li");
          var r = !1;

          for (var _e13 = 0; _e13 < n.length; _e13++) {
            if (n[_e13].innerHTML === t) {
              r = !0;
              break;
            }
          }

          return r;
        }
      }, {
        key: "onRender",
        value: function onRender(t) {
          if (this.config.userData) {
            var _t10 = e("#" + this.config.name),
                _n12 = _t10.next(),
                _r7 = this.config.userData[0];

            var _o3 = null;
            if (_n12.find("li").each(function () {
              e(this).attr("value") !== _r7 || (_o3 = e(this).get(0));
            }), null === _o3) return this.config.requireValidOption ? void 0 : void _t10.prev().val(this.config.userData[0]);
            _t10.prev().val(_o3.innerHTML), _t10.val(_o3.getAttribute("value"));

            var _i7 = _t10.next().get(0);

            "none" === _i7.style.display ? this.showList(_i7, _o3) : this.hideList(_i7);
          }

          return t;
        }
      }], [{
        key: "definition",
        get: function get() {
          return {
            mi18n: {
              requireValidOption: "requireValidOption"
            }
          };
        }
      }]);

      return a;
    }(o.a);

    o.a.register("autocomplete", a);

    var l = /*#__PURE__*/function (_o$a2) {
      _inherits(l, _o$a2);

      var _super3 = _createSuper(l);

      function l() {
        _classCallCheck(this, l);

        return _super3.apply(this, arguments);
      }

      _createClass(l, [{
        key: "build",
        value: function build() {
          return {
            field: this.markup("button", this.label, this.config),
            layout: "noLabel"
          };
        }
      }]);

      return l;
    }(o.a);

    o.a.register("button", l), o.a.register(["button", "submit", "reset"], l, "button");
    var c = r(6);

    var u = /*#__PURE__*/function (_o$a3) {
      _inherits(u, _o$a3);

      var _super4 = _createSuper(u);

      function u() {
        _classCallCheck(this, u);

        return _super4.apply(this, arguments);
      }

      _createClass(u, [{
        key: "build",
        value: function build() {
          return {
            field: this.markup("input", null, this.config),
            layout: "hidden"
          };
        }
      }, {
        key: "onRender",
        value: function onRender() {
          this.config.userData && e("#" + this.config.name).val(this.config.userData[0]);
        }
      }]);

      return u;
    }(o.a);

    o.a.register("hidden", u);
    var d = r(0);

    function p(e, t) {
      if (null == e) return {};

      var n,
          r,
          o = function (e, t) {
        if (null == e) return {};
        var n,
            r,
            o = {},
            i = Object.keys(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || (o[n] = e[n]);
        }

        return o;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]);
        }
      }

      return o;
    }

    var f = /*#__PURE__*/function (_o$a4) {
      _inherits(f, _o$a4);

      var _super5 = _createSuper(f);

      function f() {
        _classCallCheck(this, f);

        return _super5.apply(this, arguments);
      }

      _createClass(f, [{
        key: "build",
        value: function build() {
          var e = this.config,
              t = e.type,
              n = p(e, ["type"]);
          var r = t;
          var o = {
            paragraph: "p",
            header: this.subtype
          };
          return o[t] && (r = o[t]), {
            field: this.markup(r, d.f.parsedHtml(this.label), n),
            layout: "noLabel"
          };
        }
      }]);

      return f;
    }(o.a);

    function h(e, t) {
      if (null == e) return {};

      var n,
          r,
          o = function (e, t) {
        if (null == e) return {};
        var n,
            r,
            o = {},
            i = Object.keys(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || (o[n] = e[n]);
        }

        return o;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]);
        }
      }

      return o;
    }

    o.a.register(["paragraph", "header"], f), o.a.register(["p", "address", "blockquote", "canvas", "output"], f, "paragraph"), o.a.register(["h1", "h2", "h3", "h4", "h5", "h6"], f, "header");

    var m = /*#__PURE__*/function (_o$a5) {
      _inherits(m, _o$a5);

      var _super6 = _createSuper(m);

      function m() {
        _classCallCheck(this, m);

        return _super6.apply(this, arguments);
      }

      _createClass(m, [{
        key: "build",
        value: function build() {
          var e = [],
              t = this.config,
              n = t.values,
              r = t.value,
              o = t.placeholder,
              i = t.type,
              s = t.inline,
              a = t.other,
              l = t.toggle,
              c = h(t, ["values", "value", "placeholder", "type", "inline", "other", "toggle"]),
              u = i.replace("-group", ""),
              p = "select" === i;

          if ((c.multiple || "checkbox-group" === i) && (c.name = c.name + "[]"), "checkbox-group" === i && c.required && (this.onRender = this.groupRequired), delete c.title, n) {
            o && p && e.push(this.markup("option", o, {
              disabled: null,
              selected: null
            }));

            for (var _t11 = 0; _t11 < n.length; _t11++) {
              var _i8 = n[_t11];
              "string" == typeof _i8 && (_i8 = {
                label: _i8,
                value: _i8
              });

              var _i9 = _i8,
                  _i9$label = _i9.label,
                  _a3 = _i9$label === void 0 ? "" : _i9$label,
                  _d2 = h(_i8, ["label"]);

              if (_d2.id = "".concat(c.id, "-").concat(_t11), _d2.selected && !o || delete _d2.selected, void 0 !== r && _d2.value === r && (_d2.selected = !0), p) {
                var _t12 = this.markup("option", document.createTextNode(_a3), _d2);

                e.push(_t12);
              } else {
                var _t13 = [_a3];

                var _n13 = "formbuilder-" + u;

                s && (_n13 += "-inline"), _d2.type = u, _d2.selected && (_d2.checked = "checked", delete _d2.selected);

                var _r8 = this.markup("input", null, Object.assign({}, c, _d2)),
                    _o4 = {
                  "for": _d2.id
                };

                var _i10 = [_r8, this.markup("label", _t13, _o4)];
                l && (_o4.className = "kc-toggle", _t13.unshift(_r8, this.markup("span")), _i10 = this.markup("label", _t13, _o4));

                var _p = this.markup("div", _i10, {
                  className: _n13
                });

                e.push(_p);
              }
            }

            if (!p && a) {
              var _t14 = {
                id: c.id + "-other",
                className: c.className + " other-option",
                value: ""
              };

              var _n14 = "formbuilder-" + u;

              s && (_n14 += "-inline");

              var _r9 = Object.assign({}, c, _t14);

              _r9.type = u;

              var _o5 = {
                type: "text",
                events: {
                  input: function input(e) {
                    var t = e.target,
                        n = t.parentElement.previousElementSibling;
                    n.value = t.value, n.name = c.id + "[]";
                  }
                },
                id: _t14.id + "-value",
                className: "other-val"
              },
                  _i11 = this.markup("input", null, _r9),
                  _a4 = [document.createTextNode("Other"), this.markup("input", null, _o5)],
                  _l = this.markup("label", _a4, {
                "for": _r9.id
              }),
                  _d3 = this.markup("div", [_i11, _l], {
                className: _n14
              });

              e.push(_d3);
            }
          }

          return this.dom = "select" == i ? this.markup(u, e, Object(d.A)(c, !0)) : this.markup("div", e, {
            className: i
          }), this.dom;
        }
      }, {
        key: "groupRequired",
        value: function groupRequired() {
          var e = this.element.getElementsByTagName("input"),
              t = function t(e, _t15) {
            [].forEach.call(e, function (e) {
              _t15 ? e.removeAttribute("required") : e.setAttribute("required", "required"), function (e, t) {
                var n = o.a.mi18n("minSelectionRequired", 1);
                t ? e.setCustomValidity("") : e.setCustomValidity(n);
              }(e, _t15);
            });
          },
              n = function n() {
            var n = [].some.call(e, function (e) {
              return e.checked;
            });
            t(e, n);
          };

          for (var _t16 = e.length - 1; _t16 >= 0; _t16--) {
            e[_t16].addEventListener("change", n);
          }

          n();
        }
      }, {
        key: "onRender",
        value: function onRender() {
          if (this.config.userData) {
            var _t17 = this.config.userData.slice();

            "select" === this.config.type ? e(this.dom).val(_t17).prop("selected", !0) : this.config.type.endsWith("-group") && this.dom.querySelectorAll("input").forEach(function (e) {
              if (!e.classList.contains("other-val")) {
                for (var _n15 = 0; _n15 < _t17.length; _n15++) {
                  if (e.value === _t17[_n15]) {
                    e.setAttribute("checked", !0), _t17.splice(_n15, 1);
                    break;
                  }
                }

                if (e.id.endsWith("-other")) {
                  var _n16 = document.getElementById(e.id + "-value");

                  if (0 === _t17.length) return;
                  e.setAttribute("checked", !0), _n16.value = e.value = _t17[0], _n16.style.display = "inline-block";
                }
              }
            });
          }
        }
      }], [{
        key: "definition",
        get: function get() {
          return {
            inactive: ["checkbox"],
            mi18n: {
              minSelectionRequired: "minSelectionRequired"
            }
          };
        }
      }]);

      return m;
    }(o.a);

    o.a.register(["select", "checkbox-group", "radio-group", "checkbox"], m);

    var g = /*#__PURE__*/function (_o$a6) {
      _inherits(g, _o$a6);

      var _super7 = _createSuper(g);

      function g() {
        _classCallCheck(this, g);

        return _super7.apply(this, arguments);
      }

      _createClass(g, [{
        key: "build",
        value: function build() {
          var e = this.config.name;
          e = this.config.multiple ? e + "[]" : e;
          var t = Object.assign({}, this.config, {
            name: e
          });
          return this.dom = this.markup("input", null, t), this.dom;
        }
      }, {
        key: "onRender",
        value: function onRender() {
          this.config.userData && e(this.dom).val(this.config.userData[0]);
        }
      }], [{
        key: "definition",
        get: function get() {
          return {
            mi18n: {
              date: "dateField",
              file: "fileUpload"
            }
          };
        }
      }]);

      return g;
    }(o.a);

    o.a.register(["text", "file", "date", "number"], g), o.a.register(["text", "password", "email", "color", "tel"], g, "text");

    var b = /*#__PURE__*/function (_g) {
      _inherits(b, _g);

      var _super8 = _createSuper(b);

      function b() {
        _classCallCheck(this, b);

        return _super8.apply(this, arguments);
      }

      _createClass(b, [{
        key: "configure",
        value: function configure() {
          var _this5 = this;

          this.js = this.classConfig.js || "//cdnjs.cloudflare.com/ajax/libs/file-uploader/5.14.2/jquery.fine-uploader/jquery.fine-uploader.min.js", this.css = [this.classConfig.css || "//cdnjs.cloudflare.com/ajax/libs/file-uploader/5.14.2/jquery.fine-uploader/fine-uploader-gallery.min.css", {
            type: "inline",
            id: "fineuploader-inline",
            style: "\n          .qq-uploader .qq-error-message {\n            position: absolute;\n            left: 20%;\n            top: 20px;\n            width: 60%;\n            color: #a94442;\n            background: #f2dede;\n            border: solid 1px #ebccd1;\n            padding: 15px;\n            line-height: 1.5em;\n            text-align: center;\n            z-index: 99999;\n          }\n          .qq-uploader .qq-error-message span {\n            display: inline-block;\n            text-align: left;\n          }"
          }], this.handler = this.classConfig.handler || "/upload";
          ["js", "css", "handler"].forEach(function (e) {
            return delete _this5.classConfig[e];
          });
          var t = this.classConfig.template || '\n      <div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Drop files here">\n        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">\n          <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>\n        </div>\n        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>\n          <span class="qq-upload-drop-area-text-selector"></span>\n        </div>\n        <div class="qq-upload-button-selector qq-upload-button">\n          <div>Upload a file</div>\n        </div>\n        <span class="qq-drop-processing-selector qq-drop-processing">\n          <span>Processing dropped files...</span>\n          <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>\n        </span>\n        <ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite" aria-relevant="additions removals">\n          <li>\n            <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>\n            <div class="qq-progress-bar-container-selector qq-progress-bar-container">\n              <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>\n            </div>\n            <span class="qq-upload-spinner-selector qq-upload-spinner"></span>\n            <div class="qq-thumbnail-wrapper">\n              <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>\n            </div>\n            <button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>\n            <button type="button" class="qq-upload-retry-selector qq-upload-retry">\n              <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>\n              Retry\n            </button>\n            <div class="qq-file-info">\n              <div class="qq-file-name">\n                <span class="qq-upload-file-selector qq-upload-file"></span>\n                <span class="qq-edit-filename-icon-selector qq-btn qq-edit-filename-icon" aria-label="Edit filename"></span>\n              </div>\n              <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">\n              <span class="qq-upload-size-selector qq-upload-size"></span>\n              <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">\n                <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>\n              </button>\n              <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">\n                <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>\n              </button>\n              <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">\n                <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>\n              </button>\n            </div>\n          </li>\n        </ul>\n        <dialog class="qq-alert-dialog-selector">\n          <div class="qq-dialog-message-selector"></div>\n          <div class="qq-dialog-buttons">\n            <button type="button" class="qq-cancel-button-selector">Close</button>\n          </div>\n        </dialog>\n        <dialog class="qq-confirm-dialog-selector">\n          <div class="qq-dialog-message-selector"></div>\n          <div class="qq-dialog-buttons">\n            <button type="button" class="qq-cancel-button-selector">No</button>\n            <button type="button" class="qq-ok-button-selector">Yes</button>\n          </div>\n        </dialog>\n        <dialog class="qq-prompt-dialog-selector">\n          <div class="qq-dialog-message-selector"></div>\n          <input type="text">\n          <div class="qq-dialog-buttons">\n            <button type="button" class="qq-cancel-button-selector">Cancel</button>\n            <button type="button" class="qq-ok-button-selector">Ok</button>\n          </div>\n        </dialog>\n      </div>';
          this.fineTemplate = e("<div/>").attr("id", "qq-template").html(t);
        }
      }, {
        key: "build",
        value: function build() {
          return this.input = this.markup("input", null, {
            type: "hidden",
            name: this.config.name,
            id: this.config.name
          }), this.wrapper = this.markup("div", "", {
            id: this.config.name + "-wrapper"
          }), [this.input, this.wrapper];
        }
      }, {
        key: "onRender",
        value: function onRender() {
          var t = e(this.wrapper),
              n = e(this.input),
              r = jQuery.extend(!0, {
            request: {
              endpoint: this.handler
            },
            deleteFile: {
              enabled: !0,
              endpoint: this.handler
            },
            chunking: {
              enabled: !0,
              concurrent: {
                enabled: !0
              },
              success: {
                endpoint: this.handler + (-1 == this.handler.indexOf("?") ? "?" : "&") + "done"
              }
            },
            resume: {
              enabled: !0
            },
            retry: {
              enableAuto: !0,
              showButton: !0
            },
            callbacks: {
              onError: function onError(n, r, o) {
                "." != o.slice(-1) && (o += ".");
                var i = e("<div />").addClass("qq-error-message").html("<span>Error processing upload: <b>".concat(r, "</b>.<br />Reason: ").concat(o, "</span>")).prependTo(t.find(".qq-uploader")),
                    s = window.setTimeout(function () {
                  i.fadeOut(function () {
                    i.remove(), window.clearTimeout(s);
                  });
                }, 6e3);
                return n;
              },
              onStatusChange: function onStatusChange(e, r, o) {
                var i = t.fineUploader("getUploads"),
                    s = [];

                var _iterator4 = _createForOfIteratorHelper(i),
                    _step4;

                try {
                  for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {
                    var _e14 = _step4.value;
                    "upload successful" == _e14.status && s.push(_e14.name);
                  }
                } catch (err) {
                  _iterator4.e(err);
                } finally {
                  _iterator4.f();
                }

                return n.val(s.join(", ")), {
                  id: e,
                  oldStatus: r,
                  newStatus: o
                };
              }
            },
            template: this.fineTemplate
          }, this.classConfig);
          t.fineUploader(r);
        }
      }], [{
        key: "definition",
        get: function get() {
          return {
            i18n: {
              "default": "Fine Uploader"
            }
          };
        }
      }]);

      return b;
    }(g);

    function y(e, t) {
      if (null == e) return {};

      var n,
          r,
          o = function (e, t) {
        if (null == e) return {};
        var n,
            r,
            o = {},
            i = Object.keys(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || (o[n] = e[n]);
        }

        return o;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]);
        }
      }

      return o;
    }

    g.register("file", g, "file"), g.register("fineuploader", b, "file");

    var v = /*#__PURE__*/function (_o$a7) {
      _inherits(v, _o$a7);

      var _super9 = _createSuper(v);

      function v() {
        _classCallCheck(this, v);

        return _super9.apply(this, arguments);
      }

      _createClass(v, [{
        key: "build",
        value: function build() {
          var e = this.config,
              _e$value = e.value,
              t = _e$value === void 0 ? "" : _e$value,
              n = y(e, ["value"]);
          return this.field = this.markup("textarea", this.parsedHtml(t), n), this.field;
        }
      }, {
        key: "onRender",
        value: function onRender() {
          this.config.userData && e("#" + this.config.name).val(this.config.userData[0]);
        }
      }, {
        key: "on",
        value: function on(t) {
          var _this6 = this;

          return "prerender" == t && this.preview ? function (t) {
            _this6.field && (t = _this6.field), e(t).on("mousedown", function (e) {
              e.stopPropagation();
            });
          } : _get(_getPrototypeOf(v.prototype), "on", this).call(this, t);
        }
      }], [{
        key: "definition",
        get: function get() {
          return {
            mi18n: {
              textarea: "textArea"
            }
          };
        }
      }]);

      return v;
    }(o.a);

    function x(e, t) {
      if (null == e) return {};

      var n,
          r,
          o = function (e, t) {
        if (null == e) return {};
        var n,
            r,
            o = {},
            i = Object.keys(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || (o[n] = e[n]);
        }

        return o;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]);
        }
      }

      return o;
    }

    o.a.register("textarea", v), o.a.register("textarea", v, "textarea");

    var w = /*#__PURE__*/function (_v) {
      _inherits(w, _v);

      var _super10 = _createSuper(w);

      function w() {
        _classCallCheck(this, w);

        return _super10.apply(this, arguments);
      }

      _createClass(w, [{
        key: "configure",
        value: function configure() {
          if (this.js = ["https://cdn.tinymce.com/4/tinymce.min.js"], this.classConfig.js) {
            var _e15 = this.classConfig.js;
            Array.isArray(_e15) || (_e15 = new Array(_e15)), this.js.concat(_e15), delete this.classConfig.js;
          }

          this.classConfig.css && (this.css = this.classConfig.css), this.editorOptions = {
            height: 250,
            paste_data_images: !0,
            plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste code"],
            toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | table"
          };
        }
      }, {
        key: "build",
        value: function build() {
          var e = this.config,
              _e$value2 = e.value,
              t = _e$value2 === void 0 ? "" : _e$value2,
              n = x(e, ["value"]);
          return this.field = this.markup("textarea", this.parsedHtml(t), n), n.disabled && (this.editorOptions.readonly = !0), this.field;
        }
      }, {
        key: "onRender",
        value: function onRender(e) {
          window.tinymce.editors[this.id] && window.tinymce.editors[this.id].remove();
          var t = jQuery.extend(this.editorOptions, this.classConfig);
          return t.target = this.field, window.tinymce.init(t), this.config.userData && window.tinymce.editors[this.id].setContent(this.parsedHtml(this.config.userData[0])), e;
        }
      }]);

      return w;
    }(v);

    function O(e, t) {
      if (null == e) return {};

      var n,
          r,
          o = function (e, t) {
        if (null == e) return {};
        var n,
            r,
            o = {},
            i = Object.keys(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || (o[n] = e[n]);
        }

        return o;
      }(e, t);

      if (Object.getOwnPropertySymbols) {
        var i = Object.getOwnPropertySymbols(e);

        for (r = 0; r < i.length; r++) {
          n = i[r], t.indexOf(n) >= 0 || Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]);
        }
      }

      return o;
    }

    function q(e, t) {
      var n = Object.keys(e);

      if (Object.getOwnPropertySymbols) {
        var r = Object.getOwnPropertySymbols(e);
        t && (r = r.filter(function (t) {
          return Object.getOwnPropertyDescriptor(e, t).enumerable;
        })), n.push.apply(n, r);
      }

      return n;
    }

    function j(e) {
      for (var t = 1; t < arguments.length; t++) {
        var n = null != arguments[t] ? arguments[t] : {};
        t % 2 ? q(Object(n), !0).forEach(function (t) {
          k(e, t, n[t]);
        }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n)) : q(Object(n)).forEach(function (t) {
          Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(n, t));
        });
      }

      return e;
    }

    function k(e, t, n) {
      return t in e ? Object.defineProperty(e, t, {
        value: n,
        enumerable: !0,
        configurable: !0,
        writable: !0
      }) : e[t] = n, e;
    }

    v.register("tinymce", w, "textarea");

    var C = /*#__PURE__*/function (_v2) {
      _inherits(C, _v2);

      var _super11 = _createSuper(C);

      function C() {
        _classCallCheck(this, C);

        return _super11.apply(this, arguments);
      }

      _createClass(C, [{
        key: "configure",
        value: function configure() {
          var e = {
            modules: {
              toolbar: [[{
                header: [1, 2, !1]
              }], ["bold", "italic", "underline"], ["code-block"]]
            },
            placeholder: this.config.placeholder || "",
            theme: "snow"
          },
              _d$f$splitObject = d.f.splitObject(this.classConfig, ["css", "js"]),
              _d$f$splitObject2 = _slicedToArray(_d$f$splitObject, 2),
              t = _d$f$splitObject2[0],
              n = _d$f$splitObject2[1];

          Object.assign(this, j(j({}, {
            js: "//cdn.quilljs.com/1.2.4/quill.js",
            css: "//cdn.quilljs.com/1.2.4/quill.snow.css"
          }), t)), this.editorConfig = j(j({}, e), n);
        }
      }, {
        key: "build",
        value: function build() {
          var e = this.config,
              _e$value3 = e.value,
              t = _e$value3 === void 0 ? "" : _e$value3,
              n = O(e, ["value"]);
          return this.field = this.markup("div", null, n), this.field;
        }
      }, {
        key: "onRender",
        value: function onRender(e) {
          var t = this.config.value || "",
              n = window.Quill["import"]("delta");
          window.fbEditors.quill[this.id] = {};
          var r = window.fbEditors.quill[this.id];
          return r.instance = new window.Quill(this.field, this.editorConfig), r.data = new n(), t && r.instance.setContents(window.JSON.parse(this.parsedHtml(t))), r.instance.on("text-change", function (e) {
            r.data = r.data.compose(e);
          }), e;
        }
      }]);

      return C;
    }(v);

    v.register("quill", C, "textarea");
    c.a;
  },,,,,,,,,,,,,,,,,, function (t, n, r) {
    r.r(n);
    var o = r(2),
        i = r.n(o),
        s = r(0),
        a = r(4),
        l = r(5),
        c = r(10),
        u = r(1),
        d = (r(12), r(6)),
        p = r(3);
    r(31);

    var f = /*#__PURE__*/function () {
      function f() {
        var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

        _classCallCheck(this, f);

        var t = {
          layout: c.a,
          layoutTemplates: {},
          controls: {},
          controlConfig: {},
          container: !1,
          dataType: "json",
          formData: !1,
          i18n: Object.assign({}, p.b),
          messages: {
            formRendered: "Form Rendered",
            noFormData: "No form data.",
            other: "Other",
            selectColor: "Select Color",
            invalidControl: "Invalid control"
          },
          onRender: function onRender() {},
          render: !0,
          templates: {},
          notify: {
            error: function error(e) {
              console.log(e);
            },
            success: function success(e) {
              console.log(e);
            },
            warning: function warning(e) {
              console.warn(e);
            }
          }
        };
        if (this.options = jQuery.extend(!0, t, e), this.instanceContainers = [], i.a.current || i.a.init(this.options.i18n), !this.options.formData) return !1;
        this.options.formData = this.parseFormData(this.options.formData), u.a.controlConfig = e.controlConfig || {}, u.a.loadCustom(e.controls), Object.keys(this.options.templates).length && d.a.register(this.options.templates), "function" != typeof Element.prototype.appendFormFields && (Element.prototype.appendFormFields = function (e) {
          var _this7 = this;

          Array.isArray(e) || (e = [e]);
          var t = s.f.markup("div", e, {
            className: "rendered-form rendered-form-parent"
          });
          this.appendChild(t), e.forEach(function (e) {
            var _ref6 = e.className.match(/row-([^\s]+)/) || [],
                _ref7 = _slicedToArray(_ref6, 1),
                n = _ref7[0];

            if (n) {
              var _r10 = _this7.id ? "".concat(_this7.id, "-row-").concat(n) : "row-" + n;

              var _o6 = document.getElementById(_r10);

              _o6 || (_o6 = s.f.markup("div", null, {
                id: _r10,
                className: "row form-inline"
              }), t.appendChild(_o6)), _o6.appendChild(e);
            } else t.appendChild(e);

            e.dispatchEvent(l.a.fieldRendered);
          });
        }), "function" != typeof Element.prototype.emptyContainer && (Element.prototype.emptyContainer = function () {
          var e = this;

          for (; e.lastChild;) {
            e.removeChild(e.lastChild);
          }
        });
      }

      _createClass(f, [{
        key: "santizeField",
        value: function santizeField(e, t) {
          var n = Object.assign({}, e);
          return t && (n.id = e.id && "".concat(e.id, "-").concat(t), n.name = e.name && "".concat(e.name, "-").concat(t)), n.className = Array.isArray(e.className) ? s.f.unique(e.className.join(" ").split(" ")).join(" ") : e.className || e["class"] || null, delete n["class"], e.values && (e.values = e.values.map(function (e) {
            return s.f.trimObj(e);
          })), s.f.trimObj(n);
        }
      }, {
        key: "getElement",
        value: function getElement(e) {
          return (e = this.options.container || e) instanceof jQuery ? e = e[0] : "string" == typeof e && (e = document.querySelector(e)), e;
        }
      }, {
        key: "render",
        value: function render() {
          var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
          var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
          var n = this,
              r = this.options;
          e = this.getElement(e);
          var o = [];

          if (r.formData) {
            var _i12 = new r.layout(r.layoutTemplates);

            for (var _e16 = 0; _e16 < r.formData.length; _e16++) {
              var _n17 = r.formData[_e16],
                  _s2 = this.santizeField(_n17, t),
                  _a5 = u.a.getClass(_n17.type, _n17.subtype),
                  _l2 = _i12.build(_a5, _s2);

              o.push(_l2);
            }

            if (e && (this.instanceContainers[t] = e), r.render && e) e.emptyContainer(), e.appendFormFields(o), r.onRender && r.onRender(), r.notify.success(r.messages.formRendered);else {
              var _e17 = function _e17(e) {
                return e.map(function (e) {
                  return e.innerHTML;
                }).join("");
              };

              n.markup = _e17(o);
            }
          } else {
            var _e18 = s.f.markup("div", r.messages.noFormData, {
              className: "no-form-data"
            });

            o.push(_e18), r.notify.error(r.messages.noFormData);
          }

          if (r.disableInjectedStyle) {
            var _e19 = document.getElementsByClassName("formBuilder-injected-style");

            Object(s.i)(_e19, function (t) {
              return Object(a.f)(_e19[t]);
            });
          }

          return n;
        }
      }, {
        key: "renderControl",
        value: function renderControl() {
          var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
          var t = this.options,
              n = t.formData;
          if (!n || Array.isArray(n)) throw new Error("To render a single element, please specify a single object of formData for the field in question");
          var r = this.santizeField(n),
              o = new t.layout(),
              i = u.a.getClass(n.type, n.subtype),
              s = t.forceTemplate || "hidden",
              a = o.build(i, r, s);
          return e.appendFormFields(a), t.notify.success(t.messages.formRendered), this;
        }
      }, {
        key: "userData",
        get: function get() {
          var t = this.options.formData.slice();
          return t.filter(function (e) {
            return "tinymce" === e.subtype;
          }).forEach(function (e) {
            return window.tinymce.get(e.name).save();
          }), this.instanceContainers.forEach(function (n) {
            var r = e("select, input, textarea", n).serializeArray().reduce(function (e, _ref8) {
              var t = _ref8.name,
                  n = _ref8.value;
              return e[t = t.replace("[]", "")] ? e[t].push(n) : e[t] = [n], e;
            }, {}),
                o = t.length;

            for (var _e20 = 0; _e20 < o; _e20++) {
              var _n18 = t[_e20];
              void 0 !== _n18.name && (_n18.disabled || (_n18.userData = r[_n18.name]));
            }
          }), t;
        }
      }, {
        key: "clear",
        value: function clear() {
          var _this8 = this;

          this.instanceContainers.forEach(function (e) {
            _this8.options.formData.slice().filter(function (e) {
              return "tinymce" === e.subtype;
            }).forEach(function (e) {
              return window.tinymce.get(e.name).setContent("");
            }), e.querySelectorAll("input, select, textarea").forEach(function (e) {
              ["checkbox", "radio"].includes(e.type) ? e.checked = !1 : e.value = "";
            });
          });
        }
      }, {
        key: "parseFormData",
        value: function parseFormData(e) {
          return "object" != _typeof(e) && (e = {
            xml: function xml(e) {
              return Object(s.t)(e);
            },
            json: function json(e) {
              return window.JSON.parse(e);
            }
          }[this.options.dataType](e) || !1), e;
        }
      }]);

      return f;
    }();

    !function () {
      var e;
      var t = {
        init: function init(n) {
          var r = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
          return e = n, t.instance = new f(r), n.each(function (e) {
            return t.instance.render(n[e], e);
          }), t.instance;
        },
        userData: function userData() {
          return t.instance && t.instance.userData;
        },
        clear: function clear() {
          return t.instance && t.instance.clear();
        },
        setData: function setData(e) {
          if (t.instance) {
            var _n19 = t.instance;
            _n19.options.formData = _n19.parseFormData(e);
          }
        },
        render: function render(n) {
          var r = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

          if (t.instance) {
            var _o7 = t.instance;
            _o7.options = Object.assign({}, _o7.options, r, {
              formData: _o7.parseFormData(n)
            }), e.each(function (n) {
              return t.instance.render(e[n], n);
            });
          }
        },
        html: function html() {
          return e.map(function (t) {
            return e[t];
          }).html();
        }
      };
      jQuery.fn.formRender = function () {
        var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

        for (var _len2 = arguments.length, n = new Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {
          n[_key2 - 1] = arguments[_key2];
        }

        if (t[e]) return t[e].apply(this, n);
        {
          var _n20 = t.init(this, e);

          return Object.assign(t, _n20), _n20;
        }
      }, jQuery.fn.controlRender = function (e) {
        var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
        t.formData = e, t.dataType = "string" == typeof e ? "json" : "xml";
        var n = new f(t),
            r = this;
        return r.each(function (e) {
          return n.renderControl(r[e]);
        }), r;
      };
    }(jQuery);
  }, function (e, t, n) {
    var r = n(9),
        o = n(32);
    "string" == typeof (o = o.__esModule ? o["default"] : o) && (o = [[e.i, o, ""]]);
    var i = {
      attributes: {
        "class": "formBuilder-injected-style"
      },
      insert: "head",
      singleton: !1
    };
    r(o, i);
    e.exports = o.locals || {};
  }, function (e, t, n) {
    n.r(t);
    var r = n(7),
        o = n.n(r)()(!1);
    o.push([e.i, ".rendered-form *{box-sizing:border-box}.rendered-form button,.rendered-form input,.rendered-form select,.rendered-form textarea{font-family:inherit;font-size:inherit;line-height:inherit}.rendered-form input{line-height:normal}.rendered-form textarea{overflow:auto}.rendered-form button,.rendered-form input,.rendered-form select,.rendered-form textarea{font-family:inherit;font-size:inherit;line-height:inherit}.rendered-form .btn-group{position:relative;display:inline-block;vertical-align:middle}.rendered-form .btn-group>.btn{position:relative;float:left}.rendered-form .btn-group>.btn:first-child:not(:last-child):not(.dropdown-toggle){border-top-right-radius:0;border-bottom-right-radius:0}.rendered-form .btn-group>.btn:not(:first-child):not(:last-child):not(.dropdown-toggle){border-radius:0}.rendered-form .btn-group .btn+.btn,.rendered-form .btn-group .btn+.btn-group,.rendered-form .btn-group .btn-group+.btn,.rendered-form .btn-group .btn-group+.btn-group{margin-left:-1px}.rendered-form .btn-group>.btn:last-child:not(:first-child),.rendered-form .btn-group>.dropdown-toggle:not(:first-child),.rendered-form .btn-group .input-group .form-control:last-child,.rendered-form .btn-group .input-group-addon:last-child,.rendered-form .btn-group .input-group-btn:first-child>.btn-group:not(:first-child)>.btn,.rendered-form .btn-group .input-group-btn:first-child>.btn:not(:first-child),.rendered-form .btn-group .input-group-btn:last-child>.btn,.rendered-form .btn-group .input-group-btn:last-child>.btn-group>.btn,.rendered-form .btn-group .input-group-btn:last-child>.dropdown-toggle{border-top-left-radius:0;border-bottom-left-radius:0}.rendered-form .btn-group>.btn.active,.rendered-form .btn-group>.btn:active,.rendered-form .btn-group>.btn:focus,.rendered-form .btn-group>.btn:hover{z-index:2}.rendered-form .btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;user-select:none;background-image:none;border-radius:4px}.rendered-form .btn.btn-lg{padding:10px 16px;font-size:18px;line-height:1.3333333;border-radius:6px}.rendered-form .btn.btn-sm{padding:5px 10px;font-size:12px;line-height:1.5;border-radius:3px}.rendered-form .btn.btn-xs{padding:1px 5px;font-size:12px;line-height:1.5;border-radius:3px}.rendered-form .btn.active,.rendered-form .btn.btn-active,.rendered-form .btn:active{background-image:none}.rendered-form .input-group .form-control:last-child,.rendered-form .input-group-addon:last-child,.rendered-form .input-group-btn:first-child>.btn-group:not(:first-child)>.btn,.rendered-form .input-group-btn:first-child>.btn:not(:first-child),.rendered-form .input-group-btn:last-child>.btn,.rendered-form .input-group-btn:last-child>.btn-group>.btn,.rendered-form .input-group-btn:last-child>.dropdown-toggle{border-top-left-radius:0;border-bottom-left-radius:0}.rendered-form .input-group .form-control,.rendered-form .input-group-addon,.rendered-form .input-group-btn{display:table-cell}.rendered-form .input-group-lg>.form-control,.rendered-form .input-group-lg>.input-group-addon,.rendered-form .input-group-lg>.input-group-btn>.btn{height:46px;padding:10px 16px;font-size:18px;line-height:1.3333333}.rendered-form .input-group{position:relative;display:table;border-collapse:separate}.rendered-form .input-group .form-control{position:relative;z-index:2;float:left;width:100%;margin-bottom:0}.rendered-form .form-control,.rendered-form output{font-size:14px;line-height:1.42857143;display:block}.rendered-form textarea.form-control{height:auto}.rendered-form .form-control{height:34px;display:block;width:100%;padding:6px 12px;font-size:14px;line-height:1.42857143;border-radius:4px}.rendered-form .form-control:focus{outline:0;box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(102,175,233,0.6)}.rendered-form .form-group{margin-left:0px;margin-bottom:15px}.rendered-form .btn,.rendered-form .form-control{background-image:none}.rendered-form .pull-right{float:right}.rendered-form .pull-left{float:left}.rendered-form .formbuilder-required,.rendered-form .required-asterisk{color:#c10000}.rendered-form .formbuilder-checkbox-group input[type='checkbox'],.rendered-form .formbuilder-checkbox-group input[type='radio'],.rendered-form .formbuilder-radio-group input[type='checkbox'],.rendered-form .formbuilder-radio-group input[type='radio']{margin:0 4px 0 0}.rendered-form .formbuilder-checkbox-inline,.rendered-form .formbuilder-radio-inline{margin-right:8px;display:inline-block;vertical-align:middle;padding-left:0}.rendered-form .formbuilder-checkbox-inline label input[type='text'],.rendered-form .formbuilder-radio-inline label input[type='text']{margin-top:0}.rendered-form .formbuilder-checkbox-inline:first-child,.rendered-form .formbuilder-radio-inline:first-child{padding-left:0}.rendered-form .formbuilder-autocomplete-list{background-color:#fff;display:none;list-style:none;padding:0;border:1px solid #ccc;border-width:0 1px 1px;position:absolute;z-index:20;max-height:200px;overflow-y:auto}.rendered-form .formbuilder-autocomplete-list li{display:none;cursor:default;padding:5px;margin:0;transition:background-color 200ms ease-in-out}.rendered-form .formbuilder-autocomplete-list li:hover,.rendered-form .formbuilder-autocomplete-list li.active-option{background-color:rgba(0,0,0,0.075)}.rendered-form .kc-toggle{padding-left:0 !important}.rendered-form .kc-toggle span{position:relative;width:48px;height:24px;background:#e6e6e6;display:inline-block;border-radius:4px;border:1px solid #ccc;padding:2px;overflow:hidden;float:left;margin-right:5px;will-change:transform}.rendered-form .kc-toggle span::after,.rendered-form .kc-toggle span::before{position:absolute;display:inline-block;top:0}.rendered-form .kc-toggle span::after{position:relative;content:'';width:50%;height:100%;left:0;border-radius:3px;background:linear-gradient(to bottom, #fff 0%, #ccc 100%);border:1px solid #999;transition:transform 100ms;transform:translateX(0)}.rendered-form .kc-toggle span::before{border-radius:4px;top:2px;left:2px;content:'';width:calc(100% - 4px);height:18px;box-shadow:0 0 1px 1px #b3b3b3 inset;background-color:transparent}.rendered-form .kc-toggle input{height:0;overflow:hidden;width:0;opacity:0;pointer-events:none;margin:0}.rendered-form .kc-toggle input:checked+span::after{transform:translateX(100%)}.rendered-form .kc-toggle input:checked+span::before{background-color:#6fc665}.rendered-form label{font-weight:normal}.form-group .formbuilder-required{color:#c10000}.other-option:checked+label input{display:inline-block}.other-val{margin-left:5px;display:none}*[tooltip]{position:relative}*[tooltip]:hover::after{background:rgba(0,0,0,0.9);border-radius:5px 5px 5px 0;bottom:23px;color:#fff;content:attr(tooltip);padding:10px 5px;position:absolute;z-index:98;left:2px;width:230px;text-shadow:none;font-size:12px;line-height:1.5em}*[tooltip]:hover::before{border:solid;border-color:#222 transparent;border-width:6px 6px 0;bottom:17px;content:'';left:2px;position:absolute;z-index:99}.tooltip-element{color:#fff;background:#000;width:16px;height:16px;border-radius:8px;display:inline-block;text-align:center;line-height:16px;margin:0 5px;font-size:12px}.form-control.number{width:auto}.form-control[type='color']{width:60px;padding:2px;display:inline-block}.form-control[multiple]{height:auto}\n", ""]), t["default"] = o;
  }]);
}(jQuery);

/***/ }),

/***/ "./resources/js/form_builder/jquery-ui.js":
/*!************************************************!*\
  !*** ./resources/js/form_builder/jquery-ui.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*! jQuery UI - v1.11.2 - 2014-10-16
* http://jqueryui.com
* Includes: core.js, widget.js, mouse.js, position.js, accordion.js, autocomplete.js, button.js, datepicker.js, dialog.js, draggable.js, droppable.js, effect.js, effect-blind.js, effect-bounce.js, effect-clip.js, effect-drop.js, effect-explode.js, effect-fade.js, effect-fold.js, effect-highlight.js, effect-puff.js, effect-pulsate.js, effect-scale.js, effect-shake.js, effect-size.js, effect-slide.js, effect-transfer.js, menu.js, progressbar.js, resizable.js, selectable.js, selectmenu.js, slider.js, sortable.js, spinner.js, tabs.js, tooltip.js
* Copyright 2014 jQuery Foundation and other contributors; Licensed MIT */
(function (e) {
   true ? !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")], __WEBPACK_AMD_DEFINE_FACTORY__ = (e),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : undefined;
})(function (e) {
  function t(t, s) {
    var n,
        a,
        o,
        r = t.nodeName.toLowerCase();
    return "area" === r ? (n = t.parentNode, a = n.name, t.href && a && "map" === n.nodeName.toLowerCase() ? (o = e("img[usemap='#" + a + "']")[0], !!o && i(o)) : !1) : (/input|select|textarea|button|object/.test(r) ? !t.disabled : "a" === r ? t.href || s : s) && i(t);
  }

  function i(t) {
    return e.expr.filters.visible(t) && !e(t).parents().addBack().filter(function () {
      return "hidden" === e.css(this, "visibility");
    }).length;
  }

  function s(e) {
    for (var t, i; e.length && e[0] !== document;) {
      if (t = e.css("position"), ("absolute" === t || "relative" === t || "fixed" === t) && (i = parseInt(e.css("zIndex"), 10), !isNaN(i) && 0 !== i)) return i;
      e = e.parent();
    }

    return 0;
  }

  function n() {
    this._curInst = null, this._keyEvent = !1, this._disabledInputs = [], this._datepickerShowing = !1, this._inDialog = !1, this._mainDivId = "ui-datepicker-div", this._inlineClass = "ui-datepicker-inline", this._appendClass = "ui-datepicker-append", this._triggerClass = "ui-datepicker-trigger", this._dialogClass = "ui-datepicker-dialog", this._disableClass = "ui-datepicker-disabled", this._unselectableClass = "ui-datepicker-unselectable", this._currentClass = "ui-datepicker-current-day", this._dayOverClass = "ui-datepicker-days-cell-over", this.regional = [], this.regional[""] = {
      closeText: "Done",
      prevText: "Prev",
      nextText: "Next",
      currentText: "Today",
      monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
      monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
      dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
      weekHeader: "Wk",
      dateFormat: "mm/dd/yy",
      firstDay: 0,
      isRTL: !1,
      showMonthAfterYear: !1,
      yearSuffix: ""
    }, this._defaults = {
      showOn: "focus",
      showAnim: "fadeIn",
      showOptions: {},
      defaultDate: null,
      appendText: "",
      buttonText: "...",
      buttonImage: "",
      buttonImageOnly: !1,
      hideIfNoPrevNext: !1,
      navigationAsDateFormat: !1,
      gotoCurrent: !1,
      changeMonth: !1,
      changeYear: !1,
      yearRange: "c-10:c+10",
      showOtherMonths: !1,
      selectOtherMonths: !1,
      showWeek: !1,
      calculateWeek: this.iso8601Week,
      shortYearCutoff: "+10",
      minDate: null,
      maxDate: null,
      duration: "fast",
      beforeShowDay: null,
      beforeShow: null,
      onSelect: null,
      onChangeMonthYear: null,
      onClose: null,
      numberOfMonths: 1,
      showCurrentAtPos: 0,
      stepMonths: 1,
      stepBigMonths: 12,
      altField: "",
      altFormat: "",
      constrainInput: !0,
      showButtonPanel: !1,
      autoSize: !1,
      disabled: !1
    }, e.extend(this._defaults, this.regional[""]), this.regional.en = e.extend(!0, {}, this.regional[""]), this.regional["en-US"] = e.extend(!0, {}, this.regional.en), this.dpDiv = a(e("<div id='" + this._mainDivId + "' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"));
  }

  function a(t) {
    var i = "button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";
    return t.delegate(i, "mouseout", function () {
      e(this).removeClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && e(this).removeClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && e(this).removeClass("ui-datepicker-next-hover");
    }).delegate(i, "mouseover", o);
  }

  function o() {
    e.datepicker._isDisabledDatepicker(v.inline ? v.dpDiv.parent()[0] : v.input[0]) || (e(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"), e(this).addClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && e(this).addClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && e(this).addClass("ui-datepicker-next-hover"));
  }

  function r(t, i) {
    e.extend(t, i);

    for (var s in i) {
      null == i[s] && (t[s] = i[s]);
    }

    return t;
  }

  function h(e) {
    return function () {
      var t = this.element.val();
      e.apply(this, arguments), this._refresh(), t !== this.element.val() && this._trigger("change");
    };
  }

  e.ui = e.ui || {}, e.extend(e.ui, {
    version: "1.11.2",
    keyCode: {
      BACKSPACE: 8,
      COMMA: 188,
      DELETE: 46,
      DOWN: 40,
      END: 35,
      ENTER: 13,
      ESCAPE: 27,
      HOME: 36,
      LEFT: 37,
      PAGE_DOWN: 34,
      PAGE_UP: 33,
      PERIOD: 190,
      RIGHT: 39,
      SPACE: 32,
      TAB: 9,
      UP: 38
    }
  }), e.fn.extend({
    scrollParent: function scrollParent(t) {
      var i = this.css("position"),
          s = "absolute" === i,
          n = t ? /(auto|scroll|hidden)/ : /(auto|scroll)/,
          a = this.parents().filter(function () {
        var t = e(this);
        return s && "static" === t.css("position") ? !1 : n.test(t.css("overflow") + t.css("overflow-y") + t.css("overflow-x"));
      }).eq(0);
      return "fixed" !== i && a.length ? a : e(this[0].ownerDocument || document);
    },
    uniqueId: function () {
      var e = 0;
      return function () {
        return this.each(function () {
          this.id || (this.id = "ui-id-" + ++e);
        });
      };
    }(),
    removeUniqueId: function removeUniqueId() {
      return this.each(function () {
        /^ui-id-\d+$/.test(this.id) && e(this).removeAttr("id");
      });
    }
  }), e.extend(e.expr[":"], {
    data: e.expr.createPseudo ? e.expr.createPseudo(function (t) {
      return function (i) {
        return !!e.data(i, t);
      };
    }) : function (t, i, s) {
      return !!e.data(t, s[3]);
    },
    focusable: function focusable(i) {
      return t(i, !isNaN(e.attr(i, "tabindex")));
    },
    tabbable: function tabbable(i) {
      var s = e.attr(i, "tabindex"),
          n = isNaN(s);
      return (n || s >= 0) && t(i, !n);
    }
  }), e("<a>").outerWidth(1).jquery || e.each(["Width", "Height"], function (t, i) {
    function s(t, i, s, a) {
      return e.each(n, function () {
        i -= parseFloat(e.css(t, "padding" + this)) || 0, s && (i -= parseFloat(e.css(t, "border" + this + "Width")) || 0), a && (i -= parseFloat(e.css(t, "margin" + this)) || 0);
      }), i;
    }

    var n = "Width" === i ? ["Left", "Right"] : ["Top", "Bottom"],
        a = i.toLowerCase(),
        o = {
      innerWidth: e.fn.innerWidth,
      innerHeight: e.fn.innerHeight,
      outerWidth: e.fn.outerWidth,
      outerHeight: e.fn.outerHeight
    };
    e.fn["inner" + i] = function (t) {
      return void 0 === t ? o["inner" + i].call(this) : this.each(function () {
        e(this).css(a, s(this, t) + "px");
      });
    }, e.fn["outer" + i] = function (t, n) {
      return "number" != typeof t ? o["outer" + i].call(this, t) : this.each(function () {
        e(this).css(a, s(this, t, !0, n) + "px");
      });
    };
  }), e.fn.addBack || (e.fn.addBack = function (e) {
    return this.add(null == e ? this.prevObject : this.prevObject.filter(e));
  }), e("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (e.fn.removeData = function (t) {
    return function (i) {
      return arguments.length ? t.call(this, e.camelCase(i)) : t.call(this);
    };
  }(e.fn.removeData)), e.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()), e.fn.extend({
    focus: function (t) {
      return function (i, s) {
        return "number" == typeof i ? this.each(function () {
          var t = this;
          setTimeout(function () {
            e(t).focus(), s && s.call(t);
          }, i);
        }) : t.apply(this, arguments);
      };
    }(e.fn.focus),
    disableSelection: function () {
      var e = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown";
      return function () {
        return this.bind(e + ".ui-disableSelection", function (e) {
          e.preventDefault();
        });
      };
    }(),
    enableSelection: function enableSelection() {
      return this.unbind(".ui-disableSelection");
    },
    zIndex: function zIndex(t) {
      if (void 0 !== t) return this.css("zIndex", t);
      if (this.length) for (var i, s, n = e(this[0]); n.length && n[0] !== document;) {
        if (i = n.css("position"), ("absolute" === i || "relative" === i || "fixed" === i) && (s = parseInt(n.css("zIndex"), 10), !isNaN(s) && 0 !== s)) return s;
        n = n.parent();
      }
      return 0;
    }
  }), e.ui.plugin = {
    add: function add(t, i, s) {
      var n,
          a = e.ui[t].prototype;

      for (n in s) {
        a.plugins[n] = a.plugins[n] || [], a.plugins[n].push([i, s[n]]);
      }
    },
    call: function call(e, t, i, s) {
      var n,
          a = e.plugins[t];
      if (a && (s || e.element[0].parentNode && 11 !== e.element[0].parentNode.nodeType)) for (n = 0; a.length > n; n++) {
        e.options[a[n][0]] && a[n][1].apply(e.element, i);
      }
    }
  };
  var l = 0,
      u = Array.prototype.slice;
  e.cleanData = function (t) {
    return function (i) {
      var s, n, a;

      for (a = 0; null != (n = i[a]); a++) {
        try {
          s = e._data(n, "events"), s && s.remove && e(n).triggerHandler("remove");
        } catch (o) {}
      }

      t(i);
    };
  }(e.cleanData), e.widget = function (t, i, s) {
    var n,
        a,
        o,
        r,
        h = {},
        l = t.split(".")[0];
    return t = t.split(".")[1], n = l + "-" + t, s || (s = i, i = e.Widget), e.expr[":"][n.toLowerCase()] = function (t) {
      return !!e.data(t, n);
    }, e[l] = e[l] || {}, a = e[l][t], o = e[l][t] = function (e, t) {
      return this._createWidget ? (arguments.length && this._createWidget(e, t), void 0) : new o(e, t);
    }, e.extend(o, a, {
      version: s.version,
      _proto: e.extend({}, s),
      _childConstructors: []
    }), r = new i(), r.options = e.widget.extend({}, r.options), e.each(s, function (t, s) {
      return e.isFunction(s) ? (h[t] = function () {
        var e = function e() {
          return i.prototype[t].apply(this, arguments);
        },
            n = function n(e) {
          return i.prototype[t].apply(this, e);
        };

        return function () {
          var t,
              i = this._super,
              a = this._superApply;
          return this._super = e, this._superApply = n, t = s.apply(this, arguments), this._super = i, this._superApply = a, t;
        };
      }(), void 0) : (h[t] = s, void 0);
    }), o.prototype = e.widget.extend(r, {
      widgetEventPrefix: a ? r.widgetEventPrefix || t : t
    }, h, {
      constructor: o,
      namespace: l,
      widgetName: t,
      widgetFullName: n
    }), a ? (e.each(a._childConstructors, function (t, i) {
      var s = i.prototype;
      e.widget(s.namespace + "." + s.widgetName, o, i._proto);
    }), delete a._childConstructors) : i._childConstructors.push(o), e.widget.bridge(t, o), o;
  }, e.widget.extend = function (t) {
    for (var i, s, n = u.call(arguments, 1), a = 0, o = n.length; o > a; a++) {
      for (i in n[a]) {
        s = n[a][i], n[a].hasOwnProperty(i) && void 0 !== s && (t[i] = e.isPlainObject(s) ? e.isPlainObject(t[i]) ? e.widget.extend({}, t[i], s) : e.widget.extend({}, s) : s);
      }
    }

    return t;
  }, e.widget.bridge = function (t, i) {
    var s = i.prototype.widgetFullName || t;

    e.fn[t] = function (n) {
      var a = "string" == typeof n,
          o = u.call(arguments, 1),
          r = this;
      return n = !a && o.length ? e.widget.extend.apply(null, [n].concat(o)) : n, a ? this.each(function () {
        var i,
            a = e.data(this, s);
        return "instance" === n ? (r = a, !1) : a ? e.isFunction(a[n]) && "_" !== n.charAt(0) ? (i = a[n].apply(a, o), i !== a && void 0 !== i ? (r = i && i.jquery ? r.pushStack(i.get()) : i, !1) : void 0) : e.error("no such method '" + n + "' for " + t + " widget instance") : e.error("cannot call methods on " + t + " prior to initialization; " + "attempted to call method '" + n + "'");
      }) : this.each(function () {
        var t = e.data(this, s);
        t ? (t.option(n || {}), t._init && t._init()) : e.data(this, s, new i(n, this));
      }), r;
    };
  }, e.Widget = function () {}, e.Widget._childConstructors = [], e.Widget.prototype = {
    widgetName: "widget",
    widgetEventPrefix: "",
    defaultElement: "<div>",
    options: {
      disabled: !1,
      create: null
    },
    _createWidget: function _createWidget(t, i) {
      i = e(i || this.defaultElement || this)[0], this.element = e(i), this.uuid = l++, this.eventNamespace = "." + this.widgetName + this.uuid, this.bindings = e(), this.hoverable = e(), this.focusable = e(), i !== this && (e.data(i, this.widgetFullName, this), this._on(!0, this.element, {
        remove: function remove(e) {
          e.target === i && this.destroy();
        }
      }), this.document = e(i.style ? i.ownerDocument : i.document || i), this.window = e(this.document[0].defaultView || this.document[0].parentWindow)), this.options = e.widget.extend({}, this.options, this._getCreateOptions(), t), this._create(), this._trigger("create", null, this._getCreateEventData()), this._init();
    },
    _getCreateOptions: e.noop,
    _getCreateEventData: e.noop,
    _create: e.noop,
    _init: e.noop,
    destroy: function destroy() {
      this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData(e.camelCase(this.widgetFullName)), this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled " + "ui-state-disabled"), this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus");
    },
    _destroy: e.noop,
    widget: function widget() {
      return this.element;
    },
    option: function option(t, i) {
      var s,
          n,
          a,
          o = t;
      if (0 === arguments.length) return e.widget.extend({}, this.options);
      if ("string" == typeof t) if (o = {}, s = t.split("."), t = s.shift(), s.length) {
        for (n = o[t] = e.widget.extend({}, this.options[t]), a = 0; s.length - 1 > a; a++) {
          n[s[a]] = n[s[a]] || {}, n = n[s[a]];
        }

        if (t = s.pop(), 1 === arguments.length) return void 0 === n[t] ? null : n[t];
        n[t] = i;
      } else {
        if (1 === arguments.length) return void 0 === this.options[t] ? null : this.options[t];
        o[t] = i;
      }
      return this._setOptions(o), this;
    },
    _setOptions: function _setOptions(e) {
      var t;

      for (t in e) {
        this._setOption(t, e[t]);
      }

      return this;
    },
    _setOption: function _setOption(e, t) {
      return this.options[e] = t, "disabled" === e && (this.widget().toggleClass(this.widgetFullName + "-disabled", !!t), t && (this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus"))), this;
    },
    enable: function enable() {
      return this._setOptions({
        disabled: !1
      });
    },
    disable: function disable() {
      return this._setOptions({
        disabled: !0
      });
    },
    _on: function _on(t, i, s) {
      var n,
          a = this;
      "boolean" != typeof t && (s = i, i = t, t = !1), s ? (i = n = e(i), this.bindings = this.bindings.add(i)) : (s = i, i = this.element, n = this.widget()), e.each(s, function (s, o) {
        function r() {
          return t || a.options.disabled !== !0 && !e(this).hasClass("ui-state-disabled") ? ("string" == typeof o ? a[o] : o).apply(a, arguments) : void 0;
        }

        "string" != typeof o && (r.guid = o.guid = o.guid || r.guid || e.guid++);
        var h = s.match(/^([\w:-]*)\s*(.*)$/),
            l = h[1] + a.eventNamespace,
            u = h[2];
        u ? n.delegate(u, l, r) : i.bind(l, r);
      });
    },
    _off: function _off(t, i) {
      i = (i || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, t.unbind(i).undelegate(i), this.bindings = e(this.bindings.not(t).get()), this.focusable = e(this.focusable.not(t).get()), this.hoverable = e(this.hoverable.not(t).get());
    },
    _delay: function _delay(e, t) {
      function i() {
        return ("string" == typeof e ? s[e] : e).apply(s, arguments);
      }

      var s = this;
      return setTimeout(i, t || 0);
    },
    _hoverable: function _hoverable(t) {
      this.hoverable = this.hoverable.add(t), this._on(t, {
        mouseenter: function mouseenter(t) {
          e(t.currentTarget).addClass("ui-state-hover");
        },
        mouseleave: function mouseleave(t) {
          e(t.currentTarget).removeClass("ui-state-hover");
        }
      });
    },
    _focusable: function _focusable(t) {
      this.focusable = this.focusable.add(t), this._on(t, {
        focusin: function focusin(t) {
          e(t.currentTarget).addClass("ui-state-focus");
        },
        focusout: function focusout(t) {
          e(t.currentTarget).removeClass("ui-state-focus");
        }
      });
    },
    _trigger: function _trigger(t, i, s) {
      var n,
          a,
          o = this.options[t];
      if (s = s || {}, i = e.Event(i), i.type = (t === this.widgetEventPrefix ? t : this.widgetEventPrefix + t).toLowerCase(), i.target = this.element[0], a = i.originalEvent) for (n in a) {
        n in i || (i[n] = a[n]);
      }
      return this.element.trigger(i, s), !(e.isFunction(o) && o.apply(this.element[0], [i].concat(s)) === !1 || i.isDefaultPrevented());
    }
  }, e.each({
    show: "fadeIn",
    hide: "fadeOut"
  }, function (t, i) {
    e.Widget.prototype["_" + t] = function (s, n, a) {
      "string" == typeof n && (n = {
        effect: n
      });
      var o,
          r = n ? n === !0 || "number" == typeof n ? i : n.effect || i : t;
      n = n || {}, "number" == typeof n && (n = {
        duration: n
      }), o = !e.isEmptyObject(n), n.complete = a, n.delay && s.delay(n.delay), o && e.effects && e.effects.effect[r] ? s[t](n) : r !== t && s[r] ? s[r](n.duration, n.easing, a) : s.queue(function (i) {
        e(this)[t](), a && a.call(s[0]), i();
      });
    };
  }), e.widget;
  var d = !1;
  e(document).mouseup(function () {
    d = !1;
  }), e.widget("ui.mouse", {
    version: "1.11.2",
    options: {
      cancel: "input,textarea,button,select,option",
      distance: 1,
      delay: 0
    },
    _mouseInit: function _mouseInit() {
      var t = this;
      this.element.bind("mousedown." + this.widgetName, function (e) {
        return t._mouseDown(e);
      }).bind("click." + this.widgetName, function (i) {
        return !0 === e.data(i.target, t.widgetName + ".preventClickEvent") ? (e.removeData(i.target, t.widgetName + ".preventClickEvent"), i.stopImmediatePropagation(), !1) : void 0;
      }), this.started = !1;
    },
    _mouseDestroy: function _mouseDestroy() {
      this.element.unbind("." + this.widgetName), this._mouseMoveDelegate && this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate);
    },
    _mouseDown: function _mouseDown(t) {
      if (!d) {
        this._mouseMoved = !1, this._mouseStarted && this._mouseUp(t), this._mouseDownEvent = t;
        var i = this,
            s = 1 === t.which,
            n = "string" == typeof this.options.cancel && t.target.nodeName ? e(t.target).closest(this.options.cancel).length : !1;
        return s && !n && this._mouseCapture(t) ? (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function () {
          i.mouseDelayMet = !0;
        }, this.options.delay)), this._mouseDistanceMet(t) && this._mouseDelayMet(t) && (this._mouseStarted = this._mouseStart(t) !== !1, !this._mouseStarted) ? (t.preventDefault(), !0) : (!0 === e.data(t.target, this.widgetName + ".preventClickEvent") && e.removeData(t.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function (e) {
          return i._mouseMove(e);
        }, this._mouseUpDelegate = function (e) {
          return i._mouseUp(e);
        }, this.document.bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), t.preventDefault(), d = !0, !0)) : !0;
      }
    },
    _mouseMove: function _mouseMove(t) {
      if (this._mouseMoved) {
        if (e.ui.ie && (!document.documentMode || 9 > document.documentMode) && !t.button) return this._mouseUp(t);
        if (!t.which) return this._mouseUp(t);
      }

      return (t.which || t.button) && (this._mouseMoved = !0), this._mouseStarted ? (this._mouseDrag(t), t.preventDefault()) : (this._mouseDistanceMet(t) && this._mouseDelayMet(t) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, t) !== !1, this._mouseStarted ? this._mouseDrag(t) : this._mouseUp(t)), !this._mouseStarted);
    },
    _mouseUp: function _mouseUp(t) {
      return this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, t.target === this._mouseDownEvent.target && e.data(t.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(t)), d = !1, !1;
    },
    _mouseDistanceMet: function _mouseDistanceMet(e) {
      return Math.max(Math.abs(this._mouseDownEvent.pageX - e.pageX), Math.abs(this._mouseDownEvent.pageY - e.pageY)) >= this.options.distance;
    },
    _mouseDelayMet: function _mouseDelayMet() {
      return this.mouseDelayMet;
    },
    _mouseStart: function _mouseStart() {},
    _mouseDrag: function _mouseDrag() {},
    _mouseStop: function _mouseStop() {},
    _mouseCapture: function _mouseCapture() {
      return !0;
    }
  }), function () {
    function t(e, t, i) {
      return [parseFloat(e[0]) * (p.test(e[0]) ? t / 100 : 1), parseFloat(e[1]) * (p.test(e[1]) ? i / 100 : 1)];
    }

    function i(t, i) {
      return parseInt(e.css(t, i), 10) || 0;
    }

    function s(t) {
      var i = t[0];
      return 9 === i.nodeType ? {
        width: t.width(),
        height: t.height(),
        offset: {
          top: 0,
          left: 0
        }
      } : e.isWindow(i) ? {
        width: t.width(),
        height: t.height(),
        offset: {
          top: t.scrollTop(),
          left: t.scrollLeft()
        }
      } : i.preventDefault ? {
        width: 0,
        height: 0,
        offset: {
          top: i.pageY,
          left: i.pageX
        }
      } : {
        width: t.outerWidth(),
        height: t.outerHeight(),
        offset: t.offset()
      };
    }

    e.ui = e.ui || {};
    var n,
        a,
        o = Math.max,
        r = Math.abs,
        h = Math.round,
        l = /left|center|right/,
        u = /top|center|bottom/,
        d = /[\+\-]\d+(\.[\d]+)?%?/,
        c = /^\w+/,
        p = /%$/,
        f = e.fn.position;
    e.position = {
      scrollbarWidth: function scrollbarWidth() {
        if (void 0 !== n) return n;
        var t,
            i,
            s = e("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
            a = s.children()[0];
        return e("body").append(s), t = a.offsetWidth, s.css("overflow", "scroll"), i = a.offsetWidth, t === i && (i = s[0].clientWidth), s.remove(), n = t - i;
      },
      getScrollInfo: function getScrollInfo(t) {
        var i = t.isWindow || t.isDocument ? "" : t.element.css("overflow-x"),
            s = t.isWindow || t.isDocument ? "" : t.element.css("overflow-y"),
            n = "scroll" === i || "auto" === i && t.width < t.element[0].scrollWidth,
            a = "scroll" === s || "auto" === s && t.height < t.element[0].scrollHeight;
        return {
          width: a ? e.position.scrollbarWidth() : 0,
          height: n ? e.position.scrollbarWidth() : 0
        };
      },
      getWithinInfo: function getWithinInfo(t) {
        var i = e(t || window),
            s = e.isWindow(i[0]),
            n = !!i[0] && 9 === i[0].nodeType;
        return {
          element: i,
          isWindow: s,
          isDocument: n,
          offset: i.offset() || {
            left: 0,
            top: 0
          },
          scrollLeft: i.scrollLeft(),
          scrollTop: i.scrollTop(),
          width: s || n ? i.width() : i.outerWidth(),
          height: s || n ? i.height() : i.outerHeight()
        };
      }
    }, e.fn.position = function (n) {
      if (!n || !n.of) return f.apply(this, arguments);
      n = e.extend({}, n);

      var p,
          m,
          g,
          v,
          y,
          b,
          _ = e(n.of),
          x = e.position.getWithinInfo(n.within),
          w = e.position.getScrollInfo(x),
          k = (n.collision || "flip").split(" "),
          T = {};

      return b = s(_), _[0].preventDefault && (n.at = "left top"), m = b.width, g = b.height, v = b.offset, y = e.extend({}, v), e.each(["my", "at"], function () {
        var e,
            t,
            i = (n[this] || "").split(" ");
        1 === i.length && (i = l.test(i[0]) ? i.concat(["center"]) : u.test(i[0]) ? ["center"].concat(i) : ["center", "center"]), i[0] = l.test(i[0]) ? i[0] : "center", i[1] = u.test(i[1]) ? i[1] : "center", e = d.exec(i[0]), t = d.exec(i[1]), T[this] = [e ? e[0] : 0, t ? t[0] : 0], n[this] = [c.exec(i[0])[0], c.exec(i[1])[0]];
      }), 1 === k.length && (k[1] = k[0]), "right" === n.at[0] ? y.left += m : "center" === n.at[0] && (y.left += m / 2), "bottom" === n.at[1] ? y.top += g : "center" === n.at[1] && (y.top += g / 2), p = t(T.at, m, g), y.left += p[0], y.top += p[1], this.each(function () {
        var s,
            l,
            u = e(this),
            d = u.outerWidth(),
            c = u.outerHeight(),
            f = i(this, "marginLeft"),
            b = i(this, "marginTop"),
            D = d + f + i(this, "marginRight") + w.width,
            S = c + b + i(this, "marginBottom") + w.height,
            M = e.extend({}, y),
            C = t(T.my, u.outerWidth(), u.outerHeight());
        "right" === n.my[0] ? M.left -= d : "center" === n.my[0] && (M.left -= d / 2), "bottom" === n.my[1] ? M.top -= c : "center" === n.my[1] && (M.top -= c / 2), M.left += C[0], M.top += C[1], a || (M.left = h(M.left), M.top = h(M.top)), s = {
          marginLeft: f,
          marginTop: b
        }, e.each(["left", "top"], function (t, i) {
          e.ui.position[k[t]] && e.ui.position[k[t]][i](M, {
            targetWidth: m,
            targetHeight: g,
            elemWidth: d,
            elemHeight: c,
            collisionPosition: s,
            collisionWidth: D,
            collisionHeight: S,
            offset: [p[0] + C[0], p[1] + C[1]],
            my: n.my,
            at: n.at,
            within: x,
            elem: u
          });
        }), n.using && (l = function l(e) {
          var t = v.left - M.left,
              i = t + m - d,
              s = v.top - M.top,
              a = s + g - c,
              h = {
            target: {
              element: _,
              left: v.left,
              top: v.top,
              width: m,
              height: g
            },
            element: {
              element: u,
              left: M.left,
              top: M.top,
              width: d,
              height: c
            },
            horizontal: 0 > i ? "left" : t > 0 ? "right" : "center",
            vertical: 0 > a ? "top" : s > 0 ? "bottom" : "middle"
          };
          d > m && m > r(t + i) && (h.horizontal = "center"), c > g && g > r(s + a) && (h.vertical = "middle"), h.important = o(r(t), r(i)) > o(r(s), r(a)) ? "horizontal" : "vertical", n.using.call(this, e, h);
        }), u.offset(e.extend(M, {
          using: l
        }));
      });
    }, e.ui.position = {
      fit: {
        left: function left(e, t) {
          var i,
              s = t.within,
              n = s.isWindow ? s.scrollLeft : s.offset.left,
              a = s.width,
              r = e.left - t.collisionPosition.marginLeft,
              h = n - r,
              l = r + t.collisionWidth - a - n;
          t.collisionWidth > a ? h > 0 && 0 >= l ? (i = e.left + h + t.collisionWidth - a - n, e.left += h - i) : e.left = l > 0 && 0 >= h ? n : h > l ? n + a - t.collisionWidth : n : h > 0 ? e.left += h : l > 0 ? e.left -= l : e.left = o(e.left - r, e.left);
        },
        top: function top(e, t) {
          var i,
              s = t.within,
              n = s.isWindow ? s.scrollTop : s.offset.top,
              a = t.within.height,
              r = e.top - t.collisionPosition.marginTop,
              h = n - r,
              l = r + t.collisionHeight - a - n;
          t.collisionHeight > a ? h > 0 && 0 >= l ? (i = e.top + h + t.collisionHeight - a - n, e.top += h - i) : e.top = l > 0 && 0 >= h ? n : h > l ? n + a - t.collisionHeight : n : h > 0 ? e.top += h : l > 0 ? e.top -= l : e.top = o(e.top - r, e.top);
        }
      },
      flip: {
        left: function left(e, t) {
          var i,
              s,
              n = t.within,
              a = n.offset.left + n.scrollLeft,
              o = n.width,
              h = n.isWindow ? n.scrollLeft : n.offset.left,
              l = e.left - t.collisionPosition.marginLeft,
              u = l - h,
              d = l + t.collisionWidth - o - h,
              c = "left" === t.my[0] ? -t.elemWidth : "right" === t.my[0] ? t.elemWidth : 0,
              p = "left" === t.at[0] ? t.targetWidth : "right" === t.at[0] ? -t.targetWidth : 0,
              f = -2 * t.offset[0];
          0 > u ? (i = e.left + c + p + f + t.collisionWidth - o - a, (0 > i || r(u) > i) && (e.left += c + p + f)) : d > 0 && (s = e.left - t.collisionPosition.marginLeft + c + p + f - h, (s > 0 || d > r(s)) && (e.left += c + p + f));
        },
        top: function top(e, t) {
          var i,
              s,
              n = t.within,
              a = n.offset.top + n.scrollTop,
              o = n.height,
              h = n.isWindow ? n.scrollTop : n.offset.top,
              l = e.top - t.collisionPosition.marginTop,
              u = l - h,
              d = l + t.collisionHeight - o - h,
              c = "top" === t.my[1],
              p = c ? -t.elemHeight : "bottom" === t.my[1] ? t.elemHeight : 0,
              f = "top" === t.at[1] ? t.targetHeight : "bottom" === t.at[1] ? -t.targetHeight : 0,
              m = -2 * t.offset[1];
          0 > u ? (s = e.top + p + f + m + t.collisionHeight - o - a, e.top + p + f + m > u && (0 > s || r(u) > s) && (e.top += p + f + m)) : d > 0 && (i = e.top - t.collisionPosition.marginTop + p + f + m - h, e.top + p + f + m > d && (i > 0 || d > r(i)) && (e.top += p + f + m));
        }
      },
      flipfit: {
        left: function left() {
          e.ui.position.flip.left.apply(this, arguments), e.ui.position.fit.left.apply(this, arguments);
        },
        top: function top() {
          e.ui.position.flip.top.apply(this, arguments), e.ui.position.fit.top.apply(this, arguments);
        }
      }
    }, function () {
      var t,
          i,
          s,
          n,
          o,
          r = document.getElementsByTagName("body")[0],
          h = document.createElement("div");
      t = document.createElement(r ? "div" : "body"), s = {
        visibility: "hidden",
        width: 0,
        height: 0,
        border: 0,
        margin: 0,
        background: "none"
      }, r && e.extend(s, {
        position: "absolute",
        left: "-1000px",
        top: "-1000px"
      });

      for (o in s) {
        t.style[o] = s[o];
      }

      t.appendChild(h), i = r || document.documentElement, i.insertBefore(t, i.firstChild), h.style.cssText = "position: absolute; left: 10.7432222px;", n = e(h).offset().left, a = n > 10 && 11 > n, t.innerHTML = "", i.removeChild(t);
    }();
  }(), e.ui.position, e.widget("ui.accordion", {
    version: "1.11.2",
    options: {
      active: 0,
      animate: {},
      collapsible: !1,
      event: "click",
      header: "> li > :first-child,> :not(li):even",
      heightStyle: "auto",
      icons: {
        activeHeader: "ui-icon-triangle-1-s",
        header: "ui-icon-triangle-1-e"
      },
      activate: null,
      beforeActivate: null
    },
    hideProps: {
      borderTopWidth: "hide",
      borderBottomWidth: "hide",
      paddingTop: "hide",
      paddingBottom: "hide",
      height: "hide"
    },
    showProps: {
      borderTopWidth: "show",
      borderBottomWidth: "show",
      paddingTop: "show",
      paddingBottom: "show",
      height: "show"
    },
    _create: function _create() {
      var t = this.options;
      this.prevShow = this.prevHide = e(), this.element.addClass("ui-accordion ui-widget ui-helper-reset").attr("role", "tablist"), t.collapsible || t.active !== !1 && null != t.active || (t.active = 0), this._processPanels(), 0 > t.active && (t.active += this.headers.length), this._refresh();
    },
    _getCreateEventData: function _getCreateEventData() {
      return {
        header: this.active,
        panel: this.active.length ? this.active.next() : e()
      };
    },
    _createIcons: function _createIcons() {
      var t = this.options.icons;
      t && (e("<span>").addClass("ui-accordion-header-icon ui-icon " + t.header).prependTo(this.headers), this.active.children(".ui-accordion-header-icon").removeClass(t.header).addClass(t.activeHeader), this.headers.addClass("ui-accordion-icons"));
    },
    _destroyIcons: function _destroyIcons() {
      this.headers.removeClass("ui-accordion-icons").children(".ui-accordion-header-icon").remove();
    },
    _destroy: function _destroy() {
      var e;
      this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role"), this.headers.removeClass("ui-accordion-header ui-accordion-header-active ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-selected").removeAttr("aria-controls").removeAttr("tabIndex").removeUniqueId(), this._destroyIcons(), e = this.headers.next().removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-state-disabled").css("display", "").removeAttr("role").removeAttr("aria-hidden").removeAttr("aria-labelledby").removeUniqueId(), "content" !== this.options.heightStyle && e.css("height", "");
    },
    _setOption: function _setOption(e, t) {
      return "active" === e ? (this._activate(t), void 0) : ("event" === e && (this.options.event && this._off(this.headers, this.options.event), this._setupEvents(t)), this._super(e, t), "collapsible" !== e || t || this.options.active !== !1 || this._activate(0), "icons" === e && (this._destroyIcons(), t && this._createIcons()), "disabled" === e && (this.element.toggleClass("ui-state-disabled", !!t).attr("aria-disabled", t), this.headers.add(this.headers.next()).toggleClass("ui-state-disabled", !!t)), void 0);
    },
    _keydown: function _keydown(t) {
      if (!t.altKey && !t.ctrlKey) {
        var i = e.ui.keyCode,
            s = this.headers.length,
            n = this.headers.index(t.target),
            a = !1;

        switch (t.keyCode) {
          case i.RIGHT:
          case i.DOWN:
            a = this.headers[(n + 1) % s];
            break;

          case i.LEFT:
          case i.UP:
            a = this.headers[(n - 1 + s) % s];
            break;

          case i.SPACE:
          case i.ENTER:
            this._eventHandler(t);

            break;

          case i.HOME:
            a = this.headers[0];
            break;

          case i.END:
            a = this.headers[s - 1];
        }

        a && (e(t.target).attr("tabIndex", -1), e(a).attr("tabIndex", 0), a.focus(), t.preventDefault());
      }
    },
    _panelKeyDown: function _panelKeyDown(t) {
      t.keyCode === e.ui.keyCode.UP && t.ctrlKey && e(t.currentTarget).prev().focus();
    },
    refresh: function refresh() {
      var t = this.options;
      this._processPanels(), t.active === !1 && t.collapsible === !0 || !this.headers.length ? (t.active = !1, this.active = e()) : t.active === !1 ? this._activate(0) : this.active.length && !e.contains(this.element[0], this.active[0]) ? this.headers.length === this.headers.find(".ui-state-disabled").length ? (t.active = !1, this.active = e()) : this._activate(Math.max(0, t.active - 1)) : t.active = this.headers.index(this.active), this._destroyIcons(), this._refresh();
    },
    _processPanels: function _processPanels() {
      var e = this.headers,
          t = this.panels;
      this.headers = this.element.find(this.options.header).addClass("ui-accordion-header ui-state-default ui-corner-all"), this.panels = this.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").filter(":not(.ui-accordion-content-active)").hide(), t && (this._off(e.not(this.headers)), this._off(t.not(this.panels)));
    },
    _refresh: function _refresh() {
      var t,
          i = this.options,
          s = i.heightStyle,
          n = this.element.parent();
      this.active = this._findActive(i.active).addClass("ui-accordion-header-active ui-state-active ui-corner-top").removeClass("ui-corner-all"), this.active.next().addClass("ui-accordion-content-active").show(), this.headers.attr("role", "tab").each(function () {
        var t = e(this),
            i = t.uniqueId().attr("id"),
            s = t.next(),
            n = s.uniqueId().attr("id");
        t.attr("aria-controls", n), s.attr("aria-labelledby", i);
      }).next().attr("role", "tabpanel"), this.headers.not(this.active).attr({
        "aria-selected": "false",
        "aria-expanded": "false",
        tabIndex: -1
      }).next().attr({
        "aria-hidden": "true"
      }).hide(), this.active.length ? this.active.attr({
        "aria-selected": "true",
        "aria-expanded": "true",
        tabIndex: 0
      }).next().attr({
        "aria-hidden": "false"
      }) : this.headers.eq(0).attr("tabIndex", 0), this._createIcons(), this._setupEvents(i.event), "fill" === s ? (t = n.height(), this.element.siblings(":visible").each(function () {
        var i = e(this),
            s = i.css("position");
        "absolute" !== s && "fixed" !== s && (t -= i.outerHeight(!0));
      }), this.headers.each(function () {
        t -= e(this).outerHeight(!0);
      }), this.headers.next().each(function () {
        e(this).height(Math.max(0, t - e(this).innerHeight() + e(this).height()));
      }).css("overflow", "auto")) : "auto" === s && (t = 0, this.headers.next().each(function () {
        t = Math.max(t, e(this).css("height", "").height());
      }).height(t));
    },
    _activate: function _activate(t) {
      var i = this._findActive(t)[0];

      i !== this.active[0] && (i = i || this.active[0], this._eventHandler({
        target: i,
        currentTarget: i,
        preventDefault: e.noop
      }));
    },
    _findActive: function _findActive(t) {
      return "number" == typeof t ? this.headers.eq(t) : e();
    },
    _setupEvents: function _setupEvents(t) {
      var i = {
        keydown: "_keydown"
      };
      t && e.each(t.split(" "), function (e, t) {
        i[t] = "_eventHandler";
      }), this._off(this.headers.add(this.headers.next())), this._on(this.headers, i), this._on(this.headers.next(), {
        keydown: "_panelKeyDown"
      }), this._hoverable(this.headers), this._focusable(this.headers);
    },
    _eventHandler: function _eventHandler(t) {
      var i = this.options,
          s = this.active,
          n = e(t.currentTarget),
          a = n[0] === s[0],
          o = a && i.collapsible,
          r = o ? e() : n.next(),
          h = s.next(),
          l = {
        oldHeader: s,
        oldPanel: h,
        newHeader: o ? e() : n,
        newPanel: r
      };
      t.preventDefault(), a && !i.collapsible || this._trigger("beforeActivate", t, l) === !1 || (i.active = o ? !1 : this.headers.index(n), this.active = a ? e() : n, this._toggle(l), s.removeClass("ui-accordion-header-active ui-state-active"), i.icons && s.children(".ui-accordion-header-icon").removeClass(i.icons.activeHeader).addClass(i.icons.header), a || (n.removeClass("ui-corner-all").addClass("ui-accordion-header-active ui-state-active ui-corner-top"), i.icons && n.children(".ui-accordion-header-icon").removeClass(i.icons.header).addClass(i.icons.activeHeader), n.next().addClass("ui-accordion-content-active")));
    },
    _toggle: function _toggle(t) {
      var i = t.newPanel,
          s = this.prevShow.length ? this.prevShow : t.oldPanel;
      this.prevShow.add(this.prevHide).stop(!0, !0), this.prevShow = i, this.prevHide = s, this.options.animate ? this._animate(i, s, t) : (s.hide(), i.show(), this._toggleComplete(t)), s.attr({
        "aria-hidden": "true"
      }), s.prev().attr("aria-selected", "false"), i.length && s.length ? s.prev().attr({
        tabIndex: -1,
        "aria-expanded": "false"
      }) : i.length && this.headers.filter(function () {
        return 0 === e(this).attr("tabIndex");
      }).attr("tabIndex", -1), i.attr("aria-hidden", "false").prev().attr({
        "aria-selected": "true",
        tabIndex: 0,
        "aria-expanded": "true"
      });
    },
    _animate: function _animate(e, t, i) {
      var s,
          n,
          a,
          o = this,
          r = 0,
          h = e.length && (!t.length || e.index() < t.index()),
          l = this.options.animate || {},
          u = h && l.down || l,
          d = function d() {
        o._toggleComplete(i);
      };

      return "number" == typeof u && (a = u), "string" == typeof u && (n = u), n = n || u.easing || l.easing, a = a || u.duration || l.duration, t.length ? e.length ? (s = e.show().outerHeight(), t.animate(this.hideProps, {
        duration: a,
        easing: n,
        step: function step(e, t) {
          t.now = Math.round(e);
        }
      }), e.hide().animate(this.showProps, {
        duration: a,
        easing: n,
        complete: d,
        step: function step(e, i) {
          i.now = Math.round(e), "height" !== i.prop ? r += i.now : "content" !== o.options.heightStyle && (i.now = Math.round(s - t.outerHeight() - r), r = 0);
        }
      }), void 0) : t.animate(this.hideProps, a, n, d) : e.animate(this.showProps, a, n, d);
    },
    _toggleComplete: function _toggleComplete(e) {
      var t = e.oldPanel;
      t.removeClass("ui-accordion-content-active").prev().removeClass("ui-corner-top").addClass("ui-corner-all"), t.length && (t.parent()[0].className = t.parent()[0].className), this._trigger("activate", null, e);
    }
  }), e.widget("ui.menu", {
    version: "1.11.2",
    defaultElement: "<ul>",
    delay: 300,
    options: {
      icons: {
        submenu: "ui-icon-carat-1-e"
      },
      items: "> *",
      menus: "ul",
      position: {
        my: "left-1 top",
        at: "right top"
      },
      role: "menu",
      blur: null,
      focus: null,
      select: null
    },
    _create: function _create() {
      this.activeMenu = this.element, this.mouseHandled = !1, this.element.uniqueId().addClass("ui-menu ui-widget ui-widget-content").toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length).attr({
        role: this.options.role,
        tabIndex: 0
      }), this.options.disabled && this.element.addClass("ui-state-disabled").attr("aria-disabled", "true"), this._on({
        "mousedown .ui-menu-item": function mousedownUiMenuItem(e) {
          e.preventDefault();
        },
        "click .ui-menu-item": function clickUiMenuItem(t) {
          var i = e(t.target);
          !this.mouseHandled && i.not(".ui-state-disabled").length && (this.select(t), t.isPropagationStopped() || (this.mouseHandled = !0), i.has(".ui-menu").length ? this.expand(t) : !this.element.is(":focus") && e(this.document[0].activeElement).closest(".ui-menu").length && (this.element.trigger("focus", [!0]), this.active && 1 === this.active.parents(".ui-menu").length && clearTimeout(this.timer)));
        },
        "mouseenter .ui-menu-item": function mouseenterUiMenuItem(t) {
          if (!this.previousFilter) {
            var i = e(t.currentTarget);
            i.siblings(".ui-state-active").removeClass("ui-state-active"), this.focus(t, i);
          }
        },
        mouseleave: "collapseAll",
        "mouseleave .ui-menu": "collapseAll",
        focus: function focus(e, t) {
          var i = this.active || this.element.find(this.options.items).eq(0);
          t || this.focus(e, i);
        },
        blur: function blur(t) {
          this._delay(function () {
            e.contains(this.element[0], this.document[0].activeElement) || this.collapseAll(t);
          });
        },
        keydown: "_keydown"
      }), this.refresh(), this._on(this.document, {
        click: function click(e) {
          this._closeOnDocumentClick(e) && this.collapseAll(e), this.mouseHandled = !1;
        }
      });
    },
    _destroy: function _destroy() {
      this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeClass("ui-menu ui-widget ui-widget-content ui-menu-icons ui-front").removeAttr("role").removeAttr("tabIndex").removeAttr("aria-labelledby").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-disabled").removeUniqueId().show(), this.element.find(".ui-menu-item").removeClass("ui-menu-item").removeAttr("role").removeAttr("aria-disabled").removeUniqueId().removeClass("ui-state-hover").removeAttr("tabIndex").removeAttr("role").removeAttr("aria-haspopup").children().each(function () {
        var t = e(this);
        t.data("ui-menu-submenu-carat") && t.remove();
      }), this.element.find(".ui-menu-divider").removeClass("ui-menu-divider ui-widget-content");
    },
    _keydown: function _keydown(t) {
      var i,
          s,
          n,
          a,
          o = !0;

      switch (t.keyCode) {
        case e.ui.keyCode.PAGE_UP:
          this.previousPage(t);
          break;

        case e.ui.keyCode.PAGE_DOWN:
          this.nextPage(t);
          break;

        case e.ui.keyCode.HOME:
          this._move("first", "first", t);

          break;

        case e.ui.keyCode.END:
          this._move("last", "last", t);

          break;

        case e.ui.keyCode.UP:
          this.previous(t);
          break;

        case e.ui.keyCode.DOWN:
          this.next(t);
          break;

        case e.ui.keyCode.LEFT:
          this.collapse(t);
          break;

        case e.ui.keyCode.RIGHT:
          this.active && !this.active.is(".ui-state-disabled") && this.expand(t);
          break;

        case e.ui.keyCode.ENTER:
        case e.ui.keyCode.SPACE:
          this._activate(t);

          break;

        case e.ui.keyCode.ESCAPE:
          this.collapse(t);
          break;

        default:
          o = !1, s = this.previousFilter || "", n = String.fromCharCode(t.keyCode), a = !1, clearTimeout(this.filterTimer), n === s ? a = !0 : n = s + n, i = this._filterMenuItems(n), i = a && -1 !== i.index(this.active.next()) ? this.active.nextAll(".ui-menu-item") : i, i.length || (n = String.fromCharCode(t.keyCode), i = this._filterMenuItems(n)), i.length ? (this.focus(t, i), this.previousFilter = n, this.filterTimer = this._delay(function () {
            delete this.previousFilter;
          }, 1e3)) : delete this.previousFilter;
      }

      o && t.preventDefault();
    },
    _activate: function _activate(e) {
      this.active.is(".ui-state-disabled") || (this.active.is("[aria-haspopup='true']") ? this.expand(e) : this.select(e));
    },
    refresh: function refresh() {
      var t,
          i,
          s = this,
          n = this.options.icons.submenu,
          a = this.element.find(this.options.menus);
      this.element.toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length), a.filter(":not(.ui-menu)").addClass("ui-menu ui-widget ui-widget-content ui-front").hide().attr({
        role: this.options.role,
        "aria-hidden": "true",
        "aria-expanded": "false"
      }).each(function () {
        var t = e(this),
            i = t.parent(),
            s = e("<span>").addClass("ui-menu-icon ui-icon " + n).data("ui-menu-submenu-carat", !0);
        i.attr("aria-haspopup", "true").prepend(s), t.attr("aria-labelledby", i.attr("id"));
      }), t = a.add(this.element), i = t.find(this.options.items), i.not(".ui-menu-item").each(function () {
        var t = e(this);
        s._isDivider(t) && t.addClass("ui-widget-content ui-menu-divider");
      }), i.not(".ui-menu-item, .ui-menu-divider").addClass("ui-menu-item").uniqueId().attr({
        tabIndex: -1,
        role: this._itemRole()
      }), i.filter(".ui-state-disabled").attr("aria-disabled", "true"), this.active && !e.contains(this.element[0], this.active[0]) && this.blur();
    },
    _itemRole: function _itemRole() {
      return {
        menu: "menuitem",
        listbox: "option"
      }[this.options.role];
    },
    _setOption: function _setOption(e, t) {
      "icons" === e && this.element.find(".ui-menu-icon").removeClass(this.options.icons.submenu).addClass(t.submenu), "disabled" === e && this.element.toggleClass("ui-state-disabled", !!t).attr("aria-disabled", t), this._super(e, t);
    },
    focus: function focus(e, t) {
      var i, s;
      this.blur(e, e && "focus" === e.type), this._scrollIntoView(t), this.active = t.first(), s = this.active.addClass("ui-state-focus").removeClass("ui-state-active"), this.options.role && this.element.attr("aria-activedescendant", s.attr("id")), this.active.parent().closest(".ui-menu-item").addClass("ui-state-active"), e && "keydown" === e.type ? this._close() : this.timer = this._delay(function () {
        this._close();
      }, this.delay), i = t.children(".ui-menu"), i.length && e && /^mouse/.test(e.type) && this._startOpening(i), this.activeMenu = t.parent(), this._trigger("focus", e, {
        item: t
      });
    },
    _scrollIntoView: function _scrollIntoView(t) {
      var i, s, n, a, o, r;
      this._hasScroll() && (i = parseFloat(e.css(this.activeMenu[0], "borderTopWidth")) || 0, s = parseFloat(e.css(this.activeMenu[0], "paddingTop")) || 0, n = t.offset().top - this.activeMenu.offset().top - i - s, a = this.activeMenu.scrollTop(), o = this.activeMenu.height(), r = t.outerHeight(), 0 > n ? this.activeMenu.scrollTop(a + n) : n + r > o && this.activeMenu.scrollTop(a + n - o + r));
    },
    blur: function blur(e, t) {
      t || clearTimeout(this.timer), this.active && (this.active.removeClass("ui-state-focus"), this.active = null, this._trigger("blur", e, {
        item: this.active
      }));
    },
    _startOpening: function _startOpening(e) {
      clearTimeout(this.timer), "true" === e.attr("aria-hidden") && (this.timer = this._delay(function () {
        this._close(), this._open(e);
      }, this.delay));
    },
    _open: function _open(t) {
      var i = e.extend({
        of: this.active
      }, this.options.position);
      clearTimeout(this.timer), this.element.find(".ui-menu").not(t.parents(".ui-menu")).hide().attr("aria-hidden", "true"), t.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(i);
    },
    collapseAll: function collapseAll(t, i) {
      clearTimeout(this.timer), this.timer = this._delay(function () {
        var s = i ? this.element : e(t && t.target).closest(this.element.find(".ui-menu"));
        s.length || (s = this.element), this._close(s), this.blur(t), this.activeMenu = s;
      }, this.delay);
    },
    _close: function _close(e) {
      e || (e = this.active ? this.active.parent() : this.element), e.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false").end().find(".ui-state-active").not(".ui-state-focus").removeClass("ui-state-active");
    },
    _closeOnDocumentClick: function _closeOnDocumentClick(t) {
      return !e(t.target).closest(".ui-menu").length;
    },
    _isDivider: function _isDivider(e) {
      return !/[^\-\u2014\u2013\s]/.test(e.text());
    },
    collapse: function collapse(e) {
      var t = this.active && this.active.parent().closest(".ui-menu-item", this.element);
      t && t.length && (this._close(), this.focus(e, t));
    },
    expand: function expand(e) {
      var t = this.active && this.active.children(".ui-menu ").find(this.options.items).first();
      t && t.length && (this._open(t.parent()), this._delay(function () {
        this.focus(e, t);
      }));
    },
    next: function next(e) {
      this._move("next", "first", e);
    },
    previous: function previous(e) {
      this._move("prev", "last", e);
    },
    isFirstItem: function isFirstItem() {
      return this.active && !this.active.prevAll(".ui-menu-item").length;
    },
    isLastItem: function isLastItem() {
      return this.active && !this.active.nextAll(".ui-menu-item").length;
    },
    _move: function _move(e, t, i) {
      var s;
      this.active && (s = "first" === e || "last" === e ? this.active["first" === e ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1) : this.active[e + "All"](".ui-menu-item").eq(0)), s && s.length && this.active || (s = this.activeMenu.find(this.options.items)[t]()), this.focus(i, s);
    },
    nextPage: function nextPage(t) {
      var i, s, n;
      return this.active ? (this.isLastItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.nextAll(".ui-menu-item").each(function () {
        return i = e(this), 0 > i.offset().top - s - n;
      }), this.focus(t, i)) : this.focus(t, this.activeMenu.find(this.options.items)[this.active ? "last" : "first"]())), void 0) : (this.next(t), void 0);
    },
    previousPage: function previousPage(t) {
      var i, s, n;
      return this.active ? (this.isFirstItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.prevAll(".ui-menu-item").each(function () {
        return i = e(this), i.offset().top - s + n > 0;
      }), this.focus(t, i)) : this.focus(t, this.activeMenu.find(this.options.items).first())), void 0) : (this.next(t), void 0);
    },
    _hasScroll: function _hasScroll() {
      return this.element.outerHeight() < this.element.prop("scrollHeight");
    },
    select: function select(t) {
      this.active = this.active || e(t.target).closest(".ui-menu-item");
      var i = {
        item: this.active
      };
      this.active.has(".ui-menu").length || this.collapseAll(t, !0), this._trigger("select", t, i);
    },
    _filterMenuItems: function _filterMenuItems(t) {
      var i = t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"),
          s = RegExp("^" + i, "i");
      return this.activeMenu.find(this.options.items).filter(".ui-menu-item").filter(function () {
        return s.test(e.trim(e(this).text()));
      });
    }
  }), e.widget("ui.autocomplete", {
    version: "1.11.2",
    defaultElement: "<input>",
    options: {
      appendTo: null,
      autoFocus: !1,
      delay: 300,
      minLength: 1,
      position: {
        my: "left top",
        at: "left bottom",
        collision: "none"
      },
      source: null,
      change: null,
      close: null,
      focus: null,
      open: null,
      response: null,
      search: null,
      select: null
    },
    requestIndex: 0,
    pending: 0,
    _create: function _create() {
      var t,
          i,
          s,
          n = this.element[0].nodeName.toLowerCase(),
          a = "textarea" === n,
          o = "input" === n;
      this.isMultiLine = a ? !0 : o ? !1 : this.element.prop("isContentEditable"), this.valueMethod = this.element[a || o ? "val" : "text"], this.isNewMenu = !0, this.element.addClass("ui-autocomplete-input").attr("autocomplete", "off"), this._on(this.element, {
        keydown: function keydown(n) {
          if (this.element.prop("readOnly")) return t = !0, s = !0, i = !0, void 0;
          t = !1, s = !1, i = !1;
          var a = e.ui.keyCode;

          switch (n.keyCode) {
            case a.PAGE_UP:
              t = !0, this._move("previousPage", n);
              break;

            case a.PAGE_DOWN:
              t = !0, this._move("nextPage", n);
              break;

            case a.UP:
              t = !0, this._keyEvent("previous", n);
              break;

            case a.DOWN:
              t = !0, this._keyEvent("next", n);
              break;

            case a.ENTER:
              this.menu.active && (t = !0, n.preventDefault(), this.menu.select(n));
              break;

            case a.TAB:
              this.menu.active && this.menu.select(n);
              break;

            case a.ESCAPE:
              this.menu.element.is(":visible") && (this.isMultiLine || this._value(this.term), this.close(n), n.preventDefault());
              break;

            default:
              i = !0, this._searchTimeout(n);
          }
        },
        keypress: function keypress(s) {
          if (t) return t = !1, (!this.isMultiLine || this.menu.element.is(":visible")) && s.preventDefault(), void 0;

          if (!i) {
            var n = e.ui.keyCode;

            switch (s.keyCode) {
              case n.PAGE_UP:
                this._move("previousPage", s);

                break;

              case n.PAGE_DOWN:
                this._move("nextPage", s);

                break;

              case n.UP:
                this._keyEvent("previous", s);

                break;

              case n.DOWN:
                this._keyEvent("next", s);

            }
          }
        },
        input: function input(e) {
          return s ? (s = !1, e.preventDefault(), void 0) : (this._searchTimeout(e), void 0);
        },
        focus: function focus() {
          this.selectedItem = null, this.previous = this._value();
        },
        blur: function blur(e) {
          return this.cancelBlur ? (delete this.cancelBlur, void 0) : (clearTimeout(this.searching), this.close(e), this._change(e), void 0);
        }
      }), this._initSource(), this.menu = e("<ul>").addClass("ui-autocomplete ui-front").appendTo(this._appendTo()).menu({
        role: null
      }).hide().menu("instance"), this._on(this.menu.element, {
        mousedown: function mousedown(t) {
          t.preventDefault(), this.cancelBlur = !0, this._delay(function () {
            delete this.cancelBlur;
          });
          var i = this.menu.element[0];
          e(t.target).closest(".ui-menu-item").length || this._delay(function () {
            var t = this;
            this.document.one("mousedown", function (s) {
              s.target === t.element[0] || s.target === i || e.contains(i, s.target) || t.close();
            });
          });
        },
        menufocus: function menufocus(t, i) {
          var s, n;
          return this.isNewMenu && (this.isNewMenu = !1, t.originalEvent && /^mouse/.test(t.originalEvent.type)) ? (this.menu.blur(), this.document.one("mousemove", function () {
            e(t.target).trigger(t.originalEvent);
          }), void 0) : (n = i.item.data("ui-autocomplete-item"), !1 !== this._trigger("focus", t, {
            item: n
          }) && t.originalEvent && /^key/.test(t.originalEvent.type) && this._value(n.value), s = i.item.attr("aria-label") || n.value, s && e.trim(s).length && (this.liveRegion.children().hide(), e("<div>").text(s).appendTo(this.liveRegion)), void 0);
        },
        menuselect: function menuselect(e, t) {
          var i = t.item.data("ui-autocomplete-item"),
              s = this.previous;
          this.element[0] !== this.document[0].activeElement && (this.element.focus(), this.previous = s, this._delay(function () {
            this.previous = s, this.selectedItem = i;
          })), !1 !== this._trigger("select", e, {
            item: i
          }) && this._value(i.value), this.term = this._value(), this.close(e), this.selectedItem = i;
        }
      }), this.liveRegion = e("<span>", {
        role: "status",
        "aria-live": "assertive",
        "aria-relevant": "additions"
      }).addClass("ui-helper-hidden-accessible").appendTo(this.document[0].body), this._on(this.window, {
        beforeunload: function beforeunload() {
          this.element.removeAttr("autocomplete");
        }
      });
    },
    _destroy: function _destroy() {
      clearTimeout(this.searching), this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete"), this.menu.element.remove(), this.liveRegion.remove();
    },
    _setOption: function _setOption(e, t) {
      this._super(e, t), "source" === e && this._initSource(), "appendTo" === e && this.menu.element.appendTo(this._appendTo()), "disabled" === e && t && this.xhr && this.xhr.abort();
    },
    _appendTo: function _appendTo() {
      var t = this.options.appendTo;
      return t && (t = t.jquery || t.nodeType ? e(t) : this.document.find(t).eq(0)), t && t[0] || (t = this.element.closest(".ui-front")), t.length || (t = this.document[0].body), t;
    },
    _initSource: function _initSource() {
      var t,
          i,
          s = this;
      e.isArray(this.options.source) ? (t = this.options.source, this.source = function (i, s) {
        s(e.ui.autocomplete.filter(t, i.term));
      }) : "string" == typeof this.options.source ? (i = this.options.source, this.source = function (t, n) {
        s.xhr && s.xhr.abort(), s.xhr = e.ajax({
          url: i,
          data: t,
          dataType: "json",
          success: function success(e) {
            n(e);
          },
          error: function error() {
            n([]);
          }
        });
      }) : this.source = this.options.source;
    },
    _searchTimeout: function _searchTimeout(e) {
      clearTimeout(this.searching), this.searching = this._delay(function () {
        var t = this.term === this._value(),
            i = this.menu.element.is(":visible"),
            s = e.altKey || e.ctrlKey || e.metaKey || e.shiftKey;

        (!t || t && !i && !s) && (this.selectedItem = null, this.search(null, e));
      }, this.options.delay);
    },
    search: function search(e, t) {
      return e = null != e ? e : this._value(), this.term = this._value(), e.length < this.options.minLength ? this.close(t) : this._trigger("search", t) !== !1 ? this._search(e) : void 0;
    },
    _search: function _search(e) {
      this.pending++, this.element.addClass("ui-autocomplete-loading"), this.cancelSearch = !1, this.source({
        term: e
      }, this._response());
    },
    _response: function _response() {
      var t = ++this.requestIndex;
      return e.proxy(function (e) {
        t === this.requestIndex && this.__response(e), this.pending--, this.pending || this.element.removeClass("ui-autocomplete-loading");
      }, this);
    },
    __response: function __response(e) {
      e && (e = this._normalize(e)), this._trigger("response", null, {
        content: e
      }), !this.options.disabled && e && e.length && !this.cancelSearch ? (this._suggest(e), this._trigger("open")) : this._close();
    },
    close: function close(e) {
      this.cancelSearch = !0, this._close(e);
    },
    _close: function _close(e) {
      this.menu.element.is(":visible") && (this.menu.element.hide(), this.menu.blur(), this.isNewMenu = !0, this._trigger("close", e));
    },
    _change: function _change(e) {
      this.previous !== this._value() && this._trigger("change", e, {
        item: this.selectedItem
      });
    },
    _normalize: function _normalize(t) {
      return t.length && t[0].label && t[0].value ? t : e.map(t, function (t) {
        return "string" == typeof t ? {
          label: t,
          value: t
        } : e.extend({}, t, {
          label: t.label || t.value,
          value: t.value || t.label
        });
      });
    },
    _suggest: function _suggest(t) {
      var i = this.menu.element.empty();
      this._renderMenu(i, t), this.isNewMenu = !0, this.menu.refresh(), i.show(), this._resizeMenu(), i.position(e.extend({
        of: this.element
      }, this.options.position)), this.options.autoFocus && this.menu.next();
    },
    _resizeMenu: function _resizeMenu() {
      var e = this.menu.element;
      e.outerWidth(Math.max(e.width("").outerWidth() + 1, this.element.outerWidth()));
    },
    _renderMenu: function _renderMenu(t, i) {
      var s = this;
      e.each(i, function (e, i) {
        s._renderItemData(t, i);
      });
    },
    _renderItemData: function _renderItemData(e, t) {
      return this._renderItem(e, t).data("ui-autocomplete-item", t);
    },
    _renderItem: function _renderItem(t, i) {
      return e("<li>").text(i.label).appendTo(t);
    },
    _move: function _move(e, t) {
      return this.menu.element.is(":visible") ? this.menu.isFirstItem() && /^previous/.test(e) || this.menu.isLastItem() && /^next/.test(e) ? (this.isMultiLine || this._value(this.term), this.menu.blur(), void 0) : (this.menu[e](t), void 0) : (this.search(null, t), void 0);
    },
    widget: function widget() {
      return this.menu.element;
    },
    _value: function _value() {
      return this.valueMethod.apply(this.element, arguments);
    },
    _keyEvent: function _keyEvent(e, t) {
      (!this.isMultiLine || this.menu.element.is(":visible")) && (this._move(e, t), t.preventDefault());
    }
  }), e.extend(e.ui.autocomplete, {
    escapeRegex: function escapeRegex(e) {
      return e.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
    },
    filter: function filter(t, i) {
      var s = RegExp(e.ui.autocomplete.escapeRegex(i), "i");
      return e.grep(t, function (e) {
        return s.test(e.label || e.value || e);
      });
    }
  }), e.widget("ui.autocomplete", e.ui.autocomplete, {
    options: {
      messages: {
        noResults: "No search results.",
        results: function results(e) {
          return e + (e > 1 ? " results are" : " result is") + " available, use up and down arrow keys to navigate.";
        }
      }
    },
    __response: function __response(t) {
      var i;
      this._superApply(arguments), this.options.disabled || this.cancelSearch || (i = t && t.length ? this.options.messages.results(t.length) : this.options.messages.noResults, this.liveRegion.children().hide(), e("<div>").text(i).appendTo(this.liveRegion));
    }
  }), e.ui.autocomplete;

  var c,
      p = "ui-button ui-widget ui-state-default ui-corner-all",
      f = "ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only",
      m = function m() {
    var t = e(this);
    setTimeout(function () {
      t.find(":ui-button").button("refresh");
    }, 1);
  },
      g = function g(t) {
    var i = t.name,
        s = t.form,
        n = e([]);
    return i && (i = i.replace(/'/g, "\\'"), n = s ? e(s).find("[name='" + i + "'][type=radio]") : e("[name='" + i + "'][type=radio]", t.ownerDocument).filter(function () {
      return !this.form;
    })), n;
  };

  e.widget("ui.button", {
    version: "1.11.2",
    defaultElement: "<button>",
    options: {
      disabled: null,
      text: !0,
      label: null,
      icons: {
        primary: null,
        secondary: null
      }
    },
    _create: function _create() {
      this.element.closest("form").unbind("reset" + this.eventNamespace).bind("reset" + this.eventNamespace, m), "boolean" != typeof this.options.disabled ? this.options.disabled = !!this.element.prop("disabled") : this.element.prop("disabled", this.options.disabled), this._determineButtonType(), this.hasTitle = !!this.buttonElement.attr("title");
      var t = this,
          i = this.options,
          s = "checkbox" === this.type || "radio" === this.type,
          n = s ? "" : "ui-state-active";
      null === i.label && (i.label = "input" === this.type ? this.buttonElement.val() : this.buttonElement.html()), this._hoverable(this.buttonElement), this.buttonElement.addClass(p).attr("role", "button").bind("mouseenter" + this.eventNamespace, function () {
        i.disabled || this === c && e(this).addClass("ui-state-active");
      }).bind("mouseleave" + this.eventNamespace, function () {
        i.disabled || e(this).removeClass(n);
      }).bind("click" + this.eventNamespace, function (e) {
        i.disabled && (e.preventDefault(), e.stopImmediatePropagation());
      }), this._on({
        focus: function focus() {
          this.buttonElement.addClass("ui-state-focus");
        },
        blur: function blur() {
          this.buttonElement.removeClass("ui-state-focus");
        }
      }), s && this.element.bind("change" + this.eventNamespace, function () {
        t.refresh();
      }), "checkbox" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, function () {
        return i.disabled ? !1 : void 0;
      }) : "radio" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, function () {
        if (i.disabled) return !1;
        e(this).addClass("ui-state-active"), t.buttonElement.attr("aria-pressed", "true");
        var s = t.element[0];
        g(s).not(s).map(function () {
          return e(this).button("widget")[0];
        }).removeClass("ui-state-active").attr("aria-pressed", "false");
      }) : (this.buttonElement.bind("mousedown" + this.eventNamespace, function () {
        return i.disabled ? !1 : (e(this).addClass("ui-state-active"), c = this, t.document.one("mouseup", function () {
          c = null;
        }), void 0);
      }).bind("mouseup" + this.eventNamespace, function () {
        return i.disabled ? !1 : (e(this).removeClass("ui-state-active"), void 0);
      }).bind("keydown" + this.eventNamespace, function (t) {
        return i.disabled ? !1 : ((t.keyCode === e.ui.keyCode.SPACE || t.keyCode === e.ui.keyCode.ENTER) && e(this).addClass("ui-state-active"), void 0);
      }).bind("keyup" + this.eventNamespace + " blur" + this.eventNamespace, function () {
        e(this).removeClass("ui-state-active");
      }), this.buttonElement.is("a") && this.buttonElement.keyup(function (t) {
        t.keyCode === e.ui.keyCode.SPACE && e(this).click();
      })), this._setOption("disabled", i.disabled), this._resetButton();
    },
    _determineButtonType: function _determineButtonType() {
      var e, t, i;
      this.type = this.element.is("[type=checkbox]") ? "checkbox" : this.element.is("[type=radio]") ? "radio" : this.element.is("input") ? "input" : "button", "checkbox" === this.type || "radio" === this.type ? (e = this.element.parents().last(), t = "label[for='" + this.element.attr("id") + "']", this.buttonElement = e.find(t), this.buttonElement.length || (e = e.length ? e.siblings() : this.element.siblings(), this.buttonElement = e.filter(t), this.buttonElement.length || (this.buttonElement = e.find(t))), this.element.addClass("ui-helper-hidden-accessible"), i = this.element.is(":checked"), i && this.buttonElement.addClass("ui-state-active"), this.buttonElement.prop("aria-pressed", i)) : this.buttonElement = this.element;
    },
    widget: function widget() {
      return this.buttonElement;
    },
    _destroy: function _destroy() {
      this.element.removeClass("ui-helper-hidden-accessible"), this.buttonElement.removeClass(p + " ui-state-active " + f).removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html()), this.hasTitle || this.buttonElement.removeAttr("title");
    },
    _setOption: function _setOption(e, t) {
      return this._super(e, t), "disabled" === e ? (this.widget().toggleClass("ui-state-disabled", !!t), this.element.prop("disabled", !!t), t && ("checkbox" === this.type || "radio" === this.type ? this.buttonElement.removeClass("ui-state-focus") : this.buttonElement.removeClass("ui-state-focus ui-state-active")), void 0) : (this._resetButton(), void 0);
    },
    refresh: function refresh() {
      var t = this.element.is("input, button") ? this.element.is(":disabled") : this.element.hasClass("ui-button-disabled");
      t !== this.options.disabled && this._setOption("disabled", t), "radio" === this.type ? g(this.element[0]).each(function () {
        e(this).is(":checked") ? e(this).button("widget").addClass("ui-state-active").attr("aria-pressed", "true") : e(this).button("widget").removeClass("ui-state-active").attr("aria-pressed", "false");
      }) : "checkbox" === this.type && (this.element.is(":checked") ? this.buttonElement.addClass("ui-state-active").attr("aria-pressed", "true") : this.buttonElement.removeClass("ui-state-active").attr("aria-pressed", "false"));
    },
    _resetButton: function _resetButton() {
      if ("input" === this.type) return this.options.label && this.element.val(this.options.label), void 0;
      var t = this.buttonElement.removeClass(f),
          i = e("<span></span>", this.document[0]).addClass("ui-button-text").html(this.options.label).appendTo(t.empty()).text(),
          s = this.options.icons,
          n = s.primary && s.secondary,
          a = [];
      s.primary || s.secondary ? (this.options.text && a.push("ui-button-text-icon" + (n ? "s" : s.primary ? "-primary" : "-secondary")), s.primary && t.prepend("<span class='ui-button-icon-primary ui-icon " + s.primary + "'></span>"), s.secondary && t.append("<span class='ui-button-icon-secondary ui-icon " + s.secondary + "'></span>"), this.options.text || (a.push(n ? "ui-button-icons-only" : "ui-button-icon-only"), this.hasTitle || t.attr("title", e.trim(i)))) : a.push("ui-button-text-only"), t.addClass(a.join(" "));
    }
  }), e.widget("ui.buttonset", {
    version: "1.11.2",
    options: {
      items: "button, input[type=button], input[type=submit], input[type=reset], input[type=checkbox], input[type=radio], a, :data(ui-button)"
    },
    _create: function _create() {
      this.element.addClass("ui-buttonset");
    },
    _init: function _init() {
      this.refresh();
    },
    _setOption: function _setOption(e, t) {
      "disabled" === e && this.buttons.button("option", e, t), this._super(e, t);
    },
    refresh: function refresh() {
      var t = "rtl" === this.element.css("direction"),
          i = this.element.find(this.options.items),
          s = i.filter(":ui-button");
      i.not(":ui-button").button(), s.button("refresh"), this.buttons = i.map(function () {
        return e(this).button("widget")[0];
      }).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(t ? "ui-corner-right" : "ui-corner-left").end().filter(":last").addClass(t ? "ui-corner-left" : "ui-corner-right").end().end();
    },
    _destroy: function _destroy() {
      this.element.removeClass("ui-buttonset"), this.buttons.map(function () {
        return e(this).button("widget")[0];
      }).removeClass("ui-corner-left ui-corner-right").end().button("destroy");
    }
  }), e.ui.button, e.extend(e.ui, {
    datepicker: {
      version: "1.11.2"
    }
  });
  var v;
  e.extend(n.prototype, {
    markerClassName: "hasDatepicker",
    maxRows: 4,
    _widgetDatepicker: function _widgetDatepicker() {
      return this.dpDiv;
    },
    setDefaults: function setDefaults(e) {
      return r(this._defaults, e || {}), this;
    },
    _attachDatepicker: function _attachDatepicker(t, i) {
      var s, n, a;
      s = t.nodeName.toLowerCase(), n = "div" === s || "span" === s, t.id || (this.uuid += 1, t.id = "dp" + this.uuid), a = this._newInst(e(t), n), a.settings = e.extend({}, i || {}), "input" === s ? this._connectDatepicker(t, a) : n && this._inlineDatepicker(t, a);
    },
    _newInst: function _newInst(t, i) {
      var s = t[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1");
      return {
        id: s,
        input: t,
        selectedDay: 0,
        selectedMonth: 0,
        selectedYear: 0,
        drawMonth: 0,
        drawYear: 0,
        inline: i,
        dpDiv: i ? a(e("<div class='" + this._inlineClass + " ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")) : this.dpDiv
      };
    },
    _connectDatepicker: function _connectDatepicker(t, i) {
      var s = e(t);
      i.append = e([]), i.trigger = e([]), s.hasClass(this.markerClassName) || (this._attachments(s, i), s.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp), this._autoSize(i), e.data(t, "datepicker", i), i.settings.disabled && this._disableDatepicker(t));
    },
    _attachments: function _attachments(t, i) {
      var s,
          n,
          a,
          o = this._get(i, "appendText"),
          r = this._get(i, "isRTL");

      i.append && i.append.remove(), o && (i.append = e("<span class='" + this._appendClass + "'>" + o + "</span>"), t[r ? "before" : "after"](i.append)), t.unbind("focus", this._showDatepicker), i.trigger && i.trigger.remove(), s = this._get(i, "showOn"), ("focus" === s || "both" === s) && t.focus(this._showDatepicker), ("button" === s || "both" === s) && (n = this._get(i, "buttonText"), a = this._get(i, "buttonImage"), i.trigger = e(this._get(i, "buttonImageOnly") ? e("<img/>").addClass(this._triggerClass).attr({
        src: a,
        alt: n,
        title: n
      }) : e("<button type='button'></button>").addClass(this._triggerClass).html(a ? e("<img/>").attr({
        src: a,
        alt: n,
        title: n
      }) : n)), t[r ? "before" : "after"](i.trigger), i.trigger.click(function () {
        return e.datepicker._datepickerShowing && e.datepicker._lastInput === t[0] ? e.datepicker._hideDatepicker() : e.datepicker._datepickerShowing && e.datepicker._lastInput !== t[0] ? (e.datepicker._hideDatepicker(), e.datepicker._showDatepicker(t[0])) : e.datepicker._showDatepicker(t[0]), !1;
      }));
    },
    _autoSize: function _autoSize(e) {
      if (this._get(e, "autoSize") && !e.inline) {
        var t,
            i,
            s,
            n,
            a = new Date(2009, 11, 20),
            o = this._get(e, "dateFormat");

        o.match(/[DM]/) && (t = function t(e) {
          for (i = 0, s = 0, n = 0; e.length > n; n++) {
            e[n].length > i && (i = e[n].length, s = n);
          }

          return s;
        }, a.setMonth(t(this._get(e, o.match(/MM/) ? "monthNames" : "monthNamesShort"))), a.setDate(t(this._get(e, o.match(/DD/) ? "dayNames" : "dayNamesShort")) + 20 - a.getDay())), e.input.attr("size", this._formatDate(e, a).length);
      }
    },
    _inlineDatepicker: function _inlineDatepicker(t, i) {
      var s = e(t);
      s.hasClass(this.markerClassName) || (s.addClass(this.markerClassName).append(i.dpDiv), e.data(t, "datepicker", i), this._setDate(i, this._getDefaultDate(i), !0), this._updateDatepicker(i), this._updateAlternate(i), i.settings.disabled && this._disableDatepicker(t), i.dpDiv.css("display", "block"));
    },
    _dialogDatepicker: function _dialogDatepicker(t, i, s, n, a) {
      var o,
          h,
          l,
          u,
          d,
          c = this._dialogInst;
      return c || (this.uuid += 1, o = "dp" + this.uuid, this._dialogInput = e("<input type='text' id='" + o + "' style='position: absolute; top: -100px; width: 0px;'/>"), this._dialogInput.keydown(this._doKeyDown), e("body").append(this._dialogInput), c = this._dialogInst = this._newInst(this._dialogInput, !1), c.settings = {}, e.data(this._dialogInput[0], "datepicker", c)), r(c.settings, n || {}), i = i && i.constructor === Date ? this._formatDate(c, i) : i, this._dialogInput.val(i), this._pos = a ? a.length ? a : [a.pageX, a.pageY] : null, this._pos || (h = document.documentElement.clientWidth, l = document.documentElement.clientHeight, u = document.documentElement.scrollLeft || document.body.scrollLeft, d = document.documentElement.scrollTop || document.body.scrollTop, this._pos = [h / 2 - 100 + u, l / 2 - 150 + d]), this._dialogInput.css("left", this._pos[0] + 20 + "px").css("top", this._pos[1] + "px"), c.settings.onSelect = s, this._inDialog = !0, this.dpDiv.addClass(this._dialogClass), this._showDatepicker(this._dialogInput[0]), e.blockUI && e.blockUI(this.dpDiv), e.data(this._dialogInput[0], "datepicker", c), this;
    },
    _destroyDatepicker: function _destroyDatepicker(t) {
      var i,
          s = e(t),
          n = e.data(t, "datepicker");
      s.hasClass(this.markerClassName) && (i = t.nodeName.toLowerCase(), e.removeData(t, "datepicker"), "input" === i ? (n.append.remove(), n.trigger.remove(), s.removeClass(this.markerClassName).unbind("focus", this._showDatepicker).unbind("keydown", this._doKeyDown).unbind("keypress", this._doKeyPress).unbind("keyup", this._doKeyUp)) : ("div" === i || "span" === i) && s.removeClass(this.markerClassName).empty());
    },
    _enableDatepicker: function _enableDatepicker(t) {
      var i,
          s,
          n = e(t),
          a = e.data(t, "datepicker");
      n.hasClass(this.markerClassName) && (i = t.nodeName.toLowerCase(), "input" === i ? (t.disabled = !1, a.trigger.filter("button").each(function () {
        this.disabled = !1;
      }).end().filter("img").css({
        opacity: "1.0",
        cursor: ""
      })) : ("div" === i || "span" === i) && (s = n.children("." + this._inlineClass), s.children().removeClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !1)), this._disabledInputs = e.map(this._disabledInputs, function (e) {
        return e === t ? null : e;
      }));
    },
    _disableDatepicker: function _disableDatepicker(t) {
      var i,
          s,
          n = e(t),
          a = e.data(t, "datepicker");
      n.hasClass(this.markerClassName) && (i = t.nodeName.toLowerCase(), "input" === i ? (t.disabled = !0, a.trigger.filter("button").each(function () {
        this.disabled = !0;
      }).end().filter("img").css({
        opacity: "0.5",
        cursor: "default"
      })) : ("div" === i || "span" === i) && (s = n.children("." + this._inlineClass), s.children().addClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !0)), this._disabledInputs = e.map(this._disabledInputs, function (e) {
        return e === t ? null : e;
      }), this._disabledInputs[this._disabledInputs.length] = t);
    },
    _isDisabledDatepicker: function _isDisabledDatepicker(e) {
      if (!e) return !1;

      for (var t = 0; this._disabledInputs.length > t; t++) {
        if (this._disabledInputs[t] === e) return !0;
      }

      return !1;
    },
    _getInst: function _getInst(t) {
      try {
        return e.data(t, "datepicker");
      } catch (i) {
        throw "Missing instance data for this datepicker";
      }
    },
    _optionDatepicker: function _optionDatepicker(t, i, s) {
      var n,
          a,
          o,
          h,
          l = this._getInst(t);

      return 2 === arguments.length && "string" == typeof i ? "defaults" === i ? e.extend({}, e.datepicker._defaults) : l ? "all" === i ? e.extend({}, l.settings) : this._get(l, i) : null : (n = i || {}, "string" == typeof i && (n = {}, n[i] = s), l && (this._curInst === l && this._hideDatepicker(), a = this._getDateDatepicker(t, !0), o = this._getMinMaxDate(l, "min"), h = this._getMinMaxDate(l, "max"), r(l.settings, n), null !== o && void 0 !== n.dateFormat && void 0 === n.minDate && (l.settings.minDate = this._formatDate(l, o)), null !== h && void 0 !== n.dateFormat && void 0 === n.maxDate && (l.settings.maxDate = this._formatDate(l, h)), "disabled" in n && (n.disabled ? this._disableDatepicker(t) : this._enableDatepicker(t)), this._attachments(e(t), l), this._autoSize(l), this._setDate(l, a), this._updateAlternate(l), this._updateDatepicker(l)), void 0);
    },
    _changeDatepicker: function _changeDatepicker(e, t, i) {
      this._optionDatepicker(e, t, i);
    },
    _refreshDatepicker: function _refreshDatepicker(e) {
      var t = this._getInst(e);

      t && this._updateDatepicker(t);
    },
    _setDateDatepicker: function _setDateDatepicker(e, t) {
      var i = this._getInst(e);

      i && (this._setDate(i, t), this._updateDatepicker(i), this._updateAlternate(i));
    },
    _getDateDatepicker: function _getDateDatepicker(e, t) {
      var i = this._getInst(e);

      return i && !i.inline && this._setDateFromField(i, t), i ? this._getDate(i) : null;
    },
    _doKeyDown: function _doKeyDown(t) {
      var i,
          s,
          n,
          a = e.datepicker._getInst(t.target),
          o = !0,
          r = a.dpDiv.is(".ui-datepicker-rtl");

      if (a._keyEvent = !0, e.datepicker._datepickerShowing) switch (t.keyCode) {
        case 9:
          e.datepicker._hideDatepicker(), o = !1;
          break;

        case 13:
          return n = e("td." + e.datepicker._dayOverClass + ":not(." + e.datepicker._currentClass + ")", a.dpDiv), n[0] && e.datepicker._selectDay(t.target, a.selectedMonth, a.selectedYear, n[0]), i = e.datepicker._get(a, "onSelect"), i ? (s = e.datepicker._formatDate(a), i.apply(a.input ? a.input[0] : null, [s, a])) : e.datepicker._hideDatepicker(), !1;

        case 27:
          e.datepicker._hideDatepicker();

          break;

        case 33:
          e.datepicker._adjustDate(t.target, t.ctrlKey ? -e.datepicker._get(a, "stepBigMonths") : -e.datepicker._get(a, "stepMonths"), "M");

          break;

        case 34:
          e.datepicker._adjustDate(t.target, t.ctrlKey ? +e.datepicker._get(a, "stepBigMonths") : +e.datepicker._get(a, "stepMonths"), "M");

          break;

        case 35:
          (t.ctrlKey || t.metaKey) && e.datepicker._clearDate(t.target), o = t.ctrlKey || t.metaKey;
          break;

        case 36:
          (t.ctrlKey || t.metaKey) && e.datepicker._gotoToday(t.target), o = t.ctrlKey || t.metaKey;
          break;

        case 37:
          (t.ctrlKey || t.metaKey) && e.datepicker._adjustDate(t.target, r ? 1 : -1, "D"), o = t.ctrlKey || t.metaKey, t.originalEvent.altKey && e.datepicker._adjustDate(t.target, t.ctrlKey ? -e.datepicker._get(a, "stepBigMonths") : -e.datepicker._get(a, "stepMonths"), "M");
          break;

        case 38:
          (t.ctrlKey || t.metaKey) && e.datepicker._adjustDate(t.target, -7, "D"), o = t.ctrlKey || t.metaKey;
          break;

        case 39:
          (t.ctrlKey || t.metaKey) && e.datepicker._adjustDate(t.target, r ? -1 : 1, "D"), o = t.ctrlKey || t.metaKey, t.originalEvent.altKey && e.datepicker._adjustDate(t.target, t.ctrlKey ? +e.datepicker._get(a, "stepBigMonths") : +e.datepicker._get(a, "stepMonths"), "M");
          break;

        case 40:
          (t.ctrlKey || t.metaKey) && e.datepicker._adjustDate(t.target, 7, "D"), o = t.ctrlKey || t.metaKey;
          break;

        default:
          o = !1;
      } else 36 === t.keyCode && t.ctrlKey ? e.datepicker._showDatepicker(this) : o = !1;
      o && (t.preventDefault(), t.stopPropagation());
    },
    _doKeyPress: function _doKeyPress(t) {
      var i,
          s,
          n = e.datepicker._getInst(t.target);

      return e.datepicker._get(n, "constrainInput") ? (i = e.datepicker._possibleChars(e.datepicker._get(n, "dateFormat")), s = String.fromCharCode(null == t.charCode ? t.keyCode : t.charCode), t.ctrlKey || t.metaKey || " " > s || !i || i.indexOf(s) > -1) : void 0;
    },
    _doKeyUp: function _doKeyUp(t) {
      var i,
          s = e.datepicker._getInst(t.target);

      if (s.input.val() !== s.lastVal) try {
        i = e.datepicker.parseDate(e.datepicker._get(s, "dateFormat"), s.input ? s.input.val() : null, e.datepicker._getFormatConfig(s)), i && (e.datepicker._setDateFromField(s), e.datepicker._updateAlternate(s), e.datepicker._updateDatepicker(s));
      } catch (n) {}
      return !0;
    },
    _showDatepicker: function _showDatepicker(t) {
      if (t = t.target || t, "input" !== t.nodeName.toLowerCase() && (t = e("input", t.parentNode)[0]), !e.datepicker._isDisabledDatepicker(t) && e.datepicker._lastInput !== t) {
        var i, n, a, o, h, l, u;
        i = e.datepicker._getInst(t), e.datepicker._curInst && e.datepicker._curInst !== i && (e.datepicker._curInst.dpDiv.stop(!0, !0), i && e.datepicker._datepickerShowing && e.datepicker._hideDatepicker(e.datepicker._curInst.input[0])), n = e.datepicker._get(i, "beforeShow"), a = n ? n.apply(t, [t, i]) : {}, a !== !1 && (r(i.settings, a), i.lastVal = null, e.datepicker._lastInput = t, e.datepicker._setDateFromField(i), e.datepicker._inDialog && (t.value = ""), e.datepicker._pos || (e.datepicker._pos = e.datepicker._findPos(t), e.datepicker._pos[1] += t.offsetHeight), o = !1, e(t).parents().each(function () {
          return o |= "fixed" === e(this).css("position"), !o;
        }), h = {
          left: e.datepicker._pos[0],
          top: e.datepicker._pos[1]
        }, e.datepicker._pos = null, i.dpDiv.empty(), i.dpDiv.css({
          position: "absolute",
          display: "block",
          top: "-1000px"
        }), e.datepicker._updateDatepicker(i), h = e.datepicker._checkOffset(i, h, o), i.dpDiv.css({
          position: e.datepicker._inDialog && e.blockUI ? "static" : o ? "fixed" : "absolute",
          display: "none",
          left: h.left + "px",
          top: h.top + "px"
        }), i.inline || (l = e.datepicker._get(i, "showAnim"), u = e.datepicker._get(i, "duration"), i.dpDiv.css("z-index", s(e(t)) + 1), e.datepicker._datepickerShowing = !0, e.effects && e.effects.effect[l] ? i.dpDiv.show(l, e.datepicker._get(i, "showOptions"), u) : i.dpDiv[l || "show"](l ? u : null), e.datepicker._shouldFocusInput(i) && i.input.focus(), e.datepicker._curInst = i));
      }
    },
    _updateDatepicker: function _updateDatepicker(t) {
      this.maxRows = 4, v = t, t.dpDiv.empty().append(this._generateHTML(t)), this._attachHandlers(t);

      var i,
          s = this._getNumberOfMonths(t),
          n = s[1],
          a = 17,
          r = t.dpDiv.find("." + this._dayOverClass + " a");

      r.length > 0 && o.apply(r.get(0)), t.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""), n > 1 && t.dpDiv.addClass("ui-datepicker-multi-" + n).css("width", a * n + "em"), t.dpDiv[(1 !== s[0] || 1 !== s[1] ? "add" : "remove") + "Class"]("ui-datepicker-multi"), t.dpDiv[(this._get(t, "isRTL") ? "add" : "remove") + "Class"]("ui-datepicker-rtl"), t === e.datepicker._curInst && e.datepicker._datepickerShowing && e.datepicker._shouldFocusInput(t) && t.input.focus(), t.yearshtml && (i = t.yearshtml, setTimeout(function () {
        i === t.yearshtml && t.yearshtml && t.dpDiv.find("select.ui-datepicker-year:first").replaceWith(t.yearshtml), i = t.yearshtml = null;
      }, 0));
    },
    _shouldFocusInput: function _shouldFocusInput(e) {
      return e.input && e.input.is(":visible") && !e.input.is(":disabled") && !e.input.is(":focus");
    },
    _checkOffset: function _checkOffset(t, i, s) {
      var n = t.dpDiv.outerWidth(),
          a = t.dpDiv.outerHeight(),
          o = t.input ? t.input.outerWidth() : 0,
          r = t.input ? t.input.outerHeight() : 0,
          h = document.documentElement.clientWidth + (s ? 0 : e(document).scrollLeft()),
          l = document.documentElement.clientHeight + (s ? 0 : e(document).scrollTop());
      return i.left -= this._get(t, "isRTL") ? n - o : 0, i.left -= s && i.left === t.input.offset().left ? e(document).scrollLeft() : 0, i.top -= s && i.top === t.input.offset().top + r ? e(document).scrollTop() : 0, i.left -= Math.min(i.left, i.left + n > h && h > n ? Math.abs(i.left + n - h) : 0), i.top -= Math.min(i.top, i.top + a > l && l > a ? Math.abs(a + r) : 0), i;
    },
    _findPos: function _findPos(t) {
      for (var i, s = this._getInst(t), n = this._get(s, "isRTL"); t && ("hidden" === t.type || 1 !== t.nodeType || e.expr.filters.hidden(t));) {
        t = t[n ? "previousSibling" : "nextSibling"];
      }

      return i = e(t).offset(), [i.left, i.top];
    },
    _hideDatepicker: function _hideDatepicker(t) {
      var i,
          s,
          n,
          a,
          o = this._curInst;
      !o || t && o !== e.data(t, "datepicker") || this._datepickerShowing && (i = this._get(o, "showAnim"), s = this._get(o, "duration"), n = function n() {
        e.datepicker._tidyDialog(o);
      }, e.effects && (e.effects.effect[i] || e.effects[i]) ? o.dpDiv.hide(i, e.datepicker._get(o, "showOptions"), s, n) : o.dpDiv["slideDown" === i ? "slideUp" : "fadeIn" === i ? "fadeOut" : "hide"](i ? s : null, n), i || n(), this._datepickerShowing = !1, a = this._get(o, "onClose"), a && a.apply(o.input ? o.input[0] : null, [o.input ? o.input.val() : "", o]), this._lastInput = null, this._inDialog && (this._dialogInput.css({
        position: "absolute",
        left: "0",
        top: "-100px"
      }), e.blockUI && (e.unblockUI(), e("body").append(this.dpDiv))), this._inDialog = !1);
    },
    _tidyDialog: function _tidyDialog(e) {
      e.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar");
    },
    _checkExternalClick: function _checkExternalClick(t) {
      if (e.datepicker._curInst) {
        var i = e(t.target),
            s = e.datepicker._getInst(i[0]);

        (i[0].id !== e.datepicker._mainDivId && 0 === i.parents("#" + e.datepicker._mainDivId).length && !i.hasClass(e.datepicker.markerClassName) && !i.closest("." + e.datepicker._triggerClass).length && e.datepicker._datepickerShowing && (!e.datepicker._inDialog || !e.blockUI) || i.hasClass(e.datepicker.markerClassName) && e.datepicker._curInst !== s) && e.datepicker._hideDatepicker();
      }
    },
    _adjustDate: function _adjustDate(t, i, s) {
      var n = e(t),
          a = this._getInst(n[0]);

      this._isDisabledDatepicker(n[0]) || (this._adjustInstDate(a, i + ("M" === s ? this._get(a, "showCurrentAtPos") : 0), s), this._updateDatepicker(a));
    },
    _gotoToday: function _gotoToday(t) {
      var i,
          s = e(t),
          n = this._getInst(s[0]);

      this._get(n, "gotoCurrent") && n.currentDay ? (n.selectedDay = n.currentDay, n.drawMonth = n.selectedMonth = n.currentMonth, n.drawYear = n.selectedYear = n.currentYear) : (i = new Date(), n.selectedDay = i.getDate(), n.drawMonth = n.selectedMonth = i.getMonth(), n.drawYear = n.selectedYear = i.getFullYear()), this._notifyChange(n), this._adjustDate(s);
    },
    _selectMonthYear: function _selectMonthYear(t, i, s) {
      var n = e(t),
          a = this._getInst(n[0]);

      a["selected" + ("M" === s ? "Month" : "Year")] = a["draw" + ("M" === s ? "Month" : "Year")] = parseInt(i.options[i.selectedIndex].value, 10), this._notifyChange(a), this._adjustDate(n);
    },
    _selectDay: function _selectDay(t, i, s, n) {
      var a,
          o = e(t);
      e(n).hasClass(this._unselectableClass) || this._isDisabledDatepicker(o[0]) || (a = this._getInst(o[0]), a.selectedDay = a.currentDay = e("a", n).html(), a.selectedMonth = a.currentMonth = i, a.selectedYear = a.currentYear = s, this._selectDate(t, this._formatDate(a, a.currentDay, a.currentMonth, a.currentYear)));
    },
    _clearDate: function _clearDate(t) {
      var i = e(t);

      this._selectDate(i, "");
    },
    _selectDate: function _selectDate(t, i) {
      var s,
          n = e(t),
          a = this._getInst(n[0]);

      i = null != i ? i : this._formatDate(a), a.input && a.input.val(i), this._updateAlternate(a), s = this._get(a, "onSelect"), s ? s.apply(a.input ? a.input[0] : null, [i, a]) : a.input && a.input.trigger("change"), a.inline ? this._updateDatepicker(a) : (this._hideDatepicker(), this._lastInput = a.input[0], "object" != _typeof(a.input[0]) && a.input.focus(), this._lastInput = null);
    },
    _updateAlternate: function _updateAlternate(t) {
      var i,
          s,
          n,
          a = this._get(t, "altField");

      a && (i = this._get(t, "altFormat") || this._get(t, "dateFormat"), s = this._getDate(t), n = this.formatDate(i, s, this._getFormatConfig(t)), e(a).each(function () {
        e(this).val(n);
      }));
    },
    noWeekends: function noWeekends(e) {
      var t = e.getDay();
      return [t > 0 && 6 > t, ""];
    },
    iso8601Week: function iso8601Week(e) {
      var t,
          i = new Date(e.getTime());
      return i.setDate(i.getDate() + 4 - (i.getDay() || 7)), t = i.getTime(), i.setMonth(0), i.setDate(1), Math.floor(Math.round((t - i) / 864e5) / 7) + 1;
    },
    parseDate: function parseDate(t, i, s) {
      if (null == t || null == i) throw "Invalid arguments";
      if (i = "object" == _typeof(i) ? "" + i : i + "", "" === i) return null;

      var n,
          a,
          o,
          r,
          h = 0,
          l = (s ? s.shortYearCutoff : null) || this._defaults.shortYearCutoff,
          u = "string" != typeof l ? l : new Date().getFullYear() % 100 + parseInt(l, 10),
          d = (s ? s.dayNamesShort : null) || this._defaults.dayNamesShort,
          c = (s ? s.dayNames : null) || this._defaults.dayNames,
          p = (s ? s.monthNamesShort : null) || this._defaults.monthNamesShort,
          f = (s ? s.monthNames : null) || this._defaults.monthNames,
          m = -1,
          g = -1,
          v = -1,
          y = -1,
          b = !1,
          _ = function _(e) {
        var i = t.length > n + 1 && t.charAt(n + 1) === e;
        return i && n++, i;
      },
          x = function x(e) {
        var t = _(e),
            s = "@" === e ? 14 : "!" === e ? 20 : "y" === e && t ? 4 : "o" === e ? 3 : 2,
            n = "y" === e ? s : 1,
            a = RegExp("^\\d{" + n + "," + s + "}"),
            o = i.substring(h).match(a);

        if (!o) throw "Missing number at position " + h;
        return h += o[0].length, parseInt(o[0], 10);
      },
          w = function w(t, s, n) {
        var a = -1,
            o = e.map(_(t) ? n : s, function (e, t) {
          return [[t, e]];
        }).sort(function (e, t) {
          return -(e[1].length - t[1].length);
        });
        if (e.each(o, function (e, t) {
          var s = t[1];
          return i.substr(h, s.length).toLowerCase() === s.toLowerCase() ? (a = t[0], h += s.length, !1) : void 0;
        }), -1 !== a) return a + 1;
        throw "Unknown name at position " + h;
      },
          k = function k() {
        if (i.charAt(h) !== t.charAt(n)) throw "Unexpected literal at position " + h;
        h++;
      };

      for (n = 0; t.length > n; n++) {
        if (b) "'" !== t.charAt(n) || _("'") ? k() : b = !1;else switch (t.charAt(n)) {
          case "d":
            v = x("d");
            break;

          case "D":
            w("D", d, c);
            break;

          case "o":
            y = x("o");
            break;

          case "m":
            g = x("m");
            break;

          case "M":
            g = w("M", p, f);
            break;

          case "y":
            m = x("y");
            break;

          case "@":
            r = new Date(x("@")), m = r.getFullYear(), g = r.getMonth() + 1, v = r.getDate();
            break;

          case "!":
            r = new Date((x("!") - this._ticksTo1970) / 1e4), m = r.getFullYear(), g = r.getMonth() + 1, v = r.getDate();
            break;

          case "'":
            _("'") ? k() : b = !0;
            break;

          default:
            k();
        }
      }

      if (i.length > h && (o = i.substr(h), !/^\s+/.test(o))) throw "Extra/unparsed characters found in date: " + o;
      if (-1 === m ? m = new Date().getFullYear() : 100 > m && (m += new Date().getFullYear() - new Date().getFullYear() % 100 + (u >= m ? 0 : -100)), y > -1) for (g = 1, v = y;;) {
        if (a = this._getDaysInMonth(m, g - 1), a >= v) break;
        g++, v -= a;
      }
      if (r = this._daylightSavingAdjust(new Date(m, g - 1, v)), r.getFullYear() !== m || r.getMonth() + 1 !== g || r.getDate() !== v) throw "Invalid date";
      return r;
    },
    ATOM: "yy-mm-dd",
    COOKIE: "D, dd M yy",
    ISO_8601: "yy-mm-dd",
    RFC_822: "D, d M y",
    RFC_850: "DD, dd-M-y",
    RFC_1036: "D, d M y",
    RFC_1123: "D, d M yy",
    RFC_2822: "D, d M yy",
    RSS: "D, d M y",
    TICKS: "!",
    TIMESTAMP: "@",
    W3C: "yy-mm-dd",
    _ticksTo1970: 1e7 * 60 * 60 * 24 * (718685 + Math.floor(492.5) - Math.floor(19.7) + Math.floor(4.925)),
    formatDate: function formatDate(e, t, i) {
      if (!t) return "";

      var s,
          n = (i ? i.dayNamesShort : null) || this._defaults.dayNamesShort,
          a = (i ? i.dayNames : null) || this._defaults.dayNames,
          o = (i ? i.monthNamesShort : null) || this._defaults.monthNamesShort,
          r = (i ? i.monthNames : null) || this._defaults.monthNames,
          h = function h(t) {
        var i = e.length > s + 1 && e.charAt(s + 1) === t;
        return i && s++, i;
      },
          l = function l(e, t, i) {
        var s = "" + t;
        if (h(e)) for (; i > s.length;) {
          s = "0" + s;
        }
        return s;
      },
          u = function u(e, t, i, s) {
        return h(e) ? s[t] : i[t];
      },
          d = "",
          c = !1;

      if (t) for (s = 0; e.length > s; s++) {
        if (c) "'" !== e.charAt(s) || h("'") ? d += e.charAt(s) : c = !1;else switch (e.charAt(s)) {
          case "d":
            d += l("d", t.getDate(), 2);
            break;

          case "D":
            d += u("D", t.getDay(), n, a);
            break;

          case "o":
            d += l("o", Math.round((new Date(t.getFullYear(), t.getMonth(), t.getDate()).getTime() - new Date(t.getFullYear(), 0, 0).getTime()) / 864e5), 3);
            break;

          case "m":
            d += l("m", t.getMonth() + 1, 2);
            break;

          case "M":
            d += u("M", t.getMonth(), o, r);
            break;

          case "y":
            d += h("y") ? t.getFullYear() : (10 > t.getYear() % 100 ? "0" : "") + t.getYear() % 100;
            break;

          case "@":
            d += t.getTime();
            break;

          case "!":
            d += 1e4 * t.getTime() + this._ticksTo1970;
            break;

          case "'":
            h("'") ? d += "'" : c = !0;
            break;

          default:
            d += e.charAt(s);
        }
      }
      return d;
    },
    _possibleChars: function _possibleChars(e) {
      var t,
          i = "",
          s = !1,
          n = function n(i) {
        var s = e.length > t + 1 && e.charAt(t + 1) === i;
        return s && t++, s;
      };

      for (t = 0; e.length > t; t++) {
        if (s) "'" !== e.charAt(t) || n("'") ? i += e.charAt(t) : s = !1;else switch (e.charAt(t)) {
          case "d":
          case "m":
          case "y":
          case "@":
            i += "0123456789";
            break;

          case "D":
          case "M":
            return null;

          case "'":
            n("'") ? i += "'" : s = !0;
            break;

          default:
            i += e.charAt(t);
        }
      }

      return i;
    },
    _get: function _get(e, t) {
      return void 0 !== e.settings[t] ? e.settings[t] : this._defaults[t];
    },
    _setDateFromField: function _setDateFromField(e, t) {
      if (e.input.val() !== e.lastVal) {
        var i = this._get(e, "dateFormat"),
            s = e.lastVal = e.input ? e.input.val() : null,
            n = this._getDefaultDate(e),
            a = n,
            o = this._getFormatConfig(e);

        try {
          a = this.parseDate(i, s, o) || n;
        } catch (r) {
          s = t ? "" : s;
        }

        e.selectedDay = a.getDate(), e.drawMonth = e.selectedMonth = a.getMonth(), e.drawYear = e.selectedYear = a.getFullYear(), e.currentDay = s ? a.getDate() : 0, e.currentMonth = s ? a.getMonth() : 0, e.currentYear = s ? a.getFullYear() : 0, this._adjustInstDate(e);
      }
    },
    _getDefaultDate: function _getDefaultDate(e) {
      return this._restrictMinMax(e, this._determineDate(e, this._get(e, "defaultDate"), new Date()));
    },
    _determineDate: function _determineDate(t, i, s) {
      var n = function n(e) {
        var t = new Date();
        return t.setDate(t.getDate() + e), t;
      },
          a = function a(i) {
        try {
          return e.datepicker.parseDate(e.datepicker._get(t, "dateFormat"), i, e.datepicker._getFormatConfig(t));
        } catch (s) {}

        for (var n = (i.toLowerCase().match(/^c/) ? e.datepicker._getDate(t) : null) || new Date(), a = n.getFullYear(), o = n.getMonth(), r = n.getDate(), h = /([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g, l = h.exec(i); l;) {
          switch (l[2] || "d") {
            case "d":
            case "D":
              r += parseInt(l[1], 10);
              break;

            case "w":
            case "W":
              r += 7 * parseInt(l[1], 10);
              break;

            case "m":
            case "M":
              o += parseInt(l[1], 10), r = Math.min(r, e.datepicker._getDaysInMonth(a, o));
              break;

            case "y":
            case "Y":
              a += parseInt(l[1], 10), r = Math.min(r, e.datepicker._getDaysInMonth(a, o));
          }

          l = h.exec(i);
        }

        return new Date(a, o, r);
      },
          o = null == i || "" === i ? s : "string" == typeof i ? a(i) : "number" == typeof i ? isNaN(i) ? s : n(i) : new Date(i.getTime());

      return o = o && "Invalid Date" == "" + o ? s : o, o && (o.setHours(0), o.setMinutes(0), o.setSeconds(0), o.setMilliseconds(0)), this._daylightSavingAdjust(o);
    },
    _daylightSavingAdjust: function _daylightSavingAdjust(e) {
      return e ? (e.setHours(e.getHours() > 12 ? e.getHours() + 2 : 0), e) : null;
    },
    _setDate: function _setDate(e, t, i) {
      var s = !t,
          n = e.selectedMonth,
          a = e.selectedYear,
          o = this._restrictMinMax(e, this._determineDate(e, t, new Date()));

      e.selectedDay = e.currentDay = o.getDate(), e.drawMonth = e.selectedMonth = e.currentMonth = o.getMonth(), e.drawYear = e.selectedYear = e.currentYear = o.getFullYear(), n === e.selectedMonth && a === e.selectedYear || i || this._notifyChange(e), this._adjustInstDate(e), e.input && e.input.val(s ? "" : this._formatDate(e));
    },
    _getDate: function _getDate(e) {
      var t = !e.currentYear || e.input && "" === e.input.val() ? null : this._daylightSavingAdjust(new Date(e.currentYear, e.currentMonth, e.currentDay));
      return t;
    },
    _attachHandlers: function _attachHandlers(t) {
      var i = this._get(t, "stepMonths"),
          s = "#" + t.id.replace(/\\\\/g, "\\");

      t.dpDiv.find("[data-handler]").map(function () {
        var t = {
          prev: function prev() {
            e.datepicker._adjustDate(s, -i, "M");
          },
          next: function next() {
            e.datepicker._adjustDate(s, +i, "M");
          },
          hide: function hide() {
            e.datepicker._hideDatepicker();
          },
          today: function today() {
            e.datepicker._gotoToday(s);
          },
          selectDay: function selectDay() {
            return e.datepicker._selectDay(s, +this.getAttribute("data-month"), +this.getAttribute("data-year"), this), !1;
          },
          selectMonth: function selectMonth() {
            return e.datepicker._selectMonthYear(s, this, "M"), !1;
          },
          selectYear: function selectYear() {
            return e.datepicker._selectMonthYear(s, this, "Y"), !1;
          }
        };
        e(this).bind(this.getAttribute("data-event"), t[this.getAttribute("data-handler")]);
      });
    },
    _generateHTML: function _generateHTML(e) {
      var t,
          i,
          s,
          n,
          a,
          o,
          r,
          h,
          l,
          u,
          d,
          c,
          p,
          f,
          m,
          g,
          v,
          y,
          b,
          _,
          x,
          w,
          k,
          T,
          D,
          S,
          M,
          C,
          N,
          A,
          P,
          I,
          z,
          H,
          F,
          E,
          O,
          j,
          W,
          L = new Date(),
          R = this._daylightSavingAdjust(new Date(L.getFullYear(), L.getMonth(), L.getDate())),
          Y = this._get(e, "isRTL"),
          B = this._get(e, "showButtonPanel"),
          J = this._get(e, "hideIfNoPrevNext"),
          q = this._get(e, "navigationAsDateFormat"),
          K = this._getNumberOfMonths(e),
          V = this._get(e, "showCurrentAtPos"),
          U = this._get(e, "stepMonths"),
          Q = 1 !== K[0] || 1 !== K[1],
          G = this._daylightSavingAdjust(e.currentDay ? new Date(e.currentYear, e.currentMonth, e.currentDay) : new Date(9999, 9, 9)),
          X = this._getMinMaxDate(e, "min"),
          $ = this._getMinMaxDate(e, "max"),
          Z = e.drawMonth - V,
          et = e.drawYear;

      if (0 > Z && (Z += 12, et--), $) for (t = this._daylightSavingAdjust(new Date($.getFullYear(), $.getMonth() - K[0] * K[1] + 1, $.getDate())), t = X && X > t ? X : t; this._daylightSavingAdjust(new Date(et, Z, 1)) > t;) {
        Z--, 0 > Z && (Z = 11, et--);
      }

      for (e.drawMonth = Z, e.drawYear = et, i = this._get(e, "prevText"), i = q ? this.formatDate(i, this._daylightSavingAdjust(new Date(et, Z - U, 1)), this._getFormatConfig(e)) : i, s = this._canAdjustMonth(e, -1, et, Z) ? "<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (Y ? "e" : "w") + "'>" + i + "</span></a>" : J ? "" : "<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (Y ? "e" : "w") + "'>" + i + "</span></a>", n = this._get(e, "nextText"), n = q ? this.formatDate(n, this._daylightSavingAdjust(new Date(et, Z + U, 1)), this._getFormatConfig(e)) : n, a = this._canAdjustMonth(e, 1, et, Z) ? "<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='" + n + "'><span class='ui-icon ui-icon-circle-triangle-" + (Y ? "w" : "e") + "'>" + n + "</span></a>" : J ? "" : "<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='" + n + "'><span class='ui-icon ui-icon-circle-triangle-" + (Y ? "w" : "e") + "'>" + n + "</span></a>", o = this._get(e, "currentText"), r = this._get(e, "gotoCurrent") && e.currentDay ? G : R, o = q ? this.formatDate(o, r, this._getFormatConfig(e)) : o, h = e.inline ? "" : "<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>" + this._get(e, "closeText") + "</button>", l = B ? "<div class='ui-datepicker-buttonpane ui-widget-content'>" + (Y ? h : "") + (this._isInRange(e, r) ? "<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>" + o + "</button>" : "") + (Y ? "" : h) + "</div>" : "", u = parseInt(this._get(e, "firstDay"), 10), u = isNaN(u) ? 0 : u, d = this._get(e, "showWeek"), c = this._get(e, "dayNames"), p = this._get(e, "dayNamesMin"), f = this._get(e, "monthNames"), m = this._get(e, "monthNamesShort"), g = this._get(e, "beforeShowDay"), v = this._get(e, "showOtherMonths"), y = this._get(e, "selectOtherMonths"), b = this._getDefaultDate(e), _ = "", w = 0; K[0] > w; w++) {
        for (k = "", this.maxRows = 4, T = 0; K[1] > T; T++) {
          if (D = this._daylightSavingAdjust(new Date(et, Z, e.selectedDay)), S = " ui-corner-all", M = "", Q) {
            if (M += "<div class='ui-datepicker-group", K[1] > 1) switch (T) {
              case 0:
                M += " ui-datepicker-group-first", S = " ui-corner-" + (Y ? "right" : "left");
                break;

              case K[1] - 1:
                M += " ui-datepicker-group-last", S = " ui-corner-" + (Y ? "left" : "right");
                break;

              default:
                M += " ui-datepicker-group-middle", S = "";
            }
            M += "'>";
          }

          for (M += "<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix" + S + "'>" + (/all|left/.test(S) && 0 === w ? Y ? a : s : "") + (/all|right/.test(S) && 0 === w ? Y ? s : a : "") + this._generateMonthYearHeader(e, Z, et, X, $, w > 0 || T > 0, f, m) + "</div><table class='ui-datepicker-calendar'><thead>" + "<tr>", C = d ? "<th class='ui-datepicker-week-col'>" + this._get(e, "weekHeader") + "</th>" : "", x = 0; 7 > x; x++) {
            N = (x + u) % 7, C += "<th scope='col'" + ((x + u + 6) % 7 >= 5 ? " class='ui-datepicker-week-end'" : "") + ">" + "<span title='" + c[N] + "'>" + p[N] + "</span></th>";
          }

          for (M += C + "</tr></thead><tbody>", A = this._getDaysInMonth(et, Z), et === e.selectedYear && Z === e.selectedMonth && (e.selectedDay = Math.min(e.selectedDay, A)), P = (this._getFirstDayOfMonth(et, Z) - u + 7) % 7, I = Math.ceil((P + A) / 7), z = Q ? this.maxRows > I ? this.maxRows : I : I, this.maxRows = z, H = this._daylightSavingAdjust(new Date(et, Z, 1 - P)), F = 0; z > F; F++) {
            for (M += "<tr>", E = d ? "<td class='ui-datepicker-week-col'>" + this._get(e, "calculateWeek")(H) + "</td>" : "", x = 0; 7 > x; x++) {
              O = g ? g.apply(e.input ? e.input[0] : null, [H]) : [!0, ""], j = H.getMonth() !== Z, W = j && !y || !O[0] || X && X > H || $ && H > $, E += "<td class='" + ((x + u + 6) % 7 >= 5 ? " ui-datepicker-week-end" : "") + (j ? " ui-datepicker-other-month" : "") + (H.getTime() === D.getTime() && Z === e.selectedMonth && e._keyEvent || b.getTime() === H.getTime() && b.getTime() === D.getTime() ? " " + this._dayOverClass : "") + (W ? " " + this._unselectableClass + " ui-state-disabled" : "") + (j && !v ? "" : " " + O[1] + (H.getTime() === G.getTime() ? " " + this._currentClass : "") + (H.getTime() === R.getTime() ? " ui-datepicker-today" : "")) + "'" + (j && !v || !O[2] ? "" : " title='" + O[2].replace(/'/g, "&#39;") + "'") + (W ? "" : " data-handler='selectDay' data-event='click' data-month='" + H.getMonth() + "' data-year='" + H.getFullYear() + "'") + ">" + (j && !v ? "&#xa0;" : W ? "<span class='ui-state-default'>" + H.getDate() + "</span>" : "<a class='ui-state-default" + (H.getTime() === R.getTime() ? " ui-state-highlight" : "") + (H.getTime() === G.getTime() ? " ui-state-active" : "") + (j ? " ui-priority-secondary" : "") + "' href='#'>" + H.getDate() + "</a>") + "</td>", H.setDate(H.getDate() + 1), H = this._daylightSavingAdjust(H);
            }

            M += E + "</tr>";
          }

          Z++, Z > 11 && (Z = 0, et++), M += "</tbody></table>" + (Q ? "</div>" + (K[0] > 0 && T === K[1] - 1 ? "<div class='ui-datepicker-row-break'></div>" : "") : ""), k += M;
        }

        _ += k;
      }

      return _ += l, e._keyEvent = !1, _;
    },
    _generateMonthYearHeader: function _generateMonthYearHeader(e, t, i, s, n, a, o, r) {
      var h,
          l,
          u,
          d,
          c,
          p,
          f,
          m,
          g = this._get(e, "changeMonth"),
          v = this._get(e, "changeYear"),
          y = this._get(e, "showMonthAfterYear"),
          b = "<div class='ui-datepicker-title'>",
          _ = "";

      if (a || !g) _ += "<span class='ui-datepicker-month'>" + o[t] + "</span>";else {
        for (h = s && s.getFullYear() === i, l = n && n.getFullYear() === i, _ += "<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>", u = 0; 12 > u; u++) {
          (!h || u >= s.getMonth()) && (!l || n.getMonth() >= u) && (_ += "<option value='" + u + "'" + (u === t ? " selected='selected'" : "") + ">" + r[u] + "</option>");
        }

        _ += "</select>";
      }
      if (y || (b += _ + (!a && g && v ? "" : "&#xa0;")), !e.yearshtml) if (e.yearshtml = "", a || !v) b += "<span class='ui-datepicker-year'>" + i + "</span>";else {
        for (d = this._get(e, "yearRange").split(":"), c = new Date().getFullYear(), p = function p(e) {
          var t = e.match(/c[+\-].*/) ? i + parseInt(e.substring(1), 10) : e.match(/[+\-].*/) ? c + parseInt(e, 10) : parseInt(e, 10);
          return isNaN(t) ? c : t;
        }, f = p(d[0]), m = Math.max(f, p(d[1] || "")), f = s ? Math.max(f, s.getFullYear()) : f, m = n ? Math.min(m, n.getFullYear()) : m, e.yearshtml += "<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>"; m >= f; f++) {
          e.yearshtml += "<option value='" + f + "'" + (f === i ? " selected='selected'" : "") + ">" + f + "</option>";
        }

        e.yearshtml += "</select>", b += e.yearshtml, e.yearshtml = null;
      }
      return b += this._get(e, "yearSuffix"), y && (b += (!a && g && v ? "" : "&#xa0;") + _), b += "</div>";
    },
    _adjustInstDate: function _adjustInstDate(e, t, i) {
      var s = e.drawYear + ("Y" === i ? t : 0),
          n = e.drawMonth + ("M" === i ? t : 0),
          a = Math.min(e.selectedDay, this._getDaysInMonth(s, n)) + ("D" === i ? t : 0),
          o = this._restrictMinMax(e, this._daylightSavingAdjust(new Date(s, n, a)));

      e.selectedDay = o.getDate(), e.drawMonth = e.selectedMonth = o.getMonth(), e.drawYear = e.selectedYear = o.getFullYear(), ("M" === i || "Y" === i) && this._notifyChange(e);
    },
    _restrictMinMax: function _restrictMinMax(e, t) {
      var i = this._getMinMaxDate(e, "min"),
          s = this._getMinMaxDate(e, "max"),
          n = i && i > t ? i : t;

      return s && n > s ? s : n;
    },
    _notifyChange: function _notifyChange(e) {
      var t = this._get(e, "onChangeMonthYear");

      t && t.apply(e.input ? e.input[0] : null, [e.selectedYear, e.selectedMonth + 1, e]);
    },
    _getNumberOfMonths: function _getNumberOfMonths(e) {
      var t = this._get(e, "numberOfMonths");

      return null == t ? [1, 1] : "number" == typeof t ? [1, t] : t;
    },
    _getMinMaxDate: function _getMinMaxDate(e, t) {
      return this._determineDate(e, this._get(e, t + "Date"), null);
    },
    _getDaysInMonth: function _getDaysInMonth(e, t) {
      return 32 - this._daylightSavingAdjust(new Date(e, t, 32)).getDate();
    },
    _getFirstDayOfMonth: function _getFirstDayOfMonth(e, t) {
      return new Date(e, t, 1).getDay();
    },
    _canAdjustMonth: function _canAdjustMonth(e, t, i, s) {
      var n = this._getNumberOfMonths(e),
          a = this._daylightSavingAdjust(new Date(i, s + (0 > t ? t : n[0] * n[1]), 1));

      return 0 > t && a.setDate(this._getDaysInMonth(a.getFullYear(), a.getMonth())), this._isInRange(e, a);
    },
    _isInRange: function _isInRange(e, t) {
      var i,
          s,
          n = this._getMinMaxDate(e, "min"),
          a = this._getMinMaxDate(e, "max"),
          o = null,
          r = null,
          h = this._get(e, "yearRange");

      return h && (i = h.split(":"), s = new Date().getFullYear(), o = parseInt(i[0], 10), r = parseInt(i[1], 10), i[0].match(/[+\-].*/) && (o += s), i[1].match(/[+\-].*/) && (r += s)), (!n || t.getTime() >= n.getTime()) && (!a || t.getTime() <= a.getTime()) && (!o || t.getFullYear() >= o) && (!r || r >= t.getFullYear());
    },
    _getFormatConfig: function _getFormatConfig(e) {
      var t = this._get(e, "shortYearCutoff");

      return t = "string" != typeof t ? t : new Date().getFullYear() % 100 + parseInt(t, 10), {
        shortYearCutoff: t,
        dayNamesShort: this._get(e, "dayNamesShort"),
        dayNames: this._get(e, "dayNames"),
        monthNamesShort: this._get(e, "monthNamesShort"),
        monthNames: this._get(e, "monthNames")
      };
    },
    _formatDate: function _formatDate(e, t, i, s) {
      t || (e.currentDay = e.selectedDay, e.currentMonth = e.selectedMonth, e.currentYear = e.selectedYear);
      var n = t ? "object" == _typeof(t) ? t : this._daylightSavingAdjust(new Date(s, i, t)) : this._daylightSavingAdjust(new Date(e.currentYear, e.currentMonth, e.currentDay));
      return this.formatDate(this._get(e, "dateFormat"), n, this._getFormatConfig(e));
    }
  }), e.fn.datepicker = function (t) {
    if (!this.length) return this;
    e.datepicker.initialized || (e(document).mousedown(e.datepicker._checkExternalClick), e.datepicker.initialized = !0), 0 === e("#" + e.datepicker._mainDivId).length && e("body").append(e.datepicker.dpDiv);
    var i = Array.prototype.slice.call(arguments, 1);
    return "string" != typeof t || "isDisabled" !== t && "getDate" !== t && "widget" !== t ? "option" === t && 2 === arguments.length && "string" == typeof arguments[1] ? e.datepicker["_" + t + "Datepicker"].apply(e.datepicker, [this[0]].concat(i)) : this.each(function () {
      "string" == typeof t ? e.datepicker["_" + t + "Datepicker"].apply(e.datepicker, [this].concat(i)) : e.datepicker._attachDatepicker(this, t);
    }) : e.datepicker["_" + t + "Datepicker"].apply(e.datepicker, [this[0]].concat(i));
  }, e.datepicker = new n(), e.datepicker.initialized = !1, e.datepicker.uuid = new Date().getTime(), e.datepicker.version = "1.11.2", e.datepicker, e.widget("ui.draggable", e.ui.mouse, {
    version: "1.11.2",
    widgetEventPrefix: "drag",
    options: {
      addClasses: !0,
      appendTo: "parent",
      axis: !1,
      connectToSortable: !1,
      containment: !1,
      cursor: "auto",
      cursorAt: !1,
      grid: !1,
      handle: !1,
      helper: "original",
      iframeFix: !1,
      opacity: !1,
      refreshPositions: !1,
      revert: !1,
      revertDuration: 500,
      scope: "default",
      scroll: !0,
      scrollSensitivity: 20,
      scrollSpeed: 20,
      snap: !1,
      snapMode: "both",
      snapTolerance: 20,
      stack: !1,
      zIndex: !1,
      drag: null,
      start: null,
      stop: null
    },
    _create: function _create() {
      "original" === this.options.helper && this._setPositionRelative(), this.options.addClasses && this.element.addClass("ui-draggable"), this.options.disabled && this.element.addClass("ui-draggable-disabled"), this._setHandleClassName(), this._mouseInit();
    },
    _setOption: function _setOption(e, t) {
      this._super(e, t), "handle" === e && (this._removeHandleClassName(), this._setHandleClassName());
    },
    _destroy: function _destroy() {
      return (this.helper || this.element).is(".ui-draggable-dragging") ? (this.destroyOnClear = !0, void 0) : (this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"), this._removeHandleClassName(), this._mouseDestroy(), void 0);
    },
    _mouseCapture: function _mouseCapture(t) {
      var i = this.options;
      return this._blurActiveElement(t), this.helper || i.disabled || e(t.target).closest(".ui-resizable-handle").length > 0 ? !1 : (this.handle = this._getHandle(t), this.handle ? (this._blockFrames(i.iframeFix === !0 ? "iframe" : i.iframeFix), !0) : !1);
    },
    _blockFrames: function _blockFrames(t) {
      this.iframeBlocks = this.document.find(t).map(function () {
        var t = e(this);
        return e("<div>").css("position", "absolute").appendTo(t.parent()).outerWidth(t.outerWidth()).outerHeight(t.outerHeight()).offset(t.offset())[0];
      });
    },
    _unblockFrames: function _unblockFrames() {
      this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks);
    },
    _blurActiveElement: function _blurActiveElement(t) {
      var i = this.document[0];
      if (this.handleElement.is(t.target)) try {
        i.activeElement && "body" !== i.activeElement.nodeName.toLowerCase() && e(i.activeElement).blur();
      } catch (s) {}
    },
    _mouseStart: function _mouseStart(t) {
      var i = this.options;
      return this.helper = this._createHelper(t), this.helper.addClass("ui-draggable-dragging"), this._cacheHelperProportions(), e.ui.ddmanager && (e.ui.ddmanager.current = this), this._cacheMargins(), this.cssPosition = this.helper.css("position"), this.scrollParent = this.helper.scrollParent(!0), this.offsetParent = this.helper.offsetParent(), this.hasFixedAncestor = this.helper.parents().filter(function () {
        return "fixed" === e(this).css("position");
      }).length > 0, this.positionAbs = this.element.offset(), this._refreshOffsets(t), this.originalPosition = this.position = this._generatePosition(t, !1), this.originalPageX = t.pageX, this.originalPageY = t.pageY, i.cursorAt && this._adjustOffsetFromHelper(i.cursorAt), this._setContainment(), this._trigger("start", t) === !1 ? (this._clear(), !1) : (this._cacheHelperProportions(), e.ui.ddmanager && !i.dropBehaviour && e.ui.ddmanager.prepareOffsets(this, t), this._normalizeRightBottom(), this._mouseDrag(t, !0), e.ui.ddmanager && e.ui.ddmanager.dragStart(this, t), !0);
    },
    _refreshOffsets: function _refreshOffsets(e) {
      this.offset = {
        top: this.positionAbs.top - this.margins.top,
        left: this.positionAbs.left - this.margins.left,
        scroll: !1,
        parent: this._getParentOffset(),
        relative: this._getRelativeOffset()
      }, this.offset.click = {
        left: e.pageX - this.offset.left,
        top: e.pageY - this.offset.top
      };
    },
    _mouseDrag: function _mouseDrag(t, i) {
      if (this.hasFixedAncestor && (this.offset.parent = this._getParentOffset()), this.position = this._generatePosition(t, !0), this.positionAbs = this._convertPositionTo("absolute"), !i) {
        var s = this._uiHash();

        if (this._trigger("drag", t, s) === !1) return this._mouseUp({}), !1;
        this.position = s.position;
      }

      return this.helper[0].style.left = this.position.left + "px", this.helper[0].style.top = this.position.top + "px", e.ui.ddmanager && e.ui.ddmanager.drag(this, t), !1;
    },
    _mouseStop: function _mouseStop(t) {
      var i = this,
          s = !1;
      return e.ui.ddmanager && !this.options.dropBehaviour && (s = e.ui.ddmanager.drop(this, t)), this.dropped && (s = this.dropped, this.dropped = !1), "invalid" === this.options.revert && !s || "valid" === this.options.revert && s || this.options.revert === !0 || e.isFunction(this.options.revert) && this.options.revert.call(this.element, s) ? e(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function () {
        i._trigger("stop", t) !== !1 && i._clear();
      }) : this._trigger("stop", t) !== !1 && this._clear(), !1;
    },
    _mouseUp: function _mouseUp(t) {
      return this._unblockFrames(), e.ui.ddmanager && e.ui.ddmanager.dragStop(this, t), this.handleElement.is(t.target) && this.element.focus(), e.ui.mouse.prototype._mouseUp.call(this, t);
    },
    cancel: function cancel() {
      return this.helper.is(".ui-draggable-dragging") ? this._mouseUp({}) : this._clear(), this;
    },
    _getHandle: function _getHandle(t) {
      return this.options.handle ? !!e(t.target).closest(this.element.find(this.options.handle)).length : !0;
    },
    _setHandleClassName: function _setHandleClassName() {
      this.handleElement = this.options.handle ? this.element.find(this.options.handle) : this.element, this.handleElement.addClass("ui-draggable-handle");
    },
    _removeHandleClassName: function _removeHandleClassName() {
      this.handleElement.removeClass("ui-draggable-handle");
    },
    _createHelper: function _createHelper(t) {
      var i = this.options,
          s = e.isFunction(i.helper),
          n = s ? e(i.helper.apply(this.element[0], [t])) : "clone" === i.helper ? this.element.clone().removeAttr("id") : this.element;
      return n.parents("body").length || n.appendTo("parent" === i.appendTo ? this.element[0].parentNode : i.appendTo), s && n[0] === this.element[0] && this._setPositionRelative(), n[0] === this.element[0] || /(fixed|absolute)/.test(n.css("position")) || n.css("position", "absolute"), n;
    },
    _setPositionRelative: function _setPositionRelative() {
      /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative");
    },
    _adjustOffsetFromHelper: function _adjustOffsetFromHelper(t) {
      "string" == typeof t && (t = t.split(" ")), e.isArray(t) && (t = {
        left: +t[0],
        top: +t[1] || 0
      }), "left" in t && (this.offset.click.left = t.left + this.margins.left), "right" in t && (this.offset.click.left = this.helperProportions.width - t.right + this.margins.left), "top" in t && (this.offset.click.top = t.top + this.margins.top), "bottom" in t && (this.offset.click.top = this.helperProportions.height - t.bottom + this.margins.top);
    },
    _isRootNode: function _isRootNode(e) {
      return /(html|body)/i.test(e.tagName) || e === this.document[0];
    },
    _getParentOffset: function _getParentOffset() {
      var t = this.offsetParent.offset(),
          i = this.document[0];
      return "absolute" === this.cssPosition && this.scrollParent[0] !== i && e.contains(this.scrollParent[0], this.offsetParent[0]) && (t.left += this.scrollParent.scrollLeft(), t.top += this.scrollParent.scrollTop()), this._isRootNode(this.offsetParent[0]) && (t = {
        top: 0,
        left: 0
      }), {
        top: t.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
        left: t.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
      };
    },
    _getRelativeOffset: function _getRelativeOffset() {
      if ("relative" !== this.cssPosition) return {
        top: 0,
        left: 0
      };

      var e = this.element.position(),
          t = this._isRootNode(this.scrollParent[0]);

      return {
        top: e.top - (parseInt(this.helper.css("top"), 10) || 0) + (t ? 0 : this.scrollParent.scrollTop()),
        left: e.left - (parseInt(this.helper.css("left"), 10) || 0) + (t ? 0 : this.scrollParent.scrollLeft())
      };
    },
    _cacheMargins: function _cacheMargins() {
      this.margins = {
        left: parseInt(this.element.css("marginLeft"), 10) || 0,
        top: parseInt(this.element.css("marginTop"), 10) || 0,
        right: parseInt(this.element.css("marginRight"), 10) || 0,
        bottom: parseInt(this.element.css("marginBottom"), 10) || 0
      };
    },
    _cacheHelperProportions: function _cacheHelperProportions() {
      this.helperProportions = {
        width: this.helper.outerWidth(),
        height: this.helper.outerHeight()
      };
    },
    _setContainment: function _setContainment() {
      var t,
          i,
          s,
          n = this.options,
          a = this.document[0];
      return this.relativeContainer = null, n.containment ? "window" === n.containment ? (this.containment = [e(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, e(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, e(window).scrollLeft() + e(window).width() - this.helperProportions.width - this.margins.left, e(window).scrollTop() + (e(window).height() || a.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top], void 0) : "document" === n.containment ? (this.containment = [0, 0, e(a).width() - this.helperProportions.width - this.margins.left, (e(a).height() || a.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top], void 0) : n.containment.constructor === Array ? (this.containment = n.containment, void 0) : ("parent" === n.containment && (n.containment = this.helper[0].parentNode), i = e(n.containment), s = i[0], s && (t = /(scroll|auto)/.test(i.css("overflow")), this.containment = [(parseInt(i.css("borderLeftWidth"), 10) || 0) + (parseInt(i.css("paddingLeft"), 10) || 0), (parseInt(i.css("borderTopWidth"), 10) || 0) + (parseInt(i.css("paddingTop"), 10) || 0), (t ? Math.max(s.scrollWidth, s.offsetWidth) : s.offsetWidth) - (parseInt(i.css("borderRightWidth"), 10) || 0) - (parseInt(i.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (t ? Math.max(s.scrollHeight, s.offsetHeight) : s.offsetHeight) - (parseInt(i.css("borderBottomWidth"), 10) || 0) - (parseInt(i.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom], this.relativeContainer = i), void 0) : (this.containment = null, void 0);
    },
    _convertPositionTo: function _convertPositionTo(e, t) {
      t || (t = this.position);

      var i = "absolute" === e ? 1 : -1,
          s = this._isRootNode(this.scrollParent[0]);

      return {
        top: t.top + this.offset.relative.top * i + this.offset.parent.top * i - ("fixed" === this.cssPosition ? -this.offset.scroll.top : s ? 0 : this.offset.scroll.top) * i,
        left: t.left + this.offset.relative.left * i + this.offset.parent.left * i - ("fixed" === this.cssPosition ? -this.offset.scroll.left : s ? 0 : this.offset.scroll.left) * i
      };
    },
    _generatePosition: function _generatePosition(e, t) {
      var i,
          s,
          n,
          a,
          o = this.options,
          r = this._isRootNode(this.scrollParent[0]),
          h = e.pageX,
          l = e.pageY;

      return r && this.offset.scroll || (this.offset.scroll = {
        top: this.scrollParent.scrollTop(),
        left: this.scrollParent.scrollLeft()
      }), t && (this.containment && (this.relativeContainer ? (s = this.relativeContainer.offset(), i = [this.containment[0] + s.left, this.containment[1] + s.top, this.containment[2] + s.left, this.containment[3] + s.top]) : i = this.containment, e.pageX - this.offset.click.left < i[0] && (h = i[0] + this.offset.click.left), e.pageY - this.offset.click.top < i[1] && (l = i[1] + this.offset.click.top), e.pageX - this.offset.click.left > i[2] && (h = i[2] + this.offset.click.left), e.pageY - this.offset.click.top > i[3] && (l = i[3] + this.offset.click.top)), o.grid && (n = o.grid[1] ? this.originalPageY + Math.round((l - this.originalPageY) / o.grid[1]) * o.grid[1] : this.originalPageY, l = i ? n - this.offset.click.top >= i[1] || n - this.offset.click.top > i[3] ? n : n - this.offset.click.top >= i[1] ? n - o.grid[1] : n + o.grid[1] : n, a = o.grid[0] ? this.originalPageX + Math.round((h - this.originalPageX) / o.grid[0]) * o.grid[0] : this.originalPageX, h = i ? a - this.offset.click.left >= i[0] || a - this.offset.click.left > i[2] ? a : a - this.offset.click.left >= i[0] ? a - o.grid[0] : a + o.grid[0] : a), "y" === o.axis && (h = this.originalPageX), "x" === o.axis && (l = this.originalPageY)), {
        top: l - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.offset.scroll.top : r ? 0 : this.offset.scroll.top),
        left: h - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.offset.scroll.left : r ? 0 : this.offset.scroll.left)
      };
    },
    _clear: function _clear() {
      this.helper.removeClass("ui-draggable-dragging"), this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(), this.helper = null, this.cancelHelperRemoval = !1, this.destroyOnClear && this.destroy();
    },
    _normalizeRightBottom: function _normalizeRightBottom() {
      "y" !== this.options.axis && "auto" !== this.helper.css("right") && (this.helper.width(this.helper.width()), this.helper.css("right", "auto")), "x" !== this.options.axis && "auto" !== this.helper.css("bottom") && (this.helper.height(this.helper.height()), this.helper.css("bottom", "auto"));
    },
    _trigger: function _trigger(t, i, s) {
      return s = s || this._uiHash(), e.ui.plugin.call(this, t, [i, s, this], !0), /^(drag|start|stop)/.test(t) && (this.positionAbs = this._convertPositionTo("absolute"), s.offset = this.positionAbs), e.Widget.prototype._trigger.call(this, t, i, s);
    },
    plugins: {},
    _uiHash: function _uiHash() {
      return {
        helper: this.helper,
        position: this.position,
        originalPosition: this.originalPosition,
        offset: this.positionAbs
      };
    }
  }), e.ui.plugin.add("draggable", "connectToSortable", {
    start: function start(t, i, s) {
      var n = e.extend({}, i, {
        item: s.element
      });
      s.sortables = [], e(s.options.connectToSortable).each(function () {
        var i = e(this).sortable("instance");
        i && !i.options.disabled && (s.sortables.push(i), i.refreshPositions(), i._trigger("activate", t, n));
      });
    },
    stop: function stop(t, i, s) {
      var n = e.extend({}, i, {
        item: s.element
      });
      s.cancelHelperRemoval = !1, e.each(s.sortables, function () {
        var e = this;
        e.isOver ? (e.isOver = 0, s.cancelHelperRemoval = !0, e.cancelHelperRemoval = !1, e._storedCSS = {
          position: e.placeholder.css("position"),
          top: e.placeholder.css("top"),
          left: e.placeholder.css("left")
        }, e._mouseStop(t), e.options.helper = e.options._helper) : (e.cancelHelperRemoval = !0, e._trigger("deactivate", t, n));
      });
    },
    drag: function drag(t, i, s) {
      e.each(s.sortables, function () {
        var n = !1,
            a = this;
        a.positionAbs = s.positionAbs, a.helperProportions = s.helperProportions, a.offset.click = s.offset.click, a._intersectsWith(a.containerCache) && (n = !0, e.each(s.sortables, function () {
          return this.positionAbs = s.positionAbs, this.helperProportions = s.helperProportions, this.offset.click = s.offset.click, this !== a && this._intersectsWith(this.containerCache) && e.contains(a.element[0], this.element[0]) && (n = !1), n;
        })), n ? (a.isOver || (a.isOver = 1, a.currentItem = i.helper.appendTo(a.element).data("ui-sortable-item", !0), a.options._helper = a.options.helper, a.options.helper = function () {
          return i.helper[0];
        }, t.target = a.currentItem[0], a._mouseCapture(t, !0), a._mouseStart(t, !0, !0), a.offset.click.top = s.offset.click.top, a.offset.click.left = s.offset.click.left, a.offset.parent.left -= s.offset.parent.left - a.offset.parent.left, a.offset.parent.top -= s.offset.parent.top - a.offset.parent.top, s._trigger("toSortable", t), s.dropped = a.element, e.each(s.sortables, function () {
          this.refreshPositions();
        }), s.currentItem = s.element, a.fromOutside = s), a.currentItem && (a._mouseDrag(t), i.position = a.position)) : a.isOver && (a.isOver = 0, a.cancelHelperRemoval = !0, a.options._revert = a.options.revert, a.options.revert = !1, a._trigger("out", t, a._uiHash(a)), a._mouseStop(t, !0), a.options.revert = a.options._revert, a.options.helper = a.options._helper, a.placeholder && a.placeholder.remove(), s._refreshOffsets(t), i.position = s._generatePosition(t, !0), s._trigger("fromSortable", t), s.dropped = !1, e.each(s.sortables, function () {
          this.refreshPositions();
        }));
      });
    }
  }), e.ui.plugin.add("draggable", "cursor", {
    start: function start(t, i, s) {
      var n = e("body"),
          a = s.options;
      n.css("cursor") && (a._cursor = n.css("cursor")), n.css("cursor", a.cursor);
    },
    stop: function stop(t, i, s) {
      var n = s.options;
      n._cursor && e("body").css("cursor", n._cursor);
    }
  }), e.ui.plugin.add("draggable", "opacity", {
    start: function start(t, i, s) {
      var n = e(i.helper),
          a = s.options;
      n.css("opacity") && (a._opacity = n.css("opacity")), n.css("opacity", a.opacity);
    },
    stop: function stop(t, i, s) {
      var n = s.options;
      n._opacity && e(i.helper).css("opacity", n._opacity);
    }
  }), e.ui.plugin.add("draggable", "scroll", {
    start: function start(e, t, i) {
      i.scrollParentNotHidden || (i.scrollParentNotHidden = i.helper.scrollParent(!1)), i.scrollParentNotHidden[0] !== i.document[0] && "HTML" !== i.scrollParentNotHidden[0].tagName && (i.overflowOffset = i.scrollParentNotHidden.offset());
    },
    drag: function drag(t, i, s) {
      var n = s.options,
          a = !1,
          o = s.scrollParentNotHidden[0],
          r = s.document[0];
      o !== r && "HTML" !== o.tagName ? (n.axis && "x" === n.axis || (s.overflowOffset.top + o.offsetHeight - t.pageY < n.scrollSensitivity ? o.scrollTop = a = o.scrollTop + n.scrollSpeed : t.pageY - s.overflowOffset.top < n.scrollSensitivity && (o.scrollTop = a = o.scrollTop - n.scrollSpeed)), n.axis && "y" === n.axis || (s.overflowOffset.left + o.offsetWidth - t.pageX < n.scrollSensitivity ? o.scrollLeft = a = o.scrollLeft + n.scrollSpeed : t.pageX - s.overflowOffset.left < n.scrollSensitivity && (o.scrollLeft = a = o.scrollLeft - n.scrollSpeed))) : (n.axis && "x" === n.axis || (t.pageY - e(r).scrollTop() < n.scrollSensitivity ? a = e(r).scrollTop(e(r).scrollTop() - n.scrollSpeed) : e(window).height() - (t.pageY - e(r).scrollTop()) < n.scrollSensitivity && (a = e(r).scrollTop(e(r).scrollTop() + n.scrollSpeed))), n.axis && "y" === n.axis || (t.pageX - e(r).scrollLeft() < n.scrollSensitivity ? a = e(r).scrollLeft(e(r).scrollLeft() - n.scrollSpeed) : e(window).width() - (t.pageX - e(r).scrollLeft()) < n.scrollSensitivity && (a = e(r).scrollLeft(e(r).scrollLeft() + n.scrollSpeed)))), a !== !1 && e.ui.ddmanager && !n.dropBehaviour && e.ui.ddmanager.prepareOffsets(s, t);
    }
  }), e.ui.plugin.add("draggable", "snap", {
    start: function start(t, i, s) {
      var n = s.options;
      s.snapElements = [], e(n.snap.constructor !== String ? n.snap.items || ":data(ui-draggable)" : n.snap).each(function () {
        var t = e(this),
            i = t.offset();
        this !== s.element[0] && s.snapElements.push({
          item: this,
          width: t.outerWidth(),
          height: t.outerHeight(),
          top: i.top,
          left: i.left
        });
      });
    },
    drag: function drag(t, i, s) {
      var n,
          a,
          o,
          r,
          h,
          l,
          u,
          d,
          c,
          p,
          f = s.options,
          m = f.snapTolerance,
          g = i.offset.left,
          v = g + s.helperProportions.width,
          y = i.offset.top,
          b = y + s.helperProportions.height;

      for (c = s.snapElements.length - 1; c >= 0; c--) {
        h = s.snapElements[c].left - s.margins.left, l = h + s.snapElements[c].width, u = s.snapElements[c].top - s.margins.top, d = u + s.snapElements[c].height, h - m > v || g > l + m || u - m > b || y > d + m || !e.contains(s.snapElements[c].item.ownerDocument, s.snapElements[c].item) ? (s.snapElements[c].snapping && s.options.snap.release && s.options.snap.release.call(s.element, t, e.extend(s._uiHash(), {
          snapItem: s.snapElements[c].item
        })), s.snapElements[c].snapping = !1) : ("inner" !== f.snapMode && (n = m >= Math.abs(u - b), a = m >= Math.abs(d - y), o = m >= Math.abs(h - v), r = m >= Math.abs(l - g), n && (i.position.top = s._convertPositionTo("relative", {
          top: u - s.helperProportions.height,
          left: 0
        }).top), a && (i.position.top = s._convertPositionTo("relative", {
          top: d,
          left: 0
        }).top), o && (i.position.left = s._convertPositionTo("relative", {
          top: 0,
          left: h - s.helperProportions.width
        }).left), r && (i.position.left = s._convertPositionTo("relative", {
          top: 0,
          left: l
        }).left)), p = n || a || o || r, "outer" !== f.snapMode && (n = m >= Math.abs(u - y), a = m >= Math.abs(d - b), o = m >= Math.abs(h - g), r = m >= Math.abs(l - v), n && (i.position.top = s._convertPositionTo("relative", {
          top: u,
          left: 0
        }).top), a && (i.position.top = s._convertPositionTo("relative", {
          top: d - s.helperProportions.height,
          left: 0
        }).top), o && (i.position.left = s._convertPositionTo("relative", {
          top: 0,
          left: h
        }).left), r && (i.position.left = s._convertPositionTo("relative", {
          top: 0,
          left: l - s.helperProportions.width
        }).left)), !s.snapElements[c].snapping && (n || a || o || r || p) && s.options.snap.snap && s.options.snap.snap.call(s.element, t, e.extend(s._uiHash(), {
          snapItem: s.snapElements[c].item
        })), s.snapElements[c].snapping = n || a || o || r || p);
      }
    }
  }), e.ui.plugin.add("draggable", "stack", {
    start: function start(t, i, s) {
      var n,
          a = s.options,
          o = e.makeArray(e(a.stack)).sort(function (t, i) {
        return (parseInt(e(t).css("zIndex"), 10) || 0) - (parseInt(e(i).css("zIndex"), 10) || 0);
      });
      o.length && (n = parseInt(e(o[0]).css("zIndex"), 10) || 0, e(o).each(function (t) {
        e(this).css("zIndex", n + t);
      }), this.css("zIndex", n + o.length));
    }
  }), e.ui.plugin.add("draggable", "zIndex", {
    start: function start(t, i, s) {
      var n = e(i.helper),
          a = s.options;
      n.css("zIndex") && (a._zIndex = n.css("zIndex")), n.css("zIndex", a.zIndex);
    },
    stop: function stop(t, i, s) {
      var n = s.options;
      n._zIndex && e(i.helper).css("zIndex", n._zIndex);
    }
  }), e.ui.draggable, e.widget("ui.resizable", e.ui.mouse, {
    version: "1.11.2",
    widgetEventPrefix: "resize",
    options: {
      alsoResize: !1,
      animate: !1,
      animateDuration: "slow",
      animateEasing: "swing",
      aspectRatio: !1,
      autoHide: !1,
      containment: !1,
      ghost: !1,
      grid: !1,
      handles: "e,s,se",
      helper: !1,
      maxHeight: null,
      maxWidth: null,
      minHeight: 10,
      minWidth: 10,
      zIndex: 90,
      resize: null,
      start: null,
      stop: null
    },
    _num: function _num(e) {
      return parseInt(e, 10) || 0;
    },
    _isNumber: function _isNumber(e) {
      return !isNaN(parseInt(e, 10));
    },
    _hasScroll: function _hasScroll(t, i) {
      if ("hidden" === e(t).css("overflow")) return !1;
      var s = i && "left" === i ? "scrollLeft" : "scrollTop",
          n = !1;
      return t[s] > 0 ? !0 : (t[s] = 1, n = t[s] > 0, t[s] = 0, n);
    },
    _create: function _create() {
      var t,
          i,
          s,
          n,
          a,
          o = this,
          r = this.options;
      if (this.element.addClass("ui-resizable"), e.extend(this, {
        _aspectRatio: !!r.aspectRatio,
        aspectRatio: r.aspectRatio,
        originalElement: this.element,
        _proportionallyResizeElements: [],
        _helper: r.helper || r.ghost || r.animate ? r.helper || "ui-resizable-helper" : null
      }), this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i) && (this.element.wrap(e("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({
        position: this.element.css("position"),
        width: this.element.outerWidth(),
        height: this.element.outerHeight(),
        top: this.element.css("top"),
        left: this.element.css("left")
      })), this.element = this.element.parent().data("ui-resizable", this.element.resizable("instance")), this.elementIsWrapper = !0, this.element.css({
        marginLeft: this.originalElement.css("marginLeft"),
        marginTop: this.originalElement.css("marginTop"),
        marginRight: this.originalElement.css("marginRight"),
        marginBottom: this.originalElement.css("marginBottom")
      }), this.originalElement.css({
        marginLeft: 0,
        marginTop: 0,
        marginRight: 0,
        marginBottom: 0
      }), this.originalResizeStyle = this.originalElement.css("resize"), this.originalElement.css("resize", "none"), this._proportionallyResizeElements.push(this.originalElement.css({
        position: "static",
        zoom: 1,
        display: "block"
      })), this.originalElement.css({
        margin: this.originalElement.css("margin")
      }), this._proportionallyResize()), this.handles = r.handles || (e(".ui-resizable-handle", this.element).length ? {
        n: ".ui-resizable-n",
        e: ".ui-resizable-e",
        s: ".ui-resizable-s",
        w: ".ui-resizable-w",
        se: ".ui-resizable-se",
        sw: ".ui-resizable-sw",
        ne: ".ui-resizable-ne",
        nw: ".ui-resizable-nw"
      } : "e,s,se"), this.handles.constructor === String) for ("all" === this.handles && (this.handles = "n,e,s,w,se,sw,ne,nw"), t = this.handles.split(","), this.handles = {}, i = 0; t.length > i; i++) {
        s = e.trim(t[i]), a = "ui-resizable-" + s, n = e("<div class='ui-resizable-handle " + a + "'></div>"), n.css({
          zIndex: r.zIndex
        }), "se" === s && n.addClass("ui-icon ui-icon-gripsmall-diagonal-se"), this.handles[s] = ".ui-resizable-" + s, this.element.append(n);
      }
      this._renderAxis = function (t) {
        var i, s, n, a;
        t = t || this.element;

        for (i in this.handles) {
          this.handles[i].constructor === String && (this.handles[i] = this.element.children(this.handles[i]).first().show()), this.elementIsWrapper && this.originalElement[0].nodeName.match(/textarea|input|select|button/i) && (s = e(this.handles[i], this.element), a = /sw|ne|nw|se|n|s/.test(i) ? s.outerHeight() : s.outerWidth(), n = ["padding", /ne|nw|n/.test(i) ? "Top" : /se|sw|s/.test(i) ? "Bottom" : /^e$/.test(i) ? "Right" : "Left"].join(""), t.css(n, a), this._proportionallyResize()), e(this.handles[i]).length;
        }
      }, this._renderAxis(this.element), this._handles = e(".ui-resizable-handle", this.element).disableSelection(), this._handles.mouseover(function () {
        o.resizing || (this.className && (n = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)), o.axis = n && n[1] ? n[1] : "se");
      }), r.autoHide && (this._handles.hide(), e(this.element).addClass("ui-resizable-autohide").mouseenter(function () {
        r.disabled || (e(this).removeClass("ui-resizable-autohide"), o._handles.show());
      }).mouseleave(function () {
        r.disabled || o.resizing || (e(this).addClass("ui-resizable-autohide"), o._handles.hide());
      })), this._mouseInit();
    },
    _destroy: function _destroy() {
      this._mouseDestroy();

      var t,
          i = function i(t) {
        e(t).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove();
      };

      return this.elementIsWrapper && (i(this.element), t = this.element, this.originalElement.css({
        position: t.css("position"),
        width: t.outerWidth(),
        height: t.outerHeight(),
        top: t.css("top"),
        left: t.css("left")
      }).insertAfter(t), t.remove()), this.originalElement.css("resize", this.originalResizeStyle), i(this.originalElement), this;
    },
    _mouseCapture: function _mouseCapture(t) {
      var i,
          s,
          n = !1;

      for (i in this.handles) {
        s = e(this.handles[i])[0], (s === t.target || e.contains(s, t.target)) && (n = !0);
      }

      return !this.options.disabled && n;
    },
    _mouseStart: function _mouseStart(t) {
      var i,
          s,
          n,
          a = this.options,
          o = this.element;
      return this.resizing = !0, this._renderProxy(), i = this._num(this.helper.css("left")), s = this._num(this.helper.css("top")), a.containment && (i += e(a.containment).scrollLeft() || 0, s += e(a.containment).scrollTop() || 0), this.offset = this.helper.offset(), this.position = {
        left: i,
        top: s
      }, this.size = this._helper ? {
        width: this.helper.width(),
        height: this.helper.height()
      } : {
        width: o.width(),
        height: o.height()
      }, this.originalSize = this._helper ? {
        width: o.outerWidth(),
        height: o.outerHeight()
      } : {
        width: o.width(),
        height: o.height()
      }, this.sizeDiff = {
        width: o.outerWidth() - o.width(),
        height: o.outerHeight() - o.height()
      }, this.originalPosition = {
        left: i,
        top: s
      }, this.originalMousePosition = {
        left: t.pageX,
        top: t.pageY
      }, this.aspectRatio = "number" == typeof a.aspectRatio ? a.aspectRatio : this.originalSize.width / this.originalSize.height || 1, n = e(".ui-resizable-" + this.axis).css("cursor"), e("body").css("cursor", "auto" === n ? this.axis + "-resize" : n), o.addClass("ui-resizable-resizing"), this._propagate("start", t), !0;
    },
    _mouseDrag: function _mouseDrag(t) {
      var i,
          s,
          n = this.originalMousePosition,
          a = this.axis,
          o = t.pageX - n.left || 0,
          r = t.pageY - n.top || 0,
          h = this._change[a];
      return this._updatePrevProperties(), h ? (i = h.apply(this, [t, o, r]), this._updateVirtualBoundaries(t.shiftKey), (this._aspectRatio || t.shiftKey) && (i = this._updateRatio(i, t)), i = this._respectSize(i, t), this._updateCache(i), this._propagate("resize", t), s = this._applyChanges(), !this._helper && this._proportionallyResizeElements.length && this._proportionallyResize(), e.isEmptyObject(s) || (this._updatePrevProperties(), this._trigger("resize", t, this.ui()), this._applyChanges()), !1) : !1;
    },
    _mouseStop: function _mouseStop(t) {
      this.resizing = !1;
      var i,
          s,
          n,
          a,
          o,
          r,
          h,
          l = this.options,
          u = this;
      return this._helper && (i = this._proportionallyResizeElements, s = i.length && /textarea/i.test(i[0].nodeName), n = s && this._hasScroll(i[0], "left") ? 0 : u.sizeDiff.height, a = s ? 0 : u.sizeDiff.width, o = {
        width: u.helper.width() - a,
        height: u.helper.height() - n
      }, r = parseInt(u.element.css("left"), 10) + (u.position.left - u.originalPosition.left) || null, h = parseInt(u.element.css("top"), 10) + (u.position.top - u.originalPosition.top) || null, l.animate || this.element.css(e.extend(o, {
        top: h,
        left: r
      })), u.helper.height(u.size.height), u.helper.width(u.size.width), this._helper && !l.animate && this._proportionallyResize()), e("body").css("cursor", "auto"), this.element.removeClass("ui-resizable-resizing"), this._propagate("stop", t), this._helper && this.helper.remove(), !1;
    },
    _updatePrevProperties: function _updatePrevProperties() {
      this.prevPosition = {
        top: this.position.top,
        left: this.position.left
      }, this.prevSize = {
        width: this.size.width,
        height: this.size.height
      };
    },
    _applyChanges: function _applyChanges() {
      var e = {};
      return this.position.top !== this.prevPosition.top && (e.top = this.position.top + "px"), this.position.left !== this.prevPosition.left && (e.left = this.position.left + "px"), this.size.width !== this.prevSize.width && (e.width = this.size.width + "px"), this.size.height !== this.prevSize.height && (e.height = this.size.height + "px"), this.helper.css(e), e;
    },
    _updateVirtualBoundaries: function _updateVirtualBoundaries(e) {
      var t,
          i,
          s,
          n,
          a,
          o = this.options;
      a = {
        minWidth: this._isNumber(o.minWidth) ? o.minWidth : 0,
        maxWidth: this._isNumber(o.maxWidth) ? o.maxWidth : 1 / 0,
        minHeight: this._isNumber(o.minHeight) ? o.minHeight : 0,
        maxHeight: this._isNumber(o.maxHeight) ? o.maxHeight : 1 / 0
      }, (this._aspectRatio || e) && (t = a.minHeight * this.aspectRatio, s = a.minWidth / this.aspectRatio, i = a.maxHeight * this.aspectRatio, n = a.maxWidth / this.aspectRatio, t > a.minWidth && (a.minWidth = t), s > a.minHeight && (a.minHeight = s), a.maxWidth > i && (a.maxWidth = i), a.maxHeight > n && (a.maxHeight = n)), this._vBoundaries = a;
    },
    _updateCache: function _updateCache(e) {
      this.offset = this.helper.offset(), this._isNumber(e.left) && (this.position.left = e.left), this._isNumber(e.top) && (this.position.top = e.top), this._isNumber(e.height) && (this.size.height = e.height), this._isNumber(e.width) && (this.size.width = e.width);
    },
    _updateRatio: function _updateRatio(e) {
      var t = this.position,
          i = this.size,
          s = this.axis;
      return this._isNumber(e.height) ? e.width = e.height * this.aspectRatio : this._isNumber(e.width) && (e.height = e.width / this.aspectRatio), "sw" === s && (e.left = t.left + (i.width - e.width), e.top = null), "nw" === s && (e.top = t.top + (i.height - e.height), e.left = t.left + (i.width - e.width)), e;
    },
    _respectSize: function _respectSize(e) {
      var t = this._vBoundaries,
          i = this.axis,
          s = this._isNumber(e.width) && t.maxWidth && t.maxWidth < e.width,
          n = this._isNumber(e.height) && t.maxHeight && t.maxHeight < e.height,
          a = this._isNumber(e.width) && t.minWidth && t.minWidth > e.width,
          o = this._isNumber(e.height) && t.minHeight && t.minHeight > e.height,
          r = this.originalPosition.left + this.originalSize.width,
          h = this.position.top + this.size.height,
          l = /sw|nw|w/.test(i),
          u = /nw|ne|n/.test(i);
      return a && (e.width = t.minWidth), o && (e.height = t.minHeight), s && (e.width = t.maxWidth), n && (e.height = t.maxHeight), a && l && (e.left = r - t.minWidth), s && l && (e.left = r - t.maxWidth), o && u && (e.top = h - t.minHeight), n && u && (e.top = h - t.maxHeight), e.width || e.height || e.left || !e.top ? e.width || e.height || e.top || !e.left || (e.left = null) : e.top = null, e;
    },
    _getPaddingPlusBorderDimensions: function _getPaddingPlusBorderDimensions(e) {
      for (var t = 0, i = [], s = [e.css("borderTopWidth"), e.css("borderRightWidth"), e.css("borderBottomWidth"), e.css("borderLeftWidth")], n = [e.css("paddingTop"), e.css("paddingRight"), e.css("paddingBottom"), e.css("paddingLeft")]; 4 > t; t++) {
        i[t] = parseInt(s[t], 10) || 0, i[t] += parseInt(n[t], 10) || 0;
      }

      return {
        height: i[0] + i[2],
        width: i[1] + i[3]
      };
    },
    _proportionallyResize: function _proportionallyResize() {
      if (this._proportionallyResizeElements.length) for (var e, t = 0, i = this.helper || this.element; this._proportionallyResizeElements.length > t; t++) {
        e = this._proportionallyResizeElements[t], this.outerDimensions || (this.outerDimensions = this._getPaddingPlusBorderDimensions(e)), e.css({
          height: i.height() - this.outerDimensions.height || 0,
          width: i.width() - this.outerDimensions.width || 0
        });
      }
    },
    _renderProxy: function _renderProxy() {
      var t = this.element,
          i = this.options;
      this.elementOffset = t.offset(), this._helper ? (this.helper = this.helper || e("<div style='overflow:hidden;'></div>"), this.helper.addClass(this._helper).css({
        width: this.element.outerWidth() - 1,
        height: this.element.outerHeight() - 1,
        position: "absolute",
        left: this.elementOffset.left + "px",
        top: this.elementOffset.top + "px",
        zIndex: ++i.zIndex
      }), this.helper.appendTo("body").disableSelection()) : this.helper = this.element;
    },
    _change: {
      e: function e(_e, t) {
        return {
          width: this.originalSize.width + t
        };
      },
      w: function w(e, t) {
        var i = this.originalSize,
            s = this.originalPosition;
        return {
          left: s.left + t,
          width: i.width - t
        };
      },
      n: function n(e, t, i) {
        var s = this.originalSize,
            n = this.originalPosition;
        return {
          top: n.top + i,
          height: s.height - i
        };
      },
      s: function s(e, t, i) {
        return {
          height: this.originalSize.height + i
        };
      },
      se: function se(t, i, s) {
        return e.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [t, i, s]));
      },
      sw: function sw(t, i, s) {
        return e.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [t, i, s]));
      },
      ne: function ne(t, i, s) {
        return e.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [t, i, s]));
      },
      nw: function nw(t, i, s) {
        return e.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [t, i, s]));
      }
    },
    _propagate: function _propagate(t, i) {
      e.ui.plugin.call(this, t, [i, this.ui()]), "resize" !== t && this._trigger(t, i, this.ui());
    },
    plugins: {},
    ui: function ui() {
      return {
        originalElement: this.originalElement,
        element: this.element,
        helper: this.helper,
        position: this.position,
        size: this.size,
        originalSize: this.originalSize,
        originalPosition: this.originalPosition
      };
    }
  }), e.ui.plugin.add("resizable", "animate", {
    stop: function stop(t) {
      var i = e(this).resizable("instance"),
          s = i.options,
          n = i._proportionallyResizeElements,
          a = n.length && /textarea/i.test(n[0].nodeName),
          o = a && i._hasScroll(n[0], "left") ? 0 : i.sizeDiff.height,
          r = a ? 0 : i.sizeDiff.width,
          h = {
        width: i.size.width - r,
        height: i.size.height - o
      },
          l = parseInt(i.element.css("left"), 10) + (i.position.left - i.originalPosition.left) || null,
          u = parseInt(i.element.css("top"), 10) + (i.position.top - i.originalPosition.top) || null;
      i.element.animate(e.extend(h, u && l ? {
        top: u,
        left: l
      } : {}), {
        duration: s.animateDuration,
        easing: s.animateEasing,
        step: function step() {
          var s = {
            width: parseInt(i.element.css("width"), 10),
            height: parseInt(i.element.css("height"), 10),
            top: parseInt(i.element.css("top"), 10),
            left: parseInt(i.element.css("left"), 10)
          };
          n && n.length && e(n[0]).css({
            width: s.width,
            height: s.height
          }), i._updateCache(s), i._propagate("resize", t);
        }
      });
    }
  }), e.ui.plugin.add("resizable", "containment", {
    start: function start() {
      var t,
          i,
          s,
          n,
          a,
          o,
          r,
          h = e(this).resizable("instance"),
          l = h.options,
          u = h.element,
          d = l.containment,
          c = d instanceof e ? d.get(0) : /parent/.test(d) ? u.parent().get(0) : d;
      c && (h.containerElement = e(c), /document/.test(d) || d === document ? (h.containerOffset = {
        left: 0,
        top: 0
      }, h.containerPosition = {
        left: 0,
        top: 0
      }, h.parentData = {
        element: e(document),
        left: 0,
        top: 0,
        width: e(document).width(),
        height: e(document).height() || document.body.parentNode.scrollHeight
      }) : (t = e(c), i = [], e(["Top", "Right", "Left", "Bottom"]).each(function (e, s) {
        i[e] = h._num(t.css("padding" + s));
      }), h.containerOffset = t.offset(), h.containerPosition = t.position(), h.containerSize = {
        height: t.innerHeight() - i[3],
        width: t.innerWidth() - i[1]
      }, s = h.containerOffset, n = h.containerSize.height, a = h.containerSize.width, o = h._hasScroll(c, "left") ? c.scrollWidth : a, r = h._hasScroll(c) ? c.scrollHeight : n, h.parentData = {
        element: c,
        left: s.left,
        top: s.top,
        width: o,
        height: r
      }));
    },
    resize: function resize(t) {
      var i,
          s,
          n,
          a,
          o = e(this).resizable("instance"),
          r = o.options,
          h = o.containerOffset,
          l = o.position,
          u = o._aspectRatio || t.shiftKey,
          d = {
        top: 0,
        left: 0
      },
          c = o.containerElement,
          p = !0;
      c[0] !== document && /static/.test(c.css("position")) && (d = h), l.left < (o._helper ? h.left : 0) && (o.size.width = o.size.width + (o._helper ? o.position.left - h.left : o.position.left - d.left), u && (o.size.height = o.size.width / o.aspectRatio, p = !1), o.position.left = r.helper ? h.left : 0), l.top < (o._helper ? h.top : 0) && (o.size.height = o.size.height + (o._helper ? o.position.top - h.top : o.position.top), u && (o.size.width = o.size.height * o.aspectRatio, p = !1), o.position.top = o._helper ? h.top : 0), n = o.containerElement.get(0) === o.element.parent().get(0), a = /relative|absolute/.test(o.containerElement.css("position")), n && a ? (o.offset.left = o.parentData.left + o.position.left, o.offset.top = o.parentData.top + o.position.top) : (o.offset.left = o.element.offset().left, o.offset.top = o.element.offset().top), i = Math.abs(o.sizeDiff.width + (o._helper ? o.offset.left - d.left : o.offset.left - h.left)), s = Math.abs(o.sizeDiff.height + (o._helper ? o.offset.top - d.top : o.offset.top - h.top)), i + o.size.width >= o.parentData.width && (o.size.width = o.parentData.width - i, u && (o.size.height = o.size.width / o.aspectRatio, p = !1)), s + o.size.height >= o.parentData.height && (o.size.height = o.parentData.height - s, u && (o.size.width = o.size.height * o.aspectRatio, p = !1)), p || (o.position.left = o.prevPosition.left, o.position.top = o.prevPosition.top, o.size.width = o.prevSize.width, o.size.height = o.prevSize.height);
    },
    stop: function stop() {
      var t = e(this).resizable("instance"),
          i = t.options,
          s = t.containerOffset,
          n = t.containerPosition,
          a = t.containerElement,
          o = e(t.helper),
          r = o.offset(),
          h = o.outerWidth() - t.sizeDiff.width,
          l = o.outerHeight() - t.sizeDiff.height;
      t._helper && !i.animate && /relative/.test(a.css("position")) && e(this).css({
        left: r.left - n.left - s.left,
        width: h,
        height: l
      }), t._helper && !i.animate && /static/.test(a.css("position")) && e(this).css({
        left: r.left - n.left - s.left,
        width: h,
        height: l
      });
    }
  }), e.ui.plugin.add("resizable", "alsoResize", {
    start: function start() {
      var t = e(this).resizable("instance"),
          i = t.options,
          s = function s(t) {
        e(t).each(function () {
          var t = e(this);
          t.data("ui-resizable-alsoresize", {
            width: parseInt(t.width(), 10),
            height: parseInt(t.height(), 10),
            left: parseInt(t.css("left"), 10),
            top: parseInt(t.css("top"), 10)
          });
        });
      };

      "object" != _typeof(i.alsoResize) || i.alsoResize.parentNode ? s(i.alsoResize) : i.alsoResize.length ? (i.alsoResize = i.alsoResize[0], s(i.alsoResize)) : e.each(i.alsoResize, function (e) {
        s(e);
      });
    },
    resize: function resize(t, i) {
      var s = e(this).resizable("instance"),
          n = s.options,
          a = s.originalSize,
          o = s.originalPosition,
          r = {
        height: s.size.height - a.height || 0,
        width: s.size.width - a.width || 0,
        top: s.position.top - o.top || 0,
        left: s.position.left - o.left || 0
      },
          h = function h(t, s) {
        e(t).each(function () {
          var t = e(this),
              n = e(this).data("ui-resizable-alsoresize"),
              a = {},
              o = s && s.length ? s : t.parents(i.originalElement[0]).length ? ["width", "height"] : ["width", "height", "top", "left"];
          e.each(o, function (e, t) {
            var i = (n[t] || 0) + (r[t] || 0);
            i && i >= 0 && (a[t] = i || null);
          }), t.css(a);
        });
      };

      "object" != _typeof(n.alsoResize) || n.alsoResize.nodeType ? h(n.alsoResize) : e.each(n.alsoResize, function (e, t) {
        h(e, t);
      });
    },
    stop: function stop() {
      e(this).removeData("resizable-alsoresize");
    }
  }), e.ui.plugin.add("resizable", "ghost", {
    start: function start() {
      var t = e(this).resizable("instance"),
          i = t.options,
          s = t.size;
      t.ghost = t.originalElement.clone(), t.ghost.css({
        opacity: .25,
        display: "block",
        position: "relative",
        height: s.height,
        width: s.width,
        margin: 0,
        left: 0,
        top: 0
      }).addClass("ui-resizable-ghost").addClass("string" == typeof i.ghost ? i.ghost : ""), t.ghost.appendTo(t.helper);
    },
    resize: function resize() {
      var t = e(this).resizable("instance");
      t.ghost && t.ghost.css({
        position: "relative",
        height: t.size.height,
        width: t.size.width
      });
    },
    stop: function stop() {
      var t = e(this).resizable("instance");
      t.ghost && t.helper && t.helper.get(0).removeChild(t.ghost.get(0));
    }
  }), e.ui.plugin.add("resizable", "grid", {
    resize: function resize() {
      var t,
          i = e(this).resizable("instance"),
          s = i.options,
          n = i.size,
          a = i.originalSize,
          o = i.originalPosition,
          r = i.axis,
          h = "number" == typeof s.grid ? [s.grid, s.grid] : s.grid,
          l = h[0] || 1,
          u = h[1] || 1,
          d = Math.round((n.width - a.width) / l) * l,
          c = Math.round((n.height - a.height) / u) * u,
          p = a.width + d,
          f = a.height + c,
          m = s.maxWidth && p > s.maxWidth,
          g = s.maxHeight && f > s.maxHeight,
          v = s.minWidth && s.minWidth > p,
          y = s.minHeight && s.minHeight > f;
      s.grid = h, v && (p += l), y && (f += u), m && (p -= l), g && (f -= u), /^(se|s|e)$/.test(r) ? (i.size.width = p, i.size.height = f) : /^(ne)$/.test(r) ? (i.size.width = p, i.size.height = f, i.position.top = o.top - c) : /^(sw)$/.test(r) ? (i.size.width = p, i.size.height = f, i.position.left = o.left - d) : ((0 >= f - u || 0 >= p - l) && (t = i._getPaddingPlusBorderDimensions(this)), f - u > 0 ? (i.size.height = f, i.position.top = o.top - c) : (f = u - t.height, i.size.height = f, i.position.top = o.top + a.height - f), p - l > 0 ? (i.size.width = p, i.position.left = o.left - d) : (p = u - t.height, i.size.width = p, i.position.left = o.left + a.width - p));
    }
  }), e.ui.resizable, e.widget("ui.dialog", {
    version: "1.11.2",
    options: {
      appendTo: "body",
      autoOpen: !0,
      buttons: [],
      closeOnEscape: !0,
      closeText: "Close",
      dialogClass: "",
      draggable: !0,
      hide: null,
      height: "auto",
      maxHeight: null,
      maxWidth: null,
      minHeight: 150,
      minWidth: 150,
      modal: !1,
      position: {
        my: "center",
        at: "center",
        of: window,
        collision: "fit",
        using: function using(t) {
          var i = e(this).css(t).offset().top;
          0 > i && e(this).css("top", t.top - i);
        }
      },
      resizable: !0,
      show: null,
      title: null,
      width: 300,
      beforeClose: null,
      close: null,
      drag: null,
      dragStart: null,
      dragStop: null,
      focus: null,
      open: null,
      resize: null,
      resizeStart: null,
      resizeStop: null
    },
    sizeRelatedOptions: {
      buttons: !0,
      height: !0,
      maxHeight: !0,
      maxWidth: !0,
      minHeight: !0,
      minWidth: !0,
      width: !0
    },
    resizableRelatedOptions: {
      maxHeight: !0,
      maxWidth: !0,
      minHeight: !0,
      minWidth: !0
    },
    _create: function _create() {
      this.originalCss = {
        display: this.element[0].style.display,
        width: this.element[0].style.width,
        minHeight: this.element[0].style.minHeight,
        maxHeight: this.element[0].style.maxHeight,
        height: this.element[0].style.height
      }, this.originalPosition = {
        parent: this.element.parent(),
        index: this.element.parent().children().index(this.element)
      }, this.originalTitle = this.element.attr("title"), this.options.title = this.options.title || this.originalTitle, this._createWrapper(), this.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(this.uiDialog), this._createTitlebar(), this._createButtonPane(), this.options.draggable && e.fn.draggable && this._makeDraggable(), this.options.resizable && e.fn.resizable && this._makeResizable(), this._isOpen = !1, this._trackFocus();
    },
    _init: function _init() {
      this.options.autoOpen && this.open();
    },
    _appendTo: function _appendTo() {
      var t = this.options.appendTo;
      return t && (t.jquery || t.nodeType) ? e(t) : this.document.find(t || "body").eq(0);
    },
    _destroy: function _destroy() {
      var e,
          t = this.originalPosition;
      this._destroyOverlay(), this.element.removeUniqueId().removeClass("ui-dialog-content ui-widget-content").css(this.originalCss).detach(), this.uiDialog.stop(!0, !0).remove(), this.originalTitle && this.element.attr("title", this.originalTitle), e = t.parent.children().eq(t.index), e.length && e[0] !== this.element[0] ? e.before(this.element) : t.parent.append(this.element);
    },
    widget: function widget() {
      return this.uiDialog;
    },
    disable: e.noop,
    enable: e.noop,
    close: function close(t) {
      var i,
          s = this;

      if (this._isOpen && this._trigger("beforeClose", t) !== !1) {
        if (this._isOpen = !1, this._focusedElement = null, this._destroyOverlay(), this._untrackInstance(), !this.opener.filter(":focusable").focus().length) try {
          i = this.document[0].activeElement, i && "body" !== i.nodeName.toLowerCase() && e(i).blur();
        } catch (n) {}

        this._hide(this.uiDialog, this.options.hide, function () {
          s._trigger("close", t);
        });
      }
    },
    isOpen: function isOpen() {
      return this._isOpen;
    },
    moveToTop: function moveToTop() {
      this._moveToTop();
    },
    _moveToTop: function _moveToTop(t, i) {
      var s = !1,
          n = this.uiDialog.siblings(".ui-front:visible").map(function () {
        return +e(this).css("z-index");
      }).get(),
          a = Math.max.apply(null, n);
      return a >= +this.uiDialog.css("z-index") && (this.uiDialog.css("z-index", a + 1), s = !0), s && !i && this._trigger("focus", t), s;
    },
    open: function open() {
      var t = this;
      return this._isOpen ? (this._moveToTop() && this._focusTabbable(), void 0) : (this._isOpen = !0, this.opener = e(this.document[0].activeElement), this._size(), this._position(), this._createOverlay(), this._moveToTop(null, !0), this.overlay && this.overlay.css("z-index", this.uiDialog.css("z-index") - 1), this._show(this.uiDialog, this.options.show, function () {
        t._focusTabbable(), t._trigger("focus");
      }), this._makeFocusTarget(), this._trigger("open"), void 0);
    },
    _focusTabbable: function _focusTabbable() {
      var e = this._focusedElement;
      e || (e = this.element.find("[autofocus]")), e.length || (e = this.element.find(":tabbable")), e.length || (e = this.uiDialogButtonPane.find(":tabbable")), e.length || (e = this.uiDialogTitlebarClose.filter(":tabbable")), e.length || (e = this.uiDialog), e.eq(0).focus();
    },
    _keepFocus: function _keepFocus(t) {
      function i() {
        var t = this.document[0].activeElement,
            i = this.uiDialog[0] === t || e.contains(this.uiDialog[0], t);
        i || this._focusTabbable();
      }

      t.preventDefault(), i.call(this), this._delay(i);
    },
    _createWrapper: function _createWrapper() {
      this.uiDialog = e("<div>").addClass("ui-dialog ui-widget ui-widget-content ui-corner-all ui-front " + this.options.dialogClass).hide().attr({
        tabIndex: -1,
        role: "dialog"
      }).appendTo(this._appendTo()), this._on(this.uiDialog, {
        keydown: function keydown(t) {
          if (this.options.closeOnEscape && !t.isDefaultPrevented() && t.keyCode && t.keyCode === e.ui.keyCode.ESCAPE) return t.preventDefault(), this.close(t), void 0;

          if (t.keyCode === e.ui.keyCode.TAB && !t.isDefaultPrevented()) {
            var i = this.uiDialog.find(":tabbable"),
                s = i.filter(":first"),
                n = i.filter(":last");
            t.target !== n[0] && t.target !== this.uiDialog[0] || t.shiftKey ? t.target !== s[0] && t.target !== this.uiDialog[0] || !t.shiftKey || (this._delay(function () {
              n.focus();
            }), t.preventDefault()) : (this._delay(function () {
              s.focus();
            }), t.preventDefault());
          }
        },
        mousedown: function mousedown(e) {
          this._moveToTop(e) && this._focusTabbable();
        }
      }), this.element.find("[aria-describedby]").length || this.uiDialog.attr({
        "aria-describedby": this.element.uniqueId().attr("id")
      });
    },
    _createTitlebar: function _createTitlebar() {
      var t;
      this.uiDialogTitlebar = e("<div>").addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(this.uiDialog), this._on(this.uiDialogTitlebar, {
        mousedown: function mousedown(t) {
          e(t.target).closest(".ui-dialog-titlebar-close") || this.uiDialog.focus();
        }
      }), this.uiDialogTitlebarClose = e("<button type='button'></button>").button({
        label: this.options.closeText,
        icons: {
          primary: "ui-icon-closethick"
        },
        text: !1
      }).addClass("ui-dialog-titlebar-close").appendTo(this.uiDialogTitlebar), this._on(this.uiDialogTitlebarClose, {
        click: function click(e) {
          e.preventDefault(), this.close(e);
        }
      }), t = e("<span>").uniqueId().addClass("ui-dialog-title").prependTo(this.uiDialogTitlebar), this._title(t), this.uiDialog.attr({
        "aria-labelledby": t.attr("id")
      });
    },
    _title: function _title(e) {
      this.options.title || e.html("&#160;"), e.text(this.options.title);
    },
    _createButtonPane: function _createButtonPane() {
      this.uiDialogButtonPane = e("<div>").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"), this.uiButtonSet = e("<div>").addClass("ui-dialog-buttonset").appendTo(this.uiDialogButtonPane), this._createButtons();
    },
    _createButtons: function _createButtons() {
      var t = this,
          i = this.options.buttons;
      return this.uiDialogButtonPane.remove(), this.uiButtonSet.empty(), e.isEmptyObject(i) || e.isArray(i) && !i.length ? (this.uiDialog.removeClass("ui-dialog-buttons"), void 0) : (e.each(i, function (i, s) {
        var n, a;
        s = e.isFunction(s) ? {
          click: s,
          text: i
        } : s, s = e.extend({
          type: "button"
        }, s), n = s.click, s.click = function () {
          n.apply(t.element[0], arguments);
        }, a = {
          icons: s.icons,
          text: s.showText
        }, delete s.icons, delete s.showText, e("<button></button>", s).button(a).appendTo(t.uiButtonSet);
      }), this.uiDialog.addClass("ui-dialog-buttons"), this.uiDialogButtonPane.appendTo(this.uiDialog), void 0);
    },
    _makeDraggable: function _makeDraggable() {
      function t(e) {
        return {
          position: e.position,
          offset: e.offset
        };
      }

      var i = this,
          s = this.options;
      this.uiDialog.draggable({
        cancel: ".ui-dialog-content, .ui-dialog-titlebar-close",
        handle: ".ui-dialog-titlebar",
        containment: "document",
        start: function start(s, n) {
          e(this).addClass("ui-dialog-dragging"), i._blockFrames(), i._trigger("dragStart", s, t(n));
        },
        drag: function drag(e, s) {
          i._trigger("drag", e, t(s));
        },
        stop: function stop(n, a) {
          var o = a.offset.left - i.document.scrollLeft(),
              r = a.offset.top - i.document.scrollTop();
          s.position = {
            my: "left top",
            at: "left" + (o >= 0 ? "+" : "") + o + " " + "top" + (r >= 0 ? "+" : "") + r,
            of: i.window
          }, e(this).removeClass("ui-dialog-dragging"), i._unblockFrames(), i._trigger("dragStop", n, t(a));
        }
      });
    },
    _makeResizable: function _makeResizable() {
      function t(e) {
        return {
          originalPosition: e.originalPosition,
          originalSize: e.originalSize,
          position: e.position,
          size: e.size
        };
      }

      var i = this,
          s = this.options,
          n = s.resizable,
          a = this.uiDialog.css("position"),
          o = "string" == typeof n ? n : "n,e,s,w,se,sw,ne,nw";
      this.uiDialog.resizable({
        cancel: ".ui-dialog-content",
        containment: "document",
        alsoResize: this.element,
        maxWidth: s.maxWidth,
        maxHeight: s.maxHeight,
        minWidth: s.minWidth,
        minHeight: this._minHeight(),
        handles: o,
        start: function start(s, n) {
          e(this).addClass("ui-dialog-resizing"), i._blockFrames(), i._trigger("resizeStart", s, t(n));
        },
        resize: function resize(e, s) {
          i._trigger("resize", e, t(s));
        },
        stop: function stop(n, a) {
          var o = i.uiDialog.offset(),
              r = o.left - i.document.scrollLeft(),
              h = o.top - i.document.scrollTop();
          s.height = i.uiDialog.height(), s.width = i.uiDialog.width(), s.position = {
            my: "left top",
            at: "left" + (r >= 0 ? "+" : "") + r + " " + "top" + (h >= 0 ? "+" : "") + h,
            of: i.window
          }, e(this).removeClass("ui-dialog-resizing"), i._unblockFrames(), i._trigger("resizeStop", n, t(a));
        }
      }).css("position", a);
    },
    _trackFocus: function _trackFocus() {
      this._on(this.widget(), {
        focusin: function focusin(t) {
          this._makeFocusTarget(), this._focusedElement = e(t.target);
        }
      });
    },
    _makeFocusTarget: function _makeFocusTarget() {
      this._untrackInstance(), this._trackingInstances().unshift(this);
    },
    _untrackInstance: function _untrackInstance() {
      var t = this._trackingInstances(),
          i = e.inArray(this, t);

      -1 !== i && t.splice(i, 1);
    },
    _trackingInstances: function _trackingInstances() {
      var e = this.document.data("ui-dialog-instances");
      return e || (e = [], this.document.data("ui-dialog-instances", e)), e;
    },
    _minHeight: function _minHeight() {
      var e = this.options;
      return "auto" === e.height ? e.minHeight : Math.min(e.minHeight, e.height);
    },
    _position: function _position() {
      var e = this.uiDialog.is(":visible");
      e || this.uiDialog.show(), this.uiDialog.position(this.options.position), e || this.uiDialog.hide();
    },
    _setOptions: function _setOptions(t) {
      var i = this,
          s = !1,
          n = {};
      e.each(t, function (e, t) {
        i._setOption(e, t), e in i.sizeRelatedOptions && (s = !0), e in i.resizableRelatedOptions && (n[e] = t);
      }), s && (this._size(), this._position()), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", n);
    },
    _setOption: function _setOption(e, t) {
      var i,
          s,
          n = this.uiDialog;
      "dialogClass" === e && n.removeClass(this.options.dialogClass).addClass(t), "disabled" !== e && (this._super(e, t), "appendTo" === e && this.uiDialog.appendTo(this._appendTo()), "buttons" === e && this._createButtons(), "closeText" === e && this.uiDialogTitlebarClose.button({
        label: "" + t
      }), "draggable" === e && (i = n.is(":data(ui-draggable)"), i && !t && n.draggable("destroy"), !i && t && this._makeDraggable()), "position" === e && this._position(), "resizable" === e && (s = n.is(":data(ui-resizable)"), s && !t && n.resizable("destroy"), s && "string" == typeof t && n.resizable("option", "handles", t), s || t === !1 || this._makeResizable()), "title" === e && this._title(this.uiDialogTitlebar.find(".ui-dialog-title")));
    },
    _size: function _size() {
      var e,
          t,
          i,
          s = this.options;
      this.element.show().css({
        width: "auto",
        minHeight: 0,
        maxHeight: "none",
        height: 0
      }), s.minWidth > s.width && (s.width = s.minWidth), e = this.uiDialog.css({
        height: "auto",
        width: s.width
      }).outerHeight(), t = Math.max(0, s.minHeight - e), i = "number" == typeof s.maxHeight ? Math.max(0, s.maxHeight - e) : "none", "auto" === s.height ? this.element.css({
        minHeight: t,
        maxHeight: i,
        height: "auto"
      }) : this.element.height(Math.max(0, s.height - e)), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", "minHeight", this._minHeight());
    },
    _blockFrames: function _blockFrames() {
      this.iframeBlocks = this.document.find("iframe").map(function () {
        var t = e(this);
        return e("<div>").css({
          position: "absolute",
          width: t.outerWidth(),
          height: t.outerHeight()
        }).appendTo(t.parent()).offset(t.offset())[0];
      });
    },
    _unblockFrames: function _unblockFrames() {
      this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks);
    },
    _allowInteraction: function _allowInteraction(t) {
      return e(t.target).closest(".ui-dialog").length ? !0 : !!e(t.target).closest(".ui-datepicker").length;
    },
    _createOverlay: function _createOverlay() {
      if (this.options.modal) {
        var t = !0;
        this._delay(function () {
          t = !1;
        }), this.document.data("ui-dialog-overlays") || this._on(this.document, {
          focusin: function focusin(e) {
            t || this._allowInteraction(e) || (e.preventDefault(), this._trackingInstances()[0]._focusTabbable());
          }
        }), this.overlay = e("<div>").addClass("ui-widget-overlay ui-front").appendTo(this._appendTo()), this._on(this.overlay, {
          mousedown: "_keepFocus"
        }), this.document.data("ui-dialog-overlays", (this.document.data("ui-dialog-overlays") || 0) + 1);
      }
    },
    _destroyOverlay: function _destroyOverlay() {
      if (this.options.modal && this.overlay) {
        var e = this.document.data("ui-dialog-overlays") - 1;
        e ? this.document.data("ui-dialog-overlays", e) : this.document.unbind("focusin").removeData("ui-dialog-overlays"), this.overlay.remove(), this.overlay = null;
      }
    }
  }), e.widget("ui.droppable", {
    version: "1.11.2",
    widgetEventPrefix: "drop",
    options: {
      accept: "*",
      activeClass: !1,
      addClasses: !0,
      greedy: !1,
      hoverClass: !1,
      scope: "default",
      tolerance: "intersect",
      activate: null,
      deactivate: null,
      drop: null,
      out: null,
      over: null
    },
    _create: function _create() {
      var t,
          i = this.options,
          s = i.accept;
      this.isover = !1, this.isout = !0, this.accept = e.isFunction(s) ? s : function (e) {
        return e.is(s);
      }, this.proportions = function () {
        return arguments.length ? (t = arguments[0], void 0) : t ? t : t = {
          width: this.element[0].offsetWidth,
          height: this.element[0].offsetHeight
        };
      }, this._addToManager(i.scope), i.addClasses && this.element.addClass("ui-droppable");
    },
    _addToManager: function _addToManager(t) {
      e.ui.ddmanager.droppables[t] = e.ui.ddmanager.droppables[t] || [], e.ui.ddmanager.droppables[t].push(this);
    },
    _splice: function _splice(e) {
      for (var t = 0; e.length > t; t++) {
        e[t] === this && e.splice(t, 1);
      }
    },
    _destroy: function _destroy() {
      var t = e.ui.ddmanager.droppables[this.options.scope];
      this._splice(t), this.element.removeClass("ui-droppable ui-droppable-disabled");
    },
    _setOption: function _setOption(t, i) {
      if ("accept" === t) this.accept = e.isFunction(i) ? i : function (e) {
        return e.is(i);
      };else if ("scope" === t) {
        var s = e.ui.ddmanager.droppables[this.options.scope];
        this._splice(s), this._addToManager(i);
      }

      this._super(t, i);
    },
    _activate: function _activate(t) {
      var i = e.ui.ddmanager.current;
      this.options.activeClass && this.element.addClass(this.options.activeClass), i && this._trigger("activate", t, this.ui(i));
    },
    _deactivate: function _deactivate(t) {
      var i = e.ui.ddmanager.current;
      this.options.activeClass && this.element.removeClass(this.options.activeClass), i && this._trigger("deactivate", t, this.ui(i));
    },
    _over: function _over(t) {
      var i = e.ui.ddmanager.current;
      i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.addClass(this.options.hoverClass), this._trigger("over", t, this.ui(i)));
    },
    _out: function _out(t) {
      var i = e.ui.ddmanager.current;
      i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("out", t, this.ui(i)));
    },
    _drop: function _drop(t, i) {
      var s = i || e.ui.ddmanager.current,
          n = !1;
      return s && (s.currentItem || s.element)[0] !== this.element[0] ? (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function () {
        var i = e(this).droppable("instance");
        return i.options.greedy && !i.options.disabled && i.options.scope === s.options.scope && i.accept.call(i.element[0], s.currentItem || s.element) && e.ui.intersect(s, e.extend(i, {
          offset: i.element.offset()
        }), i.options.tolerance, t) ? (n = !0, !1) : void 0;
      }), n ? !1 : this.accept.call(this.element[0], s.currentItem || s.element) ? (this.options.activeClass && this.element.removeClass(this.options.activeClass), this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("drop", t, this.ui(s)), this.element) : !1) : !1;
    },
    ui: function ui(e) {
      return {
        draggable: e.currentItem || e.element,
        helper: e.helper,
        position: e.position,
        offset: e.positionAbs
      };
    }
  }), e.ui.intersect = function () {
    function e(e, t, i) {
      return e >= t && t + i > e;
    }

    return function (t, i, s, n) {
      if (!i.offset) return !1;
      var a = (t.positionAbs || t.position.absolute).left + t.margins.left,
          o = (t.positionAbs || t.position.absolute).top + t.margins.top,
          r = a + t.helperProportions.width,
          h = o + t.helperProportions.height,
          l = i.offset.left,
          u = i.offset.top,
          d = l + i.proportions().width,
          c = u + i.proportions().height;

      switch (s) {
        case "fit":
          return a >= l && d >= r && o >= u && c >= h;

        case "intersect":
          return a + t.helperProportions.width / 2 > l && d > r - t.helperProportions.width / 2 && o + t.helperProportions.height / 2 > u && c > h - t.helperProportions.height / 2;

        case "pointer":
          return e(n.pageY, u, i.proportions().height) && e(n.pageX, l, i.proportions().width);

        case "touch":
          return (o >= u && c >= o || h >= u && c >= h || u > o && h > c) && (a >= l && d >= a || r >= l && d >= r || l > a && r > d);

        default:
          return !1;
      }
    };
  }(), e.ui.ddmanager = {
    current: null,
    droppables: {
      "default": []
    },
    prepareOffsets: function prepareOffsets(t, i) {
      var s,
          n,
          a = e.ui.ddmanager.droppables[t.options.scope] || [],
          o = i ? i.type : null,
          r = (t.currentItem || t.element).find(":data(ui-droppable)").addBack();

      e: for (s = 0; a.length > s; s++) {
        if (!(a[s].options.disabled || t && !a[s].accept.call(a[s].element[0], t.currentItem || t.element))) {
          for (n = 0; r.length > n; n++) {
            if (r[n] === a[s].element[0]) {
              a[s].proportions().height = 0;
              continue e;
            }
          }

          a[s].visible = "none" !== a[s].element.css("display"), a[s].visible && ("mousedown" === o && a[s]._activate.call(a[s], i), a[s].offset = a[s].element.offset(), a[s].proportions({
            width: a[s].element[0].offsetWidth,
            height: a[s].element[0].offsetHeight
          }));
        }
      }
    },
    drop: function drop(t, i) {
      var s = !1;
      return e.each((e.ui.ddmanager.droppables[t.options.scope] || []).slice(), function () {
        this.options && (!this.options.disabled && this.visible && e.ui.intersect(t, this, this.options.tolerance, i) && (s = this._drop.call(this, i) || s), !this.options.disabled && this.visible && this.accept.call(this.element[0], t.currentItem || t.element) && (this.isout = !0, this.isover = !1, this._deactivate.call(this, i)));
      }), s;
    },
    dragStart: function dragStart(t, i) {
      t.element.parentsUntil("body").bind("scroll.droppable", function () {
        t.options.refreshPositions || e.ui.ddmanager.prepareOffsets(t, i);
      });
    },
    drag: function drag(t, i) {
      t.options.refreshPositions && e.ui.ddmanager.prepareOffsets(t, i), e.each(e.ui.ddmanager.droppables[t.options.scope] || [], function () {
        if (!this.options.disabled && !this.greedyChild && this.visible) {
          var s,
              n,
              a,
              o = e.ui.intersect(t, this, this.options.tolerance, i),
              r = !o && this.isover ? "isout" : o && !this.isover ? "isover" : null;
          r && (this.options.greedy && (n = this.options.scope, a = this.element.parents(":data(ui-droppable)").filter(function () {
            return e(this).droppable("instance").options.scope === n;
          }), a.length && (s = e(a[0]).droppable("instance"), s.greedyChild = "isover" === r)), s && "isover" === r && (s.isover = !1, s.isout = !0, s._out.call(s, i)), this[r] = !0, this["isout" === r ? "isover" : "isout"] = !1, this["isover" === r ? "_over" : "_out"].call(this, i), s && "isout" === r && (s.isout = !1, s.isover = !0, s._over.call(s, i)));
        }
      });
    },
    dragStop: function dragStop(t, i) {
      t.element.parentsUntil("body").unbind("scroll.droppable"), t.options.refreshPositions || e.ui.ddmanager.prepareOffsets(t, i);
    }
  }, e.ui.droppable;
  var y = "ui-effects-",
      b = e;
  e.effects = {
    effect: {}
  }, function (e, t) {
    function i(e, t, i) {
      var s = d[t.type] || {};
      return null == e ? i || !t.def ? null : t.def : (e = s.floor ? ~~e : parseFloat(e), isNaN(e) ? t.def : s.mod ? (e + s.mod) % s.mod : 0 > e ? 0 : e > s.max ? s.max : e);
    }

    function s(i) {
      var s = l(),
          n = s._rgba = [];
      return i = i.toLowerCase(), f(h, function (e, a) {
        var o,
            r = a.re.exec(i),
            h = r && a.parse(r),
            l = a.space || "rgba";
        return h ? (o = s[l](h), s[u[l].cache] = o[u[l].cache], n = s._rgba = o._rgba, !1) : t;
      }), n.length ? ("0,0,0,0" === n.join() && e.extend(n, a.transparent), s) : a[i];
    }

    function n(e, t, i) {
      return i = (i + 1) % 1, 1 > 6 * i ? e + 6 * (t - e) * i : 1 > 2 * i ? t : 2 > 3 * i ? e + 6 * (t - e) * (2 / 3 - i) : e;
    }

    var a,
        o = "backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",
        r = /^([\-+])=\s*(\d+\.?\d*)/,
        h = [{
      re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
      parse: function parse(e) {
        return [e[1], e[2], e[3], e[4]];
      }
    }, {
      re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
      parse: function parse(e) {
        return [2.55 * e[1], 2.55 * e[2], 2.55 * e[3], e[4]];
      }
    }, {
      re: /#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,
      parse: function parse(e) {
        return [parseInt(e[1], 16), parseInt(e[2], 16), parseInt(e[3], 16)];
      }
    }, {
      re: /#([a-f0-9])([a-f0-9])([a-f0-9])/,
      parse: function parse(e) {
        return [parseInt(e[1] + e[1], 16), parseInt(e[2] + e[2], 16), parseInt(e[3] + e[3], 16)];
      }
    }, {
      re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
      space: "hsla",
      parse: function parse(e) {
        return [e[1], e[2] / 100, e[3] / 100, e[4]];
      }
    }],
        l = e.Color = function (t, i, s, n) {
      return new e.Color.fn.parse(t, i, s, n);
    },
        u = {
      rgba: {
        props: {
          red: {
            idx: 0,
            type: "byte"
          },
          green: {
            idx: 1,
            type: "byte"
          },
          blue: {
            idx: 2,
            type: "byte"
          }
        }
      },
      hsla: {
        props: {
          hue: {
            idx: 0,
            type: "degrees"
          },
          saturation: {
            idx: 1,
            type: "percent"
          },
          lightness: {
            idx: 2,
            type: "percent"
          }
        }
      }
    },
        d = {
      "byte": {
        floor: !0,
        max: 255
      },
      percent: {
        max: 1
      },
      degrees: {
        mod: 360,
        floor: !0
      }
    },
        c = l.support = {},
        p = e("<p>")[0],
        f = e.each;

    p.style.cssText = "background-color:rgba(1,1,1,.5)", c.rgba = p.style.backgroundColor.indexOf("rgba") > -1, f(u, function (e, t) {
      t.cache = "_" + e, t.props.alpha = {
        idx: 3,
        type: "percent",
        def: 1
      };
    }), l.fn = e.extend(l.prototype, {
      parse: function parse(n, o, r, h) {
        if (n === t) return this._rgba = [null, null, null, null], this;
        (n.jquery || n.nodeType) && (n = e(n).css(o), o = t);
        var d = this,
            c = e.type(n),
            p = this._rgba = [];
        return o !== t && (n = [n, o, r, h], c = "array"), "string" === c ? this.parse(s(n) || a._default) : "array" === c ? (f(u.rgba.props, function (e, t) {
          p[t.idx] = i(n[t.idx], t);
        }), this) : "object" === c ? (n instanceof l ? f(u, function (e, t) {
          n[t.cache] && (d[t.cache] = n[t.cache].slice());
        }) : f(u, function (t, s) {
          var a = s.cache;
          f(s.props, function (e, t) {
            if (!d[a] && s.to) {
              if ("alpha" === e || null == n[e]) return;
              d[a] = s.to(d._rgba);
            }

            d[a][t.idx] = i(n[e], t, !0);
          }), d[a] && 0 > e.inArray(null, d[a].slice(0, 3)) && (d[a][3] = 1, s.from && (d._rgba = s.from(d[a])));
        }), this) : t;
      },
      is: function is(e) {
        var i = l(e),
            s = !0,
            n = this;
        return f(u, function (e, a) {
          var o,
              r = i[a.cache];
          return r && (o = n[a.cache] || a.to && a.to(n._rgba) || [], f(a.props, function (e, i) {
            return null != r[i.idx] ? s = r[i.idx] === o[i.idx] : t;
          })), s;
        }), s;
      },
      _space: function _space() {
        var e = [],
            t = this;
        return f(u, function (i, s) {
          t[s.cache] && e.push(i);
        }), e.pop();
      },
      transition: function transition(e, t) {
        var s = l(e),
            n = s._space(),
            a = u[n],
            o = 0 === this.alpha() ? l("transparent") : this,
            r = o[a.cache] || a.to(o._rgba),
            h = r.slice();

        return s = s[a.cache], f(a.props, function (e, n) {
          var a = n.idx,
              o = r[a],
              l = s[a],
              u = d[n.type] || {};
          null !== l && (null === o ? h[a] = l : (u.mod && (l - o > u.mod / 2 ? o += u.mod : o - l > u.mod / 2 && (o -= u.mod)), h[a] = i((l - o) * t + o, n)));
        }), this[n](h);
      },
      blend: function blend(t) {
        if (1 === this._rgba[3]) return this;

        var i = this._rgba.slice(),
            s = i.pop(),
            n = l(t)._rgba;

        return l(e.map(i, function (e, t) {
          return (1 - s) * n[t] + s * e;
        }));
      },
      toRgbaString: function toRgbaString() {
        var t = "rgba(",
            i = e.map(this._rgba, function (e, t) {
          return null == e ? t > 2 ? 1 : 0 : e;
        });
        return 1 === i[3] && (i.pop(), t = "rgb("), t + i.join() + ")";
      },
      toHslaString: function toHslaString() {
        var t = "hsla(",
            i = e.map(this.hsla(), function (e, t) {
          return null == e && (e = t > 2 ? 1 : 0), t && 3 > t && (e = Math.round(100 * e) + "%"), e;
        });
        return 1 === i[3] && (i.pop(), t = "hsl("), t + i.join() + ")";
      },
      toHexString: function toHexString(t) {
        var i = this._rgba.slice(),
            s = i.pop();

        return t && i.push(~~(255 * s)), "#" + e.map(i, function (e) {
          return e = (e || 0).toString(16), 1 === e.length ? "0" + e : e;
        }).join("");
      },
      toString: function toString() {
        return 0 === this._rgba[3] ? "transparent" : this.toRgbaString();
      }
    }), l.fn.parse.prototype = l.fn, u.hsla.to = function (e) {
      if (null == e[0] || null == e[1] || null == e[2]) return [null, null, null, e[3]];
      var t,
          i,
          s = e[0] / 255,
          n = e[1] / 255,
          a = e[2] / 255,
          o = e[3],
          r = Math.max(s, n, a),
          h = Math.min(s, n, a),
          l = r - h,
          u = r + h,
          d = .5 * u;
      return t = h === r ? 0 : s === r ? 60 * (n - a) / l + 360 : n === r ? 60 * (a - s) / l + 120 : 60 * (s - n) / l + 240, i = 0 === l ? 0 : .5 >= d ? l / u : l / (2 - u), [Math.round(t) % 360, i, d, null == o ? 1 : o];
    }, u.hsla.from = function (e) {
      if (null == e[0] || null == e[1] || null == e[2]) return [null, null, null, e[3]];
      var t = e[0] / 360,
          i = e[1],
          s = e[2],
          a = e[3],
          o = .5 >= s ? s * (1 + i) : s + i - s * i,
          r = 2 * s - o;
      return [Math.round(255 * n(r, o, t + 1 / 3)), Math.round(255 * n(r, o, t)), Math.round(255 * n(r, o, t - 1 / 3)), a];
    }, f(u, function (s, n) {
      var a = n.props,
          o = n.cache,
          h = n.to,
          u = n.from;
      l.fn[s] = function (s) {
        if (h && !this[o] && (this[o] = h(this._rgba)), s === t) return this[o].slice();
        var n,
            r = e.type(s),
            d = "array" === r || "object" === r ? s : arguments,
            c = this[o].slice();
        return f(a, function (e, t) {
          var s = d["object" === r ? e : t.idx];
          null == s && (s = c[t.idx]), c[t.idx] = i(s, t);
        }), u ? (n = l(u(c)), n[o] = c, n) : l(c);
      }, f(a, function (t, i) {
        l.fn[t] || (l.fn[t] = function (n) {
          var a,
              o = e.type(n),
              h = "alpha" === t ? this._hsla ? "hsla" : "rgba" : s,
              l = this[h](),
              u = l[i.idx];
          return "undefined" === o ? u : ("function" === o && (n = n.call(this, u), o = e.type(n)), null == n && i.empty ? this : ("string" === o && (a = r.exec(n), a && (n = u + parseFloat(a[2]) * ("+" === a[1] ? 1 : -1))), l[i.idx] = n, this[h](l)));
        });
      });
    }), l.hook = function (t) {
      var i = t.split(" ");
      f(i, function (t, i) {
        e.cssHooks[i] = {
          set: function set(t, n) {
            var a,
                o,
                r = "";

            if ("transparent" !== n && ("string" !== e.type(n) || (a = s(n)))) {
              if (n = l(a || n), !c.rgba && 1 !== n._rgba[3]) {
                for (o = "backgroundColor" === i ? t.parentNode : t; ("" === r || "transparent" === r) && o && o.style;) {
                  try {
                    r = e.css(o, "backgroundColor"), o = o.parentNode;
                  } catch (h) {}
                }

                n = n.blend(r && "transparent" !== r ? r : "_default");
              }

              n = n.toRgbaString();
            }

            try {
              t.style[i] = n;
            } catch (h) {}
          }
        }, e.fx.step[i] = function (t) {
          t.colorInit || (t.start = l(t.elem, i), t.end = l(t.end), t.colorInit = !0), e.cssHooks[i].set(t.elem, t.start.transition(t.end, t.pos));
        };
      });
    }, l.hook(o), e.cssHooks.borderColor = {
      expand: function expand(e) {
        var t = {};
        return f(["Top", "Right", "Bottom", "Left"], function (i, s) {
          t["border" + s + "Color"] = e;
        }), t;
      }
    }, a = e.Color.names = {
      aqua: "#00ffff",
      black: "#000000",
      blue: "#0000ff",
      fuchsia: "#ff00ff",
      gray: "#808080",
      green: "#008000",
      lime: "#00ff00",
      maroon: "#800000",
      navy: "#000080",
      olive: "#808000",
      purple: "#800080",
      red: "#ff0000",
      silver: "#c0c0c0",
      teal: "#008080",
      white: "#ffffff",
      yellow: "#ffff00",
      transparent: [null, null, null, 0],
      _default: "#ffffff"
    };
  }(b), function () {
    function t(t) {
      var i,
          s,
          n = t.ownerDocument.defaultView ? t.ownerDocument.defaultView.getComputedStyle(t, null) : t.currentStyle,
          a = {};
      if (n && n.length && n[0] && n[n[0]]) for (s = n.length; s--;) {
        i = n[s], "string" == typeof n[i] && (a[e.camelCase(i)] = n[i]);
      } else for (i in n) {
        "string" == typeof n[i] && (a[i] = n[i]);
      }
      return a;
    }

    function i(t, i) {
      var s,
          a,
          o = {};

      for (s in i) {
        a = i[s], t[s] !== a && (n[s] || (e.fx.step[s] || !isNaN(parseFloat(a))) && (o[s] = a));
      }

      return o;
    }

    var s = ["add", "remove", "toggle"],
        n = {
      border: 1,
      borderBottom: 1,
      borderColor: 1,
      borderLeft: 1,
      borderRight: 1,
      borderTop: 1,
      borderWidth: 1,
      margin: 1,
      padding: 1
    };
    e.each(["borderLeftStyle", "borderRightStyle", "borderBottomStyle", "borderTopStyle"], function (t, i) {
      e.fx.step[i] = function (e) {
        ("none" !== e.end && !e.setAttr || 1 === e.pos && !e.setAttr) && (b.style(e.elem, i, e.end), e.setAttr = !0);
      };
    }), e.fn.addBack || (e.fn.addBack = function (e) {
      return this.add(null == e ? this.prevObject : this.prevObject.filter(e));
    }), e.effects.animateClass = function (n, a, o, r) {
      var h = e.speed(a, o, r);
      return this.queue(function () {
        var a,
            o = e(this),
            r = o.attr("class") || "",
            l = h.children ? o.find("*").addBack() : o;
        l = l.map(function () {
          var i = e(this);
          return {
            el: i,
            start: t(this)
          };
        }), a = function a() {
          e.each(s, function (e, t) {
            n[t] && o[t + "Class"](n[t]);
          });
        }, a(), l = l.map(function () {
          return this.end = t(this.el[0]), this.diff = i(this.start, this.end), this;
        }), o.attr("class", r), l = l.map(function () {
          var t = this,
              i = e.Deferred(),
              s = e.extend({}, h, {
            queue: !1,
            complete: function complete() {
              i.resolve(t);
            }
          });
          return this.el.animate(this.diff, s), i.promise();
        }), e.when.apply(e, l.get()).done(function () {
          a(), e.each(arguments, function () {
            var t = this.el;
            e.each(this.diff, function (e) {
              t.css(e, "");
            });
          }), h.complete.call(o[0]);
        });
      });
    }, e.fn.extend({
      addClass: function (t) {
        return function (i, s, n, a) {
          return s ? e.effects.animateClass.call(this, {
            add: i
          }, s, n, a) : t.apply(this, arguments);
        };
      }(e.fn.addClass),
      removeClass: function (t) {
        return function (i, s, n, a) {
          return arguments.length > 1 ? e.effects.animateClass.call(this, {
            remove: i
          }, s, n, a) : t.apply(this, arguments);
        };
      }(e.fn.removeClass),
      toggleClass: function (t) {
        return function (i, s, n, a, o) {
          return "boolean" == typeof s || void 0 === s ? n ? e.effects.animateClass.call(this, s ? {
            add: i
          } : {
            remove: i
          }, n, a, o) : t.apply(this, arguments) : e.effects.animateClass.call(this, {
            toggle: i
          }, s, n, a);
        };
      }(e.fn.toggleClass),
      switchClass: function switchClass(t, i, s, n, a) {
        return e.effects.animateClass.call(this, {
          add: i,
          remove: t
        }, s, n, a);
      }
    });
  }(), function () {
    function t(t, i, s, n) {
      return e.isPlainObject(t) && (i = t, t = t.effect), t = {
        effect: t
      }, null == i && (i = {}), e.isFunction(i) && (n = i, s = null, i = {}), ("number" == typeof i || e.fx.speeds[i]) && (n = s, s = i, i = {}), e.isFunction(s) && (n = s, s = null), i && e.extend(t, i), s = s || i.duration, t.duration = e.fx.off ? 0 : "number" == typeof s ? s : s in e.fx.speeds ? e.fx.speeds[s] : e.fx.speeds._default, t.complete = n || i.complete, t;
    }

    function i(t) {
      return !t || "number" == typeof t || e.fx.speeds[t] ? !0 : "string" != typeof t || e.effects.effect[t] ? e.isFunction(t) ? !0 : "object" != _typeof(t) || t.effect ? !1 : !0 : !0;
    }

    e.extend(e.effects, {
      version: "1.11.2",
      save: function save(e, t) {
        for (var i = 0; t.length > i; i++) {
          null !== t[i] && e.data(y + t[i], e[0].style[t[i]]);
        }
      },
      restore: function restore(e, t) {
        var i, s;

        for (s = 0; t.length > s; s++) {
          null !== t[s] && (i = e.data(y + t[s]), void 0 === i && (i = ""), e.css(t[s], i));
        }
      },
      setMode: function setMode(e, t) {
        return "toggle" === t && (t = e.is(":hidden") ? "show" : "hide"), t;
      },
      getBaseline: function getBaseline(e, t) {
        var i, s;

        switch (e[0]) {
          case "top":
            i = 0;
            break;

          case "middle":
            i = .5;
            break;

          case "bottom":
            i = 1;
            break;

          default:
            i = e[0] / t.height;
        }

        switch (e[1]) {
          case "left":
            s = 0;
            break;

          case "center":
            s = .5;
            break;

          case "right":
            s = 1;
            break;

          default:
            s = e[1] / t.width;
        }

        return {
          x: s,
          y: i
        };
      },
      createWrapper: function createWrapper(t) {
        if (t.parent().is(".ui-effects-wrapper")) return t.parent();
        var i = {
          width: t.outerWidth(!0),
          height: t.outerHeight(!0),
          "float": t.css("float")
        },
            s = e("<div></div>").addClass("ui-effects-wrapper").css({
          fontSize: "100%",
          background: "transparent",
          border: "none",
          margin: 0,
          padding: 0
        }),
            n = {
          width: t.width(),
          height: t.height()
        },
            a = document.activeElement;

        try {
          a.id;
        } catch (o) {
          a = document.body;
        }

        return t.wrap(s), (t[0] === a || e.contains(t[0], a)) && e(a).focus(), s = t.parent(), "static" === t.css("position") ? (s.css({
          position: "relative"
        }), t.css({
          position: "relative"
        })) : (e.extend(i, {
          position: t.css("position"),
          zIndex: t.css("z-index")
        }), e.each(["top", "left", "bottom", "right"], function (e, s) {
          i[s] = t.css(s), isNaN(parseInt(i[s], 10)) && (i[s] = "auto");
        }), t.css({
          position: "relative",
          top: 0,
          left: 0,
          right: "auto",
          bottom: "auto"
        })), t.css(n), s.css(i).show();
      },
      removeWrapper: function removeWrapper(t) {
        var i = document.activeElement;
        return t.parent().is(".ui-effects-wrapper") && (t.parent().replaceWith(t), (t[0] === i || e.contains(t[0], i)) && e(i).focus()), t;
      },
      setTransition: function setTransition(t, i, s, n) {
        return n = n || {}, e.each(i, function (e, i) {
          var a = t.cssUnit(i);
          a[0] > 0 && (n[i] = a[0] * s + a[1]);
        }), n;
      }
    }), e.fn.extend({
      effect: function effect() {
        function i(t) {
          function i() {
            e.isFunction(a) && a.call(n[0]), e.isFunction(t) && t();
          }

          var n = e(this),
              a = s.complete,
              r = s.mode;
          (n.is(":hidden") ? "hide" === r : "show" === r) ? (n[r](), i()) : o.call(n[0], s, i);
        }

        var s = t.apply(this, arguments),
            n = s.mode,
            a = s.queue,
            o = e.effects.effect[s.effect];
        return e.fx.off || !o ? n ? this[n](s.duration, s.complete) : this.each(function () {
          s.complete && s.complete.call(this);
        }) : a === !1 ? this.each(i) : this.queue(a || "fx", i);
      },
      show: function (e) {
        return function (s) {
          if (i(s)) return e.apply(this, arguments);
          var n = t.apply(this, arguments);
          return n.mode = "show", this.effect.call(this, n);
        };
      }(e.fn.show),
      hide: function (e) {
        return function (s) {
          if (i(s)) return e.apply(this, arguments);
          var n = t.apply(this, arguments);
          return n.mode = "hide", this.effect.call(this, n);
        };
      }(e.fn.hide),
      toggle: function (e) {
        return function (s) {
          if (i(s) || "boolean" == typeof s) return e.apply(this, arguments);
          var n = t.apply(this, arguments);
          return n.mode = "toggle", this.effect.call(this, n);
        };
      }(e.fn.toggle),
      cssUnit: function cssUnit(t) {
        var i = this.css(t),
            s = [];
        return e.each(["em", "px", "%", "pt"], function (e, t) {
          i.indexOf(t) > 0 && (s = [parseFloat(i), t]);
        }), s;
      }
    });
  }(), function () {
    var t = {};
    e.each(["Quad", "Cubic", "Quart", "Quint", "Expo"], function (e, i) {
      t[i] = function (t) {
        return Math.pow(t, e + 2);
      };
    }), e.extend(t, {
      Sine: function Sine(e) {
        return 1 - Math.cos(e * Math.PI / 2);
      },
      Circ: function Circ(e) {
        return 1 - Math.sqrt(1 - e * e);
      },
      Elastic: function Elastic(e) {
        return 0 === e || 1 === e ? e : -Math.pow(2, 8 * (e - 1)) * Math.sin((80 * (e - 1) - 7.5) * Math.PI / 15);
      },
      Back: function Back(e) {
        return e * e * (3 * e - 2);
      },
      Bounce: function Bounce(e) {
        for (var t, i = 4; ((t = Math.pow(2, --i)) - 1) / 11 > e;) {
          ;
        }

        return 1 / Math.pow(4, 3 - i) - 7.5625 * Math.pow((3 * t - 2) / 22 - e, 2);
      }
    }), e.each(t, function (t, i) {
      e.easing["easeIn" + t] = i, e.easing["easeOut" + t] = function (e) {
        return 1 - i(1 - e);
      }, e.easing["easeInOut" + t] = function (e) {
        return .5 > e ? i(2 * e) / 2 : 1 - i(-2 * e + 2) / 2;
      };
    });
  }(), e.effects, e.effects.effect.blind = function (t, i) {
    var s,
        n,
        a,
        o = e(this),
        r = /up|down|vertical/,
        h = /up|left|vertical|horizontal/,
        l = ["position", "top", "bottom", "left", "right", "height", "width"],
        u = e.effects.setMode(o, t.mode || "hide"),
        d = t.direction || "up",
        c = r.test(d),
        p = c ? "height" : "width",
        f = c ? "top" : "left",
        m = h.test(d),
        g = {},
        v = "show" === u;
    o.parent().is(".ui-effects-wrapper") ? e.effects.save(o.parent(), l) : e.effects.save(o, l), o.show(), s = e.effects.createWrapper(o).css({
      overflow: "hidden"
    }), n = s[p](), a = parseFloat(s.css(f)) || 0, g[p] = v ? n : 0, m || (o.css(c ? "bottom" : "right", 0).css(c ? "top" : "left", "auto").css({
      position: "absolute"
    }), g[f] = v ? a : n + a), v && (s.css(p, 0), m || s.css(f, a + n)), s.animate(g, {
      duration: t.duration,
      easing: t.easing,
      queue: !1,
      complete: function complete() {
        "hide" === u && o.hide(), e.effects.restore(o, l), e.effects.removeWrapper(o), i();
      }
    });
  }, e.effects.effect.bounce = function (t, i) {
    var s,
        n,
        a,
        o = e(this),
        r = ["position", "top", "bottom", "left", "right", "height", "width"],
        h = e.effects.setMode(o, t.mode || "effect"),
        l = "hide" === h,
        u = "show" === h,
        d = t.direction || "up",
        c = t.distance,
        p = t.times || 5,
        f = 2 * p + (u || l ? 1 : 0),
        m = t.duration / f,
        g = t.easing,
        v = "up" === d || "down" === d ? "top" : "left",
        y = "up" === d || "left" === d,
        b = o.queue(),
        _ = b.length;

    for ((u || l) && r.push("opacity"), e.effects.save(o, r), o.show(), e.effects.createWrapper(o), c || (c = o["top" === v ? "outerHeight" : "outerWidth"]() / 3), u && (a = {
      opacity: 1
    }, a[v] = 0, o.css("opacity", 0).css(v, y ? 2 * -c : 2 * c).animate(a, m, g)), l && (c /= Math.pow(2, p - 1)), a = {}, a[v] = 0, s = 0; p > s; s++) {
      n = {}, n[v] = (y ? "-=" : "+=") + c, o.animate(n, m, g).animate(a, m, g), c = l ? 2 * c : c / 2;
    }

    l && (n = {
      opacity: 0
    }, n[v] = (y ? "-=" : "+=") + c, o.animate(n, m, g)), o.queue(function () {
      l && o.hide(), e.effects.restore(o, r), e.effects.removeWrapper(o), i();
    }), _ > 1 && b.splice.apply(b, [1, 0].concat(b.splice(_, f + 1))), o.dequeue();
  }, e.effects.effect.clip = function (t, i) {
    var s,
        n,
        a,
        o = e(this),
        r = ["position", "top", "bottom", "left", "right", "height", "width"],
        h = e.effects.setMode(o, t.mode || "hide"),
        l = "show" === h,
        u = t.direction || "vertical",
        d = "vertical" === u,
        c = d ? "height" : "width",
        p = d ? "top" : "left",
        f = {};
    e.effects.save(o, r), o.show(), s = e.effects.createWrapper(o).css({
      overflow: "hidden"
    }), n = "IMG" === o[0].tagName ? s : o, a = n[c](), l && (n.css(c, 0), n.css(p, a / 2)), f[c] = l ? a : 0, f[p] = l ? 0 : a / 2, n.animate(f, {
      queue: !1,
      duration: t.duration,
      easing: t.easing,
      complete: function complete() {
        l || o.hide(), e.effects.restore(o, r), e.effects.removeWrapper(o), i();
      }
    });
  }, e.effects.effect.drop = function (t, i) {
    var s,
        n = e(this),
        a = ["position", "top", "bottom", "left", "right", "opacity", "height", "width"],
        o = e.effects.setMode(n, t.mode || "hide"),
        r = "show" === o,
        h = t.direction || "left",
        l = "up" === h || "down" === h ? "top" : "left",
        u = "up" === h || "left" === h ? "pos" : "neg",
        d = {
      opacity: r ? 1 : 0
    };
    e.effects.save(n, a), n.show(), e.effects.createWrapper(n), s = t.distance || n["top" === l ? "outerHeight" : "outerWidth"](!0) / 2, r && n.css("opacity", 0).css(l, "pos" === u ? -s : s), d[l] = (r ? "pos" === u ? "+=" : "-=" : "pos" === u ? "-=" : "+=") + s, n.animate(d, {
      queue: !1,
      duration: t.duration,
      easing: t.easing,
      complete: function complete() {
        "hide" === o && n.hide(), e.effects.restore(n, a), e.effects.removeWrapper(n), i();
      }
    });
  }, e.effects.effect.explode = function (t, i) {
    function s() {
      b.push(this), b.length === d * c && n();
    }

    function n() {
      p.css({
        visibility: "visible"
      }), e(b).remove(), m || p.hide(), i();
    }

    var a,
        o,
        r,
        h,
        l,
        u,
        d = t.pieces ? Math.round(Math.sqrt(t.pieces)) : 3,
        c = d,
        p = e(this),
        f = e.effects.setMode(p, t.mode || "hide"),
        m = "show" === f,
        g = p.show().css("visibility", "hidden").offset(),
        v = Math.ceil(p.outerWidth() / c),
        y = Math.ceil(p.outerHeight() / d),
        b = [];

    for (a = 0; d > a; a++) {
      for (h = g.top + a * y, u = a - (d - 1) / 2, o = 0; c > o; o++) {
        r = g.left + o * v, l = o - (c - 1) / 2, p.clone().appendTo("body").wrap("<div></div>").css({
          position: "absolute",
          visibility: "visible",
          left: -o * v,
          top: -a * y
        }).parent().addClass("ui-effects-explode").css({
          position: "absolute",
          overflow: "hidden",
          width: v,
          height: y,
          left: r + (m ? l * v : 0),
          top: h + (m ? u * y : 0),
          opacity: m ? 0 : 1
        }).animate({
          left: r + (m ? 0 : l * v),
          top: h + (m ? 0 : u * y),
          opacity: m ? 1 : 0
        }, t.duration || 500, t.easing, s);
      }
    }
  }, e.effects.effect.fade = function (t, i) {
    var s = e(this),
        n = e.effects.setMode(s, t.mode || "toggle");
    s.animate({
      opacity: n
    }, {
      queue: !1,
      duration: t.duration,
      easing: t.easing,
      complete: i
    });
  }, e.effects.effect.fold = function (t, i) {
    var s,
        n,
        a = e(this),
        o = ["position", "top", "bottom", "left", "right", "height", "width"],
        r = e.effects.setMode(a, t.mode || "hide"),
        h = "show" === r,
        l = "hide" === r,
        u = t.size || 15,
        d = /([0-9]+)%/.exec(u),
        c = !!t.horizFirst,
        p = h !== c,
        f = p ? ["width", "height"] : ["height", "width"],
        m = t.duration / 2,
        g = {},
        v = {};
    e.effects.save(a, o), a.show(), s = e.effects.createWrapper(a).css({
      overflow: "hidden"
    }), n = p ? [s.width(), s.height()] : [s.height(), s.width()], d && (u = parseInt(d[1], 10) / 100 * n[l ? 0 : 1]), h && s.css(c ? {
      height: 0,
      width: u
    } : {
      height: u,
      width: 0
    }), g[f[0]] = h ? n[0] : u, v[f[1]] = h ? n[1] : 0, s.animate(g, m, t.easing).animate(v, m, t.easing, function () {
      l && a.hide(), e.effects.restore(a, o), e.effects.removeWrapper(a), i();
    });
  }, e.effects.effect.highlight = function (t, i) {
    var s = e(this),
        n = ["backgroundImage", "backgroundColor", "opacity"],
        a = e.effects.setMode(s, t.mode || "show"),
        o = {
      backgroundColor: s.css("backgroundColor")
    };
    "hide" === a && (o.opacity = 0), e.effects.save(s, n), s.show().css({
      backgroundImage: "none",
      backgroundColor: t.color || "#ffff99"
    }).animate(o, {
      queue: !1,
      duration: t.duration,
      easing: t.easing,
      complete: function complete() {
        "hide" === a && s.hide(), e.effects.restore(s, n), i();
      }
    });
  }, e.effects.effect.size = function (t, i) {
    var s,
        n,
        a,
        o = e(this),
        r = ["position", "top", "bottom", "left", "right", "width", "height", "overflow", "opacity"],
        h = ["position", "top", "bottom", "left", "right", "overflow", "opacity"],
        l = ["width", "height", "overflow"],
        u = ["fontSize"],
        d = ["borderTopWidth", "borderBottomWidth", "paddingTop", "paddingBottom"],
        c = ["borderLeftWidth", "borderRightWidth", "paddingLeft", "paddingRight"],
        p = e.effects.setMode(o, t.mode || "effect"),
        f = t.restore || "effect" !== p,
        m = t.scale || "both",
        g = t.origin || ["middle", "center"],
        v = o.css("position"),
        y = f ? r : h,
        b = {
      height: 0,
      width: 0,
      outerHeight: 0,
      outerWidth: 0
    };
    "show" === p && o.show(), s = {
      height: o.height(),
      width: o.width(),
      outerHeight: o.outerHeight(),
      outerWidth: o.outerWidth()
    }, "toggle" === t.mode && "show" === p ? (o.from = t.to || b, o.to = t.from || s) : (o.from = t.from || ("show" === p ? b : s), o.to = t.to || ("hide" === p ? b : s)), a = {
      from: {
        y: o.from.height / s.height,
        x: o.from.width / s.width
      },
      to: {
        y: o.to.height / s.height,
        x: o.to.width / s.width
      }
    }, ("box" === m || "both" === m) && (a.from.y !== a.to.y && (y = y.concat(d), o.from = e.effects.setTransition(o, d, a.from.y, o.from), o.to = e.effects.setTransition(o, d, a.to.y, o.to)), a.from.x !== a.to.x && (y = y.concat(c), o.from = e.effects.setTransition(o, c, a.from.x, o.from), o.to = e.effects.setTransition(o, c, a.to.x, o.to))), ("content" === m || "both" === m) && a.from.y !== a.to.y && (y = y.concat(u).concat(l), o.from = e.effects.setTransition(o, u, a.from.y, o.from), o.to = e.effects.setTransition(o, u, a.to.y, o.to)), e.effects.save(o, y), o.show(), e.effects.createWrapper(o), o.css("overflow", "hidden").css(o.from), g && (n = e.effects.getBaseline(g, s), o.from.top = (s.outerHeight - o.outerHeight()) * n.y, o.from.left = (s.outerWidth - o.outerWidth()) * n.x, o.to.top = (s.outerHeight - o.to.outerHeight) * n.y, o.to.left = (s.outerWidth - o.to.outerWidth) * n.x), o.css(o.from), ("content" === m || "both" === m) && (d = d.concat(["marginTop", "marginBottom"]).concat(u), c = c.concat(["marginLeft", "marginRight"]), l = r.concat(d).concat(c), o.find("*[width]").each(function () {
      var i = e(this),
          s = {
        height: i.height(),
        width: i.width(),
        outerHeight: i.outerHeight(),
        outerWidth: i.outerWidth()
      };
      f && e.effects.save(i, l), i.from = {
        height: s.height * a.from.y,
        width: s.width * a.from.x,
        outerHeight: s.outerHeight * a.from.y,
        outerWidth: s.outerWidth * a.from.x
      }, i.to = {
        height: s.height * a.to.y,
        width: s.width * a.to.x,
        outerHeight: s.height * a.to.y,
        outerWidth: s.width * a.to.x
      }, a.from.y !== a.to.y && (i.from = e.effects.setTransition(i, d, a.from.y, i.from), i.to = e.effects.setTransition(i, d, a.to.y, i.to)), a.from.x !== a.to.x && (i.from = e.effects.setTransition(i, c, a.from.x, i.from), i.to = e.effects.setTransition(i, c, a.to.x, i.to)), i.css(i.from), i.animate(i.to, t.duration, t.easing, function () {
        f && e.effects.restore(i, l);
      });
    })), o.animate(o.to, {
      queue: !1,
      duration: t.duration,
      easing: t.easing,
      complete: function complete() {
        0 === o.to.opacity && o.css("opacity", o.from.opacity), "hide" === p && o.hide(), e.effects.restore(o, y), f || ("static" === v ? o.css({
          position: "relative",
          top: o.to.top,
          left: o.to.left
        }) : e.each(["top", "left"], function (e, t) {
          o.css(t, function (t, i) {
            var s = parseInt(i, 10),
                n = e ? o.to.left : o.to.top;
            return "auto" === i ? n + "px" : s + n + "px";
          });
        })), e.effects.removeWrapper(o), i();
      }
    });
  }, e.effects.effect.scale = function (t, i) {
    var s = e(this),
        n = e.extend(!0, {}, t),
        a = e.effects.setMode(s, t.mode || "effect"),
        o = parseInt(t.percent, 10) || (0 === parseInt(t.percent, 10) ? 0 : "hide" === a ? 0 : 100),
        r = t.direction || "both",
        h = t.origin,
        l = {
      height: s.height(),
      width: s.width(),
      outerHeight: s.outerHeight(),
      outerWidth: s.outerWidth()
    },
        u = {
      y: "horizontal" !== r ? o / 100 : 1,
      x: "vertical" !== r ? o / 100 : 1
    };
    n.effect = "size", n.queue = !1, n.complete = i, "effect" !== a && (n.origin = h || ["middle", "center"], n.restore = !0), n.from = t.from || ("show" === a ? {
      height: 0,
      width: 0,
      outerHeight: 0,
      outerWidth: 0
    } : l), n.to = {
      height: l.height * u.y,
      width: l.width * u.x,
      outerHeight: l.outerHeight * u.y,
      outerWidth: l.outerWidth * u.x
    }, n.fade && ("show" === a && (n.from.opacity = 0, n.to.opacity = 1), "hide" === a && (n.from.opacity = 1, n.to.opacity = 0)), s.effect(n);
  }, e.effects.effect.puff = function (t, i) {
    var s = e(this),
        n = e.effects.setMode(s, t.mode || "hide"),
        a = "hide" === n,
        o = parseInt(t.percent, 10) || 150,
        r = o / 100,
        h = {
      height: s.height(),
      width: s.width(),
      outerHeight: s.outerHeight(),
      outerWidth: s.outerWidth()
    };
    e.extend(t, {
      effect: "scale",
      queue: !1,
      fade: !0,
      mode: n,
      complete: i,
      percent: a ? o : 100,
      from: a ? h : {
        height: h.height * r,
        width: h.width * r,
        outerHeight: h.outerHeight * r,
        outerWidth: h.outerWidth * r
      }
    }), s.effect(t);
  }, e.effects.effect.pulsate = function (t, i) {
    var s,
        n = e(this),
        a = e.effects.setMode(n, t.mode || "show"),
        o = "show" === a,
        r = "hide" === a,
        h = o || "hide" === a,
        l = 2 * (t.times || 5) + (h ? 1 : 0),
        u = t.duration / l,
        d = 0,
        c = n.queue(),
        p = c.length;

    for ((o || !n.is(":visible")) && (n.css("opacity", 0).show(), d = 1), s = 1; l > s; s++) {
      n.animate({
        opacity: d
      }, u, t.easing), d = 1 - d;
    }

    n.animate({
      opacity: d
    }, u, t.easing), n.queue(function () {
      r && n.hide(), i();
    }), p > 1 && c.splice.apply(c, [1, 0].concat(c.splice(p, l + 1))), n.dequeue();
  }, e.effects.effect.shake = function (t, i) {
    var s,
        n = e(this),
        a = ["position", "top", "bottom", "left", "right", "height", "width"],
        o = e.effects.setMode(n, t.mode || "effect"),
        r = t.direction || "left",
        h = t.distance || 20,
        l = t.times || 3,
        u = 2 * l + 1,
        d = Math.round(t.duration / u),
        c = "up" === r || "down" === r ? "top" : "left",
        p = "up" === r || "left" === r,
        f = {},
        m = {},
        g = {},
        v = n.queue(),
        y = v.length;

    for (e.effects.save(n, a), n.show(), e.effects.createWrapper(n), f[c] = (p ? "-=" : "+=") + h, m[c] = (p ? "+=" : "-=") + 2 * h, g[c] = (p ? "-=" : "+=") + 2 * h, n.animate(f, d, t.easing), s = 1; l > s; s++) {
      n.animate(m, d, t.easing).animate(g, d, t.easing);
    }

    n.animate(m, d, t.easing).animate(f, d / 2, t.easing).queue(function () {
      "hide" === o && n.hide(), e.effects.restore(n, a), e.effects.removeWrapper(n), i();
    }), y > 1 && v.splice.apply(v, [1, 0].concat(v.splice(y, u + 1))), n.dequeue();
  }, e.effects.effect.slide = function (t, i) {
    var s,
        n = e(this),
        a = ["position", "top", "bottom", "left", "right", "width", "height"],
        o = e.effects.setMode(n, t.mode || "show"),
        r = "show" === o,
        h = t.direction || "left",
        l = "up" === h || "down" === h ? "top" : "left",
        u = "up" === h || "left" === h,
        d = {};
    e.effects.save(n, a), n.show(), s = t.distance || n["top" === l ? "outerHeight" : "outerWidth"](!0), e.effects.createWrapper(n).css({
      overflow: "hidden"
    }), r && n.css(l, u ? isNaN(s) ? "-" + s : -s : s), d[l] = (r ? u ? "+=" : "-=" : u ? "-=" : "+=") + s, n.animate(d, {
      queue: !1,
      duration: t.duration,
      easing: t.easing,
      complete: function complete() {
        "hide" === o && n.hide(), e.effects.restore(n, a), e.effects.removeWrapper(n), i();
      }
    });
  }, e.effects.effect.transfer = function (t, i) {
    var s = e(this),
        n = e(t.to),
        a = "fixed" === n.css("position"),
        o = e("body"),
        r = a ? o.scrollTop() : 0,
        h = a ? o.scrollLeft() : 0,
        l = n.offset(),
        u = {
      top: l.top - r,
      left: l.left - h,
      height: n.innerHeight(),
      width: n.innerWidth()
    },
        d = s.offset(),
        c = e("<div class='ui-effects-transfer'></div>").appendTo(document.body).addClass(t.className).css({
      top: d.top - r,
      left: d.left - h,
      height: s.innerHeight(),
      width: s.innerWidth(),
      position: a ? "fixed" : "absolute"
    }).animate(u, t.duration, t.easing, function () {
      c.remove(), i();
    });
  }, e.widget("ui.progressbar", {
    version: "1.11.2",
    options: {
      max: 100,
      value: 0,
      change: null,
      complete: null
    },
    min: 0,
    _create: function _create() {
      this.oldValue = this.options.value = this._constrainedValue(), this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr({
        role: "progressbar",
        "aria-valuemin": this.min
      }), this.valueDiv = e("<div class='ui-progressbar-value ui-widget-header ui-corner-left'></div>").appendTo(this.element), this._refreshValue();
    },
    _destroy: function _destroy() {
      this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"), this.valueDiv.remove();
    },
    value: function value(e) {
      return void 0 === e ? this.options.value : (this.options.value = this._constrainedValue(e), this._refreshValue(), void 0);
    },
    _constrainedValue: function _constrainedValue(e) {
      return void 0 === e && (e = this.options.value), this.indeterminate = e === !1, "number" != typeof e && (e = 0), this.indeterminate ? !1 : Math.min(this.options.max, Math.max(this.min, e));
    },
    _setOptions: function _setOptions(e) {
      var t = e.value;
      delete e.value, this._super(e), this.options.value = this._constrainedValue(t), this._refreshValue();
    },
    _setOption: function _setOption(e, t) {
      "max" === e && (t = Math.max(this.min, t)), "disabled" === e && this.element.toggleClass("ui-state-disabled", !!t).attr("aria-disabled", t), this._super(e, t);
    },
    _percentage: function _percentage() {
      return this.indeterminate ? 100 : 100 * (this.options.value - this.min) / (this.options.max - this.min);
    },
    _refreshValue: function _refreshValue() {
      var t = this.options.value,
          i = this._percentage();

      this.valueDiv.toggle(this.indeterminate || t > this.min).toggleClass("ui-corner-right", t === this.options.max).width(i.toFixed(0) + "%"), this.element.toggleClass("ui-progressbar-indeterminate", this.indeterminate), this.indeterminate ? (this.element.removeAttr("aria-valuenow"), this.overlayDiv || (this.overlayDiv = e("<div class='ui-progressbar-overlay'></div>").appendTo(this.valueDiv))) : (this.element.attr({
        "aria-valuemax": this.options.max,
        "aria-valuenow": t
      }), this.overlayDiv && (this.overlayDiv.remove(), this.overlayDiv = null)), this.oldValue !== t && (this.oldValue = t, this._trigger("change")), t === this.options.max && this._trigger("complete");
    }
  }), e.widget("ui.selectable", e.ui.mouse, {
    version: "1.11.2",
    options: {
      appendTo: "body",
      autoRefresh: !0,
      distance: 0,
      filter: "*",
      tolerance: "touch",
      selected: null,
      selecting: null,
      start: null,
      stop: null,
      unselected: null,
      unselecting: null
    },
    _create: function _create() {
      var t,
          i = this;
      this.element.addClass("ui-selectable"), this.dragged = !1, this.refresh = function () {
        t = e(i.options.filter, i.element[0]), t.addClass("ui-selectee"), t.each(function () {
          var t = e(this),
              i = t.offset();
          e.data(this, "selectable-item", {
            element: this,
            $element: t,
            left: i.left,
            top: i.top,
            right: i.left + t.outerWidth(),
            bottom: i.top + t.outerHeight(),
            startselected: !1,
            selected: t.hasClass("ui-selected"),
            selecting: t.hasClass("ui-selecting"),
            unselecting: t.hasClass("ui-unselecting")
          });
        });
      }, this.refresh(), this.selectees = t.addClass("ui-selectee"), this._mouseInit(), this.helper = e("<div class='ui-selectable-helper'></div>");
    },
    _destroy: function _destroy() {
      this.selectees.removeClass("ui-selectee").removeData("selectable-item"), this.element.removeClass("ui-selectable ui-selectable-disabled"), this._mouseDestroy();
    },
    _mouseStart: function _mouseStart(t) {
      var i = this,
          s = this.options;
      this.opos = [t.pageX, t.pageY], this.options.disabled || (this.selectees = e(s.filter, this.element[0]), this._trigger("start", t), e(s.appendTo).append(this.helper), this.helper.css({
        left: t.pageX,
        top: t.pageY,
        width: 0,
        height: 0
      }), s.autoRefresh && this.refresh(), this.selectees.filter(".ui-selected").each(function () {
        var s = e.data(this, "selectable-item");
        s.startselected = !0, t.metaKey || t.ctrlKey || (s.$element.removeClass("ui-selected"), s.selected = !1, s.$element.addClass("ui-unselecting"), s.unselecting = !0, i._trigger("unselecting", t, {
          unselecting: s.element
        }));
      }), e(t.target).parents().addBack().each(function () {
        var s,
            n = e.data(this, "selectable-item");
        return n ? (s = !t.metaKey && !t.ctrlKey || !n.$element.hasClass("ui-selected"), n.$element.removeClass(s ? "ui-unselecting" : "ui-selected").addClass(s ? "ui-selecting" : "ui-unselecting"), n.unselecting = !s, n.selecting = s, n.selected = s, s ? i._trigger("selecting", t, {
          selecting: n.element
        }) : i._trigger("unselecting", t, {
          unselecting: n.element
        }), !1) : void 0;
      }));
    },
    _mouseDrag: function _mouseDrag(t) {
      if (this.dragged = !0, !this.options.disabled) {
        var i,
            s = this,
            n = this.options,
            a = this.opos[0],
            o = this.opos[1],
            r = t.pageX,
            h = t.pageY;
        return a > r && (i = r, r = a, a = i), o > h && (i = h, h = o, o = i), this.helper.css({
          left: a,
          top: o,
          width: r - a,
          height: h - o
        }), this.selectees.each(function () {
          var i = e.data(this, "selectable-item"),
              l = !1;
          i && i.element !== s.element[0] && ("touch" === n.tolerance ? l = !(i.left > r || a > i.right || i.top > h || o > i.bottom) : "fit" === n.tolerance && (l = i.left > a && r > i.right && i.top > o && h > i.bottom), l ? (i.selected && (i.$element.removeClass("ui-selected"), i.selected = !1), i.unselecting && (i.$element.removeClass("ui-unselecting"), i.unselecting = !1), i.selecting || (i.$element.addClass("ui-selecting"), i.selecting = !0, s._trigger("selecting", t, {
            selecting: i.element
          }))) : (i.selecting && ((t.metaKey || t.ctrlKey) && i.startselected ? (i.$element.removeClass("ui-selecting"), i.selecting = !1, i.$element.addClass("ui-selected"), i.selected = !0) : (i.$element.removeClass("ui-selecting"), i.selecting = !1, i.startselected && (i.$element.addClass("ui-unselecting"), i.unselecting = !0), s._trigger("unselecting", t, {
            unselecting: i.element
          }))), i.selected && (t.metaKey || t.ctrlKey || i.startselected || (i.$element.removeClass("ui-selected"), i.selected = !1, i.$element.addClass("ui-unselecting"), i.unselecting = !0, s._trigger("unselecting", t, {
            unselecting: i.element
          })))));
        }), !1;
      }
    },
    _mouseStop: function _mouseStop(t) {
      var i = this;
      return this.dragged = !1, e(".ui-unselecting", this.element[0]).each(function () {
        var s = e.data(this, "selectable-item");
        s.$element.removeClass("ui-unselecting"), s.unselecting = !1, s.startselected = !1, i._trigger("unselected", t, {
          unselected: s.element
        });
      }), e(".ui-selecting", this.element[0]).each(function () {
        var s = e.data(this, "selectable-item");
        s.$element.removeClass("ui-selecting").addClass("ui-selected"), s.selecting = !1, s.selected = !0, s.startselected = !0, i._trigger("selected", t, {
          selected: s.element
        });
      }), this._trigger("stop", t), this.helper.remove(), !1;
    }
  }), e.widget("ui.selectmenu", {
    version: "1.11.2",
    defaultElement: "<select>",
    options: {
      appendTo: null,
      disabled: null,
      icons: {
        button: "ui-icon-triangle-1-s"
      },
      position: {
        my: "left top",
        at: "left bottom",
        collision: "none"
      },
      width: null,
      change: null,
      close: null,
      focus: null,
      open: null,
      select: null
    },
    _create: function _create() {
      var e = this.element.uniqueId().attr("id");
      this.ids = {
        element: e,
        button: e + "-button",
        menu: e + "-menu"
      }, this._drawButton(), this._drawMenu(), this.options.disabled && this.disable();
    },
    _drawButton: function _drawButton() {
      var t = this,
          i = this.element.attr("tabindex");
      this.label = e("label[for='" + this.ids.element + "']").attr("for", this.ids.button), this._on(this.label, {
        click: function click(e) {
          this.button.focus(), e.preventDefault();
        }
      }), this.element.hide(), this.button = e("<span>", {
        "class": "ui-selectmenu-button ui-widget ui-state-default ui-corner-all",
        tabindex: i || this.options.disabled ? -1 : 0,
        id: this.ids.button,
        role: "combobox",
        "aria-expanded": "false",
        "aria-autocomplete": "list",
        "aria-owns": this.ids.menu,
        "aria-haspopup": "true"
      }).insertAfter(this.element), e("<span>", {
        "class": "ui-icon " + this.options.icons.button
      }).prependTo(this.button), this.buttonText = e("<span>", {
        "class": "ui-selectmenu-text"
      }).appendTo(this.button), this._setText(this.buttonText, this.element.find("option:selected").text()), this._resizeButton(), this._on(this.button, this._buttonEvents), this.button.one("focusin", function () {
        t.menuItems || t._refreshMenu();
      }), this._hoverable(this.button), this._focusable(this.button);
    },
    _drawMenu: function _drawMenu() {
      var t = this;
      this.menu = e("<ul>", {
        "aria-hidden": "true",
        "aria-labelledby": this.ids.button,
        id: this.ids.menu
      }), this.menuWrap = e("<div>", {
        "class": "ui-selectmenu-menu ui-front"
      }).append(this.menu).appendTo(this._appendTo()), this.menuInstance = this.menu.menu({
        role: "listbox",
        select: function select(e, i) {
          e.preventDefault(), t._setSelection(), t._select(i.item.data("ui-selectmenu-item"), e);
        },
        focus: function focus(e, i) {
          var s = i.item.data("ui-selectmenu-item");
          null != t.focusIndex && s.index !== t.focusIndex && (t._trigger("focus", e, {
            item: s
          }), t.isOpen || t._select(s, e)), t.focusIndex = s.index, t.button.attr("aria-activedescendant", t.menuItems.eq(s.index).attr("id"));
        }
      }).menu("instance"), this.menu.addClass("ui-corner-bottom").removeClass("ui-corner-all"), this.menuInstance._off(this.menu, "mouseleave"), this.menuInstance._closeOnDocumentClick = function () {
        return !1;
      }, this.menuInstance._isDivider = function () {
        return !1;
      };
    },
    refresh: function refresh() {
      this._refreshMenu(), this._setText(this.buttonText, this._getSelectedItem().text()), this.options.width || this._resizeButton();
    },
    _refreshMenu: function _refreshMenu() {
      this.menu.empty();
      var e,
          t = this.element.find("option");
      t.length && (this._parseOptions(t), this._renderMenu(this.menu, this.items), this.menuInstance.refresh(), this.menuItems = this.menu.find("li").not(".ui-selectmenu-optgroup"), e = this._getSelectedItem(), this.menuInstance.focus(null, e), this._setAria(e.data("ui-selectmenu-item")), this._setOption("disabled", this.element.prop("disabled")));
    },
    open: function open(e) {
      this.options.disabled || (this.menuItems ? (this.menu.find(".ui-state-focus").removeClass("ui-state-focus"), this.menuInstance.focus(null, this._getSelectedItem())) : this._refreshMenu(), this.isOpen = !0, this._toggleAttr(), this._resizeMenu(), this._position(), this._on(this.document, this._documentClick), this._trigger("open", e));
    },
    _position: function _position() {
      this.menuWrap.position(e.extend({
        of: this.button
      }, this.options.position));
    },
    close: function close(e) {
      this.isOpen && (this.isOpen = !1, this._toggleAttr(), this.range = null, this._off(this.document), this._trigger("close", e));
    },
    widget: function widget() {
      return this.button;
    },
    menuWidget: function menuWidget() {
      return this.menu;
    },
    _renderMenu: function _renderMenu(t, i) {
      var s = this,
          n = "";
      e.each(i, function (i, a) {
        a.optgroup !== n && (e("<li>", {
          "class": "ui-selectmenu-optgroup ui-menu-divider" + (a.element.parent("optgroup").prop("disabled") ? " ui-state-disabled" : ""),
          text: a.optgroup
        }).appendTo(t), n = a.optgroup), s._renderItemData(t, a);
      });
    },
    _renderItemData: function _renderItemData(e, t) {
      return this._renderItem(e, t).data("ui-selectmenu-item", t);
    },
    _renderItem: function _renderItem(t, i) {
      var s = e("<li>");
      return i.disabled && s.addClass("ui-state-disabled"), this._setText(s, i.label), s.appendTo(t);
    },
    _setText: function _setText(e, t) {
      t ? e.text(t) : e.html("&#160;");
    },
    _move: function _move(e, t) {
      var i,
          s,
          n = ".ui-menu-item";
      this.isOpen ? i = this.menuItems.eq(this.focusIndex) : (i = this.menuItems.eq(this.element[0].selectedIndex), n += ":not(.ui-state-disabled)"), s = "first" === e || "last" === e ? i["first" === e ? "prevAll" : "nextAll"](n).eq(-1) : i[e + "All"](n).eq(0), s.length && this.menuInstance.focus(t, s);
    },
    _getSelectedItem: function _getSelectedItem() {
      return this.menuItems.eq(this.element[0].selectedIndex);
    },
    _toggle: function _toggle(e) {
      this[this.isOpen ? "close" : "open"](e);
    },
    _setSelection: function _setSelection() {
      var e;
      this.range && (window.getSelection ? (e = window.getSelection(), e.removeAllRanges(), e.addRange(this.range)) : this.range.select(), this.button.focus());
    },
    _documentClick: {
      mousedown: function mousedown(t) {
        this.isOpen && (e(t.target).closest(".ui-selectmenu-menu, #" + this.ids.button).length || this.close(t));
      }
    },
    _buttonEvents: {
      mousedown: function mousedown() {
        var e;
        window.getSelection ? (e = window.getSelection(), e.rangeCount && (this.range = e.getRangeAt(0))) : this.range = document.selection.createRange();
      },
      click: function click(e) {
        this._setSelection(), this._toggle(e);
      },
      keydown: function keydown(t) {
        var i = !0;

        switch (t.keyCode) {
          case e.ui.keyCode.TAB:
          case e.ui.keyCode.ESCAPE:
            this.close(t), i = !1;
            break;

          case e.ui.keyCode.ENTER:
            this.isOpen && this._selectFocusedItem(t);
            break;

          case e.ui.keyCode.UP:
            t.altKey ? this._toggle(t) : this._move("prev", t);
            break;

          case e.ui.keyCode.DOWN:
            t.altKey ? this._toggle(t) : this._move("next", t);
            break;

          case e.ui.keyCode.SPACE:
            this.isOpen ? this._selectFocusedItem(t) : this._toggle(t);
            break;

          case e.ui.keyCode.LEFT:
            this._move("prev", t);

            break;

          case e.ui.keyCode.RIGHT:
            this._move("next", t);

            break;

          case e.ui.keyCode.HOME:
          case e.ui.keyCode.PAGE_UP:
            this._move("first", t);

            break;

          case e.ui.keyCode.END:
          case e.ui.keyCode.PAGE_DOWN:
            this._move("last", t);

            break;

          default:
            this.menu.trigger(t), i = !1;
        }

        i && t.preventDefault();
      }
    },
    _selectFocusedItem: function _selectFocusedItem(e) {
      var t = this.menuItems.eq(this.focusIndex);
      t.hasClass("ui-state-disabled") || this._select(t.data("ui-selectmenu-item"), e);
    },
    _select: function _select(e, t) {
      var i = this.element[0].selectedIndex;
      this.element[0].selectedIndex = e.index, this._setText(this.buttonText, e.label), this._setAria(e), this._trigger("select", t, {
        item: e
      }), e.index !== i && this._trigger("change", t, {
        item: e
      }), this.close(t);
    },
    _setAria: function _setAria(e) {
      var t = this.menuItems.eq(e.index).attr("id");
      this.button.attr({
        "aria-labelledby": t,
        "aria-activedescendant": t
      }), this.menu.attr("aria-activedescendant", t);
    },
    _setOption: function _setOption(e, t) {
      "icons" === e && this.button.find("span.ui-icon").removeClass(this.options.icons.button).addClass(t.button), this._super(e, t), "appendTo" === e && this.menuWrap.appendTo(this._appendTo()), "disabled" === e && (this.menuInstance.option("disabled", t), this.button.toggleClass("ui-state-disabled", t).attr("aria-disabled", t), this.element.prop("disabled", t), t ? (this.button.attr("tabindex", -1), this.close()) : this.button.attr("tabindex", 0)), "width" === e && this._resizeButton();
    },
    _appendTo: function _appendTo() {
      var t = this.options.appendTo;
      return t && (t = t.jquery || t.nodeType ? e(t) : this.document.find(t).eq(0)), t && t[0] || (t = this.element.closest(".ui-front")), t.length || (t = this.document[0].body), t;
    },
    _toggleAttr: function _toggleAttr() {
      this.button.toggleClass("ui-corner-top", this.isOpen).toggleClass("ui-corner-all", !this.isOpen).attr("aria-expanded", this.isOpen), this.menuWrap.toggleClass("ui-selectmenu-open", this.isOpen), this.menu.attr("aria-hidden", !this.isOpen);
    },
    _resizeButton: function _resizeButton() {
      var e = this.options.width;
      e || (e = this.element.show().outerWidth(), this.element.hide()), this.button.outerWidth(e);
    },
    _resizeMenu: function _resizeMenu() {
      this.menu.outerWidth(Math.max(this.button.outerWidth(), this.menu.width("").outerWidth() + 1));
    },
    _getCreateOptions: function _getCreateOptions() {
      return {
        disabled: this.element.prop("disabled")
      };
    },
    _parseOptions: function _parseOptions(t) {
      var i = [];
      t.each(function (t, s) {
        var n = e(s),
            a = n.parent("optgroup");
        i.push({
          element: n,
          index: t,
          value: n.attr("value"),
          label: n.text(),
          optgroup: a.attr("label") || "",
          disabled: a.prop("disabled") || n.prop("disabled")
        });
      }), this.items = i;
    },
    _destroy: function _destroy() {
      this.menuWrap.remove(), this.button.remove(), this.element.show(), this.element.removeUniqueId(), this.label.attr("for", this.ids.element);
    }
  }), e.widget("ui.slider", e.ui.mouse, {
    version: "1.11.2",
    widgetEventPrefix: "slide",
    options: {
      animate: !1,
      distance: 0,
      max: 100,
      min: 0,
      orientation: "horizontal",
      range: !1,
      step: 1,
      value: 0,
      values: null,
      change: null,
      slide: null,
      start: null,
      stop: null
    },
    numPages: 5,
    _create: function _create() {
      this._keySliding = !1, this._mouseSliding = !1, this._animateOff = !0, this._handleIndex = null, this._detectOrientation(), this._mouseInit(), this._calculateNewMax(), this.element.addClass("ui-slider ui-slider-" + this.orientation + " ui-widget" + " ui-widget-content" + " ui-corner-all"), this._refresh(), this._setOption("disabled", this.options.disabled), this._animateOff = !1;
    },
    _refresh: function _refresh() {
      this._createRange(), this._createHandles(), this._setupEvents(), this._refreshValue();
    },
    _createHandles: function _createHandles() {
      var t,
          i,
          s = this.options,
          n = this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),
          a = "<span class='ui-slider-handle ui-state-default ui-corner-all' tabindex='0'></span>",
          o = [];

      for (i = s.values && s.values.length || 1, n.length > i && (n.slice(i).remove(), n = n.slice(0, i)), t = n.length; i > t; t++) {
        o.push(a);
      }

      this.handles = n.add(e(o.join("")).appendTo(this.element)), this.handle = this.handles.eq(0), this.handles.each(function (t) {
        e(this).data("ui-slider-handle-index", t);
      });
    },
    _createRange: function _createRange() {
      var t = this.options,
          i = "";
      t.range ? (t.range === !0 && (t.values ? t.values.length && 2 !== t.values.length ? t.values = [t.values[0], t.values[0]] : e.isArray(t.values) && (t.values = t.values.slice(0)) : t.values = [this._valueMin(), this._valueMin()]), this.range && this.range.length ? this.range.removeClass("ui-slider-range-min ui-slider-range-max").css({
        left: "",
        bottom: ""
      }) : (this.range = e("<div></div>").appendTo(this.element), i = "ui-slider-range ui-widget-header ui-corner-all"), this.range.addClass(i + ("min" === t.range || "max" === t.range ? " ui-slider-range-" + t.range : ""))) : (this.range && this.range.remove(), this.range = null);
    },
    _setupEvents: function _setupEvents() {
      this._off(this.handles), this._on(this.handles, this._handleEvents), this._hoverable(this.handles), this._focusable(this.handles);
    },
    _destroy: function _destroy() {
      this.handles.remove(), this.range && this.range.remove(), this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-widget ui-widget-content ui-corner-all"), this._mouseDestroy();
    },
    _mouseCapture: function _mouseCapture(t) {
      var i,
          s,
          n,
          a,
          o,
          r,
          h,
          l,
          u = this,
          d = this.options;
      return d.disabled ? !1 : (this.elementSize = {
        width: this.element.outerWidth(),
        height: this.element.outerHeight()
      }, this.elementOffset = this.element.offset(), i = {
        x: t.pageX,
        y: t.pageY
      }, s = this._normValueFromMouse(i), n = this._valueMax() - this._valueMin() + 1, this.handles.each(function (t) {
        var i = Math.abs(s - u.values(t));
        (n > i || n === i && (t === u._lastChangedValue || u.values(t) === d.min)) && (n = i, a = e(this), o = t);
      }), r = this._start(t, o), r === !1 ? !1 : (this._mouseSliding = !0, this._handleIndex = o, a.addClass("ui-state-active").focus(), h = a.offset(), l = !e(t.target).parents().addBack().is(".ui-slider-handle"), this._clickOffset = l ? {
        left: 0,
        top: 0
      } : {
        left: t.pageX - h.left - a.width() / 2,
        top: t.pageY - h.top - a.height() / 2 - (parseInt(a.css("borderTopWidth"), 10) || 0) - (parseInt(a.css("borderBottomWidth"), 10) || 0) + (parseInt(a.css("marginTop"), 10) || 0)
      }, this.handles.hasClass("ui-state-hover") || this._slide(t, o, s), this._animateOff = !0, !0));
    },
    _mouseStart: function _mouseStart() {
      return !0;
    },
    _mouseDrag: function _mouseDrag(e) {
      var t = {
        x: e.pageX,
        y: e.pageY
      },
          i = this._normValueFromMouse(t);

      return this._slide(e, this._handleIndex, i), !1;
    },
    _mouseStop: function _mouseStop(e) {
      return this.handles.removeClass("ui-state-active"), this._mouseSliding = !1, this._stop(e, this._handleIndex), this._change(e, this._handleIndex), this._handleIndex = null, this._clickOffset = null, this._animateOff = !1, !1;
    },
    _detectOrientation: function _detectOrientation() {
      this.orientation = "vertical" === this.options.orientation ? "vertical" : "horizontal";
    },
    _normValueFromMouse: function _normValueFromMouse(e) {
      var t, i, s, n, a;
      return "horizontal" === this.orientation ? (t = this.elementSize.width, i = e.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0)) : (t = this.elementSize.height, i = e.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0)), s = i / t, s > 1 && (s = 1), 0 > s && (s = 0), "vertical" === this.orientation && (s = 1 - s), n = this._valueMax() - this._valueMin(), a = this._valueMin() + s * n, this._trimAlignValue(a);
    },
    _start: function _start(e, t) {
      var i = {
        handle: this.handles[t],
        value: this.value()
      };
      return this.options.values && this.options.values.length && (i.value = this.values(t), i.values = this.values()), this._trigger("start", e, i);
    },
    _slide: function _slide(e, t, i) {
      var s, n, a;
      this.options.values && this.options.values.length ? (s = this.values(t ? 0 : 1), 2 === this.options.values.length && this.options.range === !0 && (0 === t && i > s || 1 === t && s > i) && (i = s), i !== this.values(t) && (n = this.values(), n[t] = i, a = this._trigger("slide", e, {
        handle: this.handles[t],
        value: i,
        values: n
      }), s = this.values(t ? 0 : 1), a !== !1 && this.values(t, i))) : i !== this.value() && (a = this._trigger("slide", e, {
        handle: this.handles[t],
        value: i
      }), a !== !1 && this.value(i));
    },
    _stop: function _stop(e, t) {
      var i = {
        handle: this.handles[t],
        value: this.value()
      };
      this.options.values && this.options.values.length && (i.value = this.values(t), i.values = this.values()), this._trigger("stop", e, i);
    },
    _change: function _change(e, t) {
      if (!this._keySliding && !this._mouseSliding) {
        var i = {
          handle: this.handles[t],
          value: this.value()
        };
        this.options.values && this.options.values.length && (i.value = this.values(t), i.values = this.values()), this._lastChangedValue = t, this._trigger("change", e, i);
      }
    },
    value: function value(e) {
      return arguments.length ? (this.options.value = this._trimAlignValue(e), this._refreshValue(), this._change(null, 0), void 0) : this._value();
    },
    values: function values(t, i) {
      var s, n, a;
      if (arguments.length > 1) return this.options.values[t] = this._trimAlignValue(i), this._refreshValue(), this._change(null, t), void 0;
      if (!arguments.length) return this._values();
      if (!e.isArray(arguments[0])) return this.options.values && this.options.values.length ? this._values(t) : this.value();

      for (s = this.options.values, n = arguments[0], a = 0; s.length > a; a += 1) {
        s[a] = this._trimAlignValue(n[a]), this._change(null, a);
      }

      this._refreshValue();
    },
    _setOption: function _setOption(t, i) {
      var s,
          n = 0;

      switch ("range" === t && this.options.range === !0 && ("min" === i ? (this.options.value = this._values(0), this.options.values = null) : "max" === i && (this.options.value = this._values(this.options.values.length - 1), this.options.values = null)), e.isArray(this.options.values) && (n = this.options.values.length), "disabled" === t && this.element.toggleClass("ui-state-disabled", !!i), this._super(t, i), t) {
        case "orientation":
          this._detectOrientation(), this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-" + this.orientation), this._refreshValue(), this.handles.css("horizontal" === i ? "bottom" : "left", "");
          break;

        case "value":
          this._animateOff = !0, this._refreshValue(), this._change(null, 0), this._animateOff = !1;
          break;

        case "values":
          for (this._animateOff = !0, this._refreshValue(), s = 0; n > s; s += 1) {
            this._change(null, s);
          }

          this._animateOff = !1;
          break;

        case "step":
        case "min":
        case "max":
          this._animateOff = !0, this._calculateNewMax(), this._refreshValue(), this._animateOff = !1;
          break;

        case "range":
          this._animateOff = !0, this._refresh(), this._animateOff = !1;
      }
    },
    _value: function _value() {
      var e = this.options.value;
      return e = this._trimAlignValue(e);
    },
    _values: function _values(e) {
      var t, i, s;
      if (arguments.length) return t = this.options.values[e], t = this._trimAlignValue(t);

      if (this.options.values && this.options.values.length) {
        for (i = this.options.values.slice(), s = 0; i.length > s; s += 1) {
          i[s] = this._trimAlignValue(i[s]);
        }

        return i;
      }

      return [];
    },
    _trimAlignValue: function _trimAlignValue(e) {
      if (this._valueMin() >= e) return this._valueMin();
      if (e >= this._valueMax()) return this._valueMax();
      var t = this.options.step > 0 ? this.options.step : 1,
          i = (e - this._valueMin()) % t,
          s = e - i;
      return 2 * Math.abs(i) >= t && (s += i > 0 ? t : -t), parseFloat(s.toFixed(5));
    },
    _calculateNewMax: function _calculateNewMax() {
      var e = (this.options.max - this._valueMin()) % this.options.step;
      this.max = this.options.max - e;
    },
    _valueMin: function _valueMin() {
      return this.options.min;
    },
    _valueMax: function _valueMax() {
      return this.max;
    },
    _refreshValue: function _refreshValue() {
      var t,
          i,
          s,
          n,
          a,
          o = this.options.range,
          r = this.options,
          h = this,
          l = this._animateOff ? !1 : r.animate,
          u = {};
      this.options.values && this.options.values.length ? this.handles.each(function (s) {
        i = 100 * ((h.values(s) - h._valueMin()) / (h._valueMax() - h._valueMin())), u["horizontal" === h.orientation ? "left" : "bottom"] = i + "%", e(this).stop(1, 1)[l ? "animate" : "css"](u, r.animate), h.options.range === !0 && ("horizontal" === h.orientation ? (0 === s && h.range.stop(1, 1)[l ? "animate" : "css"]({
          left: i + "%"
        }, r.animate), 1 === s && h.range[l ? "animate" : "css"]({
          width: i - t + "%"
        }, {
          queue: !1,
          duration: r.animate
        })) : (0 === s && h.range.stop(1, 1)[l ? "animate" : "css"]({
          bottom: i + "%"
        }, r.animate), 1 === s && h.range[l ? "animate" : "css"]({
          height: i - t + "%"
        }, {
          queue: !1,
          duration: r.animate
        }))), t = i;
      }) : (s = this.value(), n = this._valueMin(), a = this._valueMax(), i = a !== n ? 100 * ((s - n) / (a - n)) : 0, u["horizontal" === this.orientation ? "left" : "bottom"] = i + "%", this.handle.stop(1, 1)[l ? "animate" : "css"](u, r.animate), "min" === o && "horizontal" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
        width: i + "%"
      }, r.animate), "max" === o && "horizontal" === this.orientation && this.range[l ? "animate" : "css"]({
        width: 100 - i + "%"
      }, {
        queue: !1,
        duration: r.animate
      }), "min" === o && "vertical" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
        height: i + "%"
      }, r.animate), "max" === o && "vertical" === this.orientation && this.range[l ? "animate" : "css"]({
        height: 100 - i + "%"
      }, {
        queue: !1,
        duration: r.animate
      }));
    },
    _handleEvents: {
      keydown: function keydown(t) {
        var i,
            s,
            n,
            a,
            o = e(t.target).data("ui-slider-handle-index");

        switch (t.keyCode) {
          case e.ui.keyCode.HOME:
          case e.ui.keyCode.END:
          case e.ui.keyCode.PAGE_UP:
          case e.ui.keyCode.PAGE_DOWN:
          case e.ui.keyCode.UP:
          case e.ui.keyCode.RIGHT:
          case e.ui.keyCode.DOWN:
          case e.ui.keyCode.LEFT:
            if (t.preventDefault(), !this._keySliding && (this._keySliding = !0, e(t.target).addClass("ui-state-active"), i = this._start(t, o), i === !1)) return;
        }

        switch (a = this.options.step, s = n = this.options.values && this.options.values.length ? this.values(o) : this.value(), t.keyCode) {
          case e.ui.keyCode.HOME:
            n = this._valueMin();
            break;

          case e.ui.keyCode.END:
            n = this._valueMax();
            break;

          case e.ui.keyCode.PAGE_UP:
            n = this._trimAlignValue(s + (this._valueMax() - this._valueMin()) / this.numPages);
            break;

          case e.ui.keyCode.PAGE_DOWN:
            n = this._trimAlignValue(s - (this._valueMax() - this._valueMin()) / this.numPages);
            break;

          case e.ui.keyCode.UP:
          case e.ui.keyCode.RIGHT:
            if (s === this._valueMax()) return;
            n = this._trimAlignValue(s + a);
            break;

          case e.ui.keyCode.DOWN:
          case e.ui.keyCode.LEFT:
            if (s === this._valueMin()) return;
            n = this._trimAlignValue(s - a);
        }

        this._slide(t, o, n);
      },
      keyup: function keyup(t) {
        var i = e(t.target).data("ui-slider-handle-index");
        this._keySliding && (this._keySliding = !1, this._stop(t, i), this._change(t, i), e(t.target).removeClass("ui-state-active"));
      }
    }
  }), e.widget("ui.sortable", e.ui.mouse, {
    version: "1.11.2",
    widgetEventPrefix: "sort",
    ready: !1,
    options: {
      appendTo: "parent",
      axis: !1,
      connectWith: !1,
      containment: !1,
      cursor: "auto",
      cursorAt: !1,
      dropOnEmpty: !0,
      forcePlaceholderSize: !1,
      forceHelperSize: !1,
      grid: !1,
      handle: !1,
      helper: "original",
      items: "> *",
      opacity: !1,
      placeholder: !1,
      revert: !1,
      scroll: !0,
      scrollSensitivity: 20,
      scrollSpeed: 20,
      scope: "default",
      tolerance: "intersect",
      zIndex: 1e3,
      activate: null,
      beforeStop: null,
      change: null,
      deactivate: null,
      out: null,
      over: null,
      receive: null,
      remove: null,
      sort: null,
      start: null,
      stop: null,
      update: null
    },
    _isOverAxis: function _isOverAxis(e, t, i) {
      return e >= t && t + i > e;
    },
    _isFloating: function _isFloating(e) {
      return /left|right/.test(e.css("float")) || /inline|table-cell/.test(e.css("display"));
    },
    _create: function _create() {
      var e = this.options;
      this.containerCache = {}, this.element.addClass("ui-sortable"), this.refresh(), this.floating = this.items.length ? "x" === e.axis || this._isFloating(this.items[0].item) : !1, this.offset = this.element.offset(), this._mouseInit(), this._setHandleClassName(), this.ready = !0;
    },
    _setOption: function _setOption(e, t) {
      this._super(e, t), "handle" === e && this._setHandleClassName();
    },
    _setHandleClassName: function _setHandleClassName() {
      this.element.find(".ui-sortable-handle").removeClass("ui-sortable-handle"), e.each(this.items, function () {
        (this.instance.options.handle ? this.item.find(this.instance.options.handle) : this.item).addClass("ui-sortable-handle");
      });
    },
    _destroy: function _destroy() {
      this.element.removeClass("ui-sortable ui-sortable-disabled").find(".ui-sortable-handle").removeClass("ui-sortable-handle"), this._mouseDestroy();

      for (var e = this.items.length - 1; e >= 0; e--) {
        this.items[e].item.removeData(this.widgetName + "-item");
      }

      return this;
    },
    _mouseCapture: function _mouseCapture(t, i) {
      var s = null,
          n = !1,
          a = this;
      return this.reverting ? !1 : this.options.disabled || "static" === this.options.type ? !1 : (this._refreshItems(t), e(t.target).parents().each(function () {
        return e.data(this, a.widgetName + "-item") === a ? (s = e(this), !1) : void 0;
      }), e.data(t.target, a.widgetName + "-item") === a && (s = e(t.target)), s ? !this.options.handle || i || (e(this.options.handle, s).find("*").addBack().each(function () {
        this === t.target && (n = !0);
      }), n) ? (this.currentItem = s, this._removeCurrentsFromItems(), !0) : !1 : !1);
    },
    _mouseStart: function _mouseStart(t, i, s) {
      var n,
          a,
          o = this.options;
      if (this.currentContainer = this, this.refreshPositions(), this.helper = this._createHelper(t), this._cacheHelperProportions(), this._cacheMargins(), this.scrollParent = this.helper.scrollParent(), this.offset = this.currentItem.offset(), this.offset = {
        top: this.offset.top - this.margins.top,
        left: this.offset.left - this.margins.left
      }, e.extend(this.offset, {
        click: {
          left: t.pageX - this.offset.left,
          top: t.pageY - this.offset.top
        },
        parent: this._getParentOffset(),
        relative: this._getRelativeOffset()
      }), this.helper.css("position", "absolute"), this.cssPosition = this.helper.css("position"), this.originalPosition = this._generatePosition(t), this.originalPageX = t.pageX, this.originalPageY = t.pageY, o.cursorAt && this._adjustOffsetFromHelper(o.cursorAt), this.domPosition = {
        prev: this.currentItem.prev()[0],
        parent: this.currentItem.parent()[0]
      }, this.helper[0] !== this.currentItem[0] && this.currentItem.hide(), this._createPlaceholder(), o.containment && this._setContainment(), o.cursor && "auto" !== o.cursor && (a = this.document.find("body"), this.storedCursor = a.css("cursor"), a.css("cursor", o.cursor), this.storedStylesheet = e("<style>*{ cursor: " + o.cursor + " !important; }</style>").appendTo(a)), o.opacity && (this.helper.css("opacity") && (this._storedOpacity = this.helper.css("opacity")), this.helper.css("opacity", o.opacity)), o.zIndex && (this.helper.css("zIndex") && (this._storedZIndex = this.helper.css("zIndex")), this.helper.css("zIndex", o.zIndex)), this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName && (this.overflowOffset = this.scrollParent.offset()), this._trigger("start", t, this._uiHash()), this._preserveHelperProportions || this._cacheHelperProportions(), !s) for (n = this.containers.length - 1; n >= 0; n--) {
        this.containers[n]._trigger("activate", t, this._uiHash(this));
      }
      return e.ui.ddmanager && (e.ui.ddmanager.current = this), e.ui.ddmanager && !o.dropBehaviour && e.ui.ddmanager.prepareOffsets(this, t), this.dragging = !0, this.helper.addClass("ui-sortable-helper"), this._mouseDrag(t), !0;
    },
    _mouseDrag: function _mouseDrag(t) {
      var i,
          s,
          n,
          a,
          o = this.options,
          r = !1;

      for (this.position = this._generatePosition(t), this.positionAbs = this._convertPositionTo("absolute"), this.lastPositionAbs || (this.lastPositionAbs = this.positionAbs), this.options.scroll && (this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName ? (this.overflowOffset.top + this.scrollParent[0].offsetHeight - t.pageY < o.scrollSensitivity ? this.scrollParent[0].scrollTop = r = this.scrollParent[0].scrollTop + o.scrollSpeed : t.pageY - this.overflowOffset.top < o.scrollSensitivity && (this.scrollParent[0].scrollTop = r = this.scrollParent[0].scrollTop - o.scrollSpeed), this.overflowOffset.left + this.scrollParent[0].offsetWidth - t.pageX < o.scrollSensitivity ? this.scrollParent[0].scrollLeft = r = this.scrollParent[0].scrollLeft + o.scrollSpeed : t.pageX - this.overflowOffset.left < o.scrollSensitivity && (this.scrollParent[0].scrollLeft = r = this.scrollParent[0].scrollLeft - o.scrollSpeed)) : (t.pageY - e(document).scrollTop() < o.scrollSensitivity ? r = e(document).scrollTop(e(document).scrollTop() - o.scrollSpeed) : e(window).height() - (t.pageY - e(document).scrollTop()) < o.scrollSensitivity && (r = e(document).scrollTop(e(document).scrollTop() + o.scrollSpeed)), t.pageX - e(document).scrollLeft() < o.scrollSensitivity ? r = e(document).scrollLeft(e(document).scrollLeft() - o.scrollSpeed) : e(window).width() - (t.pageX - e(document).scrollLeft()) < o.scrollSensitivity && (r = e(document).scrollLeft(e(document).scrollLeft() + o.scrollSpeed))), r !== !1 && e.ui.ddmanager && !o.dropBehaviour && e.ui.ddmanager.prepareOffsets(this, t)), this.positionAbs = this._convertPositionTo("absolute"), this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), i = this.items.length - 1; i >= 0; i--) {
        if (s = this.items[i], n = s.item[0], a = this._intersectsWithPointer(s), a && s.instance === this.currentContainer && n !== this.currentItem[0] && this.placeholder[1 === a ? "next" : "prev"]()[0] !== n && !e.contains(this.placeholder[0], n) && ("semi-dynamic" === this.options.type ? !e.contains(this.element[0], n) : !0)) {
          if (this.direction = 1 === a ? "down" : "up", "pointer" !== this.options.tolerance && !this._intersectsWithSides(s)) break;
          this._rearrange(t, s), this._trigger("change", t, this._uiHash());
          break;
        }
      }

      return this._contactContainers(t), e.ui.ddmanager && e.ui.ddmanager.drag(this, t), this._trigger("sort", t, this._uiHash()), this.lastPositionAbs = this.positionAbs, !1;
    },
    _mouseStop: function _mouseStop(t, i) {
      if (t) {
        if (e.ui.ddmanager && !this.options.dropBehaviour && e.ui.ddmanager.drop(this, t), this.options.revert) {
          var s = this,
              n = this.placeholder.offset(),
              a = this.options.axis,
              o = {};
          a && "x" !== a || (o.left = n.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollLeft)), a && "y" !== a || (o.top = n.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollTop)), this.reverting = !0, e(this.helper).animate(o, parseInt(this.options.revert, 10) || 500, function () {
            s._clear(t);
          });
        } else this._clear(t, i);

        return !1;
      }
    },
    cancel: function cancel() {
      if (this.dragging) {
        this._mouseUp({
          target: null
        }), "original" === this.options.helper ? this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") : this.currentItem.show();

        for (var t = this.containers.length - 1; t >= 0; t--) {
          this.containers[t]._trigger("deactivate", null, this._uiHash(this)), this.containers[t].containerCache.over && (this.containers[t]._trigger("out", null, this._uiHash(this)), this.containers[t].containerCache.over = 0);
        }
      }

      return this.placeholder && (this.placeholder[0].parentNode && this.placeholder[0].parentNode.removeChild(this.placeholder[0]), "original" !== this.options.helper && this.helper && this.helper[0].parentNode && this.helper.remove(), e.extend(this, {
        helper: null,
        dragging: !1,
        reverting: !1,
        _noFinalSort: null
      }), this.domPosition.prev ? e(this.domPosition.prev).after(this.currentItem) : e(this.domPosition.parent).prepend(this.currentItem)), this;
    },
    serialize: function serialize(t) {
      var i = this._getItemsAsjQuery(t && t.connected),
          s = [];

      return t = t || {}, e(i).each(function () {
        var i = (e(t.item || this).attr(t.attribute || "id") || "").match(t.expression || /(.+)[\-=_](.+)/);
        i && s.push((t.key || i[1] + "[]") + "=" + (t.key && t.expression ? i[1] : i[2]));
      }), !s.length && t.key && s.push(t.key + "="), s.join("&");
    },
    toArray: function toArray(t) {
      var i = this._getItemsAsjQuery(t && t.connected),
          s = [];

      return t = t || {}, i.each(function () {
        s.push(e(t.item || this).attr(t.attribute || "id") || "");
      }), s;
    },
    _intersectsWith: function _intersectsWith(e) {
      var t = this.positionAbs.left,
          i = t + this.helperProportions.width,
          s = this.positionAbs.top,
          n = s + this.helperProportions.height,
          a = e.left,
          o = a + e.width,
          r = e.top,
          h = r + e.height,
          l = this.offset.click.top,
          u = this.offset.click.left,
          d = "x" === this.options.axis || s + l > r && h > s + l,
          c = "y" === this.options.axis || t + u > a && o > t + u,
          p = d && c;
      return "pointer" === this.options.tolerance || this.options.forcePointerForContainers || "pointer" !== this.options.tolerance && this.helperProportions[this.floating ? "width" : "height"] > e[this.floating ? "width" : "height"] ? p : t + this.helperProportions.width / 2 > a && o > i - this.helperProportions.width / 2 && s + this.helperProportions.height / 2 > r && h > n - this.helperProportions.height / 2;
    },
    _intersectsWithPointer: function _intersectsWithPointer(e) {
      var t = "x" === this.options.axis || this._isOverAxis(this.positionAbs.top + this.offset.click.top, e.top, e.height),
          i = "y" === this.options.axis || this._isOverAxis(this.positionAbs.left + this.offset.click.left, e.left, e.width),
          s = t && i,
          n = this._getDragVerticalDirection(),
          a = this._getDragHorizontalDirection();

      return s ? this.floating ? a && "right" === a || "down" === n ? 2 : 1 : n && ("down" === n ? 2 : 1) : !1;
    },
    _intersectsWithSides: function _intersectsWithSides(e) {
      var t = this._isOverAxis(this.positionAbs.top + this.offset.click.top, e.top + e.height / 2, e.height),
          i = this._isOverAxis(this.positionAbs.left + this.offset.click.left, e.left + e.width / 2, e.width),
          s = this._getDragVerticalDirection(),
          n = this._getDragHorizontalDirection();

      return this.floating && n ? "right" === n && i || "left" === n && !i : s && ("down" === s && t || "up" === s && !t);
    },
    _getDragVerticalDirection: function _getDragVerticalDirection() {
      var e = this.positionAbs.top - this.lastPositionAbs.top;
      return 0 !== e && (e > 0 ? "down" : "up");
    },
    _getDragHorizontalDirection: function _getDragHorizontalDirection() {
      var e = this.positionAbs.left - this.lastPositionAbs.left;
      return 0 !== e && (e > 0 ? "right" : "left");
    },
    refresh: function refresh(e) {
      return this._refreshItems(e), this._setHandleClassName(), this.refreshPositions(), this;
    },
    _connectWith: function _connectWith() {
      var e = this.options;
      return e.connectWith.constructor === String ? [e.connectWith] : e.connectWith;
    },
    _getItemsAsjQuery: function _getItemsAsjQuery(t) {
      function i() {
        r.push(this);
      }

      var s,
          n,
          a,
          o,
          r = [],
          h = [],
          l = this._connectWith();

      if (l && t) for (s = l.length - 1; s >= 0; s--) {
        for (a = e(l[s]), n = a.length - 1; n >= 0; n--) {
          o = e.data(a[n], this.widgetFullName), o && o !== this && !o.options.disabled && h.push([e.isFunction(o.options.items) ? o.options.items.call(o.element) : e(o.options.items, o.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), o]);
        }
      }

      for (h.push([e.isFunction(this.options.items) ? this.options.items.call(this.element, null, {
        options: this.options,
        item: this.currentItem
      }) : e(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]), s = h.length - 1; s >= 0; s--) {
        h[s][0].each(i);
      }

      return e(r);
    },
    _removeCurrentsFromItems: function _removeCurrentsFromItems() {
      var t = this.currentItem.find(":data(" + this.widgetName + "-item)");
      this.items = e.grep(this.items, function (e) {
        for (var i = 0; t.length > i; i++) {
          if (t[i] === e.item[0]) return !1;
        }

        return !0;
      });
    },
    _refreshItems: function _refreshItems(t) {
      this.items = [], this.containers = [this];

      var i,
          s,
          n,
          a,
          o,
          r,
          h,
          l,
          u = this.items,
          d = [[e.isFunction(this.options.items) ? this.options.items.call(this.element[0], t, {
        item: this.currentItem
      }) : e(this.options.items, this.element), this]],
          c = this._connectWith();

      if (c && this.ready) for (i = c.length - 1; i >= 0; i--) {
        for (n = e(c[i]), s = n.length - 1; s >= 0; s--) {
          a = e.data(n[s], this.widgetFullName), a && a !== this && !a.options.disabled && (d.push([e.isFunction(a.options.items) ? a.options.items.call(a.element[0], t, {
            item: this.currentItem
          }) : e(a.options.items, a.element), a]), this.containers.push(a));
        }
      }

      for (i = d.length - 1; i >= 0; i--) {
        for (o = d[i][1], r = d[i][0], s = 0, l = r.length; l > s; s++) {
          h = e(r[s]), h.data(this.widgetName + "-item", o), u.push({
            item: h,
            instance: o,
            width: 0,
            height: 0,
            left: 0,
            top: 0
          });
        }
      }
    },
    refreshPositions: function refreshPositions(t) {
      this.offsetParent && this.helper && (this.offset.parent = this._getParentOffset());
      var i, s, n, a;

      for (i = this.items.length - 1; i >= 0; i--) {
        s = this.items[i], s.instance !== this.currentContainer && this.currentContainer && s.item[0] !== this.currentItem[0] || (n = this.options.toleranceElement ? e(this.options.toleranceElement, s.item) : s.item, t || (s.width = n.outerWidth(), s.height = n.outerHeight()), a = n.offset(), s.left = a.left, s.top = a.top);
      }

      if (this.options.custom && this.options.custom.refreshContainers) this.options.custom.refreshContainers.call(this);else for (i = this.containers.length - 1; i >= 0; i--) {
        a = this.containers[i].element.offset(), this.containers[i].containerCache.left = a.left, this.containers[i].containerCache.top = a.top, this.containers[i].containerCache.width = this.containers[i].element.outerWidth(), this.containers[i].containerCache.height = this.containers[i].element.outerHeight();
      }
      return this;
    },
    _createPlaceholder: function _createPlaceholder(t) {
      t = t || this;
      var i,
          s = t.options;
      s.placeholder && s.placeholder.constructor !== String || (i = s.placeholder, s.placeholder = {
        element: function element() {
          var s = t.currentItem[0].nodeName.toLowerCase(),
              n = e("<" + s + ">", t.document[0]).addClass(i || t.currentItem[0].className + " ui-sortable-placeholder").removeClass("ui-sortable-helper");
          return "tr" === s ? t.currentItem.children().each(function () {
            e("<td>&#160;</td>", t.document[0]).attr("colspan", e(this).attr("colspan") || 1).appendTo(n);
          }) : "img" === s && n.attr("src", t.currentItem.attr("src")), i || n.css("visibility", "hidden"), n;
        },
        update: function update(e, n) {
          (!i || s.forcePlaceholderSize) && (n.height() || n.height(t.currentItem.innerHeight() - parseInt(t.currentItem.css("paddingTop") || 0, 10) - parseInt(t.currentItem.css("paddingBottom") || 0, 10)), n.width() || n.width(t.currentItem.innerWidth() - parseInt(t.currentItem.css("paddingLeft") || 0, 10) - parseInt(t.currentItem.css("paddingRight") || 0, 10)));
        }
      }), t.placeholder = e(s.placeholder.element.call(t.element, t.currentItem)), t.currentItem.after(t.placeholder), s.placeholder.update(t, t.placeholder);
    },
    _contactContainers: function _contactContainers(t) {
      var i,
          s,
          n,
          a,
          o,
          r,
          h,
          l,
          u,
          d,
          c = null,
          p = null;

      for (i = this.containers.length - 1; i >= 0; i--) {
        if (!e.contains(this.currentItem[0], this.containers[i].element[0])) if (this._intersectsWith(this.containers[i].containerCache)) {
          if (c && e.contains(this.containers[i].element[0], c.element[0])) continue;
          c = this.containers[i], p = i;
        } else this.containers[i].containerCache.over && (this.containers[i]._trigger("out", t, this._uiHash(this)), this.containers[i].containerCache.over = 0);
      }

      if (c) if (1 === this.containers.length) this.containers[p].containerCache.over || (this.containers[p]._trigger("over", t, this._uiHash(this)), this.containers[p].containerCache.over = 1);else {
        for (n = 1e4, a = null, u = c.floating || this._isFloating(this.currentItem), o = u ? "left" : "top", r = u ? "width" : "height", d = u ? "clientX" : "clientY", s = this.items.length - 1; s >= 0; s--) {
          e.contains(this.containers[p].element[0], this.items[s].item[0]) && this.items[s].item[0] !== this.currentItem[0] && (h = this.items[s].item.offset()[o], l = !1, t[d] - h > this.items[s][r] / 2 && (l = !0), n > Math.abs(t[d] - h) && (n = Math.abs(t[d] - h), a = this.items[s], this.direction = l ? "up" : "down"));
        }

        if (!a && !this.options.dropOnEmpty) return;
        if (this.currentContainer === this.containers[p]) return this.currentContainer.containerCache.over || (this.containers[p]._trigger("over", t, this._uiHash()), this.currentContainer.containerCache.over = 1), void 0;
        a ? this._rearrange(t, a, null, !0) : this._rearrange(t, null, this.containers[p].element, !0), this._trigger("change", t, this._uiHash()), this.containers[p]._trigger("change", t, this._uiHash(this)), this.currentContainer = this.containers[p], this.options.placeholder.update(this.currentContainer, this.placeholder), this.containers[p]._trigger("over", t, this._uiHash(this)), this.containers[p].containerCache.over = 1;
      }
    },
    _createHelper: function _createHelper(t) {
      var i = this.options,
          s = e.isFunction(i.helper) ? e(i.helper.apply(this.element[0], [t, this.currentItem])) : "clone" === i.helper ? this.currentItem.clone() : this.currentItem;
      return s.parents("body").length || e("parent" !== i.appendTo ? i.appendTo : this.currentItem[0].parentNode)[0].appendChild(s[0]), s[0] === this.currentItem[0] && (this._storedCSS = {
        width: this.currentItem[0].style.width,
        height: this.currentItem[0].style.height,
        position: this.currentItem.css("position"),
        top: this.currentItem.css("top"),
        left: this.currentItem.css("left")
      }), (!s[0].style.width || i.forceHelperSize) && s.width(this.currentItem.width()), (!s[0].style.height || i.forceHelperSize) && s.height(this.currentItem.height()), s;
    },
    _adjustOffsetFromHelper: function _adjustOffsetFromHelper(t) {
      "string" == typeof t && (t = t.split(" ")), e.isArray(t) && (t = {
        left: +t[0],
        top: +t[1] || 0
      }), "left" in t && (this.offset.click.left = t.left + this.margins.left), "right" in t && (this.offset.click.left = this.helperProportions.width - t.right + this.margins.left), "top" in t && (this.offset.click.top = t.top + this.margins.top), "bottom" in t && (this.offset.click.top = this.helperProportions.height - t.bottom + this.margins.top);
    },
    _getParentOffset: function _getParentOffset() {
      this.offsetParent = this.helper.offsetParent();
      var t = this.offsetParent.offset();
      return "absolute" === this.cssPosition && this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0]) && (t.left += this.scrollParent.scrollLeft(), t.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === document.body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && e.ui.ie) && (t = {
        top: 0,
        left: 0
      }), {
        top: t.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
        left: t.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
      };
    },
    _getRelativeOffset: function _getRelativeOffset() {
      if ("relative" === this.cssPosition) {
        var e = this.currentItem.position();
        return {
          top: e.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
          left: e.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
        };
      }

      return {
        top: 0,
        left: 0
      };
    },
    _cacheMargins: function _cacheMargins() {
      this.margins = {
        left: parseInt(this.currentItem.css("marginLeft"), 10) || 0,
        top: parseInt(this.currentItem.css("marginTop"), 10) || 0
      };
    },
    _cacheHelperProportions: function _cacheHelperProportions() {
      this.helperProportions = {
        width: this.helper.outerWidth(),
        height: this.helper.outerHeight()
      };
    },
    _setContainment: function _setContainment() {
      var t,
          i,
          s,
          n = this.options;
      "parent" === n.containment && (n.containment = this.helper[0].parentNode), ("document" === n.containment || "window" === n.containment) && (this.containment = [0 - this.offset.relative.left - this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, e("document" === n.containment ? document : window).width() - this.helperProportions.width - this.margins.left, (e("document" === n.containment ? document : window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]), /^(document|window|parent)$/.test(n.containment) || (t = e(n.containment)[0], i = e(n.containment).offset(), s = "hidden" !== e(t).css("overflow"), this.containment = [i.left + (parseInt(e(t).css("borderLeftWidth"), 10) || 0) + (parseInt(e(t).css("paddingLeft"), 10) || 0) - this.margins.left, i.top + (parseInt(e(t).css("borderTopWidth"), 10) || 0) + (parseInt(e(t).css("paddingTop"), 10) || 0) - this.margins.top, i.left + (s ? Math.max(t.scrollWidth, t.offsetWidth) : t.offsetWidth) - (parseInt(e(t).css("borderLeftWidth"), 10) || 0) - (parseInt(e(t).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, i.top + (s ? Math.max(t.scrollHeight, t.offsetHeight) : t.offsetHeight) - (parseInt(e(t).css("borderTopWidth"), 10) || 0) - (parseInt(e(t).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top]);
    },
    _convertPositionTo: function _convertPositionTo(t, i) {
      i || (i = this.position);
      var s = "absolute" === t ? 1 : -1,
          n = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
          a = /(html|body)/i.test(n[0].tagName);
      return {
        top: i.top + this.offset.relative.top * s + this.offset.parent.top * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : a ? 0 : n.scrollTop()) * s,
        left: i.left + this.offset.relative.left * s + this.offset.parent.left * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : a ? 0 : n.scrollLeft()) * s
      };
    },
    _generatePosition: function _generatePosition(t) {
      var i,
          s,
          n = this.options,
          a = t.pageX,
          o = t.pageY,
          r = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
          h = /(html|body)/i.test(r[0].tagName);
      return "relative" !== this.cssPosition || this.scrollParent[0] !== document && this.scrollParent[0] !== this.offsetParent[0] || (this.offset.relative = this._getRelativeOffset()), this.originalPosition && (this.containment && (t.pageX - this.offset.click.left < this.containment[0] && (a = this.containment[0] + this.offset.click.left), t.pageY - this.offset.click.top < this.containment[1] && (o = this.containment[1] + this.offset.click.top), t.pageX - this.offset.click.left > this.containment[2] && (a = this.containment[2] + this.offset.click.left), t.pageY - this.offset.click.top > this.containment[3] && (o = this.containment[3] + this.offset.click.top)), n.grid && (i = this.originalPageY + Math.round((o - this.originalPageY) / n.grid[1]) * n.grid[1], o = this.containment ? i - this.offset.click.top >= this.containment[1] && i - this.offset.click.top <= this.containment[3] ? i : i - this.offset.click.top >= this.containment[1] ? i - n.grid[1] : i + n.grid[1] : i, s = this.originalPageX + Math.round((a - this.originalPageX) / n.grid[0]) * n.grid[0], a = this.containment ? s - this.offset.click.left >= this.containment[0] && s - this.offset.click.left <= this.containment[2] ? s : s - this.offset.click.left >= this.containment[0] ? s - n.grid[0] : s + n.grid[0] : s)), {
        top: o - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : h ? 0 : r.scrollTop()),
        left: a - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : h ? 0 : r.scrollLeft())
      };
    },
    _rearrange: function _rearrange(e, t, i, s) {
      i ? i[0].appendChild(this.placeholder[0]) : t.item[0].parentNode.insertBefore(this.placeholder[0], "down" === this.direction ? t.item[0] : t.item[0].nextSibling), this.counter = this.counter ? ++this.counter : 1;
      var n = this.counter;

      this._delay(function () {
        n === this.counter && this.refreshPositions(!s);
      });
    },
    _clear: function _clear(e, t) {
      function i(e, t, i) {
        return function (s) {
          i._trigger(e, s, t._uiHash(t));
        };
      }

      this.reverting = !1;
      var s,
          n = [];

      if (!this._noFinalSort && this.currentItem.parent().length && this.placeholder.before(this.currentItem), this._noFinalSort = null, this.helper[0] === this.currentItem[0]) {
        for (s in this._storedCSS) {
          ("auto" === this._storedCSS[s] || "static" === this._storedCSS[s]) && (this._storedCSS[s] = "");
        }

        this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper");
      } else this.currentItem.show();

      for (this.fromOutside && !t && n.push(function (e) {
        this._trigger("receive", e, this._uiHash(this.fromOutside));
      }), !this.fromOutside && this.domPosition.prev === this.currentItem.prev().not(".ui-sortable-helper")[0] && this.domPosition.parent === this.currentItem.parent()[0] || t || n.push(function (e) {
        this._trigger("update", e, this._uiHash());
      }), this !== this.currentContainer && (t || (n.push(function (e) {
        this._trigger("remove", e, this._uiHash());
      }), n.push(function (e) {
        return function (t) {
          e._trigger("receive", t, this._uiHash(this));
        };
      }.call(this, this.currentContainer)), n.push(function (e) {
        return function (t) {
          e._trigger("update", t, this._uiHash(this));
        };
      }.call(this, this.currentContainer)))), s = this.containers.length - 1; s >= 0; s--) {
        t || n.push(i("deactivate", this, this.containers[s])), this.containers[s].containerCache.over && (n.push(i("out", this, this.containers[s])), this.containers[s].containerCache.over = 0);
      }

      if (this.storedCursor && (this.document.find("body").css("cursor", this.storedCursor), this.storedStylesheet.remove()), this._storedOpacity && this.helper.css("opacity", this._storedOpacity), this._storedZIndex && this.helper.css("zIndex", "auto" === this._storedZIndex ? "" : this._storedZIndex), this.dragging = !1, t || this._trigger("beforeStop", e, this._uiHash()), this.placeholder[0].parentNode.removeChild(this.placeholder[0]), this.cancelHelperRemoval || (this.helper[0] !== this.currentItem[0] && this.helper.remove(), this.helper = null), !t) {
        for (s = 0; n.length > s; s++) {
          n[s].call(this, e);
        }

        this._trigger("stop", e, this._uiHash());
      }

      return this.fromOutside = !1, !this.cancelHelperRemoval;
    },
    _trigger: function _trigger() {
      e.Widget.prototype._trigger.apply(this, arguments) === !1 && this.cancel();
    },
    _uiHash: function _uiHash(t) {
      var i = t || this;
      return {
        helper: i.helper,
        placeholder: i.placeholder || e([]),
        position: i.position,
        originalPosition: i.originalPosition,
        offset: i.positionAbs,
        item: i.currentItem,
        sender: t ? t.element : null
      };
    }
  }), e.widget("ui.spinner", {
    version: "1.11.2",
    defaultElement: "<input>",
    widgetEventPrefix: "spin",
    options: {
      culture: null,
      icons: {
        down: "ui-icon-triangle-1-s",
        up: "ui-icon-triangle-1-n"
      },
      incremental: !0,
      max: null,
      min: null,
      numberFormat: null,
      page: 10,
      step: 1,
      change: null,
      spin: null,
      start: null,
      stop: null
    },
    _create: function _create() {
      this._setOption("max", this.options.max), this._setOption("min", this.options.min), this._setOption("step", this.options.step), "" !== this.value() && this._value(this.element.val(), !0), this._draw(), this._on(this._events), this._refresh(), this._on(this.window, {
        beforeunload: function beforeunload() {
          this.element.removeAttr("autocomplete");
        }
      });
    },
    _getCreateOptions: function _getCreateOptions() {
      var t = {},
          i = this.element;
      return e.each(["min", "max", "step"], function (e, s) {
        var n = i.attr(s);
        void 0 !== n && n.length && (t[s] = n);
      }), t;
    },
    _events: {
      keydown: function keydown(e) {
        this._start(e) && this._keydown(e) && e.preventDefault();
      },
      keyup: "_stop",
      focus: function focus() {
        this.previous = this.element.val();
      },
      blur: function blur(e) {
        return this.cancelBlur ? (delete this.cancelBlur, void 0) : (this._stop(), this._refresh(), this.previous !== this.element.val() && this._trigger("change", e), void 0);
      },
      mousewheel: function mousewheel(e, t) {
        if (t) {
          if (!this.spinning && !this._start(e)) return !1;
          this._spin((t > 0 ? 1 : -1) * this.options.step, e), clearTimeout(this.mousewheelTimer), this.mousewheelTimer = this._delay(function () {
            this.spinning && this._stop(e);
          }, 100), e.preventDefault();
        }
      },
      "mousedown .ui-spinner-button": function mousedownUiSpinnerButton(t) {
        function i() {
          var e = this.element[0] === this.document[0].activeElement;
          e || (this.element.focus(), this.previous = s, this._delay(function () {
            this.previous = s;
          }));
        }

        var s;
        s = this.element[0] === this.document[0].activeElement ? this.previous : this.element.val(), t.preventDefault(), i.call(this), this.cancelBlur = !0, this._delay(function () {
          delete this.cancelBlur, i.call(this);
        }), this._start(t) !== !1 && this._repeat(null, e(t.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, t);
      },
      "mouseup .ui-spinner-button": "_stop",
      "mouseenter .ui-spinner-button": function mouseenterUiSpinnerButton(t) {
        return e(t.currentTarget).hasClass("ui-state-active") ? this._start(t) === !1 ? !1 : (this._repeat(null, e(t.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, t), void 0) : void 0;
      },
      "mouseleave .ui-spinner-button": "_stop"
    },
    _draw: function _draw() {
      var e = this.uiSpinner = this.element.addClass("ui-spinner-input").attr("autocomplete", "off").wrap(this._uiSpinnerHtml()).parent().append(this._buttonHtml());
      this.element.attr("role", "spinbutton"), this.buttons = e.find(".ui-spinner-button").attr("tabIndex", -1).button().removeClass("ui-corner-all"), this.buttons.height() > Math.ceil(.5 * e.height()) && e.height() > 0 && e.height(e.height()), this.options.disabled && this.disable();
    },
    _keydown: function _keydown(t) {
      var i = this.options,
          s = e.ui.keyCode;

      switch (t.keyCode) {
        case s.UP:
          return this._repeat(null, 1, t), !0;

        case s.DOWN:
          return this._repeat(null, -1, t), !0;

        case s.PAGE_UP:
          return this._repeat(null, i.page, t), !0;

        case s.PAGE_DOWN:
          return this._repeat(null, -i.page, t), !0;
      }

      return !1;
    },
    _uiSpinnerHtml: function _uiSpinnerHtml() {
      return "<span class='ui-spinner ui-widget ui-widget-content ui-corner-all'></span>";
    },
    _buttonHtml: function _buttonHtml() {
      return "<a class='ui-spinner-button ui-spinner-up ui-corner-tr'><span class='ui-icon " + this.options.icons.up + "'>&#9650;</span>" + "</a>" + "<a class='ui-spinner-button ui-spinner-down ui-corner-br'>" + "<span class='ui-icon " + this.options.icons.down + "'>&#9660;</span>" + "</a>";
    },
    _start: function _start(e) {
      return this.spinning || this._trigger("start", e) !== !1 ? (this.counter || (this.counter = 1), this.spinning = !0, !0) : !1;
    },
    _repeat: function _repeat(e, t, i) {
      e = e || 500, clearTimeout(this.timer), this.timer = this._delay(function () {
        this._repeat(40, t, i);
      }, e), this._spin(t * this.options.step, i);
    },
    _spin: function _spin(e, t) {
      var i = this.value() || 0;
      this.counter || (this.counter = 1), i = this._adjustValue(i + e * this._increment(this.counter)), this.spinning && this._trigger("spin", t, {
        value: i
      }) === !1 || (this._value(i), this.counter++);
    },
    _increment: function _increment(t) {
      var i = this.options.incremental;
      return i ? e.isFunction(i) ? i(t) : Math.floor(t * t * t / 5e4 - t * t / 500 + 17 * t / 200 + 1) : 1;
    },
    _precision: function _precision() {
      var e = this._precisionOf(this.options.step);

      return null !== this.options.min && (e = Math.max(e, this._precisionOf(this.options.min))), e;
    },
    _precisionOf: function _precisionOf(e) {
      var t = "" + e,
          i = t.indexOf(".");
      return -1 === i ? 0 : t.length - i - 1;
    },
    _adjustValue: function _adjustValue(e) {
      var t,
          i,
          s = this.options;
      return t = null !== s.min ? s.min : 0, i = e - t, i = Math.round(i / s.step) * s.step, e = t + i, e = parseFloat(e.toFixed(this._precision())), null !== s.max && e > s.max ? s.max : null !== s.min && s.min > e ? s.min : e;
    },
    _stop: function _stop(e) {
      this.spinning && (clearTimeout(this.timer), clearTimeout(this.mousewheelTimer), this.counter = 0, this.spinning = !1, this._trigger("stop", e));
    },
    _setOption: function _setOption(e, t) {
      if ("culture" === e || "numberFormat" === e) {
        var i = this._parse(this.element.val());

        return this.options[e] = t, this.element.val(this._format(i)), void 0;
      }

      ("max" === e || "min" === e || "step" === e) && "string" == typeof t && (t = this._parse(t)), "icons" === e && (this.buttons.first().find(".ui-icon").removeClass(this.options.icons.up).addClass(t.up), this.buttons.last().find(".ui-icon").removeClass(this.options.icons.down).addClass(t.down)), this._super(e, t), "disabled" === e && (this.widget().toggleClass("ui-state-disabled", !!t), this.element.prop("disabled", !!t), this.buttons.button(t ? "disable" : "enable"));
    },
    _setOptions: h(function (e) {
      this._super(e);
    }),
    _parse: function _parse(e) {
      return "string" == typeof e && "" !== e && (e = window.Globalize && this.options.numberFormat ? Globalize.parseFloat(e, 10, this.options.culture) : +e), "" === e || isNaN(e) ? null : e;
    },
    _format: function _format(e) {
      return "" === e ? "" : window.Globalize && this.options.numberFormat ? Globalize.format(e, this.options.numberFormat, this.options.culture) : e;
    },
    _refresh: function _refresh() {
      this.element.attr({
        "aria-valuemin": this.options.min,
        "aria-valuemax": this.options.max,
        "aria-valuenow": this._parse(this.element.val())
      });
    },
    isValid: function isValid() {
      var e = this.value();
      return null === e ? !1 : e === this._adjustValue(e);
    },
    _value: function _value(e, t) {
      var i;
      "" !== e && (i = this._parse(e), null !== i && (t || (i = this._adjustValue(i)), e = this._format(i))), this.element.val(e), this._refresh();
    },
    _destroy: function _destroy() {
      this.element.removeClass("ui-spinner-input").prop("disabled", !1).removeAttr("autocomplete").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"), this.uiSpinner.replaceWith(this.element);
    },
    stepUp: h(function (e) {
      this._stepUp(e);
    }),
    _stepUp: function _stepUp(e) {
      this._start() && (this._spin((e || 1) * this.options.step), this._stop());
    },
    stepDown: h(function (e) {
      this._stepDown(e);
    }),
    _stepDown: function _stepDown(e) {
      this._start() && (this._spin((e || 1) * -this.options.step), this._stop());
    },
    pageUp: h(function (e) {
      this._stepUp((e || 1) * this.options.page);
    }),
    pageDown: h(function (e) {
      this._stepDown((e || 1) * this.options.page);
    }),
    value: function value(e) {
      return arguments.length ? (h(this._value).call(this, e), void 0) : this._parse(this.element.val());
    },
    widget: function widget() {
      return this.uiSpinner;
    }
  }), e.widget("ui.tabs", {
    version: "1.11.2",
    delay: 300,
    options: {
      active: null,
      collapsible: !1,
      event: "click",
      heightStyle: "content",
      hide: null,
      show: null,
      activate: null,
      beforeActivate: null,
      beforeLoad: null,
      load: null
    },
    _isLocal: function () {
      var e = /#.*$/;
      return function (t) {
        var i, s;
        t = t.cloneNode(!1), i = t.href.replace(e, ""), s = location.href.replace(e, "");

        try {
          i = decodeURIComponent(i);
        } catch (n) {}

        try {
          s = decodeURIComponent(s);
        } catch (n) {}

        return t.hash.length > 1 && i === s;
      };
    }(),
    _create: function _create() {
      var t = this,
          i = this.options;
      this.running = !1, this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all").toggleClass("ui-tabs-collapsible", i.collapsible), this._processTabs(), i.active = this._initialActive(), e.isArray(i.disabled) && (i.disabled = e.unique(i.disabled.concat(e.map(this.tabs.filter(".ui-state-disabled"), function (e) {
        return t.tabs.index(e);
      }))).sort()), this.active = this.options.active !== !1 && this.anchors.length ? this._findActive(i.active) : e(), this._refresh(), this.active.length && this.load(i.active);
    },
    _initialActive: function _initialActive() {
      var t = this.options.active,
          i = this.options.collapsible,
          s = location.hash.substring(1);
      return null === t && (s && this.tabs.each(function (i, n) {
        return e(n).attr("aria-controls") === s ? (t = i, !1) : void 0;
      }), null === t && (t = this.tabs.index(this.tabs.filter(".ui-tabs-active"))), (null === t || -1 === t) && (t = this.tabs.length ? 0 : !1)), t !== !1 && (t = this.tabs.index(this.tabs.eq(t)), -1 === t && (t = i ? !1 : 0)), !i && t === !1 && this.anchors.length && (t = 0), t;
    },
    _getCreateEventData: function _getCreateEventData() {
      return {
        tab: this.active,
        panel: this.active.length ? this._getPanelForTab(this.active) : e()
      };
    },
    _tabKeydown: function _tabKeydown(t) {
      var i = e(this.document[0].activeElement).closest("li"),
          s = this.tabs.index(i),
          n = !0;

      if (!this._handlePageNav(t)) {
        switch (t.keyCode) {
          case e.ui.keyCode.RIGHT:
          case e.ui.keyCode.DOWN:
            s++;
            break;

          case e.ui.keyCode.UP:
          case e.ui.keyCode.LEFT:
            n = !1, s--;
            break;

          case e.ui.keyCode.END:
            s = this.anchors.length - 1;
            break;

          case e.ui.keyCode.HOME:
            s = 0;
            break;

          case e.ui.keyCode.SPACE:
            return t.preventDefault(), clearTimeout(this.activating), this._activate(s), void 0;

          case e.ui.keyCode.ENTER:
            return t.preventDefault(), clearTimeout(this.activating), this._activate(s === this.options.active ? !1 : s), void 0;

          default:
            return;
        }

        t.preventDefault(), clearTimeout(this.activating), s = this._focusNextTab(s, n), t.ctrlKey || (i.attr("aria-selected", "false"), this.tabs.eq(s).attr("aria-selected", "true"), this.activating = this._delay(function () {
          this.option("active", s);
        }, this.delay));
      }
    },
    _panelKeydown: function _panelKeydown(t) {
      this._handlePageNav(t) || t.ctrlKey && t.keyCode === e.ui.keyCode.UP && (t.preventDefault(), this.active.focus());
    },
    _handlePageNav: function _handlePageNav(t) {
      return t.altKey && t.keyCode === e.ui.keyCode.PAGE_UP ? (this._activate(this._focusNextTab(this.options.active - 1, !1)), !0) : t.altKey && t.keyCode === e.ui.keyCode.PAGE_DOWN ? (this._activate(this._focusNextTab(this.options.active + 1, !0)), !0) : void 0;
    },
    _findNextTab: function _findNextTab(t, i) {
      function s() {
        return t > n && (t = 0), 0 > t && (t = n), t;
      }

      for (var n = this.tabs.length - 1; -1 !== e.inArray(s(), this.options.disabled);) {
        t = i ? t + 1 : t - 1;
      }

      return t;
    },
    _focusNextTab: function _focusNextTab(e, t) {
      return e = this._findNextTab(e, t), this.tabs.eq(e).focus(), e;
    },
    _setOption: function _setOption(e, t) {
      return "active" === e ? (this._activate(t), void 0) : "disabled" === e ? (this._setupDisabled(t), void 0) : (this._super(e, t), "collapsible" === e && (this.element.toggleClass("ui-tabs-collapsible", t), t || this.options.active !== !1 || this._activate(0)), "event" === e && this._setupEvents(t), "heightStyle" === e && this._setupHeightStyle(t), void 0);
    },
    _sanitizeSelector: function _sanitizeSelector(e) {
      return e ? e.replace(/[!"$%&'()*+,.\/:;<=>?@\[\]\^`{|}~]/g, "\\$&") : "";
    },
    refresh: function refresh() {
      var t = this.options,
          i = this.tablist.children(":has(a[href])");
      t.disabled = e.map(i.filter(".ui-state-disabled"), function (e) {
        return i.index(e);
      }), this._processTabs(), t.active !== !1 && this.anchors.length ? this.active.length && !e.contains(this.tablist[0], this.active[0]) ? this.tabs.length === t.disabled.length ? (t.active = !1, this.active = e()) : this._activate(this._findNextTab(Math.max(0, t.active - 1), !1)) : t.active = this.tabs.index(this.active) : (t.active = !1, this.active = e()), this._refresh();
    },
    _refresh: function _refresh() {
      this._setupDisabled(this.options.disabled), this._setupEvents(this.options.event), this._setupHeightStyle(this.options.heightStyle), this.tabs.not(this.active).attr({
        "aria-selected": "false",
        "aria-expanded": "false",
        tabIndex: -1
      }), this.panels.not(this._getPanelForTab(this.active)).hide().attr({
        "aria-hidden": "true"
      }), this.active.length ? (this.active.addClass("ui-tabs-active ui-state-active").attr({
        "aria-selected": "true",
        "aria-expanded": "true",
        tabIndex: 0
      }), this._getPanelForTab(this.active).show().attr({
        "aria-hidden": "false"
      })) : this.tabs.eq(0).attr("tabIndex", 0);
    },
    _processTabs: function _processTabs() {
      var t = this,
          i = this.tabs,
          s = this.anchors,
          n = this.panels;
      this.tablist = this._getList().addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").attr("role", "tablist").delegate("> li", "mousedown" + this.eventNamespace, function (t) {
        e(this).is(".ui-state-disabled") && t.preventDefault();
      }).delegate(".ui-tabs-anchor", "focus" + this.eventNamespace, function () {
        e(this).closest("li").is(".ui-state-disabled") && this.blur();
      }), this.tabs = this.tablist.find("> li:has(a[href])").addClass("ui-state-default ui-corner-top").attr({
        role: "tab",
        tabIndex: -1
      }), this.anchors = this.tabs.map(function () {
        return e("a", this)[0];
      }).addClass("ui-tabs-anchor").attr({
        role: "presentation",
        tabIndex: -1
      }), this.panels = e(), this.anchors.each(function (i, s) {
        var n,
            a,
            o,
            r = e(s).uniqueId().attr("id"),
            h = e(s).closest("li"),
            l = h.attr("aria-controls");
        t._isLocal(s) ? (n = s.hash, o = n.substring(1), a = t.element.find(t._sanitizeSelector(n))) : (o = h.attr("aria-controls") || e({}).uniqueId()[0].id, n = "#" + o, a = t.element.find(n), a.length || (a = t._createPanel(o), a.insertAfter(t.panels[i - 1] || t.tablist)), a.attr("aria-live", "polite")), a.length && (t.panels = t.panels.add(a)), l && h.data("ui-tabs-aria-controls", l), h.attr({
          "aria-controls": o,
          "aria-labelledby": r
        }), a.attr("aria-labelledby", r);
      }), this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").attr("role", "tabpanel"), i && (this._off(i.not(this.tabs)), this._off(s.not(this.anchors)), this._off(n.not(this.panels)));
    },
    _getList: function _getList() {
      return this.tablist || this.element.find("ol,ul").eq(0);
    },
    _createPanel: function _createPanel(t) {
      return e("<div>").attr("id", t).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").data("ui-tabs-destroy", !0);
    },
    _setupDisabled: function _setupDisabled(t) {
      e.isArray(t) && (t.length ? t.length === this.anchors.length && (t = !0) : t = !1);

      for (var i, s = 0; i = this.tabs[s]; s++) {
        t === !0 || -1 !== e.inArray(s, t) ? e(i).addClass("ui-state-disabled").attr("aria-disabled", "true") : e(i).removeClass("ui-state-disabled").removeAttr("aria-disabled");
      }

      this.options.disabled = t;
    },
    _setupEvents: function _setupEvents(t) {
      var i = {};
      t && e.each(t.split(" "), function (e, t) {
        i[t] = "_eventHandler";
      }), this._off(this.anchors.add(this.tabs).add(this.panels)), this._on(!0, this.anchors, {
        click: function click(e) {
          e.preventDefault();
        }
      }), this._on(this.anchors, i), this._on(this.tabs, {
        keydown: "_tabKeydown"
      }), this._on(this.panels, {
        keydown: "_panelKeydown"
      }), this._focusable(this.tabs), this._hoverable(this.tabs);
    },
    _setupHeightStyle: function _setupHeightStyle(t) {
      var i,
          s = this.element.parent();
      "fill" === t ? (i = s.height(), i -= this.element.outerHeight() - this.element.height(), this.element.siblings(":visible").each(function () {
        var t = e(this),
            s = t.css("position");
        "absolute" !== s && "fixed" !== s && (i -= t.outerHeight(!0));
      }), this.element.children().not(this.panels).each(function () {
        i -= e(this).outerHeight(!0);
      }), this.panels.each(function () {
        e(this).height(Math.max(0, i - e(this).innerHeight() + e(this).height()));
      }).css("overflow", "auto")) : "auto" === t && (i = 0, this.panels.each(function () {
        i = Math.max(i, e(this).height("").height());
      }).height(i));
    },
    _eventHandler: function _eventHandler(t) {
      var i = this.options,
          s = this.active,
          n = e(t.currentTarget),
          a = n.closest("li"),
          o = a[0] === s[0],
          r = o && i.collapsible,
          h = r ? e() : this._getPanelForTab(a),
          l = s.length ? this._getPanelForTab(s) : e(),
          u = {
        oldTab: s,
        oldPanel: l,
        newTab: r ? e() : a,
        newPanel: h
      };
      t.preventDefault(), a.hasClass("ui-state-disabled") || a.hasClass("ui-tabs-loading") || this.running || o && !i.collapsible || this._trigger("beforeActivate", t, u) === !1 || (i.active = r ? !1 : this.tabs.index(a), this.active = o ? e() : a, this.xhr && this.xhr.abort(), l.length || h.length || e.error("jQuery UI Tabs: Mismatching fragment identifier."), h.length && this.load(this.tabs.index(a), t), this._toggle(t, u));
    },
    _toggle: function _toggle(t, i) {
      function s() {
        a.running = !1, a._trigger("activate", t, i);
      }

      function n() {
        i.newTab.closest("li").addClass("ui-tabs-active ui-state-active"), o.length && a.options.show ? a._show(o, a.options.show, s) : (o.show(), s());
      }

      var a = this,
          o = i.newPanel,
          r = i.oldPanel;
      this.running = !0, r.length && this.options.hide ? this._hide(r, this.options.hide, function () {
        i.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"), n();
      }) : (i.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"), r.hide(), n()), r.attr("aria-hidden", "true"), i.oldTab.attr({
        "aria-selected": "false",
        "aria-expanded": "false"
      }), o.length && r.length ? i.oldTab.attr("tabIndex", -1) : o.length && this.tabs.filter(function () {
        return 0 === e(this).attr("tabIndex");
      }).attr("tabIndex", -1), o.attr("aria-hidden", "false"), i.newTab.attr({
        "aria-selected": "true",
        "aria-expanded": "true",
        tabIndex: 0
      });
    },
    _activate: function _activate(t) {
      var i,
          s = this._findActive(t);

      s[0] !== this.active[0] && (s.length || (s = this.active), i = s.find(".ui-tabs-anchor")[0], this._eventHandler({
        target: i,
        currentTarget: i,
        preventDefault: e.noop
      }));
    },
    _findActive: function _findActive(t) {
      return t === !1 ? e() : this.tabs.eq(t);
    },
    _getIndex: function _getIndex(e) {
      return "string" == typeof e && (e = this.anchors.index(this.anchors.filter("[href$='" + e + "']"))), e;
    },
    _destroy: function _destroy() {
      this.xhr && this.xhr.abort(), this.element.removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible"), this.tablist.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").removeAttr("role"), this.anchors.removeClass("ui-tabs-anchor").removeAttr("role").removeAttr("tabIndex").removeUniqueId(), this.tablist.unbind(this.eventNamespace), this.tabs.add(this.panels).each(function () {
        e.data(this, "ui-tabs-destroy") ? e(this).remove() : e(this).removeClass("ui-state-default ui-state-active ui-state-disabled ui-corner-top ui-corner-bottom ui-widget-content ui-tabs-active ui-tabs-panel").removeAttr("tabIndex").removeAttr("aria-live").removeAttr("aria-busy").removeAttr("aria-selected").removeAttr("aria-labelledby").removeAttr("aria-hidden").removeAttr("aria-expanded").removeAttr("role");
      }), this.tabs.each(function () {
        var t = e(this),
            i = t.data("ui-tabs-aria-controls");
        i ? t.attr("aria-controls", i).removeData("ui-tabs-aria-controls") : t.removeAttr("aria-controls");
      }), this.panels.show(), "content" !== this.options.heightStyle && this.panels.css("height", "");
    },
    enable: function enable(t) {
      var i = this.options.disabled;
      i !== !1 && (void 0 === t ? i = !1 : (t = this._getIndex(t), i = e.isArray(i) ? e.map(i, function (e) {
        return e !== t ? e : null;
      }) : e.map(this.tabs, function (e, i) {
        return i !== t ? i : null;
      })), this._setupDisabled(i));
    },
    disable: function disable(t) {
      var i = this.options.disabled;

      if (i !== !0) {
        if (void 0 === t) i = !0;else {
          if (t = this._getIndex(t), -1 !== e.inArray(t, i)) return;
          i = e.isArray(i) ? e.merge([t], i).sort() : [t];
        }

        this._setupDisabled(i);
      }
    },
    load: function load(t, i) {
      t = this._getIndex(t);

      var s = this,
          n = this.tabs.eq(t),
          a = n.find(".ui-tabs-anchor"),
          o = this._getPanelForTab(n),
          r = {
        tab: n,
        panel: o
      };

      this._isLocal(a[0]) || (this.xhr = e.ajax(this._ajaxSettings(a, i, r)), this.xhr && "canceled" !== this.xhr.statusText && (n.addClass("ui-tabs-loading"), o.attr("aria-busy", "true"), this.xhr.success(function (e) {
        setTimeout(function () {
          o.html(e), s._trigger("load", i, r);
        }, 1);
      }).complete(function (e, t) {
        setTimeout(function () {
          "abort" === t && s.panels.stop(!1, !0), n.removeClass("ui-tabs-loading"), o.removeAttr("aria-busy"), e === s.xhr && delete s.xhr;
        }, 1);
      })));
    },
    _ajaxSettings: function _ajaxSettings(t, i, s) {
      var n = this;
      return {
        url: t.attr("href"),
        beforeSend: function beforeSend(t, a) {
          return n._trigger("beforeLoad", i, e.extend({
            jqXHR: t,
            ajaxSettings: a
          }, s));
        }
      };
    },
    _getPanelForTab: function _getPanelForTab(t) {
      var i = e(t).attr("aria-controls");
      return this.element.find(this._sanitizeSelector("#" + i));
    }
  }), e.widget("ui.tooltip", {
    version: "1.11.2",
    options: {
      content: function content() {
        var t = e(this).attr("title") || "";
        return e("<a>").text(t).html();
      },
      hide: !0,
      items: "[title]:not([disabled])",
      position: {
        my: "left top+15",
        at: "left bottom",
        collision: "flipfit flip"
      },
      show: !0,
      tooltipClass: null,
      track: !1,
      close: null,
      open: null
    },
    _addDescribedBy: function _addDescribedBy(t, i) {
      var s = (t.attr("aria-describedby") || "").split(/\s+/);
      s.push(i), t.data("ui-tooltip-id", i).attr("aria-describedby", e.trim(s.join(" ")));
    },
    _removeDescribedBy: function _removeDescribedBy(t) {
      var i = t.data("ui-tooltip-id"),
          s = (t.attr("aria-describedby") || "").split(/\s+/),
          n = e.inArray(i, s);
      -1 !== n && s.splice(n, 1), t.removeData("ui-tooltip-id"), s = e.trim(s.join(" ")), s ? t.attr("aria-describedby", s) : t.removeAttr("aria-describedby");
    },
    _create: function _create() {
      this._on({
        mouseover: "open",
        focusin: "open"
      }), this.tooltips = {}, this.parents = {}, this.options.disabled && this._disable(), this.liveRegion = e("<div>").attr({
        role: "log",
        "aria-live": "assertive",
        "aria-relevant": "additions"
      }).addClass("ui-helper-hidden-accessible").appendTo(this.document[0].body);
    },
    _setOption: function _setOption(t, i) {
      var s = this;
      return "disabled" === t ? (this[i ? "_disable" : "_enable"](), this.options[t] = i, void 0) : (this._super(t, i), "content" === t && e.each(this.tooltips, function (e, t) {
        s._updateContent(t.element);
      }), void 0);
    },
    _disable: function _disable() {
      var t = this;
      e.each(this.tooltips, function (i, s) {
        var n = e.Event("blur");
        n.target = n.currentTarget = s.element[0], t.close(n, !0);
      }), this.element.find(this.options.items).addBack().each(function () {
        var t = e(this);
        t.is("[title]") && t.data("ui-tooltip-title", t.attr("title")).removeAttr("title");
      });
    },
    _enable: function _enable() {
      this.element.find(this.options.items).addBack().each(function () {
        var t = e(this);
        t.data("ui-tooltip-title") && t.attr("title", t.data("ui-tooltip-title"));
      });
    },
    open: function open(t) {
      var i = this,
          s = e(t ? t.target : this.element).closest(this.options.items);
      s.length && !s.data("ui-tooltip-id") && (s.attr("title") && s.data("ui-tooltip-title", s.attr("title")), s.data("ui-tooltip-open", !0), t && "mouseover" === t.type && s.parents().each(function () {
        var t,
            s = e(this);
        s.data("ui-tooltip-open") && (t = e.Event("blur"), t.target = t.currentTarget = this, i.close(t, !0)), s.attr("title") && (s.uniqueId(), i.parents[this.id] = {
          element: this,
          title: s.attr("title")
        }, s.attr("title", ""));
      }), this._updateContent(s, t));
    },
    _updateContent: function _updateContent(e, t) {
      var i,
          s = this.options.content,
          n = this,
          a = t ? t.type : null;
      return "string" == typeof s ? this._open(t, e, s) : (i = s.call(e[0], function (i) {
        e.data("ui-tooltip-open") && n._delay(function () {
          t && (t.type = a), this._open(t, e, i);
        });
      }), i && this._open(t, e, i), void 0);
    },
    _open: function _open(t, i, s) {
      function n(e) {
        u.of = e, o.is(":hidden") || o.position(u);
      }

      var a,
          o,
          r,
          h,
          l,
          u = e.extend({}, this.options.position);

      if (s) {
        if (a = this._find(i)) return a.tooltip.find(".ui-tooltip-content").html(s), void 0;
        i.is("[title]") && (t && "mouseover" === t.type ? i.attr("title", "") : i.removeAttr("title")), a = this._tooltip(i), o = a.tooltip, this._addDescribedBy(i, o.attr("id")), o.find(".ui-tooltip-content").html(s), this.liveRegion.children().hide(), s.clone ? (l = s.clone(), l.removeAttr("id").find("[id]").removeAttr("id")) : l = s, e("<div>").html(l).appendTo(this.liveRegion), this.options.track && t && /^mouse/.test(t.type) ? (this._on(this.document, {
          mousemove: n
        }), n(t)) : o.position(e.extend({
          of: i
        }, this.options.position)), o.hide(), this._show(o, this.options.show), this.options.show && this.options.show.delay && (h = this.delayedShow = setInterval(function () {
          o.is(":visible") && (n(u.of), clearInterval(h));
        }, e.fx.interval)), this._trigger("open", t, {
          tooltip: o
        }), r = {
          keyup: function keyup(t) {
            if (t.keyCode === e.ui.keyCode.ESCAPE) {
              var s = e.Event(t);
              s.currentTarget = i[0], this.close(s, !0);
            }
          }
        }, i[0] !== this.element[0] && (r.remove = function () {
          this._removeTooltip(o);
        }), t && "mouseover" !== t.type || (r.mouseleave = "close"), t && "focusin" !== t.type || (r.focusout = "close"), this._on(!0, i, r);
      }
    },
    close: function close(t) {
      var i,
          s = this,
          n = e(t ? t.currentTarget : this.element),
          a = this._find(n);

      a && (i = a.tooltip, a.closing || (clearInterval(this.delayedShow), n.data("ui-tooltip-title") && !n.attr("title") && n.attr("title", n.data("ui-tooltip-title")), this._removeDescribedBy(n), a.hiding = !0, i.stop(!0), this._hide(i, this.options.hide, function () {
        s._removeTooltip(e(this));
      }), n.removeData("ui-tooltip-open"), this._off(n, "mouseleave focusout keyup"), n[0] !== this.element[0] && this._off(n, "remove"), this._off(this.document, "mousemove"), t && "mouseleave" === t.type && e.each(this.parents, function (t, i) {
        e(i.element).attr("title", i.title), delete s.parents[t];
      }), a.closing = !0, this._trigger("close", t, {
        tooltip: i
      }), a.hiding || (a.closing = !1)));
    },
    _tooltip: function _tooltip(t) {
      var i = e("<div>").attr("role", "tooltip").addClass("ui-tooltip ui-widget ui-corner-all ui-widget-content " + (this.options.tooltipClass || "")),
          s = i.uniqueId().attr("id");
      return e("<div>").addClass("ui-tooltip-content").appendTo(i), i.appendTo(this.document[0].body), this.tooltips[s] = {
        element: t,
        tooltip: i
      };
    },
    _find: function _find(e) {
      var t = e.data("ui-tooltip-id");
      return t ? this.tooltips[t] : null;
    },
    _removeTooltip: function _removeTooltip(e) {
      e.remove(), delete this.tooltips[e.attr("id")];
    },
    _destroy: function _destroy() {
      var t = this;
      e.each(this.tooltips, function (i, s) {
        var n = e.Event("blur"),
            a = s.element;
        n.target = n.currentTarget = a[0], t.close(n, !0), e("#" + i).remove(), a.data("ui-tooltip-title") && (a.attr("title") || a.attr("title", a.data("ui-tooltip-title")), a.removeData("ui-tooltip-title"));
      }), this.liveRegion.remove();
    }
  });
});

/***/ }),

/***/ 1:
/*!********************************************!*\
  !*** multi ./resources/js/category_app.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\ufg-form\resources\js\category_app.js */"./resources/js/category_app.js");


/***/ })

/******/ });