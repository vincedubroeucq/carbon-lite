<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package carbon-lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content' );

			endwhile;

			the_posts_navigation( array(
				'prev_text' => '<span aria-hidden="true"><span data-icon="ei-arrow-left"></span></span><span>' . __( 'Older posts', 'carbon-lite' ) . '</span>',
				'next_text' => '<span>' . __( 'Newer posts', 'carbon-lite' ) . '</span><span aria-hidden="true"><span data-icon="ei-arrow-right"></span></span>',
			) );
			
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
