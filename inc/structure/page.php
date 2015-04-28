<?php
/**
 * Template functions used for pages.
 *
 * @package creativefocus
 */
if (!function_exists('creativefocus_page_header')) {

    /**
     * Display the post header with a link to the single post
     * @since 1.0.0
     */
    function creativefocus_page_header() {
        ?>
        <header class="page-header">
            <?php the_title('<h1 class="entry-title" itemprop="name">', '</h1>'); ?>
        </header><!-- .entry-header -->
        <?php
    }

}

if (!function_exists('creativefocus_page_content')) {

    /**
     * Display the post content with a link to the single post
     * @since 1.0.0
     */
    function creativefocus_page_content() {
        ?>
        <div class="entry-content" itemprop="mainContentOfPage">
            <?php
            if (has_post_thumbnail()) {
                echo '<figure class="aligncenter">';
                the_post_thumbnail('post-thumbnail', array('itemprop' => 'image', 'alt' => get_the_title()));
                echo '</figure>';
            }
            ?>
            <?php the_content(); ?>
            <?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . __('Pages:', 'creativefocus'),
                'after' => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->

        <?php
    }

}

if (!function_exists('creativefocus_page_footer')) {

    /**
     * Display the post content with a link to the single post
     * @since 1.0.0
     */
    function creativefocus_page_footer() {
        ?>
        <footer class="entry-footer">
            <?php edit_post_link(__('Edit', 'creativefocus'), '<span class="edit-link">', '</span>'); ?>
        </footer><!-- .entry-footer -->

        <?php
    }

}
