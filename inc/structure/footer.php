<?php
/**
 * Template functions used for the site footer.
 *
 * @package storefront
 */

if ( ! function_exists( 'creativefocus_credit' ) ) {
	/**
	 * Display the theme credit
	 * @since  1.0.0
	 * @return void
	 */
	function creativefocus_credit() {
		?>
		<div class="site-info">
			<?php echo esc_html( apply_filters( 'creativefocus_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' 2006 - ' . date( 'Y' ) ) ); ?>
			<?php if ( apply_filters( 'creativefocus_credit_link', true ) ) { ?>
			<?php } ?>
		</div><!-- .site-info -->
		<?php
	}
}
