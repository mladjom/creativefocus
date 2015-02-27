<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package creativefocus
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    /**
     * @hooked creativefocus_page_header - 10
     * @hooked creativefocus_page_content - 20
     * @hooked creativefocus_page_footer - 30
     */
    do_action('creativefocus_page');
    ?>

</article><!-- #post-## -->
