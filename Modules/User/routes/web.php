<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\Auth\ConfirmPasswordController;
use Modules\User\App\Http\Controllers\Auth\EmailVerificationController;
use Modules\User\App\Http\Controllers\Auth\ForgotPasswordController;
use Modules\User\App\Http\Controllers\Auth\LoginController;
use Modules\User\App\Http\Controllers\Auth\PasswordController;
use Modules\User\App\Http\Controllers\Auth\RegisterController;
use Modules\User\App\Http\Controllers\Auth\ResetPasswordController;
use Modules\User\App\Http\Controllers\Auth\SocialAuthController;
use Modules\User\App\Http\Controllers\ProfileController;

Route::middleware('web')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisterController::class, 'create'])->name('register');
        Route::post('/register', [RegisterController::class, 'store']);

        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::post('/login', [LoginController::class, 'store']);

        Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');

        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.store');

        Route::prefix('/auth/social')->name('auth.social.')->group(function () {
            Route::get('/{provider}', [SocialAuthController::class, 'redirect'])->name('redirect');
            Route::get('/{provider}/callback', [SocialAuthController::class, 'callback'])->name('callback');
        });
    });

    Route::middleware('auth')->group(function () {
        Route::get('/verify-email', [EmailVerificationController::class, 'notice'])->name('verification.notice');
        Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');
        Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('/confirm-password', [ConfirmPasswordController::class, 'show'])->name('password.confirm');
        Route::post('/confirm-password', [ConfirmPasswordController::class, 'store']);
        Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
        Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

        Route::redirect('/profile', '/panel/my-profile')->name('profile.edit');
        Route::patch('/panel/my-profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/panel/my-profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
