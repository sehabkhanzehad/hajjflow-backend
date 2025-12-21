<?php

use App\Http\Controllers\Api\YearController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/api/auth.php';


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('years')->group(function () {
        Route::get('/', [YearController::class, 'index']);
        Route::post('/', [YearController::class, 'store']);
        Route::put('/{year}', [YearController::class, 'update']);
    });
});
