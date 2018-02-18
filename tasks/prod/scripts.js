const uglify = require('gulp-uglify');
const concat = require('gulp-concat');

module.exports = function(gulp, config) {
	gulp.task('scripts', function() {
		gulp.src( config.source + '/scripts/*.js' )
		.pipe( uglify() )
		.pipe( concat( 'anred.js' ) )
		.pipe( gulp.dest( config.target + '/scripts/' ) )
	})
};