<?php
/**
 * Template part for displaying archive results
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package carbon-lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">

        <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
 
        <div class="entry-meta">
            <?php carbon_lite_entry_meta(); 
                  carbon_lite_edit_post_link(); ?>
        </div><!-- .entry-meta -->

    </header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
	
</article><!-- #post-## -->
