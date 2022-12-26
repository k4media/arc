<?php

     $title = "";
     $url   = "";

     // get fields via acf
     if ( function_exists('get_field') ) {
          $title   = get_field('title');
          $image   = get_field('image');
          if ( isset($image) ) {
               $url = $image['url'];
          }
     }

?>
<div id="front-page-hero" class="hero" style="background-image:url(<?php if ( isset($url) ) { echo $url; } ?>)">
     <div class="overlay"></div>
     <div class="copy-stage">
          <div class="copy silo">
               <div class="fp-hero-title"><h2><?php echo wp_kses($title, array( 'br' => array())) ?></h2></div>
          </div>
     </div>
</div>
