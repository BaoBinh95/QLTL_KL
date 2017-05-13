const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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
    mix.styles('style.css')
       .sass('app.scss')
       .scripts('all.js')
       .webpack('app.js');
    mix.copy('./public/bower_components/bootstrap/fonts', 'public/fonts/bootstrap/');
});
