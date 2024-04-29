<?php

use App\Http\Controllers\Manage\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Manage\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Manage\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Manage\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Manage\Auth\NewPasswordController;
use App\Http\Controllers\Manage\Auth\PasswordController;
use App\Http\Controllers\Manage\Auth\PasswordResetLinkController;
use App\Http\Controllers\Manage\Auth\RegisteredUserController;
use App\Http\Controllers\Manage\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('manage/register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('manage/register', [RegisteredUserController::class, 'store']);

    Route::get('manage/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('manage/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('manage/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('manage/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('manage/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('manage/reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('manage/verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('manage/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('manage/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('manage/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('manage/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('manage/password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('manage/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
