<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package creativefocus
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php creativefocus_html_tag_schema(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">
            <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'creativefocus'); ?></a>
            <header id="masthead" class="site-header" role="banner">
                <div class="col-full">
     			<?php
			/**
			 * @hooked creativefocus_site_branding - 10
			 * @hooked creativefocus_primary_navigation - 20
			 * @hooked creativefocus_search - 30
			 */
			do_action( 'creativefocus_header' ); ?>               
                </div>
            </header><!-- #masthead -->
	<?php
	/**
	 * @hooked creativefocus_header_region - 10
	 */
	do_action( 'creativefocus_before_content' ); ?>
            <div id="content" class="site-content">
                <div class="col-full">
