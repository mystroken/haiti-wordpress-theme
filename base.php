<?php
/**
 * Theme Wrapper.
 *
 * The goal of the theme wrapper is to
 * remove any repeated markup from individual template.
 *
 * @see https://roots.io/sage/docs/theme-templates/
 *
 * @package Genese
 * @subpackage Base_Template
 * @since 1.0.0
 * @author Mystro Ken <mystroken@gmail.com>
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="app" class="has-announcement" role="document" itemscope itemtype="http://schema.org/WebPage">

	<section id="app-header" class="app-header">
		<?php get_header(); ?>
	</section>

	<section id="app-content" class="app-content">
		<main id="main" class="main" role="main" itemprop="mainContentOfPage">
			<div id="content" class="content">
				<?php

					/*
					* Get the right WordPress template file.
					*/
					require genese_template_path();
					?>
			</div>
		</main>
		<?php get_footer(); ?>
	</section>

</div>
<div id="loader"></div>
<noscript><div class="issue-js"><?php echo __('Please enable JavaScript to view this website.', 'genese'); ?></div></noscript>

<?php wp_footer(); ?>
</body>
</html>
