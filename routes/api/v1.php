<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('send-verification-email', [AuthController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
    Route::post('verify-pin-email/{pin}', [AuthController::class, 'verifyPinEmail'])->name("verify-pin-email");
    Route::post('forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('reset-password/{pin}', [AuthController::class, 'resetPassword'])->name("reset-password");
});
Route::prefix('doctors')->group(function () {
    Route::get('', [DoctorController::class, 'index']);
});
