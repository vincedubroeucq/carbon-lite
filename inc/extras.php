<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package carbon-lite
 */



add_filter( 'body_class', 'carbon_lite_body_classes' );
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function carbon_lite_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Retrieve customizer settings
	// Maybe we should use get_theme_mods instead
	$settings = array(
		'header_size'       => get_theme_mod( 'carbon_lite_header_size', 'standard-header' ),
		'content_area_size' => get_theme_mod( 'carbon_lite_content_area_size', 'medium-content-area' ),
		'body_text_size'    => get_theme_mod( 'carbon_lite_body_text_size', 'medium-body-text' ),
		'headings_size'     => get_theme_mod( 'carbon_lite_headings_size', 'large-headings' ),
		'icons_size'        => get_theme_mod( 'carbon_lite_icons_size', 'medium-icons' ),
	);

	foreach ( $settings as $key => $value) {
		$classes[] = $value;
	}

	// Check to see if there's a sidebar and add the corresponding body class.
	if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ){
		$classes[] = get_theme_mod( 'carbon_lite_sidebar_position', 'sidebar-right' );
	} else {
		$classes[] = 'no-sidebar';
	}

	// If we're using the page builder, just add that class too.
	$post_id = get_the_ID();
	if ( is_active_sidebar( 'sidebar-post-' . $post_id ) ) {
		$classes[] = 'carbon-builder';
	}

	return $classes;
}



add_action( 'wp_head', 'carbon_lite_pingback_header' );
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function carbon_lite_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}



add_filter( 'get_search_form', 'carbon_lite_search_form' );
/**
 * Filter the search form HTML to get our custom search form
 *
 * @param    string   $form   Original HTML5 form markup
 * @return   string   $form   Modified search form markup
 */
function carbon_lite_search_form( $form ){
	$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
                <label>
                    <span class="screen-reader-text">' . _x( 'Search for:', 'Search form label for screen readers', 'carbon-lite' ) . '</span>
                    <input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'Search form input', 'carbon-lite' ) . '" value="' . get_search_query() . '" name="s" />
                </label>
				<span data-icon="ei-search"></span>
            </form>';
	return $form;
}



add_action( 'walker_nav_menu_start_el', 'carbon_lite_social_icons_attributes', 10, 4 );
/**
 * Filter the output of the menu items to add the markup needed  
 * to display a social icon in the social menu.
 *
 * @param    string         $item_output   Actual <a> tag that's being printed out
 * @param    Post Object    $item          Menu item Post Object
 * @param    int            $depth         Menu depth
 * @param    object         $args          Menu arguments as defined in wp_nav_menu() function call
 * @return   string         $output        Menu link output, with the icon span inside
 */
function carbon_lite_social_icons_attributes( $item_output, $item, $depth, $args ) {

	// Do not filter the menu if it's not a social menu
	if ( ! in_array( $args->theme_location, array( 'menu-2', 'menu-3') ) ){
		return $item_output;
	}

	// Get the link title text, and supported icons.
	$supported_icons = carbon_lite_get_supported_social_icons();
	$item_text = strtolower( $item->title );

	// If the social icon is supported, 
	// add the necessary data-icon attribute to display the icon properly.
	if ( array_key_exists( $item_text , $supported_icons ) ){
		$item_output = str_replace('<span data-icon="">', '<span data-icon="' . $supported_icons[$item_text] . '">', $item_output);
	}
	
	return $item_output;
}



/**
 * Returns an associative array of supported social domain and icon names
 *
 * @return   array   $supported_icons   Associative array domain => icon attribute
 **/
function carbon_lite_get_supported_social_icons(){
	
	$supported_icons = array(
		'facebook'    => 'ei-sc-facebook',
		'mail'        => 'ei-envelope',
		'github'      => 'ei-sc-github',
		'google-plus' => 'ei-sc-google-plus',
		'instagram'   => 'ei-sc-instagram',
		'linkedin'    => 'ei-sc-linkedin',
		'pinterest'   => 'ei-sc-pinterest',
		'skype'       => 'ei-sc-skype',
		'soundcloud'  => 'ei-sc-soundcloud',
		'telegram'    => 'ei-sc-telegram',
		'tumblr'      => 'ei-sc-tumblr',
		'twitter'     => 'ei-sc-twitter',
		'vimeo'       => 'ei-sc-vimeo',
		'youtube'     => 'ei-sc-youtube',
	);

	return apply_filters( 'carbon_lite_supported_social_icons' , $supported_icons );
	
}



add_filter( 'the_content_more_link', 'carbon_lite_read_more_link' );
/**
 * Returns the markup to use with the Read More link when the <!-- more --> tag is used.
 * @return   string   $read_more_link   Markup for the read more link
 **/
function carbon_lite_read_more_link() {
	
	$link_text = sprintf(
		/* translators: %s: Name of current post. */
		wp_kses( __( 'Continue reading %s', 'carbon-lite' ), array( 'span' => array( 'class' => array() ) ) ),
		the_title( '<span class="screen-reader-text">"', '"</span>', false )
	);

	$link_markup = sprintf( '<p><a class="button more-link" href="%1$s">%2$s<span data-icon="ei-arrow-right"></span><a></p>',
		esc_url( get_permalink() ),
		$link_text
	);

    return $link_markup;
}



add_filter( 'next_posts_link_attributes', 'carbon_lite_next_posts_link_classes' );
/**
 * Adds the necessary classes to the next posts link
 *
 * @param string   $attributes   Attributes for the anchor tag.
 **/
function carbon_lite_next_posts_link_classes( $attributes ){
	$attributes .= ' class="button next-posts-link"';
	return $attributes;
}



add_filter( 'previous_posts_link_attributes', 'carbon_lite_previous_posts_link_classes' );
/**
 * Adds the necessary classes to the previous posts link
 *
 * @param string   $attributes   Attributes for the anchor tag.
 **/
function carbon_lite_previous_posts_link_classes( $attributes ){
	$attributes .= ' class="button previous-posts-link"';
	return $attributes;
}



add_filter( 'previous_post_link', 'carbon_lite_previous_post_link_classes', 10, 5 );
/**
 * Adds the necessary classes to the previous post links
 *
 * @param string   $attributes   Attributes for the anchor tag.
 **/
function carbon_lite_previous_post_link_classes( $output, $format, $link, $post, $adjacent ){
	$output = str_replace( '<a ', '<a class="button previous-post-link" ', $output);
	return $output;
}


add_filter( 'next_post_link', 'carbon_lite_next_post_link_classes', 10, 5 );
/**
 * Adds the necessary classes to the next post links
 *
 * @param string   $attributes   Attributes for the anchor tag.
 **/
function carbon_lite_next_post_link_classes( $output, $format, $link, $post, $adjacent ){
	$output = str_replace( '<a ', '<a class="button next-post-link" ', $output);
	return $output;
}



/**
 * Callback function used to display comments
 *
 * @param   WP_Comment   $comment   Comment to display.
 * @param   int          $depth     Depth we're at.
 * @param   array        $args      Arguments passed to wp_list_comments() function call.
 **/
function carbon_lite_comment_callback( $comment, $args, $depth ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
	<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $comment->has_children ? 'parent' : '', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			
			<div class="comment-author vcard">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				<?php comment_author_link( $comment ); ?>
			</div><!-- .comment-author -->

			<div class="comment-content">
				
				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php
								/* translators: 1: comment date, 2: comment time */
								printf( __( 'On %1$s at %2$s', 'carbon-lite' ), get_comment_date( '', $comment ), get_comment_time() );
							?>
						</time>
					</a>
					<?php edit_comment_link( '<span>' . __( 'Edit', 'carbon-lite' ) . '</span><span data-icon="ei-pencil"></span>' ); ?>
				</div><!-- .comment-metadata -->
 
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'carbon-lite' ); ?></p>
				<?php endif; ?>
				
				<?php comment_text(); ?>

				<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>'
				) ) );
				?>

			</div><!-- .comment-content -->

		</article><!-- .comment-body -->
<?php
}



/**
 * Sanitize a checkbox value.
 *
 * @param  string    $value     The value of the setting to sanitize.
 * @param  object    $setting   The instance of the customizer setting, if used in the customizer
 * @return string    $value     The sanitized value.
 */
function carbon_lite_sanitize_checkbox( $value, $setting = null ){
	
	$valid = array( 0, 1, '', 'on');
	
	if ( in_array( $value, $valid ) ){
		return $value;
	}

	return '';
}



/**
 * Sanitize a radio input's value.
 *
 * @param  string    $value     The value of the input to sanitize.
 * @param  array     $valid     An array of valid options.
 * @return string    $value     The sanitized value.
 */
function carbon_lite_sanitize_radio( $value, $valid ) {

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	}

	return '';	

}
