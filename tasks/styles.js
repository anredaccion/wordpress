const gulp = require('gulp');
const bs = require('browser-sync');
const plumber = require('gulp-plumber');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cleanCSS = require('gulp-clean-css');

module.exports = function( config ) {
	gulp.task('styles', gulp.series(
		function build( done ) {
			gulp.src( config.dirs.source + '/styles/style.scss' )
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
				.pipe( plumber.stop() )
				.pipe( gulp.dest( config.dirs.build ) )
				.pipe( bs.stream() );
			
			done();
		},
		function dist( done ) {
			gulp.src( config.dirs.source + '/styles/style.scss' )
				.pipe( sass() )
				.pipe( postcss([
					autoprefixer({
						browsers: ['last 2 versions'],
						cascade: false,
					})
				] ) )
				.pipe( cleanCSS() )
				.pipe( gulp.dest( config.dirs.dist ) );

			done();
		},
		function editor( done ) {
			gulp.src( config.dirs.source + '/styles/editor-style.scss' )
				.pipe( sass() )
				.pipe( postcss([
					autoprefixer({
						browsers: ['last 2 versions'],
						cascade: false,
					})
				] ) )
				.pipe( cleanCSS() )
				.pipe( gulp.dest( config.dirs.build ) )
				.pipe( gulp.dest( config.dirs.dist ) );
			done();
		}
	) );
};
