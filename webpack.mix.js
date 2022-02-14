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

mix.sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/app.js', 'public/js/app.js')
.js('resources/js/booking_management.js', 'public/js/booking_management.js')
.js('resources/js/quote_management.js', 'public/js/quote_management.js')
.js('resources/js/template_management.js', 'public/js/template_management.js')
.js('resources/js/supplier_management.js', 'public/js/supplier_management.js')
.js('resources/js/commission_management.js', 'public/js/commission_management.js')
.js('resources/js/user_management.js', 'public/js/user_management.js')
.js('resources/js/setting.js', 'public/js/setting.js')
