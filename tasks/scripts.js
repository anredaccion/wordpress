const gulp = require('gulp');
const plumber = require('gulp-plumber');
const beautify = require('gulp-beautify');
const minify = require('gulp-minify');

module.exports = function( config ) {
	gulp.task('scripts', gulp.parallel(
		function build( done ) {
			gulp.src( config.dirs.source + '/scripts/*.js' )
				.pipe( plumber() )
				.pipe( beautify( {
						'indent_with_tabs': true,
						'preserve_newlines': true
				} ) )
				.pipe( plumber.stop() )
				.pipe( gulp.dest( config.dirs.build + '/scripts/' ) )

			done();
		},
		function dist( done ) {
			gulp.src( config.dirs.source + '/scripts/*.js' )
				.pipe( minify({
					ext: {
						min:'.js'
					},
					noSource: true
				}) )
				.pipe( gulp.dest( config.dirs.dist + '/scripts/' ) );
			done();
		}
	) );
};