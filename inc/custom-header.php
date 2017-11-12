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
	?>
	<style type="text/css">
		
		<?php if ( ! display_header_text() ) : ?>
			
			.header-title,
			.header-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		
		<?php else : ?>

			.header-title,
			.header-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}

		<?php endif; ?>
		
		<?php if ( $image_url = get_header_image() ) : 	?>
			
			.site-header {
				background-image: url('<?php echo esc_url( $image_url ); ?>');
			}

		<?php endif; ?>
	</style>
	<?php
}
endif;
