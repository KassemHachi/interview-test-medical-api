<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('verifying', [AuthController::class, 'verifying']);
    Route::post('forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});
