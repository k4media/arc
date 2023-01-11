<?php

     // get fields
     if ( function_exists('get_fields') ) {
          $projects = get_field('project');
     }

     $posts_per_page = 3;

     $args = array(  
          'post_type'      => 'arc_projects',
          'post_status'    => 'publish',
          'posts_per_page' => $posts_per_page, 
          'orderby'        => 'date', 
          'order'          => 'DESC', 
      );

      $query = new WP_Query($args);

      $output = array();

      if( count($query->posts) > 0 ) {
          foreach ( $query->posts as $post ) {

               $meta = get_post_meta($post->ID);

               /**
                * Clients
                */
               $clients = array();
               if ( is_array(unserialize($meta['clients'][0])) ) {
                    $array = unserialize($meta['clients'][0]);
                    foreach( $array as $client ) {
                         $term = get_term($client);
                         $clients[] = esc_attr($term->name);
                    }
               }
               
               /**
                * Services
                */
                $services = array();
                if ( is_array(unserialize($meta['services'][0])) ) {
                     $array = unserialize($meta['services'][0]);
                     foreach( $array as $service ) {
                          $term = get_term($service);
                          $services[] = '<a href="' . esc_url(get_term_link($term->term_id)) . '">' . esc_attr($term->name) . '</a>';
                     }
                }

               $output[] = '<article class="project">';
                    $output[] = '<time datetime="' . get_the_time( '', $post ) .'">' . get_the_time( 'F Y' ) . '</time>';
                    $output[] = '<a href="' . get_permalink($post->ID) . '"><div class="thumbnail" style="background-image: url(' . get_the_post_thumbnail_url($post->ID, 'medium_large') . ')"></div></a>';
                    $output[] = '<h2><a href="' . get_permalink($post->ID) . '">' . esc_html(wp_strip_all_tags($post->post_title)) . '</a></h2>';
                    if ( ! empty($clients) ) {
                         $output[] = '<div class="clients"><span>Clients</span>: ' . implode(", ", $clients) . '</span></div>';
                    }
                    if ( ! empty($services) ) {
                         $output[] = '<div class="services"><span>Sectors</span>: ' . implode(", ", $services) . '</span></div>';
                    }
               $output[] = '</article>';

          }
      }

?>
<div id="projects-callout-stage">
     <div class="silo">
          <h3><?php _e("Featured Projects", "arc"); ?></h3>
          <div class="projects-callout">
               <?php echo implode($output) ?>
          </div>
          <div class="jump"><a href="<?php echo get_tag_link(64) ?>"><?php _e("View All Case Studies", "arc"); ?></a></div>
     </div>
</div>
