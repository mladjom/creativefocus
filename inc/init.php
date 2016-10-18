<?php

/**
 * creativefocus engine room
 *
 * @package creativefocus
 */
/**
 * Setup.
 * Enqueue styles, register widget regions, etc.
 */
require get_template_directory() . '/inc/setup.php';

/**
  * Structure.
 * Template functions used throughout the theme.
 */
require get_template_directory() . '/inc/structure/hooks.php';
require get_template_directory() . '/inc/structure/post.php';
require get_template_directory() . '/inc/structure/header.php';
require get_template_directory() . '/inc/structure/footer.php';
require get_template_directory() . '/inc/structure/page.php';
require get_template_directory() . '/inc/structure/comments.php';
require get_template_directory() . '/inc/structure/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
if (creativefocus_customizer_enabled()) {
    require get_template_directory() . '/inc/customizer/customizer.php';
}
