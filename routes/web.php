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
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('home');
    Route::group(['middleware' => ['role:admin']], function () {
        //Admins
        Route::get('admins', [App\Http\Controllers\AdminController::class, 'index'])->name('admins.index');
        Route::post('admins', [App\Http\Controllers\AdminController::class, 'store'])->name('admins.store');
        Route::put('admins/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('admins.update');
        Route::delete('admins/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admins.destroy');
        Route::get('admins/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admins.users');
    });
});

Auth::routes();