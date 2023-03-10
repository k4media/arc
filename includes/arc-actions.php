<?php

/**
 * ARC Logo
 */
add_action('arc_logo', 'arc_logo');
function arc_logo() {
    if ( has_custom_logo() ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        if ( is_front_page() ) {
            echo '<div class="site-logo"><img src="' . $image[0] . '"></div>';
        } else {
            echo '<div class="site-logo"><a href="' . get_home_url() . '"><img src="' . $image[0] . '"></a></div>';
        }
    }
}

/**
 * Projects Query.
 * 
 * Filter WP Main query for projects
 * 
 * @query WordPress query
 * 
 */
add_action( 'pre_get_posts', 'arc_project_archive_filters');
function arc_project_archive_filters( $query ) {

    if ( is_admin() || ! $query->is_main_query() ) {
		return;    
	}

    if ( is_post_type_archive('arc_projects') ) {

        $service = ( isset( $_GET['service'] ) ) ? sanitize_text_field( $_GET['service'] ) : null;
        $service_term = get_term_by( 'slug', $service , 'arc_project_tax' );

        $client = ( isset( $_GET['client'] ) ) ? sanitize_text_field( $_GET['client'] ) : null;
        $client_term = get_term_by( 'slug', $client , 'arc_clients' );

        $get_year = ( isset( $_GET['pyear'] ) ) ? intval( substr($_GET['pyear'],0,4) ) : null;

        $querylist = array();

        if ( is_object($service_term) && isset($service_term->term_id) ) {
            $querylist[] = array(
                'taxonomy' => 'arc_project_tax',
                'field' => 'term_id',
                'terms' => array($service_term->term_id),
                'operator'=> 'IN'
            );
            $query->set( 'tax_query', array($querylist) );
        }

        if ( is_object($client_term) && isset($client_term->term_id) ) {
            $querylist[] = array(
                'taxonomy' => 'arc_clients',
                'field' => 'term_id',
                'terms' => array($client_term->term_id),
                'operator'=> 'IN'
            );
            $taxquery = array(
                'relationship' => 'AND',
                $querylist
            );
            $query->set( 'tax_query', array($querylist) );
        } 

        // sort by year
        if ( isset($get_year) ) {
            $query->set('meta_query', array(
                    'relation' => 'OR',
                    array(
                        'key'       => 'years',
                        'value'     => $get_year,
                        'compare'   => 'LIKE'
                    )
                )
            );
        }

        // order by project year descending
        $query->set('orderby', 'meta_value');    
        $query->set('meta_key', 'years');    
        $query->set('order', 'DESC'); 

        // optimize
        $query->set('no_found_rows',  false);
        $query->set('ignore_sticky_posts',  true);
        $query->set('update_post_meta_cache',  true);
        $query->set('update_post_term_cache',  true);

    }
}

add_action('arc_project_filters', 'arc_project_filters');
function arc_project_filters() {

    global $wpdb;

    $selected = array();

    $query_vars = array();
    
    /**
     * Services query args
     */
    $services     = array();
    $get_service  = ( isset( $_GET['service'] ) ) ? sanitize_text_field( $_GET['service'] ) : null;
    $service_term = get_term_by( 'slug', $get_service , 'arc_project_tax' );

    if ( isset($service_term->slug) ) {
        $selected['service'] = $service_term->slug;
    }

    /**
     * Clients query args
     */
    $clients      = array();
    $get_client   = ( isset( $_GET['client'] ) ) ? sanitize_text_field( $_GET['client'] ) : null;
    $client_term  = get_term_by( 'slug', $get_client , 'arc_clients' );

    if ( isset($client_term->slug) ) {
        $selected['client'] = $client_term->slug;
    }

    /**
     * Year query args
     */
    $get_year = ( isset( $_GET['pyear'] ) ) ? intval( substr($_GET['pyear'],0,4) ) : null;
    if ( isset($get_year) ) {
        $selected['pyear'] = $get_year;
    }

    /**
     * Services navigation
     */

    if ( ! is_single() && ( ! isset($_GET['service']) || false === $service_term ) ) {
        $services[] = '<li><span class="current-menu-item">View All</span></li>';
    } else {
        $query_vars['service'] = NULL;
        if ( isset($selected['client']) ) {
            $query_vars['client'] = $selected['client'];
        }
        if ( isset($selected['pyear']) ) {
            $query_vars['pyear'] = $selected['pyear'];
        }
        $link = add_query_arg( $query_vars, get_post_type_archive_link('arc_projects') );
        $services[] = '<li><a href="' . $link . '">View All</a></li>';
    }
    
    $args = array(
        'taxonomy' => 'arc_project_tax',
        'hide_empty' => true,
    );
    $terms = get_terms($args);
    if ( is_array($terms) ) {
        foreach ($terms as $t) {
            $class="";
            if ( $get_service === $t->slug ) {
                $query_vars['service'] = NULL;
                if ( isset($selected['client']) ) {
                    $query_vars['client'] = $selected['client'];
                }
                if ( isset($selected['pyear']) ) {
                    $query_vars['pyear'] = $selected['pyear'];
                }
                $link = add_query_arg( $query_vars, get_post_type_archive_link('arc_projects') );
                $services[] = '<li><a class="current-menu-item" href="' . get_post_type_archive_link('arc_projects') . '">' . $t->name. '</a></li>';
            } else {
                $query_vars['service'] = urlencode($t->slug);
                if ( isset($selected['client']) ) {
                    $query_vars['client'] = $selected['client'];
                }
                if ( isset($selected['pyear']) ) {
                    $query_vars['pyear'] = $selected['pyear'];
                }
                $link = add_query_arg( $query_vars , get_post_type_archive_link('arc_projects'));
                $services[] = '<li><a class="" href="' . $link . '">' . $t->name. '</a></li>';
                $query_vars['service'] = NULL;
            }
            
        }
    }

    echo '<h3>Filter Projects</h3><h4>Services</h4>';
    echo '<ul class="arc-services">' . implode("", $services) . '</ul>';

    /**
     * Clients navigation
     */

    if ( ! is_single() && ( ! isset($_GET['client']) || false === $client_term)  ) {
        $clients[] = '<li><span class="current-menu-item">View All</span></li>';
    } else {
        if ( isset($selected['service']) ) {
            $query_vars['service'] = $selected['service'];
        }
        $query_vars['client'] = NULL;
        if ( isset($selected['pyear']) ) {
            $query_vars['pyear'] = $selected['pyear'];
        }
        $link = add_query_arg( $query_vars, get_post_type_archive_link('arc_projects'));
        $clients[] = '<li><a href="' . $link . '">View All</a></li>';
    }
    
    $args = array(
        'taxonomy' => 'arc_clients',
        'hide_empty' => false,
    );
    $terms = get_terms($args);
    if ( is_array($terms) ) {
        foreach ($terms as $t) {
            $class="";
            if ( $get_client === $t->slug ) {
                if ( isset($selected['service']) ) {
                    $query_vars['service'] = $selected['service'];
                }
                $query_vars['client'] = NULL;
                if ( isset($selected['pyear']) ) {
                    $query_vars['pyear'] = $selected['pyear'];
                }
                $link = add_query_arg( $query_vars, get_post_type_archive_link('arc_projects') );
                $clients[] = '<li><a class="current-menu-item" href="' . $link . '">' . $t->name. '</a></li>';
            } else {
                if ( isset($selected['service']) ) {
                    $query_vars['service'] = $selected['service'];
                }
                $query_vars['client'] = urlencode($t->slug);
                if ( isset($selected['pyear']) ) {
                    $query_vars['pyear'] = $selected['pyear'];
                }
                $link = add_query_arg( $query_vars, get_post_type_archive_link('arc_projects') );
                $clients[] = '<li><a class="" href="' . $link . '">' . $t->name. '</a></li>';
                $query_vars['client'] = NULL;
            }
        }
    }

    echo '<h4>Clients</h4>';
    echo '<ul class="arc-clients">' . implode("", $clients) . '</ul>'; 

    /**
     * Years
     */
    
     $output = array();
     if ( ! is_single() && ( NULL === $get_year || 0 === $get_year ) ) {
        $output[] = '<li><span class="current-menu-item">View All</span></li>';
    } else {
        if ( isset($selected['service']) ) {
            $query_vars['service'] = $selected['service'];
        }
        if ( isset($selected['client']) ) {
            $query_vars['client'] = $selected['client'];
        }
        $query_vars['pyear'] = NULL;
        $link = add_query_arg( $query_vars, get_post_type_archive_link('arc_projects') );
        $output[] = '<li><a href="' . $link . '">View All</a></li>';
    }

    $years = array();
    $query = 'SELECT meta_value FROM ' . $wpdb->prefix . 'postmeta WHERE meta_key="years"';
    $results = $wpdb->get_results($query);

    foreach ( $results as $r ) {
        $project_years = unserialize($r->meta_value);
        foreach ( $project_years as $p ) {
            array_push($years, $p);
        }
    }
    $years = array_unique($years);
    rsort($years);
    
    foreach ( $years as $year ) {
        if ( isset($get_year) && $year == $get_year ) {
            if ( isset($selected['service']) ) {
                $query_vars['service'] = $selected['service'];
            }
            if ( isset($selected['client']) ) {
                $query_vars['client'] = $selected['client'];
            }
            $query_vars['pyear'] = NULL;
            $link = add_query_arg( $query_vars, get_post_type_archive_link('arc_projects') );
            $output[] = '<li><a class="current-menu-item" href="' . $link . '">' . $year . '</a></li>';
        } else {
            if ( isset($selected['service']) ) {
                $query_vars['service'] = $selected['service'];
            }
            if ( isset($selected['client']) ) {
                $query_vars['client'] = $selected['client'];
            }
            $query_vars['pyear'] = $year;
            $link = add_query_arg( $query_vars, get_post_type_archive_link('arc_projects') );
            $output[] = '<li><a href="' . $link . '">' . $year . '</a></li>';
        }
        
    }

    echo '<h4>Years</h4>';
    echo '<ul class="arc-years">' . implode("", $output) . '</ul>'; 
}

/**
 * Footer actions
 */

add_action('arc_footer_text', 'arc_footer_text');
function arc_footer_text() {
    if( function_exists('get_field') ) {
        $text = get_field('ftext', 'option');
        if ( isset($text) ) {
            $args = array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
            );
            echo wp_kses($text, $args);
        }
    }
}

add_action('arc_social_links', 'arc_social_links');
function arc_social_links() {
    $mods = get_theme_mods();
    echo '<div class="social-links">';
    if ( isset($mods['arc_linkedin']) ) {
        echo '<a href="' . $mods['arc_linkedin'] . '"><img src="' . get_stylesheet_directory_uri() . '/assets/media/icon-linkedin.svg"></a>';
    }
    if ( isset($mods['arc_facebook']) ) {
        echo '<a href="' . $mods['arc_facebook'] . '"><img src="' . get_stylesheet_directory_uri() . '/assets/media/icon-facebook.svg"></a>';
    }
    if ( isset($mods['arc_twitter']) ) {
        echo '<a href="' . $mods['arc_twitter'] . '"><img src="' . get_stylesheet_directory_uri() . '/assets/media/icon-twitter.svg"></a>';
    }  
    if ( isset($mods['arc_youtube']) ) {
        echo '<a href="' . $mods['arc_youtube'] . '"><img src="' . get_stylesheet_directory_uri() . '/assets/media/icon-youtube.svg"></a>';
    }
    echo '</div>';
}

add_action('arc_copyright', 'arc_copyright');
function arc_copyright() {
    echo '<div id="fineprint" class="silo">';
        echo '<div class="copyright-notice">&copy; Copyright ' . date('Y') . ' ' . get_bloginfo('name') . '</div>';
        wp_nav_menu( array(
            'theme_location'	=> 'footer',
            'fallback_cb'       => '',
            'container'         => ''
        ) );
    echo '</div>';
}
