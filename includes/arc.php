<?php

/**
 * ARC Theme bootstap
 */

 /**
 * Theme Functions
 */
require get_template_directory() . '/includes/arc-functions.php';

/**
 * Theme Actions
 */
require get_template_directory() . '/includes/arc-actions.php';

/**
 * Customizer additions
 */
require get_template_directory() . '/includes/arc-customizer.php';

/**
 * ACF Page Blocks
 */
require 'arc-acf-blocks.php';