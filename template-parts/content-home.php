<?php
/**
 * Template part for displaying post content on blog home page
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

	<?php
	$content_setting = get_theme_mod( 'carbon_lite_content_option', 'full-content' );

    // Hide thumbnail only if the content display setting is set to 'no-content'
    if( 'no-content' != $content_setting ) :
        carbon_lite_thumbnail();
    endif;
        
    // Display the content and footer only if the content display setting is not set on 'no-content'
    if( 'no-content' != $content_setting && 'title-thumb' != $content_setting ) : ?>
        
        <div class="entry-content">
            <?php carbon_lite_the_content( $content_setting ); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php carbon_lite_entry_footer(); ?>
        </footer><!-- .entry-footer -->

    <?php endif; ?>
	
</article><!-- #post-## -->
