<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Partner\DashboardController;
use App\Http\Controllers\Partner\ListingController as PartnerListingController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

Route::middleware('auth')->prefix('partner')->name('partner.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/listings', [PartnerListingController::class, 'index'])->name('listings.index');
});

require __DIR__.'/auth.php';
