<?php
/**
 * Content template for search results.
 *
 * @package carrieforde
 */

?>

<?php do_action( 'carrieforde_before_entry' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php carrieforde_the_entry_title(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<?php carrieforde_the_entry_footer(); ?>
</article>

<?php do_action( 'carrieforde_after_entry' ); ?>
