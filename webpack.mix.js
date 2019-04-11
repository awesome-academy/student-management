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
mix.styles([
    'resources/css/welcome.css',
    'resources/css/home.css',
    'resources/css/all.min.css',
    'resources/css/resume.min.css',
    'resources/css/check-information.css',
    'resources/css/update-information.css',
 ], 'public/css/home.css');
mix.scripts([
    'resources/js/sb-admin-2.min.js',
 ], 'public/js/app.js');
mix.scripts([
    'resources/js/update-information.js',
	'resources/js/jquery.easing.min.js',
    'resources/js/resume.min.js',
 ], 'public/js/home.js');
