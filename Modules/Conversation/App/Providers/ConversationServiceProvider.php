<?php

namespace Modules\Conversation\App\Providers;

use Illuminate\Support\ServiceProvider;

class ConversationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('Conversation', 'database/migrations'));
        $this->loadRoutesFrom(module_path('Conversation', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Conversation', 'resources/views'), 'conversation');
    }

    public function register(): void
    {
    }
}
