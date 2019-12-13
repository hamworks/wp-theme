<?php

namespace Torounit\WP;

/**
 * Class Post_Type_Permalink_Expander
 *
 * Expand permalink and rewrite setting.
 *
 * @package Torounit\WP
 */
class Post_Type_Permalink_Expander {

	/**
	 * Post_Type_Permastruct constructor.
	 */
	public function __construct() {
		if ( get_option( 'permalink_structure' ) ) {
			add_action( 'registered_post_type', [ $this, 'set_permastruct' ], 10, 2 );
			add_filter( 'post_type_link', [ $this, 'post_type_link' ], 10, 2 );
		}
	}

	/**
	 * Set permalink structure.
	 *
	 * @param string        $post_type
	 * @param \WP_Post_Type $post_type_object
	 */
	public function set_permastruct( string $post_type, \WP_Post_Type $post_type_object ) {
		$permastruct = $post_type_object->rewrite['permastruct'] ?? false;
		if ( $permastruct ) {
			$permastruct = str_replace( '%postname%', "%{$post_type}%", $permastruct );
			add_rewrite_tag( "%${post_type}_slug%", '(' . $post_type_object->rewrite['slug'] . ')', "post_type=${post_type}&slug=" );
			$permastruct_args         = $post_type_object->rewrite;
			$permastruct_args['feed'] = $permastruct_args['feeds'];
			add_permastruct( $post_type, "%${post_type}_slug%/${permastruct}", $permastruct_args );
		}
	}

	/**
	 * Fix post_type permalink from postname to id.
	 *
	 * @param string   $post_link The post's permalink.
	 * @param \WP_Post $post The post in question.
	 *
	 * @return string
	 */
	public function post_type_link( $post_link, \WP_Post $post ) {
		$post_type        = $post->post_type;
		$post_type_object = get_post_type_object( $post_type );
		$author           = '';
		if ( false !== strpos( $post_link, '%author%' ) ) {
			$authordata = get_userdata( $post->post_author );
			$author     = $authordata->user_nicename;
		}
		$post_date      = strtotime( $post->post_date );
		$rewritecode    = array(
			"%${post_type}_slug%",
			'%post_id%',
		);
		$rewritereplace = array(
			$post_type_object->rewrite['slug'],
			$post->ID,
			date( 'Y', $post_date ),
			date( 'm', $post_date ),
			date( 'd', $post_date ),
			date( 'H', $post_date ),
			date( 'i', $post_date ),
			date( 's', $post_date ),
			$author,
		);

		return str_replace( $rewritecode, $rewritereplace, $post_link );
	}


}
