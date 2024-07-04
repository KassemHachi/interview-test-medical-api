<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::middleware('auth:sanctum')->post('send-verification-email', [AuthController::class, 'sendVerificationEmail']);
    Route::post('verify-pin-email/{pin}', [AuthController::class, 'verifyPinEmail'])->name("verify-pin-email");
    Route::post('forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('reset-password/{pin}', [AuthController::class, 'resetPassword'])->name("reset-password");
});
Route::middleware('auth:sanctum')->prefix('doctors')->group(function () {
    Route::get('', [DoctorController::class, 'index']);
    Route::get('{id}', [DoctorController::class, 'get']);
});

Route::middleware('auth:sanctum')->prefix('patients')->group(function () {
    Route::get('', [PatientController::class, 'index']);
    Route::get('{id}', [PatientController::class, 'get']);
});

Route::middleware('auth:sanctum')->prefix('appointments')->group(function () {
    Route::post('', [AppointmentController::class, 'store']);
    Route::get('', [AppointmentController::class, 'index']);
    Route::get('{id}', [AppointmentController::class, 'get']);
    Route::patch('{id}', [AppointmentController::class, 'update']);
    Route::delete('{id}', [AppointmentController::class, 'delete']);
});

Route::middleware('auth:sanctum')->prefix('prescriptions')->group(function () {
    Route::post('', [PrescriptionController::class, 'store']);
    Route::get('', [PrescriptionController::class, 'index']);
    Route::get('{id}', [PrescriptionController::class, 'show']);
    Route::patch('{id}', [PrescriptionController::class, 'update']);
    Route::delete('{id}', [PrescriptionController::class, 'destroy']);
});
