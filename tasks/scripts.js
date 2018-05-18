const plumber = require('gulp-plumber');
const beautify = require('gulp-beautify');
const concat = require('gulp-concat');
const minify = require('gulp-minify');

module.exports = function(gulp, config) {
	gulp.task('scripts', function() {
		gulp.src( config.source + '/scripts/*.js' )
		.pipe( plumber() )
		.pipe( beautify( {
				'indent_with_tabs': true,
				'preserve_newlines': true
		} ) )
		.pipe( gulp.dest( config.dist + '/scripts/' ) )

		gulp.src( config.source + '/scripts/*.js' )
		.pipe( minify({
			ext: {
				min:'.js'
			},
			noSource: true
		}) )
		.pipe( gulp.dest( config.build + '/scripts/' ) )
	})
};