<?php
/**
 * Plugin Name: Post type
 */

require_once dirname( __FILE__ ) . '/lib/Torounit/WP/Post_Type.php';
require_once dirname( __FILE__ ) . '/lib/Torounit/WP/Taxonomy.php';
require_once dirname( __FILE__ ) . '/lib/Torounit/WP/Taxonomy_Filter.php';
require_once dirname( __FILE__ ) . '/lib/Torounit/WP/Walker_CategoryDropdown_Slug.php';

use Torounit\WP\Post_Type;
use Torounit\WP\Taxonomy;

add_action(
	'init',
	function () {
	}
);

