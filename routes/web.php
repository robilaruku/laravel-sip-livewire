<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('login', 'LoginController@index')->name('login');
Route::post('login/process', 'LoginController@authenticate')->name('process');

Route::group(['middleware' => 'auth'], function () {

    Route::get('admin', 'DashboardController@index')->name('admin');

    Route::get('admin/categories/index', 'CategoryController@index')->name('categories.index');
    Route::get('admin/categories/create', 'CategoryController@create')->name('categories.create');
    Route::post('admin/categories/store', 'CategoryController@store')->name('categories.store');
    Route::get('admin/categories/{id}/show', 'CategoryController@show')->name('categories.show');
    Route::get('admin/categories/{id}/edit', 'CategoryController@edit')->name('categories.edit');
    Route::put('admin/categories/{id}/update', 'CategoryController@update')->name('categories.update');
    Route::delete('admin/categories/{id}/destroy', 'CategoryController@destroy')->name('categories.destroy');

    Route::resource('admin/products', 'ProductController');

    Route::get('logout', 'LoginController@logout')->name('logout');

    Route::get('admin/transactions/create', 'TransactionController@create')->name('transactions.create');
    Route::post('admin/transactions/import', 'TransactionController@import')->name('transactions.import');
    Route::get('admin/transactions/index', 'TransactionController@index')->name('transactions.index');

});


