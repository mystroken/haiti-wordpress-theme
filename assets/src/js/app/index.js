import * as modules from '../modules';

export default function initializeApp() {
	const instance = {};

	// Iterate through all modules, execute each module and
	// submit the app (this) via Dependency Injection.
	instance.modules = {};
	Object.keys( modules ).forEach( ( key ) => {
		instance.modules[ key ] = modules[ key ]( instance );
	} );

	return instance;
}
