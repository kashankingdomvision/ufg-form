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

    Route::group([
        'prefix' => 'bookings',
        'as'     => 'bookings.'
    ], function () {

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

        Route::post('booking-detail-cancellation', array('as' => 'booking.detail.cancellation', 'uses' => 'BookingController@booking_detail_cancellation'));
        Route::get('revert-booking-detail-cancellation/{id}', array('as' => 'revert.booking.detail.cancellation', 'uses' => 'BookingController@revert_booking_detail_cancellation'));

        Route::get('revert-cancel-booking/{id}', array('as' => 'revert.cancel.booking', 'uses' => 'BookingController@revert_cancel_booking'));

        // not used currently
        Route::post('category-detail-feilds', array('as' => 'category.detail.feilds', 'uses' => 'BookingController@category_detail_feilds'));
    });


    /*
    |--------------------------------------------------------------------------
    | Quote Manangement
    |--------------------------------------------------------------------------
    */

    Route::group([
        'prefix' => 'quotes',
        'as'     => 'quotes.'
    ], function () {

        /* crud routes */
        Route::get('index', array('as' => 'index', 'uses' => 'QuoteController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'QuoteController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'QuoteController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'QuoteController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'QuoteController@update'));
        Route::get('final/{id}', array('as' => 'final', 'uses' => 'QuoteController@finalQuote'));
        Route::get('trash', array('as' => 'view.trash', 'uses' => 'QuoteController@getTrash'));

        /* cancel quote route */
    	Route::get('cancel/{id}',array('as'=>'cancelled','uses'=>'QuoteController@cancel'));

        /* restore quote route */
        Route::get('restore/{id}', array('as' => 'restore', 'uses' => 'QuoteController@restore'));

        /* version quote route */
        Route::get('{id}/version/{va?}', array('as' => 'view.version', 'uses' => 'QuoteController@quoteVersion'));
        
        /* quote convet to booking route */
        Route::patch('booked/{id}', array('as' => 'booked', 'uses' => 'QuoteController@booking'));

        /* archive quote routes */
        Route::get('archive', array('as' => 'archive', 'uses' => 'QuoteController@getArchive'));
        Route::patch('archive/{id}/store', array('as' => 'archive.store', 'uses' => 'QuoteController@addInArchive'));
        
        /* override access quote route */
        Route::delete('has-user-edit/{id}',array('as'=>'has-user-edit','uses'=>'QuoteController@has_user_edit'));
        
        /* quote clone route */
        Route::patch('clone/{quote}',  'QuoteController@clone')->name('clone');

        /* multiple-action route */
        Route::delete('multiple-action',array('as'=>'multiple-action','uses'=>'QuoteController@multiple_action'));
        
        /* quote export route */
        Route::POST('{id}/generate/export',  'QuoteDocumentsController@generateExport')->name('export');
        
        /* quote document routes */
        Route::get('documment/{id}', array('as' => 'quote.documment', 'uses' => 'QuoteDocumentsController@index'));
        Route::get('{id}/generate/pdf', array('as' => 'document.pdf', 'uses' => 'QuoteDocumentsController@generatePDF'));
        
        /* group quote routes */
        Route::resource('group-quote', 'GroupController',['only' => [
            'index','create', 'store', 'edit', 'update', 'destroy'
        ]]);
        Route::get('getGroups/{id}', array('as' => 'getGroups', 'uses' => 'QuoteController@getGroups'));

        /* compare quote routes */
        Route::match(['get', 'post'], 'compare-quote', array('as' => 'compare.quote', 'uses' => 'QuoteController@compare_quote'));

        /* category detail get_autocomplete_data routes */
        Route::get('get_autocomplete_data', array('as' => 'get_autocomplete_data', 'uses' => 'QuoteController@get_autocomplete_data'));
    });

    /*
    |--------------------------------------------------------------------------
    | Stored Text
    |--------------------------------------------------------------------------
    */

    Route::group([
        'prefix' => 'store/text',
        'as'     => 'store.texts.'
    ], function () {

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

    Route::group([
        'prefix' => 'customers',
        'as'     => 'customers.'
    ], function () {

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
    ], function() {

        Route::get('index', ['as' => 'index', 'uses' => 'TemplateController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'TemplateController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'TemplateController@store']);
        Route::post('store-for-quote', ['as' => 'store.for.quote', 'uses' => 'TemplateController@store_for_quote']);
        Route::get('detail/{id}', ['as' => 'detail', 'uses' => 'TemplateController@detail']);
        Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'TemplateController@destroy']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'TemplateController@edit']);
        Route::put('update/{id}', ['as' => 'update', 'uses' => 'TemplateController@update']);
    });


   /* Supplier Bulk Payments */
    Route::group([
        'prefix' => 'supplier-bulk-payments',
        'as'     => 'supplier-bulk-payments.'
    ], function () {

        /* Add Supplier Bulk Payment */
        Route::get('index', array('as' => 'index', 'uses' => 'SupplierBulkPaymentController@index'));
        Route::post('supplier-bulk-payments/store', array('as' => 'store', 'uses' => 'SupplierBulkPaymentController@store'));
        
        /* View Supplier Bulk Payment */
        Route::get('view', array('as' => 'view', 'uses' => 'SupplierBulkPaymentController@view'));
    });


    /*
    |--------------------------------------------------------------------------
    | Commission Manangement
    |--------------------------------------------------------------------------
    */

    
    /* Commissions */
    Route::group([
        'prefix' => 'commissions',
        'as'     => 'commissions.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'CommissionController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'CommissionController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'CommissionController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'CommissionController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'CommissionController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'CommissionController@destroy'));

    });

    /* Commissions Group */
    Route::group([
        'prefix' => 'commission-groups',
        'as'     => 'commission_groups.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'CommissionGroupController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'CommissionGroupController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'CommissionGroupController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'CommissionGroupController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'CommissionGroupController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'CommissionGroupController@destroy'));
    });

    /* Commissions Group */
    Route::group([
        'prefix' => 'commission-criteria',
        'as'     => 'commission_criteria.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'CommissionCriteriaController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'CommissionCriteriaController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'CommissionCriteriaController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'CommissionCriteriaController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'CommissionCriteriaController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'CommissionCriteriaController@destroy'));
    });
    

    /*
    |--------------------------------------------------------------------------
    | Users Manangement
    |--------------------------------------------------------------------------
    */

    Route::group([
        'prefix' => 'users',
        'as'     => 'users.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'UserController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'UserController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'UserController@store'));
        Route::get('edit/{id}/{status?}', array('as' => 'edit', 'uses' => 'UserController@edit'));
        Route::post('update/{id}/{status?}', array('as' => 'update', 'uses' => 'UserController@update'));
    	Route::delete('delete/{id}',array('as'=>'delete','uses'=>'UserController@delete'));
        Route::post('transfer-report-column', array('as' => 'transfer.report.column', 'uses' => 'UserController@transfer_report_column'));
    });

    Route::resource('roles', 'RoleController',['only' => [
        'index','create', 'store', 'edit', 'update', 'destroy'
    ]]);

    /*
    |--------------------------------------------------------------------------
    | Report
    |--------------------------------------------------------------------------
    */

    Route::group([
        'prefix' => 'reports',
        'as'     => 'reports.'
    ], function () {

        Route::get('user-report', array('as' => 'user.report', 'uses' => 'ReportController@user_report'));
        Route::get('activity-by-user', array('as' => 'activity.by.user', 'uses' => 'ReportController@activity_by_user'));
        Route::get('supplier-report', array('as' => 'supplier.report', 'uses' => 'ReportController@supplier_report'));
        Route::get('wallet-report', array('as' => 'wallet.report', 'uses' => 'ReportController@wallet_report'));

        Route::get('quote-report', array('as' => 'quote.report', 'uses' => 'ReportController@quote_report'));
        Route::get('customer-report', array('as' => 'customer.report', 'uses' => 'ReportController@customer_report'));
        Route::get('payment-method-report', array('as' => 'payment.method.report', 'uses' => 'ReportController@payment_method_report'));

        Route::get('refund-by-bank-report', array('as' => 'refund.by.bank.report', 'uses' => 'ReportController@refund_by_bank_report'));
        Route::get('refund-by-credit-note-report', array('as' => 'refund.by.credit.note.report', 'uses' => 'ReportController@refund_by_credit_note_report'));

        Route::get('transfer-report', array('as' => 'transfer.report', 'uses' => 'ReportController@transfer_report'));
        Route::get('transfer-report-listing', array('as' => 'transfer.report.listing', 'uses' => 'ReportController@transfer_report_listing'));

        Route::get('commission-report', array('as' => 'commission.report', 'uses' => 'ReportController@commission_report'));

        // reports-export-routes
        Route::post('customer-report-export', array('as' => 'customer.report.export', 'uses' => 'ReportController@customer_report_export'));
        Route::post('user-report-export', array('as' => 'user.report.export', 'uses' => 'ReportController@user_report_export'));
        
        Route::post('compare-quote-report-export', array('as' => 'compare.quote.export', 'uses' => 'ReportController@compare_quote_export'));
        
        Route::post('activity-by-user-report-export', array('as' => 'activity.by.user.report.export', 'uses' => 'ReportController@activity_by_user_report_excel'));
        Route::post('supplier-report-export', array('as' => 'supplier.report.export', 'uses' => 'ReportController@supplier_report_export'));
        Route::post('quote-report-export', array('as' => 'quote.report.export', 'uses' => 'ReportController@quote_report_export'));
        Route::post('transfer-report-export', array('as' => 'transfer.report.export', 'uses' => 'ReportController@transfer_report_export'));
        Route::post('payment_method-report-export', array('as' => 'payment_method.report.export', 'uses' => 'ReportController@payment_method_report_export'));
        Route::post('refund-by-bank-report-export', array('as' => 'refund.by.bank.report.export', 'uses' => 'ReportController@refund_by_bank_report_export'));
        Route::post('refund-by-credit-note-report-export', array('as' => 'refund.by.credit_note.report.export', 'uses' => 'ReportController@refund_by_credit_note_report_export'));
        Route::post('wallet-report-export', array('as' => 'wallet.report.export', 'uses' => 'ReportController@wallet_report_export'));
        Route::post('commission-report-export', array('as' => 'commission.report.export', 'uses' => 'ReportController@commission_report_export'));
    });


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

    // Route::resource('suppliers', 'SupplierController');

    Route::group([
        'prefix' => 'suppliers',
        'as'     => 'suppliers.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'SupplierController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'SupplierController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'SupplierController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'SupplierController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'SupplierController@update'));
        Route::get('show/{id}', array('as' => 'show', 'uses' => 'SupplierController@show'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'SupplierController@destroy'));
    });


    /* Group Owner */
    Route::group([
        'prefix' => 'group-owners',
        'as'     => 'group_owners.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'GroupOwnerController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'GroupOwnerController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'GroupOwnerController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'GroupOwnerController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'GroupOwnerController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'GroupOwnerController@destroy'));
    });

    /*  Products */
    Route::group([
        'prefix' => 'supplier-rate-sheet',
        'as'     => 'supplier_rate_sheet.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'SupplierRateSheetController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'SupplierRateSheetController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'SupplierRateSheetController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'SupplierRateSheetController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'SupplierRateSheetController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'SupplierRateSheetController@destroy'));
    });

    /*  Products */
    Route::group([
        'prefix' => 'products',
        'as'     => 'products.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'ProductController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'ProductController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'ProductController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'ProductController@edit'));
        Route::post('update', array('as' => 'update', 'uses' => 'ProductController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'ProductController@destroy'));
    });

    /*  Supplier Categories */
    Route::resource('category-detail-forms', 'CategoryDetailFormController',['only' => [
        'index','create', 'store', 'edit', 'update', 'destroy'
    ]]);

    
    Route::group([
        'prefix' => 'categories',
        'as'     => 'categories.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'CategoryController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'CategoryController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'CategoryController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'CategoryController@edit'));
        Route::post('update', array('as' => 'update', 'uses' => 'CategoryController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'CategoryController@destroy'));
    });


    /*
    |--------------------------------------------------------------------------
    | Wallet
    |--------------------------------------------------------------------------
    */

    Route::group([
        'prefix' => 'wallets',
        'as'     => 'wallets.'
    ], function () {

        Route::get('index', array('as' => 'index', 'uses' => 'WalletController@index'));
        Route::get('get-supplier-wallet-amount/{supplier_id}', array('as' => 'get-supplier-wallet-amount', 'uses' => 'WalletController@get_supplier_wallet_amount'));
    });


    /*
    |--------------------------------------------------------------------------
    | Setting
    |--------------------------------------------------------------------------
    */

    Route::group([
        'prefix' => 'setting',
        'as'     => 'setting.'
    ],function (){

        /* Harbours, Train and Points of Interest */
		Route::resource('harbours', 'SettingControllers\HarbourController',['only' => [
			'index','create', 'store', 'edit', 'update', 'destroy'
		]]);

        /* AirportCode */
		Route::resource('airport_codes', 'SettingControllers\AirportCodeController',['only' => [
			'index','create', 'store', 'edit', 'update', 'destroy'
		]]);

        /* Hotels */
		Route::resource('hotels', 'SettingControllers\HotelController',['only' => [
			'index','create', 'store', 'edit', 'update', 'destroy'
		]]);

        /* Preset Comment */
        Route::resource('preset-comments', 'SettingControllers\PresetCommentController',['only' => [
            'index','create', 'store', 'edit', 'update', 'destroy'
        ]]);

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


        /* Countries */
        Route::resource('countries', 'SettingControllers\CountryController',['only' => [
            'index','create', 'store', 'edit', 'update', 'destroy'
        ]]);

        /* Towns */
        Route::resource('towns', 'SettingControllers\TownController',['only' => [
            'index','create', 'store', 'edit', 'update', 'destroy'
        ]]);

        /* Locations */
        Route::resource('locations', 'SettingControllers\LocationController',['only' => [
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
        
        /* calculate commission routes */
        Route::get('get-commission-criterias',array('as'=>'get.commission.criterias','uses'=>'ResponseController@get_commission_criterias'));
        Route::get('get-commissions', array('as'=>'get.commissions','uses'=>'ResponseController@get_commissions'));
        Route::get('get-commission-groups', array('as'=>'get.commission.groups','uses'=>'ResponseController@get_commission_groups'));
        /* calculate commission routes */

        Route::get('brand/to/holidays',array('as'=>'brand.holidays','uses'=>'ResponseController@getBrandToHoliday'));
        Route::get('multiple/brand/to/holidays',array('as'=>'multiple.brand.holidays','uses'=>'ResponseController@getMultipleBrandToHoliday'));

        Route::get('country/to/town',array('as'=>'country.towns','uses'=>'ResponseController@getCountryToTown'));
        Route::get('country/to/location',array('as'=>'country.locations','uses'=>'ResponseController@getCountryToLocation'));

        Route::get('category/to/supplier',array('as'=>'category.supplier','uses'=>'ResponseController@getCategoryToSupplier'));

        Route::get('country/to/supplier',array('as'=>'country.supplier','uses'=>'ResponseController@getCountryToSupplier'));


        Route::get('supplier/to/product/currency',array('as'=>'supplier.product','uses'=>'ResponseController@getSupplierToProductORCurrency'));
        Route::get('quotes/child/reference', array('as' => 'get.child.reference', 'uses' => 'ResponseController@getChildReference'));
        Route::get('find/reference/{id}/exist', array('as' => 'quotes.ref.exit', 'uses' => 'ResponseController@isReferenceExists'));
        Route::post('find/reference', array('as' => 'quotes.ref.exit', 'uses' => 'ResponseController@findReference'));
        Route::get('template/{id}/partial', ['as' => 'partial', 'uses' => 'ResponseController@call_template']);
        Route::get('pax/{count}/partial', ['as' => 'partial', 'uses' => 'ResponseController@getPaxPartial']);
        Route::put('bulk-action', ['as' => 'bulk.action', 'uses' => 'ResponseController@bulkAction']);
        Route::post('currency/status', ['as' => 'currency.status', 'uses' => 'ResponseController@updateCurrencyStatus']);
        Route::get('stored/{slug}/text', ['as' => 'stored.text', 'uses' => 'ResponseController@getStoredText']);
        Route::get('filter-currency-rate/{ids?}', array('as' => 'filter.currency.rate', 'uses' => 'ResponseController@filter_currency_rate'));
        
        // Route::get('get-supplier-rate-sheet',array('as'=>'supplier.rate.sheet','uses'=>'ResponseController@getSupplierRateSheet'));
        Route::get('get-supplier-product-and-sheet',array('as'=>'supplier.product.and.sheet','uses'=>'ResponseController@getSupplierProductAndSheet'));
        Route::post('add-product-with-supplier-sync',array('as'=>'add.product.with.supplier.sync','uses'=>'ResponseController@addProductWithSupplierSync'));

        Route::get('location/to/supplier',array('as'=>'location.supplier','uses'=>'ResponseController@getLocationToSupplier'));
        Route::get('location/to/product',array('as'=>'location.product','uses'=>'ResponseController@getLocationToProduct'));
        
        Route::get('get-product-booking-type',array('as'=>'get.product.booking.type','uses'=>'ResponseController@getProductBookingType'));

        
        Route::get('category-details-filter', array('as' => 'category.details.filter', 'uses' => 'ReportController@category_details_filter'));


        Route::get('remove-form-buidler-feild', array('as' => 'remove.form.buidler.feild', 'uses' => 'ResponseController@removeFormBuidlerFeild'));
    });


    Route::get('pdf', function()
    {
        return view('quote_documents.index');
    });
});

// Route::group([
//     'prefix' => 'commissions',
//     'as'     => 'commissions.'
// ], function () {

    /* Commsisions */
    // Route::resource('commission', 'CommissionController',['only' => [
    //     'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /* Commission Group */
    // Route::resource('commission-group', 'CommissionGroupController',['only' => [
    //     'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /*  Commission Criteria */
    // Route::resource('commission-criteria', 'CommissionCriteriaController',['only' => [
    //     'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

// });

// Route::get('edit/{id}/{status?}', array('as' => 'edit', 'uses' => 'UserController@edit'));
// Route::delete('delete/{id}',array('as'=>'delete','uses'=>'UserController@delete'));

// Route::get('index', array('as' => 'products.index', 'uses' => 'ProductController@index'));
// Route::get('edit/{id}', ['as' => 'products.edit', 'uses' => 'ProductController@edit']);
// Route::post('update', array('as' => 'products.update', 'uses' => 'ProductController@update'));

// Route::resource('products', 'ProductController',['only' => [
//     'index','create', 'store',  'destroy'
// ]]);

/*  Supplier Categories */
// Route::resource('categories', 'CategoryController',['only' => [
//     'index','create', 'store', 'edit', 'update', 'destroy'
// ]])

/*  Supplier Rate Sheet */
// Route::resource('supplier-rate-sheet', 'SupplierRateSheetController',['only' => [
// 'index','create', 'store', 'edit', 'update', 'destroy'
// ]]);