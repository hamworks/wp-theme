<?php
/**
 * Hamworks functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hamworks
 */

if ( ! function_exists( 'hamworks_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hamworks_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on hamworks, use a find and replace
		 * to change 'hamworks' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hamworks', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'header' => 'ヘッダーメニュー',
				'footer' => 'フッターメニュー',
				'sns'    => 'SNSメニュー',
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 50,
				'width'       => 280,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for custom color scheme.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Strong Blue', 'hamworks' ),
					'slug'  => 'strong-blue',
					'color' => '#0073aa',
				),
				array(
					'name'  => __( 'Lighter Blue', 'hamworks' ),
					'slug'  => 'lighter-blue',
					'color' => '#229fd8',
				),
				array(
					'name'  => __( 'Very Light Gray', 'hamworks' ),
					'slug'  => 'very-light-gray',
					'color' => '#eee',
				),
				array(
					'name'  => __( 'Very Dark Gray', 'hamworks' ),
					'slug'  => 'very-dark-gray',
					'color' => '#444',
				),
			)
		);

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'build/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'hamworks_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hamworks_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hamworks_content_width', 640 );
}
add_action( 'after_setup_theme', 'hamworks_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hamworks_widgets_init() {
	register_sidebar(
		array(
			'name'          => 'リソース表示',
			'id'            => 'widget-resource',
			'description'   => '直近のリソースの表示エリア',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'hamworks_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hamworks_scripts() {
	wp_enqueue_style( 'hamworks-style', get_theme_file_uri( '/build/css/main.css' ), false, wp_get_theme()->get( 'Version' ) );

	wp_enqueue_script( 'hamworks-script', get_template_directory_uri() . '/build/js/index.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'hamworks-fontplus', 'https://webfont.fontplus.jp/accessor/script/fontplus.js?10lGcLVOyG8%3D&box=YPDkVlSgB4o%3D&aa=1&ab=2', array(), wp_get_theme()->get( 'Version' ), false );
}
add_action( 'wp_enqueue_scripts', 'hamworks_scripts' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
