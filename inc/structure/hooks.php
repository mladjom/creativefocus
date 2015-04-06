<?php

/**
 * creativefocus hooks
 *
 * @package creativefocus
 */
/**
 * General
 * @see  creativefocus_setup()
 * @see  creativefocus_widgets_init()
 * @see  creativefocus_scripts()
 * @see  creativefocus_header_widget_region()
 * @see  creativefocus_get_sidebar()
 */
add_action('after_setup_theme', 'creativefocus_setup');
add_action('widgets_init', 'creativefocus_widgets_init');
add_action('wp_enqueue_scripts', 'creativefocus_scripts', 10);
add_action('creativefocus_sidebar', 'creativefocus_get_sidebar', 10);

/**
 * Header
 * @hooked creativefocus_site_branding - 10
 * @hooked creativefocus_primary_navigation - 20
 * @hooked creativefocus_search - 40
 */
add_action('creativefocus_header', 'creativefocus_site_branding', 10);
add_action('creativefocus_header', 'creativefocus_primary_navigation', 20);
add_action('creativefocus_header', 'creativefocus_search', 30);
/**
 * Footer
 * @see  creativefocus_credit()
 */
add_action('creativefocus_footer', 'creativefocus_credit', 10);

/**
 * Homepage
 * @see  creativefocus_homepage_content()
 */
add_action('homepage', 'creativefocus_homepage_content', 10);


/**
 * Posts
 * @see  creativefocus_post_header()
 * @see  creativefocus_post_meta()
 * @see  creativefocus_post_content()
 * @see  creativefocus_paging_nav()
 * @see  creativefocus_single_post_header()
 * @see  creativefocus_post_nav()
 * @see  creativefocus_display_comments()
 */
add_action('creativefocus_loop_post', 'creativefocus_post_header', 10);
add_action('creativefocus_loop_post', 'creativefocus_post_meta', 20);
add_action('creativefocus_loop_post', 'creativefocus_post_content', 30);
add_action('creativefocus_loop_after', 'creativefocus_paging_nav', 10);

add_action('creativefocus_single_post', 'creativefocus_post_header', 10);
add_action('creativefocus_single_post', 'creativefocus_single_post_content', 20);
add_action('creativefocus_single_post', 'creativefocus_post_meta', 30);
add_action('creativefocus_single_post_after', 'creativefocus_post_nav', 10);
add_action('creativefocus_single_post_after', 'creativefocus_display_comments', 20);
add_action('creativefocus_comments_before', 'creativefocus_comments_nav', 10);
add_action('creativefocus_comments_after', 'creativefocus_comments_nav', 10);

/**
 * Pages
 * @see  creativefocus_page_header()
 * @see  creativefocus_page_content()
 * @see  creativefocus_page_footer()
 * @see  creativefocus_display_comments()
 */
add_action('creativefocus_page', 'creativefocus_page_header', 10);
add_action('creativefocus_page', 'creativefocus_page_content', 20);
add_action('creativefocus_page', 'creativefocus_page_footer', 30);
add_action('creativefcus_page_after', 'creativefocus_display_comments', 10);
