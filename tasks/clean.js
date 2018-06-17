const gulp = require('gulp');
const del = require('del');

module.exports = function( config ) {
	gulp.task( 'clean', function () {
		return del([
			config.dirs.build + '/**',
			'!' + config.dirs.build,
			'!' + config.dirs.build + '/vendor/**',

			config.dirs.dist + '/**',
			'!' + config.dirs.dist,
			'!' + config.dirs.dist + '/vendor/**',
		]);
	});

	gulp.task( 'clean-vendor', function () {
		return del([
			config.dirs.build + '/vendor/**',
			'!' + config.dirs.build + '/vendor',

			config.dirs.dist + '/vendor/**',
			'!' + config.dirs.dist + '/vendor',
		]);
	});
};