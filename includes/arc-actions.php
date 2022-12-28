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

add_action('arc_project_filters', 'arc_project_filters');
function arc_project_filters() {

    $services     = array();

    $get_service  = ( isset( $_GET['service'] ) ) ? sanitize_text_field( $_GET['service'] ) : null;
    $service_term = get_term_by( 'slug', $get_service , 'arc_project_tax' );

    if ( ! isset($_GET['service']) || false === $service_term ) {
        $services[] = '<li><span class="current-menu-item" href="' . get_post_type_archive_link('arc_projects') . '">View All</span></li>';
    } else {
        $services[] = '<li><a href="' . get_post_type_archive_link('arc_projects') . '">View All</a></li>';
    }
    
    $args = array(
        'taxonomy' => 'arc_project_tax',
        'hide_empty' => false,
    );
    $terms = get_terms($args);

    if ( is_array($terms) ) {
        foreach ($terms as $t) {
            $class="";
            if ( $get_service === $t->slug ) {
                $services[] = '<li><a class="current-menu-item" href="' . get_post_type_archive_link('arc_projects') . '">' . $t->name. '</a></li>';
            } else {
                $services[] = '<li><a class="" href="' . get_post_type_archive_link('arc_projects') . '?service=' . $t->slug . '">' . $t->name. '</a></li>';
            }
        }
    }

    echo '<h2>Services</h2>';
    echo '<ul class="arc-services">' . implode("", $services) . '</ul>';


    $clients     = array();

    $get_client  = ( isset( $_GET['client'] ) ) ? sanitize_text_field( $_GET['client'] ) : null;
    $client_term = get_term_by( 'slug', $get_client , 'arc_clients' );

    if ( ! isset($_GET['client']) || false === $client_term ) {
        $clients[] = '<li><span class="current-menu-item" href="' . get_post_type_archive_link('arc_projects') . '">View All</span></li>';
    } else {
        $clients[] = '<li><a href="' . get_post_type_archive_link('arc_projects') . '">View All</a></li>';
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
                $clients[] = '<li><a class="current-menu-item" href="' . get_post_type_archive_link('arc_projects') . '">' . $t->name. '</a></li>';
            } else {
                $clients[] = '<li><a class="" href="' . get_post_type_archive_link('arc_projects') . '?client=' . $t->slug . '">' . $t->name. '</a></li>';
            }
        }
    }

    echo '<h2>Clients</h2>';
    echo '<ul class="arc-clients">' . implode("", $clients) . '</ul>'; 
    

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
