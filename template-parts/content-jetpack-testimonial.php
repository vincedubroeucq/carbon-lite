<?php
/**
 * Template part for displaying JetPack portfolio archive results
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package carbon-lite
 */
?>

<blockquote id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          
    <?php carbon_lite_thumbnail( 'thumbnail' ); ?>

    <div class="jetpack-testimonial-content">
        <?php the_content(); ?>
        <cite><?php the_title(); ?></cite>
    </div><!-- .entry-content -->
	
</blockquote><!-- #post-## -->
