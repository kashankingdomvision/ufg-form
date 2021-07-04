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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::group(['middleware' => ['auth']], function(){





    


    Route::group(['prefix' => 'quotes', 'as' => 'quotes.'], function () {
        // Route::get('index', array('as' => 'index', 'uses' => 'UserController@index'));
        Route::get('create', array('as' => 'create', 'uses' => 'QuoteController@create'));
        // Route::post('store', array('as' => 'store', 'uses' => 'UserController@store'));
        // Route::get('edit/{id}', array('as' => 'edit', 'uses' => 'UserController@edit'));
        // Route::post('update/{id}', array('as' => 'update', 'uses' => 'UserController@update'));
    	// Route::delete('delete/{id}',array('as'=>'delete','uses'=>'UserController@delete'));
    });

  





    /*
    |--------------------------------------------------------------------------
    | Users
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

    Route::match(['get', 'post'],'create-quote',array('as'=>'create-quote','uses'=>'AdminController@create_quote'));


    Route::prefix('json')->group(function () {
        Route::get('holiday-types',array('as'=>'get-holiday-type','uses'=>'AdminController@get_holiday_type'));	


        Route::get('get-currency-conversion',array('as'=>'get-currency-conversion','uses'=>'QuoteController@get_currency_conversion'));
    });
});