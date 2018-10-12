const gulp = require( 'gulp' );
const gulpif = require( 'gulp-if' );
const gzip = require( 'gulp-gzip' );
const sourcemaps = require( 'gulp-sourcemaps' );
const terser = require( 'gulp-terser' );

const config = require( '../config/gulp' );
const options = config.getConfigKeys();

gulp.task( 'scripts', function( done ) {
	gulp.src( 'src/scripts/**/*.js' )
		.pipe( gulpif( options.sourcemaps, sourcemaps.init({ loadMaps: true }) ) )
		.pipe( gulpif( options.uglify, terser() ) )
		.pipe( gulpif( options.sourcemaps, sourcemaps.write( './' ) ) )
		.pipe( gulp.dest( options.dest + '/scripts' ) )
		.pipe( gulpif( options.gzip, gzip() ) )
		.pipe( gulpif( options.gzip, gulp.dest( options.dest + '/scripts' ) ) );

	done();
});