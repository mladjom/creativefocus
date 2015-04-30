<?php

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package creativefocus
 */
if (!function_exists('creativefocus_get_sidebar')) {

    /**
     * Display creativefocus sidebar
     * @uses get_sidebar()
     * @since 1.0.0
     */
    function creativefocus_get_sidebar() {
        get_sidebar();
    }

}
if (!function_exists('creativefocus_homepage_content')) {

    /**
     * Display homepage content
     * Hooked into the `homepage` action in the homepage template
     * @since  1.0.0
     * @return  void
     */
    function creativefocus_homepage_content() {
        while (have_posts()) : the_post();

            get_template_part('content', 'page');

        endwhile; // end of the loop.
    }

}

if (!function_exists('creativefocus_excerpt_more')) :

    /**
     * Replaces "[...]" (appended to automatically generated excerpts) with ...
     * and a Continue reading link.
     *
     * @since  1.0.5
     *
     * @param string $more Default Read More excerpt link.
     * @return string Filtered Read More excerpt link.
     */
    function creativefocus_excerpt_more( $more ) {
    
	$link = sprintf( '<br><a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading %s ', 'creativefocus' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return $link;
    }

    add_filter('excerpt_more', 'creativefocus_excerpt_more');
    
endif;

if (!function_exists('the_archive_title')) :

    /**
     * Shim for `the_archive_title()`.
     *
     * Display the archive title based on the queried object.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     *
     * @param string $before Optional. Content to prepend to the title. Default empty.
     * @param string $after  Optional. Content to append to the title. Default empty.
     */
    function the_archive_title($before = '', $after = '') {
        if (is_home()) {
            $title = apply_filters('the_title', get_the_title(get_option('page_for_posts')));
        } elseif (is_category()) {
            $title = sprintf(__('Category: %s', 'creativefocus'), single_cat_title('', false));
        } elseif (is_tag()) {
            $title = sprintf(__('Tag: %s', 'creativefocus'), single_tag_title('', false));
        } elseif (is_author()) {
            $title = sprintf(__('Author: %s', 'creativefocus'), '<span class="vcard">' . get_the_author() . '</span>');
        } elseif (is_year()) {
            $title = sprintf(__('Year: %s', 'creativefocus'), get_the_date(_x('Y', 'yearly archives date format', 'creativefocus')));
        } elseif (is_month()) {
            $title = sprintf(__('Month: %s', 'creativefocus'), get_the_date(_x('F Y', 'monthly archives date format', 'creativefocus')));
        } elseif (is_day()) {
            $title = sprintf(__('Day: %s', 'creativefocus'), get_the_date(_x('F j, Y', 'daily archives date format', 'creativefocus')));
        } elseif (is_tax('post_format')) {
            if (is_tax('post_format', 'post-format-aside')) {
                $title = _x('Asides', 'post format archive title', 'creativefocus');
            } elseif (is_tax('post_format', 'post-format-gallery')) {
                $title = _x('Galleries', 'post format archive title', 'creativefocus');
            } elseif (is_tax('post_format', 'post-format-image')) {
                $title = _x('Images', 'post format archive title', 'creativefocus');
            } elseif (is_tax('post_format', 'post-format-video')) {
                $title = _x('Videos', 'post format archive title', 'creativefocus');
            } elseif (is_tax('post_format', 'post-format-quote')) {
                $title = _x('Quotes', 'post format archive title', 'creativefocus');
            } elseif (is_tax('post_format', 'post-format-link')) {
                $title = _x('Links', 'post format archive title', 'creativefocus');
            } elseif (is_tax('post_format', 'post-format-status')) {
                $title = _x('Statuses', 'post format archive title', 'creativefocus');
            } elseif (is_tax('post_format', 'post-format-audio')) {
                $title = _x('Audio', 'post format archive title', 'creativefocus');
            } elseif (is_tax('post_format', 'post-format-chat')) {
                $title = _x('Chats', 'post format archive title', 'creativefocus');
            }
        } elseif (is_post_type_archive()) {
            $title = sprintf(__('Archives: %s', 'creativefocus'), post_type_archive_title('', false));
        } elseif (is_tax()) {
            $tax = get_taxonomy(get_queried_object()->taxonomy);
            /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
            $title = sprintf(__('%1$s: %2$s', 'creativefocus'), $tax->labels->singular_name, single_term_title('', false));
        } else {
            $title = __('Archives', 'creativefocus');
        }

        /**
         * Filter the archive title.
         *
         * @param string $title Archive title to be displayed.
         */
        $title = apply_filters('get_the_archive_title', $title);

        if (!empty($title)) {
            echo $before . $title . $after;
        }
    }

endif;

if (!function_exists('the_archive_description')) :

    /**
     * Shim for `the_archive_description()`.
     *
     * Display category, tag, or term description.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     *
     * @param string $before Optional. Content to prepend to the description. Default empty.
     * @param string $after  Optional. Content to append to the description. Default empty.
     */
    function the_archive_description($before = '', $after = '') {
        $description = apply_filters('get_the_archive_description', term_description());

        if (!empty($description)) {
            /**
             * Filter the archive description.
             *
             * @see term_description()
             *
             * @param string $description Archive description to be displayed.
             */
            echo $before . $description . $after;
        }
    }

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function creativefocus_categorized_blog() {
    if (false === ( $all_the_cool_cats = get_transient('creativefocus_categories') )) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields' => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number' => 2,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('creativefocus_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so creativefocus_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so creativefocus_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in creativefocus_categorized_blog.
 */
function creativefocus_category_transient_flusher() {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('creativefocus_categories');
}

add_action('edit_category', 'creativefocus_category_transient_flusher');
add_action('save_post', 'creativefocus_category_transient_flusher');
