const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cleancss = require('gulp-clean-css');

module.exports = function(gulp, config) {
	gulp.task('styles', function() {
		gulp.src( config.source + '/styles/style.scss' )
			.pipe( sass( {
				outputStyle: 'compressed',
			} ) ).on( 'error', sass.logError)
			.pipe( postcss([
				autoprefixer({
					browsers: ['last 2 versions'],
					cascade: false,
				})
			] ) )
			.pipe( cleancss() )
			.pipe( gulp.dest( config.target ) );
	});
};
