<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Conversation\App\Http\Controllers\ConversationController;

Route::middleware('web')->group(function (): void {
    Route::middleware('auth')->prefix('panel')->name('panel.')->group(function (): void {
        Route::get('/inbox', [ConversationController::class, 'inbox'])->name('inbox.index');
    });

    Route::middleware('auth')->name('conversations.')->group(function (): void {
        Route::post('/listings/{listing}/conversation', [ConversationController::class, 'start'])->name('start');
        Route::post('/conversations/{conversation}/messages', [ConversationController::class, 'send'])->name('messages.send');
        Route::post('/conversations/{conversation}/read', [ConversationController::class, 'read'])->name('read');
    });
});
