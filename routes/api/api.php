<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\ProvinceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

Route::get('/products', [ProductController::class, 'index'])->name('api.product.index');
Route::get('/products/{id}', [ProductController::class, 'find'])->name('api.product.find');
Route::post('/create-products', [ProductController::class, 'create'])->name('api.product.create');
Route::put('/update-products/{id}', [ProductController::class, 'update'])->name('api.product.update');
Route::delete('/delete-products/{id}', [ProductController::class, 'delete'])->name('api.product.delete');


