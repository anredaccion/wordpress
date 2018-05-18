module.exports = function(gulp, config) {
	gulp.task( 'images', function () {
		gulp.src( [ config.source + '/images/**', '!' + config.source + '/images/screenshot.png' ] )
			.pipe( gulp.dest( config.dist + '/images') )
			.pipe( gulp.dest( config.build + '/images') );

		gulp.src( config.source + '/images/screenshot.png' )
			.pipe( gulp.dest( config.dist) )
			.pipe( gulp.dest( config.build) );
	});
};