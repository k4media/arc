<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Angkor_Research_&_Consulting
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="silo">
			<div class="site-info">
				<?php do_action("arc_logo") ?>
				<?php do_action("arc_footer_text") ?>
			</div>
			<div class="follow">
				<?php do_action("arc_social_links") ?>
			</div>
		</div>
		<?php do_action("arc_copyright") ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
