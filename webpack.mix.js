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
    // .js('public/js/jquery.min.js', 'public/js')
    // .js('public/js/bootstrap.bundle.min.js', 'public/js')
    // .js('public/js/metisMenu.min.js', 'public/js')
    // .js('public/js/waves.min.js', 'public/js')
    // .js('resources/js/app1.js', 'public/js')
    //.js('public/plugins/tinymce/tinymce.min.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
    // .styles('resources/css/bootstrap.min.css','public/css')
    // .styles('resources/css/icons.css','public/css')
    // .styles('resources/css/metisMenu.min.css','public/css')
    // .styles('resources/css/style.css','public/css')
    // .styles([
    //     'resources/css/bootstrap.min.css',
    //     'resources/css/icons.css',
    //     'resources/css/metisMenu.min.css',
    //     'public/css/style.css'
    // ], 'public/css/all.css');

    mix.autoload({
        jquery: ['$', 'window.jQuery',"jQuery","window.$","jquery","window.jquery"]
    });

    