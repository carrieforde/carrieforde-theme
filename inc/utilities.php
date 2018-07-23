<?php
/**
 * Alcatraz utility functions.
 *
 * @package carrieforde
 */

/**
 * Custom logging function.
 *
 * This will handle strings, arrays, and objects, and it
 * doesn't require WP_DEBUG to be set to true.
 *
 * @since  1.0.0
 *
 * @param int|string|array $log Item to inspect.
 */
function carrieforde_log( $log ) {
	if ( is_array( $log ) || is_object( $log ) ) {
		error_log( print_r( $log, true ) );
	} else {
		error_log( $log );
	}
}

/**
 * Return true or false baed on the value passed.
 *
 * @since 1.0.0
 *
 * @param mixed $value The value to be tested.
 * @return bool
 */
function carrieforde_true_or_false( $value ) {

	if ( ! isset( $value ) ) {
		return false;
	}

	if ( true === $value || 'true' === $value || 1 === $value || 'yes' === $value || 'on' === $value ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Sanitize checkbox input.
 *
 * @since 1.0.0
 *
 * @param bool $checked The value to validate.
 *
 * @return bool Whether the box is checked.
 */
function carrieforde_validate_checkbox( $checked ) {

	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}
