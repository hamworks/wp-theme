<?php

spl_autoload_register( 'hamworks_blocks_autoload_register' );

function hamworks_blocks_autoload_register( $name ) {
	$dir        = dirname( __FILE__ );
	$namespaces = explode( '\\', $name );
	$class_name = array_pop( $namespaces );
	$namespaces = preg_replace( '/[a-z]+(?=[A-Z])|[A-Z]+(?=[A-Z][a-z])/', '\0-', $namespaces );
	$dir = dirname( __FILE__ ) . '/src/blocks' . str_replace( 'hamworks/blocks', '', strtolower( join( '/', $namespaces ) ) );

	$file_name = $dir . '/' . $class_name . '.php';
	if ( is_readable( $file_name ) ) {
		include $file_name;
	}
}
