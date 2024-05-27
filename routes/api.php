<?php

use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/{id}', [UserController::class, 'getById'])->name('users');

    Route::get('/users/{id}/transactions', [TransactionsController::class, 'index'])->name('transactions');
    Route::post('/users/{id}/transactions', [TransactionsController::class, 'transfer']);
});
