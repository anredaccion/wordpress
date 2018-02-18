const del = require('del');

module.exports = function(gulp, config) {
	gulp.task( 'clean', function () {
		return del([
			'dist/**'
		]);
	});
};