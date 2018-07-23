<?php
/**
 * Default content template.
 *
 * @package carrieforde
 */
?>

<?php do_action( 'carrieforde_before_entry' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="post-thumbnail"><?php the_post_thumbnail(); ?></a>
	<?php endif; ?>

	<?php carrieforde_the_entry_header(); ?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&raquo;</span>', 'carrieforde' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'carrieforde' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<?php carrieforde_the_entry_footer(); ?>
</article>

<?php do_action( 'carrieforde_after_entry' ); ?>
