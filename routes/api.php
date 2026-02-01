<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

require __DIR__ . '/api/web.php';
// require __DIR__ . '/api/mobile.php';
