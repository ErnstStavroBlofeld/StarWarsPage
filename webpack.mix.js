const mix = require('laravel-mix');
const MixGlob = require('laravel-mix-glob');

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

const mixGlob = new MixGlob({mix});

mixGlob.sass('resources/sass/**/*.compile.scss', 'public/css/', null, { base: 'resources/sass/' })
    .js('resources/js/**/*.compile.{js,jsm}', 'public/js/', null, { base: 'resources/js/' });


mix.copyDirectory('resources/img/', 'public/img/');