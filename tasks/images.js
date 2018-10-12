const gulp = require( 'gulp' );
const gulpif = require( 'gulp-if' );
const imagemin = require( 'gulp-imagemin' );

const config = require( '../config/gulp' );
const options = config.getConfigKeys();

gulp.task( 'images', gulp.parallel(
	function screenshot( done ) {
		gulp.src( 'src/images/screenshot.png' )
			.pipe( gulpif( options.imagemin, imagemin({ verbose: options.debug }) ) )
			.pipe( gulp.dest( options.dest ) );

		done();
	},
	function others( done ) {
		gulp.src([ 'src/images/**/*', '!src/images/screenshot.png' ])
			.pipe( gulpif( options.imagemin, imagemin({ verbose: options.debug }) ) )
			.pipe( gulp.dest( options.dest + '/images' ) );

		done();
	}
) );