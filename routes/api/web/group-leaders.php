<?php

use App\Http\Controllers\Api\GroupLeaderController;
use Illuminate\Support\Facades\Route;

Route::prefix('group-leaders')->group(function () {
    Route::get('/', [GroupLeaderController::class, 'index']);
});
