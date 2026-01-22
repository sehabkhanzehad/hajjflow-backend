<?php

use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;



Route::prefix('transactions')->group(function () {
    Route::get('/sections', [TransactionController::class, 'sections']);
    Route::get('/pre-registrations', [TransactionController::class, 'preRegistrations']);
    Route::get('/registrations', [TransactionController::class, 'registrations']);


    Route::get('/', [TransactionController::class, 'index']);
    Route::post('/', [TransactionController::class, 'store']);
    Route::put('/{transaction}', [TransactionController::class, 'update']);
});
