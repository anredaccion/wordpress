module.exports = function(gulp, config) {
	gulp.task( 'build', ['vendor', 'scripts', 'styles', 'templates', 'images'] );
};