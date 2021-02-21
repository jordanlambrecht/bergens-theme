<?php
/**
 * BergensTheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BergensTheme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'bergenstheme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bergenstheme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on BergensTheme, use a find and replace
		 * to change 'bergenstheme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bergenstheme', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'bergenstheme' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'bergenstheme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
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
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'bergenstheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bergenstheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bergenstheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'bergenstheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bergenstheme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'bergenstheme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bergenstheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'bergenstheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bergenstheme_scripts() {

	wp_enqueue_style( 'bergenstheme-booticons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css', array(), _S_VERSION );


	wp_enqueue_style( 'bergenstheme-style-bs', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'bergenstheme-style', get_stylesheet_uri(), array(), _S_VERSION );


		wp_enqueue_style( 'bergenstheme-flickity', 'https://unpkg.com/flickity@2/dist/flickity.min.css', array(), _S_VERSION );

	wp_enqueue_script( 'bergenstheme-bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'bergenstheme-flickity', 'https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'bergenstheme-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js', array(), _S_VERSION, true );

		wp_enqueue_script( 'bergenstheme-gsap-core', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js', array(), _S_VERSION, true );

			wp_enqueue_script( 'bergenstheme-gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/ScrollTrigger.min.js', array(), _S_VERSION, true );

	wp_style_add_data( 'bergenstheme-style', 'rtl', 'replace' );


	wp_enqueue_script( 'bergenstheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'bergenstheme-wallpapers', get_template_directory_uri() . '/js/wallpapers.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bergenstheme_scripts' );

require get_template_directory() . '/inc/cpt-wallpapers.php';
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}




// wallpapers
add_action('acf/save_post', 'update_wallpapers', 30);

function update_wallpapers( $post_id ) {

	$post_type = get_post_type($post_id);
	if ( 'wallpapers' == $post_type ) {

		echo "made it";
	}
	else {
		return;
	}
}
// Get the styling for column repeaters
function admin_theme_style()
{
  wp_enqueue_style( 'admin-theme', get_stylesheet_directory_uri() . '/style-admin.css', false, '1.0.0'  );
}
add_action('admin_enqueue_scripts', 'admin_theme_style');
// add_action( 'publish_wallpapers', 'a_new_post', 10, 3 );


// Add options page for Wallpapers cpt
if( function_exists('acf_add_options_sub_page') ) {
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Wallpapers Settings',
		'menu_title'	=> 'Wallpapers Settings',
		'parent_slug'	=> 'edit.php?post_type=wallpapers',
	));
}
