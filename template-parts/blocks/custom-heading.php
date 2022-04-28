<?php

/**
 * Custom Heading Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute
// allowing for custom "anchor" value.
$id = !empty($block['anchor'])
		? $block['anchor']
		: 'custom-heading-' . $block['id'];

// Create class attribute allowing
// for custom "className" and "align" values.
$className = 'custom-heading';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

if ( have_rows('custom-heading-rows') ): ?>

<h1 id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<?php
        while (have_rows('custom-heading-rows')):
            the_row();
            $rowClassName = '';
    ?>
		<?php the_sub_field('content'); ?>
	<?php endwhile; ?>
</h1>

<?php
endif;
