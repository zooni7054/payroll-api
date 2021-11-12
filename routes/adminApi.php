<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [App\Http\Controllers\Api\Admin\AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    // Users
    Route::get('users/restore/{id}', [App\Http\Controllers\Api\Admin\UserController::class, 'restore']);
    Route::resource('users', App\Http\Controllers\Api\Admin\UserController::class);

    // logout
    Route::get('logout', [App\Http\Controllers\Api\Admin\AuthController::class, 'logout']);
    // staff
    Route::get('staff/restore/{id}', [App\Http\Controllers\Api\Admin\StaffController::class, 'restore']);
    Route::resource('staff', App\Http\Controllers\Api\Admin\StaffController::class);
    // validate token
    Route::post('validate-token', [App\Http\Controllers\Api\Admin\AuthController::class, 'validateToken']);
});


