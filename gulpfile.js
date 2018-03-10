process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    elixir.config.css.autoprefix.options.browsers = ['> 1%', 'Last 2 versions', 'IE 9']; // to query browsers to prefix for https://github.com/ai/browserslist#queries
    mix.sass('styles.scss');
    mix.browserify('index.js');
});
