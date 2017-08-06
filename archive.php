<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package carbon-lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'archive' );

			endwhile;

			the_posts_navigation( array(
				'prev_text' => '<span data-icon="ei-arrow-left"></span><span>' . __( 'Older posts', 'carbon-lite' ) . '</span>',
				'next_text' => '<span>' . __( 'Newer posts', 'carbon-lite' ) . '</span><span data-icon="ei-arrow-right"></span>',
			) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
