<?php

     /**
      * Number of projects to display
      */
     $total_projects = 3;

     /**
      * Track post ids for query
      */
     $post_in = array();

     /**
      * Step 1: Get user designated posts
      */
      if ( function_exists('get_fields') ) {
          $selected_projects = get_field('projects');
          if ( is_array($selected_projects) ) {
               $post_in = $selected_projects[0]['arcpro'];
          }
     }

     /**
      * Step 2: If designated posts are less than $total_projects, get extra post ids
      */
     if ( count($post_in) < 3 ) {

          $extra_posts = $total_projects - count($post_in);

          $args = array(  
               'post_type'              => 'arc_projects',
               'post_status'            => 'publish',
               'posts_per_page'         => $extra_posts,
               'orderby'                => 'date', 
               'order'                  => 'DESC',
               'ignore_sticky_posts'    => true,
               'no_found_rows'          => true,
               'update_post_meta_cache' => false, 
               'update_post_term_cache' => false,
               'fields'                 => 'ids'
          );

          $query = new WP_Query($args);

          foreach( $query->posts as $p ) {
               $post_in[] = $p;
          }
          
     }

     /**
      * Main query args
      */
      $args = array(  
          'post_type'              => 'arc_projects',
          'post_status'            => 'publish',
          'posts_per_page'         => $total_projects,
          'orderby'                => 'date', 
          'order'                  => 'DESC',
          'ignore_sticky_posts'    => true,
		'no_found_rows'          => true,
          'update_post_meta_cache' => false, 
          'update_post_term_cache' => false
     );

     /**
      * Include selected projects, if any
      */
      if ( count($post_in) > 0 ) {
          $args['post__in'] = $post_in;
     }

     /**
      * Main query
      */
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
          <div class="jump"><a href="<?php echo get_tag_link(11) ?>"><?php _e("View All Case Studies", "arc"); ?></a></div>
     </div>
</div>
