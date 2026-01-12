<?php

use App\Http\Controllers\Api\GroupLeaderController;
use Illuminate\Support\Facades\Route;

Route::prefix('group-leaders')->group(function () {
    Route::get('/', [GroupLeaderController::class, 'index']);
    // Route::post('/', [GroupLeaderController::class, 'store']);
    // Route::put('/{groupLeader}', [GroupLeaderController::class, 'update']);
    // Route::delete('/{groupLeader}', [GroupLeaderController::class, 'destroy']);
});
