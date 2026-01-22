<?php

use App\Http\Controllers\Api\BankSectionController;
use Illuminate\Support\Facades\Route;

Route::prefix('banks')->group(function () {
    Route::get('/', [BankSectionController::class, 'index']);
    Route::post('/', [BankSectionController::class, 'store']);


    Route::get('/{section}', [BankSectionController::class, 'show']);
    Route::put('/{section}', [BankSectionController::class, 'update']);
    Route::post('/{section}/deposit', [BankSectionController::class, 'deposit']);
    Route::post('/{section}/withdraw', [BankSectionController::class, 'withdraw']);
    Route::get('/{section}/transactions', [BankSectionController::class, 'transactions']);
});
