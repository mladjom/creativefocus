<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package creativefocus
 */
?>
		</div><!-- .col-full -->
	</div><!-- #content -->
	<?php do_action( 'creativefocus_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full">
                    <hr>
                    <?php
			/**
			 * @hooked creativefocus_credit - 10
			 */
			do_action( 'creativefocus_footer' ); ?>

		</div><!-- .col-full -->
	</footer><!-- #colophon -->
        
        <?php do_action( 'creativefocus_after_footer' ); ?>

    </div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
