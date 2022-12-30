<?php

function arc_project_tags() {
    if ( function_exists('get_field') ) {
        $output = array();
        $tags = get_field('tag');
        if ( NULL !== $tags ){
            foreach( $tags as $t ) {
                if ( ! is_wp_error( get_term_link($t->term_id, 'arc_project_tags') ) ) {
                    $output[] = '<li><a href="' . get_term_link($t->term_id, 'arc_project_tags') . '">' . $t->name . '</a></li>';
                }
            }
            if ( count($output) > 0 ) {
                echo '<fiv class="project-tags"><span>Tagged</span>: <ul>' . implode(", ", $output) . '</ul>';
            }
        }
    }
}
function arc_entry_meta() {

    if ( function_exists('get_field') ) {

        // project years
        $years = get_field('years', get_the_ID());
        echo '<span class="project-date">' . implode("–", $years) . '</span> | ';

        // project client
        $clients = array();
        $client_ids = get_field('clients', get_the_ID());
        foreach( $client_ids as $c) {
            $clients[] = $c->name;
        }
        echo '<span class="client">' . implode(", ", $clients) . '</span>';

        // project services

        if ( ! is_single() ) {

            $services = get_field('services', get_the_ID());

            $output = array();
            foreach( $services as $s ) {
                // $output[] = '<a href="' . get_term_link($s->term_id) . '">' . $s->name . '</a>';
                $output[] = $s->name;
            }

            //$client = get_term($client_id, 'arc_clients' );
            echo ' | <span class="services">' . implode(", ", $output) . '</span>';

        }
        

    }

}

/**
* Get url for front page image
*/
function arc_frontpage_hero_url() {

    // transient key
    $cache_key = "arc_fp_hero_image";

    // transient ttl
    $cache_ttl = 1 * DAY_IN_SECONDS;

    // get url tranisent
    $url = get_transient( $cache_key );
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

/**
 * Helper function to flatten multidimensional array
 */
function flatten_array(array $array) {
    return iterator_to_array(
         new \RecursiveIteratorIterator(new \RecursiveArrayIterator($array)));
}