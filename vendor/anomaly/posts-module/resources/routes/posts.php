<?php
return [
    $this->postsUrlBase() . "/rss/categories/{category}.xml"  => [
        'as'   => 'anomaly.module.posts::categories.rss',
        'uses' => 'Anomaly\PostsModule\Http\Controller\RssController@category',
    ],
    $this->postsUrlBase() . "/rss/tags/{tag}.xml"             => [
        'as'   => 'anomaly.module.posts::tags.rss',
        'uses' => 'Anomaly\PostsModule\Http\Controller\RssController@tag',
    ],
    $this->postsUrlBase() . "/rss.xml"                        => [
        'as'   => 'anomaly.module.posts::posts.rss',
        'uses' => 'Anomaly\PostsModule\Http\Controller\RssController@recent',
    ],
    $this->postsUrlBase()                                     => [
        'as'   => 'anomaly.module.posts::posts.index',
        'uses' => 'Anomaly\PostsModule\Http\Controller\PostsController@index',
    ],
    $this->postsUrlBase() . "/preview/{str_id}"               => [
        'as'   => 'anomaly.module.posts::posts.preview',
        'uses' => 'Anomaly\PostsModule\Http\Controller\PostsController@preview',
    ],
    $this->postsUrlBase() . "/tags/{tag}"                     => [
        'as'   => 'anomaly.module.posts::tags.view',
        'uses' => 'Anomaly\PostsModule\Http\Controller\TagsController@index',
    ],
    $this->postsUrlBase() . "/type/{slug}"                    => [
        'as'   => 'anomaly.module.posts::types.view',
        'uses' => 'Anomaly\PostsModule\Http\Controller\TypesController@index',
    ],
    $this->postsUrlBase() . "/categories/{slug}"              => [
        'as'   => 'anomaly.module.posts::categories.view',
        'uses' => 'Anomaly\PostsModule\Http\Controller\CategoriesController@index',
    ],
    $this->postsUrlBase() . "/archive/{year}/{month?}"        => [
        'as'   => 'anomaly.module.posts::posts.archive',
        'uses' => 'Anomaly\PostsModule\Http\Controller\ArchiveController@index',
    ],
    $this->postsUrlBase() . "/{slug}"                         => [
        'as'   => 'anomaly.module.posts::posts.view',
        'uses' => 'Anomaly\PostsModule\Http\Controller\PostsController@view',
    ],
];