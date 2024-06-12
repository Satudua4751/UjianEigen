<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\TrxpinjamsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('book', BooksController::class);

Route::get('/book', [BooksController::class, 'index']);
Route::post('/book', [BooksController::class, 'store']);
Route::get('/book/{codeb}', [BooksController::class, 'show']);
Route::put('/book/{codeb}', [BooksController::class, 'update']);
Route::delete('/book/{codeb}', [BooksController::class, 'destroy']);


Route::resource('trxpinjam', TrxpinjamsController::class);
Route::get('/trxpinjam', [TrxpinjamsController::class, 'index']);
Route::post('/trxpinjam', [TrxpinjamsController::class, 'store']);
Route::get('/trxpinjam/{codeb}', [TrxpinjamsController::class, 'show']);
Route::put('/trxpinjam/{codeb}', [TrxpinjamsController::class, 'update']);
Route::delete('/trxpinjam/{codeb}', [TrxpinjamsController::class, 'destroy']);
