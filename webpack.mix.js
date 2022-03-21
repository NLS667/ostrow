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

/*
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
        "resources/assets/js/plugins/common.js",        
        "resources/assets/js/plugins/settings.js", 
        //'resources/assets/js/plugins/bootstrap-material-design.min.js',
        'resources/assets/js/plugins/material-dashboard2.js',
    ], 'public/js/app-custom.js')
    .vue()
    .version();
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
        "resources/assets/js/plugins/jquery.min.js",
        "resources/assets/js/plugins/popper.min.js",
        "resources/assets/js/plugins/common.js",
        'resources/assets/js/plugins/bootstrap-material-design.min.js',
        //'resources/assets/js/plugins/perfect-scrollbar.jquery.min.js',
        'resources/assets/js/plugins/moment.min.js',
        'resources/assets/js/plugins/sweetalert2.js',
        'resources/assets/js/plugins/jquery.validate.min.js',
        'resources/assets/js/plugins/jquery.bootstrap-wizard.js',
        'resources/assets/js/plugins/bootstrap-selectpicker.js',
        'resources/assets/js/plugins/bootstrap-datetimepicker.min.js',
        'resources/assets/js/plugins/jquery.dataTables.min.js',
        'resources/assets/js/plugins/bootstrap-tagsinput.js',
        'resources/assets/js/plugins/jasny-bootstrap.min.js',
        'resources/assets/js/plugins/fullcalendar.min.js',
        'resources/assets/js/plugins/jquery-jvectormap.js',
        'resources/assets/js/plugins/nouislider.min.js',
        'resources/assets/js/plugins/arrive.min.js',
        'resources/assets/js/plugins/chartist.min.js',
        'resources/assets/js/plugins/bootstrap-notify.js',
        'resources/assets/js/plugins/material-dashboard.js',
        'resources/assets/js/plugins/settings.js',
    ], 'public/js/app-custom.js')
    .vue()
    .version();