const gulp = require('gulp');

module.exports = function( config ) {
	gulp.task( 'build', gulp.parallel(
		'vendor', 
		'scripts', 
		'styles', 
		'templates', 
		'images'
	) );
};