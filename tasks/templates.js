const gulp = require( 'gulp' );

const config = require( '../config/gulp' );
const options = config.getConfigKeys();

gulp.task( 'templates', function( done ) {
	gulp.src( 'src/templates/**/*.php' )
		.pipe( gulp.dest( options.dest ) );

	done();
});