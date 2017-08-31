<?php
/**
 * Implementation of the Custom Header feature
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package carbon-lite
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses carbon_lite_header_style()
 */
function carbon_lite_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'carbon_lite_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'fff',
		'width'                  => 2000,
		'height'                 => 760,
		'flex-height'            => true,
		'wp-head-callback'       => 'carbon_lite_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'carbon_lite_custom_header_setup' );

if ( ! function_exists( 'carbon_lite_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see carbon_lite_custom_header_setup().
 */
function carbon_lite_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.header-title a,
		.header-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.header-title a,
		.header-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; 
		
		// If there's a header image, display it in the header area.
		if ( $image_url = get_header_image() ) :
	?>
		.site-header {
			background-image: url('<?php echo esc_url( $image_url ); ?>');
		}

	<?php endif;

		// If there's a custom header color defined, just use it.
		$header_background_color = get_theme_mod( 'carbon_lite_header_color' );
		if ( $header_background_color ) :
	?>
		.site-header {
			background-color: <?php echo esc_html( $header_background_color ) ?>;
		}

	<?php endif;

	?>
	</style>
	<?php
}
endif;
