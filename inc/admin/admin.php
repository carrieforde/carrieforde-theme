<?php
/**
 * Alcatraz admin-only functionality.
 *
 * Everything in this file is only run if is_admin() is true.
 *
 * @package carrieforde
 */

add_action( 'admin_enqueue_scripts', 'carrieforde_admin_enqueue_scripts' );
/**
 * Enqueue our admin JS.
 *
 * @since 1.0.0
 *
 * @param string $hook The page being displayed.
 */
function carrieforde_admin_enqueue_scripts( $hook ) {

	wp_enqueue_script(
		'carrieforde-admin-scripts',
		CARRIEFORDE_URL . 'dist/admin-bundle.js',
		array( 'jquery' ),
		CARRIEFORDE_VERSION,
		true
	);
}

add_action( 'admin_notices', 'carrieforde_activation_notice' );
/**
 * Show an activation notice.
 *
 * @since  1.0.0
 */
function carrieforde_activation_notice() {

	$options = get_option( 'carrieforde_options' );

	if ( $options['show_activation_notice'] ) {

		$customizer_link = sprintf(
			'<a href="%s">%s</a>',
			esc_url( admin_url( 'customize.php' ) ),
			__( 'Customizer', 'carrieforde' )
		);

		$documentation_link = sprintf(
			'<a href="%s" target="_blank">%s</a>',
			'https://github.com/carrieforde/Alcatraz/wiki',
			__( 'Alcatraz documentation on Github', 'carrieforde' )
		);

		?>
		<div id="carrieforde-activation-notice" class="updated notice is-dismissible" style="padding-bottom: 5px;">
			<h2><?php _e( 'Welcome to Alcatraz', 'carrieforde' ); // WPCS: XSS OK. ?></h2>
			<p><?php _e( 'Get started by configuring visual options in the', 'carrieforde' ); // WPCS: XSS OK. ?> <?php echo $customizer_link; // WPCS: XSS OK. ?></p>
			<p><?php _e( 'For development resources visit the', 'carrieforde' ); // WPCS: XSS OK. ?> <?php echo $documentation_link; // WPCS: XSS OK. ?></p>
		</div>
		<?php
	}
}

add_action( 'admin_init', 'carrieforde_add_editor_styles' );
/**
 * Include our theme CSS in the TinyMCE editor.
 *
 * @since  1.0.0
 */
function carrieforde_add_editor_styles() {

	add_editor_style( get_stylesheet_uri() );
}
