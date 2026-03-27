<?php

use Illuminate\Support\Facades\Route;
use Modules\Site\App\Http\Controllers\HomeController;
use Modules\Site\App\Http\Controllers\LanguageController;
use Modules\Site\App\Http\Controllers\PublicMediaController;

Route::get('/storage/{path}', [PublicMediaController::class, 'show'])
    ->where('path', '.*')
    ->name('media.legacy');

Route::middleware('web')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');
    Route::get('/dashboard', fn () => auth()->check()
        ? redirect()->route('panel.listings.index')
        : redirect()->route('login'))
        ->name('dashboard');
});
