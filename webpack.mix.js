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
        'resources/assets/sass/plugins/jquery.dataTables.min.css',
        'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
        'node_modules/select2/dist/css/select2.css',
    ], 'public/css/app-custom.css')
	.js([
    	'resources/assets/js/front.js',
    	'resources/assets/js/plugins/paper-kit.js',
    ], 'public/js/front.js')
    .js('resources/assets/js/app.js', 'public/js')
    .scripts([
        'resources/assets/js/plugins/bootstrap-material-design.min.js',
        'resources/assets/js/admincrm.js',
    ], 'public/js/backend-custom.js')
    .vue()
    .version();