<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Notification\Http\Controllers\NotificationController;

Route::middleware(['web', 'auth'])->prefix('panel')->name('panel.notifications.')->group(function (): void {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'read'])->name('read');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('read-all');
});
