const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
	.js('resources/assets/js/vue.js', 'public/js/vue10.js')
	.js('resources/assets/js/main.js', 'public/js/main8.js')
	.js('resources/assets/js/myscripts.js', 'public/js/bundle1.js')
   .sass('resources/assets/sass/style.scss', 'public/css/style1.css');
