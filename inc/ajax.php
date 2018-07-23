<?php
/**
 * Alcatraz Ajax.
 *
 * @package carrieforde
 */

add_action( 'wp_ajax_carrieforde_hide_activation_notice', 'carrieforde_hide_admin_notice' );
/**
 * Ajax handler for hiding the admin notice.
 *
 * @since  1.0.0
 */
function carrieforde_hide_admin_notice() {

	$options = get_option( 'carrieforde_options' );

	$options['show_activation_notice'] = 0;

	update_option( 'carrieforde_options', $options, true );

	wp_die();
}
