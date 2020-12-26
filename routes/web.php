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

Route::get('login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('login/process', [\App\Http\Controllers\LoginController::class, 'authenticate'])->name('process');

Route::group(['middleware' => 'auth'], function () {

    Route::get('admin', [\App\Http\Controllers\DashboardController::class, 'index'])->name('admin');

    Route::get('admin/categories/index', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::get('admin/categories/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
    Route::post('admin/categories/store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::get('admin/categories/{id}/show', [\App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
    Route::get('admin/categories/{id}/edit', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('admin/categories/{id}/update', [\App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('admin/categories/{id}/destroy', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::resource('admin/products', \App\Http\Controllers\ProductController::class);

    Route::get('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    Route::get('admin/transactions/create', [\App\Http\Controllers\TransactionController::class, 'create'])->name('transactions.create');
    Route::post('admin/transactions/import', [\App\Http\Controllers\TransactionController::class, 'import'])->name('transactions.import');
    Route::get('admin/transactions/index', [\App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');

    Route::get('admin/users', \App\Http\Livewire\Users\Index::class)->name('users.index');

    // roles
    Route::get('admin/roles', \App\Http\Livewire\Roles\Index::class)->name('roles.index');
    Route::get('admin/roles/cerate', \App\Http\Livewire\Roles\Create::class)->name('roles.create');
    Route::get('admin/roles/{id}/edit', \App\Http\Livewire\Roles\Edit::class)->name('roles.edit');
    Route::get('admin/roles/{id}/show', \App\Http\Livewire\Roles\Show::class)->name('roles.show');
    

});

