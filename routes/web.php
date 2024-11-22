<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});


Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route::get('/dashboard', [DashboardController::class, 'getChartData'])->name('customer-index');
});

Route::middleware(['auth'])->prefix('/customer')->group(function () {
    Route::get('', [CustomerController::class, 'index'])->name('customer-index');
    Route::get('/create', [CustomerController::class, 'create'])->name('customer-create');
    Route::post('/store', [CustomerController::class, 'store'])->name('customer-store');
    Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customer-edit');
    Route::post('/update/{id}', [CustomerController::class, 'update'])->name('customer-update'); 
    Route::delete('/delete/{id}', [CustomerController::class, 'delete'])->name('customer-delete');
    Route::get('/details/{id}', [CustomerController::class, 'customerDetailsByInvoiceId'])->name('customer-details');
    Route::get('/address/{id}', [CustomerController::class, 'customerDetailsById'])->name('customer-address');
    Route::get('/transaction/{id}', [CustomerController::class, 'customerTransaction'])->name('customer-transactions');
});


Route::middleware(['auth'])->prefix('/invoice')->group(function () {
    Route::get('', [InvoiceController::class, 'index'])->name('invoice-index');
    Route::get('/create', [InvoiceController::class, 'create'])->name('invoice-create');
    Route::post('/store', [InvoiceController::class, 'store'])->name('invoice-store');
    Route::get('/edit/{id}', [InvoiceController::class, 'edit'])->name('invoice-edit');
    Route::put('/update/{id}', [InvoiceController::class, 'update'])->name('invoice-update');
    Route::delete('/delete/{id}', [InvoiceController::class, 'delete'])->name('invoice-delete');
    Route::get('/{id}', [InvoiceController::class, 'customerInvoices'])->name('invoice-customer-index');

});  

Route::middleware(['auth'])->prefix('/payment')->group(function () { 
    Route::get('', [PaymentController::class, 'index'])->name('payment-index');
    Route::get('/create', [PaymentController::class, 'create'])->name('payment-create');
    Route::post('/store', [PaymentController::class, 'store'])->name('payment-store');
    Route::get('/edit/{id}', [PaymentController::class, 'edit'])->name('payment-edit'); // pending
    Route::put('/update', [PaymentController::class, 'update'])->name('payment-update'); // pending
    Route::get('/{id}', [PaymentController::class, 'customerPayments'])->name('payment-customer-index');
}); 


Auth::routes(); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
