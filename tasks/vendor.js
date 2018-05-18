const plumber = require('gulp-plumber');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const fs = require('fs');
const path = require('path');
const minify = require('gulp-minify');
const cleanCSS = require('gulp-clean-css');

module.exports = function( gulp, config ) {
	gulp.task('vendor', function() {
		config.vendor.forEach(pkg => {
			if (pkg == 'bootstrap' || pkg == 'font-awesome' || pkg == 'jquery-fancybox' ||
				pkg == 'image-set-polyfill' ) {
				gulp.start('vendor:' + pkg);
				return;
			}

			name = getMainFilePath( './node_modules/' + pkg + '/package.json' );
			source = path.relative( '.', './node_modules/' + pkg + '/' + name );

			target = config.dist + '/vendor/' + pkg;

			gulp.src( source )
				.pipe( gulp.dest( target ) );

			target = config.build + '/vendor/' + pkg;

			gulp.src( source )
				.pipe( minify({
					ext: {
						min:'.js'
					},
					noSource: true
				}) )
				.pipe( gulp.dest( target ) );
				
		});
	});

	gulp.task('vendor:bootstrap', function() {
		gulp.src( './node_modules/bootstrap/dist/js/bootstrap.js' )
			.pipe( gulp.dest( config.dist + '/vendor/bootstrap' ) )
			.pipe( minify({
				ext: {
					min:'.js'
				},
				noSource: true
			}) )
			.pipe( gulp.dest( config.build + '/vendor/bootstrap' ) );

		gulp.src(config.source + '/styles/bootstrap.scss')
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
			.pipe( gulp.dest( config.dist + '/vendor/bootstrap' ) )
			.pipe( cleanCSS() )
			.pipe( gulp.dest( config.build + '/vendor/bootstrap' ) );
	});

	gulp.task('vendor:font-awesome', function() {
		gulp.src(config.source + '/styles/font-awesome.scss')
			.pipe( plumber() )
			.pipe( sass() )
			.pipe( postcss([
				autoprefixer({
					browsers: ['last 2 versions'],
					cascade: false,
				})
			] ) )
			.pipe( gulp.dest( config.dist + '/vendor/font-awesome' ) )
			.pipe( cleanCSS() )
			.pipe( gulp.dest( config.build + '/vendor/font-awesome' ) );

		gulp.src( './node_modules/font-awesome/fonts/**' )
			.pipe( gulp.dest( config.dist + '/vendor/font-awesome' ) )
			.pipe( gulp.dest( config.build + '/vendor/font-awesome' ) );
	});

	gulp.task('vendor:jquery-fancybox', function() {
		gulp.src( './node_modules/jquery-fancybox/source/scss/jquery.fancybox.scss')
			.pipe( plumber() )
			.pipe( sass() )
			.pipe( postcss([
				autoprefixer({
					browsers: ['last 2 versions'],
					cascade: false,
				})
			] ) )
			.pipe( gulp.dest( config.dist + '/vendor/jquery-fancybox/css' ) )
			.pipe( cleanCSS() )
			.pipe( gulp.dest( config.build + '/vendor/jquery-fancybox/css' ) );

		gulp.src( './node_modules/jquery-fancybox/source/js/jquery.fancybox.js' )
			.pipe( gulp.dest( config.dist + '/vendor/jquery-fancybox/js' ) )
			.pipe( minify({
				ext: {
					min:'.js'
				},
				noSource: true
			}) )
			.pipe( gulp.dest( config.build + '/vendor/jquery-fancybox/js' ) );

		gulp.src( './node_modules/jquery-fancybox/source/img/**' )
			.pipe( gulp.dest( config.dist + '/vendor/jquery-fancybox/img' ) )
			.pipe( gulp.dest( config.build + '/vendor/jquery-fancybox/img' ) );

		
	});

	gulp.task('vendor:image-set-polyfill', function() {
		gulp.src( './node_modules/image-set-polyfill/image-set-polyfill.js' )
			.pipe( gulp.dest( config.dist + '/vendor/image-set-polyfill/js' ) )
			.pipe( minify({
				ext: {
					min:'.js'
				},
				noSource: true
			}) )
			.pipe( gulp.dest( config.build + '/vendor/image-set-polyfill/js' ) );
	});
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
