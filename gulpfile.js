const gulp = require('gulp');

var config = {
	'source': './src',
	'dist': './dist',
	'build': './build/anred-theme',
	'vendor': [
		'bootstrap',
		'font-awesome',
		'hammerjs',
		'image-set-polyfill',
		'jquery',
		'jquery-hammerjs',
		'jquery-fancybox',
		'malihu-custom-scrollbar-plugin',
		'popper.js'
	]
}

require('./tasks/clean')(gulp, config);
require('./tasks/vendor')(gulp, config);
require('./tasks/styles')(gulp, config);
require('./tasks/scripts')(gulp, config);
require('./tasks/templates')(gulp, config);
require('./tasks/images')(gulp, config);

require('./tasks/build')(gulp, config);
require('./tasks/watch')(gulp, config);