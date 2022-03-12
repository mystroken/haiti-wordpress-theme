<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Genese
 */

?>
<div class="announcement-bar">
	<div class="announcement-bar__inner">
		<a class="announcement-bar__link" href="/boutique" >
			<?php _e( 'Worldwide delivery 🌍', 'genese' ); ?>
		</a>
	</div>
</div>
<header id="header" class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
	<div class="header__wrapper">
		<div class="header__wrapper__left">
			<div class="hamburger-wrapper">
				<button id="hamburgerToggle" type="button" class="hamburger" aria-label="<?php esc_html_e( 'Hamburger', 'genese' ); ?>">
					<span class="hamburger-box">
						<span class="line line--1"></span>
						<span class="line line--2"></span>
					</span>
				</button>
			</div>
			<nav id="primary-nav" class="primary-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'genese' ); ?>">
				<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container' => '',
						)
					);
				?>
			</nav>
		</div>
		<div class="header__wrapper__center">
			<?php
			if ( has_custom_logo() ) {
				?>
				<div class="header__logo">
					<?php the_custom_logo(); ?>
				</div>
			<?php } else { ?>
				<a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
			<?php } ?>
		</div>
		<div class="header__wrapper__right">
			<?php
				if ( function_exists( 'genese_woocommerce_header_cart' ) ) {
					genese_woocommerce_header_cart();
				}
			?>
		</div>
	</div>
</header>
<?php
if ( has_nav_menu( 'handheld' ) ) {
	?>
	<nav id="handheld-nav" class="handheld-navigation" role="navigation" aria-label="<?php esc_html_e( 'Handheld Navigation', 'genese' ); ?>">
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'handheld',
					'container'    => '',
				)
			);
		?>
	</nav>
<?php
}
