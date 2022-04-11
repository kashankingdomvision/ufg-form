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

Route::group(['middleware' => ['auth']], function(){
    
    /* Zoho Crm Refresh Token */
	Route::get('refresh-token' , array('before' => 'csrf', 'as' => 'refresh_token', 'uses' => 'DashboardController@refresh_token'));

    /* Laravel File manager */
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

    Route::delete('multiple-delete/{ids}', array('as' =>'multiple-delete', 'uses' => 'DashboardController@multiple_delete'));
    Route::delete('has-user-edit/{id}', array('as' => 'has-user-edit', 'uses' => 'DashboardController@has_user_edit'));
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

        /* Booking Multiple Alert Patches Route */
        Route::patch('multiple-alert/{type}/{id}', array('as' => 'multiple.alert', 'uses' => 'BookingController@multipleAlert'));
        Route::patch('booking-detail-status/{type}/{id}', array('as' => 'booking.detail.status', 'uses' => 'BookingController@bookingDetailStatus'));
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
        Route::get('archive', array('as' => 'archive', 'uses' => 'QuoteController@archiveIndex'));
        
        /* override access quote route */
        Route::delete('has-user-edit/{id}',array('as'=>'has-user-edit','uses'=>'QuoteController@has_user_edit'));
        
        /* quote clone route */
        // Route::patch('clone/{quote}', array('as' => 'clone', 'uses' => 'QuoteController@cloneQuote'));
        
        /* quote export route */
        // Route::POST('{id}/generate/export',  'QuoteDocumentsController@generateExport')->name('export');
        
        /* quote document routes */
        Route::get('documment/{id}', array('as' => 'quote.documment', 'uses' => 'QuoteDocumentsController@index'));
        Route::get('{id}/generate/pdf', array('as' => 'document.pdf', 'uses' => 'QuoteDocumentsController@generatePDF'));
        
        /* group quote routes */
        // Route::resource('group-quote', 'GroupController',['only' => [
        //     'index','create', 'store', 'edit', 'update', 'destroy'
        // ]]);

        Route::get('getGroups/{id}', array('as' => 'getGroups', 'uses' => 'QuoteController@getGroups'));

        /* compare quote routes */
        Route::match(['get', 'post'], 'compare-quote', array('as' => 'compare.quote', 'uses' => 'QuoteController@compare_quote'));

        /* category detail get_autocomplete_data routes */
        Route::get('get_autocomplete_data', array('as' => 'get_autocomplete_data', 'uses' => 'QuoteController@get_autocomplete_data'));

        /* Quote Listing Bulk Action Route */
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'QuoteController@bulkAction' ));

        /* Quote Multiple Alert Patches Route */
        Route::patch('multiple-alert/{type}/{id}', array('as' => 'multiple.alert', 'uses' => 'QuoteController@multipleAlert'));
        
        /* Export Quote */
        Route::get('export/{id}', array('as' => 'export', 'uses' => 'QuoteController@exportQuote' ));

        // Route::patch('archive/{id}/store', array('as' => 'archive.store', 'uses' => 'QuoteController@addInArchive'));
        /* multiple-action route */
        // Route::delete('multiple-action',array('as'=>'multiple-action','uses'=>'QuoteController@multiple_action'));
    });

    /* Quote Groups */
    Route::group([
        'prefix' => 'groups',
        'as'     => 'groups.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'GroupController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'GroupController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'GroupController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'GroupController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'GroupController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'GroupController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'GroupController@bulkAction' ));
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
        'prefix' => 'templates',
        'as' 	 => 'templates.'
    ], function() {

        Route::get('index', array('as' => 'index', 'uses' => 'TemplateController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'TemplateController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'TemplateController@store'));
        Route::post('store-for-quote', array('as' => 'store.for.quote', 'uses' => 'TemplateController@store_for_quote'));
        Route::get('detail/{id}', array('as' => 'detail', 'uses' => 'TemplateController@detail'));
        Route::get('delete/{id}', array('as' => 'delete', 'uses' => 'TemplateController@destroy'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'TemplateController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'TemplateController@update'));
    });

    
    /*
    |--------------------------------------------------------------------------
    | Users Manangement
    |--------------------------------------------------------------------------
    */

    /* Users */
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
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'UserController@bulkAction' ));
    });

    /* Roles */
    Route::group([
        'prefix' => 'roles',
        'as'     => 'roles.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'RoleController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'RoleController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'RoleController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'RoleController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'RoleController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'RoleController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'RoleController@bulkAction' ));
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
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'CommissionController@bulkAction' ));
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
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'CommissionGroupController@bulkAction' ));
    });

    /* Commissions Group */
    Route::group([
        'prefix' => 'commission-criterias',
        'as'     => 'commission_criterias.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'CommissionCriteriaController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'CommissionCriteriaController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'CommissionCriteriaController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'CommissionCriteriaController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'CommissionCriteriaController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'CommissionCriteriaController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'CommissionCriteriaController@bulkAction' ));
    });
    
    /*
    |--------------------------------------------------------------------------
    | Supplier Managment
    |--------------------------------------------------------------------------
    */

    /*  Suppliers */
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
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'SupplierController@bulkAction' ));
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
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'GroupOwnerController@bulkAction' ));
    });

    /*  Supplier Rate Sheet */
    Route::group([
        'prefix' => 'supplier-rate-sheets',
        'as'     => 'supplier_rate_sheets.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'SupplierRateSheetController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'SupplierRateSheetController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'SupplierRateSheetController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'SupplierRateSheetController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'SupplierRateSheetController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'SupplierRateSheetController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'SupplierRateSheetController@bulkAction' ));
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
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'ProductController@bulkAction' ));
    });

    /*  Categories */
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
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'CategoryController@bulkAction' ));
    });

    /* Wallet */
    Route::group([
        'prefix' => 'wallets',
        'as'     => 'wallets.'
    ], function () {

        Route::get('index', array('as' => 'index', 'uses' => 'WalletController@index'));
        Route::get('get-supplier-wallet-amount/{supplier_id}', array('as' => 'get-supplier-wallet-amount', 'uses' => 'WalletController@get_supplier_wallet_amount'));
    });

    /*
    |--------------------------------------------------------------------------
    | Supplier Bulk Payments
    |--------------------------------------------------------------------------
    */
    
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
    | Setting
    |--------------------------------------------------------------------------
    */

    /*  AirportCode */
    Route::group([
        'prefix' => 'airport-codes',
        'as'     => 'airport_codes.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'AirportCodeController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'AirportCodeController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'AirportCodeController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'AirportCodeController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'AirportCodeController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'AirportCodeController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'AirportCodeController@bulkAction' ));
    });

    /*  Banks */
    Route::group([
        'prefix' => 'banks',
        'as'     => 'banks.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'BankController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'BankController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'BankController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'BankController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'BankController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'BankController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'BankController@bulkAction' ));
    });

    /*  Brands */
    Route::group([
        'prefix' => 'brands',
        'as'     => 'brands.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'BrandController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'BrandController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'BrandController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'BrandController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'BrandController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'BrandController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'BrandController@bulkAction' ));
    });

    /*  Cabins */
    Route::group([
        'prefix' => 'cabins',
        'as'     => 'cabins.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'CabinTypeController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'CabinTypeController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'CabinTypeController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'CabinTypeController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'CabinTypeController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'CabinTypeController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'CabinTypeController@bulkAction' ));
    });

    /*  Contacts */
    Route::group([
        'prefix' => 'tour_contacts',
        'as'     => 'tour_contacts.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'TourContactController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'TourContactController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'TourContactController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'TourContactController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'TourContactController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'TourContactController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'TourContactController@bulkAction' ));
    });

    /*  Countries */
    Route::group([
        'prefix' => 'countries',
        'as'     => 'countries.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'CountryController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'CountryController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'CountryController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'CountryController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'CountryController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'CountryController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'CountryController@bulkAction' ));
    });

    /*  Currencies */
    Route::group([
        'prefix' => 'currencies',
        'as'     => 'currencies.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'CurrencyController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'CurrencyController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'CurrencyController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'CurrencyController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'CurrencyController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'CurrencyController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'CurrencyController@bulkAction' ));
    });

    /*  Currency Conversion */
    Route::group([
        'prefix' => 'currency-conversions',
        'as'     => 'currency_conversions.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'CurrencyConversionController@index'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'CurrencyConversionController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'CurrencyConversionController@update'));
    });
    
    /*  Harbours, Train and Points of Interest */
    Route::group([
        'prefix' => 'harbours',
        'as'     => 'harbours.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'HarbourController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'HarbourController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'HarbourController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'HarbourController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'HarbourController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'HarbourController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'HarbourController@bulkAction' ));
    });

    /*  Holiday Types */
    Route::group([
        'prefix' => 'holiday-types',
        'as'     => 'holiday_types.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'HolidayTypeController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'HolidayTypeController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'HolidayTypeController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'HolidayTypeController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'HolidayTypeController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'HolidayTypeController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'HolidayTypeController@bulkAction' ));
    });

    /*  Hotels */
    Route::group([
        'prefix' => 'hotels',
        'as'     => 'hotels.'
    ], function () {

        Route::get('index', array('as' => 'index', 'uses' => 'HotelController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'HotelController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'HotelController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'HotelController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'HotelController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'HotelController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'HotelController@bulkAction' ));
    });

    /*  Locations */
    Route::group([
        'prefix' => 'locations',
        'as'     => 'locations.'
    ], function () {

        Route::get('index', array('as' => 'index', 'uses' => 'LocationController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'LocationController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'LocationController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'LocationController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'LocationController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'LocationController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'LocationController@bulkAction' ));
    });
    
    /* Payment Methods */
    Route::group([
        'prefix' => 'payment-methods',
        'as'     => 'payment_methods.'
    ], function () {

        Route::get('index', array('as' => 'index', 'uses' => 'PaymentMethodController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'PaymentMethodController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'PaymentMethodController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'PaymentMethodController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'PaymentMethodController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'PaymentMethodController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'PaymentMethodController@bulkAction' ));
    });

    /* Preset Comments */
    Route::group([
        'prefix' => 'preset-comments',
        'as'     => 'preset_comments.'
    ], function () {

        Route::get('index', array('as' => 'index', 'uses' => 'PresetCommentController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'PresetCommentController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'PresetCommentController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'PresetCommentController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'PresetCommentController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'PresetCommentController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'PresetCommentController@bulkAction' ));
    });

    /* Seasons */
    Route::group([
        'prefix' => 'seasons',
        'as'     => 'seasons.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'SeasonController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'SeasonController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'SeasonController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'SeasonController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'SeasonController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'SeasonController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'SeasonController@bulkAction' ));
    });

    /* Store Text */
    Route::group([
        'prefix' => 'store-texts',
        'as'     => 'store_texts.'
    ], function () {

        Route::get('index', array('as' => 'index', 'uses' => 'StoreTextController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'StoreTextController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'StoreTextController@store'));
        Route::get('edit/{slug}', array('as' => 'edit', 'uses' => 'StoreTextController@edit'));
        Route::put('update/{slug}', array('as' => 'update', 'uses' => 'StoreTextController@update'));
        Route::delete('delete/{slug}', array('as' => 'destroy', 'uses' => 'StoreTextController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'StoreTextController@bulkAction' ));
    });

    /*  Stations */
    Route::group([
        'prefix' => 'stations',
        'as'     => 'stations.'
    ], function () {
        
        Route::get('index', array('as' => 'index', 'uses' => 'StationController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'StationController@create'));
        Route::post('store', array('as' => 'store', 'uses' => 'StationController@store'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'StationController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'StationController@update'));
        Route::delete('delete/{id}', array('as' => 'destroy', 'uses' => 'StationController@destroy'));
        Route::post('bulk-action', array('as' => 'bulk.action', 'uses' => 'StationController@bulkAction' ));
    });

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
    | Routes For Ajax Request
    |--------------------------------------------------------------------------
    */
    Route::prefix('json')->group(function () {

        Route::post('store-harbour', array('as' => 'response.harbours.store', 'uses' => 'ResponseController@storeHarbour'));
        Route::post('store-airport-code', array('as' => 'response.airport_codes.store', 'uses' => 'ResponseController@storeAirportCode'));
        Route::post('store-hotel', array('as' => 'response.hotels.store', 'uses' => 'ResponseController@storeHotel'));
        Route::post('store-group-owner', array('as' => 'response.group_owners.store', 'uses' => 'ResponseController@storeGroupOwner'));
        Route::post('store-supplier', array('as' => 'response.suppliers.store', 'uses' => 'ResponseController@storeSupplier'));
        Route::post('store-cabin-type', array('as' => 'response.cabin_types.store', 'uses' => 'ResponseController@storeCabinType'));
        Route::post('store-station', array('as' => 'response.stations.store', 'uses' => 'ResponseController@storeStation'));

        Route::get('tour-contacts', array('as' => 'tour.contacts', 'uses' => 'ResponseController@tourContacts'));
        Route::get('get-currency-conversions', array('as'=>'get.currency.conversions','uses'=>'ResponseController@getCurrencyConversions'));
        Route::get('get-commission-criteriass',array('as'=>'get.commission.criterias','uses'=>'ResponseController@get_commission_criterias'));
        Route::get('get-commissions', array('as'=>'get.commissions','uses'=>'ResponseController@get_commissions'));
        Route::get('get-commission-groups', array('as'=>'get.commission.groups','uses'=>'ResponseController@get_commission_groups'));
        
        Route::get('supplier-on-change', array('as'=>'supplier.on.change','uses'=>'ResponseController@SupplierOnChange'));
        Route::get('brand-on-change', array('as'=>'brand.on.change','uses'=>'ResponseController@brandOnChange'));
        Route::get('multiple-brand-on-change', array('as'=>'multiple.brand.on.change','uses'=>'ResponseController@multipleBrandOnChange'));
        Route::get('country-on-change', array('as'=>'country.on.change','uses'=>'ResponseController@countryOnChange'));
        Route::get('group-owner-on-change', array('as'=>'group_owner.on.change','uses'=>'ResponseController@groupOwnerOnChange'));
        Route::get('category-on-change', array('as'=>'category.on.change','uses'=>'ResponseController@categoryOnChange'));
        Route::get('supplier-countries-on-change',array('as'=>'supplier.countries.on.change','uses'=>'ResponseController@supplierCountriesOnChange'));
        Route::get('get-filter-currency-rate', array('as' => 'get.filter.currency.rate', 'uses' => 'ResponseController@getFilterCurrencyRates'));

        Route::get('supplier/to/product/currency',array('as'=>'supplier.product','uses'=>'ResponseController@getSupplierToProductORCurrency'));
        Route::get('quotes/child/reference', array('as' => 'get.child.reference', 'uses' => 'ResponseController@getChildReference'));
        Route::get('find/reference/{id}/exist', array('as' => 'quotes.ref.exit', 'uses' => 'ResponseController@isReferenceExists'));
        Route::post('find/reference', array('as' => 'quotes.ref.exit', 'uses' => 'ResponseController@findReference'));
        Route::get('template/{id}/partial', ['as' => 'partial', 'uses' => 'ResponseController@call_template']);
        Route::get('pax/{count}/partial', ['as' => 'partial', 'uses' => 'ResponseController@getPaxPartial']);
        Route::put('bulk-action', ['as' => 'bulk.action', 'uses' => 'ResponseController@bulkAction']);
        Route::post('currency/status', ['as' => 'currency.status', 'uses' => 'ResponseController@updateCurrencyStatus']);
        Route::get('stored/{slug}/text', ['as' => 'stored.text', 'uses' => 'ResponseController@getStoredText']);
        
        // Route::get('get-supplier-rate-sheets',array('as'=>'supplier.rate.sheet','uses'=>'ResponseController@getSupplierRateSheet'));
        Route::get('get-supplier-product-and-sheet',array('as'=>'supplier.product.and.sheet','uses'=>'ResponseController@getSupplierProductAndSheet'));
        Route::post('add-product-with-supplier-sync',array('as'=>'add.product.with.supplier.sync','uses'=>'ResponseController@addProductWithSupplierSync'));

        Route::get('location/to/supplier',array('as'=>'location.supplier','uses'=>'ResponseController@getLocationToSupplier'));
        Route::get('location/to/product',array('as'=>'location.product','uses'=>'ResponseController@getLocationToProduct'));
        
        Route::get('get-product-booking-type',array('as'=>'get.product.booking.type','uses'=>'ResponseController@getProductBookingType'));

        
        Route::get('category-details-filter', array('as' => 'category.details.filter', 'uses' => 'ReportController@category_details_filter'));


        Route::get('remove-form-buidler-feild', array('as' => 'remove.form.buidler.feild', 'uses' => 'ResponseController@removeFormBuidlerFeild'));


        Route::get('holiday-types',array('as'=>'get-holiday-type','uses'=>'AdminController@get_holiday_type'));


        // Route::get('country/to/town',array('as'=>'country.towns','uses'=>'ResponseController@getCountryToTown'));
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
    // Route::resource('commission-criterias', 'CommissionCriteriaController',['only' => [
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
// Route::resource('supplier-rate-sheets', 'SupplierRateSheetController',['only' => [
// 'index','create', 'store', 'edit', 'update', 'destroy'
// ]]);

  
// Route::group([
//     'prefix' => 'setting',
//     'as'     => 'setting.'
// ],function (){

    /* Harbours, Train and Points of Interest */
    // Route::resource('harbours', 'SettingControllers\HarbourController',['only' => [
    // 	'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /* AirportCode */
    // Route::resource('airport_codes', 'SettingControllers\AirportCodeController',['only' => [
    // 	'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /* Bank */
    // Route::resource('banks', 'SettingControllers\BankController',['only' => [
    //     'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /* Hotels */
    // Route::resource('hotels', 'SettingControllers\HotelController',['only' => [
    // 	'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /* Preset Comment */
    // Route::resource('preset-comments', 'SettingControllers\PresetCommentController',['only' => [
    //     'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /* Airlines */
    // Route::resource('airlines', 'SettingControllers\AirlineController',['only' => [
    //     'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /* Booking methods */
    // Route::resource('booking_methods', 'SettingControllers\BookingMethodController',['only' => [
    // 	'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /* Payment methods */
    // Route::resource('payment_methods', 'SettingControllers\PaymentMethodController',['only' => [
    // 	'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /* Currencies */
    // Route::resource('currencies', 'SettingControllers\CurrencyController',['only' => [
    // 	'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /* Brands */
    // Route::resource('brands', 'SettingControllers\BrandController',['only' => [
    // 	'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /*  Holiday Types */
    // Route::resource('holidaytypes', 'SettingControllers\HolidayTypeController',['only' => [
    // 	'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /* Currency Conversion */
    // Route::resource('currency_conversions', 'SettingControllers\CurrencyConversionController',['only' => [
    // 	'index', 'edit', 'update'
    // ]]);


    /* Countries */
    // Route::resource('countries', 'SettingControllers\CountryController',['only' => [
    //     'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /* Towns */
    // Route::resource('towns', 'SettingControllers\TownController',['only' => [
    //     'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

    /* Locations */
    // Route::resource('locations', 'SettingControllers\LocationController',['only' => [
    //     'index','create', 'store', 'edit', 'update', 'destroy'
    // ]]);

// });

/*
|--------------------------------------------------------------------------
| Season Manangement
|--------------------------------------------------------------------------
*/

// Route::resource('seasons', 'SeasonController',['only' => [
// 	'index','create', 'store', 'edit', 'update', 'destroy'
// ]]);

/*  Supplier Categories */
// Route::resource('category-detail-forms', 'CategoryDetailFormController',['only' => [
//     'index','create', 'store', 'edit', 'update', 'destroy'
// ]]);

// Route::resource('suppliers', 'SupplierController');