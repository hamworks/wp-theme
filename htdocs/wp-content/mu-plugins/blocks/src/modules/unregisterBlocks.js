import { getBlockTypes, unregisterBlockType } from '@wordpress/blocks';
import blackListBlocks from './blackListBlocks';

const unregisterBlocks = () => {
	getBlockTypes().forEach( function( blockType ) {
		if ( blackListBlocks.includes( blockType.name ) ) {
			unregisterBlockType( blockType.name );
		}
	} );
};

/**
 * @type {Promise}
 */
const { _wpLoadBlockEditor } = window;

if ( _wpLoadBlockEditor ) {
	_wpLoadBlockEditor.then( () => {
		unregisterBlocks();
	} );
} else {
	window.addEventListener( 'load', () => {
		unregisterBlocks();
	} );
}

