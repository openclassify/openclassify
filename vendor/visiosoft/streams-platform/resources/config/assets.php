<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    | Add additional path prefixes for the asset manager here. You may also
    | add prefixes for domains like a CDN.
    |
    | Later you can access assets in the path like:
    |
    | $asset->add('collection.css', 'example::path/to/asset.css');
    |
    */

    'paths' => [
        //'example' => 'some/local/path',
        //'s3'      => 'https://region.amazonaws.com/bucket'
    ],

    /*
    |--------------------------------------------------------------------------
    | Hints
    |--------------------------------------------------------------------------
    |
    | Hints help the system interpret the correct
    | output file extension to use for syntax / languages
    | that need to be compiled to a standard language.
    |
    */

    'hints' => [
        'css' => [
            'less',
            'scss',
            'sass',
            'styl',
        ],
        'js'  => [
            'coffee',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    */

    'filters' => [
        'min'        => null, // This is a flag.
        'glob'       => null, // This is a flag.
        'parse'      => null, // This is a flag.
        'less'       => env('LESS_COMPILER', 'php') // BC compatibility
            ? \Anomaly\Streams\Platform\Asset\Filter\LessFilter::class
            : \Anomaly\Streams\Platform\Asset\Filter\NodeLessFilter::class,
        'sass'       => env('SASS_COMPILER', 'php') // BC compatibility
            ? \Anomaly\Streams\Platform\Asset\Filter\SassFilter::class
            : \Anomaly\Streams\Platform\Asset\Filter\RubySassFilter::class,
        'scss'       => env('SCSS_COMPILER', env('SASS_COMPILER', 'php')) // BC compatibility
            ? \Anomaly\Streams\Platform\Asset\Filter\ScssFilter::class
            : \Anomaly\Streams\Platform\Asset\Filter\RubyScssFilter::class,
        'styl'       => \Anomaly\Streams\Platform\Asset\Filter\StylusFilter::class,
        'coffee'     => \Anomaly\Streams\Platform\Asset\Filter\CoffeeFilter::class,
        'autoprefix' => \Anomaly\Streams\Platform\Asset\Filter\AutoprefixerFilter::class,
        'separate'   => \Assetic\Filter\SeparatorFilter::class,
        'embed'      => \Assetic\Filter\PhpCssEmbedFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Live
    |--------------------------------------------------------------------------
    |
    | Define which assets marked live are to be compiled.
    |
    | true: Assets request for both the CP and frontend.
    | public: Assets requested ONLY by the frontend.
    | admin: Assets requested ONLY by the CP.
    |
    */

    'live' => env('LIVE_ASSETS', false),

    /*
    |--------------------------------------------------------------------------
    | Version Assets
    |--------------------------------------------------------------------------
    |
    | This will cause asset changes to version by default.
    |
    | <link href="example/theme.css?v=1484943345" type="text/css"/>
    |
    */

    'version' => env('VERSION_ASSETS', true),

    /*
    |--------------------------------------------------------------------------
    | Autoprefixer
    |--------------------------------------------------------------------------
    |
    | Configure the autoprefixer filter if desired.
    |
    */

    'autoprefixer' => env('AUTOPREFIXER', base_path('bin')),
];
