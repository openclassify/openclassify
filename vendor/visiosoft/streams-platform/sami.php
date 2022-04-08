<?php

return new Sami\Sami(
    __DIR__ . '/src', [
        'build_dir' => __DIR__ . '/docs/build',
        'cache_dir' => __DIR__ . '/docs/cache'
    ]
);
