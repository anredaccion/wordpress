const bs = require('browser-sync');
const plumber = require('gulp-plumber');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');

module.exports = function(gulp, config) {
	gulp.task('styles', function() {
		return gulp.src( config.source + '/styles/style.scss' )
			.pipe( plumber() )
			.pipe( sass( {
				indentType: 'tab',
				indentWidth: 1,
				outputStyle: 'expanded',
			} ) ).on( 'error', sass.logError)
			.pipe( postcss([
				autoprefixer({
					browsers: ['last 2 versions'],
					cascade: false,
				})
			] ) )
			.pipe( gulp.dest( config.target ) )
			.pipe( bs.stream() );
	});
};
