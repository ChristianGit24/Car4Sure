<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\PolicyHolderController;

// Test route to verify API routing
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});


Route::apiResource('policies', PolicyController::class);
Route::apiResource('policy-holders', PolicyHolderController::class);
