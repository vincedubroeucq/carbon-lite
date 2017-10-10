<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package carbon-lite
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		
		<?php get_sidebar( 'footer' ); ?>
		
		<div class="footer-wrapper" role="contentinfo">

			<?php carbon_lite_footer_credits(); ?>
			<?php 
				if ( has_nav_menu( 'menu-3' ) ){
					wp_nav_menu( array( 
						'theme_location' => 'menu-3', 
						'menu_class' => 'social-icons', 
						'container' => 'ul',
						'link_before' => '<span data-icon="">', // this <span> element is going to receive a data-icon attribute later.
						'link_after' => '</span>',
					) ); 
				} 
			?>

		</div><!-- .footer-wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
