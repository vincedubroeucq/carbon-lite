<?php
/**
 * The sidebar containing the menu widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package carbon-lite
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<aside id="menu-widget-area" class="menu-widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Menu widget area', 'carbon-lite' ); ?>">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside><!-- #secondary -->
