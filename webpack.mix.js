const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
mix.styles([
    'resources/css/login.css',
    'resources/css/font.css',
    'resources/css/sb-admin-2.min.css',
    'resources/css/welcome.css',
 ], 'public/css/app.css');
mix.scripts([
    'resources/js/sb-admin-2.min.js',
 ], 'public/js/app.js');
 