const argv = require( 'yargs' ).argv;
const exec = require( 'child_process' ).exec;

module.exports = {
	environment: argv.env || 'development',
	getConfigKeys() {
		let keys;

		try {
			keys = require( `./${this.environment}` );
		} catch ( e ) {
			throw new Error( `No config file found for environment ${this.environment}` );
		}

		keys.environment = this.environment;

		return keys;
	},
	getErrorHandler() {
		return ( err ) => {
			console.log( '[', err.name, '] ', err.message );
			let command = `New-BurntToastNotification -Text "${err.name.replace( /['`]/g, '' )}", "${err.message.replace( /['`]/g, '' )}"`;
			exec( `powershell.exe -command '${command}'` );
		};
	}
};