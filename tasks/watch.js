const bs = require('browser-sync');

module.exports = function(gulp, config) {
	gulp.task( 'default', function () {
		bs.init({
			proxy: "anred.dev.cc",
			open: false
		});

		gulp.watch( config.source + '/templates/**/*.php', ['templates', bs.reload ] );
		gulp.watch( config.source + '/styles/**/*.scss', [ 'styles' ] );
		gulp.watch( config.source + '/scripts/*.js', [ 'scripts', bs.reload ] );
		gulp.watch( config.source + '/images/*', [ 'images', bs.reload ] );
		
	});
};