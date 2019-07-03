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
    'resources/css/subject-registration.css',
    'resources/css/registration-instruction.css',
    'resources/css/view-schedule.css',
    'resources/css/view-point.css',
 ], 'public/css/home.css');
mix.styles([
    'resources/css/all.min.css',
    'resources/css/font.css',
    'resources/css/sb-admin-2.min.css',
    'resources/css/custom-font.css',
    'resources/css/admin-home.css',
    'resources/css/admin-profile.css',
    'resources/css/admin-generation-management.css',
    'resources/css/student-management.css',
 ], 'public/css/admin.css');
mix.scripts([
    'resources/js/sb-admin-2.min.js',
 ], 'public/js/app.js');
mix.scripts([
    'resources/js/update-information.js',
	'resources/js/jquery.easing.min.js',
    'resources/js/resume.min.js',
    'resources/js/subject-registration.js',
    'resources/js/view-schedule.js',
 ], 'public/js/home.js');
mix.scripts([
    'resources/js/sb-admin-2.min.js',
    'resources/js/jquery.easing.min.js',
    'resources/js/admin-generation-management.js',
    'resources/js/student-management.js',
 ], 'public/js/admin.js');
