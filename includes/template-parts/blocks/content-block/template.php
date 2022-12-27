<?php

     $title = "";
     $text  = "";
     $image = "";

     // get fields via acf
     if ( function_exists('get_field') ) {
          $title = get_field('title');
          $text  = get_field('text');
          $image = get_field('image');
     }

?>
<div class="content-block">
     <div class="silo">
          <div class="column column1">
               <?php if ( isset($title) ) : ?>
                    <h3><?php echo $title ?></h3>
               <?php endif; ?>
               <?php if ( isset($text) ) : ?>
                    <?php echo $text ?>
               <?php endif; ?>
          </div>
          <div class="column column2">
               <?php if ( isset($image['url']) ) : ?>
                    <div class="image"><img src="<?php echo $image['url'] ?>"></div>
               <?php endif; ?>
          </div>
     </div>
</div>
