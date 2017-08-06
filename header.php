<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * It includes the header, navigation and menu widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package carbon-lite
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content">
		<span><?php esc_html_e( 'Skip to content', 'carbon-lite' ); ?></span>
		<span data-icon="ei-arrow-right"></span>
	</a>

	<header id="masthead" class="site-header" role="banner">
		
		<?php carbon_lite_header_title(); ?>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			
			<?php the_custom_logo(); ?>
			
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span data-icon="ei-navicon"></span>
				<?php esc_html_e( 'Menu', 'carbon-lite' ); ?>
			</button>

			<div class="menu-wrapper">
				<header class="menu-header">
                    <h2 class="menu-title"><?php esc_html_e( 'Menu', 'carbon-lite' ); ?></h2>
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span data-icon="ei-close"></span>
                        <span class="screen-reader-text"><?php esc_html_x( 'Close', 'Menu close button', 'carbon-lite' ); ?></span>
                    </button>
                </header>
				
				<?php 
					if ( get_theme_mod( 'carbon_lite_show_search', '1' ) ){
						get_search_form(); 
					}
				?>
				
				<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_class' => 'primary-menu', 'container' => 'ul' ) ); ?>

				<?php wp_nav_menu( array( 'theme_location' => 'menu-2', 'menu_class' => 'social-icons', 'container' => 'ul', 'link_before' => '<span data-icon="">', 'link_after' => '</span>', ) ); ?>

				<?php get_sidebar( 'menu' ); ?>
				
			</div>
		</nav><!-- #site-navigation -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
