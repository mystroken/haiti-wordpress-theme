<?php
/**
 * Advanced Custom Fields Pro
 * Configuration.
 *
 * @see https://www.advancedcustomfields.com/resources/including-acf-in-a-plugin-theme/
 */

// Define path and URL to the ACF plugin.
define( 'ACF_PATH', get_stylesheet_directory() . '/lib/advanced-custom-fields-pro/' );
define( 'ACF_URL', get_stylesheet_directory_uri() . '/lib/advanced-custom-fields-pro/' );
define( 'ACF_JSON_PATH', get_stylesheet_directory() . '/resources/acf-json/' );


add_filter( 'acf/settings/path', 'acf_settings_path' );
/**
 * 1. customize ACF path.
 *
 * @param string $path the path to the lib.
 * @return string
 */
function acf_settings_path( $path ) {
	return ACF_PATH;
}


add_filter( 'acf/settings/dir', 'acf_settings_dir' );
/**
 * 2. customize ACF dir.
 *
 * @param string $dir the directory.
 * @return string
 */
function acf_settings_dir( $dir ) {
	return ACF_URL;
}

// 3. Hide ACF field group menu item
// add_filter('acf/settings/show_admin', '__return_false');


add_filter( 'acf/settings/save_json', 'acf_json_save_point' );
/**
 * 4. Custom JSON saving dir
 *
 * @param string $path the custom options path.
 * @return string
 */
function acf_json_save_point( $path ) {
	return ACF_JSON_PATH;
}


add_filter( 'acf/settings/load_json', 'acf_json_load_point' );
/**
 * 5. Custom JSON loading dir
 *
 * @param array $paths Set the default options folder path.
 * @return array
 */
function acf_json_load_point( $paths ) {
	// remove original path (optional).
	unset( $paths[0] );

	// append path.
	$paths[] = ACF_JSON_PATH;
	return $paths;
}

add_action( 'acf/init', 'genese_init_acf' );
/**
 * Create options page on dashboard.
 *
 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
 */
function genese_init_acf() {

	// Set options pages.
	if ( function_exists( 'acf_add_options_page' ) ) {

		$menu_slug = 'genese-general-settings';

		// Principal page.
		$options_page = acf_add_options_page(array(
			'page_title' => __( 'Theme General Settings', 'genese' ),
			'menu_title' => __( 'Theme Settings', 'genese' ),
			'menu_slug'  => $menu_slug,
			'capability' => 'edit_posts',
			'redirect'   => true,
		));

		acf_add_options_sub_page(array(
			'page_title'  => __( 'General Settings', 'genese' ),
			'menu_title'  => __( 'General', 'genese' ),
			'parent_slug' => $menu_slug,
		));

		acf_add_options_sub_page(array(
			'page_title'  => __( 'Contact & Informations', 'genese' ),
			'menu_title'  => __( 'Contact & Informations', 'genese' ),
			'parent_slug' => $menu_slug,
		));

	}
}

add_action('acf/init', 'genese_acf_init_block_types');
/**
 * Add custom ACF blocks type
 * @link https://www.advancedcustomfields.com/resources/blocks/
 */
function genese_acf_init_block_types() {

	// Check function exists.
	if( function_exists('acf_register_block_type') ) {

		// register a testimonial block.
		acf_register_block_type(array(
			'name'              => 'haiti-custom-heading',
			'title'             => __('Haiti Custom Heading', 'genese'),
			'description'       => __('A custom heading block for HH website theme.'),
			'render_template'   => get_stylesheet_directory() . '/template-parts/blocks/custom-heading.php',
			'category'          => 'layout',
			'icon'              => array(
				// Specifying a background color to appear with the icon e.g.: in the inserter.
				'background' => 'blue',
				// Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
				// 'foreground' => '#fff',
				// Specifying a dashicon for the block
				'src' => 'text',
			),
			'keywords'          => array( 'custom', 'heading', 'header', 'hero', 'title' ),
		));
	}
}

