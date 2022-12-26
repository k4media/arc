<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

/**
 * Angkor Research & Consulting functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Angkor_Research_&_Consulting
 */

if ( ! defined( 'ARC_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'ARC_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function arc_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Angkor Research & Consulting, use a find and replace
		* to change 'arc' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'arc', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'arc' ),
			'footer' => esc_html__( 'Footer', 'arc' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 45,
			'width'       => 180,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add custom editor font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => esc_html__( 'Small', 'arc' ),
				'shortName' => esc_html_x( 'S', 'Font size', 'arc' ),
				'size'      => 14,
				'slug'      => 'extra-small',
			),
			array(
				'name'      => esc_html__( 'Body', 'arc' ),
				'shortName' => esc_html_x( 'M', 'Font size', 'arc' ),
				'size'      => 20,
				'slug'      => 'small',
			),
			array(
				'name'      => esc_html__( 'Large', 'arc' ),
				'shortName' => esc_html_x( 'L', 'Font size', 'arc' ),
				'size'      => 24,
				'slug'      => 'normal',
			),
			array(
				'name'      => esc_html__( 'Larger', 'arc' ),
				'shortName' => esc_html_x( 'XL', 'Font size', 'arc' ),
				'size'      => 28,
				'slug'      => 'large',
			),
			array(
				'name'      => esc_html__( 'Huge', 'arc' ),
				'shortName' => esc_html_x( 'XXL', 'Font size', 'arc' ),
				'size'      => 32,
				'slug'      => 'extra-large',
			),
			array(
				'name'      => esc_html__( 'Jumbo', 'arc' ),
				'shortName' => esc_html_x( 'XXXL', 'Font size', 'arc' ),
				'size'      => 56,
				'slug'      => 'huge',
			),
			array(
				'name'      => esc_html__( 'Super Jumbo', 'arc' ),
				'shortName' => esc_html_x( 'XXXXL', 'Font size', 'arc' ),
				'size'      => 72,
				'slug'      => 'gigantic',
			),
		)
	);

	// Editor color palette.
	$black     	= '#000000';
	$dark_gray 	= '#131313';
	$gray      	= '#7D7D7D';
	$light_gray = '#F6F6F6';
	$turquoise  = '#219DA9';
	$red		= '#D81D3F';
	$blue       = '#FFBD5C';
	$white      = '#203147';

	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'Black', 'arc' ),
				'slug'  => 'black',
				'color' => $black,
			),
			array(
				'name'  => esc_html__( 'Dark gray', 'arc' ),
				'slug'  => 'dark-gray',
				'color' => $dark_gray,
			),
			array(
				'name'  => esc_html__( 'Gray', 'arc' ),
				'slug'  => 'gray',
				'color' => $gray,
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'arc' ),
				'slug'  => 'light-gray',
				'color' => $light_gray,
			),
			array(
				'name'  => esc_html__( 'Turquoise', 'arc' ),
				'slug'  => 'turquoise',
				'color' => $turquoise,
			),
			array(
				'name'  => esc_html__( 'Red', 'arc' ),
				'slug'  => 'red',
				'color' => $red,
			),
			array(
				'name'  => esc_html__( 'Blue', 'arc' ),
				'slug'  => 'blue',
				'color' => $blue,
			),
			array(
				'name'  => esc_html__( 'White', 'arc' ),
				'slug'  => 'white',
				'color' => $white,
			),
		),
		'editor-gradient-presets',
		array(
			array(
				'name'     => esc_attr__( 'ARC turquoise to blue', 'arc' ),
				'gradient' => 'linear-gradient(135deg,rgba(33,157,169,1) 100%,rgb(32,49,71,1) 100%)',
				'slug'     => 'arc-turquoise-to-blue'
			),
		)

	);

	// Remove feed icon link from legacy RSS widget.
	add_filter( 'rss_widget_feed_link', '__return_false' );
}
add_action( 'after_setup_theme', 'arc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function arc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'arc_content_width', 640 );
}
add_action( 'after_setup_theme', 'arc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function arc_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'arc' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'arc' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'arc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function arc_scripts() {

	// _s Stylesheet
	$filetime = filemtime( get_stylesheet_directory() . '/style.css');
	wp_enqueue_style('underscores', get_stylesheet_directory_uri() . '/style.css', false, $filetime, 'all');

	// Theme Stylesheet
	$filetime = filemtime( get_stylesheet_directory() . '/assets/css/arc.css');
	wp_enqueue_style('arc', get_stylesheet_directory_uri() . '/assets/css/arc.css', false, $filetime, 'all');

	// Theme JS
	$filetime = filemtime( get_stylesheet_directory() . '/assets/js/arc.js');
	wp_enqueue_script('arc', get_stylesheet_directory_uri() . '/assets/js/arc.js', array(), $filetime, true );

	$params = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	);
	wp_localize_script( 'arc', 'ajax_object', $params);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'arc_scripts' );

/**
 * Enqueue admin styles.
 */
add_action( 'admin_enqueue_scripts', 'enqueuing_admin_scripts' );
function enqueuing_admin_scripts(){
    wp_enqueue_style('arc', get_template_directory_uri().'/assets/css/admin.css');
}

/*
 * Enqueue google fonts
 */
add_action('wp_print_styles', 'arc_load_fonts');
function arc_load_fonts() {
	wp_register_style('googleFonts', '//fonts.googleapis.com/css?family=Roboto:wght@400;700;900&display=swap');
	wp_enqueue_style('googleFonts');
}

/*
 * Create a theme options page with ACF
 */
add_action( 'admin_menu', 'arc_settings_page' );
function arc_settings_page() {
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
			'page_title' 	=> "ARC Settings",
			'menu_title'	=> "ARC",
			'menu_slug' 	=> 'arc-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));
	}
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * ARC Theme files
 */
require get_template_directory() . '/includes/arc.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/includes/jetpack.php';
}

