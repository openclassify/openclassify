<?php

use Illuminate\Support\Facades\Route;
use Modules\Conversation\App\Http\Controllers\ConversationController;

Route::middleware('auth')->prefix('panel')->name('panel.')->group(function () {
    Route::get('/inbox', [ConversationController::class, 'inbox'])->name('inbox.index');
});

Route::middleware('auth')->name('conversations.')->group(function () {
    Route::post('/listings/{listing}/conversation', [ConversationController::class, 'start'])->name('start');
    Route::post('/conversations/{conversation}/messages', [ConversationController::class, 'send'])->name('messages.send');
});
