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

Route::get('/', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginOrRegister'])->name('loginRedirect');


Route::get('login/google', [\App\Http\Controllers\Auth\GoogleController::class, 'redirectToProvider'])->name('login');
Route::get('login/google/callback', [\App\Http\Controllers\Auth\GoogleController::class, 'handleProviderCallback']);

Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
