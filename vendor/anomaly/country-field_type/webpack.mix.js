let mix = require('laravel-mix');

mix
    .copy('node_modules/choices/choices.js', 'resources/js')
    .sass('resources/scss/choices.scss', 'resources/css');
