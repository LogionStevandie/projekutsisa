<?php

use Illuminate\Support\Facades\Route;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('pulau', 'App\Http\Controllers\PulauController');
Route::resource('menu', 'App\Http\Controllers\MenuController');
Route::resource('barangJenis', 'App\Http\Controllers\BarangJenisController');
Route::resource('provinsi', 'App\Http\Controllers\ProvinsiController');
