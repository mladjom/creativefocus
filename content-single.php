<?php
/**
 * @package creativefocus
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    /**
     * @hooked creativefocus_post_header - 10
     * @hooked creativefocus_post_content - 20
     * @hooked creativefocus_post_meta - 30
     */
    do_action('creativefocus_single_post');
    ?>

</article><!-- #post-## -->
