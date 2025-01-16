<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// TRANSACTIONS
Route::get('transactions', [TransController::class, 'index']);
Route::post('credit', [TransController::class, 'store'])->middleware('auth:api');
Route::post('debit', [TransController::class, 'store'])->middleware('auth:api');
Route::post('totalcredit', [TransController::class, 'totalcredit'])->middleware('auth:api');
Route::post('totaldebit', [TransController::class, 'totaldebit'])->middleware('auth:api');
Route::post('balance', [TransController::class, 'balance'])->middleware('auth:api');
Route::post('bank', [TransController::class, 'bank'])->middleware('auth:api');
Route::post('cash', [TransController::class, 'cash'])->middleware('auth:api');
Route::post('momo', [TransController::class, 'momo'])->middleware('auth:api');