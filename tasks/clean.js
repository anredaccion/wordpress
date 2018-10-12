const del = require( 'del' );
const gulp = require( 'gulp' );

const config = require( '../config/gulp' );
const options = config.getConfigKeys();

gulp.task( 'clean', function() {
	return del([
		options.dest + '/**',
		'!' + options.dest,
		'!' + options.dest + '/vendor/**'
	]);
});