<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package carbon-lite
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'carbon-lite' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2><!-- .comments-title -->

		<?php 
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
				the_comments_pagination( array( 'prev_next' => false, ) );
			} 
		?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 128,
					'callback' => 'carbon_lite_comment_callback',
					'short_ping' => true,
				) );
			?>
		</ul><!-- .comment-list -->

		<?php 
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
				the_comments_pagination( array( 'prev_next' => false, ) );
			} 
		
	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'carbon-lite' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
