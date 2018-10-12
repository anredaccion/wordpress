module.exports = {
	autoprefixer: { browsers: [ '>1%, not op_mini all' ] },
	cleancss: true,
	debug: false,
	dest: 'build',
	gzip: true,
	imagemin: true,
	sass: { outputStyle: 'compressed' },
	sourcemaps: false,
	uglify: true
};