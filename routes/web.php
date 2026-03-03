<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

$redirectToPartner = static function (string $routeName) {
    if (! auth()->check()) {
        return redirect()->route('filament.partner.auth.login');
    }

    return redirect()->route($routeName, ['tenant' => auth()->id()]);
};

Route::get('/dashboard', fn () => $redirectToPartner('filament.partner.pages.dashboard'))
    ->name('dashboard');

Route::get('/partner', fn () => $redirectToPartner('filament.partner.pages.dashboard'))
    ->name('partner.dashboard');

Route::get('/partner/listings', fn () => $redirectToPartner('filament.partner.resources.listings.index'))
    ->name('partner.listings.index');

Route::get('/partner/listings/create', fn () => $redirectToPartner('filament.partner.resources.listings.create'))
    ->name('partner.listings.create');

Route::middleware('auth')->prefix('favorites')->name('favorites.')->group(function () {
    Route::get('/', [FavoriteController::class, 'index'])->name('index');
    Route::post('/listings/{listing}/toggle', [FavoriteController::class, 'toggleListing'])->name('listings.toggle');
    Route::post('/sellers/{seller}/toggle', [FavoriteController::class, 'toggleSeller'])->name('sellers.toggle');
    Route::post('/searches', [FavoriteController::class, 'storeSearch'])->name('searches.store');
    Route::delete('/searches/{favoriteSearch}', [FavoriteController::class, 'destroySearch'])->name('searches.destroy');
});

require __DIR__.'/auth.php';
