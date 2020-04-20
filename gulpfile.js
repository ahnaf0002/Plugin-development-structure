// Load Gulp...of course
var gulp         = require( 'gulp' );

const {src, task, dest, watch, series, parallel} = require ('gulp');

// CSS related plugins
var sass         = require( 'gulp-sass' );
var autoprefixer = require( 'gulp-autoprefixer' );
var minifycss    = require( 'gulp-uglifycss' );

// JS related plugins
var concat       = require( 'gulp-concat' );
var uglify       = require( 'gulp-uglify' );
var babelify     = require( 'babelify' );
var browserify   = require( 'browserify' );
var source       = require( 'vinyl-source-stream' );
var buffer       = require( 'vinyl-buffer' );
var vfs = require('vinyl-fs');
var stripDebug   = require( 'gulp-strip-debug' );

// Utility plugins
var rename       = require( 'gulp-rename' );
var sourcemaps   = require( 'gulp-sourcemaps' );
var notify       = require( 'gulp-notify' );
var plumber      = require( 'gulp-plumber' );
var options      = require( 'gulp-options' );
var gulpif       = require( 'gulp-if' );

// Browers related plugins
var browserSync  = require( 'browser-sync' ).create();
var reload       = browserSync.reload;

// Project related variables
var projectURL   = 'http://localhost/plugindevelopment/';

var styleSRC     = './src/scss/mystyle.scss';
var styleURL     = './assets/';
var mapURL       = './';

var jsSRC        = './src/js/myscript.js';
var jsURL        = './assets/';

var styleWatch   = './src/scss/**/*.scss';
var jsWatch      = './src/js/**/*.js';
var phpWatch     = './**/*.php';

// Tasks
function browser_sync(done) {
	browserSync.init({
		proxy: projectURL,
		injectChanges: true,
		open: false
	});
	done();
};
function reload(done){
	browserSync.reload();
	done();
	}

	gulp.task('browser_sync', browser_sync);


function css (done) {
	gulp.src( styleSRC )
		.pipe( sourcemaps.init() )
		.pipe( sass({
			errLogToConsole: true,
			outputStyle: 'compressed'
		}) )
		.on( 'error', console.error.bind( console ) )
		.pipe( autoprefixer({ browsers: [ 'last 2 versions', '> 5%', 'Firefox ESR' ] }) )
		.pipe( sourcemaps.write( mapURL ) )
		.pipe( gulp.dest( styleURL ) )
		.pipe( browserSync.stream() );

		done();
}

gulp.task( 'styles', css );

function js(done) {
	 
	return browserify({
		entries: [jsSRC]
	})
	.transform( babelify, { presets: [ '@babel/preset-env' ] } )
	.bundle()
	.pipe( source( 'myscript.js' ))
	.pipe( buffer() )
	.pipe( gulpif( options.has( 'production' ), stripDebug() ) )
	.pipe( sourcemaps.init({ loadMaps: true }) )
	.pipe( uglify() )
	.pipe( sourcemaps.write( '.' ) )
	.pipe( gulp.dest( jsURL ) )
	.pipe( browserSync.stream() );

	done();
 }

gulp.task( 'js', js);

function triggerPlumber( src, url ) {
	return gulp.src( src )
	.pipe( plumber() )
	.pipe( gulp.dest( url ) );
}


// function assets (done) {
// 	gulp.src( jsURL + 'myscript.min.js' )
// 		.pipe( notify({ message: 'Assets Compiled!' }) );

// 		done();
//  }
//  gulp.task( 'assets', assets);


 



 function watch_files(done){


	gulp.watch( phpWatch, reload );
	gulp.watch( styleWatch, gulp.series(css,reload) );
	gulp.watch( jsWatch, gulp.series(js, reload ) );
	gulp.src( jsURL + 'myscript.min.js' )
		.pipe( notify({ message: 'Gulp is Watching, Happy Coding!' }) );

	 done();

}

// gulp.task('watch_filess', watch)

gulp.task( 'default', gulp.parallel('styles', 'js'));

gulp.task('watch', gulp.parallel(browser_sync, watch_files) );




//  gulp.task( 'watch', ['default', 'browser-sync'], function() {
// 	gulp.watch( phpWatch, reload );
// 	gulp.watch( styleWatch, [ 'styles' ] );
// 	gulp.watch( jsWatch, [ 'js', reload ] );
// 	gulp.src( jsURL + 'myscript.min.js' )
// 		.pipe( notify({ message: 'Gulp is Watching, Happy Coding!' }) );
//  });
