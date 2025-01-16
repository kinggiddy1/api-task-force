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