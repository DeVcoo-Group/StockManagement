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

    Route::get('/', function () {
        return view('home');
    });
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
    Route::get('/import/{id?}', ['as' => 'import.index',  'uses' => 'StockControlController@importIndex']);
    Route::get('/export/{id?}',  ['as' => 'export.index', 'uses' => 'StockControlController@exportIndex']);
    //Route::get('/import/return/{id}/{returnid?}',  ['as' => 'import.return', 'uses' => 'StockControlController@importReturnShow']);
    //Route::get('/export/return/{id}/{returnid?}',  ['as' => 'export.return', 'uses' => 'StockControlController@exportReturnShow']);
    Route::post('/import', [ 'as' => 'import.store', 'uses' => 'StockControlController@import']);
    Route::post('/import/return', [ 'as' => 'import.return', 'uses' => 'StockControlController@returnImport']);
    Route::post('/export', [ 'as' => 'export.store', 'uses' => 'StockControlController@export']);
    Route::post('/export/return/{returnid?}', [ 'as' => 'export.return', 'uses' => 'StockControlController@returnexport']);
});
