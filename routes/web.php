<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tamuController;
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

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/buku_tamu/fetch_data', [tamuController::class, "fetch_data"]);

Route::resource('/buku_tamu', App\Http\Controllers\tamuController::class);
