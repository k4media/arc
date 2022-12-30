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
            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
            <div class="entry-meta">
                <?php arc_entry_meta(); ?>
            </div><!-- .entry-meta -->
            <div class="excerpt"><?php the_excerpt() ?></div>
            <?php
                if ( function_exists('get_field') ) {
                    $pdf = get_field('pdf');
                }
                if ( isset($pdf['url']) ) : 
            ?>
                <div class="pdf"><a target="_blank" href="<?php echo $pdf['url']; ?>">View PDF</a></div>
            <?php endif; ?>

            <?php if ( strlen(get_the_content( null, false, get_the_ID() )) > 0 )  : ?>
                <div class="jump"><a href="<?php echo get_the_permalink() ?>">View Project Summary</a></div>
            <?php endif; ?>

        </header><!-- .entry-header -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
