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

mix.copy('node_modules/materialize-css/dist/js/materialize.js', 'resources/assets/js/materialize.js');
mix.copy('node_modules/materialize-css/dist/css/materialize.min.css', 'public/css/materialize.css');

mix.js([
    'resources/assets/js/app.js',
    'resources/assets/js/pxl.js',
    'resources/assets/js/materialize.js',
], 'public/js');
mix.combine([
    'resources/assets/js/login.js'
], 'public/js/login.js');
mix.js([
    'resources/assets/js/gallery.js'
], 'public/js/gallery.js');
mix.sass('resources/assets/sass/app.scss', 'public/css');
