<?php

/**
 * Get url for front page image
 */
function arc_frontpage_hero_url() {

    // transient key
    $cache_key = "arc_fp_hero_image";

    // transient ttl
    $cache_ttl = 1 * DAY_IN_SECONDS;

    // get url tranisent
    $url       = get_transient( $cache_key );
    if ( false !== $url) 
        return $url[0];
    
    // refresh transient
    if ( function_exists('get_field') ) {
        $gallery = get_field('gallery');
        if ( is_array($gallery) ) {
            $images  = array();
            foreach ( $gallery as $g ) {
                $images[] = $g['url'];
            }
            $count     = count($gallery);
            $index     = rand(1, $count-1);
            $transient = array($images[$index]);
            set_transient($cache_key, $transient, $cache_ttl);
            return $images[$index];
        }
    }
}