<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){

    /* Refresh Token */
	Route::get('refresh-token',array('before'=>'csrf','as'=>'refresh-token','uses'=>'HomeController@refresh_token'));


    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::resource('dashboard', 'DashboardController',['only' => [
        'index','create', 'store', 'edit', 'update', 'destroy'
    ]]);

    Route::delete('multiple-delete/{ids}',array('as'=>'multiple-delete','uses'=>'DashboardController@multiple_delete'));
    Route::delete('has-user-edit/{id}',array('as'=>'has-user-edit','uses'=>'DashboardController@has_user_edit'));
    Route::put('update_override/{id}', array('as' => 'update.override', 'uses' => 'DashboardController@update_override'));

    /*
    |--------------------------------------------------------------------------
    | Booking
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'bookings', 'as' => 'bookings.'], function () {
        // Route::get('view-seasons', array('as' => 'view.seasons', 'uses' => 'BookingController@view_seasons'));
        Route::get('index', array('as' => 'index', 'uses' => 'BookingController@index'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'BookingController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'BookingController@update'));
        Route::delete('destroy/{id}', array('as' => 'delete', 'uses' => 'BookingController@destroy'));
        Route::get('versions/{id}', array('as' => 'version', 'uses' => 'BookingController@viewVersion'));
        Route::get('show/{id}/{status?}', array('as' => 'show', 'uses' => 'BookingController@show'));
        Route::get('cancel/{id}', array('as' => 'cancel', 'uses' => 'BookingController@bookingCancel'));
        Route::post('refund-to-bank', array('as' => 'refund-to-bank', 'uses' => 'BookingController@refund_to_bank'));
        Route::post('credit-note', array('as' => 'credit-note', 'uses' => 'BookingController@credit_note'));

        Route::get('booking-detail-clone/{id}', array('as' => 'booking.detail.clone', 'uses' => 'BookingController@booking_detail_clone'));
        Route::get('get-booking-net-price/{id}', array('as' => 'get.booking.net.price', 'uses' => 'BookingController@get_booking_net_price'));
        
        Route::post('cancel-booking', array('as' => 'cancel.booking', 'uses' => 'BookingController@cancel_booking'));
        Route::get('revert-cancel-booking/{id}', array('as' => 'revert.cancel.booking', 'uses' => 'BookingController@revert_cancel_booking'));
    });


    /*
    |--------------------------------------------------------------------------
    | Quote Manangement
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'quotes', 'as' => 'quotes.'], function () {
        Route::get('index', array('as' => 'index', 'uses' => 'QuoteController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'QuoteController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'QuoteController@store'));
    	Route::get('cancel/{id}',array('as'=>'cancelled','uses'=>'QuoteController@cancel'));
        Route::get('restore/{id}', array('as' => 'restore', 'uses' => 'QuoteController@restore'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'QuoteController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'QuoteController@update'));
        Route::get('{id}/version/{va?}', array('as' => 'view.version', 'uses' => 'QuoteController@quoteVersion'));
        Route::patch('booked/{id}', array('as' => 'booked', 'uses' => 'QuoteController@booking'));
        Route::get('trash', array('as' => 'view.trash', 'uses' => 'QuoteController@getTrash'));
        Route::get('final/{id}', array('as' => 'final', 'uses' => 'QuoteController@finalQuote'));
        Route::patch('archive/{id}/store', array('as' => 'archive.store', 'uses' => 'QuoteController@addInArchive'));
        Route::get('archive', array('as' => 'archive', 'uses' => 'QuoteController@getArchive'));
        Route::delete('has-user-edit/{id}',array('as'=>'has-user-edit','uses'=>'QuoteController@has_user_edit'));
        Route::delete('multiple-action',array('as'=>'multiple-action','uses'=>'QuoteController@multiple_action'));
        // Route::get('documents/{quote}',  'QuoteDocumentsController@documentIndex')->name('document');
        Route::patch('clone/{quote}',  'QuoteController@clone')->name('clone');
        Route::POST('{id}/generate/export',  'QuoteDocumentsController@generateExport')->name('export');
        // Route::get('documment/{id}', array('as' => 'quote.documment', 'uses' => 'QuoteController@quote_document'));
        
        Route::get('{id}/generate/pdf',  'QuoteDocumentsController@generatePDF')->name('document.pdf');
        Route::get('documment/{id}', array('as' => 'quote.documment', 'uses' => 'QuoteDocumentsController@index'));

    });


    
    /*
    |--------------------------------------------------------------------------
    | Stored Text 
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'store/text', 'as' => 'store.texts.'], function () {
        Route::get('index', array('as' => 'index', 'uses' => 'StoreTextController@index'));
        Route::get('create', ['as' => 'create', 'uses' => 'StoreTextController@create']);
        Route::get('edit/{slug}', ['as' => 'edit', 'uses' => 'StoreTextController@edit']);
        Route::put('update/{slug}', ['as' => 'update', 'uses' => 'StoreTextController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'StoreTextController@store']);
        Route::delete('destroy/{slug}', ['as' => 'destroy', 'uses' => 'StoreTextController@destroy']);
    });
    
    /*
    |--------------------------------------------------------------------------
    | Customer
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {

        Route::get('index', array('as' => 'index', 'uses' => 'CustomerController@index'));
        Route::get('quote-listing/{email}', array('as' => 'quote.listing', 'uses' => 'CustomerController@quote_listing'));
        Route::get('booking-listing/{email}', array('as' => 'booking.listing', 'uses' => 'CustomerController@booking_listing'));
    });

    /*
    |--------------------------------------------------------------------------
    | Template Controller
    |--------------------------------------------------------------------------
    */

	Route::group([
        'prefix' => 'template',
        'as' 	 => 'templates.'
    ],function (){
        Route::get('index', ['as' => 'index', 'uses' => 'TemplateController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'TemplateController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'TemplateController@store']);
        Route::get('detail/{id}', ['as' => 'detail', 'uses' => 'TemplateController@detail']);
        Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'TemplateController@destroy']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'TemplateController@edit']);
        Route::put('update/{id}', ['as' => 'update', 'uses' => 'TemplateController@update']);
    });


    /*
    |--------------------------------------------------------------------------
    | Users Manangement
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('index', array('as' => 'index', 'uses' => 'UserController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'UserController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'UserController@store'));
        Route::get('edit/{id}/{status?}', array('as' => 'edit', 'uses' => 'UserController@edit'));
        Route::post('update/{id}/{status?}', array('as' => 'update', 'uses' => 'UserController@update'));
    	Route::delete('delete/{id}',array('as'=>'delete','uses'=>'UserController@delete'));
    });

    Route::resource('roles', 'RoleController',['only' => [
        'index','create', 'store', 'edit', 'update', 'destroy'
    ]]);


    /*
    |--------------------------------------------------------------------------
    | Season Manangement
    |--------------------------------------------------------------------------
    */

    Route::resource('seasons', 'SeasonController',['only' => [
		'index','create', 'store', 'edit', 'update', 'destroy'
    ]]);

    
    /*
    |--------------------------------------------------------------------------
    | Supplier Managment
    |--------------------------------------------------------------------------
    */

    Route::resource('suppliers', 'SupplierController');

    /*  Supplier Product */
    Route::resource('products', 'ProductController',['only' => [
        'index','create', 'store', 'edit', 'update', 'destroy'
    ]]);

    /*  Supplier Categories */
    Route::resource('categories', 'CategoryController',['only' => [
        'index','create', 'store', 'edit', 'update', 'destroy'
    ]]);


    /*
    |--------------------------------------------------------------------------
    | Wallet
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'wallets', 'as' => 'wallets.'], function () {
        Route::get('index', array('as' => 'index', 'uses' => 'WalletController@index'));
        Route::get('get-supplier-wallet-amount/{supplier_id}', array('as' => 'get-supplier-wallet-amount', 'uses' => 'WalletController@get_supplier_wallet_amount'));
    });


    /*
    |--------------------------------------------------------------------------
    | Setting
    |--------------------------------------------------------------------------
    */

    Route::group([ 'prefix' => 'setting', 'as' => 'setting.'],function (){

        /* Bank */
        Route::resource('banks', 'SettingControllers\BankController',['only' => [
            'index','create', 'store', 'edit', 'update', 'destroy'
        ]]);
        
        /* Airlines */
		Route::resource('airlines', 'SettingControllers\AirlineController',['only' => [
			'index','create', 'store', 'edit', 'update', 'destroy'
		]]);

        /* Booking methods */
		Route::resource('booking_methods', 'SettingControllers\BookingMethodController',['only' => [
			'index','create', 'store', 'edit', 'update', 'destroy'
		]]);

	    /* Payment methods */
		Route::resource('payment_methods', 'SettingControllers\PaymentMethodController',['only' => [
			'index','create', 'store', 'edit', 'update', 'destroy'
		]]);

		/* Currencies */
		Route::resource('currencies', 'SettingControllers\CurrencyController',['only' => [
			'index','create', 'store', 'edit', 'update', 'destroy'
		]]);

		/* Brands */
		Route::resource('brands', 'SettingControllers\BrandController',['only' => [
			'index','create', 'store', 'edit', 'update', 'destroy'
		]]);

		/*  Holiday Types */
		Route::resource('holidaytypes', 'SettingControllers\HolidayTypeController',['only' => [
			'index','create', 'store', 'edit', 'update', 'destroy'
		]]);

		/* Currency Conversion */
		Route::resource('currency_conversions', 'SettingControllers\CurrencyConversionController',['only' => [
			'index', 'edit', 'update'
		]]);

        /* Commsisions */
        Route::resource('commissions', 'SettingControllers\CommissionController',['only' => [
            'index','create', 'store', 'edit', 'update', 'destroy'
        ]]);

	});

 
   /*
    |--------------------------------------------------------------------------
    | Routes For Ajax Request
    |--------------------------------------------------------------------------
    */
    Route::prefix('json')->group(function () {
        Route::get('holiday-types',array('as'=>'get-holiday-type','uses'=>'AdminController@get_holiday_type'));
        Route::get('get-currency-conversion',array('as'=>'get-currency-conversion','uses'=>'QuoteController@get_currency_conversion'));
        Route::get('get-commission',array('as'=>'get-commission','uses'=>'QuoteController@get_commission'));
        Route::get('brand/to/holidays',array('as'=>'brand.holidays','uses'=>'ResponseController@getBrandToHoliday'));
        Route::get('category/to/supplier',array('as'=>'category.supplier','uses'=>'ResponseController@getCategoryToSupplier'));
        Route::get('supplier/to/product/currency',array('as'=>'supplier.product','uses'=>'ResponseController@getSupplierToProductORCurrency'));
        Route::get('quotes/child/reference', array('as' => 'get.child.reference', 'uses' => 'ResponseController@getChildReference'));
        Route::get('find/reference/{id}/exist', array('as' => 'quotes.ref.exit', 'uses' => 'ResponseController@isReferenceExists'));
        Route::post('find/reference', array('as' => 'quotes.ref.exit', 'uses' => 'ResponseController@findReference'));
        Route::get('template/{id}/partial', ['as' => 'partial', 'uses' => 'ResponseController@call_template']);
        Route::get('pax/{count}/partial', ['as' => 'partial', 'uses' => 'ResponseController@getPaxPartial']);
        Route::put('bulk-action', ['as' => 'bulk.action', 'uses' => 'ResponseController@bulkAction']);
        Route::post('currency/status', ['as' => 'currency.status', 'uses' => 'ResponseController@updateCurrencyStatus']);
    });
    
    
    Route::get('pdf', function()
    {
        return view('quote_documents.index');
    });
});
