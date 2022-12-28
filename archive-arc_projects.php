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

 if ( NULL !== $service && get_term_by( 'slug', $service , 'arc_project_tax' ) ) {
	echo "valid";
 }


get_header();
?>
	<div class="stage">
		<?php
			if ( "arc_projects" === get_post_type() ) {
				get_sidebar("projects");
			}
		?>
		<main id="primary" class="site-main <?php echo get_post_type() ?>">

		<?php if ( have_posts() ) : ?>

			<?php
				
				$page_title = "Projects";

				if ( NULL !== $service ) {
					$page_title .= " / " . esc_attr($service_term->name);
				}
					
			?>
			
			<header class="page-header"><h1><?php echo $page_title ?></h1></header>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'includes/template-parts/content/content', 'project-loop' );

			endwhile;

		else :

			get_template_part( 'template-parts/content/content', 'none' );

		endif;
		?>

	</main><!-- #main -->
	</div>
<?php
get_footer();
