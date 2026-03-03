<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\FavoriteController;
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
    Route::get('/ilan-ver', [PanelController::class, 'create'])->name('listings.create');
    Route::get('/gelen-kutusu', [PanelController::class, 'inbox'])->name('inbox.index');
    Route::post('/ilanlarim/{listing}/kaldir', [PanelController::class, 'destroyListing'])->name('listings.destroy');
    Route::post('/ilanlarim/{listing}/satildi', [PanelController::class, 'markListingAsSold'])->name('listings.mark-sold');
    Route::post('/ilanlarim/{listing}/yeniden-yayinla', [PanelController::class, 'republishListing'])->name('listings.republish');
});

Route::get('/partner/{any?}', fn () => redirect()->route('panel.listings.index'))
    ->where('any', '.*');

Route::middleware('auth')->prefix('favorites')->name('favorites.')->group(function () {
    Route::get('/', [FavoriteController::class, 'index'])->name('index');
    Route::post('/listings/{listing}/toggle', [FavoriteController::class, 'toggleListing'])->name('listings.toggle');
    Route::post('/sellers/{seller}/toggle', [FavoriteController::class, 'toggleSeller'])->name('sellers.toggle');
    Route::post('/searches', [FavoriteController::class, 'storeSearch'])->name('searches.store');
    Route::delete('/searches/{favoriteSearch}', [FavoriteController::class, 'destroySearch'])->name('searches.destroy');
});

Route::middleware('auth')->name('conversations.')->group(function () {
    Route::post('/listings/{listing}/conversation', [ConversationController::class, 'start'])->name('start');
    Route::post('/conversations/{conversation}/messages', [ConversationController::class, 'send'])->name('messages.send');
});

require __DIR__.'/auth.php';
