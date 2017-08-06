<?php
/**
 * Carbon Lite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package carbon-lite
 */

if ( ! function_exists( 'carbon_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function carbon_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on carbon, use a find and replace
	 * to change 'carbon-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'carbon-lite', get_template_directory() . '/languages' );


	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );


	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );


	// Register new image sizes
	add_image_size( 'blog-thumbnail', 1045, 400, true );


	// This theme uses wp_nav_menu() in three locations.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary Menu', 'carbon-lite' ),
		'menu-2' => esc_html__( 'Main Social Menu', 'carbon-lite' ),
		'menu-3' => esc_html__( 'Footer Social Menu', 'carbon-lite' ),
	) );


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'carbon_lite_custom_background_args', array(
		'default-color' => 'fff',
		'default-image' => '',
	) ) );


	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );


	// Add theme support for custom logo.
	add_theme_support( 'custom-logo', apply_filters( 'carbon_lite_custom_logo_args', array(
        'height'      => 75,
        'flex-width'  => true,
    ) ) );


	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	$suffix = '.min';
	if ( defined( 'WP_DEBUG' ) && 1 == constant( 'WP_DEBUG' ) ) {
		$suffix = '';
	}
	add_editor_style( array ( 'editor-style' . $suffix . '.css', carbon_lite_fonts_url() ) );

}
endif;
add_action( 'after_setup_theme', 'carbon_lite_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function carbon_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'carbon_lite_content_width', 1045 );
}
add_action( 'after_setup_theme', 'carbon_lite_content_width', 0 );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function carbon_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'carbon-lite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets for your blog here.', 'carbon-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title h5">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Menu Widgets', 'carbon-lite' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets you want in the menu panel here.', 'carbon-lite' ),
		'before_widget' => '<section id="%1$s" class="widget menu-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title h5">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'carbon-lite' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets you want in the footer here.', 'carbon-lite' ),
		'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title h5">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'carbon_lite_widgets_init' );



/**
 * Returns the Google Fonts url to enqueue for our custom fonts
 *
 * @return string  $url  Url linking to Google Fonts.
 **/
function carbon_lite_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Audiowide, translate this to 'off'. Do not translate
	 * into your own language. 
	 */
	$audiowide = _x( 'on', 'Audiowide heading font: on or off', 'carbon-lite' );
	
	/* Translators: If there are characters in your language that are not
	 * supported by Exo 2, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$exo2 = _x( 'on', 'Exo2 body font: on or off', 'carbon-lite' );

	/* Translators: If there are characters in your language that are not
	 * supported by Space Mono, translate this to 'off'. Do not translate
	 * into your own language. 
	 */
	$space = _x( 'on', 'Space Mono mono font: on or off', 'carbon-lite' );
	

	if ( 'off' !== $audiowide || 'off' !== $exo2 || 'off' !== $space ) {
		$font_families = array();

		if ( 'off' !== $audiowide ) {
			$font_families[] = 'Audiowide';
		}

		if ( 'off' !== $exo2 ) {
			$font_families[] = 'Exo+2:300,300i,400,400i,700,700i';
		}

		if ( 'off' !== $space ) {
			$font_families[] = 'Space+Mono';
		}

		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => 'latin-ext',
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url( $fonts_url );
}



/**
 * Enqueue scripts and styles.
 */
function carbon_lite_scripts() {

	// Check if the debug mode is on. If not, enqueue the minified stylesheets.
	$suffix = '.min';
	if ( defined( 'WP_DEBUG' ) && 1 == constant( 'WP_DEBUG' ) ) {
		$suffix = '';
	}
	
	// Enqueue basic fonts and styles.
	wp_enqueue_style( 'carbon-fonts', carbon_lite_fonts_url(), array(), null );
	wp_enqueue_style( 'carbon-styles', get_theme_file_uri( 'style' . $suffix . '.css' ) , array(), null );

	// Enqueue the color scheme stylesheet if needed.
	$color_scheme = get_theme_mod( 'carbon_lite_color_scheme', 'color-scheme-default' );
	$registered_color_schemes = carbon_lite_get_registered_options( 'carbon_lite_color_scheme' );
	
	if ( array_key_exists( $color_scheme, $registered_color_schemes) && 'color-scheme-default' != $color_scheme ){
		wp_enqueue_style( 'carbon-color-scheme', get_theme_file_uri( 'css/' . $color_scheme . $suffix . '.css' ), array( 'carbon-styles' ), null );
	}

	// Enqueue icons fonts and scripts
	wp_enqueue_style( 'evil-icons', 'https://cdn.jsdelivr.net/evil-icons/1.9.0/evil-icons.min.css', array(), null );
	wp_enqueue_script( 'evil-icons-js', 'https://cdn.jsdelivr.net/evil-icons/1.9.0/evil-icons.min.js', array(), 'null', false );

	// Enqueue basic scripts needed on every page.
	if ( defined( 'WP_DEBUG' ) && 1 == constant( 'WP_DEBUG' ) ) {
		wp_enqueue_script( 'carbon-js-detection', get_theme_file_uri( '/js/detection.js' ), array(), null, false );
		wp_enqueue_script( 'carbon-navigation', get_theme_file_uri( '/js/navigation.js' ), array(), null, true );
		wp_enqueue_script( 'carbon-skip-link-focus-fix', get_theme_file_uri( '/js/skip-link-focus-fix.js' ), array(), null, true );
	} else {
		wp_enqueue_script( 'carbon-scripts', get_theme_file_uri( '/js/main-scripts.min.js' ), array(), null, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'carbon_lite_scripts' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions and filters.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
