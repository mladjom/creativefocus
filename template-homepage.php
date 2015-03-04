<?php
/**
 * The template for displaying the homepage.
 *
 * Template name: Homepage
 *
 * @package creativefocus
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/**
			 * @hooked creativefocus_homepage_content - 10
			 */
			do_action( 'homepage' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
