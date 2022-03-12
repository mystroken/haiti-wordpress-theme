<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Genese
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="hero alignfull">
		<div class="hero__media">
			<video class="hero__video" autoplay muted loop>
				<source src="/wp-content/uploads/2020/12/mrafropolitan-cover-video-compressed-2.mp4" type="video/mp4">
			</video>
		</div>
		<div class="hero__content">
			<h1 class="hero__title">
				<span>Dress Good</span><br>
				<span>Fell Good</span><br>
				<span>Do Good</span>
			</h1>
		</div>
	</div>

	<?php
	genese_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'genese' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'genese' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</div><!-- #post-<?php the_ID(); ?> -->
