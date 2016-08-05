<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/', 'HomeController@index');
    Route::get('/error', function () {
        return view('errors.404');
    });
    Route::get('/supplier/search', [
        'as' => 'supplier.search', 'uses' => 'SuppllierController@search'
    ]);
    Route::resource('/supplier', 'SuppllierController');
    Route::resource('/category', 'CategoryController');
    Route::get('/product/search', [
        'as' => 'product.search', 'uses' => 'ProductController@search'
    ]);
    Route::resource('/product', 'ProductController');
    Route::resource('/inventory', 'InventoryController');
    Route::get('/stock/history',['as' => 'stock.history',  'uses' => 'StockControlController@findWhere']);

    Route::get('/incoming/{id?}', ['as' => 'incoming.index',  'uses' => 'InController@inIndex']);
    Route::post('/incoming', [ 'as' => 'incoming.store', 'uses' => 'InController@in']);
    Route::post('/incoming/return', [ 'as' => 'incoming.return', 'uses' => 'InController@returnIn']);

    Route::get('/outcoming/{id?}',  ['as' => 'outcoming.index', 'uses' => 'OutController@outIndex']);
    Route::post('/outcoming', [ 'as' => 'outcoming.store', 'uses' => 'OutController@out']);
    Route::post('/outcoming/return', [ 'as' => 'outcoming.return', 'uses' => 'OutController@returnOut']);
});
