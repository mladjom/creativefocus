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
	function creativefocus_site_branding()
	{
		?>
		<div class="site-branding">
		<?php
		if (function_exists('the_custom_logo') && has_custom_logo()) :
			the_custom_logo();
		 else :
			if (is_front_page() && is_home()) : ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
				</h1>
			<?php else : ?>
				<p class="site-title">
					<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
				</p>
			<?php endif;
			$description = get_bloginfo('description', 'display');
			if ($description || is_customize_preview()) : ?>
				<p class="site-description"><?php echo $description; ?></p>
			<?php endif;
		endif;
		?>
		</div><!-- .site-branding -->
	<?php
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
        <nav id="site-navigation" class="main-navigation" role="navigation">
	        <button class="menu-toggle"></button>
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
        <div id="search-container" class="search-box-wrapper">
	        <button class="menu-toggle"></button>
	        <div class="search-box">
                <?php get_search_form(); ?>
            </div>
        </div>
        <?php
    }

}
