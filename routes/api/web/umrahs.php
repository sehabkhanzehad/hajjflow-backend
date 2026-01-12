<?php

use App\Http\Controllers\Api\UmrahController;
use Illuminate\Support\Facades\Route;

Route::prefix('umrahs')->group(function () {
    Route::get('packages', [UmrahController::class, 'packages']);
    Route::get('group-leaders', [UmrahController::class, 'groupLeaders']);
    Route::get('pilgrims', [UmrahController::class, 'pilgrims']);
    Route::get('passports', [UmrahController::class, 'passports']);
    Route::get('/', [UmrahController::class, 'index']);
    Route::post('/', [UmrahController::class, 'store']);
    Route::get('/{umrah}', [UmrahController::class, 'show']);
    Route::delete('/{umrah}', [UmrahController::class, 'destroy']);

    // Pilgrim update routes
    Route::put('/{umrah}/pilgrim/personal-info', [UmrahController::class, 'updatePilgrimPersonalInfo']);
    Route::put('/{umrah}/pilgrim/contact-info', [UmrahController::class, 'updatePilgrimContactInfo']);
    Route::put('/{umrah}/pilgrim/addresses', [UmrahController::class, 'updateAddresses']);
    Route::post('/{umrah}/pilgrim/avatar', [UmrahController::class, 'updatePilgrimAvatar']);

    Route::post('/{umrah}/discount', [UmrahController::class, 'applyDiscount']);
    // Umrah status routes
    Route::post('/{umrah}/cancel', [UmrahController::class, 'markAsCanceled']);
    Route::post('/{umrah}/complete', [UmrahController::class, 'markAsCompleted']);
    Route::post('/{umrah}/restore', [UmrahController::class, 'restore']);

    // Passport routes
    Route::post('/{umrah}/passport', [UmrahController::class, 'addPassport']);
    Route::put('/passport/{passport}', [UmrahController::class, 'updatePassport']);

    Route::get('/{umrah}/transactions', [UmrahController::class, 'transactions']);
});
