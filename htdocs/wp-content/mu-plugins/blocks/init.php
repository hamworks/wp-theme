<?php
/**
 * Hamworks Made Blocks
 */

require dirname( __FILE__ ) . '/autoload.php';

require dirname( __FILE__ ) . '/meta.php';
require dirname( __FILE__ ) . '/assets.php';



/**
 * Init
 */
function hamworks_blocks_init() {
	load_plugin_textdomain( 'hamworks-blocks' );
	add_action( 'init', 'hamworks_register_meta' );
	add_action( 'init', 'hamworks_register_block_assets' );
}

hamworks_blocks_init();
