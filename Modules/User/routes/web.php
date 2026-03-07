<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::redirect('/profile', '/panel/my-profile')->name('profile.edit');
    Route::patch('/panel/my-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/panel/my-profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
