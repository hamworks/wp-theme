<?php


namespace Torounit\WP;

/**
 * Class Post_Type
 *
 * @package Torounit\WP
 */
class Post_Type {

	/** @var string */
	private $post_type;

	/** @var string */
	private $post_type_name;


	/** @var array */
	private $args;

	/** @var array */
	private $labels;

	/**
	 * @param string $post_type post type name slug.
	 * @param string $post_type_name name for label.
	 * @param array $args
	 */
	public function __construct( $post_type, $post_type_name, $args = array() ) {
		$this->post_type      = $post_type;
		$this->post_type_name = $post_type_name;

		$labels = ( ! empty( $args['labels'] ) ) ? $args['labels'] : array();
		$this->set_labels( $labels );
		$this->set_options( $args );
		$this->init();
	}

	/**
	 * Add hooks.
	 */
	public function init() {
		$this->register_post_type();
		add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
	}

	/**
	 * @return string
	 */
	public function get_post_type() {
		return $this->post_type;
	}

	/**
	 * Set Labels.
	 *
	 * @param $args
	 */
	public function set_labels( $args = array() ) {
		$this->labels = $this->create_labels( $args );
	}


	/**
	 * Create Labels.
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	public function create_labels( $args = array() ) {
		$defaults = array(
			'name'               => $this->post_type_name,
			'singular_name'      => $this->post_type_name,
			'all_items'          => $this->post_type_name . '一覧',
			'add_new'            => '新規追加',
			'add_new_item'       => $this->post_type_name . 'を追加',
			'edit_item'          => $this->post_type_name . 'を編集',
			'new_item'           => '新しい' . $this->post_type_name,
			'view_item'          => $this->post_type_name . 'を表示',
			'search_items'       => $this->post_type_name . 'を検索',
			'not_found'          => $this->post_type_name . 'が見つかりませんでした。',
			'not_found_in_trash' => 'ゴミ箱の中から、' . $this->post_type_name . 'が見つかりませんでした。',
			'menu_name'          => $this->post_type_name,
		);

		return array_merge( $defaults, $args );
	}

	/**
	 * Set Option.
	 *
	 * @param $args
	 */
	public function set_options( $args ) {
		$this->args = $this->create_options( $args );
	}

	/**
	 * Create Options.
	 *
	 * @param array $args arguments.
	 *
	 * @return array
	 */
	public function create_options( $args = array() ) {
		$defaults = array(
			'public'            => true,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'show_in_admin_bar' => true,
			'menu_position'     => null,
			'show_in_nav_menus' => true,
			'has_archive'       => true,
			'rewrite'           => array(
				'with_front' => false,
				'slug'       => $this->post_type,
				'walk_dirs'  => false,
			),
			'supports'          => array(
				'title',
				'author',
				'editor',
				'excerpt',
				'revisions',
				'thumbnail',
				'custom-fields',
			),
		);

		$args = array_merge( $defaults, $args );

		if ( $args['rewrite'] && empty( $args['rewrite']['walk_dirs'] ) ) {
			$args['rewrite']['walk_dirs'] = false;
		}

		return $args;
	}

	/**
	 * Regiser Post Type.
	 */
	public function register_post_type() {
		$this->args['labels'] = $this->labels;
		register_post_type( $this->post_type, $this->args );
	}


	/**
	 * Default order to menu_order in admin.
	 *
	 * @param \WP_Query $query
	 */
	public function pre_get_posts( \WP_Query $query ) {
		if ( $query->is_main_query() && is_admin() ) {
			if ( $query->get( 'post_type' ) == $this->get_post_type() ) {
				if ( post_type_supports( $this->get_post_type(), 'page-attributes' ) ) {
					if ( empty( $query->query['order'] ) ) {
						$query->set( 'order', 'ASC' );
					}

					if ( empty( $query->query['orderby'] ) ) {
						$query->set( 'orderby', 'menu_order' );
					}
				}
			}
		}
	}

}


