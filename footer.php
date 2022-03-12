<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Genese
 */

?>

<footer id="footer" class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
	<div class="footer__inner">
		<nav id="footer-nav" class="footer-navigation" role="navigation" aria-label="<?php esc_html_e( 'Footer Navigation', 'genese' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'footer',
						'container' => '',
					)
				);
				?>
		</nav>
		<div class="footer__info">
			Copyright &copy; <span itemprop="copyrightYear">2020</span>
			<span itemprop="copyrightHolder" itemscope itemtype="http://schema.org/Person">
				<span itemprop="name">MR AFROPOLITAN</span>
			</span>
			<span class="sep"> - </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Site designed by %1$s', 'genese' ), '<a href="https://www.flexyla.com" target="_blank">FlexyLa Studio</a>' );
			?>
		</div>
	</div>
</footer>
