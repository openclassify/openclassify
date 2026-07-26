<?php

declare(strict_types=1);

namespace Modules\Conversation\App\Support;

class QuickMessageCatalog
{
    public static function all(): array
    {
        return [
            'Hi',
            'Is this listing still available?',
            'What is your best price?',
            'Thanks',
        ];
    }
}
