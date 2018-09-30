let mix = require('laravel-mix');

mix.sass('src/style.scss', 'dist/')
    .copyDirectory('src/images', 'dist/images');
