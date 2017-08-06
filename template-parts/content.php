<?php
/**
 * Template part for displaying post content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package carbon-lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (  ! is_singular() ) : ?>
		<header class="entry-header">
			
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

			<div class="entry-meta">
				<?php carbon_lite_entry_meta(); 
					  carbon_lite_edit_post_link(); ?>
			</div><!-- .entry-meta -->

		</header><!-- .entry-header -->
	<?php endif; ?>

	<?php carbon_lite_thumbnail(); ?>

	<div class="entry-content">
		<?php
			the_content();

			if ( is_singular() ){
				wp_link_pages( array(
					'before' => '<nav class="page-links">' . esc_html__( 'Pages:', 'carbon-lite' ),
					'after'  => '</nav>',
					'link_before' => '<span>',
					'link_after' => '</span>',
				) );
			}	
		?>
	</div><!-- .entry-content -->

	<?php if (  ! is_single() ) : ?>
		<footer class="entry-footer">
			<?php carbon_lite_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
	
</article><!-- #post-## -->
