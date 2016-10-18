<?php
/**
 * Template functions used for posts.
 *
 * @package creativefocus
 */
if (!function_exists('creativefocus_post_header')) {

    /**
     * Display the post header with a link to the single post
     * @since 1.0.0
     */
    function creativefocus_post_header() {
        ?>

        <header class="entry-header">
            <?php if (is_single()) { ?>
                <?php
                creativefocus_posted_on();
                the_title('<h1 class="entry-title" itemprop="name headline">', '</h1>');
            } else {
                ?>
                <?php
                if ('post' == get_post_type()) {
                    creativefocus_posted_on();
                }
                the_title(sprintf('<h2 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
            }
            ?>
        </header><!-- .entry-header -->
        <?php
    }

}
if (!function_exists('creativefocus_post_meta')) {

    /**
     * Display the post meta
     * @since 1.0.0
     */
    function creativefocus_post_meta() {
        ?>
        <aside class="entry-meta">
            <?php if ('post' == get_post_type() && is_single()) : // Hide category and tag text for pages on Search  ?>
                <?php
                /* translators: used between list items, there is a space after the comma */
                $categories_list = get_the_category_list(__(', ', 'creativefocus'));

                if ($categories_list && creativefocus_categorized_blog()) :
                    ?>
                    <span class="cat-links"><?php echo wp_kses_post($categories_list); ?></span>
                <?php endif; // End if categories   ?>

                <?php
                /* translators: used between list items, there is a space after the comma */
                $tags_list = get_the_tag_list('', __(', ', 'creativefocus'));

                if ($tags_list) :
                    ?>
                    <span class="tags-links"><?php echo wp_kses_post($tags_list); ?></span>
                <?php endif; // End if $tags_list  ?>

            <?php endif; // End if 'post' == get_post_type()  ?>

            <?php if (!post_password_required() && ( comments_open() || '0' != get_comments_number() )) : ?>
                <span class="comments-link"><?php comments_popup_link(__('Leave a comment', 'creativefocus'), __('1 Comment', 'creativefocus'), __('% Comments', 'creativefocus')); ?></span>
            <?php endif; ?>

            <?php edit_post_link(__('Edit', 'creativefocus'), '<span class="edit-link">', '</span>'); ?>
        </aside>
        <?php
    }

}

if (!function_exists('creativefocus_post_content')) {

    /**
     * Display the post content with a link to the single post
     * @since 1.0.0
     */
    function creativefocus_post_content() {
        ?>
        <div class="entry-content" itemprop="articleBody">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('post-thumbnail', array('itemprop' => 'image', 'alt' => get_the_title()));
            }
            ?>
            <?php the_excerpt(); ?>
        </div><!-- .entry-content -->
        <?php
    }

}
if (!function_exists('creativefocus_single_post_content')) {

    /**
     * Display the post content with a link to the single post
     * @since 1.0.0
     */
    function creativefocus_single_post_content() {
        ?>
        <div class="entry-content" itemprop="articleBody">
            <?php the_content(); ?>
            <?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . __('Pages:', 'creativefocus'),
                'after' => '</div>',
            ));
            ?>

        </div><!-- .entry-content -->
        <hr>
        <?php
    }

}
if (!function_exists('creativefocus_post_nav')) {

    /**
     * Display navigation to next/previous post when applicable.
     */
    function creativefocus_post_nav() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
        $next = get_adjacent_post(false, '', false);

        if (!$next && !$previous) {
            return;
        }
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php _e('Post navigation', 'creativefocus'); ?></h1>
            <div class="nav-links">
                <?php
                previous_post_link('<div class="nav-previous">%link</div>', _x('<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'creativefocus'));
                next_post_link('<div class="nav-next">%link</div>', _x('%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link', 'creativefocus'));
                ?>
            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
        <?php
    }

}

if (!function_exists('creativefocus_posted_on')) {

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function creativefocus_posted_on() {
        ?>
        <div class="entry-meta">
            <?php
            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if (get_the_time('U') !== get_the_modified_time('U')) {
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $time_string = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date())
            );

            $posted_on = sprintf(
                    _x('Posted on %s', 'post date', 'creativefocus'), '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
            );

            $byline = sprintf(
                    _x('by %s', 'post author', 'creativefocus'), '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
            );

            echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';
            ?>
        </div>
        <?php
    }

}

if (!function_exists('creativefocus_paging_nav')) {

    function creativefocus_paging_nav() {

        // Previous/next page navigation.
        the_posts_pagination(array(
            'prev_text' => __('Previous', 'creativefocus'),
            'next_text' => __('Next', 'creativefocus'),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'creativefocus') . ' </span>',
        ));
    }

}
    