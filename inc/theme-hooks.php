<?php
/**
 * Alcatraz Theme Hooks.
 *
 * This file contains any output that is included on the carrieforde_* hooks.
 *
 * @package carrieforde
 */

add_action( 'carrieforde_before_header_inside', 'carrieforde_output_header_image', 0 );
/**
 * Maybe output a Header image.
 *
 * @since  1.0.0
 */
function carrieforde_output_header_image() {

	if ( apply_filters( 'carrieforde_enable_custom_header', false ) && get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-image-wrap" rel="home">
			<img src="<?php header_image(); ?>" class="header-image" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
		</a>

	<?php
	endif;
}

add_action( 'carrieforde_header', 'carrieforde_output_site_title', 10 );
/**
 * Output the site title.
 *
 * @since  1.0.0
 */
function carrieforde_output_site_title() {

	$classes = 'site-title';

	if ( has_custom_logo() ) {
		$classes .= ' screen-reader-text';
	}

	if ( is_front_page() && is_home() ) {
		printf(
			'<h1 class="%s"><a href="%s" rel="home">%s</a></h1>',
			esc_attr( $classes ),
			esc_url( home_url( '/' ) ),
			esc_html( get_bloginfo( 'name' ) )
		);
	} else {
		printf(
			'<p class="%s"><a href="%s" rel="home">%s</a></p>',
			esc_attr( $classes ),
			esc_url( home_url( '/' ) ),
			esc_html( get_bloginfo( 'name' ) )
		);
	}
}

add_action( 'carrieforde_header', 'carrieforde_output_site_description', 15 );
/**
 * Output the site description.
 *
 * @since  1.0.0
 */
function carrieforde_output_site_description() {

	$classes      = 'site-description';
	$hide_tagline = get_theme_mod( 'hide_tagline', false );

	if ( $hide_tagline ) {
		$classes .= ' screen-reader-text';
	}

	$description = get_bloginfo( 'description', 'display' );

	if ( $description || is_customize_preview() ) {
		printf(
			'<p class="%s">%s</p>',
			esc_attr( $classes ),
			esc_html( $description )
		);
	}
}

add_action( 'carrieforde_header', 'carrieforde_output_logo', 5 );
/**
 * Output the site logo.
 *
 * @since 1.0.1
 */
function carrieforde_output_logo() {

	$alt_logo = get_post_meta( get_the_id(), 'alternate_logo', true );

	if ( ! has_custom_logo() ) {
		return;
	}

	if ( 'yes' === $alt_logo[0] ) {

		$logo = get_theme_mod( 'alt_logo_id', '' );

		echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link">' . wp_get_attachment_image( $logo, 'full', '', array( 'class' => 'custom-logo' ) ) . '</a>';

		return;
	}

	the_custom_logo();
}

add_action( 'carrieforde_entry_header_inside', 'carrieforde_output_default_entry_header' );
/**
 * Output the default entry header inner content.
 *
 * @since  1.0.0
 *
 * @param int $post_id The current post ID.
 */
function carrieforde_output_default_entry_header( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	carrieforde_the_entry_title( $post_id );
	carrieforde_the_entry_meta( $post_id );
}

add_action( 'carrieforde_entry_footer_inside', 'carrieforde_output_default_entry_footer' );
/**
 * Output the default entry footer inner content.
 *
 * @since 1.0.0
 *
 * @param int $post_id The current post ID.
 */
function carrieforde_output_default_entry_footer( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	carrieforde_the_edit_post_link( $post_id );

	carrieforde_the_taxonomy_term_list( $post_id, 'category', 'Posted in ', ', ' );
	carrieforde_the_taxonomy_term_list( $post_id, 'post_tag', '', '' );
}

add_action( 'carrieforde_footer', 'carrieforde_output_footer_credits', 30 );
/**
 * Output the footer bottom.
 *
 * @since  1.0.0
 */
function carrieforde_output_footer_credits() {

	$footer_credits = get_theme_mod( 'footer_credits', '' );

	if ( ! empty( $footer_credits ) ) {
		printf(
			'<div class="footer-credits">%s</div>',
			wp_kses_post( do_shortcode( $footer_credits ) )
		);
	}
}

add_action( 'carrieforde_after_header_inside', 'carrieforde_social_menu_in_header' );
/**
 * Output the social nav menu.
 */
function carrieforde_social_menu_in_header() {
	carrieforde_the_social_icons_menu();
}

add_action( 'carrieforde_footer', 'carrieforde_social_menu_in_footer', 80 );
/**
 * Output the social nav menu.
 *
 * @author Carrie Forde
 * @since  1.0.0
 */
function carrieforde_social_menu_in_footer() {

	$social_icons_in_footer = get_theme_mod( 'social_icons_in_footer', false );

	if ( $social_icons_in_footer ) {
		carrieforde_the_social_icons_menu();
	}
}

add_filter( 'style_loader_src', 'carrieforde_remove_core_version_numbers', 9999 );
add_filter( 'script_loader_src', 'carrieforde_remove_core_version_numbers', 9999 );
/**
 * Remove version numbers from WP Core styles & scripts.
 *
 * @since 1.0.0
 *
 * @param string $src The file src being loaded.
 * @return string The new src without a version number.
 * @link https://www.coreymcollins.com/2018/02/13/i-boosted-the-crap-out-of-my-site-speed-in-a-weekend/
 */
function carrieforde_remove_core_version_numbers( $src ) {

	$src = remove_query_arg( 'ver', $src );
	return $src;
}

add_action( 'wp_default_scripts', 'carrieforde_wp_default_scripts' );
/**
 * Load jQuery & associated scripts in the footer.
 *
 * @since 1.0.0
 *
 * @param array $scripts Files to be moved.
 * @link https://www.coreymcollins.com/2018/02/13/i-boosted-the-crap-out-of-my-site-speed-in-a-weekend/
 */
function carrieforde_wp_default_scripts( $scripts ) {

	// Bail if we're in the admin.
	if ( is_admin() ) {
		return;
	}

	$scripts->add_data( 'jquery', 'group', 1 );
	$scripts->add_data( 'jquery-core', 'group', 1 );
	$scripts->add_data( 'jquery-migrate', 'group', 1 );
}
