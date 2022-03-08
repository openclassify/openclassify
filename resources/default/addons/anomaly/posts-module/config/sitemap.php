<?php

return [
    'categories' => \Anomaly\PostsModule\Category\CategoryRepository::class,
    'posts'      => \Anomaly\PostsModule\Post\Contract\PostRepositoryInterface::class,
];
