<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\payment\PayPalController;
use App\Http\Controllers\payment\VNPayController;

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





Route::prefix('payment')->group(function () {
    Route::prefix('paypal')->middleware('Cart')->group(function () {
        Route::get('/paypal-error', [PayPalController::class, 'paypal_error'])->name('paypal_error');
        Route::get('/process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
        Route::get('/success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
        Route::get('/cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
        Route::get('/paypal-success',[PayPalController::class, 'paypal_success'])->name('paypal_success');

    });
    Route::prefix('vnpay')->middleware('Cart')->group(function () {
        Route::get('/vnpay-checkout/{id}', [VNPayController::class, 'VnPay'])->name('vnpayPayment');
        Route::get('/vnpay-success',[VNPayController::class, 'is_success'])->name('vnpay_success');

    });


    // Route::get('/complete/{sku}',[PayPalController::class, 'paypal_complete'])->name('paypal_complete');

});



