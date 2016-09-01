var gulp   = require('gulp');
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

/**
 * Copy any needed files.
 *
 * Do a 'gulp copyfiles' after bower updates
 *
 */

 gulp.task('copyfiles', function () {

 	gulp.src("vendor/bower_dl/jquery/dist/jquery.js")
 		.pipe(gulp.dest("resources/assets/js/"));

	gulp.src("vendor/bower_dl/bootstrap-sass/assets/stylesheets/**")
        .pipe(gulp.dest("resources/assets/sass/bootstrap"));

    gulp.src("vendor/bower_dl/bootstrap-sass/assets/javascripts/bootstrap.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("vendor/bower_dl/sweetalert/dist/sweetalert.min.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("vendor/bower_dl/sweetalert/dist/sweetalert.css")
        .pipe(gulp.dest("resources/assets/css/"));

    gulp.src("vendor/bower_dl/bootstrap-sass/assets /fonts/bootstrap/**")
    	.pipe(gulp.dest("public/assets/fonts"));
 });


/**
 * Default gulp is to run this elixir stuff
 */
elixir(function(mix) {

    // Combine scripts
    mix.scripts([
            'js/jquery.js',
            'js/jquery.multi-select.js',
            'js/bootstrap.js',
            'js/sweetalert.min.js',
            'js/deleteItems.js'
        ],
        'public/assets/js/app.js',
        'resources/assets'
    );

	//Compile sass
	mix.sass('app.scss', 'resources/assets/css/app.css');

	mix.styles([
        'resources/assets/css/app.css',
        'resources/assets/css/multi-select.css',
        'resources/assets/css/sweetalert.css'
    ], 'public/assets/css/app.css', './');
	// Version css
    mix.version('public/assets/css/app.css');
});
