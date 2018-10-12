const del = require( 'del' );
const gulp = require( 'gulp' );
const gulpif = require( 'gulp-if' );
const gzip = require( 'gulp-gzip' );
const terser = require( 'gulp-terser' );

const config = require( '../config/gulp' );
const options = config.getConfigKeys();

gulp.task( 'vendor', function( done ) {
	del([
		options.dest + '/vendor/**',
		'!' + options.dest + '/vendor'
	]);

	gulp.src( 'src/vendor/**/*' )
		.pipe( gulpif( options.uglify, terser() ) )
		.pipe( gulp.dest( options.dest + '/vendor/' ) )
		.pipe( gulpif( options.gzip, gzip() ) )
		.pipe( gulpif( options.gzip, gulp.dest( options.dest + '/vendor/' ) ) );

	done();
});
