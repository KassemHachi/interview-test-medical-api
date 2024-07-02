<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PlaygroundController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('verifying', [AuthController::class, 'verifying']);
    Route::post('forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});

Route::prefix('players')->group(function () {
    Route::get('home-page', [PlayerController::class, 'homePage']);
    Route::get('top-players', [PlayerController::class, 'topPlayers']);
    Route::get('list-players', [PlayerController::class, 'listPlayers']);
    Route::get('get-player', [PlayerController::class, 'getPlayer']);
});

Route::prefix('playgrounds')->group(function () {
    Route::get('list-playgrounds', [PlaygroundController::class, 'listPlaygrounds']);
    Route::get('get-playground', [PlaygroundController::class, 'getPlayground']);
    Route::get('availability-book-playground', [PlaygroundController::class, 'availabilityBookPlayground']);
    Route::post('book-playground', [PlaygroundController::class, 'bookPlayground']);
    Route::post('pay-book', [PlaygroundController::class, 'payBook']);
    Route::post('review-playground', [PlaygroundController::class, 'reviewPlayground']);
});

Route::prefix('profile')->group(function () {
    Route::get('get-profile', [profileController::class, 'getProfile']);
    Route::patch('update-profile', [ProfileController::class, 'updateProfile']);
    Route::put('change-password', [ProfileController::class, 'changePassword']);
    Route::post('change-avatar', [ProfileController::class, 'changeAvatar']);
    Route::delete('delete-avatar', [ProfileController::class, 'deleteAvatar']);
    Route::delete('delete-profile', [ProfileController::class, 'deleteProfile']);
    Route::post('filling-information', [ProfileController::class, 'fillingInformation']);
});
