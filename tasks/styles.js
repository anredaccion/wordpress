const autoprefixer = require( 'gulp-autoprefixer' );
const cleancss = require( 'gulp-clean-css' );
const gulp = require( 'gulp' );
const gulpif = require( 'gulp-if' );
const gzip = require( 'gulp-gzip' );
const plumber = require( 'gulp-plumber' );
const sass = require( 'gulp-sass' );
const sourcemaps = require( 'gulp-sourcemaps' );

const config = require( '../config/gulp' );
const options = config.getConfigKeys();

gulp.task( 'styles', gulp.parallel(
	function main( done ) {
		gulp.src( 'src/styles/style.scss' )
			.pipe( plumber() )
			.pipe( gulpif( options.sourcemaps, sourcemaps.init() ) )
			.pipe( sass( options.sass ) )
			.pipe( autoprefixer( options.autoprefixer ) )
			.pipe( gulpif( options.cleancss, cleancss() ) )
			.pipe( gulpif( options.sourcemaps, sourcemaps.write( './' ) ) )
			.pipe( gulp.dest( options.dest ) )
			.pipe( gulpif( options.gzip, gzip() ) )
			.pipe( gulpif( options.gzip, gulp.dest( options.dest ) ) );

		done();
	},
	function others( done ) {
		gulp.src([
			'src/styles/*.scss',
			'!src/styles/style.scss'
		])
			.pipe( plumber() )
			.pipe( gulpif( options.sourcemaps, sourcemaps.init() ) )
			.pipe( sass( options.sass ) )
			.pipe( autoprefixer( options.autoprefixer ) )
			.pipe( gulpif( options.cleancss, cleancss() ) )
			.pipe( gulpif( options.sourcemaps, sourcemaps.write( './' ) ) )
			.pipe( gulp.dest( options.dest + '/styles/' ) )
			.pipe( gulpif( options.gzip, gzip() ) )
			.pipe( gulpif( options.gzip, gulp.dest( options.dest + '/styles/' ) ) );

		done();
	}
) );