<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PanelController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

Route::get('/dashboard', fn () => auth()->check()
    ? redirect()->route('panel.listings.index')
    : redirect()->route('login'))
    ->name('dashboard');

Route::middleware('auth')->prefix('panel')->name('panel.')->group(function () {
    Route::get('/', [PanelController::class, 'index'])->name('index');
    Route::get('/ilanlarim', [PanelController::class, 'listings'])->name('listings.index');
    Route::get('/create-listing', [PanelController::class, 'create'])->name('listings.create');
    Route::post('/ilanlarim/{listing}/kaldir', [PanelController::class, 'destroyListing'])->name('listings.destroy');
    Route::post('/ilanlarim/{listing}/satildi', [PanelController::class, 'markListingAsSold'])->name('listings.mark-sold');
    Route::post('/ilanlarim/{listing}/yeniden-yayinla', [PanelController::class, 'republishListing'])->name('listings.republish');
});

Route::get('/partner/{any?}', fn () => redirect()->route('panel.listings.index'))
    ->where('any', '.*');

require __DIR__.'/auth.php';
