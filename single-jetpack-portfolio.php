<?php
/**
 * The template for displaying single JetPack portfolio items
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package carbon-lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

            get_template_part( 'template-parts/content', 'jetpack-project' );
        
			the_post_navigation( array(
				'prev_text' => '<span aria-hidden="true"><span data-icon="ei-arrow-left"></span></span><span>%title</span>',
				'next_text' => '<span>%title</span><span aria-hidden="true"><span data-icon="ei-arrow-right"></span></span>',
			) );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
