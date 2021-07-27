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


	Route::get('refresh-token',array('before'=>'csrf','as'=>'refresh-token','uses'=>'HomeController@refresh_token'));

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::resource('dashboard', 'DashboardController',['only' => [
        'index','create', 'store', 'edit', 'update', 'destroy'
    ]]);
    /*
    |--------------------------------------------------------------------------
    | Booking
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'bookings', 'as' => 'bookings.'], function () {
        Route::get('view-seasons', array('as' => 'view.seasons', 'uses' => 'BookingController@view_seasons'));
        Route::get('season/{id}', array('as' => 'index', 'uses' => 'BookingController@index'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'BookingController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'BookingController@update'));
        Route::delete('destroy/{id}', array('as' => 'delete', 'uses' => 'BookingController@destroy'));
        Route::get('versions/{id}', array('as' => 'version', 'uses' => 'BookingController@viewVersion'));
        Route::get('show/{id}', array('as' => 'show', 'uses' => 'BookingController@show'));
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
    	Route::get('delete/{id}',array('as'=>'delete','uses'=>'QuoteController@delete'));
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'QuoteController@edit'));
        Route::put('update/{id}', array('as' => 'update', 'uses' => 'QuoteController@update'));
        Route::put('update_override/{id}', array('as' => 'update.override', 'uses' => 'QuoteController@update_override'));

        Route::get('{id}/version/{va?}', array('as' => 'view.version', 'uses' => 'QuoteController@quoteVersion'));
        Route::patch('booked/{id}', array('as' => 'booked', 'uses' => 'QuoteController@booking'));
        Route::get('trash', array('as' => 'view.trash', 'uses' => 'QuoteController@getTrash'));
        Route::get('restore/{id}', array('as' => 'restore', 'uses' => 'QuoteController@restore'));

        Route::get('final/{id}', array('as' => 'final', 'uses' => 'QuoteController@finalQuote'));

        Route::patch('archive/{id}/store', array('as' => 'archive.store', 'uses' => 'QuoteController@addInArchive'));
        Route::get('archive', array('as' => 'archive', 'uses' => 'QuoteController@getArchive'));
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
        Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'UserController@edit'));
        Route::post('update/{id}', array('as' => 'update', 'uses' => 'UserController@update'));
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
    | Setting
    |--------------------------------------------------------------------------
    */

    Route::group([ 'prefix' => 'setting', 'as' => 'setting.'],function (){

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

    // Route::match(['get', 'post'],'create-quote',array('as'=>'create-quote','uses'=>'AdminController@create_quote'));

    ////////////////////////////..supplier route start //////////////////////////////////////////
    Route::resource('suppliers', 'SupplierController');

    //supplier product start
    Route::resource('products', 'ProductController',['only' => [
        'index','create', 'store', 'edit', 'update', 'destroy'
        ]]);
    //supplier product end

    //supplier categories start
    Route::resource('categories', 'CategoryController',['only' => [
        'index','create', 'store', 'edit', 'update', 'destroy'
    ]]);
    //supplier categories end
    ////////////////////////////..supplier route end //////////////////////////////////////////
   /*
    |--------------------------------------------------------------------------
    | Routes For Ajax Request Start
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

   });
    /*
    |--------------------------------------------------------------------------
    | Routes For Ajax Request End
    |--------------------------------------------------------------------------
    */
});
