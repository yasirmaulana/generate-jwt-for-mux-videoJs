<?php

use App\Http\Controllers\JwtController;
use Illuminate\Support\Facades\Route;

Route::post('/generate-jwt', [JwtController::class, 'generateToken']);

Route::get('/test-api', function () {
    return response()->json(['message' => 'API is working']);
});
