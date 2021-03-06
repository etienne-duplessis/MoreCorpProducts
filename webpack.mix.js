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

//Assets

mix
    .js('resources/assets/js/app.js', 'public/js')
    .scripts('resources/assets/js/feather.min.js', 'public/js/feather.min.js')
    .sass('resources/assets/sass/app.scss', 'public/css');

//Utilities

mix
    .sourceMaps()
    .version()
    .browserSync('http://127.0.0.1:8000');