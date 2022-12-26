<?php

     $text = "";

     // get fields via acf
     if ( function_exists('get_field') ) {
          $text   = get_field('text');
     }

?>
<div id="page-lead">
     <div class="silo">
          <?php echo wp_kses($text, array( 'br' => array())) ?>
     </div>
</div>
