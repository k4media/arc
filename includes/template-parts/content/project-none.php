<?php
/**
 * Template part for displaying a message that posts cannot be found
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

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'arc' ); ?></h1>
		<?php
				$subtitle = array();

				if ( NULL !== $service ) {
					$subtitle[] = esc_attr($service_term->name);
				}
				if ( NULL !== $client ) {
					$subtitle[] = esc_attr($client_term->name);
				}
				if ( NULL !== $year ) {
					$subtitle[] = esc_attr($year);
				}

				$subtitle = implode( " / ", $subtitle);

				echo '<p>No projects found for ' . $subtitle . '</p>';
		?>
	</header><!-- .page-header -->

	<div class="page-content">
		
	</div><!-- .page-content -->
</section><!-- .no-results -->
