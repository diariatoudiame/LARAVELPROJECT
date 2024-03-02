<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/aaa', function () {
    return view('users.edit');
});

Route::get('/', [\App\Http\Controllers\AuthController::class,'login'])->name('auth.login');
Route::post('/', [\App\Http\Controllers\AuthController::class,'store'])->name('auth.store');


Route::middleware(['auth', 'Admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('customers', CustomerController::class);

    Route::resource('orders', OrderController::class);
});
// Route::resource('users', UserController::class)
Route::controller(AuthController::class)->group(function (){
    Route::post('/logout','logout')->name('logout');
});

