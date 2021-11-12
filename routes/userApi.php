<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [App\Http\Controllers\Api\User\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\Api\User\AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    // logout
    Route::get('logout', [App\Http\Controllers\Api\User\AuthController::class, 'logout']);
    // profile update
    Route::patch('profile', [App\Http\Controllers\Api\User\ProfileController::class, 'profileUpdate']);
    // validate token
    Route::post('validate-token', [App\Http\Controllers\Api\User\AuthController::class, 'validateToken']);
});


