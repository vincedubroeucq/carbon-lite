<?php
/**
 * The sidebar containing the footer widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package carbon-lite
 */

if ( ! is_active_sidebar( 'sidebar-3' ) ) {
	return;
}
?>

<aside id="footer-widget-area" class="footer-widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Footer widget area', 'carbon-lite' ); ?>">
	<div class="footer-widgets">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</div>
</aside><!-- #secondary -->
