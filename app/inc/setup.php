<?php
/**
 * Setting up the theme.
 *
 * @package Genese
 * @subpackage Setup
 * @since 1.0.0
 * @author Mystro Ken <mystroken@gmail.com>
 */

if ( ! function_exists( 'genese_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function genese_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Genese, use a find and replace
		 * to change 'genese' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'genese', get_template_directory() . '/languages' );

		/*
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable plugins to manage the document title.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add support for Block Styles.
		 */
		add_theme_support( 'wp-block-styles' );

		/**
		 * Enable wide alignment feature.
		 */
		add_theme_support( 'align-wide' );

		/*
		 * Register menus
		 *
		 * Navigations should be mentioned into app/navigations.php
		 *
		 * We retrieve the array from this file and we pass it to
		 * wp_nav_menu() core functions
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus.
		 */
		$nav_menus = require get_stylesheet_directory() . '/app/navigations.php';
		if ( is_array( $nav_menus ) && ! empty( $nav_menus ) ) {
			register_nav_menus( $nav_menus );
		}

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
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'genese_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
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
			apply_filters(
				'genese_custom_logo_args',
				array(
					'height'      => 42,
					'width'       => 284,
					'flex-width'  => true,
					'flex-height' => true,
				)
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'genese_setup' );


if ( ! function_exists('genese_register_post_types') ) :
	/**
	 * Register custom post types.
	 */
	function genese_register_post_types() {
		/*
		 * Register menus
		 *
		 * Navigations should be mentioned into app/navigations.php
		 *
		 * We retrieve the array from this file and we pass it to
		 * wp_nav_menu() core functions
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus.
		 */
		$types = require get_stylesheet_directory() . '/app/custom-post-types.php';
		if ( is_array( $types ) ) {
			foreach ($types as $post_type => $args) {
				register_post_type($post_type, $args);
			}
		}
	}
endif;
add_action('init', 'genese_register_post_types', 0);


/**
 * Remove admin bar from frontend.
 */
add_filter( 'show_admin_bar', '__return_false', PHP_INT_MAX );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function genese_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'genese_content_width', 640 );
}
add_action( 'after_setup_theme', 'genese_content_width', 0 );




if ( ! function_exists( 'genese_enqueue_scripts' ) ) :
	/**
	 * Enqueue scripts and styles.
	 *
	 * @return void
	 */
	function genese_enqueue_scripts() {

		$theme = wp_get_theme();

		wp_register_style(
			'genese-style',
			get_theme_file_uri( '/assets/dist/css/style.css' ),
			false,
			filemtime( get_template_directory_uri() . '/assets/dist/css/style.css' ),
		);

		wp_enqueue_style( 'genese-style' );

		wp_enqueue_script(
			'genese-script',
			get_theme_file_uri( '/assets/dist/js/app.js' ),
			array( 'jquery' ),
			filemtime( get_template_directory_uri() . '/assets/dist/js/app.js' ),
			true
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;
//add_action( 'wp_enqueue_scripts', 'genese_enqueue_scripts', 100 );



/**
 * Register widget area.
 *
 *  Sidebars are filled at app/sidebars.php
 *
 * We retrieve the array from this file and we loop each sub-array to pass it to
 * register_sidebar() core functions
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function genese_widgets_init() {

	$sidebars = require get_stylesheet_directory() . '/app/sidebars.php';

	foreach ( $sidebars as $sidebar ) {

		if ( is_array( $sidebar ) && ! empty( $sidebar ) ) {
			register_sidebar( $sidebar );
		}
	}

	unset( $sidebar );
}
add_action( 'widgets_init', 'genese_widgets_init' );




/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function genese_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'genese_javascript_detection', 0 );

/**
 * For development purposes
 * Allow all origin
 */
function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');
