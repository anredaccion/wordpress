module.exports = function(gulp, config) {
	gulp.task( 'images', function () {
		gulp.src( [ config.source + '/images/**', !config.source + '/images/screenshot.png' ] )
			.pipe( gulp.dest( config.target + '/images') );
		gulp.src( config.source + '/images/screenshot.png' )
			.pipe( gulp.dest( config.target ) );
	});
};