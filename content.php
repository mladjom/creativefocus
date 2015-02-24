<?php
/**
 * @package creativefocus
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">
    <?php
    /**
     * @hooked  creativefocus_post_header() - 10
     * @hooked  creativefocus_post_meta() - 20
     * @hooked  creativefocus_post_content() - 30
     */
    do_action('creativefocus_loop_post');
    ?>

</article><!-- #post-## -->