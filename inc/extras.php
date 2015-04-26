<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package creativefocus
 */

/**
 * Check whether the Creativefocus Customizer settings ar enabled
 * @return boolean
 * @since  1.0.3
 */
function creativefocus_customizer_enabled() {
    return apply_filters('creativefocus_customizer_enabled', true);
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function creativefocus_body_classes($classes) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }
    // Dev
    $classes[] = 'debug';

    return $classes;
}

add_filter('body_class', 'creativefocus_body_classes');

if (version_compare($GLOBALS['wp_version'], '4.1', '<')) :

    /**
     * Filters wp_title to print a neat <title> tag based on what is being viewed.
     *
     * @param string $title Default title text for current view.
     * @param string $sep Optional separator.
     * @return string The filtered title.
     */
    function creativefocus_wp_title($title, $sep) {
        if (is_feed()) {
            return $title;
        }

        global $page, $paged;

        // Add the blog name
        $title .= get_bloginfo('name', 'display');

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && ( is_home() || is_front_page() )) {
            $title .= " $sep $site_description";
        }

        // Add a page number if necessary:
        if (( $paged >= 2 || $page >= 2 ) && !is_404()) {
            $title .= " $sep " . sprintf(__('Page %s', 'creativefocus'), max($paged, $page));
        }

        return $title;
    }

    add_filter('wp_title', 'creativefocus_wp_title', 10, 2);

    /**
     * Title shim for sites older than WordPress 4.1.
     *
     * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
     * @todo Remove this function when WordPress 4.3 is released.
     */
    function creativefocus_render_title() {
        ?>
        <title><?php wp_title('|', true, 'right'); ?></title>
        <?php
    }

    add_action('wp_head', 'creativefocus_render_title');
endif;

/**
 * Schema type
 * @return string schema itemprop type
 */
function creativefocus_html_tag_schema() {
	$schema 	= 'http://schema.org/';
	$type 		= 'WebPage';

	// Is single post
	if ( is_singular( 'post' ) ) {
		$type 	= 'Article';
	}

	// Is author page
	elseif ( is_author() ) {
		$type 	= 'ProfilePage';
	}

	// Is search results page
	elseif ( is_search() ) {
		$type 	= 'SearchResultsPage';
	}

	echo 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"';
}