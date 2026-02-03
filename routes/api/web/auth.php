<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/sign-up', [AuthController::class, 'signUp']);
    Route::post('/sign-in', [AuthController::class, 'signIn']);

    Route::post('/sign-out', [AuthController::class, 'signOut'])->middleware('auth:sanctum');
});
