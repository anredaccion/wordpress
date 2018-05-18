module.exports = function(gulp, config) {
	gulp.task( 'templates', function () {
		gulp.src( config.source + '/templates/**/*php' )
			.pipe( gulp.dest( config.dist ) )
			.pipe( gulp.dest( config.build ) );
	});
};