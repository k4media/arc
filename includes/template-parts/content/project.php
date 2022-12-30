<?php
/**
 * Template part for displaying ARC Projects custom post type
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Angkor_Research_&_Consulting
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("project"); ?>>

	<?php arc_post_thumbnail(); ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-meta">
		<?php arc_entry_meta(); ?>
	</div><!-- .entry-meta -->


	<div class="entry-content">

		<?php
			if ( function_exists('get_field') ) {
				$pdf = get_field('pdf');
			}
			if ( isset($pdf['url']) ) : 
		?>
			<div class="pdf"><a target="_blank" href="<?php echo $pdf['url']; ?>">View PDF</a></div>
		<?php endif; ?>

		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'arc' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php arc_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
