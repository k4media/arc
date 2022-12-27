<?php

     $title   = "";
     $gallery = "";
     $boxes   = "";
     $url     = "";
     $countups = array();

     // get fields via acf
     if ( function_exists('get_field') ) {
          $title   = get_field('title');
          $boxes   = get_field('boxes');
          foreach ( $boxes as $b ) {
               $countups[] = '<div class="countup"><span class="number">' . number_format($b['number']) . '</span><span class="label">' . $b['label'] . '</span></div>';
          }
     }

     $url = arc_frontpage_hero_url();

?>
<div id="front-page-hero" class="hero" style="background-image:url(<?php if ( isset($url) ) { echo $url; } ?>)">
     <div class="overlay"></div>
     <div class="copy-stage">
          <div class="copy silo">
               <div class="fp-hero-title"><h2><?php echo wp_kses($title, array( 'br' => array())) ?></h2></div>
               <?php if ( count($countups) > 0 ) : ?>
                    <div class="countup-boxes"><?php echo implode("", $countups) ?></div>
               <?php endif; ?>
          </div>
     </div>
</div>
