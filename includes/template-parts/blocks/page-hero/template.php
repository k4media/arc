<?php

     global $post;

     $title     = "";
     $image_url = get_stylesheet_directory_uri() . "/assets/media/placeholder.jpg";

     // get fields via acf
     if ( function_exists('get_field') ) {
          $title = get_field('title');
          if ( "" === $title ) {
               $title = $post->post_title;
          }
          $image  = get_field('image');
          if ( isset($image['url']) ) {
               $image_url  = $image['url'];
          }
     }

?>
<div id="front-page-hero" class="hero" style="background-image:url(<?php echo $image_url; ?>)">
     <div class="overlay"></div>
     <div class="copy-stage">
          <div class="copy silo">
               <div class="fp-hero-title"><h2><?php echo wp_kses($title, array( 'br' => array())) ?></h2></div>
          </div>
     </div>
</div>
