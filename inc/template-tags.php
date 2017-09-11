<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package carbon-lite
 */



if ( ! function_exists( 'carbon_lite_header_title' ) ) :
/**
 * Renders the header title HTML: 
 * - for the front page (blog or page) : display the site title and description
 * - for a single page : display the title only.
 * - for a single post : display title with metas.
 */
function carbon_lite_header_title(){

	if ( is_front_page() ): ?>

		<div class="header-info">
			<h1 class="header-title"><?php bloginfo( 'name' ); ?></h1>
			<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="header-description"><?php echo $description; ?></p>
				<?php endif; 
			?>
		</div><!-- .site-branding -->

	<?php elseif (  is_home() || is_page() ) : ?>
		
		<div class="header-info">
			<h1 class="header-title"><?php single_post_title(); ?></h1>
		</div><!-- .site-branding -->
		
	<?php elseif ( is_single() ) : ?>
		
		<div class="header-info">
			<h1 class="header-title"><?php the_title(); ?></h1>
			<p class="header-meta"><?php carbon_lite_entry_meta(); ?></p>
		</div><!-- .site-branding -->

	<?php elseif ( is_404() ) : ?>

		<div class="header-info">
			<h1 class="header-title"><?php esc_html_e( 'Oops! That\'s a 404 !', 'carbon-lite' ); ?></h1>
		</div><!-- .site-branding -->

	<?php elseif ( is_archive() ) : ?>

		<div class="header-info">
			<h1 class="header-title"><?php the_archive_title();?></h1>
			<p class="header-meta"><?php the_archive_description(); ?></p>
		</div><!-- .site-branding -->

	<?php elseif ( is_search() ) : ?>

		<div class="header-info">
			<h1 class="header-title"><?php printf( esc_html__( 'Search Results for: %s', 'carbon-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</div><!-- .site-branding -->

	<?php endif;
}
endif;



if (! function_exists( 'carbon_lite_the_custom_logo' ) ):
/**
 * Echoes the custom logo or a home link if the option is enabled in the customizer.
 */
function carbon_lite_the_custom_logo(){
	
	if( has_custom_logo() ){
		the_custom_logo();
	} else {
		if( get_theme_mod( 'carbon_lite_display_home_link', '1' ) ){
			$home_url = get_bloginfo( 'url' );
			?>
				<a href="<?php echo esc_url( $home_url ); ?>" class="home-link">
					<div class="icon home-icon"><svg class="icon__cnt" viewBox="0 0 32 32"><path d="M32 18.451l-16-12.42-16 12.42v-5.064l16-12.42 16 12.42zM28 18v12h-8v-8h-8v8h-8v-12l12-9z"></path></svg></div>
					<?php esc_html_e( 'Home', 'carbon-lite' ); ?>
				</a>
			<?php
		}
	}
	
}
endif;



if ( ! function_exists( 'carbon_lite_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function carbon_lite_entry_meta() {

	// Get the date of the post.
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	// Get the month archive link.
	$month_archive_link = get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) );

	// If the post has been updated, create another time string.
	$updated_on = '';
	
	if ( get_the_date() !== get_the_modified_date() ) {
		$update_time = '<time class="entry-date updated" datetime="%1$s">%2$s</time>';
		$update_time = sprintf( $update_time,
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$updated_on = sprintf(
			esc_html_x( ' (Updated on %s)', 'post update date', 'carbon-lite' ),
			'<a href="' . esc_url( $month_archive_link ) . '" rel="bookmark">' . $update_time . '</a>'
		);
	}

	// Build the post date meta display.
	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'carbon-lite' ),
		'<a href="' . esc_url( $month_archive_link ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	// Build the category meta display.
	$categories = '';

	$categories_list = get_the_category_list( esc_html__( ', ', 'carbon-lite' ) );
	if ( $categories_list && carbon_lite_categorized_blog() ) {
		$categories = sprintf( 
			esc_html_x( ' in %s', 'Category list', 'carbon-lite' ), 
			$categories_list 
		);
	}

	printf( '<span class="posted-on">%1$s %2$s %3$s</span>',
		$posted_on,
		$updated_on,
		$categories
	);

}
endif;



if ( ! function_exists( 'carbon_lite_edit_post_link' ) ) :
/*
 * Displays the edit post link in the entry header.
 */
function carbon_lite_edit_post_link(){

	$link_text = sprintf(
		/* translators: %s: Name of current post */
		esc_html__( 'Edit %s', 'carbon-lite' ),
		the_title( '<span class="screen-reader-text">"', '"</span>', false )
	);

	$link_text = '<span>' .$link_text . '</span><span data-icon="ei-pencil"></span>';

	edit_post_link( $link_text );
}
endif;




if ( ! function_exists( 'carbon_lite_thumbnail' ) ) :
/**
 * Echoes the thumbnail of the post or page, if any.
 */
function carbon_lite_thumbnail( $size = 'blog-thumbnail' ) {
	if ( has_post_thumbnail() ){
		echo '<picture class="thumbnail">' . get_the_post_thumbnail( null, $size ) . '</picture>';
	}
}
endif;




if ( ! function_exists( 'carbon_lite_the_content' ) ) :
/**
 * Displays the content of the post depending on the content display setting on the blog home page.
 */
function carbon_lite_the_content( $content_setting = 'full-content' ) {

	switch ( $content_setting ) {
		case 'no-content':
			return ;
			break;
		case 'excerpt':
			the_excerpt();
			break;
		default:
			the_content();
			break;
	}
}
endif;



if ( ! function_exists( 'carbon_lite_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function carbon_lite_entry_footer() {

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'carbon-lite' ) );
		if ( $tags_list ) {
			$html  = '<span class="tags-links">';
			$html .= '<span class="screen-reader-text">' . esc_html__( 'Tags: ', 'carbon-lite' ) . '</span>';
			$html .= '<span data-icon="ei-tag"></span>';
			$html .= $tags_list;
			$html .= '</span>';
			echo $html;
		}
	}

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(); 
		echo '<span data-icon="ei-comment"></span></span>';
	}

}
endif;



if ( ! function_exists( 'carbon_lite_footer_credits' ) ) :
/**
 * Prints the custom text in the footer, or the standard theme credits if left blank.
 */
function carbon_lite_footer_credits() {
	$footer_text = get_theme_mod( 'carbon_lite_footer_text' , '');

	if ( $footer_text ) :
		?>

			<div class="site-info">
				<?php echo $footer_text; ?>
			</div><!-- .site-info -->

		<?php else : ?>

			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'carbon-lite' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'carbon-lite' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( 
					esc_html__( 'Theme: %1$s by %2$s.', 'carbon-lite' ),
					wp_get_theme(),
					'<a href="' . wp_get_theme()->get( 'AuthorURI' ) . '" rel="designer">' . wp_get_theme()->get( 'Author' ) . '</a>' ); 
				?>
			</div><!-- .site-info -->

	<?php endif;

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function carbon_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'carbon_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'carbon_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so carbon_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so carbon_lite_categorized_blog should return false.
		return false;
	}
}



/**
 * Flush out the transients used in carbon_lite_categorized_blog.
 */
function carbon_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'carbon_lite_categories' );
}
add_action( 'edit_category', 'carbon_lite_category_transient_flusher' );
add_action( 'save_post',     'carbon_lite_category_transient_flusher' );
