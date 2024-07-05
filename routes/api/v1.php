<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::middleware('auth:sanctum')->post('send-verification-email', [AuthController::class, 'sendVerificationEmail']);
    Route::post('verify-pin-email/{pin}', [AuthController::class, 'verifyPinEmail'])->name("verify-pin-email");
    Route::post('forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('reset-password/{pin}', [AuthController::class, 'resetPassword'])->name("reset-password");
});

Route::middleware('auth:sanctum')->prefix('profile')->group(function () {
    Route::get('', [ProfileController::class, 'get']);
    Route::patch('', [ProfileController::class, 'update']);
    Route::delete('', [ProfileController::class, 'delete']);
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

Route::middleware('auth:sanctum')->prefix('medications')->group(function () {
    Route::post('', [MedicationController::class, 'store']);
    Route::get('', [MedicationController::class, 'index']);
    Route::get('{id}', [MedicationController::class, 'show']);
    Route::patch('{id}', [MedicationController::class, 'update']);
    Route::delete('{id}', [MedicationController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('medical-histories')->group(function () {
    Route::post('', [MedicalHistoryController::class, 'store']);
    Route::get('', [MedicalHistoryController::class, 'index']);
    Route::get('{id}', [MedicalHistoryController::class, 'show']);
    Route::patch('{id}', [MedicalHistoryController::class, 'update']);
    Route::delete('{id}', [MedicalHistoryController::class, 'destroy']);
});
