const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');
// Note: use `gulp --production` when building for production
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    if (Elixir.inProduction) {
        process.env.NODE_ENV = 'production';
    }
    mix.sass('app.scss')
        .scripts([
            'pxl.js',
            'materialize.js'
        ], 'public/js/pxl.js')
        .scripts([
            'login.js'
        ], 'public/js/login.js')
        .webpack('app.js')
});
