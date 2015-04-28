<?php
/**
 * Template functions used for the site footer.
 *
 * @package creativefocus
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
			<?php echo esc_html( apply_filters( 'creativefocus_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>
			<?php if ( apply_filters( 'creativefocus_credit_link', true ) ) { ?>
			<br /> 			
                            <?php printf( __( 'Theme: %1$s by %2$s.', 'creativefocus' ), 'creativefocus', '<a href="http://milentijevic.com/">Mladjo</a>' ); ?>

			<?php } ?>
		</div><!-- .site-info -->
		<?php
	}
}
