<?php
/**
 * Angkor Research & Consulting Theme Customizer
 *
 * @package Angkor_Research_&_Consulting
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function arc_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'arc_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'arc_customize_partial_blogdescription',
			)
		);
	}

	// Register theme options
    $wp_customize->add_section( 'arc_theme_options' , array(
        'title'      => __( 'Social Media', 'arc' ),
        'priority'   => 5000,
        'sanitize_callback'  => 'sanitize_url',
    ));

    // linkedin
    $wp_customize->add_setting( 'arc_linkedin' , array(
        'default'     => '',
        'transport'   => 'refresh',
        'sanitize_callback'  => 'sanitize_url',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'arc_linkedin',
            array(
                'label'          => __( 'LinkedIn', 'arc' ),
                'section'        => 'arc_theme_options',
                'settings'       => 'arc_linkedin',
                'type'           => 'text'
            )
        )
    );
    // facebook
    $wp_customize->add_setting( 'arc_facebook' , array(
        'default'     => '',
        'transport'   => 'refresh',
        'sanitize_callback'  => 'sanitize_url',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'arc_facebook',
            array(
                'label'          => __( 'Facebook', 'arc' ),
                'section'        => 'arc_theme_options',
                'settings'       => 'arc_facebook',
                'type'           => 'text'
            )
        )
    );
    //twitter
    $wp_customize->add_setting( 'arc_twitter' , array(
        'default'     => '',
        'transport'   => 'refresh',
        'sanitize_callback'  => 'sanitize_url',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'arc_twitter',
            array(
                'label'          => __( 'Twitter', 'arc' ),
                'section'        => 'arc_theme_options',
                'settings'       => 'arc_twitter',
                'type'           => 'text'
            )
        )
    );
    //youtube
    $wp_customize->add_setting( 'arc_youtube' , array(
        'default'     => '',
        'transport'   => 'refresh',
        'sanitize_callback'  => 'sanitize_url',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'arc_youtube',
            array(
                'label'          => __( 'YouTube', 'arc' ),
                'section'        => 'arc_theme_options',
                'settings'       => 'arc_youtube',
                'type'           => 'text'
            )
        )
    );
}
add_action( 'customize_register', 'arc_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function arc_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function arc_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function arc_customize_preview_js() {
	wp_enqueue_script( 'arc-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'arc_customize_preview_js' );
