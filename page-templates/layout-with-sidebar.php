<?php
/**
 * Template Name: Layout with Sidebar
 * Template Post Type: page, post
 *
 * @package carrieforde
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<?php do_action( 'carrieforde_before_main' ); ?>

		<main id="main" class="site-main" role="main">

		<?php do_action( 'carrieforde_before_main_inside' ); ?>

		<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content-single', get_post_type() );

				the_post_navigation();

				// Maybe load comments.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile;
		?>

		<?php do_action( 'carrieforde_after_main_inside' ); ?>

		</main>

		<?php do_action( 'carrieforde_after_main' ); ?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
