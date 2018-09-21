let mix = require('laravel-mix');

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

// Admin resources
mix.combine([
        'vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css',
        'vendor/almasaeed2010/adminlte/bower_components/font-awesome/css/font-awesome.min.css',
        'vendor/almasaeed2010/adminlte/bower_components/Ionicons/css/ionicons.min.css',

        'vendor/datatables/datatables/media/css/dataTables.bootstrap.css',
        'vendor/almasaeed2010/adminlte/bower_components/select2/dist/css/select2.min.css',
        'vendor/almasaeed2010/adminlte/plugins/iCheck/square/blue.css',

        'vendor/almasaeed2010/adminlte/dist/css/AdminLTE.min.css',
        'vendor/almasaeed2010/adminlte/dist/css/skins/skin-blue.min.css',

        'resources/assets/css/admin/fixes.css',
    ], 'public/assets/css/admin.css')
    .babel([
        'vendor/almasaeed2010/adminlte/bower_components/jquery/dist/jquery.min.js',
        'node_modules/jquery-migrate/dist/jquery-migrate.min.js',
        'vendor/almasaeed2010/adminlte/bower_components/jquery-ui/jquery-ui.min.js',
        'vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js',

        'vendor/datatables/datatables/media/js/jquery.dataTables.min.js',
        'vendor/datatables/datatables/media/js/dataTables.bootstrap.min.js',
        'vendor/almasaeed2010/adminlte/bower_components/select2/dist/js/select2.full.min.js',
        'vendor/almasaeed2010/adminlte/plugins/iCheck/icheck.min.js',
        'vendor/almasaeed2010/adminlte/bower_components/inputmask/dist/min/jquery.inputmask.bundle.min.js',

        'vendor/almasaeed2010/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
        'vendor/almasaeed2010/adminlte/bower_components/fastclick/lib/fastclick.js',
        'vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js',
    ], 'public/assets/js/vendor.js')
    .babel([
        'resources/assets/js/common/namespace.js',
        'resources/assets/js/common/http-method.js',
        'resources/assets/js/admin/datatable-helper.js',
        'resources/assets/js/admin/common.js',
    ], 'public/assets/js/admin.js')
    .copy('vendor/almasaeed2010/adminlte/bower_components/font-awesome/fonts/*.*','public/assets/fonts/')
    .copy('vendor/almasaeed2010/adminlte/bower_components/Ionicons/fonts/*.*','public/assets/fonts/')
    .copy('vendor/almasaeed2010/adminlte/bower_components/bootstrap/fonts/*.*','public/assets/fonts/')
    .copy('vendor/almasaeed2010/adminlte/dist/img','public/assets/img')
    .copy('vendor/almasaeed2010/adminlte/plugins','public/assets/plugins')
    .copy('vendor/datatables/i18n/i18n', 'public/assets/datatables/i18n')
    .copy('vendor/almasaeed2010/adminlte/plugins/iCheck/square/blue.png', 'public/assets/css');

// App resources
mix.combine([
		'markup/build/assets/css/application.css',
		'resources/assets/css/app/fixes.css',
	], 'public/assets/css/app.css')
	.babel([
        'vendor/almasaeed2010/adminlte/bower_components/jquery/dist/jquery.min.js',
        'markup/build/assets/js/common.js',
		'markup/build/assets/js/vendor.js',
		'markup/build/assets/js/application.js',

		'resources/assets/js/common/namespace.js',
        'resources/assets/js/app/common.js',
		'resources/assets/js/app/game_events.js',
	], 'public/assets/js/app.js')
	.copy('markup/build/assets/img', 'public/assets/img')
	.copy('resources/assets/images', 'public/assets/img')
	.copy('markup/build/assets/fonts', 'public/assets/fonts');

if (mix.config.inProduction) {
  mix.version();
  mix.minify();
}
