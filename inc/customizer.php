<?php
/**
 * Carbon Theme Customizer
 *
 * @package carbon-lite
 */

/**
 * Add Customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function carbon_lite_customize_register( $wp_customize ) {

	// Set basic Site Identity options to 'postMessage'
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';	

	/*
	 * Add Color Scheme options.
	 */
	$wp_customize->add_setting( 'carbon_lite_color_scheme', array(
		'default'           => 'color-scheme-default',
		'sanitize_callback' => 'carbon_lite_sanitize_customizer_radio',
	) );
	$wp_customize->add_control( 'carbon_lite_color_scheme', array(
		'label'       => __( 'General color scheme', 'carbon-lite' ),
		'description' => __( 'Pick your favorite color. This setting affects all colored accents.', 'carbon-lite' ),
		'type'        => 'radio',
		'section'     => 'colors',
		'choices'     => carbon_lite_get_registered_options( 'carbon_lite_color_scheme' ),
	) );



	/*
	 * Add typography section and settings
	 */
	$wp_customize->add_section( 'typography', array(
		'title'       => __( 'Typography', 'carbon-lite' ),
		'description' => __( 'Choose your text and icon preferences here.', 'carbon-lite' ),
		'priority'    => 50,
	) );

	// Add body text size options.
	$wp_customize->add_setting( 'carbon_lite_body_text_size', array(
		'default'           => 'medium-body-text',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'carbon_lite_sanitize_customizer_radio',
	) );
	$wp_customize->add_control( 'carbon_lite_body_text_size', array(
		'label'       => __( 'Body text size', 'carbon-lite' ),
		'description' => __( 'Choose your prefered body text size. Note that this setting also affects the size of headings and icons.', 'carbon-lite' ),
		'type'        => 'radio',
		'section'     => 'typography',
		'choices'     => carbon_lite_get_registered_options( 'carbon_lite_body_text_size' ),
	) );

	// Add headings size options.
	$wp_customize->add_setting( 'carbon_lite_headings_size', array(
		'default'           => 'large-headings',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'carbon_lite_sanitize_customizer_radio',
	) );
	$wp_customize->add_control( 'carbon_lite_headings_size', array(
		'label'       => __( 'Headings size', 'carbon-lite' ),
		'description' => __( 'Choose your favorite heading size. Be bold.', 'carbon-lite' ),
		'type'        => 'radio',
		'section'     => 'typography',
		'choices'     => carbon_lite_get_registered_options( 'carbon_lite_headings_size' ),
	) );

	// Add icon size options.
	$wp_customize->add_setting( 'carbon_lite_icons_size', array(
		'default'           => 'medium-icons',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'carbon_lite_sanitize_customizer_radio',
	) );
	$wp_customize->add_control( 'carbon_lite_icons_size', array(
		'label'       => __( 'Icons size', 'carbon-lite' ),
		'description' => __( 'Choose how you want your icons. Fat or super fat ?', 'carbon-lite' ),
		'type'        => 'radio',
		'section'     => 'typography',
		'choices'     => carbon_lite_get_registered_options( 'carbon_lite_icons_size' ),
	) );



	/*
	 * Add Display and Layout section and settings.
	 */ 
	$wp_customize->add_section( 'layout', array(
		'title'       => __( 'Display and layout', 'carbon-lite' ),
		'description' => __( 'Choose your layout and display preferences here.', 'carbon-lite' ),
		'priority'    => 90,
	) );

	// Add 'Show search in menu' option
	$wp_customize->add_setting( 'carbon_lite_show_search', array(
		'default'           => 1,
		'sanitize_callback' => 'carbon_lite_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'carbon_lite_show_search', array(
		'label'       => __( 'Menu search field', 'carbon-lite' ),
		'description' => __( 'Show the search field in menu area ?', 'carbon-lite' ),
		'type'        => 'checkbox',
		'section'     => 'layout',
	) );

	// Add header size options.
	$wp_customize->add_setting( 'carbon_lite_header_size', array(
		'default'           => 'standard-header',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'carbon_lite_sanitize_customizer_radio',
	) );
	$wp_customize->add_control( 'carbon_lite_header_size', array(
		'label'       => __( 'Header height', 'carbon-lite' ),
		'description' => __( 'Choose the height of your header area.', 'carbon-lite' ),
		'type'        => 'radio',
		'section'     => 'layout',
		'choices'     => carbon_lite_get_registered_options( 'carbon_lite_header_size' ),
	) );
	
	// Add content area size options.
	$wp_customize->add_setting( 'carbon_lite_content_area_size', array(
		'default'           => 'medium-content-area',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'carbon_lite_sanitize_customizer_radio',
	) );
	$wp_customize->add_control( 'carbon_lite_content_area_size', array(
		'label'       => __( 'Content content area size', 'carbon-lite' ),
		'description' => __( 'Choose the width of your posts area.', 'carbon-lite' ),
		'type'        => 'radio',
		'section'     => 'layout',
		'choices'     => carbon_lite_get_registered_options( 'carbon_lite_content_area_size' ),
	) );

	// Add sidebar position options.
	$wp_customize->add_setting( 'carbon_lite_sidebar_position', array(
		'default'           => 'sidebar-right',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'carbon_lite_sanitize_customizer_radio',
	) );
	$wp_customize->add_control( 'carbon_lite_sidebar_position', array(
		'label'       => __( 'Sidebar position', 'carbon-lite' ),
		'description' => __( 'Choose where you want to place your blog sidebar.', 'carbon-lite' ),
		'type'        => 'radio',
		'section'     => 'layout',
		'choices'     => carbon_lite_get_registered_options( 'carbon_lite_sidebar_position' ),
	) );

	// Add content display options.
	$wp_customize->add_setting( 'carbon_lite_content_option', array(
		'default'           => 'full-content',
		'sanitize_callback' => 'carbon_lite_sanitize_customizer_radio',
	) );
	$wp_customize->add_control( 'carbon_lite_content_option', array(
		'label'       => __( 'Content display option', 'carbon-lite' ),
		'description' => __( 'Choose what content you want to display on your blog page.', 'carbon-lite' ),
		'type'        => 'radio',
		'section'     => 'layout',
		'choices'     => carbon_lite_get_registered_options( 'carbon_lite_content_option' ),
	) );
	

	// Add footer custom text option
	$wp_customize->add_setting( 'carbon_lite_footer_text', array(
		'default'           => '',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'carbon_lite_footer_text', array(
		'label'       => __( 'Footer text', 'carbon-lite' ),
		'description' => __( 'Type in the footer credits you need, or leave blank for the default theme credits.<br />Simple HTML tags, like &lt;strong&gt;,&lt;em&gt;,&lt;a&gt; are allowed.', 'carbon-lite' ),
		'section'     => 'layout',
	) );
}
add_action( 'customize_register', 'carbon_lite_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously
 */
function carbon_lite_customize_preview_js() {
	$suffix = '.min';
	if ( defined( 'WP_DEBUG' ) && 1 == constant( 'WP_DEBUG' ) ) {
		$suffix = '';
	}
	wp_enqueue_script( 'carbon_lite_customizer', get_template_directory_uri() . '/js/customizer' . $suffix . '.js', array( 'customize-preview' ), null , true );
}
add_action( 'customize_preview_init', 'carbon_lite_customize_preview_js' );



/**
 * Sanitize the radio options.
 *
 * @param  string    $value     The value of the setting to sanitize.
 * @param  object    $setting   The instance of the customizer setting.
 * @return string    $value     The sanitized value.
 */
function carbon_lite_sanitize_customizer_radio( $value, $setting ) {

	$valid = carbon_lite_get_registered_options( $setting->id );

	return carbon_lite_sanitize_radio( $value, $valid );
		
}



/**
 * Get an array of registered options for a given radio setting in the customizer.
 *
 * @param  string   $setting              A customizer radio setting to get available choices for.
 * @return array    $registered_options   An array of registered options for the passed settings (value => label)
 */
function carbon_lite_get_registered_options( $setting ){
	
	switch ( $setting ) {
		
		case 'carbon_lite_color_scheme':
			$registered_colored_schemes = array(
				'color-scheme-default'  => __( 'Default (soft black)', 'carbon-lite' ),
				'color-scheme-red'      => __( 'Red', 'carbon-lite' ),
				'color-scheme-blue'     => __( 'Blue', 'carbon-lite' ),
				'color-scheme-green'    => __( 'Green', 'carbon-lite' ),
				'color-scheme-orange'   => __( 'Orange', 'carbon-lite' ),
				'color-scheme-yellow'   => __( 'Yellow', 'carbon-lite' ),
			);
			return apply_filters( 'carbon_lite_color_schemes', $registered_colored_schemes );
			break;
		
		case 'carbon_lite_body_text_size':
			$registered_text_sizes = array(
				'small-body-text'  => __( 'Small', 'carbon-lite' ),
				'medium-body-text' => __( 'Medium', 'carbon-lite' ),
				'large-body-text'  => __( 'Large', 'carbon-lite' ),
			);
			return apply_filters( 'carbon_lite_body_text_sizes', $registered_text_sizes );
			break;
		
		case 'carbon_lite_headings_size':
			$registered_headings_sizes = array(
				'small-headings'  => __( 'Small', 'carbon-lite' ),
				'medium-headings' => __( 'Medium', 'carbon-lite' ),
				'large-headings'  => __( 'Large', 'carbon-lite' ),
				'huge-headings'   => __( 'Huge', 'carbon-lite' ),
			);
			return apply_filters( 'carbon_lite_headings_sizes', $registered_headings_sizes );
			break;

		case 'carbon_lite_icons_size':
			$registered_icons_sizes = array(
				'small-icons'  => __( 'Small', 'carbon-lite' ),
				'medium-icons' => __( 'Medium', 'carbon-lite' ),
				'large-icons'  => __( 'Large', 'carbon-lite' ),
			);
			return apply_filters( 'carbon_lite_icons_sizes', $registered_icons_sizes );
			break;
		
		case 'carbon_lite_header_size':
			$registered_header_sizes = array(
				'small-header'    => __( 'Thin header', 'carbon-lite' ),
				'standard-header' => __( 'Standard header', 'carbon-lite' ),
			);
			return apply_filters( 'carbon_lite_header_sizes', $registered_header_sizes );
			break;
		
		case 'carbon_lite_content_area_size':
			$registered_content_area_sizes = array(
				'small-content-area'  => __( 'Narrower content area', 'carbon-lite' ),
				'medium-content-area' => __( 'Medium content area', 'carbon-lite' ),
				'large-content-area'  => __( 'Wider content area', 'carbon-lite' ),
			);
			return apply_filters( 'carbon_lite_content_area_sizes', $registered_content_area_sizes );
			break;

		case 'carbon_lite_sidebar_position':
			$registered_sidebar_positions = array(
				'sidebar-left'  => __( 'Sidebar on the left', 'carbon-lite' ),
				'sidebar-right' => __( 'Sidebar on the right', 'carbon-lite' ),
				'no-sidebar'    => __( 'No sidebar', 'carbon-lite' ),
			);
			return apply_filters( 'carbon_lite_sidebar_positions', $registered_sidebar_positions );
			break;
		
		case 'carbon_lite_content_option':
			$registered_content_options = array(
				'no-content'   => __( 'No content (just title and metas)', 'carbon-lite' ),
				'title-thumb'  => __( 'Featured image, title and metas', 'carbon-lite' ),
				'excerpt'      => __( 'An excerpt of the post', 'carbon-lite' ),
				'full-content' => __( 'The full post', 'carbon-lite' ),
			);
			return apply_filters( 'carbon_lite_content_options', $registered_content_options );
			break;
		
		default:
			return array();
			break;
	}
	
}
