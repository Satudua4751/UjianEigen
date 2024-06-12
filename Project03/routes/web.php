<?php

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

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TrxpinjamController;
use App\Http\Controllers\TrxkembaliController;

Route::get('/', function () {
    return redirect('dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('book', BookController::class);
Route::resource('trxpinjam', TrxpinjamController::class);
Route::resource('trxkembali', TrxkembaliController::class);

Route::post('/trxpinjam_getmember', [TrxpinjamController::class, 'getMember'])->name('trxpinjam_getmember');
Route::post('/trxpinjam_getbook', [TrxpinjamController::class, 'getNameBook'])->name('trxpinjam_getbook');
Route::post('/trxpinjam_nota', [TrxpinjamController::class, 'getNotaPjm'])->name('trxpinjam_nota');
Route::post('/checkstock', [TrxpinjamController::class, 'checkStock']);

Route::post('/trxkembali_getmember', [TrxkembaliController::class, 'getMember'])->name('trxkembali_getmember');
Route::post('/trxkembali_getbooks', [TrxkembaliController::class, 'getBooksByMember'])->name('trxkembali_getbooks');
Route::post('/trxkembali_getbook', [TrxkembaliController::class, 'getNameBook'])->name('trxkembali_getbook');
Route::post('/trxkembali_nota', [TrxkembaliController::class, 'getNotaKmb'])->name('trxkembali_nota');
