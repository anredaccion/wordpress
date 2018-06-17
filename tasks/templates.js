const gulp = require('gulp');

module.exports = function( config ) {
	gulp.task( 'templates', function ( done ) {
		gulp.src( config.dirs.source + '/templates/**/*.php' )
			.pipe( gulp.dest( config.dirs.build ) )
			.pipe( gulp.dest( config.dirs.dist ) );

		done();
	});
};