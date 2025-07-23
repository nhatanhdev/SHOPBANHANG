<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\auth\FacebookController;
use App\Http\Controllers\auth\GoogleController;
use App\Http\Controllers\auth\RegisterController;

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





Route::get('/admin', [LoginController::class, 'adminlogin'])->name('admin.login');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/do_register', [RegisterController::class, 'do_register'])->name('do_register');



Route::post('/admin_do_login', [LoginController::class, 'admin_do_login'])->name('admin_do_login');

Route::post('/do_login', [LoginController::class, 'do_login'])->name('do_login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/auth/facebook',[FacebookController::class, 'facebookpage'])->name('auth.facebook');
Route::get('/auth/facebook/callback',[FacebookController::class, 'facebookredirect'])->name('auth.facebookredirect');
Route::get('/auth/google',[GoogleController::class, 'googlepage'])->name('auth.google');
Route::get('/auth/google/callback',[GoogleController::class, 'googleredirect'])->name('auth.googleredirect');
