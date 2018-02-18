const plumber = require('gulp-plumber');
const beautify = require('gulp-beautify');
const concat = require('gulp-concat');

module.exports = function(gulp, config) {
	gulp.task('scripts', function() {
		return gulp.src( config.source + '/scripts/*.js' )
		.pipe( plumber() )
		.pipe( beautify( {
				'indent_with_tabs': true,
				'preserve_newlines': true
		} ) )
		.pipe( concat( 'anred.js' ) )
		.pipe( gulp.dest( config.target + '/scripts/' ) )
	})
};