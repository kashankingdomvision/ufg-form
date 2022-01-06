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
   .js('resources/js/category_app.js', 'public/js/category_app.js')
   .js('resources/js/quote_app.js', 'public/js/quote_app.js')
