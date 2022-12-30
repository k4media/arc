<?php
add_filter('get_the_archive_title', function ($title) {
    if ( is_home() ) {
        $title = "News";
    }
    if ( is_category() ) {
        $title = single_cat_title( 'News / ', false );
    }
    return $title;
});