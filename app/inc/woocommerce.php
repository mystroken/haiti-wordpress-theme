<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Genese
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function genese_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'genese_woocommerce_setup' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function genese_woocommerce_scripts() {
	 wp_enqueue_style(
	 	'genese-woocommerce-style',
		get_template_directory_uri() . '/assets/dist/css/woocommerce.css',
		array()
	 );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	// wp_add_inline_style( 'genese-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'genese_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function genese_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'genese_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function genese_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'genese_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'genese_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function genese_woocommerce_wrapper_before() {
		?>
			<!-- <main id="primary" class="site-main"> -->
		<?php
	}
}
// add_action( 'woocommerce_before_main_content', 'genese_woocommerce_wrapper_before' );

if ( ! function_exists( 'genese_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function genese_woocommerce_wrapper_after() {
		?>
			<!-- </main> -->
		<?php
	}
}
// add_action( 'woocommerce_after_main_content', 'genese_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 */

if ( ! function_exists( 'genese_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function genese_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		genese_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'genese_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'genese_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function genese_woocommerce_cart_link() {
		$cart_count = WC()->cart->get_cart_contents_count() >= 10 ?
			'9+' :
			WC()->cart->get_cart_contents_count();
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'genese' ); ?>">
			<span class="label">
				<span class="label__icon">
					<svg xmlns="http://www.w3.org/2000/svg" width="14.452" height="16" viewBox="0 0 14.452 16">
						<g transform="translate(-1 -0.5)">
							<path d="M14.419,5.042H2.032v9.375a1.037,1.037,0,0,0,1.032,1.042H13.387a1.037,1.037,0,0,0,1.032-1.042ZM1,4V14.417A2.074,2.074,0,0,0,3.065,16.5H13.387a2.074,2.074,0,0,0,2.065-2.083V4Z" transform="translate(0 0)" fill-rule="evenodd"/>
							<path d="M8,1.5A2.5,2.5,0,0,0,5.5,4h-1a3.5,3.5,0,1,1,7,0h-1A2.5,2.5,0,0,0,8,1.5Z" transform="translate(0.226)"/>
						</g>
					</svg>
				</span>
				<span class="label__text"><?php esc_html_e( 'Cart', 'genese' ); ?></span>
			</span>
			<span class="count"><?php echo wp_kses_data( $cart_count ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'genese_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function genese_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php genese_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

/**
 * Remove Add to cart button into loop.
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
