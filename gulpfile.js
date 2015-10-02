var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('all.scss');
    
    mix.scripts([
        'jquery.min.js',
        'bootstrap.min.js',
        'dropzone.js',
        'basket.js',
    ], 'public/js/all.js');
});
