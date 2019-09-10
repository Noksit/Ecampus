let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'resources/assets/js/bootstrap.js'
], 'public/js/all.js');

mix.copyDirectory('resources/assets/images','public/images');
mix.copyDirectory('resources/assets/images/Tutos','public/storage/imgpublication-crop');
mix.copyDirectory('resources/assets/images/Tutos','public/storage/imgpublication-resize');
mix.copyDirectory('resources/assets/images/Tutos','public/storage/imgpublication-origin');

