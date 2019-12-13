import { addFilter } from '@wordpress/hooks';

addFilter(
	'blocks.registerBlockType',
	'hamworks/support-full-width',
	( settings, name ) => {
		if ( name !== 'core/separator' ) {
			return settings;
		}

		return {
			...settings,
			supports: {
				align: [ 'wide', 'full' ],
			},
		};
	}
);
