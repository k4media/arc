<?php

     $image_url = get_stylesheet_directory_uri() . "/assets/media/placeholder.jpg";
     $caption   = "";

     // get fields via acf
     if ( function_exists('get_field') ) {
          $image   = get_field('image');
          $caption = get_field('caption');
          if ( isset($image['url']) ) {
               $image_url = $image['url'];
          }
     }

?>
<div class="photo-feature fp-callout" style="background-image:url(<?php echo $image_url ?>)">
     <?php if ( ! empty($caption) ) : ?>
          <div class="caption"><p><?php echo $caption ?></p></div>
     <?php endif; ?>
</div>
