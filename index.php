<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
		<main id="primary" class="site-main">

			<header class="page-header"><h1>News</h1></header>

			<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					if ( "arc_projects" === get_post_type() ) {
						get_template_part( 'includes/template-parts/content/content', 'project-loop' );
					} else {
						get_template_part( 'includes/template-parts/content/content', 'loop' );
					}

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'includes/template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- .stage -->
<?php
get_footer();