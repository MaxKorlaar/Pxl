const {mix} = require('laravel-mix');

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
// npm run dev

mix.js([
    'resources/assets/js/app.js',
    'resources/assets/js/pxl.js'
], 'public/js');
mix.combine([
    'resources/assets/js/login.js'
], 'public/js/login.js');
mix.js([
    'resources/assets/js/gallery.js'
], 'public/js');
mix.sass('resources/assets/sass/app.scss', 'public/css');
mix.sass('node_modules/materialize-css/sass/materialize.scss', 'public/css');
