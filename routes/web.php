<?php

use App\Http\Controllers\CabangController;
use App\Http\Controllers\DataMitraController;
use App\Http\Controllers\DebiturController;
use App\Http\Controllers\UserController;
use App\Models\Cabang;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::middleware('auth')->group(function(){
    Route::resource('users', UserController::class);
    Route::resource('mitra', DataMitraController::class);
    Route::resource('cabang', CabangController::class);
    Route::resource('debitur', DebiturController::class);
});
