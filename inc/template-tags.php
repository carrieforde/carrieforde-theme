<?php
/**
 * Alcatraz custom template tags.
 *
 * @package carrieforde
 */

/**
 * Build and return the "Posted on ..." HTML.
 *
 * @since 1.0.0
 *
 * @param int $post_id The post ID to use (optional).
 *
 * @return string The "Posted on ..." HTML.
 */
function carrieforde_posted_on( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf(
		 $time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);

	$output = '<span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="posted-on__link">' . $time_string . '</a></span>';

	return apply_filters( 'carrieforde_posted_on', $output, $post_id, $author_id );
}

/**
 * Echo the "Posted on ..." HTML.
 *
 * @param int $post_id The post ID to use (optional).
 */
function carrieforde_the_posted_on( $post_id = 0 ) {
	echo carrieforde_posted_on( $post_id ); // WPCS: XSS OK.
}

/**
 * Build the return edit post link HTML.
 *
 * @since 1.0.0
 *
 * @param int $post_id The post ID to use (optional).
 *
 * @return string The edit post link HTML.
 */
function carrieforde_edit_post_link( $post_id = 0 ) {

	if ( ! is_user_logged_in() || ! current_user_can( 'edit_post', $post_id ) ) {
		return '';
	}

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$link_text = sprintf(
		'%s %s',
		esc_html__( 'Edit', 'carrieforde' ),
		get_post_type( $post_id )
	);

	$edit_post_link = sprintf(
		'<span class="post-edit-link"><a href="%s">%s</a></span>',
		esc_url( get_edit_post_link( $post_id ) ),
		$link_text
	);

	return apply_filters( 'carrieforde_edit_post_link', $edit_post_link, $post_id );
}

/**
 * Echo the edit post link HTML.
 *
 * @since 1.0.0
 *
 * @param int $post_id The post ID to use (optional).
 */
function carrieforde_the_edit_post_link( $post_id = 0 ) {
	echo carrieforde_edit_post_link( $post_id ); // WPCS: XSS OK.
}

/**
 * Build and return the entry header HTML.
 *
 * @since 1.0.0
 *
 * @param int $post_id The post ID to use (optional).
 *
 * @return string The entry header HTML.
 */
function carrieforde_entry_header( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	ob_start();

	echo '<header class="entry-header">';

	do_action( 'carrieforde_entry_header_inside', $post_id );

	echo '</header>';

	return apply_filters( 'carrieforde_entry_header', ob_get_clean(), $post_id );
}

/**
 * Echo the entry header HTML.
 *
 * @since 1.0.0
 *
 * @param int $post_id The post ID to use (optional).
 */
function carrieforde_the_entry_header( $post_id = 0 ) {
	echo carrieforde_entry_header( $post_id ); // WPCS: XSS OK.
}

/**
 * Build and return the entry title HTML.
 *
 * @since 1.0.0
 *
 * @param int $post_id The post ID to use (optional).
 *
 * @return string The entry title HTML.
 */
function carrieforde_entry_title( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$title      = '';
	$hide_title = get_post_meta( $post_id, 'hide_title', true );

	if ( is_singular() && 'yes' === $hide_title[0] ) {

		$title = '<h1 class="entry-title screen-reader-text">' . get_the_title( $post_id ) . '</h1>';
	} elseif ( is_singular() ) {

		$title = '<h1 class="entry-title">' . get_the_title( $post_id ) . '</h1>';
	} else {

		$title = sprintf(
			'<h2 class="entry-title"><a href="%s" rel="bookmark" class="entry-title__link">%s</a></h2>',
			esc_url( get_permalink( $post_id ) ),
			get_the_title( $post_id )
		);
	}

	return apply_filters( 'carrieforde_entry_title', $title, $post_id );
}

/**
 * Echo the entry title HTML.
 *
 * @since 1.0.0
 *
 * @param int $post_id The post ID to use (optional).
 */
function carrieforde_the_entry_title( $post_id = 0 ) {
	echo carrieforde_entry_title( $post_id ); // WPCS: XSS OK.
}

/**
 * Build and return the entry meta HTML.
 *
 * @since 1.0.0
 *
 * @param int $post_id The post ID to use (optional).
 *
 * @return string The entry meta HTML.
 */
function carrieforde_entry_meta( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$meta       = '';
	$this_type  = get_post_type( $post_id );
	$post_types = apply_filters( 'carrieforde_entry_meta_post_types', array( 'post' ), $post_id );

	foreach ( $post_types as $post_type ) {
		if ( $this_type === $post_type ) {
			$meta = sprintf(
				 '<div class="entry-meta">%s</div>',
				carrieforde_posted_on( $post_id )
			);
			break;
		}
	}

	return apply_filters( 'carrieforde_entry_meta', $meta, $post_id );
}

/**
 * Echo the entry meta HTML.
 *
 * @since 1.0.0
 *
 * @param int $post_id The post ID to use (optional).
 */
function carrieforde_the_entry_meta( $post_id = 0 ) {
	echo carrieforde_entry_meta( $post_id ); // WPCS: XSS OK.
}

/**
 * Build and return the entry footer HTML.
 *
 * @since 1.0.0
 *
 * @param int $post_id The post ID to use (optional).
 *
 * @return string The entry footer HTML.
 */
function carrieforde_entry_footer( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	ob_start();

	echo '<footer class="entry-footer">';

	do_action( 'carrieforde_entry_footer_inside', $post_id );

	echo '</footer>';

	return apply_filters( 'carrieforde_entry_footer', ob_get_clean(), $post_id );
}

/**
 * Echo the entry footer HTML.
 *
 * @since 1.0.0
 *
 * @param int $post_id The post ID to use (optional).
 */
function carrieforde_the_entry_footer( $post_id = 0 ) {
	echo carrieforde_entry_footer( $post_id ); // WPCS: XSS OK.
}

/**
 * Build and return the HTML for a taxonomy term list.
 *
 * @since 1.0.0
 *
 * @param int    $post_id   The post ID to use.
 * @param string $taxonomy  The taxonomy slug to output terms from.
 * @param string $label     The label to use.
 * @param string $separator The separation string.
 *
 * @return string The term list HTML.
 */
function carrieforde_get_taxonomy_term_list( $post_id = 0, $taxonomy = '', $label = '', $separator = ', ' ) {

	// Taxonomy is required.
	if ( ! $taxonomy ) {
		return '';
	}

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$terms_args = array(
		'orderby' => 'name',
		'order'   => 'ASC',
		'fields'  => 'all',
	);
	$terms_args = apply_filters( 'carrieforde_get_taxonomy_term_list_args', $terms_args, $post_id, $taxonomy );

	$terms = wp_get_post_terms( $post_id, $taxonomy, $terms_args );

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return '';
	}

	$output = sprintf(
		'<div class="%s %s">%s',
		'entry-tax-term-list',
		esc_attr( $taxonomy ) . '-tax-term-list',
		$label
	);

	$i = 0;

	foreach ( $terms as $term_slug => $term_obj ) {
		$output .= sprintf(
			'<a href="%s" rel="%s %s" class="term term--%s">%s</a>',
			get_term_link( $term_obj->term_id ),
			esc_attr( $term_obj->slug ),
			esc_attr( $term_obj->taxonomy ),
			esc_attr( $term_obj->taxonomy ),
			esc_html( $term_obj->name )
		);

		$i++;

		if ( count( $terms ) > $i ) {
			$output .= $separator;
		}
	}

	$output .= '</div>';

	return apply_filters( 'carrieforde_taxonomy_term_list', $output, $post_id, $taxonomy, $label, $separator );
}

/**
 * Echo the HTML for a taxonomy term list.
 *
 * @since 1.0.0
 *
 * @param int    $post_id   The post ID to use.
 * @param string $taxonomy  The taxonomy slug to output terms from.
 * @param string $label     The label to use.
 * @param string $separator The separation string.
 */
function carrieforde_the_taxonomy_term_list( $post_id = 0, $taxonomy = '', $label = '', $separator = ', ' ) {
	echo carrieforde_get_taxonomy_term_list( $post_id, $taxonomy, $label, $separator ); // WPCS: XSS OK.
}

/**
 * Display the social icons menu.
 */
function carrieforde_the_social_icons_menu() {

	if ( has_nav_menu( 'social' ) ) {

	?>

	<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'carrieforde' ); ?>">

		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'social',
					'menu_class'     => 'menu menu--social-links',
					'depth'          => 1,
					'container'      => '',
				)
			);
		?>
	</nav>

	<?php
	}
}
