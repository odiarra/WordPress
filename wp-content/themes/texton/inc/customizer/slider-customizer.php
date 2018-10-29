<?php
/**
 * Slider Customizer Options
 *
 * @package texton
 */

// Add slider section
$wp_customize->add_section( 'texton_slider_section', array(
	'title'             => esc_html__( 'Slider Section','texton' ),
	'description'       => esc_html__( 'Slider Setting Options', 'texton' ),
	'panel'             => 'texton_theme_options_panel',
) );

// slider menu enable setting and control.
$wp_customize->add_setting( 'texton_theme_options[enable_slider]', array(
	'default'           => texton_theme_option('enable_slider'),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[enable_slider]', array(
	'label'             => esc_html__( 'Enable Slider', 'texton' ),
	'section'           => 'texton_slider_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// slider social menu enable setting and control.
$wp_customize->add_setting( 'texton_theme_options[slider_entire_site]', array(
	'default'           => texton_theme_option('slider_entire_site'),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[slider_entire_site]', array(
	'label'             => esc_html__( 'Show Entire Site', 'texton' ),
	'section'           => 'texton_slider_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// slider arrow control enable setting and control.
$wp_customize->add_setting( 'texton_theme_options[slider_arrow]', array(
	'default'           => texton_theme_option('slider_arrow'),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[slider_arrow]', array(
	'label'             => esc_html__( 'Show Arrow Controller', 'texton' ),
	'section'           => 'texton_slider_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// slider btn label chooser control and setting
$wp_customize->add_setting( 'texton_theme_options[slider_btn_label]', array(
	'default'          	=> texton_theme_option('slider_btn_label'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'texton_theme_options[slider_btn_label]', array(
	'label'             => esc_html__( 'Button Label', 'texton' ),
	'section'           => 'texton_slider_section',
	'type'				=> 'text',
) );

// slider alt btn label chooser control and setting
$wp_customize->add_setting( 'texton_theme_options[slider_alt_btn_label]', array(
	'default'          	=> texton_theme_option('slider_alt_btn_label'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'texton_theme_options[slider_alt_btn_label]', array(
	'label'             => esc_html__( 'Alt Button Label', 'texton' ),
	'section'           => 'texton_slider_section',
	'type'				=> 'text',
) );

// slider alt btn url chooser control and setting
$wp_customize->add_setting( 'texton_theme_options[slider_alt_btn_url]', array(
	'default'          	=> texton_theme_option('slider_alt_btn_url'),
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( 'texton_theme_options[slider_alt_btn_url]', array(
	'label'             => esc_html__( 'Alt Button Link', 'texton' ),
	'section'           => 'texton_slider_section',
	'type'				=> 'url',
) );

for ( $i = 1; $i <= 5; $i++ ) :

	// slider pages drop down chooser control and setting
	$wp_customize->add_setting( 'texton_theme_options[slider_content_page_' . $i . ']', array(
		'sanitize_callback' => 'texton_sanitize_page_post',
	) );

	$wp_customize->add_control( new Texton_Dropdown_Chosen_Control( $wp_customize, 'texton_theme_options[slider_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'texton' ), $i ),
		'section'           => 'texton_slider_section',
		'choices'			=> texton_page_choices(),
	) ) );

endfor;