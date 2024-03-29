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

mix.js(['resources/js/app.js', 'resources/js/nav.js'], 'public/js')
  .js('resources/js/redirect.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .copy('resources/images', 'public/images');

// TODO: Add sourcemaps (for production)
// TODO: Add cache busting (for production)
