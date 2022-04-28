<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = '';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$text = get_field('testimonial') ?: 'Your testimonial here...';
$author = get_field('author') ?: 'Author name';
$role = get_field('role') ?: 'Author role';
$image = get_field('image') ?: 295;
$background_color = get_field('background_color');
$text_color = get_field('text_color');

if (have_rows('lines')):
?>

<h1 id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<?php while (have_rows('lines')): the_row(); ?>
		<span><?php the_sub_field('content'); ?></span>
	<?php endwhile; ?>
	<style type="text/css">
		#<?php echo $id; ?> {
			background: <?php echo $background_color; ?>;
			color: <?php echo $text_color; ?>;
		}
	</style>
</h1>

<?php
endif;
