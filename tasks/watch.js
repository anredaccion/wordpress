const gulp = require('gulp');
const bs = require('browser-sync');

module.exports = function( config ) {
	gulp.task( 'default', function () {
		bs.init({
			proxy: "anred.dev.cc",
			open: false
		});

		gulp.watch( config.dirs.source + '/templates/**/*.php', gulp.series( 'templates', bs.reload ) );
		gulp.watch( config.dirs.source + '/styles/**/*.scss', gulp.series( 'styles' ) );
		gulp.watch( config.dirs.source + '/scripts/*.js', gulp.series( 'scripts', bs.reload ) );
		gulp.watch( config.dirs.source + '/images/*', gulp.series( 'images', bs.reload ) );
		
	});
};