<?php

/**
 * ARC Theme bootstap
 */

 /**
 * Theme Functions
 */
require get_template_directory() . '/includes/arc-functions.php';

/**
 * Fragment Cache
 */
require get_template_directory() . '/includes/k4-cache.php';

 /**
 * Theme Filters
 */
require get_template_directory() . '/includes/arc-filters.php';

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

/**
 * Custom Post Types
 */
require 'arc-custom-post-types.php';