<?php
/**
 * Template functions used for the site header.
 *
 * @package creativefocus
 */
if (!function_exists('creativefocus_site_branding')) {

    /**
     * Display Site Branding
     * @since  1.0.0
     * @return void
     */
    function creativefocus_site_branding() {
        if (function_exists('jetpack_has_site_logo') && jetpack_has_site_logo()) {
            jetpack_the_site_logo();
        } else {
            ?>
            <div class="site-branding">
                <?php if (is_home() && is_front_page()) : ?>
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                <?php else: ?>
                    <span class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></span>
                <?php endif; ?>
                <p class="site-description"><?php bloginfo('description'); ?></p>
            </div><!-- .site-branding -->
            <?php
        }
    }

}

if (!function_exists('creativefocus_primary_navigation')) {

    /**
     * Display Primary Navigation
     * @since  1.0.0
     * @return void
     */
    function creativefocus_primary_navigation() {
        ?>
        <button class="menu-toggle" aria-controls="menu" aria-expanded="false"></button>
        <nav id="site-navigation" class="main-navigation" role="navigation">
            <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
        </nav><!-- #site-navigation -->
        <?php
    }

}

if (!function_exists('creativefocus_search')) {

    /**
     * Display Search
     * @since  1.0.0
     * @return void
     */
    function creativefocus_search() {
        ?>

        <div class="search-toggle">
            <button href="#search-container" class="screen-reader-text"><?php _e('Search', 'creativefocus'); ?></button>
        </div>
        <div id="search-container" class="search-box-wrapper hide">
            <div class="search-box">
                <?php get_search_form(); ?>
            </div>
        </div>
        <?php
    }

}
