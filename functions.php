<?php
/**
 * Alcatraz functions and definitions.
 *
 * @package carrieforde
 */

define( 'CARRIEFORDE_VERSION', '1.0.0' );
define( 'CARRIEFORDE_PATH', trailingslashit( get_template_directory() ) );
define( 'CARRIEFORDE_URL', trailingslashit( get_template_directory_uri() ) );

if ( ! function_exists( 'carrieforde_setup' ) ) :
	add_action( 'after_setup_theme', 'carrieforde_setup', 0 );
	/**
	 * Load translations and register support for various WordPress features.
	 *
	 * @since  1.0.0
	 */
	function carrieforde_setup() {

		// Load translation files.
		load_theme_textdomain( 'carrieforde', CARRIEFORDE_PATH . 'languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress generate our title tags.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Enable support for a custom logo.
		add_theme_support( 'custom-logo' );

		// Register menus.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'carrieforde' ),
				'social' => esc_html__( 'Social', 'carrieforde' ),
			)
		);

		// Use html5 markup for certain features.
		add_theme_support(
			'html5',
			apply_filters(
				'carrieforde_html5_supports',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				)
			)
		);

		// Maybe enable post formats.
		if ( apply_filters( 'carrieforde_enable_post_formats', false ) ) {
			add_theme_support(
				'post-formats',
				apply_filters(
					'carrieforde_custom_header_args',
					array(
						'aside',
						'image',
						'video',
						'quote',
						'link',
					)
				)
			);
		}

		// Maybe enable the custom header feature.
		if ( apply_filters( 'carrieforde_enable_custom_header', false ) ) {
			add_theme_support(
				'custom-header',
				apply_filters(
					'carrieforde_custom_header_args',
					array(
						'default-image'      => '',
						'default-text-color' => '000000',
						'width'              => 1200,
						'height'             => 320,
						'flex-height'        => true,
					)
				)
			);
		}

		// Maybe enable the custom background feature.
		if ( apply_filters( 'carrieforde_enable_custom_background', false ) ) {
			add_theme_support(
				'custom-background',
				apply_filters(
					'carrieforde_custom_background_args',
					array(
						'default-color' => 'ffffff',
						'default-image' => '',
					)
				)
			);
		}

		// Add support for editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Marjorelle Blue', 'carrieforde' ),
					'slug'  => 'marjorelle-blue',
					'color' => '#7341f1',
				),
				array(
					'name'  => __( 'Shamrock', 'carrieforde' ),
					'slug'  => 'shamrock',
					'color' => '#55ee9e',
				),
				array(
					'name'  => __( 'Black Russian', 'carrieforde' ),
					'slug'  => 'black-russian',
					'color' => '#252428',
				),
				array(
					'name'  => __( 'Gun Powder', 'carrieforde' ),
					'slug'  => 'gun-powder',
					'color' => '#4b4950',
				),
				array(
					'name'  => __( 'Gray Suit', 'carrieforde' ),
					'slug'  => 'gray-suit',
					'color' => '#97949e',
				),
				array(
					'name'  => __( 'White', 'carrieforde' ),
					'slug'  => 'white',
					'color' => '#fff',
				),
			)
		);

		// Disable custom colors from editor palette.
		add_theme_support( 'disable-custom-colors' );

		// Enable wide & full alignment for editor blocks.
		add_theme_support( 'align-wide' );

		// Enable support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Enable support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor font.
		add_editor_style( str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Inconsolata|Karla' ) );

		// Enqueue editor styles.
		add_editor_style( 'dist/admin.css' );
	}
endif;

add_action( 'after_setup_theme', 'carrieforde_content_width', 0 );
/**
 * Set the content width.
 *
 * @since   1.0.0
 * @global  int  $content_width
 */
function carrieforde_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'carrieforde_content_width', 640 );
}

add_action( 'after_setup_theme', 'carrieforde_register_image_sizes', 0 );
/**
 * Register our theme image sizes.
 *
 * @since  1.0.0
 */
function carrieforde_register_image_sizes() {
	set_post_thumbnail_size( 1200, 740, true );
}

add_action( 'wp_enqueue_scripts', 'carrieforde_scripts' );
/**
 * Enqueue scripts and styles.
 *
 * @since  1.0.0
 */
function carrieforde_scripts() {

	$current_theme = wp_get_theme();

	// Theme header CSS.
	if ( is_admin() ) {
		wp_enqueue_style(
			'carrieforde-style',
			CARRIEFORDE_URL . 'style.css',
			array(),
			CARRIEFORDE_VERSION
		);
	}

	// Google fonts.
	wp_enqueue_style(
		'carrieforde-fonts',
		str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Inconsolata|Karla' ),
		array(),
		CARRIEFORDE_VERSION
	);

	// Main theme CSS.
	wp_register_style(
		'carrieforde-style',
		CARRIEFORDE_URL . 'dist/frontend.css',
		array(),
		CARRIEFORDE_VERSION
	);

	// Main theme JS.
	wp_register_script(
		'carrieforde-scripts',
		CARRIEFORDE_URL . 'dist/frontend-bundle.js',
		array( 'jquery' ),
		CARRIEFORDE_VERSION,
		true
	);

	// Enqueue the JS always.
	wp_enqueue_script( 'carrieforde-scripts' );

	// Enqueue the CSS and fonts only if a child theme is not being used.
	if ( 'Carrie Forde' === $current_theme->get( 'Name' ) ) {
		wp_enqueue_style( 'carrieforde-fonts' );
		wp_enqueue_style( 'carrieforde-style' );
	}

	// Translatable strings and other data for our JS.
	$vars = array(
		'menu_toggle'    => __( 'Toggle', 'carrieforde' ),
		'menu_close'     => __( 'Close', 'carrieforde' ),
		'slide_duration' => 300,
	);
	$vars = apply_filters( 'carrieforde_js_vars', $vars );

	wp_localize_script( 'carrieforde-scripts', 'carrieforde_vars', $vars );

	// Comment reply JS.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'enqueue_block_editor_assets', 'carrieforde_block_editor_styles' );
/**
 * Enqueue block editor styles.
 */
function carrieforde_block_editor_styles() {

	// Google fonts.
	wp_enqueue_style(
		'carrieforde-fonts',
		str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Inconsolata|Karla' ),
		array(),
		CARRIEFORDE_VERSION
	);

	// Admin styles.
	wp_enqueue_style(
		'carrieforde-style',
		CARRIEFORDE_URL . 'dist/admin.css',
		array(),
		CARRIEFORDE_VERSION
	);

	// Block scripts.
	wp_enqueue_script(
		'carrieforde-theme-blocks',
		CARRIEFORDE_URL . 'dist/blocks-bundle.js',
		array( 'wp-blocks' ),
		CARRIEFORDE_VERSION,
		true
	);
}

/**
 * Utility functions.
 */
require_once CARRIEFORDE_PATH . 'inc/utilities.php';

/**
 * Ajax callbacks.
 */
require_once CARRIEFORDE_PATH . 'inc/ajax.php';

/**
 * Custom template tags for this theme.
 */
require_once CARRIEFORDE_PATH . 'inc/template-tags.php';

/**
 * Theme hook output.
 */
require_once CARRIEFORDE_PATH . 'inc/theme-hooks.php';

/**
 * Widget Areas.
 */
require_once CARRIEFORDE_PATH . 'inc/widget-areas.php';

/**
 * Custom functions that act independent of the theme templates.
 */
require_once CARRIEFORDE_PATH . 'inc/extras.php';

/**
 * Customizer additions.
 */
require_once CARRIEFORDE_PATH . 'inc/admin/customizer.php';

/**
 * Jetpack compatibility file.
 */
require_once CARRIEFORDE_PATH . 'inc/jetpack.php';

/**
 * Admin-only functionality.
 */
if ( is_admin() ) {
	require_once CARRIEFORDE_PATH . 'inc/admin/admin.php';
}
