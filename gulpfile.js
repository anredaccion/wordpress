
var config = {
	dirs: {
		source: './src',
		dist: './dist/anred-theme',
		build: './build'
	},
	vendor: [
		'jquery-hammerjs'
	]
}

require('./tasks/clean')( config );
require('./tasks/vendor')( config );
require('./tasks/styles')( config );
require('./tasks/scripts')( config );
require('./tasks/templates')( config );
require('./tasks/images')( config );

require('./tasks/build')( config );
require('./tasks/watch')( config );