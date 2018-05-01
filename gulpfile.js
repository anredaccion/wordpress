const gulp = require('gulp');

/*
** env: devel | prod
*/

var config = {
	'env': 'devel',
	'source': './src',
	'target': './dist',
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

require('./tasks/' + config.env + '/clean')(gulp, config);
require('./tasks/' + config.env + '/vendor')(gulp, config);
require('./tasks/' + config.env + '/styles')(gulp, config);
require('./tasks/' + config.env + '/scripts')(gulp, config);
require('./tasks/' + config.env + '/templates')(gulp, config);
require('./tasks/' + config.env + '/images')(gulp, config);

require('./tasks/build')(gulp, config);
require('./tasks/watch')(gulp, config);