const gulp = require('gulp');
const plumber = require('gulp-plumber');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const fs = require('fs');
const path = require('path');
const minify = require('gulp-minify');
const cleanCSS = require('gulp-clean-css');

module.exports = function( config ) {
	function bootstrap( done ) {
		gulp.src(config.dirs.source + '/styles/bootstrap.scss')
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
			.pipe( gulp.dest( config.dirs.build + '/vendor/bootstrap' ) )
			.pipe( cleanCSS() )
			.pipe( gulp.dest( config.dirs.dist + '/vendor/bootstrap' ) );

		done();
	};

	function fancybox( done ) {
		gulp.src( './node_modules/jquery-fancybox/source/scss/jquery.fancybox.scss')
			.pipe( plumber() )
			.pipe( sass() )
			.pipe( postcss([
				autoprefixer({
					browsers: ['last 2 versions'],
					cascade: false,
				})
			] ) )
			.pipe( gulp.dest( config.dirs.build + '/vendor/jquery-fancybox/css' ) )
			.pipe( cleanCSS() )
			.pipe( gulp.dest( config.dirs.dist + '/vendor/jquery-fancybox/css' ) );

		gulp.src( './node_modules/jquery-fancybox/source/img/**' )
			.pipe( gulp.dest( config.dirs.build + '/vendor/jquery-fancybox/img' ) )
			.pipe( gulp.dest( config.dirs.dist + '/vendor/jquery-fancybox/img' ) );

		done();
	};

	function others( done ) {
		config.vendor.forEach(pkg => {
			name = getMainFilePath( './node_modules/' + pkg + '/package.json' );
			source = path.relative( '.', './node_modules/' + pkg + '/' + name );

			target = config.dirs.build + '/vendor/' + pkg;

			gulp.src( source )
				.pipe( gulp.dest( target ) );

			target = config.dirs.dist + '/vendor/' + pkg;

			gulp.src( source )
				.pipe( minify({
					ext: {
						min:'.js'
					},
					noSource: true
				}) )
				.pipe( gulp.dest( target ) );
				
		});

		done();
	}

	gulp.task('vendor', gulp.parallel(
		bootstrap,
		fancybox,
		others
	));

};

function getMainFilePath( path ) {
	const file = fs.readFileSync( path );

	if( !file )
		throw new Error('package.json no encontrado');

	const data = JSON.parse( file.toString() );

	if( !data.main )
		throw new Error('archivo principal no definido en package.json');
	
	return data.main
}
