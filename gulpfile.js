const gulp = require( 'gulp' );

require( 'dotenv' ).config( '.env' );

require( './tasks/clean' );
require( './tasks/images' );
require( './tasks/linter' );
require( './tasks/scripts' );
require( './tasks/stage' );
require( './tasks/styles' );
require( './tasks/templates' );
require( './tasks/vendor' );

gulp.task(
	'build',
	gulp.series(
		'clean',
		'linter',
		gulp.parallel(
			'images',
			'templates',
			'scripts',
			'styles'
		)
	)
);

gulp.task( 'watch', function() {
	gulp.watch( 'src/templates/**/*.php', gulp.series( 'templates' ) );
	gulp.watch( 'src/styles/**/*.scss', gulp.series( 'styles' ) );
	gulp.watch( 'src/scripts/**/*.js', gulp.series( 'scripts' ) );
	gulp.watch( 'src/images/*', gulp.series( 'images' ) );
});