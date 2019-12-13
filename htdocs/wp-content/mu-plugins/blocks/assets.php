<?php

/**
 * ブロックエディタ用のCSSを追加
 */
function hamworks_enqueue_block_styles() {
	wp_enqueue_style( 'hamworks-blocks-style', plugins_url( 'dist/main.css', __FILE__ ), false, 1 );
}


/**
 * ブロックエディタ用のJSを追加
 */
function hamworks_enqueue_editor_assets() {
	$script_asset = require ( dirname( __FILE__ )  . '/build/index.asset.php' );
	wp_enqueue_script( 'hamworks-blocks-script', plugins_url( 'build/index.js', __FILE__ ), $script_asset['dependencies'], $script_asset['version'], true );
}

function hamworks_register_block_assets() {
	add_action( 'wp_enqueue_scripts', 'hamworks_enqueue_block_styles' );
	add_action( 'enqueue_block_editor_assets', 'hamworks_enqueue_block_styles' );
	add_action( 'enqueue_block_editor_assets', 'hamworks_enqueue_editor_assets' );
}
