<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package carbon-lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php carbon_lite_thumbnail(); ?>
	
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<nav class="page-links">' . esc_html__( 'Pages:', 'carbon-lite' ),
				'after'  => '</nav>',
				'link_before' => '<span>',
				'link_after' => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php carbon_lite_edit_post_link(); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
	
</article><!-- #post-## -->
