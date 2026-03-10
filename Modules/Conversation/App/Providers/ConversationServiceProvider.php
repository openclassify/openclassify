<?php

namespace Modules\Conversation\App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class ConversationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('Conversation', 'Database/migrations'));
        $this->loadRoutesFrom(module_path('Conversation', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Conversation', 'resources/views'), 'conversation');

        Broadcast::channel('users.{id}.inbox', function ($user, $id): bool {
            return (int) $user->getKey() === (int) $id;
        });
    }

    public function register(): void {}
}
