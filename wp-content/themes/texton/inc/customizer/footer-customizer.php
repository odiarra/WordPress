<?php
/**
 * Footer Customizer Options
 *
 * @package texton
 */

// Add footer section
$wp_customize->add_section( 'texton_footer_section', array(
	'title'             => esc_html__( 'Footer Section','texton' ),
	'description'       => esc_html__( 'Footer Setting Options', 'texton' ),
	'panel'             => 'texton_theme_options_panel',
) );

// slide to top enable setting and control.
$wp_customize->add_setting( 'texton_theme_options[slide_to_top]', array(
	'default'           => texton_theme_option('slide_to_top'),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[slide_to_top]', array(
	'label'             => esc_html__( 'Show Slide to Top', 'texton' ),
	'section'           => 'texton_footer_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// copyright text
$wp_customize->add_setting( 'texton_theme_options[copyright_text]',
	array(
		'default'       		=> texton_theme_option('copyright_text'),
		'sanitize_callback'		=> 'texton_santize_allow_tags',
	)
);
$wp_customize->add_control( 'texton_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'texton' ),
		'section'    			=> 'texton_footer_section',
		'type'		 			=> 'textarea',
    )
);
