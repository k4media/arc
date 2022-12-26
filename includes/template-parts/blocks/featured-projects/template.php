<?php

     $image_url = "";
     $caption   = "";

     // get fields via acf
     if ( function_exists('get_field') ) {
          $image   = get_field('image');
          $caption = get_field('caption');
          if ( isset($image) ) {
               $image_url = $image['url'];
          }
     }

?>
<div id="feature-projects" class="fp-callout">
     <div class="silo">

     </div>
</div>
