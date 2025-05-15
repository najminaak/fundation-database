<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\OTPResetController;
use App\Http\Controllers\API\Entrepreneur\Mitra\MitraController;
use App\Http\Controllers\API\Organizer\Organization\OrganizationController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventPhotoController;
use App\Http\Controllers\EventPlacementController;
use App\Http\Controllers\EventFundController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\EventCategoryNameController;

Route::middleware(['api'])->group(function () {
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:api');

    Route::post('/register-organizer', [RegisterController::class, 'organizerRegister'])->name('api.register-organizer');
    Route::post('/register-entrepreneur', [RegisterController::class, 'entrepreneurRegister']);
    
    Route::post('/organizer-form/{user_id}', [OrganizationController::class, 'store']);
    Route::post('/mitra-form/{user_id}', [MitraController::class, 'store']);

    Route::post('/password/send-otp', [OTPResetController::class, 'sendOTP']);
    Route::post('/password/verify-otp', [OTPResetController::class, 'verifyOTP']);
    Route::post('/password/reset-with-otp', [OTPResetController::class, 'resetPassword']);

    Route::middleware('auth:api')->prefix('/user-form')->group(function () {
        Route::put('/{user_id}', [UserDataController::class, 'updateUserData']);
        Route::get('/{user_id}', [UserDataController::class, 'showUserData']);
    });

    // Mitra & Organizer
    Route::middleware('auth:api')->group(function () {
        Route::get('/mitra/{user_id}', [MitraController::class, 'show']);
        Route::get('/organization/{user_id}', [OrganizationController::class, 'show']);
        Route::get('/organizationlist', [OrganizationController::class, 'index']);
    });

    // Event
    Route::prefix('events')->group(function () {
        Route::get('/popular', [EventController::class, 'getPopularEvents']);
        Route::get('/by-category/{categoryId}', [EventController::class, 'getByCategory']);
        Route::post('/{id}/click', [EventController::class, 'incrementClick']);

        Route::get('/', [EventController::class, 'index']);
        Route::get('/{id}', [EventController::class, 'show']);
    });
    Route::middleware(['auth:api', 'scope:organizer'])->group(function () {
        Route::post('/events/', [EventController::class, 'store']);
        Route::put('/{id}', [EventController::class, 'update']);
        Route::delete('/{id}', [EventController::class, 'destroy']);
    });
    // Event Photos
    Route::prefix('event-photos')->group(function () {
        Route::get('/', [EventPhotoController::class, 'index']);
        Route::get('/{id}', [EventPhotoController::class, 'show']);
        Route::post('/', [EventPhotoController::class, 'store']);
        Route::put('/{id}', [EventPhotoController::class, 'update']);
        Route::delete('/{id}', [EventPhotoController::class, 'destroy']);
    });

    // Event Placements
    Route::prefix('event-placements')->group(function () {
        Route::get('/', [EventPlacementController::class, 'index']);
        Route::get('/{id}', [EventPlacementController::class, 'getById']);
        Route::post('/', [EventPlacementController::class, 'create']);
        Route::put('/{id}', [EventPlacementController::class, 'update']);
        Route::delete('/{id}', [EventPlacementController::class, 'delete']);
    });

    // Event Funds
    Route::prefix('event-funds')->group(function () {
        Route::get('/', [EventFundController::class, 'index']);
        Route::get('/{id}', [EventFundController::class, 'getById']);
        Route::post('/', [EventFundController::class, 'create']);
        Route::put('/{id}', [EventFundController::class, 'update']);
        Route::delete('/{id}', [EventFundController::class, 'delete']);
    });

    // Event Categories
    Route::prefix('event-categories')->group(function () {
        Route::get('/', [EventCategoryController::class, 'index']);
        Route::get('/{id}', [EventCategoryController::class, 'show']);
        Route::post('/', [EventCategoryController::class, 'store']);
        Route::delete('/{id}', [EventCategoryController::class, 'destroy']);
    });

    // Event Category Names
    Route::prefix('event-category-names')->group(function () {
        Route::get('/', [EventCategoryNameController::class, 'index']);
        Route::get('/{id}', [EventCategoryNameController::class, 'show']);
        Route::post('/', [EventCategoryNameController::class, 'store']);
        Route::put('/{id}', [EventCategoryNameController::class, 'update']);
        Route::delete('/{id}', [EventCategoryNameController::class, 'destroy']);
    });
});
