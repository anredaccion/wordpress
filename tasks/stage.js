const gulp = require( 'gulp' );
const sftp = require( 'gulp-sftp' );

const config = require( '../config/gulp' );
const options = config.getConfigKeys();

gulp.task( 'stage', function( done ) {
	gulp.src( options.dest + '/**/*' )
		.pipe( sftp({
			host: process.env.STAGE_HOST,
			port: process.env.STAGE_PORT,
			user: process.env.STAGE_USER,
			pass: process.env.STAGE_PASS,
			remotePath: process.env.STAGE_PATH
		}) );

	done();
});