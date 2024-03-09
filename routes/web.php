<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportImportController;
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
    return view('auth.dashboard');
});

Route::get('/', [\App\Http\Controllers\AuthController::class,'login'])->name('auth.login');
Route::post('/', [\App\Http\Controllers\AuthController::class,'store'])->name('auth.store');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');


Route::middleware(['auth', 'Admin'])->group(function () {
    Route::post('/users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');
    Route::get('/users/{user}/assign-role', [UserController::class, 'form'])->name('assign');
    Route::resource('users', UserController::class);
    Route::get('/customers/{customerId}/orders', [CustomerController::class, 'showHistory'])->name('customers.history');



});
Route::middleware(['auth'])->group(function () {

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('customers', CustomerController::class);

    Route::resource('orders', OrderController::class);


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/export', [ ExportImportController::class, 'export'])->name('products.export');
    Route::get('/exportPdf', [ ExportImportController::class, 'exportToPDF'])->name('exportPDF');

});


// Route::resource('users', UserController::class)
Route::controller(AuthController::class)->group(function (){
    Route::post('/logout','logout')->name('logout');
});

