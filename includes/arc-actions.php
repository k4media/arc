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
