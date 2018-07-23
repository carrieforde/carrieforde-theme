<?php
/**
 * Template for displaying 404 pages (not found).
 *
 * @package carrieforde
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<?php do_action( 'carrieforde_before_main' ); ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'carrieforde_before_main_inside' ); ?>

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'carrieforde' ); ?></h1>
				</header>

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'carrieforde' ); ?></p>

					<?php get_search_form(); ?>
				</div>
			</section>

			<?php do_action( 'carrieforde_after_main_inside' ); ?>

		</main>

		<?php do_action( 'carrieforde_after_main' ); ?>

	</div>

<?php get_footer(); ?>
