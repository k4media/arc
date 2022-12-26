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
<div class="photo-feature fp-callout" style="background-image:url(<?php echo $image_url ?>)">
     <?php if ( isset($caption) ) : ?>
          <div class="caption"><p><?php echo $caption ?></p></div>
     <?php endif; ?>
</div>
