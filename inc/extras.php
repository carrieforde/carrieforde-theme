<?php
/**
 * Extras.
 *
 * Functionality in this file should ideally find a better final home, eventually.
 *
 * @package carrieforde
 */

add_filter( 'body_class', 'carrieforde_body_classes' );
/**
 * Add custom body classes.
 *
 * @since 1.0.0
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function carrieforde_body_classes( $classes ) {

	$footer_widgets     = get_theme_mod( 'footer_widget_areas', 3 );
	$transparent_header = get_post_meta( get_the_id(), 'transparent_header', true );

	// Header image class.
	if ( get_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Custom logo class.
	if ( has_custom_logo() ) {
		$classes[] = 'has-logo';
	}

	// Transparent header class.
	if ( ! empty( $transparent_header ) ) {
		$classes[] = 'has-transparent-header';
	}

	// Footer widget areas class.
	if ( 0 < (int) $footer_widgets ) {
		$classes[] = 'has-footer-widgets';
		$classes[] = 'footer-widget-areas-' . (int) $footer_widgets;
	}

	return $classes;
}

/**
 * Return either an empty string or the integer value of the passed in value.
 *
 * @since 1.0.0
 *
 * @param string|int $value The value to test.
 *
 * @return string|int
 */
function carrieforde_empty_or_int( $value ) {
	if ( '' === $value ) {
		return '';
	} else {
		return intval( $value );
	}
}
