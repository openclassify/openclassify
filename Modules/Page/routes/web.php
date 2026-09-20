<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Page\Http\Controllers\PageController;

Route::middleware('web')->group(function (): void {
    Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
    Route::get('/robots.txt', [PageController::class, 'robots'])->name('robots');
    Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');
});
