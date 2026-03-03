<?php

return [
    'ai_provider' => env('QUICK_LISTING_AI_PROVIDER', 'openai'),
    'ai_model' => env('QUICK_LISTING_AI_MODEL', 'gpt-5.2'),
    'max_photo_count' => 20,
    'max_photo_size_kb' => 5120,
];

