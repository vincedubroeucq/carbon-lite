<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package carbon-lite
 */

?>

<section class="no-results not-found">
	
	<header class="entry-header">
		<h2 class="entry-title"><?php esc_html_e( 'Nothing Found !', 'carbon-lite' ); ?></h2>
	</header><!-- .page-header -->

	<div class="entry-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php esc_html_e( 'Ready to publish your first post?' , 'carbon-lite'); ?></p>
			<p>
				<a class="button" href="<?php esc_url( admin_url( 'post-new.php' ) ); ?>">
					<?php esc_html_e( 'Get started here !', 'carbon-lite' ); ?>
				</a>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'carbon-lite' ); ?></p>
			<?php
				get_search_form();

		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'carbon-lite' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div><!-- .entry-content -->
</section><!-- .not-found -->
