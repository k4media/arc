<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Angkor_Research_&_Consulting
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="thumbnail"><?php arc_post_thumbnail(); ?></div>
    <?php endif; ?>
        
    <div class="entry">
	    <header class="entry-header">
            <?php
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            ?>
            <div class="entry-meta">
                <?php
                    $post_date = get_the_date( 'M d, Y' );
                    echo '<span class="posted-on">' . $post_date . '</span> | ';
                    echo '<span class="posted-in">' . arc_post_tags() . '</span>';
                    //arc_posted_on();
                    //arc_posted_by();
                ?>
            </div><!-- .entry-meta -->
            
            <div class="excerpt"><?php the_excerpt() ?>

        </header><!-- .entry-header -->
    </div>

</article><!-- #post-<?php the_ID(); ?> -->
