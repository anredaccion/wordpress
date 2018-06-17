const gulp = require('gulp');

module.exports = function( config ) {
	gulp.task( 'images', gulp.parallel(
		function screenshot( done ) {
			gulp.src( config.dirs.source + '/images/screenshot.png' )
				.pipe( gulp.dest( config.dirs.build ) )
				.pipe( gulp.dest( config.dirs.dist ) );

			done();
		},
		function others( done ) {
			gulp.src( [ config.dirs.source + '/images/**', '!' + config.dirs.source + '/images/screenshot.png' ] )
				.pipe( gulp.dest( config.dirs.build + '/images' ) )
				.pipe( gulp.dest( config.dirs.dist + '/images' ) );

			done();
		}
	) );
};