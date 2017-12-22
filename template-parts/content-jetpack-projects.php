<?php
/**
 * Template part for displaying JetPack portfolio archive results
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package carbon-lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php carbon_lite_thumbnail( 'carbon-lite-jetpack-portfolio-thumbnail' ); ?>
    
    <div class="jetpack-portfolio-entry">
        
        <header class="entry-header jetpack-portfolio-entry-header">
        
            <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
        
            <div class="entry-meta">
                <?php carbon_lite_jetpack_portfolio_meta(); 
                      carbon_lite_edit_post_link(); ?>
            </div><!-- .entry-meta -->
        
        </header><!-- .entry-header -->

        <div class="entry-content jetpack-portfolio-entry-content">
            <?php the_excerpt(); ?>
        </div><!-- .entry-content -->

    </div>
	
</article><!-- #post-## -->
