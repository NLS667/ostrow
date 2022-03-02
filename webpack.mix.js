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

mix.autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'],
        'popper.js/dist/umd/popper.js': ['Popper']
    })
	.sass('resources/assets/sass/front.scss', 'public/css/front.css')
	.sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
        'node_modules/select2/dist/css/select2.css',
    ], 'public/css/app-custom.css')
	.js([
    	'resources/assets/js/front.js',
    	'resources/assets/js/plugins/paper-kit.js',
    ], 'public/js/front.js')
    .js('resources/assets/js/app.js', 'public/js')
    .scripts([
        "resources/assets/js/plugins/black-dashboard.js",  
        "resources/assets/js/plugins/common.js",
        "resources/assets/js/plugins/theme.js",
    ], 'public/js/backend-custom.js')
    .vue()
    .version();