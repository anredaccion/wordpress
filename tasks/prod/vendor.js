const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const fs = require('fs');
const path = require('path');
const uglify = require('gulp-uglify');
const cleancss = require('gulp-clean-css');

module.exports = function( gulp, config ) {
	gulp.task('vendor', function() {
		config.vendor.forEach(pkg => {
			if (pkg == 'bootstrap' || pkg == 'font-awesome') {
				gulp.start('vendor:' + pkg);
				return;
			}

			name = getMainFilePath( './node_modules/' + pkg + '/package.json' );
			source = path.relative( '.', './node_modules/' + pkg + '/' + name );

			target = config.target + '/vendor/' + pkg;
			
			gulp.src( source )
				.pipe ( uglify() )
				.pipe( gulp.dest( target ) );
		});
	});

	gulp.task('vendor:bootstrap', function() {
		gulp.src( './node_modules/bootstrap/dist/js/bootstrap.js' )
			.pipe ( uglify() )
			.pipe( gulp.dest( config.target + '/vendor/bootstrap' ) );

		gulp.src(config.source + '/styles/bootstrap.scss')
			.pipe( sass( {
				outputStyle: 'compressed'
			} ) ).on( 'error', sass.logError)
			.pipe( postcss([
				autoprefixer({
					browsers: ['last 2 versions'],
					cascade: false,
				})
			] ) )
			.pipe( cleancss() )
			.pipe( gulp.dest( config.target + '/vendor/bootstrap' ) );
	});

	gulp.task('vendor:font-awesome', function() {
		gulp.src(config.source + '/styles/font-awesome.scss')
			.pipe( sass( {
				outputStyle: 'compressed'
			} ) ).on( 'error', sass.logError)
			.pipe( postcss([
				autoprefixer({
					browsers: ['last 2 versions'],
					cascade: false,
				})
			] ) )
			.pipe( cleancss() )
			.pipe( gulp.dest( config.target + '/vendor/font-awesome' ) );

		gulp.src( './node_modules/font-awesome/fonts/**' )
			.pipe( gulp.dest( config.target + '/vendor/font-awesome' ) );
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