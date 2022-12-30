<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Angkor_Research_&_Consulting
 */

get_header();
?>
	<div class="stage">
		<?php
			if ( "arc_projects" === get_post_type() ) {
				get_sidebar("projects");
			} else {
				get_sidebar();
			}
		?>
		<main id="primary" class="single">
			<?php
			while ( have_posts() ) :
				the_post();

				if ( "arc_projects" === get_post_type() ) {
					get_template_part( 'includes/template-parts/content/project');
				} else {
					get_template_part( 'includes/template-parts/content/content', get_post_type() );
				}

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div>
<?php
get_footer();
