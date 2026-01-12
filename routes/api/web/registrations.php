<?php

use App\Http\Controllers\Api\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('registrations')->group(function () {
    Route::get('banks', [RegistrationController::class, 'banks']);
    Route::get('pre-registrations', [RegistrationController::class, 'preRegistrations']);
    Route::get('packages', [RegistrationController::class, 'packages']);
    Route::get('/', [RegistrationController::class, 'index']);
    Route::post('/', [RegistrationController::class, 'store']);
    Route::put('/{registration}', [RegistrationController::class, 'update']);
    Route::delete('/{registration}', [RegistrationController::class, 'destroy']);
});
