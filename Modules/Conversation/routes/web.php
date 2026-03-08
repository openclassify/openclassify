<?php

use Illuminate\Support\Facades\Route;
use Modules\Conversation\App\Http\Controllers\ConversationController;

Route::middleware('web')->group(function () {
    Route::prefix('panel')->name('panel.')->group(function () {
        Route::get('/inbox', [ConversationController::class, 'inbox'])->name('inbox.index');
        Route::middleware('auth')->get('/inbox/state', [ConversationController::class, 'state'])->name('inbox.state');
    });

    Route::middleware('auth')->name('conversations.')->group(function () {
        Route::post('/listings/{listing}/conversation', [ConversationController::class, 'start'])->name('start');
        Route::post('/conversations/{conversation}/messages', [ConversationController::class, 'send'])->name('messages.send');
        Route::post('/conversations/{conversation}/read', [ConversationController::class, 'read'])->name('read');
    });
});
