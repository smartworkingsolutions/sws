<?php
/**
 * SWS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SWS
 */

if ( ! defined( 'THEME_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'THEME_VERSION', '1.0.0' );
}

if ( ! function_exists( 'sws_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sws_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on SWS, use a find and replace
		 * to change 'sws' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sws', get_template_directory() . '/languages' );

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
			[
				'main-menu' => esc_html__( 'Primary', 'sws' ),
			]
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			]
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'sws_custom_background_args',
				[
					'default-color' => 'ffffff',
					'default-image' => '',
				]
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
			[
				'height'      => 50,
				'width'       => 138,
				'flex-width'  => true,
				'flex-height' => true,
			]
		);
	}
endif;
add_action( 'after_setup_theme', 'sws_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sws_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sws_content_width', 640 );
}
add_action( 'after_setup_theme', 'sws_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sws_widgets_init() {
	register_sidebar(
		[
			'name'          => esc_html__( 'Sidebar', 'sws' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'sws' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		]
	);
}
add_action( 'widgets_init', 'sws_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sws_scripts() {

	$version = CUSTOMCACHE_VERSION;
	$path    = get_template_directory_uri();

	/**
	 * Styles
	 */
	// Main style css.
	wp_enqueue_style( 'sws-style', get_stylesheet_uri(), [], $version );
	wp_enqueue_style( 'sws-theme-style', $path . '/css/theme.css', [], $version );

	// Slick css.
	wp_enqueue_style( 'sws-slick-css', $path . '/css/slick.css', [], $version );

	// Custom css for override.
	wp_enqueue_style( 'sws-custom-css', $path . '/css/custom.css', [], $version );

	/**
	 * Scripts
	 */

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Theme's scrips.
	wp_enqueue_script( 'sws-custom-js', $path . '/js/custom.js', [ 'jquery' ], $version, true );

	// Slick JS.
	wp_enqueue_script( 'sws-slick-js', $path . '/js/slick.min.js', [], $version, true );

	// Google fonts.
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@400;500;600;700&display=swap', false ); //phpcs:ignore

	// FB.
	wp_enqueue_script( 'fb-root', '//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v12.0', [], '', true ); //phpcs:ignore

}
add_action( 'wp_enqueue_scripts', 'sws_scripts' );

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
 * All classes here
 */
require get_template_directory() . '/inc/class-sws-menu-walker.php';
require get_template_directory() . '/inc/class-custom-pagination.php';
require get_template_directory() . '/inc/class-sws-actions.php';
require get_template_directory() . '/inc/class-custom-post-types.php';
require get_template_directory() . '/inc/class-svg-enable.php';

/**
 * Load ACF Options panel.
 */
require get_template_directory() . '/inc/class-acf-options-panel.php';

/**
 * Update settings from options.
 */
function add_theme_options() {
	$body_color   = get_field( 'body_color', 'options' );
	$color_1      = get_field( 'color_1', 'options' );
	$color_2      = get_field( 'color_2', 'options' );
	$color_3      = get_field( 'color_3', 'options' );
	$color_4      = get_field( 'color_4', 'options' );
	$border_color = get_field( 'border_color', 'options' );
	$text_color   = get_field( 'text_color', 'options' );
	$font         = get_field( 'select_font', 'options' );

	print_r( $font );
	?>
	<style>
		:root {
			--color-body: <?php echo $body_color ? esc_html( $body_color ) : '#ECF1F5'; ?>;
			--color-blue-dark: <?php echo $color_1 ? esc_html( $color_1 ) : '#00017A'; ?>;
			--color-blue-medium: <?php echo $color_2 ? esc_html( $color_2 ) : '#2F2CD6'; ?>;
			--color-blue-light: <?php echo $color_3 ? esc_html( $color_3 ) : '#5956FF'; ?>;
			--color-dark: <?php echo $color_4 ? esc_html( $color_4 ) : '#040524'; ?>;
			--color-border: <?php echo $border_color ? esc_html( $border_color ) : '#ECF1F5'; ?>;
			--color-text: <?php echo $text_color ? esc_html( $text_color ) : '#040524'; ?>;
		}
	</style>
	<?php
}
add_filter( 'wp_head', 'add_theme_options', 10 );

/**
 * This will remove the default image sizes and the medium_large size.
 *
 * @param array $sizes default sizes.
 */
function prefix_remove_default_images( $sizes ) {
	unset( $sizes['small'] ); // 150px.
	unset( $sizes['medium'] ); // 300px.
	unset( $sizes['large'] ); // 1024px.
	unset( $sizes['medium_large'] ); // 768px.
	return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'prefix_remove_default_images' );

/**
 * This will remove the default image sizes and the medium_large size.
 */
function remove_big_image_sizes() {
	remove_image_size( '1536x1536' ); // 2 x Medium Large (1536 x 1536)
	remove_image_size( '2048x2048' ); // 2 x Large (2048 x 2048)
}
add_action( 'init', 'remove_big_image_sizes' );


