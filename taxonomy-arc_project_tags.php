<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Angkor_Research_&_Consulting
 */


 $service = ( isset( $_GET['service'] ) ) ? sanitize_text_field( $_GET['service'] ) : null;
 $service_term = get_term_by( 'slug', $service , 'arc_project_tax' );
 $client = ( isset( $_GET['client'] ) ) ? sanitize_text_field( $_GET['client'] ) : null;
 $client_term  = get_term_by( 'slug', $client , 'arc_clients' );
 $year     = ( isset( $_GET['pyear'] ) ) ? intval( substr($_GET['pyear'],0,4) ) : null;

get_header();

?>
	<div class="stage">
		<?php
			if ( "arc_projects" === get_post_type() ) {
				get_sidebar("projects");
			}
		?>
		<main id="primary" class="site-main archive-projects <?php echo get_post_type() ?>">

		<?php if ( have_posts() ) : ?>

			<?php
				$title = "Projects";
				$tag = get_queried_object();
				if ( isset($tag->name) ) {
					$title .= " / " . $tag->name;
				}

			?>
			<header class="page-header"><h1><?php echo $title ?></h1></header>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'includes/template-parts/content/project', 'loop' );

			endwhile;

			echo '<div class="pagination">' . paginate_links() . '</div>';

		else :

			get_template_part( 'includes/template-parts/content/project', 'none' );

		endif;
		?>

	</main><!-- #main -->
	</div>
<?php
get_footer();
